<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class authController extends Controller
{
    public function login(){
        return  view('auth.v_login');
    }
}
