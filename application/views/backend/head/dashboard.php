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
                            <h3><?php echo $this->db->get('employee')->num_rows(); ?></h3>
                            <p>Total Employee</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?php echo site_url('head/employee/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                                $emp = $this->db->get();
                                echo $emp->num_rows();
                            ?>
                            </h3>
                            <p>New Employee This Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="<?php echo site_url('head/employee/new'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                                    $can = $this->db->get();

                                    echo $can->num_rows();
                                ?>
                            </h3>
                            <p>Total Eksternal Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="<?php echo site_url('head/candidate/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                            <?php echo $this->db->get_where('survey', array('survey_status' => 'Waiting for Approval'))->num_rows(); ?>
                            </h3>
                            <p>Survey Waiting for Approval</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <a href="<?php echo site_url('head/survey/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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

                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-user-tie"></i>&nbsp;&nbsp;Level</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <canvas id="myChart3"></canvas>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                            <script type="text/javascript">
                                var ctx = document.getElementById('myChart3').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'horizontalBar',
                                    data: {
                                        labels: [
                                            <?php
                                                foreach ($graphlevel as $data) {
                                                echo "'" . $data->employee_level ."',";
                                                }
                                            ?>
                                        ],
                                        datasets: [{
                                            label: 'Employee',
                                            backgroundColor: '#ADD8E6',
                                            borderColor: '##93C3D2',
                                            data: [
                                                <?php
                                                    foreach ($graphlevel as $data) {
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

                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-archive"></i>&nbsp;&nbsp;Unit</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart7"></canvas>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                            <script type="text/javascript">
                                var ctx = document.getElementById('myChart7').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'bar',
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->