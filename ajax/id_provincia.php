<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

 $id_regione = $_REQUEST['id_regione'];


echo '<option value=""></option>'; 

$query = "SELECT * FROM province WHERE codice_regione = '".$id_regione ."' ORDER BY nome_provincia ASC";
$result= $dbMysqli->query($query) or die();
foreach($result as $key => $row) {
	
	echo '<option value="'.$row['codice_provincia'].'">'.$row['sigla_provincia'].'</option>';
	
}	
?>