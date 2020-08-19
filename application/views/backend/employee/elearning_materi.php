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
            $this->db->from('elearning_class');
            $this->db->join('elearning_materi', 'elearning_class.class_id = elearning_materi.class_id');
            $this->db->where('elearning_class.class_id', $class_id);
            $query = $this->db->get();

            // $query = $this->db->get_where('elearning_student', array('nik' => $this->session->userdata('login_nik')));
            $available = $query->num_rows();
            if($available > 0){
                foreach ($query->result_array() as $row): ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h4><?php echo $row['materi_name']; ?></h4><br>
                                    <p class="text-muted" style="margin-top: -25px;">
                                        <i>
                                            Uploaded 
                                            <?php echo $row['materi_create_date'] . ' ' . $row['materi_create_time']; ?>
                                        </i>
                                    </p>
                                    <?php if ($row['materi_end_date'] != '' || $row['materi_end_date'] != NULL || $row['materi_end_time'] != '' || $row['materi_end_time'] != NULL){ ?>
                                        <p class="text-muted" style="margin-top: -15px;">
                                            <i>
                                                Available until 
                                                <?php echo $row['materi_end_date']; ?>
                                            </i>
                                        </p>
                                    <?php } ?>
                                </div>
                                <div class="col-4" style="text-align: right;">
                                    <?php
                                        if ($row['materi_end_date'] != '' || $row['materi_end_date'] != NULL || $row['materi_end_time'] != '' || $row['materi_end_time'] != NULL){
                                            if ($row['materi_end_date'] . ' ' . $row['materi_end_time'] > date('Y-m-d H:i:s')) { ?>
                                                <a href="<?php echo site_url('uploads/materi/'). $row['materi_file']; ?>" class="btn btn-success" style="margin-top: 10px;" target="_blank"><i class="fas fa-eye"></i>&nbsp;&nbsp;Open</a>  
                                    <?php   } else { ?>
                                                <button class="btn btn-danger" style="margin-top: 10px;" disabled>Unavailable</button>
                                    <?php   }
                                        } else {
                                    ?>
                                        <a href="<?php echo site_url('uploads/materi/'). $row['materi_file']; ?>" class="btn btn-success" style="margin-top: 10px;"  target="_blank"><i class="fas fa-eye"></i>&nbsp;&nbsp;Open</a> 
                                    <?php } ?>
                                </div>
                            </div>
                        </div>   
                    </div> 
                <?php endforeach;
            } else { 
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Tidak ada materi tersedia.
                            </div>
                        </div>
                    </div>
                </div>
       <?php } ?>  
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'elearning_materi_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->