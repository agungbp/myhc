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
        <?php $egdattendance = $this->db->get_where('egd_attendance', array('egdattendance_id'=>$egdattendance_id))->row(); ?>
        <p style="text-align: center; margin-top: 50px; font-size: 80px; font-weight: bold;"><?php echo strtoupper($egdattendance->egdattendance_name); ?></p>
        <p style="text-align: center; margin-top: -30px; margin-bottom: 70px; font-size: 40px; font-weight: bold;"><?php echo strtoupper($egdattendance->egdattendance_date); ?></p>
        <?php
            $code = 'http://192.168.10.186/myhc/employee/egdattendance/attend/'.$egdattendance_token.'/'.$egdattendance_id;
            $qrCode = new Endroid\QrCode\QrCode($code);
            $qrCode->writeFile('uploads/egdattendance_qrcode/'.$egdattendance_token.'.png');
        ?>
        <center><img style="margin-bottom: 0px;" src="<?php echo $this->get_model->get_image_egdattendance_qrcode_url($egdattendance_token); ?>" width="80%" /></center>
        <p style="text-align: center; margin-bottom: 60px; font-size: 40px; font-weight: bold;"><?php echo 'TOKEN: '. strtoupper($egdattendance->egdattendance_token); ?></p>
        <p style="text-align: left;  font-size: 25px; font-weight: bold;">
            INTRUCTIONS: <br>
            1. LOGIN KE APLIKASI MYHC DI BROWSER<br>
            2. BUKA APLIKASI KAMERA ATAU QRCODE SCANNER DI PONSEL ANDA<br>
            3. BUKA LINK YANG DIDAPATKAN MENGGUNAKAN BROWSER YANG SAMA<br>
            4. CEK STATUS DI MENU EGD ATTENDANCE PADA APLIKASI MYHC
        </p>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
</body>
</html>
