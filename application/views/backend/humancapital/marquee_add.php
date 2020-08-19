<?php echo form_open(site_url('humancapital/marquee/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">For</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="" selected>-- Choose Type --</option>
                <option value="ALL">ALL</option>
                <option value="ADMIN">ADMIN</option>
                <option value="EMPLOYEE">EMPLOYEE</option>
                <option value="HEAD">BRANCH HEAD</option>
                <option value="HUMANCAPITAL">HUMAN CAPITAL</option>
                <option value="SUPERUSER">SUPER USER</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label class="required">Announcement</label>
            <textarea class="form-control" name="marquee_announcement" rows="4" required></textarea>
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