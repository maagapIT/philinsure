<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
//$set = [];
$set = array('password' => md5($_POST["password"]));
//echo json_encode($_POST["username"]);
echo json_encode($fpdo
	-> update('user')
	-> set($set)
	-> where('name', $_POST["username"])
	-> execute()
//	-> getQuery()
);
?>