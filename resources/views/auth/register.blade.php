@extends('layouts.guest')

@section('title', 'Register')

@section('content')
  <h2>Create an account</h2>
  <span class="muted">Register as a property owner or a client</span>

  @if ($errors->any())
    <div class="alert" style="margin-top:20px">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('register') }}" style="margin-top:20px">
    @csrf
    <label>I am a</label>
    <select name="role">
      <option value="owner" @selected(old('role') === 'owner')>Property Owner</option>
      <option value="client" @selected(old('role') === 'client')>Client</option>
    </select>
    <label>Full Name</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="e.g. 7771234" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" required>
    <button class="btn" style="width:100%;justify-content:center">Register</button>
  </form>

  <p class="muted" style="text-align:center;font-size:13px">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
@endsection
