<?php
session_start();
include "../fluentpdo/FluentPDO.php";
require_once "connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
$firstTime = $fpdo
	-> from("user")
	-> where("name", $_POST["username"])
	-> where("password", null)
	-> where("active", true)
	-> fetch()
;
if($firstTime)
	echo json_encode('initial');
else {
	$return = $fpdo
		-> from("user")
		-> leftJoin("location ON location.id = user.location_id ")
		-> leftJoin("role ON role.id = user.role_id ")
		-> leftJoin("agent ON location.agent_id = agent.id")
		-> select("location.name AS location_name, location.policy_number, location.agent_id, location.agent_code, location.address AS location_address, location.local_government_tax_percent AS percentage_local_government_tax, location.email as location_email, role.name as role_name, role.menu as menu_access, agent.email as agent_email, agent.name as agent_name")
		-> where("user.name", $_POST["username"])
		-> where("user.password", md5($_POST["password"]))
		-> where("user.active", true)
		-> where("location.active", true)
		-> where("agent.active", true)
		-> fetch()
	;
	$_SESSION["sys_philinsure_user_id"] = $return["id"];
	$_SESSION["sys_philinsure_username"] = $return["name"];
	$_SESSION["sys_philinsure_first_name"] = $return["first_name"];
	$_SESSION["sys_philinsure_last_name"] = $return["last_name"];
	$_SESSION["sys_philinsure_location_id"] = $return["location_id"];
	$_SESSION["sys_philinsure_location_name"] = $return["location_name"];
	$_SESSION["sys_philinsure_location_address"] = $return["location_address"];
	$_SESSION["sys_philinsure_policy_number"] = $return["policy_number"];
	$_SESSION["sys_philinsure_agent_id"] = $return["agent_id"];
	$_SESSION["sys_philinsure_agent_code"] = $return["agent_code"];
	$_SESSION["sys_philinsure_menu_access"] = $return["menu_access"];
	$_SESSION["sys_philinsure_role_name"] = $return["role_name"];
	$_SESSION["sys_philinsure_percentage_local_government_tax"] = $return["percentage_local_government_tax"];
	$_SESSION["sys_philinsure_agent_email"] = $return["agent_email"];
	$_SESSION["sys_philinsure_agent_name"] = $return["agent_name"];
	$_SESSION["sys_philinsure_location_email"] = $return["location_email"];
	getSystemValue("sys_philinsure_percentage_value_added_tax");
	getSystemValue("sys_philinsure_percentage_document_stamp");
	getSystemValue("sys_philinsure_central_location");
	echo json_encode($return);
}
function getSystemValue($n) {
	$return = $GLOBALS["fpdo"]
		-> from("system")
		-> select("value")
		-> where("name", substr($n, 15-strlen($n)))
		-> fetch()
	;
	$_SESSION[$n] = $return["value"];
}
?>