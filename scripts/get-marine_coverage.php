<?php
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
echo json_encode($fpdo
	-> from("marine_coverage_details")
	-> select("marine_coverage.rate_percent")
//	-> innerJoin("marine_coverage")
	-> where("marine_coverage_details.marine_certificate_id", $_POST["id"])
	-> where("marine_coverage_details.active", true)
	-> limit(4)
	-> orderBy("date_modified")
	-> fetchAll()
);
?>