<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

function gira_data($data){
	$data_tmp = explode("-",$data);
	$new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];
	return $new_data;
}

$idsito       = $_REQUEST['idsito'];
$prima_data   = date('Y') . '-01-01';
$seconda_data = date('Y') . '-12-31';

echo $qy     = "SELECT 
                hospitality_guest.*
            FROM 
                hospitality_guest  
            INNER JOIN
                cavebianche ON cavebianche.Nome = hospitality_guest.Nome AND cavebianche.Cognome = hospitality_guest.Cognome
            WHERE
                hospitality_guest.idsito = 2377
            AND
                hospitality_guest.Cellulare is not null
            AND
                hospitality_guest.Nome is not null
            AND
                hospitality_guest.Cognome is not null
            AND
                hospitality_guest.DataRichiesta is not null
            AND 
                ((hospitality_guest.DataRichiesta >= '$prima_data' AND hospitality_guest.DataRichiesta <= '$seconda_data' ) 
            OR 
                (hospitality_guest.DataChiuso is not null AND hospitality_guest.DataChiuso >= '$prima_data' AND hospitality_guest.DataChiuso <= '$seconda_data' )) 
            GROUP BY
                cavebianche.Nome,cavebianche.Cognome";
$q      = $dbMysqli_sviluppo_quoto->query($qy);


$fatturato = '';
$cliente  = '';
$n = 1;
foreach ($q as $key => $value) {
                # code...
        if($row['Chiuso'] == 1){
            $tipo = '<span style="color:green">Prenotazione</span>';
        }else{
            if($row['TipoRichiesta']=='Preventivo'){
                    $tipo = '<span style="color:orange">Preventivo</span>';
            }else{
                    $tipo = '<span style="color:blue">Conferma</span>';
            }
        }

/* 
        $fatturato = '  <div id="fatturato_loading'.$row['Id'].'"></div>
                        <div id="fatturato'.$row['Id'].'" class="fatturato"></div>'."\r\n";
        $fatturato .= ' <script>
                            $(document).ready(function () {
                                $("#fatturato_loading'.$row['Id'].'").html(\'<div class="preloader3" style="height:50px!important;"><div class="circ1"></div><div class="circ2 bg-info"></div><div class="circ3 bg-danger"></div><div class="circ4 bg-warning"></div></div>\');
                                $("#fatturato'.$row['Id'].'").load("'.BASE_URL_SITO.'crud/report/calc.fatturato.tel.qt.crud.php?idsito='.$idsito.'&id='.$row['Id'].'", function() {
                                    $("#fatturato_loading'.$row['Id'].'").remove();
                                });
                            });
                        </script>'."\r\n";  */
 
 
    $cliente = stripslashes($row['Nome']).' '.stripslashes($row['Cognome']);

    if($tot > 0){

                        $data[] = array(													
                                        "nr"                    => '<div class="text-center small nowrap">'.$row['NumeroPrenotazione'].'</div>',
                                        "tipo"                  => '<div class="text-center small nowrap">'.$tipo.'</div>',
                                        "nome"                  => '<div class="text-center small nowrap">'.stripslashes($row['Nome']).'</div>',
                                        "cognome"               => '<div class="text-center small nowrap">'.stripslashes($row['Cognome']).'</div>'
                                        );

    }
    $n++; 
} 

$fatturato = '';
$data_vuoto[] = array();

$json_data = array(
    "draw"            => 1,
    "recordsTotal"    => sizeof($lista_tel),
    "recordsFiltered" => sizeof($lista_tel),
    "data" 			  => $data
); 


if(empty($json_data) || is_null($json_data)){
    $json_data = NULL;
}else{
    $json_data = json_encode($json_data);
} 

echo $json_data; 
?>
