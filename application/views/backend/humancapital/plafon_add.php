<?php echo form_open(site_url('humancapital/plafon/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Employee</label>
            <select class="form-control selectpicker" name="nik" id="nik" data-live-search="true" required>
                <option value="" selected>-- Choose Employee --</option>
                <?php 
                    $this->db->from('employee');
                    $this->db->join('section', 'employee.section_code = section.section_code');
                    $this->db->where('employee_status !=', 'Resign');
                    $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                    $nik = $this->db->get();

                    foreach ($nik->result_array() as $row1): ?>
                        <option value="<?php echo $row1['nik']; ?>" data-subtext="<?php echo $row1['section_name']; ?>"><?php echo $row1['employee_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Periode</label>
            <select class="form-control selectpicker" name="plafon_periode" data-live-search="true" required>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020" selected>2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Rawat Inap</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="plafon_rawatinap" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Rawat Jalan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="plafon_rawatjalan" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Persalinan Normal</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="plafon_melahirkannormal" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Persalinan Sectio</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="plafon_melahirkansectio" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Set Kacamata</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="plafon_setkacamata" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Lensa</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" name="plafon_lensa" required>
            </div>
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
