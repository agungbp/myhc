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
        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Manual Clock In</a>
        <br><br>
        <div class="callout callout-info">
            <strong>Instructions</strong><br>
            1. Buka aplikasi kamera atau Qrcode scanner<br>
            2. Buka link yang didapatkan<br>
            3. Jika berhasil, detail attendance akan tampil di bawah<br>
            3. Jika gagal, gunakan fitur manual clock-in
        </div>
        <?php 
            $this->db->from('egd_participants');
            $this->db->join('egd_attendance', 'egd_participants.egdattendance_id = egd_attendance.egdattendance_id');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $this->db->order_by('egdparticipants_clockin', 'DESC');
            $query = $this->db->get();

            $available = $query->num_rows();
            if($available > 0){
                foreach ($query->result_array() as $row): ?>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <?php echo $row['egdattendance_name']; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Place</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $row['egdattendance_place']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Date</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $row['egdattendance_date'] . ' ' . $row['egdattendance_time']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Clock In</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $row['egdparticipants_clockin']; ?></b></p>
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
                                Anda belum pernah menghadiri kegiatan EGD.
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
                <?php include 'egdattendance_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->