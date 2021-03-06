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

        $this->db->from('family_tmp');
        $this->db->join('employee_update', 'employee_update.update_id = family_tmp.update_id');
        $this->db->where('employee_update.update_id', $update_id);
        $tmp = $this->db->get();
        
        $this->db->select('family.family_ktp, family.family_name, family.family_status, family.family_bpjs, employee.*');
        $this->db->from('family');
        $this->db->join('family_tmp', 'family.family_id = family_tmp.family_id');
        $this->db->join('employee', 'family.nik = employee.nik');
        $this->db->where('update_id', $update_id);
        $family = $this->db->get();

        foreach ($tmp->result_array() as $row2):
            foreach ($family->result_array() as $row):
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <strong>REQUEST UPDATE DATA FAMILY</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">KTP</label>
                                <?php if($row['family_ktp'] != $row2['family_ktp']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['family_ktp']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="family_ktp" value="<?php echo $row2['family_ktp']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['family_ktp']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="family_ktp" value="<?php echo $row2['family_ktp']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">BPJS</label>
                                <?php if($row['family_bpjs'] != $row2['family_bpjs']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['family_bpjs']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="family_bpjs" value="<?php echo $row2['family_bpjs']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['family_bpjs']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="family_bpjs" value="<?php echo $row2['family_bpjs']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Status</label>
                                <?php if($row['family_status'] != $row2['family_status']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['family_status']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="family_status" value="<?php echo $row2['family_status']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['family_status']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="family_status" value="<?php echo $row2['family_status']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Name</label>
                                <?php if($row['family_name'] != $row2['family_name']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['family_name']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="family_name" value="<?php echo $row2['family_name']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['family_name']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="family_name" value="<?php echo $row2['family_name']; ?>"readonly>
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
            endforeach; 
        endforeach;
    ?>
</div>
<!-- /.content-wrapper -->