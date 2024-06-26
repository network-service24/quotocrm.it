<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
//include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	function nome_sito($idsito)
	{
		global $dbMysqli;
        $se   = " SELECT web FROM siti WHERE siti.idsito = ".$idsito;
        $rc   = $dbMysqli->query($se);
        $rows = $rc[0]; 
	
		return $rows['web'];
	}

    function gira_data($data){
        $data = explode(" ",$data);
        $data_tmp = explode("-",$data[0]);
        $new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data[1];
        return $new_data;
    }

	# QUERY PER COMPILARE IL DATATABLE
	$s  = " SELECT 
                * 
            FROM 
                hospitality_guest 
            WHERE 
                hospitality_guest.TipoRichiesta = 'Conferma'
            AND 
                hospitality_guest.idsito != 1740
            AND 
                (hospitality_guest.DataRichiesta >= '".date('Y')."-01-01'
            OR 
                hospitality_guest.DataChiuso >= '".date('Y')."-01-01')
            AND 
                hospitality_guest.Archivia = 0
            AND 
                hospitality_guest.Hidden = 0";

	$rec = $dbMysqli->query($s);


    foreach($rec as $key => $row){

        $data[] = array(
            "sito"                => '<div class="text-left nowrap">'.nome_sito($row['idsito']).'</div>',
            "Tipo"                => '<div class="text-center">'.($row['DataChiuso']!=''?'Prenotazione':'Conferma').'</div>',
            "NumeroPrenotazione"  => '<div class="text-center">'.$row['NumeroPrenotazione'].'</div>',
            "Fonte"               => '<div class="text-left nowrap">'.$row['FontePrenotazione'].'</div>',  
            "Target"              => '<div class="text-left">'.$row['TipoVacanza'].'</div>',
            "DataRichiesta"       => '<div class="text-center nowrap"><span class="ordinamento">'.$row['DataRichiesta'].'</span>'.gira_data($row['DataRichiesta']).'</div>',
            "NomeCognome"         => '<div class="text-left nowrap">'.$row['Nome'].' '.$row['Cognome'].'</div>',
            "Email"               => '<div class="text-left">'.$row['Email'].'</div>',
            "Lingua"              => '<div class="text-center">'.$row['Lingua'].'</div>',
            "DataArrivo"          => '<div class="text-center nowrap">'.gira_data($row['DataArrivo']).'</div>',
            "DataPartenza"        => '<div class="text-center nowrap">'.gira_data($row['DataPartenza']).'</div>',
            "DataChiuso"          => '<div class="text-center nowrap">'.gira_data($row['DataChiuso']).'</div>'
        );
    }
	

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec) ,
						"recordsFiltered" => sizeof($rec),
						"data" 			  => $data
						); 



if(empty($json_data) || is_null($json_data)){
	$json_data = NULL;
}else{
	$json_data = json_encode($json_data);
}
	  echo $json_data; 

#######################################################################################################################

?>
