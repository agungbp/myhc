<?php 
    $stock = $this->db->get_where('uniform_stock', array('uniformstock_id' => $param2))->result_array();
    foreach ($stock as $row):
        echo form_open(site_url('humancapital/uniform/update/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Type</label>
                    <input type="text" class="form-control" name="uniformstock_type" value="<?php echo $row['uniformstock_type'] ?>" required>     
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Gender</label>
                    <select class="form-control selectpicker" name="uniformstock_gender" data-live-search="true" required>
                        <option value="L" <?php if ($row['uniformstock_gender'] == 'Pria') echo 'selected'; ?>>Laki-Laki</option>
                        <option value="P" <?php if ($row['uniformstock_gender'] == 'Wanita') echo 'selected'; ?>>Perempuan</option>
                        <option value="AS" <?php if ($row['uniformstock_gender'] == 'AS') echo 'selected'; ?>>All Size</option>
                    </select> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="required">Size</label>
                    <select class="form-control selectpicker" name="uniformstock_size" data-live-search="true" required>
                        <option value="S" <?php if ($row['uniformstock_size'] == 'S') echo 'selected'; ?>>S</option>
                        <option value="M" <?php if ($row['uniformstock_size'] == 'M') echo 'selected'; ?>>M</option>
                        <option value="L" <?php if ($row['uniformstock_size'] == 'L') echo 'selected'; ?>>L</option>
                        <option value="XL" <?php if ($row['uniformstock_size'] == 'XL') echo 'selected'; ?>>XL</option>
                        <option value="XXL" <?php if ($row['uniformstock_size'] == 'XXL') echo 'selected'; ?>>XXL</option>
                        <option value="AS" <?php if ($row['uniformstock_size'] == 'AS') echo 'selected'; ?>>All Size</option>
                    </select> 
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