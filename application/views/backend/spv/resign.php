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
                    $this->db->from('employee');
                    $this->db->join('resign', 'employee.nik = resign.nik');
                    $this->db->where('employee.section_code', $this->session->userdata('login_section'));
                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                    $resign = $this->db->get();
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-data">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Employee</th>
                            <th>Unit</th>
                            <th>Reason</th>
                            <th width="10%">Apply Date</th>
                            <th width="10%">Status</th>
                            <th width="10%">Resign Date</th>
                            <th>Severance</th>
                            <th width="5%">Payment Status</th>
                            <th width="5%">Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>Employee</th>
                            <th>Unit</th>
                            <th>Reason</th>
                            <th>Apply Date</th>
                            <th>Status</th>
                            <th>Resign Date</th>
                            <th>Severance</th>
                            <th>Payment Status</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($resign->result_array() as $row): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['employee_name'] ?></td>
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
                            <td><?php echo nl2br($row['resign_reason']) ?></td>
                            <td style="text-align: center;"><?php echo $row['resign_createdate']; ?></td>
                            <td style="text-align: center;">
                                <?php if($row['resign_status'] == 'Waiting for SPV Approval') { ?>
                                    <h5><span class="badge badge-secondary"><?php echo $row['resign_status'] ?></span></h5>
                                <?php } elseif ($row['resign_status'] == 'SPV Approved') { ?>
                                    <h5>
                                        <span class="badge badge-primary">
                                            <?php 
                                                echo $row['resign_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['resign_status'] == 'Approved') { ?>
                                    <h5>
                                        <span class="badge badge-success">
                                            <?php 
                                                echo $row['resign_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['resign_status'] == 'SPV Declined') { ?>
                                    <h5>
                                        <span class="badge badge-danger">
                                            <?php 
                                                echo $row['resign_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } elseif ($row['resign_status'] == 'Declined') { ?>
                                    <h5>
                                        <span class="badge badge-danger">
                                            <?php 
                                                echo $row['resign_status'];
                                                $created = $this->db->get_where('employee', array('nik' => $row['approveby'])); 
                                                if($created->num_rows() > 0){
                                                    echo ' by ' . $created->row()->employee_name;
                                                } else {
                                                    echo '';
                                                }
                                            ?>
                                        </span>
                                    </h5>
                                <?php } ?>
                                <?php echo nl2br($row['resign_note']) ?>
                            </td>
                            <td style="text-align: center;"><?php echo $row['resign_date']; ?></td>
                            <td>
                                <?php 
                                    if ($row['resign_status'] == 'Approved') {
                                        echo '<b>Severance : </b> Rp ' . number_format($row['resign_severance']) . '<br>';
                                        //echo '<b>Leave : </b> Rp ' . number_format($row['resign_leave']) . '<br>';
                                        echo '<b>Loan : </b> Rp ' . number_format($row['resign_loan']) . '<br>';
                                        // echo '<b>Total : </b> Rp ' . number_format($row['resign_sum']);
                                    } elseif ($row['resign_status'] != 'Approved') {
                                        echo '';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['resign_paystatus'] == 'Paid') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['resign_paystatus'] ?></span></h5>
                                <?php } elseif ($row['resign_paystatus'] == 'Unpaid') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['resign_paystatus'] ?></span></h5>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('spv/employee/profile/'. $row['nik']); ?>" class="btn btn-info">
                                        <ion-icon name="person"></ion-icon>
                                    </a>
                                    &nbsp;
                                    <?php if ($row['resign_status'] == 'Waiting for SPV Approval') { ?>
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <ion-icon name="create"></ion-icon>&nbsp;Update Status
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?php echo site_url('spv/resign/change_status_approved/'. $row['resign_id']); ?>">Approve</a>
                                                <a class="dropdown-item" href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/resign_decline/'.$row['resign_id'] ); ?>');">Decline</a>
                                            </div>
                                        </div>
                                    <?php } ?>
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
        order: [[ 3, "desc" ]],
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