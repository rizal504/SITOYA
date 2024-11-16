<!-- resources/views/tabel_bulanan.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px; /* Adjust the padding as needed */
            text-align: left;
        }

        th {
            background-color: #f2f2f2; /* Optional: Background color for table headers */
        }
    </style>
    <title>Laporan Keuangan Tahunan</title>
</head>
<body>

<h1 style="text-align: center; margin: 0">Laporan Keuangan Tahun {{ $tahun }}</h1>
<h2 style="text-align: center; margin: 0">Pamsimas Tirta Sari</h2>
<p style="text-align: center; margin: 0; margin-bottom: 1cm">Jl. Desa Salam Kerep, Kel. Gondoriyo, Kec. Ngaliyan, Kota Semarang 
  No. Telp 0813 2898 4749</p>


<table>
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Bulan</th>
            <th scope="col">Pemasukan</th>
            <th scope="col">Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPemasukanTahunan = 0;
            $totalPengeluaranTahunan = 0;
        @endphp
        @foreach ($keuangan_tahunans as $bulan => $data)
            @php
                $totalPemasukanTahunan += $data['pemasukan'] ?? 0;
                $totalPengeluaranTahunan += $data['pengeluaran'] ?? 0;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="col-6">{{ date('F', mktime(0, 0, 0, $bulan, 1)) }}</td>
                <td class="text-end">Rp. {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                <td class="text-end">Rp. {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <!-- Total Dana -->
        <tr>
            <td colspan="2" class="text-end"><strong>Total:</strong></td>
            <td class="text-end">{{ is_null($totalPemasukanTahunan) || 0 ? '-' : 'Rp ' . number_format($totalPemasukanTahunan, 0, ',', '.') }}</td>
            <td class="text-end">{{ is_null($totalPengeluaranTahunan) || 0 ? '-' : 'Rp ' . number_format($totalPengeluaranTahunan, 0, ',', '.') }}</td>
        </tr>

        <!-- Grand Total Dana -->
        <tr>
            <td colspan="2" class="text-end"><strong>Grand Total:</strong></td>
            <td colspan="2" class="text-end">{{ 'Rp '. number_format($totalPemasukanTahunan - $totalPengeluaranTahunan, 0, ',', '.' ) }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>
