@extends('layouts.app')

@section('content')
    <div class="container">
        <p>id: {{ $article->getId() }}</p>
        <p>title: {{ $article->getTitle() }}</p>
        <p>announcement: {{ $article->getAnnouncement() }}</p>
        <p>body: {{ $article->getBody() }}</p>
        <p>pubDate: {{ $article->getPubDate() }}</p>
        <p>tags: {{ $article->getTags() }}</p>
    </div>
@endsection
