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
$idsito  = $_REQUEST['idsito'];


$select2 .= "SELECT SUM($goal) as $goal FROM report_adwords_syncro WHERE idsito = '" . $idsito . "' ";
$select2 .= " AND Brand = 'NO' ";
$res2 = $dbMysqli_report->query($select2);
$row2 = $res2[0];

$valore2 = number_format($row2[$goal], $decimali, ',', '.');

echo '<script type="text/javascript">
		$(document).ready(function() {
					$("#valore_nobrand_' . $num_id . '").val(\'' . $valore2 . '\');
					$("#icona_nobrand_' . $num_id . '").html(\'' . $icona . '\');

		});
	</script>';
