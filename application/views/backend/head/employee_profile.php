
<?php 
    $this->db->from('employee');
    $this->db->where('nik', $nik);
    $sql = $this->db->get();

    foreach ($sql->result_array() as $row):
?>
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
                            <a href="<?php echo site_url('head/employee/print/'. $row['nik']); ?>" target="_blank" class="btn btn-success btn-block" style="margin-bottom: -5px;"><i class="fas fa-print"></i>&nbsp;&nbsp;<b>Print CV</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal</a></li>
                                <li class="nav-item"><a class="nav-link" href="#career" data-toggle="tab">Rotation</a></li>
                                <li class="nav-item"><a class="nav-link" href="#spk" data-toggle="tab">SPK</a></li>
                                <li class="nav-item"><a class="nav-link" href="#teguran" data-toggle="tab">Surat Teguran</a></li>
                                <li class="nav-item"><a class="nav-link" href="#panggilan" data-toggle="tab">Surat Panggilan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pa" data-toggle="tab">PA</a></li>
                                <li class="nav-item"><a class="nav-link" href="#loan" data-toggle="tab">Loan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#elearning" data-toggle="tab">Elearning</a></li>
                                <li class="nav-item"><a class="nav-link" href="#asset" data-toggle="tab">Asset</a></li>
                                <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family</a></li>
                                <li class="nav-item"><a class="nav-link" href="#file" data-toggle="tab">File</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="personal">
                                    <div class="row">
                                        <label class="col-12">Personal Data</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-lg-2 col-4 col-form-label">KTP</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_ktp'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Name</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_name'] ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">KTP Expire Date</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_ktpexpire'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">BPJS Kesehatan</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_bpjskesehatan'] ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">NPWP</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_npwp'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">BPJS Ketenagakerjaan</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_bpjsketenagakerjaan']; ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Birth Place</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_birthplace'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Birth Date</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_birthdate']; ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Bank Number</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_banknumber'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Age</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo date_diff(date_create($row['employee_birthdate']), date_create('today'))->y; ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Marital</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_marital'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Gender</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php if ($row['employee_gender'] == 'L') {
                                                    echo 'LAKI - LAKI';
                                                } else {
                                                    echo 'PEREMPUAN';
                                                }
                                            ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Education</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_education'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Religion</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_religion'] ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Major</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_major'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Phone</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_phone'] ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">University</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_university'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Phone 2</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_phone2'] ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Address</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_address'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">City</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_city'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-12"><hr>Company Data</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-lg-2 col-4 col-form-label">Courier ID</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['courier_id'] ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Orion ID</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['orion_id'] ?>
                                        </div>

                                        <label class="col-lg-2 col-4 col-form-label">Area</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_area']; ?>
                                        </div>
                                        <div class="col-lg-1 col-1"></div>
                                        <label class="col-lg-2 col-4 col-form-label">Zona</label>
                                        <div class="col-lg-3 col-6 col-form-label">
                                            <?php echo $row['employee_zona']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="career">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('rotation_date', 'desc');
                                        $this->db->from('employee_rotation');
                                        $this->db->where('nik', $nik);
                                        $career = $this->db->get();

                                        if($career->num_rows() < 1){ 
                                            ?>
                                            <div class="alert alert-info">
                                                No data to display
                                            </div>
                                    <?php   } else { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th sidth="3%">#</th>
                                                        <th width="15%">Date</th>
                                                        <th>NIK</th>
                                                        <th>Status</th>
                                                        <th>Position</th>
                                                        <th>Level</th>
                                                        <th>Department</th>
                                                        <th>Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($career->result_array() as $row1): ?>
                                                        <tr>
                                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                                            <td style="text-align: center;"><?php echo $row1['rotation_date']; ?></td>
                                                            <td style="text-align: center;">
                                                                <?php 
                                                                    if($row['nik'] == $row1['rotation_nik']) {
                                                                        echo '<p>' . $row1['rotation_nik'] . '</p>'; 
                                                                    } else {
                                                                        echo '<p class="text-danger">' . $row1['rotation_nik'] . '</p>'; 
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php 
                                                                    if($row['employee_status'] == $row1['rotation_status']) {
                                                                        echo '<p>' . $row1['rotation_status'] . '</p>'; 
                                                                    } else {
                                                                        echo '<p class="text-danger">' . $row1['rotation_status'] . '</p>'; 
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php 
                                                                    if($row['employee_position'] == $row1['rotation_position']) {
                                                                        echo '<p>' . $row1['rotation_position'] . '</p>'; 
                                                                    } else {
                                                                        echo '<p class="text-danger">' . $row1['rotation_position'] . '</p>'; 
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php 
                                                                    if($row['employee_level'] == $row1['rotation_level']) {
                                                                        echo '<p>' . $row1['rotation_level'] . '</p>'; 
                                                                    } else {
                                                                        echo '<p class="text-danger">' . $row1['rotation_level'] . '</p>'; 
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php 
                                                                    if($row['section_code'] == $row1['rotation_section']) {
                                                                        echo '<p>' . $this->db->get_where('section', array('section_code' => $row1['rotation_section']))->row()->section_name . '</p>'; 
                                                                    } else {
                                                                        echo '<p class="text-danger">' . $this->db->get_where('section', array('section_code' => $row1['rotation_section']))->row()->section_name . '</p>'; 
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php 
                                                                    if($row['unit_code'] == $row1['rotation_unit']) {
                                                                        echo '<p>' . $this->db->get_where('unit', array('unit_code' => $row1['rotation_unit']))->row()->unit_name . '</p>'; 
                                                                    } else {
                                                                        echo '<p class="text-danger">' . $this->db->get_where('unit', array('unit_code' => $row1['rotation_unit']))->row()->unit_name . '</p>'; 
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="spk">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('spk_enddate', 'desc');
                                        $spk = $this->db->get_where('spk', array('nik' => $nik));
                                        if($spk->num_rows() < 1){ 
                                            ?>
                                            <div class="alert alert-info">
                                                No data to display
                                            </div>
                                    <?php   } else { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th width="3%">#</th>
                                                        <th>Number</th>
                                                        <th width="30%">Periode</th>
                                                        <th>Salary</th>
                                                        <th width="15%">Employee Status</th>
                                                        <th width="15%">Status</th>
                                                        <th width="5%">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($spk->result_array() as $row): ?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $count++; ?></td>
                                                            <td><?php echo $row['spk_number']; ?></td>
                                                            <td><?php echo $row['spk_startdate'] . ' - ' . $row['spk_enddate']; ?></td>
                                                            <td>
                                                                <?php
                                                                    if($row['spk_salarytype'] == 'Bulanan'){
                                                                        $type = '/Bulan';
                                                                    } elseif($row['spk_salarytype'] == 'Harian') {
                                                                        $type = '/Hari';
                                                                    } elseif($row['spk_salarytype'] == 'Connote') {
                                                                        $type = '/Connote';
                                                                    }
                                                                    
                                                                    echo 'Rp ' . number_format($row['spk_salary']) . $type;
                                                                ?>
                                                            </td>
                                                            <td><?php echo $row['spk_status'] ?></td>
                                                            <td>
                                                                <?php if ($row['spk_enddate'] >= date('Y-m-d')) { ?>
                                                                    <h5><span class="badge badge-success">Active</span></h5>   
                                                                <?php } else { ?>
                                                                    <h5><span class="badge badge-danger">Inactive</span></h5>
                                                                <?php } ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <div class="btn-group">
                                                                    <?php if ($row['spk_status'] == 'FREELANCE') { ?>
                                                                        <a href="<?php echo site_url('head/spk/print_freelance/'.$row['spk_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                            <ion-icon name="print"></ion-icon>
                                                                        </a>
                                                                    <?php } else if ($row['spk_status'] == 'MITRA') { ?>
                                                                        <a href="<?php echo site_url('head/spk/print_mitra/'.$row['spk_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                            <ion-icon name="print"></ion-icon>
                                                                        </a>
                                                                    <?php } else if ($row['spk_status'] == 'PKWT1' || $row['spk_status'] == 'PKWT2') { ?>
                                                                        <a href="<?php echo site_url('head/spk/print_pkwt/'.$row['spk_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                            <ion-icon name="print"></ion-icon>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="asset">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('asset_date', 'desc');
                                        $asset = $this->db->get_where('asset', array('nik' => $nik, 'asset_status' => 'Active'));
                                        if($asset->num_rows() < 1){ 
                                            ?>
                                            <div class="alert alert-info">
                                                No data to display
                                            </div>
                                    <?php   } else { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th sidth="3%">#</th>
                                                        <th>Asset Number</th>
                                                        <th>Serial Number</th>
                                                        <th>Type</th>
                                                        <th>Brand</th>
                                                        <th>Model</th>
                                                        <th width="10%">Date</th>
                                                        <th>Spesifications</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($asset->result_array() as $row): ?>
                                                        <tr>
                                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['asset_number']; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['asset_serialnumber']; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['asset_name'] ?></td>
                                                            <td style="text-align: center;"><?php echo $row['asset_merk'] ?></td>
                                                            <td style="text-align: center;"><?php echo $row['asset_model'] ?></td>
                                                            <td style="text-align: center;"><?php echo$row['asset_date']; ?></td>
                                                            <td><?php echo nl2br($row['asset_spesification']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="loan">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('loan_apply', 'desc');
                                        $loan = $this->db->get_where('loan', array('nik' => $nik));
                                        if($loan->num_rows() < 1){ 
                                            ?>
                                            <div class="alert alert-info">
                                                No data to display
                                            </div>
                                    <?php   } else { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th width="3%">#</th>
                                                        <th width="15%">Apply Date</th>
                                                        <th width="15%">Amount</th>
                                                        <th width="10%">Tenor</th>
                                                        <th>Purpose</th>
                                                        <th width="10%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($loan->result_array() as $row): ?>
                                                        <tr>
                                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['loan_apply']; ?></td>
                                                            <td style="text-align: center;"><?php echo 'Rp. ' . number_format($row['loan_amount']); ?></td>
                                                            <td style="text-align: center;"><?php echo $row['loan_tenor'] . ' Month'; ?></td>
                                                            <td style="text-align: center;"><?php echo nl2br($row['loan_purpose']) ?></td>
                                                            <td style="text-align: center;"><?php echo $row['loan_status'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="elearning">
                                    <?php 
                                        $count = 1;
                                        $this->db->from('elearning_class');
                                        $this->db->join('elearning_student', 'elearning_class.class_id = elearning_student.class_id');
                                        $this->db->where('nik', $nik);
                                        $this->db->where('student_status', 'Done');
                                        $this->db->order_by('class_periode', 'DESC');
                                        $elearning = $this->db->get();

                                        if($elearning->num_rows() < 1){ 
                                            ?>
                                            <div class="alert alert-info">
                                                No data to display
                                            </div>
                                    <?php   } else { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th width="5%">#</th>
                                                        <th>Elearning</th>
                                                        <th width="15%">Periode</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($elearning->result_array() as $row): ?>
                                                        <tr>
                                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                                            <td><?php echo $row['class_name']; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['class_periode'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.tab-pane -->

                            <div class="tab-pane" id="teguran">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('teguran_createdate', 'desc');
                                    $teguran = $this->db->get_where('teguran', array('nik' => $nik));
                                    if($teguran->num_rows() < 1){ 
                                        ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th width="3%">#</th>
                                                    <th width="20%">Number</th>
                                                    <th width="20%">Periode</th>
                                                    <th>Description</th>
                                                    <th width="20%">Status</th>
                                                    <th width="5%">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($teguran->result_array() as $row): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $count++; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['teguran_number']; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['teguran_createdate'] . ' - ' . $row['teguran_enddate']; ?></td>
                                                        <td><?php echo mb_strimwidth(nl2br($row['teguran_description']), 0, 200, "...") ?></td>
                                                        <td style="text-align: center;">
                                                            <?php if ($row['teguran_enddate'] >= date('Y-m-d')) { ?>
                                                                <h5><span class="badge badge-success">Active</span></h5>   
                                                            <?php } else { ?>
                                                                <h5><span class="badge badge-danger">Expired</span></h5>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div class="btn-group">
                                                                <a href="<?php echo site_url('head/teguran/print/'.$row['teguran_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                    <ion-icon name="print"></ion-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="panggilan">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('panggilan_createdate', 'desc');
                                    $panggilan = $this->db->get_where('panggilan', array('nik' => $nik));
                                    if($panggilan->num_rows() < 1){ 
                                        ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th width="3%">#</th>
                                                    <th width="20%">Number</th>
                                                    <th width="20%">Details</th>
                                                    <th>Description</th>
                                                    <th>Result</th>
                                                    <th width="10%">Create Date</th>
                                                    <th width="5%">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($panggilan->result_array() as $row): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $count++; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['panggilan_number']; ?></td>
                                                        <td>
                                                            <?php 
                                                                $date = date_create($row['panggilan_date']);
                                                                $time = date_create($row['panggilan_time']);
                                                                echo '<b>Date  : </b>' . date_format($date, "d F Y") . '<br>';
                                                                echo '<b>Time  : </b>' . date_format($time, "H:i") . '<br>';
                                                                echo '<b>Place : </b>' . $row['panggilan_place'] . '<br>'; 
                                                                echo '<b>Meet : </b>' . $row['panggilan_meet']; 
                                                            ?>
                                                        </td>
                                                        <td><?php echo nl2br($row['panggilan_description']); ?></td>
                                                        <td><?php echo nl2br($row['panggilan_result']); ?></td>
                                                        <td style="text-align: center;"><?php echo $row['panggilan_createdate']; ?></td>
                                                        <td style="text-align: center;">
                                                            <div class="btn-group">
                                                                <a href="<?php echo site_url('head/panggilan/print/'.$row['panggilan_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                    <ion-icon name="print"></ion-icon>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="pa">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('pa_year', 'desc');
                                    $pa = $this->db->get_where('pa', array('nik' => $nik));
                                    if($pa->num_rows() < 1){ 
                                        ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th width="3%">#</th>
                                                    <th>Year</th>
                                                    <th>PA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pa->result_array() as $row): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $count++; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['pa_year']; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['pa_assesment']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="family">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('family_name');
                                    $family = $this->db->get_where('family', array('nik' => $nik));
                                    if($family->num_rows() < 1){ 
                                ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th width="3%">#</th>
                                                    <th width="20%">KTP</th>
                                                    <th width="20%">BPJS</th>
                                                    <th width="15%">Status</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($family->result_array() as $row): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $count++; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['family_ktp']; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['family_bpjs']; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['family_status']; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['family_name']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="file">
                                <?php 
                                    $file = $this->db->get_where('file', array('nik' => $nik));
                                    if($file->num_rows() < 1){ 
                                ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { 
                                        foreach ($file->result_array() as $row):?>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">KTP</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_ktp'] != '' || $row['file_ktp'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/ktp/'). $row['file_ktp']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_ktp']; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">SIM</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_sim'] != '' || $row['file_sim'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/sim/'). $row['file_sim']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_sim']; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">KK</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_kk'] != '' || $row['file_kk'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/kk/'). $row['file_kk']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_kk']; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">Ijazah</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_ijazah'] != '' || $row['file_ijazah'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/ijazah/'). $row['file_ijazah']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_ijazah']; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">Transcript</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_transkrip'] != '' || $row['file_transkrip'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/transkrip/'). $row['file_transkrip']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_transkrip']; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">Curriculum Vitae</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_cv'] != '' || $row['file_cv'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/cv/'). $row['file_cv']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_cv']; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-4 col-form-label">Other</label>
                                                <div class="col-lg-10 col-8">
                                                    <?php if($row['file_other'] != '' || $row['file_other'] != NULL){ ?>
                                                        <a href="<?php echo site_url('uploads/file/other/'). $row['file_other']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </a>&nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                            <i class="fas fa-download mr-1"></i>Download
                                                        </button>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span class="text-muted"><?php echo $row['file_other']; ?></span>
                                                </div>
                                            </div>
                                <?php   endforeach; 
                                    } 
                                ?>
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php endforeach; ?>