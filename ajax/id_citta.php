<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

 $id_provincia 	= $_REQUEST['id_provincia'];


 echo '<option value=""></option>'; 

$query = "SELECT * FROM comuni WHERE codice_provincia = '".$id_provincia ."' ORDER BY nome_comune ASC";
$result= $dbMysqli->query($query) or die();
foreach($result as $key => $row) {
	
	echo '<option value="'.$row['codice_comune'].'">'.$row['nome_comune'].'</option>';
	
}	
?>