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
        <?php
            $count = 1;
            $this->db->from('cbt_participants');
            $this->db->join('cbt_exam', 'cbt_participants.exam_id = cbt_exam.exam_id');
            $this->db->join('employee', 'employee.nik = cbt_participants.nik');
            $this->db->where('cbt_participants.exam_id', $exam_id);
            $participants = $this->db->get();

            
        ?>

        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Participants</span>
                        <span class="info-box-number">
                            <?php 
                                $this->db->from('cbt_participants');
                                $this->db->join('cbt_exam', 'cbt_participants.exam_id = cbt_exam.exam_id');
                                $this->db->where('cbt_participants.exam_id', $exam_id);
                                $par = $this->db->get();
                                echo $par->num_rows();
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sort-numeric-up-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Highest Score</span>
                        <span class="info-box-number">
                            <?php 
                                $this->db->select_max('participants_score');
                                $this->db->from('cbt_participants');
                                $this->db->where('exam_id', $exam_id);
                                $max = $this->db->get();
                                echo round($max->row()->participants_score, 2);
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-sort-numeric-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Lowest Score</span>
                        <span class="info-box-number">
                            <?php 
                                $this->db->select_min('participants_score');
                                $this->db->from('cbt_participants');
                                $this->db->where('exam_id', $exam_id);
                                $min = $this->db->get();
                                echo round($min->row()->participants_score, 2);
                            ?>
                        </span>
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-grip-lines"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Average Score</span>
                        <span class="info-box-number">
                            <?php 
                                $this->db->select_avg('participants_score');
                                $this->db->from('cbt_participants');
                                $this->db->where('exam_id', $exam_id);
                                $avg = $this->db->get();
                                echo round($avg->row()->participants_score, 2);
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Default box -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?php echo site_url('head/exam/list'); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Exam List</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="tabel-data" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th width="3%">#</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Correct</th>
                                    <th>Wrong</th>
                                    <th>Score</th>
                                    <th width="10%">Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Correct</th>
                                    <th>Wrong</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach ($participants->result_array() as $row): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $count++; ?></td>
                                    <td style="text-align: center;"><?php echo $row['employee_name']; ?></td>
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
                                    <td style="text-align: center;"><?php echo $row['participants_start']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['participants_end']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['participants_correct']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['participants_wrong']; ?></td>
                                    <td style="text-align: center;"><?php echo round($row['participants_score'], 2); ?></td>
                                    <td style="text-align: center;">
                                        <?php if($row['participants_status'] == 'Take On') { ?>
                                            <h5><span class="badge badge-primary"><?php echo $row['participants_status'] ?></span></h5>
                                        <?php } elseif ($row['participants_status'] == 'Finished') { ?>
                                            <h5><span class="badge badge-success"><?php echo $row['participants_status'] ?></span></h5>
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
            </div>
        </div>

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
                <?php include 'cbt_question_add.php' ?>
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
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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