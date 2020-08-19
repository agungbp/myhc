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
                        <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/panggilan_add'); ?>');" class="btn btn-primary pull-left">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Create Surat Panggilan
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
                            <th width="23%">Details</th>
                            <th>Description</th>
                            <th>Result</th>
                            <th>Create By</th>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <th width="5%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot style="text-align: center;">
                        <tr>
                            <th>Number</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th>Details</th>
                            <th>Description</th>
                            <th>Result</th>
                            <th>Create Date</th>
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
                        $this->db->select('panggilan.*, employee.employee_name, employee.section_code, employee.unit_code, employee.employee_position');
                        $this->db->from('panggilan');
                        $this->db->join('employee', 'panggilan.nik = employee.nik');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $panggilan = $this->db->get();

                        foreach ($panggilan->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['panggilan_number']; ?></td>
                            <td style="text-align: center;"><?php echo $row['nik']; ?></td>
                            <td><?php echo $row['employee_name']; ?></td>
                            <td>
                                <?php 
                                    $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                    if($section->num_rows() > 0){
                                        echo $section->row()->section_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td>
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
                            <td>
                                <?php 
                                    $date = date_create($row['panggilan_date']);
                                    $time = date_create($row['panggilan_time']);
                                    echo '<b>Date  : </b>' . date_format($date, "d F Y") . '<br>';
                                    echo '<b>Time  : </b>' . date_format($time, "H:i") . '<br>';
                                    echo '<b>Place : </b>' . $row['panggilan_place'] . '<br>'; 
                                    echo '<b>Meet : </b>' . $row['panggilan_meet']; 
                                ?>
                            </td>
                            <td><?php echo mb_strimwidth(nl2br($row['panggilan_description']), 0, 200, "..."); ?></td>
                            <td><?php echo nl2br($row['panggilan_result']); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    echo $row['panggilan_createdate'];
                                    
                                    $created = $this->db->get_where('employee', array('nik' => $row['createby'])); 
                                    if($created->num_rows() > 0){
                                        echo '<br> ' . $created->row()->employee_name;
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <a class="btn btn-info" href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/panggilan_result/'.$row['panggilan_id'] ); ?>');"><i class="fas fa-check"></i>&nbsp;Result</a>
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('humancapital/panggilan/print/'.$row['panggilan_id']); ?>" class="btn btn-dark" target="_blank">
                                                <ion-icon name="print"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/panggilan_edit/'.$row['panggilan_id']); ?>');">
                                                <ion-icon name="create"></ion-icon>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('humancapital/panggilan/delete/'.$row['panggilan_id']); ?>');">
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
                <?php include 'panggilan_add.php' ?>
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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