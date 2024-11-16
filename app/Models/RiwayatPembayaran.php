<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RiwayatPembayaran extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    
    public function generateUniqueToken()
    {
        do {
            $token = Str::random(32);
        } while ($this->isTokenExists($token));
    
        $this->update(['generated_token' => $token]);
    
        return $token;
    }
    private function isTokenExists($token)
    {
        return DB::table('riwayat_pembayarans')->where('generated_token', $token)->exists();
    }
    public function isValidToken($token)
    {
        return $token === $this->generated_token;
    }
    public function dataWarga(){
        return $this->belongsTo(DataWarga::class,'warga_id','id');
    }
    public function backupPembayaran(){
        return $this->hasMany(BackupPembayaran::class,'riwayatpembayaran_id','id');
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
