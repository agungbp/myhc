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
                            <th width="5%">Total Question</th>
                            <th width="5%">Total Participants</th>
                            <th>Token</th>
                            <th>Status</th>
                            <th width="23%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Test Name</th>
                            <th>For</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Question Package</th>
                            <th>Total Question</th>
                            <th>Total Participants</th>
                            <th>Token</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $exam = $this->db->get_where('cbt_exam', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        foreach ($exam as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['exam_name']; ?></td>
                            <td style="text-align: center;">
                                <?php
                                    if ($row['user_type'] == 'EMPLOYEE') {
                                        echo 'Internal';
                                    } elseif ($row['user_type'] == 'CANDIDATE') {
                                        echo 'Eksternal';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['exam_start_date'] . ' ' . $row['exam_start_time']; ?></td>
                            <td style="text-align: center;"><?php echo $row['exam_end_date'] . ' ' . $row['exam_end_time']; ?></td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('cbt_questionpack', array('questionpack_id' => $row['questionpack_id']))->row()->questionpack_name; ?></td>
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
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('head/question/list/'.$row['questionpack_id']); ?>" class="btn btn-light">
                                        <i class="fas fa-list-ul"></i>&nbsp;&nbsp;Question
                                    </a>
                                    <a href="<?php echo site_url('head/participants/list/'.$row['exam_id']); ?>" class="btn btn-dark">
                                        <i class="fas fa-users"></i>&nbsp;&nbsp;Participants
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