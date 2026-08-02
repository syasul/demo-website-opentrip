@extends('layouts.layout')

@section('title', 'Altimeter Logs | Sanford Nature Collective')

@section('content')
    <div id="blog-root" data-props="{{ json_encode([
        'articlesData' => $articles
    ]) }}"></div>
@endsection
