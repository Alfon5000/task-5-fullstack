@extends('layouts.app')

@section('title', 'Post\'s Detail')

@section('home-active', 'active')

@section('content')
  <div class="container">
    <h2 class="my-2">{{ $post->title }}</h2>
    <small>Written by. {{ $post->user->name }} | Category - {{ $post->category->name }} | Last updated
      {{ $post->updated_at->diffForHumans() }}</small>
    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid my-3 w-75">
    <p class="my-3">{!! $post->content !!}</p>
    <a href="/" class="btn btn-danger">Back</a>
  </div>
@endsection
