<?php echo form_open(site_url('humancapital/exam/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Title</label>
            <input type="text" class="form-control" name="exam_name" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Question Package</label>
            <select class="form-control selectpicker" name="questionpack_id" data-live-search="true" required>
                <option value="" selected>-- Choose Question --</option>
                <?php $questionpack = $this->db->get_where('cbt_questionpack', array('questionpack_status' => 'Approved', 'branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($questionpack as $row1): ?>
                        <option value="<?php echo $row1['questionpack_id']; ?>"><?php echo $row1['questionpack_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Start</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_start_date" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_start_time" required>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">End</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_end_date" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_end_time" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">For</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="" selected>-- Choose --</option>
                <option value="EMPLOYEE">EMPLOYEE</option>
                <option value="CANDIDATE">CANDIDATE</option>
            </select>
        </div>
        <!-- <div class="form-group col-md-6">
            <label class="required">Randomize Question</label>
            <select class="form-control selectpicker" name="exam_random" data-live-search="true" required>
                <option value="" selected>-- Choose --</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
            </select>
        </div> -->
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>