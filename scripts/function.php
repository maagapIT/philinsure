<?php
require_once("connect.php");
include "fluentpdo/FluentPDO.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
function fetchSelectData($t, $f, $c) {
// t = table
// f = fields
	$return = "";
	$tmp = array("0" => array("value" => '', "name" => "- Select -"));
	if($c) {
		if($_SESSION["sys_philinsure_location_name"] != $_SESSION["sys_philinsure_central_location"])
			$array = $GLOBALS["fpdo"]
				-> from($t)
				-> select($f)
				-> where($c)
				-> where("active", true)
				-> fetchAll()
			;
		else
			$array = $GLOBALS["fpdo"]
				-> from($t)
				-> select($f)
				-> where("active", true)
				-> fetchAll()
			;
		$tmp = array_merge($tmp, $array);
	} else {
		$tmp = array_merge($tmp, $GLOBALS["fpdo"]
			-> from($t)
			-> select($f)
			-> where("active", true)
			-> fetchAll()
		);
	}
	foreach($tmp as $row) {
		$return .= "<option value='".$row["value"]."'>".$row["name"]."</option>";
	}
	return $return;
}
function fetchSelectDataCondition($t, $f, $c) {
// t = table
// f = fields
// c = condition
	$return = "";
	$tmp = array("0" => array("value" => '', "name" => "- Select -"));
	if($_SESSION["location_name"] != $_SESSION["central_location"])
		$array = $GLOBALS["fpdo"]
			-> from($t)
			-> select($f)
			-> where($c)
			-> where("active", true)
			-> fetchAll()
		;
	else
		$array = $GLOBALS["fpdo"]
			-> from($t)
			-> select($f)
			-> where("active", true)
			-> fetchAll()
		;
	$tmp = array_merge($tmp, $array);
	foreach($tmp as $row) {
		$return .= "<option value='".$row["value"]."'>".$row["name"]."</option>";
	}
	return $return;
}
function clearFields($f) {
	foreach($f as $i => $r) {
		if($f[$i][2] == "date")
			echo "\$scope.".$f[$i][0]." = new Date('0000-00-00 00:00:00');"; // \$scope.".$f[$i][0].".setHours(0,0,0,0);
		else
			echo "\$scope.".$f[$i][0]." = '';";
		echo "$('#".$f[$i][0]."').val('');";
	}
}
function editFields($f) {
	foreach($f as $i => $r)
		if($f[$i][2] == "date") {
			echo "\$scope.".$f[$i][0]." = new Date(data.".$f[$i][1].");";
			echo "$('#".$f[$i][0]."').val(\$scope.editDate(data.".$f[$i][1]."));";
		} else {
			echo "\$scope.".$f[$i][0]." = data.".$f[$i][1].";";
			echo "$('#".$f[$i][0]."').val(data.".$f[$i][1].");";
		}
}
function saveFields($f) {
	$first = true;
	foreach($f as $i => $r) {
		if($f[$i][2] == "numeric")
			echo ($first ? "" : ",")."".$f[$i][1].":unformatCurrency(\$scope.".$f[$i][0].")";
		else
			echo ($first ? "" : ",")."".$f[$i][1].":".($f[$i][2] == "date" ? "\$scope.saveDate(\$scope.".$f[$i][0].")" : "\$scope.".$f[$i][0]);
		$first = false;
	}
}
function validateFields($m, $f) {
	$first = true;
	foreach($f as $i => $r) {
		echo ($first ? "" : "||").$m.".".$f[$i][0].".\$error.required";
		$first = false;
	}
}
function disableFields($f) {
	foreach($f as $i => $r)
		echo "$('#".$f[$i][0]."').attr('disabled', 'disabled');";
}
function enableFields($f) {
	foreach($f as $i => $r) {
		if(!$f[$i][3])
			echo "$('#".$f[$i][0]."').removeAttr('disabled');";
	}
}
function createField($i, $l, $t, $r, $o, $s) {
// i = id
// l = label
// t = type
// r = required
// o = options
// s = select options
	$lbl_hdr = "";
	$lbl_tlr = "";
	$rqd_ico = "";
	$rqd_ind = "";
	if($r) {
		$rqd_ico = "<span style='color: red;'>*</span>";
		$rqd_ind = "required";
	}
	if($l) {
		$lbl_hdr = "<label>".$l."&nbsp;".$rqd_ico;
		$lbl_tlr = "</label>";
	}
	switch($t) {
		case "date":
		case "email":
		case "password":
		case "text":
			return $lbl_hdr."<input id='".$i."' name='".$i."' ng-model='".$i."' type='".$t."' ".$o." ".$rqd_ind." />".$lbl_tlr;
			break;
		case "textarea":
			return $lbl_hdr."<textarea id='".$i."' name='".$i."' ng-model='".$i."' type='text' rows='5' ".$o." ".$rqd_ind."></textarea>".$lbl_tlr;
			break;
		case "select":
			return $lbl_hdr."<select id='".$i."' name='".$i."' ng-model='".$i."' ".$o." ".$rqd_ind.">".$s."</select>".$lbl_tlr;
			break;
	}
}
?>