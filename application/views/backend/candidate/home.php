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
            $this->db->from('application');
            $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
            $this->db->where('application.nik', $this->session->userdata('login_nik'));
            $available = $this->db->get();

            if($available->num_rows() > 0){
                $cek = $this->db->get_where('application', array('nik' => $this->session->userdata('login_nik')))->row(); 
                if($cek->application_status == 'Psikotest') {
                    $this->db->from('recruitment_schedule');
                    $this->db->join('recruitment_candidate', 'recruitment_schedule.schedule_id = recruitment_candidate.schedule_id');
                    $this->db->where('nik', $this->session->userdata('login_nik'));
                    $this->db->where('application_status', 'Psikotest');
                    $this->db->where('schedule_date >=', date("Y-m-d"));
                    $psikotest = $this->db->get();

                    if ($psikotest->num_rows() > 0) {
                        foreach($psikotest->result_array() as $row): 
        ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading"><b>SELAMAT!</b></h4>
                                <p>Selamat, Anda lolos ke tahap PSIKOTEST</p>
                                <div class="row">
                                    <div class="col-12"><u><b>Jadwal Psikotest</b></u></div>
                                    <div class="col-lg-1 col-3"><b>Tanggal</b></div>
                                    <div class="col-lg-11 col-9"><?php echo date_format(date_create($row['schedule_date']),"d F Y"); ?></div>
                                    <div class="col-lg-1 col-3"><b>Pukul</b></div>
                                    <div class="col-lg-11 col-9"><?php echo date_format(date_create($row['schedule_time']),"H:i"); ?></div>
                                    <div class="col-lg-1 col-3"><b>Tempat</b></div>
                                    <div class="col-lg-11 col-9"><?php echo $row['schedule_place']; ?></div>
                                    <div class="col-lg-1 col-3"><b>Catatan</b></div>
                                    <div class="col-lg-11 col-9"><?php echo nl2br($row['schedule_note']); ?></div>
                                </div>
                            </div>
        <?php  
                        endforeach;
                    }
                } elseif ($cek->application_status == 'Interview') {
                
                    $this->db->from('recruitment_schedule');
                    $this->db->join('recruitment_candidate', 'recruitment_schedule.schedule_id = recruitment_candidate.schedule_id');
                    $this->db->where('nik', $this->session->userdata('login_nik'));
                    $this->db->where('application_status', 'Interview');
                    $this->db->where('schedule_date >=', date("Y-m-d"));
                    $interview = $this->db->get();

                    if($interview->num_rows() > 0) {
                        foreach($interview->result_array() as $row):
        ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading"><b>SELAMAT!</b></h4>
                                <p>Selamat, Anda lolos ke tahap INTERVIEW</p>
                                <div class="row">
                                    <div class="col-12"><u><b>Jadwal Interview</b></u></div>
                                    <div class="col-lg-1 col-3"><b>Tanggal</b></div>
                                    <div class="col-lg-11 col-9"><?php echo date_format(date_create($row['schedule_date']),"d F Y"); ?></div>
                                    <div class="col-lg-1 col-3"><b>Pukul</b></div>
                                    <div class="col-lg-11 col-9"><?php echo date_format(date_create($row['schedule_time']),"H:i"); ?></div>
                                    <div class="col-lg-1 col-3"><b>Tempat</b></div>
                                    <div class="col-lg-11 col-9"><?php echo $row['schedule_place']; ?></div>
                                    <div class="col-lg-1 col-3"><b>Catatan</b></div>
                                    <div class="col-lg-11 col-9"><?php echo nl2br($row['schedule_note']); ?></div>
                                </div>
                            </div>
        <?php
                        endforeach;
                    }
                } elseif ($cek->application_status == 'Hired') {

                    $this->db->from('recruitment_schedule');
                    $this->db->join('recruitment_candidate', 'recruitment_schedule.schedule_id = recruitment_candidate.schedule_id');
                    $this->db->where('nik', $this->session->userdata('login_nik'));
                    $this->db->where('application_status', 'Hired');
                    $this->db->where('schedule_date >=', date("Y-m-d"));
                    $hired = $this->db->get();

                    if($hired->num_rows() > 0) {
                        foreach($hired->result_array() as $row):
        ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading"><b>SELAMAT!</b></h4>
                                <p>Selamat, Anda diterima menjadi Karyawan JNE Bandung</p>
                                <div class="row">
                                    <div class="col-12"><u><b>Kami menunggu Anda untuk membicarakannya lebih lanjut pada</b></u></div>
                                    <div class="col-lg-1 col-3"><b>Tanggal</b></div>
                                    <div class="col-lg-11 col-9"><?php echo date_format(date_create($row['schedule_date']),"d F Y"); ?></div>
                                    <div class="col-lg-1 col-3"><b>Pukul</b></div>
                                    <div class="col-lg-11 col-9"><?php echo date_format(date_create($row['schedule_time']),"H:i"); ?></div>
                                    <div class="col-lg-1 col-3"><b>Tempat</b></div>
                                    <div class="col-lg-11 col-9"><?php echo $row['schedule_place']; ?></div>
                                    <div class="col-lg-1 col-3"><b>Catatan</b></div>
                                    <div class="col-lg-11 col-9"><?php echo nl2br($row['schedule_note']); ?></div>
                                </div>
                            </div>
        <?php
                        endforeach;
                    }
                } elseif ($cek->application_status == 'On Review') {
        ?>
                    <div class="alert alert-warning" role="alert">
                        Selamat, lamaran Kamu sedang Kami tinjau
                    </div>
        <?php
                } elseif ($cek->application_status == 'Declined') {
        ?>
                    <div class="alert alert-danger" role="alert">
                        Maaf, dengan sangat menyesal lamaran Anda masih belum dapat Kami terima. Hal ini didasarkan pada beberapa hal termasuk kualifikasi Anda yang masih belum memenuhi posisi tersebut.
                    </div>
        <?php
                }
            }
        ?>
    <?php $logged_in_user = $this->db->get_where('candidate', array('candidate_ktp' => $this->session->userdata('login_nik')))->row(); ?>
        <!-- Default box -->
        <div class="card card-primary card-outline">
            <div class="card-body" style="margin-left: 30px; margin-right: 30px;">
                <h1>Halo, <?php echo $logged_in_user->candidate_name ?>!</h1><hr><br>
                <h2 class="text-blue"><i class="fas fa-info-circle fa-2x"></i>
                    <p style="margin-top: -50px; margin-bottom: 30px; margin-left: 80px;">INFO</p>
                </h2>
                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Lengkapi profil Anda pada menu Curriculum Vitae</p>
                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Sebelum profil lengkap, Anda tidak bisa melakukan apply lowongan</p>
                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Apply lowongan yang Anda minati pada menu Lowongan</p>
                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Anda hanya dapat melamar maksimal satu lowongan</p>
                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Lihat status lamaran Anda pada menu Lamaran Saya</p>
                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Selama proses seleksi, JNE tidak pernah memungut biaya apapun</p>
                <hr class="my-4">
                <p class="text-muted">JNE Human Capital</p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->