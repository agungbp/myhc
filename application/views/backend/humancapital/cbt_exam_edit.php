<?php 
$exam = $this->db->get_where('cbt_exam', array('exam_id'=>$param2))->result_array();
foreach ($exam as $row):
echo form_open(site_url('humancapital/exam/update/'.$param2), array('enctype' => 'multipart/form-data')); 
$first_option = $this->db->get_where('cbt_participants', array('exam_id' => $param2))->row();
?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Title</label>
            <input type="text" class="form-control" name="exam_name" value="<?php echo $row['exam_name']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Question Package</label>
            <select class="form-control selectpicker" name="questionpack_id" data-live-search="true" required>
                <?php $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_status' => 'Approved'))->result_array();
                    foreach ($questionpack_id as $row1): ?>
                        <option value="<?php echo $row1['questionpack_id']; ?>" <?php if($row['questionpack_id'] == $row1['questionpack_id']) echo 'selected'; ?>><?php echo $row1['questionpack_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Start</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_start_date" value="<?php echo $row['exam_start_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_start_time" value="<?php echo $row['exam_start_time']; ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="required">End</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="exam_end_date" value="<?php echo $row['exam_end_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="exam_end_time" value="<?php echo $row['exam_end_time']; ?>" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- <div class="form-group col-md-6">
            <label class="required">For</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" id="seeAnotherField2" required>
                <option value="ALL" <?php // if ($row['user_type'] == 'ALL') echo 'selected'; ?>>SEMUA KARYAWAN</option>
                <option value="DEPARTMENT" <?php // if ($row['user_type'] == 'DEPARTMENT') echo 'selected'; ?>>DEPARTMENT TERTENTU</option>
                <option value="INDIVIDU" <?php // if ($row['user_type'] == 'INDIVIDU') echo 'selected'; ?>>PILIH PERORANGAN</option>
            </select>
        </div> -->
        <!-- <div class="form-group col-md-6">
            <label class="required">Randomize Question</label>
            <select class="form-control selectpicker" name="exam_random" data-live-search="true" required>
                <option value="Y" <?php // if ($row['exam_random'] == 'Y') echo 'selected'; ?>>YES</option>
                <option value="N" <?php // if ($row['exam_random'] == 'N') echo 'selected'; ?>>NO</option>
            </select>
        </div> -->
        <div class="form-group col-md-6">
            <label>Token</label>
            <a href="<?php echo site_url('humancapital/exam/reset_token/'.$param2); ?>" class="btn btn-danger btn-block"><i class="fas fa-key"></i>&nbsp;&nbsp;Reset Token</a>
        </div>
    </div>

    <!-- <span id="designation2">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Employee</label>
                <select class="form-control selectpicker" name="participants_<?php // echo $first_option->participants_id; ?>" data-live-search="true">
                    <option value="" selected>-- Choose Employee --</option>
                    <?php 
                        // $this->db->from('employee');
                        // $this->db->join('section', 'employee.section_code = section.section_code');
                        // $this->db->where('employee_status !=', 'Resign');
                        // $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                        // $nik = $this->db->get();

                        // foreach ($nik->result_array() as $row3): ?>
                            <option value="<?php // echo $row3['nik']; ?>" data-subtext="<?php echo $row3['section_name']; ?>" <?php if($row3['nik'] == $first_option->nik) echo 'selected' ?>><?php echo $row3['employee_name']; ?></option>
                    <?php // endforeach; ?>
                </select>
            </div>
        </div>

        <?php
            // $query = $this->db->get_where('cbt_participants', array('exam_id' => $param2));
            // if($query->num_rows() > 1) {
            //     $count          = 1;
            //     $participants   = $query->result_array();
            //     foreach($participants as $row2) {
            //         if($count > 1) { ?>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <select class="form-control selectpicker" name="participants_<?php // echo $row2['participants_id']; ?>" data-live-search="true">
                                    <option value="" selected>-- Choose Employee --</option>
                                    <?php 
                                        // $this->db->from('employee');
                                        // $this->db->join('section', 'employee.section_code = section.section_code');
                                        // $this->db->where('employee_status !=', 'Resign');
                                        // $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                        // $nik = $this->db->get();

                                        // foreach ($nik->result_array() as $row4): ?>
                                            <option value="<?php // echo $row4['nik']; ?>" data-subtext="<?php // echo $row4['section_name']; ?>" <?php if($row4['nik'] == $row2['nik']) echo 'selected' ?>><?php echo $row4['employee_name']; ?></option>
                                    <?php // endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="button" class="btn btn-default" onclick="deleteParentElement2(this, <?php // echo $row2['participants_id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    <?php // }
            //         $count ++;
            //     }
            // } 
        ?>
    </span> 
    <span id="designation_input2">
        <div class="form-row">
            <div class="form-group col-md-10">
                <select class="form-control selectpicker2" name="nik[]" data-live-search="true">
                    <option value="" selected>-- Choose Employee --</option>
                    <?php 
                        // foreach ($nik->result_array() as $row5): ?>
                            <option value="<?php // echo $row5['nik']; ?>" data-subtext="<?php // echo $row5['section_name']; ?>"><?php // echo $row5['employee_name']; ?></option>
                    <?php // endforeach; ?>
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

    <span id="department2">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Department</label>
                <select class="form-control selectpicker" name="section_code" data-live-search="true">
                    <?php // $section = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                        // foreach ($section as $row1): ?>
                            <option value="<?php // echo $row1['section_code']; ?>" <?php // if($row['exam_section'] == $row1['section_code']) echo 'selected'; ?>>
                                <?php // echo $row1['section_name']; ?>
                            </option>
                    <?php // endforeach; ?>
                </select>
            </div>
        </div>
    </span> -->

    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); 
endforeach; ?>

<!-- <script>
    
    $('#designation_input2').hide();

    $("#seeAnotherField2").change(function() {
        if ($(this).val() == "INDIVIDU") {
            $('#department2').hide();
            $('#designation2').show();
            $('#add2').show();
        } else if ($(this).val() == "DEPARTMENT") {
            $('#department2').show();
            $('#designation2').hide();
            $('#add2').hide();
        } else {
            $('#department2').hide();
            $('#designation2').hide();
            $('#add2').hide();
        }
    });
    $("#seeAnotherField2").trigger("change");
    
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
    function deleteParentElement2(n, participants_id) {
        $.ajax({
            url     : '<?php echo site_url('humancapital/delete_participants/'); ?>' + participants_id,
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

</script> -->

<script>
    $('.selectpicker').selectpicker('render')
</script>