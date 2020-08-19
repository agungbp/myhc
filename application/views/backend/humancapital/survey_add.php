<?php echo form_open(site_url('humancapital/survey/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Title</label>
            <input type="text" class="form-control" name="survey_name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea class="form-control" name="survey_description"></textarea>
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