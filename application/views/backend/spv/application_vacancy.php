<?php
    $this->db->from('vacancy');
    $this->db->where('vacancy_id', $param2);
    $vacancy = $this->db->get();
    foreach ($vacancy->result_array() as $row): 
?>
        <div class="row">
            <div class="col-md-12">
                <h4 style="margin-bottom: 0px;"><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></h4>
                <p class="text-muted" style="margin-bottom: 0px;"><?php echo 'Department ' . $this->db->get_where('section', array('section_code' => $row['vacancy_section']))->row()->section_name; ?></p>
                <p class="text-muted" style="margin-bottom: 0px;"><?php echo 'Unit ' . $this->db->get_where('unit', array('unit_code' => $row['vacancy_unit']))->row()->unit_name; ?></p>                                
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <p class="card-title"><i class="fas fa-calendar"></i>&nbsp;&nbsp;
                    <?php echo date_format(date_create($row['vacancy_publishdate']),"d F Y") . ' - ' . date_format(date_create($row['vacancy_lastdate']),"d F Y"); ?>
                </p><br>                                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;<?php echo $row['vacancy_placement']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="lead" style="margin-bottom: 0px;">Requirements :</p>
                <p class="lead"><?php echo nl2br($row['vacancy_requirements']); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="lead" style="margin-bottom: 0px;">Job Description :</p>
                <p class="lead"><?php echo nl2br($row['vacancy_jobdesc']); ?></p>
            </div>
        </div>
<?php endforeach; ?>