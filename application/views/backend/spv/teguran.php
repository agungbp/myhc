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
                            <th width="15%">Number</th>
                            <th>Employee</th>
                            <th>Unit</th>
                            <th width="20%">Periode</th>
                            <th>Description</th>
                            <th width="7%">Status</th>
                            <th width="5%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Number</th>
                            <th>Employee</th>
                            <th>Unit</th>
                            <th>Periode</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;
                        $this->db->from('teguran');
                        $this->db->join('employee', 'teguran.nik = employee.nik');
                        $this->db->where('section_code', $this->session->userdata('login_section'));
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $teguran = $this->db->get();

                        foreach ($teguran->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['teguran_number']; ?></td>
                            <td><?php echo $row['employee_name']; ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code']));
                                    if($unit->num_rows() > 0){
                                        echo $unit->row()->unit_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['teguran_createdate'] . ' - ' . $row['teguran_enddate']; ?></td>
                            <td><?php echo nl2br($row['teguran_description']); ?></td>
                            <td style="text-align: center;">
                                <?php if (strtotime($row['teguran_enddate']) > strtotime('now')) { ?>
                                    <h5><span class="badge badge-success">Active</span></h5>   
                                <?php } else { ?>
                                    <h5><span class="badge badge-danger">Expired</span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('spv/teguran/print/'.$row['teguran_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                        <ion-icon name="print"></ion-icon>
                                    </a>
                                    <a href="<?php echo site_url('spv/employee/edit/'. $row['nik']); ?>" class="btn btn-info">
                                        <ion-icon name="person"></ion-icon>
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

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'teguran_add.php' ?>
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
        order: [[ 3, "desc" ]],
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