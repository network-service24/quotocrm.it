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

       
$select = "SELECT siti.data_start_hospitality,siti.data_end_hospitality FROM siti WHERE idsito = " . $idsito;
$res = $dbMysqli->query($select);
$row = $res[0];

$data_dal_   = explode("-", $row['data_start_hospitality']);
$data_dal    = $data_dal_[2] . '-' . $data_dal_[1] . '-' . $data_dal_[0];

$data_al_   = explode("-", $row['data_end_hospitality']);
$data_al    = $data_al_[2] . '-' . $data_al_[1] . '-' . $data_al_[0];

if($row['data_end_hospitality'] < date('Y-m-d')){
	$date_attivazione .= 'Attivazione di QUOTO dal <b class="text-red">'.$data_dal.'</b> al <b class="text-red">'.$data_al.'</b> disdetto!';
}else{
	$date_attivazione .= 'Attivazione di QUOTO dal <b class="text-green">'.$data_dal.'</b> al <b class="text-green">'.$data_al.'</b>';	
}
$date_attivazione .= '<br><i class="fa fa-exclamation-triangle text-red"></i> <b class="text-red">ATTENZIONE:</b> rispettare il range di date che deve essere rigorosamente compreso tra la data di attivazione di QUOTO e la data di scadenza!';


echo '<script>
		$(document).ready(function() {
			$("#dal").val("'.str_replace("-","/",$data_dal).'");
			$("#al").val("'.date('d/m/Y').'");
		});
	  </script>'."\r\n";
echo '<div id="valore_dal" data-id="'.str_replace("-","/",$data_dal).'"></div>';
echo '<div id="valore_al" data-id="'.str_replace("-","/",$data_al).'"></div>';
echo $date_attivazione;