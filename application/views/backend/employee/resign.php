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
            $this->db->from('resign');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $this->db->order_by('resign_createdate', 'desc');
            $resign = $this->db->get();

            if($resign->num_rows() < 1){ ?>
                <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-minus"></i>&nbsp;&nbsp;&nbsp;Resign</a>
                <br><br>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda tidak memiliki request resign
                            </div>
                        </div>
                    </div>
                </div>
        <?php } else { 
                $resigncek = $this->db->get_where('resign', array('nik' => $this->session->userdata('login_nik'), 'resign_status !=' => 'Declined'))->num_rows();
                if($resigncek  == 0) {
        ?>
                    <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-minus"></i>&nbsp;&nbsp;&nbsp;Resign</a>
                    <br><br>
        <?php
                }
            foreach ($resign->result_array() as $row): ?>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-4">Reason</div>
                            <div class="col-lg-11 col-8"><b><?php echo nl2br($row['resign_reason']); ?></b></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Apply Date</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <?php 
                                        $date = date_create($row['resign_createdate']);
                                        echo date_format($date, "d F Y"); 
                                        ?>
                                </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Letter</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <a href="<?php echo site_url('uploads/resign/'). $row['resign_file']; ?>">
                                        <?php echo $row['resign_file']; ?>
                                    </a>
                                </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-4">Status</div>
                            <div class="col-lg-11 col-8">
                                <b>
                                    <?php if($row['resign_status'] == 'Waiting for SPV Approval') { ?>
                                        <h5><span class="badge badge-secondary"><?php echo $row['resign_status'] ?></span></h5>
                                    <?php } elseif ($row['resign_status'] == 'SPV Approved') { ?>
                                        <h5>
                                            <span class="badge badge-primary">
                                                <?php 
                                                    echo $row['resign_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                    <?php } elseif ($row['resign_status'] == 'Approved') { ?>
                                        <h5>
                                            <span class="badge badge-success">
                                                <?php 
                                                    echo $row['resign_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                    <?php } elseif ($row['resign_status'] == 'SPV Declined') { ?>
                                        <h5>
                                            <span class="badge badge-danger">
                                                <?php 
                                                    echo $row['resign_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                    <?php } elseif ($row['resign_status'] == 'Declined') { ?>
                                        <h5>
                                            <span class="badge badge-danger">
                                                <?php 
                                                    echo $row['resign_status'];
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
                        <?php if($row['resign_status'] == 'Declined') { ?>
                            <div class="row">
                                <div class="col-lg-1 col-4">Note</div>
                                <div class="col-lg-11 col-8"><b><?php echo $row['resign_status'] ?></b></div>
                            </div>
                        <?php } elseif ($row['resign_status'] == 'Approved') { ?>
                            <div class="row">
                                <div class="col-lg-1 col-4">Resign Date</div>
                                <div class="col-lg-11 col-8">
                                    <b>
                                        <?php 
                                            $date = date_create($row['resign_date']);
                                            echo date_format($date, "d F Y"); 
                                        ?>
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-4">Severance</div>
                                <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['resign_severance']) ?></b></div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-1 col-4">Remaining Leave</div>
                                <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['resign_leave']) ?></b></div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-1 col-4">Remaining Loan</div>
                                <div class="col-lg-11 col-8"><b><?php echo 'Rp ' . number_format($row['resign_loan']) ?></b></div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-1 col-4">Total</div>
                                <div class="col-lg-11 col-8"><b><?php // echo 'Rp ' . number_format($row['resign_sum']) ?></b></div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-1 col-4">Payment Status</div>
                                <div class="col-lg-11 col-8">
                                    <?php if($row['resign_paystatus'] == 'Paid') { ?>
                                        <h5><span class="badge badge-success"><?php echo $row['resign_paystatus'] ?></span></h5>
                                    <?php } elseif ($row['resign_paystatus'] == 'Unpaid') { ?>
                                        <h5><span class="badge badge-success"><?php echo $row['resign_paystatus'] ?></span></h5>
                                    <?php } ?>
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

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'resign_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->