<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'namamerk', 'tipe', 'jenis', 'ukuran', 'harga', 'stok', 'gambar',
    ];

    // Mendefinisikan accessor untuk atribut 'ukuran'
    public function getUkuranAttribute($value)
    {
        return json_decode($value); // Mengonversi nilai dari database (JSON) menjadi array PHP
    }
}
