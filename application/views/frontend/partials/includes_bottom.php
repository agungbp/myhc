<!-- jquery latest version -->
<script src="<?php echo base_url();?>assets/frontend3/js/vendor/jquery-1.12.0.min.js"></script>
<!-- Bootstrap framework js -->
<script src="<?php echo base_url();?>assets/frontend3/js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="<?php echo base_url();?>assets/frontend3/js/plugins.js"></script>
<script src="<?php echo base_url();?>assets/frontend3/js/slick.min.js"></script>
<script src="<?php echo base_url();?>assets/frontend3/js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="<?php echo base_url();?>assets/frontend3/js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="<?php echo base_url();?>assets/frontend3/js/main.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">
    <?php if($this->session->flashdata('success')){ ?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php }else if($this->session->flashdata('error')){  ?>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php }else if($this->session->flashdata('warning')){  ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php }else if($this->session->flashdata('info')){  ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>