<?php 
$survey = $this->db->get_where('survey', array('survey_id' => $param2))->result_array();
foreach ($survey as $row):
echo form_open(site_url('humancapital/survey/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Title</label>
            <input type="text" class="form-control" name="survey_name" value="<?php echo $row['survey_name']; ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea class="form-control" name="survey_description"><?php echo $row['survey_description']; ?></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">End</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="survey_end_date" value="<?php echo $row['survey_end_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="survey_end_time" value="<?php echo $row['survey_end_time']; ?>" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Request for Approval</label>
            <a href="<?php echo site_url('humancapital/survey/requestapproval/'. $row['survey_id']); ?>" class="btn btn-dark btn-block"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Request Approval</a>
        </div>
    </div>
    <?php if($row['survey_status'] == 'Approved'){ ?>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Status</label>
                <select class="form-control selectpicker" name="survey_status" data-live-search="true" required>
                    <option value="Publish" <?php if ($row['survey_status'] == 'Publish') echo 'selected'; ?>>Publish</option>
                    <option value="Unpublish" <?php if ($row['survey_status'] == 'Unpublish') echo 'selected'; ?>>Unpublish</option>
                </select>
            </div>
        </div>
    <?php } ?>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); 
endforeach; ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>