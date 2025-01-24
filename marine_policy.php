<?php
$fieldsMarinePolicy = array(
	 array("policyNumber", "policy_number", "", false)
);
?>
<a href="#ctrlMarinePolicy" id="menuMarinePolicy">Marine Policy</a>
<div id="ctrlMarinePolicy" ng-controller="ctrlMarinePolicy" class="content row" ng-init="fetch()">
	<p>Allows you to add, edit, and delete marine policies.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Add a policy" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableMarinePolicy"></table>
	<div id="modalMarinePolicy" name="modalMarinePolicy" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<?php echo createField("policyNumber", "Policy Number", "text", true, "", ""); ?>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-click="save();" id="saveMarinePolicy" ng-disabled="modalMarinePolicy.$invalid">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalMarinePolicy').foundation('reveal', 'close');">Close</button>
		</div>
	</div>
	<script>
	app.controller('ctrlMarinePolicy', function($scope) {
		$scope.id = '';
		$scope.clear = function() { 
			<?php clearFields($fieldsMarinePolicy); ?>
		};
		$scope.refresh = function() {
			var table = $('#tableMarinePolicy').DataTable();
			table.clear().draw();
			$.post('scripts/fetch.php', {
				 'table': 'marine_policy'
				,'fields': 'id'
			}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuMarinePolicy').click(function() {
				if(!flag) {
					$.post('scripts/fetch.php', {
						 'table': 'marine_policy'
						,'fields': 'id'
					}, function(data) {
						console.log(data);
						$('#tableMarinePolicy').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<span data-tooltip aria-haspopup="true" class="has-tip radius" title="Edit ' + row.name + '"><button class="button medium radius edit-button" onclick="edit(\'ctrlMarinePolicy\', ' + row.id + ')"><i class="fi-pencil"></i></button></span>'; }, 'title': '<span class="title-button">Edit</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'render': function(data, type, row) { return '<button class="button medium radius delete-button" onclick="del(\'ctrlMarinePolicy\', ' + row.id + ', \'' + row.name + '\')"><i class="fi-trash"></i></button>'; }, 'title': '<span class="title-button">Delete</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'data': 'policy_number', 'title': 'Policy Number', 'className': 'text-center'}
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
				 'table': 'marine_policy'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					<?php editFields($fieldsMarinePolicy); ?>
					$('#modalMarinePolicy').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'marine_policy'
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
			$('#modalMarinePolicy h5').html('Add New Record');
			$('#modalMarinePolicy').foundation('reveal', 'open');
			$scope.clear();
		};
		$scope.save = function() {
			$('#saveMarinePolicy').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'marine_policy'
				,'id': $scope.id
				,'fields': { <?php saveFields($fieldsMarinePolicy); ?> }
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