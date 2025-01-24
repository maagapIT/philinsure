<a href="#ctrlMarinePostedCertificate" id="menuMarinePostedcertificate">Marine Posted Certificates</a>
<div id="ctrlMarinePostedCertificate" ng-controller="ctrlMarinePostedCertificate" class="content" ng-init="fetch()">
	<p>Allows you print marine posts per certificates.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh Table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableMarinePostedCertificate"></table>
	<script>
	app.controller('ctrlMarinePostedCertificate', function($scope) {
		$scope.print = function(id) {
			window.open('reports/marine_posted_certificate_rpt.php?id=' + id);
		};
		$scope.refresh = function() {
			var table = $('#tableMarinePostedCertificate').DataTable();
			table.clear().draw();
			$.post('scripts/fetch-marine_posted_certificate.php', {}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuMarinePostedcertificate').click(function() {
				if(!flag) {
					$.post('scripts/fetch-marine_posted_certificate.php', {}, function(data) {
						$('#tableMarinePostedCertificate').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<button class="button medium radius view-button" onclick="angular.element(\'#ctrlMarinePostedCertificate\').scope().print(' + row.id + ');"><i class="fi-print"></i></button>'; }, 'title': '<span class="title-button">Print</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px'}
								,{'data': 'certificate_number', 'title': 'Certificate Number'}
								,{'data': 'reference_number', 'title': 'Reference Number', 'className': 'text-center'}
								,{'data': 'insured_name', 'title': 'Insured Name'}
								,{'render': function(data, type, row) { return currency('ctrlMarineCertificate', row.total_sum_insured); }, 'title': 'Sum Insured', 'className': 'text-right', 'width': '40px'}
								,{'render': function(data, type, row) { return currency('ctrlMarineCertificate', row.total_premium); }, 'title': 'Premium', 'className': 'text-right', 'width': '40px'}
								,{'render': function(data, type, row) { return currency('ctrlMarineCertificate', row.total_amount_due); }, 'title': 'Total Amount Due', 'className': 'text-right', 'width': '40px'}
								,{'render': function(data, type, row) { return datetime('ctrlMarineCertificate', row.date_created); }, 'title': 'Date Created', 'className': 'text-center'}
								,{'render': function(data, type, row) { return date('ctrlMarineCertificate', row.date_issued); }, 'title': 'Date Issued', 'className': 'text-center'}
								,{'render': function(data, type, row) { return datetime('ctrlMarineCertificate', row.date_created); }, 'title': 'Date Created', 'className': 'text-center'}
							]
						});
					}, 'json');
				}
				flag = true;
			});
		};
	});
	</script>
</div>