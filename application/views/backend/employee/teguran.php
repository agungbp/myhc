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

        <!-- Default box -->
            <?php 
                $this->db->order_by('teguran_number');
                $teguran = $this->db->get_where('teguran', array('nik' => $this->session->userdata('login_nik'))); 
                if($teguran->num_rows() < 1){ ?>
                  <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda tidak memiliki Surat Teguran.
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php foreach ($teguran->result_array() as $row): ?>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1 col-4">Number</div>
                                <div class="col-lg-11 col-8"><b><?php echo $row['teguran_number']; ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Periode</div>
                                <div class="col-lg-11 col-8">
                                    <b><?php echo date_format(date_create($row['teguran_createdate']),"d F Y") . ' - ' . date_format(date_create($row['teguran_enddate']),"d F Y"); ?></b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Status</div>
                                <div class="col-lg-11 col-8">
                                    <b>
                                        <?php if (strtotime($row['teguran_enddate']) >= strtotime('now')) { ?>
                                            <h5><span class="badge badge-success">Active</span></h5>   
                                        <?php } else { ?>
                                            <h5><span class="badge badge-danger">Expired</span></h5>
                                        <?php } ?>
                                    </b>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-12"><?php echo mb_strimwidth(nl2br($row['teguran_description']), 0, 500, "...") ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo site_url('employee/teguran/print/'.$row['teguran_id']); ?>" class="btn btn-dark" target="_blank">
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

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'teguran_add.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->