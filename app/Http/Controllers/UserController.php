<?php

namespace App\Http\Controllers;

use App\Models\penjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Imports\DataPenjualanImportClass;
use App\Exports\DataPenjualanExportClass;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class userController extends Controller
{
    public function index()
    {
        $jdl = "List Profil";
        return view('user.index', ['jdl' => $jdl]);
    }
    public function edit()
    {
        $jdl = "List Profil";
        return view('user.edit', ['jdl' => $jdl]);
    }
}
