<?php

    if($_REQUEST['azione']!=''){

        $select = "SELECT TipoRichiesta,Chiuso FROM hospitality_guest  WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO;
        $result = $dbMysqli->query($select);
        $row    = $result[0];

        $dbMysqli->query("UPDATE hospitality_guest SET Hidden = 0 WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO);

        if($row['TipoRichiesta'] == 'Preventivo'){

            $prt->_goto(BASE_URL_SITO.'preventivi/');

        }else{

			if($row['Chiuso']=='1'){

                $prt->_goto(BASE_URL_SITO.'prenotazioni/');

            }else{

                 $prt->_goto(BASE_URL_SITO.'conferme/');  

            }

        }
    }
