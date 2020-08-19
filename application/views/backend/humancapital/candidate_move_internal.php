<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $page_title;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $page_title;?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
            // $this->db->select('application.*, vacancy.*, employee.nik, employee.ktp, employee.kk, employee.bpjs, employee.npwp, employee.employee_name, employee.employee_name,  employee.employee_email, employee.employee_phone, employee.employee_birthplace, employee.employee_birthdate, employee.employee_gender, employee.employee_religion, employee.employee_maritalstatus, employee.employee_bloodtype, employee.employee_weight, employee.employee_height,  employee.employee_bankaccountname, employee.employee_bankaccountnumber, employee.employee_ktpcity, employee.employee_ktpaddress, employee.employee_domicilecity, employee.employee_domicileaddress, employee.employee_status, employee.employee_join, employee.regional_code, employee.branch_code, employee.origin_code, employee.zone_code');
            $this->db->from('employee');
            $this->db->join('application', 'employee.nik = application.nik');
            $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
            $this->db->where('employee.nik', $nik);
            $candidate = $this->db->get();
            foreach ($candidate->result_array() as $row):
                echo form_open(site_url('humancapital/candidate/move_data_internal/'.$nik), array('enctype' => 'multipart/form-data')); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Personal Data</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="required">NIK</label>
                                    <input type="text" class="form-control" name="nik" value="<?php echo $row['nik']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>NPWP</label>
                                    <input type="text" class="form-control" name="employee_npwp" value="<?php echo $row['employee_npwp']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Full Name</label>
                                    <input type="text" class="form-control" name="employee_name" value="<?php echo $row['employee_name']; ?>" required>
                                </div>
                            </div>

                            <div class="form-row">  
                                <div class="form-group col-md-3">
                                    <label class="required">KTP</label>
                                    <input type="number" class="form-control" name="employee_ktp" value="<?php echo $row['employee_ktp']; ?>" required>
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
                                    <input type="text" class="form-control" name="employee_birthplace" value="<?php echo $row['employee_birthplace']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Birth Date</label>
                                    <input type="date" class="form-control" name="employee_birthdate" value="<?php echo $row['employee_birthdate']; ?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>BPJS Kesehatan</label>
                                    <input type="number" class="form-control" name="employee_bpjskesehatan" value="<?php echo $row['employee_bpjskesehatan']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>BPJS Ketenagakerjaan</label>
                                    <input type="number" class="form-control" name="employee_bpjsketenagakerjaan" value="<?php echo $row['employee_bpjsketenagakerjaan']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Gender</label>
                                    <select class="form-control selectpicker" name="employee_gender" data-live-search="true" required>
                                        <option value="L" <?php if ($row['employee_gender'] == 'L') echo 'selected'; ?>>LAKI-LAKI</option>
                                        <option value="P" <?php if ($row['employee_gender'] == 'P') echo 'selected'; ?>>PEREMPUAN</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Religion</label>
                                    <select class="form-control selectpicker" name="employee_religion" data-live-search="true" required>
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
                                    <select class="form-control selectpicker" name="employee_marital" data-live-search="true" required>
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
                                    <input type="number" class="form-control" name="employee_banknumber" value="<?php echo $row['employee_banknumber']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Phone</label>
                                    <input type="number" class="form-control" name="employee_phone" value="<?php echo $row['employee_phone']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Phone 2</label>
                                    <input type="number" class="form-control" name="employee_phone2" value="<?php echo $row['employee_phone2']; ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="required">Education</label>
                                    <select class="form-control selectpicker" name="employee_education" data-live-search="true" required>
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
                                    <input type="text" class="form-control" name="employee_university" value="<?php echo $row['employee_university']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Major</label>
                                    <input type="text" class="form-control" name="employee_major" value="<?php echo $row['employee_major']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Address City</label>
                                    <input type="text" class="form-control" name="employee_city" value="<?php echo $row['employee_city']; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="required">Address</label>
                                    <textarea class="form-control" rows="3" name="employee_address" required><?php echo $row['employee_address']; ?></textarea>
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
                                    <input type="date" class="form-control" name="employee_join" value="<?php echo $row['employee_join']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Status</label>
                                    <select class="form-control selectpicker" name="employee_status" data-live-search="true" required>
                                        <option value="FREELANCE" <?php if ($row['employee_status'] == 'FREELANCE') echo 'selected'; ?>>FREELANCE</option>
                                        <option value="HS 2020" <?php if ($row['employee_status'] == 'HS 2020') echo 'selected'; ?>>HS 2020</option>
                                        <option value="MITRA" <?php if ($row['employee_status'] == 'MITRA') echo 'selected'; ?>>MITRA</option>
                                        <option value="PKWT1" <?php if ($row['employee_status'] == 'PKWT1') echo 'selected'; ?>>PKWT1</option>
                                        <option value="PKWT2" <?php if ($row['employee_status'] == 'PKWT2') echo 'selected'; ?>>PKWT2</option>
                                        <option value="SOS" <?php if ($row['employee_status'] == 'SOS') echo 'selected'; ?>>SOS</option>
                                        <option value="TETAP" <?php if ($row['employee_status'] == 'TETAP') echo 'selected'; ?>>TETAP</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Level</label>
                                    <select class="form-control selectpicker" name="employee_level" data-live-search="true" required>
                                        <option value="BRANCH MANAGER" <?php if ($row['vacancy_level'] == 'BRANCH MANAGER') echo 'selected'; ?>>BRANCH MANAGER</option>
                                        <option value="DEPUTY BRANCH HEAD" <?php if ($row['vacancy_level'] == 'DEPUTY BRANCH HEAD') echo 'selected'; ?>>DEPUTY BRANCH HEAD</option>
                                        <option value="JUNIOR SUPERVISOR" <?php if ($row['vacancy_level'] == 'JUNIOR SUPERVISOR') echo 'selected'; ?>>JUNIOR SUPERVISOR</option>
                                        <option value="JUNIOR SUPERVISOR (PIC)" <?php if ($row['vacancy_level'] == 'JUNIOR SUPERVISOR (PIC)') echo 'selected'; ?>>JUNIOR SUPERVISOR (PIC)</option>
                                        <option value="KOORDINATOR" <?php if ($row['vacancy_level'] == 'KOORDINATOR') echo 'selected'; ?>>KOORDINATOR</option>
                                        <option value="KOORDINATOR (PIC)" <?php if ($row['vacancy_level'] == 'KOORDINATOR (PIC)') echo 'selected'; ?>>KOORDINATOR (PIC)</option>
                                        <option value="PJS KOORDINATOR" <?php if ($row['vacancy_level'] == 'PJS KOORDINATOR') echo 'selected'; ?>>PJS KOORDINATOR</option>
                                        <option value="STAFF" <?php if ($row['vacancy_level'] == 'STAFF') echo 'selected'; ?>>STAFF</option>
                                        <option value="STAFF (PIC)" <?php if ($row['vacancy_level'] == 'STAFF (PIC)') echo 'selected'; ?>>STAFF (PIC)</option>
                                        <option value="SUPERVISOR" <?php if ($row['vacancy_level'] == 'SUPERVISOR') echo 'selected'; ?>>SUPERVISOR</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Type</label>
                                    <select class="form-control selectpicker" name="employee_type" data-live-search="true" required>
                                        <option value="BO" <?php if ($row['employee_type'] == 'BO') echo 'selected'; ?>>BO</option>
                                        <option value="CS" <?php if ($row['employee_type'] == 'CS') echo 'selected'; ?>>CS</option>
                                        <option value="OPS" <?php if ($row['employee_type'] == 'OPS') echo 'selected'; ?>>OPS</option>
                                        <option value="SALES" <?php if ($row['employee_type'] == 'SALES') echo 'selected'; ?>>SALES</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="required">Position</label>
                                    <input type="text" class="form-control" name="employee_position" value="<?php echo $row['vacancy_position']; ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Department</label>
                                    <select class="form-control selectpicker" name="section_code" id="section_code" data-live-search="true" required>
                                        <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                            foreach ($section_code as $row1): ?>
                                                <option value="<?php echo $row1['section_code']; ?>" <?php if($row['vacancy_section'] == $row1['section_code']) echo 'selected'; ?>><?php echo $row1['section_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Unit</label>
                                    <select class="form-control selectpicker" name="unit_code" id="unit_code" data-live-search="true" required>
                                        <?php 
                                            $this->db->from('section');
                                            $this->db->join('unit', 'section.section_code = unit.section_code');
                                            $unit_code = $this->db->get();
                                            foreach ($unit_code->result_array() as $row1): ?>
                                                <option value="<?php echo $row1['unit_code']; ?>" data-subtext="<?php echo $row1['section_name']; ?>" <?php if($row['vacancy_unit'] == $row1['unit_code']) echo 'selected'; ?>><?php echo $row1['unit_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Regional</label>
                                    <select class="form-control selectpicker" name="regional_code" id="regional_code" data-live-search="true" required>
                                        <?php $regional = $this->db->get('regional')->result_array();
                                            foreach ($regional as $row1): ?>
                                                <option value="<?php echo $row1['regional_code']; ?>" <?php if($row['regional_code'] == $row1['regional_code']) echo 'selected'; ?>><?php echo $row1['regional_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">  
                                <div class="form-group col-md-3">
                                    <label class="required">Branch</label>
                                    <select class="form-control selectpicker" name="branch_code" id="branch_code" data-live-search="true" required>
                                        <?php $branch_code = $this->db->get('branch')->result_array();
                                            foreach ($branch_code as $row1): ?>
                                                <option value="<?php echo $row1['branch_code']; ?>" <?php if($row['branch_code'] == $row1['branch_code']) echo 'selected'; ?>><?php echo $row1['branch_desc']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Origin</label>
                                    <select class="form-control selectpicker" name="origin_code" id="origin_code" data-live-search="true" required>
                                        <?php $origin_code = $this->db->get('origin')->result_array();
                                            foreach ($origin_code as $row1): ?>
                                                <option value="<?php echo $row1['origin_code']; ?>" <?php if($row['origin_code'] == $row1['origin_code']) echo 'selected'; ?>><?php echo $row1['origin_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="required">Zone</label>
                                    <select class="form-control selectpicker" name="zone_code" id="zone_code" data-live-search="true" required>
                                        <?php $zone_code = $this->db->get('zone')->result_array();
                                            foreach ($zone_code as $row1): ?>
                                                <option value="<?php echo $row1['zone_code']; ?>" <?php if($row['zone_code'] == $row1['zone_code']) echo 'selected'; ?>><?php echo $row1['zone_desc']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Orion ID</label>
                                    <input type="text" class="form-control" name="orion_id" value="<?php echo $row['orion_id']; ?>">
                                </div>
                            </div>
                            <div class="form-row"> 
                                <div class="form-group col-md-3">
                                    <label>Courier ID</label>
                                    <input type="text" class="form-control" name="courier_id" value="<?php echo $row['courier_id']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Area</label>
                                    <input type="text" class="form-control" name="employee_area" value="<?php echo $row['employee_area']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Zona</label>
                                    <input type="text" class="form-control" name="employee_zona" value="<?php echo $row['employee_zona']; ?>">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
        <?php 
                echo form_close(); 
            endforeach;
        ?> 
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    var uploadField = document.getElementById("photo");

    uploadField.onchange = function() {
        if(this.files[0].size > 500000){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>

<script type="text/javascript">
		$(document).ready(function(){

			$('#section_code').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('humancapital/get_unit');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '<option value="">-- Choose Unit --</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].unit_code+'>'+data[i].unit_name+'</option>';
                        }
                        $('#unit_code').html(html);
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
                return false;
            }); 

            $('#regional_code').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('humancapital/get_branch');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '<option value="">-- Choose Branch --</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].branch_code+'>'+data[i].branch_desc+'</option>';
                        }
                        $('#branch_code').html(html);
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
                return false;
            }); 

            $('#branch_code').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('humancapital/get_origin');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '<option value="">-- Choose Origin --</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].origin_code+'>'+data[i].origin_name+'</option>';
                        }
                        $('#origin_code').html(html);
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
                return false;
            }); 

            $('#origin_code').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('humancapital/get_zone');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '<option value="">-- Choose Zone --</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].zone_code+'>'+data[i].zone_desc+'</option>';
                        }
                        $('#zone_code').html(html);
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
                return false;
            }); 
            
		});
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