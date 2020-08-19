<?php echo form_open(site_url('humancapital/teguran/create/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Number</label>
            <input type="text" class="form-control" name="teguran_number" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Employee</label>
            <select class="form-control selectpicker" name="nik" data-live-search="true" required>
                <option value="" selected>-- Choose Employee --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                    $nik = $this->db->get();

                    foreach ($nik->result_array() as $row): ?>
                        <option value="<?php echo $row['nik']; ?>" data-subtext="<?php echo $row['section_name']; ?>"><?php echo $row['employee_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea class="form-control" name="teguran_description" rows="5" required></textarea>
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
