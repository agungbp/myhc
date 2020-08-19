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
                <table id="tabel-data" class="table table-striped table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Create Date</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Create Date</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $this->db->from('speakup');
                        $this->db->join('employee', 'speakup.nik = employee.nik');
                        $this->db->where('branch_code', $this->session->userdata('login_branch'));
                        $speakup = $this->db->get();

                        foreach ($speakup->result_array() as $row):
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
                            <td><?php echo $row['employee_position'] ?></td>
                            <td><?php echo $row['speakup_subject'] ?></td>
                            <td><?php echo mb_strimwidth(nl2br($row['speakup_description']), 0, 100, "...") ?></td>
                            <td style="text-align: center;"><?php echo $row['speakup_createdate']; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['speakup_status'] == 'Read') { ?>
                                    <h5>
                                        <span class="badge badge-success">
                                            <?php 
                                                echo $row['speakup_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['speakup_status'] == 'Unread') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['speakup_status'] ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="#" class="btn btn-info" onclick="FormModal('<?php echo site_url('modal/popup/speakup_details/'.$row['speakup_id'] ); ?>');">
                                    <ion-icon name="eye"></ion-icon>&nbsp;Details
                                </a>
                                <?php if($row['speakup_status'] == 'Unread'){ ?>
                                    <a href="<?php echo site_url('humancapital/speakup/read/'. $row['speakup_id']); ?>" class="btn btn-dark">
                                        <i class="fas fa-check"></i>&nbsp;&nbsp;Mark as read
                                    </a>
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
        order: [[ 6, "desc" ]],
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