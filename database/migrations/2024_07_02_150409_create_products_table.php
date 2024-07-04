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
        Schema::create('products', function (Blueprint $table) {
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
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};