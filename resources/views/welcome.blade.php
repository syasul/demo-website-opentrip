@extends('layouts.layout')

@section('title', 'Puncak & Bara | Open Trip Pendakian Gunung Profesional')

@section('content')
    <div id="welcome-root" data-props="{{ json_encode([
        'trips' => $trips,
        'reviews' => $reviews,
        'articles' => $articles,
        'auth' => [
            'check' => Auth::check(),
            'user' => Auth::user(),
        ],
        'routes' => [
            'explore' => route('explore'),
            'register' => route('register'),
            'login' => route('login'),
        ]
    ]) }}"></div>
@endsection
