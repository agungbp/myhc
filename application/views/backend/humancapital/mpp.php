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
                <?php 
                    $count = 1;
                    $mpp = $this->db->get('mpp')->result_array();
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-data">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="10%">Date</th>
                            <th width="25%">Details</th>
                            <th>Requirements</th>
                            <th>Job Description</th>
                            <th width="15%">File</th>
                            <th width="10%">Status</th>
                            <th width="3%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Date</th>
                            <th>Details</th>
                            <th>Requirements</th>
                            <th>Job Description</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($mpp as $row): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['mpp_date']; ?></td>
                            <td>
                                <?php echo '<b>Number of Needs : </b>' . $row['mpp_numberofneeds'] . '<br>' ?>
                                <?php echo '<b>Position : </b>' . $row['mpp_position'] . '<br>'; ?>
                                <?php echo '<b>Department : </b>' . $this->db->get_where('section', array('section_code' => $row['section_code']))->row()->section_name . '<br>'; ?>
                                <?php echo '<b>Unit : </b>' . $this->db->get_where('unit', array('unit_code' => $row['unit_code']))->row()->unit_name . '<br>'; ?>
                                <?php echo '<b>Zone : </b>' . $this->db->get_where('zone', array('zone_code' => $row['zone_code']))->row()->zone_desc; ?>
                            </td>
                            <td><?php echo nl2br($row['mpp_requirements']); ?></td>
                            <td><?php echo nl2br($row['mpp_jobdesc']); ?></td>
                            <td>
                                <a href="<?php echo site_url('uploads/mpp/'). $row['mpp_file']; ?>">
                                    <?php echo $row['mpp_file']; ?>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['mpp_status'] == 'Waiting for Approval') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['mpp_status'] ?></span></h5>
                                <?php } elseif ($row['mpp_status'] == 'Approve') { ?> 
                                    <h5><span class="badge badge-success"><?php echo $row['mpp_status'] ?></span></h5>
                                <?php } elseif ($row['mpp_status'] == 'Decline') { ?> 
                                    <h5><span class="badge badge-danger"><?php echo $row['mpp_status'] ?></span></h5>
                                <?php } ?>
                                <?php echo nl2br($row['mpp_note']) ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <ion-icon name="create"></ion-icon>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?php echo site_url('humancapital/mpp/change_status_approve/'. $row['mpp_id']); ?>">Approve</a>
                                        <a class="dropdown-item" href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/mpp_decline/'.$row['mpp_id'] ); ?>');">Decline</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>   
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php include 'mpp_add.php'; ?>
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
        order: [[ 0, "desc" ]],
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 8, 9 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 8, 9 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 8, 9 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 8, 9 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 8, 9 ]
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