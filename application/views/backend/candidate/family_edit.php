<?php 
    $family = $this->db->get_where('family', array('family_id'=>$param2))->result_array();
    foreach ($family as $row):
        echo form_open(site_url('candidate/family/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">KTP</label>
                    <input type="text" class="form-control" name="family_ktp" value="<?php echo $row['family_ktp']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="family_status" data-live-search="true" required>
                        <option value="ISTRI" <?php if ($row['family_status'] == 'ISTRI') echo 'selected'; ?>>ISTRI</option>
                        <option value="SUAMI" <?php if ($row['family_status'] == 'SUAMI') echo 'selected'; ?>>SUAMI</option>
                        <option value="ANAK KE-1" <?php if ($row['family_status'] == 'ANAK KE-1') echo 'selected'; ?>>ANAK KE-1</option>
                        <option value="ANAK KE-2" <?php if ($row['family_status'] == 'ANAK KE-2') echo 'selected'; ?>>ANAK KE-2</option>
                        <option value="ANAK KE-3" <?php if ($row['family_status'] == 'ANAK KE-3') echo 'selected'; ?>>ANAK KE-3</option>
                    </select>
                </div> 
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">nama</label>
                    <input type="text" class="form-control" name="family_name" value="<?php echo $row['family_name']; ?>" required>
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