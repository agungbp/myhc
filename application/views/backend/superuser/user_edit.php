<?php 
    $user = $this->db->get_where('user', array('user_id' => $param2))->result_array();
    foreach ($user as $row):
        echo form_open(site_url('superuser/user/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <?php if ($row['user_type'] != 'EMPLOYEE') { ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="required">Employee</label>
                        <select class="form-control selectpicker" name="nik" id="nik" data-live-search="true" required>
                            <?php 
                                $this->db->from('employee');
                                $this->db->join('section', 'employee.section_code = section.section_code');
                                $this->db->where('employee_status !=', 'Resign');
                                $nik = $this->db->get();

                                foreach ($nik->result_array() as $row1): ?>
                                    <option value="<?php echo $row1['nik']; ?>" <?php if($row['nik'] == $row1['nik']) echo 'selected'; ?> data-subtext="<?php echo $row1['section_name']; ?>"><?php echo $row1['employee_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="required">Type</label>
                        <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                            <option value="ADMIN" <?php if ($row['user_type'] == 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                            <option value="HEAD" <?php if ($row['user_type'] == 'HEAD') echo 'selected'; ?>>BRANCH HEAD</option>
                            <option value="HUMANCAPITAL" <?php if ($row['user_type'] == 'HUMANCAPITAL') echo 'selected'; ?>>HUMAN CAPITAL</option>
                            <option value="SPV" <?php if ($row['user_type'] == 'SPV') echo 'selected'; ?>>SUPERVISOR</option>
                            <option value="SUPERUSER" <?php if ($row['user_type'] == 'SUPERUSER') echo 'selected'; ?>>SUPER USER</option>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="user_status" data-live-search="true" required>
                        <option value="Y" <?php if ($row['user_status'] == 'Y') echo 'selected'; ?>>Active</option>
                        <option value="N" <?php if ($row['user_status'] == 'N') echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Password</label>
                    <a href="<?php echo site_url('superuser/user/reset_password/'. $row['nik']); ?>" class="btn btn-danger btn-block"><i class="fas fa-key"></i>&nbsp;&nbsp;Reset Password</a>
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