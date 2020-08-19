<?php 
    $melahirkan = $this->db->get_where('melahirkan', array('melahirkan_id' => $param2))->result_array();

    echo form_open(site_url('humancapital/melahirkan/update/'.$param2), array('enctype' => 'multipart/form-data')); 
        foreach($melahirkan as $row):
?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Coding</label>
                    <input type="text" class="form-control" name="melahirkan_coding" value="<?php echo $row['melahirkan_coding'] ?>">
                    <input type="hidden" class="form-control" name="nik" value="<?php echo $row['nik'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jenis Persalinan</label>
                    <select class="form-control selectpicker" name="melahirkan_persalinan" id="opt_melahirkan_persalinan" data-live-search="true" required>
                        <option value="" <?php if ($row['melahirkan_persalinan'] == '') echo 'selected'; ?>>-- Pilih Persalinan --</option>
                        <option value="NORMAL" <?php if ($row['melahirkan_persalinan'] == 'NORMAL') echo 'selected'; ?>>NORMAL</option>
                        <option value="SECTIO" <?php if ($row['melahirkan_persalinan'] == 'SECTIO') echo 'selected'; ?>>SECTIO</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Nama Pasien</label>
                    <input type="text" class="form-control" name="melahirkan_namapasien" value="<?php echo $row['melahirkan_namapasien'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Keterangan</label>
                    <select class="form-control selectpicker" name="melahirkan_keterangan" data-live-search="true" required>
                        <option value="" <?php if ($row['melahirkan_keterangan'] == '') echo 'selected'; ?>>-- Pilih Keterangan --</option>
                        <option value="KARYAWAN" <?php if ($row['melahirkan_keterangan'] == 'KARYAWAN') echo 'selected'; ?>>KARYAWAN</option>
                        <option value="ISTRI KARYAWAN" <?php if ($row['melahirkan_keterangan'] == 'ISTRI KARYAWAN') echo 'selected'; ?>>ISTRI KARYAWAN</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Tanggal Kwitansi</label>
                    <input type="date" class="form-control" name="melahirkan_tglkwitansi" value="<?php echo $row['melahirkan_tglkwitansi'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Diajukan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="melahirkan_jmldiajukan" id="txt_melahirkan_jmldiajukan" value="<?php echo $row['melahirkan_jmldiajukan'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Jumlah Pengurang</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="melahirkan_jmlpengurang" id="txt_melahirkan_jmlpengurang" value="<?php echo $row['melahirkan_jmlpengurang'] ?>">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Disetujui</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="melahirkan_jmldisetujui" id="txt_melahirkan_jmldisetujui" value="<?php echo $row['melahirkan_jmldisetujui'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Pergantian</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" name="melahirkan_pergantian" id="txt_melahirkan_pergantian" value="<?php echo $row['melahirkan_pergantian'] ?>" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">%</div>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group col-md-6">
                    <label>Pinjaman Karyawan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="melahirkan_loan" value="<?php echo $row['melahirkan_loan'] ?>">
                    </div>
                </div> -->
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Realisasi</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="melahirkan_jmlrealisasi" id="txt_melahirkan_jmlrealisasi" value="<?php echo $row['melahirkan_jmlrealisasi'] ?>" 
                            max="<?php 
                                    if($row['melahirkan_persalinan'] == "NORMAL") {
                                        echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_melahirkannormal; 
                                    } else if ($row['melahirkan_persalinan'] == "SECTIO"){
                                        echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_melahirkansectio;
                                    }
                                ?>" 
                            required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Bank</label>
                    <input type="text" class="form-control" name="melahirkan_bank" value="<?php echo $row['melahirkan_bank'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Pemilik Rekening</label>
                    <input type="text" class="form-control" name="melahirkan_rekeningpemilik" value="<?php echo $row['melahirkan_rekeningpemilik'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Nomor Rekening</label>
                    <input type="number" class="form-control" name="melahirkan_rekeningnomor" value="<?php echo $row['melahirkan_rekeningnomor'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="melahirkan_status" data-live-search="true" id="opt_status" required>
                        <option value="Waiting for Approval" <?php if ($row['melahirkan_status'] == 'Waiting for Approval') echo 'selected'; ?>>WAITING FOR APPROVAL</option>
                        <option value="Hold" <?php if ($row['melahirkan_status'] == 'Hold') echo 'selected'; ?>>HOLD</option>
                        <option value="Approved" <?php if ($row['melahirkan_status'] == 'Approved') echo 'selected'; ?>>APPROVE</option>
                        <option value="Declined" <?php if ($row['melahirkan_status'] == 'Declined') echo 'selected'; ?>>DECLINE</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Note</label>
                    <textarea class="form-control" name="melahirkan_note" rows="4"><?php echo $row['melahirkan_note'] ?></textarea>
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
        $("#txt_melahirkan_jmldisetujui").keyup(function(){
            melahirkan_jmlrealisasi = ($("#txt_melahirkan_pergantian").val() / 100) * $("#txt_melahirkan_jmldisetujui").val();
            $("#txt_melahirkan_jmlrealisasi").val(melahirkan_jmlrealisasi);
        });
        $("#txt_melahirkan_pergantian").keyup(function(){
            melahirkan_jmlrealisasi = ($("#txt_melahirkan_pergantian").val() / 100) * $("#txt_melahirkan_jmldisetujui").val();
            $("#txt_melahirkan_jmlrealisasi").val(melahirkan_jmlrealisasi);
        });
        $("#txt_melahirkan_jmlpengurang").keyup(function(){
            melahirkan_jmldisetujui = $("#txt_melahirkan_jmldiajukan").val() - $("#txt_melahirkan_jmlpengurang").val();
            $("#txt_melahirkan_jmldisetujui").val(melahirkan_jmldisetujui);
        });

        $("#opt_status").change(function(){
            if ( $(this).val() == "Declined" || $(this).val() == "Hold" || $(this).val() == "Waiting for Approval" ) { 
                melahirkan_jmldisetujui = 0;
                $("#txt_melahirkan_jmldisetujui").val(melahirkan_jmldisetujui);
                melahirkan_jmlrealisasi = 0;
                $("#txt_melahirkan_jmlrealisasi").val(melahirkan_jmlrealisasi);
            }
        })
    });
</script>