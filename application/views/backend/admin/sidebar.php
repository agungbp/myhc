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
    <a href="<?php echo site_url('admin/dashboard'); ?>" class="brand-link">
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
                <a class="d-block"><small>ADMIN <?php echo $row->section_code; ?></small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('admin/employee/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Employee</p>
                        </a>
                    </li>
                </li>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>MPP</p>
                        <?php 
                            // $this->db->from('mpp');
                            // $this->db->where('mpp_status', 'Waiting for Approval'); 
                            // $this->db->where('mpp.section_code', $this->session->userdata('login_section'));
                            // $mpp = $this->db->get();
                            // $mppnotif = $mpp->num_rows();
                            // if ($mppnotif > 0) { 
                        ?>
                            <span class="badge badge-info right"><?php // echo $mppnotif; ?></span>
                        <?php // } ?>
                    </a>
                </li> -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>Freelance Attendance<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('admin/freelance_attendance'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daily Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('admin/freelance_attendance_report'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('admin/change_password'); ?>" class="nav-link">
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