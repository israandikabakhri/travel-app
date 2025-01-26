<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'tb_pemesanan'; 
    
    protected $fillable = [
        'id_travel', 'id_penumpang', 'status', 'doc_confirm'
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'id_travel');
    }

    public function penumpang()
    {
        return $this->belongsTo(Penumpang::class, 'id_penumpang');
    }

    
}