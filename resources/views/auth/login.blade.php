@extends('layouts.guest')

@section('title', 'Login')

@section('content')
  <h2>Welcome back</h2>
  <span class="muted">Sign in to continue</span>

  <div class="roles" id="roles">
    <div class="on"><svg><use href="#i-home"/></svg>Owner</div>
    <div><svg><use href="#i-user"/></svg>Client</div>
    <div><svg><use href="#i-users"/></svg>Staff</div>
  </div>

  @if ($errors->any())
    <div class="alert">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <label>Email or Phone</label>
    <input type="text" name="login" value="{{ old('login') }}" placeholder="e.g. 7771234" required autofocus>
    <label>Password</label>
    <input type="password" name="password" placeholder="••••••••" required>
    <div style="display:flex;justify-content:space-between;font-size:13px;margin:-4px 0 18px">
      <label style="font-weight:normal;display:flex;gap:6px;align-items:center;margin:0"><input type="checkbox" name="remember" style="width:auto;margin:0"> Remember me</label>
    </div>
    <button class="btn" style="width:100%;justify-content:center">Sign In</button>
  </form>

  <p class="muted" style="text-align:center;font-size:13px">Don't have an account? <a href="{{ route('register') }}">Register</a><br>
    <small>Staff accounts are created by the System Administrator.</small></p>

  <script>
    // Highlight the clicked role tab
    document.querySelectorAll('#roles div').forEach(r => r.onclick = () => {
      document.querySelectorAll('#roles div').forEach(x => x.classList.remove('on'));
      r.classList.add('on');
    });
  </script>
@endsection
