<?php 
$questionessay = $this->db->get_where('cbt_question', array('question_id'=>$param2))->result_array();
foreach ($questionessay as $row):
 echo form_open(site_url('humancapital/question/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Question</label>
            <input type="hidden" class="form-control" name="question_type" value="Essay" required>
            <textarea class="form-control" name="question_question" rows="4"><?php echo $row['question_question']; ?></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_question_file" style="margin-top: 3px;">
            (Max: 500 Kb) <?php echo $row['question_question_file']; ?>
        </div>
    </div>
    <div class="form-row" style="margin-top: 50px;">
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