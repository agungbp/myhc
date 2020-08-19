<?php echo form_open(site_url('humancapital/question/create/'.$questionpack_id), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Question</label>
            <input type="hidden" class="form-control" name="question_type" value="Essay" required>
            <textarea class="form-control" name="question_question" rows="4"></textarea>
            <input type="file" id="uploadfile" class="form-control-file" name="question_question_file" style="margin-top: 3px;"> (Max: 500 Kb)
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Bobot</label>
            <input type="number" class="form-control" name="question_bobot" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>

<script type="text/javascript">
        var uploadField = document.getElementById("uploadfile");

        uploadField.onchange = function() {
            if(this.files[0].size > 500000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>