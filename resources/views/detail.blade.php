@extends('layouts.layout')

@section('title', $trip->nama_gunung . ' | Nature Journal | Sanford')

@section('content')
    <div id="detail-root" data-props="{{ json_encode([
        'trip' => $trip,
        'otherTrips' => $otherTrips,
        'approvedReviews' => $approvedReviews,
        'auth' => [
            'check' => Auth::check(),
            'user' => Auth::user(),
        ],
        'routes' => [
            'booking' => route('user.booking.form', $trip->slug)
        ]
    ]) }}"></div>
@endsection
