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
    <a href="<?php echo site_url('superuser/dashboard'); ?>" class="brand-link">
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
                <a class="d-block" ><small>SUPER USER</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('superuser/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('superuser/user/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Users</p>
                        </a>
                    </li>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('superuser/log/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-clock"></i>
                            <p>Login Log</p>
                        </a>
                    </li>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('superuser/marquee/list'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Running Text</p>
                        </a>
                    </li>
                </li>
                <!-- <li class="nav-item">
                    <li class="nav-item">
                        <a href="<?php echo site_url('superuser/change_password'); ?>" class="nav-link">
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