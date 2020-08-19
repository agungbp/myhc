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

    <?php 
        $this->db->from('employee');
        $this->db->where("DATE_FORMAT(employee_join,'%Y-%m')", date('Y-m'));
        $this->db->where('branch_code', $this->session->userdata('login_branch'));
        $emp = $this->db->get();
    ?>

    <!-- Main content -->
    <section class="content">

        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('DATE_FORMAT(employee_join,"%Y-%m")' => date('Y-m'), 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
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
                        <span class="info-box-text">Freelance</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'FREELANCE', 'DATE_FORMAT(employee_join,"%Y-%m")' => date('Y-m'), 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
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
                        <span class="info-box-text">Mitra</span>
                        <span class="info-box-number">
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'MITRA', 'DATE_FORMAT(employee_join,"%Y-%m")' => date('Y-m'), 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
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
                            <?php echo $this->db->get_where('employee', array('employee_status' => 'HS 2020', 'DATE_FORMAT(employee_join,"%Y-%m")' => date('Y-m'), 'branch_code' => $this->session->userdata('login_branch')))->num_rows(); ?>
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
                                        <th>SPK</th>
                                        <th>Options</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($emp->result_array() as $row): ?>
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
                                            <td style="text-align: center;">
                                                <?php 
                                                    $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                                    if($section->num_rows() > 0){
                                                        echo $section->row()->section_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    $unit = $this->db->get_where('unit', array('unit_code' => $row['unit_code'])); 
                                                    if($unit->num_rows() > 0){
                                                        echo $unit->row()->unit_name;
                                                    } else {
                                                        echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;"><?php echo $row['employee_position']; ?></td>
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
                                            <td style="text-align: center;" width="5%">
                                                <div class="btn-group">
                                                    <a href="<?php echo site_url('head/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                                        <ion-icon name="person"></ion-icon>
                                                    </a>
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
                { targets: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 26, 28, 29, 30, 31, 32, 33, 34 ], visible: false }
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