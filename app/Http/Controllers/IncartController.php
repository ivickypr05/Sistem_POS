<?php

namespace App\Http\Controllers;

use App\Models\Incart;
use App\Models\Product;
use Illuminate\Http\Request;

class IncartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        $incarts = Incart::with('product')->get();
        return view('dashboard.inproduct.add', compact('products', 'incarts'));
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
        // Cari incart berdasarkan product_id
        $existingIncart = Incart::where('product_id', $request->product_id)->first();

        // Jika produk sudah ada dalam incart, beri pesan kesalahan
        if ($existingIncart) {
            return redirect()->route('incart.index')->with('error', 'Tidak Bisa Menambah Produk Yang Sama');
        }

        // Jika produk belum ada dalam incart, tambahkan produk ke incart
        $incart = new Incart();
        $incart->jumlah = 1;
        $incart->product_id = $request->product_id;
        $incart->save();

        return redirect()->route('incart.index')->with('toast_success', 'Produk Berhasil Ditambahkan');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $incart = Incart::findOrFail($id);
        $incart->delete();

        return redirect()->route('incart.index')->with('toast_success', 'Produk Berhasil Dihapus');
    }
}
