<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function renderDashboard($viewName)
    {
        $totalGudangAktif = Gudang::where('status', 'aktif')->count();
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();

        $stokTertinggi = Produk::orderBy('stok', 'desc')->take(10)->get(['nama', 'stok']);
        $stokTerendah = Produk::orderBy('stok', 'asc')->take(10)->get(['nama', 'stok']);

        $kapasitasTertinggi = Gudang::orderBy('kapasitas', 'desc')->take(5)->get(['nama', 'kapasitas']);
        $kapasitasTerendah = Gudang::orderBy('kapasitas', 'asc')->take(5)->get(['nama', 'kapasitas']);

        return view($viewName, compact(
            'totalGudangAktif',
            'totalKategori',
            'totalProduk',
            'stokTertinggi',
            'stokTerendah',
            'kapasitasTertinggi',
            'kapasitasTerendah'
        ));
    }

    public function adminIndex()
    {
        return $this->renderDashboard('admin.index');
    }

    public function admingudangIndex()
    {
        return $this->renderDashboard('admingudang.index');
    }

    public function managerIndex()
    {
        return $this->renderDashboard('manager.index');
    }
}
