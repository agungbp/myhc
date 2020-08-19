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

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="tabel-data" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="10%">Date</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Regional</th>
                            <th>Branch</th>
                            <th>Origin</th>
                            <th>Zone</th>
                            <th width="5%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Date</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Regional</th>
                            <th>Branch</th>
                            <th>Origin</th>
                            <th>Zone</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;
                        $this->db->from('employee');
                        $this->db->join('employee_rotation', 'employee.nik = employee_rotation.nik');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $employee = $this->db->get();

                        $rotation = $this->db->get('employee_rotation')->result_array();

                        foreach ($employee->result_array() as $row):
                        foreach ($rotation as $row1):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row1['rotation_date']; ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['nik'] == $row1['rotation_nik']) {
                                        echo '<p>' . $row1['rotation_nik'] . '</p>'; 
                                    } else {
                                        echo '<p class="text-danger">' . $row1['rotation_nik'] . '</p>'; 
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['employee_name']; ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['section_code'] == $row1['rotation_section']) {
                                        $section = $this->db->get_where('section', array('section_code' => $row1['rotation_section']));
                                        if($section->num_rows() > 0){
                                            echo '<p>' . $section->row()->section_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        $section = $this->db->get_where('section', array('section_code' => $row1['rotation_section']));
                                        if($section->num_rows() > 0){
                                            echo '<p class="text-danger">' . $section->row()->section_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        } 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['unit_code'] == $row1['rotation_unit']) {
                                        $unit = $this->db->get_where('unit', array('unit_code' => $row1['rotation_unit']));
                                        if($unit->num_rows() > 0){
                                            echo '<p>' . $unit->row()->unit_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        $unit = $this->db->get_where('unit', array('unit_code' => $row1['rotation_unit']));
                                        if($unit->num_rows() > 0){
                                            echo '<p class="text-danger">' . $unit->row()->unit_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        } 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['employee_position'] == $row1['rotation_position']) {
                                        echo '<p>' . $row1['rotation_position'] . '</p>'; 
                                    } else {
                                        echo '<p class="text-danger">' . $row1['rotation_position'] . '</p>'; 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['employee_level'] == $row1['rotation_level']) {
                                        echo '<p>' . $row1['rotation_level'] . '</p>'; 
                                    } else {
                                        echo '<p class="text-danger">' . $row1['rotation_level'] . '</p>'; 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['employee_status'] == $row1['rotation_status']) {
                                        echo '<p>' . $row1['rotation_status'] . '</p>'; 
                                    } else {
                                        echo '<p class="text-danger">' . $row1['rotation_status'] . '</p>'; 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['employee_type'] == $row1['rotation_type']) {
                                        echo '<p>' . $row1['rotation_type'] . '</p>'; 
                                    } else {
                                        echo '<p class="text-danger">' . $row1['rotation_type'] . '</p>'; 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['regional_code'] == $row1['rotation_regional']) {
                                        $regional = $this->db->get_where('regional', array('regional_code' => $row1['rotation_regional']));
                                        if($regional->num_rows() > 0){
                                            echo '<p>' . $regional->row()->regional_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        $regional = $this->db->get_where('regional', array('regional_code' => $row1['rotation_regional']));
                                        if($regional->num_rows() > 0){
                                            echo '<p class="text-danger">' . $regional->row()->regional_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        } 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['branch_code'] == $row1['rotation_branch']) {
                                        $branch = $this->db->get_where('branch', array('branch_code' => $row1['rotation_branch']));
                                        if($branch->num_rows() > 0){
                                            echo '<p>' . $branch->row()->branch_desc . '</p>'; ;
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        $branch = $this->db->get_where('branch', array('branch_code' => $row1['rotation_branch']));
                                        if($branch->num_rows() > 0){
                                            echo '<p class="text-danger">' . $branch->row()->branch_desc . '</p>'; ;
                                        } else {
                                            echo '';
                                        } 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['origin_code'] == $row1['rotation_origin']) {
                                        $origin = $this->db->get_where('origin', array('origin_code' => $row1['rotation_origin']));
                                        if($origin->num_rows() > 0){
                                            echo '<p>' . $origin->row()->origin_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        $origin = $this->db->get_where('origin', array('origin_code' => $row1['rotation_origin']));
                                        if($origin->num_rows() > 0){
                                            echo '<p class="text-danger">' . $origin->row()->origin_name . '</p>'; ;
                                        } else {
                                            echo '';
                                        } 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['zone_code'] == $row1['rotation_zone']) {
                                        $zone = $this->db->get_where('zone', array('zone_code' => $row1['rotation_zone']));
                                        if($zone->num_rows() > 0){
                                            echo '<p>' . $zone->row()->zone_desc . '</p>'; ;
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        $zone = $this->db->get_where('zone', array('zone_code' => $row1['rotation_zone']));
                                        if($zone->num_rows() > 0){
                                            echo '<p class="text-danger">' . $zone->row()->zone_desc . '</p>'; ;
                                        } else {
                                            echo '';
                                        } 
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('head/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                        <ion-icon name="person"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php 
                            endforeach; 
                        endforeach;
                    ?>    
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
        order: [[ 0, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
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