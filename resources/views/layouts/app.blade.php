{{-- Layout for logged-in pages: sidebar + top bar. Pages fill in @section('content'). --}}
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

@php
  $user = auth()->user();
@endphp

<div class="app">

  <!-- ================= SIDEBAR ================= -->
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="logo">H4</div>
      <div><b>Housing_4_Raajje</b><small>Property Management</small></div>
    </div>
    <nav class="menu">
      {{-- Each role only sees its own menu --}}
      @if ($user->role === 'owner')
        <div class="group">Owner</div>
        <a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'active' : '' }}"><svg><use href="#i-grid"/></svg>Owner Dashboard</a>
        <a href="{{ route('owner.apartments.create') }}" class="{{ request()->routeIs('owner.apartments.create') ? 'active' : '' }}"><svg><use href="#i-plus"/></svg>Register Apartment</a>
      @endif

      @if ($user->role === 'client')
        <div class="group">Client</div>
        <a href="{{ route('client.search') }}" class="{{ request()->routeIs('client.search') ? 'active' : '' }}"><svg><use href="#i-search"/></svg>Find Apartments</a>
      @endif

      @if ($user->isStaff())
        <div class="group">Staff</div>
        <a href="{{ route('staff.dashboard') }}" class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}"><svg><use href="#i-check"/></svg>Staff Dashboard</a>
      @endif

      @if ($user->role === 'admin')
        <div class="group">Admin</div>
        <a href="{{ route('admin.staff') }}" class="{{ request()->routeIs('admin.staff') ? 'active' : '' }}"><svg><use href="#i-users"/></svg>Staff Accounts</a>
      @endif
    </nav>
    <div class="user">
      <div class="avatar">{{ $user->initials() }}</div>
      <div style="flex:1;min-width:0"><b style="font-size:13px">{{ $user->name }}</b><div class="muted" style="font-size:12px">{{ $user->roleLabel() }}</div></div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="link-btn" title="Log out"><svg><use href="#i-out"/></svg></button>
      </form>
    </div>
  </aside>
  <div class="overlay" id="overlay"></div>

  <!-- ================= CONTENT ================= -->
  <div class="content">
    <div class="topbar">
      <button class="icon-btn" id="menuBtn"><svg><use href="#i-menu"/></svg></button>
      <h1>@yield('title')</h1>
      <button class="icon-btn"><svg><use href="#i-bell"/></svg></button>
    </div>

    <main>
      @yield('content')
    </main>
  </div>
</div>

<script>
  // Open and close the sidebar on small screens
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  document.getElementById('menuBtn').onclick = () => { sidebar.classList.add('open'); overlay.classList.add('show'); };
  overlay.onclick = () => { sidebar.classList.remove('open'); overlay.classList.remove('show'); };
</script>
</body>
</html>
