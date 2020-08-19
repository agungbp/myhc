<?php
    $this->db->from('employee');
    $this->db->join('freelance_payroll', 'freelance_payroll.nik = employee.nik');
    $this->db->join('section', 'employee.section_code = section.section_code');
    $this->db->where('fpayroll_id', $param2);
    $payroll = $this->db->get();

    $this->load->helper('number_to_words');

    foreach ($payroll->result_array() as $row): ?>
        <div class="row">
            <div class="col-12">
                <b>JNE EXPRESS</b>
            </div>
        </div>
        <div class="row">
            <div class="col-3">&nbsp;</div>
            <div class="col-6" style="text-align: center;"><h4><u>** PAYSLIP REGISTER **</u></h4></div>
            <div class="col-3">&nbsp;</div>
        </div>
        <div class="row" style="margin-top: 0px;">
            <div class="col-3">&nbsp;</div>
            <div class="col-6" style="text-align: center;"><h5>Period : <?php echo date_format(date_create($row['fpayroll_date']), "F Y"); ?></h5></div>
            <div class="col-3">Print Date : <?php echo date_format(date_create(date('Y-m-d')), "d F Y"); ?></div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr style="border: 2px solid black;">
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <label class="col-2 col-form-label">NIK</label>
            <div class="col-3 col-form-label">
                <?php echo $row['nik'] ?>
            </div>
            <div class="col-1"></div>
            <label class="col-2 col-form-label">Department</label>
            <div class="col-3 col-form-label">
                <?php echo $row['section_name'] ?>
            </div>
        </div>
        <div class="row" style="margin-top: -10px;">
            <label class="col-2 col-form-label">Employee</label>
            <div class="col-3 col-form-label">
                <?php echo $row['employee_name'] ?>
            </div>
            <div class="col-1"></div>
            <label class="col-2 col-form-label">Position</label>
            <div class="col-3 col-form-label">
                <?php echo $row['employee_position'] ?>
            </div>
        </div>
        <div class="row" style="margin-top: -10px;">
            <label class="col-2 col-form-label">Hiring Date</label>
            <div class="col-3 col-form-label">
                <?php echo $row['employee_join'] ?>
            </div>
            <div class="col-1"></div>
            <label class="col-2 col-form-label">Status</label>
            <div class="col-3 col-form-label">
                <?php echo $row['employee_status'] ?>
            </div>
        </div>
        <div class="row"><div class="col-12"><hr></div></div>
        <div class="row">
            <div class="col-1" style="text-align: center;"><b>A.</b></div>
            <div class="col-11"><b>ATTENDANCE</b></div>
        </div>
        <div class="row">
            <div class="col-1">&nbsp;</div>
            <div class="col-1">Masuk</div>
            <div class="col-1" style="text-align: center;"><b><?php echo $row['fpayroll_masuk'] ?></b></div>
            <div class="col-1">Days</div>
            <div class="col-2">&nbsp;</div>
            <div class="col-1">Sakit</div>
            <div class="col-1" style="text-align: center;"><b><?php echo $row['fpayroll_sakit'] ?></b></div>
            <div class="col-1">Days</div>
        </div>
        <div class="row">
            <div class="col-1">&nbsp;</div>
            <div class="col-1">Izin</div>
            <div class="col-1" style="text-align: center;"><b><?php echo $row['fpayroll_izin'] ?></b></div>
            <div class="col-1">Days</div>
            <div class="col-2">&nbsp;</div>
            <div class="col-1">Alfa</div>
            <div class="col-1" style="text-align: center;"><b><?php echo $row['fpayroll_alfa'] ?></b></div>
            <div class="col-1">Days</div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-1" style="text-align: center;"><b>B.</b></div>
            <div class="col-11"><b>SALARY</b></div>
        </div>
        <div class="row" style="margin-top: 5px;">
            <div class="col-1">&nbsp;</div>
            <div class="col-11">
                <table class="table table-bordered">
                    <tr>
                        <td>Total Masuk : <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['fpayroll_masuk'] ?></b></td>
                        <td>Upah per Hari : <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp 144.000</b></td>
                        <td>Total Gaji : <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Rp ' . number_format($row['fpayroll_salary']); ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3">Terbilang : <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords(number_to_words($row['fpayroll_salary'])) ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-7">&nbsp;</div>
            <div class="col-5"><u>Receive Date :</u></div>
        </div>
        <div class="row">
            <div class="col-7">&nbsp;</div>
            <div class="col-5">Employee :</div>
        </div>
        <div class="row" style="margin-top: 100px;">
            <div class="col-7">&nbsp;</div>
            <div class="col-5"><b>[ <?php echo $row['employee_name'] ?> ]</b></div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-12" style="text-align: center;">
                <a href="<?php echo site_url('head/freelance_payslip_details_print/'.$row['fpayroll_id']); ?>" class="btn btn-dark" target="_blank">
                    <i class="fas fa-print"></i>&nbsp;&nbsp;Print Payslip
                </a>
            </div>
        </div>
<?php endforeach; ?>