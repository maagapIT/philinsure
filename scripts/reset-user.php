<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
$set = [];
$set = array_merge($set, array('password' => null));
echo json_encode($fpdo
	-> update("user", $set, $_POST["id"])
	-> execute()
//	-> getQuery()
);
?>