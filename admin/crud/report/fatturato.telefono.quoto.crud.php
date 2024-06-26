<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

function gira_data($data){
	$data_tmp = explode("-",$data);
	$new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];
	return $new_data;
}

$idsito = $_REQUEST['idsito'];

$qy     = "SELECT 
                REPLACE(hospitality_guest.Cellulare,'-','') as Cellulare,
                hospitality_guest.Id
            FROM 
                hospitality_guest  
            WHERE
                hospitality_guest.idsito = ".$idsito." 
            AND
                hospitality_guest.FontePrenotazione != 'Sito Web'

            AND 
                hospitality_guest.TipoRichiesta = 'Conferma'  
            AND
                hospitality_guest.Cellulare != ''
            AND
                hospitality_guest.Nome != ''
            AND
                hospitality_guest.Cognome != ''
            AND
                hospitality_guest.DataRichiesta != ''
            AND
                LENGTH(hospitality_guest.Cellulare) > 5
            AND
				hospitality_guest.Cellulare NOT LIKE '%000000%'";
$q      = $dbMysqli_sviluppo_quoto->query($qy);
foreach($q as $k => $rw){
    $lista_tel[$rw['Id']] = trim($rw['Cellulare']);
}

$fatturato = '';
$cliente  = '';
$n = 1;
foreach ($lista_tel as $key => $value) {
                # code...
            
             $qry     = "SELECT 
                            hospitality_guest.Id ,
                            hospitality_guest.NumeroPrenotazione ,
                            hospitality_guest.TipoRichiesta ,
                            hospitality_guest.Chiuso ,
                            hospitality_guest.Nome ,
                            hospitality_guest.Cognome ,
                            hospitality_guest.Cellulare ,
                            hospitality_guest.FontePrenotazione ,
                            hospitality_guest.DataRichiesta ,
                            hospitality_guest_track_phone.telefono,
                            hospitality_guest_track_phone.campagna
                        FROM 
                            hospitality_guest  
                        INNER JOIN 
                            hospitality_guest_track_phone ON hospitality_guest_track_phone.idsito = hospitality_guest.idsito
                        WHERE
                            hospitality_guest.idsito = ".$idsito."  
                        AND
                            hospitality_guest_track_phone.idsito = ".$idsito."   
                        AND 
                            hospitality_guest.Id = ".$key."
                        AND 
                            hospitality_guest_track_phone.telefono = '".$value."'";
            $sq      = $dbMysqli_sviluppo_quoto->query($qry);

            if(is_array($sq)) {
                if($sq > count($sq)) 
                    $tot = count($sq); 
            }else{
                $tot = 0;
            }

            $row     = $sq[0];
            $tipo    = '';

        if($row['Chiuso'] == 1){
            $tipo = '<span style="color:green">Prenotazione</span>';
        }else{
            if($row['TipoRichiesta']=='Preventivo'){
                    $tipo = '<span style="color:orange">Preventivo</span>';
            }else{
                    $tipo = '<span style="color:blue">Conferma</span>';
            }
        }


        $fatturato = '  <div id="fatturato_loading'.$row['Id'].'"></div>
                        <div id="fatturato'.$row['Id'].'" class="fatturato"></div>'."\r\n";
        $fatturato .= ' <script>
                            $(document).ready(function () {
                                $("#fatturato_loading'.$row['Id'].'").html(\'<div class="preloader3" style="height:50px!important;"><div class="circ1"></div><div class="circ2 bg-info"></div><div class="circ3 bg-danger"></div><div class="circ4 bg-warning"></div></div>\');
                                $("#fatturato'.$row['Id'].'").load("'.BASE_URL_SITO.'crud/report/calc.fatturato.tel.qt.crud.php?idsito='.$idsito.'&id='.$row['Id'].'", function() {
                                    $("#fatturato_loading'.$row['Id'].'").remove();
                                });
                            });
                        </script>'."\r\n"; 
 
 
    $cliente = stripslashes($row['Nome']).' '.stripslashes($row['Cognome']);

    if($tot > 0){

                        $data[] = array(													
                                        "nr"                    => '<div class="text-center small nowrap">'.$row['NumeroPrenotazione'].'</div>',
                                        "tipo"                  => '<div class="text-center small nowrap">'.$tipo.'</div>',
                                        "nome"                  => '<div class="text-center small nowrap">'.(strlen($cliente)<=35?$cliente:substr($cliente,0,35).'...').'</div>',
                                        "cell"                  => '<div class="text-center small nowrap">'.trim($row['Cellulare']).'</div>',
                                        "campagna"              => '<div class="text-center small nowrap">'.$row['campagna'].'</div>',
                                        "fatturato"             => '<div class="text-center small nowrap">'.$fatturato.'</div>'
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
