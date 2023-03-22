@extends('guest.dashboard.dashboard_master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h3>Welcome, {{Auth::guard('guestlogin')->user()->name}}</h3>
        </div>
    </div>
</div>

@endsection