<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class userController extends Controller
{
    public function index(){
        $data = User::all();
        return view('user.v_user',['data' => $data]);
    }

    public function store_user(Request $request){
        $this->validate($request,[
            'name' =>  'required',
            'role' =>  'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        //Jika validasi berhasil, lanjutkan dengan menyimpan data pengguna
        $user = new User();
        $user->name = $request->name;
        $user->role =  $request->role;
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->save();

        return redirect()->back()->with('success','Tambah User berhasil');
    }
}
