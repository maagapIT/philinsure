<?php
$fieldsMarineCertificate = array(
	 array("referenceNumberMarineCertificate", "reference_number", "", false)
	,array("dateIssuedMarineCertificate", "date_issued", "date", true)
	,array("policyNumberMarineCertificate", "policy_number", "", true)
	,array("marineInsuredIdMarineCertificate", "insured_name", "", false)
	,array("insuredAddressMarineCertificate", "insured_address", "", true)
	,array("vesselMarineCertificate", "vessel", "", false)
	,array("certificateNumberMarineCertificate", "certificate_number", "", true)
	,array("agentCodeMarineCertificate", "agent_code", "", true)
	,array("subjectMatterInsuredMarineCertificate", "subject_matter_insured", "", false)
	,array("voyageFromMarineCertificate", "voyage_from", "", false)
	,array("etdMarineCertificate", "etd", "date", false)
	,array("blnumMarineCertificate", "blnum", "", false)
	,array("consigneeMarineCertificate", "consignee", "", false)
	,array("consigneeAddressMarineCertificate", "consignee_address", "", false)
	,array("voyageToMarineCertificate", "voyage_to", "", false)
	,array("etaMarineCertificate", "eta", "date", false)
	,array("lcnumMarineCertificate", "lcnum", "", false)
	,array("mortgageeMarineCertificate", "mortgagee", "", false)
	,array("dateEffectiveMarineCertificate", "date_effective", "date", false)
	,array("dateExpiryMarineCertificate", "date_expiry", "date", false)
);
$fieldsMarineCertificateCoverage = array(
	 array("coverageCodeMarineCertificateCoverage_", "marine_coverage_id", "", false)
	,array("invoiceMarineCertificateCoverage_", "invoice_amount", "", false)
	,array("markupPercentMarineCertificateCoverage_", "markup_percent", "", false)
	,array("markupAmountMarineCertificateCoverage_", "markup_amount", "", false)
	,array("sumInsuredMarineCertificateCoverage_", "sum_insured", "", false)
	,array("ratePercentMarineCertificateCoverage_", "rate_percent", "", false)
	,array("premiumMarineCertificateCoverage_", "premium", "", false)
);
$fieldsMarineCertificateCoverageTotals = array(
	 array("totalSumInsuredMarineCertificateCoverage", "total_sum_insured", "", false)
	,array("totalPremiumMarineCertificateCoverage", "total_premium", "", false)
	,array("valueAddedTaxMarineCertificateCoverage", "value_added_tax", "", false)
	,array("documentStampMarineCertificateCoverage", "document_stamp", "", false)
	,array("localGovernmentTaxMarineCertificateCoverage", "local_government_tax", "", false)
	,array("othersMarineCertificateCoverage", "other_charges", "", false)
	,array("totalAmountDueMarineCertificateCoverage", "total_amount_due", "", false)
);
function clearMarineCertificateCoverages() {
	$f = $GLOBALS["fieldsMarineCertificateCoverage"];
	for($i = 1; $i <= 4; $i++) {
		foreach($f as $j => $r)
			echo "\$scope.".$f[$j][0].$i." = ''; $('#".$f[$j][0].$i."').val(''); ";
	}
}
function editMarineCertificateCoverages() {
	$f = $GLOBALS["fieldsMarineCertificateCoverage"];
	for($i = 1; $i <= 4; $i++) {
		echo "if(data[".($i-1)."]) {";
		foreach($f as $j => $r) {
			echo "\$scope.coverageId[".($i-1)."] = data[".($i-1)."].id;";
			if($f[$j][1] != 'marine_coverage_id' && $f[$j][1] != 'premium') {
				echo "\$scope.".$f[$j][0].$i." = \$scope.currency(data[".($i-1)."].".$f[$j][1].");";
				echo "$('#".$f[$j][0].$i."').val(\$scope.currency(data[".($i-1)."].".$f[$j][1]."));";
			} else {
				echo "\$scope.".$f[$j][0].$i." = data[".($i-1)."].".$f[$j][1].";";
				echo "$('#".$f[$j][0].$i."').val(data[".($i-1)."].".$f[$j][1].");";
			}
		}
		echo "}";
	}
}
?>
<a href="#ctrlMarineCertificate" id="menuMarineCertificate">Marine Certificate Issuance</a>
<div id="ctrlMarineCertificate" ng-controller="ctrlMarineCertificate" class="content" ng-init="initialize()">
	<p>Allows you to add, edit, and delete Marine Certificates Issuance.</p>
	<div class="columns panel">
		<button class="button medium radius toolbar-button" ng-click="add()" title="Issue a certificate" data-tooltip><i class="fi-plus"></i>&nbsp;Add Record</button>
		<button class="button medium radius toolbar-button" ng-click="refresh()" title="Refresh the table" data-tooltip><i class="fi-refresh"></i>&nbsp;Refresh Table</button>
	</div>
	<table id="tableMarineCertificate"></table>
	<div id="modalMarineCertificate" name="modalMarineCertificate" class="reveal-modal full" aria-hidden="true" role="dialog" data-reveal ng-form>
		<h5></h5>
		<div class="large-3 medium-6 small-12 columns">
			<?php echo createField("referenceNumberMarineCertificate", "Reference Number", "text", false, "", ""); ?>
			<?php echo createField("dateIssuedMarineCertificate", "Date Issued", "date", true, "disabled", ""); ?>
			<?php echo createField("policyNumberMarineCertificate", "Policy Number", "text", true, "disabled", ""); ?>
			<?php // echo createField("marineInsuredIdMarineCertificate", "Marine Insured", "text", true, "disabled", ""); ?>
			<?php echo createField("marineInsuredIdMarineCertificate", "Marine Insured", "select", true, "ng-click='getInsuredAddress();'", fetchSelectData("location", "name AS value,name", "name != '".$_SESSION["sys_philinsure_central_location"]."'")); ?>
			<?php echo createField("insuredAddressMarineCertificate", "Insured Address", "textarea", true, "disabled", ""); ?>
			<?php echo createField("vesselMarineCertificate", "Vessel", "text", false, "", ""); ?>
		</div>
		<div class="large-3 medium-6 small-12 columns">
			<?php echo createField("certificateNumberMarineCertificate", "Certificate Number", "text", true, "disabled", ""); ?>
			<?php echo createField("agentCodeMarineCertificate", "Agent Code Number", "text", true, "disabled", ""); ?>
			<?php echo createField("subjectMatterInsuredMarineCertificate", "Subject Matter Insured", "textarea", true, "", ""); ?>
		</div>
		<div class="large-3 medium-6 small-12 columns">
			<?php echo createField("voyageFromMarineCertificate", "Voyage From", "text", true, "", ""); ?>
			<?php echo createField("etdMarineCertificate", "ETD", "date", false, "onblur='angular.element(\"#ctrlMarineCertificate\").scope().setEffectiveDate($(this).val());'", ""); ?>
			<?php echo createField("blnumMarineCertificate", "B/L (AWB) Number", "text", false, "", ""); ?>
			<?php echo createField("consigneeMarineCertificate", "Consignee", "text", false, "", ""); ?>
			<?php echo createField("consigneeAddressMarineCertificate", "Consignee Address", "textarea", false, "", ""); ?>
		</div>
		<div class="large-3 medium-6 small-12 columns">
			<?php echo createField("voyageToMarineCertificate", "Voyage To", "text", true, "", ""); ?>
			<?php echo createField("etaMarineCertificate", "ETA", "date", false, "", ""); ?>
			<?php echo createField("lcnumMarineCertificate", "LC Number", "text", false, "", ""); ?>
			<?php echo createField("mortgageeMarineCertificate", "Mortgagee", "text", false, "", ""); ?>
			<?php echo createField("dateEffectiveMarineCertificate", "Effectivity Date", "date", true, "ng-change='getExpiryDate();'", ""); ?>
			<?php echo createField("dateExpiryMarineCertificate", "Expiry Date", "date", true, "", ""); ?>
		</div>
		<div class="right">
			<button class="button radius mod-button" tabindex="0" ng-model="saveButton" id="saveButton" ng-click="save();" ng-disabled="modalMarineCertificate.$invalid">Save</button>
			<button class="button radius mod-button" tabindex="0" onclick="$('#modalMarineCertificate').foundation('reveal', 'close')">Close</button>
		</div>
	</div>
	<div id="modalMarineCertificateCoverage" name="modalMarineCertificateCoverage" class="reveal-modal full" aria-hidden="true" role="dialog" data-reveal ng-form>
		<div class="large-10 medium-12 small-12 columns">
			<div class="columns panel">
				<div class="large-4 medium-4 small-4 columns">
					<label>Currency
						<select id="currencyMarineCertificateCoverage" name="currencyMarineCertificateCoverage" ng-model="currencyMarineCertificateCoverage" ng-disabled="!modalMarineCertificateCoverage.otherCurrencyMarineCertificateCoverage.$error.required" ng-click="handleRateCurrency();" class="disabledCoverage" required>
							<option value="PHP">PHP</option>
							<option value="USD">USD</option>
							<option value="EUR">EUR</option>
							<option value="RMB">RMB</option>
						</select>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>If Other Currency
						<input id="otherCurrencyMarineCertificateCoverage" name="otherCurrencyMarineCertificateCoverage" ng-model="otherCurrencyMarineCertificateCoverage" type="text" class="disabledCoverage" required />
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>Rate
						<input id="rateCurrencyMarineCertificateCoverage" name="rateCurrencyMarineCertificateCoverage" ng-model="rateCurrencyMarineCertificateCoverage" ng-blur="rateCurrencyMarineCertificateCoverage = percentage(rateCurrencyMarineCertificateCoverage); setCoverageTotal();" type="text" class="text-right disabledCoverage" required />
					</label>
				</div>
			</div>
			<table>
				<tr><th class="text-center">Coverage Code</th><th class="text-center">Invoice</th><th class="text-center">Mark-up %</th><th class="text-center">Mark-up Amount</th><th class="text-center">Sum Insured</th><th class="text-center">Rate %</th><th class="text-center">Premium</th></tr>
				<?php
				for($i = 1; $i <= 4; $i++) {
					echo "
					<tr>
						<td width='110px'>".createField("coverageCodeMarineCertificateCoverage_".$i, "", "select", false, "class='disabledCoverage' ng-click='getRatePercent(".$i."); setCoverage(".$i."); setCoverageTotal();'", fetchSelectData('marine_coverage', 'id AS value,code AS name', ''))."</td>
						<td>".createField("invoiceMarineCertificateCoverage_".$i, "", "text", false, "class='text-right disabledCoverage' ng-blur='invoiceMarineCertificateCoverage_".$i." = currency(invoiceMarineCertificateCoverage_".$i."); setCoverage(".$i."); setCoverageTotal();'", "")."</td>
						<td>".createField("markupPercentMarineCertificateCoverage_".$i, "", "text", false, "class='text-right disabledCoverage' ng-blur='markupPercentMarineCertificateCoverage_".$i." = currency(markupPercentMarineCertificateCoverage_".$i."); setCoverage(".$i."); setCoverageTotal();'", "")."</td>
						<td>".createField("markupAmountMarineCertificateCoverage_".$i, "", "text", false, "class='text-right' disabled", "")."</td>
						<td>".createField("sumInsuredMarineCertificateCoverage_".$i, "", "text", false, "class='text-right' disabled", "")."</td>
						<td>".createField("ratePercentMarineCertificateCoverage_".$i, "", "text", false, "class='text-right' ng-init='ratePercentMarineCertificateCoverage_".$i." = \"0.0000\"' disabled", "")."</td>
						<td>".createField("premiumMarineCertificateCoverage_".$i, "", "text", false, "class='text-right' disabled", "")."</td>
					</tr>
					";
				}
				?>
			</table>
		</div>
		<div class="large-2 medium-12 small-12 columns">
			<label>Total Sum Insured<input type="text" class="text-right" id="totalSumInsuredMarineCertificateCoverage" name="totalSumInsuredMarineCertificateCoverage" ng-model="totalSumInsuredMarineCertificateCoverage" disabled /></label>
			<label>Premium<input type="text" class="text-right" id="totalPremiumMarineCertificateCoverage" name="totalPremiumMarineCertificateCoverage" ng-model="totalPremiumMarineCertificateCoverage" disabled /></label>
			<label>Value Added Tax<input type="text" class="text-right" id="valueAddedTaxMarineCertificateCoverage" name="valueAddedTaxMarineCertificateCoverage" ng-model="valueAddedTaxMarineCertificateCoverage" disabled /></label>
			<label>Document Stamp<input type="text" class="text-right" id="documentStampMarineCertificateCoverage" name="documentStampMarineCertificateCoverage" ng-model="documentStampMarineCertificateCoverage" disabled /></label>
			<label>Local Government Tax<input type="text" class="text-right" id="localGovernmentTaxMarineCertificateCoverage" name="localGovernmentTaxMarineCertificateCoverage" ng-model="localGovernmentTaxMarineCertificateCoverage" disabled /></label>
			<label>Others<input type="text" class="text-right disabledCoverage" id="othersMarineCertificateCoverage" name="othersMarineCertificateCoverage" ng-model="othersMarineCertificateCoverage" ng-blur="othersMarineCertificateCoverage = currency(othersMarineCertificateCoverage); setCoverageTotal();" required /></label>
			<label>Total Amount Due<input type="text" class="text-right" id="totalAmountDueMarineCertificateCoverage" name="totalAmountDueMarineCertificateCoverage" ng-model="totalAmountDueMarineCertificateCoverage" disabled required /></label>
		</div>
		<div class="right">
			<button id="saveMarineCoverage" class="button radius mod-button disabledCoverage" tabindex="0" ng-click="saveCoverage();" ng-disabled="
				modalMarineCertificateCoverage.othersMarineCertificateCoverage.$error.required || 
				modalMarineCertificateCoverage.currencyMarineCertificateCoverage.$error.required || 
				modalMarineCertificateCoverage.rateCurrencyMarineCertificateCoverage.$error.required">Save</button>
			<button id="closeMarineCoverage" class="button radius mod-button" tabindex="0" ng-click="closeCoverage();">Close</button>
		</div>
	</div>
	<script>
	app.controller('ctrlMarineCertificate', function($scope, $filter) {
		$scope.handleRateCurrency = function() {
			if($('#currencyMarineCertificateCoverage').val() == 'PHP') {
				$('#rateCurrencyMarineCertificateCoverage').attr('disabled', 'disabled');
				$('#rateCurrencyMarineCertificateCoverage').val('1');
				$scope.rateCurrencyMarineCertificateCoverage = '1';
			} else {
				$('#rateCurrencyMarineCertificateCoverage').removeAttr('disabled');
			}
			$scope.setCoverageTotal();
		};
		$scope.id = '';
		$scope.valueAddedTax = 0;
		$scope.certificateExtension = 1;
		$scope.coverageId = [0, 0, 0, 0];
		$scope.disabledCoverage = false;
		$scope.disable = function() {
			<?php disableFields($fieldsMarineCertificate); ?>
			$('#lcnumSwitchMarineCertificate').attr('disabled', 'disabled');
		};
		$scope.enable = function() {
			<?php enableFields($fieldsMarineCertificate); ?>
			$('#lcnumSwitchMarineCertificate').removeAttr('disabled');
		}
		$scope.constant = function() {
			policyNumber = '<?php echo $_SESSION["sys_philinsure_policy_number"]; ?>';
			$scope.policyNumberMarineCertificate = policyNumber; $('#policyNumberMarineCertificate').val(policyNumber);
			$scope.dateIssuedMarineCertificate = new Date(); $('#dateIssuedMarineCertificate').val($filter('date')(new Date(), 'yyyy-MM-dd'));
			$scope.getCertificateExtension(policyNumber);
			agentCode = '<?php echo $_SESSION["sys_philinsure_agent_code"]; ?>';
			$scope.agentCodeMarineCertificate = agentCode; $('#agentCodeMarineCertificate').val(agentCode);
			marineInsured = '<?php echo $_SESSION["sys_philinsure_location_name"]; ?>';
			$scope.marineInsuredIdMarineCertificate = marineInsured; $('#marineInsuredIdMarineCertificate').val(marineInsured);
			marineInsuredAddress = '<?php echo preg_replace('/\s\s+/', '\\n', $_SESSION["sys_philinsure_location_address"]); ?>';
			$scope.insuredAddressMarineCertificate = marineInsuredAddress; $('#insuredAddressMarineCertificate').val(marineInsuredAddress);
			$scope.setEffectiveDate($scope.dateIssuedMarineCertificate);
		};
		$scope.setCoverage = function(batch) {
			var invoiceAmount = unformatCurrency($('#invoiceMarineCertificateCoverage_' + batch).val());
			var markupPercent = unformatCurrency($('#markupPercentMarineCertificateCoverage_' + batch).val());
			var ratePercent = unformatCurrency($('#ratePercentMarineCertificateCoverage_' + batch).val());
			var markupAmount = (markupPercent / 100) * invoiceAmount;
			sumInsured = invoiceAmount + markupAmount;
			premium = (ratePercent / 100) * sumInsured;
			$('#markupAmountMarineCertificateCoverage_' + batch).val($scope.currency(markupAmount));
			$('#sumInsuredMarineCertificateCoverage_' + batch).val($scope.currency(sumInsured));
//			$('#premiumMarineCertificateCoverage_' + batch).val($scope.currency(premium));
			$('#premiumMarineCertificateCoverage_' + batch).val(premium);
		};
		$scope.setCoverageTotal = function() {
			var totalSumInsured = 0;
			var totalPremium = 0;
			for(i = 1; i <= 4; i++) {
				totalSumInsured += unformatCurrency($('#sumInsuredMarineCertificateCoverage_' + i).val());
				totalPremium += unformatCurrency($('#premiumMarineCertificateCoverage_' + i).val());
			}
			var rateCurrencyMarineCertificateCoverage = unformatCurrency($('#rateCurrencyMarineCertificateCoverage').val());
			totalSumInsured = totalSumInsured * rateCurrencyMarineCertificateCoverage;
			totalPremium = totalPremium * rateCurrencyMarineCertificateCoverage;
			if(totalPremium < 500) {
				totalPremium = 500;
			}
			var valueAddedTax = (<?php echo $_SESSION["sys_philinsure_percentage_value_added_tax"]; ?> / 100) * totalPremium;
			$scope.valueAddedTax = valueAddedTax;
//			console.log(valueAddedTax);
//			console.log($scope.valueAddedTax);
			var documentStamp = (<?php echo $_SESSION["sys_philinsure_percentage_document_stamp"]; ?> / 100) * totalPremium;
			var localGovernmentTax = (<?php echo $_SESSION["sys_philinsure_percentage_local_government_tax"]; ?> / 100) * totalPremium;
			var otherCharges = unformatCurrency($('#othersMarineCertificateCoverage').val()) * rateCurrencyMarineCertificateCoverage;
			var totalAmountDue = totalPremium + valueAddedTax + documentStamp + localGovernmentTax + otherCharges;
			$('#totalSumInsuredMarineCertificateCoverage').val($scope.currency(totalSumInsured));
			$('#totalPremiumMarineCertificateCoverage').val($scope.currency(totalPremium));
			$('#valueAddedTaxMarineCertificateCoverage').val($scope.currency(valueAddedTax));
			$('#documentStampMarineCertificateCoverage').val($scope.currency(documentStamp));
			$('#localGovernmentTaxMarineCertificateCoverage').val($scope.currency(localGovernmentTax));
			$('#othersMarineCertificateCoverage').val($scope.currency(otherCharges));
			$('#totalAmountDueMarineCertificateCoverage').val($scope.currency(totalAmountDue));
		};
		$scope.initialize = function() {
			$scope.fetch();
			$scope.clear();
		};
		$scope.clear = function() {
			<?php clearFields($fieldsMarineCertificate); ?>
			$scope.enable();
			$('#saveButton').html('Save').removeClass('success');
		};
		$scope.refresh = function() {
			var table = $('#tableMarineCertificate').DataTable();
			table.clear().draw();
			$.post('scripts/fetch-marine_certificate.php', {}, function(data) {
				table.rows.add(data).draw();
			}, 'json');
		};
		$scope.currency = function(n) {
			n += '';
			return $filter('currency')(unformatCurrency(n), '');
		};
		$scope.percentage = function(n) {
			n += '';
			return $filter('currency')(unformatCurrency(n), '', 4);
		};
		$scope.date = function(d) {
			return $filter('date')(new Date(d), 'MM/dd/yyyy');
		};
		$scope.date2 = function(d) {
			return $filter('date')(new Date(d), 'yyyy-MM-dd');
		};
		$scope.editDate = function(d) {
			return $filter('date')(new Date(d), 'yyyy-MM-dd');
		};
		$scope.datetime = function(d) {
			return $filter('date')(new Date(d), 'MM/dd/yyyy HH:mm');
		};
		$scope.saveDate = function(d) {
			return $filter('date')(new Date(d), 'yyyy-MM-dd HH:mm:ss');
		};
		$scope.fetch = function() {
			var flag = false;
			var url = '';
			$('#menuMarineCertificate').click(function() {
				if(!flag) {
					$.post('scripts/fetch-marine_certificate.php', {}, function(data) {
						$('#tableMarineCertificate').DataTable({
							data: data,
							order: [[2, 'asc']],
							columns: [
								 {'render': function(data, type, row) { return '<button class="button medium radius view-button" onclick="angular.element(\'#ctrlMarineCertificate\').scope().view(' + row.id + ');"><i class="fi-magnifying-glass"></i></button>'; }, 'title': '<span class="title-button">View</span>','bSortable': false, 'className': 'text-center', 'width': '20px'}
								,{'render': function(data, type, row) { return '<button class="button medium radius edit-button" onclick="edit(\'ctrlMarineCertificate\', ' + row.id + ', \'' + row.certificate_number + '\')"><i class="fi-pencil"></i></button>'; }, 'title': '<span class="title-button">Edit</span>','bSortable': false, 'className': 'text-center', 'width': '20px'}
								,{'data': 'certificate_number', 'title': 'Certificate Number'}
								,{'data': 'reference_number', 'title': 'Reference Number', 'className': 'text-center'}
								,{'data': 'insured_name', 'title': 'Insured Name'}
								,{'render': function(data, type, row) { return date('ctrlMarineCertificate', row.date_issued); }, 'title': 'Date Issued', 'className': 'text-center'}
								,{'render': function(data, type, row) { return '<button class="button medium radius view-button" onclick="angular.element(\'#ctrlMarineCertificate\').scope().viewCoverage(' + row.id + ');"><i class="fi-zoom-in"></i></button>'; }, 'title': '<span class="title-button">View Cov</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px'}
								,{'render': function(data, type, row) { return '<button class="button medium radius edit-button" onclick="angular.element(\'#ctrlMarineCertificate\').scope().editCoverage(' + row.id + ');"><i class="fi-clipboard-notes"></i></button>'; }, 'title': '<span class="title-button">Edit Cov</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px'}
								,{'render': function(data, type, row) { return currency('ctrlMarineCertificate', row.total_sum_insured); }, 'title': 'Sum Insured', 'className': 'text-right', 'width': '40px'}
								,{'render': function(data, type, row) { return currency('ctrlMarineCertificate', row.total_premium); }, 'title': 'Premium', 'className': 'text-right', 'width': '40px'}
								,{'render': function(data, type, row) { return currency('ctrlMarineCertificate', row.total_amount_due); }, 'title': 'Total Amount', 'className': 'text-right', 'width': '40px'}
								,{'render': function(data, type, row) { return datetime('ctrlMarineCertificate', row.date_created); }, 'title': 'Date Created', 'className': 'text-center'}
								,{'render': function(data, type, row) { row.total_amount_due <= 0 ? disabled = 'disabled' : disabled = ''; return '<button ' + disabled + ' class="button medium radius regular-button" onclick="angular.element(\'#ctrlMarineCertificate\').scope().post(' + row.id + ', \'' + row.certificate_number + '\');"><i class="fi-price-tag"></i></button>'; }, 'title': '<span class="title-button">Post</span>', 'bSortable': false, 'className': 'text-center', 'width': '20px'}
							]
						});
					}, 'json');
				}
				flag = true;
			});
		};
		$scope.edit = function(id) {
			url = 'scripts/edit.php'
			$scope.id = id;
			$scope.clear();
			$('#saveButton').removeAttr('disabled');
			$.post('scripts/get.php', {
				 'table': 'marine_certificate'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
					<?php editFields($fieldsMarineCertificate); ?>
					$('#modalMarineCertificate').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
		};
		$scope.view = function(id) {
//			console.log('id'+id);
			$.post('scripts/get.php', {
				 'table': 'marine_certificate'
				,'fields': 'id'
				,'id': id
			}, function(data) {
				if(data) {
//					console.log('step1');
					<?php editFields($fieldsMarineCertificate); ?>
//					console.log('step2');
					$('#modalMarineCertificate').foundation('reveal', 'open');
//					console.log('step3');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
			$scope.disable();
		};
		$scope.viewCoverage = function(id) {
			$scope.id = id;
			$scope.editCoverage(id);
			$('#modalMarineCertificateCoverage').foundation('reveal', 'open');
			$scope.setCoverageTotal();
//			$scope.disabledCoverage = true;
			$('.disabledCoverage').attr('disabled', 'disabled');
		};
		$scope.editCoverage = function(id) {
			$scope.id = id;
			$scope.coverageId = [0, 0, 0, 0];
			$.post('scripts/get-marine_coverage.php', { 'id': id }, function(data) {
				if(data) {
					<?php editMarineCertificateCoverages(); ?>
					$scope.disabledCoverage = false;
					$('#modalMarineCertificateCoverage').foundation('reveal', 'open');
				} else
					showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
			}, 'json');
			$.post('scripts/get.php', {
				 'table': 'marine_certificate'
				,'id': id
				,'fields': 'id'
			}, function(data) {
				$scope.currencyMarineCertificateCoverage = data.currency; $('#currencyMarineCertificateCoverage').val(data.currency);
				$scope.otherCurrencyMarineCertificateCoverage = data.currency_other; $('#otherCurrencyMarineCertificateCoverage').val(data.currency_other);
				$scope.rateCurrencyMarineCertificateCoverage = unformatCurrency(data.currency_rate); $('#rateCurrencyMarineCertificateCoverage').val(unformatCurrency(data.currency_rate));
				$scope.totalSumInsuredMarineCertificateCoverage = $scope.currency(data.total_sum_insured); $('#totalSumInsuredMarineCertificateCoverage').val($scope.currency(data.total_sum_insured));
				$scope.totalPremiumMarineCertificateCoverage = $scope.currency(data.total_premium); $('#totalPremiumMarineCertificateCoverage').val($scope.currency(data.total_premium));
				$scope.valueAddedTaxMarineCertificateCoverage = $scope.currency(data.value_added_tax); $('#valueAddedTaxMarineCertificateCoverage').val($scope.currency(data.value_added_tax));
				$scope.documentStampMarineCertificateCoverage = $scope.currency(data.document_stamp); $('#documentStampMarineCertificateCoverage').val($scope.currency(data.document_stamp));
				$scope.localGovernmentTaxMarineCertificateCoverage = $scope.currency(data.local_government_tax); $('#localGovernmentTaxMarineCertificateCoverage').val($scope.currency(data.local_government_tax));
				$scope.othersMarineCertificateCoverage = $scope.currency(data.other_charges); $('#othersMarineCertificateCoverage').val($scope.currency(data.other_charges));
				$scope.totalAmountDueMarineCertificateCoverage = $scope.currency(data.total_amount_due); $('#totalAmountDueMarineCertificateCoverage').val($scope.currency(data.total_amount_due));
				if($scope.currencyMarineCertificateCoverage == 'PHP')
					$('#rateCurrencyMarineCertificateCoverage').attr('disabled', 'disabled');
			}, 'json');
			$scope.setCoverageTotal();
//			console.log('haller');
			$scope.disable();
			$('.disabledCoverage').removeAttr('disabled');
		};
		$scope.saveCoverage = function() {
			$('#saveMarineCoverage').attr('disabled', 'disabled');
			var error = false;
			for(i = 1; i <= 4; i++) {
				if($scope.coverageId[(i - 1)]) url = 'scripts/edit.php';
				else url = 'scripts/add.php';
				if($('#coverageCodeMarineCertificateCoverage_' + i).val()) {
					$.post(url, {
						 'table': 'marine_coverage_details'
						,'id': $scope.coverageId[(i - 1)]
						,'fields': {
							 'marine_coverage_id'    : $('#coverageCodeMarineCertificateCoverage_' + i).val()
							,'marine_certificate_id' : $scope.id
							,'invoice_amount'        : unformatCurrency($('#invoiceMarineCertificateCoverage_' + i).val())
							,'markup_percent'        : unformatCurrency($('#markupPercentMarineCertificateCoverage_' + i).val())
							,'markup_amount'         : unformatCurrency($('#markupAmountMarineCertificateCoverage_' + i).val())
							,'sum_insured'           : unformatCurrency($('#sumInsuredMarineCertificateCoverage_' + i).val())
							,'rate_percent'          : unformatCurrency($('#ratePercentMarineCertificateCoverage_' + i).val())
							,'premium'               : unformatCurrency($('#premiumMarineCertificateCoverage_' + i).val())
						}
					}, function(data) {
						if(!data) error = true;
					}, 'json');
				} else if(!$('#coverageCodeMarineCertificateCoverage_' + i).val() || !$scope.coverageId[(i - 1)]) {
					if($scope.coverageId[(i - 1)])
						$.post('scripts/edit.php', {
							 'table': 'marine_coverage_details'
							,'id': $scope.coverageId[(i - 1)]
							,'fields': {
								'active': 0
							}
					}, function(data) {}, 'json');
				}
			}
			if(!error)
				$.post('scripts/edit.php', {
					 'table': 'marine_certificate'
					,'id': $scope.id
					,'fields': {
						 'currency'             : $('#currencyMarineCertificateCoverage').val()
						,'currency_other'       : $('#otherCurrencyMarineCertificateCoverage').val()
						,'currency_rate'        : unformatCurrency($('#rateCurrencyMarineCertificateCoverage').val())
						,'total_sum_insured'    : unformatCurrency($('#totalSumInsuredMarineCertificateCoverage').val())
						,'total_premium'        : unformatCurrency($('#totalPremiumMarineCertificateCoverage').val())
						,'value_added_tax'      : unformatCurrency($('#valueAddedTaxMarineCertificateCoverage').val())
//						,'value_added_tax'      : $scope.valueAddedTax
						,'document_stamp'       : unformatCurrency($('#documentStampMarineCertificateCoverage').val())
						,'local_government_tax' : unformatCurrency($('#localGovernmentTaxMarineCertificateCoverage').val())
						,'other_charges'        : unformatCurrency($('#othersMarineCertificateCoverage').val())
						,'total_amount_due'     : unformatCurrency($('#totalAmountDueMarineCertificateCoverage').val())
					}
				}, function(data) {
					showAlert('fi-info', 'Information', 'Record saved successfully.');
					$scope.closeCoverage();
					$scope.refresh();
				}, 'json');
			else
				showAlert('fi-alert', 'Error', 'Error on saving record details.');
		};
		$scope.delete = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/delete.php', {
					 'table': 'marine_certificate'
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
			$('#modalMarineCertificate h5').html('Add New Record');
			$('#modalMarineCertificate').foundation('reveal', 'open');
			$scope.clear();
			$scope.constant();
		};
		$scope.save = function() {
			$('#saveButton').attr('disabled', 'disabled');
			$.post(url, {
				 'table': 'marine_certificate'
				,'id': $scope.id
				,'fields': { <?php saveFields($fieldsMarineCertificate); ?> 
					,location_id: <?php echo $_SESSION["sys_philinsure_location_id"]; ?>
				}
			}, function(data) {
				if(data) {
					if(url == 'scripts/add.php') { // show saved record details after adding of record.
						$.post('scripts/get.php', {
							 'table': 'marine_certificate'
							,'fields': 'id'
							,'id': data
						}, function(data) {
							if(data) {
								<?php editFields($fieldsMarineCertificate); ?>
							} else
								showAlert('fi-alert', 'Error', 'Error on retrieving record details.');
						}, 'json');
						$('#saveButton').html('Record Saved Successfully').addClass("success");
						$scope.disable();
					} else {
						showAlert('fi-info', 'Information', 'Record saved successfully.');
						$scope.clear();
					}
					$scope.refresh();
				} else
					showAlert('fi-alert', 'Error', 'Error on saving new record.');
			}, 'json');
		};
		$scope.post = function(id, name) {
			$scope.id = id;
			$('#confirmed').prop('onclick', null).off('click').click(function() {
				$.post('scripts/edit.php', {
					 'table': 'marine_certificate'
					,'id': $scope.id
					,'fields': {
						posted: 1
					}
				}, function(data) {
					if(data) {
						showAlert('fi-info', 'Information', 'Record posted successfully.');
						$scope.refresh();
						window.open('reports/marine_posted_certificate_rpt.php?id=' + id);
						$.post('scripts/sendmail.php', {
							 'username'     : '<?php echo $_SESSION["sys_philinsure_agent_email"]; ?>'
							,'address'      : '<?php echo $_SESSION["sys_philinsure_location_email"]; ?>'
							,'from_name'    : '<?php echo $_SESSION["sys_philinsure_agent_name"]; ?>'
							,'address_name' : '<?php echo $_SESSION["sys_philinsure_location_name"]; ?>'
							,'subject'      : 'E-Marine Certificate Issuance'
							,'body'         : ' '
							,'file_name'    : name
						}, function(data) {
							console.log(data);
						}, 'json');
					} else
						showAlert('fi-alert', 'Error', 'Error on posting record.');
				}, 'json');
			});
			showConfirmation('fi-lightbulb', 'Confirmation', 'Are you sure you want to POST this record? [' + name + ']');
		};
		$scope.clearCoverage = function() {
			<?php clearMarineCertificateCoverages(); ?>
		};
		$scope.closeCoverage = function() {
			$('#modalMarineCertificateCoverage').foundation('reveal', 'close');
			$scope.clearCoverage();
		};
		$scope.getCertificateExtension = function(policyNumber) {
			$.post('scripts/get-marine_certificate_extension.php', {
				'policy_number': policyNumber
			}, function(data) {
				if(data) {
					if(data.extension != 0 && data.extension != '0' && data.extension != '') {
						var num = parseInt(data.extension) + 1;
						certificateNumber = policyNumber + '-' + padZero(num, 4);
					} else
						certificateNumber = policyNumber + '-' + padZero(1, 4);
					$scope.certificateNumberMarineCertificate = certificateNumber;
					$('#certificateNumberMarineCertificate').val(certificateNumber);
				}
			}, 'json');
		};
		$scope.setEffectiveDate = function(d) {
			var effectiveDate = new Date(d);
			$scope.dateEffectiveMarineCertificate = effectiveDate;
			$('#dateEffectiveMarineCertificate').val($scope.date2(effectiveDate));
			$scope.getExpiryDate();
		};
		$scope.getExpiryDate = function() {
			var expiryDate = new Date();
			var effectiveDate = new Date($scope.dateEffectiveMarineCertificate);
			expiryDate.setDate(effectiveDate.getDate() + 30);
			$scope.dateExpiryMarineCertificate =  expiryDate;
			$('#dateExpiryMarineCertificate').val($scope.date2(expiryDate));
		};
		$scope.getRatePercent = function(batch) {
			if($('#coverageCodeMarineCertificateCoverage_' + batch).val() != '')
				$.post('scripts/get.php', {
					 table: 'marine_coverage'
					,id: $('#coverageCodeMarineCertificateCoverage_' + batch).val()
					,fields: 'rate_percent'
				}, function(data) {
					$('#ratePercentMarineCertificateCoverage_' + batch).val(data.rate_percent);
				}, 'json');
			else
				$('#ratePercentMarineCertificateCoverage_' + batch).val('0.0000');
				
		};
		$scope.getInsuredAddress = function() {
			
		};
	});
	</script>
</div>