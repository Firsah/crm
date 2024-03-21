<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class userController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('user.v_user', ['data' => $data]);
    }

    public function store_user(Request $request)
    {
        $this->validate($request, [
            'username' =>  'required',
            'role' =>  'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        //Jika validasi berhasil, lanjutkan dengan menyimpan data pengguna
        $user = new User();
        $user->username = $request->username;
        $user->role =  $request->role;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        return redirect()->back()->with('success', 'Tambah User berhasil');
    }
    public function edit($id)
    {
        $jdl = 'Edit Users';
        $user = User::findOrFail($id);

        return view('user.edit', compact('user', 'jdl'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user', // Pastikan rolenya valid
        ]);

        $user = User::findOrFail($id);
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];

        // Jika password diisi, maka kita hash password baru
        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();

        return redirect()->route('listUser.index')->with('success', 'User updated successfully');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('listUser.index')->with('success', 'User deleted successfully');
    }
    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view('user.detail', compact('user'));
    }
}
