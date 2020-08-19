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
        <div class="card">
            <div class="card-body"> 
                <?php 
                    $count = 1;
                    $this->db->from('employee');
                    $this->db->join('loan', 'employee.nik = loan.nik');
                    $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                    $loan = $this->db->get();
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-data">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Department</th>
                            <th>Jabatan</th>
                            <th>Tgl Masuk Kerja</th>
                            <th>Status Karyawan</th>
                            <th>Gaji Pokok/bulan</th>
                            <th>No HP</th>
                            <th>Kategori</th>
                            <th>Keperluan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Jangka Waktu</th>
                            <th>Tgl Pengajuan</th>
                            <th>Tgl Realisasi</th>
                            <th>Status</th>
                            <th width="5%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Department</th>
                            <th>Jabatan</th>
                            <th>Tgl Masuk Kerja</th>
                            <th>Status Karyawan</th>
                            <th>Gaji Pokok/bulan</th>
                            <th>No HP</th>
                            <th>Kategori</th>
                            <th>Keperluan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Jangka Waktu</th>
                            <th>Tgl Pengajuan</th>
                            <th>Tgl Realisasi</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($loan->result_array() as $row): ?>
                        <tr>
                            <td><?php echo $row['employee_name'] ?></td>
                            <td style="text-align: center;"><?php echo $row['nik'] ?></td>
                            <td>
                                <?php 
                                    $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                    if($section->num_rows() > 0){
                                        echo $section->row()->section_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['employee_position'] ?></td>
                            <td style="text-align: center;"><?php echo $row['employee_join'] ?></td>
                            <td style="text-align: center;"><?php echo $row['employee_status'] ?></td>
                            <td style="text-align: center;"><?php echo 'Rp ' . $row['loan_salary'] ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_phone'] ?></td>
                            <td><?php echo $row['loan_purpose'] ?></td>
                            <td><?php echo $row['loan_description'] ?></td>
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['loan_amount']) ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_tenor'] . ' Bulan' ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_apply']; ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_realization']; ?></td>
                            <td style="text-align: center;">
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
                                <?php echo nl2br($row['loan_note']) ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('spv/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                        <ion-icon name="person"></ion-icon>
                                    </a>
                                    <?php if ($row['loan_status'] == 'Waiting for SPV Approval') { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <ion-icon name="create"></ion-icon>&nbsp;Update Status
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="<?php echo site_url('spv/loan/change_status_approved/'. $row['loan_id']); ?>">Approve</a>
                                            <a class="dropdown-item" href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/loan_decline/'.$row['loan_id'] ); ?>');">Decline</a>
                                        </div>
                                    </div>
                                    <?php } elseif ($row['loan_status'] == 'Approved' || $row['loan_status'] == 'Paid') { ?>
                                        <a href="#" class="btn btn-secondary" onclick="FormModal('<?php echo site_url('modal/popup/loan_details/'.$row['loan_id'] ); ?>');">
                                            <ion-icon name="eye"></ion-icon>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>   
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
        order: [[ 12, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
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