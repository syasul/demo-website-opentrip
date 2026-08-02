@extends('layouts.layout')

@section('title', $article->judul . ' | Altimeter Log | Sanford')

@section('content')
    <div id="blog-detail-root" data-props="{{ json_encode([
        'article' => $article,
        'otherArticles' => $otherArticles
    ]) }}"></div>
@endsection
