<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inproduct;
use App\Models\Inproduct_detail;
use Illuminate\Http\Request;


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
        $details = Inproduct_detail::with('product')->get();
        $nama_toko = $request->input('nama_toko');
        $total_item = 0;
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
