<?php
    $this->db->from('candidate');
    $this->db->where('candidate_ktp', $this->session->userdata('login_nik'));
    $query = $this->db->get();
    $row = $query->row();
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('candidate/dashboard'); ?>" class="brand-link">
      <center><img src="<?php echo base_url();?>assets/login/img/logo_white.png" alt="JNE" style="opacity: .8" width="30%"></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="margin-top: 0px; margin-bottom: 0px;">
                <img src="<?php echo $this->get_model->get_image_url('candidate', $this->session->userdata('login_nik')); ?>" alt="User Image" class="img-circle">
            </div>
            <div class="info" style="margin-top: -10px; margin-bottom: 0px;">
                <a class="d-block"><?php echo $row->candidate_name; ?></a>
                <a><small>CANDIDATE</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('candidate/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('candidate/cv/edit'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Curriculum Vitae</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('candidate/vacancy'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Lowongan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('candidate/application/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Lamaran Saya</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?php // echo site_url('candidate/exam/list'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>Online Test</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="<?php echo site_url('candidate/change_password/'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Ganti Password</p>
                    </a>
                </li>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
</aside>