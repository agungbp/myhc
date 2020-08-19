<?php
    $qrCode = new Endroid\QrCode\QrCode($param2);
    $qrCode->writeFile('uploads/qrcode/'.$param2.'.png');
?>
<center>
    <img src="<?php echo $this->get_model->get_image_qrcode_url($param2); ?>" width="100%" />
</center>