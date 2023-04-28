@extends('layouts.app')

@section('title', 'Categories')

@section('categories-active', 'active')

@section('content')
  <div class="container">
    <h2>@yield('title')</h2>

    @if (session()->has('created'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('created') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @elseif(session()->has('updated'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('updated') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @elseif(session()->has('deleted'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('deleted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <a href="/categories/create" class="btn btn-primary mb-3">Create</a>

    @if ($count > 0)
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr class="text-center">
              <th scope="row">{{ $loop->iteration }}</th>
              <td scope="row">{{ $category->name }}</td>
              <td scope="row">
                <a href="categories/{{ $category->id }}/edit" class="btn btn-warning">Edit</a>
                <form action="categories/{{ $category->id }}" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $categories->links() }}
    @else
      <div class="alert alert-danger" role="alert">
        Categories are empty.
      </div>
    @endif
  </div>
@endsection
