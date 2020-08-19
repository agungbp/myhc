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
    <a href="<?php echo site_url('spv/dashboard'); ?>" class="brand-link">
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
                <a class="d-block"><small>SPV <?php echo $row->section_code; ?></small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('spv/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Employee
                            <i class="fas fa-angle-left right"></i>
                            <?php 
                                $this->db->from('employee_update');
                                $this->db->join('employee', 'employee_update.nik = employee.nik');
                                $this->db->where('update_status', 'Waiting for Approval');
                                $this->db->where('update_type', 'Shift');
                                $this->db->where('section_code', $this->session->userdata('login_section'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();

                                $update = $sql->num_rows();

                                if ($update > 0) { 
                            ?>
                                    <span class="badge badge-info right"><?php echo $update; ?></span>
                            <?php } ?>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('spv/employee/list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('spv/employee/update_list'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request Update</p>
                                <?php if ($update > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $update; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php 
                    $kar = $this->db->get_where('employee', array('section_code' => $this->session->userdata('login_section')))->row(); 
                    if($kar->section_code == 'HCS'){
                ?>
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="<?php echo site_url('spv/application/newhire'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>New Hire Approval</p>
                                <?php
                                    $this->db->from('application');
                                    $this->db->where('application_status', 'Waiting for SPV Approval');
                                    $new = $this->db->get();

                                    if ($new->num_rows() > 0) { 
                                ?>
                                        <span class="badge badge-info right"><?php echo $new->num_rows(); ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </li>
                <?php } ?>
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
                            <a href="<?php echo site_url('spv/spk/soon'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SPK Expiring Soon</p>
                                <?php if ($expired2 > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $expired2; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('spv/spk/expired'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expired SPK</p>
                                <?php if ($expired > 0) { ?>
                                    <span class="badge badge-info right"><?php echo $expired; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('spv/freelance_attendance_report'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-fingerprint"></i>
                            <p>Freelance Attendance</p>
                        </a>
                    </li>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('spv/teguran/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-exclamation"></i>
                        <p>Surat Teguran</p>
                        <?php 
                        $this->db->from('teguran');
                        $this->db->join('employee', 'employee.nik = teguran.nik');
                        $this->db->where('teguran_enddate >=', date('Y-m-d'));
                        $this->db->where('section_code', $this->session->userdata('login_section'));
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $teguran = $this->db->get();                                
                        $letter1 = $teguran->num_rows(); 

                        if ($letter1 > 0) { ?>
                            <span class="badge badge-info right"><?php echo $letter1; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('spv/panggilan/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Surat Panggilan</p>
                        <?php 
                        $this->db->from('panggilan');
                        $this->db->join('employee', 'employee.nik = panggilan.nik');
                        $this->db->where('panggilan_date', date('Y-m-d'));
                        $this->db->where('section_code', $this->session->userdata('login_section'));
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $panggilan = $this->db->get();
                        $letter2 = $panggilan->num_rows(); 

                        if ($letter2 > 0) { ?>
                            <span class="badge badge-info right"><?php echo $letter2; ?></span>
                        <?php } ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo site_url('spv/application/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Job Application Approval</p>
                        <?php 
                            $this->db->from('application');
                            $this->db->join('employee', 'application.nik = employee.nik');
                            $this->db->where('application_status', 'Applied'); 
                            $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $app = $this->db->get();
                            $appnotif = $app->num_rows();
                            if ($appnotif > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php echo $appnotif; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('spv/loan/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Loan Approval</p>
                        <?php 
                            $this->db->from('loan');
                            $this->db->join('employee', 'loan.nik = employee.nik');
                            $this->db->where('loan_status', 'Waiting for SPV Approval'); 
                            $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $loan = $this->db->get();
                            $loannotif = $loan->num_rows();
                            if ($loannotif > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php echo $loannotif; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('spv/elearning/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>E-Learning Approval</p>
                        <?php 
                            $this->db->from('elearning_class');
                            $this->db->join('elearning_student', 'elearning_class.class_id = elearning_student.class_id');
                            $this->db->join('employee', 'elearning_student.nik = employee.nik');
                            $this->db->where('student_status', 'Waiting for SPV Approval'); 
                            $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                            $this->db->where('elearning_class.branch_code', $this->session->userdata('login_branch'));
                            $elearning = $this->db->get();

                            $elearningnotif = $elearning->num_rows();
                            if ($elearningnotif > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php echo $elearningnotif; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('spv/resign/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-minus"></i>
                        <p>Resign Approval</p>
                        <?php 
                            $this->db->from('resign');
                            $this->db->join('employee', 'resign.nik = employee.nik');
                            $this->db->where('resign_status', 'Waiting for SPV Approval'); 
                            $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $resign = $this->db->get();
                            $resignnotif = $resign->num_rows();
                            if ($resignnotif > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php echo $resignnotif; ?></span>
                        <?php } ?>
                    </a>
                </li>
                <?php 
                    if($kar->section_code == 'HCS'){
                ?>
                        <li class="nav-item">
                            <a href="<?php echo site_url('spv/questionpack/list'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-desktop"></i>
                                <p>Online Test Approval</p>
                                <?php 
                                    $this->db->from('cbt_questionpack');
                                    $this->db->where('questionpack_status', 'Waiting for SPV Approval'); 
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $questionpack = $this->db->get();
                                    $questionpacknotif = $questionpack->num_rows();
                                    if ($questionpacknotif > 0) { 
                                ?>
                                    <span class="badge badge-info right"><?php echo $questionpacknotif; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                <?php } ?>
                <!-- <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('spv/change_password'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                </li> -->
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
</aside>