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
        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Take New Class</a>
        <br><br>
        <?php 
            $this->db->from('elearning_class');
            $this->db->join('elearning_student', 'elearning_class.class_id = elearning_student.class_id');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $this->db->order_by('class_periode', 'DESC');
            $query = $this->db->get();

            // $query = $this->db->get_where('elearning_student', array('nik' => $this->session->userdata('login_nik')));
            $available = $query->num_rows();
            if($available > 0){
                foreach ($query->result_array() as $row): ?>
                    <div class="card">
                        <div class="card-header">
                            <?php echo $row['class_name']; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Elearning</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $row['class_name']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Periode</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $row['class_periode']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Total Materi</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $this->db->get_where('elearning_materi', array('class_id' => $row['class_id']))->num_rows() ?></b></p>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Total Student</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php // echo $this->db->get_where('elearning_student', array('class_id' => $row['class_id']))->num_rows() ?></b></p>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Status</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title">
                                        <b>
                                            <?php if($row['student_status'] == 'Waiting for SPV Approval') { ?>
                                                <h5><span class="badge badge-secondary"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } elseif ($row['student_status'] == 'SPV Approved') { ?>
                                                <h5><span class="badge badge-success"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } elseif ($row['student_status'] == 'Registered') { ?>
                                                <h5><span class="badge badge-info"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } elseif ($row['student_status'] == 'SPV Declined') { ?>
                                                <h5><span class="badge badge-danger"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } elseif ($row['student_status'] == 'Declined') { ?>
                                                <h5><span class="badge badge-danger"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } elseif ($row['student_status'] == 'Done') { ?>
                                                <h5><span class="badge badge-dark"><?php echo $row['student_status'] ?></span></h5>
                                                <?php } elseif ($row['student_status'] == 'Pending') { ?>
                                                <h5><span class="badge badge-warning"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } ?>
                                        </b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php if($row['student_status'] == 'Registered' || $row['student_status'] == 'Done') { ?>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-7">
                                        <a href="<?php echo site_url('employee/class/materi/' . $row['class_id']); ?>" class="btn btn-primary"><i class="fas fa-book"></i>&nbsp;&nbsp;Materi List</a>
                                        <!-- <a href="<?php // echo site_url('employee/class/students/' . $row['class_id']); ?>" class="btn btn-primary"><i class="fas fa-users"></i>&nbsp;&nbsp;Students</a> -->
                                    </div>
                                    <!-- <div class="col-5" style="text-align: right;">
                                        <a href="<?php // echo site_url('employee/class/leave/' . $row['nik']); ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Leave</a>                            
                                    </div> -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>    
                <?php endforeach;
            } else { 
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda belum ditambahkan ke kelas manapun.
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
                <?php include 'elearning_class_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->