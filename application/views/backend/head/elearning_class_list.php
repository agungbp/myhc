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
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Title</th>
                            <th width="15%">Create Date</th>
                            <th width="5%">Total Materi</th>
                            <th width="5%">Total Students</th>
                            <th width="5%">Status</th>
                            <th width="5%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Title</th>
                            <th>Create Date</th>
                            <th>Total Materi</th>
                            <th>Total Students</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $elearning = $this->db->getget_where('elearning_class', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($elearning as $row):
                    ?>
                        <tr>
                            <td><?php echo $row['class_name']; ?></td>
                            <td style="text-align: center;"><?php echo $row['class_date']; ?></td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('elearning_materi', array('class_id' => $row['class_id']))->num_rows() ?></td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('elearning_student', array('class_id' => $row['class_id']))->num_rows() ?></td>
                            <td style="text-align: center;">
                                <?php if($row['class_status'] == 'Active') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['class_status'] ?></span></h5>
                                <?php } elseif ($row['class_status'] == 'Inactive') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['class_status'] ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('head/materi/list/'.$row['class_id']); ?>" class="btn btn-light">
                                        <i class="fas fa-list-ul"></i>&nbsp;&nbsp;Materi
                                    </a>
                                    <a href="<?php echo site_url('head/student/list/'.$row['class_id']); ?>" class="btn btn-dark">
                                        <i class="fas fa-users"></i>&nbsp;&nbsp;Students
                                    </a>
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
                <?php include 'elearning_class_add.php' ?>
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
        order: [[ 1, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
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