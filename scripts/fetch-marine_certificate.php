<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
if($_SESSION["sys_philinsure_location_name"] != $_SESSION["sys_philinsure_central_location"])
	echo json_encode($fpdo
		-> from("marine_certificate")
	//	-> select("marine_insured.insured_name")
//		-> select("IFNULL(SUM(marine_coverage_details.invoice_amount), 0) AS 'invoice_amount'")
//		-> leftJoin("marine_coverage_details ON marine_coverage_details.marine_certificate_id = marine_certificate.id AND marine_coverage_details.active = TRUE")
		-> where("marine_certificate.active", true)
		-> where("marine_certificate.posted", false)
		-> where("marine_certificate.location_id", $_SESSION["sys_philinsure_location_id"])
	//	-> where("marine_coverage_details.active", true)
		-> groupBy("marine_certificate.id")
		-> fetchAll()
	//	-> getQuery()
	);
else
	echo json_encode($fpdo
		-> from("marine_certificate")
		-> where("active", true)
		-> where("posted", false)
		-> fetchAll()
	);
?>