<?php
require_once("class.phpmailer.php");
$mail = new PHPMailer();
$address = explode(",",$_POST["address"]);
// $address = explode(",","dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph");
$cc = explode(",",$_POST["username"]);
// $cc = explode(",","maatech@maa.com.ph");
$mail -> Username = "no-reply@maagap.com";
$mail -> Password = "N20pG97u";
foreach($address as $s) $mail -> AddAddress(trim($s));
foreach($cc as $s) $mail -> AddCC(trim($s));
$mail -> FromName = "no-reply@maa.com.ph";
// $mail -> FromName = "TESTING";
$mail -> Subject = $_POST["subject"];
// $mail -> Subject = "E-Marine Certificate Issuance";
$mail -> Body = $_POST["body"];
// $mail -> Body = " ";
$mail -> Host = "smtp.office365.com";
$mail -> Port = 25;
$mail -> IsSMTP();
$mail -> SMTPAuth = true;
$mail -> SMTPSecure = "tls";
$mail -> From = "no-reply@maagap.com";
for($i = 0; $i <= 3; $i++) {
	if(!file_exists(__DIR__ ."\\..\\certificates\\".$_POST["file_name"].".pdf"))
		sleep(7);
}
$mail -> AddAttachment("../certificates/".$_POST["file_name"].".pdf");
// $mail -> AddAttachment("../certificates/MK-07-16-LF-000004-0009.pdf");
$mail -> Send();
?>