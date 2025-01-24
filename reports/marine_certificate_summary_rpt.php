<?php
session_start();
if (!(isset($_SESSION["sys_philinsure_username"]) && $_SESSION["sys_philinsure_username"] != "")) {
	header("Location: ../login.php");
}
require_once("../tcpdf/tcpdf.php");
include "../fluentpdo/FluentPDO.php";
require_once "../scripts/connect.php";
$pdo = new PDO("mysql:dbname=" . $GLOBALS["dba"], $GLOBALS["usr"], $GLOBALS["pas"]);
$fpdo = new FluentPDO($pdo);
class MYPDF extends TCPDF
{
	public function Header()
	{
		$header = '
			<font face="monospace" size="10">
				<table border="0">
					<tr>
						<td align="center">
							<font size="14">
								<strong></strong>
							</font>
						</td>
					</tr>
					<tr>
						<!--td width="75"><img src="marine_posted_certificate_rpt/logo.png" width="75"></td-->
						<td align="center" valign="middle">
							<font size="9"></font>
						</td>
					</tr>
					<tr>
						<td align="center">
							<font size="15"><br /><br />MARINE INSURANCE CERTIFICATE<hr width="252"/></font>
						</td>
					</tr>
				</table>
			</font>
		';
		$this->Image("../images/header.png", 10, 10, 110, 0, "", "", "", true, 300);
		$this->writeHTML($header, true, false, true, false, '');
	}
	public function Footer()
	{
		$footer = '
			<font face="monospace" size="10">
				<table border="0">
					<tr><td>' . date('m/d/Y h:m:s A') . '</td></tr>
				</table>
			</font>
		';
		$this->writeHTML($footer, true, false, true, false, '');
	}
}
$pdf = new MYPDF("L", PDF_UNIT, "LEGAL", true, "UTF-8", false);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);
$certificateCount = 0;
$premiumTotal = 0;
$amountDueTotal = 0;
/* begin page 1 */
$pdf->AddPage();
$pdf->Ln(33);
$html = '
<font face="monospace" size="10">
	<table cellpadding="2" border="0">
		<tr>
			<td width="680" rowspan="3"><br /><br /><b>Policy No. : </b>' . $_SESSION["sys_philinsure_policy_number"] . '</td>
			<td width="60"><b>VAT</b></td>
			<td width="12"><b>:</b></td>
			<td width="141">&nbsp;' . $_SESSION["sys_philinsure_percentage_value_added_tax"] . ' %</td>
		</tr>
		<tr>
			<td><b>Doc Stamp</b></td>
			<td><b>:</b></td>
			<td>&nbsp;' . $_SESSION["sys_philinsure_percentage_document_stamp"] . ' %</td>
		</tr>
		<tr>
			<td><b>LGT</b></td>
			<td><b>:</b></td>
			<td>&nbsp;' . $_SESSION["sys_philinsure_percentage_local_government_tax"] . ' %</td>
		</tr>
	</table>
	<table cellpadding="2" border="0">
		<tr>
			<td width="70"><b>Issue Date</b></td>
			<td width="34"><b>Cert. No.</b></td>
			<td width="150"><b>Insured</b></td>
			<td width="374"><b>Subject Matter</b></td>
			<td width="90" align="right"><b>Sum Insured</b></td>
			<td width="90" align="right"><b>Premium</b></td>
			<td width="90" align="right"><b>Total Amt Due</b></td>
			<td width="41" align="center"><b>Posted</b></td>
		</tr>
		' . fetchData() . '
		<tr><td colspan="14"></td></tr>
		<tr>
			<td align="right" colspan="2"><b>No. of Certificates</b></td>
			<td align="right">' . number_format($certificateCount, 0) . '</td>
			<td align="right" colspan="2"><b>Subtotal : PHP</b></td>
			<td align="right">' . number_format($premiumTotal, 2) . '</td>
			<td align="right">' . number_format($amountDueTotal, 2) . '</td>
			<td></td>
		</tr>
		<tr><td colspan="14"></td></tr>
		<tr>
			<td align="right" colspan="2"><b>Total No. of Certificates</b></td>
			<td align="right">' . number_format($certificateCount, 0) . '</td>
			<td align="right" colspan="2"><b>Subtotal : PHP</b></td>
			<td align="right">' . number_format($premiumTotal, 2) . '</td>
			<td align="right">' . number_format($amountDueTotal, 2) . '</td>
			<td></td>
		</tr>
	</table>
</font>
';
$pdf->writeHTML($html, true, false, true, false, '');
/* end page 1 */
$pdf->Output('marinePostedCertificate.pdf', 'I');
function fetchData()
{
	if ($_SESSION["sys_philinsure_location_name"] == $_SESSION["sys_philinsure_central_location"]) {
		$result = $GLOBALS["fpdo"]
			->from('marine_certificate')
			->where("active", 1)
			->where("date_issued BETWEEN '" . $_GET["f"] . "' AND '" . $_GET["t"] . "'")
			->fetchAll();
	} else {
		$result = $GLOBALS["fpdo"]
			->from('marine_certificate')
			->where("policy_number", $_SESSION["sys_philinsure_policy_number"])
			->where("active", 1)
			->where("date_issued BETWEEN '" . $_GET["f"] . "' AND '" . $_GET["t"] . "'")
			->fetchAll();
	}
	$return = '';
	foreach ($result as $value) {
		$GLOBALS["certificateCount"] += 1;
		$GLOBALS["premiumTotal"] += $value["total_premium"];
		$GLOBALS["amountDueTotal"] += $value["total_amount_due"];
		$return .= '
			<tr>
				<td>' . date('m/d/Y', strtotime($value['date_issued'])) . '</td>
				<td>-' . explode('-', $value["certificate_number"])[5] . '</td>
				<td>' . $value["insured_name"] . '</td>
				<td width="374">' . substr($value["subject_matter_insured"], 0, 70) . (strlen($value["subject_matter_insured"]) > 72 ? "..." : "") . '</td>
				<td align="right">' . number_format($value["total_sum_insured"], 2) . '</td>
				<td align="right">' . number_format($value["total_premium"], 2) . '</td>
				<td align="right">' . number_format($value["total_amount_due"], 2) . '</td>
				<td align="center">' . ($value["posted"] ? 'YES' : 'NO') . '</td>
			</tr>
		';
	}
	return $return;
}
