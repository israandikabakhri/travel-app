<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title_bar')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @yield('css')
    <!-- endinject -->
    <link rel="shortcut icon" href='{{ asset("assets/images/icon.jpeg") }}' />

    <style type="text/css">
      .btn{
        color:white;
      }
    </style>

  </head>
  <body>
    <div class="container-scroller">

      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo me-5" href="{{ url('/') }}"><img src='{{ asset("assets/images/logo.svg") }}' class='me-2' alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src='{{ asset("assets/images/logo-mini.svg") }}' alt='logo' /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src='{{ asset("assets/images/icon.jpeg") }}' alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ url('/logout') }}">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
 

          <ul class="nav">
            
            @if (Auth::check() && Auth::user()->role == 'admin')
            
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}/admin/home">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}/admin/pemesanan">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Konfirmasi Pembayaran</span>
              </a>
            </li>
            
            @elseif (Auth::check() && Auth::user()->role == 'penumpang')
            
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}/penumpang/home">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}/penumpang/riwayat">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Riwayat Pemesanan</span>
              </a>
            </li>
            
            @endif
            
          </ul>
        </nav>


        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            @yield("content")

          </div>
          <!-- content-wrapper ends -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025. Travel App.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">PT Jasamedika Saranatama <i class="ti-heart text-danger ms-1"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src='{{ asset("assets/vendors/js/vendor.bundle.base.js") }}'></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src='{{ asset("assets/vendors/typeahead.js/typeahead.bundle.min.js") }}'></script>
    <script src='{{ asset("assets/vendors/select2/select2.min.js") }}'></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src='{{ asset("assets/js/off-canvas.js") }}'></script>
    <script src='{{ asset("assets/js/template.js") }}'></script>
    <script src='{{ asset("assets/js/settings.js") }}'></script>
    <script src='{{ asset("assets/js/todolist.js") }}'></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src='{{ asset("assets/js/file-upload.js") }}'></script>
    <script src='{{ asset("assets/js/typeahead.js") }}'></script>
    <script src='{{ asset("assets/js/select2.js") }}'></script>
    <!-- End custom js for this page-->

    @yield("js")

        
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
      function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengklik tombol "Ya", kirimkan formulir
                document.getElementById('delete-form-' + id).submit();
              }
        });
    }

    function confirmPilihIni(id) {
        Swal.fire({
            title: 'Mau Travel ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Pilih!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengklik tombol "Ya", kirimkan formulir
                document.getElementById('pilih-form-' + id).submit();
              }
        });
    }


    function confirmPembayaran(id) {
        Swal.fire({
            title: 'Apakah Yakin Konfirmasi Pembayaran Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Konfirmasi!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengklik tombol "Ya", kirimkan formulir
                document.getElementById('konfirmasi-form-' + id).submit();
              }
        });
    }
    </script>

  </body>
</html>