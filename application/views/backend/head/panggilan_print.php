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
    $panggilan = $this->db->get_where('panggilan', array('panggilan_id'=>$panggilan_id))->result_array();

    foreach ($panggilan as $row): ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-md-2" style="margin-top: 40px;">
                <img class="img-fluid" src="<?php echo base_url();?>assets/logo.png">
            </div>
            <div class="col-md-7" style="margin-left: 50px; text-align: center;">
                <div class="row">
                    <div class="col" style="margin-top: 30px;"><u><h2>SURAT PANGGILAN</h2></u></div>
                </div>
                <div class="row">
                    <div class="col">No. <?php echo $row['panggilan_number']; ?></div>
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
                Dengan surat ini kami mengharapkan kehadiran saudara/i:
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Nama</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;<?php echo $this->db->get_where('employee', array('nik' => $row['nik']))->row()->employee_name; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>NIK</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;<?php echo $this->db->get_where('employee', array('nik' => $row['nik']))->row()->nik; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Jabatan</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;<?php echo $this->db->get_where('employee', array('nik' => $row['nik']))->row()->employee_position; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2">Pada :</div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Tanggal</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;
                <?php 
                    $date = date_create($row['panggilan_date']);
                    echo date_format($date,"d F Y");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Pukul</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;
                <?php 
                    $date = date_create($row['panggilan_time']);
                    echo date_format($date,"H:i");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Tempat</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;<?php echo $row['panggilan_place']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Bertemu</b></div>
            <div class="col-sm-9">
                :&nbsp;&nbsp;<?php echo $row['panggilan_meet']; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <?php echo $row['panggilan_description']; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                Demikian surat panggilan ini kami sampaikan. Atas perhatian dan kerjasamanya kami sampaikan terimakasih.
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4" style="text-align: center;">
                <?php 
                    $date = date_create($row['panggilan_createdate']);
                    echo 'Bandung, ' . date_format($date,"d F Y");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4" style="text-align: center;">
                HC Supervisor
            </div>
        </div>
        <br><br><br><br><br>
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4" style="text-align: center;">
                <u>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</u>
            </div>
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
