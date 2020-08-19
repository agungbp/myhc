<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php
            if($this->session->userdata('login_type') != 'candidate') { 
                $this->db->from('user');
                $this->db->where('nik', $this->session->userdata('login_nik'));
                $this->db->where('user_status', 'Y');
                $this->db->where('user_application', 'MYHC');
                $this->db->order_by('user_type');
                $emp = $this->db->get();

                if($emp->num_rows() > 1){
        ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Change user type
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php foreach ($emp->result_array() as $row): ?>
                                    <a class="dropdown-item" href="<?php echo site_url('login/select/'. $row['nik'] . '/' . $row['user_type'] . '/' . $row['user_id']); ?>"><?php echo $row['user_type']; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
        <?php 
                }
            } 
        ?>
        &nbsp;
        <li class="nav-item">
            <a class="btn btn-dark" href="<?php if($this->session->userdata('login_type') == 'candidate') { echo site_url('erecruitment/logout'); } else { echo site_url('login/logout'); } ?>">
                <ion-icon name="power"></ion-icon>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<?php 
    $marquee = $this->db->query('SELECT * FROM marquee WHERE marquee_status = "Active" AND (user_type = "ALL" OR user_type = "'. $this->session->userdata("login_type") . '")');
    
    if ($marquee->num_rows() > 0) { 
?>
        <nav class="navbar navbar-info">
            <marquee>
                <p class="text-white" style="margin-bottom: 0px;">
                    <i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php 
                        foreach ($marquee->result_array() as $row):
                            echo '[' . $row['marquee_date'] . ']   ' . $row['marquee_announcement'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-circle fa-xs"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; 
                        endforeach;
                    ?>
                </p>
            </marquee>
        </nav>
<?php } ?>