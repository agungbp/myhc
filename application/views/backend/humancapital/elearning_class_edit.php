<?php 
    $class = $this->db->get_where('elearning_class', array('class_id'=>$param2))->result_array();
    foreach ($class as $row):
        $first_option = $this->db->get_where('elearning_student', array('class_id' => $param2))->row();
        echo form_open(site_url('humancapital/class/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Title</label>
                    <input type="text" class="form-control" name="class_name" value="<?php echo $row['class_name']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Periode</label>
                    <select class="form-control selectpicker" name="class_periode" data-live-search="true" required>
                        <option value="2015" <?php if ($row['class_periode'] == "2015") echo 'selected'; ?>>2015</option>
                        <option value="2016" <?php if ($row['class_periode'] == "2016") echo 'selected'; ?>>2016</option>
                        <option value="2017" <?php if ($row['class_periode'] == "2017") echo 'selected'; ?>>2017</option>
                        <option value="2018" <?php if ($row['class_periode'] == "2018") echo 'selected'; ?>>2018</option>
                        <option value="2019" <?php if ($row['class_periode'] == "2019") echo 'selected'; ?>>2019</option>
                        <option value="2020" <?php if ($row['class_periode'] == "2020") echo 'selected'; ?>>2020</option>
                        <option value="2021" <?php if ($row['class_periode'] == "2021") echo 'selected'; ?>>2021</option>
                        <option value="2022" <?php if ($row['class_periode'] == "2022") echo 'selected'; ?>>2022</option>
                        <option value="2023" <?php if ($row['class_periode'] == "2023") echo 'selected'; ?>>2023</option>
                        <option value="2024" <?php if ($row['class_periode'] == "2024") echo 'selected'; ?>>2024</option>
                        <option value="2025" <?php if ($row['class_periode'] == "2025") echo 'selected'; ?>>2025</option>
                    </select>
                </div>
            </div>

            <span id="designation2">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="required">Employee</label>
                        <select class="form-control selectpicker" name="student_<?php echo $first_option->student_id; ?>" data-live-search="true">
                            <option value="" selected>-- Choose Employee --</option>
                            <?php 
                                $this->db->from('employee');
                                $this->db->join('section', 'employee.section_code = section.section_code');
                                // $this->db->join('elearning_student', 'employee.nik = elearning_student.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                // $this->db->where('class_id', $param2);
                                $nik = $this->db->get();

                                foreach ($nik->result_array() as $row3): ?>
                                    <option value="<?php echo $row3['nik']; ?>" data-subtext="<?php echo $row3['section_name']; ?>" <?php if($row3['nik'] == $first_option->nik) echo 'selected' ?>><?php echo $row3['employee_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <?php
                    $query = $this->db->get_where('elearning_student', array('class_id' => $param2));
                    if($query->num_rows() > 1) {
                        $count          = 1;
                        $elearning_student   = $query->result_array();
                        foreach($elearning_student as $row2) {
                            if($count > 1) { ?>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <!-- <input type="text" class="form-control" value="<?php //echo $row2['nik']; ?>" name="student_<?php // echo $row2['student_id']; ?>" /> -->
                                        <select class="form-control selectpicker" name="student_<?php echo $row2['student_id']; ?>" data-live-search="true">
                                            <option value="" selected>-- Choose Employee --</option>
                                            <?php 
                                                $this->db->from('employee');
                                                $this->db->join('section', 'employee.section_code = section.section_code');
                                                // $this->db->join('elearning_student', 'employee.nik = elearning_student.nik');
                                                $this->db->where('employee_status !=', 'Resign');
                                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                                // $this->db->where('class_id', $param2);
                                                $nik = $this->db->get();

                                                foreach ($nik->result_array() as $row4): ?>
                                                    <option value="<?php echo $row4['nik']; ?>" data-subtext="<?php echo $row4['section_name']; ?>" <?php if($row4['nik'] == $row2['nik']) echo 'selected' ?>><?php echo $row4['employee_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-default" onclick="deleteParentElement2(this, <?php echo $row2['student_id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php }
                            $count ++;
                        }
                    } 
                ?>
            </span>
            <span id="designation_input2">
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <select class="form-control selectpicker2" name="nik[]" data-live-search="true">
                            <option value="" selected>-- Choose Employee --</option>
                            <?php 
                                foreach ($nik->result_array() as $row5): ?>
                                    <option value="<?php echo $row5['nik']; ?>" data-subtext="<?php echo $row5['section_name']; ?>"><?php echo $row5['employee_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-default" onclick="deleteNewParentElement2(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </span>
            <div class="form-row" id="add2">
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-default btn-sm btn-icon icon-right" onClick="add_designation2()">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Option
                    </button>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="class_status" data-live-search="true" required>
                        <option value="Active" <?php if ($row['class_status'] == 'Active') echo 'selected'; ?>>Active</option>
                        <option value="Inactive" <?php if ($row['class_status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
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
        echo form_close(); 
    endforeach;
?>

<script>
    
    $('#designation_input2').hide();

    // $("#seeAnotherField2").change(function() {
    // if ($(this).val() == "Radio" || $(this).val() == "Checkbox") {
    //     $('#designation2').show();
    //     $('#add2').show();
    // } else {
    //     $('#designation2').hide();
    //     $('#add2').hide();
    // }
    // });
    // $("#seeAnotherField2").trigger("change");
    
    // CREATING BLANK DESIGNATION INPUT
    var blank_designation2 = '';
    $(document).ready(function () {
        blank_designation2 = $('#designation_input2').html();
    });

    function add_designation2()
    {
        $("#designation2").append(blank_designation2);
        $('.selectpicker2').selectpicker('render')
    }

    // REMOVING DESIGNATION INPUT
    function deleteParentElement2(n, student_id) {
        $.ajax({
            url     : '<?php echo site_url('humancapital/delete_student/'); ?>' + student_id,
            success : function (response)
            {
                response = 'success';
            }
        });
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }
    
    function deleteNewParentElement2(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }

</script>

<script>
    $(document).ready(function () {
        var wrapper = $(".add-text-box"); //Fields wrapper
        var add_button = $(".add-designation2"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            x++; //text box increment
            $(wrapper).append('<div class="col-md-12"><input type="text" class="form-control" name="nik[]" id="designation2"></div>'); //add input box

        });


    });

</script>

<script>
    $('.selectpicker').selectpicker('render')
</script>