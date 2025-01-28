@extends('layouts.adminapp')

@section('content')
<div class="container-fluid mt-5">
    <div class="card shadow-lg p-4 rounded-lg">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-dark">Data Produk</h2>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-success rounded-pill">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        <!-- Form Pencarian dan Filter -->
        <form action="{{ route('admin.produk.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari Produk" value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="kategori_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Tabel Produk -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Gudang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                        <tr>
                            <td>{{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->kategori->nama ?? '-' }}</td>
                            <td>{{ $produk->gudang->nama ?? '-' }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ number_format($produk->harga, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm rounded-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $produks->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $produks->previousPageUrl() }}" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                </li>

                @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $produks->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ $produks->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $produks->nextPageUrl() }}" aria-label="Next">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
