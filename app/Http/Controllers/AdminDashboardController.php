<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\TripImage;
use App\Models\Booking;
use App\Models\BookingParticipant;
use App\Models\Payment;
use App\Models\User;
use App\Models\Review;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalRevenue = Booking::where('status_pembayaran', 'Lunas')->sum('total_harga');
        $activeTripsCount = Trip::where('status', 'Aktif')->count();
        $totalUsers = User::count();

        // Latest bookings
        $latestBookings = Booking::with(['user', 'trip'])->latest()->take(5)->get();

        // Trips calendar
        $upcomingTrips = Trip::where('tanggal_berangkat', '>=', now())
            ->orderBy('tanggal_berangkat', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings', 'totalRevenue', 'activeTripsCount', 'totalUsers', 'latestBookings', 'upcomingTrips'
        ));
    }

    // --- TRIPS CRUD ---
    public function trips()
    {
        $trips = Trip::latest()->get();
        return view('admin.trips', compact('trips'));
    }

    public function storeTrip(Request $request)
    {
        $request->validate([
            'nama_gunung' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'kuota' => 'required|integer|min:1',
            'level_kesulitan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
            'location' => 'required|string|max:255',
            'image_url' => 'nullable|url',
            'itinerary' => 'nullable|array',
            'what_is_included' => 'nullable|array',
        ]);

        $slug = Str::slug($request->nama_gunung) . '-' . rand(100, 999);

        // Standard itinerary & inclusions
        $itinerary = $request->input('itinerary', [
            'Hari 1: Penjemputan & Basecamp',
            'Hari 2: Pendakian ke Camp Site',
            'Hari 3: Summit Attack & Kembali ke Basecamp'
        ]);

        $what_is_included = $request->input('what_is_included', [
            'Tiket Masuk & Simaksi',
            'Tenda & Peralatan Kelompok',
            'Makan Selama di Gunung',
            'Porter & Guide Berpengalaman'
        ]);

        $imageUrl = $request->input('image_url') ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80';

        Trip::create([
            'nama_gunung' => $request->nama_gunung,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'kuota' => $request->kuota,
            'sisa_kuota' => $request->kuota,
            'level_kesulitan' => $request->level_kesulitan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_pulang' => $request->tanggal_pulang,
            'location' => $request->location,
            'image_url' => $imageUrl,
            'itinerary' => $itinerary,
            'what_is_included' => $what_is_included,
            'status' => 'Aktif',
        ]);

        return redirect()->back()->with('success', 'Trip baru berhasil ditambahkan.');
    }

    public function updateTrip(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $request->validate([
            'nama_gunung' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'kuota' => 'required|integer|min:1',
            'level_kesulitan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
            'location' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $trip->update([
            'nama_gunung' => $request->nama_gunung,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'kuota' => $request->kuota,
            'level_kesulitan' => $request->level_kesulitan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_pulang' => $request->tanggal_pulang,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Trip berhasil diperbarui.');
    }

    public function deleteTrip($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->back()->with('success', 'Trip berhasil dihapus.');
    }

    // --- BOOKINGS & VERIFICATION ---
    public function bookings()
    {
        $bookings = Booking::with(['user', 'trip', 'payment', 'participants'])->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function verifyPayment(Request $request, $id)
    {
        $booking = Booking::with('payment')->findOrFail($id);
        
        $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        if (!$booking->payment) {
            return redirect()->back()->with('error', 'Belum ada data pembayaran untuk booking ini.');
        }

        if ($request->action === 'approve') {
            $booking->payment->update([
                'status_verifikasi' => 'Disetujui',
                'verified_by_admin_id' => Auth::guard('admin')->id(),
            ]);
            $booking->update(['status_pembayaran' => 'Lunas']);
            $msg = 'Pembayaran booking #' . $booking->id . ' disetujui.';
        } else {
            $booking->payment->update([
                'status_verifikasi' => 'Ditolak',
                'verified_by_admin_id' => Auth::guard('admin')->id(),
            ]);
            $booking->update(['status_pembayaran' => 'Dibatalkan']);
            
            // Revert kuota
            $trip = $booking->trip;
            $trip->sisa_kuota += $booking->jumlah_peserta;
            if ($trip->status === 'Penuh' && $trip->sisa_kuota > 0) {
                $trip->status = 'Aktif';
            }
            $trip->save();
            
            $msg = 'Pembayaran booking #' . $booking->id . ' ditolak.';
        }

        return redirect()->back()->with('success', $msg);
    }

    // --- USERS MANAGEMENT ---
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    // --- REVIEWS MODERATION ---
    public function reviews()
    {
        $reviews = Review::with(['user', 'trip'])->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function approveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status_approve' => true]);

        return redirect()->back()->with('success', 'Ulasan berhasil disetujui.');
    }

    public function rejectReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil ditolak/dihapus.');
    }

    // --- ARTICLES CRUD ---
    public function articles()
    {
        $articles = Article::with('author')->latest()->get();
        return view('admin.articles', compact('articles'));
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar_cover' => 'nullable|url',
        ]);

        $slug = Str::slug($request->judul) . '-' . rand(100, 999);
        $cover = $request->input('gambar_cover') ?: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80';

        Article::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'gambar_cover' => $cover,
            'author_admin_id' => Auth::guard('admin')->id(),
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Artikel baru berhasil dibuat.');
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
    }
}
