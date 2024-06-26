<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/function.inc.php");
close_session();
function ckeck_ajax_notify_chat($idsito){
    global $dbMysqli;

    $body      = '';
    $etichetta = '';
    $sel       = '';
    $rec       = '';

    $select = " SELECT
                    hospitality_chat_notify.*
                FROM
                    hospitality_chat_notify 
                WHERE
                    hospitality_chat_notify.idsito = ".$idsito."
                GROUP BY 
                    hospitality_chat_notify.NumeroPrenotazione 
                ORDER BY
                    hospitality_chat_notify.id DESC";

    $record    = $dbMysqli->query($select);
    if(sizeof($record)>0){

        $body = '<table class="xcrud-list table table-striped table-hover table-bordered" id="tabellaChat">
                    <tr>
                        <th class="text-left  nowrap"><small>Tipo</small></th>
                        <th class="text-center nowrap"><small>Numero</small></th>
                        <th class="text-left  nowrap"><small>Nome Cognome</small></th>
                        <th class="text-center nowrap"><small>Apri Chat</small></th>
                        <th class="text-center nowrap"><small>Chiudi Chat</small></th>
                    </tr>';
        foreach ($record as $key => $value) {

                $sel = " SELECT
                                hospitality_guest.Id as id_richiesta,
                                hospitality_guest.TipoRichiesta,
                                hospitality_guest.Chiuso
                            FROM
                                hospitality_guest 
                            WHERE
                                hospitality_guest.idsito = ".$idsito." 
                            AND
                                hospitality_guest.NumeroPrenotazione = ".$value['NumeroPrenotazione']."
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

            $body .= '<tr id="riga'.$value['id'].'">
                        <td class="text-left nowrap">'.$etichetta.'</td>
                        <td class="text-center nowrap"><a href="'.BASE_URL_SITO.'modifica_modulo_hospitality/edit/'.$rec['id_richiesta'].'">N° '.$value['NumeroPrenotazione'].'</a></td>
                        <td class="text-left nowrap">'.(strlen($value['user'])>=25?substr($value['user'],0,25).'...':$value['user']).'</td>
                        <td class="text-center nowrap"><a href="javascript:;" data-toggle="modal" data-target="#idChat'.$value['id'].'"><i class="fa fa-link"></i></a></td>
                        <td class="text-center nowrap">
                            <a href="javascript:;" id="CloseChat'.$value['id'].'"><i class="fa fa-chain-broken"></i></a>
                            <script>
                                $(document).ready(function(){
                                    $("#CloseChat'.$value['id'].'").on("click",function(){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler chiudere la chat N° '.$value['NumeroPrenotazione'].'?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/close_chat.php",
                                                type: "POST",
                                                data: "id='.$value['id'].'&idsito='.$value['idsito'].'&NumeroPrenotazione='.$value['NumeroPrenotazione'].'&id_guest='.$rec['id_richiesta'].'&user='.$_SESSION['user_accesso'].'",
                                                dataType: "html",
                                                success: function(data) {
                                                $(\'#riga'.$value['id'].'\').remove();
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
        return 'Nessuna Chat in attesa di risposta!';
    }
 
} 

echo ckeck_ajax_notify_chat($_REQUEST['idsito']);
?>
