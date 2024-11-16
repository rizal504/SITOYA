<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPembayaran;
use App\Http\Requests\StoreRiwayatPembayaranRequest;
use App\Http\Requests\UpdateRiwayatPembayaranRequest;
use App\Models\BackupPembayaran;
use App\Models\DataWarga;

class RiwayatPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $warga_uuid = request()->input('uuid');
        // $warga_id = DataWarga::where('uuid',$warga_uuid)->first()->id;

        $warga_id = request()->input('warga_id');
        $nama_cari = request()->input('nama_cari');
        return view('inputmeteran', [
            'warga' => RiwayatPembayaran::where('warga_id', $warga_id)->orderBy('created_at', 'desc')->first(),
            'nama_cari' => $nama_cari
            // ->whereMonth('created_at', now()->subMonth()->month)
            // ->whereYear('created_at', now()->subMonth()->year)
            // ->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatPembayaranRequest $request)
    {
        //
        $messages = [
            'warga_id.required' => 'Kolom harus diisi',
            'warga_id.numeric' => 'Kolom  harus berupa angka',
            'kondisimeteran.required' => 'Kolom  harus diisi',
            'kondisimeteran.numeric' => 'Kolom  harus berupa angka',
            'kondisimeteran.min' => 'Kolom tidak boleh negatif',
            'totalpemakaian.required' => 'Kolom harus diisi',
            'totalpemakaian.numeric' => 'Kolom harus berupa angka',
            'totalpemakaian.min' => 'Kolom tidak boleh negatif',
            'totalbayar.required' => 'Kolom harus diisi',
            'totalbayar.numeric' => 'Kolom harus berupa angka',
            'totalbayar.min' => 'Kolom tidak boleh negatif',
            'bayar.required' => 'Kolom harus diisi',
            'bayar.numeric' => 'Kolom harus berupa angka',
            'bayar.min' => 'Kolom tidak boleh negatif',
        ];

        $validatedData = $request->validate([
            'warga_id' => 'required',
            'debitawal' => 'required|numeric|min:0',
            'kondisimeteran' => 'required|numeric|min:0',
            'totalpemakaian' => 'required|numeric|min:0',
            'totalbayar' => 'required|numeric|min:0',
            'bayar' => 'required|numeric|min:0',
            'kembalian' => 'required|numeric|min:0',
        ], $messages);

        $validatedData = array_merge($validatedData,[
            'warga_id' => DataWarga::where('uuid',$validatedData['warga_id'])->first()->id
        ]);
        
        $kurang = $validatedData['totalbayar'] - $validatedData['bayar'];

        if ($kurang < 0) {
            $validatedData['kurang'] = 0;
        } else {
            $validatedData['kurang'] = $kurang;
        }

        if ($validatedData['totalbayar'] > $validatedData['bayar']) {
            $validatedData['status'] = 0;
        } else {
            $validatedData['status'] = 1;
        }

        if ($validatedData['totalbayar'] < $validatedData['bayar']) {
            $untuk_ditotal = $validatedData['totalbayar'];
        } else {
            $untuk_ditotal = $validatedData['bayar'];
        }

        $RiwayatPembayaran = RiwayatPembayaran::create($validatedData);
        $RiwayatPembayaran->backupPembayaran()->create([
            'warga_id' => $validatedData['warga_id'],
            'totalbayar' => $validatedData['totalbayar'],
            'bayar' => $validatedData['bayar'],
            'untuk_ditotal' => $untuk_ditotal
        ]);
        if ($validatedData['status'] == 1) {
            $statusResi = "lunas";
        } else {
            $statusResi = "belum lunas";
        }
        // return view('resi', [
        //     'nama' => DataWarga::where('id', $validatedData['warga_id'])->first(),
        //     'debitawal' => $validatedData['debitawal'],
        //     'debitAkhir' => $validatedData['kondisimeteran'],
        //     'totalDebit' => $validatedData['totalpemakaian'],
        //     'tagihan' => $validatedData['totalbayar'],
        //     'terbayar' => $validatedData['bayar'],
        //     'kembalian' => $validatedData['kembalian'],
        //     'status' => $statusResi,
        //     'success' => "Data telah ditambahkan"
        // ]);
        return redirect('/dashboard/inputdata')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatPembayaran $riwayatPembayaran)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPembayaran $riwayatPembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatPembayaranRequest $request, RiwayatPembayaran $riwayatPembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatPembayaran $riwayatPembayaran)
    {
        //
    }
}
