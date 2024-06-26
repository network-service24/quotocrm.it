<?php

    if($_REQUEST['azione']!=''){

        $select = "SELECT TipoRichiesta FROM hospitality_guest  WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO;
        $result = $db->query($select);
        $row    = $db->row($result);

        $db->query("UPDATE hospitality_guest SET NoDisponibilita = 0 WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO);

        if($row['TipoRichiesta'] == 'Preventivo'){

            $prt->_goto(BASE_URL_SITO.'preventivi/');

        }else{

            $prt->_goto(BASE_URL_SITO.'conferme/');

        }
    }
