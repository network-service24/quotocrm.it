<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");

    mysqli_set_charset('utf8', $conn);

	if($_REQUEST['lang']){
    	$file = BASE_PATH_SITO.'tmp_trattamenti/'.$_REQUEST['lang'].'/trattamento.txt';
		if(file_exists($file)){
			$contents = file($file);
			$string = implode($contents);
			$string = nl2br($string);
            $string = addslashes($string) ;
			//echo $string; 
			$db_query ="SELECT 
                            hospitality_dizionario_lingua.* 
                        FROM 
                            hospitality_dizionario 
                        INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                        WHERE  
                            hospitality_dizionario.etichetta = 'INFORMATIVA_PRIVACY' 
                        AND 
                            hospitality_dizionario_lingua.data_modifica IS NULL 
                        AND 
                            hospitality_dizionario_lingua.Lingua = '".$_REQUEST['lang']."' ";
			$res = mysqli_query($conn,$db_query);
            $n = mysqli_num_rows($res);
			while($row = mysqli_fetch_assoc($res)){	
				
				mysqli_query($conn,"UPDATE hospitality_dizionario_lingua SET testo = '".$string."' WHERE id = ".$row['id']);	
			}
			echo 'Aggiornati n° '.$n;
		}
    }
        



	mysqli_close($conn);

?>
