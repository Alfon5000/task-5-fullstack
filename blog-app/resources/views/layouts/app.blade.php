<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ env('APP_NAME') }} | @yield('title')</title>
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none;
    }
  </style>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
  <div class="container-fluid-full">
    @include('layouts.navbar')
    <main class="p-3 mt-5">
      @yield('content')
    </main>
  </div>
  <script>
    document.addEventListener('trix-file-accept', function(event) {
      event.preventDefault();
    });
  </script>
</body>

</html>
