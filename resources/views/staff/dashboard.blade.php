@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
  <div class="card">
    <h3><svg><use href="#i-info"/></svg>Coming next</h3>
    <ul class="muted">
      <li>Stat cards: pending verifications, branch listings, active leases, viewings today</li>
      <li>Verification queue for new apartments and clients (approve / reject)</li>
      <li>Everything limited to the staff member's own branch</li>
      <li>Matchmaker: clients whose budget and location fit a new listing</li>
      <li>Log a viewing with feedback and comments</li>
      <li>Create a lease: rent, deposit, payment method, start date, duration, signatures</li>
    </ul>
  </div>
@endsection
