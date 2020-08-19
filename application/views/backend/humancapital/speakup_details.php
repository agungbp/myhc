<?php 
    $speakup = $this->db->get_where('speakup', array('speakup_id'=>$param2))->result_array();
    foreach ($speakup as $row):
?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <input type="text" class="form-control" name="speakup_subject" value="<?php echo $row['speakup_subject'] ?>" readonly>     
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <textarea class="form-control" name="speakup_description" rows="20" placeholder="Kritik, saran, info, aduan, dll." readonly><?php echo $row['speakup_description'] ?></textarea>   
        </div>
    </div>              
<?php endforeach; ?>