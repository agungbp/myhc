<?php echo form_open(site_url('humancapital/asset/create/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Asset Number</label>
            <input type="text" class="form-control" name="asset_number">
        </div>
        <div class="form-group col-md-6">
            <label>Serial Number</label>
            <input type="text" class="form-control" name="asset_serialnumber">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Type</label>
            <input type="text" class="form-control" name="asset_name">
        </div>
        <div class="form-group col-md-6">
            <label>Brand</label>
            <input type="text" class="form-control" name="asset_merk">
        </div>
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-6">
            <label>Model</label>
            <input type="text" class="form-control" name="asset_model">
        </div>   
        <div class="form-group col-md-6">
            <label>Date</label>
            <input type="date" class="form-control" name="asset_date">
        </div>   
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-12">
            <label>Spesification</label>
            <textarea class="form-control" name="asset_spesification" rows="4"></textarea>
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