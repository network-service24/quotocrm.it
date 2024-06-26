<?php


include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");


error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');	
		
$id_tipo_input = $_REQUEST['id_tipo_input'];
$id_campo      = $_REQUEST['id_campo'];
$obb           = $_REQUEST['obb'];
$name          = strtolower($_REQUEST['name']);
$label         = urldecode($_REQUEST['label']);
$idContent     = $_REQUEST['idContent'];

		$query = "SELECT params FROM hospitality_form_campi WHERE id =" . $id_tipo_input;
		$sel   = mysqli_query($conn,$query);
		$row   = mysql_fetch_assoc($sel);

        $input = str_replace('[name]',$name ,$row['params']);
        $input = str_replace('[id]',$idContent ,$input);
        $input = str_replace('[placeholder]',$label,$input);
        $input = str_replace('[obbligatorio]',($obb==0?'':'required'),$input);

	$update = "UPDATE hospitality_form_contenuti_lang SET campo = '".$input."', label = '".$label."' WHERE id =" . $id_campo;
	mysqli_query($conn,$update);

	echo $input;

mysqli_close($conn);
?>