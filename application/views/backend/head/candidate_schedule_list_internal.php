<?php
    $this->db->from('recruitment_candidate');
    $this->db->join('employee', 'recruitment_candidate.nik = employee.nik');
    $this->db->join('application', 'employee.nik = application.nik');
    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
    $this->db->where('schedule_id', $param2);
    $candidate = $this->db->get();
?>
<div class="row">
    <div class="col-sm-12">
    <a href="<?php echo site_url('head/recruitment_schedule/print_internal/'. $param2); ?>" target="_blank" class="btn btn-success" style="margin-bottom: 5px;"><i class="fas fa-print"></i>&nbsp;&nbsp;<b>Print Attendance List</b></a>
    <div class="table-responsive">
    <table id="tabel-data" class="table table-striped table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th>Name</th>
                <th>Details</th>
                <th>Applied Position</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr style="text-align: center;">
                <th>Name</th>
                <th>Details</th>
                <th>Applied Position</th>
                <th>Status</th>
            </tr>
        </tfoot>
        <tbody>
        <?php foreach ($candidate->result_array() as $row): ?>
            <tr>
                <td><?php echo $row['employee_name']; ?></td>
                <td>
                    <?php echo '<b>Department : </b>' . $this->db->get_where('section', array('section_code' => $row['section_code']))->row()->section_name . '<br>'; ?>
                    <?php echo '<b>Unit : </b>' . $this->db->get_where('unit', array('unit_code' => $row['unit_code']))->row()->unit_name . '<br>'; ?>
                    <?php echo '<b>Position : </b>' . $row['employee_position'] . ' ' . $row['employee_level'] . '<br>'; ?>
                    <?php echo '<b>Zone : </b>' . $this->db->get_where('zone', array('zone_code' => $row['zone_code']))->row()->zone_desc; ?>
                </td>
                <td><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></td>
                <td style="text-align: center;">
                    <?php if($row['application_status'] == 'Applied') { ?>
                        <h5><span class="badge badge-secondary"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'On Review') { ?>
                        <h5><span class="badge badge-warning"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'Psikotest') { ?>
                        <h5><span class="badge badge-info"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'Interview') { ?>
                        <h5><span class="badge badge-light"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'Hired') { ?>
                        <h5><span class="badge badge-success"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'Waiting for SPV Approval') { ?>
                        <h5><span class="badge badge-secondary"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'Declined') { ?>
                        <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                    <?php } elseif ($row['application_status'] == 'SPV Declined') { ?>
                        <h5><span class="badge badge-danger"><?php echo $row['application_status']; ?></span></h5>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>    
        </tbody>
    </table>
    </div>
    </div>
</div>