<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyHC | <?php echo $page_title;?></title>

    <link rel="icon" href="<?php echo base_url();?>assets/favicon.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
        <!-- Main content -->
        <section class="content">
            <?php
                $this->db->from('teguran');
                $this->db->join('employee', 'teguran.nik = employee.nik');
                $this->db->where('teguran_id', $teguran_id);
                $teguran = $this->db->get();

                foreach ($teguran->result_array() as $row):  
            ?>
                    <div class="row" >
                        <div class="col-10 mx-auto text-center" style="margin-top: 100px;"><u><h1><b>SURAT TEGURAN</b></h1></u></div>
                        <div class="col-10 mx-auto text-center" style="margin-top: 0px;"><h4>No. <?php echo $row['teguran_number']; ?></h4></div>
                        <div class="col-10 mx-auto text-center" style="margin-top: 0px;"><h3><b>SAUDARA <?php echo $row['employee_name']; ?></b></h3></div>
                        <div class="col-10 mx-auto"><br><br><hr style="border: 2px solid black;"><br></div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 15px;">Surat teguran ini diberikan kepada kepada :</div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-2" style="font-size: 20px; margin-left: 50px;"><b>Nama</b></div>
                                <div class="col-8" style="font-size: 20px;"><b>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['employee_name']; ?></b></div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-2" style="font-size: 20px; margin-left: 50px;"><b>NIK</b></div>
                                <div class="col-8" style="font-size: 20px;"><b>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['nik']; ?></b></div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-2" style="font-size: 20px; margin-left: 50px;"><b>Jabatan</b></div>
                                <div class="col-8" style="font-size: 20px;"><b>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['employee_position']; ?></b></div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-2" style="font-size: 20px; margin-left: 50px;"><b>Departement</b></div>
                                <div class="col-8" style="font-size: 20px; margin-bottom: 15px;"><b>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php 
                                    $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                    if($section->num_rows() > 0){
                                        echo $section->row()->section_name;
                                    } else {
                                        echo '';
                                    }
                                ?></b></div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10" style="font-size: 20px;  margin-bottom: 25px;">Surat Teguran diterbitkan berdasarkan :</div>
                            </div>
                        </div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 15px;">Bahwa Sdr. <?php echo $row['employee_name']; ?>, telah melakukan tindakan <?php echo nl2br($row['teguran_description']); ?></div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 15px;">Jika dikemudian hari Saudara didapati kembali melakukan kesalahan yang sama, maka Saudara akan dikenakan Surat Peringatan atau bahkan diminta untuk mengundurkan diri.</div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 80px;">Demikian Surat  Teguran ini dikeluarkan untuk dapat dijadikan sebagai bahan perhatian dan digunakan sebagaimana mestinya.</div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 15px;">Bandung, <?php echo date_indo($row['teguran_createdate']); ?></div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 130px;">PT. Tiki Jalur Nugraha Ekakurir</div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 5px;">
                            <?php
                                $this->db->from('unit');
                                $this->db->join('employee', 'unit.unit_head = employee.nik');
                                $this->db->where('unit.unit_code', 'DVU');
                                $head = $this->db->get();

                                echo $head->row()->employee_name;
                            ?>
                        </div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 30px;">Head of Unit Personalia JNE Cab Bandung</div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 5px;">CC:</div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 5px;">- SPV 
                            <?php 
                                $section = $this->db->get_where('section', array('section_code' => $row['section_code']));
                                if($section->num_rows() > 0){
                                    echo $section->row()->section_name;
                                } else {
                                    echo '';
                                }
                            ?>
                        </div>
                        <div class="col-10 mx-auto" style="font-size: 20px; margin-bottom: 5px;">- BRANCH HEAD</div>
                    </div>    
            <?php endforeach; ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script type="text/javascript"> 
        window.addEventListener("load", window.print());
    </script>
</body>
</html>
