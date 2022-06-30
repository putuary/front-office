<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';

    public function Pesanan()
    {
        return $this->hasMany(MenuDipesan::class);
    }

    protected $fillable = [
        'no_meja',
        'waktu_pesan',
        'status'
    ];
}