<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'gambar',
        'tipe_produk',
        'harga',
        'deskripsi',
    ];
}