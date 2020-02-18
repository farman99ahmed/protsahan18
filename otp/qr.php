<?php
require_once('src/QrCode.php');
use Endroid\QrCode\QrCode;
$qr= new QrCode();
$qr	->setText("This is Qr Code")
	->setSize("200")
	->render();
?>
