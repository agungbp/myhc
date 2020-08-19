<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $this->db->get_where('employee', array('branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?></h3>
                            <p>Total Employee</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?php echo site_url('humancapital/employee/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                            <?php 
                                $this->db->from('employee');
                                $this->db->where("DATE_FORMAT(employee_join,'%Y-%m')", date('Y-m'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $emp = $this->db->get();
                                echo $emp->num_rows();
                            ?>
                            </h3>
                            <p>New Employee This Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="<?php echo site_url('humancapital/employee/new'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                            <?php
                                $this->db->from('candidate');
                                $this->db->join('application', 'candidate.candidate_ktp = application.nik');
                                $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $can = $this->db->get();

                                echo $can->num_rows();
                            ?>
                            </h3>
                            <p>Total Eksternal Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="<?php echo site_url('humancapital/candidate/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                            <?php
                                $this->db->from('employee_update');
                                $this->db->join('employee', 'employee_update.nik = employee.nik');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $this->db->where('update_status', 'Waiting for Approval');
                                $req = $this->db->get();

                                echo $req->num_rows();
                            ?>
                            </h3>
                            <p>Request Data Update</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <a href="<?php echo site_url('humancapital/employee/update_list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="<?php echo site_url('humancapital/spk/soon'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="<?php echo site_url('humancapital/spk/expired'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>
                            <?php
                                $this->db->from('panggilan');
                                $this->db->join('employee', 'panggilan.nik = employee.nik');
                                $this->db->where('panggilan_date', date('Y-m-d'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $panggilan = $this->db->get();

                                echo $panggilan->num_rows();
                            ?>
                            </h3>
                            <p>Surat Panggilan Meeting</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <a href="<?php echo site_url('humancapital/panggilan/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>
                            <?php
                                $this->db->from('teguran');
                                $this->db->join('employee', 'teguran.nik = employee.nik');
                                $this->db->where('teguran_enddate', date('Y-m-d'));
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
                        <a href="<?php echo site_url('humancapital/teguran/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                            <h5 class="m-0"><i class="fas fa-archive"></i>&nbsp;&nbsp;Department</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <canvas id="myChart6"></canvas>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                            <script type="text/javascript">
                                var ctx = document.getElementById('myChart6').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'horizontalBar',
                                    data: {
                                        labels: [
                                            <?php
                                                foreach ($graphsection as $data) {
                                                echo "'" . $data->section_name ."',";
                                                }
                                            ?>
                                        ],
                                        datasets: [{
                                            label: 'Employee',
                                            backgroundColor: '#ADD8E6',
                                            borderColor: '##93C3D2',
                                            data: [
                                                <?php
                                                    foreach ($graphsection as $data) {
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
                            <h5 class="m-0"><i class="fas fa-tshirt"></i>&nbsp;&nbsp;Uniform Stock</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <canvas id="myChart3"></canvas>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                            <script type="text/javascript">
                                var ctx = document.getElementById('myChart3').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [
                                            <?php
                                                foreach ($graphuniform as $data) {
                                                echo "'" . $data->uniformstock_code ."',";
                                                }
                                            ?>
                                        ],
                                        datasets: [{
                                            label: 'Stock',
                                            backgroundColor: '#ADD8E6',
                                            borderColor: '##93C3D2',
                                            data: [
                                                <?php
                                                    foreach ($graphuniform as $data) {
                                                    echo $data->uniformstock_stock . ", ";
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
                            <h5 class="m-0"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Active Vacancy</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <canvas id="myChart2"></canvas>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                            <script type="text/javascript">
                                var ctx = document.getElementById('myChart2').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [
                                            <?php
                                                foreach ($graphvacancy as $data) {
                                                    echo "'" . $data->vacancy_position ."',";
                                                }
                                            ?>
                                        ],
                                        datasets: [{
                                            label: 'Candidate',
                                            backgroundColor: '#ADD8E6',
                                            borderColor: '##93C3D2',
                                            data: [
                                                <?php
                                                    foreach ($graphvacancy as $data) {
                                                        echo $data->app . ", ";
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

            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0"><i class="fas fa-user"></i>&nbsp;&nbsp;Position</h5>
                    </div>
                    <div class="card-body">
                            <canvas id="myChart4"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                        <script type="text/javascript">
                            var ctx = document.getElementById('myChart4').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'line',
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
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->