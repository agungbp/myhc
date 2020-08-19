<?php echo form_open(site_url('candidate/certification/create/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Nomor sertifikat</label>
            <input type="text" class="form-control" name="certification_number" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Nama Sertifikat</label>
            <input type="text" class="form-control" name="certification_name" required>
        </div>
    </div>
    <div class="form-row">     
        <div class="form-group col-md-6">
            <label class="required">Penyelenggara</label>
            <input type="text" class="form-control" name="certification_organizer" required>
        </div>
        <div class="form-group col-md-6">
            <label>File (Max: 500 Kb)</label>
            <input type="file" class="form-control-file" name="certification_file" accept=".pdf" id="uploadfile">
        </div>
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-3">
            <label class="required">Tahun</label>
            <input type="text" class="form-control" name="certification_year" maxlength="4" required>
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

<script type="text/javascript">
    var uploadField = document.getElementById("uploadfile");

    uploadField.onchange = function() {
        if(this.files[0].size > 500000){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>