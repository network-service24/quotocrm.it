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

$idsito_  = explode("_",$_REQUEST['idsito']);
$idsito = $idsito_[0];

$select    = "SELECT * FROM copertina_report WHERE idsito = " . $idsito." AND data = '".date('Y-m-d')."'";
$res       = $dbMysqli_report->query($select);
$tot_check = sizeof($res);
if($tot_check>0){
		echo'<script type="text/javascript">
					$(document).ready(function() {
						$("#check_copertina").css(\'display\',\'none\');
						$("#intestazione_report").attr("disabled","disabled");
						$("#report").attr("disabled","disabled");
						$("#data").attr("disabled","disabled");
						$("#image1").attr("disabled","disabled");
						$("#image2").attr("disabled","disabled");
					});
			</script>';
}else{
		echo'<script type="text/javascript">
					$(document).ready(function() {
						$("#check_copertina").css(\'display\',\'block\');
						$("#intestazione_report").removeAttr("disabled");
						$("#report").removeAttr("disabled");
						$("#data").removeAttr("disabled");
						$("#image1").removeAttr("disabled");
						$("#image2").removeAttr("disabled");						
					});
			</script>';	
}
