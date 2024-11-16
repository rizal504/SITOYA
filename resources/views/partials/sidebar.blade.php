

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="/">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
    
    @can('penarikan_tagihan')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/inputdata*') ? '' : 'collapsed' }}" href="/dashboard/inputdata">
          <i class="bi bi-journal-text"></i><span>Penarikan Tagihan</span>
        </a>
      </li><!-- End Forms Nav -->
    @endcan

    @can('laporan_tagihan')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/laporan*') ? '' : 'collapsed' }}" href="/dashboard/laporan">
          <i class="bi bi-layout-text-window-reverse"></i><span>Laporan Tagihan</span>
        </a>
      </li><!-- End Forms Nav -->
    @endcan

    @can('keuangan')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/keuangan*') ? '' : 'collapsed' }}" href="/dashboard/keuangan">
          <i class="bi bi-cash-coin"></i><span>Keuangan</span>
        </a>
    </li><!-- End Forms Nav -->
    @endcan
    
    <li class="nav-link collapsed">
      <form action="/logout" method="post">
        @csrf
        {{-- <a class="dropdown-item d-flex align-items-center" href="#">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sign Out</span>
        </a> --}}
        <button type="submit" class="dropdown-item text-danger ">
          <i class="bi bi-box-arrow-right text-danger"></i>Logout
        </button>
      </form>
    </li><!-- End Forms Nav -->
  </ul>

</aside><!-- End Sidebar-->