@extends('layout.main')
@section('container')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formulir Tagihan</h5>
              <!-- Multi Columns Form -->
              <form class="row g-3" action="/dashboard/laporan/{{ $warga->uuid }}" method="POST">
                @method('put')
                @csrf
                
                <div class="col-md-12">
                  <label for="namawarga" class="form-label">Nama Pengguna</label>
                  <input type="text" class="form-control bg-body-secondary" id="namawarga" name="namawarga" value="{{ $warga->dataWarga->nama }} - {{ $warga->dataWarga->alamat }}" readonly>
                </div>
                <div class="col-md-12">
                  <label for="tanggal" class="form-label">Tanggal Tagihan</label>
                  <input type="text" class="form-control bg-body-secondary" id="tanggal" name="tanggal" value="{{ $warga->created_at->format('Y-m-d') }}" readonly>
                </div>
                <div class="col-md-6">
                  <label for="totalpemakaian" class="form-label">Total Debit</label>
                  <input type="number" class="form-control bg-body-secondary" name="totalpemakaian" id="totalpemakaian" value="{{ $warga->totalpemakaian }}" readonly>
                </div>
                <div class="col-md-6">
                  <label for="totalbayar" class="form-label">Tagihan</label>
                  <input type="number" class="form-control bg-body-secondary" id="totalbayar" name="totalbayar" value="{{$warga->kurang}}" readonly>
                </div>
                <div class="col-md-6">
                  <label for="bayar" class="form-label">Pembayaran</label>
                  <input type="text" class="form-control @error('bayar') is-invalid @enderror" id="bayar" name="bayar" oninput="kembalianTotal()" value="{{ old('bayar') }}">
                  @error('bayar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="kembalian" class="form-label justify-content-center">Uang Kembalian</label>
                  <input type="number" class="form-control bg-body-secondary" name="kembalian" id="kembalian" readonly>
                </div>
                <div class="col-md-8">
                  <div id="errorPembayaran" style="display: none;"></div>
                </div>
                {{-- <div class="col-md-4">
                  <label for="inputState" class="form-label">Keterangan</label>
                  <select id="inputState" class="form-select">
                    <option selected>Lunas</option>
                    <option>Belum Lunas</option>
                  </select>
                </div> --}}
                <div class="text-center" id="simpanButton">
                  <a href="/dashboard/laporan"><button type="button" class="btn btn-warning">Batal</button></a>
                  <button type="submit" class="btn btn-primary">Bayar</button>
                </div>

                <script>
                  function kembalianTotal(){
                    var pembayaran = parseFloat(document.getElementById('bayar').value);
                    var tagihan = parseFloat(document.getElementById('totalbayar').value);

                    console.log('Pembayaran:', pembayaran);
                    console.log('Tagihan:', tagihan);

                    if (!isNaN(pembayaran) && !isNaN(tagihan)) {
                        var uangkembalian = pembayaran - tagihan;
                        if(uangkembalian<0){
                          document.getElementById('kembalian').value = 0;
                        }else{
                          document.getElementById('kembalian').value = uangkembalian.toFixed(2);
                        }
                        
                    }
                  }
                </script>
              </form><!-- End Multi Columns Form -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection