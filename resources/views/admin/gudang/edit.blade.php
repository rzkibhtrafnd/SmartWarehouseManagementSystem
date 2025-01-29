@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Gudang</h2>

        <form action="{{ route('admin.gudang.update', $gudang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $gudang->nama) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-gray-700 font-semibold mb-1">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $gudang->lokasi) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="kapasitas" class="block text-gray-700 font-semibold mb-1">Kapasitas</label>
                <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $gudang->kapasitas) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-semibold mb-1">Status</label>
                <select id="status" name="status" required class="w-full border rounded-lg px-4 py-2">
                    <option value="aktif" {{ old('status', $gudang->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak aktif" {{ old('status', $gudang->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                <a href="{{ route('admin.gudang.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
