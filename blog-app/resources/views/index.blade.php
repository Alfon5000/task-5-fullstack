@extends('layouts.app')

@section('title', 'Home')

@section('home-active', 'active')

@section('content')
  <div class="container">
    <h1 class="text-center mb-3">{{ env('APP_NAME') }}</h1>

    @if (session()->has('login'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('login') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="" method="get">
      <div class="input-group mb-4 w-75 mx-auto">
        <input type="text" class="form-control" placeholder="Search posts..." name="search"
          value="{{ request('search') }}">
        <button class="btn btn-primary">Search</button>
      </div>
    </form>

    @if ($count > 0)
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($posts as $post)
          <div class="col">
            <div class="card h-100">
              <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{!! Str::limit($post->content, 85) !!}</p>
                <a href="/blogs/{{ $post->id }}" class="btn btn-primary">Read more</a>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="my-3">
        {{ $posts->links() }}
      </div>
    @else
      <div class="alert alert-danger" role="alert">
        Blogs are empty.
      </div>
    @endif
  </div>
@endsection
