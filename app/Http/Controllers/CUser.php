<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CUser extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user', compact('users'));
    }


    public function simpan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil ditambahkan');
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->password) {

            $data['password'] =
                Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil diupdate');
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);

        // optional
        if ($user->id == Auth::id()) {

            return back()
                ->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return back()
            ->with('success', 'User berhasil dihapus');
    }
}