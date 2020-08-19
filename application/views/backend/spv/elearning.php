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
                    $this->db->from('elearning_class');
                    $this->db->join('elearning_student', 'elearning_class.class_id = elearning_student.class_id');
                    $this->db->join('employee', 'elearning_student.nik = employee.nik');
                    $this->db->where('student_status !=', 'Registered'); 
                    $this->db->where('student_status !=', 'Done'); 
                    $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                    $this->db->where('elearning_class.branch_code', $this->session->userdata('login_branch'));
                    $elearning = $this->db->get();
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-data">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Employee</th>
                            <th>Unit</th>
                            <th>Class Name</th>
                            <th>Period</th>
                            <th width="10%">Apply Date</th>
                            <th width="10%">Status</th>
                            <th width="5%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Employee</th>
                            <th>Unit</th>
                            <th>Class Name</th>
                            <th>Period</th>
                            <th>Apply Date</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($elearning->result_array() as $row): ?>
                        <tr>
                            <td><?php echo $row['employee_name'] ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code']));
                                    if($unit->num_rows() > 0){
                                        echo $unit->row()->unit_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['class_name']; ?></td>
                            <td style="text-align: center;"><?php echo $row['class_periode']; ?></td>
                            <td style="text-align: center;"><?php echo $row['student_createdate']; ?></td>
                            <td style="text-align: center;">
                                <?php if($row['student_status'] == 'Waiting for SPV Approval') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['student_status'] ?></span></h5>
                                <?php } elseif ($row['student_status'] == 'SPV Approved') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['student_status'] ?></span></h5>
                                <?php } elseif ($row['student_status'] == 'SPV Declined') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['student_status'] ?></span></h5>
                                <?php } elseif ($row['student_status'] == 'Declined') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['student_status'] ?></span></h5>
                                <?php } elseif ($row['student_status'] == 'Pending') { ?>
                                    <h5><span class="badge badge-warning"><?php echo $row['student_status'] ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('spv/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                        <ion-icon name="person"></ion-icon>
                                    </a>
                                    &nbsp;
                                    <?php if ($row['student_status'] == 'Waiting for SPV Approval') { ?>
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <ion-icon name="create"></ion-icon>&nbsp;Update Status
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?php echo site_url('spv/elearning/change_status_approved/'. $row['student_id']); ?>">Approve</a>
                                                <a class="dropdown-item" href="<?php echo site_url('spv/elearning/change_status_declined/'. $row['student_id']); ?>">Decline</a>
                                            </div>
                                        </div>
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
        order: [[ 4, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
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