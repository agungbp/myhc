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
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Vacancy</a>
                    </div>
            <?php } ?>
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
                                <th>Created By</th>
                                <th width="5%">Status</th>
                                <?php 
                                    if (strpos($usercek, 'SVU') !== FALSE) { 
                                ?>
                                        <th width="10%">Options</th>
                                <?php } ?>
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
                                <th>Created By</th>
                                <th>Status</th>
                                <?php 
                                    if (strpos($usercek, 'SVU') !== FALSE) { 
                                ?>
                                        <th>Options</th>
                                <?php } ?>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php
                            $this->db->select('vacancy.*, section.section_name, unit.unit_name');
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
                                <td><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></td>
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
                                    <?php if (strtotime($row['vacancy_lastdate']) > strtotime('now')) { ?>
                                        <h5><span class="badge badge-success">Active</span></h5>   
                                    <?php } else { ?>
                                        <h5><span class="badge badge-danger">Inactive</span></h5>
                                    <?php } ?>
                                </td>
                                <?php 
                                    if (strpos($usercek, 'SVU') !== FALSE) { 
                                ?>
                                        <td style="text-align: center;">
                                            <div class="btn-group">
                                                <?php if($row['user_type'] == 'EMPLOYEE') { ?>
                                                    <a href="<?php echo site_url('humancapital/candidate/internal_list/'.$row['vacancy_id']); ?>" class="btn btn-dark">
                                                        <i class="fas fa-users"></i>
                                                    </a>
                                                <?php } elseif($row['user_type'] == 'CANDIDATE') { ?>
                                                    <a href="<?php echo site_url('humancapital/candidate/eksternal_list/'.$row['vacancy_id']); ?>" class="btn btn-dark">
                                                        <i class="fas fa-users"></i>
                                                    </a>
                                                <?php } ?>
                                                <a href="<?php echo site_url('humancapital/vacancy/print/'.$row['vacancy_id']); ?>" class="btn btn-info" target="_blank">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <a href="<?php echo site_url('humancapital/vacancy/print_qrcode/'.$row['vacancy_id']); ?>" class="btn btn-secondary" target="_blank">
                                                    <i class="fas fa-qrcode"></i>
                                                </a>
                                                <a href="#" class="btn btn-success" onclick="FormModal('<?php echo site_url('modal/popup/vacancy_edit/'.$row['vacancy_id'] ); ?>');">
                                                    <ion-icon name="create"></ion-icon>
                                                </a>
                                                <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/vacancy/delete/'. $row['vacancy_id']); ?>');">
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
                <?php include 'vacancy_add.php' ?>
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
        order: [[ 1, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ]
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