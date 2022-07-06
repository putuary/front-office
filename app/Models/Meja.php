<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Keranjang;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';
    protected $primaryKey = 'no_meja';
    public $incrementing = false;
    
    public function MenudiKeranjang() 
    {
        return $this->hasMany(Keranjang::class, 'no_meja');
    }
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'no_meja',
        'nama_meja',
    ];
}