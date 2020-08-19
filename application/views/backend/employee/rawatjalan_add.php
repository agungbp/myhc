<?php 
    echo form_open(site_url('employee/rawatjalan/create'), array('enctype' => 'multipart/form-data')); 
?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Keterangan</label>
            <select class="form-control selectpicker" name="rawatjalan_keterangan" id="opt_rawatjalan_keterangan" data-live-search="true" required>
                <option value="" selected>-- Pilih Keterangan --</option>
                <option value="KARYAWAN">PRIBADI</option>
                <option value="ISTRI KARYAWAN">ISTRI</option>
                <option value="SUAMI KARYAWAN">SUAMI</option>
                <option value="ANAK KARYAWAN">ANAK</option>
            </select>
        </div>
        <div class="form-group col-md-6" id="div_rawatjalan_namapasien">
            <label class="required">Nama Pasien</label>
            <input type="text" class="form-control" name="rawatjalan_namapasien" id="txt_rawatjalan_namapasien">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Tanggal Kwitansi</label>
            <input type="date" class="form-control" name="rawatjalan_tglkwitansi" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Jumlah Diajukan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="rawatjalan_jmldiajukan" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Rekening</label>
            <select class="form-control selectpicker" name="rawatjalan_rekening" id="opt_rawatjalan_rekening" data-live-search="true" required>
                <option value="" selected>-- Pilih Rekening --</option>
                <option value="PRIBADI">PRIBADI</option>
                <option value="LAIN">LAIN</option>
            </select>
        </div>
        <div class="form-group col-md-6" id="div_rawatjalan_bank">
            <label class="required">Nama Bank</label>
            <input type="text" class="form-control" name="rawatjalan_bank" id="txt_rawatjalan_bank">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div_rawatjalan_rekeningpemilik">
            <label class="required">Pemilik Rekening</label>
            <input type="text" class="form-control" name="rawatjalan_rekeningpemilik" id="txt_rawatjalan_rekeningpemilik">
        </div>
        <div class="form-group col-md-6" id="div_rawatjalan_rekeningnomor">
            <label class="required">Nomor Rekening</label>
            <input type="number" class="form-control" name="rawatjalan_rekeningnomor" id="txt_rawatjalan_rekeningnomor">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Upload Kwitansi (Max: 1 Mb)</label>
            <input type="file" class="form-control-file" name="rawatjalan_file" accept=".pdf" required>
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
        $("#opt_rawatjalan_keterangan").change(function() {
            if ($(this).val() == "ANAK KARYAWAN" || $(this).val() == "ISTRI KARYAWAN" || $(this).val() == "SUAMI KARYAWAN") {
                $('#div_rawatjalan_namapasien').show();
            } else {
                $('#div_rawatjalan_namapasien').hide();
            }
        });
        $("#opt_rawatjalan_keterangan").trigger("change");  
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#opt_rawatjalan_rekening").change(function() {
            if ($(this).val() == "LAIN") {
                $('#div_rawatjalan_bank').show();
                $('#div_rawatjalan_rekeningpemilik').show();
                $('#div_rawatjalan_rekeningnomor').show();
                $('#txt_rawatjalan_bank').attr("required", true);
                $('#txt_rawatjalan_rekeningpemilik').attr("required", true);
                $('#txt_rawatjalan_rekeningnomor').attr("required", true);
            } else {
                $('#div_rawatjalan_bank').hide();
                $('#div_rawatjalan_rekeningpemilik').hide();
                $('#div_rawatjalan_rekeningnomor').hide();
                $('#txt_rawatjalan_bank').attr("required", false);
                $('#txt_rawatjalan_rekeningpemilik').attr("required", false);
                $('#txt_rawatjalan_rekeningnomor').attr("required", false);
            }
        });
        $("#opt_rawatjalan_rekening").trigger("change");  
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