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
            $this->db->where('survey.survey_id', $survey_id);
            $survey = $this->db->get();

            foreach ($survey->result_array() as $row):
                echo form_open(site_url('employee/survey/submit/'.$survey_id), array('enctype' => 'multipart/form-data'));
        ?> 
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h1><?php echo strtoupper($row['survey_name']); ?></h1>
                            <hr>
                            <p><?php echo nl2br($row['survey_description']); ?></p>
                            <br>
                            <?php
                                $count = 1;
                                $count1 = 1;
                                $count2 = 1;
                                $this->db->from('survey_question');
                                $this->db->where('survey_id', $survey_id);
                                $this->db->order_by('surveyquestion_time');
                                $question = $this->db->get();

                                foreach ($question->result_array() as $row):
                            ?>
                                    <p style="margin-bottom: 3px;"><?php echo $count2++ . '. ' . $row['surveyquestion_question']; ?></p>
                                    <input type="hidden" name="surveyquestion_id_<?php echo $count++ ?>" value="<?php echo $row['surveyquestion_id']; ?>">
                                    
                            <?php   if ($row['surveyquestion_type'] == 'Short Text'){ ?>
                                        <input type="text" class="form-control" name="responds_answer_<?php echo $count1++ ?>">
                            <?php   } else if ($row['surveyquestion_type'] == 'Long Text') { ?>
                                        <textarea class="form-control" name="responds_answer_<?php echo $count1++ ?>" rows="3"></textarea>
                            <?php   } else if ($row['surveyquestion_type'] == 'Date') { ?>
                                        <input type="date" class="form-control" name="responds_answer_<?php echo $count1++ ?>">
                            <?php   } else if ($row['surveyquestion_type'] == 'Radio') { 
                                        $no = $count1++;
                                        $option = $this->db->get_where('survey_question_option', array('surveyquestion_id' => $row['surveyquestion_id']))->result_array();

                                        foreach($option as $row2): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="responds_answer_<?php echo $no; ?>" value="<?php echo $row2['surveyquestionoption_option'] ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row2['surveyquestionoption_option'] ?>
                                                </label>
                                            </div>
                            <?php       endforeach;
                                    } else if ($row['surveyquestion_type'] == 'Checkbox') { 
                                        $no2 = $count1++;
                                        $option2 = $this->db->get_where('survey_question_option', array('surveyquestion_id' => $row['surveyquestion_id']))->result_array();

                                        foreach($option2 as $row2): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="responds_answer_<?php echo $no2; ?>" value="<?php echo $row2['surveyquestionoption_option'] ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row2['surveyquestionoption_option'] ?>
                                                </label>
                                            </div>
                            <?php       endforeach;
                                    } ?>
                                    <br>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <!-- /.card -->
                    </div>
                    </div>
        <?php 
                echo form_close();
            endforeach; 
        ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->