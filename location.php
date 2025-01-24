<?php
$fieldsLocation = array(
	 array("nameLocation", "name", "")
	,array("addressLocation", "address", "")
	,array("marinePolicyLocation", "marine_policy_id", "")
	,array("agentCodeLocation", "agent_id", "")
	,array("localGovernmentTaxLocation", "local_government_tax_percent", "numeric")
	,array("emailLocation", "email", "")
);
?>
<a href="#ctrlLocation" id="menuLocation">Location</a>
<div id="ctrlLocation" ng-controller="ctrlLocation" class="content" ng-init="fetch()">
	<p>Allows you to add, edit, and delete location details.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Add Location" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableLocation"></table>
	<div id="modalLocation" name="modalLocation" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<?php echo createField("nameLocation", "Name", "text", true, "", ""); ?>
		<?php echo createField("addressLocation", "Address", "textarea", true, "", ""); ?>
		<?php echo createField("marinePolicyLocation", "Marine Policy", "select", true, "", fetchSelectData("marine_policy", "id AS value,policy_number AS name", "")); ?>
		<?php echo createField("agentCodeLocation", "Agent Code", "select", true, "", fetchSelectData("agent", "id AS value,code AS name", "")); ?>
		<?php echo createField("localGovernmentTaxLocation", "Local Government Tax", "text", true, "ng-blur='localGovernmentTaxLocation = percent(localGovernmentTaxLocation);'", ""); ?>
		<?php echo createField("emailLocation", "E-Mail", "text", true, "", ""); ?>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-click="save();" id="saveLocation" ng-disabled="<?php validateFields("modalLocation", $fieldsLocation); ?>">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalLocation').foundation('reveal', 'close');">Close</button>
		</div>
	</div>
	<script>
	app.controller('ctrlLocation', function($scope, $filter) {
		$scope.id = '';
		$scope.clear = function() { <?php clearFields($fieldsLocation); ?> };
		$scope.refresh = function() {
			var table = $('#tableLocation').DataTable();
			table.clear().draw();
			$.post('scripts/fetch.php', {
				 'table': 'location'
				,'fields': 'id'
			}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuLocation').click(function() {
				if(!flag) {
					$.post('scripts/fetch.php', {
						 'table': 'location'
						,'fields': 'id'
					}, function(data) {
						$('#tableLocation').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<span data-tooltip aria-haspopup="true" class="has-tip radius" title="Edit ' + row.name + '"><button class="button medium radius edit-button" onclick="edit(\'ctrlLocation\', ' + row.id + ')"><i class="fi-pencil"></i></button></span>'; }, 'title': '<span class="title-button">Edit</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'render': function(data, type, row) { return '<button class="button medium radius delete-button" onclick="del(\'ctrlLocation\', ' + row.id + ', \'' + row.name + '\')"><i class="fi-trash"></i></button>'; }, 'title': '<span class="title-button">Delete</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'data': 'name', 'title': 'Name'}
								,{'data': 'address', 'title': 'Address'}
								,{'data': 'policy_number', 'title': 'Policy Number'}
								,{'data': 'agent_code', 'title': 'Agent Code'}
								,{'data': 'local_government_tax_percent', 'title': 'LGT', 'className': 'text-center'}
								,{'data': 'email', 'title': 'E-Mail', 'className': 'text-center'}
								,{'render': function(data, type, row) { return datetime('ctrlLocation', row.date_created); }, 'title': 'Date Created', 'className': 'text-center'}
							]
						});
					}, 'json');
				}
				flag = true;
			});
			$scope.clear();
		};
		$scope.datetime = function(d) {
			return $filter('date')(new Date(d), 'MM/dd/yyyy HH:mm');
		};
		$scope.percent = function(n) {
			n += '';
			return $filter('currency')(unformatCurrency(n), '', 4);
		};
		$scope.edit = function(id) {
			url = 'scripts/edit.php'
			$scope.id = id;
			$scope.clear();
			$.post('scripts/get.php', {
				 'table': 'location'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					<?php editFields($fieldsLocation); ?>
					$('#modalLocation').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'location'
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
			$('#modalLocation h5').html('Add New Record');
			$('#modalLocation').foundation('reveal', 'open');
			$scope.clear();
		};
		$scope.save = function() {
			$('#saveLocation').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'location'
				,'id': $scope.id
				,'fields': { <?php saveFields($fieldsLocation); ?> 
					,policy_number: $('#marinePolicyLocation option:selected').text()
					,agent_code: $('#agentCodeLocation option:selected').text()
				}
			}, function(data) {
				console.log(data);
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