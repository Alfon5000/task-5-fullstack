@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <div class="container w-25">
    <h1 class="text-center mb-3">@yield('title')</h1>

    @if (session()->has('register'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('register') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="/login" method="post">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
          placeholder="Enter email..." value="{{ old('email') }}">
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
          placeholder="Enter password..." value="{{ old('password') }}">
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3 d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>

      <div class="mb-3 text-center">
        <p>Not registered yet? <a href="/register">Register</a></p>
      </div>
    </form>
  </div>
@endsection
