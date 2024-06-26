<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$lingua = $_REQUEST['lingua'];
	$idsito = $_REQUEST['idsito'];

		$select = "SELECT hospitality_condizioni_tariffe_lingua.* FROM hospitality_condizioni_tariffe_lingua
								INNER JOIN hospitality_condizioni_tariffe ON hospitality_condizioni_tariffe.id = hospitality_condizioni_tariffe_lingua.id_tariffe
								WHERE hospitality_condizioni_tariffe_lingua.Lingua = '".$lingua."'
								AND hospitality_condizioni_tariffe.idsito = ".$idsito."
								ORDER BY hospitality_condizioni_tariffe_lingua.tariffa ASC";
		$result = $dbMysqli->query($select);
		if(sizeof($result)>0){	
        $ListaTariffe.='<option value="">scegli</option>';	
			foreach($result as $chiave => $valore){
				$ListaTariffe .='<option value="'.$dbMysqli->escape($valore['tariffa']).'" data-id="'.$valore['id'].'" >'.$dbMysqli->escape($valore['tariffa']).'</option>';
			}
		}else{		
			$ListaTariffe = '';
		}


 	echo '  <script type="text/javascript">
                $(document).ready(function() {
                    $("#EtichettaTariffa_1").html(\''.$ListaTariffe.'\');
                    $("#EtichettaTariffa_2").html(\''.$ListaTariffe.'\');
                    $("#EtichettaTariffa_3").html(\''.$ListaTariffe.'\');
                    $("#EtichettaTariffa_4").html(\''.$ListaTariffe.'\');
                    $("#EtichettaTariffa_5").html(\''.$ListaTariffe.'\');
                });
            </script>';

?>