                <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                    <div class="mdk-drawer__content">
                        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>


                            <div class="sidebar-block p-0 m-0">
                                <div class="d-flex align-items-center sidebar-p-a border-bottom bg-light">
                                    <a href="#" class="flex d-flex align-items-center text-body text-underline-0">
                                        <span class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-soft-secondary text-muted">AD</span>
                                        </span>
                                        <span class="flex d-flex flex-column">
                                            <strong><?=$this->session->userdata('username')?></strong>
                                            <small class="text-muted text-uppercase"><?=$this->session->userdata('level')?></small>
                                        </span>
                                    </a>
                                    <div class="dropdown ml-auto">
                                        <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="student-dashboard.html">Dashboard</a>
                                            <a class="dropdown-item" href="student-profile.html">My profile</a>
                                            <a class="dropdown-item" href="student-edit-account.html">Edit account</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" rel="nofollow" data-method="delete" href="login.html">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-block p-0">

                                <div class="sidebar-heading">navigation</div>


                                <ul class="sidebar-menu mt-0">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button" href="<?=site_url()?>">
                                            <span class="material-icons">dashboard</span>
                                            <span class="sidebar-menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <?php if($this->session->userdata('level')=="Administrator"):?>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('admin/mahasiswa')?>">
                                                <span class="material-icons">people</span>
                                                <span class="sidebar-menu-text">Mahasiswa</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('admin/soal')?>">
                                                <span class="material-icons">event_note</span>
                                                <span class="sidebar-menu-text">Soal</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('admin/prodi')?>">
                                                <span class="material-icons">event_note</span>
                                                <span class="sidebar-menu-text">Prodi</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('admin/cat_soal')?>">
                                                <span class="material-icons">event_note</span>
                                                <span class="sidebar-menu-text">Kategori Soal</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('admin/laporan')?>">
                                                <span class="material-icons">event_note</span>
                                                <span class="sidebar-menu-text">Laporan</span>
                                            </a>
                                        </li>
                                    <?php elseif($this->session->userdata('level')=="Mahasiswa"): ?>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('user/ujian')?>">
                                                <span class="material-icons">people</span>
                                                <span class="sidebar-menu-text">Ujian</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button" href="<?=site_url('user/result')?>">
                                                <span class="material-icons">event_note</span>
                                                <span class="sidebar-menu-text">Hasil Ujian</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                
                            </div>

                        </div>
                    </div>
                </div>