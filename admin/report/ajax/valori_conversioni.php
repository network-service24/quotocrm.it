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

$ScorsoAnno = (date('Y') - 1);
$Anno       = date('Y');

switch ($_REQUEST['conversione']) {
    case "Transazioni":
        $conversioni = 'Transactions';
        $decimali = 0;
        $icona = '<i class="fa fa-check fa-fw" aria-hidden="true"></i>';
        break;
    case "Entrate":
        $conversioni = 'Transaction_revenue';
        $decimali = 2;
        $icona = '<i class="fa fa-euro fa-fw" aria-hidden="true"></i>';
        break;
    case "Tasso di conversione e-commerce":
        $conversioni = 'Ecommerce_Conversion_Rate';
        $decimali = 2;
        $icona = '<i class="fa fa-percent fa-fw" aria-hidden="true"></i>';
        break; 
    case "Tasso di conversione sito":
        $conversioni = 'Goal_conversion_rate_all_goals';
        $decimali = 2;
        $icona = '<i class="fa fa-percent fa-fw" aria-hidden="true"></i>';
        break;                
}

$num_id  = $_REQUEST['num_id'];
$idsito  = $_REQUEST['idsito'];


$select .= "SELECT * FROM report_analytics_syncro WHERE idsito = '" . $idsito . "' ";
$select .= " AND 
            Sessions != '' 
            AND 
            Users != '' 
            AND 
            Pageviews != '' ";
$select .= " AND Periodo = 'dopo' ";
$res = $dbMysqli_report->query($select);
$row = $res[0];

$select2 .= "SELECT * FROM report_analytics_syncro WHERE idsito = '" . $idsito . "' ";
$select2 .= " AND 
            Sessions != '' 
            AND 
            Users != '' 
            AND 
            Pageviews != '' ";
$select2 .= " AND Periodo = 'prima' ";
$res2 = $dbMysqli_report->query($select2);
$row2 = $res2[0];

$valoreanno   = number_format($row[$conversioni], $decimali, ',', '.');
$valorescorso = number_format($row2[$conversioni], $decimali, ',', '.');

echo '<script type="text/javascript">
		$(document).ready(function() {
					$("#anno_' . $num_id . '").val(\'' . $valoreanno . '\');
					$("#scorsoanno_' . $num_id . '").val(\'' . $valorescorso . '\');
					$("#icona_' . $num_id . '").html(\'' . $icona . '\');
					$("#icona_bis_' . $num_id . '").html(\'' . $icona . '\');
		});
	</script>';
