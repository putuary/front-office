<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class MenuDipesan extends Model
{
    use HasFactory;
    protected $table = 'menu_dipesan';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    protected $fillable = [
        'id_pesanan',
        'id_menu',
        'jumlah',
        'harga_peritem',
    ];
}