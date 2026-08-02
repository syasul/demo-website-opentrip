@extends('layouts.layout')

@section('title', 'Expedition Journals | Sanford Archive')

@section('content')
    <div id="explore-root" data-props="{{ json_encode([
        'tripsData' => $trips,
        'searchParams' => [
            'search' => request('search'),
            'difficulty' => request('difficulty'),
            'max_price' => request('max_price')
        ]
    ]) }}"></div>
@endsection
