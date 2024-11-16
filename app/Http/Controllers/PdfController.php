<?php

namespace App\Http\Controllers;

use App\Models\KeuanganBulanan;
use App\Models\RiwayatPembayaran;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{
    public function cetakPdf_bulan(Request $request)
    {
        $startDate = Carbon::create($request->input('tagihanbulan')); 
        $endDate = $startDate->copy()->endOfMonth();
        
        $data = [
            'keuangan_bulanans' => KeuanganBulanan::whereBetween('tanggal', [$startDate, $endDate])->get(),
            'bulanapa' => $startDate->format('F')
        ];

        // Load the view manually
        $view = View::make('tabel_bulanan', $data)->render();

        // Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);

        // Set paper size (e.g., A4)
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF (first output)
        $dompdf->render();

        // Stream the file
        return $dompdf->stream('laporan_keuangan_bulan_'.$startDate->format('F').' '.$startDate->format('Y').'.pdf');
    }
    public function cetakPdf_tahun(Request $request)
    {
        
        $startMonth = Carbon::create($request->input('tagihantahun'),1);
        $endYear = $startMonth->copy()->endOfYear();
        $keuangan_tahunan = KeuanganBulanan::whereBetween('tanggal', [$startMonth, $endYear])->get();
        $total_per_bulan = [];
        foreach ($keuangan_tahunan as $keuangan) {
            $bulan = date('n', strtotime($keuangan->tanggal));
            if (!isset($total_per_bulan[$bulan])) {
                $total_per_bulan[$bulan] = [
                    'pemasukan' => 0,
                    'pengeluaran' => 0,
                ];
            }
        
            // Tambahkan keuangan ke pendapatan
            $total_per_bulan[$bulan]['pemasukan'] += $keuangan->pemasukan; // Gantilah 'jumlah' dengan kolom yang sesuai
            // Tambahkan pengeluaran ke pengeluaran
            $total_per_bulan[$bulan]['pengeluaran'] += $keuangan->pengeluaran; // Gantilah 'pengeluaran' dengan kolom yang sesuai
        }

        $data = [
            'keuangan_tahunans' => $total_per_bulan,
            'tahun' => $startMonth->format('Y')
        ];

        // Load the view manually
        $view = View::make('tabel_tahunan', $data)->render();

        // Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);

        // Set paper size (e.g., A4)
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF (first output)
        $dompdf->render();

        // Stream the file
        return $dompdf->stream('laporan_keuangan_tahun_'.$startMonth->format('Y').'.pdf');
    }
    public function cetakPdf_buktiPembayaran(){
        
        
    }
    public function cetakPdf_buktiLunas(String $uuid){
        $resi = RiwayatPembayaran::where('uuid',$uuid)->first();
        $debit_awal = RiwayatPembayaran::where('created_at', '<', $resi->created_at)
        ->orderBy('created_at', 'desc')
        ->first();

        $data['resi'] = $resi;

        if($debit_awal !== null){
            $data['debit_awal'] = $debit_awal->kondisimeteran;
        }else{
            $data['debit_awal'] = "";
        }
        

        // Load the view manually
        $view = View::make('resi_lunas_pdf', $data)->render();

        // Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);

        // Set paper size (e.g., A4)
        $dompdf->setPaper('A6', 'portrait');

        

        // Render PDF (first output)
        $dompdf->render();

        // Stream the file
        return $dompdf->stream('buktiLunas '.$resi->dataWarga->nama.'.pdf');
    }
}
