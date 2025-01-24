<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
$set = [];
$set = $_POST["fields"];
$set = array_merge($set, array('user_modified' => $_SESSION["sys_philinsure_user_id"]));
echo json_encode($fpdo
	-> update($_POST["table"], $set, $_POST["id"])
	-> execute()
//	-> getQuery()
);
?>