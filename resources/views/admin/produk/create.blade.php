@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Produk</h2>
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.produk.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                    <input type="text" id="nama" name="nama" required class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                    <select class="w-full border rounded-lg px-4 py-2" id="kategori_id" name="kategori_id" required>
                        <option value="" selected disabled>Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="gudang_id" class="block text-gray-700 font-semibold mb-1">Gudang</label>
                    <select class="w-full border rounded-lg px-4 py-2" id="gudang_id" name="gudang_id" required>
                        <option value="" selected disabled>Pilih Gudang</option>
                        @foreach ($gudangs as $gudang)
                            <option value="{{ $gudang->id }}">{{ $gudang->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="stok" class="block text-gray-700 font-semibold mb-1">Stok</label>
                    <input type="number" class="w-full border rounded-lg px-4 py-2" id="stok" name="stok" required>
                </div>

                <div class="mb-4">
                    <label for="harga" class="block text-gray-700 font-semibold mb-1">Harga</label>
                    <input type="number" class="w-full border rounded-lg px-4 py-2" id="harga" name="harga" required>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea class="w-full border rounded-lg px-4 py-2" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                    <a href="{{ route('admin.produk.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
