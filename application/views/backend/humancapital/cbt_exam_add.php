<?php echo form_open(site_url('humancapital/exam/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Nama Ujian</label>
            <input type="text" class="form-control" name="exam_name" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Paket Soal</label>
            <select class="form-control selectpicker" name="questionpack_id" data-live-search="true" required>
                <option value="" selected>-- Pilih Paket Soal --</option>
                <?php $questionpack = $this->db->get_where('cbt_questionpack', array('questionpack_status' => 'Approved', 'branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($questionpack as $row1): ?>
                        <option value="<?php echo $row1['questionpack_id']; ?>"><?php echo $row1['questionpack_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Waktu Mulai</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_start_date" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_start_time" required>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Waktu Selesai</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_end_date" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_end_time" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Peserta</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" id="seeAnotherField" required>
                <option value="" selected>-- Pilih Peserta --</option>
                <option value="ALL">SEMUA KARYAWAN</option>
                <option value="DEPARTMENT">DEPARTMENT TERTENTU</option>
                <option value="INDIVIDU">PILIH PERORANGAN</option>
            </select>
        </div>
    </div>

    <span id="designation">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Tambah Peserta</label>
                <select class="form-control selectpicker" name="nik[]" data-live-search="true">
                    <option value="" selected>-- Choose Employee --</option>
                    <?php 
                        $this->db->from('employee');
                        $this->db->join('section', 'employee.section_code = section.section_code');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                        $nik = $this->db->get();

                        foreach ($nik->result_array() as $row): ?>
                            <option value="<?php echo $row['nik']; ?>" data-subtext="<?php echo $row['section_name']; ?>"><?php echo $row['employee_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </span>
    <span id="designation_input">
        <div class="form-row">
            <div class="form-group col-md-10">
                <select class="form-control selectpicker" name="nik[]" data-live-search="true">
                    <option value="" selected>-- Choose Employee --</option>
                    <?php 
                        $this->db->from('employee');
                        $this->db->join('section', 'employee.section_code = section.section_code');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                        $nik = $this->db->get();

                        foreach ($nik->result_array() as $row): ?>
                            <option value="<?php echo $row['nik']; ?>" data-subtext="<?php echo $row['section_name']; ?>"><?php echo $row['employee_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </span>
    <div class="form-row" id="add">            
        <div class="form-group col-md-12">
            <button type="button" class="btn btn-default btn-sm btn-icon icon-right" onClick="add_designation()">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Employee
            </button>
        </div>
    </div>
    

    <span id="department">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Department</label>
                <select class="form-control selectpicker" name="section_code" data-live-search="true">
                    <option value="" selected>-- Pilih Department --</option>
                    <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($section_code as $row): ?>
                        <option value="<?php echo $row['section_code']; ?>"><?php echo $row['section_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </span>


    <!-- <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">For</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="" selected>-- Choose --</option>
                <option value="EMPLOYEE">EMPLOYEE</option>
                <option value="CANDIDATE">CANDIDATE</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Randomize Question</label>
            <select class="form-control selectpicker" name="exam_random" data-live-search="true" required>
                <option value="" selected>-- Choose --</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
            </select>
        </div>
    </div> -->
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>

<script>
    
    $('#designation_input').hide();
    
    // CREATING BLANK DESIGNATION INPUT
    var blank_designation = '';
    $(document).ready(function () {
        blank_designation = $('#designation_input').html();
    });

    function add_designation()
    {
        $("#designation").append(blank_designation);
        $('.selectpicker').selectpicker('render');
    }

    // REMOVING DESIGNATION INPUT
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }

    $("#seeAnotherField").change(function() {
        if ($(this).val() == "INDIVIDU") {
            $('#department').hide();
            $('#designation').show();
            $('#add').show();
        } else if ($(this).val() == "DEPARTMENT") {
            $('#department').show();
            $('#designation').hide();
            $('#add').hide();
        } else {
            $('#department').hide();
            $('#designation').hide();
            $('#add').hide();
        }
    });
    $("#seeAnotherField").trigger("change");

</script>