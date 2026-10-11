@extends('layouts.app')

@section('title', 'Owner Dashboard')

@section('content')
  <div class="card">
    <h3><svg><use href="#i-info"/></svg>Coming next</h3>
    <ul class="muted">
      <li>Stat cards: my apartments, currently rented, total viewings, payout this month</li>
      <li>My apartments table with the Available / Rented / Under Maintenance toggle</li>
      <li>Shortcut to the active lease when an apartment is rented</li>
      <li>Chart of why viewers didn't rent</li>
      <li>Viewing timeline</li>
      <li>Earnings and payout statements</li>
    </ul>
  </div>
@endsection
