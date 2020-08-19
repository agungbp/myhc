<?php 
    $rawatjalan = $this->db->get_where('rawatjalan', array('rawatjalan_id' => $param2))->result_array();

    echo form_open(site_url('humancapital/rawatjalan/update/'.$param2), array('enctype' => 'multipart/form-data')); 
        foreach($rawatjalan as $row):
?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Coding</label>
                    <input type="text" class="form-control" name="rawatjalan_coding" value="<?php echo $row['rawatjalan_coding'] ?>">
                    <input type="hidden" class="form-control" name="nik" value="<?php echo $row['nik'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nama Pasien</label>
                    <input type="text" class="form-control" name="rawatjalan_namapasien" value="<?php echo $row['rawatjalan_namapasien'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Keterangan</label>
                    <select class="form-control selectpicker" name="rawatjalan_keterangan" data-live-search="true" required>
                        <option value="" <?php if ($row['rawatjalan_keterangan'] == '') echo 'selected'; ?>>-- Pilih Keterangan --</option>
                        <option value="KARYAWAN" <?php if ($row['rawatjalan_keterangan'] == 'KARYAWAN') echo 'selected'; ?>>KARYAWAN</option>
                        <option value="ISTRI KARYAWAN" <?php if ($row['rawatjalan_keterangan'] == 'ISTRI KARYAWAN') echo 'selected'; ?>>ISTRI KARYAWAN</option>
                        <option value="SUAMI KARYAWAN" <?php if ($row['rawatjalan_keterangan'] == 'SUAMI KARYAWAN') echo 'selected'; ?>>SUAMI KARYAWAN</option>
                        <option value="ANAK KARYAWAN" <?php if ($row['rawatjalan_keterangan'] == 'ANAK KARYAAWAN') echo 'selected'; ?>>ANAK KARYAWAN</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Tanggal Kwitansi</label>
                    <input type="date" class="form-control" name="rawatjalan_tglkwitansi" value="<?php echo $row['rawatjalan_tglkwitansi'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Plafon Awal</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatjalan_plafonawal" id="txt_rawatjalan_plafonawal" value="<?php echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_rawatjalan; ?>" readonly>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Diajukan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatjalan_jmldiajukan" id="txt_rawatjalan_jmldiajukan" value="<?php echo $row['rawatjalan_jmldiajukan'] ?>" required>
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
                        <input type="number" class="form-control" name="rawatjalan_loan" value="<?php echo $row['rawatjalan_loan'] ?>">
                    </div>
                </div> -->
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Realisasi</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatjalan_jmlrealisasi" id="txt_rawatjalan_jmlrealisasi" value="<?php echo $row['rawatjalan_jmlrealisasi'] ?>" max="<?php echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_rawatjalan; ?>" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Sisa Plafon</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="rawatjalan_sisaplafon" id="txt_rawatjalan_sisasplafon" value="<?php echo $row['rawatjalan_sisaplafon'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Bank</label>
                    <input type="text" class="form-control" name="rawatjalan_bank" value="<?php echo $row['rawatjalan_bank'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Pemilik Rekening</label>
                    <input type="text" class="form-control" name="rawatjalan_rekeningpemilik" value="<?php echo $row['rawatjalan_rekeningpemilik'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Nomor Rekening</label>
                    <input type="number" class="form-control" name="rawatjalan_rekeningnomor" value="<?php echo $row['rawatjalan_rekeningnomor'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="rawatjalan_status" id="opt_status" data-live-search="true" required>
                        <option value="Waiting for Approval" <?php if ($row['rawatjalan_status'] == 'Waiting for Approval') echo 'selected'; ?>>WAITING FOR APPROVAL</option>
                        <option value="Hold" <?php if ($row['rawatjalan_status'] == 'Hold') echo 'selected'; ?>>HOLD</option>
                        <option value="Approved" <?php if ($row['rawatjalan_status'] == 'Approved') echo 'selected'; ?>>APPROVE</option>
                        <option value="Declined" <?php if ($row['rawatjalan_status'] == 'Declined') echo 'selected'; ?>>DECLINE</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Note</label>
                    <textarea class="form-control" name="rawatjalan_note" rows="4"><?php echo $row['rawatjalan_note'] ?></textarea>
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
        $("#txt_rawatjalan_jmlrealisasi").keyup(function(){
            rawatjalan_sisasplafon = $("#txt_rawatjalan_plafonawal").val() - $("#txt_rawatjalan_jmlrealisasi").val();
            $("#txt_rawatjalan_sisasplafon").val(rawatjalan_sisasplafon);
        });

        $("#opt_status").change(function(){
            if ( $(this).val() == "Declined" || $(this).val() == "Hold" || $(this).val() == "Waiting for Approval" ) { 
                rawatjalan_jmlrealisasi = 0;
                $("#txt_rawatjalan_jmlrealisasi").val(rawatjalan_jmlrealisasi);
                rawatjalan_sisasplafon = $("#txt_rawatjalan_plafonawal").val();
                $("#txt_rawatjalan_sisasplafon").val(rawatjalan_sisasplafon);
            }
        })
    });
</script>