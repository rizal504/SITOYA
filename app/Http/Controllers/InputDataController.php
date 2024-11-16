<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use Illuminate\Http\Request;

class InputDataController extends Controller
{
    //
    public function index(){
        $warga = DataWarga::orderBy('nama', 'asc');
        if(request('search')){
            $warga->where('nama', 'like', '%'. request('search'). '%' );
            return view('cariwarga',[
                //"userData" => UserData::where('username',auth()->user()->username)->get()
                'wargas' => $warga->get()
            ]);
        }

        return view('cariwarga',[
            //"userData" => UserData::where('username',auth()->user()->username)->get()
            // 'wargas' => $warga->get()
        ]);      
        
    }
}
