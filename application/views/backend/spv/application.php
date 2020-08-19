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
                                    <th>Employee</th>
                                    <th>Applied Department</th>
                                    <th>Applied Unit</th>
                                    <th>Applied Position</th>
                                    <th>Placement</th>
                                    <th>Date</th>
                                    <th width="5%">Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>Employee</th>
                                    <th>Applied Department</th>
                                    <th>Applied Unit</th>
                                    <th>Applied Position</th>
                                    <th>Placement</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $this->db->select('employee.*, application.*, vacancy.*');
                                $this->db->from('employee');
                                $this->db->join('application', 'employee.nik = application.nik');
                                $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                $this->db->where('user_type', 'EMPLOYEE');
                                $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();

                                foreach ($sql->result_array() as $row):
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row['employee_name']; ?></td>
                                    <td style="text-align: center;"><?php echo $this->db->get_where('section', array('section_code' => $row['vacancy_section']))->row()->section_name; ?></td>
                                    <td style="text-align: center;"><?php echo $this->db->get_where('unit', array('unit_code' => $row['vacancy_unit']))->row()->unit_name; ?></td>
                                    <td style="text-align: center;"><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['vacancy_placement']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['application_date']; ?></td>
                                    <td style="text-align: center;">
                                        <?php if($row['application_status'] == 'Applied') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'SPV Approved') { ?>
                                            <h5><span class="badge badge-primary"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'On Review') { ?>
                                            <h5><span class="badge badge-warning"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Psikotest') { ?>
                                            <h5><span class="badge badge-info"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Interview') { ?>
                                            <h5><span class="badge badge-light"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Hired') { ?>
                                            <h5><span class="badge badge-success"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'SPV Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Hire Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Waiting for SPV Approval') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('spv/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                                <ion-icon name="person"></ion-icon>
                                            </a>
                                            <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/application_vacancy/'.$row['vacancy_id'] ); ?>');" class="btn btn-warning">
                                                <ion-icon name="briefcase"></ion-icon>
                                            </a>
                                            &nbsp;
                                            <?php if ($row['application_status'] == 'Applied' || $row['application_status'] == 'SPV Declined') { ?>
                                                <div class="dropdown" style="margin-bottom: 3px;">
                                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <ion-icon name="create"></ion-icon>&nbsp;Update Status
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="<?php echo site_url('spv/application/approve/'. $row['nik']); ?>">Approve</a>
                                                        <a class="dropdown-item" href="<?php echo site_url('spv/application/decline/'. $row['nik']); ?>">Decline</a>
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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