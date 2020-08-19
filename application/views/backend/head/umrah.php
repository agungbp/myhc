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
                            <th width="15%">Join Date</th>
                            <th width="15%">Length of work</th>
                            <th width="15%">Umrah Date</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Join Date</th>
                            <th>Length of work</th>
                            <th>Umrah Date</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $count = 1;
                        $this->db->from('umrah');
                        $this->db->join('employee', 'umrah.nik = employee.nik');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $umrah = $this->db->get();

                        foreach ($umrah->result_array() as $row):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['employee_name']; ?></td>
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
                            <td style="text-align: center;"><?php echo $row['employee_join']; ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    if($row['employee_join'] != NULL || $row['employee_join'] != ''){
                                        $date1  = strtotime($row['employee_join']);
                                        $date2  = strtotime('now'); 
                                        $diff   = abs($date2 - $date1);
                                        $years  = floor($diff / (365*60*60*24));
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
                                        $days   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                        echo $years . ' Years ' . $months . ' Months ' . $days . ' Days';
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['umrah_date']; ?></td>
                            <td style="text-align: center;">
                                <?php if ($row['umrah_status'] == 'Pending') { ?>
                                    <h5><span class="badge badge-secondary">Pending</span></h5>   
                                <?php } elseif ($row['umrah_status'] == 'Scheduled') { ?>
                                    <h5><span class="badge badge-info">Scheduled</span></h5>   
                                <?php } elseif ($row['umrah_status'] == 'Done') { ?>
                                    <h5><span class="badge badge-success">Done</span></h5>
                                <?php } ?>
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
        order: [[ 3, "desc"]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
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