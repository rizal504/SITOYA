<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPembayaran;
use Illuminate\Http\Request;

class ResiController extends Controller
{
    //
    public function index(string $uuid)
    {
        //
        $viewData = [];

        $resi = RiwayatPembayaran::where('uuid',$uuid)->first();
        $debit_awal = RiwayatPembayaran::where('created_at', '<', $resi->created_at)
        ->orderBy('created_at', 'desc')
        ->first();

        $viewData['resi'] = $resi;

        if($debit_awal !== null){
            $viewData['debit_awal'] = $debit_awal->kondisimeteran;
        }else{
            $viewData['debit_awal'] = "";
        }
        
        return view('resi_lunas',$viewData);
    }
}
