<?php
    $this->db->from('employee');
    $this->db->join('section', 'employee.section_code = section.section_code');
    $this->db->where('nik', $this->session->userdata('login_nik'));
    $emp = $this->db->get();
    // $emp = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')));

    foreach($emp->result_array() as $row):
        echo form_open(site_url('employee/loan/create'), array('enctype' => 'multipart/form-data')); 
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
                        <input type="number" class="form-control" name="loan_salary" value="<?php echo $row['employee_salary'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>No HP/WA</label>
                    <input type="number" class="form-control" name="loan_phone" value="<?php echo $row['employee_phone'] ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Kategori</label>
                    <select class="form-control selectpicker" name="loan_purpose" id="selectid" data-live-search="true" required>
                        <option value="" selected>-- Pilih Kategori --</option>
                        <option value="Musibah">Musibah (Sakit keluarga, Kematian, Kebakaran dll)</option>
                        <option value="Pendidikan Sekolah Keluarga Inti">Pendidikan Sekolah Keluarga Inti (Pribadi, Anak, Istri)</option>
                        <option value="Pendidikan Sekolah Keluarga Non Inti">Pendidikan Sekolah Keluarga Non Inti</option>
                        <option value="Pernikahan atau Khitan Anak">Pernikahan, Khitan Anak</option>
                        <option value="Sewa Rumah">Sewa Rumah (Sewa Baru atau Perpanjangan)</option>
                        <option value="Kredit Pemilikan Rumah">Kredit Pemilikan Rumah</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Deskripsi</label>
                    <textarea class="form-control" name="loan_description" required></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Maksimal Pinjaman</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="text" class="form-control" name="loan_max" id="maksimal" readonly>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Jumlah Pinjaman</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="loan_amount" id="amount" min="1" max="" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Jangka Waktu</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" name="loan_tenor" id="tenor" max="10" min="1" value="10" required>
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
                        <input type="text" class="form-control" name="loan_paypermonth" id="installment" readonly>
                    </div>
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