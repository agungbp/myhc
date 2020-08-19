<?php 
    echo form_open(site_url('employee/kacamata/create'), array('enctype' => 'multipart/form-data')); 
?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jenis Claim</label>
            <select class="form-control selectpicker" name="kacamata_keterangan" id="opt_kacamata_keterangan" data-live-search="true" required>
                <option value="" selected>-- Pilih Jenis Claim --</option>
                <option value="LENSA">LENSA</option>
                <option value="SET KACAMATA">SET KACAMATA</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Tanggal Kwitansi</label>
            <input type="date" class="form-control" name="kacamata_tglkwitansi" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Jumlah Diajukan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="kacamata_jmldiajukan" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Rekening</label>
            <select class="form-control selectpicker" name="kacamata_rekening" id="opt_kacamata_rekening" data-live-search="true" required>
                <option value="" selected>-- Pilih Rekening --</option>
                <option value="PRIBADI">PRIBADI</option>
                <option value="LAIN">LAIN</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div_kacamata_bank">
            <label class="required">Nama Bank</label>
            <input type="text" class="form-control" name="kacamata_bank" id="txt_kacamata_bank">
        </div>
        <div class="form-group col-md-6" id="div_kacamata_rekeningpemilik">
            <label class="required">Pemilik Rekening</label>
            <input type="text" class="form-control" name="kacamata_rekeningpemilik" id="txt_kacamata_rekeningpemilik">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div_kacamata_rekeningnomor">
            <label class="required">Nomor Rekening</label>
            <input type="number" class="form-control" name="kacamata_rekeningnomor" id="txt_kacamata_rekeningnomor">
        </div>
        <div class="form-group col-md-12">
            <label class="required">Upload Kwitansi (Max: 1 Mb)</label>
            <input type="file" id="uploadfile" class="form-control-file" name="kacamata_file" accept=".pdf" required>
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
        $("#opt_kacamata_rekening").change(function() {
            if ($(this).val() == "LAIN") {
                $('#div_kacamata_bank').show();
                $('#div_kacamata_rekeningpemilik').show();
                $('#div_kacamata_rekeningnomor').show();
                $('#txt_kacamata_bank').attr("required", true);
                $('#txt_kacamata_rekeningpemilik').attr("required", true);
                $('#txt_kacamata_rekeningnomor').attr("required", true);
            } else {
                $('#div_kacamata_bank').hide();
                $('#div_kacamata_rekeningpemilik').hide();
                $('#div_kacamata_rekeningnomor').hide();
                $('#txt_kacamata_bank').attr("required", false);
                $('#txt_kacamata_rekeningpemilik').attr("required", false);
                $('#txt_kacamata_rekeningnomor').attr("required", false);
            }
        });
        $("#opt_kacamata_rekening").trigger("change");  
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