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
        <?php echo form_open(site_url('admin/freelance_attendance_selector')); ?>
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-4">
                            <div class="form-group">
                                <label class="control-label">Department</label>
                                <?php
                                    $this->db->from('section');
                                    $this->db->where('section_code', $this->session->userdata('login_section'));
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $query = $this->db->get();
                                    $section = $query->row();
                                ?>
                                <input type="hidden" class="form-control" name="section_code" value="<?php echo $section->section_code; ?>" />
                                <input type="text" class="form-control" value="<?php echo $section->section_name; ?>" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control" name="fattendance_date" value="<?php echo $fattendance_date; ?>" required>                          
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary">Manage Attendance</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        <?php echo form_close(); ?>

        <?php echo form_open(site_url('admin/freelance_attendance_update/') .$section_code . '/' . $fattendance_date); ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Status</th>
                                <!-- <th>Remaks</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $valid_employee_ids = array();
                            $count = 0;
                            
                            $freelance_attendance = $this->db->get_where('freelance_attendance', array('fattendance_date' => $fattendance_date))->result_array();
                        
                                foreach($freelance_attendance as $row3) {
                                    $this->db->from('employee');
                                    $this->db->where('nik', $row3['nik']);
                                    $this->db->where('employee_status', 'Freelance');
                                    $query = $this->db->get();

                                    $section_code_attendance = $query->row()->section_code;
                                    
                                    if($section_code_attendance == $section_code)
                                        array_push($valid_employee_ids, $row3['nik']);
                                }
                            
                            foreach($freelance_attendance as $row)
                                if(in_array($row['nik'], $valid_employee_ids)) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo ++$count; ?></td>
                                        <td>
                                            <?php 
                                                $this->db->from('employee');
                                                $this->db->join('section', 'section.section_code = employee.section_code');
                                                $this->db->where('nik', $row['nik']);
                                                $this->db->where('employee_status', 'Freelance');        
                                                $query = $this->db->get();

                                                echo $query->row()->employee_name;
                                            ?>
                                        </td>
                                        <td><?php echo $query->row()->section_name; ?></td>
                                        <td><?php echo $query->row()->employee_position; ?></td>
                                        <td style="width: 20%;">
                                            <select class="form-control selectpicker" name="fattendance_status_<?php echo $row['fattendance_id']; ?>" onchange="get_reason_holder(this.value, <?php echo $row['fattendance_id']; ?>)" data-live-search="true">
                                                <option value="M" <?php if ($row['fattendance_status'] == 'M') echo 'selected'; ?>>
                                                    MASUK
                                                </option>
                                                <option value="S" <?php if ($row['fattendance_status'] == 'S') echo 'selected'; ?>>
                                                    SAKIT
                                                </option>
                                                <option value="I" <?php if ($row['fattendance_status'] == 'I') echo 'selected'; ?>>
                                                    IZIN
                                                </option>
                                                <option value="A" <?php if ($row['fattendance_status'] == 'A') echo 'selected'; ?>>
                                                    ALFA
                                                </option>
                                                <option value="L" <?php if ($row['fattendance_status'] == 'L') echo 'selected'; ?>>
                                                    LIBUR
                                                </option>
                                            </select>	
                                        </td>
                                        <!-- <td>
                                            <span style="display: none;" id="reason_holder_<?php // echo $row['fattendance_id']; ?>">
                                                <input type="text" name="fattendance_remarks_<?php // echo $row['fattendance_id']; ?>"
                                                    class="form-control" value="<?php // echo $row['fattendance_remarks']; ?>" />
                                            </span>
                                            <?php // if($row['fattendance_status'] == 'S' || $row['fattendance_status'] == 'I' || $row['fattendance_status'] == 'A') { ?>
                                                <span style="display: block;" id="reason_holder_2_<?php // echo $row['fattendance_id']; ?>">
                                                    <input type="text" name="fattendance_remarks_<?php // echo $row['fattendance_id']; ?>"
                                                        class="form-control" value="<?php // echo $row['fattendance_remarks']; ?>" />
                                                </span>
                                            <?php // } if($row['fattendance_status'] == 'M') {?>
                                                <span style="display: block;" id="reason_holder_2_<?php // echo $row['fattendance_id']; ?>"></span>
                                            <?php // } ?>
                                        </td> -->
                                    </tr>
                                    <input type="hidden" name="fattendance_id_<?php echo $count; ?>" value="<?php echo $row['fattendance_id']; ?>" />
                            <?php } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="number_of_attendances" value="<?php echo $count; ?>" />
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-dark" id="submit_button" style="margin-top: 10px;">
                                <i class="entypo-check"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    
    // function get_reason_holder(fattendance_status, fattendance_id)
    // {
    //     $('#reason_holder_2_' + fattendance_id).attr('style', 'display: none;');

    //     if(fattendance_status == 'S' || fattendance_status == 'I' || fattendance_status == 'A')
    //         $('#reason_holder_' + fattendance_id).attr('style', 'display: block;');
    //     if(fattendance_status == 'M')
    //         $('#reason_holder_' + fattendance_id).attr('style', 'display: none;');
    // }

</script>