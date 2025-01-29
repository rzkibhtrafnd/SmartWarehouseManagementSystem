<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Gudang;
use Illuminate\Http\Request;

class ProdukGudangController extends Controller
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
            ->paginate(20);

        $kategoris = Kategori::all();

        return view('admingudang.produk.index', compact('produks', 'kategoris'));
    }
}
