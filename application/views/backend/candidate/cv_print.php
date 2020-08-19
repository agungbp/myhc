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

    $this->db->from('candidate');
    $this->db->where('candidate_ktp', $candidate_ktp);
    $candidate = $this->db->get();

    foreach ($candidate->result_array() as $row):
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
                                    <div class="col" style="margin-top: 30px;"><h1>CURRICULUM VITAE</h1></div>
                                </div>
                                <div class="row">
                                    <div class="col"><h4>Recruitment PT Tiki Jalur Nugraha Ekakurir</h4></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card-body box-profile">
                                    <div class="text-right">
                                        <img class="profile-user-img img-fluid" src="<?php echo $this->get_model->get_image_url('candidate', $row['candidate_ktp']); ?>" alt="User profile picture">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <strong>PERSONAL</strong>
                        </div>
                        <div class="card-body">
                        <div class="row">
                                <label class="col-sm-2 col-form-label">KTP</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_ktp'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">NAMA</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_name']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">MASA BERLAKU KTP</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_ktpexpire'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">TEMPAT LAHIR</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_birthplace']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php if ($row['candidate_gender'] == 'L') {
                                            echo 'LAKI - LAKI';
                                        } else {
                                            echo 'PEREMPUAN';
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_birthdate']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">AGAMA</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_religion']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">UMUR</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo date_diff(date_create($row['candidate_birthdate']), date_create('today'))->y; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">STATUS PERKAWINAN</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_marital']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">EMAIL</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_education']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">NOMOR HP</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_phone'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">NOMOR HP 2</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_phone2'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">PENDIDIKAN TERAKHIR</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_education']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">SEKOLAH/UNIV</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_university']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">JURUSAN</label>
                                <div class="col-sm-3 col-form-label">
                                <?php echo $row['candidate_major']; ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">IPK/NEM</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_gpa'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ALAMAT</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_address'] ?>
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-2 col-form-label">KOTA</label>
                                <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_city'] ?>
                                </div>
                            </div>
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
                                    $family = $this->db->get_where('family', array('nik' => $candidate_ktp));
                                    if($family->num_rows() < 1){ 
                                        echo "No Data to Display";
                                    } else {
                                ?>
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th width="15%">KTP</th>
                                            <th width="20%">STATUS</th>
                                            <th>NAMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($family->result_array() as $row): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                            <td style="text-align: center;"><?php echo $row['family_ktp']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['family_status']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['family_name']; ?></td>
                                        </tr>
                                <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>PENDIDIKAN</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                    <?php
                                        $count = 1;
                                        $this->db->order_by('education_yearstart', 'desc');
                                        $education = $this->db->get_where('education', array('nik' => $candidate_ktp));
                                        if($education->num_rows() < 1){ 
                                            echo "No Data to Display";
                                        } else {
                                    ?>
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th width="10%">PENDIDIKAN</th>
                                            <th>SEKOLAH/UNIV</th>
                                            <th>JURUSAN</th>
                                            <th width="10%">IPK/NEM</th>
                                            <th width="15%">TAHUN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($education->result_array() as $row): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                            <td style="text-align: center;"><?php echo $row['education_level']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['education_university']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['education_major']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['education_gpa']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['education_yearstart'] .' - '. $row['education_yearend']; ?></td>
                                        </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>SERTIFIKAT</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                    <?php
                                        $count = 1;
                                        $this->db->order_by('certification_year', 'desc');
                                        $certification = $this->db->get_where('certification', array('nik' => $candidate_ktp));
                                        if($certification->num_rows() < 1){ 
                                            echo "No Data to Display";
                                        } else {
                                    ?>
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th width="20%">NOMOR</th>
                                            <th>SERTIFIKAT</th>
                                            <th>PENYELENGGARA</th>
                                            <th width="10%">TAHUN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($certification->result_array() as $row): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                            <td style="text-align: center;"><?php echo $row['certification_number']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['certification_name']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['certification_organizer']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['certification_year']; ?></td>
                                        </tr>
                                    <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <strong>ORGANISASI</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                    <?php
                                        $count = 1;
                                        $this->db->order_by('organization_yearstart', 'desc');
                                        $organization = $this->db->get_where('organization', array('nik' => $candidate_ktp));
                                        if($organization->num_rows() < 1){ 
                                            echo "No Data to Display";
                                        } else {
                                    ?>
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th>JENIS</th>
                                            <th>ORGANISASI</th>
                                            <th>JABATAN</th>
                                            <th width="15%">TAHUN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($organization->result_array() as $row): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                            <td style="text-align: center;"><?php echo $row['organization_type']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['organization_name']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['organization_position']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['organization_yearstart'] . ' - ' . $row['organization_yearend']; ?></td>
                                        </tr>
                                    <?php endforeach; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>RIWAYAT PEKERJAAN</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                    <?php
                                        $count = 1;
                                        $this->db->order_by('company_id', 'desc');
                                        $company = $this->db->get_where('company', array('nik' => $candidate_ktp));
                                        if($company->num_rows() < 1){ 
                                            echo "No Data to Display";
                                        } else {
                                    ?>
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th>JENIS</th>
                                            <th>PERUSAHAAN</th>
                                            <th>JABATAN</th>
                                            <th width="15%">STATUS</th>
                                            <th width="15%">TAHUN</th>
                                            <th>JOB DESCRIPTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($company->result_array() as $row): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $count++; ?></td>
                                            <td style="text-align: center;"><?php echo $row['company_type']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['company_name']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['company_position']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['company_status']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['company_yearstart'] . ' - ' . $row['company_yearend']; ?></td>
                                            <td><?php echo nl2br($row['company_jobdesc']); ?></td>
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
