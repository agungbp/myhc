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
        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Claim Rawat Jalan</a>
        <br><br>
        <?php 
            $this->db->from('rawatjalan');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $this->db->order_by('rawatjalan_applydate', 'DESC');
            $rawatjalan = $this->db->get();

            if($rawatjalan->num_rows() < 1){ ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda tidak memiliki claim rawat jalan.
                            </div>
                        </div>
                    </div>
                </div>
        <?php } else { ?>
            <?php foreach ($rawatjalan->result_array() as $row): ?>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-4">Nama Pasien</div>
                            <div class="col-lg-11 col-8"><b><?php echo $row['rawatjalan_namapasien']; ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Keterangan</div>
                            <div class="col-lg-11 col-8"><b><?php echo $row['rawatjalan_keterangan']; ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Tgl Kwitansi</div>
                            <div class="col-lg-11 col-8"><b><?php echo date_format(date_create($row['rawatjalan_tglkwitansi']),"d F Y"); ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Plafon Awal</div>
                            <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['rawatjalan_plafonawal']) ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Jml Diajukan</div>
                            <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['rawatjalan_jmldiajukan']) ?></b></div>
                        </div>
                        <?php if($row['rawatjalan_status'] == 'Approved') { ?>
                            <div class="row">
                                <div class="col-lg-1 col-4">Jml Realisasi</div>
                                <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['rawatjalan_jmlrealisasi']) ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Sisa Plafon</div>
                                <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['rawatjalan_sisaplafon']) ?></b></div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-lg-1 col-4">Kwitansi</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <a href="<?php echo site_url('uploads/rawatjalan/'). $row['rawatjalan_file']; ?>" target="_blank">
                                        <?php echo $row['rawatjalan_file']; ?>
                                    </a>
                                </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Tgl Pengajuan</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <?php 
                                        $date = date_create($row['rawatjalan_applydate']);
                                        echo date_format($date, "d F Y"); 
                                        ?>
                                </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Status</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <?php if($row['rawatjalan_status'] == 'Waiting for Approval') { ?>
                                        <h5><span class="badge badge-secondary"><?php echo $row['rawatjalan_status'] ?></span></h5>
                                    <?php } elseif($row['rawatjalan_status'] == 'Declined') { ?>
                                        <h5>
                                            <span class="badge badge-danger">
                                                <?php 
                                                    echo $row['rawatjalan_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                    <?php } elseif ($row['rawatjalan_status'] == 'Approved') { ?>
                                        <h5>
                                            <span class="badge badge-success">
                                                <?php 
                                                    echo $row['rawatjalan_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                    <?php } elseif ($row['rawatjalan_status'] == 'Hold') { ?>
                                        <h5><span class="badge badge-warning"><?php echo $row['rawatjalan_status'] ?></span></h5>
                                    <?php } ?>
                                </b>
                            </div>
                        </div>
                        <?php if($row['rawatjalan_status'] == 'Declined' ||$row['rawatjalan_status'] == 'Hold' ) { ?>
                            <div class="row">
                                <div class="col-lg-1 col-4">Note</div>
                                <div class="col-lg-11 col-8"><b><?php echo $row['rawatjalan_note'] ?></b></div>
                            </div>
                        <?php } ?>
                        <?php if($row['rawatjalan_status'] != 'Approved') { ?>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <i><b>Anda harus menyerahkan kwitansi asli ke HC paling lambat tanggal
                                    <?php 
                                        $date = $row['rawatjalan_applydate'];
                                        echo date('d F Y', strtotime($date. ' + 1 days'));
                                    ?>
                                    </b></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>   
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-lg" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'rawatjalan_add.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->