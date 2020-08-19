<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>MyHC | <?php echo $page_title;?></title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme Style -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition layout-top-nav">
        <?php echo form_open(site_url('employee/exam/answer/'.$exam_id), array('enctype' => 'multipart/form-data')); ?>
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
                                <h1 class="m-0 text-dark"><?php echo $page_title;?></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <?php 
                    $count = 1;
                    $count2 = 1;
                    $count3 = 1;
                    $count4 = 1;
                    $count5 = 1;
                    $count6 = 1;
                    $count7 = 1;
                    $count8 = 1;
                    $count9 = 1;
                    $count10 = 1;
                    $count11 = 1;
                    $count12 = 1;
                    $count13 = 1;
                    $this->db->from('cbt_exam');
                    $this->db->join('cbt_questionpack', 'cbt_exam.questionpack_id = cbt_questionpack.questionpack_id');
                    $this->db->join('cbt_question', 'cbt_question.questionpack_id = cbt_questionpack.questionpack_id');
                    $this->db->where('exam_id', $exam_id);
                    $question = $this->db->get();
                ?>
                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"><h5 class="card-title">Navigation</h5></div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <?php foreach ($question->result_array() as $row): ?>
                                                <div class="col-3 border border-primary rounded text-center" style="margin: 3px;"><a href="<?php echo '#question'.$count++ ?>" data-toggle="tab"><?php echo $count2++ ?></a></div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div><!-- /.card -->
                            </div>
                            <div class="col-lg-10">
                                <div class="card card-primary card-outline">
                                    <div class="tab-content">
                                        <div class="active tab-pane">
                                            <div class="card-header"><h5 class="card-title">Info</h5></div>
                                            <div class="card-body">
                                                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Timer waktu di atas menunjukan sisa waktu Anda untuk mengerjakan soal.</p>
                                                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Gunakan tombol navigasi disamping atau tombol <b>NEXT</b> dan <b>PREVIOUS</b> di bawah untuk berpindah dari soal satu ke soal yang lain.</p> 
                                                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; Tekan tombol <b>FINISH</b> untuk menyimpan jawaban dan mengakhiri sesi ujian</p> 
                                                <p class="lead" style="margin-bottom: 2px;"><i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp; <b>PENTING</b>: Jangan merefresh halaman ini karena jawaban Anda tidak akan tersimpan dan Anda harus mengisi kembali dari awal.</p>                                        
                                            </div>
                                        </div>
                                        <?php foreach ($question->result_array() as $row): ?>
                                            <div class="tab-pane" id="<?php echo 'question'.$count3++ ?>">
                                                <div class="card-header"><h5 class="card-title">Question #<?php echo $count4++ ?></h5></div>
                                                <div class="card-body">
                                                    <input type="hidden" name="question_id_<?php echo $count5++ ?>" value="<?php echo $row['question_id']; ?>">
                                                    <?php if($row['question_question_file'] != NULL || $row['question_question_file'] != '') { ?>
                                                        <img src="<?php echo $this->get_model->get_image_question_url($row['question_question_file']); ?>" width="30%"/><br>
                                                    <?php } else {
                                                        echo '';
                                                    } ?>
                                                    <h5 class="card-title"><?php echo $row['question_question']; ?></h5><br><br>

                                                    <h5 class="card-title">
                                                        <input type="radio" name="answer_answer_<?php echo $count6++ ?>" value="A">
                                                            <?php if($row['question_answer_a_file'] != NULL || $row['question_answer_a_file'] != '') { ?>
                                                                <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_a_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_a']; ?><br><br>
                                                            <?php } else { ?>
                                                                &nbsp;&nbsp;<?php echo $row['question_answer_a']; ?>
                                                            <?php } ?>
                                                    </h5><br>

                                                    <h5 class="card-title">
                                                        <input type="radio" name="answer_answer_<?php echo $count7++ ?>" value="B">
                                                            <?php if($row['question_answer_b_file'] != NULL || $row['question_answer_b_file'] != '') { ?>
                                                                <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_b_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_b']; ?><br><br>
                                                            <?php } else { ?>
                                                                &nbsp;&nbsp;<?php echo $row['question_answer_b']; ?>
                                                            <?php } ?>
                                                    </h5><br>

                                                    <h5 class="card-title">
                                                        <input type="radio" name="answer_answer_<?php echo $count8++ ?>" value="C">
                                                            <?php if($row['question_answer_c_file'] != NULL || $row['question_answer_c_file'] != '') { ?>
                                                                <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_c_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_c']; ?><br><br>
                                                            <?php } else { ?>
                                                                &nbsp;&nbsp;<?php echo $row['question_answer_c']; ?>
                                                            <?php } ?>
                                                    </h5><br>

                                                    <h5 class="card-title">
                                                        <input type="radio" name="answer_answer_<?php echo $count9++ ?>" value="D">
                                                            <?php if($row['question_answer_d_file'] != NULL || $row['question_answer_d_file'] != '') { ?>
                                                                <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_d_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_d']; ?><br><br>
                                                            <?php } else { ?>
                                                                &nbsp;&nbsp;<?php echo $row['question_answer_d']; ?>
                                                            <?php } ?>
                                                    </h5><br>

                                                    <h5 class="card-title">
                                                        <input type="radio" name="answer_answer_<?php echo $count10++ ?>" value="E">
                                                            <?php if($row['question_answer_e_file'] != NULL || $row['question_answer_e_file'] != '') { ?>
                                                                <img src="<?php echo $this->get_model->get_image_question_url($row['question_answer_e_file']); ?>" width="30%"/>&nbsp;&nbsp;<?php echo $row['question_answer_e']; ?><br><br>
                                                            <?php } else { ?>
                                                                &nbsp;&nbsp;<?php echo $row['question_answer_e']; ?>
                                                            <?php } ?>
                                                    </h5><br>

                                                    <input type="hidden" name="question_answer_key_<?php echo $count11++ ?>" value="<?php echo $row['question_answer_key']; ?>">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <?php 
                                                            $now = $count12++;
                                                            $next = $now + 1; 
                                                            $prev = $now - 1; 
                                                        ?>
                                                        <div class="col-lg-2 col-4 border border-primary rounded text-center"><a href="<?php echo '#question'.$prev; ?>" data-toggle="tab"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Previous</a></div>
                                                        <div class="col-lg-8 col-4"></div>
                                                        <div class="col-lg-2 col-4 border border-primary rounded text-center"><a href="<?php echo '#question'.$next; ?>" data-toggle="tab">Next&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i></a></div>
                                                    </div>
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
            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>&copy;</b> 2020 All rights reserved.
                </div>
                Made with <span style="color: #e25555;">&hearts;</span> by <strong>JNE IT Dev BDO</strong> 
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <script>
            CountDownTimer("<?php echo $question->row()->exam_end_date . ' ' . $question->row()->exam_end_time;?>", 'hari', 'jam', 'menit', 'detik');
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
