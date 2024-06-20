<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // validate the request
        $request->validate([
            'tanggal_awal' => 'date',
            'tanggal_akhir' => 'date',
        ]);


        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $reports = Transaction::select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('SUM(total_harga) as total_harga_harian'), DB::raw('SUM(laba) as total_laba_harian'))->whereBetween('tanggal', [$request->input('tanggal_awal'), $request->input('tanggal_akhir')])->groupBy(DB::raw('DATE(tanggal)'))->orderBy('tanggal')->get();
            return view('dashboard.report.index', compact('reports'));
        }

        $reports = Transaction::select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('SUM(total_harga) as total_harga_harian'), DB::raw('SUM(laba) as total_laba_harian'))->groupBy(DB::raw('DATE(tanggal)'))->orderBy('tanggal')->get();
        return view('dashboard.report.index', compact('reports'));
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
        //
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
        //
    }
    public function exportPDF(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Ambil data laporan dari database berdasarkan rentang tanggal
        $reports = Transaction::select(
            DB::raw('DATE(tanggal) as tanggal'),
            DB::raw('SUM(total_harga) as total_harga_harian'),
            DB::raw('SUM(laba) as total_laba_harian')
        )
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy('tanggal')
            ->get();

        // Mengkonversi data menjadi array untuk diteruskan ke tampilan Blade
        $data = [
            'reports' => $reports,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ];

        // Logika untuk menghasilkan file PDF
        $pdf = PDF::loadView('dashboard.report.pdf', $data);

        // Mengirimkan file PDF ke browser dengan nama file yang mencantumkan rentang tanggal
        $fileName = 'laporan_' . $request->tanggal_awal . '_' . $request->tanggal_akhir . '.pdf';
        return $pdf->stream($fileName);
    }
}
