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

        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">EMPLOYEE</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('user', array('user_type' => 'EMPLOYEE'))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">HUMAN CAPITAL</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('user', array('user_type' => 'HUMANCAPITAL'))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">BRANCH HEAD</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('user', array('user_type' => 'HEAD'))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">SPV</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('user', array('user_type' => 'SPV'))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ADMIN</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('user', array('user_type' => 'ADMIN'))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">SUPER USER</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('user', array('user_type' => 'SUPERUSER'))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open(site_url('superuser/user/search')); ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Search</div>
                                <div class="col-lg-1 col-12">
                                    <select class="form-control selectpicker" name="searchmethod" data-live-search="true" required>
                                        <option value="NAME" <?php if ($searchmethod == 'NAME') echo 'selected'; ?>>NAME</option>
                                        <option value="NIK" <?php if ($searchmethod == 'NIK') echo 'selected'; ?>>NIK</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <input type="text" class="form-control" name="search" value="<?php echo $search ?>" required>
                                </div>
                                <div class="col-lg-1 col-12" style="margin-top: 0px;">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i>&nbsp;&nbsp;Search</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        <hr>
                        <?php echo form_open(site_url('superuser/user/filter')); ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Create Period</div>
                                <div class="col-lg-2 col-12">
                                    <input type="date" class="form-control" name="start" value="<?php echo $start ?>" id="txt_user_createdatestart" required <?php if ($user_createdate == 'All') echo 'disabled'; ?>>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <input type="date" class="form-control" name="end" value="<?php echo $end ?>" id="txt_user_createdateend" required <?php if ($user_createdate == 'All') echo 'disabled'; ?>>
                                </div>
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">
                                    <div class="form-check" style="margin-top: 0px;">
                                        <input class="form-check-input" type="checkbox" value="All" name="user_createdate" id="chk_user_createdate" <?php if ($user_createdate == 'All') echo 'checked'; ?>>
                                        <label class="form-check-label">ALL PERIOD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Department</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="section_code" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE DEPARTMENT --</option>
                                        <option value="All" <?php if ($section_code == 'All') echo 'selected'; ?>>ALL DEPARTMENT</option>
                                        <?php $section = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                            foreach ($section as $row1): ?>
                                                <option value="<?php echo $row1['section_code']; ?>" <?php if($section_code == $row1['section_code']) echo 'selected'; ?>><?php echo $row1['section_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Status</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE TYPE --</option>
                                        <option value="All" <?php if ($user_type == 'All') echo 'selected'; ?>>ALL TYPE</option>
                                        <option value="ADMIN" <?php if ($user_type == 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                                        <option value="EMPLOYEE" <?php if ($user_type == 'EMPLOYEE') echo 'selected'; ?>>EMPLOYEE</option>
                                        <option value="HEAD" <?php if ($user_type == 'HEAD') echo 'selected'; ?>>BRANCH HEAD</option>
                                        <option value="HUMANCAPITAL" <?php if ($user_type == 'HUMANCAPITAL') echo 'selected'; ?>>HUMAN CAPITAL</option>
                                        <option value="SPV" <?php if ($user_type == 'SPV') echo 'selected'; ?>>SPV</option>
                                        <option value="SUPERUSER" <?php if ($user_type == 'SUPERUSER') echo 'selected'; ?>>SUPER USER</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add User</a>                                
                    </div>
                </div>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th width="10%">Application</th>
                            <th width="10%">Type</th>
                            <th width="10%">Create Date</th>
                            <th width="5%">Status</th>
                            <th width="10%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Application</th>
                            <th>Type</th>
                            <th>Create Date</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $this->db->from('user');
                        $this->db->join('employee', 'user.nik = employee.nik');
                        $this->db->join('section', 'section.section_code = employee.section_code');
                        $this->db->where('user_status', '1');
                        $sql = $this->db->get();

                        if ($user_createdate == 'All' && $section_code == 'All' && $user_type == 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $sql = $this->db->get();
                        } elseif ($user_createdate != 'All' && $start != NULL && $end != NULL && $section_code == 'All' && $user_type == 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('user_createdate >=', $start);
                            $this->db->where('user_createdate <=', $end);
                            $sql = $this->db->get();
                        } elseif ($user_createdate == 'All' && $section_code != 'All' && $user_type == 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('employee.section_code', $section_code);
                            $sql = $this->db->get();
                        } elseif ($user_createdate == 'All' && $section_code == 'All' && $user_type != 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('user_type', $user_type);
                            $sql = $this->db->get();
                        } elseif ($user_createdate == 'All' && $section_code != 'All' && $user_type != 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('user_type', $user_type);
                            $this->db->where('employee.section_code', $section_code);
                            $sql = $this->db->get();
                        } elseif ($user_createdate != 'All' && $start != NULL && $end != NULL && $section_code != 'All' && $user_type == 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('user_createdate >=', $start);
                            $this->db->where('user_createdate <=', $end);
                            $this->db->where('employee.section_code', $section_code);
                            $sql = $this->db->get();
                        } elseif ($user_createdate != 'All' && $start != NULL && $end != NULL && $section_code == 'All' && $user_type != 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('user_createdate >=', $start);
                            $this->db->where('user_createdate <=', $end);
                            $this->db->where('user_type', $user_type);
                            $sql = $this->db->get();
                        } elseif ($user_createdate != 'All' && $start != NULL && $end != NULL && $section_code != 'All' && $user_type != 'All') {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->where('user_createdate >=', $start);
                            $this->db->where('user_createdate <=', $end);
                            $this->db->where('employee.section_code', $section_code);
                            $this->db->where('user_type', $user_type);
                            $sql = $this->db->get();
                        } 

                        if ($searchmethod == 'NAME' && $search != NULL) {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->like('employee_name', $search);
                            $sql = $this->db->get();
                        } elseif ($searchmethod == 'NIK' && $search != NULL) {
                            $this->db->from('user');
                            $this->db->join('employee', 'user.nik = employee.nik');
                            $this->db->join('section', 'section.section_code = employee.section_code');
                            $this->db->like('user.nik', $search);
                            $sql = $this->db->get();
                        }

                        foreach ($sql->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['nik']; ?></td>
                            <td><?php echo $row['employee_name']; ?></td>
                            <td><?php echo $row['section_name']; ?></td>
                            <td><?php echo $row['employee_position']; ?></td>
                            <td style="text-align: center;"><?php echo $row['user_application'] ?></td>
                            <td style="text-align: center;"><?php echo $row['user_type'] ?></td>
                            <td style="text-align: center;"><?php echo $row['user_createdate'] ?></td>
                            <td style="text-align: center;">
                                <?php if ($row['user_status'] == 'Y' ){ ?>
                                        <h5><span class="badge badge-success">Acive</span></h5>
                                <?php } else if ($row['user_status'] == 'N') { ?>
                                        <h5><span class="badge badge-danger">Inactive</span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['user_application'] == 'MYHC'){ ?>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-success" onclick="FormModalMd('<?php echo site_url('modal/popup/user_edit/'. $row['user_id'] ); ?>');">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('superuser/user/delete/'. $row['user_id']); ?>');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
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

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'user_add.php' ?>
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

<script type="text/javascript">
    $('#chk_user_createdate').click(function(){
        if($(this).is(':checked')){
            $('#txt_user_createdatestart').attr("disabled", true);
            $('#txt_user_createdateend').attr("disabled", true);
        } else{
            $('#txt_user_createdatestart').attr("disabled", false);
            $('#txt_user_createdateend').attr("disabled", false);
        }
    });
</script>