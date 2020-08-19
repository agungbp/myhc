<?php echo form_open(site_url('candidate/education/create/'.$this->session->userdata('login_nik')), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Pendidikan</label>
            <select class="form-control selectpicker" name="education_level" data-live-search="true" required>
                <option value="" selected>-- Choose Level --</option>
                <option value="SLTP SEDERAJAT">SLTP SEDERAJAT</option>
                <option value="SMU SEDERAJAT">SMU SEDERAJAT</option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Sekolah/Univ</label>
            <input type="text" class="form-control" name="education_university" required>
        </div>
    </div>
    <div class="form-row">  
        <div class="form-group col-md-6">
            <label>Jurusan</label>
            <input type="text" class="form-control" name="education_major">
        </div>  
        <div class="form-group col-md-3">
            <label>IPK/NEM</label>
            <input type="text" class="form-control" name="education_gpa">
        </div> 
        <div class="form-group col-md-3">
            <label>Tahun masuk</label>
            <input type="text" class="form-control" name="education_yearstart" maxlength="4">
        </div>
    </div>
    <div class="form-row">  
        <div class="form-group col-md-3">
            <label>Tahun lulus</label>
            <input type="text" class="form-control" name="education_yearend" maxlength="4">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Simpan</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>