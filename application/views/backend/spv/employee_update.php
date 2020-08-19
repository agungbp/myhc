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
                        <div class="table-responsive">
                        <table id="tabel-data" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th width="10%">Update ID</th>
                                    <th>Employee</th>
                                    <th width="10%">Type</th>
                                    <th width="10%">Process</th>
                                    <th width="15%">Request Date</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>Update ID</th>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>Process</th>
                                    <th>Request Date</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $count = 1;

                                $this->db->from('employee_update');
                                $this->db->join('employee', 'employee_update.nik = employee.nik');
                                $this->db->where('update_type', 'Shift');
                                $this->db->where('section_code', $this->session->userdata('login_section'));
                                $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();

                                foreach ($sql->result_array() as $row):
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row['update_id']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['employee_name']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['update_type']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['update_process']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['update_date']; ?></td>
                                    <td style="text-align: center;">
                                        <?php if($row['update_status'] == 'Waiting for Approval') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['update_status'] ?></span></h5>
                                        <?php } elseif ($row['update_status'] == 'Approved') { ?>
                                            <h5><span class="badge badge-success"><?php echo $row['update_status'] ?></span></h5>
                                        <?php } elseif ($row['update_status'] == 'Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['update_status'] ?></span></h5>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <?php if($row['update_type'] == 'Shift' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('spv/employee/update_shift/'. $row['update_id'] . '/' . $row['nik']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
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