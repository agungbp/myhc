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
        <?php echo form_open(site_url('humancapital/freelance_attendance_report_selector')); ?>
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-4">
                            <div class="form-group">
                                <label class="control-label">Department</label>
                                <select name="section_code" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">-- Select Department --</option>
                                    <option value="All">ALL FREELANCE EMPLOYEES</option>
                                    <?php
                                    $sections = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                    foreach($sections as $row): ?>
                                        <option value="<?php echo $row['section_code']; ?>">
                                            <?php echo $row['section_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <div class="input-group">
                                    <select name="year" class="form-control selectpicker" data-live-search="true">
                                        <?php
                                        $year_list = array("2020","2021","2022","2023","2024","2025","2026","2027","2028","2030","2031","2032","2033","2034","2035");
                                        foreach($year_list as $row) { ?>
                                            <option value="<?php echo $row; ?>"
                                                <?php if($row == $year) echo 'selected'; ?>>
                                                    <?php echo $row; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Month</label>
                                <div class="input-group">
                                    <select name="month" class="form-control selectpicker" data-live-search="true">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++):
                                            if ($i == 1)
                                                $m = 'January';
                                            else if ($i == 2)
                                                $m = 'February';
                                            else if ($i == 3)
                                                $m = 'March';
                                            else if ($i == 4)
                                                $m = 'April';
                                            else if ($i == 5)
                                                $m = 'May';
                                            else if ($i == 6)
                                                $m = 'June';
                                            else if ($i == 7)
                                                $m = 'July';
                                            else if ($i == 8)
                                                $m = 'August';
                                            else if ($i == 9)
                                                $m = 'September';
                                            else if ($i == 10)
                                                $m = 'October';
                                            else if ($i == 11)
                                                $m = 'November';
                                            else if ($i == 12)
                                                $m = 'December'; ?>
                                            
                                            <option value="<?php echo $i; ?>"
                                                <?php if($i == $month) echo 'selected'; ?>>
                                                    <?php echo $m; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="operation" value="selection">
                        <div class="col-md-3" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary">Show Report</button>
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