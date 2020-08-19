<?php 
$question = $this->db->get_where('cbt_question', array('question_id'=>$param2))->result_array();
foreach ($question as $row):
 echo form_open(site_url('humancapital/question/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Question</label>
            <input type="hidden" class="form-control" name="question_type" value="PG" required>
            <textarea class="form-control" name="question_question" rows="4"><?php echo $row['question_question']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_question_file" style="margin-top: 3px;" accept="image/*">
            (Max: 500 Kb) <?php echo $row['question_question_file']; ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Answer A</label>
            <textarea class="form-control" name="question_answer_a" rows="3"><?php echo $row['question_answer_a']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_answer_a_file" style="margin-top: 3px;" accept="image/*">
            (Max: 500 Kb) <?php echo $row['question_answer_a_file']; ?>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Answer B</label>
            <textarea class="form-control" name="question_answer_b" rows="3"><?php echo $row['question_answer_b']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_answer_b_file" style="margin-top: 3px;" accept="image/*">
            (Max: 500 Kb) <?php echo $row['question_answer_b_file']; ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Answer C</label>
            <textarea class="form-control" name="question_answer_c" rows="3"><?php echo $row['question_answer_c']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_answer_c_file" style="margin-top: 3px;" accept="image/*">
            (Max: 500 Kb) <?php echo $row['question_answer_c_file']; ?>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Answer D</label>
            <textarea class="form-control" name="question_answer_d" rows="3"><?php echo $row['question_answer_d']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_answer_d_file" style="margin-top: 3px;" accept="image/*">
            (Max: 500 Kb) <?php echo $row['question_answer_d_file']; ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Answer E</label>
            <textarea class="form-control" name="question_answer_e" rows="3"><?php echo $row['question_answer_e']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_answer_e_file" style="margin-top: 3px;" accept="image/*">
            (Max: 500 Kb) <?php echo $row['question_answer_e_file']; ?>
        </div>
    </div>
    <div class="form-row" style="margin-top: 50px;">
        <div class="form-group col-md-6">
            <label class="required">Answer Key</label>
            <select class="form-control selectpicker" name="question_answer_key" data-live-search="true" required>
                <option value="A" <?php if ($row['question_answer_key'] == 'A') echo 'selected'; ?>>A</option>
                <option value="B" <?php if ($row['question_answer_key'] == 'B') echo 'selected'; ?>>B</option>
                <option value="C" <?php if ($row['question_answer_key'] == 'C') echo 'selected'; ?>>C</option>
                <option value="D" <?php if ($row['question_answer_key'] == 'D') echo 'selected'; ?>>D</option>
                <option value="E" <?php if ($row['question_answer_key'] == 'E') echo 'selected'; ?>>E</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Bobot</label>
            <input type="number" class="form-control" name="question_bobot" value="<?php echo $row['question_bobot']; ?>" required>
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

<script type="text/javascript">
        var uploadField = document.getElementById("uploadfile");

        uploadField.onchange = function() {
            if(this.files[0].size > 500000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>