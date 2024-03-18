<?php

namespace App\Imports;

use App\Models\penjualan;
use DateTime;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;

class DataPenjualanImportClass implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $total = $row['quantity'] * $row['harga'];

        $tanggalExcel  = $row['tanggal'];

        // Inisialisasi variabel untuk komponen tanggal
        $tahun = $bulan = $hari = null;
    
        // Ekstrak komponen jika pola cocok
        if (preg_match('/DATE\((\d+),(\d+),(\d+)\)/', $tanggalExcel, $matches)) {
            $tahun = $matches[1];
            $bulan = $matches[2];
            $hari = $matches[3];

    
        $tanggal = DateTime::createFromFormat('Y-m-d', "$tahun-$bulan-$hari"); 
        
        return new penjualan([
            'tanggal' =>  $tanggal->format('Y-m-d'),
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'produk' => $row['produk'],
            'no_telp' => $row['no_telp'],
            'quantity' => $row['quantity'],
            'harga' => $row['harga'],
            'total' => $total
        ]);

        //dd($row);
    } 
}

}


