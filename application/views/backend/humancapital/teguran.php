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
                if (strpos($usercek, 'SVU') !== FALSE) { 
            ?>
                    <div class="card-header">
                        <a href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/teguran_add'); ?>');" class="btn btn-primary pull-left">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Create Surat Teguran
                        </a>
                    </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Number</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th>Periode</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th width="7%">Status</th>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <th width="5%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Number</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th>Periode</th>
                            <th>Description</th>
                            <th>Created By</th>
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
                        $count = 1;
                        $this->db->select('teguran.*, employee.employee_name, employee.section_code, employee.unit_code, employee.employee_position');
                        $this->db->from('teguran');
                        $this->db->join('employee', 'teguran.nik = employee.nik');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $teguran = $this->db->get();

                        foreach ($teguran->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['teguran_number']; ?></td>
                            <td style="text-align: center;"><?php echo $row['nik']; ?></td>
                            <td><?php echo $row['employee_name']; ?></td>
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
                            <td><?php echo $row['employee_position']; ?></td>
                            <td style="text-align: center;"><?php echo $row['teguran_createdate'] . ' - ' . $row['teguran_enddate']; ?></td>
                            <td><?php echo nl2br($row['teguran_description']); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    echo $row['teguran_createdate'];
                                    
                                    $created = $this->db->get_where('employee', array('nik' => $row['createby'])); 
                                    if($created->num_rows() > 0){
                                        echo '<br> ' . $created->row()->employee_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if (strtotime($row['teguran_enddate']) > strtotime('now')) { ?>
                                    <h5><span class="badge badge-success">Active</span></h5>   
                                <?php } else { ?>
                                    <h5><span class="badge badge-danger">Expired</span></h5>
                                <?php } ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('humancapital/teguran/print/'.$row['teguran_id']); ?>" class="btn btn-dark" target="_blank">
                                                <ion-icon name="print"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm " onclick="FormModalMd('<?php echo site_url('modal/popup/teguran_edit/'.$row['teguran_id']); ?>');">
                                                <ion-icon name="create"></ion-icon>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('humancapital/teguran/delete/'.$row['teguran_id']); ?>');">
                                                <ion-icon name="trash"></ion-icon>
                                            </button>
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
        order: [[ 6, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
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