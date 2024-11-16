<?php

namespace App\Http\Controllers;

use App\Models\BackupPembayaran;
use App\Models\RiwayatPembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dotenv\Util\Str;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        if(request('bulan')){
            $inputan = request('bulan');
            list($tahun, $bulan) = explode('-', $inputan);

            $startDate = Carbon::create($tahun, $bulan, 25);
            $endDate = $startDate->copy()->addMonths(1);
            $belumlunas = RiwayatPembayaran::where('status','0')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('updated_at', 'desc');
            $sudahlunas = RiwayatPembayaran::where('status','1')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('updated_at', 'desc');
            return view('laporan',[           
            //"userData" => UserData::where('username',auth()->user()->username)->get()
                'belumlunass' => $belumlunas->get(),
                'sudahlunass' => $sudahlunas->get(),
                'bulanapa' => $startDate->format('F')
            ]);
        }else{
            if(Carbon::now()->format('d')<25){
                $now = Carbon::now();
                $last25Months = Carbon::now()->subMonths(1)->day(25);

                $belumlunas = RiwayatPembayaran::where('status','0')
                ->whereBetween('created_at', [$last25Months, $now])
                ->orderBy('updated_at', 'desc');

                $sudahlunas = RiwayatPembayaran::where('status','1')
                ->whereBetween('created_at', [$last25Months, $now])
                ->orderBy('updated_at', 'desc');

                return view('laporan',[           
                //"userData" => UserData::where('username',auth()->user()->username)->get()
                    'belumlunass' => $belumlunas->get(),
                    'sudahlunass' => $sudahlunas->get(),
                    'bulanapa' => $now->subMonths()->format('F')
                ]);
                
            }else{
                $now = Carbon::now();
                $thismonth25 = Carbon::now()->day(25);

                $belumlunas = RiwayatPembayaran::where('status','0')
                ->whereBetween('created_at', [$thismonth25, $now])
                ->orderBy('updated_at', 'desc');

                $sudahlunas = RiwayatPembayaran::where('status','1')
                ->whereBetween('created_at', [$thismonth25, $now])
                ->orderBy('updated_at', 'desc');

                return view('laporan',[           
                    //"userData" => UserData::where('username',auth()->user()->username)->get()
                        'belumlunass' => $belumlunas->get(),
                        'sudahlunass' => $sudahlunas->get(),
                        'bulanapa' => $now->subMonths()->format('F')
                    ]);
            }
            
        }

        // $today = Carbon::today();
        // $last24Months = Carbon::today()->subMonths(24);

        // $belumlunas = RiwayatPembayaran::where('status','0');
        // $sudahlunas = RiwayatPembayaran::where('status','1')
        // ->whereBetween('created_at', [$last24Months, $today]);

        // return view('laporan',[           
        // //"userData" => UserData::where('username',auth()->user()->username)->get()
        //     'belumlunass' => $belumlunas->get(),
        //     'sudahlunass' => $sudahlunas->get()
        // ]);
        // list($tahun, $bulan) = explode('-', request('bulan')); 
        // return $tahun;
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPembayaran $laporan)
    {
        //
        // Temukan sumber daya berdasarkan ID
        $riwayatPembayaran = RiwayatPembayaran::find($laporan->id);

        if (!$riwayatPembayaran) {
            // Sumber daya tidak ditemukan, tangani sesuai
            abort(404);
        }
        // // Validasi token
        // if (!$riwayatPembayaran->isValidToken($token)) {
        //     // Token tidak valid, tangani sesuai
        //     abort(403, 'Unauthorized');
        // }
        
        if ($riwayatPembayaran->status==1) {
            // Sumber daya tidak ditemukan, tangani sesuai
            abort(403, 'Maaf tagihan ini sudah lunas');
        }

        // Token valid, lanjutkan dengan pengeditan
        return view('belumlunas', [
            'warga' => $riwayatPembayaran
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiwayatPembayaran $laporan)
    {
        //
        $validatedData = $request -> validate([
            'totalpemakaian' => 'required|numeric',
            'totalbayar' => 'required|numeric',
            'bayar' => 'required|numeric',
        ]);

        // $riwayatPembayaran = RiwayatPembayaran::find($laporan->id);

        if($validatedData['totalbayar']<=$validatedData['bayar']){
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }

        if($validatedData['totalbayar']<$validatedData['bayar']){
            $untuk_ditotal = $validatedData['totalbayar'];
        }else{
            $untuk_ditotal = $validatedData['bayar'];
        }

        BackupPembayaran::create([
            'riwayatpembayaran_id' => $laporan->id,
            'warga_id' => $laporan->warga_id,
            'totalbayar' => $laporan->totalbayar,
            'bayar' => $validatedData['bayar'],
            'untuk_ditotal' => $untuk_ditotal
        ]);

        $kurang = $laporan->kurang - $validatedData['bayar'];

        if($kurang<0){
            $kurang = 0;
        }else{
            $kurang = $kurang;
        }

        $laporan->update([
            'bayar' => $laporan->bayar + $validatedData['bayar'],
            'kurang' => $kurang,
            'status' => $data['status']
        ]);
        
        return redirect('/dashboard/laporan')->with('update', 'Data telah update');

        // $data = RiwayatPembayaran::find($id);
        // $data['bayar'] = $data['bayar'] + $validatedData['bayar'];
        // $data['kurang'] = $data['kurang'] - $validatedData['bayar'];

        // if($validatedData['totalbayar']<=$validatedData['bayar']){
        //     $data['status'] = 1;
        // }
        // else{
        //     $data['status'] = 0;
        // }

        // RiwayatPembayaran::find($id)->update($data);
        // BackupPembayaran::create([
        //     'riwayatpembayaran_id' => $id,
        //     'warga_id' => $validatedData['warga_id'],
        //     'totalbayar' => $validatedData['totalbayar'],
        //     'bayar' => $validatedData['bayar']
        // ]);

        // return redirect('/dashboard/laporan')->with('success', 'Data telah update');
        // return $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
