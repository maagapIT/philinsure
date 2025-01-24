<?php
session_start();
if(!(isset($_SESSION["sys_philinsure_username"]) && $_SESSION["sys_philinsure_username"] != "")) {
	header("Location: ../login.php");
}
require_once("../tcpdf/tcpdf.php");
include "../fluentpdo/FluentPDO.php";
require_once "../scripts/connect.php";
$pdo = new PDO("mysql:dbname=".$GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
class MYPDF extends TCPDF {
    public function Header() {
		$header = '
			<font face="monospace" size="10">
				<table border="0">
					<tr>
						<td align="center">
							<font size="14">
								<strong>MAA GENERAL ASSURANCE PHILS. INC</strong>
							</font>
						</td>
					</tr>
					<tr>
						<!--td width="75"><img src="marine_posted_certificate_rpt/logo.png" width="75"></td-->
						<td align="center" valign="middle">
							<font size="9">10TH FLOOR, PEARLBANK CENTRE 146 VALERO ST. SALCEDO VILLAGE, MAKATI CITY 1227<br />Tel: 02-867-2452 Fax: 02-893-2230</font>
						</td>
					</tr>
					<tr>
						<td align="center">
							<font size="15"><br />MARINE INSURANCE CERTIFICATE<hr width="252"/></font>
						</td>
					</tr>
				</table>
			</font>
		';
		$this -> Image("marine_posted_certificate_rpt/logo.png", 13, 13, 20, 0, "", "", "", true, 300);
		$this -> writeHTML($header, true, false, true, false, '');
	}
    public function Footer() {
		$footer = '
			<font face="monospace" size="10">
				<table border="0">
					<tr><td align="right">'.$GLOBALS["referenceNumber"].'</td></tr>
				</table>
			</font>
		';
		$this -> writeHTML($footer, true, false, true, false, '');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
$pdf -> SetHeaderMargin(10);
$pdf -> SetFooterMargin(10);
$result = $fpdo
	-> from('marine_certificate', $_GET["id"])
	-> where("active", 1)
	-> fetch();
$referenceNumber = $result['reference_number'];
$certificateNumber = $result["certificate_number"];
$markupPercent = getMarkupPercent();
$markupAmount = getMarkupAmount();
$pageWidth = 526;
//$coverageDetails = getCoverages();
/* begin page 1 */
//$pdf -> AddPage(PDF_PAGE_ORIENTATION, PDF_PAGE_FORMAT);
$pdf -> AddPage();
$pdf -> Ln(33);
$html = '
<font face="monospace" size="10">
	<table cellpadding="2" border="0">
		<tr>
			<td align="justify" colspan="6">THIS COMPANY, in consideration of the payment of the premium as arranged or specified in the schedule herein, insures against loss, damage, liability or expense, subject to the Terms and Conditions, Clauses, Endorsements, Special conditions and Warranties printed or stamped hereon, and/or attached hereto, loss or not loss, the shipment specified in the Schedule.<br /><hr /></td>
		</tr>
		<tr>
			<td width="105"><b>Open Policy No.</b></td>
			<td width="10"><b>:</b></td>
			<td width="179">'.$result["policy_number"].'</td>
			<td width="105"><b>Total Premium</b></td>
			<td width="10">:</td>
			<td width="117" align="right">'.number_format($result["total_premium"], 2).'</td>
		</tr>
		'.newRow1("Certificate No.", $result["certificate_number"], "Doc. Stamps", number_format($result["document_stamp"], 2)).'
		'.newRow1("Issue Date", date('m/d/Y', strtotime($result['date_issued'])), "VAT", number_format($result["value_added_tax"], 2)).'
		'.newRow1("Agent Code", $result["agent_code"], "Local Gov't Tax", number_format($result["local_government_tax"], 2)).'
		'.newRow1("Name of Assured", $result["insured_name"], "Others",  number_format($result["other_charges"], 2)).'
		<!--tr>
			<td colspan="5"></td>
			<td align="right"><hr /></td>
		</tr-->
		<tr>
			<td rowspan="2"><b>Address</b></td>
			<td rowspan="2"><b>:</b></td>
			<td rowspan="2">'.$result["insured_address"].'</td>
			<td colspan="2"></td>
			<td align="right"><hr /></td>
		</tr>
		<tr>
			<td><b>Total Amount Due</b></td>
			<td><b>:</b></td>
			<td align="right">'.number_format($result["total_amount_due"], 2).'<br /><hr /></td>
		</tr>
	</table>
	<table cellpadding="2" border="0">
		<tr>
			<td colspan="6"><hr /></td>
		</tr>
		<tr>
			<td width="105"><b>Vessel Name</b></td>
			<td width="10"><b>:</b></td>
			<td width="177">'.($result['vessel'] != '' ? $result['vessel'] : "TBA").'</td>
			<td width="85"></td>
			<td width="10"></td>
			<td width="137"></td>
		</tr>
		'.newRow2("Voyage From", $result['voyage_from'], "Voyage To", $result['voyage_to']).'
		'.newRow2("ETD",($result['etd'] != '0000-00-00 00:00:00' ? date('m/d/Y', strtotime($result['etd'])) : "TBA"), "ETA", ($result['eta'] != '0000-00-00 00:00:00' ? date('m/d/Y', strtotime($result['eta'])) : "TBA")).'
		'.newRow2("B/L (AWB) Number", ($result['blnum'] != '' ? $result['blnum'] : "TBA"), "LC Number", ($result['lcnum'] != '' ? $result['lcnum'] : "N/A")).'
		<tr>
			<td><b>Consignee</b></td>
			<td><b>:</b></td>
			<td>'.($result['consignee'] != '' ? $result['consignee'] : "NIL").'</td>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td><b>Consignee Address</b></td>
			<td><b>:</b></td>
			<td colspan="4">'.($result['consignee_address'] != '' ? $result['consignee_address'] : "NIL").'</td>
		</tr>
		<tr>
			<td><b>Sum Insured</b></td>
			<td><b>:</b></td>
			<td colspan="4"><b>PHP '
				.number_format($result['total_sum_insured'], 2)
				.($result['currency'] != 'PHP' ? ' or '.$result['currency']
				.' '.number_format(($result['total_sum_insured'] / $result['currency_rate']) - $markupAmount, 2) : '' )
				.(intval($markupPercent) <= 0 ? '' : ' plus '.$markupPercent.'% markup').
				' '.($result['currency'] != 'PHP' ? ' at PHP '.number_format($result['currency_rate'], 4).' / '
				.$result['currency'].' 1.00 ' : '' ).'</b><br /></td>
		</tr>
	</table>
	<table cellpadding="2" border="0">
		<tr>
			<td colspan="4"><hr /></td>
		</tr>
		<tr>
			<td width="265"><b>Coverage(s)</b></td>
			<td width="87" align="right"><b>Sum Insured</b></td>
			<td width="87" align="right"><b>Rate</b></td>
			<td width="87" align="right"><b>Premium</b></td>
		</tr>
		'.getCoverages($result['currency'], $result['currency_rate']).'
		<tr><td colspan="4"></td></tr>
		<tr><td colspan="4"><b>Mortgagee : </b>'.($result['mortgagee'] != '' ? $result['mortgagee'] : "NIL").'</td></tr>
		<tr><td colspan="4"><b>Warranty / Clauses Attached : </b></td></tr>
		<tr><td colspan="4"><b>Claims Representative : </b></td></tr>
		<tr><td colspan="4"><b>Settling Agent : </b></td></tr>
		<tr><td colspan="4"><b>Claims, if any, Payable at : </b></td></tr>
		<tr><td colspan="4"><b>SUBJECT MATTER INSURED : </b>'.$result['subject_matter_insured'].'</td></tr>
	</table>
</font>
';
$pdf -> writeHTML($html, true, false, true, false, '');
/* end page 1 */
/* begin page 2 */
$pdf -> AddPage();
$pdf -> Ln(33);
$html = '
<font face="monospace" size="10">
	<table cellpadding="2" border="0">
		<tr>
			<td width="120"><b>Open Policy No.</b></td>
			<td width="404">'.$result['policy_number'].'</td>
		</tr>
		<tr>
			<td><b>Certificate No.</b></td>
			<td>'.$result['certificate_number'].'</td>
		</tr>
		<tr><td colspan="2" align="justify"></td></tr>
		<tr><td colspan="2" align="justify">
			Warranted that this Insurance shall not Inure directly or indirectly to the benefit of any fire Insurance Company, Carrier or baillee.<br /><br />
			Warranted free from any claim consequent upon detention and/or loss of time whether arising from a peril of the sea or otherwise.<br /><br />
			This Insurance is subject to English jurisdiction, except in the event that loss or losses are payable in the Philippines. In which case if the said laws and customs of England shall be in conflict with the laws of the Republic of the Philipines, then the laws of the Republic of the Philippines shall govern.<br /><br />
			N.B - All policies issured abroad on goods for voyage and made payable in the United Kingdom are required by law to have the necessary government stamp affixed within ten days after receipt in the United Kingdom.<br /><br />
			NOTICE "THE INSURANCE COMMISSIONER, with offices in Manila, Dagupan, Cebu and Davao is" the Government Official in charge of the faithful execution and enforcement of all laws relating to insurance and has supervision over insurance companies. He is ready at all times to render assistance in settling any controversy between an insurance company and a policyholder relating to insurance matters.<br /><br />
			Loss, if any, payable to Assured(s) or Order upon surrender of this Certificate, which covers the right of collecting any such loss as fully as if the property were covered by a special policy direct to the holder hereof. This Certificate is subject to all the terms and conditions of the Open Policy, provided however, that the rights of a bonafide holder, of this Certificate for value shall not be prejudiced by and terms of the Open Policy which are in conflict with the terms of this Certificate.<br /><br />
			In the event of loss or damage which may result in claim under this Insurance, immediate notice must be given to the claim representative named in the schedule at the port or place when the loss or damage is discovered in order that he may examine the goods and issue a survey report. If there be no such agent at such port, notice shall be immediately given to MAA General Assurance Phils.,Inc.<br /><br />
			IN WITNESS WHEREOF, the Company has caused this policy to be signed by its duly authotized officer representative at Makati City, Philippines.<br />
		</td></tr>
	</table>
	<table cellpadding="2" border="0">
		<tr><td colspan="2"></td></tr>
		<tr><td colspan="2"></td></tr>
		<tr>
			<td width="263"></td>
			<td width="263" align="center"><b>For and on the behalf of the</b></td>
		</tr>
		<tr>
			<td></td>
			<td align="center"><b>MAA GENERAL ASSURANCE PHILS. INC.</b></td>
		</tr>
		<tr>
			<td align="justify" rowspan="2"><b>Documentary stamps to the value shown on this Certificate are affixed and properly cancelled on the office copy of this policy.</b></td>
			<td align="center"><br /><br /><br /><b>________________________</b></td>
		</tr>
		<tr>
			<td align="center"><b>Authorized Signature</b></td>
		</tr>
	</table>
</font>
';
$pdf -> Image("marine_posted_certificate_rpt/signature.jpg", 120, 245, 60, 0, "", "", "", true, 300);
$pdf -> writeHTML($html, true, false, true, false, '');
/* end page 2 */
/* begin page 3 */
if($result["mortgagee"] != "") {
	$pdf -> AddPage();
	$pdf -> Ln(33);
	$html = '
	<font face="monospace" size="10">
		<table cellpadding="2" border="0">
			<tr><td align="center" colspan="2"><font size="20"><b>CERTIFICATION</b></font></td></tr>
			<tr><td colspan="2">'.date("F d, Y").'</td></tr>
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2">To whom it may concern:</td></tr>
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2" align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby certify that the Marine Cargo Policy No. '.$result["certificate_number"].' issued in favor of '.$result["insured_name"].' covering the cargo described hereunder is deemed legal and binding and in full force and effect for the period '.date('m/d/Y', strtotime($result['date_effective'])).' to '.date('m/d/Y', strtotime($result['date_expiry'])).'.</td></tr>
			<tr><td colspan="2"></td></tr>
		</table>
		<table cellpadding="2" border="0">
			<tr>
				<td width="100"><b>Cargo</b></td>
				<td width="11"><b>:</b></td>
				<td width="375">'.$result["subject_matter_insured"].'</td>
			</tr>
			'.newRow3("Vessel", $result["vessel"]).'
			'.newRow3("BL No.", ($result["blnum"] != '' ? $result["blnum"] : "TBA")).'
			'.newRow3("Bank", $result["mortgagee"]).'
			'.newRow3("L/C No.", $result["lcnum"]).'
			'.newRow3("Origin", $result["voyage_from"]).'
			<tr>
				<td><b>Sum Insured</b></td>
				<td><b>:</b></td>
				<td><b>PHP '
				.number_format($result['total_sum_insured'], 2)
				.($result['currency'] != 'PHP' ? ' or '.$result['currency']
				.' '.number_format(($result['total_sum_insured'] / $result['currency_rate']) - $markupAmount, 2) : '' )
				.(intval($markupPercent) <= 0 ? '' : ' plus '.$markupPercent.'% markup').
				' '.($result['currency'] != 'PHP' ? ' at PHP '.number_format($result['currency_rate'], 4).' / '
				.$result['currency'].' 1.00 ' : '' ).'</b><br /></td>
			</tr>
		</table>
		<table cellpadding="2" border="0">
			<tr>
				<td width="129"></td>
				<td width="128"></td>
				<td width="12"></td>
				<td width="128"></td>
				<td width="129"></td>
			</tr>
			<tr>
				<td></td>
				<td><b>Premium</b></td>
				<td><b>:</b></td>
				<td align="right"><b>PHP</b> '.number_format($result["total_premium"], 2).'</td>
				<td></td>
			</tr>
			'.newRow4("Doc. Stamps", number_format($result["document_stamp"], 2)).'
			'.newRow4("EVAT", number_format($result["value_added_tax"], 2)).'
			'.newRow4("LG Tax", number_format($result["local_government_tax"], 2)).'
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>____________________</td>
				<td></td>
			</tr>
			'.newRow4("Total", '<b>PHP</b> '.number_format($result["total_amount_due"], 2)).'
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><hr /></td>
				<td></td>
			</tr>
			<tr><td align="justify" colspan="5">It is further understood and agreed that in lieu of the non-presentation of the Official Receipt of payment, MAA General Assurance Phils., Inc shall be liable for any loss or damage occurring during the currency of the Policy.</td></tr>
		</table>
		<table cellpadding="2" border="0">
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td></td>
				<td align="center"><font size="14"><b>JOSHUA L. SALIGO</b></font></td>
			</tr>
			<tr>
				<td></td>
				<td align="center"><b>Underwriting</b></td>
			</tr>
			<tr>
				<td></td>
				<td align="center"><b>Marine & Aviation Dept</b></td>
			</tr>
		</table>
	</font>
	';
	$pdf -> Image("marine_posted_certificate_rpt/signature.jpg", 120, 225, 60, 0, "", "", "", true, 300);
	$pdf -> writeHTML($html, true, false, true, false, '');
}
/* end page 3 */
$pdf -> Output(__DIR__ .'\\..\\certificates\\'.$certificateNumber.'.pdf', 'F');
$pdf -> Output('marinePostedCertificate.pdf', 'I');
function newRow1($label1, $value1, $label2, $value2) {
	return '
		<tr>
			<td><b>'.$label1.'</b></td>
			<td><b>:</b></td>
			<td>'.$value1.'</td>
			<td><b>'.$label2.'</b></td>
			<td><b>:</b></td>
			<td align="right">'.$value2.'</td>
		</tr>
	';
}
function newRow2($label1, $value1, $label2, $value2) {
	return '
		<tr>
			<td><b>'.$label1.'</b></td>
			<td><b>:</b></td>
			<td>'.$value1.'</td>
			<td><b>'.$label2.'</b></td>
			<td><b>:</b></td>
			<td>'.$value2.'</td>
		</tr>
	';
}
function newRow3($label, $value) {
	return '
		<tr>
			<td><b>'.$label.'</b></td>
			<td><b>:</b></td>
			<td>'.$value.'</td>
		</tr>
	';
}
function newRow4($label, $value) {
	return '
		<tr>
			<td></td>
			<td><b>'.$label.'</b></td>
			<td><b>:</b></td>
			<td align="right">'.$value.'</td>
			<td></td>
		</tr>
	';
}
function getCoverages($currency, $rate) {
	$result = $GLOBALS["fpdo"]
		-> from("marine_coverage_details")
		-> select("marine_coverage.name AS marine_coverage_name")
		-> where("marine_coverage_details.marine_certificate_id", $_GET["id"])
		-> where("marine_coverage_details.active", 1)
		-> limit(4)
		-> orderBy("marine_coverage_details.id")
		-> fetchAll();
	$return = '';
	foreach($result as $value) {
		$GLOBALS["markupPercent"] = $value["markup_percent"];
		$return .= '
			<tr>
				<td>'.$value["marine_coverage_name"].'</td>
				<td align="right">'.number_format($currency != 'PHP' ? $value["sum_insured"] * $rate : $value["sum_insured"], 2).'</td>
				<td align="right">'.number_format($value["rate_percent"], 4).'</td>
				<td align="right">'.number_format(($currency != 'PHP' ? $value["premium"] * $rate : $value["premium"]) < 500 ? 500 : ($currency != 'PHP' ? $value["premium"] * $rate : $value["premium"]), 2).'</td>
			</tr>
		';
	}
	return $return;
}
function getMarkupPercent() {
	$result = $GLOBALS["fpdo"]
		-> from("marine_coverage_details")
		-> select(null)
		-> select('markup_percent')
		-> where("marine_certificate_id", $_GET["id"])
		-> where("active", 1)
		-> fetch();
	return $result["markup_percent"];
}
function getMarkupAmount() {
	$result = $GLOBALS["fpdo"]
		-> from("marine_coverage_details")
		-> select(null)
		-> select('markup_amount')
		-> where("marine_certificate_id", $_GET["id"])
		-> where("active", 1)
		-> fetch();
	return $result["markup_amount"];
}
?>