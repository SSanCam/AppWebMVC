<!-- resources/views/comment/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Comentarios del Post: {{ $post->id }}</h1>

    @foreach ($comments as $comment)
        <p>{{ $comment->comment }}</p>
        <small>Publicado el {{ $comment->publish_date }}</small>
    @endforeach
@endsection
