<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::paginate(5);
        return view('produk.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Produk::create([
            'nama' => $request->name,
            'harga' => $request->price,
            'deskripsi' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama' => $request->name,
            'harga' => $request->price,
            'deskripsi' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
