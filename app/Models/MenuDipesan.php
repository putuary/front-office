<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDipesan extends Model
{
    use HasFactory;
    protected $table = 'menu_dipesan';

    protected $fillable = [
        'id_pesanan',
        'id_menu',
        'jumlah',
        'total_harga',
    ];
}