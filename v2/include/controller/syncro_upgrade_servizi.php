<?php

                $query = "SELECT siti.idsito
                            FROM siti 
                            INNER JOIN pms_progetti ON pms_progetti.idsito = siti.idsito
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


        // SERVIZI AGGIUNTIVI
        $seT = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','culla_baby.png','Culla','','Al giorno','1')");
        $id_seT = $db->insert_id($seT);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/culla_baby.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/culla_baby.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".$v['idsito']."','it','Culla','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".$v['idsito']."','en','Baby cot','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".$v['idsito']."','fr','Lit d\'enfant','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".$v['idsito']."','de','Krippe','')");
        #
        $seT1 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','parking.png','Parcheggio','','Al giorno','1')");
        $id_seT1 = $db->insert_id($seT1);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/parking.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/parking.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".$v['idsito']."','it','Parcheggio','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".$v['idsito']."','en','Parking','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".$v['idsito']."','fr','Parking','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".$v['idsito']."','de','Parkplatz','')");
        #
        $seT2 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','beach.png','Spiaggia','','Al giorno','1')");
        $id_seT2 = $db->insert_id($seT2);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/beach.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/beach.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".$v['idsito']."','it','Spiaggia','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".$v['idsito']."','en','Beach','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".$v['idsito']."','fr','Plage','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".$v['idsito']."','de','Strand','')");
        #
        $seT3 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','bus_navetta.png','Bus Navetta','','Una tantum','1')");
        $id_seT3 = $db->insert_id($seT3);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/bus_navetta.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/bus_navetta.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".$v['idsito']."','it','Bus Navetta','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".$v['idsito']."','en','Bus','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".$v['idsito']."','fr','Navette','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".$v['idsito']."','de','Shuttle-Bus','')");
        #
        $seT4 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','wellness.png','Centro Wellness','','Una tantum','1')");
        $id_seT4 = $db->insert_id($seT4);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/wellness.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/wellness.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".$v['idsito']."','it','Centro Wellness','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".$v['idsito']."','en','Wellness Center','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".$v['idsito']."','fr','Centre de bien-être','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".$v['idsito']."','de','Wellness Zentrum','')");
        #
        $seT5 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','computer.png','Internet Point','','Una tantum','1')");
        $id_seT5 = $db->insert_id($seT5);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/computer.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/computer.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','it','Internet Point','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','en','Internet Point','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','fr','Internet Point','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','de','Internet Point','')");
        #
        $seT5 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','nursery.png','Nursery','','Al giorno','1')");
        $id_seT5 = $db->insert_id($seT5);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/nursery.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/nursery.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','it','Nursery','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','en','Nursery','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','fr','Pépinière','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".$v['idsito']."','de','Kindergarten','')");
        #
        $seT6 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','giornali.png','Giornali','','Al giorno','1')");
        $id_seT6 = $db->insert_id($seT6);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/giornali.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/giornali.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".$v['idsito']."','it','Giornali','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".$v['idsito']."','en','Newspapers','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".$v['idsito']."','fr','Journaux','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".$v['idsito']."','de','Zeitungen','')");
        #
        $seT7 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','joystick_cover.png','Sala Giochi','','Una tantum','1')");
        $id_seT7 = $db->insert_id($seT7);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/joystick_cover.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/joystick_cover.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".$v['idsito']."','it','Sala Giochi','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".$v['idsito']."','en','Game room','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".$v['idsito']."','fr','Salle de jeux','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".$v['idsito']."','de','Spielzimmer','')");
        //FINE

        $seT8 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','skipass.png','Skipass','','A persona','0')");
        $id_seT8 = $db->insert_id($seT8);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/skipass.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/skipass.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".$v['idsito']."','it','Skipass','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".$v['idsito']."','en','Skipass','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".$v['idsito']."','fr','Skipass','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".$v['idsito']."','de','Skipass','')");

        $seT9 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','massaggio.png','Massaggio','','A persona','1')");
        $id_seT9 = $db->insert_id($seT9);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/massaggio.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/massaggio.png';  
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA
        
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".$v['idsito']."','it','Massaggio','')");       
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".$v['idsito']."','en','Massage','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".$v['idsito']."','fr','Massage','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".$v['idsito']."','de','Massage','')");
        //FINE 
    }
       
?>