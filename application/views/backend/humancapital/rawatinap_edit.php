<?php 
    $rawatinap = $this->db->get_where('rawatinap', array('rawatinap_id' => $param2))->result_array();

    echo form_open(site_url('humancapital/rawatinap/update/'.$param2), array('enctype' => 'multipart/form-data')); 
        foreach($rawatinap as $row):
?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Coding</label>
                    <input type="text" class="form-control" name="rawatinap_coding" value="<?php echo $row['rawatinap_coding'] ?>">
                    <input type="hidden" class="form-control" name="nik" value="<?php echo $row['nik'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nama Pasien</label>
                    <input type="text" class="form-control" name="rawatinap_namapasien" value="<?php echo $row['rawatinap_namapasien'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Keterangan</label>
                    <select class="form-control selectpicker" name="rawatinap_keterangan" data-live-search="true" required>
                        <option value="" <?php if ($row['rawatinap_keterangan'] == '') echo 'selected'; ?>>-- Pilih Keterangan --</option>
                        <option value="KARYAWAN" <?php if ($row['rawatinap_keterangan'] == 'KARYAWAN') echo 'selected'; ?>>KARYAWAN</option>
                        <option value="ISTRI KARYAWAN" <?php if ($row['rawatinap_keterangan'] == 'ISTRI KARYAWAN') echo 'selected'; ?>>ISTRI KARYAWAN</option>
                        <option value="SUAMI KARYAWAN" <?php if ($row['rawatinap_keterangan'] == 'SUAMI KARYAWAN') echo 'selected'; ?>>SUAMI KARYAWAN</option>
                        <option value="ANAK KARYAWAN" <?php if ($row['rawatinap_keterangan'] == 'ANAK KARYAAWAN') echo 'selected'; ?>>ANAK KARYAWAN</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Tanggal Kwitansi</label>
                    <input type="date" class="form-control" name="rawatinap_tglkwitansi" value="<?php echo $row['rawatinap_tglkwitansi'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Diajukan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatinap_jmldiajukan" id="txt_rawatinap_jmldiajukan" value="<?php echo $row['rawatinap_jmldiajukan'] ?>" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Jumlah Pengurang</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatinap_jmlpengurang" id="txt_rawatinap_jmlpengurang" value="<?php echo $row['rawatinap_jmlpengurang'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Disetujui</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatinap_jmldisetujui" id="txt_rawatinap_jmldisetujui" value="<?php echo $row['rawatinap_jmldisetujui'] ?>" required>
                    </div>
                </div>
            <!-- </div>
            <div class="form-row"> -->
                <div class="form-group col-md-6">
                    <label class="required">Pergantian</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" name="rawatinap_pergantian" id="txt_rawatinap_pergantian" value="<?php echo $row['rawatinap_pergantian'] ?>" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <!-- <div class="form-group col-md-6">
                    <label>Pinjaman Karyawan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatinap_loan" value="<?php echo $row['rawatinap_loan'] ?>">
                    </div>
                </div> -->
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Realisasi</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatinap_jmlrealisasi" id="txt_rawatinap_jmlrealisasi" value="<?php echo $row['rawatinap_jmlrealisasi'] ?>" max="<?php echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_rawatinap; ?>" required>
                    </div>
                </div>
            <!-- </div>
            <div class="form-row"> -->
                <div class="form-group col-md-6">
                    <label class="required">Bank</label>
                    <input type="text" class="form-control" name="rawatinap_bank" value="<?php echo $row['rawatinap_bank'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Pemilik Rekening</label>
                    <input type="text" class="form-control" name="rawatinap_rekeningpemilik" value="<?php echo $row['rawatinap_rekeningpemilik'] ?>" required>
                </div>
            <!-- </div>
            <div class="form-row"> -->
                <div class="form-group col-md-6">
                    <label class="required">Nomor Rekening</label>
                    <input type="number" class="form-control" name="rawatinap_rekeningnomor" value="<?php echo $row['rawatinap_rekeningnomor'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="rawatinap_status" id="opt_status" data-live-search="true" required>
                        <option value="Waiting for Approval" <?php if ($row['rawatinap_status'] == 'Waiting for Approval') echo 'selected'; ?>>WAITING FOR APPROVAL</option>
                        <option value="Hold" <?php if ($row['rawatinap_status'] == 'Hold') echo 'selected'; ?>>HOLD</option>
                        <option value="Approved" <?php if ($row['rawatinap_status'] == 'Approved') echo 'selected'; ?>>APPROVE</option>
                        <option value="Declined" <?php if ($row['rawatinap_status'] == 'Declined') echo 'selected'; ?>>DECLINE</option>
                    </select>
                </div>
            <!-- </div>
            <div class="form-row"> -->
                <div class="form-group col-md-6">
                    <label>Note</label>
                    <textarea class="form-control" name="rawatinap_note" rows="4"><?php echo $row['rawatinap_note'] ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <br><button type="submit" class="btn btn-info">Save</button>
                    </div>
                </div>
            </div>
<?php 
        endforeach;
    echo form_close(); 
?>

<script>
    $('.selectpicker').selectpicker('render')
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#txt_rawatinap_jmldisetujui").keyup(function(){
            rawatinap_jmlrealisasi = ($("#txt_rawatinap_pergantian").val() / 100) * $("#txt_rawatinap_jmldisetujui").val();
            $("#txt_rawatinap_jmlrealisasi").val(rawatinap_jmlrealisasi);
        });
        $("#txt_rawatinap_pergantian").keyup(function(){
            rawatinap_jmlrealisasi = ($("#txt_rawatinap_pergantian").val() / 100) * $("#txt_rawatinap_jmldisetujui").val();
            $("#txt_rawatinap_jmlrealisasi").val(rawatinap_jmlrealisasi);
        });
        $("#txt_rawatinap_jmlpengurang").keyup(function(){
            rawatinap_jmldisetujui = $("#txt_rawatinap_jmldiajukan").val() - $("#txt_rawatinap_jmlpengurang").val();
            $("#txt_rawatinap_jmldisetujui").val(rawatinap_jmldisetujui);
        });

        $("#opt_status").change(function(){
            if ( $(this).val() == "Declined" || $(this).val() == "Hold" || $(this).val() == "Waiting for Approval" ) { 
                rawatinap_jmldisetujui = 0;
                $("#txt_rawatinap_jmldisetujui").val(rawatinap_jmldisetujui);
                rawatinap_jmlrealisasi = 0;
                $("#txt_rawatinap_jmlrealisasi").val(rawatinap_jmlrealisasi);
            }
        })
    });
</script>