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
        $this->db->from('asset_tmp');
        $this->db->join('employee_update', 'employee_update.update_id = asset_tmp.update_id');
        $this->db->join('employee', 'asset_tmp.nik = employee.nik');
        $this->db->where('employee_update.update_id', $update_id);
        $tmp = $this->db->get();

        foreach ($tmp->result_array() as $row):
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
                            <strong>REQUEST CREATE DATA ASSET</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Asset Number</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <input type="text" class="form-control" name="asset_number" value="<?php echo $row['asset_number']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Serial Number</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <input type="text" class="form-control" name="asset_serialnumber" value="<?php echo $row['asset_serialnumber']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Type</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <input type="text" class="form-control" name="asset_name" value="<?php echo $row['asset_name']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Brand</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <input type="text" class="form-control" name="asset_merk" value="<?php echo $row['asset_merk']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Model</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <input type="text" class="form-control" name="asset_model" value="<?php echo $row['asset_model']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Date</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <input type="date" class="form-control" name="asset_date" value="<?php echo $row['asset_date']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Spesification</label>
                                <div class="col-lg-3 col-9 col-form-label">
                                    <textarea class="form-control" name="asset_spesification" rows="3" readonly><?php echo $row['asset_spesification']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <?php endforeach; ?>
</div>
<!-- /.content-wrapper -->