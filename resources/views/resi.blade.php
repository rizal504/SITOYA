@extends('layout.main')

@section('container')

  <main id="main" class="main">

    <section class="section profile">
        <div class="row animate__animated animate__fadeInUp">
            <div class="col-lg-12">
              
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ $success}} 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              
              <div class="card">
                <div class="card-body">
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Bukti Pembayaran</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                      <div class="col-lg-9 col-md-8">{{ $nama->nama }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Debit Awal</div>
                      <div class="col-lg-9 col-md-8">{{ $debitawal }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Debit Akhir</div>
                      <div class="col-lg-9 col-md-8">{{ $debitAkhir }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Total Debit</div>
                      <div class="col-lg-9 col-md-8">{{ $totalDebit }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Tagihan</div>
                      <div class="col-lg-9 col-md-8">{{ $tagihan }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Terbayar</div>
                      <div class="col-lg-9 col-md-8">{{ $terbayar }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Kembalian</div>
                      <div class="col-lg-9 col-md-8">{{ $kembalian }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Status</div>
                      <div class="col-lg-9 col-md-8"><span> {{ $status }}</span></div>
                    </div>
                    <div class="row">
                      <button type="submit" class="btn btn-warning">Print</button>
                    </div>
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