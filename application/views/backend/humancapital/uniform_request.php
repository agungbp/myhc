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
                            <th>Type</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Uniform</th>
                            <th width="10%">Request Date</th>
                            <th>Status</th>
                            <?php 
                                $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->unit_code;
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <th width="5%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Type</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Uniform</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <th>Options</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $this->db->from('employee');
                        $this->db->join('uniform_request', 'employee.nik = uniform_request.nik');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $uniformrequest = $this->db->get();
                        
                        foreach ($uniformrequest->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php if($row['uniformrequest_type'] == 'BARU') { ?>
                                    <h5><span class="badge badge-dark"><?php echo $row['uniformrequest_type'] ?></span></h5>
                                <?php } elseif ($row['uniformrequest_type'] == 'TUKAR') { ?>
                                    <h5><span class="badge badge-warning"><?php echo $row['uniformrequest_type'] ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['employee_name'] ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                    if($section->num_rows() > 0){
                                        echo $section->row()->section_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['uniformstock_code']; ?></td>
                            <td style="text-align: center;"><?php echo $row['uniformrequest_date'] ?></td>
                            <td style="text-align: center;">
                                <?php if($row['uniformrequest_status'] == 'Waiting for Approval') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['uniformrequest_status'] ?></span></h5>
                                <?php } elseif ($row['uniformrequest_status'] == 'Approved') { ?>
                                    <h5>
                                        <span class="badge badge-success">
                                            <?php 
                                                echo $row['uniformrequest_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['uniformrequest_status'] == 'Declined') { ?>
                                    <h5>
                                        <span class="badge badge-danger">
                                            <?php 
                                                echo $row['uniformrequest_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } ?>
                                <?php echo nl2br($row['uniformrequest_note']) ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <ion-icon name="create"></ion-icon>&nbsp;&nbsp;Update Status
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/uniform/change_status_approve/'. $row['uniformrequest_id']); ?>">Approve</a>
                                                    <a class="dropdown-item" href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/uniform_decline/'.$row['uniformrequest_id'] ); ?>');">Decline</a>
                                                </div>
                                            </div>
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

<div class="modal fade" id="modal-lg" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'rawatinap_add.php' ?>
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