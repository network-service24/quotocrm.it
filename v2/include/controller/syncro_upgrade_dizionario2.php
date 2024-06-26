<?php


 $query = "SELECT distinct(siti.idsito)
                FROM siti
                INNER JOIN pms_progetti ON pms_progetti.idsito = siti.idsito
                WHERE siti.hospitality = 1
                AND siti.data_end_hospitality > '".date('Y-m-d')."'
                ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                AND pms_progetti.codice_progetto IN('127','132')
                GROUP BY siti.idsito
                ORDER BY siti.idsito DESC";
$rec = $db_suiteweb->query($query);
$res = $db_suiteweb->result($rec);


foreach($res as $k => $v){

        $select2 = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'OGGETTO_RECENSIONE'";
        $sel2 = $db->query($select2);
        $tot2 = sizeof($db->result($sel2));
        if($tot2==0){
                $diz120_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','OGGETTO_RECENSIONE')");
                $id_diz120_bis = $db->insert_id($diz120_bis);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".$v['idsito']."','it','Dopo essere stato nostro ospite, le chiediamo una sua recensione su TripAdvisor sulla nostra struttura ricettiva!')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".$v['idsito']."','en','After being our guest, we ask for your review on TripAdvisor on our accommodation!')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".$v['idsito']."','fr','Après avoir été notre invité, nous vous demandons votre avis sur TripAdvisor sur notre hébergement!')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".$v['idsito']."','de','Nachdem wir unser Gast waren, bitten wir Sie um Ihre Bewertung auf TripAdvisor für unsere Unterkunft!')");
        }//
        $select = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'TESTOMAIL_RECENSIONE'";
        $sel = $db->query($select);
        $tot = sizeof($db->result($sel));
        if($tot==0){
                $diz121_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','TESTOMAIL_RECENSIONE')");
                $id_diz121_bis = $db->insert_id($diz121_bis);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','it','Gentile [cliente], vorremmo invitarti a lasciare una recensione su TripAdvisor, esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura! Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','en','Dear [cliente], we would like to invite you to leave a review on TripAdvisor, express your opinion on the stay you have just spent at our facility! Your thought will be an indispensable source for us to improve our services in the Hotel.','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','fr','Cher [cliente], nous aimerions vous inviter à laisser un avis sur TripAdvisor, exprimer votre opinion sur le séjour que vous venez de passer dans notre établissement! Votre pensée sera une source indispensable pour nous d\'améliorer nos services dans l\'hôtel.','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','de','Sehr geehrter [cliente], wir möchten Sie einladen, eine Bewertung auf TripAdvisor abzugeben und Ihre Meinung zu dem Aufenthalt zu äußern, den Sie gerade in unserer Einrichtung verbracht haben! Ihr Gedanke wird für uns eine unverzichtbare Quelle sein, um unsere Dienstleistungen im Hotel zu verbessern.','1')");
        }

}



?>
