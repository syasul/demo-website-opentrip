<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\BookingParticipant;
use App\Models\Payment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with('trip')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('user.dashboard', compact('bookings'));
    }

    public function bookingForm($slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();
        if ($trip->sisa_kuota <= 0 || $trip->status !== 'Aktif') {
            return redirect()->back()->with('error', 'Trip ini sudah penuh atau tidak aktif.');
        }
        return view('user.booking', compact('trip'));
    }

    public function storeBooking(Request $request, $slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'jumlah_peserta' => 'required|integer|min:1|max:' . $trip->sisa_kuota,
            'notes' => 'nullable|string',
            'participants' => 'required|array|min:1',
            'participants.*.nama' => 'required|string|max:255',
            'participants.*.no_ktp' => 'required|string|max:30',
            'participants.*.kontak_darurat' => 'required|string|max:30',
            'participants.*.catatan_kesehatan' => 'nullable|string',
        ]);

        $jumlah = $request->input('jumlah_peserta');
        $totalHarga = $trip->harga * $jumlah;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'trip_id' => $trip->id,
            'jumlah_peserta' => $jumlah,
            'total_harga' => $totalHarga,
            'status_pembayaran' => 'Pending',
            'notes' => $request->input('notes'),
        ]);

        foreach ($request->input('participants') as $part) {
            BookingParticipant::create([
                'booking_id' => $booking->id,
                'nama' => $part['nama'],
                'no_ktp' => $part['no_ktp'],
                'kontak_darurat' => $part['kontak_darurat'],
                'catatan_kesehatan' => $part['catatan_kesehatan'] ?? null,
            ]);
        }

        // Decrement sisa kuota
        $trip->sisa_kuota -= $jumlah;
        if ($trip->sisa_kuota <= 0) {
            $trip->status = 'Penuh';
        }
        $trip->save();

        return redirect()->route('user.booking.success', $booking->id);
    }

    public function bookingSuccess($id)
    {
        $booking = Booking::with('trip')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.booking_success', compact('booking'));
    }

    public function invoice($id)
    {
        $booking = Booking::with(['trip', 'participants', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.invoice', compact('booking'));
    }

    public function uploadPayment(Request $request, $id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'bukti_transfer' => 'required|image|max:2048', // max 2MB
        ]);

        $payment = Payment::where('booking_id', $booking->id)->first();
        
        // Save image to public path for simple rendering without complex storage links
        $file = $request->file('bukti_transfer');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/payments'), $fileName);
        $fileUrl = '/uploads/payments/' . $fileName;

        if ($payment) {
            $payment->update([
                'bukti_transfer_url' => $fileUrl,
                'status_verifikasi' => 'Pending'
            ]);
        } else {
            Payment::create([
                'booking_id' => $booking->id,
                'metode' => 'Transfer Bank',
                'bukti_transfer_url' => $fileUrl,
                'status_verifikasi' => 'Pending',
            ]);
        }

        $booking->update(['status_pembayaran' => 'Terverifikasi']);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Tunggu konfirmasi admin.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'kontak_darurat' => 'nullable|string|max:20',
            'foto_profil' => 'nullable|image|max:1024',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->input('name'),
            'no_hp' => $request->input('no_hp'),
            'kontak_darurat' => $request->input('kontak_darurat'),
        ];

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $fileName);
            $data['foto_profil'] = '/uploads/profiles/' . $fileName;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Need to bypass fillable attribute check if needed, but we defined fillable properly!
        $dbUser = User::find($user->id);
        $dbUser->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function storeReview(Request $request, $trip_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'trip_id' => $trip_id,
            'rating' => $request->input('rating'),
            'komentar' => $request->input('komentar'),
            'status_approve' => false, // wait for admin approval
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim dan menunggu verifikasi admin.');
    }
}
