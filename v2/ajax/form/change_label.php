<?php


include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");


error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');	
		
$label    = $_REQUEST['label'];
$id_campo = $_REQUEST['id_campo'];


		$query = "SELECT campo FROM hospitality_form_contenuti_lang WHERE id =" . $id_campo;
		$sel   = mysqli_query($conn,$query);
		$row   = mysqli_fetch_assoc($sel);


        $input = strstr($row['campo'],'placeholder="');
        $input = substr($input,13,1000);
        $input = explode('"',$input);
        $input = str_replace($input[0],$label,$row['campo']);

	$update = "UPDATE hospitality_form_contenuti_lang SET campo = '".$input."', label = '".$label."' WHERE id =" . $id_campo;
	mysqli_query($conn,$update);

	echo $input;

mysqli_close($conn);
?>