<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = Category::count();
        $product = Product::with('category')->count();
        $user = User::count();

        // Mendapatkan tanggal 7 hari yang lalu
        $tujuhHariLalu = Carbon::now()->subDays(7);

        // Query menggunakan Eloquent
        $jumlahTransaksiPerHari = DB::table('transactions')
            ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('sum(total_harga) as sum_harga'),DB::raw('sum(laba) as keuntungan'))
            ->where('tanggal', '>=', $tujuhHariLalu)
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy(DB::raw('DATE(tanggal)'))
            ->limit(25)
            ->get();

        // jadikan 2 aray penjualan dan tanggal
        $penjualan = $jumlahTransaksiPerHari->pluck('sum_harga')->toArray();
        $keuntungan = $jumlahTransaksiPerHari->pluck('keuntungan')->toArray();
        $tanggal = $jumlahTransaksiPerHari->pluck('tanggal')->toArray();
        // dd($tanggal);

        return view('dashboard.home', compact('category', 'product', 'user','penjualan','tanggal','keuntungan'));
    }
}
