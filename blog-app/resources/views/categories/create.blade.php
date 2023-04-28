@extends('layouts.app')

@section('title', 'Create Category')

@section('categories-active', 'active')

@section('content')
  <div class="container">
    <h2>@yield('title')</h2>
    <form action="/categories" method="post">
      @csrf
      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
          placeholder="Category's name..." name="name" value="{{ old('name') }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-success">Create</button>
      </div>
    </form>
  </div>
@endsection
