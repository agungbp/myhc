<?php 
    $employee = $this->db->get_where('employee', array('nik' => $param2))->result_array();
    foreach ($employee as $row):
        echo form_open(site_url('spv/employee/update/') . $param2, array('enctype' => 'multipart/form-data')); ?>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Area</label>
                <input type="text" class="form-control" name="employee_area" value="<?php echo $row['employee_area'] ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Zona</label>
                <input type="text" class="form-control" name="employee_zona" value="<?php echo $row['employee_zona'] ?>">
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