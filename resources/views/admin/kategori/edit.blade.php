@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Kategori</h2>

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $kategori->deskripsi) }}" required class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                <a href="{{ route('admin.kategori.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
