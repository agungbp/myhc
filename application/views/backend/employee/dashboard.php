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
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php
                                $this->db->from('loan_detail');
                                $this->db->where('dtloan_status !=', 'Unpaid');
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $dtloan = $this->db->get();

                                echo $dtloan->num_rows();
                                ?>
                            </h3>
                            <p>Sisa Pinjaman</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <a href="<?php echo site_url('employee/loan/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <?php
                                $this->db->from('panggilan');
                                $this->db->where('panggilan_date >=', date('Y-m-d'));
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $panggilan = $this->db->get();

                                echo $panggilan->num_rows();
                                ?>
                            </h3>
                            <p>Surat Panggilan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <a href="<?php echo site_url('employee/panggilan/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                <?php
                                $this->db->from('teguran');
                                $this->db->where('teguran_enddate >=', date('Y-m-d'));
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $teguran = $this->db->get();

                                echo $teguran->num_rows();
                                ?>
                            </h3>
                            <p>Surat Teguran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <a href="<?php echo site_url('employee/teguran/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php
                                $this->db->from('vacancy');
                                $this->db->where('vacancy_lastdate >=', date('Y-m-d'));
                                $this->db->where('user_type', 'EMPLOYEE');
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $vac = $this->db->get();

                                echo $vac->num_rows();
                                ?>
                            </h3>
                            <p>Job Posting</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="<?php echo site_url('employee/vacancy/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-2 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rawat Jalan</span>
                            <span class="info-box-number">
                                <?php // echo 'Rp ' . number_format($this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')))->row()->plafon_rawatjalan); ?>
                                <?php 
                                    $rawatjalan = $this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')));
                                    if($rawatjalan->num_rows() > 0){
                                        echo 'Rp ' . number_format($rawatjalan->row()->plafon_rawatjalan);
                                    } else {
                                        echo 'Rp 0';
                                    }
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-2 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rawat Inap</span>
                            <span class="info-box-number">
                                <?php // echo 'Rp ' . number_format($this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')))->row()->plafon_rawatinap); ?>
                                <?php 
                                    $rawatinap = $this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')));
                                    if($rawatinap->num_rows() > 0){
                                        echo 'Rp ' . number_format($rawatinap->row()->plafon_rawatinap);
                                    } else {
                                        echo 'Rp 0';
                                    }
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-2 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Persalinan Normal</span>
                            <span class="info-box-number">
                                <?php // echo 'Rp ' . number_format($this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')))->row()->plafon_melahirkannormal); ?>
                                <?php 
                                    $normal = $this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')));
                                    if($normal->num_rows() > 0){
                                        echo 'Rp ' . number_format($normal->row()->plafon_melahirkannormal);
                                    } else {
                                        echo 'Rp 0';
                                    }
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-2 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Persalinan Sectio</span>
                            <span class="info-box-number">
                                <?php // echo 'Rp ' . number_format($this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')))->row()->plafon_melahirkansectio); ?>
                                <?php 
                                    $sectio = $this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')));
                                    if($sectio->num_rows() > 0){
                                        echo 'Rp ' . number_format($sectio->row()->plafon_melahirkansectio);
                                    } else {
                                        echo 'Rp 0';
                                    }
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-2 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Set Kacamata</span>
                            <span class="info-box-number">
                                <?php // echo 'Rp ' . number_format($this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')))->row()->plafon_setkacamata); ?>
                                <?php 
                                    $kacamata = $this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')));
                                    if($kacamata->num_rows() > 0){
                                        echo 'Rp ' . number_format($kacamata->row()->plafon_setkacamata);
                                    } else {
                                        echo 'Rp 0';
                                    }
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-2 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Lensa</span>
                            <span class="info-box-number">
                                <?php // echo 'Rp ' . number_format($this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')))->row()->plafon_lensa); ?>
                                <?php 
                                    $lensa = $this->db->get_where('plafon', array('nik' => $this->session->userdata('login_nik'), 'plafon_periode' => date('Y')));
                                    if($lensa->num_rows() > 0){
                                        echo 'Rp ' . number_format($lensa->row()->plafon_lensa);
                                    } else {
                                        echo 'Rp 0';
                                    }
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-bell"></i>&nbsp;&nbsp;Notifikasi</h5>
                        </div>
                        <div class="card-body">

                            <?php
                            $this->db->from('application');
                            $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                            $this->db->where('nik', $this->session->userdata('login_nik'));
                            $appnotif = $this->db->get();

                            foreach ($appnotif->result_array() as $row) :
                            ?>
                                <div class="row" style="margin-bottom: -10px;">
                                    <div class="col-12">
                                        <a href="<?php echo site_url('employee/application/list'); ?>" class="card text-white bg-primary">
                                            <div class="card-body">
                                                <span class="badge badge-light font-weight-bold">Job Posting</span> &nbsp;&nbsp; Status lamaran Anda <b><?php echo $row['application_status'] ?></b>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <?php
                            $this->db->from('teguran');
                            $this->db->where('teguran_enddate', date('Y-m-d'));
                            $this->db->where('nik', $this->session->userdata('login_nik'));
                            $tegurannotif = $this->db->get();

                            foreach ($tegurannotif->result_array() as $row) :
                            ?>
                                <div class="row" style="margin-bottom: -10px;">
                                    <div class="col-12">
                                        <a href="<?php echo site_url('employee/teguran/list'); ?>" class="card text-white bg-primary">
                                            <div class="card-body">
                                                <span class="badge badge-light font-weight-bold">Surat Teguran</span> &nbsp;&nbsp; Surat Teguran Anda <b><?php echo $row['teguran_number'] ?></b> berakhir hari ini.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php
                            $this->db->from('panggilan');
                            $this->db->where('panggilan_date', date('Y-m-d'));
                            $this->db->where('nik', $this->session->userdata('login_nik'));
                            $panggilannotif = $this->db->get();

                            foreach ($panggilannotif->result_array() as $row) :
                            ?>
                                <div class="row" style="margin-bottom: -10px;">
                                    <div class="col-12">
                                        <a href="<?php echo site_url('employee/panggilan/list'); ?>" class="card text-white bg-primary">
                                            <div class="card-body">
                                                <span class="badge badge-light font-weight-bold">Surat Panggilan</span> &nbsp;&nbsp; Anda memiliki surat panggilan <b><?php echo $row['panggilan_number'] ?></b> untuk hari ini.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php if ($tegurannotif->num_rows() == 0 && $panggilannotif->num_rows() == 0 && $appnotif->num_rows() == 0) { ?>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="card-text text-muted font-italic" style="margin-bottom: 0px;">
                                            Belum ada notifikasi.
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Job Posting</h5>
                        </div>
                        <?php

                        if ($vac->num_rows() > 0) {
                            foreach ($vac->result_array() as $row) :
                        ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5 class="card-title text-bold" style="margin-bottom: 6px;"><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></h5>
                                            <p class=" card-text text-muted" style="margin-bottom: 0px;">
                                                <i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;
                                                <?php echo $row['vacancy_placement']; ?>
                                            </p>
                                            <p class=" card-text text-muted">
                                                <i class="fas fa-calendar"></i>&nbsp;&nbsp;
                                                <?php echo date_format(date_create($row['vacancy_publishdate']), "d F Y") . ' - ' . date_format(date_create($row['vacancy_lastdate']), "d F Y"); ?>
                                            </p>
                                        </div>
                                        <div class="col-4" style="text-align: right; margin-top: 10px;">
                                            <a href="<?php echo site_url('employee/vacancy/list'); ?>" class="btn btn-primary">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <hr style="margin-bottom: 5px;">
                                </div>
                            <?php endforeach;
                        } else { ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="card-text text-muted font-italic" style="margin-bottom: 0px;">
                                            Job posting tidak tersedia.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->