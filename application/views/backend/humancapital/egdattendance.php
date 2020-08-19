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
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Event</a>
                    </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Event Name</th>
                            <th>Details</th>
                            <th width="10%">Token</th>
                            <th width="5%">Total Participants</th>
                            <th>Create By</th>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <th width="18%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Event Name</th>
                            <th>Details</th>
                            <th>Token</th>
                            <th>Total Participants</th>
                            <th>Create By</th>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <th>Options</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $egdattendance = $this->db->get_where('egd_attendance', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($egdattendance as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['egdattendance_name']; ?></td>
                            <td>
                                <?php 
                                    echo '<b>Date : </b>' . $row['egdattendance_date'] . '<br> ';
                                    echo '<b>Time : </b>' . $row['egdattendance_time'] . '<br> ';
                                    echo '<b>Place : </b>' . $row['egdattendance_place']; 
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['egdattendance_token']; ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $this->db->from('egd_participants');
                                    $this->db->where('egdattendance_id', $row['egdattendance_id']);
                                    $participants = $this->db->get();
                                    
                                    echo $participants->num_rows();
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    echo $row['createdate'];
                                    
                                    $created = $this->db->get_where('employee', array('nik' => $row['createby'])); 
                                    if($created->num_rows() > 0){
                                        echo '<br> ' . $created->row()->employee_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('humancapital/egdparticipants/list/'.$row['egdattendance_id']); ?>" class="btn btn-dark">
                                                <i class="fas fa-users"></i>&nbsp;&nbsp;Participants
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('humancapital/egdattendance/qrcode/' . $row['egdattendance_token'] . '/' . $row['egdattendance_id']); ?>" class="btn btn-dark" target="_blank">
                                                <i class="fas fa-qrcode"></i>
                                            </a>
                                            <a href="#" class="btn btn-success" onclick="FormModalMd('<?php echo site_url('modal/popup/egdattendance_edit/'.$row['egdattendance_id'] ); ?>');">
                                                <ion-icon name="create"></ion-icon>
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/egdattendance/delete/'. $row['egdattendance_id']); ?>');">
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
                <?php include 'egdattendance_add.php' ?>
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