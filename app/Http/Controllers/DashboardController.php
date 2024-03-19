<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jdl = "Dashboard";

        // Mengambil semua data penjualan
        $penjualan = Penjualan::all();

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

        $penjualanEtawalin = Penjualan::where('produk', 'Etawalin')->get();

        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardEtawalin = $penjualanEtawalin->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_quantity' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanZymuno = Penjualan::where('produk', 'Zymuno')->get();

        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardZymuno = $penjualanZymuno->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanGeneros = Penjualan::where('produk', 'Generos')->get();

        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardGeneros = $penjualanGeneros->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanFreshmage = Penjualan::where('produk', 'Freshmage')->get();

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
