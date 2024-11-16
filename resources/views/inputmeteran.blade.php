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
              <form class="row g-3" action="/dashboard/inputdata/inputmeteran" method="POST">
                @csrf
                <input type="hidden" name="warga_id" value="{{ $warga->dataWarga->uuid }}">
                <div class="col-md-12">
                  <label for="namawarga" class="form-label">Nama Pengguna</label>
                  <input type="text" class="form-control bg-body-secondary @error('namawarga') is-invalid @enderror" id="namawarga" name="namawarga" value="{{ $warga->dataWarga->nama }} - {{ $warga->dataWarga->alamat }}" readonly>
                  @error('namawarga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="debitawal" class="form-label">Debit Awal</label>
                  <input type="number" class="form-control bg-body-secondary @error('debitawal') is-invalid @enderror" name="debitawal" id="debitawal" value="{{ $warga->kondisimeteran }}" readonly>
                  @error('debitawal')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="kondisimeteran" class="form-label">Debit Sekarang</label>
                  <input type="text" class="form-control @error('kondisimeteran') is-invalid @enderror" name="kondisimeteran" id="kondisimeteran" oninput="hitungTotal()" value="{{ old('kondisimeteran') }}">
                  @error('kondisimeteran')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="totalpemakaian" class="form-label">Total Debit</label>
                  <input type="number" class="form-control bg-body-secondary @error('totalpemakaian') is-invalid @enderror"" name="totalpemakaian" id="totalpemakaian" readonly>
                  @error('totalpemakaian')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="totalbayar" class="form-label">Tagihan</label>
                  <input type="number" class="form-control bg-body-secondary @error('totalbayar') is-invalid @enderror"" id="totalbayar" name="totalbayar" readonly>
                  @error('totalbayar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
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
                  <input type="number" class="form-control bg-body-secondary @error('kembalian') is-invalid @enderror"" name="kembalian" id="kembalian" readonly>
                  @error('kembalian')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
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
                <div class="text-center" id="batal">
                  <a href="/dashboard/inputdata?search={{ $nama_cari }}"><button type="button" class="btn btn-warning">Batal</button></a>
                  <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
                <script>
                  function hitungTotal() {
                      var debitAwal = parseFloat(document.getElementById('debitawal').value);
                      var debitSekarang = parseFloat(document.getElementById('kondisimeteran').value);

                      var alamat = {!! json_encode($warga->dataWarga->alamat) !!};
                      var hargaPerdebit = 1500;

                      if (!isNaN(debitAwal) && !isNaN(debitSekarang)) {
                        if(alamat == "nggludang"){
                          hargaPerdebit = 2000;
                        }
                          var totalDebit = debitSekarang - debitAwal;
                          var tagihan = totalDebit * hargaPerdebit;
              
                          document.getElementById('totalpemakaian').value = totalDebit.toFixed(2);
                          document.getElementById('totalbayar').value = tagihan.toFixed(2);
                      }
                  } 
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