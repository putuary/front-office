<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'gambar',
        'nama_menu',
        'tipe_produk',
        'harga_modal',
        'harga_jual',
        'jumlah',
        'deskripsi',
    ];
}