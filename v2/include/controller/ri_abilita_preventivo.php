<?php

    if($_REQUEST['azione']!=''){

        $db->query("UPDATE hospitality_guest SET NoDisponibilita = 0 WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO);

        //header('Location:'.BASE_URL_SITO.'dashboard-index/');
        $prt->_goto(BASE_URL_SITO.'preventivi/');
    }
