<?php echo form_open(site_url('humancapital/uniform/in'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Uniform</label>
            <select class="form-control selectpicker" name="uniformstock_code" data-live-search="true" required>
                <option value="" selected>-- Choose Uniform --</option>
                <?php $type = $this->db->get_where('uniform_stock', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($type as $row): ?>
                        <option value="<?php echo $row['uniformstock_code']; ?>"><?php echo $row['uniformstock_type'] . ' - ' . $row['uniformstock_gender'] . ' - ' . $row['uniformstock_size']; ?></option>
                <?php endforeach; ?>
            </select>        
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label  class="required">Qty</label>
            <input type="number" class="form-control" name="uniform_qty" min="1" required>
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