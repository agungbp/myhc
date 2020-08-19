<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $page_title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $page_title;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

            <?php 
                $this->db->order_by('panggilan_createdate');
                $panggilan = $this->db->get_where('panggilan', array('nik' => $this->session->userdata('login_nik'))); 
                if($panggilan->num_rows() < 1){ ?>
                    <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda tidak memiliki Surat Panggilan.
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php foreach ($panggilan->result_array() as $row): ?>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1 col-4">Number</div>
                                <div class="col-lg-11 col-8"><b><?php echo $row['panggilan_number']; ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Date</div>
                                <div class="col-lg-11 col-8">
                                    <?php 
                                        $date = date_create($row['panggilan_date']);
                                        echo '<b>' . date_format($date, "d F Y") . '</b>';
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Time</div>
                                <div class="col-lg-11 col-8">
                                    <?php 
                                        $time = date_create($row['panggilan_time']);
                                        echo '<b>' . date_format($time, "H:i") . '</b>';
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Place</div>
                                <div class="col-lg-11 col-8"><b><?php echo $row['panggilan_place']; ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Meet</div>
                                <div class="col-lg-11 col-8"><b><?php echo $row['panggilan_meet']; ?></b></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12"><?php echo mb_strimwidth(nl2br($row['panggilan_description']), 0, 500, "...") ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo site_url('employee/panggilan/print/'.$row['panggilan_id']); ?>" class="btn btn-dark" target="_blank">
                                        <i class="fas fa-print"></i>&nbsp;&nbsp;Print
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->