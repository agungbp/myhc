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
                            <th>Number</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th width="10%">Status</th>
                            <th width="20%">Periode</th>
                            <th width="10%">Remaining Time</th>
                            <th>Created By</th>
                            <?php 
                                $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->unit_code;
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <th width="5%">Options</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Number</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th>Remaining Time</th>
                            <th>Created By</th>
                            <?php 
                                if (strpos($usercek, 'SVU') !== FALSE) { 
                            ?>
                                    <th>Options</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php 
                        $this->db->from('employee');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $sql2 = $this->db->get();
                        foreach ($sql2->result_array() as $row):
                            $this->db->select('spk.*, employee.employee_name');
                            $this->db->from('spk');
                            $this->db->join('employee', 'spk.nik = employee.nik');
                            $this->db->where('spk.nik', $row['nik']);
                            $this->db->order_by('spk_enddate', 'DESC');
                            $this->db->limit(1);
                            $spk2 = $this->db->get();
                        
                            if($spk2->num_rows() > 0){
                                if(date('Y-m-d') <= $spk2->row()->spk_enddate) {
                                    if(date($spk2->row()->spk_enddate) <= date('Y-m-d',strtotime('+30 days'))) {
                                        foreach ($spk2->result_array() as $row2): 
                    ?>
                                            <tr style="text-align: center;">
                                                <td style="text-align: center;"><?php echo $row2['spk_number']; ?></td>
                                                <td style="text-align: center;"><?php echo $row2['nik']; ?></td>
                                                <td><?php echo $row2['employee_name']; ?></td>
                                                <td style="text-align: center;">
                                                    <?php 
                                                        $section = $this->db->get_where('section', array('section_code' => $row2['section_code']));
                                                        if($section->num_rows() > 0){
                                                            echo $section->row()->section_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php 
                                                        $unit = $this->db->get_where('unit', array('unit_code' => $row2['unit_code']));
                                                        if($unit->num_rows() > 0){
                                                            echo $unit->row()->unit_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row2['spk_position']; ?></td>
                                                <td><?php echo $row2['spk_status']; ?></td>
                                                <td><?php echo $row2['spk_startdate'] . ' - ' . $row2['spk_enddate']; ?></td>
                                                <td>
                                                    <?php 
                                                        $start_date = new DateTime(date('Y-m-d'));
                                                        $end_date = new DateTime($row2['spk_enddate']);
                                                        $interval = $start_date->diff($end_date);
                                                        echo "$interval->days Days "; // hasil : 217 hari
                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php 
                                                        echo $row2['spk_createdate'];
                                                        
                                                        $created = $this->db->get_where('employee', array('nik' => $row2['createby'])); 
                                                        if($created->num_rows() > 0){
                                                            echo '<br> ' . $created->row()->employee_name;
                                                        } else {
                                                            echo '';
                                                        }
                                                    ?>
                                                </td>
                                                <?php 
                                                    if (strpos($usercek, 'SVU') !== FALSE) { 
                                                ?>
                                                        <td style="text-align: center;">
                                                            <div class="btn-group">
                                                                <a href="<?php echo site_url('humancapital/employee/edit/'. $row2['nik']); ?>" class="btn btn-info">
                                                                    <ion-icon name="person"></ion-icon>
                                                                </a>
                                                                <?php if ($row2['spk_status'] == 'FREELANCE') { ?>
                                                                    <a href="<?php echo site_url('humancapital/spk/print_freelance/'.$row2['spk_id'].'/'.$row2['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                        <ion-icon name="print"></ion-icon>
                                                                    </a>
                                                                <?php } else if ($row2['spk_status'] == 'MITRA') { ?>
                                                                    <a href="<?php echo site_url('humancapital/spk/print_mitra/'.$row2['spk_id'].'/'.$row2['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                        <ion-icon name="print"></ion-icon>
                                                                    </a>
                                                                <?php } else if ($row2['spk_status'] == 'PKWT1' || $row2['spk_status'] == 'PKWT2') { ?>
                                                                    <a href="<?php echo site_url('humancapital/spk/print_pkwt/'.$row2['spk_id'].'/'.$row2['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                        <ion-icon name="print"></ion-icon>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                <?php } ?>
                                            </tr>
                    <?php 
                                        endforeach; 
                                    }
                                }
                            }
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
        order: [[ 8, "asc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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