<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\penjualan;

class DataPenjualanExportClass implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $nominal;

    public function __construct($nominal)
    {
        $this->nominal =  $nominal;
    }

    public function headings():array{
        return [
            'Nama',
            'No Telp',
            'Quantity',
            'Total'
        ];
    }

    public function collection()
    {
        $data = penjualan::all();

        //mengelompokan data berdasarkan  nomer telepon
        $groupData = $data->groupBy('no_telp');

        // Merubah data yang sudah diurutkan dan digroupkan ke dalam format yang diinginkan
        $finalData = [];

        foreach( $groupData as $no_telp => $items){
            $total = $items->sum('total');
            $totQty = 0; 

            foreach($items as $item){
                $totQty += $item->quantity;
            }

            $nama = $items ->first()->nama; // Mengambil Nama dari data pertama dalam kelompok nomer Telepon

            if($total >= $this->nominal ){
                $finalData[] = [
                    'nama' => $nama,
                    'no_telp' => $no_telp,
                    'quantity' => $totQty,
                    'total' => $total
                ];
            }
        }

        usort($finalData, function($a, $b) {
            if (isset($a['total'], $b['total'])) {
                return $b['total'] - $a['total'];
            } 
            else {
                // Handle jika kunci 'total' tidak ada pada salah satu elemen
                return 0; // Atau atur sesuai dengan logika aplikasi Anda
            }
        });
        
        // dd($finalData);
        return collect($finalData);
    }
}
