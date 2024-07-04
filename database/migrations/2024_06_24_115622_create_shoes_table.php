<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoesTable extends Migration
{
    public function up()
    {
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();
            $table->string('namamerk');
            $table->string('tipe');
            $table->string('jenis'); // misal: anak, wanita, pria
            $table->string('ukuran');
            $table->integer('harga');
            $table->string('stok')->nullable(0); // tambahkan kolom stok dengan default 0
            $table->string('gambar')->nullable(); // tambahkan kolom gambar nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shoes');
    }
}

