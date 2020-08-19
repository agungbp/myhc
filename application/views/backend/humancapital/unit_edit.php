<?php 
    $unit = $this->db->get_where('unit', array('unit_code'=>$param2))->result_array();
    foreach ($unit as $row):
        echo form_open(site_url('humancapital/unit/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Department Name</label>
                    <select class="form-control selectpicker" name="section_code" data-live-search="true" required>
                        <?php $section = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                            foreach ($section as $row1): ?>
                                <option value="<?php echo $row1['section_code']; ?>" <?php if($row['section_code'] == $row1['section_code']) echo 'selected'; ?>>
                                    <?php echo $row1['section_name']; ?>
                                </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Unit Code</label>
                    <input type="text" class="form-control" name="unit_code" value="<?php echo $row['unit_code']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Unit Name</label>
                    <input type="text" class="form-control" name="unit_name" value="<?php echo $row['unit_name']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Head</label>
                    <select class="form-control selectpicker" name="unit_head" data-live-search="true" required>
                        <option value="">-- Choose Head --</option>
                        <?php 
                            $this->db->from('employee');
                            $this->db->join('section', 'employee.section_code = section.section_code');
                            $this->db->where('employee_status !=', 'Resign');
                            $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                            $unit_head = $this->db->get();

                            foreach ($unit_head->result_array() as $row1): ?>
                                <option value="<?php echo $row1['nik']; ?>" data-subtext="<?php echo $row1['section_name']; ?>" <?php if($row['unit_head'] == $row1['nik']) echo 'selected'; ?>><?php echo $row1['employee_name']; ?></option>
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