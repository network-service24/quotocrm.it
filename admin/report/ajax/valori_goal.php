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
    default;
        $decimali = 0;
        $icona = '<i class="fa fa-check fa-fw" aria-hidden="true"></i>';
        break;

}
$goal    = $_REQUEST['goal'];
$num_id  = $_REQUEST['num_id'];
$idsito  = $_REQUEST['idsito'];


$select = "SELECT 
                * 
            FROM 
                report_analytics_syncro 
            WHERE 
                idsito = '" . $idsito . "'  
            AND 
                Sessions != '' 
            AND 
                Users != '' 
            AND 
                Pageviews != '' 
            AND 
                Periodo = 'dopo' ";
$res = $dbMysqli_report->query($select);
$row = $res[0];

$select2 = "SELECT 
                * 
            FROM 
                report_analytics_syncro 
            WHERE 
                idsito = '" . $idsito . "'  
            AND 
                Sessions != '' 
            AND 
                Users != '' 
            AND 
                Pageviews != '' 
            AND 
                Periodo = 'prima' ";
$res2 = $dbMysqli_report->query($select2);
$row2 = $res2[0];

$valoreanno   = number_format($row[$goal], $decimali, ',', '.');
$valorescorso = number_format($row2[$goal], $decimali, ',', '.');

echo '<script type="text/javascript">
		$(document).ready(function() {
					$("#anno_g_' . $num_id . '").val(\'' . $valoreanno . '\');
					$("#scorsoanno_g_' . $num_id . '").val(\'' . $valorescorso . '\');
					$("#icona_g_' . $num_id . '").html(\'' . $icona . '\');
					$("#icona_bis_g_' . $num_id . '").html(\'' . $icona . '\');
		});
	</script>';
