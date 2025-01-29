<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Gudang;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class TransaksiManagerController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['produk', 'gudang', 'user']);

        // Filter berdasarkan minggu atau bulan
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            if ($filter == 'weekly') {
                $query->where('tanggal', '>=', Carbon::now()->startOfWeek())
                      ->where('tanggal', '<=', Carbon::now()->endOfWeek());
            } elseif ($filter == 'monthly') {
                $query->where('tanggal', '>=', Carbon::now()->startOfMonth())
                      ->where('tanggal', '<=', Carbon::now()->endOfMonth());
            }
        }

        $transaksis = $query->paginate(30);
        return view('manager.transaksi.index', compact('transaksis'));
    }

    public function downloadPDF(Request $request)
    {
        $transaksis = Transaksi::with(['produk', 'gudang', 'user'])->get();
        $pdf = PDF::loadView('manager.transaksi.downloadPDF', compact('transaksis'));
        return $pdf->download('transaksi.pdf');
    }
}
