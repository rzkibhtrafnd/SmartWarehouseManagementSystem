<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Adminindex()
    {
        // Total data
        $totalGudangAktif = Gudang::where('status', 'aktif')->count();
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();

        // 10 Stok Tertinggi dan Terendah
        $stokTertinggi = Produk::orderBy('stok', 'desc')->take(10)->get(['nama', 'stok']);
        $stokTerendah = Produk::orderBy('stok', 'asc')->take(10)->get(['nama', 'stok']);

        // 5 Gudang Kapasitas Tertinggi dan Terendah
        $kapasitasTertinggi = Gudang::orderBy('kapasitas', 'desc')->take(5)->get(['nama', 'kapasitas']);
        $kapasitasTerendah = Gudang::orderBy('kapasitas', 'asc')->take(5)->get(['nama', 'kapasitas']);

        return view('admin.index', compact(
            'totalGudangAktif',
            'totalKategori',
            'totalProduk',
            'stokTertinggi',
            'stokTerendah',
            'kapasitasTertinggi',
            'kapasitasTerendah'
        ));
    }

    public function Admingudangindex()
    {
        // Total data
        $totalGudangAktif = Gudang::where('status', 'aktif')->count();
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();

        // 10 Stok Tertinggi dan Terendah
        $stokTertinggi = Produk::orderBy('stok', 'desc')->take(10)->get(['nama', 'stok']);
        $stokTerendah = Produk::orderBy('stok', 'asc')->take(10)->get(['nama', 'stok']);


        // 5 Gudang Kapasitas Tertinggi dan Terendah
        $kapasitasTertinggi = Gudang::orderBy('kapasitas', 'desc')->take(5)->get(['nama', 'kapasitas']);
        $kapasitasTerendah = Gudang::orderBy('kapasitas', 'asc')->take(5)->get(['nama', 'kapasitas']);

        return view('admingudang.index', compact(
            'totalGudangAktif',
            'totalKategori',
            'totalProduk',
            'stokTertinggi',
            'stokTerendah',
            'kapasitasTertinggi',
            'kapasitasTerendah'
        ));
    }

    public function Managerindex()
    {
        // Total data
        $totalGudangAktif = Gudang::where('status', 'aktif')->count();
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();

        // 10 Stok Tertinggi dan Terendah
        $stokTertinggi = Produk::orderBy('stok', 'desc')->take(10)->get(['nama', 'stok']);
        $stokTerendah = Produk::orderBy('stok', 'asc')->take(10)->get(['nama', 'stok']);


        // 5 Gudang Kapasitas Tertinggi dan Terendah
        $kapasitasTertinggi = Gudang::orderBy('kapasitas', 'desc')->take(5)->get(['nama', 'kapasitas']);
        $kapasitasTerendah = Gudang::orderBy('kapasitas', 'asc')->take(5)->get(['nama', 'kapasitas']);

        return view('manager.index', compact(
            'totalGudangAktif',
            'totalKategori',
            'totalProduk',
            'stokTertinggi',
            'stokTerendah',
            'kapasitasTertinggi',
            'kapasitasTerendah'
        ));
    }
}
