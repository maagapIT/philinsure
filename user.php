<?php
$fieldsUser = array(
	 array("nameUser", "name", "", false)
	,array("firstNameUser", "first_name", "", false)
	,array("lastNameUser", "last_name", "", false)
	,array("emailUser", "email", "", false)
	,array("locationUser", "location_id", "", true)
	,array("roleUser", "role_id", "", true)
);
?>
<a href="#ctrlUser" id="menuUser">User</a>
<div id="ctrlUser" ng-controller="ctrlUser" class="content" ng-init="fetch()">
	<p>Allows you to add, edit, and delete User Account details.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Add user" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableUser"></table>
	<div id="modalUser" name="modalUser" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<?php echo createField("nameUser", "Username", "text", true, "", ""); ?>
		<?php echo createField("firstNameUser", "First Name", "text", true, "", ""); ?>
		<?php echo createField("lastNameUser", "Last Name", "text", true, "", ""); ?>
		<?php echo createField("emailUser", "E-Mail", "email", true, "email", ""); ?>
		<?php echo createField("locationUser", "Location", "select", true, "", fetchSelectData("location", "id AS value,name", "id = '".$_SESSION["sys_philinsure_location_id"]."'")); ?>
		<?php echo createField("roleUser", "Role", "select", true, "", fetchSelectData("role", "id AS value,name", "name = '".$_SESSION["sys_philinsure_role_name"]."'")); ?>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-click="save();" id="saveUser" ng-disabled="modalUser.$invalid">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalUser').foundation('reveal', 'close');">Close</button>
		</div>
	</div>
	<script>
	app.controller('ctrlUser', function($scope) {
		$scope.role = '<?php echo $_SESSION["sys_philinsure_role_name"]; ?>';
		$scope.id = '';
		$scope.clear = function() { 
			<?php clearFields($fieldsUser); ?>
			$scope.enable();
		};
		$scope.refresh = function() {
			var table = $('#tableUser').DataTable();
			table.clear().draw();
			$.post('scripts/fetch-user.php', {}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.disable = function() { <?php disableFields($fieldsMarineCertificate); ?> };
		$scope.enable = function() { <?php enableFields($fieldsMarineCertificate); ?> }
		$scope.constant = function() {
//			if()
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuUser').click(function() {
				if(!flag) {
					$.post('scripts/fetch-user.php', {}, function(data) {
						console.log(data);
						$('#tableUser').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<span data-tooltip aria-haspopup="true" class="has-tip radius" title="Edit ' + row.name + '"><button class="button medium radius edit-button" onclick="edit(\'ctrlUser\', ' + row.id + ')"><i class="fi-pencil"></i></button></span>'; }, 'title': '<span class="title-button">Edit</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'render': function(data, type, row) { return '<button class="button medium radius delete-button" onclick="angular.element(\'#ctrlUser\').scope().delete(' + row.id + ', \'' + row.name + '\')"><i class="fi-trash"></i></button>'; }, 'title': '<span class="title-button">Delete</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'data': 'name', 'title': 'Username', 'className': 'text-center'}
								,{'render': function(data, type, row) { return row.first_name + ' ' + row.last_name; }, 'title': 'Full Name' }
								,{'data': 'email', 'title': 'E-Mail'}
								,{'data': 'location_name', 'title': 'Location'}
								,{'data': 'role_name', 'title': 'Role'}
								,{'data': 'date_created', 'title': 'Date Created', 'className': 'text-center'}
								,{'render': function(data, type, row) { return '<button class="button medium radius view-button" onclick="angular.element(\'#ctrlUser\').scope().reset(' + row.id + ', \'' + row.name + '\')"><i class="fi-key"></i></button>'; }, 'title': '<span class="title-button">Reset Password</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
							]
						});
					}, 'json');
				}
				flag = true;
			});
			$scope.clear();
		};
		$scope.reset = function(id, name) {
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/reset-user.php', {
					'id': id
				}, function(data) {
//					if(data) {
						showAlert('fi-info', 'Information', 'Record saved successfully.');
						$scope.clear();
						$scope.refresh();
//					} else
//						showAlert('fi-alert', 'Error', 'Error on saving record.');
				}, 'json');
			});
			showConfirmation('fi-lightbulb', 'Confirmation', 'Are you sure you want to reset password? [' + name + ']');
		};
		$scope.edit = function(id) {
			url = 'scripts/edit.php'
			$scope.id = id;
			$scope.clear();
			$.post('scripts/get.php', {
				 'table': 'user'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					<?php editFields($fieldsUser); ?>
					$('#modalUser').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'user'
					,'id': $scope.id
				}, function(data) {
					if(data) {
						showAlert('fi-info', 'Information', 'Record deleted successfully.');
						$scope.refresh();
					} else
						showAlert('fi-alert', 'Error', 'Error on deleting record.');
				}, 'json');
			});
			showConfirmation('fi-lightbulb', 'Confirmation', 'Are you sure you want to delete this record? [' + name + ']');
		};
		$scope.add = function() {
			url = 'scripts/add.php'
			$('#modalUser h5').html('Add New Record');
			$('#modalUser').foundation('reveal', 'open');
			$scope.clear();
		};
		$scope.save = function() {
			$('#saveUser').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'user'
				,'id': $scope.id
				,'fields': { <?php saveFields($fieldsUser); ?>
					,location_name: $('#locationUser option:selected').text()
					,role_name: $('#roleUser option:selected').text()
				}
			}, function(data) {
				if(data) {
					showAlert('fi-info', 'Information', 'Record saved successfully.');
					$scope.clear();
					$scope.refresh();
				} else
					showAlert('fi-alert', 'Error', 'Error on saving new record.');
			}, 'json');
		};
	});
//	$(document).foundation('tooltip', 'reflow');
	</script>
</div>