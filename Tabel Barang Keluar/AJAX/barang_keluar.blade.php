<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Centra Moda Textile - @yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    @yield('css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="http://127.0.0.1:8000/admins"><img src="../assets/images/cm.png" alt="logo" style="height: auto; width: 13rem; margin-top: 3rem;"/></a>
          <a class="navbar-brand brand-logo-mini" href="http://127.0.0.1:8000/admins"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">            
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>            
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">David Greymaax</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <br><br>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/admins">
                <span class="menu-title">Admin</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/suppliers">
                <span class="menu-title">Supplier</span>
                <i class="mdi mdi-factory menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/pegawais">
                <span class="menu-title">Pegawai</span>
                <i class="mdi mdi-face menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/jenis_barangs">
                <span class="menu-title">Jenis Barang</span>
                <i class="mdi mdi-nfc-variant menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/barangs">
                <span class="menu-title">Barang</span>
                <i class="mdi mdi-package-variant-closed menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/barang_masuks">
                <span class="menu-title">Barang Masuk</span>
                <i class="mdi mdi mdi-import menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://127.0.0.1:8000/barang_keluars">
                <span class="menu-title">Barang Keluar</span>
                <i class="mdi mdi-cart menu-icon"></i>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          @yield('content')
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../partials/_footer.html -->
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    @yield('js')
  </body>
</html>