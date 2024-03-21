<?php

namespace App\Http\Controllers;

use App\Models\penjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Imports\DataPenjualanImportClass;
use App\Exports\DataPenjualanExportClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class uploadExcelController extends Controller
{
    public function index()
    {
        $jdl = "Upload Data";

        // $data = penjualan::all();
        $data = null;

        //periksa  peran pengguna  yang sedang login
        if (Auth::user()->role == 'user' || Auth::user()->role == 'admin') {
            // Jika pengguna adalah 'user', ambil hanya data yang sesuai dengan user yang sedang login
            $data = penjualan::where('user_id',Auth::id())->get();
        }
       

        //Mengelompokan data  berdasarkan nomer  Telepon
        $groupData = $data->groupBy('no_telp');

        //Merubah  data  yang sudah  diurutkan dan digroupkan ke dalam  format yang diinginkan
        $finalData = [];

        foreach ($groupData as $no_telp => $items) {
            $total = $items->sum('total');
            $totQty = 0;

            foreach ($items as $item) {
                $totQty += $item->quantity;
            }
            $nama  = $items->first()->nama; //Mengambil Nama dari data pertama dalam  kelompok nomer Telepon

            $finalData[] = [
                'nama' => $nama,
                'no_telp' => $no_telp,
                'quantity' => $totQty,
                'total' => $total
            ];
        }
        //Mengurutkan data berdasarkan total dari nilai terbesar yang terkecil 
        usort($finalData, function ($a, $b) {
            return $b['total'] - $a['total'];
        });

        return view('upload.index', ['data' =>  $data, 'finalData' => $finalData, 'jdl' => $jdl]);
    }

    public  function store_file(Request $request)
    {
        // Memastikan bahwa hanya pengguna yang masuk yang dapat mengakses rute ini
        $this->middleware('auth');

        $this->validate(
            $request,
            [
                'file' => 'required|file|mimes:xlsx,xls'
            ]
        );

        $file = $request->file('file');

        // Mendapatkan nama asli file yang diunggah
        $originName = $file->getClientOriginalName();

        // Validasi agar file dengan nama yang sama tidak bisa diunggah
        if (file_exists(public_path('excel/' . $originName))) {
            return redirect()->back()->with('error', 'File dengan nama  yang sama sudah ada!');
        }

        // Menyimpan file dengan nama yang sama dengan nama asli
        $file->move(public_path('excel'), $originName);

        //Memeriksa  peran pengguna sebelum mengimpor file
        $user = Auth::user();
        if ($user && ($user->role == 'admin' || $user->role == 'user')) {
            $user_id = Auth::id();
            //Memproses File Excel dan  menyimpannya di database
            Excel::import(new DataPenjualanImportClass($user_id), public_path('excel/' . $originName));
            return redirect()->route('dashboard');
        }else{
                // Jika pengguna tidak memiliki izin, beri tahu mereka dengan pesan kesalahan
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengunggah file.');
            }        
        }
    

    public function delete_all()
    {
        $user_id = Auth::id(); 
        // dd($user_id);


        // Menghapus semua data penjualan yang memiliki user_id tertentu
        Penjualan::where('user_id', $user_id)->delete();
        
        // Menghapus semua file dari direktori public/excel/
        $files = glob(public_path('excel/*'));
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file); //Hapus File
        }

        // // Menghapus semua data dari tabel penjualan
        // penjualan::truncate();

        return  redirect()->back()->with('success', 'Data Behasil Di Hapus  Semua');
    }

    public function store_min(Request $request)
    {
        $jdl = "Dasboard";

        $this->validate($request, [
            'nominal' => 'required|numeric'
        ]);

        //Simpan nilai nominal dalam  sesi
        $request->session()->put('nominal', $request->nominal);

        $data = penjualan::all();

        $nominal = $request->nominal;

        //mengelompokan data berdasarkan  nomer telepon
        $groupData = $data->groupBy('no_telp');

        // Merubah data yang sudah diurutkan dan digroupkan ke dalam format yang diinginkan
        $finalData = [];

        foreach ($groupData as $no_telp => $items) {
            $total = $items->sum('total');
            $totQty = 0;

            foreach ($items as $item) {
                $totQty += $item->quantity;
            }

            $nama = $items->first()->nama; // Mengambil Nama dari data pertama dalam kelompok nomer Telepon

            if ($total >= $nominal) {
                $finalData[] = [
                    'nama' => $nama,
                    'no_telp' => $no_telp,
                    'quantity' => $totQty,
                    'total' => $total
                ];
            }
        }

        usort($finalData, function ($a, $b) {
            if (isset($a['total'], $b['total'])) {
                return $b['total'] - $a['total'];
            } else {
                // Handle jika kunci 'total' tidak ada pada salah satu elemen
                return 0; // Atau atur sesuai dengan logika aplikasi Anda
            }
        });

        //SCRIPTMENGHITUNG KEMUNCULAN DATA  BERDASARKAN NAMA  PRODUK
        // Hitung  total kemunculan setiap produk
        $produkCount = $data->groupBy('produk')->map->count();

        //Menentukan nama-nama produk yang sudah ditentukan secara statis dalam HTML
        $namaProduk = [
            'Zymuno',
            'Generos',
            'Freshmage',
            'Etawalin',
            'Etawaku',
        ];

            //Gabungkan data kemunculan produk dengan nama produk yang telah ditentukan
            $combineData = [];
             foreach( $namaProduk as  $np){
                $combineData[$np] = $produkCount->get($np,0);
             }
 
        // dd($finalData);
        return view('upload.index', ['jdl' => $jdl, 'finalData' => $finalData, 'data' => $data, 'combineData' => $combineData]);
    }

    public function store_export(Request $request)
    {
        //Ambil nominal dari sesi
        $nominal =  $request->session()->get('nominal');

        //Objek export dengan   parameter nominal
        $export = new DataPenjualanExportClass($nominal);

        $fileType = 'xlsx';

        // //Export data ke file excel dan  simpan di storage
        $file = 'penjualan_nominal_' . $nominal . '.' . $fileType;

        // //Kembalikan tautan untuk mengunduh file excel
        return Excel::download($export, $file);
    }
}

// return redirect()->route('/index')->with(['finalData' => $finalData]);
// return redirect()->back()->with(['jdl'=> $jdl,'finalData' => $finalData,'data' => $data]);
