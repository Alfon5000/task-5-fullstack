@extends('layouts.app')

@section('title', 'Register')

@section('content')
  <div class="container w-25">
    <h1 class="text-center mb-3">@yield('title')</h1>

    <form action="/register" method="post">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
          placeholder="Enter name..." value="{{ old('name') }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

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

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password Confirmation</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
          placeholder="Reenter password..." value="{{ old('password_confirmation') }}">
      </div>

      <div class="mb-3 d-grid">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>

      <div class="mb-3 text-center">
        <p>Already registered? <a href="/login">Login</a></p>
      </div>
    </form>
  </div>
@endsection
