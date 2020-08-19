<?php echo form_open(site_url('employee/asset/create/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Asset Number</label>
            <input type="text" class="form-control" name="asset_number" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Serial Number</label>
            <input type="text" class="form-control" name="asset_serialnumber" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Type</label>
            <input type="text" class="form-control" name="asset_name" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Brand</label>
            <input type="text" class="form-control" name="asset_merk" required>
        </div>
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-6">
            <label class="required">Model</label>
            <input type="text" class="form-control" name="asset_model" required>
        </div>   
        <div class="form-group col-md-6">
            <label class="required">Date</label>
            <input type="date" class="form-control" name="asset_date" required>
        </div>   
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-12">
            <label class="required">Spesification</label>
            <textarea class="form-control" name="asset_spesification" rows="4" required></textarea>
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