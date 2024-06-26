<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$idsito = $_REQUEST['idsito'];

	$syncro = "INSERT INTO hospitality_data_esport(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
	$dbMysqli->query($syncro);
	
	$s = "SELECT data FROM hospitality_data_esport WHERE idsito = ".$idsito." ORDER BY id DESC";
	$r = $dbMysqli->query($s);
	$tot = sizeof($r);

	if($tot > 0){

		$w = $r[0];
    
	    $datS    =  explode(" ",$w['data']); 
	    $dataS   =  explode("-",$datS[0]);  
	    $dataH   =  explode(":",$datS[1]);               
	    echo '<h4>Ultimo export del '.$dataS[2].'-'.$dataS[1].'-'.$dataS[0].' alle '.$dataH[0].':'.$dataH[1].':'.$dataH[2].'</h4>';
	}

?>