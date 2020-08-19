<?php 
    $spk = $this->db->get_where('employee', array('nik'=>$param2))->result_array();
    foreach ($spk as $row):
        echo form_open(site_url('humancapital/spk/create/'.$param2), array('enctype' => 'multipart/form-data')); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">SPK Number</label>
                    <input type="text" class="form-control" name="spk_number" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Position</label>
                    <input type="text" class="form-control" name="spk_position" value="<?php echo $row['employee_position']; ?>" required>
                </div>   
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Department</label>
                    <select class="form-control selectpicker" name="section_code" id="section_code" data-live-search="true" required>
                        <?php $section_code = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                            foreach ($section_code as $row1): ?>
                                <option value="<?php echo $row1['section_code']; ?>" <?php if($row['section_code'] == $row1['section_code']) echo 'selected'; ?>><?php echo $row1['section_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 
                <div class="form-group col-md-6">
                    <label class="required">Unit</label>
                    <select class="form-control selectpicker" name="unit_code" id="unit_code" data-live-search="true" required>
                        <?php 
                            $this->db->from('section');
                            $this->db->join('unit', 'section.section_code = unit.section_code');
                            $this->db->where('unit.branch_code', $this->session->userdata('login_branch'));
                            $unit_code = $this->db->get();
                            foreach ($unit_code->result_array() as $row1): ?>
                                <option value="<?php echo $row1['unit_code']; ?>" data-subtext="<?php echo $row1['section_name']; ?>" <?php if($row['unit_code'] == $row1['unit_code']) echo 'selected'; ?>><?php echo $row1['unit_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">Start Date</label>
                    <input type="date" class="form-control" name="spk_startdate" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label>End Date</label>
                    <div class="row">
                        <div class="col-md-7">
                            <input type="date" class="form-control" name="spk_enddate" id="txt_spk_enddate" disabled>
                        </div>
                        <div class="col-md-5">
                            <div class="form-check" style="margin-top: 7px;">
                                <input class="form-check-input" type="checkbox" value="TETAP" name="spk_enddate" id="chk_spk_enddate" checked>
                                <label class="form-check-label">TETAP</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row"> 
                <div class="form-group col-md-6">
                    <label class="required">Status</label>
                    <select class="form-control selectpicker" name="spk_status" data-live-search="true" required>
                        <option value="FREELANCE" <?php if ($row['employee_status'] == 'FREELANCE') echo 'selected'; ?>>FREELANCE</option>
                        <option value="HS 2020" <?php if ($row['employee_status'] == 'HS 2020') echo 'selected'; ?>>HS 2020</option>
                        <option value="MITRA" <?php if ($row['employee_status'] == 'MITRA') echo 'selected'; ?>>MITRA</option>
                        <option value="PKWT1" <?php if ($row['employee_status'] == 'PKWT1') echo 'selected'; ?>>PKWT1</option>
                        <option value="PKWT2" <?php if ($row['employee_status'] == 'PKWT2') echo 'selected'; ?>>PKWT2</option>
                        <option value="SOS" <?php if ($row['employee_status'] == 'SOS') echo 'selected'; ?>>SOS</option>
                        <option value="TETAP" <?php if ($row['employee_status'] == 'TETAP') echo 'selected'; ?>>TETAP</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Salary</label>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" name="spk_salary" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control selectpicker" name="spk_salarytype" data-live-search="true" required>
                                <option value="Bulanan">Bulanan</option>
                                <option value="Harian">Harian</option>
                                <option value="Connote">Connote</option>
                            </select>
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
<?php 
        echo form_close(); 
    endforeach;
?>

<script type="text/javascript">
    $('.selectpicker').selectpicker('render');

    $('#chk_spk_enddate').click(function(){
        if($(this).is(':checked')){
            $('#txt_spk_enddate').attr("disabled", true);
        } else{
            $('#txt_spk_enddate').attr("disabled", false);
        }
    });
</script>