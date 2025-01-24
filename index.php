<!doctype html>
<?php
session_start();
if (!(isset($_SESSION["sys_philinsure_username"]) && $_SESSION["sys_philinsure_username"] != "")) {
	header("Location: login.php");
}
?>
<html>

<head>
	<?php include_once("initial.php"); ?>
</head>

<body ng-app="appMain" ng-controller="ctrlMain">
	<script>
		var app = angular.module('appMain', []);
	</script>
	<div class="fixed">
		<nav class="top-bar sticky" role="navigation" data-topbar>
			<ul class="title-area">
				<li><img class="large-4 medium-4 small-4 left" src="images/maagap-logo.png"
						style="filter: invert(84%) sepia(11%) saturate(5073%) hue-rotate(358deg) brightness(103%) contrast(106%);" /></li>
			</ul>
			<section class="top-bar-section">
				<ul class="left">
					<li><a href="#"></a></li>
				</ul>
				<ul class="right">
					<li class="divider"></li>
					<li><a>Logged: <span class="label info radius"><?php echo $_SESSION["sys_philinsure_first_name"] . " " . $_SESSION["sys_philinsure_last_name"]; ?></span></a></li>
					<li class="divider"></li>
					<li><a>Location: <span class="label info radius"><?php echo $_SESSION["sys_philinsure_location_name"]; ?></span></a></li>
					<li class="divider"></li>
					<li><a ng-click="showVersion();">Version: <span class="label info radius">1.3.160205</span></a></li>
					<li class="divider"></li>
					<li><a class="button radius" ng-click="logout()"><i class="fi-power"></i>&nbsp;Logout</a></li>&nbsp;
				</ul>
			</section>
		</nav>
	</div>
	<?php
	$tmpArray = explode(",", $_SESSION["sys_philinsure_menu_access"]);
	$sqlMenu = "";
	foreach ($tmpArray as $tmpValue) {
		$sqlMenu .= "'" . $tmpValue . "',";
	}
	$sqlMenu = substr($sqlMenu, 0, -1);
	echo "<span style='font-size: 20px;'></span>";
	$parentMenu = $fpdo
		->from("menu")
		->innerJoin("menu AS mainMenu ON menu.parent = mainMenu.id")
		->select(NULL)
		->select("mainMenu.name,mainMenu.label,mainMenu.link,mainMenu.icon")
		->where("menu.active", true)
		->where("menu.name in (" . $sqlMenu . ")")
		->groupBy("menu.parent")
		->fetchAll();
	?>
	<div>
		<div class="row">
			<ul class="tabs" data-tab>
				<li class="tab-title active"><a href="#homeMenu"><i class="fi-home"></i>&nbsp;Home</a></li>
				<?php
				foreach ($parentMenu as $value) {
					echo "<li class='tab-title'><a href='#" . $value["name"] . "Menu'><i class='" . $value["icon"] . "'></i>&nbsp;" . $value["label"] . "</a></li>";
				}
				?>
			</ul>
		</div>
		<div class="tabs-content">
			<div class="content active" id="homeMenu">
				<?php include_once("home.php"); ?>
			</div>
			<?php
			foreach ($parentMenu as $value) {
				echo "<div class='content' id='" . $value["name"] . "Menu'>";
				include_once($value["link"]);
				echo "</div>";
			}
			?>
		</div>
	</div>
	<?php include_once("version.php"); ?>
</body>

</html>
<script>
	$(document).foundation();
	app.controller('ctrlMain', function($scope) {
		$scope.logout = function() {
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				window.location.assign(window.location.href + 'login.php');
			});
			showConfirmation('fi-info', 'Warning', 'Are you sure you want to logout?');
		};
		$scope.showVersion = function() {
			$('#modalVersion').foundation('reveal', 'open');
		};
	});
</script>