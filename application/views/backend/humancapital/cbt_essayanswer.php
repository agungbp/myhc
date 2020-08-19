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
                <a href="<?php echo site_url('humancapital/essay/list/' . $exam_id . '/' . $questionpack_id); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Essay List</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabel-data" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th width="3%">#</th>
                                <th width="15%">Participants</th>
                                <th>Answer</th>
                                <th width="10%">Nilai</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Participants</th>
                                <th>Answer</th>
                                <th>Nilai</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                        $count = 1;
                        $this->db->from('cbt_answer');
                        $this->db->join('cbt_question', 'cbt_answer.question_id = cbt_question.question_id');
                        $this->db->join('cbt_participants', 'cbt_answer.participants_id = cbt_participants.participants_id');
                        $this->db->where('cbt_question.question_id', $question_id);
                        $this->db->where('cbt_answer.exam_id', $exam_id);
                        $answer = $this->db->get();
                        
                        // $question = $this->db->get_where('cbt_question', array('questionpack_id' => $questionpack_id))->result_array();
                        
                        foreach ($answer->result_array() as $row): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $count++; ?></td>
                            <td>
                                <?php 
                                    $cek = $this->db->get_where('cbt_exam', array('exam_id' => $row['exam_id']))->row()->user_type;
                                    if($cek == 'EMPLOYEE'){ 
                                        echo $this->db->get_where('employee', array('nik' => $row['nik']))->row()->employee_name; 
                                    } else {
                                        echo $this->db->get_where('candidate', array('candidate_ktp' => $row['nik']))->row()->candidate_name; 
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['answer_answer']; ?></td>
                            <td style="text-align: center;">
                                <?php echo form_open(site_url('humancapital/essay/submit/' . $row['answer_id'] . '/' . $question_id . '/' . $exam_id . '/' . $questionpack_id), array('enctype' => 'multipart/form-data')); ?>
                                    <div class="btn-group">
                                        <input type="number" class="form-control" name="answer_score" value="<?php echo $row['answer_score'] ?>" min="0" max="<?php echo $row['question_bobot'] ?>" required>
                                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i></button>
                                    </div>
                                <?php echo form_close(); ?>
                                <?php
                                    if($row['answer_result'] != NULL){
                                        echo 'Telah dinilai';
                                    } else {
                                        echo '';
                                    }
                                ?>
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

<div class="modal fade" id="modal-lg2" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'cbt_question_addessay.php' ?>
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
        order: [[ 0, "asc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
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