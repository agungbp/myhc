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

<!-- Content Wrapper. Contains page content -->
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
    <?php
    $spk = $this->db->get_where('spk', array('spk_id'=>$spk_id))->result_array();

    foreach ($spk as $row): 
    $employee = $this->db->get_where('employee', array('nik' => $row['nik']))->row(); ?>
    <div class="row" style="margin-top: 50px;">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-md-2" style="margin-top: 40px;">
                <img class="img-fluid" src="<?php echo base_url();?>assets/logo.png">
            </div>
            <div class="col-md-7" style="margin-left: 50px; text-align: center;">
                <div class="row">
                    <div class="col" style="margin-top: 30px;"><u><h2>SURAT PERINTAH KERJA</h2></u></div>
                </div>
                <div class="row">
                    <div class="col"><?php echo $row['spk_number']; ?></div>
                </div>
            </div>
            <div class="col-md-2">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><hr><br></div>
        </div>
        <div class="row">
            <div class="col-md-12">
            Surat Perintah Kerja (selanjutnya disebut SPK) ini diberikan kepada :
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"><b>Nama</b></div>
            <div class="col-sm-9">
                <b>:&nbsp;&nbsp;<?php echo $employee->employee_name; ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"><b>Tempat & Tanggal Lahir</b></div>
            <div class="col-sm-9">
                <b>:&nbsp;&nbsp;<?php echo $employee->employee_birthplace . ', ' . date_indo($employee->employee_birthdate); ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"><b>Alamat</b></div>
            <div class="col-sm-9">
                <b>:&nbsp;&nbsp;<?php echo $employee->employee_address . ', ' . $employee->employee_city; ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"><b>Jabatan</b></div>
            <div class="col-sm-9">
                <b>:&nbsp;&nbsp;<?php echo $row['spk_position']; ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"><b>Penempatan</b></div>
            <div class="col-sm-9">
                <b>:&nbsp;&nbsp;<?php echo $this->db->get_where('section', array('section_code' => $row['section_code']))->row()->section_name; ?></b>
            </div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-12 text-justify">
                Terhitung mulai tanggal <b><?php echo date_indo($row['spk_startdate']); ?></b> sampai <b><?php echo date_indo($row['spk_enddate']); ?></b> dengan tanggal bekerja di
                <em>PT. Tiki Jalur Nugraha Ekakurir</em> sebagai/pada jabatan <b><?php echo $row['spk_position']; ?></b> di <b><?php echo $this->db->get_where('section', array('section_code' => $row['section_code']))->row()->section_name; ?></b>
                dengan ketentuan sebagai berikut : <br>
                <div class="row">
                    <div class="col-1" style="text-align: center;">1.</div>
                    <div class="col-11 text-justify">
                        Bahwa yang bersangkutan yang namanya tercantum dalam SPK ini adalah karyawan dengan status karyawan <b><?php echo $row['spk_status']; ?></b>.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">2.</div>
                    <div class="col-11 text-justify">
                        Bahwa sebagai karyawan dengan status tersebut di atas yang bersangkutan wajib tunduk pada Peraturan Perusahaan dan Tata Tertib Kerja di unit kerjanya serta Instruksi Kerja (Strandard Operating Procedure) yang berlaku.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">3.</div>
                    <div class="col-11 text-justify">
                        Bahwa karyawan yang bersangkutan wajib taat pada Perintah dan Pengarahan dari Atasan, baik Atasan Langsung maupun Atasan yang lebih tinggi.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">4.</div>
                    <div class="col-11 text-justify">
                        Bahwa yang bersangkutan bersedia ditempatkan atau dipindahkan ke bagian lain apabila diperlukan oleh perusahaan.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">5.</div>
                    <div class="col-11 text-justify">
                        Bahwa yang bersangkutan bersedia bekerja dalam hari kerja dan jam kerja yang ditetapkan oleh Pimpinan Departement.
                    </div>
                    <div class="col-1" style="text-align: center;">6.</div>
                    <div class="col-11 text-justify">
                        Bahwa yang bersangkutan berhak menerima upah yang ditetapkan yaitu sebesaar 
                        <b><?php
                            if($row['spk_salarytype'] == 'Bulanan'){
                                $type = '/Bulan';
                            } elseif($row['spk_salarytype'] == 'Harian') {
                                $type = '/Hari';
                            } elseif($row['spk_salarytype'] == 'Connote') {
                                $type = '/Connote';
                            }
                            
                            echo 'Rp ' . number_format($row['spk_salary']) . ',-' . $type;
                        ?></b> yang pembayarannya akan diperhitungkan dengan kehadirannya.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">7.</div>
                    <div class="col-11 text-justify">
                        Sebagai harian lepas ybs tidak menerima pendapatan lain seperti ; kesejahteraan beras, insentif kehadiran, biaya pengobatan baik rawat inap maupun rawat jalan.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">8.</div>
                    <div class="col-11 text-justify">
                        Surat perintah kerja ini tidak berlaku lagi apabila yang bersangkutan tidak masuk kerja selama 3 (tiga) hari berturut-turut tanpa keterangan dengan bukti yang sah atau dinilai tidak mampu bekerja sesuai standar yang ditetapkan atau
                        yang bersangkutan melakukan kesalahan berat di perusahaan.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">9.</div>
                    <div class="col-11 text-justify">
                        Tanggal dan waktu untuk memulai pekerjaan sesuai dengan yang sudah disepakati dalam perjanjian ini, dan ketika jangka waktu berakhir maka hak dan kewajiban juga akan berakhir dengan sendirinya.<br>
                    </div>
                    <div class="col-1" style="text-align: center;">10.</div>
                    <div class="col-11 text-justify">
                        Surat Perintah Kerja ini dibaca, dimengerti dan disetujui oleh karyawan yang bersangkutan.<br>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                <?php 
                    echo 'Bandung, ' . date_indo($row['spk_createdate']);
                ?>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;">Yang memberikan perintah kerja</div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: center;">Karyawan yang bersangkutan</div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;">
                <?php
                    $this->db->from('section');
                    $this->db->join('employee', 'section.section_head = employee.nik');
                    $this->db->where('section.section_code', $row['section_code']);
                    $head = $this->db->get();

                    echo $head->row()->employee_name;
                ?>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: center;">
                <?php echo $employee->employee_name; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;"><?php echo $this->db->get_where('section', array('section_code' => $row['section_code']))->row()->section_name . ' HEAD'; ?></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: center;">Mengetahui,</div>
            <div class="col-sm-4"></div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: center;">IYUS RUSTANDI</div>
            <div class="col-sm-4"></div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: center;">BANDUNG MAIN BRANCH HEAD</div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <div class="col-1"></div>
    </div>
<?php endforeach; ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
