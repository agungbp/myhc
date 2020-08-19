<?php 

    $this->db->from('candidate');
    $this->db->join('application', 'candidate.candidate_ktp = application.nik');
    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
    $this->db->where('candidate.candidate_ktp', $candidate_ktp);
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
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo $this->get_model->get_image_url('candidate', $row['candidate_ktp']); ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center" style="margin-bottom: 30px;"><?php echo $row['candidate_name']; ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Application Status</b> <a class="float-right"><?php echo $row['application_status']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Application Date</b> <a class="float-right"><?php echo $row['application_date']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Department</b> <a class="float-right"><?php echo $this->db->get_where('section', array('section_code' => $row['vacancy_section']))->row()->section_name; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Unit</b> <a class="float-right"><?php echo $this->db->get_where('unit', array('unit_code' => $row['vacancy_unit']))->row()->unit_name; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Position</b> <a class="float-right"><?php echo $row['vacancy_position']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Level</b> <a class="float-right"><?php echo $row['vacancy_level']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Placement</b> <a class="float-right"><?php echo $row['vacancy_placement']; ?></a>
                                </li>
                            </ul>
                            <div class="dropdown" style="margin-bottom: 3px;">
                                <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-edit"></i>&nbsp;&nbsp;<b>Update Status</b>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/application/change_status_applied_eksternal/'. $row['candidate_ktp']); ?>">Applied</a>
                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/application/change_status_onreview_eksternal/'. $row['candidate_ktp']); ?>">On Review</a>
                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/application/change_status_psikotest_eksternal/'. $row['candidate_ktp']); ?>">Psikotest</a>
                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/application/change_status_interview_eksternal/'. $row['candidate_ktp']); ?>">Interview</a>
                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/application/change_status_hired_eksternal/'. $row['candidate_ktp']); ?>">Hired</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo site_url('humancapital/application/change_status_declined_eksternal/'. $row['candidate_ktp']); ?>">Declined</a>
                                </div>
                            </div>
                            <a href="<?php echo site_url('humancapital/candidate/print_eksternal/'. $row['candidate_ktp']); ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i>&nbsp;&nbsp;<b>Print CV</b></a>
                            <?php if ($row['application_status'] == 'Hired') { ?>
                                <a href="<?php echo site_url('humancapital/candidate/move_eksternal/'. $row['candidate_ktp']); ?>" class="btn btn-dark btn-block"><i class="fas fa-arrow-circle-right"></i>&nbsp;&nbsp;<b>Move Data to Employee</b></a>
                            <?php } ?>
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
                                <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family</a></li>
                                <li class="nav-item"><a class="nav-link" href="#education" data-toggle="tab">Education</a></li>
                                <li class="nav-item"><a class="nav-link" href="#certification" data-toggle="tab">Certification</a></li>
                                <li class="nav-item"><a class="nav-link" href="#organization" data-toggle="tab">Organization</a></li>
                                <li class="nav-item"><a class="nav-link" href="#jobhistory" data-toggle="tab">Job History</a></li>
                                <li class="nav-item"><a class="nav-link" href="#file" data-toggle="tab">File</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Personal Data</label>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">KTP</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_ktp'] ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Birth Place</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_birthplace'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">KTP Expire Date</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_ktpexpire'] ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Birth Date</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_birthdate'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php if ($row['candidate_gender'] == 'L') {
                                                echo 'LAKI - LAKI';
                                            } else {
                                                echo 'PEREMPUAN';
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Age</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo date_diff(date_create($row['candidate_birthdate']), date_create('today'))->y; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_religion']; ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Religion</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_religion']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Education</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_education']; ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_phone']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">University</label>
                                    <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_university'] ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Phone Number 2</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_phone2'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Major</label>
                                    <div class="col-sm-3 col-form-label">
                                    <?php echo $row['candidate_major'] ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_email'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">GPA</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_gpa']; ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_city']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-3 col-form-label">
                                        <?php echo $row['candidate_address']; ?>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-3 col-form-label">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="family">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('family_name');
                                    $family = $this->db->get_where('family', array('nik' => $candidate_ktp));
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
                                                    <th width="15%">Status</th>
                                                    <th>Name</th>
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
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="education">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('education_yearstart', 'desc');
                                    $education = $this->db->get_where('education', array('nik' => $candidate_ktp));
                                    if($education->num_rows() < 1){ 
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
                                                    <th width="15%">Level</th>
                                                    <th>School / University</th>
                                                    <th>Major</th>
                                                    <th width="10%">GPA</th>
                                                    <th width="15%">Year</th>
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
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="certification">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('certification_year', 'desc');
                                    $certification = $this->db->get_where('certification', array('nik' => $candidate_ktp));
                                    if($certification->num_rows() < 1){ 
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
                                                    <th style="text-align: center;">Name</th>
                                                    <th style="text-align: center;">Organizer</th>
                                                    <th width="10%">Year</th>
                                                    <th width="15%">File</th>
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
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="organization">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('organization_yearstart', 'desc');
                                    $organization = $this->db->get_where('organization', array('nik' => $candidate_ktp));
                                    if($organization->num_rows() < 1){ 
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
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th width="15%">Year</th>
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
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="jobhistory">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('company_yearstart', 'desc');
                                    $company = $this->db->get_where('company', array('nik' => $candidate_ktp));
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
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th width="15%">Status</th>
                                                    <th>Job Description</th>
                                                    <th width="15%">Year</th>
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
                                                        <td><?php echo nl2br($row['company_jobdesc']); ?></td>
                                                        <td style="text-align: center;"><?php echo $row['company_yearstart'] . ' - ' . $row['company_yearend']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="file">
                                <?php $file = $this->db->get_where('file', array('nik' => $candidate_ktp))->result_array(); 
                                foreach ($file as $row):?>
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
                                <?php endforeach; ?>
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