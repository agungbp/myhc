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
                            <th width="5%">Type</th>
                            <th>Applied For</th>
                            <th width="5%">Process</th>
                            <th width="10%">Date</th>
                            <th>Place</th>
                            <th>Note</th>
                            <th width="5%">Total Candidate</th>
                            <th width="5%">Options</th>
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
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $this->db->from('recruitment_schedule');
                        $this->db->join('vacancy', 'recruitment_schedule.vacancy_id = vacancy.vacancy_id');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $schedule = $this->db->get();

                        foreach ($schedule->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php $type = $this->db->get_where('vacancy', array('vacancy_id' => $row['vacancy_id']))->row()->user_type; 
                                    if($type == 'EMPLOYEE') { ?>
                                    <h5><span class="badge badge-warning">Internal</span></h5>
                                <?php } elseif ($type == 'CANDIDATE') { ?>
                                    <h5><span class="badge badge-dark">Eksternal</span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('vacancy', array('vacancy_id' => $row['vacancy_id']))->row()->vacancy_position . ' ' . $this->db->get_where('vacancy', array('vacancy_id' => $row['vacancy_id']))->row()->vacancy_level; ?></td>
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
                                <div class="btn-group">
                                    <?php if($type == '2') { ?>
                                        <a href="#" class="btn btn-info" onclick="FormModal('<?php echo site_url('modal/popup/candidate_schedule_list_internal/'.$row['schedule_id'] ); ?>');">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    <?php } elseif ($type == '3') { ?>
                                        <a href="#" class="btn btn-info" onclick="FormModal('<?php echo site_url('modal/popup/candidate_schedule_list_eksternal/'.$row['schedule_id'] ); ?>');">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    <?php } ?>
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