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
        <?php $candidate = $this->db->get_where('candidate', array('candidate_ktp' => $this->session->userdata('login_nik')))->result_array();
        foreach ($candidate as $row) { ?>
            <?php echo form_open(site_url('candidate/change_password/change'), array('class' => 'validate', 'target' => '_top')); ?>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required">Password saat ini</label>
                                <input type="password" class="form-control" name="user_password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required">Password baru</label>
                                <input type="password" class="form-control" name="new_password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required">Konfirmasi password</label>
                                <input type="password" class="form-control" name="confirm_new_password">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            <?php echo form_close(); ?>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
 <!-- /.content-wrapper -->