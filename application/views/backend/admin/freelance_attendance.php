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
                                    $row = $query->row();
                                ?>
                                <input type="hidden" class="form-control" name="section_code" value="<?php echo $row->section_code; ?>"/>
                                <input type="text" class="form-control" value="<?php echo $row->section_name; ?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control" name="fattendance_date" value="<?php echo date("Y-m-d"); ?>" required>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->