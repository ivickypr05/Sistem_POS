<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('dashboard.category.index', compact('categories'));
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
        $validatedData = $request->validate([
            'nama' => 'required|min:2|max:50'
        ]);
        Category::create($validatedData);

        return redirect()->route('category.index')->with('toast_success', 'Kategori Berhasil Ditambah');
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
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|min:2|max:50',
        ]);
        $category = Category::find($id);
        $category->update($validatedData);

        return redirect()->route('category.index')->with('toast_success', 'Kategori Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $products = Product::with('category')->where('category_id', $id)->count();
        // if ($products >= 1) {
        //     return redirect()->back()->with('toast_error', 'Maaf kategori tidak bisa dihapus karena masih terhubung dengan beberapa produk');
        // } else {
        Category::destroy($id);
        return redirect()->route('category.index')->with('toast_success', 'Kategori Berhasil Dihapus');
        // }
    }
}
