<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/function.inc.php");
close_session();
function ckeck_ajax_modifica($idsito){
    global $dbMysqli;

    $body      = '';
    $etichetta = '';

    $select = " SELECT
                    hospitality_check_modifica.*
                FROM
                    hospitality_check_modifica 
                WHERE
                    hospitality_check_modifica.idsito = ".$idsito." 
                ORDER BY
                    hospitality_check_modifica.id DESC";

    $record    = $dbMysqli->query($select);

    if(sizeof($record)>0){

        $body = '<table class="xcrud-list table table-striped table-hover table-bordered" id="tabellaChat">
                    <tr>
                        <th class="text-left  nowrap"><small>Tipo</small></th>
                        <th class="text-center nowrap"><small>Numero</small></th>
                        <th class="text-left  nowrap"><small>Operatore</small></th>
                        <th class="text-left  nowrap"><small>Sblocca</small></th>
                    </tr>';
        foreach ($record as $key => $value) {

                $sel = " SELECT
                                hospitality_guest.TipoRichiesta,
                                hospitality_guest.NumeroPrenotazione,
                                hospitality_guest.Chiuso
                            FROM
                                hospitality_guest 
                            WHERE
                                hospitality_guest.idsito = ".$idsito." 
                            AND
                                hospitality_guest.id = ".$value['id_richiesta']."
                            ORDER BY
                                hospitality_guest.Id DESC
                            LIMIT 1";

                $rus = $dbMysqli->query($sel);
                $rec = $rus[0];

                if($rec['TipoRichiesta'] == 'Preventivo'){
                    $etichetta = 'Preventivo';
                }elseif($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 0){
                    $etichetta = 'Conferma';
                }elseif($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 1){
                    $etichetta = 'Prenotazione';
                }

            $body .= '<tr id="SbloccaRiga'.$value['id'].'">
                        <td class="text-left nowrap">'.$etichetta.'</td>
                        <td class="text-center nowrap"><a href="'.BASE_URL_SITO.'modifica_modulo_hospitality/edit/'.$value['id_richiesta'].'">N° '.$rec['NumeroPrenotazione'].'</a></td>
                        <td class="text-left nowrap">'.$value['operatore'].'</td>
                        <td class="text-center nowrap">
                            <a href="javascript:;" id="SbloccaP'.$value['id'].'"><i class="fa fa-chain-broken"></i></a>
                            <script>
                                $(document).ready(function(){
                                    $("#SbloccaP'.$value['id'].'").on("click",function(){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler sbloccare N° '.$rec['NumeroPrenotazione'].'?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/sblocca_p.php",
                                                type: "POST",
                                                data: "id='.$value['id'].'&idsito='.$value['idsito'].'&NumeroPrenotazione='.$rec['NumeroPrenotazione'].'",
                                                dataType: "html",
                                                success: function(data) {
                                                $(\'#SbloccaRiga'.$value['id'].'\').remove();
                                                }
                                            });
                                            return false;
                                        }
                                    });
                                });
                            </script>
                        </td>
                    </tr>';

        }
        $body .= '</table>';

        return $body;
    }else{
        return 'Nessuna Proposta bloccata!';
    }
 
} 

echo ckeck_ajax_modifica($_REQUEST['idsito']);
?>
