<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>MyHC | <?php echo $model['page_title'];?></title>

        <link rel="icon" href="<?php echo base_url();?>assets/favicon.png">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme Style -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a class="navbar-brand">
                        <img src="<?php echo base_url();?>assets/login/img/logo.png" class="brand-image">
                    </a>

                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <div class="row">
                            <div class="col bg-danger rounded">Remaining time&nbsp;&nbsp;&nbsp;<p id="jam" style="display:inline"></p> : <p id="menit" style="display:inline"></p> : <p id="detik" style="display:inline"></p></div>
                        </div>
                    </ul>
                    <ul class="order-1 order-md-5 navbar-nav navbar-no-expand ml-auto">
                        <div class="row">
                            <div class="col">                
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-finish">Finish</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </nav>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?php echo $model['page_title'];?></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"><h5 class="card-title">Navigation</h5></div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <?php echo $model['pagination']; ?>
                                        </div>
                                    </div>
                                </div><!-- /.card -->
                            </div>
                            <div class="col-lg-10">
                                <div class="card card-primary card-outline">
                                    <div class="tab-content">
                                        <div class="active tab-pane">
                                        <?php 
                                            foreach ($model['soal'] as $row): 
                                                $cek = $this->db->get_where('cbt_answer', array('answer_id' => $row['exam_id'] . '-' . $this->session->userdata('login_nik') . '-' . $row['question_id']));
                                                $number = $this->uri->segment(5);
                                                if($this->uri->segment(5) == NULL){
                                                    $number = 1;
                                                }
                                        ?>
                                                <div class="tab-pane">
                                                    <div class="card-header"><h5 class="card-title">Question #<?php echo $number; ?></h5></div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input type="hidden" name="question_id_<?php echo $number ?>" value="<?php echo $row['question_id']; ?>">
                                                                <?php if($row['question_question_file'] != NULL || $row['question_question_file'] != '') { ?>
                                                                    <img src="<?php echo $this->get_model->get_image_question_url($row['question_question_file']); ?>" width="30%"/><br>
                                                                <?php } else {
                                                                    echo '';
                                                                } ?>
                                                                <h5 class="card-title"><?php echo $row['question_question']; ?></h5><br><br>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if($row['question_type'] == 'PG'){ ?>
                                                        <a href="<?php echo site_url('candidate/exam/answer2/'. $row['exam_id'] . '/' . $number . '/' . $row['question_id'] . '/A'); ?>">
                                                            <div class="row rounded border <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'A'){ echo 'border-primary'; } else { echo 'border-secondary'; } ?>" style="margin-bottom: 10px;">
                                                                <div class="col-1 text-center <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'A'){ echo 'bg-primary'; } else { echo 'bg-secondary'; } ?>" style="padding: 10px;">A</div>
                                                                <div class="col-11" style="padding: 10px;">
                                                                    <h5 class="card-title">
                                                                        <?php if($row['question_answer_a_file'] != NULL || $row['question_answer_a_file'] != '') { ?>
                                                                            <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_a_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_a']; ?><br><br>
                                                                        <?php } else { ?>
                                                                            &nbsp;&nbsp;<?php echo $row['question_answer_a']; ?>
                                                                        <?php } ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="<?php echo site_url('candidate/exam/answer2/'. $row['exam_id'] . '/' . $number . '/' . $row['question_id'] . '/B'); ?>">
                                                            <div class="row rounded border <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'B'){ echo 'border-primary'; } else { echo 'border-secondary'; } ?>" style="margin-bottom: 10px;">
                                                                <div class="col-1 text-center <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'B'){ echo 'bg-primary'; } else { echo 'bg-secondary'; } ?>" style="padding: 10px;">B</div>
                                                                <div class="col-11" style="padding: 10px;">
                                                                    <h5 class="card-title">
                                                                        <?php if($row['question_answer_b_file'] != NULL || $row['question_answer_b_file'] != '') { ?>
                                                                            <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_b_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_b']; ?><br><br>
                                                                        <?php } else { ?>
                                                                            &nbsp;&nbsp;<?php echo $row['question_answer_b']; ?>
                                                                        <?php } ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="<?php echo site_url('candidate/exam/answer2/'. $row['exam_id'] . '/' . $number . '/' . $row['question_id'] . '/C'); ?>">
                                                            <div class="row rounded border <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'C'){ echo 'border-primary'; } else { echo 'border-secondary'; } ?>" style="margin-bottom: 10px;">
                                                                <div class="col-1 text-center <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'C'){ echo 'bg-primary'; } else { echo 'bg-secondary'; } ?>" style="padding: 10px;">C</div>
                                                                <div class="col-11" style="padding: 10px;">
                                                                    <h5 class="card-title">
                                                                        <?php if($row['question_answer_c_file'] != NULL || $row['question_answer_c_file'] != '') { ?>
                                                                            <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_c_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_c']; ?><br><br>
                                                                        <?php } else { ?>
                                                                            &nbsp;&nbsp;<?php echo $row['question_answer_c']; ?>
                                                                        <?php } ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="<?php echo site_url('candidate/exam/answer2/'. $row['exam_id'] . '/' . $number . '/' . $row['question_id'] . '/D' ); ?>">
                                                            <div class="row rounded border <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'D'){ echo 'border-primary'; } else { echo 'border-secondary'; } ?>" style="margin-bottom: 10px;">
                                                                <div class="col-1 text-center <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'D'){ echo 'bg-primary'; } else { echo 'bg-secondary'; } ?>" style="padding: 10px;">D</div>
                                                                <div class="col-11" style="padding: 10px;">
                                                                    <h5 class="card-title">
                                                                        <?php if($row['question_answer_d_file'] != NULL || $row['question_answer_d_file'] != '') { ?>
                                                                            <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_d_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_d']; ?><br><br>
                                                                        <?php } else { ?>
                                                                            &nbsp;&nbsp;<?php echo $row['question_answer_d']; ?>
                                                                        <?php } ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="<?php echo site_url('candidate/exam/answer2/'. $row['exam_id'] . '/' . $number . '/' . $row['question_id'] . '/E'); ?>">
                                                            <div class="row rounded border <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'E'){ echo 'border-primary'; } else { echo 'border-secondary'; } ?>" style="margin-bottom: 10px;">
                                                                <div class="col-1 text-center <?php if($cek->num_rows() > 0 && $cek->row()->answer_answer == 'E'){ echo 'bg-primary'; } else { echo 'bg-secondary'; } ?>" style="padding: 10px;">E</div>
                                                                <div class="col-11" style="padding: 10px;">
                                                                    <h5 class="card-title">
                                                                        <?php if($row['question_answer_e_file'] != NULL || $row['question_answer_e_file'] != '') { ?>
                                                                            <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_e_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_e']; ?><br><br>
                                                                        <?php } else { ?>
                                                                            &nbsp;&nbsp;<?php echo $row['question_answer_e']; ?>
                                                                        <?php } ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <input type="hidden" name="question_answer_key_<?php echo $number ?>" value="<?php echo $row['question_answer_key']; ?>">
                                                        <?php } else { 
                                                                echo form_open(site_url('candidate/exam/answeressay/' . $row['exam_id'] . '/' . $number . '/' . $row['question_id']), array('enctype' => 'multipart/form-data')); ?>
                                                                <div class="row">
                                                                    <div class="col-12 text-right">
                                                                        <textarea class="form-control" name="answer_answer" rows="6" placeholder="Tulis jawaban Anda disini..." required><?php if($cek->num_rows() > 0) { echo $cek->row()->answer_answer; } ?></textarea>
                                                                        <?php if($cek->num_rows() > 0) { ?>
                                                                                <i style="padding-top: 20px;">Jawaban tersimpan</i>&nbsp;&nbsp;
                                                                        <?php } ?>
                                                                        <button type="submit" class="btn btn-info" style="margin-top: 10px;">Simpan Jawaban</button>
                                                                    </div>
                                                                </div>
                                                        <?php   echo form_close();
                                                            } ?>
                                                    </div>
                                                </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div><!-- /.card -->
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div><!-- /.content -->
            </div>
            <?php echo form_open(site_url('candidate/exam/finish/'.$model['exam_id']), array('enctype' => 'multipart/form-data')); ?>
                <!-- /.content-wrapper -->
                <div class="modal fade" id="modal-finish" data-backdrop="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content" style="margin-top:100px;">
                            <div class="modal-header" >
                                <h5 class='col-12 modal-title text-center'>Are you sure?</h5>
                            </div>
                            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                                <button type="submit" class="btn btn-primary">Yes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-timesup" data-backdrop="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content" style="margin-top:100px;">
                            <div class="modal-header">
                                <h5 class='col-12 modal-title text-center'>Time is up, please save your answer!</h5>
                            </div>
                            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <script>
            CountDownTimer("<?php echo $model['soal1']->exam_end_date . ' ' . $model['soal1']->exam_end_time;?>", 'hari', 'jam', 'menit', 'detik');
            function CountDownTimer(dt, id1, id2, id3, id4)
            {
                var end = new Date(dt);

                var _second = 1000;
                var _minute = _second * 60;
                var _hour = _minute * 60;
                var _day = _hour * 24;
                var timer;

                function showRemaining() {
                    var now = new Date();
                    var distance = end - now;
                    var distance1 = now - end;
                    if(distance1 > 0){
                        clearInterval(timer);
                        return;
                    }
                    var days = Math.floor(distance / _day);
                    var hours = Math.floor((distance % _day) / _hour);
                    var minutes = Math.floor((distance % _hour) / _minute);
                    var seconds = Math.floor((distance % _minute) / _second);

                    document.getElementById(id2).innerHTML = hours;
                    document.getElementById(id3).innerHTML = minutes;
                    document.getElementById(id4).innerHTML = seconds;

                    if (days == 0 && hours == 0 && minutes == 0 && seconds == 0){
                        $('#modal-timesup').modal('show');
                    }
                }

                timer = setInterval(showRemaining, 1);

            }
        </script>

        <!-- jQuery -->
        <script src="<?php echo base_url();?>assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url();?>assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>assets/AdminLTE/dist/js/adminlte.min.js"></script>
    </body>
</html>
