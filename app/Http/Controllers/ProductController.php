<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $products = Product::with('Category')->orderBy('updated_at', 'desc')->get();
        return view('dashboard.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_produk' => 'required|string|min:2|max:10',
            'nama' => 'required|string|min:2|max:50',
            'stok' => 'required|integer',
            'harga_beli' => 'required|integer|min:3',
            'harga_jual' => 'required|integer|min:3',
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        Product::create($validatedData);
        return redirect()->route('product.index')->with('toast_success', 'Produk Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'kode_produk' => 'required|string|min:2|max:10',
            'nama' => 'required|string|min:2|max:50',
            'stok' => 'required|integer',
            'harga_beli' => 'required|integer|min:3',
            'harga_jual' => 'required|integer|min:3',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $product = Product::find($id);
        $product->update($validatedData);

        return redirect()->route('product.index')->with('toast_success', 'Produk Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('toast_success', 'Produk Berhasil Dihapus');
    }
}
