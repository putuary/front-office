<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuDipesan;
use App\Models\Feedback;
use App\Models\RiwayatTransaksi;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    public function menu_dipesan()
    {
        return $this->hasMany(MenuDipesan::class, 'id_pesanan');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'id_pesanan');
    }

    public function riwayat_transaksi()
    {
        return $this->hasOne(RiwayatTransaksi::class, 'id_pesanan');
    }

    protected $fillable = [
        'no_meja',
        'waktu_pesan',
        'status',
        'total_harga'
    ];
}