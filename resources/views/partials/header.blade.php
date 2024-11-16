<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center p-0" >

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn" ></i>
      <a href="/" class="logo d-flex align-items-center">
        <img src="assets/img/sitoya.png" alt="" >
        {{-- <span class="d-none d-lg-block">SITOYA</span> --}}
      </a>
      
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block  ps-2">{{ auth()->user()->username }}</span>
          </a><!-- End Profile Iamge Icon -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->