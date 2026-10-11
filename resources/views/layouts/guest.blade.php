{{-- Layout for the login and register pages (no sidebar). --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') – Housing_4_Raajje</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.icons')

<main>
  <div class="login-wrap">
    <div class="login-art">
      <h2>Find your next home in Raajje.</h2>
      <p>Verified apartments across Malé, Hulhumalé and Villingili, managed by our team at three branches.</p>
    </div>
    <div class="login-form">
      @yield('content')
    </div>
  </div>
</main>

</body>
</html>
