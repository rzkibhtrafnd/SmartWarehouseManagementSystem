@extends('layouts.adminapp')

@section('title', 'Dashboard')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Welcome Banner -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 shadow-lg">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->name }}</h1>
                    <p class="text-blue-100">Analisis kinerja gudang terkini</p>
                </div>
                <div class="flex space-x-4">
                    <div class="bg-white/10 p-4 rounded-lg text-center">
                        <p class="text-sm text-blue-50">Total Gudang</p>
                        <p class="text-2xl font-bold text-white">{{ $totalGudangAktif }}</p>
                    </div>
                    <div class="bg-white/10 p-4 rounded-lg text-center">
                        <p class="text-sm text-blue-50">Total Produk</p>
                        <p class="text-2xl font-bold text-white">{{ $totalProduk }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Gudang Card -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-warehouse text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Gudang Aktif</h3>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalGudangAktif }}</p>
                    <p class="text-sm text-gray-500 mt-2">Update terakhir: Hari ini</p>
                </div>
                <div class="text-green-500">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Kategori Card -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-tags text-purple-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Total Kategori</h3>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalKategori }}</p>
                    <p class="text-sm text-gray-500 mt-2">+5% dari bulan lalu</p>
                </div>
                <div class="text-purple-500">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Produk Card -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-orange-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-boxes text-orange-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Total Produk</h3>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalProduk }}</p>
                    <p class="text-sm text-gray-500 mt-2">Stok tersedia</p>
                </div>
                <div class="text-orange-500">
                    <i class="fas fa-chart-bar text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Stok Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Distribusi Stok Produk</h3>
                <div class="flex space-x-2">
                    <button class="text-sm px-3 py-1 rounded-lg bg-blue-50 text-blue-600">30 Hari</button>
                    <button class="text-sm px-3 py-1 rounded-lg hover:bg-gray-50">1 Tahun</button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="stokChart"></canvas>
            </div>
        </div>

        <!-- Kapasitas Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Utilisasi Kapasitas Gudang</h3>
                <div class="text-gray-500">
                    <i class="fas fa-info-circle"></i>
                </div>
            </div>
            <div class="h-80">
                <canvas id="gudangChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
    // Stok Chart
    const stokChart = new Chart(document.getElementById('stokChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($stokTertinggi->pluck('nama')->merge($stokTerendah->pluck('nama'))) !!},
            datasets: [{
                label: 'Stok Produk',
                data: {!! json_encode($stokTertinggi->pluck('stok')->merge($stokTerendah->pluck('stok'))) !!},
                backgroundColor: [
                    'rgba(79, 70, 229, 0.7)',
                    'rgba(99, 102, 241, 0.7)',
                    'rgba(129, 140, 248, 0.7)',
                    'rgba(165, 180, 252, 0.7)',
                    'rgba(199, 210, 254, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(248, 113, 113, 0.7)',
                    'rgba(252, 165, 165, 0.7)',
                    'rgba(254, 202, 202, 0.7)',
                    'rgba(255, 228, 230, 0.7)'
                ],
                borderColor: [
                    'rgba(79, 70, 229, 1)',
                    'rgba(99, 102, 241, 1)',
                    'rgba(129, 140, 248, 1)',
                    'rgba(165, 180, 252, 1)',
                    'rgba(199, 210, 254, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(248, 113, 113, 1)',
                    'rgba(252, 165, 165, 1)',
                    'rgba(254, 202, 202, 1)',
                    'rgba(255, 228, 230, 1)'
                ],
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleFont: { size: 14 },
                    bodyFont: { size: 14 },
                    padding: 12
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#E5E7EB' },
                    ticks: { color: '#6B7280' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#6B7280' }
                }
            }
        }
    });

    // Kapasitas Chart
    const gudangChart = new Chart(document.getElementById('gudangChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($kapasitasTertinggi->pluck('nama')->merge($kapasitasTerendah->pluck('nama'))) !!},
            datasets: [{
                label: 'Kapasitas',
                data: {!! json_encode($kapasitasTertinggi->pluck('kapasitas')->merge($kapasitasTerendah->pluck('kapasitas'))) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleFont: { size: 14 },
                    bodyFont: { size: 14 },
                    padding: 12
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#E5E7EB' },
                    ticks: { color: '#6B7280' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#6B7280' }
                }
            }
        }
    });
</script>

@endsection
