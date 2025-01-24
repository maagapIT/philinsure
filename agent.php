<?php
$fieldsAgent = array(
	 array("agentCodeAgent", "code", "", false)
	,array("agentNameAgent", "name", "", false)
	,array("emailAgent", "email", "", false)
);
?>
<a href="#ctrlAgent" id="menuAgent">Agent</a>
<div id="ctrlAgent" ng-controller="ctrlAgent" class="content row" ng-init="fetch()">
	<p>Allows you to add, edit, and delete agent details.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Add an agent" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableAgent"></table>
	<div id="modalAgent" name="modalAgent" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<?php echo createField("agentCodeAgent", "Agent Code", "text", true, "", ""); ?>
		<?php echo createField("agentNameAgent", "Agent Name", "text", true, "", ""); ?>
		<?php echo createField("emailAgent", "E-Mail", "email", true, "email", ""); ?>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-click="save();" id="saveAgent" ng-disabled="modalAgent.$invalid">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalAgent').foundation('reveal', 'close');">Close</button>
		</div>
	</div>
	<script>
	app.controller('ctrlAgent', function($scope) {
		$scope.id = '';
		$scope.clear = function() { 
			<?php clearFields($fieldsAgent); ?>
		};
		$scope.refresh = function() {
			var table = $('#tableAgent').DataTable();
			table.clear().draw();
			$.post('scripts/fetch.php', {
				 'table': 'agent'
				,'fields': 'id'
			}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuAgent').click(function() {
				if(!flag) {
					$.post('scripts/fetch.php', {
						 'table': 'agent'
						,'fields': 'id'
					}, function(data) {
						console.log(data);
						$('#tableAgent').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<span data-tooltip aria-haspopup="true" class="has-tip radius" title="Edit ' + row.name + '"><button class="button medium radius edit-button" onclick="edit(\'ctrlAgent\', ' + row.id + ')"><i class="fi-pencil"></i></button></span>'; }, 'title': '<span class="title-button">Edit</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'render': function(data, type, row) { return '<button class="button medium radius delete-button" onclick="del(\'ctrlAgent\', ' + row.id + ', \'' + row.name + '\')"><i class="fi-trash"></i></button>'; }, 'title': '<span class="title-button">Delete</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'data': 'code', 'title': 'Agent Code', 'className': 'text-center'}
								,{'data': 'name', 'title': 'Agent Name'}
								,{'data': 'email', 'title': 'E-Mail', 'className': 'text-center'}
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
				 'table': 'agent'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					<?php editFields($fieldsAgent); ?>
					$('#modalAgent').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'agent'
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
			$('#modalAgent h5').html('Add New Record');
			$('#modalAgent').foundation('reveal', 'open');
			$scope.clear();
		};
		$scope.save = function() {
			$('#saveAgent').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'agent'
				,'id': $scope.id
				,'fields': { <?php saveFields($fieldsAgent); ?> }
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