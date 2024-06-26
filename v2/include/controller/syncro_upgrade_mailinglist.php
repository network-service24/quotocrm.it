<?php

                $query = "SELECT siti.idsito, siti.web,siti.nome,siti.data_start_hospitality,siti.data_end_hospitality,siti.no_rinnovo_hospitality,siti.email,siti.tel,siti.cell,
                            utenti.ut_email,utenti.ut_nome,utenti.ut_cognome,pms_progetti.codice_progetto,pms_progetti.commento,pms_progetti.progetto
                            FROM siti 
                            INNER JOIN pms_progetti ON pms_progetti.idsito = siti.idsito
                            INNER JOIN utenti ON utenti.matricola = pms_progetti.codice_operatore
                            WHERE siti.hospitality = 1 
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'
                            ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                            AND pms_progetti.codice_progetto IN('127','132') 
                            GROUP BY siti.idsito
                            ORDER BY siti.data_start_hospitality DESC";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $tot      = '';
        $select   = '';


        foreach($res as $k => $v){

                $select = "SELECT * FROM mailing_newsletter_nome_liste WHERE idsito = ".$v['idsito']." AND nome_lista = 'Mailing List'";
                $sel = $db->query($select);
                $tot = sizeof($db->result($sel));
                if($tot==0){ 

                    $db->query("INSERT INTO mailing_newsletter_nome_liste(idsito,nome_lista,visibile) VALUES('".$v['idsito']."','Mailing List','1')");              
                }
             
        }
       
?>