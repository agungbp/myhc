<?php
    $this->db->from('recruitment_candidate');
    $this->db->join('candidate', 'recruitment_candidate.nik = candidate.candidate_ktp');
    $this->db->join('application', 'candidate.candidate_ktp = application.nik');
    $this->db->join('vacancy', 'application.vacancy_id = vacancy.vacancy_id');
    $this->db->where('schedule_id', $param2);
    $candidate = $this->db->get();
?>
<div class="row">
    <div class="col-sm-12">
    <div class="table-responsive">
    <table id="tabel-data" class="table table-striped table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th width="10%">Photo</th>
                <th>Name</th>
                <th>Education</th>
                <th>Applied For</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr style="text-align: center;">
                <th>Photo</th>
                <th>Name</th>
                <th>Education</th>
                <th>Applied For</th>
                <th>Status</th>
            </tr>
        </tfoot>
        <tbody>
        <?php foreach ($candidate->result_array() as $row): ?>
            <tr>
                <td style="text-align: center;"><img src="<?php echo $this->get_model->get_image_url('candidate', $row['candidate_ktp']); ?>" width="50" /></td>
                <td><?php echo $row['candidate_name']; ?></td>
                <td>
                    <?php echo '<b>Education : </b>' . $row['candidate_education'] . '<br>'; ?>
                    <?php echo '<b>University : </b>' . $row['candidate_university'] . '<br>'; ?>
                    <?php echo '<b>Major : </b>' . $row['candidate_major'] . '<br>'; ?>
                    <?php echo '<b>GPA : </b>' . $row['candidate_gpa']; ?>
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