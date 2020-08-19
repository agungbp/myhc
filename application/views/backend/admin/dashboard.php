<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $page_title;?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                  $this->db->from('employee');
                  $this->db->where('section_code', $this->session->userdata('login_section'));
                  $this->db->where('branch_code', $this->session->userdata('login_branch'));

                  $employee = $this->db->get();
                ?>
                <h3><?php echo $employee->num_rows(); ?></h3>
                <p>Total Employee</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo site_url('admin/employee/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  $this->db->from('freelance_attendance');
                  $this->db->join('employee', 'employee.nik = freelance_attendance.nik');
                  $this->db->where('section_code', $this->session->userdata('login_section'));
                  $this->db->where('branch_code', $this->session->userdata('login_branch'));
                  $this->db->where('fattendance_status', 'M');
                  $this->db->where('fattendance_date', date('Y-m-d'));
                  $masuk = $this->db->get();
                ?>
                <h3><?php echo $masuk->num_rows(); ?></h3>
                <p>Freelance Present Today</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-check"></i>
              </div>
              <a href="<?php echo site_url('admin/freelance_attendance_view/' . $this->session->userdata('login_section') . '/' . date('Y-m-d')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                  $this->db->from('freelance_attendance');
                  $this->db->join('employee', 'employee.nik = freelance_attendance.nik');
                  $this->db->where('section_code', $this->session->userdata('login_section'));
                  $this->db->where('branch_code', $this->session->userdata('login_branch'));
                  $this->db->where('fattendance_status !=', 'M');
                  $this->db->where('fattendance_date', date('Y-m-d'));
                  $masuk = $this->db->get();
                ?>
                <h3><?php echo $masuk->num_rows(); ?></h3>
                <p>Freelance Absent Today</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-times"></i>
              </div>
              <a href="<?php echo site_url('admin/freelance_attendance_view/' . $this->session->userdata('login_section') . '/' . date('Y-m-d')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->