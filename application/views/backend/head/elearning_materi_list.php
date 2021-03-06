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
            <div class="card-header">
                <a href="<?php echo site_url('head/class/list'); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;E-Learning List</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Title</th>
                            <th width="20%">Date</th>
                            <th width="15%">File</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Title</th>
                            <th>Date</th>
                            <th>File</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $elearning = $this->db->get_where('elearning_materi', array('class_id' => $class_id))->result_array();
                        foreach ($elearning as $row):
                    ?>
                        <tr>
                            <td><?php echo $row['materi_name']; ?></td>
                            <td style="text-align: center;">
                                <?php if ($row['materi_end_date'] != '' || $row['materi_end_date'] != NULL || $row['materi_end_date'] != '0000-00-00' || $row['materi_end_time'] != '' || $row['materi_end_time'] != NULL || $row['materi_end_time'] != '00:00:00'){
                                    echo $row['materi_create_date'] . ' ' . $row['materi_create_time']  . ' - ' . $row['materi_end_date'] . ' ' . $row['materi_end_time']; 
                                } elseif ($row['materi_end_date'] == '' || $row['materi_end_date'] == NULL || $row['materi_end_date'] == '0000-00-00' || $row['materi_end_time'] == '' || $row['materi_end_time'] == NULL || $row['materi_end_time'] == '00:00:00') {
                                    echo $row['materi_create_date'] . ' ' . $row['materi_create_time'];
                                }
                                ?>
                            </td>
                            <td  style="text-align: center;">
                                <a href="<?php echo site_url('uploads/materi/'). $row['materi_file']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                    <i class="fas fa-download mr-1"></i>Download
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                     if ($row['materi_end_date'] != '' || $row['materi_end_date'] != NULL || $row['materi_end_date'] != '0000-00-00' || $row['materi_end_time'] != '' || $row['materi_end_time'] != NULL || $row['materi_end_time'] != '00:00:00'){
                                        if (strtotime($row['materi_end_date'] . ' ' . $row['materi_end_time']) > strtotime('now')) { ?>
                                            <h5><span class="badge badge-success">Available</span></h5>   
                                <?php   } else { ?>
                                            <h5><span class="badge badge-danger">Expired</span></h5>
                                <?php   }
                                     } else {
                                ?>
                                        <h5><span class="badge badge-success">Available</span></h5>  
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

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'elearning_materi_add.php' ?>
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
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
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