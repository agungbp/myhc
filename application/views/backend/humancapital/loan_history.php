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
            <?php 
                $quota = $this->db->get_where('loan_quota', array('branch_code' => $this->session->userdata('login_branch')))->result_array(); 
                foreach ($quota as $row):
            ?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3 style="margin-top: 10px;"><?php echo 'Rp ' . number_format($row['loanquota_remaining']); ?></h3>
                    <p style="margin-top: 10px;">Remaining Quota</p>
                </div>
                <div class="icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <?php 
                    $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->employee_position;
                    if (strpos($usercek, 'COMPENSATION & BENEFIT') !== FALSE) { 
                ?>
                        <a class="small-box-footer" href="#" onclick="FormModalMd('<?php echo site_url('modal/popup/loan_quota/'.$row['loanquota_id'] ); ?>');">Change&nbsp;&nbsp;<i class="fas fa-pen"></i></a>
                <?php } ?>
                </div>
            </div>
            <!-- ./col -->
            <?php endforeach; ?>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-body"> 
                <?php 
                    $count = 1;
                    $this->db->from('loan_history');
                    $this->db->join('employee', 'loan_history.nik = employee.nik');
                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                    $loanhistory = $this->db->get();
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-data">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="10%">In/Out</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th width="15%">Amount</th>
                            <th width="15%">Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>In/Out</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($loanhistory->result_array() as $row): ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php if($row['loanhistory_inout'] == 'In') { ?>
                                    <h5><span class="badge badge-success"><?php echo $row['loanhistory_inout'] ?></span></h5>
                                <?php } elseif ($row['loanhistory_inout'] == 'Out') { ?>
                                    <h5><span class="badge badge-danger"><?php echo $row['loanhistory_inout'] ?></span></h5>
                                <?php } ?>
                            </td>
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
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['loanhistory_amount']) ?></td>
                            <td style="text-align: center;"><?php echo $row['loanhistory_date']; ?></td>
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
        order: [[ 5, "desc" ]],
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