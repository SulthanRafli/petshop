<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo base_url('C_home/dashboard_v3') ?>" class="brand-link">
        <img src="<?php echo base_url('assets/') ?>dist/img/logo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: 0.8; margin-left: 0px; margin-right: 7px" />
        <span class="brand-text font-weight-light" style="font-size: 1rem; vertical-align: text-top;">Sistem Prediksi Petshop</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/') ?>dist/img/profile.png" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('nama') ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo base_url('C_home') ?>" class="nav-link <?= $page === 'dashboard/dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('C_crud/list_login') ?>" class="nav-link <?= strpos($page, 'login') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Master Login</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('C_crud/list_barang') ?>" class="nav-link <?= strpos($page, 'barang') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Master Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('C_crud/list_penjualan') ?>" class="nav-link <?= strpos($page, 'penjualan') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Master Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('C_crud/list_prediksi') ?>" class="nav-link <?= $page === 'crud/list_prediksi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Hasil Prediksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('C_crud/add_prediksi') ?>" class="nav-link <?= $page === 'crud/add_prediksi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>Hitung Prediksi</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>