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
    <title>Laporan Keuangan</title>
</head>
<body>

<h1 style="text-align: center; margin: 0">Laporan Keuangan Bulan {{ $bulanapa }}</h1>
<h2 style="text-align: center; margin: 0">Pamsimas Tirta Sari</h2>
<p style="text-align: center; margin: 0; margin-bottom: 1cm">Jl. Desa Salam Kerep, Kel. Gondoriyo, Kec. Ngaliyan, Kota Semarang 
  No. Telp 0813 2898 4749</p>


<table>
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Kategori</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Pemasukan</th>
            <th scope="col">Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @php
            $nomor = 0;
            $totalPemasukan = 0;
            $totalPengeluaran = 0;
        @endphp
        @foreach ($keuangan_bulanans as $keuangan_bulanan)
            @php
                $nomor++;
                $totalPemasukan += $keuangan_bulanan->pemasukan ?? 0;
                $totalPengeluaran += $keuangan_bulanan->pengeluaran ?? 0;
            @endphp
            <tr>
                <td>{{ $nomor }}</td>
                <td>{{ $keuangan_bulanan->created_at->format('d-m-Y') }}</td>
                <td>{{ $keuangan_bulanan->kategori }}</td>
                <td>{{ $keuangan_bulanan->keterangan }}</td>
                <td class="text-end">{{ is_null($keuangan_bulanan->pemasukan) ? '-' : 'Rp ' . number_format($keuangan_bulanan->pemasukan, 0, ',', '.') }}</td>
                <td class="text-end">{{ is_null($keuangan_bulanan->pengeluaran) ? '-' : 'Rp ' . number_format($keuangan_bulanan->pengeluaran, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <!-- Total Dana -->
        <tr>
            <td colspan="4" class="text-end"><strong>Total:</strong></td>
            <td class="text-end">{{ is_null($totalPemasukan) || $totalPemasukan == 0 ? '-' : 'Rp ' . number_format($totalPemasukan, 0, ',', '.') }}</td>
            <td class="text-end">{{ is_null($totalPengeluaran) || $totalPengeluaran == 0 ? '-' : 'Rp ' . number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>

        <!-- Grand Total Dana -->
        <tr>
            <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
            <td colspan="2" class="text-end">{{ 'Rp ' . number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>
