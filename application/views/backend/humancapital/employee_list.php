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
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('branch_code' => $this->session->userdata('login_branch')))->num_rows();
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TETAP</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'TETAP', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">PKWT1</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'PKWT1', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">PKWT2</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'PKWT2', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">SOS</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'SOS', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">FREELANCE</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'FREELANCE', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">MITRA</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'MITRA', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">HS 2020</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'HS 2020', 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open(site_url('humancapital/employee/search')); ?>
                        <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Search</div>
                                <div class="col-lg-1 col-12">
                                    <select class="form-control selectpicker" name="searchmethod" data-live-search="true" required>
                                        <option value="NAME" <?php if ($searchmethod == 'NAME') echo 'selected'; ?>>NAME</option>
                                        <option value="NIK" <?php if ($searchmethod == 'NIK') echo 'selected'; ?>>NIK</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <input type="text" class="form-control" name="search" value="<?php echo $search ?>" required>
                                </div>
                                <div class="col-lg-1 col-12" style="margin-top: 0px;">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i>&nbsp;&nbsp;Search</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        <hr>
                        <?php echo form_open(site_url('humancapital/employee/filter')); ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Join Period</div>
                                <div class="col-lg-2 col-12">
                                    <input type="date" class="form-control" name="start" value="<?php echo $start ?>" id="txt_employee_joinstart" required <?php if ($employee_join == 'All') echo 'disabled'; ?>>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <input type="date" class="form-control" name="end" value="<?php echo $end ?>" id="txt_employee_joinend" required <?php if ($employee_join == 'All') echo 'disabled'; ?>>
                                </div>
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">
                                    <div class="form-check" style="margin-top: 0px;">
                                        <input class="form-check-input" type="checkbox" value="All" name="employee_join" id="chk_employee_join" <?php if ($employee_join == 'All') echo 'checked'; ?>>
                                        <label class="form-check-label">ALL PERIOD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Department</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="section_code" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE DEPARTMENT --</option>
                                        <option value="All" <?php if ($section_code == 'All') echo 'selected'; ?>>ALL DEPARTMENT</option>
                                        <?php $section = $this->db->get_where('section', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                            foreach ($section as $row1): ?>
                                                <option value="<?php echo $row1['section_code']; ?>" <?php if($section_code == $row1['section_code']) echo 'selected'; ?>><?php echo $row1['section_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Status</div>
                                <div class="col-lg-4 col-12">
                                    <select class="form-control selectpicker" name="employee_status" data-live-search="true" required>
                                        <option value="" selected>-- CHOOSE STATUS --</option>
                                        <option value="All" <?php if ($employee_status == 'All') echo 'selected'; ?>>ALL STATUS</option>
                                        <option value="FREELANCE" <?php if ($employee_status == 'FREELANCE') echo 'selected'; ?>>FREELANCE</option>
                                        <option value="HS 2020" <?php if ($employee_status == 'HS 2020') echo 'selected'; ?>>HS 2020</option>
                                        <option value="MITRA" <?php if ($employee_status == 'MITRA') echo 'selected'; ?>>MITRA</option>
                                        <option value="PKWT1" <?php if ($employee_status == 'PKWT1') echo 'selected'; ?>>PKWT1</option>
                                        <option value="PKWT2" <?php if ($employee_status == 'PKWT2') echo 'selected'; ?>>PKWT2</option>
                                        <option value="SOS" <?php if ($employee_status == 'SOS') echo 'selected'; ?>>SOS</option>
                                        <option value="TETAP" <?php if ($employee_status == 'TETAP') echo 'selected'; ?>>TETAP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php 
                        $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->unit_code;
                        if (strpos($usercek, 'SVU') !== FALSE) { 
                    ?>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-5 col-12">
                                        <a href="<?php echo site_url('humancapital/employee/add'); ?>" class="btn btn-primary pull-left"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Employee</a> 
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>NPWP</th>
                                        <th>KTP</th>
                                        <th>Masa Berlaku KTP</th>
                                        <th>BPJS Kesehatan</th>
                                        <th>BPJS Ketenagakerjaan</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status Perkawinan</th>
                                        <th>Agama</th>
                                        <th>Nomor HP</th>
                                        <th>Nomor HP 2</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Nomor Rekening</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Sekolah</th>
                                        <th>Jurusan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Department</th>
                                        <th>Unit</th>
                                        <th>Jabatan</th>
                                        <th>Pangkat</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Area</th>
                                        <th>Zona</th>
                                        <th>Courier ID</th>
                                        <th>Orion ID</th>
                                        <th>Regional</th>
                                        <th>Branch</th>
                                        <th>Origin</th>
                                        <th>Zone</th>
                                        <th>Created By</th>
                                        <th>SPK</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>NPWP</th>
                                        <th>KTP</th>
                                        <th>Masa Berlaku KTP</th>
                                        <th>BPJS Kesehatan</th>
                                        <th>BPJS Ketenagakerjaan</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status Perkawinan</th>
                                        <th>Agama</th>
                                        <th>Nomor HP</th>
                                        <th>Nomor HP 2</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Nomor Rekening</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Sekolah</th>
                                        <th>Jurusan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Department</th>
                                        <th>Unit</th>
                                        <th>Jabatan</th>
                                        <th>Pangkat</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Area</th>
                                        <th>Zona</th>
                                        <th>Courier ID</th>
                                        <th>Orion ID</th>
                                        <th>Regional</th>
                                        <th>Branch</th>
                                        <th>Origin</th>
                                        <th>Zone</th>
                                        <th>Created By</th>
                                        <th>SPK</th>
                                        <th>Options</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $expired = 0;

                                        $this->db->from('employee');
                                        $this->db->where('employee_status', '0');
                                        $sql = $this->db->get();

                                        if ($employee_join == 'All' && $section_code == 'All' && $employee_status == 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join != 'All' && $start != NULL && $end != NULL && $section_code == 'All' && $employee_status == 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('employee_join >=', $start);
                                            $this->db->where('employee_join <=', $end);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join == 'All' && $section_code != 'All' && $employee_status == 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('section_code', $section_code);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join == 'All' && $section_code == 'All' && $employee_status != 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('employee_status', $employee_status);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join == 'All' && $section_code != 'All' && $employee_status != 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('employee_status', $employee_status);
                                            $this->db->where('section_code', $section_code);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join != 'All' && $start != NULL && $end != NULL && $section_code != 'All' && $employee_status == 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('employee_join >=', $start);
                                            $this->db->where('employee_join <=', $end);
                                            $this->db->where('section_code', $section_code);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join != 'All' && $start != NULL && $end != NULL && $section_code == 'All' && $employee_status != 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('employee_join >=', $start);
                                            $this->db->where('employee_join <=', $end);
                                            $this->db->where('employee_status', $employee_status);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } elseif ($employee_join != 'All' && $start != NULL && $end != NULL && $section_code != 'All' && $employee_status != 'All') {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->where('employee_join >=', $start);
                                            $this->db->where('employee_join <=', $end);
                                            $this->db->where('section_code', $section_code);
                                            $this->db->where('employee_status', $employee_status);
                                            $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                            $sql = $this->db->get();
                                        } 

                                        if ($searchmethod == 'NAME' && $search != NULL) {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->like('employee_name', $search);
                                            $sql = $this->db->get();
                                        } elseif ($searchmethod == 'NIK' && $search != NULL) {
                                            $this->db->from('employee');
                                            $this->db->where('employee_status !=', 'Resign');
                                            $this->db->like('nik', $search);
                                            $sql = $this->db->get();
                                        }

                                        foreach ($sql->result_array() as $row): 
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row['nik']; ?></td>
                                            <td><?php echo $row['employee_name']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_npwp']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_ktp']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_ktpexpire']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_bpjskesehatan']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_bpjsketenagakerjaan']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_birthplace']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_birthdate']; ?></td>
                                            <td style="text-align: center;"><?php echo date_diff(date_create($row['employee_birthdate']), date_create('today'))->y; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_gender']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_marital']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_religion']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_phone']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_phone2']; ?></td>
                                            <td><?php echo $row['employee_address']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_city']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_banknumber']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_education']; ?></td>
                                            <td><?php echo $row['employee_university']; ?></td>
                                            <td><?php echo $row['employee_major']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_join']; ?></td>
                                            <td>
                                                <?php 
                                                    $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                                    if($section->num_rows() > 0){
                                                        echo $section->row()->section_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code'])); 
                                                    if($unit->num_rows() > 0){
                                                        echo $unit->row()->unit_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row['employee_position']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_level']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_type']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_status']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_area']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['employee_zona']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['courier_id']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['orion_id']; ?></td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    $regional = $this->db->get_where('regional', array('regional_code' => $row['regional_code'])); 
                                                    if($regional->num_rows() > 0){
                                                        echo $regional->row()->regional_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    $branch = $this->db->get_where('branch', array('branch_code' => $row['branch_code'])); 
                                                    if($branch->num_rows() > 0){
                                                        echo $branch->row()->branch_desc;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    $origin = $this->db->get_where('origin', array('origin_code' => $row['origin_code'])); 
                                                    if($origin->num_rows() > 0){
                                                        echo $origin->row()->origin_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    $zone = $this->db->get_where('zone', array('zone_code' => $row['zone_code'])); 
                                                    if($zone->num_rows() > 0){
                                                        echo $zone->row()->zone_desc;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    echo $row['createdate'];

                                                    $created = $this->db->get_where('employee', array('nik' => $row['createby'])); 
                                                    if($created->num_rows() > 0){
                                                        echo '<br> ' . $created->row()->employee_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;" width="10%">
                                                <?php
                                                    $this->db->from('spk');
                                                    $this->db->where('nik', $row['nik']);
                                                    $this->db->order_by('spk_enddate', 'DESC');
                                                    $this->db->limit(1);
                                                    $spk = $this->db->get();

                                                    if($spk->num_rows() > 0){
                                                        if(date('Y-m-d') <= $spk->row()->spk_enddate) {
                                                ?>
                                                            <h5><span class="badge badge-success">ACTIVE</span></h5>
                                                <?php   } else { ?>
                                                            <h5><span class="badge badge-danger">EXPIRED</span></h5>
                                                <?php       $expired++; 
                                                        } 
                                                    } else {
                                                ?>
                                                    <h5><span class="badge badge-dark">NO DATA</span></h5>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;" width="10%">
                                                <div class="btn-group">
                                                    <a href="<?php echo site_url('humancapital/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                                        <i class="fas fa-user"></i>
                                                    </a>
                                                    <?php 
                                                        if (strpos($usercek, 'SVU') !== FALSE) { 
                                                    ?>
                                                            <a href="<?php echo site_url('humancapital/employee/edit/'. $row['nik']); ?>" class="btn btn-success">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/employee/delete/'. $row['nik']); ?>');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#tabel-data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    var table = $('#tabel-data').DataTable( {
        'columnDefs': [
            { targets: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 26, 28, 29, 30, 31, 32, 33, 34, 36 ], visible: false }
        ],
        orderCellsTop: true,
        dom:
            "<'row'<'col-sm-5'l><'col-sm-4 text-center'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        order: [[ 1, "asc" ]],
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );

    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>

<script type="text/javascript">
    $('#chk_employee_join').click(function(){
        if($(this).is(':checked')){
            $('#txt_employee_joinstart').attr("disabled", true);
            $('#txt_employee_joinend').attr("disabled", true);
        } else{
            $('#txt_employee_joinstart').attr("disabled", false);
            $('#txt_employee_joinend').attr("disabled", false);
        }
    });
</script>