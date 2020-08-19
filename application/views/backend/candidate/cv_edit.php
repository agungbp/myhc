<?php 
    $candidate = $this->db->get_where('candidate', array('candidate_ktp' => $this->session->userdata('login_nik')))->result_array();
    foreach ($candidate as $row):
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
        <div class="row">
            <div class="col-lg-2 col-12">
                <div class="card card-primary card-outline">
                    <div class="card-body" style="text-align: center;">
                <img src="<?php echo $this->get_model->get_image_url('candidate', $this->session->userdata('login_nik')); ?>" alt="User Image" width="62%">
                </div>
                </div>
            </div>
            <div class="col-lg-10 col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-2 col-6" style="margin-top: 10px;">
                                <strong style="font-size: 20px;"><?php echo $row['candidate_name']; ?></strong>
                            </div>
                            <div class="col-lg-8 col-1">&nbsp;</div>
                            <div class="col-lg-2 col-5" style="text-align: right;">
                                <a href="<?php echo site_url('candidate/cv/print/'. $row['candidate_ktp']); ?>" target="_blank" class="btn btn-success"><i class="fas fa-print"></i>&nbsp;&nbsp;<b>Cetak CV</b></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-lg-1 col-4 col-form-label">KTP</label>
                            <div class="col-lg-2 col-7 col-form-label">
                                <?php echo $row['candidate_ktp'] ?>
                            </div>
                            <div class="col-lg-1 col-1"></div>
                            <label class="col-lg-1 col-4 col-form-label">Email</label>
                            <div class="col-lg-7 col-7 col-form-label">
                                <?php echo $row['candidate_email'] ?>
                            </div>

                            <label class="col-lg-1 col-4 col-form-label">Pendidikan</label>
                            <div class="col-lg-2 col-7 col-form-label">
                                <?php echo $row['candidate_education'] ?>
                            </div>
                            <div class="col-lg-1 col-1"></div>
                            <label class="col-lg-1 col-4 col-form-label">Sekolah/Univ</label>
                            <div class="col-lg-7 col-7 col-form-label">
                                <?php echo $row['candidate_university'] ?>
                            </div>

                            <label class="col-lg-1 col-4 col-form-label">IPK/NEM</label>
                            <div class="col-lg-2 col-7 col-form-label">
                                <?php echo $row['candidate_gpa'] ?>
                            </div>
                            <div class="col-lg-1 col-1"></div>
                            <label class="col-lg-1 col-4 col-form-label">Jurusan</label>
                            <div class="col-lg-7 col-7 col-form-label">
                                <?php echo $row['candidate_major'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-tab" data-toggle="pill" href="#personal" role="tab" aria-controls="personal" aria-selected="true"><i class="fas fa-user"></i>&nbsp;&nbsp;Personal<i class="required"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="family-tab" data-toggle="pill" href="#family" role="tab" aria-controls="family" aria-selected="false"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Keluarga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="education-tab" data-toggle="pill" href="#education" role="tab" aria-controls="education" aria-selected="false"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="certification-tab" data-toggle="pill" href="#certification" role="tab" aria-controls="certification" aria-selected="false"><i class="fas fa-certificate"></i>&nbsp;&nbsp;Sertifikat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="organization-tab" data-toggle="pill" href="#organization" role="tab" aria-controls="organization" aria-selected="false"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;Organisasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="company-tab" data-toggle="pill" href="#company" role="tab" aria-controls="company" aria-selected="false"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Riwayat kerja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="file-tab" data-toggle="pill" href="#file" role="tab" aria-controls="file" aria-selected="false"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;File<i class="required"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <?php  echo form_open(site_url('candidate/cv/update/'), array('enctype' => 'multipart/form-data')); ?>
                                <?php include 'cv_edit_personal.php' ?>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <a href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/family_add/'.$this->session->userdata('login_nik')); ?>');" class="btn btn-primary pull-left">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah kelurga
                                    </a>
                                    <br><br>
                                </div>
                                <div class="panel-body">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('family_name');
                                        $family = $this->db->get_where('family', array('nik' => $this->session->userdata('login_nik')));
                                        if($family->num_rows() < 1){ 
                                    ?>
                                            <div class="alert alert-info">
                                                Tidak ada data untuk ditampilkan
                                            </div>
                                    <?php   } else { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th width="5%">#</th>
                                                            <th width="10%">KTP</th>
                                                            <th width="15%">Status</th>
                                                            <th>Nama</th>
                                                            <th width="10%">Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($family->result_array() as $row): ?>
                                                            <tr>
                                                                <td style="text-align: center;"><?php echo $count++; ?></td>
                                                                <td style="text-align: center;"><?php echo $row['family_ktp']; ?></td>
                                                                <td style="text-align: center;"><?php echo $row['family_status']; ?></td>
                                                                <td style="text-align: center;"><?php echo $row['family_name']; ?></td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-success btn-sm " onclick="FormModalMd('<?php echo site_url('modal/popup/family_edit/'.$row['family_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                            <ion-icon name="create"></ion-icon>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('candidate/family/delete/'.$row['family_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                            <ion-icon name="trash"></ion-icon>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="aducation-tab">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/education_add/'.$this->session->userdata('login_nik')); ?>');" class="btn btn-primary pull-left">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah pendidikan
                                    </a>
                                    <br><br>
                                </div>
                                <div class="panel-body">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('education_yearstart');
                                        $education = $this->db->get_where('education', array('nik' => $this->session->userdata('login_nik')));
                                        if($education->num_rows() < 1){ 
                                    ?>
                                            <div class="alert alert-info">
                                                Tidak ada data untuk ditampilkan
                                            </div>
                                    <?php   } else { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th width="5%">#</th>
                                                            <th width="15%">Pendidikan</th>
                                                            <th>Sekolah/Univ</th>
                                                            <th>Jurusan</th>
                                                            <th width="10%">IPK/NEM</th>
                                                            <th width="10%">Tahun</th>
                                                            <th width="10%">Options</th>
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
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/education_edit/'.$row['education_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                            <ion-icon name="create"></ion-icon>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('candidate/education/delete/'.$row['education_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                            <ion-icon name="trash"></ion-icon>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="certification" role="tabpanel" aria-labelledby="certification-tab">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/certification_add/'.$this->session->userdata('login_nik')); ?>');" class="btn btn-primary pull-left">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Certification
                                    </a>
                                    <br><br>
                                </div>
                                <div class="panel-body">
                                    <?php 
                                        $count = 1;
                                        $this->db->order_by('certification_year');
                                        $certification = $this->db->get_where('certification', array('nik' => $this->session->userdata('login_nik')));
                                        if($certification->num_rows() < 1){ 
                                    ?>
                                            <div class="alert alert-info">
                                                Tidak ada data untuk ditampilkan
                                            </div>
                                    <?php   } else { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th width="5%">#</th>
                                                            <th width="20%">Nomor</th>
                                                            <th>Sertifikat</th>
                                                            <th>Penyelenggara</th>
                                                            <th width="10%">Tahun</th>
                                                            <th width="10%">File</th>
                                                            <th width="10%">Options</th>
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
                                                                <td style="text-align: center;">
                                                                    <?php if($row['certification_file'] != '' || $row['certification_file'] != NULL){ ?>
                                                                        <a href="<?php echo site_url('uploads/file/certification/'). $row['certification_file']; ?>" class="btn btn-primary btn-icon icon-left" target="_blank">
                                                                            <i class="fas fa-download mr-1"></i>Download
                                                                        </a>&nbsp;&nbsp;
                                                                    <?php } else { ?>
                                                                        <button class="btn btn-primary btn-icon icon-left" disabled>
                                                                            <i class="fas fa-download mr-1"></i>Download
                                                                        </button>&nbsp;&nbsp;
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/certification_edit/'.$row['certification_number'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                            <ion-icon name="create"></ion-icon>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('candidate/certification/delete/'.$row['certification_number'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                            <ion-icon name="trash"></ion-icon>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/organization_add/'.$this->session->userdata('login_nik')); ?>');" class="btn btn-primary pull-left">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah organisasi
                                </a>
                                <br><br>
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('organization_yearstart');
                                    $organization = $this->db->get_where('organization', array('nik' => $this->session->userdata('login_nik')));
                                    if($organization->num_rows() < 1){ 
                                ?>
                                        <div class="alert alert-info">
                                            Tidak ada data untuk ditampilkan
                                        </div>
                                <?php   } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th width="5%">#</th>
                                                    <th>Jenis</th>
                                                    <th>Organisasi</th>
                                                    <th>Jabatan</th>
                                                    <th width="15%">Tahun</th>
                                                    <th width="10%">Options</th>
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
                                                        <td style="text-align: center;">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/organization_edit/'.$row['organization_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                    <ion-icon name="create"></ion-icon>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('candidate/organization/delete/'.$row['organization_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                    <ion-icon name="trash"></ion-icon>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/company_add/'.$this->session->userdata('login_nik')); ?>');" class="btn btn-primary pull-left">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah perusahaan
                                </a>
                                <br><br>
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('company_id', 'desc');
                                    $company = $this->db->get_where('company', array('nik' => $this->session->userdata('login_nik')));
                                    if($company->num_rows() < 1){ 
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
                                                    <th width="20%">Perusahaan</th>
                                                    <th width="15%">Jabatan</th>
                                                    <th width="10%">Status</th>
                                                    <th width="10%">Tahun</th>
                                                    <th width="30%">Job Description</th>
                                                    <th width="10%">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($company->result_array() as $row): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $count++; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['company_name'] ?></td>
                                                        <td style="text-align: center;"><?php echo $row['company_position'] ?></td>
                                                        <td style="text-align: center;"><?php echo $row['company_status']; ?></td>
                                                        <td style="text-align: center;"><?php echo $row['company_yearstart'] . ' - ' . $row['company_yearend']; ?></td>
                                                        <td><?php echo nl2br($row['company_jobdesc']); ?></td>
                                                        <td style="text-align: center;">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success btn-sm" onclick="FormModal('<?php echo site_url('modal/popup/company_edit/'.$row['company_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                    <ion-icon name="create"></ion-icon>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="DeleteModal('<?php echo site_url('candidate/company/delete/'.$row['company_id'].'/'.$this->session->userdata('login_nik')); ?>');">
                                                                    <ion-icon name="trash"></ion-icon>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="5%">#</th>
                                            <th width="15%">File</th>
                                            <th width="40%">Nama dokumen</th>
                                            <th width="20%">Options</th>
                                            <th width="25%">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                            if (!empty($file = $this->db->get_where('file', array('nik'=>$this->session->userdata('login_nik')))->result_array())) {
                                                foreach ($file as $row):
                                                    echo form_open(site_url('candidate/file/upload/'). $this->session->userdata('login_nik'), array('enctype' => 'multipart/form-data')); ?>
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: center;">1</td>
                                                                <td>KTP <i class="required"></i></td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/ktp/' . $row['file_ktp']; ?>" target="_blank">
                                                                        <?php echo $row['file_ktp']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_ktp" accept=".pdf" id="uploadfile"/></td>
                                                                <td>.pdf (max: 500kb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;">2</td>
                                                                <td>SIM</td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/sim/' . $row['file_sim']; ?>" target="_blank">
                                                                        <?php echo $row['file_sim']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_sim" accept=".pdf" id="uploadfile"/></td>
                                                                <td>.pdf (max: 500kb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;">3</td>
                                                                <td>KK</td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/kk/' . $row['file_kk']; ?>" target="_blank">
                                                                        <?php echo $row['file_kk']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_kk" accept=".pdf" id="uploadfile"/></td>
                                                                <td>.pdf (max: 500kb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;">4</td>
                                                                <td>Ijazah <i class="required"></i></td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/ijazah/' . $row['file_ijazah']; ?>" target="_blank">
                                                                        <?php echo $row['file_ijazah']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_ijazah" accept=".pdf" id="uploadfile"/></td>
                                                                <td>.pdf (max: 500kb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;">5</td>
                                                                <td>Transkrip Nilai <i class="required"></i></td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/transkrip/' . $row['file_transkrip']; ?>" target="_blank">
                                                                        <?php echo $row['file_transkrip']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_transkrip" accept=".pdf" id="uploadfile"/></td>
                                                                <td>.pdf (max: 500kb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;">6</td>
                                                                <td>Curriculum Vitae <i class="required"></i></td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/cv/' . $row['file_cv']; ?>" target="_blank">
                                                                        <?php echo $row['file_cv']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_cv" accept=".pdf" id="uploadfile"/></td>
                                                                <td>.pdf (max: 500kb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;">7</td>
                                                                <td>Lainnya (Disatukan dalam satu file)</td>
                                                                <td>
                                                                    <a href="<?php echo base_url().'uploads/file/other/' . $row['file_other']; ?>">
                                                                        <?php echo $row['file_other']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><input type="file" name="file_other" accept=".rar, .zip" id="uploadfileother"/></td>
                                                                <td>.rar/.zip (max: 2mb)</td>                           
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5"><button type="submit" class="btn btn-info">Simpan</button></td>
                                                            </tr>
                                                        </tbody>
                                            <?php   echo form_close(); 
                                                endforeach; 
                                            } else { 
                                                echo form_open(site_url('candidate/file/upload_edit/').$this->session->userdata('login_nik'), array('enctype' => 'multipart/form-data')); 
                                            ?>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">1</td>
                                                            <td>KTP <i class="required"></i></td>
                                                            <td></td>
                                                            <td><input type="file" name="file_ktp" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">2</td>
                                                            <td>SIM</td>
                                                            <td></td>
                                                            <td><input type="file" name="file_sim" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">3</td>
                                                            <td>KK</td>
                                                            <td></td>
                                                            <td><input type="file" name="file_kk" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">4 <i class="required"></i></td>
                                                            <td>Ijazah</td>
                                                            <td></a>
                                                            </td>
                                                            <td><input type="file" name="file_ijazah" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">5 <i class="required"></i></td>
                                                            <td>Transkrip Nilai</td>
                                                            <td></a>
                                                            </td>
                                                            <td><input type="file" name="file_transkrip" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">6 <i class="required"></i></td>
                                                            <td>Curriculum Vitae</td>
                                                            <td></a>
                                                            </td>
                                                            <td><input type="file" name="file_cv" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">7</td>
                                                            <td>Lainnya (Disatukan dalam satu file)</td>
                                                            <td></a>
                                                            </td>
                                                            <td><input type="file" name="file_other" accept=".rar, .zip" id="uploadfileother"/></td>
                                                            <td>.rar/.zip (max: 2mb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5"><button type="submit" class="btn btn-info">Simpan</button></td>
                                                        </tr>
                                                    </tbody>
                                        <?php   echo form_close();
                                            } 
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php endforeach; ?>

    <script type="text/javascript">
        var uploadField = document.getElementById("uploadfile");

        uploadField.onchange = function() {
            if(this.files[0].size > 500000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>

    <script type="text/javascript">
        var uploadField = document.getElementById("uploadfileother");

        uploadField.onchange = function() {
            if(this.files[0].size > 2000000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>