<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class DataWarga extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function riwayatPembayaran(){
        return $this->hasMany(RiwayatPembayaran::class,'warga_id','id');
}

    public function backupPembayaran(){
        return $this->hasMany(BackupPembayaran::class,'warga_id','id');
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
