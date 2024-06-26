<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
		
$obb    = $_REQUEST['obb'];
$id_campo = $_REQUEST['id_campo'];


		$query = "SELECT id_campo as idcontent,campo FROM hospitality_form_contenuti_lang WHERE id =" . $id_campo;
		$sel   = $dbMysqli->query($query);
		$row   = $sel[0];


        if($obb==0){
        	$input = str_replace('required','',$row['campo']);
        	$input = ltrim($input);
        	$input = rtrim($input);
        	$input = preg_replace('/\s+/', ' ', $input);
                $update2 = "UPDATE hospitality_form_contenuti SET obbligatorio = 0 WHERE id =" . $row['idcontent'];
                $dbMysqli->query($update2);
        }else{
        	if(!strstr($row['campo'],'required')){             	    		
        		$input = strstr($row['campo'],'>');
        		$input = ltrim($input);
        		$input = rtrim($input);
        		$input = preg_replace('/\s+/', ' ', $input);
        		$input = str_replace($input,' required '.$input,$row['campo']);
                        $update2 = "UPDATE hospitality_form_contenuti SET obbligatorio = 1 WHERE id =" . $row['idcontent'];
                        $dbMysqli->query($update2);                           		
        	}else{
        		$input = $row['campo'];
                        $update2 = "UPDATE hospitality_form_contenuti SET obbligatorio = 1 WHERE id =" . $row['idcontent'];
                        $dbMysqli->query($update2);
        	}

        }
        
	$update = "UPDATE hospitality_form_contenuti_lang SET campo = '".$input."' WHERE id =" . $id_campo;
	$dbMysqli->query($update);

	echo $input;


?>