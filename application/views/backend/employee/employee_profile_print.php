<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyHC | <?php echo $page_title;?></title>

    <link rel="icon" href="<?php echo base_url();?>assets/favicon.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body style="font-size: 17px;">
<?php 

    $this->db->from('employee');
    $this->db->where('nik', $this->session->userdata('login_nik'));
    $employee = $this->db->get();

    foreach ($employee->result_array() as $row):
?>
<!-- Content Wrapper. Contains page content -->
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="row">
                            <div class="col-md-2" style="margin-top: 40px;">
                                <img class="img-fluid" src="<?php echo base_url();?>assets/logo.png">
                            </div>
                            <div class="col-md-7" style="margin-left: 50px; text-align: center;">
                                <div class="row">
                                    <div class="col" style="margin-top: 30px;"><h1>EMPLOYEE PROFILE</h1></div>
                                </div>
                                <div class="row">
                                    <div class="col"><h4><?php echo $row['employee_name']; ?></h4></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card-body box-profile">
                                    <div class="text-right">
                                        <img class="profile-user-img img-fluid" src="<?php echo $this->get_model->get_image_url('employee', $row['nik']); ?>" alt="User profile picture">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <strong>COMPANY PROFILE</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['nik'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">KTP</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_ktp'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">COURIER ID</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['courier_id'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">BPJS KESEHATAN</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_bpjskesehatan'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ORION ID</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['orion_id'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">BPJS KETENAGAKERJAAN</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_bpjsketenagakerjaan'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_npwp'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">STATUS</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_status'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">LEVEL</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_level']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">POSITION</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_position'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">TYPE</label>
                                <div class="col-sm-3 col-form-label">
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
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">DEPARTMENT</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php 
                                        $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                        if($section->num_rows() > 0){
                                            echo $section->row()->section_name;
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">JOIN DATE</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_join'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">UNIT</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php 
                                        $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code'])); 
                                        if($unit->num_rows() > 0){
                                            echo $unit->row()->unit_name;
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">REGIONAL</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php 
                                        $regional = $this->db->get_where('regional', array('regional_code' => $row['regional_code']));
                                        if($regional->num_rows() > 0){
                                            echo $regional->row()->regional_name;
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">BRANCH</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php 
                                        $branch = $this->db->get_where('branch', array('branch_code' => $row['branch_code']));
                                        if($branch->num_rows() > 0){
                                            echo $branch->row()->branch_desc;
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ORIGIN</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php 
                                        $origin = $this->db->get_where('origin', array('origin_code' => $row['origin_code']));
                                        if($origin->num_rows() > 0){
                                            echo $origin->row()->origin_name;
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">ZONE</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php 
                                        $zone = $this->db->get_where('zone', array('zone_code' => $row['zone_code']));
                                        if($zone->num_rows() > 0){
                                            echo $zone->row()->zone_desc;
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">AREA</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_area'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">ZONA</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_zona'] ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>PERSONAL PROFILE</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">BIRTH PLACE</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_birthplace'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">BIRTH DATE</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_birthdate']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">GENDER</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php if ($row['employee_gender'] == 'L') {
                                            echo 'LAKI - LAKI';
                                        } else {
                                            echo 'PEREMPUAN';
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">AGE</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo date_diff(date_create($row['employee_birthdate']), date_create('today'))->y; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">MARITAL</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_marital']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">RELIGION</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_religion']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">EDUCATION</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_education']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">BANK NUMBER</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_banknumber']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">MAJOR</label>
                                <div class="col-sm-3 col-form-label">
                                <?php echo $row['employee_major']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">UNIVERSITY</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_university'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">PHONE</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_phone'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">PHONE 2</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_phone2'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ADDRESS</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_address'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">CITY</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['employee_city'] ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>ROTATION</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('rotation_date', 'desc');
                                    $this->db->from('employee_rotation');
                                    $this->db->where('nik', $this->session->userdata('login_nik'));
                                    $rotation = $this->db->get();

                                    if($rotation->num_rows() < 1){ 
                                        echo "No Data to Display";
                                  } else {
                                ?>
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
                                    <?php foreach ($rotation->result_array() as $row1): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                            <td style="text-align: center;"><?php echo $row1['rotation_date']; ?></td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($row['nik'] == $row1['rotation_nik']) {
                                                        echo '<p>' . $row1['rotation_nik'] . '</p>'; 
                                                    } else {
                                                        echo '<p class="text-danger font-weight-bold">' . $row1['rotation_nik'] . '</p>'; 
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($row['employee_status'] == $row1['rotation_status']) {
                                                        echo '<p>' . $row1['rotation_status'] . '</p>'; 
                                                    } else {
                                                        echo '<p class="text-danger font-weight-bold">' . $row1['rotation_status'] . '</p>'; 
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($row['employee_position'] == $row1['rotation_position']) {
                                                        echo '<p>' . $row1['rotation_position'] . '</p>'; 
                                                    } else {
                                                        echo '<p class="text-danger font-weight-bold">' . $row1['rotation_position'] . '</p>'; 
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($row['employee_level'] == $row1['rotation_level']) {
                                                        echo '<p>' . $row1['rotation_level'] . '</p>'; 
                                                    } else {
                                                        echo '<p class="text-danger font-weight-bold">' . $row1['rotation_level'] . '</p>'; 
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($row['section_code'] == $row1['rotation_section']) {
                                                        echo '<p>' . $this->db->get_where('section', array('section_code' => $row1['rotation_section']))->row()->section_name . '</p>'; 
                                                    } else {
                                                        echo '<p class="text-danger font-weight-bold">' . $this->db->get_where('section', array('section_code' => $row1['rotation_section']))->row()->section_name . '</p>'; 
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($row['unit_code'] == $row1['rotation_unit']) {
                                                        echo '<p>' . $this->db->get_where('unit', array('unit_code' => $row1['rotation_unit']))->row()->unit_name . '</p>'; 
                                                    } else {
                                                        echo '<p class="text-danger font-weight-bold">' . $this->db->get_where('unit', array('unit_code' => $row1['rotation_unit']))->row()->unit_name . '</p>'; 
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>SURAT TEGURAN</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('teguran_createdate', 'desc');
                                    $this->db->from('teguran');
                                    $this->db->where('nik', $this->session->userdata('login_nik'));
                                    $teguran = $this->db->get();

                                    if($teguran->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
                                <thead>
                                    <tr style="text-align: center;">
                                        <th width="3%">#</th>
                                        <th width="20%">Number</th>
                                        <th width="20%">Periode</th>
                                        <th>Description</th>
                                        <th width="20%">Status</th>
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
                                                    Active 
                                                <?php } else { ?>
                                                    Expired
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php 
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>SURAT PANGGILAN</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('panggilan_createdate', 'desc');
                                    $this->db->from('panggilan');
                                    $this->db->where('nik', $this->session->userdata('login_nik'));
                                    $panggilan = $this->db->get();

                                    if($panggilan->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
                                <thead>
                                    <tr style="text-align: center;">
                                        <th width="3%">#</th>
                                        <th width="20%">Number</th>
                                        <th width="20%">Details</th>
                                        <th>Description</th>
                                        <th>Result</th>
                                        <th width="10%">Create Date</th>
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
                                        </tr>
                                    <?php 
                                        endforeach; 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>PA</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('pa_year', 'desc');
                                    $pa = $this->db->get_where('pa', array('nik' => $this->session->userdata('login_nik')));
                                    if($pa->num_rows() < 1){ 
                                        echo "No Data to Display";
                                  } else {
                                ?>
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
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>LOAN HISTORY</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('loan_apply', 'desc');
                                    $loan = $this->db->get_where('loan', array('nik' => $this->session->userdata('login_nik')));
                                    if($loan->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
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
                                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['loan_amount']); ?></td>
                                            <td style="text-align: center;"><?php echo $row['loan_tenor'] . ' Month'; ?></td>
                                            <td style="text-align: center;"><?php echo nl2br($row['loan_purpose']) ?></td>
                                            <td style="text-align: center;"><?php echo $row['loan_status'] ?></td>
                                        </tr>
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>ELEARNING HISTORY</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->from('elearning_class');
                                    $this->db->join('elearning_student', 'elearning_class.class_id = elearning_student.class_id');
                                    $this->db->where('nik', $nik);
                                    $this->db->where('student_status', 'Done');
                                    $this->db->order_by('class_periode', 'DESC');
                                    $elearning = $this->db->get();

                                    if($elearning->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
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
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>ASSETS</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('asset_date');
                                    $asset = $this->db->get_where('asset', array('nik' => $this->session->userdata('login_nik'), 'asset_status' => 'Active'));
                                    if($asset->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
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
                                            <td style="text-align: center;"><?php echo $row['asset_date']; ?></td>
                                            <td><?php echo nl2br($row['asset_spesification']); ?></td>
                                        </tr>
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>FAMILY</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <?php
                                    $count = 1;
                                    $this->db->order_by('family_name');
                                    $family = $this->db->get_where('family', array('nik' => $this->session->userdata('login_nik')));
                                    if($family->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th width="15%">KTP</th>
                                            <th width="15%">BPJS</th>
                                            <th width="10%">Status</th>
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
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
</body>
</html>
