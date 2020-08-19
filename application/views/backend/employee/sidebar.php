<?php
    $this->db->from('employee');
    $this->db->where('nik', $this->session->userdata('login_nik'));
    $query = $this->db->get();
    $row = $query->row();
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('humancapital/dashboard'); ?>" class="brand-link">
        <center><img src="<?php echo base_url();?>assets/login/img/logo_white.png" alt="JNE" style="opacity: .8" width="30%"></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="margin-top: 0px; margin-bottom: 0px;">
                <img src="<?php echo $this->get_model->get_image_url('employee', $this->session->userdata('login_nik')); ?>" alt="User Image" class="img-circle">
            </div>
            <div class="info" style="margin-top: -5px; margin-bottom: 0px;">
                <a href="<?php echo site_url('employee/profile/myprofile'); ?>" class="d-block"><?php echo $row->employee_name; ?></a>
                <a><small>EMPLOYEE</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                            <i class="right fas fa-angle-left"></i>
                            <?php 
                                $this->db->from('employee_update');
                                $this->db->where('update_status', 'Waiting for Approval');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $update = $this->db->get();
                                $emp = $update->num_rows(); 
                                
                                if ($emp > 0) { 
                                    ?>
                                    <span class="badge badge-info right"><?php echo $emp; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/profile/myprofile'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/profile/update_list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request Update</p>
                                <?php if ($emp > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $emp; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php 
                    $kar = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row(); 
                    if($kar->employee_status == 'FREELANCE'){
                ?>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/freelance_attendance_report'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-fingerprint"></i>
                                <p>Freelance Attendance</p>
                            </a>
                        </li>
                <?php } ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>
                            Claim
                            <i class="right fas fa-angle-left"></i>
                            <?php 
                                $this->db->from('rawatinap');
                                $this->db->where('rawatinap_status', 'Waiting for Approval');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $inap = $this->db->get();
                                $rawatinap = $inap->num_rows();

                                $this->db->from('rawatjalan');
                                $this->db->where('rawatjalan_status', 'Waiting for Approval');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $jalan = $this->db->get();
                                $rawatjalan = $jalan->num_rows();

                                $this->db->from('melahirkan');
                                $this->db->where('melahirkan_status', 'Waiting for Approval');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $lahir = $this->db->get();
                                $melahirkan = $lahir->num_rows();

                                $this->db->from('kacamata');
                                $this->db->where('kacamata_status', 'Waiting for Approval');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $kc = $this->db->get();
                                $kacamata = $kc->num_rows();
                                
                                $claim = $rawatinap + $rawatjalan + $melahirkan + $kacamata;
                                
                                if ($claim > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $claim; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/rawatinap/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rawat Inap</p>
                                <?php if ($rawatinap > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $rawatinap; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/rawatjalan/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rawat Jalan</p>
                                <?php if ($rawatjalan > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $rawatjalan; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/melahirkan/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Melahirkan</p>
                                <?php if ($melahirkan > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $melahirkan; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/kacamata/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kacamata</p>
                                <?php if ($kacamata > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $kacamata; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if($kar->employee_status == 'TETAP' || $kar->employee_status == 'PKWT1' || $kar->employee_status == 'PKWT2'){ ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url('employee/loan/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Peminjaman</p>
                            <?php 
                                $this->db->from('loan_detail');
                                $this->db->where('dtloan_status !=', 'Unpaid');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $dtloan = $this->db->get();

                                $loan = $dtloan->num_rows(); 

                                if ($loan > 0) { 
                            ?>
                                <span class="badge badge-info right"><?php echo $loan; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/uniform/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>Seragam</p>
                        <?php 
                            $this->db->from('uniform_request');
                            $this->db->where('uniformrequest_status', 'Waiting for Approval');
                            $this->db->where('nik', $this->session->userdata('login_nik'));
                            $uni = $this->db->get();

                            $uniform = $uni->num_rows(); 

                            if ($uniform > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php echo $uniform; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>
                            Surat
                            <i class="right fas fa-angle-left"></i>
                            <?php 
                                $this->db->from('teguran');
                                $this->db->where('teguran_enddate >=', date('Y-m-d'));
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $teguran = $this->db->get();                                
                                $letter1 = $teguran->num_rows(); 

                                $this->db->from('panggilan');
                                $this->db->where('panggilan_date', date('Y-m-d'));
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $panggilan = $this->db->get();
                                $letter2 = $panggilan->num_rows(); 
                                
                                $letter = $letter1 + $letter2;
                                
                                if ($letter > 0) { 
                                    ?>
                                    <span class="badge badge-info right"><?php echo $letter; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/teguran/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Teguran</p>
                                <?php if ($letter1 > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $letter1; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/panggilan/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Panggilan</p>
                                <?php if ($letter2 > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $letter2; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Job Posting
                            <i class="right fas fa-angle-left"></i>
                            <?php 
                                $this->db->from('vacancy');
                                $this->db->where('vacancy_lastdate <=', date('Y-m-d'));
                                $this->db->where('user_type', 'EMPLOYEE');
                                $vac = $this->db->get();                                
                                $job = $vac->num_rows(); 

                                $this->db->from('application');
                                $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                $this->db->where('application_status !=', 'Declined');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $app = $this->db->get();                                
                                $application = $app->num_rows(); 
                                
                                $vacancy = $job + $application;
                                
                                if ($vacancy > 0) { 
                                    ?>
                                    <span class="badge badge-info right"><?php echo $vacancy; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/vacancy/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Job Posting</p>
                                <?php if ($job > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $job; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('employee/application/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status Lamaran</p>
                                <?php if ($application > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $application; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/class/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>E-Learning</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/exam/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>Test Online</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/survey/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>E-Survey</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/egdattendance/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-qrcode"></i>
                        <p>EGD Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/resign/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-minus"></i>
                        <p>Resign</p>
                        <?php 
                            $this->db->from('resign');
                            $this->db->where('resign_status', 'Waiting for SPV Approval');
                            $this->db->where('resign_status', 'SPV Approved');
                            $this->db->where('nik', $this->session->userdata('login_nik'));
                            $res = $this->db->get();

                            $resign = $res->num_rows(); 

                            if ($resign > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php echo $resign; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('employee/speakup/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>Speak Up Corner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('employee/change_password'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Ganti Password</p>
                        </a>
                    </li>
                </li>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
</aside>