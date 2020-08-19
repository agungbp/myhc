<?php
    $this->db->from('employee');
    $this->db->join('section', 'employee.section_code = section.section_code');
    $this->db->join('loan', 'employee.nik = loan.nik');
    $this->db->where('loan_id', $param2);
    $emp = $this->db->get();
    // $emp = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')));

    foreach($emp->result_array() as $row):
        echo form_open(site_url('humancapital/loan/update/' . $param2 . '/' . $param3), array('enctype' => 'multipart/form-data')); 
?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="<?php echo $row['employee_name'] ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>NIP</label>
                    <input type="text" class="form-control" value="<?php echo $row['nik'] ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Department</label>
                    <input type="text" class="form-control" value="<?php echo $row['section_name'] ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" value="<?php echo $row['employee_position'] ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tanggal Masuk Kerja</label>
                    <input type="date" class="form-control" value="<?php echo $row['employee_join'] ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Status Karyawan</label>
                    <input type="text" class="form-control" value="<?php echo $row['employee_status'] ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Gaji Pokok/bulan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="loan_salary" value="<?php echo $row['loan_salary'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>No HP/WA</label>
                    <input type="number" class="form-control" name="loan_phone" value="<?php echo $row['employee_phone'] ?>" readonly>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Kategori</label>
                    <input type="hidden" class="form-control" name="loan_purpose" value="<?php echo $row['loan_purpose'] ?>" readonly>
                    <select class="form-control selectpicker" id="selectid" data-live-search="true" disabled>
                        <option value="Musibah" <?php if($row['loan_purpose'] == 'Musibah') echo 'selected'; ?>>Musibah (Sakit keluarga, Kematian, Kebakaran dll)</option>
                        <option value="Pendidikan Sekolah Keluarga Inti" <?php if($row['loan_purpose'] == 'Pendidikan Sekolah Keluarga Inti') echo 'selected'; ?>>Pendidikan Sekolah Keluarga Inti (Pribadi, Anak, Istri)</option>
                        <option value="Pendidikan Sekolah Keluarga Non Inti" <?php if($row['loan_purpose'] == 'Pendidikan Sekolah Keluarga Non Inti') echo 'selected'; ?>>Pendidikan Sekolah Keluarga Non Inti</option>
                        <option value="Pernikahan atau Khitan Anak" <?php if($row['loan_purpose'] == 'Pernikahan atau Khitan Anak') echo 'selected'; ?>>Pernikahan, Khitan Anak</option>
                        <option value="Sewa Rumah" <?php if($row['loan_purpose'] == 'Sewa Rumah') echo 'selected'; ?>>Sewa Rumah (Sewa Baru atau Perpanjangan)</option>
                        <option value="Kredit Pemilikan Rumah" <?php if($row['loan_purpose'] == 'Kredit Pemilikan Rumah') echo 'selected'; ?>>Kredit Pemilikan Rumah</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Deskripsi</label>
                    <textarea class="form-control" name="loan_description" readonly><?php echo $row['loan_description']; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Maksimal Pinjaman</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="text" class="form-control" name="loan_max" id="maksimal" value="<?php echo $row['loan_max']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Pinjaman</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="loan_amount" id="amount" min="1" max="" value="<?php echo $row['loan_amount']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Jangka Waktu</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" name="loan_tenor" id="tenor" max="10" min="1" value="<?php echo $row['loan_tenor']; ?>" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">Month</div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Bayar Perbulan</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="text" class="form-control" name="loan_paypermonth" id="installment" value="<?php echo $row['loan_paypermonth']; ?>" readonly>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="loan_status" data-live-search="true" id="seeAnotherField" required>
                        <option value="Waiting for Approval" <?php if ($row['loan_status'] == 'SPV Approved') echo 'selected'; ?>>SPV APPROVED</option>
                        <option value="Approved" <?php if ($row['loan_status'] == 'Approved') echo 'selected'; ?>>APPROVE</option>
                        <option value="Pending" <?php if ($row['loan_status'] == 'Pending') echo 'selected'; ?>>PENDING</option>
                        <option value="Declined" <?php if ($row['loan_status'] == 'Declined') echo 'selected'; ?>>DECLINE</option>
                    </select>
                </div>
                <div class="form-group col-md-6" id="note">
                    <label>Note</label>
                    <textarea class="form-control" name="loan_note" rows="3"><?php echo $row['loan_note'] ?></textarea>
                </div>
                <div class="form-group col-md-6" id="realisasi">
                    <label class="required">Tanggal Realisasi</label>
                    <input type="date" class="form-control" name="loan_realization">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <br><button type="submit" class="btn btn-info">Apply</button>
                    </div>
                </div>
            </div>              
<?php 
        echo form_close(); 
    endforeach;
?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#selectid').on('change', function() {
            if(document.getElementById('selectid').value == "Musibah") {    
                maksimal = <?php echo $emp->row()->employee_salary ?> * 3;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            } else if(document.getElementById('selectid').value == "Pendidikan Sekolah Keluarga Inti") {    
                maksimal = <?php echo $emp->row()->employee_salary ?> * 3;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            } else if(document.getElementById('selectid').value == "Pendidikan Sekolah Keluarga Non Inti") {    
                maksimal = <?php echo $emp->row()->employee_salary ?> * 2;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            } else if(document.getElementById('selectid').value == "Pernikahan atau Khitan Anak") {    
                maksimal = <?php echo $emp->row()->employee_salary ?> * 3;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            } else if(document.getElementById('selectid').value == "Sewa Rumah") {    
                maksimal = <?php echo $emp->row()->employee_salary ?> * 3;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            } else if(document.getElementById('selectid').value == "Kredit Pemilikan Rumah") {    
                maksimal = <?php echo $emp->row()->employee_salary ?> * 5;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            } else {
                maksimal = 0;
                $("#maksimal").val(maksimal);
                document.getElementById('amount').setAttribute('max', maksimal);
            }
        });

        $("#tenor").keyup(function(){
            installment = $("#amount").val() / $("#tenor").val();
            $("#installment").val(installment);
        });

        $("#amount").keyup(function(){
            installment = $("#amount").val() / $("#tenor").val();
            $("#installment").val(installment);
        });
    });
</script>

<script>
    $('.selectpicker').selectpicker('render')
</script>

<script>
    $('#realisasi').hide();
    $('#note').hide();
    
    $("#seeAnotherField").change(function() {
        if ($(this).val() == "Approved") {
            $('#realisasi').show();
            $('#note').hide();
        } else if ($(this).val() == "Pending" || $(this).val() == "Declined") {
            $('#realisasi').hide();
            $('#note').show();
        } else {
            $('#realisasi').hide();
            $('#note').hide();
        }
    });
    $("#seeAnotherField").trigger("change");
</script>