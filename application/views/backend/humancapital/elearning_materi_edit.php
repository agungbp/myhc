<?php 
    $materi = $this->db->get_where('elearning_materi', array('materi_id'=>$param2))->result_array();
    foreach ($materi as $row):
        echo form_open(site_url('humancapital/materi/update/'.$param2.'/'.$param3), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Title</label>
                    <input type="text" class="form-control" name="materi_name" value="<?php echo $row['materi_name']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Expire</label>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" class="form-control" name="materi_end_date" value="<?php echo $row['materi_end_date']; ?>" id="txt_materi_end_date2" <?php if ($row['materi_end_date'] == NULL || $row['materi_end_date'] == '') echo 'disabled'; ?>>
                        </div>
                        <div class="col-md-4">
                            <input type="time" class="form-control" name="materi_end_time" value="<?php echo $row['materi_end_time']; ?>" id="txt_materi_end_time2" <?php if ($row['materi_end_time'] == NULL || $row['materi_end_time'] == '') echo 'disabled'; ?>>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check" style="margin-top: 7px;">
                                <input class="form-check-input" type="checkbox" id="chk_materi_end2" <?php if (($row['materi_end_date'] == NULL || $row['materi_end_date'] == '') && ($row['materi_end_time'] == NULL || $row['materi_end_time'] == '')) echo 'checked'; ?>>
                                <label class="form-check-label">PERMANENT</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">File (Max: 2 Mb)</label>
                    <input type="file" id="uploadfile" class="form-control-file" name="materi_file">
                    <?php echo $row['materi_file']; ?>
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

<script type="text/javascript">
    $('#chk_materi_end2').click(function(){
        if($(this).is(':checked')){
            $('#txt_materi_end_date2').attr("disabled", true);
            $('#txt_materi_end_time2').attr("disabled", true);
        } else{
            $('#txt_materi_end_date2').attr("disabled", false);
            $('#txt_materi_end_time2').attr("disabled", false);
        }
    });
</script>

<script type="text/javascript">
        var uploadField = document.getElementById("uploadfile");

        uploadField.onchange = function() {
            if(this.files[0].size > 2000000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>