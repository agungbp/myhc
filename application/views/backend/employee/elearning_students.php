<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $page_title;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $page_title;?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
                <?php 
                    $this->db->from('elearning_student');
                    $this->db->join('employee', 'elearning_student.nik = employee.nik');
                    $this->db->where('class_id', $class_id);
                    $students = $this->db->get();
                    // $students = $this->db->get_where('elearning_student', array('class_id' => $class_id))->result_array();
                    foreach ($students->result_array() as $row): ?>
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-1 col-3">
                                        <img src="<?php echo $this->get_model->get_image_url('employee', $row['nik']); ?>" width="100%" style="margin-left: 0px;" />
                                    </div>
                                    <div class="col-lg-11 col-9" >
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-lg-1 col-4">NIK</div>
                                            <div class="col-lg-11 col-8"><b><?php echo $row['nik']; ?></b></div>
                                        </div>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-lg-1 col-4">Employee</div>
                                            <div class="col-lg-11 col-8"><b><?php echo $row['employee_name']; ?></b></div>
                                        </div>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-lg-1 col-4">Department</div>
                                            <div class="col-lg-11 col-8">
                                                <b>
                                                    <?php 
                                                        $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                                        if($section->num_rows() > 0){
                                                            echo $section->row()->section_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-lg-1 col-4">Unit</div>
                                            <div class="col-lg-11 col-8">
                                                <b>
                                                    <?php 
                                                        $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code'])); 
                                                        if($unit->num_rows() > 0){
                                                            echo $unit->row()->unit_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-lg-1 col-4">Position</div>
                                            <div class="col-lg-11 col-8"><b><?php echo $row['employee_position']; ?></b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div> 
                <?php endforeach; ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'elearning_class_add.php'; ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->