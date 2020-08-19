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
        <?php echo form_open(site_url('humancapital/employee/update_filter')); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Type</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="update_type" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE TYPE --</option>
                                        <option value="All" <?php if ($update_type == 'All') echo 'selected'; ?>>ALL TYPE</option>
                                        <option value="Personal" <?php if ($update_type == 'Personal') echo 'selected'; ?>>PERSONAL</option>
                                        <option value="Shift" <?php if ($update_type == 'Shift') echo 'selected'; ?>>SHIFT</option>
                                        <option value="Asset" <?php if ($update_type == 'Asset') echo 'selected'; ?>>ASSET</option>
                                        <option value="Family" <?php if ($update_type == 'Family') echo 'selected'; ?>>FAMILY</option>
                                        <option value="File" <?php if ($update_type == 'File') echo 'selected'; ?>>FILE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Status</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="update_status" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE STATUS --</option>
                                        <option value="All" <?php if ($update_status == 'All') echo 'selected'; ?>>ALL STATUS</option>
                                        <option value="Waiting for Approval" <?php if ($update_status == 'Waiting for Approval') echo 'selected'; ?>>WAITING FOR APPROVAL</option>
                                        <option value="Approved" <?php if ($update_status == 'Approved') echo 'selected'; ?>>APPROVED</option>
                                        <option value="Declined" <?php if ($update_status == 'Declined') echo 'selected'; ?>>DECLINED</option>
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
                                    <th width="10%">Update ID</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th width="10%">Type</th>
                                    <th width="10%">Process</th>
                                    <th width="15%">Request Date</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>Update ID</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Process</th>
                                    <th>Request Date</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $count = 1;

                                if ($update_type == 'All' && $update_status == 'All') {
                                    $this->db->from('employee_update');
                                    $this->db->join('employee', 'employee.nik = employee_update.nik');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                } elseif ($update_type != 'All' && $update_status != 'All') {
                                    $this->db->from('employee_update');
                                    $this->db->join('employee', 'employee.nik = employee_update.nik');
                                    $this->db->where('update_type', $update_type);
                                    $this->db->where('update_status', $update_status);
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                } elseif ($update_type == 'All' && $update_status != 'All') {
                                    $this->db->from('employee_update');
                                    $this->db->join('employee', 'employee.nik = employee_update.nik');
                                    $this->db->where('update_status', $update_status);
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                } elseif ($update_type != 'All' && $update_status == 'All') {
                                    $this->db->from('employee_update');
                                    $this->db->join('employee', 'employee.nik = employee_update.nik');
                                    $this->db->where('update_type', $update_type);
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $sql = $this->db->get();
                                }

                                foreach ($sql->result_array() as $row):
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row['update_id']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['employee_name']; ?></td>
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
                                    <td style="text-align: center;"><?php echo $row['update_type']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['update_process']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['update_date']; ?></td>
                                    <td style="text-align: center;">
                                        <?php if($row['update_status'] == 'Waiting for Approval') { ?>
                                            <h5><span class="badge badge-secondary"><?php echo $row['update_status'] ?></span></h5>
                                        <?php } elseif ($row['update_status'] == 'Approved') { ?>
                                            <h5>
                                                <span class="badge badge-success">
                                                    <?php 
                                                        echo $row['update_status'];
                                                        $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                        if($created->num_rows() > 0){
                                                            echo ' by ' . $created->row()->employee_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </span>
                                            </h5>
                                        <?php } elseif ($row['update_status'] == 'Declined') { ?>
                                            <h5>
                                                <span class="badge badge-danger">
                                                    <?php 
                                                        echo $row['update_status'];
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
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn-group">
                                            <?php if($row['update_type'] == 'Personal' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/employee/update_personal/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>

                                            <?php } elseif ($row['update_type'] == 'Shift' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/employee/update_shift/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            
                                            <?php } elseif ($row['update_type'] == 'Asset' && $row['update_process'] == 'Create') { ?>
                                                <a href="<?php echo site_url('humancapital/asset/update_asset_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Asset' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/asset/update_asset_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Asset' && $row['update_process'] == 'Delete') { ?>
                                                <a href="<?php echo site_url('humancapital/asset/update_asset_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            
                                            <?php } elseif ($row['update_type'] == 'Family' && $row['update_process'] == 'Create') { ?>
                                                <a href="<?php echo site_url('humancapital/family/update_family_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Family' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/family/update_family_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Family' && $row['update_process'] == 'Delete') { ?>
                                                <a href="<?php echo site_url('humancapital/family/update_family_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            
                                            <?php } elseif ($row['update_type'] == 'Education' && $row['update_process'] == 'Create') { ?>
                                                <a href="<?php echo site_url('humancapital/education/update_education_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Education' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/education/update_education_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Education' && $row['update_process'] == 'Delete') { ?>
                                                <a href="<?php echo site_url('humancapital/education/update_education_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>

                                            <?php } elseif ($row['update_type'] == 'Certification' && $row['update_process'] == 'Create') { ?>
                                                <a href="<?php echo site_url('humancapital/certification/update_certification_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Certification' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/certification/update_certification_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } elseif ($row['update_type'] == 'Certification' && $row['update_process'] == 'Delete') { ?>
                                                <a href="<?php echo site_url('humancapital/certification/update_certification_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>

                                            <?php } elseif ($row['update_type'] == 'File' && $row['update_process'] == 'Update') { ?>
                                                <a href="<?php echo site_url('humancapital/file/update_file/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;Details</a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        order: [[ 5, "desc" ]],
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