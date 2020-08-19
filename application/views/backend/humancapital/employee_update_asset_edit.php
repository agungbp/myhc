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
        $this->db->where('employee_update.update_id', $update_id);
        $tmp = $this->db->get();
        
        $this->db->select('asset.asset_id, asset.asset_number, asset.asset_serialnumber, asset.asset_name, asset.asset_merk, asset.asset_model, asset.asset_spesification, asset.asset_date, employee.*, employee_update.*');
        $this->db->from('asset');
        $this->db->join('asset_tmp', 'asset.asset_id = asset_tmp.asset_id');
        $this->db->join('employee', 'asset.nik = employee.nik');
        $this->db->join('employee_update', 'employee_update.update_id = asset_tmp.update_id');
        $this->db->where('employee_update.update_id', $update_id);
        $asset = $this->db->get();

        foreach ($tmp->result_array() as $row2):
            foreach ($asset->result_array() as $row):
                echo form_open(site_url('humancapital/asset/update_asset_edit_approve/') . $row['update_id'] .'/'.$row['asset_id'], array('enctype' => 'multipart/form-data'));
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
                            <strong>REQUEST UPDATE DATA ASSET</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Asset Number</label>
                                <?php if($row['asset_number'] != $row2['asset_number']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['asset_number']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="asset_number" value="<?php echo $row2['asset_number']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['asset_number']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="asset_number" value="<?php echo $row2['asset_number']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Serial Number</label>
                                <?php if($row['asset_serialnumber'] != $row2['asset_serialnumber']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['asset_serialnumber']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="asset_serialnumber" value="<?php echo $row2['asset_serialnumber']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['asset_serialnumber']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="asset_serialnumber" value="<?php echo $row2['asset_serialnumber']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Type</label>
                                <?php if($row['asset_name'] != $row2['asset_name']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['asset_name']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="asset_name" value="<?php echo $row2['asset_name']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['asset_name']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="asset_name" value="<?php echo $row2['asset_name']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Brand</label>
                                <?php if($row['asset_merk'] != $row2['asset_merk']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['asset_merk']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="asset_merk" value="<?php echo $row2['asset_merk']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['asset_merk']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="asset_merk" value="<?php echo $row2['asset_merk']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Model</label>
                                <?php if($row['asset_model'] != $row2['asset_model']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['asset_model']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="asset_model" value="<?php echo $row2['asset_model']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['asset_model']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="asset_model" value="<?php echo $row2['asset_model']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Date</label>
                                <?php if($row['asset_date'] != $row2['asset_date']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="date" class="form-control border border-danger" value="<?php echo $row['asset_date']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="date" class="form-control border border-danger" name="asset_date" value="<?php echo $row2['asset_date']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="date" class="form-control" value="<?php echo $row['asset_date']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="date" class="form-control" name="asset_date" value="<?php echo $row2['asset_date']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Spesification</label>
                                <?php if($row['asset_spesification'] != $row2['asset_spesification']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <textarea class="form-control border border-danger" rows="3" readonly><?php echo $row['asset_spesification']; ?></textarea>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <textarea class="form-control border border-danger" name="asset_spesification" rows="3" readonly><?php echo $row2['asset_spesification']; ?></textarea>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <textarea class="form-control" rows="3" readonly><?php echo $row['asset_spesification']; ?></textarea>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <textarea class="form-control" name="asset_spesification" rows="3" readonly><?php echo $row2['asset_spesification']; ?></textarea>
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