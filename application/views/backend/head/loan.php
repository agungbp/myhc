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
                    $this->db->from('loan');
                    $this->db->join('employee', 'loan.nik = employee.nik');
                    $this->db->where('loan_status !=', 'Waiting for SPV Approval');
                    $this->db->where('loan_status !=', 'SPV Declined');
                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                    $loan = $this->db->get();
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-data">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Name</th>
                            <th>Department</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Tenor</th>
                            <th>Purpose</th>
                            <th width="10%">Apply Date</th>
                            <th width="10%">Realization Date</th>
                            <th width="10%">Status</th>
                            <th width="5%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Name</th>
                            <th>Department</th>
                            <th>Amount</th>
                            <th>Tenor</th>
                            <th>Purpose</th>
                            <th>Apply Date</th>
                            <th>Realization Date</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($loan->result_array() as $row): ?>
                        <tr>
                            <td><?php echo $row['employee_name'] ?></td>
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
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['loan_amount']) ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_tenor'] . ' Month' ?></td>
                            <td><?php echo $row['loan_purpose'] ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_apply']; ?></td>
                            <td style="text-align: center;"><?php echo $row['loan_realization']; ?></td>
                            <td style="text-align: center;">
                                <?php if($row['loan_status'] == 'Waiting for SPV Approval') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['loan_status'] ?></span></h5>
                                <?php } elseif ($row['loan_status'] == 'SPV Approved') { ?>
                                    <h5><span class="badge badge-primary"><?php echo $row['loan_status'] ?></span></h5>
                                <?php } elseif ($row['loan_status'] == 'Approved') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['loan_status'] ?></span></h5>
                                <?php } elseif ($row['loan_status'] == 'SPV Declined') { ?>
                                    <h5><span class="badge badge-primary"><?php echo $row['loan_status'] ?></span></h5>
                                <?php } elseif ($row['loan_status'] == 'Declined') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['loan_status'] ?></span></h5>
                                <?php } elseif ($row['loan_status'] == 'Paid') { ?>
                                    <h5><span class="badge badge-dark"><?php echo $row['loan_status'] ?></span></h5>
                                <?php } ?>
                                <?php echo nl2br($row['loan_note']) ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('head/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                        <ion-icon name="person"></ion-icon>
                                    </a>
                                    <?php if ($row['loan_status'] == 'Approved' || $row['loan_status'] == 'Paid') { ?>
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
        order: [[ 5, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
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