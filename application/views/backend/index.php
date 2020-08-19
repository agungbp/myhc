<?php $logged_in_user_type = $this->session->userdata('login_type'); ?>

<!DOCTYPE html>
<html>
    <?php include 'includes_top.php'; ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php include 'header.php'; ?>
            <?php include $logged_in_user_type . '/sidebar.php'; ?>
            <?php include $logged_in_user_type . '/' . $page_name . '.php'; ?>
            <?php include 'footer.php'; ?>
        </div>
        <?php include 'modal.php'; ?>
        <?php include 'includes_bottom.php'; ?>
    </body>
</html>
