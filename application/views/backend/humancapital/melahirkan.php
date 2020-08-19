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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open(site_url('humancapital/melahirkan/filter')); ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Period</div>
                                <div class="col-lg-2 col-12">
                                    <input type="date" class="form-control" name="start" value="<?php echo $start ?>" id="txt_melahirkan_start" required <?php if ($melahirkan_period == 'All') echo 'disabled'; ?>>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <input type="date" class="form-control" name="end" value="<?php echo $end ?>" id="txt_melahirkan_end" required <?php if ($melahirkan_period == 'All') echo 'disabled'; ?>>
                                </div>
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">
                                    <div class="form-check" style="margin-top: 0px;">
                                        <input class="form-check-input" type="checkbox" value="All" name="melahirkan_period" id="chk_melahirkan_period" <?php if ($melahirkan_period == 'All') echo 'checked'; ?>>
                                        <label class="form-check-label">ALL PERIOD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Status</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="melahirkan_status" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE STATUS --</option>
                                        <option value="All" <?php if ($melahirkan_status == 'All') echo 'selected'; ?>>ALL STATUS</option>
                                        <option value="Waiting for Approval" <?php if ($melahirkan_status == 'Waiting for Approval') echo 'selected'; ?>>WAITING FOR APPROVAL</option>
                                        <option value="Hold" <?php if ($melahirkan_status == 'Hold') echo 'selected'; ?>>HOLD</option>
                                        <option value="Approved" <?php if ($melahirkan_status == 'Approved') echo 'selected'; ?>>APPROVED</option>
                                        <option value="Declined" <?php if ($melahirkan_status == 'Declined') echo 'selected'; ?>>DECLINED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Level Pangkat</th>
                            <th>Posisi Jabatan</th>
                            <th>Coding</th>
                            <th>Nama Pasien</th>
                            <th>Keterangan</th>
                            <th>Persalinan</th>
                            <th>Tanggal Kwitansi</th>
                            <th>Jumlah Diajukan</th>
                            <th>Jumlah Pengurang</th>
                            <th>Jumlah Yang Disetujui</th>
                            <th>Pergantian</th>
                            <!-- <th>Pinjaman Karyawan</th> -->
                            <th>Jumlah Realisasi</th>
                            <th>Bank</th>
                            <th>Pemilik Rekening</th>
                            <th>Nomor Rekening</th>
                            <th>Tanggal Pengajuan</th>
                            <th width="10%">File</th>
                            <th>Status</th>
                            <?php 
                                $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->employee_position;
                                if (strpos($usercek, 'COMPENSATION & BENEFIT') !== FALSE) { 
                            ?>
                                    <th width="5%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Level Pangkat</th>
                            <th>Posisi Jabatan</th>
                            <th>Coding</th>
                            <th>Nama Pasien</th>
                            <th>Keterangan</th>
                            <th>Persalinan</th>
                            <th>Tanggal Kwitansi</th>
                            <th>Jumlah Diajukan</th>
                            <th>Jumlah Pengurang</th>
                            <th>Jumlah Yang Disetujui</th>
                            <th>Pergantian</th>
                            <!-- <th>Pinjaman Karyawan</th> -->
                            <th>Jumlah Realisasi</th>
                            <th>Bank</th>
                            <th>Pemilik Rekening</th>
                            <th>Nomor Rekening</th>
                            <th>Tanggal Pengajuan</th>
                            <th>File</th>
                            <th>Status</th>
                            <?php 
                                if (strpos($usercek, 'COMPENSATION & BENEFIT') !== FALSE) { 
                            ?>
                                    <th>Options</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $number = 1;

                        if ($melahirkan_period == 'All' && $melahirkan_status == 'All') {
                            $this->db->from('melahirkan');
                            $this->db->join('employee', 'melahirkan.nik = employee.nik');
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $sql = $this->db->get();
                        } elseif ($melahirkan_period != 'All' && $start != NULL && $end != NULL && $melahirkan_status == 'All') {
                            $this->db->from('melahirkan');
                            $this->db->join('employee', 'melahirkan.nik = employee.nik');
                            $this->db->where('melahirkan_applydate >=', $start);
                            $this->db->where('melahirkan_applydate <=', $end);
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $sql = $this->db->get();
                        } elseif ($melahirkan_period == 'All' && $melahirkan_status != 'All') {
                            $this->db->from('melahirkan');
                            $this->db->join('employee', 'melahirkan.nik = employee.nik');
                            $this->db->where('melahirkan_status', $melahirkan_status);
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $sql = $this->db->get();
                        }  elseif ($melahirkan_period != 'All' && $start != NULL && $end != NULL && $melahirkan_status != 'All') {
                            $this->db->from('melahirkan');
                            $this->db->join('employee', 'melahirkan.nik = employee.nik');
                            $this->db->where('melahirkan_applydate >=', $start);
                            $this->db->where('melahirkan_applydate <=', $end);
                            $this->db->where('melahirkan_status', $melahirkan_status);
                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                            $sql = $this->db->get();
                        } 

                        foreach ($sql->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $number++; ?></td>
                            <td style="text-align: center;"><?php echo $row['nik'] ?></td>
                            <td><?php echo $row['employee_name'] ?></td>
                            <td style="text-align: center;"><?php echo $row['employee_level'] ?></td>
                            <td><?php echo $row['employee_position'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_coding'] ?></td>
                            <td><?php echo $row['melahirkan_namapasien'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_keterangan'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_persalinan'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_tglkwitansi'] ?></td>
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['melahirkan_jmldiajukan']) ?></td>
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['melahirkan_jmlpengurang']) ?></td>
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['melahirkan_jmldisetujui']) ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_pergantian'] . ' %' ?></td>
                            <!-- <td style="text-align: center;"><?php // echo 'Rp ' . number_format($row['melahirkan_loan']) ?></td> -->
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['melahirkan_jmlrealisasi']) ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_bank'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_rekeningpemilik'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_rekeningnomor'] ?></td>
                            <td style="text-align: center;"><?php echo $row['melahirkan_applydate']; ?></td>
                            <td style="text-align: center;">
                                <?php if($row['melahirkan_file'] != '' || $row['melahirkan_file'] != NULL){ ?>
                                    <a href="<?php echo site_url('uploads/melahirkan/'). $row['melahirkan_file']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>&nbsp;&nbsp;
                                <?php } else { ?>
                                    <button class="btn btn-primary btn-icon icon-left" disabled>
                                        <i class="fas fa-download mr-1"></i>Download
                                    </button>&nbsp;&nbsp;
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['melahirkan_status'] == 'Waiting for Approval') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['melahirkan_status'] ?></span></h5>
                                <?php } elseif($row['melahirkan_status'] == 'Declined') { ?>
                                    <h5>
                                        <span class="badge badge-danger">
                                            <?php 
                                                echo $row['melahirkan_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['melahirkan_status'] == 'Approved') { ?>
                                    <h5>
                                        <span class="badge badge-success">
                                            <?php 
                                                echo $row['melahirkan_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['melahirkan_status'] == 'Hold') { ?>
                                    <h5><span class="badge badge-warning"><?php echo $row['melahirkan_status'] ?></span></h5>
                                <?php } ?>
                                <?php echo nl2br($row['melahirkan_note']); ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'COMPENSATION & BENEFIT') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <?php if($row['melahirkan_status'] != 'Approved'){ ?>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-dark" onclick="FormModal('<?php echo site_url('modal/popup/melahirkan_edit/'.$row['melahirkan_id'] ); ?>');">
                                                    <ion-icon name="create"></ion-icon>&nbsp;&nbsp;Update Status
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>    
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

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
                <?php include 'melahirkan_add.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#tabel-data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    var table = $('#tabel-data').DataTable( {
        orderCellsTop: true,
        dom:
            "<'row'<'col-sm-4'l><'col-sm-5 text-center'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        order: [[ 18, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 20 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 20 ]
                }
            }
        ]
    } );

    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>

<script type="text/javascript">
    $('#chk_melahirkan_period').click(function(){
        if($(this).is(':checked')){
            $('#txt_melahirkan_start').attr("disabled", true);
            $('#txt_melahirkan_end').attr("disabled", true);
        } else{
            $('#txt_melahirkan_start').attr("disabled", false);
            $('#txt_melahirkan_end').attr("disabled", false);
        }
    });
</script>