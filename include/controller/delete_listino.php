<?php

    if($_REQUEST['azione']!=''){

        $dbMysqli->query("DELETE FROM hospitality_numero_listini WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO);
        $dbMysqli->query("DELETE FROM hospitality_listino_camere WHERE IdNumeroListino = ".$_REQUEST['azione']." AND idsito = ".IDSITO);
        //header('Location:'.BASE_URL_SITO.'dashboard-index/');
        $prt->_goto(BASE_URL_SITO.'disponibilita-tipo_listino/');
    }
