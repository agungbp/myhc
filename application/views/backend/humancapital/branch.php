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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th width="6%">Code</th>
                                        <th>Name</th>
                                        <th>Ctrno</th>
                                        <th>Address</th>
                                        <th>Pic</th>
                                        <th>Email</th>
                                        <th width="10%">Phone</th>
                                        <th width="10%">Fax</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Ctrno</th>
                                        <th>Address</th>
                                        <th>Pic</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Fax</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $count = 1;
                                    $branch = $this->db->get('branch')->result_array();

                                    foreach ($branch as $row):
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $row['branch_code']; ?></td>
                                        <td><?php echo $row['branch_desc']; ?></td>
                                        <td><?php echo $row['branch_ctrno']; ?></td>
                                        <td><?php echo $row['branch_address']; ?></td>
                                        <td><?php echo $row['branch_pic']; ?></td>
                                        <td><?php echo $row['branch_email']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['branch_phone']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['branch_fax']; ?></td>
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