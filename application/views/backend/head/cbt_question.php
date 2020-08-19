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
                <a href="<?php echo site_url('head/questionpack/list'); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Question Pack List</a>
                <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Question</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="3%">#</th>
                            <th>Question</th>
                            <th width="7%">Key</th>
                            <th width="7%">Bobot</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Key</th>
                            <th>Bobot</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;
                        $question = $this->db->get_where('cbt_question', array('questionpack_id' => $questionpack_id))->result_array();
                        $questionessay = $this->db->get_where('cbt_questionessay', array('questionpack_id' => $questionpack_id))->result_array();

                        foreach ($question as $row):
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
                                        <br>
                                        <div class="row">
                                            <div class="col-1 text-center text-bold">A.</div>
                                            <?php if($row['question_answer_a_file'] != null) { ?>
                                                <div class="col-1">
                                                    <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_a_file']); ?>" width="100%" />
                                                </div>
                                            <?php } ?>
                                            <div class="col-10"><?php echo $row['question_answer_a']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1 text-center text-bold">B.</div>
                                            <?php if($row['question_answer_b_file'] != null) { ?>
                                                <div class="col-1">
                                                    <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_b_file']); ?>" width="100%" />
                                                </div>
                                            <?php } ?>
                                            <div class="col-10"><?php echo $row['question_answer_b']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1 text-center text-bold">C.</div>
                                            <?php if($row['question_answer_c_file'] != null) { ?>
                                                <div class="col-1">
                                                    <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_c_file']); ?>" width="100%" />
                                                </div>
                                            <?php } ?>
                                            <div class="col-10"><?php echo $row['question_answer_c']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1 text-center text-bold">D.</div>
                                            <?php if($row['question_answer_d_file'] != null) { ?>
                                                <div class="col-1">
                                                    <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_d_file']); ?>" width="100%" />
                                                </div>
                                            <?php } ?>
                                            <div class="col-10"><?php echo $row['question_answer_d']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1 text-center text-bold">E.</div>
                                            <?php if($row['question_answer_e_file'] != null) { ?>
                                                <div class="col-1">
                                                    <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_e_file']); ?>" width="100%" />
                                                </div>
                                            <?php } ?>
                                            <div class="col-10"><?php echo $row['question_answer_e']; ?></div>
                                        </div>
                                    </td>
                                    <td style="text-align: center;"><?php echo $row['question_answer_key']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['question_bobot']; ?></td>
                                </tr>
                            <?php 
                                endforeach; 
                                foreach ($questionessay as $row2):
                            ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $count++; ?></td>
                                        <td>
                                            <div class="row">
                                                <?php if($row2['questionessay_question_file'] != null) { ?>
                                                    <div class="col-1">
                                                        <img src="<?php echo $this->get_model->get_image_question_url($row['questionessay_question_file']); ?>" width="100%" />
                                                    </div>
                                                <?php } ?>
                                                <div class="col-11">
                                                    <?php echo $row2['questionessay_question']; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">Essay</td>
                                        <td style="text-align: center;"><?php echo $row2['questionessay_bobot']; ?></td>
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