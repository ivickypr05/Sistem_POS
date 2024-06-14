<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $products = Product::with('category')->get();
        $carts = Cart::with('product')->where('user_id', $user_id)->get();
        $total_harga = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->where('user_id', $user_id)
            ->sum(DB::raw('carts.jumlah * products.harga_jual'));
        return view('dashboard.transaction.sale', compact('user', 'products', 'carts', 'total_harga'));
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
        $user = Auth::user();
        $product = Product::find($request->product_id);

        // Cari cart berdasarkan product_id
        $existingCart = Cart::where('product_id', $request->product_id)->first();

        // Jika produk sudah ada dalam Cart, beri pesan kesalahan
        if ($existingCart) {
            return redirect()->route('cart.index')->with('error', 'Tidak Bisa Menambah Produk Yang Sama');
        }

        // Pastikan stok tersedia
        if ($product->stok <= 0) {
            return redirect()->route('cart.index')->with('error', 'Stok Produk Tidak Tersedia.');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Tambahkan produk ke keranjang
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->jumlah = 1;
            $cart->save();

            // Kurangi stok produk
            $product->stok--;
            $product->save();

            // Commit transaksi database
            DB::commit();

            return redirect()->route('cart.index')->with('toast_success', 'Produk Berhasil Ditambah');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Produk');
        }
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
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);

        if ($request->jumlah - 1 > $product->stok) {
            return redirect()->back()->with('error', 'Maaf, stok tidak mencukupi');
        }

        $data = $request->validate(['jumlah' => 'required|min:1|max:' . $product->stok]);
        $oldJumlah = $cart->jumlah; // Mendapatkan jumlah sebelumnya
        $cart->update($data);
        $difference = $request->jumlah - $oldJumlah; // Menghitung selisih

        if ($difference > 0) {
            $product->decrement('stok', $difference); // Mengurangi stok jika selisih positif
        } elseif ($difference < 0) {
            $product->increment('stok', abs($difference)); // Menambahkan stok jika selisih negatif
        }
        return redirect()->route('cart.index')->with('toast_success', 'Jumlah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
        $product->increment('stok', $cart->jumlah);
        $cart->delete();

        return redirect()->route('cart.index')->with('toast_success', 'Produk Berhasil Dihapus');
    }
}
