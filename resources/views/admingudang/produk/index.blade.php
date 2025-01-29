@extends('layouts.admingudangapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Data Produk</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Pencarian dan Filter -->
        <form action="{{ route('admin.produk.index') }}" method="GET" class="mb-4">
            <div class="flex space-x-4">
                <input type="text" name="search" class="form-control border-gray-300 border rounded-md p-2" placeholder="Cari Produk" value="{{ request('search') }}">
                <select name="kategori_id" class="form-control border-gray-300 border rounded-md p-2">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Cari</button>
                <a href="{{ route('admingudang.produk.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Reset</a>
            </div>
        </form>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto mt-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Gudang</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-t">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-t">{{ $produk->nama }}</td>
                            <td class="px-4 py-2 border-t">{{ $produk->kategori->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border-t">{{ $produk->gudang->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border-t">{{ $produk->stok }}</td>
                            <td class="px-4 py-2 border-t">{{ number_format($produk->harga, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-2 border-t">Tidak ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6 border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="{{ $produks->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="{{ $produks->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $produks->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $produks->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $produks->total() }}</span>
                    results
                </p>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <a href="{{ $produks->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Previous</span>
                            &laquo;
                        </a>
                        @for ($i = 1; $i <= $produks->lastPage(); $i++)
                            <a href="{{ $produks->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ ($produks->currentPage() == $i) ? 'bg-indigo-600 text-white' : 'text-gray-900 ring-1 ring-gray-300 hover:bg-gray-50' }} focus:z-20 focus:outline-offset-0">{{ $i }}</a>
                        @endfor
                        <a href="{{ $produks->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
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
