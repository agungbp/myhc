<?php 

    $employee = $this->db->get_where('employee', array('nik'=>$nik))->result_array();
    foreach ($employee as $row):
?>
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

        <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-tab" data-toggle="pill" href="#personal" role="tab" aria-controls="personal" aria-selected="true"><i class="fas fa-user"></i>&nbsp;&nbsp;Personal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="spk-tab" data-toggle="pill" href="#spk" role="tab" aria-controls="spk" aria-selected="false"><i class="fas fa-file-signature"></i>&nbsp;&nbsp;SPK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pa-tab" data-toggle="pill" href="#pa" role="tab" aria-controls="pa" aria-selected="false"><i class="fas fa-tasks"></i>&nbsp;&nbsp;PA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="asset-tab" data-toggle="pill" href="#asset" role="tab" aria-controls="asset" aria-selected="false"><i class="fas fa-barcode"></i>&nbsp;&nbsp;Asset</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="family-tab" data-toggle="pill" href="#family" role="tab" aria-controls="family" aria-selected="false"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Family</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="file-tab" data-toggle="pill" href="#file" role="tab" aria-controls="file" aria-selected="false"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;File</a>
                        </li>
                    </ul>
                </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <?php  echo form_open(site_url('humancapital/employee/update/') . $row['nik'], array('enctype' => 'multipart/form-data')); ?>
                            <?php include 'employee_edit_personal.php' ?>
                        <?php echo form_close(); ?>
                    </div>

                    <div class="tab-pane fade" id="spk" role="tabpanel" aria-labelledby="spk-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/spk_add/'.$nik); ?>');" class="btn btn-primary pull-left">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Create SPK
                                </a>
                                <br><br>
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('spk_enddate', 'desc');
                                    $spk = $this->db->get_where('spk', array('nik' => $nik));
                                    if($spk->num_rows() < 1){ 
                                        ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th width="2%">#</th>
                                                <th>Number</th>
                                                <th width="20%">Periode</th>
                                                <th>Salary</th>
                                                <th width="15%">Employee Status</th>
                                                <th width="15%">Status</th>
                                                <th width="10%">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($spk->result_array() as $row): ?>
                                                <tr style="text-align: center;">
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['spk_number']; ?></td>
                                                    <td><?php echo $row['spk_startdate'] . ' - ' . $row['spk_enddate']; ?></td>
                                                    <td>
                                                        <?php
                                                            if($row['spk_salarytype'] == 'Bulanan'){
                                                                $type = '/Bulan';
                                                            } elseif($row['spk_salarytype'] == 'Harian') {
                                                                $type = '/Hari';
                                                            } elseif($row['spk_salarytype'] == 'Connote') {
                                                                $type = '/Connote';
                                                            }
                                                            
                                                            echo 'Rp ' . number_format($row['spk_salary']) . $type;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['spk_status'] ?></td>
                                                    <td>
                                                        <?php if ($row['spk_enddate'] >= date('Y-m-d')) { ?>
                                                            <h5><span class="badge badge-success">Active</span></h5>   
                                                        <?php } else { ?>
                                                            <h5><span class="badge badge-danger">Expired</span></h5>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="btn-group">
                                                            <?php if ($row['spk_status'] == 'FREELANCE') { ?>
                                                                <a href="<?php echo site_url('humancapital/spk/print_freelance/'.$row['spk_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                    <ion-icon name="print"></ion-icon>
                                                                </a>
                                                            <?php } else if ($row['spk_status'] == 'MITRA') { ?>
                                                                <a href="<?php echo site_url('humancapital/spk/print_mitra/'.$row['spk_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                    <ion-icon name="print"></ion-icon>
                                                                </a>
                                                            <?php } else if ($row['spk_status'] == 'PKWT1' || $row['spk_status'] == 'PKWT2') { ?>
                                                                <a href="<?php echo site_url('humancapital/spk/print_pkwt/'.$row['spk_id'].'/'.$row['nik']); ?>" class="btn btn-dark" target="_blank">
                                                                    <ion-icon name="print"></ion-icon>
                                                                </a>
                                                            <?php } ?>
                                                            <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/spk_edit/'.$row['spk_id'].'/'.$nik); ?>');">
                                                                <ion-icon name="create"></ion-icon>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('humancapital/spk/delete/'.$row['spk_id'].'/'.$nik); ?>');">
                                                                <ion-icon name="trash"></ion-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="asset" role="tabpanel" aria-labelledby="asset-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/asset_add/'.$nik); ?>');" class="btn btn-primary pull-left">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Asset
                                </a>
                                <br><br>
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('asset_date', 'desc');
                                    $asset = $this->db->get_where('asset', array('nik' => $nik, 'asset_status' => 'Active'));
                                    if($asset->num_rows() < 1){ 
                                        ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th width="2%">#</th>
                                                <th>Asset Number</th>
                                                <th>Serial Number</th>
                                                <th>Type</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th width="10%">Date</th>
                                                <th>Spesifications</th>
                                                <th width="10%">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($asset->result_array() as $row): ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $count++; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['asset_number']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['asset_serialnumber']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['asset_name'] ?></td>
                                                    <td style="text-align: center;"><?php echo $row['asset_merk'] ?></td>
                                                    <td style="text-align: center;"><?php echo $row['asset_model']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['asset_date'];?></td>
                                                    <td><?php echo nl2br($row['asset_spesification']); ?></td>
                                                    <td style="text-align: center;">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/asset_edit/'.$row['asset_id'].'/'.$nik); ?>');">
                                                                <ion-icon name="create"></ion-icon>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('humancapital/asset/delete/'.$row['asset_id'].'/'.$nik); ?>');">
                                                                <ion-icon name="trash"></ion-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pa" role="tabpanel" aria-labelledby="pa-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/pa_add/'.$nik); ?>');" class="btn btn-primary pull-left">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Add PA
                                </a>
                                <br><br>
                            </div>
                            <div class="panel-body">
                            <?php 
                                $count = 1;
                                $this->db->order_by('pa_year', 'asc');
                                $pa = $this->db->get_where('pa', array('nik' => $nik));
                                if($pa->num_rows() < 1){ 
                                    ?>
                                    <div class="alert alert-info">
                                        No data to display
                                    </div>
                            <?php   } else { ?>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="3%">#</th>
                                            <th>Year</th>
                                            <th>PA</th>
                                            <th width="10%">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pa->result_array() as $row): ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $count++; ?></td>
                                                <td style="text-align: center;"><?php echo $row['pa_year']; ?></td>
                                                <td style="text-align: center;"><?php echo $row['pa_assesment']; ?></td>
                                                <td style="text-align: center;">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/pa_edit/'.$row['pa_id'].'/'.$nik); ?>');">
                                                            <ion-icon name="create"></ion-icon>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('humancapital/pa/delete/'.$row['pa_id'].'/'.$nik); ?>');">
                                                            <ion-icon name="trash"></ion-icon>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <a href="#" onclick="FormModal('<?php echo site_url('modal/popup/family_add/'.$nik); ?>');" class="btn btn-primary pull-left">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Family
                                </a>
                                <br><br>
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $count = 1;
                                    $this->db->order_by('family_name');
                                    $family = $this->db->get_where('family', array('nik' => $nik));
                                    if($family->num_rows() < 1){ 
                                ?>
                                        <div class="alert alert-info">
                                            No data to display
                                        </div>
                                <?php   } else { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th width="2%">#</th>
                                                <th width="15%">KTP</th>
                                                <th width="15%">BPJS</th>
                                                <th width="15%">Status</th>
                                                <th>Name</th>
                                                <th width="5%">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($family->result_array() as $row): ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $count++; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['family_ktp']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['family_bpjs']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['family_status']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['family_name']; ?></td>
                                                    <td style="text-align: center;">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success btn-sm " onclick="FormModal('<?php echo site_url('modal/popup/family_edit/'.$row['family_id'].'/'.$nik); ?>');">
                                                                <ion-icon name="create"></ion-icon>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm " onclick="DeleteModal('<?php echo site_url('humancapital/family/delete/'.$row['family_id'].'/'.$nik); ?>');">
                                                                <ion-icon name="trash"></ion-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                
                    <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th width="5%">#</th>
                                        <th width="15%">File</th>
                                        <th width="40%">Document Name</th>
                                        <th width="20%">Options</th>
                                        <th width="25%">Description</th>
                                    </tr>
                                </thead>
                                <?php
                                        if (!empty($file = $this->db->get_where('file', array('nik'=>$nik))->result_array())) {
                                            foreach ($file as $row):
                                                echo form_open(site_url('humancapital/file/upload/'). $row['nik'], array('enctype' => 'multipart/form-data')); ?>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">1</td>
                                                            <td>KTP</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/nik/' . $row['file_ktp']; ?>" target="_blank">
                                                                    <?php echo $row['file_ktp']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_ktp" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">2</td>
                                                            <td>SIM</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/sim/' . $row['file_sim']; ?>" target="_blank">
                                                                    <?php echo $row['file_sim']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_sim" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">3</td>
                                                            <td>KK</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/kk/' . $row['file_kk']; ?>" target="_blank">
                                                                    <?php echo $row['file_kk']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_kk" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">4</td>
                                                            <td>Ijazah</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/ijazah/' . $row['file_ijazah']; ?>" target="_blank">
                                                                    <?php echo $row['file_ijazah']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_ijazah" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">5</td>
                                                            <td>Transkrip Nilai</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/transkrip/' . $row['file_transkrip']; ?>" target="_blank">
                                                                    <?php echo $row['file_transkrip']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_transkrip" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">6</td>
                                                            <td>Curriculum Vitae</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/cv/' . $row['file_cv']; ?>" target="_blank">
                                                                    <?php echo $row['file_cv']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_cv" accept=".pdf" id="uploadfile"/></td>
                                                            <td>.pdf (max: 500kb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;">7</td>
                                                            <td>Lainnya (Disatukan dalam satu file)</td>
                                                            <td>
                                                                <a href="<?php echo base_url().'uploads/file/other/' . $row['file_other']; ?>">
                                                                    <?php echo $row['file_other']; ?>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;"><input type="file" name="file_other" accept=".rar, .zip" id="uploadfileother"/></td>
                                                            <td>.rar/.zip (max: 2mb)</td>                           
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5"><button type="submit" class="btn btn-primary">Save</button></td>
                                                        </tr>
                                                    </tbody>
                                        <?php   echo form_close(); 
                                            endforeach; 
                                        } else { 
                                            echo form_open(site_url('humancapital/file/upload_edit/'). $row['nik'], array('enctype' => 'multipart/form-data')); 
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">1</td>
                                                        <td>KTP</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_ktp" accept=".pdf" id="uploadfile"/></td>
                                                        <td>.pdf (max: 500kb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">2</td>
                                                        <td>SIM</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_sim" accept=".pdf" id="uploadfile"/></td>
                                                        <td>.pdf (max: 500kb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">3</td>
                                                        <td>KK</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_kk" accept=".pdf" id="uploadfile"/></td>
                                                        <td>.pdf (max: 500kb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">4</td>
                                                        <td>Ijazah</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_ijazah" accept=".pdf" id="uploadfile"/></td>
                                                        <td>.pdf (max: 500kb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">5</td>
                                                        <td>Transkrip Nilai</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_transkrip" accept=".pdf" id="uploadfile"/></td>
                                                        <td>.pdf (max: 500kb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">6</td>
                                                        <td>Curriculum Vitae</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_cv" accept=".pdf" id="uploadfile"/></td>
                                                        <td>.pdf (max: 500kb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">7</td>
                                                        <td>Lainnya (Disatukan dalam satu file)</td>
                                                        <td></td>
                                                        <td style="text-align: center;"><input type="file" name="file_other" accept=".rar, .zip" id="uploadfileother"/></td>
                                                        <td>.rar/.zip (max: 2mb)</td>                           
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"><button type="submit" class="btn btn-primary">Save</button></td>
                                                    </tr>
                                                </tbody>
                                    <?php   echo form_close();
                                        } 
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php endforeach; ?>

    <script type="text/javascript">
        var uploadField = document.getElementById("uploadfile");

        uploadField.onchange = function() {
            if(this.files[0].size > 500000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>

    <script type="text/javascript">
        var uploadField = document.getElementById("uploadfileother");

        uploadField.onchange = function() {
            if(this.files[0].size > 2000000){
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>