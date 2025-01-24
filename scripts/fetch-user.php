<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
if($_SESSION["sys_philinsure_location_name"] != $_SESSION["sys_philinsure_central_location"])
	echo json_encode($fpdo
		-> from("user")
		-> where("location_id", $_SESSION["sys_philinsure_location_id"])
		-> where("active", true)
		-> fetchAll()
	);
else
	echo json_encode($fpdo
		-> from("user")
		-> where("active", true)
		-> fetchAll()
	);
?>