@extends('layouts.managerapp')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-6">
            Welcome to the Admin Dashboard
        </h2>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h5 class="text-base sm:text-lg font-semibold mb-2">Total Gudang Aktif</h5>
                <p class="text-2xl sm:text-3xl font-bold">{{ $totalGudangAktif }}</p>
            </div>

            <div class="bg-green-500 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h5 class="text-base sm:text-lg font-semibold mb-2">Total Kategori</h5>
                <p class="text-2xl sm:text-3xl font-bold">{{ $totalKategori }}</p>
            </div>

            <div class="bg-yellow-500 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h5 class="text-base sm:text-lg font-semibold mb-2">Total Produk</h5>
                <p class="text-2xl sm:text-3xl font-bold">{{ $totalProduk }}</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Stok Tertinggi & Terendah -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">10 Stok Tertinggi & Terendah</h3>
                <canvas id="stokChart"></canvas>
            </div>

            <!-- Kapasitas Gudang -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">5 Gudang Kapasitas Tertinggi & Terendah</h3>
                <canvas id="gudangChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk chart Stok Produk
    var stokLabels = {!! json_encode($stokTertinggi->pluck('nama')->merge($stokTerendah->pluck('nama'))) !!};
    var stokData = {!! json_encode($stokTertinggi->pluck('stok')->merge($stokTerendah->pluck('stok'))) !!};

    var ctx1 = document.getElementById('stokChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: stokLabels,
            datasets: [{
                label: 'Jumlah Stok',
                data: stokData,
                backgroundColor: stokLabels.map((_, i) => i < 10 ? 'rgba(54, 162, 235, 0.7)' : 'rgba(255, 99, 132, 0.7)'),
                borderColor: stokLabels.map((_, i) => i < 10 ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)'),
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true, 
            scales: { y: { beginAtZero: true } } 
        }
    });

    // Data untuk chart Kapasitas Gudang
    var gudangLabels = {!! json_encode($kapasitasTertinggi->pluck('nama')->merge($kapasitasTerendah->pluck('nama'))) !!};
    var gudangData = {!! json_encode($kapasitasTertinggi->pluck('kapasitas')->merge($kapasitasTerendah->pluck('kapasitas'))) !!};

    var ctx2 = document.getElementById('gudangChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: gudangLabels,
            datasets: [{
                label: 'Total Kapasitas',
                data: gudangData,
                backgroundColor: gudangLabels.map((_, i) => i < 5 ? 'rgba(75, 192, 192, 0.7)' : 'rgba(255, 159, 64, 0.7)'),
                borderColor: gudangLabels.map((_, i) => i < 5 ? 'rgba(75, 192, 192, 1)' : 'rgba(255, 159, 64, 1)'),
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true, 
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
