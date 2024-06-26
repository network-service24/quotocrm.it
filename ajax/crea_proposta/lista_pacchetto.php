<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$lingua = $_REQUEST['lingua'];
	$idsito = $_REQUEST['idsito'];

 		$select = "SELECT hospitality_tipo_pacchetto_lingua.* FROM hospitality_tipo_pacchetto_lingua
					INNER JOIN hospitality_tipo_pacchetto ON hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
					WHERE hospitality_tipo_pacchetto_lingua.lingue = '".$lingua."'
					AND hospitality_tipo_pacchetto.Abilitato = 1
					AND hospitality_tipo_pacchetto_lingua.idsito = ".$idsito."
					ORDER BY hospitality_tipo_pacchetto_lingua.Pacchetto ASC";
		$result = $dbMysqli->query($select);
		if(sizeof($result)>0){	
        $ListaPacchetti .='<option value="">scegli</option>';	
			foreach($result as $chiave => $valore){
				$ListaPacchetti .='<option value="'.addslashes($valore['Pacchetto']).'" data-id="'.$valore['Id'].'" >'.addslashes($valore['Pacchetto']).'</option>';
			}
		}else{		
			$ListaPacchetti = '';
		} 


 	echo '  <script type="text/javascript">
                $(document).ready(function() {
                    $("#NomeProposta_1").html(\''.$ListaPacchetti.'\');
                    $("#NomeProposta_2").html(\''.$ListaPacchetti.'\');
                    $("#NomeProposta_3").html(\''.$ListaPacchetti.'\');
                    $("#NomeProposta_4").html(\''.$ListaPacchetti.'\');
                    $("#NomeProposta_5").html(\''.$ListaPacchetti.'\');
                });
            </script>';

?>