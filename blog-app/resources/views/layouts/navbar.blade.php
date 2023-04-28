  <nav class="navbar navbar-expand-lg bg-primary navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link @yield('posts-active')" href="/posts">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('categories-active')" href="/categories">Categories</a>
            </li>
          @endauth
        </ul>
        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
              </ul>
            </li>
          @else
            <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="/register" class="nav-link">Register</a></li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
