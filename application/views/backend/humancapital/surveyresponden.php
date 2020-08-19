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
                <a href="<?php echo site_url('humancapital/survey/list'); ?>" class="btn btn-danger pull-left"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;E-Survey List</a>
            </div>
            <div class="card-body">
                <?php 
                    $this->db->from('survey_question');
                    $this->db->where('survey_id', $survey_id);
                    $this->db->order_by('surveyquestion_time', 'ASC');
                    $question = $this->db->get();

                    // $question = $this->db->get_where('survey_question', array('survey_id' => $survey_id))->result_array(); ?>
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="3%">#</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <?php foreach ($question->result_array() as $row): ?>
                                <th><?php echo $row['surveyquestion_question']; ?></th>
                            <?php endforeach; ?>
                            <th width="5%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <?php foreach ($question->result_array() as $row): ?>
                                <th><?php echo $row['surveyquestion_question']; ?></th>
                            <?php endforeach; ?>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;

                        $this->db->from('employee');
                        $this->db->join('survey_responden', 'employee.nik = survey_responden.nik');
                        $this->db->where('survey_id', $survey_id);
                        
                        $responden = $this->db->get();                        

                        foreach ($responden->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $count++; ?></td>
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
                            <?php 
                                $this->db->from('survey_responds');
                                $this->db->join('survey_question', 'survey_question.surveyquestion_id = survey_responds.surveyquestion_id');
                                $this->db->where('survey_responds.survey_id', $survey_id);
                                $this->db->where('responden_id', $row['responden_id']);
                                $this->db->order_by('surveyquestion_time', 'ASC');

                                $responds = $this->db->get();
                                // $responds = $this->db->get_where('survey_responds', array('survey_id' => $survey_id, 'responden_id' => $row['responden_id']))->result_array(); 
                            ?>
                            <?php foreach ($responds->result_array() as $row2): ?>
                                <td><?php echo $row2['responds_answer']; ?></td>
                            <?php endforeach; ?>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/responds/delete/'. $row['responden_id'] . '/' . $row['survey_id']); ?>');">
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
                <?php include 'surveyquestion_add.php' ?>
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
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
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