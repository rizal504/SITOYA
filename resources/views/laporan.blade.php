@extends('layout.main')
@section('container')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Tagihan</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          @if (session()->has('update'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  {{ session('update') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
          <form class="row g-3" id="searchForm" action="/dashboard/laporan">
            <div class="card recent-sales overflow-auto">
              <div class="col-md-12">
                <label for="bulan" class="form-label">Pilih Bulan :</label>
                <input type="month" class="form-control" id="bulan" name="bulan" value="{{ request('bulan') }}">  
              </div>
              <div class="text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary" >Cari</button>
              </div>
            </div>
          </form>
          <div class="row">
            <!-- Belum Lunas Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Pembayaran Belum Lunas <span>| {{ $bulanapa }}</span></h5>
                    
                  <table class="table table-hover datatable">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Tagihan</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(isset($belumlunass))
                            @if($belumlunass->count())
                                @foreach($belumlunass as $belumlunas)
                                    <tr>
                                        <td>{{ $belumlunas->dataWarga->nama }}</td>
                                        <td>Rp{{ $belumlunas->kurang }}</td>
                                        <td><a href="/dashboard/laporan/{{$belumlunas->uuid}}/edit" class="btn btn-secondary badge bg-warning">Belum Lunas</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- End Recent Sales -->

            <!-- Lunas Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Pembayaran Lunas <span>| {{ $bulanapa }}</span></h5>

                  <table class="table table-hover datatable">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Tagihan</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($sudahlunass))
                          @if($sudahlunass->count())
                              @foreach($sudahlunass as $sudahlunas)
                                  <tr>
                                      <td>{{ $sudahlunas->dataWarga->nama }}</td>
                                      <td>{{ $sudahlunas->totalbayar }}</td>
                                      <td><a href="{{ route('resi',['uuid' => $sudahlunas->uuid]) }}" class="btn btn-success badge bg-success">Lunas</a></td>
                                  </tr>
                              @endforeach
                          @endif
                      @endif
                  </tbody>
                  </table>
                </div>
              </div>
            </div><!-- End Recent Sales -->

            

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection