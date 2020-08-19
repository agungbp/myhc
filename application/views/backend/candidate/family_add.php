<?php echo form_open(site_url('candidate/family/create/'.$this->session->userdata('login_nik')), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Nomor KTP</label>
            <input type="text" class="form-control" name="family_ktp" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Status</label>
            <select class="form-control selectpicker" name="family_status" data-live-search="true" required>
                <option value="" selected>-- Choose Status --</option>
                <option value="ISTRI">ISTRI</option>
                <option value="SUAMI">SUAMI</option>
                <option value="ANAK KE-1">ANAK KE-1</option>
                <option value="ANAK KE-2">ANAK KE-2</option>
                <option value="ANAK KE-3">ANAK KE-3</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Nama</label>
            <input type="text" class="form-control" name="family_name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>