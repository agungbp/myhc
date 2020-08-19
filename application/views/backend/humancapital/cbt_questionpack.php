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
            <?php 
                $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->unit_code;
                if (strpos($usercek, 'DVU') !== FALSE) { 
            ?>
                    <div class="card-header">
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Package</a>
                    </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Name</th>
                            <th width="10%">Total Question</th>
                            <th width="15%">Create By</th>
                            <th width="10%">Status</th>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <th width="15%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Total Question</th>
                            <th>Create By</th>
                            <th>Status</th>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <th>Options</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;
                        $questionpack = $this->db->get_where('cbt_questionpack', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($questionpack as $row):
                    ?>
                        <tr>
                            <td><?php echo $row['questionpack_name']; ?></td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id']))->num_rows(); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    echo $row['questionpack_createdate'];

                                    $created = $this->db->get_where('employee', array('nik' => $row['createby'])); 
                                    if($created->num_rows() > 0){
                                        echo '<br> ' . $created->row()->employee_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['questionpack_status'] == 'Waiting for SPV Approval') { ?>
                                    <h5><span class="badge badge-warning"><?php echo $row['questionpack_status'] ?></span></h5>
                                <?php } elseif ($row['questionpack_status'] == 'Approved') { ?>
                                    <h5>
                                        <span class="badge badge-success">
                                            <?php 
                                                echo $row['questionpack_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['questionpack_status'] == 'Declined') { ?>
                                    <h5>
                                        <span class="badge badge-danger">
                                            <?php 
                                                echo $row['questionpack_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['questionpack_status'] == 'Draft') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['questionpack_status'] ?></span></h5>
                                <?php } ?>
                                <?php echo nl2br($row['questionpack_note']); ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <a href="<?php echo site_url('humancapital/question/list/'.$row['questionpack_id']); ?>" class="btn btn-dark">
                                            <i class="fas fa-list-ul"></i>&nbsp;&nbsp;Question
                                        </a>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-success" onclick="FormModalMd('<?php echo site_url('modal/popup/cbt_questionpack_edit/'.$row['questionpack_id']); ?>');">
                                                <ion-icon name="create"></ion-icon>
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/questionpack/delete/'. $row['questionpack_id']); ?>');">
                                                <ion-icon name="trash"></ion-icon>
                                            </a>
                                        </div>
                                    </td>
                            <?php } ?>
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
                <?php include 'cbt_questionpack_add.php' ?>
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
                    columns: [ 0, 1, 3 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 3 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 3 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 3 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 3 ]
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