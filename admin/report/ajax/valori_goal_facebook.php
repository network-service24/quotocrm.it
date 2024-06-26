<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

switch ($_REQUEST['etichetta']) {
    default;
        $decimali = 0;
        $icona = '<i class="fa fa-check fa-fw" aria-hidden="true"></i>';
        break;

}
$goal    = $_REQUEST['goal'];
$num_id  = $_REQUEST['num_id'];
$ciclo   = $_REQUEST['ciclo'];
$idsito  = $_REQUEST['idsito'];
$tabella = $_REQUEST['tabella'];
$campagna = $_REQUEST['campagna'];

$select2 = "SELECT * FROM report_facebook_syncro WHERE idsito = '" . $idsito . "' AND Campaign_name = '".$campagna."'";
$res2 = $dbMysqli_report->query($select2);
$row2 = $res2[0];

$valore = number_format($row2[$goal], $decimali, ',', '.');

echo '<script type="text/javascript">
		$(document).ready(function() {
					$("#valore'.$ciclo.'_' . $num_id . '").val(\'' . $valore . '\');
					$("#icona'.$ciclo.'_' . $num_id . '").html(\'' . $icona . '\');

		});
	</script>';
