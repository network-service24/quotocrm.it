<?php

                 $query = "SELECT  siti.*
                            FROM siti
                            WHERE siti.hospitality = 1
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'
                            AND siti.id_status <> 5
                            GROUP BY  siti.idsito
                            ORDER BY siti.data_start_hospitality DESC ";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $tot      = '';
        $select   = ''; 

        $descr_ui .= 'Check per aprire QUOTO al login con la nuova o vecchia interfaccia UI'."\r\n";
        $descr_ui .= 'Impostando il valore: '."\r\n";
        $descr_ui .= '0 = Quoto si apre con la vecchia interfaccia'."\r\n";
        $descr_ui .= '1 = Quoto si apre con la nuova interfaccia'."\r\n";


        foreach($res as $k => $v){

               $select = "SELECT * FROM hospitality_configurazioni WHERE idsito = ".$v['idsito']." AND parametro = 'check_interfaccia'";
                $sel = $db->query($select);
                $tot = sizeof($db->result($sel));
                if($tot==0){
                //
                    $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".$v['idsito']."','check_interfaccia','".$descr_ui."','0')");
                }

       }

?>