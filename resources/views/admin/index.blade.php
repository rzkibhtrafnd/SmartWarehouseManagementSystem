@extends('layouts.adminapp')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Welcome to the Admin Dashboard</h2>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Users Card -->
            <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h5 class="text-lg font-semibold mb-2">Total Users</h5>
                <p class="text-3xl font-bold">100</p>
            </div>

            <!-- Active Admins Card -->
            <div class="bg-green-500 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h5 class="text-lg font-semibold mb-2">Active Admins</h5>
                <p class="text-3xl font-bold">5</p>
            </div>

            <!-- Pending Tasks Card -->
            <div class="bg-yellow-500 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h5 class="text-lg font-semibold mb-2">Pending Tasks</h5>
                <p class="text-3xl font-bold">2</p>
            </div>
        </div>

        <!-- You can add more dashboard components here -->
    </div>
@endsection
