<?php 
$exam = $this->db->get_where('cbt_exam', array('exam_id'=>$param2))->result_array();
foreach ($exam as $row):
echo form_open(site_url('humancapital/exam/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Title</label>
            <input type="text" class="form-control" name="exam_name" value="<?php echo $row['exam_name']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Question Package</label>
            <select class="form-control selectpicker" name="questionpack_id" data-live-search="true" required>
                <?php $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_status' => 'Approved'))->result_array();
                    foreach ($questionpack_id as $row1): ?>
                        <option value="<?php echo $row1['questionpack_id']; ?>" <?php if($row['questionpack_id'] == $row1['questionpack_id']) echo 'selected'; ?>><?php echo $row1['questionpack_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Start</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_start_date" value="<?php echo $row['exam_start_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_start_time" value="<?php echo $row['exam_start_time']; ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">End</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_end_date" value="<?php echo $row['exam_end_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_end_time" value="<?php echo $row['exam_end_time']; ?>" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">For</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="EMPLOYEE" <?php if ($row['user_type'] == 'EMPLOYEE') echo 'selected'; ?>>EMPLOYEE</option>
                <option value="CANDIDATE" <?php if ($row['user_type'] == 'CANDIDATE') echo 'selected'; ?>>CANDIDATE</option>
            </select>
        </div>
        <!-- <div class="form-group col-md-6">
            <label class="required">Randomize Question</label>
            <select class="form-control selectpicker" name="exam_random" data-live-search="true" required>
                <option value="Y" <?php if ($row['exam_random'] == 'Y') echo 'selected'; ?>>YES</option>
                <option value="N" <?php if ($row['exam_random'] == 'N') echo 'selected'; ?>>NO</option>
            </select>
        </div>
    </div>
    <div class="form-row"> -->
        <div class="form-group col-md-6">
            <label>Token</label>
            <a href="<?php echo site_url('humancapital/exam/reset_token/'.$param2); ?>" class="btn btn-danger btn-block"><i class="fas fa-key"></i>&nbsp;&nbsp;Reset Token</a>
        </div>
    </div>
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