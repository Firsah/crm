<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan';
    protected $fillable = ['tanggal','nama','alamat','produk','no_telp','quantity','harga','total','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
