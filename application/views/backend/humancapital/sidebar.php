<?php
    $this->db->from('user');
    $this->db->join('employee', 'user.nik = employee.nik');
    $this->db->where('user.nik', $this->session->userdata('login_nik'));
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
            <div class="info" style="margin-top: -10px; margin-bottom: 0px;">
                <a class="d-block" style="margin-bottom: -5px;"><?php echo $row->employee_name; ?></a>
                <a class="d-block" ><small>HUMAN CAPITAL</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('humancapital/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/section/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/unit/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/regional/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regional</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/branch/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Branch</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/origin/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Origin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/zone/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Zone</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">TALENT ACQUISTION</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Employee
                            <i class="fas fa-angle-left right"></i>
                            <?php 
                                $this->db->from('employee');
                                $this->db->where("DATE_FORMAT(employee_join,'%Y-%m')", date('Y-m'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $emp = $this->db->get();
                                $new = $emp->num_rows();

                                $this->db->from('employee_update');
                                $this->db->join('employee', 'employee.nik = employee_update.nik');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $this->db->where('update_status', 'Waiting for Approval');
                                $upt = $this->db->get();
                                $update = $upt->num_rows();;

                                $notifemp =  $new + $update;

                                if ($notifemp > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $notifemp; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/employee/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                                <?php if ($new > 0) { ?>
                                    <span class="badge badge-danger right"><?php echo 'NEW ' . $new; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/employee/update_list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Request</p>
                                <?php if ($update > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $update; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>
                            SPK
                            <i class="fas fa-angle-left right"></i>
                            <?php 
                                $expired = 0;
                                $this->db->from('employee');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                                foreach ($sql->result_array() as $row):
                                    $this->db->from('spk');
                                    $this->db->where('nik', $row['nik']);
                                    $this->db->order_by('spk_enddate', 'DESC');
                                    $this->db->limit(1);
                                    $spk = $this->db->get();

                                    if($spk->num_rows() > 0){
                                        if(date('Y-m-d') > $spk->row()->spk_enddate) {
                                            $expired++;
                                        }
                                    }
                                endforeach;

                                $expired2 = 0;
                                $this->db->from('employee');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $sql2 = $this->db->get();
                                foreach ($sql2->result_array() as $row):
                                    $this->db->from('spk');
                                    $this->db->where('nik', $row['nik']);
                                    $this->db->order_by('spk_enddate', 'DESC');
                                    $this->db->limit(1);
                                    $spk2 = $this->db->get();

                                    if($spk2->num_rows() > 0){
                                        if(date('Y-m-d') <= $spk2->row()->spk_enddate) {
                                            if(date($spk2->row()->spk_enddate) <= date('Y-m-d',strtotime('+30 days'))) {
                                                $expired2++;
                                            }
                                        }
                                    }
                                endforeach;

                                $notifspk = $expired + $expired2;

                                if ($notifspk > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $notifspk; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/spk/soon'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SPK Expiring Soon</p>
                                <?php if ($expired2 > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $expired2; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/spk/expired'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expired SPK</p>
                                <?php if ($expired > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $expired; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Recruitment
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/vacancy/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vacancies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/recruitment_schedule/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Schedule</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php //echo site_url('humancapital/mpp/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>MPP</p>
                            <?php 
                                // $mpp = $this->db->get_where('mpp', array('mpp_status' => 'Waiting for Approval'))->num_rows();
                                // if ($mpp > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php // echo $mpp; ?></span>
                            <?php // } ?>
                        </a>
                    </li>
                </li> -->
                <!-- <li class="nav-item">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-area"></i>
                            <p>Productivity</p>
                        </a>
                    </li>
                </li> -->
                <?php 
                    $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->employee_position;
                    if (strpos($usercek, 'COMPENSATION & BENEFIT') !== FALSE) { 
                ?>
                    <li class="nav-header">COMBEN</li>
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/freelance_attendance_report'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>Freelance Report</p>
                            </a>
                        </li>
                    </li>
                    <!-- <li class="nav-item">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>UMT</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Picket</p>
                            </a>
                        </li>
                    </li> -->
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="<?php echo site_url('humancapital/plafon/list'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>Plafon</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clinic-medical"></i>
                            <p>
                                Claim
                                <i class="right fas fa-angle-left"></i>
                                <?php 
                                    $this->db->from('rawatinap');
                                    $this->db->join('employee', 'rawatinap.nik = employee.nik');
                                    $this->db->where('rawatinap_status', 'Waiting for Approval');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $inap = $this->db->get();
                                    $rawatinap = $inap->num_rows();

                                    $this->db->from('rawatjalan');
                                    $this->db->join('employee', 'rawatjalan.nik = employee.nik');
                                    $this->db->where('rawatjalan_status', 'Waiting for Approval');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $jalan = $this->db->get();
                                    $rawatjalan = $jalan->num_rows();

                                    $this->db->from('melahirkan');
                                    $this->db->join('employee', 'melahirkan.nik = employee.nik');
                                    $this->db->where('melahirkan_status', 'Waiting for Approval');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $lahir = $this->db->get();
                                    $melahirkan = $lahir->num_rows();

                                    $this->db->from('kacamata');
                                    $this->db->join('employee', 'kacamata.nik = employee.nik');
                                    $this->db->where('kacamata_status', 'Waiting for Approval');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
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
                                <a href="<?php echo site_url('humancapital/rawatinap/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rawat Inap</p>
                                    <?php if ($rawatinap > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $rawatinap; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/rawatjalan/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rawat Jalan</p>
                                    <?php if ($rawatjalan > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $rawatjalan; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/melahirkan/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Melahirkan</p>
                                    <?php if ($melahirkan > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $melahirkan; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/kacamata/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kacamata</p>
                                    <?php if ($kacamata > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $kacamata; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>
                                Loan
                                <i class="fas fa-angle-left right"></i>
                                <?php 
                                    $this->db->from('loan');
                                    $this->db->join('employee', 'loan.nik = employee.nik');
                                    $this->db->where('loan_status', 'SPV Approved');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $ln = $this->db->get();
                                    $loan = $ln->num_rows();

                                    if ($loan > 0) { 
                                ?>
                                        <span class="badge badge-info right"><?php echo $loan; ?></span>
                                <?php } ?>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/loan/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Request</p>
                                    <?php if ($loan > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $loan; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/loan/history'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>History</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-header">IERD</li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/rotation'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-sync"></i>
                            <p>Rotation</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-minus"></i>
                            <p>
                                Resign
                                <i class="fas fa-angle-left right"></i>
                                <?php 
                                    $this->db->from('resign');
                                    $this->db->join('employee', 'resign.nik = employee.nik');
                                    $this->db->where('resign_status', 'SPV Approved');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $res = $this->db->get();
                                    $resign = $res->num_rows();

                                    if ($resign > 0) { 
                                ?>
                                        <span class="badge badge-info right"><?php echo $resign; ?></span>
                                <?php } ?>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/resign/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Request</p>
                                    <?php if ($resign > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $resign; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/resign/employeelist'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employee</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/teguran/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-exclamation"></i>
                            <p>Surat Teguran</p>
                            <?php 
                                $this->db->from('teguran');
                                $this->db->join('employee', 'teguran.nik = employee.nik');
                                $this->db->where('teguran_enddate >=', date('Y-m-d'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $teguran = $this->db->get();
                                $active = $teguran->num_rows();

                                if ($active > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $active; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/panggilan/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Surat Panggilan</p>
                            <?php 
                                $this->db->from('panggilan');
                                $this->db->join('employee', 'panggilan.nik = employee.nik');
                                $this->db->where('panggilan_date', date('Y-m-d'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $panggilan = $this->db->get();
                                $today = $panggilan->num_rows();

                                if ($today > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $today; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-times"></i>
                            <p>Undisciplined Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Hold Salary</p>
                        </a>
                    </li> -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tshirt"></i>
                            <p>
                                Uniform
                                <i class="fas fa-angle-left right"></i>
                                <?php 
                                        $this->db->from('uniform_request');
                                        $this->db->join('employee', 'uniform_request.nik = employee.nik');
                                        $this->db->where('uniformrequest_status', 'Waiting for Approval');
                                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                        $uni = $this->db->get();
                                        $uniform = $uni->num_rows();

                                        if ($uniform > 0) { 
                                ?>
                                    <span class="badge badge-info right"><?php echo $uniform; ?></span>
                                <?php } ?>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/uniform/request'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Request</p>
                                    <?php if ($uniform > 0) { ?>
                                        <span class="badge badge-info right"><?php echo $uniform; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/uniform/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Stock</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav-header">DEVELOPMENT</li>
                <li class="nav-item">
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-business-time"></i>
                            <p>Training Hour</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Assessment</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>TNA Monitoring</p>
                        </a>
                    </li> -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>
                                Online Test
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/questionpack/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Question</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('humancapital/exam/list'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Exam</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/class/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>E-Learning</p>
                        </a>
                    </li>
                </li>
                <li class="nav-header">EGD</li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/egdattendance/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>E-Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/survey/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>E-Survey</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/umrah/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-kaaba"></i>
                            <p>Umroh Reward</p>
                            <?php 
                                $this->db->from('umrah');
                                $this->db->join('employee', 'umrah.nik = employee.nik');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $umr = $this->db->get();
                                $umrah = $umr->num_rows();

                                if ($umrah > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $umrah; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                </li>

                <li class="nav-header">&nbsp;</li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/speakup/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-comment"></i>
                            <p>Speak Up Corner</p>
                            <?php
                                $this->db->from('speakup');
                                $this->db->join('employee', 'speakup.nik = employee.nik');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $this->db->where('speakup_status', 'Unread');
                                $speak = $this->db->get();
                                $speakup = $speak->num_rows();

                                if ($speakup > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $speakup; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/marquee/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Running Text</p>
                        </a>
                    </li>
                </li>
                <!-- <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('humancapital/change_password'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                </li> -->
                <br>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
</aside>