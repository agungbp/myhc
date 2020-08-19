<?php echo form_open(site_url('employee/speakup/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Judul</label>
            <input type="text" class="form-control" name="speakup_subject" required>     
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Isi</label>
            <textarea class="form-control" name="speakup_description" rows="20" placeholder="Kritik, saran, info, aduan, dll." required></textarea>   
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