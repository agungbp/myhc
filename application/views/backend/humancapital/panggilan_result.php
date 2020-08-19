<?php 
    $panggilan = $this->db->get_where('panggilan', array('panggilan_id' => $param2))->result_array();
    foreach ($panggilan as $row):
        echo form_open(site_url('humancapital/panggilan/result/'.$param2), array('enctype' => 'multipart/form-data')); 
?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Result</label>
                    <textarea class="form-control" name="panggilan_result" rows="4"><?php echo $row['panggilan_result']; ?></textarea>
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