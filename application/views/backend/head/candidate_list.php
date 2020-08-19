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

        <?php echo form_open(site_url('head/candidate/filter')); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Vacancy</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="vacancy_id" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE VACANCY --</option>
                                        <option value="All" <?php if ($vacancy_id == 'All') echo 'selected'; ?>>ALL VACANCY</option>
                                        <?php $vacancy = $this->db->get_where('vacancy', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                            foreach ($vacancy as $row1): ?>
                                                <option value="<?php echo $row1['vacancy_id']; ?>" <?php if($vacancy_id == $row1['vacancy_id']) echo 'selected'; ?>><?php echo $row1['vacancy_position']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Status</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="application_status" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE STATUS --</option>
                                        <option value="All" <?php if ($application_status == 'All') echo 'selected'; ?>>ALL STATUS</option>
                                        <option value="On Review" <?php if ($application_status == 'On Review') echo 'selected'; ?>>ON REVIEW</option>
                                        <option value="Psikotest" <?php if ($application_status == 'Psikotest') echo 'selected'; ?>>PSIKOTEST</option>
                                        <option value="Interview" <?php if ($application_status == 'Interview') echo 'selected'; ?>>INTERVIEW</option>
                                        <option value="Hired" <?php if ($application_status == 'Hired') echo 'selected'; ?>>HIRED</option>
                                        <option value="Declined" <?php if ($application_status == 'Declined') echo 'selected'; ?>>DECLINED</option>
                                        <option value="Hire Declined" <?php if ($application_status == 'Hire Declined') echo 'selected'; ?>>HIRE DECLINED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="tabel-data" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Name</th>
                                    <th width="5%">Education</th>
                                    <th>University</th>
                                    <th>Major</th>
                                    <th width="5%">Gpa</th>
                                    <th>Applied For</th>
                                    <th>Apply Date</th>
                                    <th width="5%">Status</th>
                                    <th width="5%">Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>Name</th>
                                    <th>Education</th>
                                    <th>University</th>
                                    <th>Major</th>
                                    <th>Gpa</th>
                                    <th>Applied For</th>
                                    <th>Apply Date</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $this->db->from('candidate');
                                $this->db->join('application', 'candidate.candidate_ktp = application.nik');
                                $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                $this->db->where('application_status', 0);
                                $this->db->where('vacancy.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();

                                if ($vacancy_id == 'All' && $application_status == 'All') {
                                    $this->db->from('candidate');
                                    $this->db->join('application', 'candidate.candidate_ktp = application.nik');
                                    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                    $this->db->where('vacancy.branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                } elseif ($vacancy_id != 'All' && $application_status != 'All') {
                                    $this->db->from('candidate');
                                    $this->db->join('application', 'candidate.candidate_ktp = application.nik');
                                    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                    $this->db->where('vacancy.vacancy_id', $vacancy_id);
                                    $this->db->where('application_status', $application_status);
                                    $this->db->where('vacancy.branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                } elseif ($vacancy_id == 'All' && $application_status != 'All') {
                                    $this->db->from('candidate');
                                    $this->db->join('application', 'candidate.candidate_ktp = application.nik');
                                    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                    $this->db->where('application_status', $application_status);
                                    $this->db->where('vacancy.branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                } elseif ($vacancy_id != 'All' && $application_status == 'All') {
                                    $this->db->from('candidate');
                                    $this->db->join('application', 'candidate.candidate_ktp = application.nik');
                                    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
                                    $this->db->where('vacancy.vacancy_id', $vacancy_id);
                                    $this->db->where('vacancy.branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                }

                                foreach ($sql->result_array() as $row):
                            ?>
                                <tr>
                                    <td><?php echo $row['candidate_name']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['candidate_education']; ?></td>
                                    <td><?php echo $row['candidate_university']; ?></td>
                                    <td><?php echo $row['candidate_major']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['candidate_gpa']; ?></td>
                                    <td><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></td>
                                    <td><?php echo $row['application_date']; ?></td>
                                    <td style="text-align: center;">
                                        <?php if($row['application_status'] == 'Applied') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'On Review') { ?>
                                            <h5><span class="badge badge-warning"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Psikotest') { ?>
                                            <h5><span class="badge badge-info"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Interview') { ?>
                                            <h5><span class="badge badge-light"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Hired') { ?>
                                            <h5><span class="badge badge-success"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Waiting for SPV Approval') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'SPV Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } elseif ($row['application_status'] == 'Hire Declined') { ?>
                                            <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('head/candidate/profile_eksternal/'. $row['candidate_ktp']); ?>" class="btn btn-info">
                                                <ion-icon name="person"></ion-icon>
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
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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
        order: [[ 6, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
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