<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Sky Chill Coffee')</title>
  <script src="{{ asset('js/style.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  @yield('css')
</head>
<body data-page="@yield('page', 'public')">

@include('user.partials.header')

@yield('content')

@include('user.partials.auth-modal')
@include('user.partials.cart')
@include('user.partials.footer')

@if(session('showLogin') && !request()->routeIs('user.*'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        openAuth();
    });
</script>
@endif
<script>
window.IS_LOGGED_IN = {{ auth()->check() ? 'true' : 'false' }};
</script>
</body>
</html>
