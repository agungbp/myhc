<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-striped table-hover" id="tabel-data">
            <thead>
                <tr style="text-align: center;">
                    <th>Category</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $loan = $this->db->get_where('resign', array('resign_id' => $param2));
                if ($loan->row()->resign_loan > 0){
                    foreach ($loan->result_array() as $row): 
            ?>
                        <tr>
                            <td>Loan</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($row['resign_loan']); ?></td>
                            <td style="text-align: center;">
                                <?php if($row['resign_paystatus'] == 'Unpaid'){ ?>
                                    <a class="btn btn-dark" href="<?php echo site_url('humancapital/resign/change_status_paid/'. $row['resign_id'] . '/' . $row['nik']); ?>"><i class="fas fa-check"></i></a>    
                                <?php } else if($row['resign_paystatus'] == 'Paid'){ 
                                        echo 'Already Paid'; 
                                    } 
                                ?>
                            </td>
                        </tr>
            <?php 
                    endforeach;
                }

                $this->db->from('resign_asset');
                $this->db->join('asset', 'asset.asset_number = resign_asset.resignasset_code');
                $this->db->where('resign_id', $param2);
                $asset = $this->db->get();

                foreach ($asset->result_array() as $row2): 
            ?>
                <tr>
                    <td><?php echo $row2['asset_name'] ?></td>
                    <td><?php echo $row2['asset_merk'] ?></td>
                    <td style="text-align: center;">1</td>
                    <td style="text-align: center;">
                        <?php if($row2['resignasset_status'] == 'On Employee'){ ?>
                            <a class="btn btn-dark" href="<?php echo site_url('humancapital/resign/asset_update/'. $row2['resignasset_id']); ?>"><i class="fas fa-check"></i></a>    
                        <?php } else if($row2['resignasset_status'] == 'Returned'){ 
                                echo 'Already Returned'; 
                            } 
                        ?>
                    </td>
                </tr>
            <?php 
                endforeach;

                $this->db->from('resign_asset');
                $this->db->join('uniform_stock', 'uniform_stock.uniformstock_code = resign_asset.resignasset_code');
                $this->db->where('resign_id', $param2);
                $uniform = $this->db->get();

                foreach ($uniform->result_array() as $row3): 
            ?>
                <tr>
                    <td><?php echo $row3['resignasset_type'] ?></td>
                    <td><?php echo $row3['uniformstock_code'] ?></td>
                    <td style="text-align: center;"><?php echo $row3['resignasset_qty'] ?></td>
                    <td style="text-align: center;">
                        <?php if($row3['resignasset_status'] == 'On Employee'){ ?>
                            <a class="btn btn-dark" href="<?php echo site_url('humancapital/resign/asset_update/'. $row3['resignasset_id']); ?>"><i class="fas fa-check"></i></a>    
                        <?php } else if($row3['resignasset_status'] == 'Returned'){ 
                                echo 'Already Returned'; 
                            } 
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('.selectpicker').selectpicker('render')
</script>