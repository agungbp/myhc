<?php
    $panggilan = $this->db->get_where('panggilan', array('panggilan_id' => $param2))->result_array();
    foreach ($panggilan as $row):
    echo form_open(site_url('humancapital/panggilan/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Number</label>
            <input type="text" class="form-control" name="panggilan_number" value="<?php echo $row['panggilan_number']; ?>" required>
        </div>
        <div class="form-group col-md-6">
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
        <div class="form-group col-md-6">
            <label class="required">Place</label>
            <input type="text" class="form-control" name="panggilan_place" value="<?php echo $row['panggilan_place']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Date</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="panggilan_date" value="<?php echo $row['panggilan_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="panggilan_time" value="<?php echo $row['panggilan_time']; ?>" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Meet With</label>
            <input type="text" class="form-control" name="panggilan_meet" value="<?php echo $row['panggilan_meet']; ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Subject</label>
            <textarea class="form-control" name="panggilan_description" rows="5" required><?php echo $row['panggilan_description']; ?></textarea>
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
endforeach; ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>