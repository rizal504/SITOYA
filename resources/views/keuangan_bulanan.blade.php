@extends('layout.main')

@section('container')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Keuangan</h1>
  </div><!-- End Page Title -->
    <section class="section">
      <div class="row animate_animated animate_fadeInUp">
        <div class="col-lg-12">
          <div class="card">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('delete') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (session()->has('update'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  {{ session('update') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="card-body">
              <!-- Default Tabs -->
              <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Bulanan</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Tahunan</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5  class="card-title col-6">Pemasukan Kas Tirta Sari <span>| {{ $bulanapa }}</span></h5>
                    <div>
                      {{-- <a href="/export-pdf" class="btn btn-warning d-md-inline d-none">Cetak PDF</a> --}}
                      <form class="d-inline" action="/export-pdf-bulan" method="POST">
                        @csrf
                        <input name="tagihanbulan" id="tagihanbulan" type="hidden" value="{{ $startDate }}">
                        <button type="submit" class="btn btn-warning"><i class="bi bi-filetype-pdf"></i></button>
                      </form>
                      {{-- <a href="#" class="btn btn-warning d-inline d-md-none"><i class="bi bi-filetype-pdf"></i></a> --}}
                      {{-- <a href="inputpemasukan.html" class="btn btn-success d-md-inline d-none">Tambah</a> --}}
                      <form class="d-inline" action="/dashboard/keuangan/create">
                        {{-- action="/listklinik/{{$clinicList->id}} --}}
                          <button type="submit" class="btn btn-success"><i class="bi bi-plus"></i></button>
                      </form>
                    </div>
                  </div>
                  <form action="/dashboard/keuangan" class="row g-3" id="searchForm" style="padding-bottom: 50px;">
                    {{-- <label for="inputName" class="form-label">Pilih Bulan :</label> --}}
                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                    <div class="col-md-4">
                      <input type="month" class="form-control" id="bulan" name="bulan" value="{{ request('bulan') }}">  
                    </div>
                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                    <div class="col-md-2 d-flex">
                      <button type="submit" class="btn btn-primary btn-block">Cari</button>
                    </div>
                  </form>
                  <div style="overflow-x: auto;">
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Aksi</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Pemasukan</th>
                          <th scope="col">Pengeluaran</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Table Data -->
                        @php
                            $totalPemasukan = 0;
                            $totalPengeluaran = 0;
                        @endphp
                        @foreach ($keuangan_bulanans as $keuangan_bulanan)
                        @php
                          
                          $totalPemasukan += $keuangan_bulanan->pemasukan ?? 0;
                          $totalPengeluaran += $keuangan_bulanan->pengeluaran ?? 0;
                        @endphp   
                          <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                              <a href="/dashboard/keuangan/{{$keuangan_bulanan->uuid}}/edit" class="btn btn-warning mb-2 mb-md-0 me-md-2"><i class="bi bi-pen-fill"></i></a>
                              {{-- <a href="detailpemasukan.html" class="btn btn-danger"><i class="bi bi-trash3"></i></a> --}}
                              <form class="d-inline" action="/dashboard/keuangan/{{ $keuangan_bulanan->uuid }}" method="post">
                                @method('delete')
                                @csrf
                                  {{-- <button type="submit" class="btn btn-danger d-md-inline d-none"><i class="bi bi-trash3"></i></button> --}}
                                  <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger d-md-inline"><i class="bi bi-trash3"></i></button>
                  
                              </form>
                            </td>
                            <td>{{ $keuangan_bulanan->created_at->format('d-m-Y') }}</td>
                            <td>{{ $keuangan_bulanan->kategori }}</td>
                            <td>{{ $keuangan_bulanan->keterangan }}</td>
                            <td class="text-end">{{ is_null($keuangan_bulanan->pemasukan) ? '-' : 'Rp ' . number_format($keuangan_bulanan->pemasukan, 0, ',', '.') }}</td>
                            <td class="text-end">{{ is_null($keuangan_bulanan->pengeluaran) ? '-' : 'Rp ' . number_format($keuangan_bulanan->pengeluaran, 0, ',', '.') }}</td>
                          </tr>
                        @endforeach
                        <!-- Total Dana -->
                        <tr>
                          <td colspan="5" class="text-end"><strong>Total:</strong></td>
                          <td class="text-end">{{ is_null($totalPemasukan) || 0 ? '-' : 'Rp ' . number_format($totalPemasukan, 0, ',', '.') }}</td>
                          <td class="text-end">{{ is_null($totalPengeluaran) || 0 ? '-' : 'Rp ' . number_format($totalPengeluaran, 0, ',', '.') }}</td>
                        </tr>
                  
                        <!-- Grand Total Dana -->
                        <tr>
                          <td colspan="5" class="text-end"><strong>Grand Total:</strong></td>
                          <td colspan="2" class="text-end">{{ 'Rp '. number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.' ) }}</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>           
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title col-6">Pemasukan Kas Tirta Sari <span>| {{ $tahun }}</span></h5>
                    <div>
                      <form class="d-inline" action="/export-pdf-tahun" method="POST">
                        @csrf
                        <input name="tagihantahun" id="tagihantahun" type="hidden" value="{{ $tahun }}">
                        <button type="submit" class="btn btn-warning"><i class="bi bi-filetype-pdf"></i></button>
                      </form>  
                    </div>
                  </div>
                  <form action="/dashboard/keuangan" class="row g-3" id="searchForm" style="padding-bottom: 50px;">
                    {{-- <label for="inputName" class="form-label">Pilih Bulan :</label> --}}
                    <label for="tahun" class="form-label">Pilih Tahun :</label>
                    <div class="col-md-4">
                      <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $tahun }}">  
                    </div>
                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                    <div class="col-md-2 d-flex">
                      <button type="submit" class="btn btn-primary btn-block">Cari</button>
                    </div>
                  </form>
                  <div style="overflow-x: auto;">
                    <table class="table table-bordered">
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
                  </div>
              </div><!-- End Default Tabs -->
              <div class="tab-pane fade" id="rekap-justified" role="tabpanel" aria-labelledby="rekap-tab">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="card-title col-6">Pemasukan Kas Tirta Sari <span>| Januari</span></h5>
                  <a href="inputpengeluaran.html" class="btn btn-success d-md-inline d-none">Tambah</a>
                  <a href="inputpengeluaran.html" class="btn btn-success d-inline d-md-none">+</a>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Uraian Pemasukan</th>
                      <th scope="col">Anggaran Masuk</th>
                      <th scope="col">Uraian Pengeluaran</th>
                      <th scope="col">Anggaran Keluar</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>$64</td>
                      <td>$64</td>
                      <td>$64</td>
                      <td>$64</td>  
                      <td>
                      <a href="detailpengeluaran.html" class="btn btn-primary">Detail</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div><!-- End Default Tabs -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </div><!-- End Bordered Tabs -->
  </main><!-- End #main -->
  @endsection