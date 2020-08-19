<?php echo form_open(site_url('employee/egdattendance/attendmanual'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Event</label>
            <select class="form-control selectpicker" name="egdattendance_id" data-live-search="true" required>
                <option value="" selected>-- Choose Event --</option>
                <?php $egdattendance_id = $this->db->get_where('egd_attendance', array('egdattendance_date >=' => date('Y-m-d'), 'branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($egdattendance_id as $row1): ?>
                        <option value="<?php echo $row1['egdattendance_id']; ?>"><?php echo $row1['egdattendance_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Token</label>
            <input type="text" class="form-control" name="egdattendance_token" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Clock In</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>