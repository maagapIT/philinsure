<?php
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
$policy_number = $_POST["policy_number"];
//echo json_encode($_POST["policy_number"]);
echo json_encode($fpdo
	-> from('marine_certificate')
	-> select("IFNULL(MAX(CAST(SUBSTRING_INDEX(certificate_number, '-', -1) AS DECIMAL)), 0) AS extension")
    -> where("active", true)
	-> where("certificate_number LIKE '".$policy_number."%'")
	-> fetch()
//	-> getQuery()
);
?>