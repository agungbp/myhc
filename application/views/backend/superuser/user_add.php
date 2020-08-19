<?php echo form_open(site_url('superuser/user/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Employee</label>
            <select class="form-control selectpicker" name="nik" id="nik" data-live-search="true" required>
                <option value="" selected>-- Choose Employee --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $nik = $this->db->get();
                    
                    foreach ($nik->result_array() as $row1): ?>
                        <option value="<?php echo $row1['nik']; ?>" data-subtext="<?php echo $row1['section_name']; ?>"><?php echo $row1['employee_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Type</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="" selected>-- Choose Type --</option>
                <option value="ADMIN">ADMIN</option>
                <!-- <option value="EMPLOYEE">EMPLOYEE</option> -->
                <option value="HEAD">BRANCH HEAD</option>
                <option value="HUMANCAPITAL">HUMAN CAPITAL</option>
                <option value="SPV">SUPERVISOR</option>
                <option value="SUPERUSER">SUPER USER</option>
            </select>
        </div>
    </div>
    <!-- <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Password</label>
            <input type="password" class="form-control" name="user_password" required>
        </div>
    </div> -->
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>