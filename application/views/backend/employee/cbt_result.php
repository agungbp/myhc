<?php
    $this->db->from('cbt_participants');
    $this->db->join('cbt_exam', 'cbt_participants.exam_id = cbt_exam.exam_id');
    $this->db->join('employee', 'cbt_participants.nik = employee.nik');
    $this->db->where('cbt_participants.nik', $this->session->userdata('login_nik'));
    $this->db->where('cbt_exam.exam_id', $param2);
    $exam = $this->db->get();

    foreach ($exam->result_array() as $row):
?>
        <div class="row">
            <div class="col-lg-3 col-4">Nama Test</div>
            <div class="col-lg-9 col-8"><b><?php echo $row['exam_name']; ?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-4">Waktu Mulai</div>
            <div class="col-lg-9 col-8"><b><?php echo date_format(date_create($row['participants_start']), "H:i:s"); ?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-4">Waktu Selesai</div>
            <div class="col-lg-9 col-8"><b><?php echo date_format(date_create($row['participants_end']), "H:i:s"); ?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-4">Durasi Mengerjakan</div>
            <div class="col-lg-9 col-8">
                <b>
                    <?php 
                        $time1 = strtotime($row['participants_start']);
                        $time2 = strtotime($row['participants_end']); 
                        $secs = $time2 - $time1;
                        $min = $secs / 60;
                        echo round($min, 2) . ' Menit';
                    ?>
                </b>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="50%">Total Soal</th>
                            <th width="25%">PG</th>
                            <th width="25%">Essay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center;">
                            <td><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id']))->num_rows(); ?></td>
                            <td><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id'], 'question_type' => 'PG'))->num_rows(); ?></td>
                            <td><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row['questionpack_id'], 'question_type' => 'Essay'))->num_rows(); ?></td>
                        </tr>
                        <tr>
                            <td><b>Score</b></td>
                            <td style="text-align: center;"><?php echo $row['participants_pg']; ?></td>
                            <td style="text-align: center;"><?php echo $row['participants_essay']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Final Score</b></td>
                            <td style="text-align: center;" colspan="2"><b><?php echo $row['participants_score']; ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">Soal essay butuh penilaian secara manual dan score akan muncul setelah diperiksa oleh HC.</div>
        </div>
        <!-- <div class="row">
            <div class="col-lg-2 col-4">Correct Answer</div>
            <div class="col-lg-10 col-8"><b><?php // echo $row['participants_correct']; ?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-4">Wrong Answer</div>
            <div class="col-lg-10 col-8"><b><?php // echo $row['participants_wrong']; ?></b></div>
        </div> -->
        <br>
<?php endforeach; ?>