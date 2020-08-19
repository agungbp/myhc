<?php 
    echo form_open(site_url('employee/melahirkan/create'), array('enctype' => 'multipart/form-data')); 
?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Keterangan</label>
            <select class="form-control selectpicker" name="melahirkan_keterangan" id="opt_melahirkan_keterangan" data-live-search="true" required>
                <option value="" selected>-- Pilih Keterangan --</option>
                <option value="KARYAWAN">PRIBADI</option>
                <option value="ISTRI KARYAWAN">ISTRI</option>
            </select>
        </div>
        <div class="form-group col-md-6" id="div_melahirkan_namapasien">
            <label class="required">Nama Pasien</label>
            <input type="text" class="form-control" name="melahirkan_namapasien" id="txt_melahirkan_namapasien">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jenis Persalinan</label>
            <select class="form-control selectpicker" name="melahirkan_persalinan" id="opt_melahirkan_persalinan" data-live-search="true" required>
                <option value="" selected>-- Pilih Persalinan --</option>
                <option value="NORMAL">NORMAL</option>
                <option value="SECTIO">SECTIO</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Tanggal Kwitansi</label>
            <input type="date" class="form-control" name="melahirkan_tglkwitansi" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jumlah Diajukan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="melahirkan_jmldiajukan" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Rekening</label>
            <select class="form-control selectpicker" name="melahirkan_rekening" id="opt_melahirkan_rekening" data-live-search="true" required>
                <option value="" selected>-- Pilih Rekening --</option>
                <option value="PRIBADI">PRIBADI</option>
                <option value="LAIN">LAIN</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div_melahirkan_bank">
            <label class="required">Nama Bank</label>
            <input type="text" class="form-control" name="melahirkan_bank" id="txt_melahirkan_bank">
        </div>
        <div class="form-group col-md-6" id="div_melahirkan_rekeningpemilik">
            <label class="required">Pemilik Rekening</label>
            <input type="text" class="form-control" name="melahirkan_rekeningpemilik" id="txt_melahirkan_rekeningpemilik">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div_melahirkan_rekeningnomor">
            <label class="required">Nomor Rekening</label>
            <input type="number" class="form-control" name="melahirkan_rekeningnomor" id="txt_melahirkan_rekeningnomor">
        </div>
        <div class="form-group col-md-12">
            <label class="required">Upload Kwitansi (Max: 1 Mb)</label>
            <input type="file" id="uploadfile" class="form-control-file" name="melahirkan_file" accept=".pdf" required>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#opt_melahirkan_keterangan").change(function() {
            if ($(this).val() == "ISTRI KARYAWAN") {
                $('#div_melahirkan_namapasien').show();
            } else {
                $('#div_melahirkan_namapasien').hide();
            }
        });
        $("#opt_melahirkan_keterangan").trigger("change");  
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#opt_melahirkan_rekening").change(function() {
            if ($(this).val() == "LAIN") {
                $('#div_melahirkan_bank').show();
                $('#div_melahirkan_rekeningpemilik').show();
                $('#div_melahirkan_rekeningnomor').show();
                $('#txt_melahirkan_bank').attr("required", true);
                $('#txt_melahirkan_rekeningpemilik').attr("required", true);
                $('#txt_melahirkan_rekeningnomor').attr("required", true);
            } else {
                $('#div_melahirkan_bank').hide();
                $('#div_melahirkan_rekeningpemilik').hide();
                $('#div_melahirkan_rekeningnomor').hide();
                $('#txt_melahirkan_bank').attr("required", false);
                $('#txt_melahirkan_rekeningpemilik').attr("required", false);
                $('#txt_melahirkan_rekeningnomor').attr("required", false);
            }
        });
        $("#opt_melahirkan_rekening").trigger("change");  
    });
</script>

<script type="text/javascript">
    var uploadField = document.getElementById("uploadfile");

    uploadField.onchange = function() {
        if(this.files[0].size > 1000000){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>