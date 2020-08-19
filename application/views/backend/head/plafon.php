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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open(site_url('head/plafon/filter')); ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Search</div>
                                <div class="col-lg-1 col-12">
                                    <select class="form-control selectpicker" name="searchmethod" id="opt_searchmethod" data-live-search="true" required>
                                        <option value="ALL" <?php if ($searchmethod == 'ALL') echo 'selected'; ?>>ALL</option>
                                        <option value="NAME" <?php if ($searchmethod == 'NAME') echo 'selected'; ?>>NAME</option>
                                        <option value="NIK" <?php if ($searchmethod == 'NIK') echo 'selected'; ?>>NIK</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <input type="text" class="form-control" name="search" id="txt_search" value="<?php echo $search ?>" <?php if($searchmethod == 'ALL') echo 'disabled' ?>>
                                </div>
                                <div class="col-lg-1 col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-lg-1 col-12" style="margin-top: 5px;">Period</div>
                                <div class="col-lg-1 col-12">
                                    <select class="form-control selectpicker" name="plafon_periode" data-live-search="true" required>
                                        <option value="All" <?php if ($plafon_periode == 'All') echo 'selected'; ?>>ALL PERIOD</option>
                                        <?php 
                                            $this->db->select('DISTINCT(plafon_periode)');
                                            $period = $this->db->get('plafon')->result_array();
                                            foreach ($period as $row3): 
                                        ?>
                                                <option value="<?php echo $row3['plafon_periode']; ?>" <?php if ($plafon_periode == $row3['plafon_periode']) echo 'selected'; ?>><?php echo $row3['plafon_periode']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Department</th>
                            <th>Rawat Inap</th>
                            <th>Rawat Jalan</th>
                            <th>Persalinan Normal</th>
                            <th>Persalinan Sectio</th>
                            <th>Set Kacamata</th>
                            <th>Lensa</th>
                            <th width="5%">Periode</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Department</th>
                            <th>Rawat Inap</th>
                            <th>Rawat Jalan</th>
                            <th>Persalinan Normal</th>
                            <th>Persalinan Sectio</th>
                            <th>Set Kacamata</th>
                            <th>Lensa</th>
                            <th>Periode</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $this->db->from('employee');
                            $this->db->join('plafon', 'plafon.nik = employee.nik');
                            $this->db->where('employee_status !=', 'Resign');
                            $this->db->where('plafon_periode', $plafon_periode);
                            $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                            $sql = $this->db->get();

                            if ($searchmethod == 'NAME' && $search != NULL && $plafon_periode == 'All') {
                                $this->db->from('employee');
                                $this->db->join('plafon', 'plafon.nik = employee.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->like('employee_name', $search);
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                            } elseif ($searchmethod == 'NAME' && $search != NULL && $plafon_periode != 'All') {
                                $this->db->from('employee');
                                $this->db->join('plafon', 'plafon.nik = employee.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->where('plafon_periode', $plafon_periode);
                                $this->db->like('employee_name', $search);
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                            } elseif ($searchmethod == 'NIK' && $search != NULL && $plafon_periode == 'All') {
                                $this->db->from('employee');
                                $this->db->join('plafon', 'plafon.nik = employee.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->like('plafon.nik', $search);
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                            } elseif ($searchmethod == 'NIK' && $search != NULL && $plafon_periode != 'All') {
                                $this->db->from('employee');
                                $this->db->join('plafon', 'plafon.nik = employee.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->where('plafon_periode', $plafon_periode);
                                $this->db->like('plafon.nik', $search);
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                            } elseif ($searchmethod == 'ALL' && $search == NULL && $plafon_periode == 'All') {
                                $this->db->from('employee');
                                $this->db->join('plafon', 'plafon.nik = employee.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->like('plafon.nik', $search);
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                            } elseif ($searchmethod == 'ALL' && $search == NULL && $plafon_periode != 'All') {
                                $this->db->from('employee');
                                $this->db->join('plafon', 'plafon.nik = employee.nik');
                                $this->db->where('employee_status !=', 'Resign');
                                $this->db->where('plafon_periode', $plafon_periode);
                                $this->db->like('plafon.nik', $search);
                                $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
                                $sql = $this->db->get();
                            }

                            foreach ($sql->result_array() as $row):
                        ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row['nik'] ?></td>
                                    <td><?php echo $row['employee_name'] ?></td>
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
                                    <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['plafon_rawatinap']) ?></td>
                                    <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['plafon_rawatjalan']) ?></td>
                                    <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['plafon_melahirkannormal']) ?></td>
                                    <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['plafon_melahirkansectio']) ?></td>
                                    <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['plafon_setkacamata']) ?></td>
                                    <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['plafon_lensa']) ?></td>
                                    <td style="text-align: center;"><?php echo $row['plafon_periode'] ?></td>
                                </tr>
                        <?php endforeach; ?>    
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="modal-lg" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'plafon_add.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'plafon_import.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tabel-data tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        } );

        var table = $('#tabel-data').DataTable( {
            orderCellsTop: true,
            dom:
                "<'row'<'col-sm-4'l><'col-sm-5 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[ 1, "asc" ]],
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                    }
                }
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
    $(document).ready(function(){
        $("#opt_searchmethod").change(function() {
            if ($(this).val() != "ALL") {
                $('#txt_search').attr("required", true);
                $('#txt_search').attr("disabled", false);
            } else {
                $('#txt_search').attr("required", false);
                $('#txt_search').attr("disabled", true);
            }
        });
        $("#opt_rawatinap_rekening").trigger("change");  
    });
</script>