<?php echo form_open(site_url('humancapital/participants/create/' . $exam_id), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Employee</label>
            <select class="form-control selectpicker" name="nik" data-live-search="true" required>
                <option value="" selected>-- Choose Employee --</option>
                <?php 
                    $user_type = $this->db->get_where('cbt_exam', array('exam_id' => $exam_id));

                    if($user_type->row()->user_type == 'DEPARTMENT'){
                        $this->db->from('employee');
                        $this->db->join('section', 'employee.section_code = section.section_code');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('employee.section_code', $user_type->row()->exam_section);
                        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                        $nik = $this->db->get();
                    } else {
                        $this->db->from('employee');
                        $this->db->join('section', 'employee.section_code = section.section_code');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                        $nik = $this->db->get();
                    }

                    foreach ($nik->result_array() as $row): ?>
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