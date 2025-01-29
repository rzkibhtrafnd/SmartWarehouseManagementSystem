<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Gudang;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('admingudang.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        $gudangs = Gudang::all();
        return view('admingudang.transaksi.create', compact('produks', 'gudangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'kuantitas' => 'required|integer|min:1',
            'tipe' => 'required|in:masuk,keluar',
            'gudang_id' => 'required|exists:gudang,id',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $gudang = Gudang::findOrFail($request->gudang_id);
        $stokGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');

        // Handle stock overflow
        if ($request->tipe == 'masuk') {
            if (($stokGudang + $request->kuantitas) > $gudang->kapasitas) {
                return redirect()->back()->with('error', 'Kapasitas gudang tidak cukup.');
            }
            $produk->stok += $request->kuantitas;
        } else { // For keluar
            if ($produk->stok < $request->kuantitas) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $produk->stok -= $request->kuantitas;
        }

        // Store the transaction
        Transaksi::create([
            'produk_id' => $request->produk_id,
            'kuantitas' => $request->kuantitas,
            'tipe' => $request->tipe,
            'gudang_id' => $request->gudang_id,
            'user_id' => auth()->id(),
        ]);

        // Save updated stock
        $produk->save();

        return redirect()->route('admingudang.transaksi.index')->with('success', 'Transaksi berhasil dilakukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $produks = Produk::all();
        $gudangs = Gudang::all();
        return view('admingudang.transaksi.edit', compact('transaksi', 'produks', 'gudangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'kuantitas' => 'required|integer|min:1',
            'tipe' => 'required|in:masuk,keluar',
            'gudang_id' => 'required|exists:gudang,id',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $gudang = Gudang::findOrFail($request->gudang_id);
        $stokGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');

        if ($request->tipe == 'masuk') {
            if (($stokGudang + $request->kuantitas) > $gudang->kapasitas) {
                return redirect()->back()->with('error', 'Kapasitas gudang tidak cukup.');
            }
            $produk->stok += $request->kuantitas;
        } else { // For keluar
            if ($produk->stok < $request->kuantitas) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $produk->stok -= $request->kuantitas;
        }

        // Update the transaction
        $transaksi->update([
            'produk_id' => $request->produk_id,
            'kuantitas' => $request->kuantitas,
            'tipe' => $request->tipe,
            'gudang_id' => $request->gudang_id,
            'user_id' => auth()->id(),
        ]);

        // Save updated stock
        $produk->save();

        return redirect()->route('admingudang.transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $produk = Produk::find($transaksi->produk_id);

        if ($transaksi->tipe == 'masuk') {
            $produk->stok -= $transaksi->kuantitas;
        } else {
            $produk->stok += $transaksi->kuantitas;
        }

        // Save the updated stock after deletion
        $produk->save();
        $transaksi->delete();

        return redirect()->route('admingudang.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function downloadPDF(Request $request)
    {
        $transaksis = Transaksi::with(['produk', 'gudang', 'user'])->get();
        $pdf = PDF::loadView('admingudang.transaksi.downloadPDF', compact('transaksis'));
        return $pdf->download('transaksi.pdf');
    }
}
