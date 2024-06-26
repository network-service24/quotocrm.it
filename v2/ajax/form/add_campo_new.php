<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');

 $action = $_REQUEST['action'];
 $idsito = $_REQUEST['idSito']; 
 $idform = $_REQUEST['idForm'];

		$lingue = array();
		$q = "SELECT 
				hospitality_lingue_form.codlingua, 
				hospitality_lista_lingue.id_lang 
			FROM 
				hospitality_lista_lingue, hospitality_lingue_form 
			WHERE 
				hospitality_lingue_form.idsito = '".$idsito."' 
			AND 
				hospitality_lingue_form.codlingua = hospitality_lista_lingue.codice 
			ORDER BY
				hospitality_lista_lingue.id_lang asc";
		$res = mysqli_query($conn,$q); 
		while($row = mysqli_fetch_assoc($res)) {
			$lingue[$row['id_lang']] = $row['codlingua'];
		}

				if($action=='insertField'){
					
					
					$nuovo = array(1=>'Nuovo campo',
								2=>'New field',
								3=>'New field',
								4=>'New field',
								5=>'New field',
								6=>'New field',
								7=>'New field',
								8=>'New field',
								9=>'New field',
								10=>'New field',
								);
								
					$errore = array( 1=>'Il campo [label] è obbligatorio',
									2=>'The field [label] is mandatory',
									3=>'The field [label] is mandatory',
									4=>'The field [label] is mandatory',
									5=>	'The field [label] is mandatory',
									6=>	'The field [label] is mandatory',
									7=>	'The field [label] is mandatory',
									8=>	'The field [label] is mandatory',
									9=>	'The field [label] is mandatory',
									10=>'The field [label] is mandatory');	
													
					

								$query = "INSERT INTO hospitality_form_contenuti (id_sito,id_form,id_tipo_input,name,obbligatorio,ordinamento,attivo)
			  								VALUES('".$idsito."','".$idform."','3','nuovo campo','0','0','1')";			 
								mysqli_query($conn,$query);								

							
								$sql = 'select id FROM hospitality_form_contenuti ORDER BY id DESC';
								$result = mysqli_query($conn,$sql) or die('Error, connesione'.$sql);
								$ret = mysqli_fetch_assoc($result);	
								$nuField = $ret['id'];
								$campo = '';						
								foreach($lingue as $k=>$v){	

									$campo = '<input type="text" name="'.strtolower(str_replace(' ','_',$nuovo[$k])).'" id="'.strtolower(str_replace(' ','_',$nuovo[$k])).'_'.$nuField.'" placeholder="'.$nuovo[$k].'" autocomplete="new_password">';

									$insert = "INSERT INTO hospitality_form_contenuti_lang (id_campo,id_lang,label,errore_su_campo,id_sito,id_form,campo)
				  								VALUES('".$nuField."','".$k."','".$nuovo[$k]."','".str_replace('[label]',$nuovo[$k], $errore[$k])."','".$idsito."','".$idform."','".$campo."')";			 
									mysqli_query($conn,$insert) or die('Errore nella query'.$insert);							
								
								}

						}

	mysqli_close($conn_suiteweb);
	mysqli_close($conn);
?>