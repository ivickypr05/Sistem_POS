<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
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
        $data = $request->validate(
            [
                'name' => 'required|string|min:2|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|max:15',
                'role' => 'in:kasir'
            ]
        );
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('user.index')->with('toast_success', 'User Berhasil Ditambah');
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
        $data = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:pemilik,kasir'
        ]);

        $data['role'] = $request->role;
        $user = User::findOrFail($id);
        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;
        user::where('id', $id)->update($data);
        return redirect()->route('user.index')->with('toast_success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('toast_success', 'User berhasil dihapus');
    }
}
