
  <!-- Navbar -->
  <style>
    .main-header{
      position: relative;
    }
    </style>
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="../assets/dist/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-4" style="opacity: .9">
        <span class="brand-text font-weight-light"><b>Laundry Seribu Bunga</b></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <?php if($_SESSION['role']=="admin"){  ?>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Master</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="Outlet.php" class="dropdown-item">Data Outlet </a></li>
              <li><a href="Paket.php" class="dropdown-item">Data Paket</a></li>
              <li><a href="Pengguna.php" class="dropdown-item">Data Pengguna</a></li>
               </ul>
               </li>
          
           <li class="nav-item">
            <a href="Pelanggan.php" class="nav-link">Registrasi Pelanggan</a>
          </li> 
          <li class="nav-item">
            <a href="Transaksi.php" class="nav-link">Entri Transaksi</a>
          </li> 
          <li class="nav-item">
            <a href="Laporan.php" class="nav-link">Laporan</a>
          </li>
          <?php } ?>

          <?php if($_SESSION['role']=="kasir"){  ?>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
           <li class="nav-item">
            <a href="Pelanggan.php" class="nav-link">Registrasi Pelanggan</a>
          </li> 
          <li class="nav-item">
            <a href="Transaksi.php" class="nav-link">Entri Transaksi</a>
          </li> 
          <li class="nav-item">
            <a href="Laporan.php" class="nav-link">Laporan</a>
          </li>
          <?php } ?>

          <?php if($_SESSION['role']=="kasirsatu"){  ?>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
           <li class="nav-item">
            <a href="Pelanggan.php" class="nav-link">Registrasi Pelanggan</a>
          </li> 
          <li class="nav-item">
            <a href="Transaksi.php" class="nav-link">Entri Transaksi</a>
          </li> 
          <li class="nav-item">
            <a href="Laporan.php" class="nav-link">Laporan</a>
          </li>
          <?php } ?>

          <?php if($_SESSION['role']=="owner"){  ?>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="Laporan.php" class="nav-link">Laporan</a>
          </li>
          <!-- <li class="nav-item">
            <a href="grafik.php" class="nav-link">Grafik</a>
          </li> -->
          <?php } ?>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">
            <i class="fas fa-user"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>