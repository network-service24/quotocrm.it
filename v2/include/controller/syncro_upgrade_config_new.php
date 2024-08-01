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

        $descr_ui .= 'Check per inviare copia della mail voucher verso Hotel'."\r\n";
        $descr_ui .= 'Impostando il valore: '."\r\n";
        $descr_ui .= '0 = Quoto NON invia copia email voucher anche verso hotel'."\r\n";
        $descr_ui .= '1 = Quoto invia copia email voucher anche verso hotel'."\r\n";


        foreach($res as $k => $v){

               $select = "SELECT * FROM hospitality_configurazioni WHERE idsito = ".$v['idsito']." AND parametro = 'check_email_voucher_hotel'";
                $sel = $db->query($select);
                $tot = sizeof($db->result($sel));
                if($tot==0){
                    $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".$v['idsito']."','check_email_voucher_hotel','".$descr_ui."','0')");
                }

       }

?>