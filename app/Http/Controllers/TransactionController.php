<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $transactions = Transaction::where('user_id', $user_id)->get();
        return view('dashboard.transaction.index', compact('user', 'transactions'));
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
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        // dd($carts);
        $jumlah_bayar = $request->input('jumlah_bayar');
        // dd($carts);

        // if (!empty($carts)) {
        //     return redirect()->back()->with('error', 'Produk dalam keranjang tidak ditemukan');
        // }
        $total_harga = 0;

        foreach ($carts as $cart) {
            $total_harga += $cart->product->harga_jual * $cart->jumlah;
        }
        // dd($total_harga);

        if ($jumlah_bayar >= $total_harga) {
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_nomor' => 'Invoice - ' . rand(1000, 9999),
                'total_harga' => $total_harga,
                'jumlah_bayar' => $jumlah_bayar
            ]);

            foreach ($carts as $cart) {
                Transaction_detail::create([
                    'transaction_id' => $transaction->id,
                    'kode_produk' => $cart->product->kode_produk,
                    'nama' => $cart->product->nama,
                    'harga_beli' => $cart->product->harga_beli,
                    'harga_jual' => $cart->product->harga_jual,
                    'jumlah' => $cart->jumlah,
                    'subtotal' => $cart->product->harga_jual * $cart->jumlah,
                ]);
                // Menghapus entri cart
                $cart->delete();
            }

            return redirect()->route('transaction.show', $transaction->id)->with('success', 'Pembayaran Berhasil');
        } else {
            return redirect()->back()->with('error', 'Uang Pembayaran tidak Mencukupi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        // dd($transaction);
        $transaction_detail = Transaction_detail::where('transaction_id', $id)->get();
        // dd($detail_transaction);
        return view('dashboard.transaction.detail', compact('transaction', 'transaction_detail'));
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
        //
    }
}
