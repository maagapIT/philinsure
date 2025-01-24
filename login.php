<!doctype html>
<?php
session_start();
session_destroy();
?>
<html class="no-js" lang="en">

<head>
	<?php include_once("initial.php"); ?>
</head>
<!--body style="padding-top: 7%"-->

<body>
	<div class="row" ng-app="appLogin" ng-controller="ctrlLogin">
		<div class="large-4 small-centered columns">
			<div class="large-6 small-centered columns">
				<img src="images/maagap-logo.png"
					style="filter: invert(84%) sepia(11%) saturate(5073%) hue-rotate(358deg) brightness(103%) contrast(106%);" />
			</div>
			<div name="formLogin" ng-form="formLogin" class="panel clearfix radius medium" ng-init="initialize()">
				<h6>MAAGAP Insurance Inc.</h6>&nbsp;
				<?php echo createField("usernameLogin", "Username", "text", true, "ng-keyup='checkComplete(\$event);'", ""); ?>
				<?php echo createField("passwordLogin", "Password", "password", true, "ng-keyup='checkComplete(\$event);'", ""); ?>
				<div class="right">
					<button class="button mod-button radius" ng-disabled="formLogin.$invalid" ng-click="submit()">Login</button>
					<button class="button mod-button radius" ng-click="clear()">Clear</button>
				</div>
			</div>
			<div class="large-5 small-centered columns">
			</div>
		</div>
		<div id="modalLogin" name="modalLogin" ng-form="modalLogin" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal>
			<h5></h5>
			<p>Your account has no password defined. Please re-type your password from the login screen.</p>
			<?php echo createField("newPasswordLogin", "Confirm Password", "password", true, "ng-keyup='checkPassword()'", ""); ?>
			<div class="right">
				<button id="saveLogin" class="button radius mod-button" tabindex="0" ng-click="save();" ng-disabled="modalLogin.$invalid || invalidPassword">Save</button>
				<button class="button radius mod-button" tabindex="0" onclick="$('#modalLogin').foundation('reveal', 'close');">Close</button>
			</div>
		</div>
	</div>
</body>

</html>
<script>
	angular.module('appLogin', []).controller('ctrlLogin', function($scope) {
		$scope.initialize = function() {
			$('#usernameLogin').focus();
		};
		$scope.save = function() {
			$.post('scripts/edit-login.php', {
				'username': $('#usernameLogin').val(),
				'password': $('#passwordLogin').val()
			}, function(data) {
				strFilePath = window.location.href;
				window.location.assign(strFilePath.substr(0, (strFilePath.lastIndexOf("/"))) + '');
				$('#modalLogin').foundation('reveal', 'close');
			}, 'json');
		};
		$scope.checkPassword = function() {
			if ($('#passwordLogin').val() == $('#newPasswordLogin').val())
				$scope.invalidPassword = false;
			else
				$scope.invalidPassword = true;
		};
		$scope.checkComplete = function(e) {
			if (e.which == 13) {
				if ($scope.usernameLogin && $scope.passwordLogin) {
					$scope.submit();
				}
			}
		};
		$scope.submit = function() {
			$.post('scripts/get-login.php', {
				'username': $('#usernameLogin').val(),
				'password': $('#passwordLogin').val()
			}, function(data) {
				if (data == 'initial') {
					$('#saveLogin').attr('disabled', 'disabled');
					$('#modalLogin').foundation('reveal', 'open');
					$('#newPasswordLogin').focus();
				} else {
					if (data) {
						strFilePath = window.location.href;
						window.location.assign(strFilePath.substr(0, (strFilePath.lastIndexOf("/"))) + '');
					} else {
						showAlert('fi-alert', 'Error', 'Invalid Username or Password');
					}
				}
			}, 'json');
		};
		$scope.clear = function() {
			$scope.usernameLogin = '';
			$scope.passwordLogin = '';
			$scope.initialize();
		};
	});
</script>