<?php echo form_open(site_url('candidate/company/create/'.$this->session->userdata('login_nik')), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jenis perusahaan</label>
            <select class="form-control selectpicker" name="company_type" data-live-search="true" required>
                <option value="" selected>-- Choose Type --</option>
                <option value="LEMBAGA">LEMBAGA</option>
                <option value="BUMN">BUMN</option>
                <option value="BUMD">BUMD</option>
                <option value="SWASTA">SWASTA</option>
                <option value="LAINNYA">LAINNYA</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Status karyawan</label>
            <select class="form-control selectpicker" name="company_status" data-live-search="true" required>
                <option value="" selected>-- Choose Status --</option>
                <option value="TETAP">TETAP</option>
                <option value="KONTRAK">KONTRAK</option>
                <option value="MAGANG">MAGANG</option>
            </select>
        </div>
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-6">
            <label class="required">Nama perusahaan</label>
            <input type="text" class="form-control" name="company_name" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Jabatan</label>
            <input type="text" class="form-control" name="company_position" required>
        </div> 
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-3">
            <label class="required">Tahun masuk</label>
            <input type="text" class="form-control" name="company_yearstart" maxlength="4" required>
        </div>
        <div class="form-group col-md-3">
            <label class="required">Tahun keluar</label>
            <input type="text" class="form-control" name="company_yearend" maxlength="4" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Job Description</label>
            <textarea class="form-control" name="company_jobdesc" rows="4"></textarea>
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