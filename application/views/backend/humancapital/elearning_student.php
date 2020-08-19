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
                    <div class="card-header">
                        <a href="<?php echo site_url('humancapital/class/list'); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;E-Learning List</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="tabel-data" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>NIK</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th width="10%">Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>NIK</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                    $this->db->from('employee');
                                    $this->db->join('elearning_student', 'employee.nik = elearning_student.nik');
                                    $this->db->join('elearning_class', 'elearning_student.class_id = elearning_class.class_id');
                                    $this->db->where('elearning_class.class_id', $class_id);
                                    $this->db->where('student_status !=', 'Waiting for SPV Approval');
                                    $this->db->where('student_status !=', 'SPV Approved');
                                    $this->db->where('student_status !=', 'Pending');
                                    $this->db->where('student_status !=', 'SPV Declined');
                                    $this->db->where('student_status !=', 'Declined');
                                    $sql = $this->db->get();

                                    foreach ($sql->result_array() as $row):
                                ?>
                                    <tr>
                                        <td style="text-align: center;" width="10%"><?php echo $row['nik']; ?></td>
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
                                        <td><?php echo $row['employee_position']; ?></td>
                                        <td style="text-align: center;">
                                            <?php if($row['student_status'] == 'Registered') { ?>
                                                <h5><span class="badge badge-info"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } elseif ($row['student_status'] == 'Done') { ?>
                                                <h5><span class="badge badge-dark"><?php echo $row['student_status'] ?></span></h5>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;" width="10%">
                                            <?php if($row['student_status'] == 'Registered'){ ?>
                                                <a href="<?php echo site_url('humancapital/student/done/'. $row['student_id'] . '/' . $row['class_id']); ?>" class="btn btn-dark">
                                                    <i class="fas fa-check"></i>&nbsp;&nbsp;Done
                                                </a>
                                            <?php } ?>
                                            <div class="btn-group">
                                                <a href="<?php echo site_url('humancapital/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                                    <ion-icon name="person"></ion-icon>
                                                </a>
                                                <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/student/delete/'. $row['student_id'] . '/' . $row['class_id']); ?>');">
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
        order: [[ 1, "asc" ]],
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