@extends('layout.main')

@section('container')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card m-3">

              

              <div class="card-body">
                <h5 class="card-title">Saldo</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Rp. {{ number_format($saldo, 0, ',', '.') }}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card m-3">


              <div class="card-body">
                <h5 class="card-title">Pemasukan<span> | Bulan ini</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-clipboard-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Rp. {{ number_format($pemasukanBulanan, 0, ',', '.') }}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card m-3">

              <div class="card-body">
                <h5 class="card-title">Pengeluaran<span> | Bulan ini</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-clipboard-x"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Rp. {{ number_format($pengeluaranBulanan, 0, ',', '.') }}</h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <!-- Reports -->
          
        </div>
      </div><!-- End Left side columns -->
  </section>

</main><!-- End #main -->
@endsection
