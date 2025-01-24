<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
if($_SESSION["sys_philinsure_location_name"] != $_SESSION["sys_philinsure_central_location"])
	echo json_encode($fpdo
		-> from("marine_certificate")
		-> where("marine_certificate.active", 1)
		-> where("marine_certificate.posted", 1)
		-> where("marine_certificate.location_id", $_SESSION["sys_philinsure_location_id"])
		-> groupBy("marine_certificate.id")
		-> fetchAll()
	);
else
	echo json_encode($fpdo
		-> from("marine_certificate")
		-> where("active", 1)
		-> where("posted", 1)
		-> fetchAll()
	);
?>