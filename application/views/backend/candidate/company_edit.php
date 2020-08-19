<?php 
    $company = $this->db->get_where('company', array('company_id'=>$param2))->result_array();
    foreach ($company as $row):
        echo form_open(site_url('candidate/company/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Jenis perusahaan</label>
                    <select class="form-control selectpicker" name="company_type" data-live-search="true" required>
                        <option value="LEMBAGA" <?php if ($row['company_type'] == 'LEMBAGA') echo 'selected'; ?>>LEMBAGA</option>
                        <option value="BUMN" <?php if ($row['company_type'] == 'BUMN') echo 'selected'; ?>>BUMN</option>
                        <option value="BUMD" <?php if ($row['company_type'] == 'BUMD') echo 'selected'; ?>>BUMD</option>
                        <option value="SWASTA" <?php if ($row['company_type'] == 'SWASTA') echo 'selected'; ?>>SWASTA</option>
                        <option value="LAINNYA" <?php if ($row['company_type'] == 'LAINNYA') echo 'selected'; ?>>LAINNYA</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Status karyawan</label>
                    <select class="form-control selectpicker" name="company_status" data-live-search="true" required>
                        <option value="TETAP" <?php if ($row['company_status'] == 'TETAP') echo 'selected'; ?>>TETAP</option>
                        <option value="KONTRAK" <?php if ($row['company_status'] == 'KONTRAK') echo 'selected'; ?>>KONTRAK</option>
                        <option value="MAGANG" <?php if ($row['company_status'] == 'MAGANG') echo 'selected'; ?>>MAGANG</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Nama perusahaan</label>
                    <input type="text" class="form-control" name="company_name" value="<?php echo $row['company_name']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jabatan</label>
                    <input type="text" class="form-control" name="company_position" value="<?php echo $row['company_position']; ?>" required>
                </div>  
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="required">Tahun masuk</label>
                    <input type="text" class="form-control" name="company_yearstart" value="<?php echo $row['company_yearstart']; ?>" maxlength="4" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Tahun selesai</label>
                    <input type="text" class="form-control" name="company_yearend" value="<?php echo $row['company_yearend']; ?>" maxlength="4" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Job Description</label>
                    <textarea class="form-control" name="company_jobdesc" rows="4"><?php echo $row['company_jobdesc']; ?></textarea>
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