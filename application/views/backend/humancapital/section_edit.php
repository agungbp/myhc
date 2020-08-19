<?php 
    $section = $this->db->get_where('section', array('section_code'=>$param2))->result_array();
    foreach ($section as $row):
        echo form_open(site_url('humancapital/section/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Code</label>
                    <input type="text" class="form-control" name="section_code" value="<?php echo $row['section_code']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Department Name</label>
                    <input type="text" class="form-control" name="section_name" value="<?php echo $row['section_name']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Head</label>
                    <select class="form-control selectpicker" name="section_head" data-live-search="true" required>
                        <option value="">-- Choose Head --</option>
                        <?php 
                            $this->db->from('employee');
                            $this->db->join('section', 'employee.section_code = section.section_code');
                            $this->db->where('employee_status !=', 'Resign');
                            $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                            $section_head = $this->db->get();

                            foreach ($section_head->result_array() as $row1): ?>
                                <option value="<?php echo $row1['nik']; ?>" data-subtext="<?php echo $row1['section_name']; ?>" <?php if($row['section_head'] == $row1['nik']) echo 'selected'; ?>><?php echo $row1['employee_name']; ?></option>
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
<?php 
        echo form_close(); 
    endforeach;
?>

<script>
    $('.selectpicker').selectpicker('render')
</script>