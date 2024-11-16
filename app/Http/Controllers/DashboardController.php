<?php

namespace App\Http\Controllers;

use App\Models\KeuanganBulanan;
use Carbon\Carbon;
use App\Models\pemasukan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $saldo = 0;
        $totalPemasukanDasboard = KeuanganBulanan::where('kategori', 'pemasukan')->sum('pemasukan');
        $totalPengeluaranDashboard = KeuanganBulanan::where('kategori', 'pengeluaran')->sum('pengeluaran');

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $pemasukanBulanan = KeuanganBulanan::whereBetween('tanggal', [$startDate, $endDate])->where('kategori', 'pemasukan')->sum('pemasukan');
        $pengeluaranBulanan = KeuanganBulanan::whereBetween('tanggal', [$startDate, $endDate])->where('kategori', 'pengeluaran')->sum('pengeluaran');

        $saldo = $totalPemasukanDasboard - $totalPengeluaranDashboard;

        return view('dashboard', [
            'saldo' => $saldo,
            'pemasukanBulanan' => $pemasukanBulanan,
            'pengeluaranBulanan' => $pengeluaranBulanan
        ]);
    }
}
