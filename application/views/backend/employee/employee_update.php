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
        <?php 
        $this->db->from('employee_update');
        $this->db->order_by('update_date', 'DESC');
        $this->db->where('nik', $this->session->userdata('login_nik'));
        $update = $this->db->get();
            if($update->num_rows() < 1){ ?>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                Anda tidak memiliki update request
                            </div>
                        </div>
                    </div>
                </div>
        <?php } else { ?>
            <?php foreach ($update->result_array() as $row): ?>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-lg-2 col-4">Update ID</div>
                                    <div class="col-lg-10 col-8"><b><?php echo $row['update_id']; ?></b></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-4">Type</div>
                                    <div class="col-lg-10 col-8"><b><?php echo $row['update_type']; ?></b></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-4">Process</div>
                                    <div class="col-lg-10 col-8"><b><?php echo $row['update_process']; ?></b></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-4">Req Date</div>
                                    <div class="col-lg-10 col-8">
                                        <b>
                                            <?php 
                                                $date = date_create($row['update_date']);
                                                echo date_format($date, "d F Y"); 
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-4">Status</div>
                                    <div class="col-lg-10 col-8">
                                        <b>
                                            <?php if($row['update_status'] == 'Waiting for Approval') { ?>
                                                <h5><span class="badge badge-secondary"><?php echo $row['update_status'] ?></span></h5>
                                            <?php } elseif ($row['update_status'] == 'Approved') { ?>
                                                <h5><span class="badge badge-success"><?php echo $row['update_status'] ?></span></h5>
                                            <?php } elseif ($row['update_status'] == 'Declined') { ?>
                                                <h5><span class="badge badge-danger"><?php echo $row['update_status'] ?></span></h5>
                                            <?php } ?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5" style="text-align: right;">
                                <?php if($row['update_type'] == 'Personal' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/profile/update_personal/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>

                                <?php } elseif($row['update_type'] == 'Shift' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/profile/update_shift/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                
                                <?php } elseif ($row['update_type'] == 'Asset' && $row['update_process'] == 'Create') { ?>
                                    <a href="<?php echo site_url('employee/asset/update_asset_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Asset' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/asset/update_asset_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Asset' && $row['update_process'] == 'Delete') { ?>
                                    <a href="<?php echo site_url('employee/asset/update_asset_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>

                                <?php } elseif ($row['update_type'] == 'Family' && $row['update_process'] == 'Create') { ?>
                                    <a href="<?php echo site_url('employee/family/update_family_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Family' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/family/update_family_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Family' && $row['update_process'] == 'Delete') { ?>
                                    <a href="<?php echo site_url('employee/family/update_family_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                
                                <?php } elseif ($row['update_type'] == 'Education' && $row['update_process'] == 'Create') { ?>
                                    <a href="<?php echo site_url('employee/education/update_education_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Education' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/education/update_education_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Education' && $row['update_process'] == 'Delete') { ?>
                                    <a href="<?php echo site_url('employee/education/update_education_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>

                                <?php } elseif ($row['update_type'] == 'Certification' && $row['update_process'] == 'Create') { ?>
                                    <a href="<?php echo site_url('employee/certification/update_certification_create/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Certification' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/certification/update_certification_edit/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } elseif ($row['update_type'] == 'Certification' && $row['update_process'] == 'Delete') { ?>
                                    <a href="<?php echo site_url('employee/certification/update_certification_delete/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>

                                <?php } elseif ($row['update_type'] == 'File' && $row['update_process'] == 'Update') { ?>
                                    <a href="<?php echo site_url('employee/file/update_file/'. $row['update_id']); ?>" class="btn btn-dark" style="margin-top: 0px;"><i class="fas fa-eye"></i>&nbsp;&nbsp;Details</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>   
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->