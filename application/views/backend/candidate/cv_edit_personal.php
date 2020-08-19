<div class="form-row">
    <div class="form-group col-md-12">
        <label>Data Personal</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">KTP</label>
        <input type="text" class="form-control" name="candidate_ktp" value="<?php echo $row['candidate_ktp']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Nama lengkap</label>
        <input type="text" class="form-control" name="candidate_name" value="<?php echo $row['candidate_name']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Tempat lahir</label>
        <input type="text" class="form-control" name="candidate_birthplace" value="<?php echo $row['candidate_birthplace']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Tanggal lahir</label>
        <input type="date" class="form-control" name="candidate_birthdate" value="<?php echo $row['candidate_birthdate']; ?>" required>
    </div>
</div>

<div class="form-row">  
    <div class="form-group col-md-3">
        <label>Masa berlaku KTP</label>
        <div class="row">
            <div class="col-md-7">
                <input type="date" class="form-control" name="candidate_ktpexpire" value="<?php echo $row['candidate_ktpexpire']; ?>" id="txt_candidate_ktpexpire" <?php if ($row['candidate_ktpexpire'] == 'SEUMUR HIDUP') echo 'disabled'; ?>>
            </div>
            <div class="col-md-5">
                <div class="form-check" style="margin-top: 7px;">
                    <input class="form-check-input" type="checkbox" value="SEUMUR HIDUP" name="candidate_ktpexpire" id="chk_candidate_ktpexpire" <?php if ($row['candidate_ktpexpire'] == 'SEUMUR HIDUP') echo 'checked'; ?>>
                    <label class="form-check-label">SEUMUR HIDUP</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Email</label>
        <input type="email" class="form-control" name="candidate_email" value="<?php echo $row['candidate_email']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Nomor HP</label>
        <input type="number" class="form-control" name="candidate_phone" value="<?php echo $row['candidate_phone']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label>Nomor HP 2</label>
        <input type="number" class="form-control" name="candidate_phone2" value="<?php echo $row['candidate_phone2']; ?>">
    </div>
</div>

<div class="form-row">  
    <div class="form-group col-md-3">
        <label class="required">Jenis kelamin</label>
        <select class="form-control selectpicker" name="candidate_gender" data-live-search="true" required>
            <option value="" <?php if ($row['candidate_gender'] == '') echo 'selected'; ?>>-- Pilih jenis kelamin --</option>
            <option value="L" <?php if ($row['candidate_gender'] == 'L') echo 'selected'; ?>>LAKI-LAKI</option>
            <option value="P" <?php if ($row['candidate_gender'] == 'P') echo 'selected'; ?>>PEREMPUAN</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Agama</label>
        <select class="form-control selectpicker" name="candidate_religion" data-live-search="true" required>
            <option value="" <?php if ($row['candidate_religion'] == '') echo 'selected'; ?>>-- Pilih agama --</option>
            <option value="ISLAM" <?php if ($row['candidate_religion'] == 'ISLAM') echo 'selected'; ?>>ISLAM</option>
            <option value="KRISTEN" <?php if ($row['candidate_religion'] == 'KRISTEN') echo 'selected'; ?>>KRISTEN</option>
            <option value="KATOLIK" <?php if ($row['candidate_religion'] == 'KATOLIK') echo 'selected'; ?>>KATOLIK</option>
            <option value="HINDU" <?php if ($row['candidate_religion'] == 'HINDU') echo 'selected'; ?>>HINDU</option>
            <option value="BUDHA" <?php if ($row['candidate_religion'] == 'BUDHA') echo 'selected'; ?>>BUDHA</option>
            <option value="KON HU CU" <?php if ($row['candidate_religion'] == 'KON HU CU') echo 'selected'; ?>>KON HU CU</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Status perkawinan</label>
        <select class="form-control selectpicker" name="candidate_marital" data-live-search="true" required>
            <option value="" <?php if ($row['candidate_marital'] == '') echo 'selected'; ?>>-- Pilih status perkawinan --</option>
            <option value="MENIKAH" <?php if ($row['candidate_marital'] == 'MENIKAH') echo 'selected'; ?>>MENIKAH</option>
            <option value="TIDAK MENIKAH" <?php if ($row['candidate_marital'] == 'TIDAK MENIKAH') echo 'selected'; ?>>TIDAK MENIKAH</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Pendidikan terakhir</label>
        <select class="form-control selectpicker" name="candidate_education" data-live-search="true" required>
            <option value="" <?php if ($row['candidate_education'] == '') echo 'selected'; ?>>-- Pilih pendidikan --</option>
            <option value="SLTP SEDERAJAT" <?php if ($row['candidate_education'] == 'SLTP SEDERAJAT') echo 'selected'; ?>>SLTP SEDERAJAT</option>
            <option value="SMU SEDERAJAT" <?php if ($row['candidate_education'] == 'SMU SEDERAJAT') echo 'selected'; ?>>SMU SEDERAJAT</option>
            <option value="D1" <?php if ($row['candidate_education'] == 'D1') echo 'selected'; ?>>D1</option>
            <option value="D2" <?php if ($row['candidate_education'] == 'D2') echo 'selected'; ?>>D2</option>
            <option value="D3" <?php if ($row['candidate_education'] == 'D3') echo 'selected'; ?>>D3</option>
            <option value="D4" <?php if ($row['candidate_education'] == 'D4') echo 'selected'; ?>>D4</option>
            <option value="S1" <?php if ($row['candidate_education'] == 'S1') echo 'selected'; ?>>S1</option>
            <option value="S2" <?php if ($row['candidate_education'] == 'S2') echo 'selected'; ?>>S2</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">Sekolah/Univ</label>
        <input type="text" class="form-control" name="candidate_university" value="<?php echo $row['candidate_university']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label>Jurusan</label>
        <input type="text" class="form-control" name="candidate_major" value="<?php echo $row['candidate_major']; ?>">
    </div>
    <div class="form-group col-md-3">
        <label>IPK/NEM</label>
        <input type="text" class="form-control" name="candidate_gpa" value="<?php echo $row['candidate_gpa']; ?>">
    </div>
    <div class="form-group col-md-3">
        <label class="required">Kota</label>
        <input type="text" class="form-control" name="candidate_city" value="<?php echo $row['candidate_city']; ?>" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label class="required">Alamat</label>
        <textarea class="form-control" rows="3" name="candidate_address" required><?php echo $row['candidate_address']; ?></textarea>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <hr><label>Foto profil</label>
    </div>
</div>

<div class="form-group">
    <label for="field-1" class="col-sm-3 control-label">(3x4 Formal, max : 500kb) .jpg</label>
    <div class="col-sm-8">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 150px; height: 200px; margin-left: 20px; margin-top: 5px; margin-bottom: 5px; outline: 1px dashed #1C6EA4; outline-offset: 7px;" data-trigger="fileinput">
                <?php if (file_exists('uploads/candidate_image/' . $row['candidate_ktp'] . '.jpg')): ?>
                    <img src="<?php echo base_url();?>uploads/candidate_image/<?php echo $row['candidate_ktp']; ?>.jpg" alt="...">
                <?php endif; ?>
                <?php if (!(file_exists('uploads/candidate_image/' . $row['candidate_ktp'] . '.jpg'))): ?>
                    <img src="http://placehold.it/300x400" alt="...">
                <?php endif; ?>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 200px; margin-left: 20px; margin-top: 5px; margin-bottom: 5px; outline: 1px dashed #1C6EA4; outline-offset: 7px;"></div>
            <div>
                <span class="btn btn-white btn-file">
                    <span class="fileinput-new btn btn-dark">Pilih foto</span>
                    <span class="fileinput-exists btn btn-warning">Ubah</span>
                    <input type="file" name="userfile" id="uploadfile" accept=".jpg">
                </span>
                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>

<script type="text/javascript">
    var uploadField = document.getElementById("uploadfile");

    uploadField.onchange = function() {
        if(this.files[0].size > 500000){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>

<script type="text/javascript">
    $('#chk_candidate_ktpexpire').click(function(){
        if($(this).is(':checked')){
            $('#txt_candidate_ktpexpire').attr("disabled", true);
        } else{
            $('#txt_candidate_ktpexpire').attr("disabled", false);
        }
    });
</script>