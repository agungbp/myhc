<div class="callout callout-info">
    <strong>Kelas akan ditambahkan oleh HC</strong>
    <br>
    <span class="countdown">Tetapi jika Anda ingin pengajuan kelas secara mandiri, silahkan pilih kelas dibawah<br/>
</div>

<?php echo form_open(site_url('employee/class/join'), array('enctype' => 'multipart/form-data')); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Class</label>
            <select class="form-control selectpicker" name="class_id" id="class_id" data-live-search="true" required>
                <option value="" selected>-- Choose Class --</option>
                <?php 
                    $this->db->from('elearning_class');
                    // $this->db->join('elearning_student', 'elearning_class.class_id = elearning_student.class_id');
                    $this->db->where('class_status', 'Active');
                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                    // $this->db->where('nik !=', $this->session->userdata('login_nik'));
                    $class = $this->db->get();

                    // $class = $this->db->get_where('elearning_class', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                    foreach ($class->result_array() as $row1): 
                        if($this->db->get_where('elearning_student', array('class_id' => $row1['class_id'], 'nik' => $this->session->userdata('login_nik')))->num_rows() == 0){
                ?>
                            <option value="<?php echo $row1['class_id']; ?>" data-subtext="<?php echo $row1['class_periode']; ?>"><?php echo $row1['class_name']; ?></option>
                <?php   
                        }
                    endforeach; 
                ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <div class="form-group col-md-12">
                <br><button type="submit" class="btn btn-info">Apply</button>
            </div>
        </div>
    </div>              
<?php echo form_close(); ?>