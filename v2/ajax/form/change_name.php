<?php


include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");


error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');	
		

$id_campo = $_REQUEST['id_campo'];


	$query = "SELECT id_campo as idcontent, label, campo FROM hospitality_form_contenuti_lang WHERE id_campo =" . $id_campo." AND id_lang = 1";
	$sel   = mysqli_query($conn,$query);
	$row   = mysqli_fetch_assoc($sel);

	function clean_string($stringa){

		$clean_title = str_replace( "!", "", $stringa );
		$clean_title = str_replace( "?", "", $clean_title );
		$clean_title = str_replace( "|", "", $clean_title );
		$clean_title = str_replace( ":", "", $clean_title );
		$clean_title = str_replace( "+", "", $clean_title );
		$clean_title = str_replace( "à", "a", $clean_title );
		$clean_title = str_replace( "è", "e", $clean_title );
		$clean_title = str_replace( "é", "e", $clean_title );
		$clean_title = str_replace( "ì", "i", $clean_title );
		$clean_title = str_replace( "ò", "o", $clean_title );
		$clean_title = str_replace( "ù", "u", $clean_title );
		$clean_title = str_replace( "n.", "", $clean_title );
	    $clean_title = str_replace( "€", "", $clean_title );
	    $clean_title = str_replace( "%", "", $clean_title );	
		$clean_title = str_replace( ".", "", $clean_title );
		$clean_title = str_replace( ",", "", $clean_title );
		$clean_title = str_replace( ";", "", $clean_title );
		$clean_title = str_replace( "-", "", $clean_title );
		$clean_title = str_replace( "'", "", $clean_title );
		$clean_title = str_replace( "*", "", $clean_title );
		$clean_title = str_replace( "/", "", $clean_title );
		$clean_title = str_replace( "\"", "", $clean_title );
		$clean_title = str_replace( "+", "_", $clean_title );
		$clean_title = strtolower($clean_title);
		$clean_title = trim($clean_title);
		$clean_title = str_replace( " ", "_", $clean_title );

		return($clean_title);
	}


        $name = clean_string($row['label']);
      

        $update = "UPDATE hospitality_form_contenuti SET name = '".$name."' WHERE id =" . $row['idcontent'];
        mysqli_query($conn,$update);


	echo $name;

	mysqli_close($conn);
?>