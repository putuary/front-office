<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meja;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    
    public function Keranjang_Meja()
    {
        return $this->belongsTo(Meja::class, 'no_meja');
    }


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'no_meja',
        'id_menu',
    ];
}