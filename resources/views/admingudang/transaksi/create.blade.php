@extends('layouts.admingudangapp')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Transaksi</h2>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admingudang.transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="produk_id" class="block text-gray-700 font-semibold mb-1">Produk</label>
                <select name="produk_id" id="produk_id" class="w-full border rounded-lg px-4 py-2">
                    <option value="">Pilih Produk</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                    @endforeach
                </select>
                @error('produk_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="kuantitas" class="block text-gray-700 font-semibold mb-1">Kuantitas</label>
                <input type="number" name="kuantitas" id="kuantitas" class="w-full border rounded-lg px-4 py-2" value="{{ old('kuantitas') }}">
                @error('kuantitas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="tipe" class="block text-gray-700 font-semibold mb-1">Tipe Transaksi</label>
                <select name="tipe" id="tipe" class="w-full border rounded-lg px-4 py-2">
                    <option value="masuk">Masuk</option>
                    <option value="keluar">Keluar</option>
                </select>
                @error('tipe') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4" id="gudang-field">
                <label for="gudang_id" class="block text-gray-700 font-semibold mb-1">Gudang</label>
                <select name="gudang_id" id="gudang_id" class="w-full border rounded-lg px-4 py-2">
                    <option value="">Pilih Gudang</option>
                    @foreach ($gudangs as $gudang)
                        <option value="{{ $gudang->id }}" {{ old('gudang_id') == $gudang->id ? 'selected' : '' }}>{{ $gudang->nama }}</option>
                    @endforeach
                </select>
                @error('gudang_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan</button>
                <a href="{{ route('admingudang.transaksi.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeSelect = document.getElementById('tipe');
        const gudangField = document.getElementById('gudang-field');
    
        function toggleGudangField() {
            if (tipeSelect.value === 'masuk') {
                gudangField.style.display = 'block';
            } else {
                gudangField.style.display = 'none';
                document.getElementById('gudang_id').value = '';
            }
        }
    
        tipeSelect.addEventListener('change', toggleGudangField);
        toggleGudangField();
    });
</script>