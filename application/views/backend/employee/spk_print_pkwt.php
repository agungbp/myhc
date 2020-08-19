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
    <?php
    $this->db->from('spk');
    $this->db->join('employee', 'spk.nik = employee.nik');
    $this->db->join('section', 'section.section_code = employee.section_code');
    $this->db->join('unit', 'unit.unit_code = employee.unit_code');
    $this->db->where('spk_id', $spk_id);
    $spk = $this->db->get();

    foreach ($spk->result_array() as $row): 
    // $employee = $this->db->get_where('employee', array('nik' => $row['nik']))->row(); ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-md-2" style="margin-top: 40px;">
                <img class="img-fluid" src="<?php echo base_url();?>assets/logo.png">
            </div>
            <div class="col-md-7" style="margin-left: 50px; text-align: center;">
                <div class="row">
                    <div class="col-12" style="margin-top: 30px;"><h5><b>PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</b></h5></div>
                    <div class="col-12" style="margin-top: 0px;"><h5>Nomor: <b><?php echo $row['spk_number']; ?></b></h5></div>
                    <div class="col-12" style="margin-top: 0px;"><h5><b>ANTARA PT. TIKI JALUR NUGRAHA EKAKURIR</b></h5></div>
                    <div class="col-12" style="margin-top: 0px;"><h5><b>DENGAN SAUDARA <?php echo strtoupper($row['employee_name']); ?></b></h5></div>
                </div>
            </div>
            <div class="col-md-2">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><hr><br></div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-12">
            Pada hari ini <?php echo longdate_indo($row['spk_createdate']); ?> di Bandung, dibuat dan ditandatangani Perjanjian Kerja Waktu Tertentu oleh dan antara: 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-justify">
                <div class="row">
                    <div class="col-1" style="text-align: center;">1.</div>
                    <div class="col-11 text-justify" style="margin-bottom: 15px;">
                        <b>PT. TIKI JALUR NUGRAHA EKAKURIR</b>, suatu perseroan terbatas yang didirikan secara sah berdasarkan hukum negara Republik Indonesia, berkedudukan di Jakarta, Jl. Tomang Raya No. 11, Jakarta 11440, dalam hal ini diwakili oleh <b>Iyus Rustandi</b> selaku Bandung Main Branch Head, dalam hal ini bertindak untuk dan atas nama PT. Tiki Jalur Nugraha Ekakurir, selanjutnya disebut sebagai <b>Pihak Pertama</b>;<br>
                    </div>

                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-11 text-justify">
                        dengan,
                    </div>

                    <div class="col-1" style="text-align: center;">2.</div>
                    <div class="col-11 text-justify" style="margin-bottom: 15px;">
                        <b>Sdr. <?php echo $row['employee_name']; ?></b>, Pemegang No. KTP: <?php echo $row['ktp']; ?>, bertempat tinggal di <?php echo $row['employee_address']; ?>, Jenis kelamin <?php echo $row['employee_gender']; ?>, Tempat tnggal lahir <?php echo $row['employee_birthplace'] . ', ' . date_indo($row['employee_birthdate']); ?>, Pendidikan <?php echo $row['employee_education']; ?> dan dalam hal ini bertindak untuk diri sendiri, selanjutnya disebut sebagai <b>Pihak Kedua</b>.
                    </div>

                    <div class="col-12 text-justify" style="margin-bottom: 15px;">
                        <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> untuk selanjutnya apabila masing-masing disebut <b>"Pihak"</b> dan apabila bersama-sama disebut <b>"Para Pihak"</b>.
                    </div>

                    <div class="col-12 text-justify">
                        <b>Para Pihak</b> dengan ini menerangkan hal-hal sebagai berikut:
                    </div>

                    <div class="col-1" style="text-align: center;">1.</div>
                    <div class="col-11 text-justify">
                        Bahwa <b>Pihak Pertama</b> adalah suatu perseroan terbatas yang ruang lingkup usahanya bergerak di bidang jasa pengiriman;
                    </div>

                    <div class="col-1" style="text-align: center;">2.</div>
                    <div class="col-11 text-justify" style="margin-bottom: 15px;">
                        Bahwa <b>Pihak Pertama</b> dalam rangka menjalankan usahanya bermaksud untuk memperkerjakan <b>Pihak Kedua</b> sebagai karyawan tidak tetap berdasarkan <b>Perjanjian Kerja Waktu Tertentu (PKWT)</b> sebagaimana yang diatur dalam perjanjian ini.
                    </div>

                    <div class="col-12 text-justify" style="margin-bottom: 30px;">
                        Berdasarkan hal-hal tersebut diatas, maka <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> dengan ini sepakat dan setuju untuk membuat dan menandatangani <b>Perjanjian Kerja Waktu Tertentu (PKWT)</b> (selanjutnya disebut <b>"Perjanjian"</b>), dengan syarat dan ketentuan sebagai berikut:
                    </div>


                    <!-- PASAL 1 -->
                    
                    <div class="col-12 text-center">
                        <b>Pasal 1</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Perjanjian Kerja Waktu Tertentu</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Pertama</b> dengan ini sepakat untuk memperkerjakan <b>Pihak Kedua</b> sebagai karyawan tidak tetap dan <b>Pihak Kedua</b> dengan ini sepakat untuk bekerja kepada <b>Pihak Pertama</b> sebagai karyawan tidak tetap dalam suatu hubungan kerja berdasarkan <b>Perjanjian</b> ini;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        <b>Perjanjian</b> ini dibuat untuk <b>jangka waktu selama 1 (satu) tahun</b>, sejak tanggal ditandatanganinya <b>Perjanjian</b> ini, yaitu <b>sejak <?php echo date_indo($row['spk_startdate']); ?></b> dan <b>berakhir pada tanggal <?php echo date_indo($row['spk_enddate']); ?></b>, kecuali terjadi <b>pengakhiran Perjanjian</b> sebagaimana dimaksud dalam Pasal 2 Perjanjian;
                    </div>

                    <div class="col-1" style="text-align: center;">(3)</div>
                    <div class="col-11 text-justify">
                        <b>Perjanjian</b> ini dapat diperpanjang dengan pemberitahuan tertulis terlebih dahulu dari <b>Pihak Pertama</b> kepada <b>Pihak Kedua</b> dalam jangka waktu paling lama 7 (tujuh) hari sebelum <b>Perjanjian</b> ini berakhir;
                    </div>

                    <div class="col-1" style="text-align: center;">(4)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        Hal-hal lain yang berkaitan dengan prestasi dan atau disiplin karyawan akan sangat berpengaruh terhadap penilaian unjuk kerja (performance) <b>Pihak Kedua</b> oleh <b>Pihak pertama</b> dalam meninjau <b>Perjanjian</b> ini.
                    </div>


                    <!-- PASAL 2 -->

                    <div class="col-12 text-center">
                        <b>Pasal 2</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Pengakhiran Perjanjian</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Perjanjian</b> akan berakhir dengan sendirinya apabila jangka waktu <b>Perjanjian</b> sebagaimana dimaksud dalam Pasal 1 ayat (2) <b>Perjanjian</b> ini telah selesai;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Pertama</b> dapat mengakhiri <b>Perjanjian</b> secara sepihak sebelum jangka waktu <b>Perjanjian</b> berlaku apabila <b>Pihak Kedua</b> melakukan pelanggaran terhadap performa dan disiplin sebagaimana yang diatur dalam Peraturan Perusahaan yang telah ditentukan <b>Pihak Pertama</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(3)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Pertama</b> tidak berkewajiban untuk memberikan uang pesangon dan jasa kepada <b>Pihak kedua</b> apabila jangka waktu <b>Perjanjian</b> ini berakhir;
                    </div>

                    <div class="col-1" style="text-align: center;">(4)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        Dalam jangka waktu 30 (tiga puluh) hari sebelum <b>Perjanjian</b> berakhir <b>Pihak Kedua</b> harus telah menyelesaikan segala kewajibannya dan melakukan serah terima pekerjaan antara lain penyelesaian laporan, penyerahan uang, berkas-berkas dan barang-barang kepada <b>Pihak pertama</b>.
                    </div>


                    <!-- PASAL 3 -->

                    <div class="col-12 text-center">
                        <b>Pasal 3</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Ruang Lingkup Pekerjaan dan Persyaratan Kerja</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak kedua</b> akan bekerja di Kantor Cabang Bandung Pihak Pertama <?php echo $row['section_name']; ?> sebagai <?php echo $row['unit_name']; ?> dengan <i>job description</i> terlampir;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Kedua</b> harus mematuhi prosedur kerja yang ditentukan oleh bagian Penyelia unit kerja pada Perusahaan <b>Pihak Pertama</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(3)</div>
                    <div class="col-11 text-justify">
                        Bila dipandang perlu, <b>Pihak Pertama</b> dapat menempatkan <b>Pihak Kedua</b> pada tugas-tugas atau pekerjaan lain yang sesuai dengan kemampuan <b>Pihak Kedua</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(4)</div>
                    <div class="col-11 text-justify" style="margin-bottom: 20px;">
                        <b>Pihak kedua</b> bersedia ditempatkan/dimutasikan ke bagian lain yang dipandang sesuai dengan kebutuhn Perusahaan <b>Pihak pertama</b>.
                    </div>


                    <!-- PASAL 4 -->

                    <div class="col-12 text-center">
                        <b>Pasal 4</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Hak dan Kewajiban Para Pihak</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        Hak dan Kewajiban <b>Pihak Pertama</b><br>
                        Selain yang ditentukan lain dalam <b>Perjanjian</b> ini, hak dan kewajiban <b>Pihak Pertama</b> adalah sebagai berikut:
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">a.</div>
                    <div class="col-10 text-justify">
                        <b>Pihak Pertama</b> berhak untuk menerima hasil pekerjaan <b>Pihak kedua</b> berdasarkan Ruang Lingkup dan Persyaratan Kerja sebagaimana yang dimaksud dengan Pasal 3 <b>Perjanjian</b>;
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">b.</div>
                    <div class="col-10 text-justify">
                        <b>Pihak Pertama</b> berhak untuk membuat keputusan berkaitan dengan pelaksanaan <b>Perjanjian</b> ini;
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">c.</div>
                    <div class="col-10 text-justify">
                        <b>Pihak Pertama</b> berkewajiban untuk memberikan gaji dan tunjangan kepada <b>Pihak Kedua</b> sebagaimana dimaksud dalam Pasal 7 <b>Perjanjian</b>.
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        Hak dan Kewajiban <b>Pihak Kedua</b><br>
                        Selain yang ditentukan lain dalam <b>Perjanjian</b> ini, hak dan kewajiban <b>Pihak Kedua</b> adalah sebagai berikut:
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">a.</div>
                    <div class="col-10 text-justify">
                        <b>Pihak Kedua</b> berhak untuk menerima gaji dan tunjangan dari <b>Pihak Pertama</b> sebagaimana dimaksud dalam Pasal 7 <b>Perjanjian</b>;
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">b.</div>
                    <div class="col-10 text-justify">
                        <b>Pihak Kedua</b> berkewajiban untuk melaksanakan pekerjaan berdasarkan Ruang Lingkup dan Persyaratan Kerja sebagaimana yang dimaksud dalam Pasal 3 <b>Perjanjian</b>;
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">c.</div>
                    <div class="col-10 text-justify" style="margin-bottom: 20px;">
                        <b>Pihak Kedua</b> berkewajiban untuk menjaga nama baik (citra) Perusahaan dan mematuhi peraturan yang berlaku bagi karyawan di Perusahaan <b>Pihak Pertama</b> sebagaimana yang diatur dalam peraturan Peraturan Perusahaan.
                    </div>


                    <!-- PASAL 5 -->

                    <div class="col-12 text-center">
                        <b>Pasal 5</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Waktu Kerja</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        Dalam 1 (satu) minggu, waktu kerja <b>Pihak Kedua</b> adalah hari Senin sampai dengan hari Sabtu dengan Jam Kerja sebagai berikut:
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-10 text-justify">
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-2">Senin-Jumat</div>
                            <div class="col-3">: 09:00 - 17:00 WIB</div>
                        </div>
                        <div class="row">
                            <div class="col-2">Sabtu</div>
                            <div class="col-3">: 09:00 - 14:00 WIB</div>
                        </div>
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        Apabila adad pergeseran atau perubahan jam kerja di luar sebagaimana dimaksud dalam ayat (1) di atas, maka pedoman yang dipakai adalah 40 (empat puluh) jam per minggu;
                    </div>

                    <div class="col-1" style="text-align: center;">(3)</div>
                    <div class="col-11 text-justify" style="margin-bottom: 20px;">
                        Dalam hal diperlukan, <b>Pihak Pertama</b> dapat menugaskan <b>Pihak Kedua</b> di luar waktu kerja yang telah ditentukan sebagaimana dimaksud dalam ayat (1) dan (2) pasal ini untuk kepentingan pekerjaan pada Perusahaan <b>Pihak pertama</b>, dengan memperolah upah lembur yang besarnya sebagaimana yang diatur dalam Peraturan Perusahaan.
                    </div>


                    <!-- PASAL 6 -->

                    <div class="col-12 text-center">
                        <b>Pasal 6</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Peraturan Perusahaan</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak kedua</b> harus tunduk dan mematuhi ketentuan-ketentuan yang tertulis dalam Peraturan Perusahaan <b>Pihak Pertama</b> khusunya mengenai hak dan kewajiban-kewajiban serta larangan-larangan untuk pekerja;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Pertama</b> akan memberitahukan dan menjelaskan isi Peraturan Perusahaan serta memberikan naskah Peraturan Perusahaan atau perubahaannya kepada <b>Pihak Kedua</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(3)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Kedua</b> harus membaca dan mengerti isi dai Peraturan Perusahaan yang berlaku di <b>Pihak pertama</b> dan akan mengikuti serta mematuhi semua ketentuan yang terdapat di dalam Peraturan Perusahaan <b>Pihak pertama</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(4)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        Apabila <b>Pihak kedua</b> diketahui melanggar atau melakukan tindakan indisipliner dalam tugasnya atau di lingkungan Perusahaan akan dikenakan sanksi bahkan sampai pada pembatalan perjanjian kerja.
                    </div>


                    <!-- PASAL 7 -->

                    <div class="col-12 text-center">
                        <b>Pasal 7</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Gaji dan Tunjangan</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak kedua</b> berhak memperoleh gaji dari <b>Pihak Pertama</b> sebesar <b><?php echo 'Rp, ' . number_format($row['spk_salary'], 0, ",", ".") . ',-'; ?>/<?php if ($row['spk_salarytype'] == 'Bulanan'){ echo 'bulan'; } else { echo 'hari'; } ?>, (<?php echo ucwords(number_to_words($row['spk_salary'])) ?>)</b> perbulan, yang pembayarannya dilakukan oleh <b>Pihak pertama</b> kepada <b>Pihak Kedua</b> setiap tanggal 25 setiap bulannya;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Kedua</b> berhak diikutsertakan dalam program jamsostek/BPJS Ketenagakerjaan oleh <b>Pihak Pertama</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(3)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        <b>Pihak Kedua</b> berhak memperoleh Tunjangan Hari Raya yang besarnya diperhitungkan berdasarkan misal peraturan perusahaan yang perhitungannya sudah didasarkan pada Peraturan Menteri Tenaga Kerja No. PER.04/MEN/1994.
                    </div>


                    <!-- PASAL 8 -->

                    <div class="col-12 text-center">
                        <b>Pasal 8</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Istirahat Tahunan (Cuti), Hari Libur dan Hari Raya</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak Kedua</b> berhak memperoleh waktu istirahat tahunan atau cuti kerja dengan ketentuan sebagai berikut:
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">a.</div>
                    <div class="col-10 text-justify">
                        Jika <b>Pihak Kedua</b> telah bekerja selama lebih dari 12 (dua belas) bulan secara terus menerus maka <b>Pihak Kedua</b> berhak memperoleh cuti kerja selama 15 (lima belas) hari dalam setahun;
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">b.</div>
                    <div class="col-10 text-justify">
                        Cuti kerja dapat digunakan sekaligus atau sebagian dan harus dikoordinasikan dengan atasan atau bagian HC terlebih dahulu disesuaikan dengan kondisi pekerjaan;
                    </div>
                    <div class="col-1" style="text-align: center;">&nbsp;</div>
                    <div class="col-1" style="text-align: center;">c.</div>
                    <div class="col-10 text-justify">
                        Apabila <b>Pihak Kedua</b> tidak mengambil/menggunakan hak cutinya atas kehendak sendiri setelah berakhirnya masa tenggang 12 (dua belas) bulan penggunaan hak cuti maka maka hak cutinya akan hilang atau hangus dan tidak dapat dikompensasikan dengan uang.
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        <b>Pihak Kedua</b> berhak memperoleh hari libur yang jatuh pada hari Minggu, Libur Nasional dan Hari Raya Keagamaan.
                    </div>


                    <!-- PASAL 9 -->

                    <div class="col-12 text-center">
                        <b>Pasal 9</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Kerahasiaan</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Pihak kedua</b> sepakat untuk menjaga kerahasiaan semua data dan informasi selama menjadi karyawan <b>Pihak Pertama</b> dan sehubungan dengan pelaksanaan <b>Perjanjian</b> ini dan tidak akan memberikannya kepada pihak lain tanpa persetujuan dari <b>Pihak Pertama</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        Ketentuan dalam ayat (1) Pasal ini tetap mengikat <b>Pihak Kedua</b> walaupun <b>Perjanjian</b> ini telah berakhir.
                    </div>


                    <!-- PASAL 10 -->

                    <div class="col-12 text-center">
                        <b>Pasal 10</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Penyelesaian Perselisihan</b>
                    </div>

                    <div class="col-12 text-justify"  style="margin-bottom: 20px;">
                        Apabila timbul perselisihan diantara <b>Para Pihak</b> sebagai akibat pelaksanaan <b>Perjanjin</b> ini, maka <b>Para Pihak</b> sepakat untuk menyelesaikan secara musyawarah, dan apabila penyelesaian secara musyawarah tidak mencapai kesepakatan, maka <b>Para Pihak</b> sepakat untuk melibatkan pihak ketiga melalui Mediasi, dan jika penyelesaian melalui Mediasi tidak juga dapat menyelesaikan perselisihan, maka <b>Para Pihak</b> sepakat untuk menyelesaikan secara hukum melalui Pengadilan Hubungan Industrial.
                    </div>


                    <!-- PASAL 11 -->

                    <div class="col-12 text-center">
                        <b>Pasal 11</b>
                    </div>
                    <div class="col-12 text-center" style="margin-bottom: 15px;">
                        <b>Penutup</b>
                    </div>

                    <div class="col-1" style="text-align: center;">(1)</div>
                    <div class="col-11 text-justify">
                        <b>Perjanjian</b> ini telah dimengerti dan disetujui oleh <b>Para Pihak</b>;
                    </div>

                    <div class="col-1" style="text-align: center;">(2)</div>
                    <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                        Hal-hal lain yang belum diatur dalam <b>Perjanjian</b> ini akan dituangkan dalam perjanjian tambahan (addendum) atau amandemen yang dibuat atas dasar kesepakatan <b>Para Pihak</b> yang akan menjadi satu kesatuan yang tidak terpisahkan dari <b>Perjanjian</b> ini serta mempunyai kekuatan hukum yang sama dan mengikat setelah ditandatangani oleh <b>Para Pihak</b>.
                    </div>


                    <div class="col-12 text-justify"  style="margin-bottom: 20px;">
                        Demikian <b>Pejanjian</b> ini dibuat dalam rangkap 2 (dua), masing-masing mempunyai kekuatan hukum yang sama dan mulai berlaku sejak <b>Perjanjian</b> ini ditandatangani <b>Para Pihak</b> pada tanggal yang disebutkan di awal <b>Perjanjian</b> ini. 
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;"><b>Pihak Pertama</b></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: left;"><b>Pihak Kedua</b></div>
        </div>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;"><b>PT. Tiki Jalur Nugraha Ekakurir</b></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;"><b><u><i>Iyus Rustandi</i></u></b></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: left;">
                <b><?php echo $row['employee_name']; ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4" style="text-align: left;"><i>Bandung Main Branch Head</i></div>
            <div class="col-sm-4"></div>
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
