<?php 
    $vacancy = $this->db->get_where('vacancy', array('vacancy_id'=>$param2))->result_array();
    foreach ($vacancy as $row):
        echo form_open(site_url('humancapital/vacancy/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Type</label>
                    <select class="form-control selectpicker" name="user_type" data-live-search="true" required>
                        <option value="EMPLOYEE" <?php if ($row['user_type'] == 'EMPLOYEE') echo 'selected'; ?>>INTERNAL</option>
                        <option value="CANDIDATE" <?php if ($row['user_type'] == 'CANDIDATE') echo 'selected'; ?>>EKSTERNAL</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Position</label>
                    <input type="text" class="form-control" name="vacancy_position" value="<?php echo $row['vacancy_position']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Level</label>
                    <select class="form-control selectpicker" name="vacancy_level" data-live-search="true" required>
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
                <div class="form-group col-md-6">
                    <label class="required">Placement</label>
                    <input type="text" class="form-control" name="vacancy_placement" value="<?php echo $row['vacancy_placement']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Department</label>
                    <select class="form-control selectpicker" name="vacancy_section" id="section_code" data-live-search="true" required>
                        <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                            foreach ($section_code as $row1): ?>
                                <option value="<?php echo $row1['section_code']; ?>" <?php if($row['vacancy_section'] == $row1['section_code']) echo 'selected'; ?>><?php echo $row1['section_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Unit</label>
                    <select class="form-control selectpicker" name="vacancy_unit" id="unit_code" data-live-search="true" required>
                        <?php $unit_code = $this->db->get_where('unit', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                            foreach ($unit_code as $row1): ?>
                                <option value="<?php echo $row1['unit_code']; ?>" <?php if($row['vacancy_unit'] == $row1['unit_code']) echo 'selected'; ?>><?php echo $row1['unit_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Last Date</label>
                    <input type="date" class="form-control" name="vacancy_lastdate" value="<?php echo $row['vacancy_lastdate']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Requirements</label>
                    <textarea class="form-control" name="vacancy_requirement" rows="8" required><?php echo $row['vacancy_requirements']; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Job Description</label>
                    <textarea class="form-control" name="vacancy_jobdesc" rows="8" required><?php echo $row['vacancy_jobdesc']; ?></textarea>
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
    $('.selectpicker').selectpicker('render')
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