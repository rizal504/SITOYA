<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    @page { margin: 10mm; }

    body {
        font-family: Arial, sans-serif;
        margin: 0px;
        font-size: 12px; /* Adjust the font size as needed */
    }

    .row {
      margin-bottom: 10px;
      display: flex;
    }

    .label {
        font-weight: bold;
        min-width: 150px;
        display: inline-block;
        font-size: 12px; /* Adjust the font size as needed */
    }

    .value {
        flex: 1;
        margin-bottom: 5px;
        font-size: 12px; /* Adjust the font size as needed */
    }
  </style>
</head>
<body>

  <h2 style="text-align: center; margin: 0">Bukti Lunas</h1>
  <h4 style="text-align: center; margin: 0">Pamsimas Tirta Sari</h2>
  <p style="text-align: center; margin: 0; margin-bottom: 1cm">Jl. Desa Salam Kerep, Kel. Gondoriyo, Kec. Ngaliyan, Kota Semarang 
    No. Telp 0813 2898 4749</p>

  <div class="row">
    <div class="label">Nama Lengkap</div>
    <div class="value">{{ $resi->dataWarga->nama }}</div>
  </div>

  <div class="row">
    <div class="label">Debit Awal</div>
    <div class="value">{{ $debit_awal }}</div>
  </div>

  <div class="row">
    <div class="label">Debit Akhir</div>
    <div class="value">{{ $resi->kondisimeteran }}</div>
  </div>

  <div class="row">
    <div class="label">Total Debit</div>
    <div class="value">{{ $resi->totalpemakaian }}</div>
  </div>

  <div class="row">
    <div class="label">Tagihan</div>
    <div class="value">{{ $resi->totalbayar }}</div>
  </div>

  <div class="row">
    <div class="label">Terbayar</div>
    <div class="value">{{ $resi->bayar }}</div>
  </div>

  <div class="row">
    <div class="label">Tanggal Tagihan Dibuat</div>
    <div class="value">{{ $resi->created_at->format('d-m-Y') }}</div>
  </div>

  <div class="row">
    <div class="label">Tanggal Lunas</div>
    <div class="value">{{ $resi->updated_at->format('d-m-Y') }}</div>
  </div>

  <div class="row">
    <div class="label">Status</div>
    <div class="value">Lunas</div>
  </div>

</body>
</html>
