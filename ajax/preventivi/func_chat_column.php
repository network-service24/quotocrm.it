<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$id                 = $_REQUEST['id'];
$idsito             = $_REQUEST['idsito'];
$NumeroPrenotazione = $_REQUEST['NumeroPrenotazione'];
$DataInvio          = $_REQUEST['DataInvio'];
$DataScadenza       = $_REQUEST['DataScadenza'];
$DataChiuso         = $_REQUEST['DataChiuso'];
$DataArrivo         = $_REQUEST['DataArrivo'];
$provenienza        = $_REQUEST['provenienza'];

$new_chat = '';
$chat = '';
$command = '';
switch ($provenienza) {
    case 'preventivi':
        $articolo = 'del';
        $etichetta = 'Preventivo';
        $inputHidden = 'id_preventivo';
        break;
    case 'conferme':
        $articolo = 'della';
        $etichetta = 'Conferma';
        $inputHidden = 'id_conferma';
        break;
    case 'prenotazioni':
        $articolo = 'della';
        $etichetta = 'Prenotazione';
        $inputHidden = 'id_prenotazione';
        break;
}
$q = $dbMysqli->query('SELECT * FROM hospitality_chat WHERE NumeroPrenotazione = ' . $NumeroPrenotazione . ' AND idsito = ' . $idsito . ' ORDER by data DESC');
$rec = $q[0];

if (sizeof($rec) > 0) {
    if ($rec['operator'] == 0) {
        $new_chat = '<i class="fa fa-spinner fa-pulse"></i>';
        $title = 'Rispondi alla Chat';
    } else {
        $new_chat = '';
        $title = 'Discussione Chat';
    }

    $chat = '<a class="btn btn-primary btn-mini-mini" href="#!"  title="' . $title . '" id="OpenColumnChat' . $id . '">
                                ' . $new_chat . ' Chat
                            </a>';
} else {
    if (($DataInvio != 'null')) {
        if  ($DataScadenza != 'null' && $DataScadenza >= date("Y-m-d")) {
            $chat = '<a class="btn btn-primary btn-mini-mini" href="#!"  title="Apri una Chat" id="OpenColumnChat' . $id . '">
                            <i class="fa fa-comments-o"></i> Apri Chat
                        </a>';

        }
    }
    if (($DataChiuso != 'null') && ($DataArrivo > date('Y-m-d'))) {

        $chat = '<a class="btn btn-primary btn-mini-mini" href="#!"  title="Apri una Chat" id="OpenColumnChat' . $id . '">
                        <i class="fa fa-comments-o"></i> Apri Chat
                    </a>';

    }
}

$redirectForm = ' 	<form name="redirect" id="redirect' . $id . '" method="POST" action="' . BASE_URL_SITO . $provenienza . '/">
                            <input type="hidden" name="' . $inputHidden . '" value="' . $id . '">
                        </form>' . "\r\n";

$modale = '<!-- MODALE CHAT -->
        <div class="modal fade" id="idColumnChat' . $id . '"  role="dialog" aria-labelledby="idColumnChat' . $id . '">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-left" id="myModalLabel">Chat! <div class="clearfix f-11">Chiudi la finestra e ri-apri i dettagli ' . $articolo . ' ' . strtolower($etichetta) . ' cliccando sulla <b>X</b></div></h5>
                        <i class="fa fa-times fa-2x" id="pul_close_chat' . $id . '" class="btn btn-out-dotted btn-inverse btn-square btn-sm" data-dismiss="modal" aria-label="Close" style="float:right;cursor:pointer;"></i>
                    </div>
                    <div class="modal-body">
                            <iframe id="srcAttbributo' . $id . '" src="" frameborder="no" scrolling="yes" onload="resizeIframe(this)" style="min-height:800px;width:100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#OpenColumnChat' . $id . '").on("click",function(){
                    $("#idColumnChat' . $id . '").modal("show");
                    $("#srcAttbributo' . $id . '").attr("src","' . BASE_URL_SITO . 'ajax/chat/dashboard_chat.php?NumeroPrenotazione=' . $NumeroPrenotazione . '&idsito=' . $idsito . '")
                });
                $("#pul_close_chat' . $id . '").on("click",function () {
                    $("#redirect' . $id . '").submit();
                });
            });
        </script>';

echo $chat . $redirectForm . $modale;
    
?>