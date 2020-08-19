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
                                <th>Periode</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Unit</th>
                                <th>Placement</th>
                                <th>Requirement</th>
                                <th>Job Description</th>
                                <th width="5%">Total Candidate</th>
                                <th width="5%">Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Type</th>
                                <th>Periode</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Unit</th>
                                <th>Placement</th>
                                <th>Requirement</th>
                                <th>Job Description</th>
                                <th>Total Candidate</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php
                            $this->db->from('vacancy');
                            $this->db->join('section', 'section.section_code = vacancy.vacancy_section');
                            $this->db->join('unit', 'unit.unit_code = vacancy.vacancy_unit');
                            $this->db->where('vacancy.branch_code', $this->session->userdata('login_branch'));
                            $vacancy = $this->db->get();

                            foreach ($vacancy->result_array() as $row):
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?php if($row['user_type'] == 'EMPLOYEE') { ?>
                                        <h5><span class="badge badge-warning">INTERNAL</span></h5>
                                    <?php } elseif ($row['user_type'] == 'CANDIDATE') { ?>
                                        <h5><span class="badge badge-dark">EKSTERNAL</span></h5>
                                    <?php } ?>
                                </td>
                                <td style="text-align: center;"><?php echo $row['vacancy_publishdate'] . ' - ' . $row['vacancy_lastdate']; ?></td>
                                <td><?php echo $row['vacancy_position']; ?></td>
                                <td><?php echo $row['section_name']; ?></td>
                                <td><?php echo $row['unit_name']; ?></td>
                                <td><?php echo $row['vacancy_placement']; ?></td>
                                <td><?php echo nl2br($row['vacancy_requirements']); ?></td>
                                <td><?php echo nl2br($row['vacancy_jobdesc']); ?></td>
                                <td style="text-align: center;">
                                    <?php if($row['user_type'] == 'CANDIDATE') { 
                                            echo $this->db->get_where('application', array('vacancy_id' => $row['vacancy_id']))->num_rows(); 
                                        } elseif($row['user_type'] == 'EMPLOYEE') {
                                            $this->db->from('application');
                                            $this->db->where('vacancy_id', $row['vacancy_id']);
                                            $this->db->where('application_status != ', 'Applied');
                                            $this->db->where('application_status != ', 'SPV Declined');
                                            $jum = $this->db->get();

                                            echo $jum->num_rows();
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php if (strtotime($row['vacancy_lastdate']) > strtotime('now')) { ?>
                                        <h5><span class="badge badge-success">Active</span></h5>   
                                    <?php } else { ?>
                                        <h5><span class="badge badge-danger">Inactive</span></h5>
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
        order: [[ 1, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
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