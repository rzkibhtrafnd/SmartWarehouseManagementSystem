@extends('layouts.adminapp')

@section('content')
<div class="container-fluid mt-5">
    <div class="card shadow-lg p-4 rounded-lg">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-dark">Data Kategori</h2>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-success rounded-pill">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ $kategori->deskripsi }}</td>
                            <td>
                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm rounded-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $kategoris->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $kategoris->previousPageUrl() }}" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                </li>

                @foreach ($kategoris->getUrlRange(1, $kategoris->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $kategoris->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ $kategoris->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $kategoris->nextPageUrl() }}" aria-label="Next">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
