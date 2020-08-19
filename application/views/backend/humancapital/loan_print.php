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
<body>

    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row" style="margin-top: 70px;">
                <div class="col-9 mx-auto">
            <?php
                $this->db->from('employee');
                $this->db->join('section', 'employee.section_code = section.section_code');
                $this->db->join('loan', 'employee.nik = loan.nik');
                $this->db->where('loan_id', $loan_id);
                $emp = $this->db->get();

                $this->load->helper('number_to_words');

                foreach ($emp->result_array() as $row): ?>
                    <div class="row">
                        <div class="col-3">&nbsp;</div>
                        <div class="col-6" style="text-align: center;"><img src="<?php echo base_url();?>assets/logo.png" width="50%"></div>
                        <div class="col-3">&nbsp;</div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-3">&nbsp;</div>
                        <div class="col-6" style="text-align: center;"><h4><u>PT TIKI JALUR NUGRAHA EKAKURIR</u></h4></div>
                        <div class="col-3">&nbsp;</div>
                    </div>
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-12"><h5>Kepada Yth,</h5></div>
                        <div class="col-12"><h5>Direksi PT TIKI Jalur Nugraha Ekakurir</h5></div>
                        <div class="col-12"><h5>Melalui Departemen HRD/Personalia</h5></div>
                    </div>
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-3">&nbsp;</div>
                        <div class="col-6" style="text-align: center;"><h4><u>PERMOHONAN PINJAMAN</u></h4></div>
                        <div class="col-3">&nbsp;</div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-12"><h5>Yang bertanda tangan di bawah ini :</h5></div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-3 col-form-label"><h5>Nama</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['employee_name'] ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>NIP</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['nik'] ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>Department/Cabang</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['section_name'] ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>Jabatan</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['employee_position'] ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>Tanggal Masuk Kerja</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date_indo($row['employee_join']) ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>Status Karyawan</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['employee_status'] ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>Gaji Pokok/Bulan</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Rp ' . number_format($row['loan_salary']) ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>No HP/WA</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['loan_phone'] ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-form-label">
                            <h5>Saya mengajukan permohonan pinjaman sebesar <?php echo 'Rp. ' . number_format($row['loan_amount']) ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-form-label"><h5>Keperluan</h5></div>
                        <div class="col-9 col-form-label">
                            <h5>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['loan_description'] ?></h5>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-12"><h5>Saya bersedia mentaati persyaratan dan peraturan Pinjaman yang berlaku,dan saya bersedia untuk melunasi Pinjaman saya tersebut sekaliigus bila dikemudian hari ternyata terbukti bahwa keterangan saya tersebut tidak benar dan atau akan mengundurkan diri dari perusahaan.</h5></div>
                    </div>
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-7">&nbsp;</div>
                        <div class="col-5"><h5>Bandung, <?php echo date_indo(date('Y-m-d')) ?></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-7"><h5>Mengetahui dan menyutujui,</h5></div>
                        <div class="col-5"><h5>Pemohon</h5></div>
                    </div>
                    <div class="row" style="margin-top: 120px;">
                        <div class="col-7"><h5><b>Kepala Dept / Cabang</b></h5></div>
                        <div class="col-5"><h5><b><?php echo $row['employee_name'] ?></b></h5></div>
                    </div>
            <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script type="text/javascript"> 
        window.addEventListener("load", window.print());
    </script>
</body>
</html>
