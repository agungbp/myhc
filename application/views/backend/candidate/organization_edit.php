<?php 
    $organization = $this->db->get_where('organization', array('organization_id'=>$param2))->result_array();
    foreach ($organization as $row):
        echo form_open(site_url('candidate/organization/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="required">Jenis</label>
                    <select class="form-control selectpicker" name="organization_type" data-live-search="true" required>
                        <option value="KEAGAMAAN" <?php if ($row['organization_type'] == 'KEAGAMAAN') echo 'selected'; ?>>KEAGAMAAN</option>
                        <option value="SOSIAL" <?php if ($row['organization_type'] == 'SOSIAL') echo 'selected'; ?>>SOSIAL</option>
                        <option value="POLITIK" <?php if ($row['organization_type'] == 'POLITIK') echo 'selected'; ?>>POLITIK</option>
                        <option value="SEKOLAH/KAMPUS" <?php if ($row['organization_type'] == 'SEKOLAH/KAMPUS') echo 'selected'; ?>>SEKOLAH/KAMPUS</option>
                        <option value="LAINNYA" <?php if ($row['organization_type'] == 'LAINNYA') echo 'selected'; ?>>LAINNYA</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label class="required">Nama</label>
                    <input type="text" class="form-control" name="organization_name" value="<?php echo $row['organization_name']; ?>" required>
                </div>
            </div>
            <div class="form-row">   
                <div class="form-group col-md-6">
                    <label class="required">Jabatan</label>
                    <input type="text" class="form-control" name="organization_position" value="<?php echo $row['organization_position']; ?>" required>
                </div>  
                <div class="form-group col-md-3">
                    <label class="required">Tahun masuk</label>
                    <input type="text" class="form-control" name="organization_yearstart" value="<?php echo $row['organization_yearstart']; ?>" maxlength="4" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Tahun keluar</label>
                    <input type="text" class="form-control" name="organization_yearend" value="<?php echo $row['organization_yearend']; ?>" maxlength="4" required>
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