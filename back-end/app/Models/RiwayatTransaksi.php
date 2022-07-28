<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class RiwayatTransaksi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_transaksi';

    public function pesanan()
    {
        return $this->hasOne(Pesanan::class, 'id_pesanan');
    }

    protected $fillable = [
        'id_pesanan',
        'status_transaksi',
    ];
}