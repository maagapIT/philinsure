<?php
$fieldsSettings = array(
	 array("nameSettings", "name", "", false)
	,array("valueSettings", "value", "", false)
);
?>
<a href="#ctrlSettings" id="menuSettings">System Settings</a>
<div id="ctrlSettings" ng-controller="ctrlSettings" class="content row" ng-init="fetch()">
	<p>Allows you to add, edit, and delete system settings.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Add a setting" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableSettings"></table>
	<div id="modalSettings" name="modalSettings" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<?php echo createField("nameSettings", "Name", "text", true, "", ""); ?>
		<?php echo createField("valueSettings", "Value", "text", true, "", ""); ?>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-click="save();" id="saveSettings" ng-disabled="modalSettings.$invalid">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalSettings').foundation('reveal', 'close');">Close</button>
		</div>
	</div>
	<script>
	app.controller('ctrlSettings', function($scope) {
		$scope.id = '';
		$scope.clear = function() { 
			<?php clearFields($fieldsSettings); ?>
			$scope.enable();
		};
		$scope.refresh = function() {
			var table = $('#tableSettings').DataTable();
			table.clear().draw();
			$.post('scripts/fetch.php', {
				 'table': 'system'
				,'fields': 'id'
			}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.enable = function() { <?php enableFields($fieldsMarineCertificate); ?> }
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuSettings').click(function() {
				if(!flag) {
					$.post('scripts/fetch.php', {
						 'table': 'system'
						,'fields': 'id'
					}, function(data) {
						console.log(data);
						$('#tableSettings').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<span data-tooltip aria-haspopup="true" class="has-tip radius" title="Edit ' + row.name + '"><button class="button medium radius edit-button" onclick="edit(\'ctrlSettings\', ' + row.id + ')"><i class="fi-pencil"></i></button></span>'; }, 'title': '<span class="title-button">Edit</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'render': function(data, type, row) { return '<button class="button medium radius delete-button" onclick="del(\'ctrlSettings\', ' + row.id + ', \'' + row.name + '\')"><i class="fi-trash"></i></button>'; }, 'title': '<span class="title-button">Delete</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'data': 'name', 'title': 'Name'}
								,{'data': 'value', 'title': 'Value'}
							]
						});
					}, 'json');
				}
				flag = true;
			});
			$scope.clear();
		};
		$scope.edit = function(id) {
			url = 'scripts/edit.php'
			$scope.id = id;
			$scope.clear();
			$.post('scripts/get.php', {
				 'table': 'system'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					<?php editFields($fieldsSettings); ?>
					$('#modalSettings').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'system'
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
			$('#modalSettings h5').html('Add New Record');
			$('#modalSettings').foundation('reveal', 'open');
			$scope.clear();
		};
		$scope.save = function() {
			$('#saveSettings').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'system'
				,'id': $scope.id
				,'fields': { <?php saveFields($fieldsSettings); ?> }
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