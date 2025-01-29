@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Produk</h2>
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $produk->nama) }}" required class="w-full border rounded-lg px-4 py-2 @error('nama') border-red-500 @enderror">
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                <select id="kategori_id" name="kategori_id" required class="w-full border rounded-lg px-4 py-2 @error('kategori_id') border-red-500 @enderror">
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $produk->kategori_id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gudang_id" class="block text-gray-700 font-semibold mb-1">Gudang</label>
                <select id="gudang_id" name="gudang_id" required class="w-full border rounded-lg px-4 py-2 @error('gudang_id') border-red-500 @enderror">
                    @foreach ($gudangs as $gudang)
                        <option value="{{ $gudang->id }}" {{ $gudang->id == $produk->gudang_id ? 'selected' : '' }}>
                            {{ $gudang->nama }}
                        </option>
                    @endforeach
                </select>
                @error('gudang_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="stok" class="block text-gray-700 font-semibold mb-1">Stok</label>
                <input type="number" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" required class="w-full border rounded-lg px-4 py-2 @error('stok') border-red-500 @enderror">
                @error('stok')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-gray-700 font-semibold mb-1">Harga</label>
                <input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" required class="w-full border rounded-lg px-4 py-2 @error('harga') border-red-500 @enderror">
                @error('harga')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full border rounded-lg px-4 py-2 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                <a href="{{ route('admin.produk.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
