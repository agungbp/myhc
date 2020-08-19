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
                <a href="<?php echo site_url('humancapital/exam/list'); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Exam List</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="3%">#</th>
                            <th>Question</th>
                            <th width="10%">Bobot</th>
                            <th width="15%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Bobot</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;

                        $this->db->from('cbt_question');
                        $this->db->join('cbt_questionpack', 'cbt_question.questionpack_id = cbt_questionpack.questionpack_id');
                        $this->db->join('cbt_exam', 'cbt_exam.questionpack_id = cbt_questionpack.questionpack_id');
                        $this->db->where('cbt_question.questionpack_id', $questionpack_id);
                        $this->db->where('exam_id', $exam_id);
                        $this->db->where('question_type', 'Essay');
                        $essay = $this->db->get();

                        // $question = $this->db->get_where('cbt_question', array('questionpack_id' => $questionpack_id))->result_array();

                        foreach ($essay->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $count++; ?></td>
                            <td>
                                <div class="row">
                                    <?php if($row['question_question_file'] != null) { ?>
                                        <div class="col-1">
                                            <img src="<?php echo $this->get_model->get_image_question_url($row['question_question_file']); ?>" width="100%" />
                                        </div>
                                    <?php } ?>
                                    <div class="col-11">
                                        <?php echo $row['question_question']; ?>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;"><?php echo $row['question_bobot']; ?></td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('humancapital/essay/answerlist/' . $row['question_id'] . '/' . $row['exam_id'] . '/' . $row['questionpack_id']); ?>" class="btn btn-dark">
                                        <i class="fas fa-list-ul"></i>&nbsp;&nbsp;Answer List
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