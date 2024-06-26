<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

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
			$res = $dbMysqli->query($db_query);
            $n   = sizeof($res);
			foreach($res as $key => $row){	
				
				$dbMysqli->query("UPDATE hospitality_dizionario_lingua SET testo = '".$string."' WHERE id = ".$row['id']);	
			}
			echo 'Aggiornati n° '.$n;
		}
    }
        
?>
