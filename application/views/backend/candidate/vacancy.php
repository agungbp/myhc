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
        <?php 
            $this->db->from('candidate');
            $this->db->where('candidate_ktp', $this->session->userdata('login_nik'));
            $candidate = $this->db->get()->row();

            $this->db->from('file');
            $this->db->where('nik', $this->session->userdata('login_nik'));
            $file = $this->db->get()->row();

            $this->db->from('vacancy');
            $this->db->where('vacancy_lastdate >=', date('Y-m-d'));
            $this->db->where('user_type', 'CANDIDATE');
            $vacancy = $this->db->get();

            $available = $vacancy->num_rows();

            if($available > 0 && $candidate->candidate_phone != null && $candidate->candidate_birthplace != null && $candidate->candidate_birthdate != null && $candidate->candidate_gender != null && $candidate->candidate_religion != null && $candidate->candidate_marital != null && $candidate->candidate_education != null && $candidate->candidate_university != null && $candidate->candidate_city != null && $candidate->candidate_address != null && $file->file_ktp != null && $file->file_ijazah != null && $file->file_transkrip != null && $file->file_cv != null){
                foreach ($vacancy->result_array() as $row): 
        ?>
                    <div class="card card-primary card-outline">
                        <h5 class="card-header font-weight-bold" style="margin-left: 30px; margin-right: 30px; margin-top: 20px;"><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></h5>
                        <div class="card-body" style="margin-left: 30px; margin-right: 30px; margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-title"><i class="fas fa-calendar"></i>&nbsp;&nbsp;
                                        <?php echo date_format(date_create($row['vacancy_publishdate']),"d F Y") . ' - ' . date_format(date_create($row['vacancy_lastdate']),"d F Y"); ?>
                                    </p><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;<?php echo $row['vacancy_placement']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="margin-bottom: 0px;"><b>Job Description</b></p>
                                    <p><?php echo nl2br($row['vacancy_jobdesc']); ?><hr></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="margin-bottom: 0px;"><b>Kriteria</b></p>
                                    <p><?php echo nl2br($row['vacancy_requirements']); ?></p>
                                </div>
                            </div>
                            <?php $application = $this->db->get_where('application', array('nik' => $this->session->userdata('login_nik'), 'application_status !=' => 'Declined'))->num_rows(); ?>
                            <?php if ($application < 1) { ?>
                                <div class="row">
                                    <div class="col-md-12">       
                                        <a href="<?php echo site_url('candidate/application/apply/'.$row['vacancy_id'].'/'.$this->session->userdata('login_nik')); ?>" class="btn btn-primary"><i class="fas fa-check-square"></i>&nbsp;&nbsp;Apply</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-12">       
                                        <button class="btn btn-secondary" disabled><i class="fas fa-check-square"></i>&nbsp;&nbsp;Apply</button>&nbsp;&nbsp;
                                        <span class="text text-muted">Anda hanya bisa melamar satu pekerjaan dalam satu waktu</span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
        <?php   endforeach; 
            } elseif ($candidate->candidate_phone == null || $candidate->candidate_birthplace == null || $candidate->candidate_birthdate == null || $candidate->candidate_gender == null || $candidate->candidate_religion == null || $candidate->candidate_marital == null || $candidate->candidate_education == null || $candidate->candidate_university == null || $candidate->candidate_city == null || $candidate->candidate_address == null || $file->file_ktp == null || $file->file_ijazah == null || $file->file_transkrip == null && $file->file_cv == null) {
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Silahkan lengkapi profil Anda terlebih dahulu
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            } elseif ($available <= 0) { 
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Tidak ada lowongan tersedia
                            </div>
                        </div>
                    </div>
                </div>
       <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->