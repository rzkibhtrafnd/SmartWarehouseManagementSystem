@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit User</h2>

        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-semibold mb-1">Role</label>
                <select id="role" name="role" required class="w-full border rounded-lg px-4 py-2">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="admingudang" {{ old('role', $user->role) == 'admingudang' ? 'selected' : '' }}>Admin Gudang</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.user.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
