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
<body style="font-size: 16px;">

<!-- Content Wrapper. Contains page content -->
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
    <?php
        $this->db->from('spk');
        $this->db->join('employee', 'spk.nik = employee.nik');
        $this->db->where('spk_id', $spk_id);
        $spk = $this->db->get();

        foreach ($spk->result_array() as $row):  
    ?>  

    <!-- PAGES 1 -->

    <div class="row" style="margin-top: 30px;">
        <div class="col-6">
            <div class="row">
                <div class="col-12" style="margin-bottom: 20px;"><h4><b><u>PERNYATAAN PEMOHON</u></b></h4></div>
                <div class="col-12  text-justify"  style="margin-bottom: 15px;">Saya yang bertanda tangan dibawah ini, selaku Pemohon yang sah dan berwenang untuk mengajukan kerja sama kemitraan pengiriman barang dengan JNE.</div>
                <div class="col-12" style="margin-bottom: 15px;">Bersama pengajuan ini, Saya menyatakan :</div>
                
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-11 text-justify">
                    Telah menyetujui syarat-syarat kemitraan pengiriman barang JNE dan bersedia mengikuti serta mematuhi ketentuan yang berlaku sesuai Perjanjian Mitra Pengiriman Barang.                
                </div>

                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-11 text-justify">
                    Menjamin kebenaran semua data, lampiran dan pernyataan yang disampaikan dalam formulir kemitraan (DPRF) dan JNE berhak memutuskan kerja sama secara sepihak apabila dikemudian hari terbukti terdapat ketidaksesuaian dalam pengisian formulir kemitraan (DPRF).
                </div>

                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-11 text-justify">
                    Menjamin kebenaran semua data, lampiran dan pernyataan yang disampaikan dalam formulir kemitraan (DPRF) dan JNE berhak memutuskan kerja sama secara sepihak apabila dikemudian hari terbukti terdapat ketidaksesuaian dalam pengisian formulir kemitraan (DPRF).
                </div>

                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-11 text-justify">
                    Bersedia mematuhi dan melaksanakan Standart Operational Procedures (SOP) yang telah ditentukan oleh JNE.
                </div>

                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-11 text-justify">
                    Menjamin kerahasiaan data JNE.
                </div>

                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-11 text-justify">
                    Bersedia menjamin nama baik JNE.
                </div>

                <div class="col-1" style="text-align: center;">6.</div>
                <div class="col-11 text-justify">
                    Bersedia mematuhi dan melaksanakan nilai-nilai JNE yaitu Disiplin, Jujur, Tanggung Jawab, dan Visioner.
                </div>

                <div class="col-1" style="text-align: center;">7.</div>
                <div class="col-11 text-justify"  style="margin-bottom: 20px;">
                    Bersedia membayar ganti rugi sebesar nilai barang akibat kesalahan dari pemohon.
                </div>

                <div class="col-5">&nbsp;</div>
                <div class="col-7" style="margin-bottom: 100px;">Tanda Tangan & Stempel,</div>

                <div class="col-5">&nbsp;</div>
                <div class="col-2">Nama</div>
                <div class="col-5">:&nbsp;&nbsp;<?php echo $row['employee_name']; ?></div>

                <div class="col-5">&nbsp;</div>
                <div class="col-2">Jabatan</div>
                <div class="col-5">:&nbsp;&nbsp;<?php echo $row['employee_position']; ?></div>

                <div class="col-5">&nbsp;</div>
                <div class="col-2">Tgl Join</div>
                <div class="col-5">:&nbsp;&nbsp;<?php echo date_indo($row['spk_startdate']); ?></div>
            </div>
        </div>
        
        <div class="col-6">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-12"><h4><b>PERJANJIAN MITRA PENGIRIMAN BARANG</b></h4></div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>A.</b></div>
                <div class="col-11"><b>RUANG LINGKUP PERJANJIAN MITRA</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PIHAK PERTAMA dengan ini menunjuk PIHAK KEDUA dan PIHAK KEDUA dengan ini menerima penunjukan PIHAK PERTAMA untuk melaksanakan Pengiriman Barang yang diserahkan oleh PIHAK PERTAMA melalui <b>Program Mitra Pengiriman Barang</b> dengan rincian sebagaimana tercantum dalam Lampiran PERJANJIAN MITRA PENGIRIMAN BARANG (selanjutnya disebut <b>PERJANJIAN</b>).</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify"><b>Program Mitra Pengiriman Barang</b> adalah Program Jasa Pengiriman Barang yang dititipkan oleh <b>PENGIRIM</b> di gudang PIHAK PERTAMA ke alamat <b>PENERIMA</b> sesuai dengan SOP yang telah ditentukan oleh PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">PIHAK KEDUA wajib melakukan Pekerjaan sesuai dengan <i>Service Level Availability</i> (SLA) yang ditentukan oleh PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-10 text-justify">Pengiriman Barang dilakukan dari Lokasi yang ditentukan oleh PIHAK PERTAMA kepada lokasi Penerima Barang yang tertera dalam dokumen pengiriman Barang.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-10 text-justify">Kualifikasi <b>Program Mitra Pengiriman Barang</b> adalah syarat-syarat atau aturan-aturan atau SOP yang ditentukan oleh PIHAK PERTAMA mengenai Pekerjaan, Program Kemitraan dan Pengiriman Barang.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>B.</b></div>
                <div class="col-11"><b>TUGAS DAN TANGGUNG JAWAB</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PIHAK PERTAMA akan memberikan dokumen-dokumen terkait prosedur (SOP) sebagaimana dapat digunakan untuk menunjang kinerja PIHAK KEDUA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">PIHAK KEDUA bertanggungjawab untuk melengkapi semua kebutuhan pengiriman PIHAK KEDUA dengan Surat Ijin Mengemudi (SIM) yang sesuai kendaraannya, alat kerja (kendaraan bermotor) dan/atau atau surat-surat lain yang diperlukan. Seluruh biaya yang timbul terkait menjadi tanggungjwab PIHAK KEDUA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">Lokasi Pengiriman Barang akan ditentukan oleh PIHAK PERTAMA kepada PIHAK KEDUA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-10 text-justify">PIHAK KEDUA akan melakukan Training secara bertahap sebelum dimulainya Pengiriman Barang sebagaimana dimaksud PERJANJIAN MITRA ini.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-10 text-justify">Apabila dalam pelaksanaan Pengiriman Barang sebagaimana dimaksud PERJANJIAN MITRA ini terdapat transaksi/perbuatan/proses yang dilakukan oleh PIHAK KEDUA yang tidak sesuai dengan prosedur (SOP),  yang mengakibatkan timbulnya klaim atau tuntutan dari Pihak Ketiga, maka PIHAK PERTAMA berhak memperoleh ganti rugi sebesar kerugian yang ditimbulkan oleh PIHAK KEDUA atas transaksi/perbuatan/proses tersebut.</div>
            </div>

            <div class="row">
                <div class="col-1" style="text-align: center;"><b>C.</b></div>
                <div class="col-11"><b>SERAGAM</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PIHAK KEDUA akan diberikan Seragam yang mewakili PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">Segala biaya yang timbul dalam proses produksi seragam yang akan digunakan oleh PIHAK KEDUA, menjadi tanggung jawab PIHAK KEDUA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">PIHAK PERTAMA akan menyediakan ID Card untuk PIHAK KEDUA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-10 text-justify">PIHAK KEDUA dilarang untuk menyalahgunakan dan atau merubah bentuk Seragam dan Logo PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-10 text-justify">Segala bentuk kerugian akibat penyalahgunaan seragam dan Logo yang dilakukan oleh personel PIHAK KEDUA sepenuhnya akan menjadi tanggung jawab PIHAK KEDUA.</div>
            </div>
        </div>
    </div>
    


    <!-- PAGES 2 -->

    <div class="row" style="margin-top: 50px;">
        <div class="col-6">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>D.</b></div>
                <div class="col-11"><b>KOMISI</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PIHAK KEDUA berhak untuk mendapatkan Komisi dari PIHAK PERTAMA sebagaimana ditentukan di Delivery Partnership Registration Form (DPRF) yang telah disepakati.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">Komisi PIHAK KEDUA dibayarkan oleh PIHAK PERTAMA dengan cara transfer melalui rekening bank PIHAK KEDUA sebagaimana ditentukan di Delivery Partnership Registration Form (DPRF) yang telah disepakati.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">Pembayaran komisi PIHAK KEDUA dilakukan oleh PIHAK PERTAMA setiap bulannya yang tanggalnya disesuaikan dengan kebijakan PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-10 text-justify">Setiap pajak yang timbul akibat transaksi Program Kemitraan ini dibebankan kepada masing-masing PIHAK sesuai dengan ketentuan yang berlaku.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>E.</b></div>
                <div class="col-11"><b>HAK DAN KEWAJIBAN PIHAK PERTAMA</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">HAK PIHAK PERTAMA</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">a.</div>
                <div class="col-9 text-justify">Menentukan syarat-syarat kualifikasi, keterampilan, jumlah yang dibutuhkan untuk pengelolaan, pelaksaaan dan pengembangan kegiatan usaha PIHAK PERTAMA.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">b.</div>
                <div class="col-9 text-justify">Memperoleh hasil Pengiriman Barang sebagaimana dimaksud PERJANJIAN MITRA ini sesuai dengan SLA yang ditentukan sesuai dengan PERJANJIAN MITRA ini.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">c.</div>
                <div class="col-9 text-justify">Memperoleh jaminan bahwa proses pelaksanaan Pengiriman Barang yang dilakukan PIHAK KEDUA terus menerus selama jangka waktu PERJANJIAN MITRA berjalan dengan baik sesuai dengan SOP dan regulasi yang berlaku di PIHAK PERTAMA.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">d.</div>
                <div class="col-9 text-justify">Mengevaluasi pelaksanaan Pengiriman Barang yang dilakukan PIHAK KEDUA. Berdasarkan evaluasi tersebut, PIHAK KEDUA berkewajiban untuk memberikan report terhadap PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">KEWAJIBAN PIHAK PERTAMA</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">a.</div>
                <div class="col-9 text-justify">Melakukan pembayaran Komisi Pengiriman Barang sesuai dengan ketentuan dalam PERJANJIAN MITRA ini.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">b.</div>
                <div class="col-9 text-justify">PIHAK PERTAMA akan melakukan cek absensi dan connote pengiriman yang dikirimkan PIHAK KEDUA setiap 1 (satu) hari setelah pengiriman dilakukan berdasarkan report yang dikirimkan oleh PIHAK KEDUA</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>F.</b></div>
                <div class="col-11"><b>HAK DAN KEWAJIBAN PIHAK KEDUA</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">HAK PIHAK KEDUA</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">a.</div>
                <div class="col-9 text-justify">Mendapatkan pembayaran Komisi dari PIHAK PERTAMA sesuai dengan ketentuan PERJANJIAN MITRA ini.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">KEWAJIBAN PIHAK KEDUA</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">a.</div>
                <div class="col-9 text-justify">Menjamin bahwa Pengiriman Barang sebagaimana dimaksud dalam PERJANJIAN MITRA ini akan dilaksanakan/sesuai dengan SOP yang berlaku dan memenuhi SLA yang telah ditentukan dan wajib menjamin keakuratan hasil Pengiriman Barang dimaksud.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">b.</div>
                <div class="col-9 text-justify">Menjamin PIHAK PERTAMA, bahwa proses pelaksanaan Pengiriman Barang dilakukan PIHAK KEDUA terus menerus selama jangka waktu PERJANJIAN MITRA berjalan dengan baik sesuai dengan SOP dan regulasi di PIHAK PERTAMA.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">c.</div>
                <div class="col-9 text-justify">Bertanggung jawab dan menjamin bahwa pelaksanaan Pengiriman Barang dilakukan sesuai dengan kebutuhan PIHAK PERTAMA sebagaimana dimaksud dalam PERJANJIAN MITRA.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">d.</div>
                <div class="col-9 text-justify">Melengkapi perizinan dan/atau pelengkapan yang diperlukan dalam menunjang pelaksanaan Pengiriman Barang sebagaimana dimaksud PERJANJIAN MITRA ini.</div>
            </div>
        </div>

        <div class="col-6">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">e.</div>
                <div class="col-9 text-justify">Mematuhi peraturan perundang-undangan ketenagakerjaan yang berlaku.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">f.</div>
                <div class="col-9 text-justify">Bertanggung jawab atas segala pelaksanaan Pengiriman Barang, baik prosedur ataupun proses pelaksanaan Pengiriman Barang yang dilakukan sebagaimana dimaksud Perjanijan ini.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">g.</div>
                <div class="col-9 text-justify">Setiap saat dalam jangka waktu PERJANJIAN MITRA ini, PIHAK KEDUA wajib berupaya terbaik untuk menjaga nama baik PARA PIHAK.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">h.</div>
                <div class="col-9 text-justify">PIHAK KEDUA berkewajiban menyampaikan Barang ke Penerima Barang sesuai dengan Service Level Agreement (SLA), dimana proses Pengiriman Barang akan dilakukan pada hari yang sama sejak dilakukannya proses serah terima barang dari PIHAK PERTAMA.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">i.</div>
                <div class="col-9 text-justify">Bertanggung jawab atas kiriman Barang setelah dilakukannya proses serah terima dari PIHAK PERTAMA.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">j.</div>
                <div class="col-9 text-justify">Menyediakan peralatan kerja yang terkait dengan pelaksanaan Pengiriman Barang.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">k.</div>
                <div class="col-9 text-justify">Mengembalikan segala atribut dan/atau kelengkapan Barang milik JNE selambat-lambatnya 3 (tiga) hari kalender setelah tanggal pengakhiran PERJANJIAN MITRA.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>G.</b></div>
                <div class="col-11"><b>JAMINAN KUALITAS</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PIHAK KEDUA berkewajiban mengikuti segala ketentuan mengenai jaminan kualitas kerja yang ditentukan oleh PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">Apabila terjadi pelanggaran dalam kualitas kerja yang dilakukan oleh PIHAK KEDUA, maka PIHAK PERTAMA dapat memberikan Sanksi kepada PIHAK KEDUA sesuai dengan aturan yang diatur oleh PIHAK PERTAMA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">Apabila terjadi pelanggaran yang dilakukan oleh PIHAK KEDUA maka dengan ini PIHAK KEDUA menjamin kesediaannya melakukan pembayaran sanksi dan denda yang ditentukan oleh PIHAK PERTAMA, yang diperhitungkan/dipotong dari pendapatan komisi PIHAK KEDUA.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-10 text-justify">PERJANJIAN MITRA ini dan dokumen-dokumen lain sehubungan dengan PERJANJIAN MITRA adalah sah, berlaku dan mengikat sah dan menimbulkan kewajiban hukum terhadap PARA PIHAK, sesuai dengan syarat dan ketentuan yang tercantum di dalamnya.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-10 text-justify">Setiap izin, pemberian kewenangan atau persetujuan yang diperlukan oleh PIHAK KEDUA sehubungan dengan pelaksanaan, penyerahan, keabsahan, keberlakuan PERJANJIAN MITRA ini atau pelaksanaannya oleh PIHAK KEDUA atas kewajibannya menurut PERJANJIAN MITRA ini telah diperoleh atau dibuat dan berlaku penuh.</div>
                
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-10 text-justify">PIHAK KEDUA menjamin bahwa PIHAK KEDUA memiliki kualifikasi sebagai pihak yang berpengalaman dalam melakukan kemitraan sebagaimana dimaksud dalam PERJANJIAN MITRA ini.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>I.</b></div>
                <div class="col-11"><b>GANTI RUGI</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">Bahwa tanggung jawab terhadap barang rusak, hilang, tertukar atau yang menyebabkan kerugian PIHAK PERTAMA yang disebabkan oleh PIHAK KEDUA  menjadi tanggung jawab PIHAK KEDUA, apabila dapat dibuktikan oleh PIHAK PERTAMA besaran ganti rugi sebagaimana dimaksud Lampiran pada PERJANJIAN MITRA.</div>
            </div>
        </div>
    </div>


    <!-- PAGES 3 -->

    <div class="row" style="margin-top: 50px;">
        <div class="col-6">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">Setiap kehilangan, kerusakan Barang kiriman akan dibuatkan berita acara kehilangan/kerusakan oleh PIHAK PERTAMA berdasarkan hasil investigasi. Penggantian dilakukan melalui pemotongan Pembayaran PIHAK PERTAMA kepada PIHAK KEDUA. Nilai penggantian akan dipotongkan dari tagihan PIHAK KEDUA dalam periode terdekat.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>I.</b></div>
                <div class="col-11"><b>EVALUASI</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PARA PIHAK sepakat untuk mengadakan evaluasi dan pemantauan pelaksanaan Pengiriman Barang sesuai dengan mekanisme, metode, dan tata cara yang disepakati bersama oleh PARA PIHAK.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">2.	Tanpa mengesampingkan ketentuan ayat (2) Pasal ini, PARA PIHAK sepakat untuk mengadakan pertemuan secara reguler sesuai dengan kesepakatan PARA PIHAK, dalam rangka memantau pelaksanaan Pengiriman Barang. Masing-masing Pihak wajib memberikan tanggapan dan tindak lanjut untuk setiap temuan, usulan, dan keluhan dari salah satu PIHAK yang bertujuan meningkatkan kinerja layanan PARA PIHAK.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>J.</b></div>
                <div class="col-11"><b><i>FORCE MAJEURE</i></b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">Yang dimaksud <i>Force Majeure</i> adalah hal-hal yang dapat mempengaruhi pelaksanaan Pengiriman Barang diluar kemampuan PIHAK KEDUA seperti terjadinya peperangan, huru-hara, bencaan alam, perubahan kebijaksanaan pemerintah yang secara langsung maupun tidak langung mempengaruhi PERJANJIAN MITRA ini.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">Bila terjadi <i>Force Majeure</i> PIHAK KEDUA harus memberitahukan kepada PIHAK PERTAMA secara lisan maupun tertulis dalam waktu 2 x 24 jam hari kerja setelah terjadi <i>Force Majeure</i>.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">Kelalaian dalam memenuhi kewajiban untuk memberitahukan adanya <i>Force Majeure</i> ditentukan dalam ayat 2 Pasal ini, akan menyebabkan kejadian sebagaimana dimaksud dalam Pasal ini tidak dianggap sebagai <i>Force Majeure</i>.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>K.</b></div>
                <div class="col-11"><b>JANGKA WAKTU PERJANJIAN</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PERJANJIAN ini berlaku sejak tanggal <b><?php echo date_indo($row['spk_startdate']); ?></b>  sampai  <b><?php echo date_indo($row['spk_enddate']); ?></b> dan dapat diperpanjang sesuai dengan kesepakatan PARA PIHAK.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">PERJANJIAN ini dapat berakhir karena sebab-sebab sebagai berikut:</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">a.</div>
                <div class="col-9 text-justify">Habisnya jangka waktu PERJANJIAN.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">b.</div>
                <div class="col-9 text-justify">Adanya kesepakatan PARA PIHAK untuk mengakhiri PERJANJIAN ini sebelum masa berakhirnya PERJANJIAN ini.</div>
                <div class="col-2">&nbsp;</div>
                <div class="col-1" style="text-align: center;">c.</div>
                <div class="col-9 text-justify">Adanya sesuatu hal yang ditentukan di dalam PERJANJIAN ini.</div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">PARA PIHAK secara tegas setuju untuk melepaskan/mengesampingkan ketentuan yang terdapat dalam kalimat kedua dan ketiga Pasal 1266 Kitab Undang-Undang Hukum Perdata Indonesia sepanjang yang mengatur tata cara pembatalan PERJANJIAN, sehingga mengenai pemutusan PERJANJIAN tidak diperlukan keputusan Pengadilan. </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>L.</b></div>
                <div class="col-11"><b>HUBUNGAN HUKUM</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">PIHAK PERTAMA hanya mempunyai hubungan hukum kemitraan dengan PIHAK KEDUA sesuai dengan PERJANJIAN MITRA ini dan PIHAK PERTAMA hanya berkewajiban memberikan biaya jasa kepada PIHAK KEDUA.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">PIHAK PERTAMA tidak bertanggung jawab atas klaim asuransi kesehatan, asuransi kecelakaan kerja maupun tunjangan lainnya terhadap PIHAK KEDUA.</div>
            </div>
        </div>


        <div class="col-6">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>M.</b></div>
                <div class="col-11"><b>KERAHASIAAN</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">Selama berlakunya PERJANJIAN MITRA ini dan pada setiap waktu sesudahnya, kecuali bila disyaratkan lain oleh peraturan perundang-undangan yang berlaku:</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">PARA PIHAK sepakat untuk menjaga kerahasiaan keterangan dan/atau data pendukung milik PIHAK lainnya sebagaimana dinyatakan dalam PERJANJIAN MITRA ini, serta tidak akan memberikan keterangan apapun mengenai data-data tersebut kepada siapapun selain dalam rangka pelaksanaan kewajibannya berdasarkan PERJANJIAN MITRA ini.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">3.</div>
                <div class="col-10 text-justify">PARA PIHAK sepakat bahwa segala informasi dan keterangan, baik yang tertulis maupun tidak tertulis dan informasi-informasi lain yang berkaitan dengan data billing, bisnis, produk dan pelayanan yang diketahui atau timbul berdasarkan PERJANJIAN MITRA ini adalah bersifat rahasia dan tidak boleh diberitahukan kepada pihak ketiga atau badan hukum/ orang lain yang tidak berkepentingan dengan alasan apapun, baik selama PERJANJIAN MITRA ini berlaku maupun setelah PERJANJIAN MITRA ini berakhir.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">4.</div>
                <div class="col-10 text-justify">PARA PIHAK sepakat bahwa setiap saat akan merahasiakan informasi yang diperoleh sebagai pelaksanaan dari PERJANJIAN MITRA ini kepada siapapun atau tidak akan menggunakannya untuk kepentingan pihak manapun, tanpa terlebih dahulu memperoleh persetujuan tertulis dari pejabat yang berwenang dari pihak lainnya sesuai dengan ketentuan hukum yang berlaku, kecuali untuk kepentingan investigasi dari instansi pemerintah yang berwenang.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">5.</div>
                <div class="col-10 text-justify">PARA PIHAK sepakat bahwa setiap saat akan merahasiakan informasi yang diperoleh sebagai pelaksanaan dari PERJANJIAN MITRA ini kepada siapapun atau tidak akan menggunakannya untuk kepentingan pihak manapun, tanpa terlebih dahulu memperoleh persetujuan tertulis dari pejabat yang berwenang dari pihak lainnya sesuai dengan ketentuan hukum yang berlaku, kecuali untuk kepentingan investigasi dari instansi pemerintah yang berwenang.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-1" style="text-align: center;"><b>N.</b></div>
                <div class="col-11"><b>PENYELESAIAN PERSELISIHAN</b></div>

                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">1.</div>
                <div class="col-10 text-justify">Apabila dikemudian hari terjadi perselisihan atau permasalahan antara PARA PIHAK sehubungan dengan pelaksanaan dan penafsiran PERJANJIAN ini, maka PARA PIHAK setuju untuk menyelesaikan permasalahan atau perselisihan dengan musyawarah untuk mencapai mufakat.</div>
                <div class="col-1">&nbsp;</div>
                <div class="col-1" style="text-align: center;">2.</div>
                <div class="col-10 text-justify">2.	Apabila cara penyelesaian dalam ayat 1 tidak tercapai kesepakatan dalam jangka waktu 30 (tiga puluh) hari kalender maka PARA PIHAK sepakat menyelesaikan perselisihan melalui jalur hukum yang berlaku dengan memilih domisili hokum yang tetap di Kantor Panitera Pengadilan Negeri Jakarta Barat.</div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-12 text-justify" style="margin-bottom: 20px;">Dengan demikian PIHAK KEDUA telah membaca dan mengerti seluruh isi Ketentuan-Ketentuan Mitra Pengiriman Barang.</div>
                <div class="col-12 text-justify" style="margin-bottom: 20px;">Bandung, <?php echo date_indo($row['spk_startdate']); ?></div>
                <div class="col-7">PIHAK PERTAMA</div>
                <div class="col-5" style="margin-bottom: 100px;">PIHAK KEDUA</div>
                <div class="col-7">IYUS RUSTANDI</div>
                <div class="col-5"><?php echo $row['employee_name']; ?></div>
                <div class="col-7"><i>(Head of Bandung Branch)</i></div>
                <div class="col-5">&nbsp;</div>
            </div>
        </div>
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
