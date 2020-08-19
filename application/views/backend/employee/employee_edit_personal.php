<div class="form-row">
    <div class="form-group col-md-12">
        <label>Personal Data</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">NIK</label>
        <input type="text" class="form-control border border-danger" name="nik" value="<?php echo $row['nik']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label>NPWP</label>
        <input type="text" class="form-control border border-success" name="employee_npwp" value="<?php echo $row['employee_npwp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label class="required">Full Name</label>
        <input type="text" class="form-control border border-success" name="employee_name" value="<?php echo $row['employee_name']; ?>" required>
    </div>
</div>

<div class="form-row">  
    <div class="form-group col-md-3">
        <label class="required">KTP</label>
        <input type="number" class="form-control border border-success" name="employee_ktp" value="<?php echo $row['employee_ktp']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label>KTP Expire Date</label>
        <div class="row">
            <div class="col-md-7">
                <input type="date" class="form-control border border-success" name="employee_ktpexpire" value="<?php echo $row['employee_ktpexpire']; ?>" id="txt_employee_ktpexpire" <?php if ($row['employee_ktpexpire'] == 'SEUMUR HIDUP') echo 'disabled'; ?>>
            </div>
            <div class="col-md-5">
                <div class="form-check" style="margin-top: 7px;">
                    <input class="form-check-input" type="checkbox" value="SEUMUR HIDUP" name="employee_ktpexpire" id="chk_employee_ktpexpire" <?php if ($row['employee_ktpexpire'] == 'SEUMUR HIDUP') echo 'checked'; ?>>
                    <label class="form-check-label">SEUMUR HIDUP</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Birth Place</label>
        <input type="text" class="form-control border border-success" name="employee_birthplace" value="<?php echo $row['employee_birthplace']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Birth Date</label>
        <input type="date" class="form-control border border-success" name="employee_birthdate" value="<?php echo $row['employee_birthdate']; ?>" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label>BPJS Kesehatan</label>
        <input type="number" class="form-control border border-success" name="employee_bpjskesehatan" value="<?php echo $row['employee_bpjskesehatan']; ?>">
    </div>
    <div class="form-group col-md-3">
        <label>BPJS Ketenagakerjaan</label>
        <input type="number" class="form-control border border-success" name="employee_bpjsketenagakerjaan" value="<?php echo $row['employee_bpjsketenagakerjaan']; ?>">
    </div>
    <div class="form-group col-md-3">
        <label class="required">Gender</label>
        <select class="form-control selectpicker border border-success" name="employee_gender" data-live-search="true" required>
            <option value="L" <?php if ($row['employee_gender'] == 'L') echo 'selected'; ?>>LAKI-LAKI</option>
            <option value="P" <?php if ($row['employee_gender'] == 'P') echo 'selected'; ?>>PEREMPUAN</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Religion</label>
        <select class="form-control selectpicker border border-success" name="employee_religion" data-live-search="true" required>
            <option value="ISLAM" <?php if ($row['employee_religion'] == 'ISLAM') echo 'selected'; ?>>ISLAM</option>
            <option value="KRISTEN" <?php if ($row['employee_religion'] == 'KRISTEN') echo 'selected'; ?>>KRISTEN</option>
            <option value="KATOLIK" <?php if ($row['employee_religion'] == 'KATOLIK') echo 'selected'; ?>>KATOLIK</option>
            <option value="HINDU" <?php if ($row['employee_religion'] == 'HINDU') echo 'selected'; ?>>HINDU</option>
            <option value="BUDHA" <?php if ($row['employee_religion'] == 'BUDHA') echo 'selected'; ?>>BUDHA</option>
            <option value="KON HU CU" <?php if ($row['employee_religion'] == 'KON HU CU') echo 'selected'; ?>>KON HU CU</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">Marital Status</label>
        <select class="form-control selectpicker border border-success" name="employee_marital" data-live-search="true" required>
            <option value="D/0" <?php if ($row['employee_marital'] == 'D/0') echo 'selected'; ?>>D/0</option>
            <option value="D/1" <?php if ($row['employee_marital'] == 'D/1') echo 'selected'; ?>>D/1</option>
            <option value="D/2" <?php if ($row['employee_marital'] == 'D/2') echo 'selected'; ?>>D/2</option>
            <option value="K" <?php if ($row['employee_marital'] == 'K') echo 'selected'; ?>>K</option>
            <option value="K/0" <?php if ($row['employee_marital'] == 'K/0') echo 'selected'; ?>>K/0</option>
            <option value="K/1" <?php if ($row['employee_marital'] == 'K/1') echo 'selected'; ?>>K/1</option>
            <option value="K/2" <?php if ($row['employee_marital'] == 'K/2') echo 'selected'; ?>>K/2</option>
            <option value="K/3" <?php if ($row['employee_marital'] == 'K/3') echo 'selected'; ?>>K/3</option>
            <option value="TK" <?php if ($row['employee_marital'] == 'TK') echo 'selected'; ?>>TK</option>
            <option value="TK/0" <?php if ($row['employee_marital'] == 'TK/0') echo 'selected'; ?>>TK/0</option>
            <option value="TK/1" <?php if ($row['employee_marital'] == 'TK/1') echo 'selected'; ?>>TK/1</option>
            <option value="TK/2" <?php if ($row['employee_marital'] == 'TK/2') echo 'selected'; ?>>TK/2</option>
            <option value="TK/3" <?php if ($row['employee_marital'] == 'TK/3') echo 'selected'; ?>>TK/3</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Bank Number</label>
        <input type="number" class="form-control border border-danger" name="employee_banknumber" value="<?php echo $row['employee_banknumber']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Phone</label>
        <input type="number" class="form-control border border-success" name="employee_phone" value="<?php echo $row['employee_phone']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label>Phone 2</label>
        <input type="number" class="form-control border border-success" name="employee_phone2" value="<?php echo $row['employee_phone2']; ?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">Education</label>
        <select class="form-control selectpicker border border-success" name="employee_education" data-live-search="true" required>
            <option value="SLTP SEDERAJAT" <?php if ($row['employee_education'] == 'SLTP SEDERAJAT') echo 'selected'; ?>>SLTP SEDERAJAT</option>
            <option value="SMU SEDERAJAT" <?php if ($row['employee_education'] == 'SMU SEDERAJAT') echo 'selected'; ?>>SMU SEDERAJAT</option>
            <option value="D1" <?php if ($row['employee_education'] == 'D1') echo 'selected'; ?>>D1</option>
            <option value="D2" <?php if ($row['employee_education'] == 'D2') echo 'selected'; ?>>D2</option>
            <option value="D3" <?php if ($row['employee_education'] == 'D3') echo 'selected'; ?>>D3</option>
            <option value="D4" <?php if ($row['employee_education'] == 'D4') echo 'selected'; ?>>D4</option>
            <option value="S1" <?php if ($row['employee_education'] == 'S1') echo 'selected'; ?>>S1</option>
            <option value="S2" <?php if ($row['employee_education'] == 'S2') echo 'selected'; ?>>S2</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="required">School/University</label>
        <input type="text" class="form-control border border-success" name="employee_university" value="<?php echo $row['employee_university']; ?>" required>
    </div>
    <div class="form-group col-md-3">
        <label>Major</label>
        <input type="text" class="form-control border border-success" name="employee_major" value="<?php echo $row['employee_major']; ?>">
    </div>
    <div class="form-group col-md-3">
        <label class="required">Address City</label>
        <input type="text" class="form-control border border-success" name="employee_city" value="<?php echo $row['employee_city']; ?>" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="required">Address</label>
        <textarea class="form-control border border-success" rows="3" name="employee_address" required><?php echo $row['employee_address']; ?></textarea>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <hr><label>Company Data</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">Join Date</label>
        <input type="text" class="form-control border border-danger" name="employee_join" value="<?php echo $row['employee_join']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Status</label>
        <input type="text" class="form-control border border-danger" name="employee_status" value="<?php echo $row['employee_status']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Level</label>
        <input type="text" class="form-control border border-danger" name="employee_level" value="<?php echo $row['employee_level']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Type</label>
        <input type="text" class="form-control border border-danger" name="employee_type" value="<?php echo $row['employee_type']; ?>" readonly>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label class="required">Position</label>
        <input type="text" class="form-control border border-danger" name="employee_position" value="<?php echo $row['employee_position']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Department</label>
        <input type="hidden" name="section_code" value="<?php echo $row['section_code']; ?>">
        <input type="text" class="form-control border border-danger" value="
        <?php 
                                            $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                            if($section->num_rows() > 0){
                                                echo $section->row()->section_name;
                                            } else {
                                                echo '';
                                            }
                                        ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Unit</label>
        <input type="hidden" name="unit_code" value="<?php echo $row['unit_code']; ?>">
        <input type="text" class="form-control border border-danger" value="<?php 
                                            $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code'])); 
                                            if($unit->num_rows() > 0){
                                                echo $unit->row()->unit_name;
                                            } else {
                                                echo '';
                                            }
                                        ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Regional</label>
        <input type="hidden" name="regional_code" value="<?php echo $row['regional_code']; ?>">
        <input type="text" class="form-control border border-danger" value="<?php 
                                            $regional = $this->db->get_where('regional', array('regional_code' => $row['regional_code']));
                                            if($regional->num_rows() > 0){
                                                echo $regional->row()->regional_name;
                                            } else {
                                                echo '';
                                            }
                                        ?>" readonly>
    </div>
</div>
<div class="form-row">  
    <div class="form-group col-md-3">
        <label class="required">Branch</label>
        <input type="hidden" name="branch_code" value="<?php echo $row['branch_code']; ?>">
        <input type="text" class="form-control border border-danger" value="<?php 
                                            $branch = $this->db->get_where('branch', array('branch_code' => $row['branch_code']));
                                            if($branch->num_rows() > 0){
                                                echo $branch->row()->branch_desc;
                                            } else {
                                                echo '';
                                            }
                                        ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Origin</label>
        <input type="hidden" name="origin_code" value="<?php echo $row['origin_code']; ?>">
        <input type="text" class="form-control border border-danger" value="<?php 
                                            $origin = $this->db->get_where('origin', array('origin_code' => $row['origin_code']));
                                            if($origin->num_rows() > 0){
                                                echo $origin->row()->origin_name;
                                            } else {
                                                echo '';
                                            }
                                        ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label class="required">Zone</label>
        <input type="hidden" name="zone_code" value="<?php echo $row['zone_code']; ?>">
        <input type="text" class="form-control border border-danger" value="<?php 
                                            $zone = $this->db->get_where('zone', array('zone_code' => $row['zone_code']));
                                            if($zone->num_rows() > 0){
                                                echo $zone->row()->zone_desc;
                                            } else {
                                                echo '';
                                            }
                                        ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label>Orion ID</label>
        <input type="text" class="form-control border border-danger" name="orion_id" value="<?php echo $row['orion_id']; ?>" readonly>
    </div>
</div>
<div class="form-row"> 
    <div class="form-group col-md-3">
        <label>Courier ID</label>
        <input type="text" class="form-control border border-danger" name="courier_id" value="<?php echo $row['courier_id']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label>Area</label>
        <input type="text" class="form-control border border-danger" name="employee_area" value="<?php echo $row['employee_area']; ?>" readonly>
    </div>
    <div class="form-group col-md-3">
        <label>Zona</label>
        <input type="text" class="form-control border border-danger" name="employee_zona" value="<?php echo $row['employee_zona']; ?>" readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <hr><label>Profile Photo</label>
    </div>
</div>

<div class="form-group">
    <label for="field-1" class="col-sm-3 control-label">(3x4 Formal, max : 500kb) .jpg</label>
    <div class="col-sm-8">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 150px; height: 200px; margin-left: 20px; margin-top: 5px; margin-bottom: 5px; outline: 1px dashed #1C6EA4; outline-offset: 7px;" data-trigger="fileinput">
                <?php if (file_exists('uploads/employee_image/' . $row['nik'] . '.jpg')): ?>
                    <img src="<?php echo base_url();?>uploads/employee_image/<?php echo $row['nik']; ?>.jpg" alt="...">
                <?php endif; ?>
                <?php if (!(file_exists('uploads/employee_image/' . $row['nik'] . '.jpg'))): ?>
                    <img src="http://placehold.it/300x400" alt="...">
                <?php endif; ?>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 200px; margin-left: 20px; margin-top: 5px; margin-bottom: 5px; outline: 1px dashed #1C6EA4; outline-offset: 7px;"></div>
            <div>
                <span class="btn btn-white btn-file">
                    <span class="fileinput-new btn btn-dark">Select Image</span>
                    <span class="fileinput-exists btn btn-warning">Change</span>
                    <input type="file" name="userfile" id="uploadfile" accept=".jpg">
                </span>
                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-1">
        <button type="submit" class="btn btn-primary btn-block">Save</button>
    </div>
    <div class="form-group col-md-1">
        <a href="<?php echo site_url('humancapital/employee/list'); ?>" class="btn btn-warning btn-block">Cancel</a>
    </div>
    <div class="form-group col-md-9"></div>
    <!-- <div class="form-group col-md-1" style="text-align: right;">
        <button type="submit" class="btn btn-danger btn-block"><i class="nav-icon fas fa-user-minus"></i>&nbsp;&nbsp;&nbsp;Resign</button>
    </div> -->
</div>

<script type="text/javascript">
    var uploadField = document.getElementById("uploadfile");

    uploadField.onchange = function() {
        if(this.files[0].size > 500000){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>

<script type="text/javascript">
    $('#chk_employee_ktpexpire').click(function(){
        if($(this).is(':checked')){
            $('#txt_employee_ktpexpire').attr("disabled", true);
        } else{
            $('#txt_employee_ktpexpire').attr("disabled", false);
        }
    });
</script>