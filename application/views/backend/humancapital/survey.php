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
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Survey</a>
                    </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Survey Name</th>
                            <th>Description</th>
                            <th>Create Date</th>
                            <th>End Date</th>
                            <th width="5%">Total Question</th>
                            <th width="5%">Total Participants</th>
                            <th>Create By</th>
                            <th width="10%">Status</th>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <th width="23%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Survey Name</th>
                            <th>Description</th>
                            <th>Create Date</th>
                            <th>End Date</th>
                            <th>Total Question</th>
                            <th>Total Participants</th>
                            <th>Create By</th>
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
                        $survey = $this->db->get_where('survey', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($survey as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['survey_name']; ?></td>
                            <td><?php echo nl2br($row['survey_description']); ?></td>
                            <td style="text-align: center;"><?php echo $row['survey_start_date'] . ' ' . $row['survey_start_time']; ?></td>
                            <td style="text-align: center;"><?php echo $row['survey_end_date'] . ' ' . $row['survey_end_time']; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    $question = $this->db->get_where('survey_question', array('survey_id' => $row['survey_id']))->num_rows();
                                    echo $question;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    $this->db->from('survey_responden');
                                    $this->db->where('survey_id', $row['survey_id']);
                                    $responden = $this->db->get();
                                    
                                    echo $responden->num_rows();
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
                            <td style="text-align: center;">
                                <?php if ($row['survey_status'] == 'Publish' ){ ?>
                                        <h5><span class="badge badge-success"><?php echo $row['survey_status']; ?></span></h5>
                                <?php } else if ($row['survey_status'] == 'Draft') { ?>
                                        <h5><span class="badge badge-secondary"><?php echo $row['survey_status']; ?></span></h5>
                                <?php } else if ($row['survey_status'] == 'Waiting for Approval') { ?>
                                        <h5><span class="badge badge-warning"><?php echo $row['survey_status']; ?></span></h5>
                                <?php } else if ($row['survey_status'] == 'Approved') { ?>
                                        <h5>
                                            <span class="badge badge-primary">
                                                <?php 
                                                    echo $row['survey_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                <?php } else if ($row['survey_status'] == 'Declined') { ?>
                                        <h5>
                                            <span class="badge badge-danger">
                                                <?php 
                                                    echo $row['survey_status'];
                                                    $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo ' by ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </span>
                                        </h5>
                                <?php } ?>
                                <?php echo $row['survey_note']; ?>
                            </td>
                            <?php 
                                if (strpos($usercek, 'DVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('humancapital/surveyquestion/list/'.$row['survey_id']); ?>" class="btn btn-light">
                                                <i class="fas fa-list-ul"></i>&nbsp;&nbsp;Question
                                            </a>
                                            <a href="<?php echo site_url('humancapital/responds/list/'.$row['survey_id']); ?>" class="btn btn-dark">
                                                <i class="fas fa-users"></i>&nbsp;&nbsp;Responden
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-success" onclick="FormModalMd('<?php echo site_url('modal/popup/survey_edit/'.$row['survey_id'] ); ?>');">
                                                <ion-icon name="create"></ion-icon>
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/survey/delete/'. $row['survey_id']); ?>');">
                                                <ion-icon name="trash"></ion-icon>
                                            </a>
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

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'survey_add.php' ?>
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
                        columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 7 ]
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