<?php echo form_open(site_url('candidate/organization/create/'.$this->session->userdata('login_nik')), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jenis</label>
            <select class="form-control selectpicker" name="organization_type" data-live-search="true" required>
                <option value="" selected>-- Pilih jenis --</option>
                <option value="KEAGAMAAN">KEAGAMAAN</option>
                <option value="SOSIAL">SOSIAL</option>
                <option value="POLITIK">POLITIK</option>
                <option value="SEKOLAH/KAMPUS">SEKOLAH/KAMPUS</option>
                <option value="LAINNYA">LAINNYA</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Nama</label>
            <input type="text" class="form-control" name="organization_name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jabatan</label>
            <input type="text" class="form-control" name="organization_position" required>
        </div>
        <div class="form-group col-md-3">
            <label class="required">Tahun masuk</label>
            <input type="text" class="form-control" name="organization_yearstart" maxlength="4" required>
        </div>
        <div class="form-group col-md-3">
            <label class="required">Tahun keluar</label>
            <input type="text" class="form-control" name="organization_yearend" maxlength="4" required>
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