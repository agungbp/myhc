<?php 
$question = $this->db->get_where('survey_question', array('surveyquestion_id'=>$param2))->result_array();
foreach ($question as $row):
    $first_option = $this->db->get_where('survey_question_option', array('surveyquestion_id' => $param2))->row();
    echo form_open(site_url('humancapital/surveyquestion/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data'));
?>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Question</label>
                <input type="text" class="form-control" name="surveyquestion_question" value="<?php echo $row['surveyquestion_question'] ?>" required>
            </div>
        </div>

        <?php if($row['surveyquestion_type'] == 'Short Text' || $row['surveyquestion_type'] == 'Long Text' || $row['surveyquestion_type'] == 'Date'){ ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Answer Type</label>
                    <select class="form-control selectpicker" name="surveyquestion_type" id="seeAnotherField2" data-live-search="true" required>
                        <option value="Short Text" <?php if ($row['surveyquestion_type'] == 'Short Text') echo 'selected'; ?>>Short Text</option>
                        <option value="Long Text" <?php if ($row['surveyquestion_type'] == 'Long Text') echo 'selected'; ?>>Long Text</option>
                        <option value="Date" <?php if ($row['surveyquestion_type'] == 'Date') echo 'selected'; ?>>Date</option>
                    </select>        
                </div>
            </div>
        <?php } else if($row['surveyquestion_type'] == 'Radio' || $row['surveyquestion_type'] == 'Checkbox'){ ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Answer Type</label>
                    <select class="form-control selectpicker" name="surveyquestion_type" id="seeAnotherField2" data-live-search="true" required>
                        <option value="Radio" <?php if ($row['surveyquestion_type'] == 'Radio') echo 'selected'; ?>>Radio</option>
                        <option value="Checkbox" <?php if ($row['surveyquestion_type'] == 'Checkbox') echo 'selected'; ?>>Checkbox</option>
                    </select>        
                </div>
            </div>
        <?php } ?>

        <span id="designation2">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Option</label>
                    <input type="text" class="form-control" value="<?php echo $first_option->surveyquestionoption_option; ?>" name="surveyquestionoption_<?php echo $first_option->surveyquestionoption_id; ?>" required />
                </div>
            </div>

            <?php
                $query = $this->db->get_where('survey_question_option', array('surveyquestion_id' => $param2));
                if($query->num_rows() > 1) {
                    $count          = 1;
                    $survey_question_option   = $query->result_array();
                    foreach($survey_question_option as $row2) {
                        if($count > 1) { ?>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control" value="<?php echo $row2['surveyquestionoption_option']; ?>" name="surveyquestionoption_<?php echo $row2['surveyquestionoption_id']; ?>" />
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-default" onclick="deleteParentElement2(this, <?php echo $row2['surveyquestionoption_id']; ?>)">
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
                    <input type="text" class="form-control" name="surveyquestionoption_option[]" />
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

    $("#seeAnotherField2").change(function() {
    if ($(this).val() == "Radio" || $(this).val() == "Checkbox") {
        $('#designation2').show();
        $('#add2').show();
    } else {
        $('#designation2').hide();
        $('#add2').hide();
    }
    });
    $("#seeAnotherField2").trigger("change");
    
    // CREATING BLANK DESIGNATION INPUT
    var blank_designation = '';
    $(document).ready(function () {
        blank_designation = $('#designation_input2').html();
    });

    function add_designation2()
    {
        $("#designation2").append(blank_designation);
    }

    // REMOVING DESIGNATION INPUT
    function deleteParentElement2(n, surveyquestionoption_id) {
        $.ajax({
            url     : '<?php echo site_url('humancapital/delete_surveyquestionoption/'); ?>' + surveyquestionoption_id,
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
        var add_button = $(".add-designation"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            x++; //text box increment
            $(wrapper).append('<div class="col-md-12"><input type="text" class="form-control" name="surveyquestionoption_question[]" id="designation2"></div>'); //add input box

        });


    });

</script>

<script>
    $('.selectpicker').selectpicker('render')
</script>