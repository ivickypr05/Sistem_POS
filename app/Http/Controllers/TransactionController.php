<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Mail\StockMinus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $date = Carbon::now()->subDays(30); // Menghitung tanggal 30 hari yang lalu
        $transactions = Transaction::where('user_id', $user_id)
            ->where('updated_at', '>=', $date) // Mengambil transaksi dalam 30 hari terakhir
            ->orderBy('updated_at', 'desc')
            ->get();
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
        $laba = 0;
        foreach ($carts as $cart) {
            $total_harga += $cart->product->harga_jual * $cart->jumlah;
            $laba += ($cart->product->harga_jual - $cart->product->harga_beli) * $cart->jumlah;
        }
        // dd($total_harga);

        if ($jumlah_bayar >= $total_harga) {
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'invoice_nomor' => 'Invoice - ' . rand(1000, 9999),
                'total_harga' => $total_harga,
                'jumlah_bayar' => $jumlah_bayar,
                'laba' => $laba,
                'tanggal' => date('Y-m-d')
            ]);

            $produk_minus = [];

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
                if ($cart->product->stok < 6) {
                    $produk_minus[] = $cart->product_id;
                    // dd($produk_minus);
                }
                // Menghapus entri cart
                $cart->delete();
            }
            $data_products = Product::select('kode_produk', 'nama', 'stok')->whereIn('id', $produk_minus)->get();
            $data = [];
            foreach ($data_products as $product) {
                $data[] = [
                    'kode_produk' => $product->kode_produk,
                    'nama' => $product->nama,
                    'stok' => $product->stok
                ];
            }
            // dd($data_products[]);
            // exit;
            if ($produk_minus > 0) {
                // send mail
                Mail::to('vickypratama0649@gmail.com')->send(new StockMinus($data));
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

    public function smallPDF(string $id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $transaction_detail = Transaction_detail::where('transaction_id', $id)->get();

        $pdf = Pdf::loadView('dashboard.transaction.smallpdf', compact('transaction', 'transaction_detail'))
            ->setPaper([0, 0, 163.071, 326.142], 'portrait'); // Mengatur ukuran kertas menjadi 58mm dalam satuan titik (1 inch = 72 points)

        return $pdf->stream();
    }

    public function bigPDF(string $id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $transaction_detail = Transaction_detail::where('transaction_id', $id)->get();

        $pdf = Pdf::loadView('dashboard.transaction.bigpdf', compact('transaction', 'transaction_detail'))
            ->setPaper([0, 0, 595.276, 841.890], 'portrait'); // A4 size in points (1 inch = 72 points)

        return $pdf->stream();
    }

    public function transactionall()
    {
        $transactions = Transaction::orderBy('updated_at', 'desc')->get();
        return view('dashboard.transaction.all', compact('transactions'));
    }
}
