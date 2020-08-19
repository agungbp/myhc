<?php echo form_open(site_url('humancapital/section/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Code</label>
            <input type="text" class="form-control" name="section_code" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Department Name</label>
            <input type="text" class="form-control" name="section_name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Head</label>
            <select class="form-control selectpicker" name="section_head" data-live-search="true" required>
                <option value="" selected>-- Choose Head --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                    $section_head = $this->db->get();

                    foreach ($section_head->result_array() as $row): ?>
                        <option value="<?php echo $row['nik']; ?>" data-subtext="<?php echo $row['section_name']; ?>"><?php echo $row['employee_name']; ?></option>
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