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
        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Kirim</a>
        <br><br>
        <?php 
            $this->db->from('speakup');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $this->db->order_by('speakup_createdate', 'DESC');
            $speakup = $this->db->get();
            
            if($speakup->num_rows() < 1){ 
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda belum pernah mengirim kritik maupun saran.
                            </div>
                        </div>
                    </div>
                </div>
        <?php } else { ?>
            <?php foreach ($speakup->result_array() as $row): ?>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-4">Judul</div>
                            <div class="col-lg-11 col-8"><b><?php echo $row['speakup_subject'] ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Isi</div>
                            <div class="col-lg-11 col-8"><b><?php echo mb_strimwidth(nl2br($row['speakup_description']), 0, 100, "...") ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Create Date</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <?php 
                                        $date = date_create($row['speakup_createdate']);
                                        echo date_format($date, "d F Y"); 
                                        ?>
                                </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Status</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <?php if($row['speakup_status'] == 'Unread') { ?>
                                        <h5><span class="badge badge-secondary"><?php echo $row['speakup_status'] ?></span></h5>
                                    <?php } elseif ($row['speakup_status'] == 'Read') { ?>
                                        <h5>
                                            <span class="badge badge-success">
                                                <?php 
                                                    echo $row['speakup_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                    <?php } ?>
                                </b>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-info" onclick="FormModal('<?php echo site_url('modal/popup/speakup_details/'.$row['speakup_id'] ); ?>');"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
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
                <?php include 'speakup_add.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->