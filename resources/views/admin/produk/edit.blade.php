@extends('layouts.adminapp')

@section('content')
<div class="container-fluid mt-5">
    <div class="card shadow-lg p-4 rounded-lg">
        <h2 class="text-dark">Edit Produk</h2>

        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $produk->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $produk->kategori_id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="gudang_id">Gudang</label>
                <select class="form-control" id="gudang_id" name="gudang_id" required>
                    @foreach ($gudangs as $gudang)
                        <option value="{{ $gudang->id }}" {{ $gudang->id == $produk->gudang_id ? 'selected' : '' }}>
                            {{ $gudang->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
        </form>

        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
