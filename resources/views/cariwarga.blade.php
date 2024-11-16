@extends('layout.main')
@section('container')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Penarikan Tagihan</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formulir Tagihan</h5>
              <!-- Multi Columns Form -->
              <form class="row g-3" id="searchForm" action="/dashboard/inputdata">
                <div class="col-md-12">
                  <label for="search" class="form-label">Nama Pengguna</label>
                  <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">  
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" >Cari Pengguna</button>
                </div>
              </form>
              <!-- Tabel untuk menampilkan hasil pencarian -->
              @if(isset($wargas))
                @if($wargas->count())
                  <table class="table table-hover" style="margin-top: 30px;">
                    <thead>
                      <tr>
                        <th style="width: 40%;">Nama</th>
                        <th style="width: 40%;">Alamat</th>
                        <th style="width: 20%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($wargas as $warga)
                        <tr>
                          <td>{{ $warga->nama }}</td>
                          <td>{{ $warga->alamat }}</td>
                          <td>
                            <form action="/dashboard/inputdata/inputmeteran/create">
                              {{-- action="/listklinik/{{$clinicList->id}} --}}
                                <input type="hidden" name="warga_id" value="{{ $warga->id }}">
                                <input type="hidden" name="nama_cari" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-secondary">Lihat Detail</button>
                            </form>
                          </td>
                        </tr>
                      <!-- Tambahkan baris lain sesuai kebutuhan -->
                      @endforeach
                    </tbody>
                  </table>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection
