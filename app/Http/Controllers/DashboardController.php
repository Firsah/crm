<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jdl = "Dashboard";

        // // Mengambil semua data penjualan
        //$penjualan = Penjualan::all();

        $penjualanZymuno = null; 

         //periksa peran pengguna  yang sedang login
            if(Auth::user()->role == 'user' || Auth::user()->role == 'admin'){
                $penjualan = penjualan::where('user_id',Auth::id())->get();
                $penjualanEtawalin = penjualan::where('user_id',Auth::id())->where('produk', 'Etawalin')->get();
                $penjualanZymuno = penjualan::where('user_id',Auth::id())->where('produk','zymuno')->get();
                $penjualanGeneros = Penjualan::where('user_id',Auth::id())->where('produk','Generos')->get();
                $penjualanFreshmage = Penjualan::where('user_id',Auth::id())->where('produk', 'Freshmage')->get();
            }

            // Mengelompokkan data penjualan berdasarkan nomor telepon
            $leaderboard = $penjualan->groupBy('no_telp')->map(function ($group) {
            // Mengelompokkan pembelian berdasarkan produk
            $grouped_purchases = $group->groupBy('produk')->map(function ($purchases) {
                return [
                    'produk' => $purchases->first()->produk,
                    'quantity' => $purchases->sum('quantity'),
                    'total' => $purchases->sum('total'),
                ];
            });

            return [
                'nama' => $group->first()->nama,
                'no_telp' => $group->first()->no_telp,
                'pembelian' => $grouped_purchases,
                'total_pembelian' => $group->sum('total'),
                'jumlah_quantity' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);


        //----leaderboardEtawalin----
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardEtawalin = $penjualanEtawalin->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_quantity' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);


        //----leaderboardZymuno----
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardZymuno = $penjualanZymuno->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        
        //----leaderboarGeneros----
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardGeneros = $penjualanGeneros->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

       
        //----leaderboarFreshmag----
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardFreshmage = $penjualanFreshmage->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        return view('dashboard.index', compact('jdl', 'leaderboard', 'leaderboardEtawalin', 'leaderboardZymuno', 'leaderboardGeneros', 'leaderboardFreshmage'));
    }
}
