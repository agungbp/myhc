<?php echo form_open(site_url('humancapital/vacancy/create'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Type</label>
            <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                <option value="" selected>-- Choose Type --</option>
                <option value="EMPLOYEE">INTERNAL</option>
                <option value="CANDIDATE">EKSTERNAL</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Position</label>
            <input type="text" class="form-control" name="vacancy_position" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Level</label>
            <select class="form-control selectpicker" name="vacancy_level" data-live-search="true" required>
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
        <div class="form-group col-md-6">
            <label class="required">Placement</label>
            <input type="text" class="form-control" name="vacancy_placement" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Department</label>
            <select class="form-control selectpicker" name="vacancy_section" id="section_code" data-live-search="true" required>
                <option value="" selected>-- Choose Department --</option>
                <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($section_code as $row1): ?>
                        <option value="<?php echo $row1['section_code']; ?>"><?php echo $row1['section_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Unit</label>
            <select class="form-control selectpicker" name="vacancy_unit" id="unit_code" data-live-search="true" required>
                <option value="">-- Choose Unit --</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Last Date</label>
            <input type="date" class="form-control" name="vacancy_lastdate" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Requirements</label>
            <textarea class="form-control" name="vacancy_requirement" rows="8" required></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Job Description</label>
            <textarea class="form-control" name="vacancy_jobdesc" rows="8" required></textarea>
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
                    
                    var html = '';
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
        
    });
</script>
