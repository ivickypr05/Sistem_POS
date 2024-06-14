<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // validate the request
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        // Check if there is a start and end date request, then display data based on the request
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $reports = Transaction::select(DB::raw('DATE(tanggal) as tanggal'),DB::raw('SUM(total_harga) as total_harga_harian'),DB::raw('SUM(laba) as total_laba_harian'))->whereBetween('tanggal', [$request->input('tanggal_awal'), $request->input('tanggal_akhir')])->groupBy(DB::raw('DATE(tanggal)'))->orderBy('tanggal')->get();
            return view('dashboard.report.index', compact('reports'));
        }

        $reports = Transaction::select(DB::raw('DATE(tanggal) as tanggal'),DB::raw('SUM(total_harga) as total_harga_harian'),DB::raw('SUM(laba) as total_laba_harian'))->groupBy(DB::raw('DATE(tanggal)'))->orderBy('tanggal')->get();
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
}
