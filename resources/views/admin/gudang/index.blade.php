@extends('layouts.adminapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Data Gudang</h2>
            <a href="{{ route('admin.gudang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                <i class="fas fa-plus"></i> Tambah Gudang
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Kapasitas</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gudangs as $gudang)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-t">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-t">{{ $gudang->nama }}</td>
                            <td class="px-4 py-2 border-t">{{ $gudang->lokasi }}</td>
                            <td class="px-4 py-2 border-t">{{ $gudang->kapasitas }}</td>
                            <td class="px-4 py-2 border-t">
                                <span class="{{ $gudang->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-sm px-2 py-1 rounded">
                                    {{ ucfirst($gudang->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border-t flex space-x-2">
                                <a href="{{ route('admin.gudang.edit', $gudang->id) }}" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.gudang.destroy', $gudang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gudang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-2 border-t">Tidak ada data gudang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Manual -->
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-4">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="{{ $gudangs->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="{{ $gudangs->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $gudangs->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $gudangs->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $gudangs->total() }}</span>
                    results
                </p>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <a href="{{ $gudangs->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Previous</span>
                            &laquo;
                        </a>
                        @for ($i = 1; $i <= $gudangs->lastPage(); $i++)
                            <a href="{{ $gudangs->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ ($gudangs->currentPage() == $i) ? 'bg-indigo-600 text-white' : 'text-gray-900 ring-1 ring-gray-300 hover:bg-gray-50' }} focus:z-20 focus:outline-offset-0">{{ $i }}</a>
                        @endfor
                        <a href="{{ $gudangs->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Next</span>
                            &raquo;
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
