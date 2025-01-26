<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'tb_travel'; 
    
    protected $fillable = [
        'tujuan_travel', 'tgl', 'waktu', 'kouta', 'harga_tiket'
    ];

    public function penumpang()
    {
        return $this->hasMany(Penumpang::class);
    }

    public function getpemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_travel', 'id'); 
    }

    
}