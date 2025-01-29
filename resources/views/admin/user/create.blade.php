@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Pegawai</h2>

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" id="name" name="name" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-semibold mb-1">Role</label>
                <select id="role" name="role" required class="w-full border rounded-lg px-4 py-2">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="admingudang">Admin Gudang</option>
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Simpan
                </button>
                <a href="{{ route('admin.user.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
