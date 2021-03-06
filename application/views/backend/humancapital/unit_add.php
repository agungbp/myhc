<?php echo form_open(site_url('humancapital/unit/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Department Name</label>
            <select class="form-control selectpicker" name="section_code" data-live-search="true" required>
                <option value="" selected>-- Choose Department --</option>
                <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($section_code as $row): ?>
                        <option value="<?php echo $row['section_code']; ?>"><?php echo $row['section_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label class="required">Unit Code</label>
            <input type="text" class="form-control" name="unit_code" required>
        </div>
        <div class="form-group col-md-12">
            <label class="required">Unit Name</label>
            <input type="text" class="form-control" name="unit_name" required>
        </div>
        <div class="form-group col-md-12">
            <label class="required">Head</label>
            <select class="form-control selectpicker" name="unit_head" data-live-search="true" required>
                <option value="" selected>-- Choose Head --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                    $unit_head = $this->db->get();

                    foreach ($unit_head->result_array() as $row): ?>
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

<script>
    $('.selectpicker').selectpicker('render')
</script>