<?php 
$questionpack = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param2))->result_array();
foreach ($questionpack as $row):
    echo form_open(site_url('humancapital/questionpack/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Question Package Name</label>
            <input type="text" class="form-control" name="questionpack_name" value="<?php echo $row['questionpack_name']; ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Request for SPV Approval</label>
            <a href="<?php echo site_url('humancapital/questionpack/requestapproval/'. $row['questionpack_id']); ?>" class="btn btn-dark btn-block"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Request Approval</a>
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