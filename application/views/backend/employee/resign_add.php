<?php echo form_open(site_url('employee/resign/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Reason</label>
            <textarea class="form-control" name="resign_reason" rows="4" required></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Resign Letter (Max: 1 Mb)</label>
            <input type="file" id="uploadfile" class="form-control-file" name="resign_file" accept=".pdf, .docx, .doc, .pptx, .ppt, .rar, .zip" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Apply</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>

<script type="text/javascript">
        var uploadField = document.getElementById("uploadfile");

        uploadField.onchange = function() {
            if(this.files[0].size > 1000000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>