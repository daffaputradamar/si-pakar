<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION['login']; ?> </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- <li class="nav-item">
            <a href="datauser.php" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p> Data User </p>
            </a>
          </li> -->
            <li class="nav-item">
                <a href="gejalapenyakit.php" class="nav-link">
                    <i class="fas fa-head-side-cough nav-icon"></i>
                    <p> Gejala Penyakit </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="datapenyakit.php" class="nav-link">
                    <i class="fas fa-disease nav-icon"></i>
                    <p> Data Penyakit </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="kategorigejala.php" class="nav-link">
                    <i class="nav-icon far fa-object-group"></i>
                    <p>
                        Kategori Gejala
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="bobot.php" class="nav-link">
                    <i class="fas fa-balance-scale nav-icon"></i>
                    <p> Bobot </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="perhitungancf.php" class="nav-link">
                    <i class="nav-icon fas fa-square-root-alt"></i>
                    <p>
                        Perhitungan CF & Fuzzy
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->