<aside class="left-sidebar" style="background-color: #ffff ">
    <div class="scroll-sidebar" style="background-color: #ffff ">
        <nav class="sidebar-nav" style="background-color: #ffff ">
            <ul id="sidebarnav" style="background-color: #ffff ">
                <li class="sidebar-item mt-3">
                    <a href="<?php echo base_url('dashboard')?>"
                        class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i
                            data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item mt-3">
                    <a href="<?php echo base_url('data_jamaah')?>"
                        class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i
                        data-feather="users" class="feather-icon"></i><span class="hide-menu">Data Jama'ah</span></a>
                </li>
                <li class="sidebar-item mt-3">
                    <a href="<?php echo base_url('daftar_kegiatan')?>"
                        class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i
                            data-feather="home" class="feather-icon"></i><span class="hide-menu">Daftar Kegiatan</span></a>
                </li>
                <li class="sidebar-item mt-3">
                    <a href="<?php echo base_url('data_masjid')?>"
                        class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i
                            data-feather="credit-card" class="feather-icon"></i><span class="hide-menu">Data Masjid</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            data-feather="clipboard" class="feather-icon"></i><span class="hide-menu">Absensi
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url('absenss')?>" class="sidebar-link"><i
                                    data-feather="disc"></i><span class="hide-menu">
                                    Data Absensi
                                </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url('absenss/input_absensi')?>" class="sidebar-link"><i
                                    data-feather="disc"></i><span class="hide-menu">
                                    Input Absensi
                                </span></a>
                        </li>
                       
                    </ul>
                </li>
                <li class="sidebar-item mt-3">
                    <a href="<?php echo base_url('tanggapan')?>"
                        class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i
                            data-feather="credit-card" class="feather-icon"></i><span class="hide-menu">Saran & Tanggapan</span></a>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            data-feather="user" class="feather-icon"></i><span class="hide-menu">Pengaturan
                            Akun</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url('akun')?>" class="sidebar-link"><i data-feather="disc"
                                    class="mdi mdi-view-quit"></i><span class="hide-menu"> Akun
                                </span></a>
                        </li>
                      
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="<?php echo base_url('auth/logout')?>" aria-expanded="false"><i data-feather="log-out"
                            class="feather-icon"></i><span class="hide-menu">Log Out</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>