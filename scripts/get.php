<?php
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
echo json_encode($fpdo
	-> from($_POST["table"], $_POST["id"])
	-> select($_POST["fields"])
    -> where($_POST["table"].".active", true)
	-> fetch()
);
?>