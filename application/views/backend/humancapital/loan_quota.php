<?php echo form_open(site_url('humancapital/loan/quota/'.$param2), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Type</label>
            <select class="form-control selectpicker" name="loanhistory_inout" data-live-search="true" required>
                <option value="" selected>-- Choose Type --</option>
                <option value="In">PENAMBAHAN</option>
                <option value="Out">PENGURANGAN</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="required">Amount</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="text" class="form-control" name="loanhistory_amount" required>
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
<?php echo form_close(); ?>

<script>
    $('.selectpicker').selectpicker('render')
</script>