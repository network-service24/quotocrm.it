<?php

    $azioneLog  = '';
    $tabellaLog = '';
    ### VARIABILI LOG PER UNA MODIFICA DI PREVENTIVO ###
    if($_REQUEST['TipoRichiesta'] == 'Preventivo'  && $_REQUEST['action'] == 'modif'){
        $azioneLog    = 'UPDATE Preventivo';
        $tabellaLog   = 'hospitality_guest|hospitality_richieste|hospitality_proposte';
        $id_richiesta = $_REQUEST['Id'];
    }
    ### VARIABILI LOG PER UNA CREAZIONE DI PREVENTIVO ###
    if($_REQUEST['TipoRichiesta'] == 'Preventivo' && $_REQUEST['action'] == 'create'){
        $azioneLog    = 'INSERT Preventivo';
        $tabellaLog   = 'hospitality_guest|hospitality_richieste|hospitality_proposte';
        $sel   = "SELECT MAX(Id) as Id  FROM hospitality_guest WHERE hospitality_guest.idsito = ".IDSITO;
        $res   = $dbMysqli->query($sel);
        $dato  = $res[0];
        $id_richiesta = $dato['Id'];

    }
    ### VARIABILI LOG PER UNA CREAZIONE DI CONFERMA ###
    if($_REQUEST['TipoRichiesta']== 'Conferma' && $_REQUEST['action'] == 'create'){
        $azioneLog    = 'INSERT Conferma in Trattativa';
        $tabellaLog   = 'hospitality_guest|hospitality_richieste|hospitality_proposte';
        $sel   = "SELECT MAX(Id) as Id FROM hospitality_guest WHERE hospitality_guest.idsito = ".IDSITO;
        $res   = $dbMysqli->query($sel);
        $dato  = $res[0];
        $id_richiesta = $dato['Id'];
    }
    ### VARIABILI LOG PER UNA MODIFICA DI UNA CONFERMA IN TRATTATIVA ###
    if($_REQUEST['TipoRichiesta']== 'Conferma' && $_REQUEST['action'] == 'modif' && $_REQUEST['Chiuso'] == 0){
        $azioneLog    = 'UPDATE Conferma in Trattativa';
        $tabellaLog   = 'hospitality_guest|hospitality_richieste|hospitality_proposte';
        $id_richiesta = $_REQUEST['Id'];
    }
     ### VARIABILI LOG PER UNA MODIFICA DI UNA PRENOTAZIONE CONFERMATA ###
    if($_REQUEST['TipoRichiesta'] == 'Conferma' && $_REQUEST['action'] == 'modif' && $_REQUEST['Chiuso'] == 1){
        $azioneLog    = 'UPDATE Prenotazione Confermata';
        $tabellaLog   = 'hospitality_guest|hospitality_richieste|hospitality_proposte';
        $id_richiesta = $_REQUEST['Id'];
    }    
     ### VARIABILI LOG PER UN INVIO VOUCHER E CHIUSURA DI UNA PRENOTAZIONE ###
    if($_REQUEST['provenienza'] == 'voucher' && $_REQUEST['voucher'] == 'si'){
        $azioneLog    = 'SAVE  Prenotazione Confermata AND SEND Voucher';
        $tabellaLog   = 'phpmailer|hospitality_guest';
        $id_richiesta = $_REQUEST['id_richiesta'];
    } 
    ### VARIABILI LOG PER NESSUN INVIO VOUCHER E CHIUSURA DI UNA PRENOTAZIONE ### 
    if($_REQUEST['provenienza'] == 'voucher' && $_REQUEST['voucher'] == 'no'){
        $azioneLog    = 'SAVE  Prenotazione Confermata AND NOT SEND Voucher';
        $tabellaLog   = 'hospitality_guest';
        $id_richiesta = $_REQUEST['id_richiesta'];
    }
    ### VARIABILI LOG PER UN INVIO MAIL PREVENTIVO e/o CONFERMA ###
    if($_REQUEST['action'] == 'send' && $_REQUEST['spedito'] != ''){
        $azioneLog    = 'SEND MAIL '.$_REQUEST['spedito'];
        $tabellaLog   = 'phpmailer';
        $id_richiesta = $_REQUEST['id_richiesta'];
    }  
    ### VARIABILI LOG PER UN INVIO PREVENTIVO e/o CONFERMA TRAMITE WHATSAPP ###
    if($_REQUEST['action'] == 'send_whatsapp' && $_REQUEST['spedito'] != ''){
        $azioneLog    = 'SEND WHATSAPP '.$_REQUEST['spedito'];
        $tabellaLog   = 'whatsapp';
        $id_richiesta = $_REQUEST['id_richiesta'];
    }    
    ### VARIABILI LOG PER UN INVIO VOUCHER TRAMITE WHATSAPP ###
    if($_REQUEST['action'] == 'send_whatsapp' && $_REQUEST['spedito'] == 'Voucher'){
        $azioneLog    = 'SEND Voucher WHATSAPP';
        $tabellaLog   = 'whatsapp';
        $id_richiesta = $_REQUEST['id_richiesta'];
    }   
    ### VARIABILI LOG PER UN INVIO RICHIESTA RECENSIONI MANUALE ###
    if($_REQUEST['action'] == 'send_recensioni' && $_REQUEST['spedito'] == 'RecensioniManuali'){
        $azioneLog    = 'SEND Richiesta Recensioni Manuale';
        $tabellaLog   = 'hospitality_recensioni_range|hospitality_recensioni_send';
        $id_richiesta = $_REQUEST['id_richiesta'];
    }     
    ###CREAZIONE RECORD DI LOG PER OPERATORE
    if($azioneLog  != '' && $tabellaLog != ''){

        $insert_log = "INSERT INTO hospitality_log_operations(idsito,id_richiesta,operatore,azione,tabella,data_ora,Ip) VALUES('".IDSITO."','".$id_richiesta."','".$_SESSION['user_accesso']."','".$azioneLog ."','".$tabellaLog."','".date('Y-m-d H:s:i')."','".$_SERVER['REMOTE_ADDR']."')";
        $dbMysqli->query($insert_log);

    }
