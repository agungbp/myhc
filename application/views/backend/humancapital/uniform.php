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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="m-0"><i class="fas fa-exchange-alt"></i>&nbsp;&nbsp;Log</h5>
                                </div>
                                <div class="col-6" style="text-align: right;">
                                    <?php 
                                        $usercek = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->unit_code;
                                        if (strpos($usercek, 'SVU') !== FALSE) { 
                                    ?>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-success pull-left" data-toggle="modal" data-target="#modal-md2"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;In</a>
                                                <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#modal-md"><i class="fas fa-minus"></i>&nbsp;&nbsp;&nbsp;Out</a>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="tabel-data" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th width="3%">In/Out</th>
                                        <th width="15%">Date</th>
                                        <th>Employee</th>
                                        <th width="20%">Uniform</th>
                                        <th width="3%">Qty</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th>In/Out</th>
                                        <th>Date</th>
                                        <th>Employee</th>
                                        <th>Uniform</th>
                                        <th>Qty</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $count = 1;
                                    $this->db->from('uniform');
                                    $this->db->join('employee', 'uniform.nik = employee.nik');
                                    $this->db->where('branch_code', $this->session->userdata('login_branch'));
                                    $uniform = $this->db->get();
                                    foreach ($uniform->result_array() as $row):
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <?php if($row['uniform_inout'] == 'In') { ?>
                                                <h5><span class="badge badge-success"><?php echo $row['uniform_inout'] ?></span></h5>
                                            <?php } elseif ($row['uniform_inout'] == 'Out') { ?>
                                                <h5><span class="badge badge-danger"><?php echo $row['uniform_inout'] ?></span></h5>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;"><?php echo $row['uniform_date']; ?></td>
                                        <td><?php echo $row['employee_name']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['uniformstock_code']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['uniform_qty']; ?></td>
                                    </tr>
                                <?php endforeach; ?>    
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="m-0"><i class="fas fa-layer-group"></i>&nbsp;&nbsp;Stock</h5>
                                </div>
                                <div class="col-6" style="text-align: right;">
                                    <?php 
                                        if (strpos($usercek, 'SVU') !== FALSE) { 
                                    ?>
                                            <a href="#" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal-md3"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Add</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="tabel-data2" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Type</th>
                                        <th>Gender</th>
                                        <th width="5%">Size</th>
                                        <th width="5%">Qty</th>
                                        <?php 
                                            if (strpos($usercek, 'SVU') !== FALSE) { 
                                        ?>
                                                <th width="5%">Options</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th>Type</th>
                                        <th>Gender</th>
                                        <th>Size</th>
                                        <th>Qty</th>
                                        <?php 
                                            if (strpos($usercek, 'SVU') !== FALSE) { 
                                        ?>
                                                <th>Options</th>
                                        <?php } ?>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $count1 = 1;
                                    $stock = $this->db->get_where('uniform_stock', array('branch_code' => $this->session->userdata('login_branch')))->result_array();
                                    foreach ($stock as $row):
                                ?>
                                    <tr style="text-align: center;">
                                        <td><?php echo $row['uniformstock_type']; ?></td>
                                        <td>
                                            <?php
                                                if ($row['uniformstock_gender'] == 'L') {
                                                    echo 'Laki-Laki';
                                                } elseif ($row['uniformstock_gender'] == 'P') {
                                                    echo 'Perempuan';
                                                } elseif ($row['uniformstock_gender'] == 'AS') {
                                                    echo 'All Size';
                                                }
                                            ?></td>
                                        <td><?php echo $row['uniformstock_size']; ?></td>
                                        <td><?php echo $row['uniformstock_stock']; ?></td>
                                        <?php 
                                            if (strpos($usercek, 'SVU') !== FALSE) { 
                                        ?>
                                                <td style="text-align: center;">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-success" onclick="FormModalMd('<?php echo site_url('modal/popup/uniform_edit/'.$row['uniformstock_id'] ); ?>');">
                                                            <ion-icon name="create"></ion-icon>
                                                        </a>
                                                        <a href="#" class="btn btn-danger" onclick="DeleteModal('<?php echo site_url('humancapital/uniform/delete/'. $row['uniformstock_id']); ?>');">
                                                            <ion-icon name="trash"></ion-icon>
                                                        </a>
                                                    </div>
                                                </td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach; ?>    
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-md" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'uniform_out.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-md2" data-backdrop="true">
    <div class="modal-dialog modal-md2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'uniform_in.php' ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-md3" data-backdrop="true">
    <div class="modal-dialog modal-md3">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'uniform_add.php' ?>
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
            order: [[ 1, "desc" ]],
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                }
            ]
        } );

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
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tabel-data2 tfoot th').each( function () {
            var title2 = $(this).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title2+'" />' );
        } );

        var table2 = $('#tabel-data2').DataTable( {
            orderCellsTop: true,
            dom: 'Bfrtip',
            //pageLength: 11,
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                }
            ]
        } );

        table2.columns().every( function () {
            var that2 = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that2.search() !== this.value ) {
                    that2
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );
</script>