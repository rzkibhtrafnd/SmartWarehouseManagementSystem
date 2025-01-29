<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Produk;  // Tambahkan import Produk
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gudangs = Gudang::paginate(10);

        foreach ($gudangs as $gudang) {
            $totalStokDiGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');
            $gudang->kapasitas -= $totalStokDiGudang;
        }

        return view('admin.gudang.index', compact('gudangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Gudang::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.gudang.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gudang $gudang)
    {
        return view('admin.gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $totalStokDiGudang = Produk::where('gudang_id', $gudang->id)->sum('stok');
        $gudang->kapasitas -= $totalStokDiGudang;

        $gudang->update([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.gudang.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return redirect()->route('admin.gudang.index')->with('success', 'Gudang berhasil dihapus.');
    }
}
