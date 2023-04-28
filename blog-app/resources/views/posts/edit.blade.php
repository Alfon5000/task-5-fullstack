@extends('layouts.app')

@section('title', 'Edit Post')

@section('posts-active', 'active')

@section('content')
  <div class="container">
    <h2>@yield('title')</h2>
    <form action="/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
          placeholder="Post's title..." name="title" value="{{ $post->title }}">
        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <input id="content" type="hidden" name="content">
        <trix-editor input="content">{!! $post->content !!}</trix-editor>
        @error('content')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control @error('title') is-invalid @enderror">
        @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select @error('title') is-invalid @enderror" id="category" name="category_id">
          <option selected value="{{ $post->category->id }}">{{ $post->category->name }}</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        @error('category_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
  </div>
@endsection
