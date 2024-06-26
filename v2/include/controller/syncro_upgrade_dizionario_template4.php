<?php


 $query = "SELECT  siti.*
            FROM siti
            WHERE siti.hospitality = 1
            AND siti.data_end_hospitality > '".date('Y-m-d')."'
            AND siti.id_status <> 5
            GROUP BY  siti.idsito
            ORDER BY siti.data_start_hospitality DESC";
$rec = $db_suiteweb->query($query);
$res = $db_suiteweb->result($rec);


foreach($res as $k => $v){

        $select2 = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'PREVENTIVO_CUSTOM4'";
        $sel2 = $db->query($select2);
        $tot2 = sizeof($db->result($sel2));
        if($tot2==0){

            $preventivo_custom4_it = 'Gentile <b>[cliente]</b>,<br> facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. La nostra struttura ricettiva è organizzata appositamente per gli sport invernali ed eventi stagionali.';

            $preventivo_custom4_en = 'Dear <b>[cliente]</b>,<br> in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. Our accommodation facility is specially organized for winter sports and seasonal events';                                  

            $preventivo_custom4_fr = 'Cher <b>[cliente]</b>,<br> en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition. Notre structure d\'hébergement est spécialement organisée pour les sports d\'hiver et les événements saisonniers';

            $preventivo_custom4_de = 'Sehr geehrter <b>[cliente]</b>,<br> als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. Unsere Unterkunftseinrichtung ist speziell für Wintersport und saisonale Veranstaltungen organisiert'; 

                $diz120_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM4')");
                $id_diz120_bis = $db->insert_id($diz120_bis);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','it','".addslashes($preventivo_custom4_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','en','".addslashes($preventivo_custom4_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','fr','".addslashes($preventivo_custom4_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','de','".addslashes($preventivo_custom4_de)."','1')");
        }//
        $select = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'CONFERMA_CUSTOM4'";
        $sel = $db->query($select);
        $tot = sizeof($db->result($sel));
        if($tot==0){

            $conferma_custom4_it = 'Gentile <b>[cliente]</b>,<br> facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia. La nostra struttura ricettiva è organizzata appositamente per gli sport invernali ed eventi stagionali.';

            $conferma_custom4_en = 'Dear <b>[cliente]</b>,<br> in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. Our accommodation facility is specially organized for winter sports and seasonal events';                                  

            $conferma_custom4_fr = 'Cher <b>[cliente]</b>,<br> en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie. Notre structure d\'hébergement est spécialement organisée pour les sports d\'hiver et les événements saisonniers';

            $conferma_custom4_de = 'Sehr geehrter <b>[cliente]</b>,<br> als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie. Unsere Unterkunftseinrichtung ist speziell für Wintersport und saisonale Veranstaltungen organisiert';  

                $diz121_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM4')");
                $id_diz121_bis = $db->insert_id($diz121_bis);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','it','".addslashes($conferma_custom4_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','en','".addslashes($conferma_custom4_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','fr','".addslashes($conferma_custom4_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','de','".addslashes($conferma_custom4_de)."','1')");
        }

    
        

        $select2 = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'PREVENTIVO_CUSTOM5'";
        $sel2 = $db->query($select2);
        $tot2 = sizeof($db->result($sel2));
        if($tot2==0){

            $preventivo_custom5_it = 'Gentile <b>[cliente]</b>,<br> facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. La nostra struttura ricettiva è organizzata appositamente per gli sport estivi ed eventi stagionali.';

            $preventivo_custom5_en = 'Dear <b>[cliente]</b>,<br> in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. Our accommodation is specially organized for summer sports and seasonal events';                                  

            $preventivo_custom5_fr = 'Cher <b>[cliente]</b>,<br> en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition. Notre hébergement est spécialement organisé pour les sports d\'été et les événements saisonniers';

            $preventivo_custom5_de = 'Sehr geehrter <b>[cliente]</b>,<br> als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. Unsere Unterkunft ist speziell für Sommersport und saisonale Veranstaltungen organisiert'; 

                $diz120_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM5')");
                $id_diz120_bis = $db->insert_id($diz120_bis);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','it','".addslashes($preventivo_custom5_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','en','".addslashes($preventivo_custom5_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','fr','".addslashes($preventivo_custom5_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz120_bis."','".$v['idsito']."','de','".addslashes($preventivo_custom5_de)."','1')");
        }//
        $select = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'CONFERMA_CUSTOM5'";
        $sel = $db->query($select);
        $tot = sizeof($db->result($sel));
        if($tot==0){

            $conferma_custom5_it = 'Gentile <b>[cliente]</b>,<br> facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia. La nostra struttura ricettiva è organizzata appositamente per gli sport estivi ed eventi stagionali.';

            $conferma_custom5_en = 'Dear <b>[cliente]</b>,<br> in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. Our accommodation is specially organized for summer sports and seasonal events';                                  

            $conferma_custom5_fr = 'Cher <b>[cliente]</b>,<br> en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie. Notre hébergement est spécialement organisé pour les sports d\'été et les événements saisonniers';

            $conferma_custom5_de = 'Sehr geehrter <b>[cliente]</b>,<br> als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie. Unsere Unterkunft ist speziell für Sommersport und saisonale Veranstaltungen organisiert';  

                $diz121_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM5')");
                $id_diz121_bis = $db->insert_id($diz121_bis);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','it','".addslashes($conferma_custom5_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','en','".addslashes($conferma_custom5_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','fr','".addslashes($conferma_custom5_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".$v['idsito']."','de','".addslashes($conferma_custom5_de)."','1')");
        }        

}

$content = 'salvataggio contenuti testuali per il nuovo template effettuato con successo!!';


?>
