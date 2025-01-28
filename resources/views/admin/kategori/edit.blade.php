@extends('layouts.adminapp')

@section('content')
<div class="container-fluid mt-5">
    <div class="card shadow-lg p-4 rounded-lg">
        <h2 class="text-dark">Edit Kategori</h2>

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $kategori->deskripsi) }}" required>
            </div>

            <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
        </form>

        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
