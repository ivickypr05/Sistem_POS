<?php

namespace App\Http\Controllers;

use App\Models\Incart;
use App\Models\Product;
use App\Models\Inproduct;
use Illuminate\Http\Request;
use App\Models\Inproduct_detail;


class InproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inproducts = Inproduct::orderBy('updated_at', 'desc')->get();
        return view('dashboard.inproduct.index', compact('inproducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil semua item dari keranjang dengan produk terkait
        $incart = Incart::with('product')->get();

        // Inisialisasi total_item
        $total_item = 0;

        // Buat entri baru di tabel inproduct
        $inproduct = Inproduct::create([
            'nama_toko' => $request->nama_toko,
            'total_item' => $total_item, // Ini akan di-update nanti
        ]);

        // Hitung total item di keranjang berdasarkan input formulir
        foreach ($incart as $item) {
            $jumlah = $request->input('jumlah.' . $item->id);
            if ($jumlah === null) {
                return back()->withErrors(['jumlah' => 'Jumlah tidak boleh null.']);
            }
            $total_item += $jumlah;
        }

        // Update total_item di inproduct
        $inproduct->update(['total_item' => $total_item]);

        foreach ($incart as $item) {
            $jumlah = $request->input('jumlah.' . $item->id);
            if ($jumlah === null) {
                continue; // Abaikan item dengan jumlah null
            }

            // Buat entri baru di tabel inproduct_detail
            Inproduct_detail::create([
                'inproduct_id' => $inproduct->id,
                'kode_produk' => $item->product->kode_produk,
                'nama' => $item->product->nama,
                'jumlah' => $jumlah
            ]);

            // Dapatkan produk yang terkait dan update stoknya
            $product = Product::where('id', $item->product_id)->first();
            if ($product) {
                $product->update([
                    'stok' => $product->stok + $jumlah
                ]);
            }

            // Hapus item dari keranjang
            $item->delete();
        }

        return redirect()->route('inproduct.index')->with('success', 'Produk Masuk Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inproduct = Inproduct::findOrFail($id);
        $inproduct_detail = Inproduct_detail::where('inproduct_id', $id)->get();
        return view('dashboard.inproduct.detail', compact('inproduct', 'inproduct_detail'));
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
        // Temukan entri Inproduct berdasarkan ID
        $inproduct = Inproduct::findOrFail($id);

        // Ambil semua entri Inproduct_detail yang terkait dengan Inproduct ini
        $inproduct_details = Inproduct_detail::where('inproduct_id', $id)->get();

        // Loop melalui setiap entri Inproduct_detail untuk mengupdate stok produk
        foreach ($inproduct_details as $detail) {
            // Temukan produk terkait menggunakan kode produk
            $product = Product::where('kode_produk', $detail->kode_produk)->first();
            if ($product) {
                // Kurangi stok produk sesuai jumlah di entri Inproduct_detail
                $product->update([
                    'stok' => $product->stok - $detail->jumlah
                ]);
            }

            // Hapus entri Inproduct_detail
            $detail->delete();
        }

        // Hapus entri Inproduct
        $inproduct->delete();

        return redirect()->back()->with('success', 'Data Produk Masuk Berhasil Dihapus.');
    }
}
