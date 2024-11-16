@extends('layout.main')

@section('container')

  <main id="main" class="main">

    <section class="section profile">
        <div class="row animate__animated animate__fadeInUp">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Bukti Lunas</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->dataWarga->nama }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Debit Awal</div>
                      <div class="col-lg-9 col-md-8">{{ $debit_awal }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Debit Akhir</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->kondisimeteran }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Total Debit</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->totalpemakaian }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Tagihan</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->totalbayar }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Terbayar</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->bayar }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Tanggal Tagihan Dibuat</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->created_at->format('d-m-Y') }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Tanggal Lunas</div>
                      <div class="col-lg-9 col-md-8">{{ $resi->updated_at->format('d-m-Y') }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Status</div>
                      <div class="col-lg-9 col-md-8"><span> Lunas</span></div>
                    </div>
                    
                      {{-- <button type="submit" class="btn btn-warning">Print</button> --}}
                      <form class="row" action="{{ route('buktilunas',['uuid' => $resi->uuid]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning"><i class="bi bi-filetype-pdf"></i>Cetak PDF</button>
                      </form>
                    
                    <div class="row">
                      <a href="/dashboard/inputdata?success=Data+telah+ditambahkan" class="btn btn-success">Selesai</a>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </section>

  </main><!-- End #main -->

  @endsection