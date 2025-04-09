@extends('layouts.managerapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Data Transaksi</h2>
        </div>

        <!-- Filter tanggal dan PDF -->
        <form method="GET" action="{{ route('manager.transaksi.index') }}" class="mb-4">
            <div class="flex gap-2 items-center">
                <input type="date" name="start_date" class="px-4 py-2 border rounded" value="{{ request('start_date') }}">
                <span>sampai</span>
                <input type="date" name="end_date" class="px-4 py-2 border rounded" value="{{ request('end_date') }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Filter
                </button>
                <a href="{{ route('manager.transaksi.downloadPDF', request()->query()) }}"
                   class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                    Unduh PDF
                </a>
            </div>
        </form>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Kuantitas</th>
                        <th class="px-4 py-2">Gudang</th>
                        <th class="px-4 py-2">Admin</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-t">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-t">{{ $transaksi->produk->nama }}</td>
                            <td class="px-4 py-2 border-t">{{ $transaksi->kuantitas }}</td>
                            <td class="px-4 py-2 border-t">{{ $transaksi->gudang->nama }}</td>
                            <td class="px-4 py-2 border-t">{{ $transaksi->user->name }}</td>
                            <td class="px-4 py-2 border-t">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-2 border-t">
                                <span class="{{ $transaksi->tipe == 'masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-sm px-2 py-1 rounded">
                                    {{ ucfirst($transaksi->tipe) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center px-4 py-2 border-t">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $transaksis->links() }}
    </div>
</div>
@endsection
