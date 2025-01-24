<a href="#ctrlMarineCertificateSummary" id="menuMarineCertificateSummary">Marine Certificates Summary</a>
<div id="ctrlMarineCertificateSummary" ng-controller="ctrlMarineCertificateSummary" class="content">
	<p>Allows you print summary marine certificates.</p>
	<div class="columns panel">
		<div class="large-2 medium-2 small-2 columns">
			<?php echo createField("dateFromMarineCertificateSummary", "From", "date", true, "", ""); ?>
		</div>
		<div class="large-2 medium-2 small-2 columns">
			<?php echo createField("dateToMarineCertificateSummary", "To", "date", true, "", ""); ?>
		</div>
		<div class="large-2 medium-2 small-2 columns">
			<button class="button medium radius toolbar-button" ng-click="print()" title="Print report from selected date range" data-tooltip><i class="fi-print"></i>&nbsp;Print Report</button>
		</div>
		<div class="large-6 medium-6 small-6 columns"></div>
	</div>
	<script>
	app.controller('ctrlMarineCertificateSummary', function($scope, $filter) {
		$scope.print = function() {
			window.open('reports/marine_certificate_summary_rpt.php?f=' + $scope.date($scope.dateFromMarineCertificateSummary) + '&t=' + $scope.date($scope.dateToMarineCertificateSummary));
		};
		$scope.date = function(d) {
			return $filter('date')(new Date(d), 'yyyy-MM-dd');
		};
	});
	</script>
</div>