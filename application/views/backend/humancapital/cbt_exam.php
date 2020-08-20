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
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Exam</a>
                    </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Test Name</th>
                            <th>For</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Question Package</th>
                            <!-- <th>Random</th> -->
                            <th width="5%">Total Question</th>
                            <th width="5%">Total Participants</th>
                            <th>Create By</th>
                            <th>Token</th>
                            <th>Status</th>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <th width="23%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Test Name</th>
                            <th>For</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <!-- <th>Random</th> -->
                            <th>Question Package</th>
                            <th>Total Question</th>
                            <th>Total Participants</th>
                            <th>Create By</th>
                            <th>Token</th>
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
                        $exam = $this->db->get_where('cbt_exam', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($exam as $row):
                    ?>
                        <tr>
                            <td><?php echo $row['exam_name']; ?></td>
                            <td style="text-align: center;"><?php echo $row['user_type'] . ' ' . $row['exam_section'] ?></td>
                            <td style="text-align: center;"><?php echo $row['exam_start_date'] . ' ' . $row['exam_start_time']; ?></td>
                            <td style="text-align: center;"><?php echo $row['exam_end_date'] . ' ' . $row['exam_end_time']; ?></td>
                            <td><?php echo $this->db->get_where('cbt_questionpack', array('questionpack_id' => $row['questionpack_id']))->row()->questionpack_name; ?></td>
                            <!-- <td style="text-align: center;"><?php // echo $row['exam_random']; ?></td> -->
                            <td style="text-align: center;"><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id']))->num_rows(); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $this->db->from('cbt_participants');
                                    $this->db->join('cbt_exam', 'cbt_participants.exam_id = cbt_exam.exam_id');
                                    $this->db->where('cbt_participants.exam_id', $row['exam_id']);
                                    $par = $this->db->get();
                                    echo $par->num_rows();
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
                            <td style="text-align: center;"><h4><span class="badge badge-info"><?php echo $row['exam_token']; ?></span></h4></td>
                            <td style="text-align: center;">
                                <?php if(date('Y-m-d H:i:s') < $row['exam_end_date'] . ' ' . $row['exam_end_time'] && date('Y-m-d H:i:s') > $row['exam_start_date'] . ' ' . $row['exam_start_time']) { ?>
                                    <h5><span class="badge badge-success">Sedang Berlangsung</span></h5>
                                <?php } elseif(date('Y-m-d H:i:s') < $row['exam_start_date'] . ' ' . $row['exam_start_time']) { ?>
                                    <h5><span class="badge badge-secondary">Belum Dimulai</span></h5>
                                <?php } elseif(date('Y-m-d H:i:s') > $row['exam_end_date'] . ' ' . $row['exam_end_time']) { ?>
                                    <h5><span class="badge badge-danger">Sudah Berakhir</span></h5>
                                <?php } ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('humancapital/question/list/'.$row['questionpack_id']); ?>" class="btn btn-light">
                                                <i class="fas fa-list-ul"></i>&nbsp;&nbsp;Question
                                            </a>
                                            <a href="<?php echo site_url('humancapital/participants/list/'.$row['exam_id']); ?>" class="btn btn-dark">
                                                <i class="fas fa-users"></i>&nbsp;&nbsp;Participants
                                            </a>
                                        </div>
                                        <?php if(date('Y-m-d H:i:s') > $row['exam_end_date'] . ' ' . $row['exam_end_time']) { ?>
                                            <a href="<?php echo site_url('humancapital/essay/list/' . $row['exam_id'] . '/' . $row['questionpack_id']); ?>" class="btn btn-info">
                                                <i class="fas fa-check"></i>&nbsp;&nbsp;Review Essay (<?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id'], 'question_type' => 'Essay'))->num_rows(); ?>)
                                            </a>
                                        <?php } ?>
                                        <div class="btn-group">
                                            <?php if(date('Y-m-d H:i:s') < $row['exam_start_date'] . ' ' . $row['exam_start_time']) { ?>
                                                <a href="#" class="btn btn-success" onclick="FormModal('<?php echo site_url('modal/popup/cbt_exam_edit/'.$row['exam_id'] ); ?>');">
                                                    <ion-icon name="create"></ion-icon>
                                                </a>
                                                <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/exam/delete/'. $row['exam_id']); ?>');">
                                                    <ion-icon name="trash"></ion-icon>
                                                </a>
                                            <?php } ?>
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
                <?php include 'cbt_exam_add.php' ?>
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