<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $page_title;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $page_title;?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
            $this->db->from('cbt_exam');
            $this->db->where('user_type', 'EMPLOYEE');
            $this->db->where('branch_code', $this->session->userdata('login_branch'));
            $this->db->order_by('exam_start_date', 'desc');
            $exam = $this->db->get();

            if($exam->num_rows() > 0){
                foreach ($exam->result_array() as $row): ?>
                    <div class="card text-bold">
                        <div class="card-header">
                            <?php echo $row['exam_name']; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Time Start</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo date_format(date_create($row['exam_start_date']),"d F Y") . '   ' . date_format(date_create($row['exam_start_time']),"H:i"); ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Time End</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo date_format(date_create($row['exam_end_date']),"d F Y") . ' ' . date_format(date_create($row['exam_end_time']),"H:i"); ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Duration</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b>
                                        <?php 
                                            $datetime1 = strtotime($row['exam_start_date'] . ' ' . $row['exam_start_time']);
                                            $datetime2 = strtotime($row['exam_end_date'] . ' ' . $row['exam_end_time']); 
                                            $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                                            $min = $secs / 60;
                                            echo $min . ' Minutes';
                                        ?>
                                </b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Total Question</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id']))->num_rows(); ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php
                                $this->db->from('cbt_answer');
                                $this->db->join('cbt_participants', 'cbt_answer.participants_id = cbt_participants.participants_id');
                                $this->db->where('cbt_participants.exam_id', $row['exam_id']);
                                $this->db->where('nik', $this->session->userdata('login_nik'));
                                $cek = $this->db->get();

                                $end = $row['exam_end_date'] . ' ' . $row['exam_end_time'];

                                if($cek->num_rows() == 0){
                                    if(date('Y-m-d H:i:s') <= $end){ 
                            ?>
                                        <a href="<?php echo site_url('employee/exam/take/'.$row['exam_id']); ?>" class="btn btn-dark">
                                            <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Take this test
                                        </a>
                            <?php   } else if(date('Y-m-d H:i:s') >= $end){ ?>

                                            <a href="#" class="btn btn-danger">Exam time has ended</a> 
                            <?php   
                                    } 
                                } else if($cek->num_rows() > 0) {
                            ?>
                                    <a href="#" class="btn btn-info" onclick="FormModal('<?php echo site_url('modal/popup/cbt_result/'.$row['exam_id'] ); ?>');"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;See Result</a> 
                            <?php } ?>
                        </div>
                    </div>    
        <?php   endforeach;
            } else { 
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Tidak ada test online tersedia.
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>  
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->