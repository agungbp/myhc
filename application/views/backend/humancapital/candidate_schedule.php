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
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Schedule</a>
                    </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="5%">Type</th>
                            <th>Applied For</th>
                            <th width="5%">Process</th>
                            <th width="10%">Date</th>
                            <th>Place</th>
                            <th>Note</th>
                            <th width="5%">Total Candidate</th>
                            <th>Created By</th>
                            <?php if (strpos($usercek, 'SVU') !== FALSE) { ?>
                                    <th width="5%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Type</th>
                            <th>Applied For</th>
                            <th>Process</th>
                            <th>Date</th>
                            <th>Place</th>
                            <th>Note</th>
                            <th>Total Candidate</th>
                            <th>Created By</th>
                            <?php if (strpos($usercek, 'SVU') !== FALSE) { ?>
                                    <th>Options</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $this->db->select('recruitment_schedule.*, vacancy.vacancy_position, vacancy.vacancy_level, vacancy.user_type');
                        $this->db->from('recruitment_schedule');
                        $this->db->join('vacancy', 'recruitment_schedule.vacancy_id = vacancy.vacancy_id');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $schedule = $this->db->get();

                        foreach ($schedule->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php if ($row['user_type'] == 'EMPLOYEE') { ?>
                                    <h5><span class="badge badge-warning">Internal</span></h5>
                                <?php } elseif ($row['user_type'] == 'CANDIDATE') { ?>
                                    <h5><span class="badge badge-dark">Eksternal</span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></td>
                            <td style="text-align: center;">
                                <?php if($row['application_status'] == 'Psikotest') { ?>
                                    <h5><span class="badge badge-warning"><?php echo $row['application_status']; ?></span></h5>
                                <?php } elseif ($row['application_status'] == 'Interview') { ?>
                                    <h5><span class="badge badge-dark"><?php echo $row['application_status']; ?></span></h5>
                                <?php } elseif ($row['application_status'] == 'Hired') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['application_status']; ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <?php echo $row['schedule_date'] . ' ' . $row['schedule_time']; ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['schedule_place']; ?></td>
                            <td><?php echo nl2br($row['schedule_note']); ?></td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('recruitment_candidate', array('schedule_id' => $row['schedule_id']))->num_rows(); ?></td>
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
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <?php if($row['user_type'] == 'EMPLOYEE') { ?>
                                                <a href="#" class="btn btn-dark" onclick="FormModal('<?php echo site_url('modal/popup/candidate_schedule_list_internal/'.$row['schedule_id'] ); ?>');">
                                                    <i class="fas fa-list"></i>
                                                </a>
                                            <?php } elseif ($row['user_type'] == 'CANDIDATE') { ?>
                                                <a href="#" class="btn btn-dark" onclick="FormModal('<?php echo site_url('modal/popup/candidate_schedule_list_eksternal/'.$row['schedule_id'] ); ?>');">
                                                    <i class="fas fa-list"></i>
                                                </a>
                                            <?php } ?>
                                            <a href="#" class="btn btn-success" onclick="FormModal('<?php echo site_url('modal/popup/candidate_schedule_edit/'.$row['schedule_id'] ); ?>');">
                                                <ion-icon name="create"></ion-icon>
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/recruitment_schedule/delete/'. $row['schedule_id']); ?>');">
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

<div class="modal fade" id="modal-lg" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'candidate_schedule_add.php' ?>
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
        order: [[ 3, "desc" ]],
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