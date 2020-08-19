<?php echo form_open(site_url('humancapital/egdattendance/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Event Name</label>
            <input type="text" class="form-control" name="egdattendance_name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Place</label>
            <input type="text" class="form-control" name="egdattendance_place" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Date</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="egdattendance_date" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="egdattendance_time" required>
                </div>
            </div>
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