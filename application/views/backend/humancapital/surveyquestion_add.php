<?php echo form_open(site_url('humancapital/surveyquestion/create/'.$survey_id), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Question</label>
            <input type="text" class="form-control" name="surveyquestion_question" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Answer Type</label>
            <select class="form-control selectpicker" name="surveyquestion_type" id="seeAnotherField" data-live-search="true" required>
                <option value="" selected>-- Choose Type --</option>
                <option value="Short Text">Short Text</option>
                <option value="Long Text">Long Text</option>
                <option value="Date">Date</option>
                <option value="Radio">Radio</option>
                <option value="Checkbox">Checkbox</option>
            </select>        
        </div>
    </div>

    <span id="designation">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required">Option</label>
                <input type="text" class="form-control" name="surveyquestionoption_option[]" />
            </div>
        </div>
    </span>
    <span id="designation_input">
        <div class="form-row">
            <div class="form-group col-md-10">
                <input type="text" class="form-control" name="surveyquestionoption_option[]" />
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
    }

    // REMOVING DESIGNATION INPUT
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }


    $("#seeAnotherField").change(function() {
    if ($(this).val() == "Radio" || $(this).val() == "Checkbox") {
        $('#designation').show();
        $('#add').show();
    } else {
        $('#designation').hide();
        $('#add').hide();
    }
    });
    $("#seeAnotherField").trigger("change");

</script>