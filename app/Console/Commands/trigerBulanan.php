<?php

namespace App\Console\Commands;

use App\Models\BackupPembayaran;
use App\Models\KeuanganBulanan;
use App\Models\RiwayatPembayaran;
use App\Models\TotalBulanan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class trigerBulanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:triger-bulanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    
    {
        $now = Carbon::now();
        $last25Months = Carbon::now()->subMonths()->day(25);

        //UNTUK RT1 ==================================
        $total_masuk_rt1 = BackupPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'rt1'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('untuk_ditotal');
        
        $total_kurang_rt1 = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'rt1'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('kurang');
        
        TotalBulanan::create([
            'tanggal' => Carbon::now(),
            'alamat' => 'rt1',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari RT 1',
            'total_masuk' => $total_masuk_rt1,
            'total_kurang' => $total_kurang_rt1
        ]);
        KeuanganBulanan::create([
            'tanggal' => Carbon::now(),
            'kategori' => 'pemasukan',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari RT 1',
            'pemasukan' => $total_masuk_rt1
        ]);

        // UNTUK RT2 ====================================
        $total_masuk_rt2 = BackupPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'rt2'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('untuk_ditotal');
        
        $total_kurang_rt2 = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'rt2'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('kurang');
        
        TotalBulanan::create([
            'tanggal' => Carbon::now(),
            'alamat' => 'rt2',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari RT 2',
            'total_masuk' => $total_masuk_rt2,
            'total_kurang' => $total_kurang_rt2

        ]);
        KeuanganBulanan::create([
            'tanggal' => Carbon::now(),
            'kategori' => 'pemasukan',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari RT 2',
            'pemasukan' => $total_masuk_rt2
        ]);

        // UNTUK NGGULDANG ====================================
        $total_masuk_nggludang = BackupPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'nggludang'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('untuk_ditotal');
        
        $total_kurang_nggludang = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'nggludang'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('kurang');
        
        TotalBulanan::create([
            'tanggal' => Carbon::now(),
            'alamat' => 'nggludang',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari Nggludang',
            'total_masuk' => $total_masuk_nggludang,
            'total_kurang' => $total_kurang_nggludang

        ]);
        KeuanganBulanan::create([
            'tanggal' => Carbon::now(),
            'kategori' => 'pemasukan',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari Nggludang',
            'pemasukan' => $total_masuk_nggludang
        ]);

        // UNTUK WARDANA ====================================
        $total_masuk_wardana = BackupPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'wardana'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('untuk_ditotal');
        
        $total_kurang_wardana = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $now])
        ->whereHas('dataWarga', function ($query) {
            $query->where('alamat', 'wardana'); // Ganti 'your_value' sesuai kebutuhan
        })
        ->sum('kurang');
        
        TotalBulanan::create([
            'tanggal' => Carbon::now(),
            'alamat' => 'wardana',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari Wardana',
            'total_masuk' => $total_masuk_wardana,
            'total_kurang' => $total_kurang_wardana

        ]);
        KeuanganBulanan::create([
            'tanggal' => Carbon::now(),
            'kategori' => 'pemasukan',
            'keterangan' => 'Tagihan bulan '.$last25Months->format('F').' dari Wardana',
            'pemasukan' => $total_masuk_wardana
        ]);
    }
}
