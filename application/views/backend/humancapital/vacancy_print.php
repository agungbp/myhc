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
<body style="overflow:hidden;">
<img src="<?php echo base_url();?>uploads/vacancy_template.jpg"); width="100%" height="100%" style="position:absolute;
    z-index:0;">
<!-- Content Wrapper. Contains page content -->
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <?php
        $vacancy = $this->db->get_where('vacancy', array('vacancy_id'=>$vacancy_id))->result_array();
        foreach ($vacancy as $row): ?>
            <div class="row" style="position:relative; z-index:1; padding-top: 27.5%; margin-left: 20%; margin-right: 20%; text-align: center;">
                <div class="col-12" style="font-size: 40px;"><?php echo $row['vacancy_position']; ?></div>
            </div>
            <div class="row" style="position:relative; z-index:1; margin-top: -1%; margin-left: 20%; margin-right: 20%; text-align: center;">
                <div class="col-12" style="font-size: 40px;"><?php echo $row['vacancy_level']; ?></div>
            </div>
            <div class="row" style="position:relative; z-index:1; height: 600px;">
                <div class="col-3" style="margin-top: 23%; margin-left: 19.5%; font-size: 20px;"><?php echo mb_strimwidth(nl2br($row['vacancy_requirements']), 0, 434, " ..."); ?></div>
                <div class="col-1">&nbsp;</div>
                <div class="col-3" style="margin-top: 23%; margin-left: 3%; font-size: 20px;"><?php echo  mb_strimwidth(nl2br($row['vacancy_jobdesc']), 0, 434, " ..."); ?></div>
            </div>
            <div class="row" style="position:relative; z-index:1; margin-top: 11%; margin-left: 37%; margin-right: 30%;">
                <div class="col-12 font-weight-bold" style="font-size: 20px;">PLACEMENT <?php echo $row['vacancy_placement']; ?></div>
                <div class="col-12 font-weight-bold" style="font-size: 20px;">CLOSED <?php echo date_format(date_create($row['vacancy_lastdate']),"d F Y"); ?></div><br><br>
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
