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
        $etichetta = 'Preventivo';
        break;
    case 'conferme':
        $etichetta = 'Conferma';
        break;
    case 'prenotazioni':
        $etichetta = 'Prenotazione';
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

    $chat = '<a class="btn btn-primary btn-sm" href="#!" data-toggle="modal" title="' . $title . '" data-target="#idChat' . $id . '">
                                ' . $new_chat . ' Chat
                            </a>';
} else {
    if ($DataInvio != '') {
        if ($DataScadenza >= date("Y-m-d")) {

            $chat = '<a class="btn btn-primary btn-sm" href="#!" data-toggle="modal" title="Apri una Chat" data-target="#idChat' . $id . '">
                            <i class="fa fa-comments-o"></i> Apri Chat
                        </a>';
        } else {
            $chat = '<label class="badge badge-inverse-danger f-11">Data Scadenza passata</label>';
        }
    } else {
        $chat = '<label class="badge badge-inverse-danger f-11">' . $etichetta . ' da inviare</label>';
    }
    if (($DataChiuso != '') && ($DataArrivo > date('Y-m-d'))) {

        $chat = '<a class="btn btn-primary btn-sm" href="#!" data-toggle="modal" title="Apri una Chat" data-target="#idChat' . $id . '">
                        <i class="fa fa-comments-o"></i> Apri Chat
                    </a>';

    }
}

echo $chat;
    
?>