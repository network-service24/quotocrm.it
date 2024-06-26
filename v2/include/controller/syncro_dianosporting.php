<?php

         // dizionario del software
        $diz1 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOLUZIONECONFERMATA')");
        $id_diz1 = $db->insert_id($diz1);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','it','Soluzione Confermata')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','en','Solution Confirmed')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','fr','Solution Confirmée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','de','Bestätigte Lösung')");
         //
        $diz2 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATISOGGIORNO')");
        $id_diz2 = $db->insert_id($diz2);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','it','Dati del soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','en','Brief summary reservation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','fr','Restez données:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','de','Bleiben Daten:')");
        //
        $diz3 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TIPOSOGGIORNO')");
        $id_diz3 = $db->insert_id($diz3);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','it','Tipo soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','en','Type of stay:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','fr','Type de séjour:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','de','Aufenthalt Art:')");
        //
        $diz4 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATAARRIVO')");
        $id_diz4 = $db->insert_id($diz4);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','it','Data arrivo:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','en','Arrival:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','fr','Arrivée:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','de','Ankunft:')");
        //
        $diz5 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATAPARTENZA')");
        $id_diz5 = $db->insert_id($diz5);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','it','Data partenza:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','en','Departure:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','fr','Date de départ:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','de','Abreisedatum:')");
        //
        $diz6 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SISTEMAZIONE')");
        $id_diz6 = $db->insert_id($diz6);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','it','Sistemazione:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','en','Accommodation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','fr','Hébergement:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','de','Unterkunft:')");
        //
        $diz7 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPIENZAADULTI')");
        $id_diz7 = $db->insert_id($diz7);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','it','<b>Capienza Adulti:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','en','<b>Capacity Adults:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','fr','<b>Capacité Adultes:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','de','<b>Kapazität Erwachsene:</b>')");
        //
        $diz8 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPIENZABAMBINI')");
        $id_diz8 = $db->insert_id($diz8);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','it','<b>Capienza Bambini:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','en','<b>Children Capacity:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','fr','<b>La capacité des enfants:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','de','<b>Kinder Kapazität:</b>')");
        //
        $diz9 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','METRATURA')");
        $id_diz9 = $db->insert_id($diz9);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','it','<b>Metratura:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','en','<b>Square footage:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','fr','<b>Pieds carrés:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','de','<b>Quadratmeterzahl:</b>')");
        //
        $diz10 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZICAMERA')");
        $id_diz10 = $db->insert_id($diz10);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','it','<b>Servizi in camera:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','en','<b>Room facilities:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','fr','<b>Équipements en Chambre:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','de','<b>Zimmerausstattung:</b>')");
        //
        $diz11 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PRENOTAZIONE')");
        $id_diz11 = $db->insert_id($diz11);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','it','Prenotazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','en','Reservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','fr','Réservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','de','Buchung')");
        //
        $diz12 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA')");
        $id_diz12 = $db->insert_id($diz12);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','it','Conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','en','Confirm')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','fr','Confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','de','Bestätigung')");
        //
        $diz13 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO')");
        $id_diz13 = $db->insert_id($diz13);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','it','Preventivo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','en','Quote')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','fr','Citation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','de','Zitat')");
        //
        $diz14 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NOTE')");
        $id_diz14 = $db->insert_id($diz14);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','it','Note:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','en','Notes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','fr','Remarques:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','de','Aufzeichnungen:')");
        //
        $diz15 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK1')");
        $id_diz15 = $db->insert_id($diz15);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','it','Clicca qui per vedere l\'offerta a te dedicata... ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','en','Click here to see the page dedicated to you ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','fr','Cliquez ici pour voir l\'offre dédiée à vous ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','de','Klicken Sie hier, um zu sehen, das Angebot zu Ihnen gewidmet ...')");
        //
        $diz16 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK2')");
        $id_diz16 = $db->insert_id($diz16);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','it','Scopri qual è la nostra migliore offerta per il periodo da te richiesto!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','en','Find out what our best offer for the required period!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','fr','Découvrez ce que notre meilleure offre pour la période requise!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','de','Entdecken Sie, was unser bestes Angebot für den gewünschten Zeitraum!')");
        //
        $diz17 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA')");
        $id_diz17 = $db->insert_id($diz17);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','it','Pagina Web riservata a:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','en','Web page reserved for:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','fr','Page Web réservée aux:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','de','Webseite reserviert für:')");
        //
        $diz18 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SALUTI_H')");
        $id_diz18 = $db->insert_id($diz18);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','it','I nostri migliori saluti.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','en','Our best regards.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','fr','Nos meilleures salutations.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','de','Unsere freundlichen Grüßen.')");
        //
        $diz19 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OFFERTA_DETTAGLIO')");
        $id_diz19 = $db->insert_id($diz19);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','it','Vai al dettaglio dell\'offerta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','en','View detailed offer')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','fr','Voir offre détaillée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','de','Detailierten Angebot')");
        //
        $diz20 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGAMENTO')");
        $id_diz20 = $db->insert_id($diz20);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','it','Caparra da versare per la conferma della prenotazione:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','en','Deposit to be paid for the reservation confirmation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','fr','Dépôt requis pour confirmer la réservation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','de','Kaution erforderlich, um Reservierung zu bestätigen:')");
        //
        $diz85 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONTO')");
        $id_diz85 = $db->insert_id($diz85);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','it','Caparra calcolata sul prezzo del soggiorno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','en','Deposit calculated on the price of the stay')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','fr','Caution calculée sur le prix du séjour')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','de','Kaution berechnet auf den Preis des Aufenthaltes')");
        //
        $diz21 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO')");
        $id_diz21 = $db->insert_id($diz21);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','it','Dopo essere stato nostro ospite, le chiediamo una sua opinione sui nostri servizi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','en','After being our guest, we ask you your own opinion about our services')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','fr','Après avoir été notre invité, nous demandons son opinion sur nos services')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','de','Nachdem unser Gast zu sein, bitten wir seine Meinung über unsere Dienstleistungen')");
        //
        $diz22 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL')");
        $id_diz22 = $db->insert_id($diz22);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','it','Gentile [cliente], fiduciosi che il suo soggiorno presso la nostra struttura ricettiva sia stato di suo gradimento, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà dare una sua opinione sui servizi relativi al nostro hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','en','Dear [cliente], confident that his stay at our accommodation has been to his liking, please click on the link located at the bottom in the mail in a few minutes will give an opinion on the services related to our hotels.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','fr','Cher [cliente], confiant que son séjour dans notre établissement a été à son gré, s\'il vous plaît cliquer sur le lien situé au bas de l\'e-mail en quelques minutes donnera un avis sur les services liés à nos hôtels.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','de','Sehr [cliente], zuversichtlich, dass sein Aufenthalt in unserer Unterkunft nach seinem Geschmack gewesen ist, klicken Sie bitte auf den Link am Ende in der E-Mail in wenigen Minuten befindet sich eine Stellungnahme zu den Dienstleistungen für unsere Hotels im Zusammenhang geben.','1')");
        //
        $diz23 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VAI_AL_QUEST')");
        $id_diz23 = $db->insert_id($diz23);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','it','Vai al questionario')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','en','Go to the questionnaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','fr','Accédez au questionnaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','de','Gehen Sie auf den Fragebogen')");
        //
        //Dizionario CLOUD
        $diz24 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VISITA_NOSTRO_SITO')");
        $id_diz24 = $db->insert_id($diz24);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','it','Visita il nostro sito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','en','Visit our website')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','fr','Visitez notre site Web')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','de','Besuchen Sie unsere Website')");
        //
        $diz25 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MESSAGGIO_PER_NOI')");
        $id_diz25 = $db->insert_id($diz25);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','it','Messaggio per noi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','en','Message for us')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','fr','Message pour nous')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','de','Nachricht für uns')");
        //
        $diz26 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTE')");
        $id_diz26 = $db->insert_id($diz26);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','it','Proposte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','en','Proposals')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','fr','Propositions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','de','Vorschläge')");
        //
        $diz27 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOGGIORNI')");
        $id_diz27 = $db->insert_id($diz27);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','it','Soggiorni')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','en','Stays')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','fr','Séjours')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','de','Aufenthalte')");
        //
        $diz28 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','EVENTI')");
        $id_diz28 = $db->insert_id($diz28);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','it','Eventi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','en','Events')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','fr','Evénements')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','de','Geschehen')");
        //
        $diz29 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PDI')");
        $id_diz29 = $db->insert_id($diz29);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','it','Punti di Interesse')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','en','Points of Interest')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','fr','Points d\'intérêt')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','de','Interesse Punkte')");
        //
        $diz30 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONTATTA_HOTEL')");
        $id_diz30 = $db->insert_id($diz30);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','it','Contatta l\'Hotel')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','en','Contact the Hotel')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','fr','Contactez l\'Hôtel')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','de','Kontaktieren Sie das Hotel')");
        //
        $diz31 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MESSAGGIO')");
        $id_diz31 = $db->insert_id($diz31);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','it','Messaggio')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','en','Message')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','fr','Message')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','de','Nachricht')");
        //
        $diz32 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INVIA')");
        $id_diz32 = $db->insert_id($diz32);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','it','Invia')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','en','Submit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','fr','Soumettre')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','de','Einreichen')");
        //
        $diz33 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','IL_SUO')");
        $id_diz33 = $db->insert_id($diz33);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','it','Il suo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','en','His')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','fr','Son')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','de','Seine')");
        //
        $diz34 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DA')");
        $id_diz34 = $db->insert_id($diz34);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','it','da')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','en','from')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','fr','à partir de')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','de','von')");
        //
        $diz37 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OFFERTA')");
        $id_diz37 = $db->insert_id($diz37);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','it','Offerta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','en','Offers')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','fr','Offre')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','de','Angebot')");
        //
        $diz38 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DEL')");
        $id_diz38 = $db->insert_id($diz38);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','it','del')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','en','the')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','fr','la')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','de','die')");
        //
        $diz39 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATA_ARRIVO')");
        $id_diz39 = $db->insert_id($diz39);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','it','Data di Arrivo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','en','Check-in date')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','fr','Date d\'arrivée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','de','Ankunft')");
        //
        $diz40 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATA_PARTENZA')");
        $id_diz40 = $db->insert_id($diz40);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','it','Data di Partenza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','en','Departure date')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','fr','Date de départ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','de','Abfahrtsdatum')");
        //
        $diz41 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTE_PER_NR_ADULTI')");
        $id_diz41 = $db->insert_id($diz41);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','it','Proposte per N° Adulti:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','en','Proposals for N° Adults:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','fr','Les propositions de N° Adultes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','de','Vorschläge für N° Erwachsene:')");
        //
        $diz42 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOGGIORNO_PER_NR_ADULTI')");
        $id_diz42 = $db->insert_id($diz42);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','it','Soggiorno per N° Adulti:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','en','Stay to N° Adults:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','fr','Restez à N° Adultes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','de','Bleiben Sie auf dem N° Erwachsene:')");
        //
        $diz43 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NR_BAMBINI')");
        $id_diz43 = $db->insert_id($diz43);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','it','N° Bambini:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','en','N° Children:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','fr','N° Enfants:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','de','Nr Kinder:')");
        //
        $diz44 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NOTTI')");
        $id_diz44 = $db->insert_id($diz44);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','it','N° Notti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','en','N° Nights')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','fr','N° Nuits')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','de','N° Nächte')");
        //
        $diz45 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ADULTI')");
        $id_diz45 = $db->insert_id($diz45);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','it','Adulti:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','en','Adults:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','fr','Adultes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','de','Erwachsene:')");
        //
        $diz46 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','BAMBINI')");
        $id_diz46 = $db->insert_id($diz46);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','it','Bambini:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','en','Children:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','fr','Enfants:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','de','Kinder:')");
        //
        $diz48 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTA')");
        $id_diz48 = $db->insert_id($diz48);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','it','Proposta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','en','Proposal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','fr','Proposition')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','de','Vorschlag')");
        //
        $diz49 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOGGIORNO')");
        $id_diz49 = $db->insert_id($diz49);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','it','Soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','en','Stay:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','fr','Séjour:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','de','Aufenthalt:')");
        //
        $diz50 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TIPOCAMERA')");
        $id_diz50 = $db->insert_id($diz50);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','it','Tipologia Camera:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','en','Room type:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','fr','Type de chambre:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','de','Zimmerkategorie:')");
        //
        $diz51 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZI_CAMERA')");
        $id_diz51 = $db->insert_id($diz51);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','it','Servizi Camera:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','en','Room services:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','fr','Les services de chambre:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','de','Zimmerservice:')");
        //
        $diz52 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAMERA')");
        $id_diz52 = $db->insert_id($diz52);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','it','Camera:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','en','Room:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','fr','Chambre:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','de','Zimmer:')");
        //
        $diz53 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO')");
        $id_diz53 = $db->insert_id($diz53);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','it','Prezzo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','en','Price')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','fr','Prix')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','de','Preis')");
        //
        $diz54 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DA_LISTINO')");
        $id_diz54 = $db->insert_id($diz54);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','it','da listino')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','en','pricelist')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','fr','pricelist')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','de','preisliste')");
        //
        $diz55 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','E_PROPOSTO')");
        $id_diz55 = $db->insert_id($diz55);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','it',' per il soggiorno ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','en',' for the stay ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','fr',' pour le séjour ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','de',' für den Aufenthalt ')");
        //
        $diz56 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ALLA_CO')");
        $id_diz56 = $db->insert_id($diz56);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','it','Alla c/o di ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','en','At c / or ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','fr','A c / ou ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','de','Bei c / oder ')");
        //
        $diz57 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONTENUTO_MSG')");
        $id_diz57 = $db->insert_id($diz57);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','it','vorremmo accettare la proposta di soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','en','we would like to accept the proposal of stay:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','fr','nous tenons à accepter la proposition du séjour:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','de','möchten wir den Vorschlag des Aufenthalts zu akzeptieren:')");
        //
        $diz58 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CORDIALMENTE')");
        $id_diz58 = $db->insert_id($diz58);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','it','Cordialmente')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','en','Cordially')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','fr','Cordialement')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','de','Herzlich')");
        //
        $diz59 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VISUALIZZA_MAPPA')");
        $id_diz59 = $db->insert_id($diz59);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','it','Visualizza sulla Mappa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','en','Show on map')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','fr','Voir sur la carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','de','Auf der Karte anzeigen')");
        //
        $diz60 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DOVE_SIAMO')");
        $id_diz60 = $db->insert_id($diz60);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','it','Dove Siamo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','en','Where we are')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','fr','Où sommes-nous')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','de','Wo wir sind')");
        //
        $diz61 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTA_SCELTA')");
        $id_diz61 = $db->insert_id($diz61);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','it','Scegli la proposta ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','en','Choosing proposal ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','fr','Choisissez la proposition ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','de','Wählen Sie den Vorschlag ')");
        //
        $diz62 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PLACEHOLDER_PROPOSTA')");
        $id_diz62 = $db->insert_id($diz62);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','it','Scegliere una delle proposte soggiorno, selezionando il checkbox relativo!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','en','Choose from the proposed hotel offers, by checking the appropriate checkbox!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','fr','Choisissez un séjour proposé, en cochant la case appropriée!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','de','Wählen Sie eines der vorgeschlagenen Aufenthalt, indem Sie die entsprechende Checkbox!')");
        //
        $diz63 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SALUTI')");
        $id_diz63 = $db->insert_id($diz63);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','it','Saluti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','en','Greetings')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','fr','Salutations')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','de','Gruß')");
        //
        $diz64 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SELEZIONA_PROPOSTA')");
        $id_diz64 = $db->insert_id($diz64);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','it','Seleziona la proposta e contatta l\'hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','en','Select the proposal and contact the hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','fr','Sélectionnez la proposition et de contacter l\'hôtel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','de','Wählen Sie den Vorschlag und kontaktieren Sie das Hotel!')");
        //
        $diz65 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','STAMPA')");
        $id_diz65 = $db->insert_id($diz65);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','it','VOUCHER PROMEMORIA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','en','VOUCHER REMINDER')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','fr','RAPPEL VOUCHER')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','de','VOUCHER ERINNERUNG')");
        //
        $diz66 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ANNI')");
        $id_diz66 = $db->insert_id($diz66);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','it','anni')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','en','age')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','fr','âge')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','de','Alter')");
        //
        $diz67 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONDIZIONI_GENERALI')");
        $id_diz67 = $db->insert_id($diz67);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','it','Condizioni Generali e Politiche di Cancellazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','en','General Conditions and Cancellation Policies')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','fr','Politiques et conditions générales d\'annulation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','de','Allgemeine Geschäftsbedingungen und Stornierungsbedingungen')");
        //
        $diz68 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CREATA_DA')");
        $id_diz68 = $db->insert_id($diz68);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','it','Creato da:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','en','Created by:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','fr','Créé par:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','de','Erstellt von:')");
        //
        $diz69 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','HOTELCHAT')");
        $id_diz69 = $db->insert_id($diz69);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','it','Hai delle domande per noi? Questo è lo spazio giusto!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','en','You have a question for us? This is the right spot!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','fr','Vous avez une question pour nous? Ceci est le bon endroit!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','de','Sie haben eine Frage an uns? Dies ist der richtige Ort!')");
        //
        $diz70 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','QUESTIONARIO')");
        $id_diz70 = $db->insert_id($diz70);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','it','Questionario soddisfazione del cliente')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','en','Customer satisfaction questionnaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','fr','Questionnaire satisfaction')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','de','Kundenzufriedenheit')");
        //
        $diz71 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_QUESTIONARIO')");
        $id_diz71 = $db->insert_id($diz71);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','it','Gentile [cliente], <br>esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura, per ogni domanda puoi dare un valore di soddisfazione ed un commento!<br> Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','en','Dear [cliente], Give your opinion about your stay you just spent at our facility, for each question you can give a satisfaction value and a comment! Your thinking will be for us a source essential to improve our services in the hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','fr','Cher [cliente], exprimer votre opinion sur votre séjour, vous venez de passer à notre établissement, pour chaque question, vous pouvez donner une valeur de satisfaction et un commentaire! Votre pensée sera pour nous une source essentielle pour améliorer nos services dans l\'hôtel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','de','Lieber [cliente], äußern Sie Ihre Meinung über Ihren Aufenthalt Sie nur in unserer Einrichtung verbracht, für jede Frage können Sie einen Zufriedenheitswert und einen Kommentar abgeben! Ihr Denken wird für uns eine Quelle wesentlich für unsere Dienstleistungen im Hotel zu verbessern.','1')");
        //
        $diz72 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NO_QUESTIONARIO')");
        $id_diz72 = $db->insert_id($diz72);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','it','Questionario già compilato!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','en','Questionnaire already filled!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','fr','Questionnaire déjà rempli!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','de','Fragebogen bereits ausgefüllt!')");
        //
        $diz73 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','THANKS_QUESTIONARIO')");
        $id_diz73 = $db->insert_id($diz73);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','it','Ringraziandovi per aver compilato questo breve questionario, ci auguriamo di rivedervi presto nel nostro hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','en','Thank you for filling out this short questionnaire, we hope to see you soon in our hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','fr','Je vous remercie de remplir ce court questionnaire, nous espérons vous voir bientôt dans notre hôtel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','de','Ich danke Ihnen für das Füllen dieser kurzen Fragebogen aus, wir hoffen, Sie bald in unserem Hotel zu sehen!')");
        //
        $diz74 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','LASCIA_COMMENTO')");
        $id_diz74 = $db->insert_id($diz74);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','it','Lascia un commento')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','en','Leave a comment')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','fr','Laisser un commentaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','de','Hinterlassen Sie einen Kommentar')");
        //
        $diz75 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CARTA_CREDITO')");
        $id_diz75 = $db->insert_id($diz75);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','it','Garanzia Carta di Credito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','en','Guarantee Credit Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','fr','Garantie Carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','de','Garantie Kreditkarte')");
        //
        $diz76 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_CARTA_CREDITO')");
        $id_diz76 = $db->insert_id($diz76);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','it','La carta di credito serve solo per garantire la prenotazione!<br> L\'importo del soggiorno non verrà addebitato sulla sua carta di credito, i cui dati rimangono conservati criptati su server sicuro a garanzia della prenotazione fino al giorno del suo arrivo.<br> Il soggiorno verrà pagato direttamente all\'hotel.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','en','A credit card is required to guarantee your reservation!<br> The amount of the booking will not be billed to your credit card, whose data are stored on a secure server to guarantee your reservation until the day of his arrival. The stay will be paid directly to the hotel.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','fr','Une carte de crédit est nécessaire pour garantir votre réservation! Le montant du séjour sera débité de votre carte de crédit, dont les données sont stockées cryptées sur un serveur sécurisé pour garantir votre réservation jusqu\'à ce que le jour de son arrivée. Le séjour sera payé directement à l\'hôtel.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','de','Wird eine Kreditkarte benötigt, um Ihre Reservierung zu garantieren! Die Menge des Aufenthaltes wird von Ihrer Kreditkarte abgebucht werden, deren Daten auf einem sicheren Server verschlüsselt gespeichert Ihre Reservierung bis zu dem Tag seiner Ankunft zu garantieren. Der Aufenthalt wird direkt im Hotel bezahlt.')");
        //
        $diz77 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SALVA_CARTA_CREDITO')");
        $id_diz77 = $db->insert_id($diz77);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','it','Salva Carta di Credito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','en','Save Credit Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','fr','Sauvegarder la carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','de','Speichern Kreditkarte')");
        //
        $diz78 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CARTA')");
        $id_diz78 = $db->insert_id($diz78);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','it','Carta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','en','Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','fr','Carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','de','Karte')");
        //
        $diz79 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','N_CARTA')");
        $id_diz79 = $db->insert_id($diz79);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','it','Numero carta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','en','Card number')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','fr','numéro de carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','de','Kartennummer')");
        //
        $diz80 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INTESTATARIO')");
        $id_diz80 = $db->insert_id($diz80);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','it','Intestatario')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','en','Accountholder')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','fr','Candidat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','de','Kandidat')");
        //
        $diz81 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCADENZA')");
        $id_diz81 = $db->insert_id($diz81);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','it','Scadenza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','en','Deadline')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','fr','Date limite')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','de','Frist')");
        //
        $diz82 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CODICE')");
        $id_diz82 = $db->insert_id($diz82);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','it','Codice CVV2')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','en','Code CVV2')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','fr','Code CVV2')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','de','Code CVV2')");
        //
        $diz83 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_CARTA')");
        $id_diz83 = $db->insert_id($diz83);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','it','Salvataggio criptato della Carta avvenuto con successo!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','en','Save the encrypted happened Charter successfully!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','fr','Save the crypté est arrivé Charte avec succès!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','de','Speichern Sie die verschlüsselte passiert Charta erfolgreich!')");
        //
        $diz84 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATI_CARTA')");
        $id_diz84 = $db->insert_id($diz84);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','it','Dati Carta di Credito già inseriti!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','en','Credit Card Data already entered!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','fr','Credit Card Data est déjà entré!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','de','Kreditkartendaten bereits eingetragen!')");
        //
        $diz86 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONSENTI_PRIVACY_POLICY')");
        $id_diz86 = $db->insert_id($diz86);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','it','Ho preso visione dell\'informativa privacy e delle <a href=\"javascript:;\" id=\"sblocca_politiche\">politiche di cancellazione</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','en','I have read the privacy policy and the <a href=\"javascript:;\" id=\"sblocca_politiche\">cancellation policies</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche\">conditions d\'annulation</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','de','Ich habe die Datenschutzerklärung und die <a href=\"javascript:;\" id=\"sblocca_politiche\">Stornierungsbedingungen gelesen</a>')");
        //
        $diz87 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONSENTI_PRIVACY_POLICY_SOGGIORNO')");
        $id_diz87 = $db->insert_id($diz87);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','it','Ho preso visione dell\'informativa privacy e delle <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">politiche di cancellazione</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','en','I have read the privacy policy and the <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">cancellation policies</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">conditions d\'annulation</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','de','Ich habe die Datenschutzerklärung und die <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">Stornierungsbedingungen gelesen</a>')");
        //
        $diz88 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NO_REPLAY_EMAIL')");
        $id_diz88 = $db->insert_id($diz88);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','it','Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','en','This email was sent automatically by the software, do not reply to this email!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','fr','Ce courriel a été envoyé automatiquement par le logiciel, ne répond pas à cet email!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','de','Diese E-Mail wurde von der Software automatisch gesendet wird, antworten Sie nicht auf diese E-Mail!')");
        //
        $diz89 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_VAUCHER')");
        $id_diz89 = $db->insert_id($diz89);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','it','Conferma di prenotazione accettata e voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','en','Confirming queuing and vouchers')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','fr','Confirmant les files d\'attente et des bons')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','de','Bestätigen Queuing und Gutscheine')");

        $diz90 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_VAUCHER')");
        $id_diz90 = $db->insert_id($diz90);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','it','Gentile [cliente], confermiamo le sua prenotazione come accettata e la invitiamo a stampare il Voucher riepilogativo come promemoria, che troverà nella landing page dedicata, da presentare alla reception al giorno del suo arrivo!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','en','Dear [cliente], we confirm your reservation as accepted and please print the summary Voucher as a reminder, you will find in the dedicated landing page, to be presented at the reception on the day of his arrival!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','fr','Cher [cliente], nous confirmons votre réservation acceptée et s\'il vous plaît imprimer votre bon de reprise comme un rappel, vous trouverez la page de destination dédiée à être présenté à la réception le jour de son arrivée!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','de','Sehr [cliente], bestätigen wir Ihre Reservierung als angenommen und bitte Ihren Lebenslauf Gutschein als Erinnerung zu drucken, erhalten Sie die Zielseite finden gewidmet am Tag seiner Ankunft an der Rezeption vorgelegt werden!','1')");
       //
        $diz91 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RE_CHAT')");
        $id_diz91 = $db->insert_id($diz91);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','it','Gentile [cliente], hai avuto un messaggio sulla chat della proposta che hai già visionato. Torna alla landing page a te dedicata per visualizzarlo!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','en','Dear [cliente], you had a message on the chat of the proposal you have already viewed. Go back to the landing page dedicated to you to view it!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','fr','Cher [cliente], vous avez eu un message sur le chat de la proposition que vous avez déjà consultée. Retournez à la page de destination qui vous est dédiée pour la voir!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','de','Sehr geehrte [cliente], Sie hatten im Chat eine Nachricht zu dem Angebot, das Sie bereits angesehen haben. Kehren Sie zur Startseite zurück, um sie anzuzeigen!','1')");
           //
        $diz111 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RE_CHAT')");
        $id_diz111 = $db->insert_id($diz111);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','it','Gentile [cliente], hai un messaggio in Chat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','en','Dear [cliente], you have a message in Chat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','fr','Cher [cliente], vous avez un message dans le chat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','de','Sehr geehrter [cliente], Sie haben eine Nachricht im Chat')");

        $diz112 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CARTACREDITOGARANZIA')");
        $id_diz112 = $db->insert_id($diz112);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','it','Carta di Credito a Garanzia')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','en','Credit Card Guarantee')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','fr','Garantie de carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','de','Kreditkartengarantie')");

        $diz1_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ALTERNATIVA')");
        $id_diz1_new = $db->insert_id($diz1_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','it','alternativa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','en','alternative')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','fr','alternative')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','de','alternative')");

        $diz2_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATEALTERNATIVE')");
        $id_diz2_new = $db->insert_id($diz2_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','it','Date alternative')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','en','Alternative dates')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','fr','Dates alternatives')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','de','Alternative Termine')");

        $diz3_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ETA')");
        $id_diz3_new = $db->insert_id($diz3_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','it','Età')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','en','Age')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','fr','âge')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','de','Alter')");

        $diz4_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZI_AGGIUNTIVI')");
        $id_diz4_new = $db->insert_id($diz4_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','it','Servizi Aggiuntivi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','en','Additional services')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','fr','Services supplémentaires')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','de','Zusätzliche Dienste')");

        $diz4X = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZIO')");
        $id_diz4X = $db->insert_id($diz4X);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','it','Servizio')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','en','Service')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','fr','Service')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','de','Dienste')");

        $diz4Y = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CALCOLO')");
        $id_diz4Y = $db->insert_id($diz4Y);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','it','Calcolo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','en','Calculation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','fr','Calcul')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','de','Berechnung')");

        $diz4K = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_SERVIZIO')");
        $id_diz4K = $db->insert_id($diz4K);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','it','Prezzo Servizio')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','en','Price Service')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','fr','Service de prix')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','de','Preis Service')");

        $diz5_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_VOUCHER')");
        $id_diz5_new = $db->insert_id($diz5_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','it','Gentile [cliente]...','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','en','Dear [cliente]...','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','fr','Cher [cliente]...','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','de','Lieber [cliente]...','1')");

        $descr_it = '<p>Gentile <strong>[cliente]</strong>,</p>

                <p>questo buono voucher è stato emesso in riferimento alla vostra richiesta di variazione date del soggiorno da voi prenotato!</p>

                <p>Per verificare la disponibilità e prenotare il suo prossimo soggiorno, la preghiamo di contattarci e di conservare o stampare questo voucher.</p>

                <p>Questo buono potrà essere utilizzato entro e non oltre la data di scadenza, il <b>[datascadenza]</b></p>';

        $descr_en = '<p>Dear <strong>[cliente]</strong>,</p>

                        <p>this voucher has been issued for your booking cancellation request!</p>
                        
                        <p>To check availability and book your next stay, please contact us and keep or print this voucher.</p>

                        <p>This voucher can be used no later than the expiry date, the <b>[datascadenza]</b></p>';

        $descr_fr = '<p>Cher <strong>[cliente]</strong>,</p>

                    <p>ce bon a été émis pour votre demande d\'annulation de réservation!</p>
                    
                    <p>Pour vérifier la disponibilité et réserver votre prochain séjour, veuillez nous contacter et conserver ou imprimer ce bon.</p>
                    
                    <p>Ce bon peut être utilisé au plus tard à la date d\'expiration, la <b>[datascadenza]</b></p>';

        $descr_de = '<p>Sehr geehrter <strong>[cliente]</strong>,</p>

                    <p>Dieser Gutschein wurde für Ihre Buchungsstornierungsanfrage ausgestellt!</p>
                    
                    <p>Um die Verfügbarkeit zu prüfen und Ihren nächsten Aufenthalt zu buchen, kontaktieren Sie uns bitte und bewahren Sie diesen Gutschein auf oder drucken Sie ihn aus.</p>
                    
                    <p>Dieser Gutschein kann spätestens am Ablaufdatum, dem <b>[datascadenza]</b>, verwendet werden.</p>';

        $diz5_new_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_VOUCHER_RECUPERO')");
        $id_diz5_new_bis = $db->insert_id($diz5_new_bis);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','it','".addslashes($descr_it)."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','en','".addslashes($descr_en)."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','fr','".addslashes($descr_fr)."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','de','".addslashes($descr_de)."','1')");

        $diz5_new_tris = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FRASE_RECUPERO_CAPARRA')");
        $id_diz5_new_tris = $db->insert_id($diz5_new_tris);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','it','La caparra è già stata pagata tramite [tipopagamento]<br><br>Il pari importo sarà pienamente ri-utilizzabile entro [datavalidita]','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','en','The deposit has already been paid by [tipopagamento]<br><br>The same amount will be fully re-usable by [datavalidita]','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','fr','L\'acompte a déjà été payé par [tipopagamento]<br><br>Le même montant sera entièrement réutilisable d\'ici le [datavalidita]','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','de','Die Anzahlung wurde bereits von [tipopagamento] bezahlt. <br> <br> Der gleiche Betrag kann bis zum [datavalidita] vollständig wiederverwendet werden.','1')");


        $diz6_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','UNA_TANTUM')");
        $id_diz6_new = $db->insert_id($diz6_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','it','Una tantum')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','en','Lump sum')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','fr','Une fois')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','de','Einmal')");

        $diz7_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','AL_GIORNO')");
        $id_diz7_new = $db->insert_id($diz7_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','it','Al giorno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','en','Per day')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','fr','Par jour')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','de','Pro Tag')");


        $diz7_bis_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','A_PERSONA')");
        $id_diz7_bis_new = $db->insert_id($diz7_bis_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','it','A persona')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','en','Per person')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','fr','Par personne')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','de','Pro Person')");


        $diz8_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_CARTA_CREDITO')");
        $id_diz8_new = $db->insert_id($diz8_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','it','Paga con Carta di Credito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','en','Pay by Credit Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','fr','Payer par carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','de','Zahlen Sie mit Kreditkarte')");

        $diz9_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_PAYPAL')");
        $id_diz9_new = $db->insert_id($diz9_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','it','Paga con PayPal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','en','Pay by PayPal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','fr','Payer par PayPal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','de','Zahlen Sie mit PayPal')");

        $diz10_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_PAYPAL')");
        $id_diz10_new = $db->insert_id($diz10_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','en','Payment successfully saved, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");

        $diz11_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_STRIPE')");
        $id_diz11_new = $db->insert_id($diz11_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','it','Paga con STRIPE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','en','Pay by STRIPE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','fr','Payer par STRIPE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','de','Zahlen Sie mit STRIPE')");

        $diz12_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_STRIPE')");
        $id_diz12_new = $db->insert_id($diz12_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','en','Payment successfully saved, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");


       //
        $diz92 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INFORMATIVA_PRIVACY')");
        $id_diz92 = $db->insert_id($diz92);

        $file_it = BASE_PATH_SITO.'txt_trattamenti/it/trattamento.txt';
        if(file_exists($file_it)){
          $contents_it  = file($file_it);
          $string_it    = implode($contents_it);
          $string_it    = nl2br($string_it);
          $string_it    = addslashes($string_it);
        }
        $file_en = BASE_PATH_SITO.'txt_trattamenti/en/trattamento.txt';
        if(file_exists($file_it)){
          $contents_en  = file($file_en);
          $string_en    = implode($contents_en);
          $string_en    = nl2br($string_en);
          $string_en    = addslashes($string_en);
        }
        $file_fr = BASE_PATH_SITO.'txt_trattamenti/fr/trattamento.txt';
        if(file_exists($file_fr)){
          $contents_fr  = file($file_fr);
          $string_fr    = implode($contents_fr);
          $string_fr    = nl2br($string_fr);
          $string_fr    = addslashes($string_fr);
        }
        $file_de = BASE_PATH_SITO.'txt_trattamenti/de/trattamento.txt';
        if(file_exists($file_de)){
          $contents_de  = file($file_de);
          $string_de    = implode($contents_de);
          $string_de    = nl2br($string_de);
          $string_de    = addslashes($string_de);
        }
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','it','".$string_it."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','en','".$string_en."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','fr','".$string_fr."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','de','".$string_de."','1')");
         //
        $diz93 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NOME')");
        $id_diz93 = $db->insert_id($diz93);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','it','Nome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','en','Name')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','fr','Nom')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','de','Name')");
        //
        $diz94 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','COGNOME')");
        $id_diz94 = $db->insert_id($diz94);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','it','Cognome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','en','Surname')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','fr','Nom de famille')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','de','Nachname')");
        //
        $diz95 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TELEFONO')");
        $id_diz95 = $db->insert_id($diz95);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','it','Telefono')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','en','Phone')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','fr','Téléphone')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','de','Telefon')");
      //
        $diz96 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCADENZA_OFFERTA')");
        $id_diz96 = $db->insert_id($diz96);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','it','La caparra dovrà essere versata entro questa data di scadenza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','en','The deposit must be paid within this expiration date')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','fr','Le dépôt doit être payé à cette date d\'expiration')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','de','Die Kaution ist nach diesem Ablaufdatum zu zahlen')");

        $diz97 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONTO_OFFERTA')");
        $id_diz97 = $db->insert_id($diz97);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','it','Scegli il metodo di pagamento')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','en','Choose payment method')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','fr','Choisissez le mode de paiement')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','de','Zahlungsart auswählen')");

        $diz98 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_CAMERA')");
        $id_diz98 = $db->insert_id($diz98);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','it','Prezzo Camera')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','en','Room Price')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','fr','Prix de la chambre')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','de','Zimmerpreis')");
      //
        $diz99 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATA_RICHIESTA')");
        $id_diz99 = $db->insert_id($diz99);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','it','Data della richiesta:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','en','Date of request:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','fr','Date de la demande:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','de','Datum angefordert:')");
       //
        $diz100 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK3')");
        $id_diz100 = $db->insert_id($diz100);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','it','Clicca e scopri i metodi di pagamento per confermare il tuo soggiorno!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','en','Click and find the payment methods to confirm your stay!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','fr','Cliquez et trouver les moyens de paiement pour confirmer votre séjour!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','de','Klicken Sie auf und die Zahlungsmethoden, um Ihren Aufenthalt zu bestätigen!')");
      //
        $diz101 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RIEPILOGO_OFFERTA')");
        $id_diz101 = $db->insert_id($diz101);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','it','Riepilogo Offerta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','en','Summary Offer')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','fr','Offre sommaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','de','Zusammenfassung Angebot')");
      //
        $diz102 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK4')");
        $id_diz102 = $db->insert_id($diz102);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','it','Raccontaci la tua esperienza in hotel...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','en','Tell us your experience at the hotel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','fr','Donnez-nous votre expérience à l\'hôtel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','de','Teilen Sie uns Ihre Erfahrung im Hotel ...')");
      //
        $diz103 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA_VAUCHER')");
        $id_diz103 = $db->insert_id($diz103);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','it','Vai alla pagina del voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','en','Go to the voucher page')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','fr','Aller à la page de coupons')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','de','Gehen Sie auf die Seite Gutschein')");
      //
        $diz104 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK5')");
        $id_diz104 = $db->insert_id($diz104);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','it','Stampa il voucher e ricordati di portarlo con te in hotel...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','en','Print the voucher and remember to take with you at the hotel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','fr','Imprimer le coupon et souvenez-vous de l\'apporter avec vous à l\'hôtel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','de','Drucken Sie den Gutschein und denken Sie daran, es zu bringen Sie zum Hotel ...')");
      //
        $diz105 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA_CHAT')");
        $id_diz105 = $db->insert_id($diz105);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','it','Leggi la nostra proposta...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','en','Read our proposal ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','fr','Lire notre proposition ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','de','Lesen Sie unseren Vorschlag ...')");
     //
        $diz106 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK6')");
        $id_diz106 = $db->insert_id($diz106);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','it','Clicca qui per vedere il messaggio sulla tua chat!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','en','Click here to see the message on your chat!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','fr','Cliquez ici pour voir le message sur votre chat!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','de','Klicken Sie hier, um die Nachricht in Ihrem Chat zu sehen!')");
     //
        $diz107 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ANCORA_DOMANDE')");
        $id_diz107 = $db->insert_id($diz107);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','it','Hai ancora delle domande da farci?')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','en','You still have questions for us?')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','fr','Vous avez encore des questions pour nous?')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','de','Sie haben noch Fragen an uns?')");
     //
        $diz108 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCRIVICI_SE_HAI_BISOGNO')");
        $id_diz108 = $db->insert_id($diz108);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','it','Scrivici se hai bisogno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','en','Write to us if you need')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','fr','Écrivez-nous si vous avez besoin')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','de','Schreiben Sie uns, wenn Sie brauchen')");
     //
        $diz109 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONTO_CARTA')");
        $id_diz109 = $db->insert_id($diz109);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','it','Verrà prelevata la caparra in caso di mancanto rispetto delle politiche di cancellazione!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','en','The down payment will be charged in case of lack of compliance with the cancellation policies!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','fr','Le dépôt sera prise en cas de non-respect des conditions d\'annulation!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','de','Die Kaution wird im Falle eines Ausfalls getroffen werden mit Stornierungsbedingungen zu erfüllen!')");
    //
        $diz110 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INVIA_GIUDIZI')");
        $id_diz110 = $db->insert_id($diz110);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','it','Inviaci i tuoi giudizi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','en','Send us your feedback')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','fr','Envoyez-nous vos commentaires')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','de','Senden Sie uns Ihr Feedback')");
        //
        $diz120 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING')");
        $id_diz120 = $db->insert_id($diz120);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','de','Willkommen')");
        //
        $diz121 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING')");
        $id_diz121 = $db->insert_id($diz121);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>La cortesia, la disponibilità e la premura del nostro staff, ci auguriamo siano una meravigliosa scoperta.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>Courtesy, availability and care of our staff, we hope will be a wonderful discovery.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement.<br>La courtoisie, la serviabilité et la gentillesse de notre personnel, nous espérons être une merveilleuse découverte.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','de','Lieber [cliente], willkommen zu unserer Unterkunft. <br>Höflichkeit, Verfügbarkeit und Betreuung unserer Mitarbeiter, wir hoffen, ein wunderbarer Fund sein.','1')");
        //


        $diz120_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RECENSIONE')");
        $id_diz120_bis = $db->insert_id($diz120_bis);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','it','Dopo essere stato nostro ospite, le chiediamo una sua recensione su TripAdvisor sulla nostra struttura ricettiva!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','en','After being our guest, we ask for your review on TripAdvisor on our accommodation!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','fr','Après avoir été notre invité, nous vous demandons votre avis sur TripAdvisor sur notre hébergement!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','de','Nachdem wir unser Gast waren, bitten wir Sie um Ihre Bewertung auf TripAdvisor für unsere Unterkunft!')");
        //
        $diz121_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RECENSIONE')");
        $id_diz121_bis = $db->insert_id($diz121_bis);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','it','Gentile [cliente], vorremmo invitarti a lasciare una recensione su TripAdvisor, esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura! Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','en','Dear [cliente], we would like to invite you to leave a review on TripAdvisor, express your opinion on the stay you have just spent at our facility! Your thought will be an indispensable source for us to improve our services in the Hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','fr','Cher [cliente], nous aimerions vous inviter à laisser un avis sur TripAdvisor, exprimer votre opinion sur le séjour que vous venez de passer dans notre établissement! Votre pensée sera une source indispensable pour nous d\'améliorer nos services dans l\'hôtel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','de','Sehr geehrter [cliente], wir möchten Sie einladen, eine Bewertung auf TripAdvisor abzugeben und Ihre Meinung zu dem Aufenthalt zu äußern, den Sie gerade in unserer Einrichtung verbracht haben! Ihr Gedanke wird für uns eine unverzichtbare Quelle sein, um unsere Dienstleistungen im Hotel zu verbessern.','1')");



        $diz125 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESEND_CONFERMA')");
        $id_diz125 = $db->insert_id($diz125);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','it','Ricorda di confermare la prenotazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','en','Remember to confirm the reservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','fr','Rappelez-vous de confirmer la réservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','de','Denken Sie daran, die Reservierung zu bestätigen')");
        //
        $diz126 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESEND_CONFERMA')");
        $id_diz126 = $db->insert_id($diz126);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','it','Gentile [cliente], si sta avvicinando la data di scadenza per il versamento della caparra, le ricordiamo che per confermare la sua prenotazione come accettata, deve effettuare il pagamento della caparra o dare il numero di carta di credito a garanzia.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','en','Dear [cliente],  is approaching the expiration date for the payment of the deposit, remember to confirm your reservation as accepted, you must pay the deposit or give your credit card number to guarantee.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','fr','Cher [cliente],  se rapproche de la date d\'expiration pour le paiement de la caution, rappelez-vous pour confirmer votre réservation comme acceptée, doit effectuer le paiement du dépôt ou de donner votre numéro de carte de crédit pour garantir.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','de','Lieber [cliente],  wird das Ablaufdatum für die Zahlung der Kaution nähern, denken Sie daran Ihre Reservierung zu bestätigen, wie angenommen, muss die Zahlung der Kaution zu machen oder Ihre Kreditkartennummer geben zu gewährleisten.','1')");
        //
        $diz127 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RECALL_PREVENTIVI')");
        $id_diz127 = $db->insert_id($diz127);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','it','Ciao [cliente], ricorda di visualizzare la nostra proposta di soggiorno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','en','Hi [cliente], remember to see our proposal to stay')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','fr','Bonjour [cliente], rappelez-vous de montrer notre séjour proposé')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','de','Hallo [cliente], erinnern uns vorgeschlagenen Aufenthalt zu zeigen')");
        //
        $diz128 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RECALL_PREVENTIVI')");
        $id_diz128 = $db->insert_id($diz128);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','it','Gentile [cliente], si sta avvicinando la data di scadenza per la proposta di soggiorno, le ricordiamo che rimarrà valida ancora per poco. Non si faccia sfuggire questa grande opportunità!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','en','Dear [cliente], you are approaching the expiration date for the proposed stay, remember to remain valid for a short while. Do not face out on this great opportunity!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','fr','Cher [cliente], se rapproche de la date d\'expiration pour le séjour proposé, nous vous rappelons qu\'il restera valable pendant une courte période. Ne pas faire face à cette grande opportunité!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','de','Lieber [cliente], wird das Ablaufdatum für die geplante Aufenthalt nähern wir Sie daran erinnern, dass es für eine kurze Zeit gültig bleiben. Sie stehen nicht auf diese große Chance heraus!','1')");
        //
        $diz129 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELGO_VAGLIA')");
        $id_diz129 = $db->insert_id($diz129);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','it','Scelgo il pagamento con Vaglia')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','en','I choose payment by money order')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','fr','Je choisis de payer par mandat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','de','Ich wähle von Geld zu zahlen')");
        //
        $diz130 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_VAGLIA')");
        $id_diz130 = $db->insert_id($diz130);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','it','Scelta salvata con successo, rimaniamo in attesa del Fax o della Email con ricevuta di pagamento, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','en','Choosing saved successfully, we are waiting for the Fax or Email with proof of payment, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','fr','Choisir correctement enregistré, nous attendons le fax ou e-mail avec la preuve de paiement, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','de','Erfolgreich gespeichert Aussuchen, wir sind für das Fax oder E-Mail mit Zahlungsnachweis warten, beachten Sie bitte folgende Bestätigung Gutschein')");
        //
        $diz131 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELGO_BONIFICO')");
        $id_diz131 = $db->insert_id($diz131);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','it','Scelgo il pagamento con Bonifico')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','en','I choose to pay by bank transfer')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','fr','Je choisis de payer par virement bancaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','de','Ich wähle per Banküberweisung zu bezahlen')");
        //
        $diz132 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_BONIFICO')");
        $id_diz132 = $db->insert_id($diz132);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','it','Scelta salvata con successo, rimaniamo in attesa del Fax o della Email con numero di CRO o ricevuta di pagamento, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','en','Choosing saved successfully, we remain waiting for the Fax or Email with CRO number or proof of payment, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','fr','Choisir correctement enregistré, nous restons en attente de fax ou e-mail avec le numéro CRO ou une preuve de paiement, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','de','Erfolgreich gespeichert Aussuchen, bleiben wir für das Fax oder E-Mail mit CRO Nummer oder Nachweis über die Zahlung warten, beachten Sie bitte folgende Bestätigung Gutschein')");
        //
        $diz133 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_FAMILY')");
        $id_diz133 = $db->insert_id($diz133);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','de','Willkommen')");
        //
        $diz134 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_FAMILY')");
        $id_diz134 = $db->insert_id($diz134);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Per capire la differenza, basta pensare che i nostri ospiti più importanti sono i bambini.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>To understand the difference, just think that our most important guests are children.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement.<br>Pour comprendre la différence, il suffit de penser que nos clients les plus importants sont des enfants.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','de','Lieber [cliente], willkommen zu unserer Unterkunft.<br>Um den Unterschied zu verstehen, man denke nur, dass unsere wichtigsten Gäste sind Kinder.','1')");
        //
        $diz135 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_BUSINESS')");
        $id_diz135 = $db->insert_id($diz135);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','de','Willkommen')");
        //
        $diz136 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_BUSINESS')");
        $id_diz136 = $db->insert_id($diz136);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Scopri come sia facile da noi ritrovare gli stessi comfort del tuo ufficio.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>Discover how easy we find the same comfort of your office.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement. <br> Découvrez comment facile nous trouvons le même confort de votre bureau.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','de','Lieber [cliente], willkommen in unserer Unterkunft. <br> Entdecken Sie, wie einfach wir den gleichen Komfort von Ihrem Büro finden.','1')");
        //
        $diz137 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_BENESSERE')");
        $id_diz137 = $db->insert_id($diz137);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','de','Willkommen')");
        //
        $diz138 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_BENESSERE')");
        $id_diz138 = $db->insert_id($diz138);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Una esperienza di soggiorno pensata esclusivamente per la cura e il benessere del tuo corpo.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>A living experience designed exclusively for the care and well-being of your body.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement. <br>Avec une expérience de séjour conçu exclusivement pour les soins et le bien-être de votre corps.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','de','Lieber [cliente], willkommen zu unserer Unterkunft. <br>Bei einem Aufenthalt Erfahrung ausschließlich für die Pflege und das Wohlbefinden des Körpers.','1')");
        //
        $diz139 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_SPORT')");
        $id_diz139 = $db->insert_id($diz139);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','de','Willkommen')");
        //
        $diz140 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_SPORT')");
        $id_diz140 = $db->insert_id($diz140);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>L\'hotel è organizzato appositamente per i ciclisti e tutti gli sportivi in genere.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>The hotel is specially organized for bikers and all sports in general.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement.<br> L\'hôtel est spécialement organisé pour les cyclistes et tous les sports en général.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','de','Lieber  [cliente], willkommen zu unserer Unterkunft.<br> Das Hotel ist speziell für Motorradfahrer organisiert und alle Sportarten im Allgemeinen.','1')");
        //
        $diz141 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_CHECKIN')");
        $id_diz141 = $db->insert_id($diz141);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','it','Gentile [cliente], compila il tuo Check-in Online')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','en','Dear [cliente], fill out your Online Check-In')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','fr','Cher [cliente], remplissez votre enregistrement en ligne')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','de','Lieber [cliente], füllen Sie Ihre Online-Check-In')");
        //
        $diz142 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_CHECKIN')");
        $id_diz142 = $db->insert_id($diz142);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','it','Gentile [cliente], ansiosi di riceverla presso la nostra struttura ricettiva, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà compilare il modulo di Check-in Online, velocizzando così le procedure d\'ingresso in hotel al momento del suo arrivo!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','en','Dear [cliente], anxious to receive it at our accommodation, please click on the link at the bottom in the mail in a few minutes will be able to complete the Online Check-In form, thus speeding up of procedures at the hotel entrance to upon his arrival!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','fr','Cher [cliente], désireux de le recevoir à notre hébergement, s\'il vous plaît cliquer sur le lien en bas dans le courrier en quelques minutes sera en mesure de remplir le formulaire enregistrement en ligne, accélérant ainsi des procédures à l\'entrée de l\'hôtel pour à son arrivée!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','de','Lieber [cliente], besorgt es bei unserer Unterkunft zu erhalten, klicken Sie bitte auf dem Link unten in der E-Mail in wenigen Minuten in der Lage, das Online-Check-In Formular ausfüllen, damit von Verfahren am Hoteleingang beschleunigt zu bei seiner Ankunft!','1')");
        //
        $diz143 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK7')");
        $id_diz143 = $db->insert_id($diz143);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','it','Clicca qui per raggiungere il modulo del Check-in Online!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','en','Click here to reach the form of Online Check-In!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','fr','Cliquez ici pour accéder au formulaire de ligne d\'arrivée!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','de','Klicken Sie hier, um die Form des Online-Check-In zu erreichen!')");
        //
        $diz144 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA_CHECKIN')");
        $id_diz144 = $db->insert_id($diz144);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','it','Pagina riservata al tuo Check-in Online')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','en','Page reserved to your Online Check-In')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','fr','Page réservée à votre enregistrement en ligne')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','de','Seite reserviert Ihre Online-Check-In')");

        $diz145 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_DISDETTA')");
        $id_diz145 = $db->insert_id($diz145);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','it','Gentile [cliente], la sua prenotazione è stata disdetta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','en','Dear [cliente], your reservation has been canceled')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','fr','Cher [cliente], votre réservation a été annulée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','de','Lieber [cliente], um Ihre Reservierung wird storniert')");
        //
        $diz146 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_DISDETTA')");
        $id_diz146 = $db->insert_id($diz146);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','it','Gentile [cliente], abbiamo disdetto&nbsp;la sua prenotazione Nr. [NumeroPrenotazione], come da sua richiesta!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','en','Dear [cliente], we canceled your reservation Nr. [NumeroPrenotazione], at his request!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','fr','Cher [cliente], nous avons annul&eacute; votre r&eacute;servation Nr. [NumeroPrenotazione], &agrave; sa demande!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','de','Lieber [cliente], storniert wir Ihre Reservierung Nr. [NumeroPrenotazione], auf seinen Wunsch!','1')");

        $diz147 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_DISPONIBILITA')");
        $id_diz147 = $db->insert_id($diz147);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','it','Gentile [cliente], per la sua richiesta di soggiorno non abbiamo disponibilità')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','en','Dear [cliente], we do not have availability for your stay request')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','fr','Cher [cliente], nous n\'avons pas la disponibilité pour votre demande de séjour')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','de','Lieber [cliente], wir haben keine Verfügbarkeit für Ihren Aufenthalt')");
        //
        $diz148 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_DISPONIBILITA')");
        $id_diz148 = $db->insert_id($diz148);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','it','Gentile [cliente], per le date scelte purtroppo non abbiamo disponibilità presso la nostra struttura ricettiva. Se volesse riformulare una richiesta di preventivo dal nostro sito:[sito], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','en','Dear [cliente], for the dates chosen unfortunately we do not have availability at our accommodation. If you would like to reformulate a quote from our website: [sito], diversifying your stay dates, we would be happy to offer you our best proposal!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','fr','Cher [cliente], pour les dates choisies malheureusement nous n\'avons pas la disponibilité dans notre hébergement. Si vous souhaitez reformuler une citation de notre site: [sito], en diversifiant vos dates de séjour, nous serions heureux de vous proposer notre meilleure proposition!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','de','Lieber [cliente], für die gewählten Daten haben wir leider keine Verfügbarkeit in unserer Unterkunft. Wenn Sie ein Angebot von unserer Website umformulieren möchten: [sito], um Ihre Aufenthaltsdaten zu diversifizieren, würden wir uns freuen, Ihnen unseren besten Vorschlag zu unterbreiten!','1')");

        $diz149 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPARRA')");
        $id_diz149 = $db->insert_id($diz149);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','it','Caparra richiesta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','en','Deposit required')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','fr','Dépôt requis')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','de','Kaution erforderlich')");

        $diz150 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELTAPROPOSTA')");
        $id_diz150 = $db->insert_id($diz150);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','it','Scelta della proposta di soggiorno, inviata con successo!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','en','Choice of stay proposal, sent successfully!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','fr','Choix de la proposition de séjour, envoyé avec succès!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','de','Wahl des Aufenthaltsvorschlags, erfolgreich gesendet!')");

        $diz151 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELTAPROPOSTA2')");
        $id_diz151 = $db->insert_id($diz151);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','it','Ora puoi chiudere la pagina ed attendere la prossima e-mail dall\'Hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','en','Now you can close the page and wait for the next e-mail from the Hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','fr','Vous pouvez maintenant fermer la page et attendre le prochain e-mail de l\'hôtel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','de','Jetzt können Sie die Seite schließen und auf die nächste E-Mail vom Hotel warten!')");

        $diz152 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELTAPROPOSTAFATTA')");
        $id_diz152 = $db->insert_id($diz152);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','it','La proposta di soggiorno è già stata precedentemente scelta, non è possibile re-inviarla!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','en','The stay proposal has already been previously chosen, it is not possible to re-send it!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','fr','La proposition de séjour a déjà été choisie, il n\'est pas possible de la renvoyer!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','de','Der Aufenthaltsvorschlag wurde bereits vorher gewählt, es ist nicht möglich ihn erneut zu senden!')");

        $diz153 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCONTO')");
        $id_diz153 = $db->insert_id($diz153);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','it','Sconto')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','en','Discount')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','fr','Réduction')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','de','Rabatt')");

        $diz154 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONDIZIONI_TARIFFA')");
        $id_diz154 = $db->insert_id($diz154);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','it','Condizioni tariffa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','en','Tariff conditions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','fr','Conditions tarifaires')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','de','Tarifbedingungen')");


        $diz155 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCETTO_POLITICHE')");
        $id_diz155 = $db->insert_id($diz155);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','it','Accetto le politiche di cancellazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','en','I accept the cancellation policy')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','fr','J\'accepte les conditions d\'annulation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','de','Ich akzeptiere die Stornobedingungen')");

        $diz156 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','LEGGI_POLITICHE')");
        $id_diz156 = $db->insert_id($diz156);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','it','Leggi le politiche')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','en','Read the policies')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','fr','Lire les politiques')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','de','Lesen Politik')");

        $diz157 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONDIZIONI')");
        $id_diz157 = $db->insert_id($diz157);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','it','Condizioni')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','en','Conditions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','fr','Conditions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','de','Geschäftsbedingungen')");


        $diz158 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VISUALIZZA')");
        $id_diz158 = $db->insert_id($diz158);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','it','Visualizza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','en','View')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','fr','Vue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','de','Ansicht')");

        $diz159 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NASCONDI')");
        $id_diz159 = $db->insert_id($diz159);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','it','Nascondi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','en','Hide')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','fr','Cacher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','de','Verstecken')");

        $diz160 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONVERSAZIONE')");
        $id_diz160 = $db->insert_id($diz160);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','it','la conversazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','en','the conversation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','fr','la conversation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','de','die Konversation')");

        $diz161 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM')");
        $id_diz161 = $db->insert_id($diz161);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','it','il Form di Prenotazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','en','the Booking Form')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','fr','le formulaire de réservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','de','das Buchungsformular')");

        $diz162 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PRENOTA_OFFERTA')");
        $id_diz162 = $db->insert_id($diz162);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','it','PRENOTA ORA LA TUA OFFERTA PERSONALIZZATA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','en','BOOK YOUR CUSTOM OFFER NOW')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','fr','RÉSERVEZ VOTRE OFFRE SPÉCIALE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','de','BUCHEN SIE IHR ANGEBOT JETZT')");

        $diz163 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MAPPA')");
        $id_diz163 = $db->insert_id($diz163);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','it','Mappa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','en','Map')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','fr','Carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','de','Karte')");

        $diz164 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ARRIVO')");
        $id_diz164 = $db->insert_id($diz164);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','it','ARRIVO')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','en','ARRIVAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','fr','ARRIVÉE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','de','ANREISE')");

        $diz165 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PARTENZA')");
        $id_diz165 = $db->insert_id($diz165);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','it','PARTENZA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','en','DEPARTURE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','fr','DEPARTURE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','de','ABFAHRT')");

        $diz166 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PERSONE')");
        $id_diz166 = $db->insert_id($diz166);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','it','PERSONE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','en','PEOPLE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','fr','GENS')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','de','MENSCHEN')");

        $diz167 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAMERE')");
        $id_diz167 = $db->insert_id($diz167);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','it','CAMERE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','en','ROOMS')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','fr','CHAMBRES')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','de','ZIMMER')");

        $diz168 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TRATTAMENTO')");
        $id_diz168 = $db->insert_id($diz168);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','it','TRATTAMENTO')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','en','TREATMENT')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','fr','TRAITEMENT')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','de','BEHANDLUNG')");

        $diz169 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_TOTALE')");
        $id_diz169 = $db->insert_id($diz169);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','it','PREZZO TOTALE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','en','TOTAL PRICE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','fr','PRIX TOTAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','de','GESAMTPREIS')");

        $diz170 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','QUANTITA')");
        $id_diz170 = $db->insert_id($diz170);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','it','QUANTITA\'')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','en','QUANTITY')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','fr','QUANTITÉ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','de','MENGE')");

        $diz171 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_UNITARIO')");
        $id_diz171 = $db->insert_id($diz171);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','it','PREZZO UNITARIO')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','en','UNIT PRICE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','fr','PRIX UNITAIRE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','de','Einheitspreis')");

        $diz172 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SUBTOTALE')");
        $id_diz172 = $db->insert_id($diz172);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','it','SUBTOTALE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','en','SUBTOTAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','fr','SUBTOTAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','de','SUBTOTAL')");

        $diz173 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PRENOTA_SUBITO')");
        $id_diz173 = $db->insert_id($diz173);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','it','PRENOTA SUBITO QUESTA OFFERTA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','en','BOOK THIS OFFER IMMEDIATELY')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','fr','RÉSERVEZ CETTE OFFRE IMMÉDIATEMENT')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','de','BUCHEN SIE DIESES ANGEBOT SOFORT')");

        $diz174 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPARRA_RICHIESTA')");
        $id_diz174 = $db->insert_id($diz174);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','it','Caparra richiesta:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','en','Deposit required:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','fr','Dépôt requis:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','de','Anzahlung erforderlich:')");

        $diz175 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONSENSOMARKETING')");
        $id_diz175 = $db->insert_id($diz175);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','it','Do il consenso per ricevere materiale marketing')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','en','I consent to receive marketing material')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','fr','Je consens à recevoir du matériel de marketing')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','de','Ich bin damit einverstanden, Marketingmaterial zu erhalten')");

        $diz178 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONSENSOPROFILAZIONE')");
        $id_diz178 = $db->insert_id($diz178);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','it','Voglio ricevere solo le offerte in linea con le preferenze che ho indicato')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','en','I only want to receive offers in line with the preferences I have indicated')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','fr','Je veux seulement recevoir des offres conformes aux préférences que j\'ai indiquées')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','de','Ich möchte nur Angebote erhalten, die den von mir angegebenen Präferenzen entsprechen')");

        $diz179 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTAPAGAMENTOSCELTO')");
        $id_diz179 = $db->insert_id($diz179);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','it','La Proposta è già stata confermata con un altro tipo di pagamento!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','en','The proposal has already been confirmed with another type of payment!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','fr','La proposition a déjà été confirmée avec un autre type de paiement!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','de','Der Vorschlag wurde bereits mit einer anderen Zahlungsart bestätigt!')");

        $diz180 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGAMENTOSCELTO')");
        $id_diz180 = $db->insert_id($diz180);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','it','Proposta confermata tramite pagamento con')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','en','Proposal confirmed by payment with')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','fr','Proposition confirmée par paiement avec')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','de','Vorschlag durch Zahlung bestätigt mit')");

        
 ### RESPONSEFORM
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_NOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Name')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Name')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_COGNOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Cognome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Surname')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Prenom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachname')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_EMAIL')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Email')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TELEFONO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Telefono')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Phone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Telephone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Telefon')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ARRIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Arrivo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Arrival date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ankunft')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_PARTENZA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Partenza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Departure date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Abreisedatum')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ARRIVO_ALTERNATIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Arrivo alternativo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Arrival')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Ankunft')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_PARTENZA_ALTERNATIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Partenza alternativa')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Departure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Abreisedatum')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TOTALE_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Totale Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Total Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Total Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Total Erwachsene')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TOTALE_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Totale Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Total Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Total Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Total Kinder')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Erwachsene')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Kinder')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_BAMBINI_ETA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Età')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Age')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Age')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Jahre')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_SISTEMAZIONE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Rooms')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Chambre')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zimmer')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TRATTAMENTO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Trattamento')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Treatment')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Categorie')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Behandlung')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TARGET')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia vacanza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Target vacation')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Vacances ciblées')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zielurlaub')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_MESSAGGIO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Messaggio')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachricht')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_H1')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta informazioni!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Information request!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande d\'information!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Informationen anfordern!')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_OGGETTO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta Informazioni per il sito: [sito] da parte di: [nome]')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Request Information for the site: [sito] by: [nome]')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande d\'informations pour le site: [sito] par [nome]')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Fordern Sie Informationen für die Website an: [sito] Von: [nome]')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_SUCCESSO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta Inviata con Successo!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Successfully Received Inquiry!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande reçue avec succès!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Anfrage erfolgreich gesendet!')");


        ### FORM
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TARGET')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia vacanza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Target vacation')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Vacances ciblées')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zielurlaub')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_LEGENDA_VACANZA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Scegli il tipo o il motivo della tua vacanza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Choose the type or the reason for your holiday')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Choisissez le type ou la raison de vos vacances')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Wählen Sie die Art oder den Grund für Ihren Urlaub')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_COMUNICAZIONI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Qualcosa da comunicarci')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Something to tell us')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Quelque chose à nous dire')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Etwas zu erzählen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TUO_SOGGIORNO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Dati del soggiorno')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Your stay data')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Vos données de séjour')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ihre Aufenthaltsdaten')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_DATE_SOGGIORNO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Date del soggiorno')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Dates of stay')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Dates de séjour')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Daten des Aufenthalts')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_DATI_PERSONALI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Dati personali')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Personal data')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Données personnelles')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Persönliche Daten')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TEAXT_LOADER')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Qualche istante.... Sta per apparire il MODULO di richiesta informazioni dedicato al <b>CRM QUOTO</b>!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','A few moments .... The information request form dedicated to <b>CRM QUOTO</b> is about to appear!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Quelques instants .... Le formulaire de demande d\'informations dédié à <b>CRM QUOTO</b> est sur le point d\'apparaître!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ein paar Augenblicke ... Das Informationsanforderungsformular für <b>CRM QUOTO</b> ist in Kürze verfügbar!')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_NOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Name')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Name')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_COGNOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Cognome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Surname')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Prenom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachname')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_EMAIL')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Email')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TELEFONO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Telefono')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Phone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Telephone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Telefon')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ARRIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Arrivo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Arrival date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ankunft')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_PARTENZA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Partenza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Departure date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Abreisedatum')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ARRIVO_ALTERNATIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Arrivo alternativo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Arrival')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Ankunft')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_PARTENZA_ALTERNATIVA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Partenza alternativa')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Departure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Abreisedatum')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TOTALE_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nr.Totale Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Nr.Total Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nr.Total Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nr.Total Erwachsene')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TOTALE_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nr.Totale Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Nr.Total Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nr.Total Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nr.Total Kinder')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_SISTEMAZIONE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Type of room')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Type de chambre')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zimmertyp')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CAMERE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Camere')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Rooms')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Chambres')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zimmer')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TRATTAMENTO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Trattamento')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Treatment')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Categorie')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Behandlung')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Erwachsene')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Kinder')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_BAMBINI_ETA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Età: 1,3 mesi,<1')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Age: 1,3 months,<1')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Age: 1,3 mois,<1')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alter: 1,3 Monate,<1')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_LEGENDA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Scegli e/o aggiungi il trattamento e distribuisci i partecipanti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Choose and/or add the treatment and distribute the participants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Choisissez et/ou ajoutez le traitement et répartissez les participants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Wählen und/oder fügen Sie die Behandlung hinzu und verteilen Sie die Teilnehmer')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ADD_DATE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','aggiungi date alternative')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','add alternative dates')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','ajouter des dates alternatives')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','alternative Termine hinzufügen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_REM_DATE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','elimina date alternative')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','delete alternative dates')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','supprimer des dates alternatives')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','alternative Termine löschen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ADD_ROOM')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','aggiungi camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','add room')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','ajouter de la place')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','raum hinzufügen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_REM_ROOM')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','rimuovi camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','remove room')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','retirer la pièce')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','zimmer entfernen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_MESSAGGIO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Messaggio')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachricht')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_INVIA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Invia Richiesta')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Send Request')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Envoyer demande')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Anfrage senden')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CONSENSO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Ho preso visione dell\'informativa privacy - ')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','I have read the privacy policy - ')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','J\'ai lu la politique de confidentialité - ')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ich habe die Datenschutzerklärung gelesen - ')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_LINK_INFORMATIVA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Visualizza Informativa')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','View Information')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Voir les informations')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Informationen anzeigen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CONSENSO2')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Do il consenso per ricevere materiale marketing')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','I consent to receive marketing material')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','J\'accepte de recevoir du matériel de marketing')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ich bin damit einverstanden, Marketingmaterial zu erhalten')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CONSENSO3')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Voglio ricevere le offerte in linea con le preferenze che ho indicato')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','I want to receive offers in line with the preferences I have indicated')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Je veux recevoir des offres conformes aux préférences que j\'ai indiquées')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ich möchte Angebote erhalten, die den von mir angegebenen Präferenzen entsprechen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_PRIVACY')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Inserire informativa su SuiteWeb')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Inserire informativa su SuiteWeb')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Inserire informativa su SuiteWeb')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Inserire informativa su SuiteWeb')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_SUCCESSO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta Inviata con Successo!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Successfully Received Inquiry!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande reçue avec succès!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Anfrage erfolgreich gesendet!')");



        $descr_select_tipo_camere .= 'Nel box select del campo TIPO CAMERE in CREA NUOVA PROPOSTA'."\r\n";
        $descr_select_tipo_camere .= 'Impostando il valore : '."\r\n";
        $descr_select_tipo_camere .= '0 = default'."\r\n";
        $descr_select_tipo_camere .= '1 = select con ricerca integrata'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','select_tipo_camere','".$descr_select_tipo_camere."','0')");
        #
        $descr_checkemail_verify .= 'Check per avere il controllo email tramite record MX'."\r\n";
        $descr_checkemail_verify .= 'Impostando il valore : '."\r\n";
        $descr_checkemail_verify .= '0 = il controllo non viene fatto'."\r\n";
        $descr_checkemail_verify .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_verify_email','".$descr_checkemail_verify."','1')");

        $descr_pagination .= 'Check per avere il ritorno alla pagina selezionata dopo una modifica'."\r\n";
        $descr_pagination .= 'Impostando il valore : '."\r\n";
        $descr_pagination .= '0 = il controllo non viene fatto'."\r\n";
        $descr_pagination .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_pagination','".$descr_pagination."','1')");

        $descr_paypal .= 'Check per avere la possibilità di pagare tramite PayPal'."\r\n";
        $descr_paypal .= 'Impostando il valore : '."\r\n";
        $descr_paypal .= '0 = il controllo non viene fatto'."\r\n";
        $descr_paypal .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_paypal','".$descr_paypal."','1')");

        $descr_gateway .= 'Check per avere la ppossibilità di pagare tramite Gateway Bancario'."\r\n";
        $descr_gateway .= 'Impostando il valore : '."\r\n";
        $descr_gateway .= '0 = il controllo non viene fatto'."\r\n";
        $descr_gateway .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_gateway_bancario','".$descr_gateway."','0')");

        $descr_virtualpay .= 'Check per avere la possibilità di pagare tramite Virtual Pay'."\r\n";
        $descr_virtualpay .= 'Impostando il valore : '."\r\n";
        $descr_virtualpay .= '0 = il controllo non viene fatto'."\r\n";
        $descr_virtualpay .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_virtualpay','".$descr_virtualpay."','0')");


        $descr_notifiche .= 'Check per abiltare o disabilitare le notifiche in push'."\r\n";
        $descr_notifiche .= 'Impostando il valore : '."\r\n";
        $descr_notifiche .= '0 = notifiche si NON vedono'."\r\n";
        $descr_notifiche .= '1 = notifiche si vedono'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_notifiche_push','".$descr_notifiche."','1')");

        $descr_box .= 'Impostazioni per box servizi aggiuntivi'."\r\n";
        $descr_box .= 'Impostando il valore : '."\r\n";
        $descr_box .= '0 = il box dei servizi aggiuintivi parte da chiuso'."\r\n";
        $descr_box .= '1 = il box dei servizi aggiuintivi parte da aperto'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_open_servizi','".$descr_box."','1')");

        $descr_stripe .= 'Check per avere la possibilità di pagare tramite STRIPE'."\r\n";
        $descr_stripe .= 'Impostando il valore : '."\r\n";
        $descr_stripe .= '0 = il controllo non viene fatto'."\r\n";
        $descr_stripe .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_stripe','".$descr_stripe."','1')");

        #inserimento di default di una lista_newsletter
        $db->query("INSERT INTO hospitality_smtp(idsito,SMTPAuth,SMTPHost,SMTPPort,SMTPSecure,SMTPUsername,SMTPPassword,NumberSend,Abilitato) VALUES('".IDSITO."','true','pro.eu.turbo-smtp.com','587','','info@network-service.it','SjMSUrxL','300','1')");


        $oggetto_covid19_it = 'Emesso Buono Voucher per [cliente] in riferimento Nr.Prenotazione [numeropreno]';
        $oggetto_covid19_en = 'Voucher issued for [cliente] reference No. Reservation [numeropreno]';
        $oggetto_covid19_fr = 'Bon émis pour le numéro de référence [cliente] Réservation [numeropreno]';
        $oggetto_covid19_de = 'Gutschein ausgestellt für [cliente] Referenznummer Reservierung [numeropreno]';
        
        $descr_covid19_it = '<p>Gentile <strong>[cliente]</strong>,</p>
        
                                <p>siamo sinceramente dispiaciuti per la cancellazione della sua prenotazione Nr. <strong>[numeropreno]</strong>, in conseguenza dell&rsquo;emergenza dovuta al virus COVID-19.</p>
        
                                <p>In conformit&agrave; a quanto previsto dall&#39;articolo 88 del decreto-legge n. 18 del 2020 e dell&#39;articolo 28 del decreto-legge n. 9 del 2020, le inviamo un voucher del valore di &euro; [caparra], che potr&agrave; utilizzare entro un anno dalla data di emissione.</p>
        
                                <p>Le condizioni applicabili sono le seguenti:&nbsp;</p>
        
                                <ul>
                                        <li>il voucher non &egrave; cedibile, e pu&ograve; essere quindi utilizzato solo dal beneficiario</li>
                                        <li>il voucher &egrave; cedibile e pu&ograve; quindi essere utilizzato da soggetti da lei indicati</li>
                                        <li>l&rsquo;importo non &egrave; frazionabile e deve pertanto essere utilizzato per un unico periodo di soggiorno</li>
                                        <li>l&rsquo;importo &egrave; frazionabile e quindi utilizzabile per pi&ugrave; soggiorni</li>
                                </ul>
        
                                <p>Per verificare la disponibilit&agrave; e prenotare il suo prossimo soggiorno, la preghiamo di contattarci su <strong>[emailhotel]</strong> indicando il numero del voucher e le date in cui desidera soggiornare.</p>
        
                                <p>Non vediamo l&#39;ora di darle il benvenuto</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>CLICCA SUL LINK PER VISUALIZZARE E&nbsp;STAMPARE IL VOUCHER</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p style="text-align: center;">&nbsp;</p>
        
                                <p>Cordiali saluti</p>
        
                                <p><strong>[struttura]</strong></p>';
        
        $descr_covid19_en = '<p>Dear <strong>[cliente]</strong>,</p>
        
                                <p>we are sincerely sorry to hear about your need to cancel your reservation Nr. [<strong>numeropreno]</strong>, due to the COVID-19 emergency.</p>
        
                                <p>In accordance with the provisions of article 88 of law-decree no. 18/2020 and article 28 of law-decree no. 9/2020, we send you a voucher worth &euro; [caparra], which you can use within one year from the date of issue.</p>
        
                                <p>The applicable conditions are as follows:</p>
        
                                <ul>
                                        <li>the voucher is not transferable, and can therefore only be used by the beneficiary</li>
                                        <li>the voucher is transferable and can therefore be used by subjects indicated by you</li>
                                        <li>the amount is not fractionable and must therefore be used for a single period of stay</li>
                                        <li>the amount is fractionable and therefore usable for multiple stays</li>
                                </ul>
        
                                <p>To check availability and book your next stay, please contact us on <strong>[emailhotel]</strong> and indicate the voucher number and the dates of your preferred stay.</p>
        
                                <p>We look forward to welcoming you</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>CLICK ON THE LINK TO VIEW AND PRINT THE VOUCHER</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p>&nbsp;</p>
        
                                <p>Sincerely</p>
        
                                <p><strong>[struttura]</strong></p>';
        
        $descr_covid19_fr = '<p>Cher <strong>[cliente],</strong></p>
        
                                <p>nous sommes sinc&egrave;rement d&eacute;sol&eacute;s pour l&#39;annulation de votre r&eacute;servation Nr.<strong> [numeropreno]</strong>, suite &agrave; l&#39;urgence due au virus COVID-19.</p>
        
                                <p>Conform&eacute;ment aux dispositions de l&#39;article 88 du d&eacute;cret-loi no. 18 de 2020 et l&#39;article 28 du d&eacute;cret-loi no. Le 9 de 2020, nous vous envoyons un bon d&#39;une valeur de [caparra] &euro;, que vous pouvez utiliser dans l&#39;ann&eacute;e suivant la date d&#39;&eacute;mission.</p>
        
                                <p>Les conditions applicables sont les suivantes:</p>
        
                                <p>le bon n&#39;est pas transf&eacute;rable et ne peut donc &ecirc;tre utilis&eacute; que par le b&eacute;n&eacute;ficiaire<br />
                                le bon est transf&eacute;rable et peut donc &ecirc;tre utilis&eacute; par les sujets que vous avez indiqu&eacute;s<br />
                                le montant n&#39;est pas divisible et doit donc &ecirc;tre utilis&eacute; pour une seule p&eacute;riode de s&eacute;jour<br />
                                le montant est divisible et donc utilisable pour plusieurs s&eacute;jours<br />
                                Pour v&eacute;rifier la disponibilit&eacute; et r&eacute;server votre prochain s&eacute;jour, veuillez nous contacter au <strong>[emailhotel]</strong> en indiquant le num&eacute;ro du bon et les dates auxquelles vous souhaitez s&eacute;journer.</p>
        
                                <p>Au plaisir de vous accueillir</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>CLIQUEZ SUR LE LIEN POUR VISUALISER ET IMPRIMER LE BON</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p>&nbsp;</p>
        
                                <p>Cordialement</p>
        
                                <p><strong>[struttura]</strong></p>';
        
        $descr_covid19_de = '<p>Sehr geehrter<strong> [cliente]</strong>,</p>
        
                                <p>Wir entschuldigen uns aufrichtig f&uuml;r die Stornierung Ihrer Reservierung&nbsp;Nr. <strong>[numeropreno]</strong> als Folge des Notfalls aufgrund des COVID-19-Virus.</p>
        
                                <p>In &Uuml;bereinstimmung mit den Bestimmungen von Artikel 88 des Gesetzesdekrets Nr. 18 von 2020 und Artikel 28 des Gesetzesdekrets Nr. 9 von 2020 senden wir Ihnen einen Gutschein im Wert von &euro; [caparra], den Sie innerhalb eines Jahres ab Ausstellungsdatum einl&ouml;sen k&ouml;nnen.</p>
        
                                <p>Die anwendbaren Bedingungen sind wie folgt:</p>
        
                                <p>Der Gutschein ist nicht &uuml;bertragbar und kann daher nur vom Beg&uuml;nstigten verwendet werden<br />
                                Der Gutschein ist &uuml;bertragbar und kann daher von den von Ihnen angegebenen Themen verwendet werden<br />
                                Der Betrag ist nicht teilbar und muss daher f&uuml;r eine einzelne Aufenthaltsdauer verwendet werden<br />
                                Der Betrag ist teilbar und daher f&uuml;r mehrere Aufenthalte verwendbar<br />
                                Um die Verf&uuml;gbarkeit zu pr&uuml;fen und Ihren n&auml;chsten Aufenthalt zu buchen, kontaktieren Sie uns bitte unter <strong>[emailhotel]</strong> und geben Sie die Gutscheinnummer und die Daten an, an denen Sie &uuml;bernachten m&ouml;chten.</p>
        
                                <p>Wir freuen uns, Sie begr&uuml;&szlig;en zu d&uuml;rfen</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>KLICKEN SIE AUF DEN LINK, UM DEN BIS GULTIG GULTIGEN GUTSCHEIN ANZUZEIGEN</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p>&nbsp;</p>
        
                                <p>Mit freundlichen Gr&uuml;&szlig;en</p>
        
                                <p><strong>[struttura]</strong></p>';

        // MOTIVAZIONI VOSUCHER CANCELLAZIONE
        $sync =$db->query("INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,DataValidita,Motivazione,Abilitato) VALUES('".IDSITO."','it','".(date('Y')+1)."-".date('m-d')."','COVID19','1')");
        $id_sync = $db->insert_id($sync);
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','it','COVID19','".addslashes($oggetto_covid19_it)."','".addslashes($descr_covid19_it)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','en','COVID19','".addslashes($oggetto_covid19_en)."','".addslashes($descr_covid19_en)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','fr','COVID19','".addslashes($oggetto_covid19_fr)."','".addslashes($descr_covid19_fr)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','de','COVID19','".addslashes($oggetto_covid19_de)."','".addslashes($descr_covid19_de)."')");
        #
        $oggetto_malattia_it = 'Emesso Buono Voucher per [cliente] in riferimento alla prenotazione nr.[numeropreno]!';
        $oggetto_malattia_en = 'Voucher issued for [cliente] in reference to Reservation no. [numeropreno]!';
        $oggetto_malattia_fr = 'Bon émis pour le numéro de référence [cliente] Réservation [numeropreno]';
        $oggetto_malattia_de = 'Gutschein ausgestellt für [cliente] Referenznummer Reservierung [numeropreno]';
        
        $descr_malattia_it = '<p>Gentile [cliente],</p>
        
                                <p>se desideri&nbsp;recuperare la caparra gi&agrave; versata in riferimento alla&nbsp;prenotazione nr. [numeropreno];</p>
        
                                <p>Segui...........................</p>
        
                                <p>[linkvoucher]</p>';
        
        $descr_malattia_en = '<p>Dear [cliente],</p>
        
                                <p>if you wish to recover the deposit already paid in reference to the reservation no.[numeropreno];</p>
        
                                <p>Follow...........................</p>
        
                                <p>[linkvoucher]</p>';
        
        $descr_malattia_fr = 'Cher [cliente],
        
                                si vous souhaitez récupérer les arrhes déjà versées en référence à la réservation no. [numeropreno];
        
                                Suivez ...........................
        
                                [linkvoucher]';
        
        $descr_malattia_de = 'Sehr geehrter [cliente],
        
                                Wenn Sie die bereits gezahlte Anzahlung in Bezug auf die Reservierungsnummer zurückerhalten möchten. [numeropreno];
        
                                Folgen Sie ...........................
        
                                [linkvoucher]';

        $sync2 =$db->query("INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,DataValidita,Motivazione,Abilitato) VALUES('".IDSITO."','it','".date('Y')."-".(date('m')+6)."-".date('d')."','Malattia','1')");
        $id_sync2 = $db->insert_id($sync);
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','it','Malattia','".addslashes($oggetto_malattia_it)."','".addslashes($descr_malattia_it)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','en','Disease','".addslashes($oggetto_malattia_en)."','".addslashes($descr_malattia_en)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','fr','Maladie','".addslashes($oggetto_malattia_fr)."','".addslashes($descr_malattia_fr)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','de','Krankheit','".addslashes($oggetto_malattia_de)."','".addslashes($descr_malattia_de)."')");                       
        // FINE

        // SERVIZI AGGIUNTIVI
        $seT = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','culla_baby.png','Culla','','Al giorno','1')");
        $id_seT = $db->insert_id($seT);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/culla_baby.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/culla_baby.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','it','Culla','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','en','Baby cot','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','fr','Lit d\'enfant','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','de','Krippe','')");
        #
        $seT1 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','parking.png','Parcheggio','','Al giorno','1')");
        $id_seT1 = $db->insert_id($seT1);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/parking.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/parking.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','it','Parcheggio','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','en','Parking','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','fr','Parking','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','de','Parkplatz','')");
        #
        $seT2 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','beach.png','Spiaggia','','Al giorno','0')");
        $id_seT2 = $db->insert_id($seT2);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/beach.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/beach.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','it','Spiaggia','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','en','Beach','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','fr','Plage','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','de','Strand','')");
        #
        $seT3 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','bus_navetta.png','Bus Navetta','','Una tantum','1')");
        $id_seT3 = $db->insert_id($seT3);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/bus_navetta.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/bus_navetta.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','it','Bus Navetta','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','en','Bus','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','fr','Navette','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','de','Shuttle-Bus','')");
        #
        $seT4 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','wellness.png','Centro Wellness','','Una tantum','1')");
        $id_seT4 = $db->insert_id($seT4);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/wellness.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/wellness.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','it','Centro Wellness','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','en','Wellness Center','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','fr','Centre de bien-être','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','de','Wellness Zentrum','')");
        #
        $seT5 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','computer.png','Internet Point','','Una tantum','1')");
        $id_seT5 = $db->insert_id($seT5);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/computer.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/computer.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','it','Internet Point','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','en','Internet Point','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','fr','Internet Point','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','de','Internet Point','')");
        #
        $seT51 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','nursery.png','Nursery','','Una tantum','1')");
        $id_seT51 = $db->insert_id($seT51);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/nursery.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/nursery.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','it','Nursery','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','en','Nursery','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','fr','Pépinière','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','de','Kindergarten','')");
        #
        $seT6 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','giornali.png','Giornali','','Al giorno','1')");
        $id_seT6 = $db->insert_id($seT6);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/giornali.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/giornali.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','it','Giornali','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','en','Newspapers','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','fr','Journaux','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','de','Zeitungen','')");
        #
        $seT7 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','joystick_cover.png','Sala Giochi','','Una tantum','1')");
        $id_seT7 = $db->insert_id($seT7);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/joystick_cover.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/joystick_cover.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','it','Sala Giochi','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','en','Game room','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','fr','Salle de jeux','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','de','Spielzimmer','')");

        #
        $seT8 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','skipass.png','Skipass','','A persona','0')");
        $id_seT8 = $db->insert_id($seT8);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/skipass.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/skipass.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','it','Skipass','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','en','Skipass','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','fr','Skipass','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','de','Skipass','')");

        #
        $seT9 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".IDSITO."','it','massaggio.png','Massaggio','','A persona','1')");
        $id_seT9 = $db->insert_id($seT9);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/massaggio.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/massaggio.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','it','Massaggio','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','en','Massage','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','fr','Massage','')");
        $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','de','Massage','')");
        //FINE




   
    
