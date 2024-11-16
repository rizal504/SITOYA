<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataWarga;
use App\Models\RiwayatPembayaran;
use App\Models\BackupPembayaran;
use App\Models\KeuanganBulanan;
use App\Models\TotalBulanan;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::factory(10)->create();
        User::create([                                      
            'username' => "pengurus1",
            'password' => Hash::make('pengurus1'),
            'role'=> "pengurus", 
        ]);
        User::create([                                      
            'username' => "penagih1",
            'password' => Hash::make('penagih1'),
            'role'=> "penagih",
        ]); 
        
        DataWarga::create([                                      
            'nama' => "Hasan Nur Wakhid",
            'alamat' => "rt1"
        ]);

        DataWarga::create([                                      
            'nama' => "Agus Hermawan",
            'alamat' => "rt2"
        ]);
        
        DataWarga::create([                                      
            'nama' => "Rudi Taputi",
            'alamat' => "nggludang"
        ]);
        DataWarga::create([                                      
            'nama' => "Budi Santoso",
            'alamat' => "wardana"
        ]);
        
        RiwayatPembayaran::create([                                      
            'warga_id' => 1,     
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'kondisimeteran' => 10,
            'totalpemakaian' => 2,
            'totalbayar' => 5000,
            'bayar' => 5000,
            'kurang' => 0,
            'status' => 1
        ]);

        BackupPembayaran::create([
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'warga_id' => 1,     
            'riwayatpembayaran_id' => 1,
            'totalbayar' => 5000,
            'bayar' => 5000,
            'untuk_ditotal' => 5000
        ]);

        RiwayatPembayaran::create([                                      
            'warga_id' => 2,     
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'kondisimeteran' => 15,
            'totalpemakaian' => 4,
            'totalbayar' => 10000,
            'bayar' => 10000,
            'kurang' => 0,
            'status' => 1
        ]);

        BackupPembayaran::create([
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'warga_id' => 2,     
            'riwayatpembayaran_id' => 2,
            'totalbayar' => 10000,
            'bayar' => 10000,
            'untuk_ditotal' => 10000
        ]);

        RiwayatPembayaran::create([                                      
            'warga_id' => 3,     
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'kondisimeteran' => 13,
            'totalpemakaian' => 5,
            'totalbayar' => 12500,
            'bayar' => 12500,
            'kurang' => 0,
            'status' => 1
        ]);

        BackupPembayaran::create([
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'warga_id' => 3,     
            'riwayatpembayaran_id' => 3,
            'totalbayar' => 12500,
            'bayar' => 12500,
            'untuk_ditotal' => 12500
        ]);

        RiwayatPembayaran::create([                                      
            'warga_id' => 4,     
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'kondisimeteran' => 14,
            'totalpemakaian' => 10,
            'totalbayar' => 25000,
            'bayar' => 20000,
            'kurang' => 5000,
            'status' => 0
        ]);

        BackupPembayaran::create([
            'created_at' => Carbon::now()->subMonths()->day(26),                                                                       
            'warga_id' => 4,     
            'riwayatpembayaran_id' => 4,
            'totalbayar' => 25000,
            'bayar' => 20000,
            'untuk_ditotal' => 20000
        ]);


        // $today = Carbon::today();
        // $last25Months = Carbon::today()->subMonths()->day(25);

        // //UNTUK RT1 ==================================
        // $total_masuk_rt1 = BackupPembayaran::whereBetween('created_at', [$last25Months, $today])
        // ->whereHas('dataWarga', function ($query) {
        //     $query->where('alamat', 'rt1'); // Ganti 'your_value' sesuai kebutuhan
        // })
        // ->sum('untuk_ditotal');
        
        // $total_kurang_rt1 = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $today])
        // ->whereHas('dataWarga', function ($query) {
        //     $query->where('alamat', 'rt1'); // Ganti 'your_value' sesuai kebutuhan
        // })
        // ->sum('kurang');
        
        // TotalBulanan::create([
        //     'created_at' => Carbon::today()->subMonths()->day(25),
        //     'tanggal' => Carbon::today()->subMonths()->day(25),
        //     'alamat' => 'rt1',
        //     'keterangan' => 'bulanan dari rt1',
        //     'total_masuk' => $total_masuk_rt1,
        //     'total_kurang' => $total_kurang_rt1

        // ]);
        // KeuanganBulanan::create([
        //     'created_at' => Carbon::today()->subMonths()->day(25),
        //     'tanggal' => Carbon::today(),
        //     'kategori' => 'pemasukan',
        //     'keterangan' => 'bulanan dari rt1',
        //     'pemasukan' => $total_masuk_rt1
        // ]);

        // // UNTUK RT2 ====================================
        // $total_masuk_rt2 = BackupPembayaran::whereBetween('created_at', [$last25Months, $today])
        // ->whereHas('dataWarga', function ($query) {
        //     $query->where('alamat', 'rt2'); // Ganti 'your_value' sesuai kebutuhan
        // })
        // ->sum('untuk_ditotal');
        
        // $total_kurang_rt2 = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $today])
        // ->whereHas('dataWarga', function ($query) {
        //     $query->where('alamat', 'rt2'); // Ganti 'your_value' sesuai kebutuhan
        // })
        // ->sum('kurang');
        
        // TotalBulanan::create([
        //     'created_at' => Carbon::today()->subMonths()->day(25),
        //     'tanggal' => Carbon::today()->subMonths()->day(25),
        //     'alamat' => 'rt2',
        //     'keterangan' => 'bulanan dari rt2',
        //     'total_masuk' => $total_masuk_rt2,
        //     'total_kurang' => $total_kurang_rt2

        // ]);
        // KeuanganBulanan::create([
        //     'created_at' => Carbon::today()->subMonths()->day(25),
        //     'tanggal' => Carbon::today(),
        //     'kategori' => 'pemasukan',
        //     'keterangan' => 'bulanan dari rt2',
        //     'pemasukan' => $total_masuk_rt2
        // ]);

        // // UNTUK NGGULDANG ====================================
        // $total_masuk_nggludang = BackupPembayaran::whereBetween('created_at', [$last25Months, $today])
        // ->whereHas('dataWarga', function ($query) {
        //     $query->where('alamat', 'nggludang'); // Ganti 'your_value' sesuai kebutuhan
        // })
        // ->sum('untuk_ditotal');
        
        // $total_kurang_nggludang = RiwayatPembayaran::whereBetween('created_at', [$last25Months, $today])
        // ->whereHas('dataWarga', function ($query) {
        //     $query->where('alamat', 'nggludang'); // Ganti 'your_value' sesuai kebutuhan
        // })
        // ->sum('kurang');
        
        // TotalBulanan::create([
        //     'created_at' => Carbon::today()->subMonths()->day(25),
        //     'tanggal' => Carbon::today()->subMonths()->day(25),
        //     'alamat' => 'nggludang',
        //     'keterangan' => 'bulanan dari nggludang',
        //     'total_masuk' => $total_masuk_nggludang,
        //     'total_kurang' => $total_kurang_nggludang

        // ]);
        // KeuanganBulanan::create([
        //     'created_at' => Carbon::today()->subMonths()->day(25),
        //     'tanggal' => Carbon::today(),
        //     'kategori' => 'pemasukan',
        //     'keterangan' => 'bulanan dari nggludang',
        //     'pemasukan' => $total_masuk_nggludang
        // ]);
    }
}
