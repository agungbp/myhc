<?php 
    $education = $this->db->get_where('education', array('education_id'=>$param2))->result_array();
    foreach ($education as $row):
        echo form_open(site_url('candidate/education/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Pendidikan</label>
                    <select class="form-control selectpicker" name="education_level" data-live-search="true" required>
                        <option value="SLTP SEDERAJAT" <?php if ($row['education_level'] == 'SLTP SEDERAJAT') echo 'selected'; ?>>SLTP SEDERAJAT</option>
                        <option value="SMU SEDERAJAT" <?php if ($row['education_level'] == 'SMU SEDERAJAT') echo 'selected'; ?>>SMU SEDERAJAT</option>
                        <option value="D1" <?php if ($row['education_level'] == 'D1') echo 'selected'; ?>>D1</option>
                        <option value="D2" <?php if ($row['education_level'] == 'D2') echo 'selected'; ?>>D2</option>
                        <option value="D3" <?php if ($row['education_level'] == 'D3') echo 'selected'; ?>>D3</option>
                        <option value="D4" <?php if ($row['education_level'] == 'D4') echo 'selected'; ?>>D4</option>
                        <option value="S1" <?php if ($row['education_level'] == 'S1') echo 'selected'; ?>>S1</option>
                        <option value="S2" <?php if ($row['education_level'] == 'S2') echo 'selected'; ?>>S2</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Sekolah/Univ</label>
                    <input type="text" class="form-control" name="education_university" value="<?php echo $row['education_university']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Jurusan</label>
                    <input type="text" class="form-control" name="education_major" value="<?php echo $row['education_major']; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>IPK/NEM</label>
                    <input type="text" class="form-control" name="education_gpa" value="<?php echo $row['education_gpa']; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>Tahun masuk</label>
                    <input type="text" class="form-control" name="education_yearstart" value="<?php echo $row['education_yearstart']; ?>" maxlength="4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Tahun lulus</label>
                    <input type="text" class="form-control" name="education_yearend" value="<?php echo $row['education_yearend']; ?>" maxlength="4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <br><button type="submit" class="btn btn-info">Simpan</button>
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