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

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
            <?php  echo form_open(site_url('humancapital/employee/create'), array('enctype' => 'multipart/form-data')); ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Personal Data</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="required">NIK</label>
                        <input type="text" class="form-control" name="nik" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>NPWP</label>
                        <input type="text" class="form-control" name="employee_npwp">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Full Name</label>
                        <input type="text" class="form-control" name="employee_name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="required">KTP</label>
                        <input type="number" class="form-control" name="employee_ktp" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>KTP Expire Date</label>
                        <div class="row">
                            <div class="col-md-7">
                                <input type="date" class="form-control" name="employee_ktpexpire" id="txt_employee_ktpexpire" disabled>
                            </div>
                            <div class="col-md-5">
                                <div class="form-check" style="margin-top: 7px;">
                                    <input class="form-check-input" type="checkbox" value="SEUMUR HIDUP" name="employee_ktpexpire" id="chk_employee_ktpexpire" checked>
                                    <label class="form-check-label">SEUMUR HIDUP</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Birth Place</label>
                        <input type="text" class="form-control" name="employee_birthplace" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Birth Date</label>
                        <input type="date" class="form-control" name="employee_birthdate" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>BPJS Kesehatan</label>
                        <input type="number" class="form-control" name="employee_bpjskesehatan">
                    </div>
                    <div class="form-group col-md-3">
                        <label>BPJS Ketenagakerjaan</label>
                        <input type="number" class="form-control" name="employee_bpjsketenagakerjaan">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Gender</label>
                        <select class="form-control selectpicker" name="employee_gender" data-live-search="true" required>
                            <option value="" selected>-- Choose Gender --</option>
                            <option value="L">LAKI-LAKI</option>
                            <option value="P">PEREMPUAN</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Religion</label>
                        <select class="form-control selectpicker" name="employee_religion" data-live-search="true" required>
                            <option value="" selected>-- Choose Religion --</option>
                            <option value="ISLAM">ISLAM</option>
                            <option value="KRISTEN">KRISTEN</option>
                            <option value="KATOLIK">KATOLIK</option>
                            <option value="HINDU">HINDU</option>
                            <option value="BUDHA">BUDHA</option>
                            <option value="KON HU CU">KON HU CU</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="required">Marital Status</label>
                        <select class="form-control selectpicker" name="employee_marital" data-live-search="true" required>
                            <option value="" selected>-- Choose Marital Status --</option>
                            <option value="D/0">D/0</option>
                            <option value="D/1">D/1</option>
                            <option value="D/2">D/2</option>
                            <option value="K">K</option>
                            <option value="K/0">K/0</option>
                            <option value="K/1">K/1</option>
                            <option value="K/2">K/2</option>
                            <option value="K/3">K/3</option>
                            <option value="TK">TK</option>
                            <option value="TK/0">TK/0</option>
                            <option value="TK/1">TK/1</option>
                            <option value="TK/2">TK/2</option>
                            <option value="TK/3">TK/3</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Bank Number</label>
                        <input type="number" class="form-control" name="employee_banknumber" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Phone</label>
                        <input type="number" class="form-control" name="employee_phone" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Phone 2</label>
                        <input type="number" class="form-control" name="employee_phone2">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="required">Education</label>
                        <select class="form-control selectpicker" name="employee_education" data-live-search="true" required>
                            <option value="" selected>-- Choose Education --</option>
                            <option value="SLTP SEDERAJAT">SLTP SEDERAJAT</option>
                            <option value="SMU SEDERAJAT">SMU SEDERAJAT</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">School/University</label>
                        <input type="text" class="form-control" name="employee_university" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Major</label>
                        <input type="text" class="form-control" name="employee_major">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Address City</label>
                        <input type="text" class="form-control" name="employee_city" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="required">Address</label>
                        <textarea class="form-control" rows="3" name="employee_address" required></textarea>
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
                        <input type="date" class="form-control" name="employee_join" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Status</label>
                        <select class="form-control selectpicker" name="employee_status" data-live-search="true" required>
                            <option value="" selected>-- Choose Status --</option>
                            <option value="FREELANCE">FREELANCE</option>
                            <option value="HS 2020">HS 2020</option>
                            <option value="MITRA">MITRA</option>
                            <option value="PKWT1">PKWT1</option>
                            <option value="PKWT2">PKWT2</option>
                            <option value="SOS">SOS</option>
                            <option value="TETAP">TETAP</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Level</label>
                        <select class="form-control selectpicker" name="employee_level" data-live-search="true" required>
                            <option value="" selected>-- Choose Level --</option>
                            <option value="BRANCH MANAGER">BRANCH MANAGER</option>
                            <option value="DEPUTY BRANCH HEAD">DEPUTY BRANCH HEAD</option>
                            <option value="JUNIOR SUPERVISOR">JUNIOR SUPERVISOR</option>
                            <option value="JUNIOR SUPERVISOR (PIC)">JUNIOR SUPERVISOR (PIC)</option>
                            <option value="KOORDINATOR">KOORDINATOR</option>
                            <option value="KOORDINATOR (PIC)">KOORDINATOR (PIC)</option>
                            <option value="PJS KOORDINATOR">PJS KOORDINATOR</option>
                            <option value="STAFF">STAFF</option>
                            <option value="STAFF (PIC)">STAFF (PIC)</option>
                            <option value="SUPERVISOR">SUPERVISOR</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Type</label>
                        <select class="form-control selectpicker" name="employee_type" data-live-search="true" required>
                            <option value="" selected>-- Choose Type --</option>
                            <option value="BO">BO</option>
                            <option value="CS">CS</option>
                            <option value="OPS">OPS</option>
                            <option value="SALES">SALES</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="required">Position</label>
                        <input type="text" class="form-control" name="employee_position" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Department</label>
                        <select class="form-control selectpicker" name="section_code" id="section_code" data-live-search="true" required>
                            <option value="" selected>-- Choose Department --</option>
                            <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                foreach ($section_code as $row1): ?>
                                    <option value="<?php echo $row1['section_code']; ?>"><?php echo $row1['section_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Unit</label>
                        <select class="form-control selectpicker" name="unit_code" id="unit_code" data-live-search="true" required>
                            <option value="">-- Choose Unit --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Regional</label>
                        <select class="form-control selectpicker" name="regional_code" id="regional_code" data-live-search="true" required>
                            <option value="" selected>-- Choose Regional --</option>
                            <?php $regional = $this->db->get('regional')->result_array();
                                foreach ($regional as $row3): ?>
                                    <option value="<?php echo $row3['regional_code']; ?>"><?php echo $row3['regional_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row"> 
                    <div class="form-group col-md-3">
                        <label class="required">Branch</label>
                        <select class="form-control selectpicker" name="branch_code" id="branch_code" data-live-search="true" required>
                            <option value="">-- Choose Branch --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Origin</label>
                        <select class="form-control selectpicker" name="origin_code" id="origin_code" data-live-search="true" required>
                            <option value="">-- Choose Origin --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Zone</label>
                        <select class="form-control selectpicker" name="zone_code" id="zone_code" data-live-search="true" required>
                            <option value="">-- Choose Zone --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Orion ID</label>
                        <input type="text" class="form-control" name="orion_id">
                    </div>
                </div>
                <div class="form-row"> 
                    <div class="form-group col-md-3">
                        <label>Courier ID</label>
                        <input type="text" class="form-control" name="courier_id">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Area</label>
                        <input type="text" class="form-control" name="employee_area">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Zona</label>
                        <input type="text" class="form-control" name="employee_zona">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <hr><label>Profile Photo</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">(3x4 Formal, max : 500kb) .jpg</label>
                    <div class="col-sm-5">
                        <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-bottom: 0px;">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 200px; margin-left: 20px; margin-top: 5px; margin-bottom: 5px; outline: 1px dashed #1C6EA4; outline-offset: 7px;" data-trigger="fileinput">
                                <img src="http://placehold.it/300x400" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 200px; margin-left: 20px; margin-top: 5px; margin-bottom: 5px; outline: 1px dashed #1C6EA4; outline-offset: 7px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new btn btn-dark">Select image</span>
                                    <span class="fileinput-exists btn btn-warning">Change</span>
                                    <input type="file" id="uploadfile" name="userfile" accept=".jpg">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <!-- /.card-footer-->
            <?php echo form_close(); ?> 
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
        var uploadField = document.getElementById("photo");

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