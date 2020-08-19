<?php echo form_open(site_url('humancapital/pa/create/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="control-label">Year</label>
            <div class="input-group">
                <select name="pa_year" class="form-control selectpicker" data-live-search="true" required>
                    <?php
                    $year = date('Y');
                    $year_list = array("2010","2011","2012","2013","2014","2015","2016","2017","2018","2019","2020","2021","2022","2023","2024","2025","2026","2027","2028","2030");
                    foreach($year_list as $row) { ?>
                        <option value="<?php echo $row; ?>"
                            <?php if($row == $year) echo 'selected'; ?>>
                                <?php echo $row; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>PA</label>
            <input type="number" class="form-control" name="pa_assesment" required>
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
    $('.selectpicker').selectpicker('render')
</script>