<?php 
    $schedule = $this->db->get_where('recruitment_schedule', array('schedule_id'=>$param2))->result_array();
    foreach ($schedule as $row):
    echo form_open(site_url('humancapital/recruitment_schedule/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="required">Applied For</label>
            <select class="form-control selectpicker" name="vacancy_id" data-live-search="true" required>
                <?php $vacancy = $this->db->get('vacancy')->result_array();
                    foreach ($vacancy as $row1): ?>
                        <option value="<?php echo $row1['vacancy_id']; ?>" <?php if ($row['vacancy_id'] == $row1['vacancy_id']) echo 'selected'; ?>><?php echo $row1['vacancy_position']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="required">Application Status</label>
            <select class="form-control selectpicker" name="application_status" data-live-search="true" required>
                <option value="Psikotest" <?php if ($row['application_status'] == 'Psikotest') echo 'selected'; ?>>Psikotest</option>
                <option value="Interview" <?php if ($row['application_status'] == 'Interview') echo 'selected'; ?>>Interview</option>
                <option value="Hired" <?php if ($row['application_status'] == 'Hired') echo 'selected'; ?>>Hired</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="required">Date</label>
            <input type="date" class="form-control" name="schedule_date" value="<?php echo $row['schedule_date']; ?>" required>
        </div>
        <div class="form-group col-md-3">
            <label class="required">Time</label>
            <input type="time" class="form-control" name="schedule_time" value="<?php echo $row['schedule_time']; ?>" required>
        </div>
        <div class="form-group col-md-5">
            <label class="required">Place</label>
            <input type="text" class="form-control" name="schedule_place" value="<?php echo $row['schedule_place']; ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Note</label>
            <textarea class="form-control" name="schedule_note" rows="4"><?php echo $row['schedule_note']; ?></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>              
<?php echo form_close();
    endforeach;
?>

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

                    }
                });
                return false;
            }); 
            
		});
	</script>

<script>
    $('.selectpicker').selectpicker('render')
</script>