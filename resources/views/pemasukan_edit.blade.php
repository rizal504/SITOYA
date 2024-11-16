@extends('layout.main')

@section('container')
<main id="main" class="main">
    <section class="section">
      <div class="row animate__animated animate__fadeInUp">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formulir Edit Data Bulanan</h5>
              
              <!-- Multi Columns Form -->
              <form class="row g-3" action="/dashboard/keuangan/{{ $keuangan->uuid }}" method="POST">
                @method('put')
                @csrf
                <div class="col-md-6">
                  <label for="kategori" class="form-label">Kategori</label>
                  <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror" >
                    <option value="pemasukan" {{ $keuangan->kategori == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ $keuangan->kategori == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                  </select>
                  @error('kategori')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ $keuangan->tanggal }}">
                  @error('tanggal')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ $keuangan->keterangan }}">
                  @error('keterangan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="nominal" class="form-label"> Nominal Uang</label>
                  <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ is_null($keuangan->pemasukan) ?  $keuangan->pengeluaran : $keuangan->pemasukan }}">
                  @error('nominal')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="text-center">
                  <a href="/dashboard/keuangan"><button type="button" class="btn btn-warning">Batal</button></a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form><!-- End Multi Columns Form -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection