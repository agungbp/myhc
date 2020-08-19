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
            <div class="small-box bg-primary">
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
              <a href="<?php echo site_url('spv/employee/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>
                    <?php
                        $expired2 = 0;
                        $this->db->from('employee');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('section_code', $this->session->userdata('login_section'));
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

                        echo $expired2;
                    ?>
                    </h3>
                    <p>Expiring SPK</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-contract"></i>
                </div>
                <a href="<?php echo site_url('spv/spk/soon'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                    <?php
                        $expired = 0;
                        $this->db->from('employee');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('section_code', $this->session->userdata('login_section'));
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

                        echo $expired;
                    ?>
                    </h3>
                    <p>Expired SPK</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-signature"></i>
                </div>
                <a href="<?php echo site_url('spv/spk/expired'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-light">
              <div class="inner">
                  <h3>
                  <?php
                      $this->db->from('teguran');
                      $this->db->join('employee', 'teguran.nik = employee.nik');
                      $this->db->where('teguran_enddate >', date('Y-m-d'));
                      $this->db->where('section_code', $this->session->userdata('login_section'));
                      $this->db->where('branch_code', $this->session->userdata('login_branch'));
                      $teguran = $this->db->get();
  
                      echo $teguran->num_rows();
                  ?>
                  </h3>
                  <p>Surat Teguran Active</p>
              </div>
              <div class="icon">
                  <i class="fas fa-exclamation"></i>
              </div>
              <a href="<?php echo site_url('spv/teguran/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>
              <?php
                $this->db->from('panggilan');
                $this->db->join('employee', 'panggilan.nik = employee.nik');
                $this->db->where('panggilan_date', date('Y-m-d'));
                $this->db->where('section_code', $this->session->userdata('login_section'));
                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                $panggilan = $this->db->get();

                echo $panggilan->num_rows();
              ?>
            </h3>
            <p>Surat Panggilan Today's Meeting</p>
          </div>
          <div class="icon">
            <i class="fas fa-envelope-open-text"></i>
          </div>
          <a href="<?php echo site_url('spv/panggilan/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <?php
              $this->db->from('employee');
              $this->db->join('application', 'employee.nik = application.nik');
              $this->db->where('employee.section_code', $this->session->userdata('login_section'));
              $this->db->where('branch_code', $this->session->userdata('login_branch'));
              $this->db->where('application_status', 'Applied');
              $application = $this->db->get();
            ?>
            <h3><?php echo $application->num_rows(); ?></h3>
            <p style="margin-top: -10px; margin-bottom: 0px;">Application Waiting<br>for Approval</p>
          </div>
          <div class="icon">
            <i class="fas fa-briefcase"></i>
          </div>
          <a href="<?php echo site_url('spv/application/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <?php
              $this->db->from('loan');
              $this->db->join('employee', 'loan.nik = employee.nik');
              $this->db->where('section_code', $this->session->userdata('login_section'));
              $this->db->where('branch_code', $this->session->userdata('login_branch'));
              $this->db->where('loan_status', 'Waiting for SPV Approval');
              $mpp = $this->db->get();
            ?>
            <h3><?php echo $mpp->num_rows(); ?></h3>
            <p style="margin-top: -10px; margin-bottom: 0px;">Loan Waiting<br>for Approval</p>
          </div>
          <div class="icon">
            <i class="fas fa-credit-card"></i>
          </div>
          <a href="<?php echo site_url('spv/loan/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-dark">
          <div class="inner">
            <?php
              $this->db->from('resign');
              $this->db->join('employee', 'resign.nik = employee.nik');
              $this->db->where('section_code', $this->session->userdata('login_section'));
              $this->db->where('branch_code', $this->session->userdata('login_branch'));
              $this->db->where('resign_status', 'Waiting for SPV Approval');
              $mpp = $this->db->get();
            ?>
            <h3><?php echo $mpp->num_rows(); ?></h3>
            <p style="margin-top: -10px; margin-bottom: 0px;">Resign Request Waiting<br>for Approval</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-minus"></i>
          </div>
          <a href="<?php echo site_url('spv/resign/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0"><i class="fas fa-id-card"></i>&nbsp;&nbsp;Employee Status</h5>
            </div>
            <div class="card-body">
                <div class="container">
                    <canvas id="myChart5"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                <script type="text/javascript">
                    var ctx = document.getElementById('myChart5').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                <?php
                                    foreach ($graphstatus as $data) {
                                    echo "'" . $data->employee_status ."',";
                                    }
                                ?>
                            ],
                            datasets: [{
                                label: 'Employee',
                                backgroundColor: '#ADD8E6',
                                borderColor: '##93C3D2',
                                data: [
                                    <?php
                                        foreach ($graphstatus as $data) {
                                        echo $data->emp . ", ";
                                        }
                                    ?>
                                ]
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0"><i class="fas fa-archive"></i>&nbsp;&nbsp;Unit</h5>
            </div>
            <div class="card-body">
                <div class="container">
                    <canvas id="myChart4"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                <script type="text/javascript">
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: {
                            labels: [
                                <?php
                                    foreach ($graphunit as $data) {
                                    echo "'" . $data->unit_name ."',";
                                    }
                                ?>
                            ],
                            datasets: [{
                                label: 'Employee',
                                backgroundColor: '#ADD8E6',
                                borderColor: '##93C3D2',
                                data: [
                                    <?php
                                        foreach ($graphunit as $data) {
                                        echo $data->emp . ", ";
                                        }
                                    ?>
                                ]
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0"><i class="fas fa-users"></i>&nbsp;&nbsp;Position</h5>
            </div>
            <div class="card-body">
                <canvas id="myChart3"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                <script type="text/javascript">
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                <?php
                                    foreach ($graphposition as $data) {
                                    echo "'" . $data->employee_position ."',";
                                    }
                                ?>
                            ],
                            datasets: [{
                                label: 'Employee',
                                backgroundColor: '#ADD8E6',
                                borderColor: '##93C3D2',
                                data: [
                                    <?php
                                        foreach ($graphposition as $data) {
                                        echo $data->emp . ", ";
                                        }
                                    ?>
                                ]
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->