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
        <?php echo form_open(site_url('employee/freelance_attendance_report_selector')); ?>
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-4">
                            <div class="form-group">
                                <label class="control-label">Employee</label>
                                <?php
                                    $this->db->from('employee');
                                    $this->db->where('nik', $this->session->userdata('login_nik'));
                                    $query = $this->db->get();
                                    $row = $query->row();
                                ?>
                                <input type="hidden" class="form-control" name="nik" value="<?php echo $row->nik; ?>"/>
                                <input type="text" class="form-control" value="<?php echo $row->employee_name; ?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <div class="input-group">
                                    <select name="year" class="form-control selectpicker" data-live-search="true">
                                        <?php
                                        $year_list = array("2020","2021","2022","2023","2024","2025","2026","2027","2028","2030","2031","2032","2033","2034","2035");
                                        foreach($year_list as $row) { ?>
                                            <option value="<?php echo $row; ?>"
                                                <?php if($row == $year) echo 'selected'; ?>>
                                                    <?php echo $row; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Month</label>
                                <div class="input-group">
                                    <select name="month" class="form-control selectpicker" data-live-search="true">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++):
                                            if ($i == 1)
                                                $m = 'January';
                                            else if ($i == 2)
                                                $m = 'February';
                                            else if ($i == 3)
                                                $m = 'March';
                                            else if ($i == 4)
                                                $m = 'April';
                                            else if ($i == 5)
                                                $m = 'May';
                                            else if ($i == 6)
                                                $m = 'June';
                                            else if ($i == 7)
                                                $m = 'July';
                                            else if ($i == 8)
                                                $m = 'August';
                                            else if ($i == 9)
                                                $m = 'September';
                                            else if ($i == 10)
                                                $m = 'October';
                                            else if ($i == 11)
                                                $m = 'November';
                                            else if ($i == 12)
                                                $m = 'December'; ?>
                                            
                                            <option value="<?php echo $i; ?>"
                                                <?php if($i == $month) echo 'selected'; ?>>
                                                    <?php echo $m; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="operation" value="selection">
                        <div class="col-md-3" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary">Show Report</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        <?php echo form_close(); ?>

        <?php if($nik != '' && $year != '' && $month != '') { ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        
                        <div class="col-md-4" style="text-align: center;">
                            <div class="tile-stats tile-gray">
                                <div class="icon"><i class="entypo-docs"></i></div>
                                <h4 style="color: #696969; margin-bottom: 0px;"><b>FREELANCE ATTENDANCE SHEET</b></h4>
                                <h5 style="color: #696969;">
                                    <?php
                                    
                                    if ($month == 1)
                                        $m = 'January';
                                    else if ($month == 2)
                                        $m = 'February';
                                    else if ($month == 3)
                                        $m = 'March';
                                    else if ($month == 4)
                                        $m = 'April';
                                    else if ($month == 5)
                                        $m = 'May';
                                    else if ($month == 6)
                                        $m = 'June';
                                    else if ($month == 7)
                                        $m = 'July';
                                    else if ($month == 8)
                                        $m = 'August';
                                    else if ($month == 9)
                                        $m = 'Sepetember';
                                    else if ($month == 10)
                                        $m = 'October';
                                    else if ($month == 11)
                                        $m = 'November';
                                    else if ($month == 12)
                                        $m = 'December';
                                    
                                    echo $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row()->employee_name . '<br>' . $m . ' ' . $year; ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table id="tabel-data" class="table table-striped table-bordered table-hover" style="max-width: none; font-size: 10px;">
                                    <thead>
                                        <tr style="text-align: center; padding: 5px;">
                                            <td style="text-align: center; padding: 5px;">#</td>
                                            <td style="text-align: center; padding: 5px;">Employees</td>
                                            <td style="text-align: center; padding: 5px;">Department</td>
                                            <td style="text-align: center; padding: 5px;">Position</td>
                                            <?php
                                                $nextmonth = $month + 1;
                                                $begin = new DateTime($year . '-' . $month . '-16');
                                                $end = new DateTime($year . '-' . $nextmonth . '-16');
                                                
                                                $interval = DateInterval::createFromDateString('1 day');
                                                $period = new DatePeriod($begin, $interval, $end);
                                                
                                                foreach ($period as $dt) {
                                            ?>
                                                    <td style="padding: 5px;"><?php echo $dt->format("d"); ?></td>
                                            <?php } ?>
                                            <td style="padding: 5px;">M Total</td>
                                            <td style="padding: 5px;">S Total</td>
                                            <td style="padding: 5px;">I Total</td>
                                            <td style="padding: 5px;">A Total</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if($nik == 'All') {
                                            $this->db->from('employee');
                                            $this->db->join('section', 'employee.section_code = section.section_code');
                                            $this->db->where('employee_status', 'Freelance');
                                            $sql = $this->db->get();

                                            $employees = $sql->result_array();
                                        } else {
                                            $this->db->from('employee');
                                            $this->db->join('section', 'employee.section_code = section.section_code');
                                            $this->db->where('employee_status', 'Freelance');
                                            $this->db->where('nik', $this->session->userdata('login_nik'));
                                            $sql = $this->db->get();

                                            $employees = $sql->result_array();
                                        }
                                        
                                        foreach($employees as $row) { ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no++ ?></td>
                                                <td><?php echo $row['employee_name']; ?></td>
                                                <td><?php echo $row['section_name']; ?></td>
                                                <td><?php echo $row['employee_position']; ?></td>
                                                <?php
                                                    foreach ($period as $dt) {
                                                        $query = $this->db->get_where('freelance_attendance', array('nik' => $row['nik'], 'fattendance_date' => $dt->format("Y-m-d")));
                                                        if($query->num_rows() > 0){
                                                ?>
                                                            <td style="text-align: center; padding: 5px;">
                                                                <?php echo $query->row()->fattendance_status; ?>
                                                            </td>
                                                <?php   } else { ?>
                                                        <td style="text-align: center; padding: 5px;">&nbsp;</td>
                                                <?php
                                                        }
                                                    } 
                                                ?>
                                                <td style="text-align: center; padding: 5px;">
                                                    <?php
                                                        $total_masuk_this_month  = 0;
                                                        $total_sakit_this_month  = 0;
                                                        $total_izin_this_month   = 0;
                                                        $total_alfa_this_month   = 0;
                                                        $month_start_date        = strtotime($year . '-' . $month . '-16');
                                                        $month_end_date          = strtotime($year . '-' . $nextmonth . '-15');

                                                        $total_masuk = $this->db->get_where('freelance_attendance', array('nik' => $row['nik'], 'fattendance_status' => 'M'))->result_array();
                                                        foreach($total_masuk as $row_total_masuk){
                                                            if(strtotime($row_total_masuk['fattendance_date']) >= $month_start_date && strtotime($row_total_masuk['fattendance_date']) <= $month_end_date){
                                                                $total_masuk_this_month++;
                                                            }
                                                        }

                                                        $total_sakit = $this->db->get_where('freelance_attendance', array('nik' => $row['nik'], 'fattendance_status' => 'S'))->result_array();
                                                        foreach($total_sakit as $row_total_sakit){
                                                            if(strtotime($row_total_sakit['fattendance_date']) >= $month_start_date && strtotime($row_total_sakit['fattendance_date']) <= $month_end_date){
                                                                $total_sakit_this_month++;
                                                            }
                                                        }

                                                        $total_izin = $this->db->get_where('freelance_attendance', array('nik' => $row['nik'], 'fattendance_status' => 'I'))->result_array();
                                                        foreach($total_izin as $row_total_izin){
                                                            if(strtotime($row_total_izin['fattendance_date']) >= $month_start_date && strtotime($row_total_izin['fattendance_date']) <= $month_end_date){
                                                                $total_izin_this_month++;
                                                            }
                                                        }

                                                        $total_alfa = $this->db->get_where('freelance_attendance', array('nik' => $row['nik'], 'fattendance_status' => 'A'))->result_array();
                                                        foreach($total_alfa as $row_total_alfa){
                                                            if(strtotime($row_total_alfa['fattendance_date']) >= $month_start_date && strtotime($row_total_alfa['fattendance_date']) <= $month_end_date){
                                                                $total_alfa_this_month++;
                                                            }
                                                        }

                                                        echo $total_masuk_this_month;
                                                    ?>
                                                </td>
                                                <td style="text-align: center; padding: 5px;"><?php echo $total_sakit_this_month; ?></td>
                                                <td style="text-align: center; padding: 5px;"><?php echo $total_izin_this_month; ?></td>
                                                <td style="text-align: center; padding: 5px;"><?php echo $total_alfa_this_month; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <div>   
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tabel-data').DataTable( {
            orderCellsTop: true,
            dom:
                "<'row'<'col-sm-5'l><'col-sm-4 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        } );
    } );
</script>