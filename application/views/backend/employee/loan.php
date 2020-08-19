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
            $this->db->from('loan');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $this->db->order_by('loan_apply', 'desc');
            $loan = $this->db->get();
            if($loan->num_rows() < 1){ ?>
                <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Ajukan Pinjaman</a>
                <br><br>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda tidak memiliki pinjaman
                            </div>
                        </div>
                    </div>
                </div>
        <?php } else { 
                $loancek = $this->db->get_where('loan', array('nik' => $this->session->userdata('login_nik'), 'loan_status !=' => 'Paid'))->num_rows();
                if($loancek == 0) {
        ?>
                    <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Ajukan Pinjaman</a>
                    <br><br>
        <?php
                }
                foreach ($loan->result_array() as $row): ?>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-4">Jumlah Pinjaman</div>
                                <div class="col-lg-10 col-8"><b><?php echo 'Rp ' . number_format($row['loan_amount']) ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">Jangka Waktu</div>
                                <div class="col-lg-10 col-8"><b><?php echo $row['loan_tenor'] . ' Bulan' ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">Kategori</div>
                                <div class="col-lg-10 col-8"><b><?php echo $row['loan_purpose'] ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">Keperluan</div>
                                <div class="col-lg-10 col-8"><b><?php echo $row['loan_description'] ?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">Tanggal Pengajuan</div>
                                <div class="col-lg-10 col-8"><b><?php echo $row['loan_apply']; ?></b></div>
                            </div>
                            <?php if($row['loan_status'] == 'Approved') { ?>
                                <div class="row">
                                    <div class="col-lg-2 col-4">Tanggal Realisasi</div>
                                    <div class="col-lg-10 col-8"><b><?php echo $row['loan_realization'] ?></b></div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-2 col-4">Status</div>
                                <div class="col-lg-10 col-8">
                                    <b>
                                        <?php if($row['loan_status'] == 'Waiting for SPV Approval') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['loan_status'] ?></span></h5>
                                        <?php } elseif ($row['loan_status'] == 'SPV Approved') { ?>
                                            <h5>
                                                <span class="badge badge-primary">
                                                    <?php 
                                                        echo $row['loan_status'];
                                                        $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                        if($created->num_rows() > 0){
                                                            echo ' by ' . $created->row()->employee_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </span>
                                            </h5>
                                        <?php } elseif ($row['loan_status'] == 'Approved') { ?>
                                            <h5>
                                                <span class="badge badge-success">
                                                    <?php 
                                                        echo $row['loan_status'];
                                                        $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                        if($created->num_rows() > 0){
                                                            echo ' by ' . $created->row()->employee_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </span>
                                            </h5>
                                        <?php } elseif ($row['loan_status'] == 'SPV Declined') { ?>
                                            <h5>
                                                <span class="badge badge-danger">
                                                    <?php 
                                                        echo $row['loan_status'];
                                                        $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                        if($created->num_rows() > 0){
                                                            echo ' by ' . $created->row()->employee_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </span>
                                            </h5>
                                        <?php } elseif ($row['loan_status'] == 'Declined') { ?>
                                            <h5>
                                                <span class="badge badge-danger">
                                                    <?php 
                                                        echo $row['loan_status'];
                                                        $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                        if($created->num_rows() > 0){
                                                            echo ' by ' . $created->row()->employee_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </span>
                                            </h5>
                                        <?php } elseif ($row['loan_status'] == 'Paid') { ?>
                                            <h5><span class="badge badge-dark"><?php echo $row['loan_status'] ?></span></h5>
                                        <?php } elseif ($row['loan_status'] == 'Pending') { ?>
                                            <h5><span class="badge badge-warning"><?php echo $row['loan_status'] ?></span></h5>
                                        <?php } ?>
                                    </b>
                                </div>
                            </div>
                            <?php if($row['loan_status'] == 'Declined' || $row['loan_status'] == 'SPV Declined') { ?>
                                <div class="row">
                                    <div class="col-lg-2 col-4">Catatan</div>
                                    <div class="col-lg-10 col-8"><b><?php echo $row['loan_note'] ?></b></div>
                                </div>
                            <?php } ?>
                            <?php if($row['loan_status'] == 'Approved' || $row['loan_status'] == 'Paid') { ?>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped">
                                            <tr style="text-align: center;">
                                                <th width="10%">Pembayaran Ke</th>
                                                <th>Periode</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Status</th>
                                            </tr>
                                            <?php
                                                $dtloan = $this->db->get_where('loan_detail', array('nik' => $this->session->userdata('login_nik'), 'loan_id' => $row['loan_id']))->result_array();
                                                foreach ($dtloan as $row1): 
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $row1['dtloan_installment'] ?></td>
                                                <td style="text-align: center;">
                                                    <?php 
                                                        $date = date_create($row1['dtloan_month']);
                                                        echo date_format($date, "F Y"); 
                                                    ?>
                                                </td>
                                                <td style="text-align: center;"><?php echo 'Rp ' . number_format($row1['dtloan_paypermonth']) ?></td>
                                                <td style="text-align: center;">
                                                    <?php if($row1['dtloan_status'] == 'Paid') { ?>
                                                        <h5><span class="badge badge-secondary"><?php echo $row1['dtloan_status'] ?></span></h5>
                                                    <?php } elseif ($row1['dtloan_status'] == 'Unpaid') { ?>
                                                        <h5><span class="badge badge-danger"><?php echo $row1['dtloan_status'] ?></span></h5>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
        <?php 
                endforeach; 
            }
        ?>   
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
                <?php include 'loan_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->