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
    public function index(Request $request)
    {
        $category = Category::count();
        $product = Product::with('category')->count();
        $user = User::count();

        $request->validate([
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date',
        ]);

        // Periksa apakah tanggal awal dan tanggal akhir ada dalam request
        if ($request->has(['tanggal_awal', 'tanggal_akhir'])) {
            $tanggal_awal = Carbon::parse($request->input('tanggal_awal'))->startOfDay();
            $tanggal_akhir = Carbon::parse($request->input('tanggal_akhir'))->endOfDay();
        } else {
            // Jika tidak, set tanggal_awal ke awal bulan dan tanggal_akhir ke hari ini
            $tanggal_awal = Carbon::now()->startOfMonth();
            $tanggal_akhir = Carbon::now()->endOfDay();
        }

        // Query menggunakan Eloquent
        $jumlahTransaksiPerHari = DB::table('transactions')
            ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('sum(total_harga) as sum_harga'), DB::raw('sum(laba) as laba'))
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy(DB::raw('DATE(tanggal)'))
            ->limit(25)
            ->get();

        // Ekstrak data untuk grafik
        $penjualan = $jumlahTransaksiPerHari->pluck('sum_harga')->toArray();
        $laba = $jumlahTransaksiPerHari->pluck('laba')->toArray();
        $tanggal = $jumlahTransaksiPerHari->pluck('tanggal')->map(function ($date) {
            return Carbon::parse($date)->isoFormat('D MMMM YYYY');
        })->toArray();

        return view('dashboard.home', compact('category', 'product', 'user', 'penjualan', 'tanggal', 'laba'));
    }
}
