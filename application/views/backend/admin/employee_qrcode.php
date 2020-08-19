<?php
    $qrCode = new Endroid\QrCode\QrCode($param2);
    $qrCode->writeFile('uploads/qrcode/'.$param2.'.png');

    // header('Content-Type: '.$qrCode->getContentType());
    // echo $qrCode->writeString();

    // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    //          echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('1234567890', $generator::TYPE_CODE_128)) . '">';
?>
<center>
    <img src="<?php echo $this->get_model->get_image_qrcode_url($param2); ?>" width="100%" />
</center>