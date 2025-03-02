@extends('layouts.app')

@section('content')
    <h1>Comentario</h1>
    <p>{{ $comment->comment }}</p>
    <small>Publicado el {{ $comment->publish_date->format('d/m/Y H:i') }}</small>
@endsection
