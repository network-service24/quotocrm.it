<?php


include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");


error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');	
		
$obb    = $_REQUEST['obb'];
$id_campo = $_REQUEST['id_campo'];


		$query = "SELECT id_campo as idcontent,campo FROM hospitality_form_contenuti_lang WHERE id =" . $id_campo;
		$sel   = mysqli_query($conn,$query);
		$row   = mysqli_fetch_assoc($sel);


        if($obb==0){
        	$input = str_replace('required','',$row['campo']);
        	$input = ltrim($input);
        	$input = rtrim($input);
        	$input = preg_replace('/\s+/', ' ', $input);
                $update2 = "UPDATE hospitality_form_contenuti SET obbligatorio = 0 WHERE id =" . $row['idcontent'];
                mysqli_query($conn,$update2);
        }else{
        	if(!strstr($row['campo'],'required')){             	    		
        		$input = strstr($row['campo'],'>');
        		$input = ltrim($input);
        		$input = rtrim($input);
        		$input = preg_replace('/\s+/', ' ', $input);
        		$input = str_replace($input,' required '.$input,$row['campo']);
                        $update2 = "UPDATE hospitality_form_contenuti SET obbligatorio = 1 WHERE id =" . $row['idcontent'];
                        mysqli_query($conn,$update2);                           		
        	}else{
        		$input = $row['campo'];
                        $update2 = "UPDATE hospitality_form_contenuti SET obbligatorio = 1 WHERE id =" . $row['idcontent'];
                        mysqli_query($conn,$update2);
        	}

        }
        
	$update = "UPDATE hospitality_form_contenuti_lang SET campo = '".$input."' WHERE id =" . $id_campo;
	mysqli_query($conn,$update);

	echo $input;

	mysqli_close($conn);
?>