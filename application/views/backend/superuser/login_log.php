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
            <?php echo form_open(site_url('superuser/log/filter')); ?>
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-1 col-12" style="margin-top: 5px;">Login Period</div>
                        <div class="col-lg-2 col-12">
                            <input type="date" class="form-control" name="start" value="<?php echo $start ?>" required>
                        </div>
                        <div class="col-lg-2 col-12">
                            <input type="date" class="form-control" name="end" value="<?php echo $end ?>" required>
                        </div>
                        <div class="col-lg-1 col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</button>
                        </div>
                    </div>
                </div> <!-- /.card-header -->
            <?php echo form_close(); ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Application</th>
                            <th>Type</th>
                            <th>IP Address</th>
                            <th>Browser</th>
                            <th>OS</th>
                            <th>Time</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Application</th>
                            <th>Type</th>
                            <th>IP Address</th>
                            <th>Browser</th>
                            <th>OS</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $this->db->from('login_log');
                        $this->db->join('employee', 'employee.nik = login_log.nik');
                        $this->db->where('log_time >=', $start);
                        $this->db->where('log_time <=', $end);
                        $log = $this->db->get();

                        foreach ($log->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['nik']; ?></td>
                            <td style="text-align: center;"><?php echo $row['employee_name']; ?></td>
                            <td style="text-align: center;"><?php echo $row['log_application']; ?></td>
                            <td style="text-align: center;"><?php echo $row['log_type']; ?></td>
                            <td style="text-align: center;"><?php echo $row['log_ipaddress']; ?></td>
                            <td style="text-align: center;"><?php echo $row['log_browser']; ?></td>
                            <td style="text-align: center;"><?php echo $row['log_os']; ?></td>
                            <td style="text-align: center;"><?php echo $row['log_time']; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['log_status'] == 'Success') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['log_status'] ?></span></h5>
                                <?php } elseif ($row['log_status'] == 'Failed') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['log_status'] ?></span></h5>
                                <?php } ?>
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
        order: [[ 7, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
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