<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Gudang;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produks = produk::with(['kategori','gudang'])->paginate(10);
        $kategoris = Kategori::all();

        // Ambil produk sesuai dengan pencarian dan filter kategori
        $produks = Produk::with(['kategori', 'gudang'])
        ->when($request->search, function($query) use ($request) {
            return $query->where('nama', 'like', '%' . $request->search . '%');
        })
        ->when($request->kategori_id, function($query) use ($request) {
            return $query->where('kategori_id', $request->kategori_id);
        })
        ->paginate(10);

        return view('admin.produk.index', compact('produks','kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gudangs = Gudang::all();
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('gudangs', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

        Produk::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'gudang_id' => $request->gudang_id,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $gudangs = Gudang::all();
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk','gudangs', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        $produk->update($request->all());

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
