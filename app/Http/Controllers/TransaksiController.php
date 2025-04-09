<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Gudang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['produk', 'gudang', 'user']);

        // Filter tanggal
        if ($request->filled(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        // Filter tambahan untuk manager (mingguan/bulanan)
        if (auth()->user()->role === 'manager' && $request->has('filter')) {
            $filter = $request->input('filter');
            if ($filter === 'weekly') {
                $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($filter === 'monthly') {
                $query->whereBetween('tanggal', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
            }
        }

        $query->orderBy('updated_at', 'desc');
        $transaksis = $query->paginate(30);

        $view = auth()->user()->role === 'manager'
            ? 'manager.transaksi.index'
            : 'admingudang.transaksi.index';

        return view($view, compact('transaksis'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admingudang') {
            abort(403);
        }

        $produks = Produk::all();
        $gudangs = Gudang::all();
        return view('admingudang.transaksi.create', compact('produks', 'gudangs'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admingudang') {
            abort(403);
        }

        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'kuantitas' => 'required|integer|min:1',
            'tipe' => 'required|in:masuk,keluar',
            'gudang_id' => 'required|exists:gudang,id',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $gudang = Gudang::findOrFail($request->gudang_id);
        $stokGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');

        if ($request->tipe === 'masuk') {
            if (($stokGudang + $request->kuantitas) > $gudang->kapasitas) {
                return back()->with('error', 'Kapasitas gudang tidak cukup.');
            }
            $produk->stok += $request->kuantitas;
        } else {
            if ($produk->stok < $request->kuantitas) {
                return back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $produk->stok -= $request->kuantitas;
        }

        Transaksi::create([
            'produk_id' => $request->produk_id,
            'kuantitas' => $request->kuantitas,
            'tipe' => $request->tipe,
            'gudang_id' => $request->gudang_id,
            'user_id' => auth()->id(),
        ]);

        $produk->save();

        return redirect()->route('admingudang.transaksi.index')->with('success', 'Transaksi berhasil dilakukan.');
    }

    public function edit(Transaksi $transaksi)
    {
        if (auth()->user()->role !== 'admingudang') {
            abort(403);
        }

        $produks = Produk::all();
        $gudangs = Gudang::all();
        return view('admingudang.transaksi.edit', compact('transaksi', 'produks', 'gudangs'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        if (auth()->user()->role !== 'admingudang') {
            abort(403);
        }

        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'kuantitas' => 'required|integer|min:1',
            'tipe' => 'required|in:masuk,keluar',
            'gudang_id' => 'required|exists:gudang,id',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $gudang = Gudang::findOrFail($request->gudang_id);
        $stokGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');

        if ($request->tipe === 'masuk') {
            if (($stokGudang + $request->kuantitas) > $gudang->kapasitas) {
                return back()->with('error', 'Kapasitas gudang tidak cukup.');
            }
            $produk->stok += $request->kuantitas;
        } else {
            if ($produk->stok < $request->kuantitas) {
                return back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $produk->stok -= $request->kuantitas;
        }

        $transaksi->update([
            'produk_id' => $request->produk_id,
            'kuantitas' => $request->kuantitas,
            'tipe' => $request->tipe,
            'gudang_id' => $request->gudang_id,
            'user_id' => auth()->id(),
        ]);

        $produk->save();

        return redirect()->route('admingudang.transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        if (auth()->user()->role !== 'admingudang') {
            abort(403);
        }

        $produk = Produk::find($transaksi->produk_id);

        if ($transaksi->tipe === 'masuk') {
            $produk->stok -= $transaksi->kuantitas;
        } else {
            $produk->stok += $transaksi->kuantitas;
        }

        $produk->save();
        $transaksi->delete();

        return redirect()->route('admingudang.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function generatePDF(Request $request)
    {
        $query = Transaksi::with(['produk', 'gudang', 'user']);

        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('tanggal', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $transaksis = $query->get();
        $totalMasuk = $transaksis->where('tipe', 'masuk')->sum('kuantitas');
        $totalKeluar = $transaksis->where('tipe', 'keluar')->sum('kuantitas');
        $totalTransaksi = $transaksis->count();

        $view = auth()->user()->role === 'manager'
            ? 'manager.transaksi.downloadPDF'
            : 'admingudang.transaksi.pdf';

        $pdf = Pdf::loadView($view, [
            'transaksis' => $transaksis,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'totalTransaksi' => $totalTransaksi,
            'startDate' => $request->start_date ?? '-',
            'endDate' => $request->end_date ?? '-',
        ]);

        return $pdf->download('laporan-transaksi.pdf');
    }
}
