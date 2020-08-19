<?php echo form_open(site_url('humancapital/class/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Title</label>
            <input type="text" class="form-control" name="class_name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Periode</label>
            <select class="form-control selectpicker" name="class_periode" data-live-search="true" required>
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

    <span id="designation">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Employee</label>
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


    // $("#seeAnotherField").change(function() {
    // if ($(this).val() == "Radio" || $(this).val() == "Checkbox") {
    //     $('#designation').show();
    //     $('#add').show();
    // } else {
    //     $('#designation').hide();
    //     $('#add').hide();
    // }
    // });
    // $("#seeAnotherField").trigger("change");

</script>