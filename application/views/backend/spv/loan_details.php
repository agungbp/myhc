<?php
    $this->db->from('loan_detail');
    $this->db->where('loan_id', $param2);
    $loan = $this->db->get();
?>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped">
                    <tr style="text-align: center;">
                        <th width="5%">Installment</th>
                        <th>Month</th>
                        <th>Pay per Month</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($loan->result_array() as $row): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row['dtloan_installment'] ?></td>
                        <td style="text-align: center;">
                            <?php 
                                $date = date_create($row['dtloan_month']);
                                echo date_format($date, "F Y"); 
                            ?>
                        </td>
                        <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['dtloan_paypermonth']) ?></td>
                        <td style="text-align: center;">
                            <?php if($row['dtloan_status'] == 'Paid') { ?>
                                <h5><span class="badge badge-secondary"><?php echo $row['dtloan_status'] ?></span></h5>
                            <?php } elseif ($row['dtloan_status'] == 'Unpaid') { ?>
                                <h5><span class="badge badge-danger"><?php echo $row['dtloan_status'] ?></span></h5>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>