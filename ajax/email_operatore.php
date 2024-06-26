<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$NomeOperatore = $_REQUEST['ChiPrenota'];
	$idsito        = $_REQUEST['idsito'];

    $sql    = "SELECT * FROM hospitality_operatori WHERE NomeOperatore = '".addslashes($NomeOperatore)."' AND idsito = ".$idsito;
	$result = $dbMysqli->query($sql) or die('Error, connesione'.$sql);
	$ret    = $result[0];	
	/** vecchio sistema con select della mailoperatore */
	//echo '<option value="'.$ret['EmailSegretaria'].'" >'.$ret['EmailSegretaria'].'</option>';
	/** veccnuovohio sistema con input hidden della mailoperatore */
	echo $ret['EmailSegretaria'];

?>