<?php 
    $teguran = $this->db->get_where('teguran', array('teguran_id'=>$param2))->result_array();
    foreach ($teguran as $row):
    echo form_open(site_url('humancapital/teguran/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Number</label>
            <input type="text" class="form-control" name="teguran_number" value="<?php echo $row['teguran_number']; ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Employee</label>
            <select class="form-control selectpicker" name="nik" data-live-search="true" required>
                <option value="">-- Choose Employee --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                    $nik = $this->db->get();

                    foreach ($nik->result_array() as $row1): ?>
                        <option value="<?php echo $row1['nik']; ?>" data-subtext="<?php echo $row1['section_name']; ?>" <?php if($row['nik'] == $row1['nik']) echo 'selected'; ?>><?php echo $row1['employee_name']; ?></option>
                <?php endforeach; ?>  
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea class="form-control" name="teguran_description" rows="5"><?php echo $row['teguran_description']; ?></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); 
endforeach;
?>

<script>
    $('.selectpicker').selectpicker('render')
</script>