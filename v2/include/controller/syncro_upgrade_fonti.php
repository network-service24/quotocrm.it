<?php

                $query = "SELECT utenti.idsito, siti.web 
                            FROM utenti 
                            INNER JOIN siti ON siti.idsito = utenti.idsito 
                            WHERE 1=1
                            AND utenti.blocco_accesso = 0 
                            AND siti.hospitality = 1
                            ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                            AND siti.data_start_hospitality <= '".date('Y-m-d')."' 
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $dir_sito = '';
        $dir_tmp  = '';
        $tot      = '';
        $select   = '';

        foreach($res as $k => $v){

               $select = "SELECT * FROM hospitality_fonti_prenotazione WHERE idsito = ".$v['idsito']." AND FontePrenotazione = 'Richiesta diretta da Newsletter' ";
               $result = $db->query($select);
               $rec = $db->result($result);

                if(sizeof($rec)==0){
                    $db->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".$v['idsito']."','Richiesta diretta da Newsletter','1','1')");

                }
           
        }



?>