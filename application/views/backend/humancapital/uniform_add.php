<?php echo form_open(site_url('humancapital/uniform/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Type</label>
            <input type="text" class="form-control" name="uniformstock_type" required>     
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Gender</label>
            <select class="form-control selectpicker" name="uniformstock_gender" data-live-search="true" required>
                <option value="" selected>-- Choose Gender --</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
                <option value="AS">All Size</option>
            </select> 
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Size</label>
            <select class="form-control selectpicker" name="uniformstock_size" data-live-search="true" required>
                <option value="" selected>-- Choose Size --</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="AS">All Size</option>
            </select> 
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