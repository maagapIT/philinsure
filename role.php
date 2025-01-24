<a href="#ctrlRole" id="menuRole">Role</a>
<div id="ctrlRole" ng-controller="ctrlRole" class="content row" ng-init="fetch()">
	<p>Allows you to add, edit, and delete Role.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Add role" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableRole"></table>
	<div id="modalRole" name="modalRole" class="reveal-modal tiny" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<?php echo createField("nameRole", "Name", "text", true, "", ""); ?>
		<label>Menu Access&nbsp;<span style="color: red;">*</span><select id="menuAccessRole" name="menuAccessRole" ng-model="menuAccessRole" data-placeholder=" " multiple required>
		<?php
			$parentMenu = $fpdo
				-> from('menu')
				-> select('id')
			    -> where("active", true)
			    -> where("parent", 0)
				-> fetchAll()
			;
			$childMenu = $fpdo
				-> from('menu')
				-> select('id')
			    -> where("active", true)
			    -> where("parent <> 0")
				-> fetchAll()
			;
			foreach($parentMenu as $parentValue) {
				echo "<optgroup label='".$parentValue["label"]."'>";
				foreach($childMenu as $childValue) {
					if($parentValue["id"] == $childValue["parent"])
						echo "<option value='".$childValue["name"]."'>".$childValue["label"]."</option>";
				}
				echo "</optgroup>
					<!--div class='large-4 medium-4 small-4 columns'>
						<h6>".$value["label"]."</h6>
						<div class='switch radius small'>
							<input id='".$value["name"]."_Role' type='checkbox'>
							<label for='".$value["name"]."_Role'></label>
							<label for='".$value["name"]."_Role'>
								<span class='switch-on'>ON</span>
								<span class='switch-off'>OFF</span>
							</label>
						</div>
					</div-->
				";
			}
		?>
		</select></label>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-click="save();" id="saveRole" ng-disabled="modalRole.$invalid">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalRole').foundation('reveal', 'close');">Close</button>
		</div>
	</div>
	<script>
	$('#menuAccessRole').chosen({});
	app.controller('ctrlRole', function($scope) {
		$scope.id = '';
		$scope.clear = function() {
			$scope.nameRole = ''; $('#nameRole').val('');
			$scope.menuAccessRole = ''; $('#menuAccessRole').val('').trigger('chosen:updated');
		};
		$scope.refresh = function() {
			var table = $('#tableRole').DataTable();
			table.clear().draw();
			$.post('scripts/fetch.php', {
				 'table': 'role'
				,'fields': 'id'
			}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuRole').click(function() {
				if(!flag) {
					$.post('scripts/fetch.php', {
						 'table': 'role'
						,'fields': 'id'
					}, function(data) {
						$('#tableRole').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<span data-tooltip aria-haspopup="true" class="has-tip radius" title="Edit ' + row.name + '"><button class="button medium radius edit-button" onclick="edit(\'ctrlRole\', ' + row.id + ')"><i class="fi-pencil"></i></button></span>'; }, 'title': '<span class="title-button">Edit</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'render': function(data, type, row) { return '<button class="button medium radius delete-button" onclick="del(\'ctrlRole\', ' + row.id + ', \'' + row.name + '\')"><i class="fi-trash"></i></button>'; }, 'title': '<span class="title-button">Delete</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px' }
								,{'data': 'name', 'title': 'Role', 'className': 'text-center'}
								,{'data': 'date_created', 'title': 'Date Created', 'className': 'text-center'}
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
				 'table': 'role'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					$scope.nameRole = data.name; $('#nameRole').val(data.name);
					var menuAccess = data.menu.split(',');
					$scope.menuAccessRole = menuAccess; $('#menuAccessRole').val(menuAccess).trigger('chosen:updated');
					$('#modalRole').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'role'
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
			$('#modalRole h5').html('Add New Record');
			$('#modalRole').foundation('reveal', 'open');
			$scope.clear();
		};
		$scope.save = function() {
			$('#saveRole').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'role'
				,'id': $scope.id
				,'fields': { 
					 'name': $('#nameRole').val()
					,'menu': $('#menuAccessRole').val().toString()
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