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

    <?php 
        $this->db->from('employee_shifttmp');
        $this->db->where('update_id', $update_id);
        $tmp = $this->db->get();

        $this->db->select('employee.*, employee_update.*');
        $this->db->from('employee');
        $this->db->join('employee_shifttmp', 'employee.nik = employee_shifttmp.nik');
        $this->db->join('employee_update', 'employee_shifttmp.update_id = employee_update.update_id');
        $this->db->where('employee_update.update_id', $update_id);
        $employee = $this->db->get();

        foreach ($tmp->result_array() as $row2):
            foreach ($employee->result_array() as $row):
                echo form_open(site_url('humancapital/employee/update_approve_shift/') . $row['update_id'] .'/'.$row['nik'], array('enctype' => 'multipart/form-data'));
    ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- Profile Image -->
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="<?php echo $this->get_model->get_image_url('employee', $row['nik']); ?>" alt="User profile picture">
                                            </div>
                                            <h3 class="profile-username text-center"><?php echo $row['employee_name']; ?></h3>
                                            <p class="text-muted text-center"><?php echo $row['employee_position']; ?></p>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>NIK</b> <a class="float-right"><?php echo $row['nik']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Status</b> <a class="float-right"><?php echo $row['employee_status']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Level</b> <a class="float-right"><?php echo $row['employee_level']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Join Date</b> 
                                                    <a class="float-right">
                                                        <?php echo $row['employee_join']; ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Type</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            if ($row['employee_type'] == 'BO') {
                                                                echo 'BACK OFFICE';
                                                            } elseif ($row['employee_type'] == 'CS') {
                                                                echo 'CUSTOMER SERVICE';
                                                            } elseif ($row['employee_type'] == 'SALES') {
                                                                echo 'SALES';
                                                            } elseif ($row['employee_type'] == 'OPS') {
                                                                echo 'OPERATIONAL';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Department</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                                            if($section->num_rows() > 0){
                                                                echo $section->row()->section_name;
                                                            } else {
                                                                echo '';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Unit</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code'])); 
                                                            if($unit->num_rows() > 0){
                                                                echo $unit->row()->unit_name;
                                                            } else {
                                                                echo '';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Regional</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            $regional = $this->db->get_where('regional', array('regional_code' => $row['regional_code']));
                                                            if($regional->num_rows() > 0){
                                                                echo $regional->row()->regional_name;
                                                            } else {
                                                                echo '';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Branch</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            $branch = $this->db->get_where('branch', array('branch_code' => $row['branch_code']));
                                                            if($branch->num_rows() > 0){
                                                                echo $branch->row()->branch_desc;
                                                            } else {
                                                                echo '';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Origin</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            $origin = $this->db->get_where('origin', array('origin_code' => $row['origin_code']));
                                                            if($origin->num_rows() > 0){
                                                                echo $origin->row()->origin_name;
                                                            } else {
                                                                echo '';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Zona</b>
                                                    <a class="float-right">
                                                        <?php 
                                                            $zone = $this->db->get_where('zone', array('zone_code' => $row['zone_code']));
                                                            if($zone->num_rows() > 0){
                                                                echo $zone->row()->zone_desc;
                                                            } else {
                                                                echo '';
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                            </ul>
                                            <?php if($row['update_status'] == 'Waiting for Approval') { ?>
                                                <button type="submit" class="btn btn-success btn-block" style="margin-bottom: -5px;"><i class="fas fa-check"></i>&nbsp;&nbsp;<b>Approve</b></button>
                                                <a href="<?php echo site_url('humancapital/employee/update_decline/'. $row['update_id']); ?>" class="btn btn-danger btn-block"><i class="fas fa-times"></i>&nbsp;&nbsp;<b>Decline</b></a>
                                            <?php } ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->

                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>REQUEST UPDATE DATA COMPANY</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <label class="col-12">Company Data</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-lg-2 col-3 col-form-label">Area</label>
                                                <?php if($row['employee_area'] != $row2['employee_area']){ ?>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_area']; ?>" readonly>
                                                    </div>
                                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control border border-danger" name="employee_area" value="<?php echo $row2['employee_area']; ?>" readonly>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control" value="<?php echo $row['employee_area']; ?>" readonly>
                                                    </div>
                                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control" name="employee_area" value="<?php echo $row2['employee_area']; ?>"readonly>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <label class="col-lg-2 col-3 col-form-label">Zona</label>
                                                <?php if($row['employee_zona'] != $row2['employee_zona']){ ?>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_zona']; ?>" readonly>
                                                    </div>
                                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control border border-danger" name="employee_zona" value="<?php echo $row2['employee_zona']; ?>" readonly>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control" value="<?php echo $row['employee_zona']; ?>" readonly>
                                                    </div>
                                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                                    <div class="col-lg-3 col-4 col-form-label">
                                                        <input type="text" class="form-control" name="employee_zona" value="<?php echo $row2['employee_zona']; ?>"readonly>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
    <!-- /.content -->
    <?php 
                echo form_close();
            endforeach; 
        endforeach;
    ?>
</div>
<!-- /.content-wrapper -->