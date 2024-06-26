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

        $dir_sito = '';
        $dir_tmp  = '';
        $tot      = '';
        $select   = '';

        foreach($res as $k => $v){

                    $diz183 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM4')");
                    $id_diz183 = $db->insert_id($diz183);
            
                    $preventivo_i_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                              Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport invernali ed eventi stagionali.';
                 
                    $preventivo_i_family_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                              To understand how much our structure is a Family Hotels just think that our most important guests are children. Our accommodation facility is specially organized for winter sports and seasonal events';                                  
            
                    $preventivo_i_family_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                              Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'hiver et les événements saisonniers';
            
                    $preventivo_i_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                              Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Wintersport und saisonale Veranstaltungen organisiert';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','it','".addslashes($preventivo_i_family_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','en','".addslashes($preventivo_i_family_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','fr','".addslashes($preventivo_i_family_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','de','".addslashes($preventivo_i_family_de)."','1')");
            
                    $diz184 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM4')");
                    $id_diz184 = $db->insert_id($diz184);
            
                    $conferma_i_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                              Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport invernali ed eventi stagionali.';
                 
                    $conferma_i_family_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                              To understand how much our structure is a Family Hotels just think that our most important guests are children.  Our accommodation facility is specially organized for winter sports and seasonal events';                                  
            
                    $conferma_i_family_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                              Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'hiver et les événements saisonniers';
            
                    $conferma_i_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                              Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Wintersport und saisonale Veranstaltungen organisiert';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','it','".addslashes($conferma_i_family_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','en','".addslashes($conferma_i_family_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','fr','".addslashes($conferma_i_family_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','de','".addslashes($conferma_i_family_de)."','1')");
     
                    
                    $diz183 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM5')");
                    $id_diz183 = $db->insert_id($diz183);
            
                    $preventivo_e_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                              Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport estivi ed eventi stagionali.';
                 
                    $preventivo_e_family_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                              To understand how much our structure is a Family Hotels just think that our most important guests are children. Our accommodation facility is specially organized for summer sports and seasonal events';                                  
            
                    $preventivo_e_family_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                              Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'été et les événements saisonniers';
            
                    $preventivo_e_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                              Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Sommersport und saisonale Veranstaltungen organisiert';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','it','".addslashes($preventivo_e_family_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','en','".addslashes($preventivo_e_family_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','fr','".addslashes($preventivo_e_family_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".$v['idsito']."','de','".addslashes($preventivo_e_family_de)."','1')");
            
                    $diz184 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM5')");
                    $id_diz184 = $db->insert_id($diz184);
            
                    $conferma_e_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                              Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport estivi ed eventi stagionali.';
                 
                    $conferma_e_family_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                              To understand how much our structure is a Family Hotels just think that our most important guests are children.  Our accommodation facility is specially organized for summer sports and seasonal events';                                  
            
                    $conferma_e_family_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                              Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'été  et les événements saisonniers';
            
                    $conferma_e_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                              Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Sommersport und saisonale Veranstaltungen organisiert';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','it','".addslashes($conferma_e_family_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','en','".addslashes($conferma_e_family_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','fr','".addslashes($conferma_e_family_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".$v['idsito']."','de','".addslashes($conferma_e_family_de)."','1')");





                    $diz185 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM6')");
                    $id_diz185 = $db->insert_id($diz185);
            
                    $preventivo_i_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                            La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi invernali in genere.';
                 
                    $preventivo_i_bike_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                            Our accommodation facility is specially organized for cyclists and all winter sportsmen in general.';                                  
            
                    $preventivo_i_bike_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                              Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';
            
                    $preventivo_i_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                              Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','it','".addslashes($preventivo_i_bike_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','en','".addslashes($preventivo_i_bike_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','fr','".addslashes($preventivo_i_bike_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','de','".addslashes($preventivo_i_bike_de)."','1')");
            
                    $diz186 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM6')");
                    $id_diz186 = $db->insert_id($diz186);
            
                    $conferma_i_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                            La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi in genere.';
                 
                    $conferma_i_bike_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                          Our accommodation facility is specially organized for cyclists and all winter sportsmen in general.';                                  
            
                    $conferma_i_bike_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                          Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';
            
                    $conferma_i_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                          Unsere Unterkunft ist speziell für Radfahrer und alle Sportler im Allgemeinen organisiert.';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','it','".addslashes($conferma_i_bike_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','en','".addslashes($conferma_i_bike_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','fr','".addslashes($conferma_i_bike_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','de','".addslashes($conferma_i_bike_de)."','1')");
            
           
                    $diz185 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM7')");
                    $id_diz185 = $db->insert_id($diz185);
            
                    $preventivo_e_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                            La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi estivi in genere.';
                 
                    $preventivo_e_bike_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                            Our accommodation facility is specially organized for cyclists and all summer sportsmen in general.';                                  
            
                    $preventivo_e_bike_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                              Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';
            
                    $preventivo_e_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                              Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','it','".addslashes($preventivo_e_bike_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','en','".addslashes($preventivo_e_bike_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','fr','".addslashes($preventivo_e_bike_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".$v['idsito']."','de','".addslashes($preventivo_e_bike_de)."','1')");
            
                    $diz186 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM7')");
                    $id_diz186 = $db->insert_id($diz186);
            
                    $conferma_e_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                            La nostra struttura ricettiva è organizzata appositamente in estate per i ciclisti e tutti gli sportivi in genere.';
                 
                    $conferma_e_bike_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                          Our accommodation facility is specially organized for cyclists and all summer sportsmen in general.';                                  
            
                    $conferma_e_bike_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                          Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';
            
                    $conferma_e_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                          Unsere Unterkunft ist speziell für Radfahrer und alle Sportler im Allgemeinen organisiert.';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','it','".addslashes($conferma_e_bike_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','en','".addslashes($conferma_e_bike_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','fr','".addslashes($conferma_e_bike_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".$v['idsito']."','de','".addslashes($conferma_e_bike_de)."','1')");             



            
                    $diz187 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM8')");
                    $id_diz187 = $db->insert_id($diz187);
            
                    $preventivo_i_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                                  Una esperienza di soggiorno invernale pensata esclusivamente per le coppie.';
                 
                    $preventivo_i_romantico_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                                    A winter stay experience designed exclusively for couples';                                  
            
                    $preventivo_i_romantico_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                                    Une expérience de séjour d\'hiver conçue exclusivement pour les couples';
            
                    $preventivo_i_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                                    Ein Winteraufenthaltserlebnis exklusiv für Paare';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','it','".addslashes($preventivo_i_romantico_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','en','".addslashes($preventivo_i_romantico_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','fr','".addslashes($preventivo_i_romantico_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','de','".addslashes($preventivo_i_romantico_de)."','1')");
            
                    $diz188 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM8')");
                    $id_diz188 = $db->insert_id($diz188);
            
                    $conferma_i_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                                 Una esperienza di soggiorno invernale pensata esclusivamente per le coppie.';
                 
                    $conferma_i_romantico_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                                A winter stay experience designed exclusively for couples';                                  
            
                    $conferma_i_romantico_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                                    Une expérience de séjour d\'hiver conçue exclusivement pour les couples';
            
                    $conferma_i_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                                Ein Winteraufenthaltserlebnis exklusiv für Paare';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','it','".addslashes($conferma_i_romantico_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','en','".addslashes($conferma_i_romantico_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','fr','".addslashes($conferma_i_romantico_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','de','".addslashes($conferma_i_romantico_de)."','1')");
            
                    $diz187 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PREVENTIVO_CUSTOM9')");
                    $id_diz187 = $db->insert_id($diz187);
            
                    $preventivo_e_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                    Una esperienza di soggiorno estiva pensata esclusivamente per le coppie..';
                 
                    $preventivo_e_romantico_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                    A summer stay experience designed exclusively for couples.';                                  
            
                    $preventivo_e_romantico_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                    Une expérience de séjour estival conçue exclusivement pour les couples.';
            
                    $preventivo_e_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                    Ein Sommererlebnis exklusiv für Paare.';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','it','".addslashes($preventivo_e_romantico_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','en','".addslashes($preventivo_e_romantico_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','fr','".addslashes($preventivo_e_romantico_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".$v['idsito']."','de','".addslashes($preventivo_e_romantico_de)."','1')");
            
                    $diz188 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','CONFERMA_CUSTOM9')");
                    $id_diz188 = $db->insert_id($diz188);
            
                    $conferma_e_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                    Una esperienza di soggiorno estiva pensata esclusivamente per le coppie.';
                 
                    $conferma_e_romantico_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                    A summer stay experience designed exclusively for couples.';                                  
            
                    $conferma_e_romantico_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                    Une expérience de séjour estival conçue exclusivement pour les couples.';
            
                    $conferma_e_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                    Ein Sommererlebnis exklusiv für Paare.';                                
            
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','it','".addslashes($conferma_e_romantico_it)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','en','".addslashes($conferma_e_romantico_en)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','fr','".addslashes($conferma_e_romantico_fr)."','1')");
                    $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".$v['idsito']."','de','".addslashes($conferma_e_romantico_de)."','1')");             
           
        }

        $content = 'salvataggio effettuato con successo!!';

?>