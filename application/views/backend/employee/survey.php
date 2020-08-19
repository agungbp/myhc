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
            $this->db->from('survey');
            $this->db->where('survey_status', 'Publish');
            $this->db->where('branch_code', $this->session->userdata('login_branch'));
            $this->db->order_by('survey_id', 'desc');
            $survey = $this->db->get();

            if($survey->num_rows() > 0){
                foreach ($survey->result_array() as $row): ?>
                    <div class="card text-bold">
                        <div class="card-header">
                            <?php echo $row['survey_name']; ?>
                        </div>
                        <div class="card-body">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-lg-12 col-12">
                                <p class="card-title"><?php echo nl2br($row['survey_description']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">End of Survey</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo date_format(date_create($row['survey_end_date']),"d F Y") . '   ' . date_format(date_create($row['survey_end_time']),"H:i"); ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <p class="card-title">Total Question</p>
                                </div>
                                <div class="col-lg-10 col-8">
                                    <p class="card-title"><b><?php echo $this->db->get_where('survey_question', array('survey_id' => $row['survey_id']))->num_rows(); ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php
                                $this->db->from('survey_responden');
                                $this->db->join('employee', 'survey_responden.nik = employee.nik');
                                $this->db->where('survey_id', $row['survey_id']);
                                $this->db->where('survey_responden.nik', $this->session->userdata('login_nik'));
                                $cek = $this->db->get();

                                $end = $row['survey_end_date'] . ' ' . $row['survey_end_time'];

                                if($cek->num_rows() == 0){
                                    if(date('Y-m-d H:i:s') <= $end){ 
                            ?>
                                        <a href="<?php echo site_url('employee/survey/take/'.$row['survey_id']); ?>" class="btn btn-dark">
                                            <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Take this survey
                                        </a>
                            <?php   } 
                                    if(date('Y-m-d H:i:s') >= $end){ 
                            ?>
                                        <a href="#" class="btn btn-danger">Survey time has ended</a> 
                            <?php   
                                    } 
                                } else {
                            ?>
                                    <a href="#" class="btn btn-success">You have responded to this survey</a>  
                            <?php } ?>
                            
                        </div>
                    </div>    
                <?php endforeach;
            } else { 
        ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                E-survey tidak tersedia.
                            </div>
                        </div>
                    </div>
                </div>
       <?php } ?>  
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'elearning_class_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->