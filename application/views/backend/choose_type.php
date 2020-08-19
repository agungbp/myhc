<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHC | Pilih tipe user</title>
    <link rel="icon" href="<?php echo base_url();?>assets/favicon.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url();?>assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- Bootstrap Select -->
    <script src="<?php echo base_url();?>assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
</head>



    <div id="myModal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih tipe user</h5>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="row">
                        <?php
                            $this->db->from('user');
                            $this->db->where('nik', $nik);
                            $this->db->where('user_status', 'Y');
                            $this->db->where('user_application', 'MYHC');
                            $emp = $this->db->get();

                            foreach ($emp->result_array() as $row):
                        ?>
                                <div class="col-3 mx-auto text-center">
                                    <a href="<?php echo site_url('login/select/'. $row['nik'] . '/' . $row['user_type'] . '/' . $row['user_id']); ?>" class="btn btn-dark btn-block" style="padding: 15px;"><i class="fas fa-user fa-2x" style="margin-bottom: 10px;"></i><br><?php echo $row['user_type']; ?></a><br>
                                </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo site_url('login'); ?>" type="button" class="btn btn-danger">Kembali ke halaman login</a>
                </div>
            </div>
        </div>
        </div>

    <script type="text/javascript">
        $(document).ready(function () { $('#myModal').modal('show'); });
    </script>
</body>
</html>