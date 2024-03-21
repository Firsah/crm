<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->user('user_id');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('alamat');
            $table->string('produk');
            $table->string('no_telp',15);
            $table->integer('quantity');
            $table->decimal('harga',10,2);
            $table->decimal('total',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};


//Keterangan 
/*
    a). 10: Parameter kedua menunjukkan panjang total dari nilai numerik dalam kolom. Dalam hal ini, panjang totalnya adalah 10 digit. Ini berarti kolom akan mampu 
        menampung angka dengan panjang maksimum 10 digit, termasuk bagian desimal (jika ada).

    b). 2: Parameter ketiga menunjukkan jumlah digit setelah titik desimal. Dalam hal ini, ada 2 digit setelah titik desimal. Ini menentukan presisi dari angka
        desimal yang dapat disimpan dalam kolom tersebut.
*/

