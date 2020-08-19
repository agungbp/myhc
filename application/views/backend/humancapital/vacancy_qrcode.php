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
        <?php $vacancy = $this->db->get_where('vacancy', array('vacancy_id'=>$vacancy_id))->row(); ?>
        <p style="text-align: center; margin-top: 50px; margin-bottom: 70px; font-size: 80px; font-weight: bold;"><?php echo strtoupper($vacancy->vacancy_position) . ' ' . $vacancy->vacancy_level; ?></p>
        <?php
            $code = 'http://192.168.10.186/myhc/erecruitment/vacancy/details/'.$vacancy_id;
            $qrCode = new Endroid\QrCode\QrCode($code);
            $qrCode->writeFile('uploads/vacancy_qrcode/'.$vacancy_id.'.png');
        ?>
        <center>
            <img src="<?php echo $this->get_model->get_image_vacancy_qrcode_url($vacancy_id); ?>" width="80%" />
        </center>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
