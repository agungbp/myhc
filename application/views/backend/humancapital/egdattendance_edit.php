<?php 
$egdattendance = $this->db->get_where('egd_attendance', array('egdattendance_id' => $param2))->result_array();
foreach ($egdattendance as $row):
echo form_open(site_url('humancapital/egdattendance/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Event Name</label>
            <input type="text" class="form-control" name="egdattendance_name" value="<?php echo $row['egdattendance_name']; ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Place</label>
            <input type="text" class="form-control" name="egdattendance_place" value="<?php echo $row['egdattendance_place']; ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Date</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="date" class="form-control" name="egdattendance_date" value="<?php echo $row['egdattendance_date']; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" name="egdattendance_time" value="<?php echo $row['egdattendance_time']; ?>" required>
                </div>
            </div>
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
endforeach; ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>