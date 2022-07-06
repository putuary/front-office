<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';

    public function feedback_pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'isi_feedback',
    ];
}