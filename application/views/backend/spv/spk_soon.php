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
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th width="10%">Status</th>
                            <th width="20%">Periode</th>
                            <th width="10%">Remaining Time</th>
                            <th width="5%">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th>Remaining Time</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php 
                        $this->db->from('employee');
                        $this->db->where('employee_status !=', 'Resign');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $sql2 = $this->db->get();
                        foreach ($sql2->result_array() as $row):
                            $this->db->from('spk');
                            $this->db->join('employee', 'spk.nik = employee.nik');
                            $this->db->where('spk.nik', $row['nik']);
                            $this->db->order_by('spk_enddate', 'DESC');
                            $this->db->limit(1);
                            $spk2 = $this->db->get();
                        
                            if($spk2->num_rows() > 0){
                                if(date('Y-m-d') <= $spk2->row()->spk_enddate) {
                                    if(date($spk2->row()->spk_enddate) <= date('Y-m-d',strtotime('+30 days'))) {
                                        foreach ($spk2->result_array() as $row): 
                    ?>
                                            <tr style="text-align: center;">
                                                <td><?php echo $row['employee_name']; ?></td>
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
                                                <td><?php echo $row['employee_position']; ?></td>
                                                <td><?php echo $row['employee_status']; ?></td>
                                                <td><?php echo $row['spk_startdate'] . ' - ' . $row['spk_enddate']; ?></td>
                                                <td>
                                                    <?php 
                                                        $start_date = new DateTime(date('Y-m-d'));
                                                        $end_date = new DateTime($row['spk_enddate']);
                                                        $interval = $start_date->diff($end_date);
                                                        echo "$interval->days Days "; // hasil : 217 hari
                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="btn-group">
                                                        <a href="<?php echo site_url('spv/employee/edit/'. $row['nik']); ?>" class="btn btn-info">
                                                            <ion-icon name="person"></ion-icon>
                                                        </a>
                                                    </div>
                                                </td>
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
        order: [[ 5, "asc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
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
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
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