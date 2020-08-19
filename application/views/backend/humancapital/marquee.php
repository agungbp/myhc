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
                <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Running Text</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="15%">For</th>
                            <th>Announcement</th>
                            <th width="15%">Create By</th>
                            <th width="10%">Status</th>
                            <th width="5%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>For</th>
                            <th>Announcement</th>
                            <th>Create By</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $marquee = $this->db->get_where('marquee', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($marquee as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['user_type'] ?></td>
                            <td><?php echo nl2br($row['marquee_announcement']); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    echo $row['marquee_date'];
                                    
                                    $created = $this->db->get_where('employee', array('nik' => $row['createby'])); 
                                    if($created->num_rows() > 0){
                                        echo '<br> ' . $created->row()->employee_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['marquee_status'] == 'Active') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['marquee_status'] ?></span></h5>
                                <?php } elseif ($row['marquee_status'] == 'Inactive') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['marquee_status'] ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-success" onclick="FormModalMd('<?php echo site_url('modal/popup/marquee_edit/'.$row['marquee_id'] ); ?>');">
                                        <ion-icon name="create"></ion-icon>
                                    </a>
                                    <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/marquee/delete/'. $row['marquee_id']); ?>');">
                                        <ion-icon name="trash"></ion-icon>
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
                <?php include 'marquee_add.php' ?>
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
        order: [[ 2, "desc" ]],
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