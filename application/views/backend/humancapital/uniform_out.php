<?php echo form_open(site_url('humancapital/uniform/out'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Uniform</label>
            <select class="form-control selectpicker" name="uniformstock_code" data-live-search="true" required>
                <option value="" selected>-- Choose Uniform --</option>
                <?php $type = $this->db->get_where('uniform_stock', array('uniformstock_stock >' => 0, 'branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($type as $row): ?>
                        <option value="<?php echo $row['uniformstock_code']; ?>"><?php echo $row['uniformstock_type'] . ' - ' . $row['uniformstock_gender'] . ' - ' . $row['uniformstock_size']; ?></option>
                <?php endforeach; ?>
            </select>       
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Qty</label>
            <input type="number" class="form-control" name="uniform_qty" min="1"  value="1" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Employee</label>
            <select class="form-control selectpicker" name="nik" id="nik" data-live-search="true" required>
                <option value="" selected>-- Choose Employee --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                    $nik = $this->db->get();

                    foreach ($nik->result_array() as $row1): ?>
                        <option value="<?php echo $row1['nik']; ?>" data-subtext="<?php echo $row1['section_name']; ?>"><?php echo $row1['employee_name']; ?></option>
                <?php endforeach; ?>
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