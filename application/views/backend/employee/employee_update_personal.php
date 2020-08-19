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
        $this->db->from('employee_tmp');
        $this->db->where('update_id', $update_id);
        $tmp = $this->db->get();

        $this->db->from('employee');
        $this->db->where('nik', $this->session->userdata('login_nik'));
        $employee = $this->db->get();

        foreach ($tmp->result_array() as $row2):
            foreach ($employee->result_array() as $row):
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
                            <strong>REQUEST UPDATE DATA PERSONAL</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-12">Personal Data</label>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">NPWP</label>
                                <?php if($row['employee_npwp'] != $row2['employee_npwp']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_npwp']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_npwp" value="<?php echo $row2['employee_npwp']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_npwp']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_npwp" value="<?php echo $row2['employee_npwp']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">KTP</label>
                                <?php if($row['employee_ktp'] != $row2['employee_ktp']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_ktp']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_ktp" value="<?php echo $row2['employee_ktp']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_ktp']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_ktp" value="<?php echo $row2['employee_ktp']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">KTP Expire Date</label>
                                <?php if($row['employee_ktpexpire'] != $row2['employee_ktpexpire']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_ktpexpire']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_ktpexpire" value="<?php echo $row2['employee_ktpexpire']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_ktpexpire']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_ktpexpire" value="<?php echo $row2['employee_ktpexpire']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">BPJS Kesehatan</label>
                                <?php if($row['employee_bpjskesehatan'] != $row2['employee_bpjskesehatan']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_bpjskesehatan']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_bpjskesehatan" value="<?php echo $row2['employee_bpjskesehatan']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_bpjskesehatan']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_bpjskesehatan" value="<?php echo $row2['employee_bpjskesehatan']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">BPJS Ketenagakerjaan</label>
                                <?php if($row['employee_bpjsketenagakerjaan'] != $row2['employee_bpjsketenagakerjaan']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_bpjsketenagakerjaan']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_bpjsketenagakerjaan" value="<?php echo $row2['employee_bpjsketenagakerjaan']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_bpjsketenagakerjaan']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_bpjsketenagakerjaan" value="<?php echo $row2['employee_bpjsketenagakerjaan']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Full Name</label>
                                <?php if($row['employee_name'] != $row2['employee_name']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_name']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_name" value="<?php echo $row2['employee_name']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_name']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_name" value="<?php echo $row2['employee_name']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Birth Place</label>
                                <?php if($row['employee_birthplace'] != $row2['employee_birthplace']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_birthplace']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_birthplace" value="<?php echo $row2['employee_birthplace']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_birthplace']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_birthplace" value="<?php echo $row2['employee_birthplace']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Birth Date</label>
                                <?php if($row['employee_birthdate'] != $row2['employee_birthdate']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_birthdate']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_birthdate" value="<?php echo $row2['employee_birthdate']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_birthdate']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_birthdate" value="<?php echo $row2['employee_birthdate']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Gender</label>
                                <?php if($row['employee_gender'] != $row2['employee_gender']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_gender']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_gender" value="<?php echo $row2['employee_gender']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_gender']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_gender" value="<?php echo $row2['employee_gender']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Religion</label>
                                <?php if($row['employee_religion'] != $row2['employee_religion']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_religion']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_religion" value="<?php echo $row2['employee_religion']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_religion']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_religion" value="<?php echo $row2['employee_religion']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Marital Status</label>
                                <?php if($row['employee_marital'] != $row2['employee_marital']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_marital']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_marital" value="<?php echo $row2['employee_marital']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_marital']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_marital" value="<?php echo $row2['employee_marital']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Bank Number</label>
                                <?php if($row['employee_banknumber'] != $row2['employee_banknumber']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_banknumber']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_banknumber" value="<?php echo $row2['employee_banknumber']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_banknumber']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_banknumber" value="<?php echo $row2['employee_banknumber']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Education</label>
                                <?php if($row['employee_education'] != $row2['employee_education']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_education']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_education" value="<?php echo $row2['employee_education']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_education']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_education" value="<?php echo $row2['employee_education']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">University</label>
                                <?php if($row['employee_university'] != $row2['employee_university']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_university']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_university" value="<?php echo $row2['employee_university']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_university']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_university" value="<?php echo $row2['employee_university']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Major</label>
                                <?php if($row['employee_major'] != $row2['employee_major']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_major']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_major" value="<?php echo $row2['employee_major']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_major']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_major" value="<?php echo $row2['employee_major']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Phone</label>
                                <?php if($row['employee_phone'] != $row2['employee_phone']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_phone']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_phone" value="<?php echo $row2['employee_phone']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_phone']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_phone" value="<?php echo $row2['employee_phone']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Phone 2</label>
                                <?php if($row['employee_phone2'] != $row2['employee_phone2']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_phone2']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_phone2" value="<?php echo $row2['employee_phone2']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_phone2']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_phone2" value="<?php echo $row2['employee_phone2']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">City</label>
                                <?php if($row['employee_city'] != $row2['employee_city']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_city']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_city" value="<?php echo $row2['employee_city']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_city']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_city" value="<?php echo $row2['employee_city']; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Address</label>
                                <?php if($row['employee_address'] != $row2['employee_address']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <textarea class="form-control border border-danger" rows="3" readonly><?php echo $row['employee_address']; ?></textarea>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <textarea class="form-control border border-danger" name="employee_address" rows="3" readonly><?php echo $row2['employee_address']; ?></textarea>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                    <textarea class="form-control border" rows="3" readonly><?php echo $row['employee_address']; ?></textarea>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                    <textarea class="form-control border" name="employee_address" rows="3" readonly><?php echo $row2['employee_address']; ?></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-12">Company Data</label>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">NIK</label>
                                <?php if($row['nik'] != $row2['nik']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['nik']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="nik" value="<?php echo $row2['nik']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['nik']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="nik" value="<?php echo $row2['nik']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Orion ID</label>
                                <?php if($row['orion_id'] != $row2['orion_id']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['orion_id']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="orion_id" value="<?php echo $row2['orion_id']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['orion_id']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="orion_id" value="<?php echo $row2['orion_id']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Courier ID</label>
                                <?php if($row['courier_id'] != $row2['courier_id']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['courier_id']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="courier_id" value="<?php echo $row2['courier_id']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['courier_id']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="courier_id" value="<?php echo $row2['courier_id']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Status</label>
                                <?php if($row['employee_status'] != $row2['employee_status']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_status']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_status" value="<?php echo $row2['employee_status']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_status']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_status" value="<?php echo $row2['employee_status']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Level</label>
                                <?php if($row['employee_level'] != $row2['employee_level']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_level']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_level" value="<?php echo $row2['employee_level']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_level']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_level" value="<?php echo $row2['employee_level']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Type</label>
                                <?php if($row['employee_type'] != $row2['employee_type']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_type']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_type" value="<?php echo $row2['employee_type']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_type']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_type" value="<?php echo $row2['employee_type']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Position</label>
                                <?php if($row['employee_position'] != $row2['employee_position']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['employee_position']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="employee_position" value="<?php echo $row2['employee_position']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['employee_position']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="employee_position" value="<?php echo $row2['employee_position']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Department</label>
                                <?php if($row['section_code'] != $row2['section_code']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['section_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="section_code" value="<?php echo $row2['section_code']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['section_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="section_code" value="<?php echo $row2['section_code']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Unit</label>
                                <?php if($row['unit_code'] != $row2['unit_code']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['unit_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="unit_code" value="<?php echo $row2['unit_code']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['unit_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="unit_code" value="<?php echo $row2['unit_code']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Regional</label>
                                <?php if($row['regional_code'] != $row2['regional_code']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['regional_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="regional_code" value="<?php echo $row2['regional_code']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['regional_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="regional_code" value="<?php echo $row2['regional_code']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Branch</label>
                                <?php if($row['branch_code'] != $row2['branch_code']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['branch_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="branch_code" value="<?php echo $row2['branch_code']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['branch_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="branch_code" value="<?php echo $row2['branch_code']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Origin</label>
                                <?php if($row['origin_code'] != $row2['origin_code']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['origin_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="origin_code" value="<?php echo $row2['origin_code']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['origin_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="origin_code" value="<?php echo $row2['origin_code']; ?>"readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 col-3 col-form-label">Zone</label>
                                <?php if($row['zone_code'] != $row2['zone_code']){ ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" value="<?php echo $row['zone_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control border border-danger" name="zone_code" value="<?php echo $row2['zone_code']; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" value="<?php echo $row['zone_code']; ?>" readonly>
                                    </div>
                                    <label class="col-lg-1 col-1 col-form-label text-center"><i class="fas fa-arrow-right"></i></label>
                                    <div class="col-lg-3 col-4 col-form-label">
                                        <input type="text" class="form-control" name="zone_code" value="<?php echo $row2['zone_code']; ?>"readonly>
                                    </div>
                                <?php } ?>
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
            endforeach; 
        endforeach;
    ?>
</div>
<!-- /.content-wrapper -->