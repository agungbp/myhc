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
        $count = 1;
        $this->db->from('recruitment_schedule');
        $this->db->join('recruitment_candidate', 'recruitment_schedule.schedule_id = recruitment_candidate.schedule_id');
        $this->db->join('employee', 'recruitment_candidate.nik = employee.nik');
        $this->db->join('application', 'employee.nik = application.nik');
        $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
        $this->db->where('recruitment_schedule.schedule_id', $schedule_id);
        $candidate = $this->db->get();
    ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-md-2" style="margin-top: 40px;">
                <img class="img-fluid" src="<?php echo base_url();?>assets/logo.png">
            </div>
            <div class="col-md-7" style="margin-left: 50px; text-align: center;">
                <div class="row">
                    <div class="col" style="margin-top: 50px;"><h2>RECRUITMENT ATTENDANCE LIST</h2></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><hr><br></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"><b>Applied Position</b></div>
                    <div class="col-md-3"><?php echo $candidate->row()->vacancy_position . ' ' . $candidate->row()->vacancy_level; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Recruitment Process</b></div>
                    <div class="col-md-3"><?php echo $candidate->row()->application_status; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Date</b></div>
                    <div class="col-md-3"><?php echo date_format(date_create($candidate->row()->schedule_date),"d F Y"); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Time</b></div>
                    <div class="col-md-3"><?php echo date_format(date_create($candidate->row()->schedule_time),"H:i"); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Place</b></div>
                    <div class="col-md-3"><?php echo $candidate->row()->schedule_place; ?></div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
            <table id="tabel-data" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th width="20%">Signature</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($candidate->result_array() as $row): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $count++; ?></td>
                        <td><?php echo $row['employee_name']; ?></td>
                        <td>&nbsp;</td>
                    </tr>
                <?php endforeach; ?>    
                </tbody>
            </table>
            </div>
        </div>
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
