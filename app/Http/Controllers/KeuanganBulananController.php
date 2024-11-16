<?php

namespace App\Http\Controllers;

use App\Models\KeuanganBulanan;
use App\Http\Requests\StoreKeuanganBulananRequest;
use App\Http\Requests\UpdateKeuanganBulananRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeuanganBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $request->validate([
            'bulan' => 'nullable|date_format:Y-m',
            'tahun' => 'nullable|numeric'
        ]);
        $viewData = [];
        if(request('bulan') || $request->input('bulan')){
            // PENARIKAN BULAN
            $inputan = request('bulan');
            list($tahun, $bulan) = explode('-', $inputan);
            $startDate = Carbon::create($tahun, $bulan, 1);
            $endDate = $startDate->copy()->endOfMonth();
            $keuangan_bulanan = KeuanganBulanan::whereBetween('tanggal', [$startDate, $endDate])->get();
            // AKHIR PENARIKAN BULAN

            $viewData = array_merge($viewData,[
                'keuangan_bulanans' => $keuangan_bulanan,
                'bulanapa' => Carbon::createFromDate($tahun, $bulan)->format('F'),
                'startDate' => $startDate,
            ]); 
            
            // //PENARIKAN TAHUN
            // $tahun = Carbon::today()->year;
            // $startMonth = Carbon::create($tahun, 1);
            // $endYear = $startMonth->copy()->endOfYear();
            // $keuangan_tahunan = KeuanganBulanan::whereBetween('tanggal', [$startMonth, $endYear])->get();
            // foreach ($keuangan_tahunan as $keuangan) {
            //     $bulan = date('n', strtotime($keuangan->tanggal));
            //     if (!isset($total_per_bulan[$bulan])) {
            //         $total_per_bulan[$bulan] = [
            //             'pemasukan' => 0,
            //             'pengeluaran' => 0,
            //         ];
            //     }
            
            //     // Tambahkan keuangan ke pendapatan
            //     $total_per_bulan[$bulan]['pemasukan'] += $keuangan->pemasukan; // Gantilah 'jumlah' dengan kolom yang sesuai
            //     // Tambahkan pengeluaran ke pengeluaran
            //     $total_per_bulan[$bulan]['pengeluaran'] += $keuangan->pengeluaran; // Gantilah 'pengeluaran' dengan kolom yang sesuai
            // }
            // // AKHIR PENARIKAN TAHUN


        }if(!request('bulan')){
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $keuangan_bulanan = KeuanganBulanan::whereBetween('tanggal', [$startDate, $endDate])->get();

            $viewData = array_merge($viewData, [
                'keuangan_bulanans' => $keuangan_bulanan,
                'bulanapa' => Carbon::now()->format('F'),
                'startDate' => $startDate,
            ]) ;
        }
        if(request('tahun') || $request->input('tahun')){
            //PENARIKAN TAHUN
            // $tahun = Carbon::today()->year;
            $startMonth = Carbon::create(request('tahun'), 1);
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
            // AKHIR PENARIKAN TAHUN

            $viewData = array_merge($viewData, [
                'keuangan_tahunans' => $total_per_bulan,
                'tahun' => request('tahun')
            ]);
            
        }if(!request('tahun')){
            //PENARIKAN TAHUN
                $tahun = Carbon::now()->year;
                $startMonth = Carbon::create($tahun, 1);
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
            // AKHIR PENARIKAN TAHUN
            $viewData = array_merge($viewData,[
                'keuangan_tahunans' => $total_per_bulan,
                'tahun' => Carbon::now()->year
            ]) ;
        }
        return view('keuangan_bulanan',$viewData);
        // return dd($viewData);
        
        
        
        // else{
        //     //PENARIKAN BULAN
        //     $startDate = Carbon::today()->startOfMonth();
        //     $endDate = Carbon::today()->endOfMonth();
        //     $keuangan_bulanan = KeuanganBulanan::whereBetween('tanggal', [$startDate, $endDate])->get();
        //     // AKHIR PENARIKAN BULAN

        //     //PENARIKAN TAHUN
        //     $tahun = Carbon::today()->year;
        //     $startMonth = Carbon::create($tahun, 1);
        //     $endYear = $startMonth->copy()->endOfYear();
        //     $keuangan_tahunan = KeuanganBulanan::whereBetween('tanggal', [$startMonth, $endYear])->get();
        //     foreach ($keuangan_tahunan as $keuangan) {
        //         $bulan = date('n', strtotime($keuangan->tanggal));
        //         if (!isset($total_per_bulan[$bulan])) {
        //             $total_per_bulan[$bulan] = [
        //                 'pemasukan' => 0,
        //                 'pengeluaran' => 0,
        //             ];
        //         }
            
        //         // Tambahkan keuangan ke pendapatan
        //         $total_per_bulan[$bulan]['pemasukan'] += $keuangan->pemasukan; // Gantilah 'jumlah' dengan kolom yang sesuai
        //         // Tambahkan pengeluaran ke pengeluaran
        //         $total_per_bulan[$bulan]['pengeluaran'] += $keuangan->pengeluaran; // Gantilah 'pengeluaran' dengan kolom yang sesuai
        //     }
        //     // AKHIR PENARIKAN TAHUN
            
        //     return view('keuangan_bulanan',[
        //         'keuangan_bulanans' => $keuangan_bulanan,
        //         'bulanapa' => Carbon::today()->format('F'),
        //         'startDate' => $startDate,
        //         'keuangan_tahunans' => $total_per_bulan,
        //         'tahun' => Carbon::today()->year
        //     ]);
        //         // return dd($total_per_bulan);
        // }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('input_pemasukan',[

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeuanganBulananRequest $request)
    {
        //
        $messages = [
            'kategori.required' => 'Kolom harus diisi',
            'tanggal.required' => 'Kolom harus diisi',
            'tanggal.date' => 'Kolom  harus berupa tanggal',
            'keterangan.required' => 'Kolom harus diisi',
            'keterangan.max' => 'Maksimal 255 karakter',
            'nominal.required' => 'Kolom harus diisi',
            'nominal.numeric' => 'Isi harus berupa angka',
            'nominal.min' => 'Angka tidak boleh negatif',
        ];
        $validatedData = $request->validate([
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required|max:255',
            'nominal' => 'required|numeric|min:0',
        ],$messages);
        if($validatedData['kategori']=='pemasukan'){
            $validatedData['pemasukan']=$validatedData['nominal'];
        }else{
            $validatedData['pengeluaran']=$validatedData['nominal'];
        }
        unset($validatedData['nominal']);

        KeuanganBulanan::create($validatedData);
        return redirect('/dashboard/keuangan')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KeuanganBulanan $keuanganBulanan)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KeuanganBulanan $keuangan)
    {
        //
        $keuangan = KeuanganBulanan::find($keuangan->id);
        if (!$keuangan) {
            // Sumber daya tidak ditemukan, tangani sesuai
            abort(404);
        }
        // // Validasi token
        // if (!$keuangan->isValidToken($token)) {
        //     // Token tidak valid, tangani sesuai
        //     abort(403, 'Unauthorized');
        // }
        return view('pemasukan_edit', [
            'keuangan' => $keuangan
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeuanganBulananRequest $request, KeuanganBulanan $keuangan)
    {
        //
        $messages = [
            'kategori.required' => 'Kolom harus diisi',
            'tanggal.required' => 'Kolom harus diisi',
            'tanggal.date' => 'Kolom  harus berupa tanggal',
            'keterangan.required' => 'Kolom harus diisi',
            'keterangan.max' => 'Maksimal 255 karakter',
            'nominal.required' => 'Kolom harus diisi',
            'nominal.numeric' => 'Isi harus berupa angka',
            'nominal.min' => 'Angka tidak boleh negatif',
        ];
        $validatedData = $request->validate([
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required|max:255',
            'nominal' => 'required|numeric|min:0',
        ],$messages);
        if($validatedData['kategori']=='pemasukan'){
            $validatedData['pemasukan']=$validatedData['nominal'];
            $validatedData['pengeluaran']=null;
        }else{
            $validatedData['pengeluaran']=$validatedData['nominal'];
            $validatedData['pemasukan']=null;
        }
        unset($validatedData['nominal']);
        KeuanganBulanan::where('id',$keuangan->id)->update($validatedData);
        return redirect('/dashboard/keuangan')->with('update', 'Data telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeuanganBulanan $keuangan)
    {
        //
        KeuanganBulanan::destroy($keuangan->id);
        return redirect('/dashboard/keuangan')->with('delete', 'Data telah dihapus');
        
    }

}
