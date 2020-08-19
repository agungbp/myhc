<?php 
    $umrah = $this->db->get_where('umrah', array('nik'=>$param2))->result_array();
    foreach ($umrah as $row):    
    echo form_open(site_url('humancapital/umrah/update/'.$param2), array('enctype' => 'multipart/form-data')); 
?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Status</label>
            <select class="form-control selectpicker" name="umrah_status" id="seeAnotherFieldIn" data-live-search="true" required>
                <option value="Pending" <?php if ($row['umrah_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Scheduled" <?php if ($row['umrah_status'] == 'Scheduled') echo 'selected'; ?>>Scheduled</option>
                <option value="Done" <?php if ($row['umrah_status'] == 'Done') echo 'selected'; ?>>Done</option>
            </select>        
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12" id="otherFieldDivIn">
            <label>Umrah Date</label>
            <input type="date" class="form-control" name="umrah_date" value="<?php echo $row['umrah_date']; ?>" required>
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

        $("#seeAnotherFieldIn").change(function() {
            if ($(this).val() == "Scheduled") {
                $('#otherFieldDivIn').show();
            } else {
                $('#otherFieldDivIn').hide();
            }
        });
        $("#seeAnotherFieldIn").trigger("change");  
    });
</script>

<script>
    $('.selectpicker').selectpicker('render')
</script>