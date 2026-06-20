<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Article;
use App\Models\Review;

class VisitorController extends Controller
{
    public function index()
    {
        // Fetch active/featured trips
        $trips = Trip::where('status', 'Aktif')->take(3)->get();
        // Fetch approved reviews with users
        $reviews = Review::with('user', 'trip')->where('status_approve', true)->latest()->take(6)->get();
        // Fetch latest articles
        $articles = Article::with('author')->latest()->take(3)->get();

        return view('welcome', compact('trips', 'reviews', 'articles'));
    }

    public function explore(Request $request)
    {
        $query = Trip::query();

        // Search by gunung or location
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_gunung', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by difficulty level
        if ($request->filled('difficulty')) {
            $query->where('level_kesulitan', $request->input('difficulty'));
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        } else {
            $query->whereIn('status', ['Aktif', 'Penuh']);
        }

        // Filter by price
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->input('max_price'));
        }

        $trips = $query->orderBy('tanggal_berangkat', 'asc')->paginate(9);

        return view('explore', compact('trips'));
    }

    public function show($slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();
        $otherTrips = Trip::where('id', '!=', $trip->id)->where('status', 'Aktif')->take(3)->get();
        $approvedReviews = Review::with('user')->where('trip_id', $trip->id)->where('status_approve', true)->latest()->get();

        return view('detail', compact('trip', 'otherTrips', 'approvedReviews'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function blog()
    {
        $articles = Article::with('author')->latest()->paginate(6);
        return view('blog', compact('articles'));
    }

    public function blogDetail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $otherArticles = Article::where('id', '!=', $article->id)->latest()->take(3)->get();
        return view('blog-detail', compact('article', 'otherArticles'));
    }
}
