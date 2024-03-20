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

        $penjualanFreshmag = Penjualan::where('produk', 'Freshmag')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardFreshmag = $penjualanFreshmag->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanBio = Penjualan::where('produk', 'Bio Insuleaf')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardBio = $penjualanBio->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanGizidat = Penjualan::where('produk', 'Gizidat')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardGizidat = $penjualanGizidat->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanNutriflakes = Penjualan::where('produk', 'Nutriflakes')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardNutriflakes = $penjualanNutriflakes->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanEtawaku = Penjualan::where('produk', 'Etawaku Platinum')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardEtawaku = $penjualanEtawaku->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanFreshvision = Penjualan::where('produk', 'Fresh Vision')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardFreshvision = $penjualanFreshvision->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        $penjualanWeightherba = Penjualan::where('produk', 'Weight Herba')->get();
        // Menghitung total pembelian dan jumlah transaksi untuk setiap nama
        $leaderboardWeightherba = $penjualanWeightherba->groupBy('no_telp')->map(function ($group) {
            return [
                'nama' => $group->first()->nama, // Ambil nama dari salah satu transaksi
                'no_telp' => $group->first()->no_telp, // Ambil nomor telepon dari salah satu transaksi
                'total_pembelian' => $group->sum('total'),
                'jumlah_transaksi' => $group->sum('quantity'),
            ];
        })->sortByDesc('total_pembelian')->take(10);

        //SCRIPTMENGHITUNG KEMUNCULAN DATA  BERDASARKAN NAMA  PRODUK
        // Hitung  total kemunculan setiap produk
        $produkCount = $penjualan->groupBy('produk')->map->count();

        //Menentukan nama-nama produk yang sudah ditentukan secara statis dalam HTML
        $namaProduk = [
            'Zymuno',
            'Generos',
            'Freshmag',
            'Etawalin',
            'Etawaku Platinum',
            'Bio Insuleaf',
            'Gizidat',
            'Nutriflakes',
            'Fresh Vision',
            'Weight Herba',
        ];

        //Gabungkan data kemunculan produk dengan nama produk yang telah ditentukan
        $combineData = [];
        foreach ($namaProduk as  $np) {
            $combineData[$np] = $produkCount->get($np, 0);
        }

        return view('dashboard.index', compact('jdl', 'combineData', 'leaderboard', 'leaderboardEtawalin', 'leaderboardZymuno', 'leaderboardGeneros', 'leaderboardFreshmag', 'leaderboardBio', 'leaderboardGizidat', 'leaderboardNutriflakes', 'leaderboardEtawaku', 'leaderboardFreshvision', 'leaderboardWeightherba'));
    }
}
