<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo site_url(); ?>" class="brand-link">
        <!-- <img src="<?php echo base_url('assets/dist/img/boxed-bg.jpg'); ?>" alt="<?php echo $this->config->item('site_name'); ?>" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light"><?php echo $this->config->item('site_name'); ?></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <span class="fas fa-user-circle img-circle elevation-2 text-white" style="font-size: 2.1rem; opacity: .8"></span>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->auth_lib->pengguna()->nama_pengguna; ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('laporan'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Absen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('absen/masuk'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absen Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('absen/keluar'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absen Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('absen'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Absen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('pesanan'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Pesanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('pegawai'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('gaji'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Gaji</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('pengguna'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
