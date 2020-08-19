<?php 
    $kacamata = $this->db->get_where('kacamata', array('kacamata_id' => $param2))->result_array();

    echo form_open(site_url('humancapital/kacamata/update/'.$param2), array('enctype' => 'multipart/form-data')); 
        foreach($kacamata as $row):
?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Coding</label>
                    <input type="text" class="form-control" name="kacamata_coding" value="<?php echo $row['kacamata_coding'] ?>">
                    <input type="hidden" class="form-control" name="nik" value="<?php echo $row['nik'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jenis Claim</label>
                    <select class="form-control selectpicker" name="kacamata_keterangan" data-live-search="true" required>
                        <option value="" <?php if ($row['kacamata_keterangan'] == '') echo 'selected'; ?>>-- Pilih Jenis Claim --</option>
                        <option value="LENSA" <?php if ($row['kacamata_keterangan'] == 'LENSA') echo 'selected'; ?>>LENSA</option>
                        <option value="SET KACAMATA" <?php if ($row['kacamata_keterangan'] == 'SET KACAMATA') echo 'selected'; ?>>SET KACAMATA</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Tanggal Kwitansi</label>
                    <input type="date" class="form-control" name="kacamata_tglkwitansi" value="<?php echo $row['kacamata_tglkwitansi'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Diajukan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="kacamata_jmldiajukan" id="txt_kacamata_jmldiajukan" value="<?php echo $row['kacamata_jmldiajukan'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Diganti</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="kacamata_jmldiganti" id="txt_kacamata_jmldiganti" value="<?php echo $row['kacamata_jmldiganti'] ?>" 
                            max="<?php 
                                    if($row['kacamata_keterangan'] == "LENSA") {
                                        echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_lensa; 
                                    } else if ($row['kacamata_keterangan'] == "SET KACAMATA"){
                                        echo $this->db->get_where('plafon', array('nik' => $row['nik'], 'plafon_periode' => date('Y')))->row()->plafon_setkacamata;
                                    }
                                ?>" 
                            required>                    
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Bank</label>
                    <input type="text" class="form-control" name="kacamata_bank" value="<?php echo $row['kacamata_bank'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Pemilik Rekening</label>
                    <input type="text" class="form-control" name="kacamata_rekeningpemilik" value="<?php echo $row['kacamata_rekeningpemilik'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nomor Rekening</label>
                    <input type="number" class="form-control" name="kacamata_rekeningnomor" value="<?php echo $row['kacamata_rekeningnomor'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="kacamata_status" data-live-search="true" id="opt_status" required>
                        <option value="Waiting for Approval" <?php if ($row['kacamata_status'] == 'Waiting for Approval') echo 'selected'; ?>>WAITING FOR APPROVAL</option>
                        <option value="Hold" <?php if ($row['kacamata_status'] == 'Hold') echo 'selected'; ?>>HOLD</option>
                        <option value="Approved" <?php if ($row['kacamata_status'] == 'Approved') echo 'selected'; ?>>APPROVE</option>
                        <option value="Declined" <?php if ($row['kacamata_status'] == 'Declined') echo 'selected'; ?>>DECLINE</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Note</label>
                    <textarea class="form-control" name="kacamata_note" rows="4"><?php echo $row['kacamata_note'] ?></textarea>
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
        $("#opt_status").change(function(){
            if ( $(this).val() == "Declined" || $(this).val() == "Hold" || $(this).val() == "Waiting for Approval" ) { 
                kacamata_jmldiganti = 0;
                $("#txt_kacamata_jmldiganti").val(kacamata_jmldiganti);
            }
        })
    });
</script>