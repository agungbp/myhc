<?php 
    $marquee = $this->db->get_where('marquee', array('marquee_id'=>$param2))->result_array();
    foreach ($marquee as $row):
    echo form_open(site_url('humancapital/marquee/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">For</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="ALL" <?php if ($row['user_type'] == 'ALL') echo 'selected'; ?>>ALL</option>
                <option value="ADMIN" <?php if ($row['user_type'] == 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                <option value="HEAD" <?php if ($row['user_type'] == 'HEAD') echo 'selected'; ?>>BRANCH HEAD</option>
                <option value="EMPLOYEE" <?php if ($row['user_type'] == 'EMPLOYEE') echo 'selected'; ?>>EMPLOYEE</option>
                <option value="SUPERUSER" <?php if ($row['user_type'] == 'SUPERUSER') echo 'selected'; ?>>SUPERUSER</option>
                <option value="HUMANCAPITAL" <?php if ($row['user_type'] == 'HUMANCAPITAL') echo 'selected'; ?>>HUMAN CAPITAL</option>
            </select>
        </div>
    <div class="form-row">
    </div>
        <div class="form-group col-md-12">
            <label class="required">Announcement</label>
            <textarea class="form-control" name="marquee_announcement" rows="4" required><?php echo $row['marquee_announcement']; ?></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Status</label>
            <select class="form-control selectpicker" name="marquee_status" data-live-search="true" required>
                <option value="Active" <?php if ($row['marquee_status'] == 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if ($row['marquee_status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
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
<?php echo form_close();
endforeach; ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>