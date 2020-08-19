<?php echo form_open(site_url('humancapital/upload_plafon'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">File (Excel)</label>
            <input type="file" class="form-control-file" name="berkas_excel" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Import</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo site_url('uploads/template_plafon.xlsx'); ?>" class="btn btn-success"><i class="fas fa-file-download"></i>&nbsp;&nbsp;Download template</a>
            </div>
        </div>
    </div>          
<?php echo form_close(); ?>