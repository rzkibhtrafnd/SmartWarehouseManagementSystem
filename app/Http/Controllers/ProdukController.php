<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::with(['kategori', 'gudang'])
            ->when($request->search, function ($query) use ($request) {
                return $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->kategori_id, function ($query) use ($request) {
                return $query->where('kategori_id', $request->kategori_id);
            })
            ->paginate(10);

        $kategoris = Kategori::all();

        $view = Auth::user()->role === 'admingudang' ? 'admingudang.produk.index' : 'admin.produk.index';
        return view($view, compact('produks', 'kategoris'));
    }

    public function create()
    {
        $gudangs = Gudang::all();
        $kategoris = Kategori::all();
        $view = Auth::user()->role === 'admingudang' ? 'admingudang.produk.create' : 'admin.produk.create';

        return view($view, compact('gudangs', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'gudang_id' => 'required|exists:gudang,id',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $gudang = Gudang::findOrFail($request->gudang_id);
        $totalStokDiGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');

        if (($totalStokDiGudang + $request->stok) > $gudang->kapasitas) {
            return redirect()->back()->with('error', 'Kapasitas gudang tidak cukup.');
        }

        Produk::create($request->all());

        $gudang->kapasitas -= $request->stok;
        $gudang->save();

        $route = Auth::user()->role === 'admingudang' ? 'admingudang.produk.index' : 'admin.produk.index';
        return redirect()->route($route)->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $gudangs = Gudang::all();
        $kategoris = Kategori::all();
        $view = Auth::user()->role === 'admingudang' ? 'admingudang.produk.edit' : 'admin.produk.edit';

        return view($view, compact('produk', 'gudangs', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'gudang_id' => 'required|exists:gudang,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $oldGudang = Gudang::findOrFail($produk->gudang_id);
        $newGudang = Gudang::findOrFail($request->gudang_id);

        if ($request->stok < $produk->stok) {
            $oldGudang->kapasitas += ($produk->stok - $request->stok);
        }

        $totalStokDiGudang = Produk::where('gudang_id', $request->gudang_id)->sum('stok');
        if (($totalStokDiGudang + $request->stok) > $newGudang->kapasitas) {
            return redirect()->back()->with('error', 'Kapasitas gudang tidak cukup.');
        }

        $newGudang->kapasitas -= $request->stok;
        $oldGudang->save();
        $newGudang->save();

        $produk->update($request->all());

        $route = Auth::user()->role === 'admingudang' ? 'admingudang.produk.index' : 'admin.produk.index';
        return redirect()->route($route)->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        $route = Auth::user()->role === 'admingudang' ? 'admingudang.produk.index' : 'admin.produk.index';
        return redirect()->route($route)->with('success', 'Produk berhasil dihapus.');
    }
}
