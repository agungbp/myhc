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
        <?php 
            $this->db->from('candidate');
            $this->db->where('candidate_ktp', $this->session->userdata('login_nik'));
            $candidate = $this->db->get();

            $exam = $this->db->get_where('cbt_exam', array('exam_id' => $exam_id));

            foreach ($candidate->result_array() as $row):
                foreach ($exam->result_array() as $row2):
                    echo form_open(site_url('candidate/exam/auth/'.$exam_id), array('enctype' => 'multipart/form-data'));
        ?>
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <td><?php echo $row['candidate_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Exam Name</th>
                                                <td><?php echo $row2['exam_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total Question</th>
                                                <td><?php echo $this->db->get_where('cbt_question', array('questionpack_id' => $row2['questionpack_id']))->num_rows(); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Time</th>
                                                <td>
                                                    <?php echo date_format(date_create($row2['exam_start_date']),"d F Y") . ' ' . date_format(date_create($row2['exam_start_time']),"H:i") . ' - ' . date_format(date_create($row2['exam_end_date']),"d F Y") . ' ' . date_format(date_create($row2['exam_end_time']),"H:i"); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Duration</th>
                                                <td>
                                                    <?php 
                                                        $datetime1 = strtotime($row2['exam_start_date'] . ' ' . $row2['exam_start_time']);
                                                        $datetime2 = strtotime($row2['exam_end_date'] . ' ' . $row2['exam_end_time']); 
                                                        $secs = $datetime2 - $datetime1;
                                                        $min = $secs / 60;
                                                        echo $min . ' Minutes';
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align:middle">Token</th>
                                                <td>
                                                    <input autocomplete="off" name="exam_token" type="text" class="form-control" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-5 col-12">
                                        <div class="callout callout-info">
                                            <strong>Ujian akan dimulai ketika muncul tombol <b>MULAI</b></strong>
                                            <br>
                                            <span class="countdown">Silahkan refresh halaman ini jika tombol <b>MULAI</b> tidak muncul</strong><br/>
                                        </div>
                                        <div class="callout callout-info">
                                            <strong>Ujian akan dimulai pada</strong>
                                            <br>
                                            <div class="row" style="margin-top: 20px;">
                                            <div class="col-lg-2 col-3"><div class="card card-info card-outline"><div class="card-content" style="height: 90px; text-align: center;"><h1 id="hari" style="margin-top: 10px; margin-bottom: -5px;" class="font-weight-bold"></h1>Hari</div></div></div>
                                            <div class="col-lg-2 col-3"><div class="card card-info card-outline"><div class="card-content"  style="height: 90px; text-align: center;"><h1 id="jam" style="margin-top: 10px; margin-bottom: -5px;" class="font-weight-bold"></h1>Jam</div></div></div>
                                            <div class="col-lg-2 col-3"><div class="card card-info card-outline"><div class="card-content"  style="height: 90px; text-align: center;"><h1 id="menit" style="margin-top:10px; margin-bottom: -5px;" class="font-weight-bold"></h1>Menit</div></div></div>
                                            <div class="col-lg-2 col-3"><div class="card card-info card-outline"><div class="card-content"  style="height: 90px; text-align: center;"><h1 id="detik" style="margin-top: 10px; margin-bottom: -5px;" class="font-weight-bold"></h1>Detik</div></div></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php
                                            $this->db->from('cbt_answer');
                                            $this->db->join('cbt_participants', 'cbt_answer.participants_id = cbt_participants.participants_id');
                                            $this->db->where('cbt_participants.exam_id', $exam_id);
                                            $this->db->where('nik', $this->session->userdata('login_nik'));
                                            $cek = $this->db->get();
            
                                            if($cek->num_rows() == 0){
                                        ?>
                                                    <button type="submit" class="btn btn-success btn-lg btn-block" id="start">Mulai</button>
                                        <?php   
                                                if(date('Y-m-d') >= $row2['exam_end_date'] && date('H:i:s') > $row2['exam_end_time']){ 
                                        ?>
                                                    <div class="alert alert-danger" role="alert">Waktu ujian telah berakhir</div>
                                        <?php   
                                                } 
                                            } else {
                                        ?>
                                                <a href="#" class="btn btn-info btn-block">Lihat Hasil</a> 
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
        <?php 
                    echo form_close();
                endforeach; 
            endforeach; 
        ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    CountDownTimer("<?php echo $exam->row()->exam_start_date . ' ' . $exam->row()->exam_start_time;?>", 'hari', 'jam', 'menit', 'detik');
    function CountDownTimer(dt, id1, id2, id3, id4)
    {
        var end = new Date(dt);

        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var timer;

        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            var distance1 = now - end;
            if(distance1 > 0){
                clearInterval(timer);
                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            document.getElementById(id1).innerHTML = days;
            document.getElementById(id2).innerHTML = hours;
            document.getElementById(id3).innerHTML = minutes;
            document.getElementById(id4).innerHTML = seconds;

            if (days == 0 && hours == 0 && minutes == 0 && seconds == 0){
                document.getElementById("start").style.display = "block";
            } else {
                document.getElementById("start").style.display = "none";
            }
        }

        timer = setInterval(showRemaining, 1);

    }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#tabel-data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    var table = $('#tabel-data').DataTable( {
        orderCellsTop: true,
        dom:
            "<'row'<'col-sm-4'l><'col-sm-5 text-center'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            }
        ]
    } );

    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>