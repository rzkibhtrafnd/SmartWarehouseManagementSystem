@extends('layouts.adminapp')

@section('title', 'Dashboard')

@section('content')
    <h2 class="mb-4">Welcome to the Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">100</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Active Admins</h5>
                    <p class="card-text">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text">2</p>
                </div>
            </div>
        </div>
    </div>

    <!-- You can add more dashboard components here -->
@endsection
