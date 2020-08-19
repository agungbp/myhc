<?php 
    echo form_open(site_url('employee/rawatinap/create'), array('enctype' => 'multipart/form-data')); 
?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Keterangan</label>
            <select class="form-control selectpicker" name="rawatinap_keterangan" id="opt_rawatinap_keterangan" data-live-search="true" required>
                <option value="" selected>-- Pilih Keterangan --</option>
                <option value="KARYAWAN">PRIBADI</option>
                <option value="ISTRI KARYAWAN">ISTRI</option>
                <option value="SUAMI KARYAWAN">SUAMI</option>
                <option value="ANAK KARYAWAN">ANAK</option>
            </select>
        </div>
        <div class="form-group col-md-6" id="div_rawatinap_namapasien">
            <label class="required">Nama Pasien</label>
            <input type="text" class="form-control" name="rawatinap_namapasien" id="txt_rawatinap_namapasien">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Tanggal Kwitansi</label>
            <input type="date" class="form-control" name="rawatinap_tglkwitansi" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Jumlah Diajukan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="rawatinap_jmldiajukan" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Rekening</label>
            <select class="form-control selectpicker" name="rawatinap_rekening" id="opt_rawatinap_rekening" data-live-search="true" required>
                <option value="" selected>-- Pilih Rekening --</option>
                <option value="PRIBADI">PRIBADI</option>
                <option value="LAIN">LAIN</option>
            </select>
        </div>
        <div class="form-group col-md-6" id="div_rawatinap_bank">
            <label class="required">Nama Bank</label>
            <input type="text" class="form-control" name="rawatinap_bank" id="txt_rawatinap_bank">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div_rawatinap_rekeningpemilik">
            <label class="required">Pemilik Rekening</label>
            <input type="text" class="form-control" name="rawatinap_rekeningpemilik" id="txt_rawatinap_rekeningpemilik">
        </div>
        <div class="form-group col-md-6" id="div_rawatinap_rekeningnomor">
            <label class="required">Nomor Rekening</label>
            <input type="number" class="form-control" name="rawatinap_rekeningnomor" id="txt_rawatinap_rekeningnomor">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Upload Kwitansi (Max: 1 Mb)</label>
            <input type="file" id="uploadfile" class="form-control-file" name="rawatinap_file" accept=".pdf" required>
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
        $("#opt_rawatinap_keterangan").change(function() {
            if ($(this).val() == "ANAK KARYAWAN" || $(this).val() == "ISTRI KARYAWAN" || $(this).val() == "SUAMI KARYAWAN") {
                $('#div_rawatinap_namapasien').show();
            } else {
                $('#div_rawatinap_namapasien').hide();
            }
        });
        $("#opt_rawatinap_keterangan").trigger("change");  
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#opt_rawatinap_rekening").change(function() {
            if ($(this).val() == "LAIN") {
                $('#div_rawatinap_bank').show();
                $('#div_rawatinap_rekeningpemilik').show();
                $('#div_rawatinap_rekeningnomor').show();
                $('#txt_rawatinap_bank').attr("required", true);
                $('#txt_rawatinap_rekeningpemilik').attr("required", true);
                $('#txt_rawatinap_rekeningnomor').attr("required", true);
            } else {
                $('#div_rawatinap_bank').hide();
                $('#div_rawatinap_rekeningpemilik').hide();
                $('#div_rawatinap_rekeningnomor').hide();
                $('#txt_rawatinap_bank').attr("required", false);
                $('#txt_rawatinap_rekeningpemilik').attr("required", false);
                $('#txt_rawatinap_rekeningnomor').attr("required", false);
            }
        });
        $("#opt_rawatinap_rekening").trigger("change");  
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