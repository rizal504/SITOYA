<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupPembayaran extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function dataWarga(){
        return $this->belongsTo(DataWarga::class,'warga_id','id');
    }
    public function riwayatPembayaran(){
        return $this->belongsTo(RiwayatPembayaran::class,'pembayaran_id','id');
    }
}
