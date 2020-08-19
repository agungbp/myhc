<?php 
    $asset = $this->db->get_where('asset', array('asset_id'=>$param2))->result_array();
    foreach ($asset as $row):
        echo form_open(site_url('humancapital/asset/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Asset Number</label>
                    <input type="text" class="form-control" name="asset_number" value="<?php echo $row['asset_number']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Serial Number</label>
                    <input type="text" class="form-control" name="asset_serialnumber" value="<?php echo $row['asset_serialnumber']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Type</label>
                    <input type="text" class="form-control" name="asset_name" value="<?php echo $row['asset_name']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Brand</label>
                    <input type="text" class="form-control" name="asset_merk" value="<?php echo $row['asset_merk']; ?>">
                </div>
            </div>
            <div class="form-row">  
                <div class="form-group col-md-6">
                    <label>Model</label>
                    <input type="text" class="form-control" name="asset_model" value="<?php echo $row['asset_model']; ?>">
                </div> 
                <div class="form-group col-md-6">
                    <label>Date</label>
                    <input type="date" class="form-control" name="asset_date" value="<?php echo $row['asset_date']; ?>">
                </div>  
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Spesification</label>
                    <textarea class="form-control" name="asset_spesification" rows="4"><?php echo $row['asset_spesification']; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <br><button type="submit" class="btn btn-info">Save</button>
                    </div>
                </div>
            </div>
<?php 
        echo form_close(); 
    endforeach;
?>