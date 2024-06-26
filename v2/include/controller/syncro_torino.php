<?php
// dizionario del software
        $diz1 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SOLUZIONECONFERMATA')");
        $id_diz1 = $db->insert_id($diz1);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','1914','it','Soluzione Confermata')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','1914','en','Solution Confirmed')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','1914','fr','Solution Confirmée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','1914','de','Bestätigte Lösung')");
         //
        $diz2 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATISOGGIORNO')");
        $id_diz2 = $db->insert_id($diz2);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','1914','it','Dati del soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','1914','en','Brief summary reservation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','1914','fr','Restez données:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','1914','de','Bleiben Daten:')");
        //
        $diz3 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TIPOSOGGIORNO')");
        $id_diz3 = $db->insert_id($diz3);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','1914','it','Tipo soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','1914','en','Type of stay:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','1914','fr','Type de séjour:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','1914','de','Aufenthalt Art:')");
        //
        $diz4 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATAARRIVO')");
        $id_diz4 = $db->insert_id($diz4);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','1914','it','Data arrivo:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','1914','en','Arrival:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','1914','fr','Arrivée:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','1914','de','Ankunft:')");
        //
        $diz5 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATAPARTENZA')");
        $id_diz5 = $db->insert_id($diz5);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','1914','it','Data partenza:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','1914','en','Departure:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','1914','fr','Date de départ:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','1914','de','Abreisedatum:')");
        //
        $diz6 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SISTEMAZIONE')");
        $id_diz6 = $db->insert_id($diz6);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','1914','it','Sistemazione:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','1914','en','Accommodation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','1914','fr','Hébergement:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','1914','de','Unterkunft:')");
        //
        $diz7 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CAPIENZAADULTI')");
        $id_diz7 = $db->insert_id($diz7);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','1914','it','<b>Capienza Adulti:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','1914','en','<b>Capacity Adults:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','1914','fr','<b>Capacité Adultes:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','1914','de','<b>Kapazität Erwachsene:</b>')");
        //
        $diz8 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CAPIENZABAMBINI')");
        $id_diz8 = $db->insert_id($diz8);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','1914','it','<b>Capienza Bambini:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','1914','en','<b>Children Capacity:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','1914','fr','<b>La capacité des enfants:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','1914','de','<b>Kinder Kapazität:</b>')");
        //
        $diz9 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','METRATURA')");
        $id_diz9 = $db->insert_id($diz9);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','1914','it','<b>Metratura:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','1914','en','<b>Square footage:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','1914','fr','<b>Pieds carrés:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','1914','de','<b>Quadratmeterzahl:</b>')");
        //
        $diz10 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SERVIZICAMERA')");
        $id_diz10 = $db->insert_id($diz10);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','1914','it','<b>Servizi in camera:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','1914','en','<b>Room facilities:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','1914','fr','<b>Équipements en Chambre:</b>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','1914','de','<b>Zimmerausstattung:</b>')");
        //
        $diz11 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PRENOTAZIONE')");
        $id_diz11 = $db->insert_id($diz11);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','1914','it','Prenotazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','1914','en','Reservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','1914','fr','Réservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','1914','de','Buchung')");
        //
        $diz12 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONFERMA')");
        $id_diz12 = $db->insert_id($diz12);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','1914','it','Conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','1914','en','Confirm')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','1914','fr','Confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','1914','de','Bestätigung')");
        //
        $diz13 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PREVENTIVO')");
        $id_diz13 = $db->insert_id($diz13);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','1914','it','Preventivo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','1914','en','Quote')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','1914','fr','Citation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','1914','de','Zitat')");
        //
        $diz14 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NOTE')");
        $id_diz14 = $db->insert_id($diz14);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','1914','it','Note:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','1914','en','Notes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','1914','fr','Remarques:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','1914','de','Aufzeichnungen:')");
        //
        $diz15 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK1')");
        $id_diz15 = $db->insert_id($diz15);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','1914','it','Clicca qui per vedere l\'offerta a te dedicata... ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','1914','en','Click here to see the page dedicated to you ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','1914','fr','Cliquez ici pour voir l\'offre dédiée à vous ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','1914','de','Klicken Sie hier, um zu sehen, das Angebot zu Ihnen gewidmet ...')");
        //
        $diz16 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK2')");
        $id_diz16 = $db->insert_id($diz16);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','1914','it','Scopri qual è la nostra migliore offerta per il periodo da te richiesto!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','1914','en','Find out what our best offer for the required period!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','1914','fr','Découvrez ce que notre meilleure offre pour la période requise!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','1914','de','Entdecken Sie, was unser bestes Angebot für den gewünschten Zeitraum!')");
        //
        $diz17 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGINARISERVATA')");
        $id_diz17 = $db->insert_id($diz17);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','1914','it','Pagina Web riservata a:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','1914','en','Web page reserved for:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','1914','fr','Page Web réservée aux:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','1914','de','Webseite reserviert für:')");
        //
        $diz18 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SALUTI_H')");
        $id_diz18 = $db->insert_id($diz18);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','1914','it','I nostri migliori saluti.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','1914','en','Our best regards.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','1914','fr','Nos meilleures salutations.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','1914','de','Unsere freundlichen Grüßen.')");
        //
        $diz19 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OFFERTA_DETTAGLIO')");
        $id_diz19 = $db->insert_id($diz19);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','1914','it','Vai al dettaglio dell\'offerta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','1914','en','View detailed offer')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','1914','fr','Voir offre détaillée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','1914','de','Detailierten Angebot')");
        //
        $diz20 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGAMENTO')");
        $id_diz20 = $db->insert_id($diz20);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','1914','it','Caparra da versare per la conferma della prenotazione:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','1914','en','Deposit to be paid for the reservation confirmation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','1914','fr','Dépôt requis pour confirmer la réservation:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','1914','de','Kaution erforderlich, um Reservierung zu bestätigen:')");
        //
        $diz85 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ACCONTO')");
        $id_diz85 = $db->insert_id($diz85);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','1914','it','Caparra calcolata sul prezzo del soggiorno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','1914','en','Deposit calculated on the price of the stay')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','1914','fr','Caution calculée sur le prix du séjour')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','1914','de','Kaution berechnet auf den Preis des Aufenthaltes')");
        //
        $diz21 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO')");
        $id_diz21 = $db->insert_id($diz21);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','1914','it','Dopo essere stato nostro ospite, le chiediamo una sua opinione sui nostri servizi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','1914','en','After being our guest, we ask you your own opinion about our services')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','1914','fr','Après avoir été notre invité, nous demandons son opinion sur nos services')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','1914','de','Nachdem unser Gast zu sein, bitten wir seine Meinung über unsere Dienstleistungen')");
        //
        $diz22 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL')");
        $id_diz22 = $db->insert_id($diz22);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','1914','it','Gentile [cliente], fiduciosi che il suo soggiorno presso la nostra struttura ricettiva sia stato di suo gradimento, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà dare una sua opinione sui servizi relativi al nostro hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','1914','en','Dear [cliente], confident that his stay at our accommodation has been to his liking, please click on the link located at the bottom in the mail in a few minutes will give an opinion on the services related to our hotels.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','1914','fr','Cher [cliente], confiant que son séjour dans notre établissement a été à son gré, s\'il vous plaît cliquer sur le lien situé au bas de l\'e-mail en quelques minutes donnera un avis sur les services liés à nos hôtels.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','1914','de','Sehr [cliente], zuversichtlich, dass sein Aufenthalt in unserer Unterkunft nach seinem Geschmack gewesen ist, klicken Sie bitte auf den Link am Ende in der E-Mail in wenigen Minuten befindet sich eine Stellungnahme zu den Dienstleistungen für unsere Hotels im Zusammenhang geben.','1')");
        //
        $diz23 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','VAI_AL_QUEST')");
        $id_diz23 = $db->insert_id($diz23);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','1914','it','Vai al questionario')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','1914','en','Go to the questionnaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','1914','fr','Accédez au questionnaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','1914','de','Gehen Sie auf den Fragebogen')");
        //
        //Dizionario CLOUD
        $diz24 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','VISITA_NOSTRO_SITO')");
        $id_diz24 = $db->insert_id($diz24);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','1914','it','Visita il nostro sito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','1914','en','Visit our website')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','1914','fr','Visitez notre site Web')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','1914','de','Besuchen Sie unsere Website')");
        //
        $diz25 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MESSAGGIO_PER_NOI')");
        $id_diz25 = $db->insert_id($diz25);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','1914','it','Messaggio per noi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','1914','en','Message for us')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','1914','fr','Message pour nous')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','1914','de','Nachricht für uns')");
        //
        $diz26 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PROPOSTE')");
        $id_diz26 = $db->insert_id($diz26);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','1914','it','Proposte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','1914','en','Proposals')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','1914','fr','Propositions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','1914','de','Vorschläge')");
        //
        $diz27 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SOGGIORNI')");
        $id_diz27 = $db->insert_id($diz27);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','1914','it','Soggiorni')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','1914','en','Stays')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','1914','fr','Séjours')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','1914','de','Aufenthalte')");
        //
        $diz28 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','EVENTI')");
        $id_diz28 = $db->insert_id($diz28);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','1914','it','Eventi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','1914','en','Events')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','1914','fr','Evénements')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','1914','de','Geschehen')");
        //
        $diz29 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PDI')");
        $id_diz29 = $db->insert_id($diz29);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','1914','it','Punti di Interesse')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','1914','en','Points of Interest')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','1914','fr','Points d\'intérêt')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','1914','de','Interesse Punkte')");
        //
        $diz30 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONTATTA_HOTEL')");
        $id_diz30 = $db->insert_id($diz30);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','1914','it','Contatta l\'Hotel')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','1914','en','Contact the Hotel')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','1914','fr','Contactez l\'Hôtel')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','1914','de','Kontaktieren Sie das Hotel')");
        //
        $diz31 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MESSAGGIO')");
        $id_diz31 = $db->insert_id($diz31);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','1914','it','Messaggio')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','1914','en','Message')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','1914','fr','Message')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','1914','de','Nachricht')");
        //
        $diz32 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','INVIA')");
        $id_diz32 = $db->insert_id($diz32);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','1914','it','Invia')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','1914','en','Submit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','1914','fr','Soumettre')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','1914','de','Einreichen')");
        //
        $diz33 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','IL_SUO')");
        $id_diz33 = $db->insert_id($diz33);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','1914','it','Il suo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','1914','en','His')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','1914','fr','Son')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','1914','de','Seine')");
        //
        $diz34 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DA')");
        $id_diz34 = $db->insert_id($diz34);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','1914','it','da')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','1914','en','from')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','1914','fr','à partir de')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','1914','de','von')");
        //
        $diz37 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OFFERTA')");
        $id_diz37 = $db->insert_id($diz37);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','1914','it','Offerta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','1914','en','Offers')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','1914','fr','Offre')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','1914','de','Angebot')");
        //
        $diz38 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DEL')");
        $id_diz38 = $db->insert_id($diz38);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','1914','it','del')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','1914','en','the')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','1914','fr','la')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','1914','de','die')");
        //
        $diz39 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATA_ARRIVO')");
        $id_diz39 = $db->insert_id($diz39);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','1914','it','Data di Arrivo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','1914','en','Check-in date')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','1914','fr','Date d\'arrivée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','1914','de','Ankunft')");
        //
        $diz40 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATA_PARTENZA')");
        $id_diz40 = $db->insert_id($diz40);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','1914','it','Data di Partenza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','1914','en','Departure date')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','1914','fr','Date de départ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','1914','de','Abfahrtsdatum')");
        //
        $diz41 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PROPOSTE_PER_NR_ADULTI')");
        $id_diz41 = $db->insert_id($diz41);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','1914','it','Proposte per N° Adulti:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','1914','en','Proposals for N° Adults:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','1914','fr','Les propositions de N° Adultes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','1914','de','Vorschläge für N° Erwachsene:')");
        //
        $diz42 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SOGGIORNO_PER_NR_ADULTI')");
        $id_diz42 = $db->insert_id($diz42);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','1914','it','Soggiorno per N° Adulti:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','1914','en','Stay to N° Adults:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','1914','fr','Restez à N° Adultes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','1914','de','Bleiben Sie auf dem N° Erwachsene:')");
        //
        $diz43 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NR_BAMBINI')");
        $id_diz43 = $db->insert_id($diz43);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','1914','it','N° Bambini:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','1914','en','N° Children:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','1914','fr','N° Enfants:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','1914','de','Nr Kinder:')");
        //
        $diz44 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NOTTI')");
        $id_diz44 = $db->insert_id($diz44);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','1914','it','N° Notti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','1914','en','N° Nights')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','1914','fr','N° Nuits')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','1914','de','N° Nächte')");
        //
        $diz45 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ADULTI')");
        $id_diz45 = $db->insert_id($diz45);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','1914','it','Adulti:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','1914','en','Adults:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','1914','fr','Adultes:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','1914','de','Erwachsene:')");
        //
        $diz46 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','BAMBINI')");
        $id_diz46 = $db->insert_id($diz46);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','1914','it','Bambini:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','1914','en','Children:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','1914','fr','Enfants:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','1914','de','Kinder:')");
        //
        $diz48 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PROPOSTA')");
        $id_diz48 = $db->insert_id($diz48);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','1914','it','Proposta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','1914','en','Proposal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','1914','fr','Proposition')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','1914','de','Vorschlag')");
        //
        $diz49 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SOGGIORNO')");
        $id_diz49 = $db->insert_id($diz49);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','1914','it','Soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','1914','en','Stay:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','1914','fr','Séjour:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','1914','de','Aufenthalt:')");
        //
        $diz50 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TIPOCAMERA')");
        $id_diz50 = $db->insert_id($diz50);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','1914','it','Tipologia Camera:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','1914','en','Room type:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','1914','fr','Type de chambre:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','1914','de','Zimmerkategorie:')");
        //
        $diz51 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SERVIZI_CAMERA')");
        $id_diz51 = $db->insert_id($diz51);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','1914','it','Servizi Camera:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','1914','en','Room services:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','1914','fr','Les services de chambre:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','1914','de','Zimmerservice:')");
        //
        $diz52 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CAMERA')");
        $id_diz52 = $db->insert_id($diz52);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','1914','it','Camera:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','1914','en','Room:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','1914','fr','Chambre:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','1914','de','Zimmer:')");
        //
        $diz53 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PREZZO')");
        $id_diz53 = $db->insert_id($diz53);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','1914','it','Prezzo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','1914','en','Price')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','1914','fr','Prix')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','1914','de','Preis')");
        //
        $diz54 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DA_LISTINO')");
        $id_diz54 = $db->insert_id($diz54);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','1914','it','da listino')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','1914','en','pricelist')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','1914','fr','pricelist')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','1914','de','preisliste')");
        //
        $diz55 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','E_PROPOSTO')");
        $id_diz55 = $db->insert_id($diz55);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','1914','it',' per il soggiorno ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','1914','en',' for the stay ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','1914','fr',' pour le séjour ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','1914','de',' für den Aufenthalt ')");
        //
        $diz56 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ALLA_CO')");
        $id_diz56 = $db->insert_id($diz56);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','1914','it','Alla c/o di ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','1914','en','At c / or ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','1914','fr','A c / ou ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','1914','de','Bei c / oder ')");
        //
        $diz57 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONTENUTO_MSG')");
        $id_diz57 = $db->insert_id($diz57);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','1914','it','vorremmo accettare la proposta di soggiorno:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','1914','en','we would like to accept the proposal of stay:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','1914','fr','nous tenons à accepter la proposition du séjour:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','1914','de','möchten wir den Vorschlag des Aufenthalts zu akzeptieren:')");
        //
        $diz58 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CORDIALMENTE')");
        $id_diz58 = $db->insert_id($diz58);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','1914','it','Cordialmente')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','1914','en','Cordially')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','1914','fr','Cordialement')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','1914','de','Herzlich')");
        //
        $diz59 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','VISUALIZZA_MAPPA')");
        $id_diz59 = $db->insert_id($diz59);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','1914','it','Visualizza sulla Mappa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','1914','en','Show on map')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','1914','fr','Voir sur la carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','1914','de','Auf der Karte anzeigen')");
        //
        $diz60 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DOVE_SIAMO')");
        $id_diz60 = $db->insert_id($diz60);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','1914','it','Dove Siamo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','1914','en','Where we are')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','1914','fr','Où sommes-nous')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','1914','de','Wo wir sind')");
        //
        $diz61 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PROPOSTA_SCELTA')");
        $id_diz61 = $db->insert_id($diz61);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','1914','it','Scegli la proposta ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','1914','en','Choosing proposal ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','1914','fr','Choisissez la proposition ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','1914','de','Wählen Sie den Vorschlag ')");
        //
        $diz62 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PLACEHOLDER_PROPOSTA')");
        $id_diz62 = $db->insert_id($diz62);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','1914','it','Scegliere una delle proposte soggiorno, selezionando il checkbox relativo!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','1914','en','Choose from the proposed hotel offers, by checking the appropriate checkbox!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','1914','fr','Choisissez un séjour proposé, en cochant la case appropriée!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','1914','de','Wählen Sie eines der vorgeschlagenen Aufenthalt, indem Sie die entsprechende Checkbox!')");
        //
        $diz63 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SALUTI')");
        $id_diz63 = $db->insert_id($diz63);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','1914','it','Saluti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','1914','en','Greetings')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','1914','fr','Salutations')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','1914','de','Gruß')");
        //
        $diz64 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SELEZIONA_PROPOSTA')");
        $id_diz64 = $db->insert_id($diz64);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','1914','it','Seleziona la proposta e contatta l\'hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','1914','en','Select the proposal and contact the hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','1914','fr','Sélectionnez la proposition et de contacter l\'hôtel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','1914','de','Wählen Sie den Vorschlag und kontaktieren Sie das Hotel!')");
        //
        $diz65 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','STAMPA')");
        $id_diz65 = $db->insert_id($diz65);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','1914','it','VOUCHER PROMEMORIA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','1914','en','VOUCHER REMINDER')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','1914','fr','RAPPEL VOUCHER')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','1914','de','VOUCHER ERINNERUNG')");
        //
        $diz66 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ANNI')");
        $id_diz66 = $db->insert_id($diz66);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','1914','it','anni')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','1914','en','age')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','1914','fr','âge')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','1914','de','Alter')");
        //
        $diz67 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONDIZIONI_GENERALI')");
        $id_diz67 = $db->insert_id($diz67);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','1914','it','Condizioni Generali e Politiche di Cancellazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','1914','en','General Conditions and Cancellation Policies')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','1914','fr','Politiques et conditions générales d\'annulation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','1914','de','Allgemeine Geschäftsbedingungen und Stornierungsbedingungen')");
        //
        $diz68 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CREATA_DA')");
        $id_diz68 = $db->insert_id($diz68);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','1914','it','Creato da:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','1914','en','Created by:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','1914','fr','Créé par:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','1914','de','Erstellt von:')");
        //
        $diz69 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','HOTELCHAT')");
        $id_diz69 = $db->insert_id($diz69);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','1914','it','Hai delle domande per noi? Questo è lo spazio giusto!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','1914','en','You have a question for us? This is the right spot!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','1914','fr','Vous avez une question pour nous? Ceci est le bon endroit!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','1914','de','Sie haben eine Frage an uns? Dies ist der richtige Ort!')");
        //
        $diz70 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','QUESTIONARIO')");
        $id_diz70 = $db->insert_id($diz70);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','1914','it','Questionario soddisfazione del cliente')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','1914','en','Customer satisfaction questionnaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','1914','fr','Questionnaire satisfaction')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','1914','de','Kundenzufriedenheit')");
        //
        $diz71 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTO_QUESTIONARIO')");
        $id_diz71 = $db->insert_id($diz71);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','1914','it','Gentile [cliente], <br>esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura, per ogni domanda puoi dare un valore di soddisfazione ed un commento!<br> Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','1914','en','Dear [cliente], Give your opinion about your stay you just spent at our facility, for each question you can give a satisfaction value and a comment! Your thinking will be for us a source essential to improve our services in the hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','1914','fr','Cher [cliente], exprimer votre opinion sur votre séjour, vous venez de passer à notre établissement, pour chaque question, vous pouvez donner une valeur de satisfaction et un commentaire! Votre pensée sera pour nous une source essentielle pour améliorer nos services dans l\'hôtel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','1914','de','Lieber [cliente], äußern Sie Ihre Meinung über Ihren Aufenthalt Sie nur in unserer Einrichtung verbracht, für jede Frage können Sie einen Zufriedenheitswert und einen Kommentar abgeben! Ihr Denken wird für uns eine Quelle wesentlich für unsere Dienstleistungen im Hotel zu verbessern.','1')");
        //
        $diz72 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NO_QUESTIONARIO')");
        $id_diz72 = $db->insert_id($diz72);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','1914','it','Questionario già compilato!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','1914','en','Questionnaire already filled!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','1914','fr','Questionnaire déjà rempli!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','1914','de','Fragebogen bereits ausgefüllt!')");
        //
        $diz73 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','THANKS_QUESTIONARIO')");
        $id_diz73 = $db->insert_id($diz73);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','1914','it','Ringraziandovi per aver compilato questo breve questionario, ci auguriamo di rivedervi presto nel nostro hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','1914','en','Thank you for filling out this short questionnaire, we hope to see you soon in our hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','1914','fr','Je vous remercie de remplir ce court questionnaire, nous espérons vous voir bientôt dans notre hôtel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','1914','de','Ich danke Ihnen für das Füllen dieser kurzen Fragebogen aus, wir hoffen, Sie bald in unserem Hotel zu sehen!')");
        //
        $diz74 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','LASCIA_COMMENTO')");
        $id_diz74 = $db->insert_id($diz74);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','1914','it','Lascia un commento')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','1914','en','Leave a comment')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','1914','fr','Laisser un commentaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','1914','de','Hinterlassen Sie einen Kommentar')");
        //
        $diz75 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CARTA_CREDITO')");
        $id_diz75 = $db->insert_id($diz75);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','1914','it','Garanzia Carta di Credito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','1914','en','Guarantee Credit Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','1914','fr','Garantie Carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','1914','de','Garantie Kreditkarte')");
        //
        $diz76 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTO_CARTA_CREDITO')");
        $id_diz76 = $db->insert_id($diz76);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','1914','it','La carta di credito serve solo per garantire la prenotazione!<br> L\'importo del soggiorno non verrà addebitato sulla sua carta di credito, i cui dati rimangono conservati criptati su server sicuro a garanzia della prenotazione fino al giorno del suo arrivo.<br> Il soggiorno verrà pagato direttamente all\'hotel.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','1914','en','A credit card is required to guarantee your reservation!<br> The amount of the booking will not be billed to your credit card, whose data are stored on a secure server to guarantee your reservation until the day of his arrival. The stay will be paid directly to the hotel.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','1914','fr','Une carte de crédit est nécessaire pour garantir votre réservation! Le montant du séjour sera débité de votre carte de crédit, dont les données sont stockées cryptées sur un serveur sécurisé pour garantir votre réservation jusqu\'à ce que le jour de son arrivée. Le séjour sera payé directement à l\'hôtel.')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','1914','de','Wird eine Kreditkarte benötigt, um Ihre Reservierung zu garantieren! Die Menge des Aufenthaltes wird von Ihrer Kreditkarte abgebucht werden, deren Daten auf einem sicheren Server verschlüsselt gespeichert Ihre Reservierung bis zu dem Tag seiner Ankunft zu garantieren. Der Aufenthalt wird direkt im Hotel bezahlt.')");
        //
        $diz77 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SALVA_CARTA_CREDITO')");
        $id_diz77 = $db->insert_id($diz77);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','1914','it','Salva Carta di Credito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','1914','en','Save Credit Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','1914','fr','Sauvegarder la carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','1914','de','Speichern Kreditkarte')");
        //
        $diz78 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CARTA')");
        $id_diz78 = $db->insert_id($diz78);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','1914','it','Carta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','1914','en','Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','1914','fr','Carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','1914','de','Karte')");
        //
        $diz79 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','N_CARTA')");
        $id_diz79 = $db->insert_id($diz79);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','1914','it','Numero carta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','1914','en','Card number')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','1914','fr','numéro de carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','1914','de','Kartennummer')");
        //
        $diz80 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','INTESTATARIO')");
        $id_diz80 = $db->insert_id($diz80);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','1914','it','Intestatario')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','1914','en','Accountholder')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','1914','fr','Candidat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','1914','de','Kandidat')");
        //
        $diz81 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCADENZA')");
        $id_diz81 = $db->insert_id($diz81);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','1914','it','Scadenza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','1914','en','Deadline')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','1914','fr','Date limite')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','1914','de','Frist')");
        //
        $diz82 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CODICE')");
        $id_diz82 = $db->insert_id($diz82);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','1914','it','Codice CVV2')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','1914','en','Code CVV2')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','1914','fr','Code CVV2')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','1914','de','Code CVV2')");
        //
        $diz83 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MSG_CARTA')");
        $id_diz83 = $db->insert_id($diz83);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','1914','it','Salvataggio criptato della Carta avvenuto con successo!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','1914','en','Save the encrypted happened Charter successfully!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','1914','fr','Save the crypté est arrivé Charte avec succès!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','1914','de','Speichern Sie die verschlüsselte passiert Charta erfolgreich!')");
        //
        $diz84 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATI_CARTA')");
        $id_diz84 = $db->insert_id($diz84);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','1914','it','Dati Carta di Credito già inseriti!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','1914','en','Credit Card Data already entered!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','1914','fr','Credit Card Data est déjà entré!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','1914','de','Kreditkartendaten bereits eingetragen!')");
        //
        $diz86 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ACCONSENTI_PRIVACY_POLICY')");
        $id_diz86 = $db->insert_id($diz86);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','1914','it','Ho preso visione dell\'informativa privacy e delle <a href=\"javascript:;\" id=\"sblocca_politiche\">politiche di cancellazione</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','1914','en','I have read the privacy policy and the <a href=\"javascript:;\" id=\"sblocca_politiche\">cancellation policies</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','1914','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche\">conditions d\'annulation</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','1914','de','Ich habe die Datenschutzerklärung und die <a href=\"javascript:;\" id=\"sblocca_politiche\">Stornierungsbedingungen gelesen</a>')");
        //
        $diz87 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ACCONSENTI_PRIVACY_POLICY_SOGGIORNO')");
        $id_diz87 = $db->insert_id($diz87);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','1914','it','Ho preso visione dell\'informativa privacy e delle <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">politiche di cancellazione</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','1914','en','I have read the privacy policy and the <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">cancellation policies</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','1914','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">conditions d\'annulation</a>')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','1914','de','Ich habe die Datenschutzerklärung und die <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">Stornierungsbedingungen gelesen</a>')");
        //
        $diz88 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NO_REPLAY_EMAIL')");
        $id_diz88 = $db->insert_id($diz88);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','1914','it','Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','1914','en','This email was sent automatically by the software, do not reply to this email!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','1914','fr','Ce courriel a été envoyé automatiquement par le logiciel, ne répond pas à cet email!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','1914','de','Diese E-Mail wurde von der Software automatisch gesendet wird, antworten Sie nicht auf diese E-Mail!')");
        //
        $diz89 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_VAUCHER')");
        $id_diz89 = $db->insert_id($diz89);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','1914','it','Conferma di prenotazione accettata e voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','1914','en','Confirming queuing and vouchers')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','1914','fr','Confirmant les files d\'attente et des bons')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','1914','de','Bestätigen Queuing und Gutscheine')");

        $diz90 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_VAUCHER')");
        $id_diz90 = $db->insert_id($diz90);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','1914','it','Gentile [cliente], confermiamo le sua prenotazione come accettata e la invitiamo a stampare il Voucher riepilogativo come promemoria, che troverà nella landing page dedicata, da presentare alla reception al giorno del suo arrivo!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','1914','en','Dear [cliente], we confirm your reservation as accepted and please print the summary Voucher as a reminder, you will find in the dedicated landing page, to be presented at the reception on the day of his arrival!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','1914','fr','Cher [cliente], nous confirmons votre réservation acceptée et s\'il vous plaît imprimer votre bon de reprise comme un rappel, vous trouverez la page de destination dédiée à être présenté à la réception le jour de son arrivée!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','1914','de','Sehr [cliente], bestätigen wir Ihre Reservierung als angenommen und bitte Ihren Lebenslauf Gutschein als Erinnerung zu drucken, erhalten Sie die Zielseite finden gewidmet am Tag seiner Ankunft an der Rezeption vorgelegt werden!','1')");
       //
        $diz91 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RE_CHAT')");
        $id_diz91 = $db->insert_id($diz91);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','1914','it','Gentile [cliente], hai avuto un messaggio sulla chat della proposta che hai già visionato. Torna alla landing page a te dedicata per visualizzarlo!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','1914','en','Dear [cliente], you had a message on the chat of the proposal you have already viewed. Go back to the landing page dedicated to you to view it!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','1914','fr','Cher [cliente], vous avez eu un message sur le chat de la proposition que vous avez déjà consultée. Retournez à la page de destination qui vous est dédiée pour la voir!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','1914','de','Sehr geehrte [cliente], Sie hatten im Chat eine Nachricht zu dem Angebot, das Sie bereits angesehen haben. Kehren Sie zur Startseite zurück, um sie anzuzeigen!','1')");
           //
        $diz111 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RE_CHAT')");
        $id_diz111 = $db->insert_id($diz111);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','1914','it','Gentile [cliente], hai un messaggio in Chat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','1914','en','Dear [cliente], you have a message in Chat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','1914','fr','Cher [cliente], vous avez un message dans le chat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','1914','de','Sehr geehrter [cliente], Sie haben eine Nachricht im Chat')");

        $diz112 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CARTACREDITOGARANZIA')");
        $id_diz112 = $db->insert_id($diz112);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','1914','it','Carta di Credito a Garanzia')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','1914','en','Credit Card Guarantee')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','1914','fr','Garantie de carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','1914','de','Kreditkartengarantie')");

        $diz1_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ALTERNATIVA')");
        $id_diz1_new = $db->insert_id($diz1_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','1914','it','alternativa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','1914','en','alternative')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','1914','fr','alternative')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','1914','de','alternative')");

        $diz2_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATEALTERNATIVE')");
        $id_diz2_new = $db->insert_id($diz2_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','1914','it','Date alternative')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','1914','en','Alternative dates')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','1914','fr','Dates alternatives')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','1914','de','Alternative Termine')");

        $diz3_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ETA')");
        $id_diz3_new = $db->insert_id($diz3_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','1914','it','Età')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','1914','en','Age')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','1914','fr','âge')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','1914','de','Alter')");

        $diz4_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SERVIZI_AGGIUNTIVI')");
        $id_diz4_new = $db->insert_id($diz4_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','1914','it','Servizi Aggiuntivi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','1914','en','Additional services')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','1914','fr','Services supplémentaires')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','1914','de','Zusätzliche Dienste')");

        $diz4X = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SERVIZIO')");
        $id_diz4X = $db->insert_id($diz4X);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','1914','it','Servizio')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','1914','en','Service')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','1914','fr','Service')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','1914','de','Dienste')");

        $diz4Y = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CALCOLO')");
        $id_diz4Y = $db->insert_id($diz4Y);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','1914','it','Calcolo')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','1914','en','Calculation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','1914','fr','Calcul')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','1914','de','Berechnung')");

        $diz4K = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PREZZO_SERVIZIO')");
        $id_diz4K = $db->insert_id($diz4K);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','1914','it','Prezzo Servizio')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','1914','en','Price Service')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','1914','fr','Service de prix')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','1914','de','Preis Service')");

        $diz5_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTO_VOUCHER')");
        $id_diz5_new = $db->insert_id($diz5_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','1914','it','Gentile [cliente]...','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','1914','en','Dear [cliente]...','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','1914','fr','Cher [cliente]...','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','1914','de','Lieber [cliente]...','1')");

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

        $diz5_new_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTO_VOUCHER_RECUPERO')");
        $id_diz5_new_bis = $db->insert_id($diz5_new_bis);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','1914','it','".addslashes($descr_it)."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','1914','en','".addslashes($descr_en)."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','1914','fr','".addslashes($descr_fr)."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','1914','de','".addslashes($descr_de)."','1')");

        $diz5_new_tris = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','FRASE_RECUPERO_CAPARRA')");
        $id_diz5_new_tris = $db->insert_id($diz5_new_tris);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','1914','it','La caparra è già stata pagata tramite [tipopagamento]<br><br>Il pari importo sarà pienamente ri-utilizzabile entro [datavalidita]','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','1914','en','The deposit has already been paid by [tipopagamento]<br><br>The same amount will be fully re-usable by [datavalidita]','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','1914','fr','L\'acompte a déjà été payé par [tipopagamento]<br><br>Le même montant sera entièrement réutilisable d\'ici le [datavalidita]','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','1914','de','Die Anzahlung wurde bereits von [tipopagamento] bezahlt. <br> <br> Der gleiche Betrag kann bis zum [datavalidita] vollständig wiederverwendet werden.','1')");


        $diz6_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','UNA_TANTUM')");
        $id_diz6_new = $db->insert_id($diz6_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','1914','it','Una tantum')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','1914','en','Lump sum')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','1914','fr','Une fois')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','1914','de','Einmal')");

        $diz7_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','AL_GIORNO')");
        $id_diz7_new = $db->insert_id($diz7_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','1914','it','Al giorno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','1914','en','Per day')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','1914','fr','Par jour')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','1914','de','Pro Tag')");


        $diz7_bis_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','A_PERSONA')");
        $id_diz7_bis_new = $db->insert_id($diz7_bis_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','1914','it','A persona')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','1914','en','Per person')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','1914','fr','Par personne')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','1914','de','Pro Person')");


        $diz8_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGA_CARTA_CREDITO')");
        $id_diz8_new = $db->insert_id($diz8_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','1914','it','Paga con Carta di Credito')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','1914','en','Pay by Credit Card')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','1914','fr','Payer par carte de crédit')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','1914','de','Zahlen Sie mit Kreditkarte')");

        $diz9_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGA_PAYPAL')");
        $id_diz9_new = $db->insert_id($diz9_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','1914','it','Paga con PayPal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','1914','en','Pay by PayPal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','1914','fr','Payer par PayPal')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','1914','de','Zahlen Sie mit PayPal')");

        $diz10_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MSG_PAYPAL')");
        $id_diz10_new = $db->insert_id($diz10_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','1914','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','1914','en','Payment successfully saved, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','1914','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','1914','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");

        $diz11_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGA_STRIPE')");
        $id_diz11_new = $db->insert_id($diz11_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','1914','it','Paga con STRIPE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','1914','en','Pay by STRIPE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','1914','fr','Payer par STRIPE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','1914','de','Zahlen Sie mit STRIPE')");

        $diz12_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MSG_STRIPE')");
        $id_diz12_new = $db->insert_id($diz12_new);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','1914','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','1914','en','Payment successfully saved, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','1914','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','1914','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");


       //
        $diz92 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','INFORMATIVA_PRIVACY')");
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
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','1914','it','".$string_it."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','1914','en','".$string_en."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','1914','fr','".$string_fr."','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','1914','de','".$string_de."','1')");
         //
        $diz93 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NOME')");
        $id_diz93 = $db->insert_id($diz93);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','1914','it','Nome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','1914','en','Name')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','1914','fr','Nom')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','1914','de','Name')");
        //
        $diz94 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','COGNOME')");
        $id_diz94 = $db->insert_id($diz94);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','1914','it','Cognome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','1914','en','Surname')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','1914','fr','Nom de famille')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','1914','de','Nachname')");
        //
        $diz95 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TELEFONO')");
        $id_diz95 = $db->insert_id($diz95);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','1914','it','Telefono')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','1914','en','Phone')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','1914','fr','Téléphone')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','1914','de','Telefon')");
      //
        $diz96 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCADENZA_OFFERTA')");
        $id_diz96 = $db->insert_id($diz96);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','1914','it','La caparra dovrà essere versata entro questa data di scadenza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','1914','en','The deposit must be paid within this expiration date')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','1914','fr','Le dépôt doit être payé à cette date d\'expiration')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','1914','de','Die Kaution ist nach diesem Ablaufdatum zu zahlen')");

        $diz97 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ACCONTO_OFFERTA')");
        $id_diz97 = $db->insert_id($diz97);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','1914','it','Scegli il metodo di pagamento')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','1914','en','Choose payment method')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','1914','fr','Choisissez le mode de paiement')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','1914','de','Zahlungsart auswählen')");

        $diz98 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PREZZO_CAMERA')");
        $id_diz98 = $db->insert_id($diz98);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','1914','it','Prezzo Camera')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','1914','en','Room Price')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','1914','fr','Prix de la chambre')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','1914','de','Zimmerpreis')");
      //
        $diz99 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','DATA_RICHIESTA')");
        $id_diz99 = $db->insert_id($diz99);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','1914','it','Data della richiesta:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','1914','en','Date of request:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','1914','fr','Date de la demande:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','1914','de','Datum angefordert:')");
       //
        $diz100 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK3')");
        $id_diz100 = $db->insert_id($diz100);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','1914','it','Clicca e scopri i metodi di pagamento per confermare il tuo soggiorno!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','1914','en','Click and find the payment methods to confirm your stay!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','1914','fr','Cliquez et trouver les moyens de paiement pour confirmer votre séjour!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','1914','de','Klicken Sie auf und die Zahlungsmethoden, um Ihren Aufenthalt zu bestätigen!')");
      //
        $diz101 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','RIEPILOGO_OFFERTA')");
        $id_diz101 = $db->insert_id($diz101);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','1914','it','Riepilogo Offerta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','1914','en','Summary Offer')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','1914','fr','Offre sommaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','1914','de','Zusammenfassung Angebot')");
      //
        $diz102 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK4')");
        $id_diz102 = $db->insert_id($diz102);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','1914','it','Raccontaci la tua esperienza in hotel...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','1914','en','Tell us your experience at the hotel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','1914','fr','Donnez-nous votre expérience à l\'hôtel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','1914','de','Teilen Sie uns Ihre Erfahrung im Hotel ...')");
      //
        $diz103 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGINARISERVATA_VAUCHER')");
        $id_diz103 = $db->insert_id($diz103);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','1914','it','Vai alla pagina del voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','1914','en','Go to the voucher page')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','1914','fr','Aller à la page de coupons')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','1914','de','Gehen Sie auf die Seite Gutschein')");
      //
        $diz104 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK5')");
        $id_diz104 = $db->insert_id($diz104);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','1914','it','Stampa il voucher e ricordati di portarlo con te in hotel...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','1914','en','Print the voucher and remember to take with you at the hotel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','1914','fr','Imprimer le coupon et souvenez-vous de l\'apporter avec vous à l\'hôtel ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','1914','de','Drucken Sie den Gutschein und denken Sie daran, es zu bringen Sie zum Hotel ...')");
      //
        $diz105 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGINARISERVATA_CHAT')");
        $id_diz105 = $db->insert_id($diz105);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','1914','it','Leggi la nostra proposta...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','1914','en','Read our proposal ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','1914','fr','Lire notre proposition ...')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','1914','de','Lesen Sie unseren Vorschlag ...')");
     //
        $diz106 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK6')");
        $id_diz106 = $db->insert_id($diz106);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','1914','it','Clicca qui per vedere il messaggio sulla tua chat!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','1914','en','Click here to see the message on your chat!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','1914','fr','Cliquez ici pour voir le message sur votre chat!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','1914','de','Klicken Sie hier, um die Nachricht in Ihrem Chat zu sehen!')");
     //
        $diz107 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ANCORA_DOMANDE')");
        $id_diz107 = $db->insert_id($diz107);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','1914','it','Hai ancora delle domande da farci?')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','1914','en','You still have questions for us?')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','1914','fr','Vous avez encore des questions pour nous?')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','1914','de','Sie haben noch Fragen an uns?')");
     //
        $diz108 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCRIVICI_SE_HAI_BISOGNO')");
        $id_diz108 = $db->insert_id($diz108);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','1914','it','Scrivici se hai bisogno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','1914','en','Write to us if you need')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','1914','fr','Écrivez-nous si vous avez besoin')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','1914','de','Schreiben Sie uns, wenn Sie brauchen')");
     //
        $diz109 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ACCONTO_CARTA')");
        $id_diz109 = $db->insert_id($diz109);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','1914','it','Verrà prelevata la caparra in caso di mancanto rispetto delle politiche di cancellazione!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','1914','en','The down payment will be charged in case of lack of compliance with the cancellation policies!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','1914','fr','Le dépôt sera prise en cas de non-respect des conditions d\'annulation!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','1914','de','Die Kaution wird im Falle eines Ausfalls getroffen werden mit Stornierungsbedingungen zu erfüllen!')");
    //
        $diz110 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','INVIA_GIUDIZI')");
        $id_diz110 = $db->insert_id($diz110);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','1914','it','Inviaci i tuoi giudizi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','1914','en','Send us your feedback')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','1914','fr','Envoyez-nous vos commentaires')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','1914','de','Senden Sie uns Ihr Feedback')");
        //
        $diz120 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RESELLING')");
        $id_diz120 = $db->insert_id($diz120);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','1914','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','1914','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','1914','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','1914','de','Willkommen')");
        //
        $diz121 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RESELLING')");
        $id_diz121 = $db->insert_id($diz121);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','1914','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>La cortesia, la disponibilità e la premura del nostro staff, ci auguriamo siano una meravigliosa scoperta.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','1914','en','Dear [cliente], welcome at our accommodation.<br>Courtesy, availability and care of our staff, we hope will be a wonderful discovery.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','1914','fr','Cher [cliente], bienvenue à notre hébergement.<br>La courtoisie, la serviabilité et la gentillesse de notre personnel, nous espérons être une merveilleuse découverte.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','1914','de','Lieber [cliente], willkommen zu unserer Unterkunft. <br>Höflichkeit, Verfügbarkeit und Betreuung unserer Mitarbeiter, wir hoffen, ein wunderbarer Fund sein.','1')");
        //


        $diz120_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RECENSIONE')");
        $id_diz120_bis = $db->insert_id($diz120_bis);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','1914','it','Dopo essere stato nostro ospite, le chiediamo una sua recensione su TripAdvisor sulla nostra struttura ricettiva!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','1914','en','After being our guest, we ask for your review on TripAdvisor on our accommodation!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','1914','fr','Après avoir été notre invité, nous vous demandons votre avis sur TripAdvisor sur notre hébergement!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','1914','de','Nachdem wir unser Gast waren, bitten wir Sie um Ihre Bewertung auf TripAdvisor für unsere Unterkunft!')");
        //
        $diz121_bis = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RECENSIONE')");
        $id_diz121_bis = $db->insert_id($diz121_bis);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','1914','it','Gentile [cliente], vorremmo invitarti a lasciare una recensione su TripAdvisor, esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura! Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','1914','en','Dear [cliente], we would like to invite you to leave a review on TripAdvisor, express your opinion on the stay you have just spent at our facility! Your thought will be an indispensable source for us to improve our services in the Hotel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','1914','fr','Cher [cliente], nous aimerions vous inviter à laisser un avis sur TripAdvisor, exprimer votre opinion sur le séjour que vous venez de passer dans notre établissement! Votre pensée sera une source indispensable pour nous d\'améliorer nos services dans l\'hôtel.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','1914','de','Sehr geehrter [cliente], wir möchten Sie einladen, eine Bewertung auf TripAdvisor abzugeben und Ihre Meinung zu dem Aufenthalt zu äußern, den Sie gerade in unserer Einrichtung verbracht haben! Ihr Gedanke wird für uns eine unverzichtbare Quelle sein, um unsere Dienstleistungen im Hotel zu verbessern.','1')");



        $diz125 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RESEND_CONFERMA')");
        $id_diz125 = $db->insert_id($diz125);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','1914','it','Ricorda di confermare la prenotazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','1914','en','Remember to confirm the reservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','1914','fr','Rappelez-vous de confirmer la réservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','1914','de','Denken Sie daran, die Reservierung zu bestätigen')");
        //
        $diz126 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RESEND_CONFERMA')");
        $id_diz126 = $db->insert_id($diz126);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','1914','it','Gentile [cliente], si sta avvicinando la data di scadenza per il versamento della caparra, le ricordiamo che per confermare la sua prenotazione come accettata, deve effettuare il pagamento della caparra o dare il numero di carta di credito a garanzia.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','1914','en','Dear [cliente],  is approaching the expiration date for the payment of the deposit, remember to confirm your reservation as accepted, you must pay the deposit or give your credit card number to guarantee.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','1914','fr','Cher [cliente],  se rapproche de la date d\'expiration pour le paiement de la caution, rappelez-vous pour confirmer votre réservation comme acceptée, doit effectuer le paiement du dépôt ou de donner votre numéro de carte de crédit pour garantir.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','1914','de','Lieber [cliente],  wird das Ablaufdatum für die Zahlung der Kaution nähern, denken Sie daran Ihre Reservierung zu bestätigen, wie angenommen, muss die Zahlung der Kaution zu machen oder Ihre Kreditkartennummer geben zu gewährleisten.','1')");
        //
        $diz127 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RECALL_PREVENTIVI')");
        $id_diz127 = $db->insert_id($diz127);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','1914','it','Ciao [cliente], ricorda di visualizzare la nostra proposta di soggiorno')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','1914','en','Hi [cliente], remember to see our proposal to stay')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','1914','fr','Bonjour [cliente], rappelez-vous de montrer notre séjour proposé')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','1914','de','Hallo [cliente], erinnern uns vorgeschlagenen Aufenthalt zu zeigen')");
        //
        $diz128 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RECALL_PREVENTIVI')");
        $id_diz128 = $db->insert_id($diz128);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','1914','it','Gentile [cliente], si sta avvicinando la data di scadenza per la proposta di soggiorno, le ricordiamo che rimarrà valida ancora per poco. Non si faccia sfuggire questa grande opportunità!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','1914','en','Dear [cliente], you are approaching the expiration date for the proposed stay, remember to remain valid for a short while. Do not face out on this great opportunity!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','1914','fr','Cher [cliente], se rapproche de la date d\'expiration pour le séjour proposé, nous vous rappelons qu\'il restera valable pendant une courte période. Ne pas faire face à cette grande opportunité!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','1914','de','Lieber [cliente], wird das Ablaufdatum für die geplante Aufenthalt nähern wir Sie daran erinnern, dass es für eine kurze Zeit gültig bleiben. Sie stehen nicht auf diese große Chance heraus!','1')");
        //
        $diz129 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCELGO_VAGLIA')");
        $id_diz129 = $db->insert_id($diz129);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','1914','it','Scelgo il pagamento con Vaglia')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','1914','en','I choose payment by money order')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','1914','fr','Je choisis de payer par mandat')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','1914','de','Ich wähle von Geld zu zahlen')");
        //
        $diz130 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MSG_VAGLIA')");
        $id_diz130 = $db->insert_id($diz130);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','1914','it','Scelta salvata con successo, rimaniamo in attesa del Fax o della Email con ricevuta di pagamento, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','1914','en','Choosing saved successfully, we are waiting for the Fax or Email with proof of payment, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','1914','fr','Choisir correctement enregistré, nous attendons le fax ou e-mail avec la preuve de paiement, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','1914','de','Erfolgreich gespeichert Aussuchen, wir sind für das Fax oder E-Mail mit Zahlungsnachweis warten, beachten Sie bitte folgende Bestätigung Gutschein')");
        //
        $diz131 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCELGO_BONIFICO')");
        $id_diz131 = $db->insert_id($diz131);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','1914','it','Scelgo il pagamento con Bonifico')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','1914','en','I choose to pay by bank transfer')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','1914','fr','Je choisis de payer par virement bancaire')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','1914','de','Ich wähle per Banküberweisung zu bezahlen')");
        //
        $diz132 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MSG_BONIFICO')");
        $id_diz132 = $db->insert_id($diz132);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','1914','it','Scelta salvata con successo, rimaniamo in attesa del Fax o della Email con numero di CRO o ricevuta di pagamento, seguirà nostro voucher di conferma')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','1914','en','Choosing saved successfully, we remain waiting for the Fax or Email with CRO number or proof of payment, follow our confirmation voucher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','1914','fr','Choisir correctement enregistré, nous restons en attente de fax ou e-mail avec le numéro CRO ou une preuve de paiement, suivre notre bon de confirmation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','1914','de','Erfolgreich gespeichert Aussuchen, bleiben wir für das Fax oder E-Mail mit CRO Nummer oder Nachweis über die Zahlung warten, beachten Sie bitte folgende Bestätigung Gutschein')");
        //
        $diz133 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RESELLING_FAMILY')");
        $id_diz133 = $db->insert_id($diz133);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','1914','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','1914','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','1914','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','1914','de','Willkommen')");
        //
        $diz134 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RESELLING_FAMILY')");
        $id_diz134 = $db->insert_id($diz134);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','1914','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Per capire la differenza, basta pensare che i nostri ospiti più importanti sono i bambini.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','1914','en','Dear [cliente], welcome at our accommodation.<br>To understand the difference, just think that our most important guests are children.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','1914','fr','Cher [cliente], bienvenue à notre hébergement.<br>Pour comprendre la différence, il suffit de penser que nos clients les plus importants sont des enfants.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','1914','de','Lieber [cliente], willkommen zu unserer Unterkunft.<br>Um den Unterschied zu verstehen, man denke nur, dass unsere wichtigsten Gäste sind Kinder.','1')");
        //
        $diz135 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RESELLING_BUSINESS')");
        $id_diz135 = $db->insert_id($diz135);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','1914','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','1914','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','1914','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','1914','de','Willkommen')");
        //
        $diz136 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RESELLING_BUSINESS')");
        $id_diz136 = $db->insert_id($diz136);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','1914','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Scopri come sia facile da noi ritrovare gli stessi comfort del tuo ufficio.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','1914','en','Dear [cliente], welcome at our accommodation.<br>Discover how easy we find the same comfort of your office.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','1914','fr','Cher [cliente], bienvenue à notre hébergement. <br> Découvrez comment facile nous trouvons le même confort de votre bureau.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','1914','de','Lieber [cliente], willkommen in unserer Unterkunft. <br> Entdecken Sie, wie einfach wir den gleichen Komfort von Ihrem Büro finden.','1')");
        //
        $diz137 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RESELLING_BENESSERE')");
        $id_diz137 = $db->insert_id($diz137);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','1914','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','1914','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','1914','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','1914','de','Willkommen')");
        //
        $diz138 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RESELLING_BENESSERE')");
        $id_diz138 = $db->insert_id($diz138);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','1914','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Una esperienza di soggiorno pensata esclusivamente per la cura e il benessere del tuo corpo.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','1914','en','Dear [cliente], welcome at our accommodation.<br>A living experience designed exclusively for the care and well-being of your body.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','1914','fr','Cher [cliente], bienvenue à notre hébergement. <br>Avec une expérience de séjour conçu exclusivement pour les soins et le bien-être de votre corps.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','1914','de','Lieber [cliente], willkommen zu unserer Unterkunft. <br>Bei einem Aufenthalt Erfahrung ausschließlich für die Pflege und das Wohlbefinden des Körpers.','1')");
        //
        $diz139 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_RESELLING_SPORT')");
        $id_diz139 = $db->insert_id($diz139);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','1914','it','Benvenuti')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','1914','en','Welcome')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','1914','fr','Bienvenue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','1914','de','Willkommen')");
        //
        $diz140 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_RESELLING_SPORT')");
        $id_diz140 = $db->insert_id($diz140);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','1914','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>L\'hotel è organizzato appositamente per i ciclisti e tutti gli sportivi in genere.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','1914','en','Dear [cliente], welcome at our accommodation.<br>The hotel is specially organized for bikers and all sports in general.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','1914','fr','Cher [cliente], bienvenue à notre hébergement.<br> L\'hôtel est spécialement organisé pour les cyclistes et tous les sports en général.','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','1914','de','Lieber  [cliente], willkommen zu unserer Unterkunft.<br> Das Hotel ist speziell für Motorradfahrer organisiert und alle Sportarten im Allgemeinen.','1')");
        //
        $diz141 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_CHECKIN')");
        $id_diz141 = $db->insert_id($diz141);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','1914','it','Gentile [cliente], compila il tuo Check-in Online')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','1914','en','Dear [cliente], fill out your Online Check-In')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','1914','fr','Cher [cliente], remplissez votre enregistrement en ligne')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','1914','de','Lieber [cliente], füllen Sie Ihre Online-Check-In')");
        //
        $diz142 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_CHECKIN')");
        $id_diz142 = $db->insert_id($diz142);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','1914','it','Gentile [cliente], ansiosi di riceverla presso la nostra struttura ricettiva, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà compilare il modulo di Check-in Online, velocizzando così le procedure d\'ingresso in hotel al momento del suo arrivo!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','1914','en','Dear [cliente], anxious to receive it at our accommodation, please click on the link at the bottom in the mail in a few minutes will be able to complete the Online Check-In form, thus speeding up of procedures at the hotel entrance to upon his arrival!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','1914','fr','Cher [cliente], désireux de le recevoir à notre hébergement, s\'il vous plaît cliquer sur le lien en bas dans le courrier en quelques minutes sera en mesure de remplir le formulaire enregistrement en ligne, accélérant ainsi des procédures à l\'entrée de l\'hôtel pour à son arrivée!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','1914','de','Lieber [cliente], besorgt es bei unserer Unterkunft zu erhalten, klicken Sie bitte auf dem Link unten in der E-Mail in wenigen Minuten in der Lage, das Online-Check-In Formular ausfüllen, damit von Verfahren am Hoteleingang beschleunigt zu bei seiner Ankunft!','1')");
        //
        $diz143 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TXTLINK7')");
        $id_diz143 = $db->insert_id($diz143);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','1914','it','Clicca qui per raggiungere il modulo del Check-in Online!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','1914','en','Click here to reach the form of Online Check-In!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','1914','fr','Cliquez ici pour accéder au formulaire de ligne d\'arrivée!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','1914','de','Klicken Sie hier, um die Form des Online-Check-In zu erreichen!')");
        //
        $diz144 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGINARISERVATA_CHECKIN')");
        $id_diz144 = $db->insert_id($diz144);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','1914','it','Pagina riservata al tuo Check-in Online')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','1914','en','Page reserved to your Online Check-In')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','1914','fr','Page réservée à votre enregistrement en ligne')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','1914','de','Seite reserviert Ihre Online-Check-In')");

        $diz145 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_DISDETTA')");
        $id_diz145 = $db->insert_id($diz145);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','1914','it','Gentile [cliente], la sua prenotazione è stata disdetta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','1914','en','Dear [cliente], your reservation has been canceled')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','1914','fr','Cher [cliente], votre réservation a été annulée')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','1914','de','Lieber [cliente], um Ihre Reservierung wird storniert')");
        //
        $diz146 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_DISDETTA')");
        $id_diz146 = $db->insert_id($diz146);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','1914','it','Gentile [cliente], abbiamo disdetto&nbsp;la sua prenotazione Nr. [NumeroPrenotazione], come da sua richiesta!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','1914','en','Dear [cliente], we canceled your reservation Nr. [NumeroPrenotazione], at his request!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','1914','fr','Cher [cliente], nous avons annul&eacute; votre r&eacute;servation Nr. [NumeroPrenotazione], &agrave; sa demande!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','1914','de','Lieber [cliente], storniert wir Ihre Reservierung Nr. [NumeroPrenotazione], auf seinen Wunsch!','1')");

        $diz147 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','OGGETTO_DISPONIBILITA')");
        $id_diz147 = $db->insert_id($diz147);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','1914','it','Gentile [cliente], per la sua richiesta di soggiorno non abbiamo disponibilità')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','1914','en','Dear [cliente], we do not have availability for your stay request')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','1914','fr','Cher [cliente], nous n\'avons pas la disponibilité pour votre demande de séjour')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','1914','de','Lieber [cliente], wir haben keine Verfügbarkeit für Ihren Aufenthalt')");
        //
        $diz148 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TESTOMAIL_DISPONIBILITA')");
        $id_diz148 = $db->insert_id($diz148);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','1914','it','Gentile [cliente], per le date scelte purtroppo non abbiamo disponibilità presso la nostra struttura ricettiva. Se volesse riformulare una richiesta di preventivo dal nostro sito:[sito], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','1914','en','Dear [cliente], for the dates chosen unfortunately we do not have availability at our accommodation. If you would like to reformulate a quote from our website: [sito], diversifying your stay dates, we would be happy to offer you our best proposal!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','1914','fr','Cher [cliente], pour les dates choisies malheureusement nous n\'avons pas la disponibilité dans notre hébergement. Si vous souhaitez reformuler une citation de notre site: [sito], en diversifiant vos dates de séjour, nous serions heureux de vous proposer notre meilleure proposition!','1')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','1914','de','Lieber [cliente], für die gewählten Daten haben wir leider keine Verfügbarkeit in unserer Unterkunft. Wenn Sie ein Angebot von unserer Website umformulieren möchten: [sito], um Ihre Aufenthaltsdaten zu diversifizieren, würden wir uns freuen, Ihnen unseren besten Vorschlag zu unterbreiten!','1')");

        $diz149 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CAPARRA')");
        $id_diz149 = $db->insert_id($diz149);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','1914','it','Caparra richiesta')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','1914','en','Deposit required')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','1914','fr','Dépôt requis')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','1914','de','Kaution erforderlich')");

        $diz150 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCELTAPROPOSTA')");
        $id_diz150 = $db->insert_id($diz150);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','1914','it','Scelta della proposta di soggiorno, inviata con successo!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','1914','en','Choice of stay proposal, sent successfully!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','1914','fr','Choix de la proposition de séjour, envoyé avec succès!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','1914','de','Wahl des Aufenthaltsvorschlags, erfolgreich gesendet!')");

        $diz151 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCELTAPROPOSTA2')");
        $id_diz151 = $db->insert_id($diz151);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','1914','it','Ora puoi chiudere la pagina ed attendere la prossima e-mail dall\'Hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','1914','en','Now you can close the page and wait for the next e-mail from the Hotel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','1914','fr','Vous pouvez maintenant fermer la page et attendre le prochain e-mail de l\'hôtel!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','1914','de','Jetzt können Sie die Seite schließen und auf die nächste E-Mail vom Hotel warten!')");

        $diz152 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCELTAPROPOSTAFATTA')");
        $id_diz152 = $db->insert_id($diz152);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','1914','it','La proposta di soggiorno è già stata precedentemente scelta, non è possibile re-inviarla!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','1914','en','The stay proposal has already been previously chosen, it is not possible to re-send it!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','1914','fr','La proposition de séjour a déjà été choisie, il n\'est pas possible de la renvoyer!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','1914','de','Der Aufenthaltsvorschlag wurde bereits vorher gewählt, es ist nicht möglich ihn erneut zu senden!')");

        $diz153 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SCONTO')");
        $id_diz153 = $db->insert_id($diz153);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','1914','it','Sconto')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','1914','en','Discount')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','1914','fr','Réduction')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','1914','de','Rabatt')");

        $diz154 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONDIZIONI_TARIFFA')");
        $id_diz154 = $db->insert_id($diz154);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','1914','it','Condizioni tariffa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','1914','en','Tariff conditions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','1914','fr','Conditions tarifaires')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','1914','de','Tarifbedingungen')");


        $diz155 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ACCETTO_POLITICHE')");
        $id_diz155 = $db->insert_id($diz155);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','1914','it','Accetto le politiche di cancellazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','1914','en','I accept the cancellation policy')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','1914','fr','J\'accepte les conditions d\'annulation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','1914','de','Ich akzeptiere die Stornobedingungen')");

        $diz156 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','LEGGI_POLITICHE')");
        $id_diz156 = $db->insert_id($diz156);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','1914','it','Leggi le politiche')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','1914','en','Read the policies')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','1914','fr','Lire les politiques')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','1914','de','Lesen Politik')");

        $diz157 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONDIZIONI')");
        $id_diz157 = $db->insert_id($diz157);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','1914','it','Condizioni')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','1914','en','Conditions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','1914','fr','Conditions')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','1914','de','Geschäftsbedingungen')");


        $diz158 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','VISUALIZZA')");
        $id_diz158 = $db->insert_id($diz158);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','1914','it','Visualizza')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','1914','en','View')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','1914','fr','Vue')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','1914','de','Ansicht')");

        $diz159 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','NASCONDI')");
        $id_diz159 = $db->insert_id($diz159);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','1914','it','Nascondi')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','1914','en','Hide')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','1914','fr','Cacher')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','1914','de','Verstecken')");

        $diz160 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONVERSAZIONE')");
        $id_diz160 = $db->insert_id($diz160);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','1914','it','la conversazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','1914','en','the conversation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','1914','fr','la conversation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','1914','de','die Konversation')");

        $diz161 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','FORM')");
        $id_diz161 = $db->insert_id($diz161);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','1914','it','il Form di Prenotazione')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','1914','en','the Booking Form')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','1914','fr','le formulaire de réservation')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','1914','de','das Buchungsformular')");

        $diz162 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PRENOTA_OFFERTA')");
        $id_diz162 = $db->insert_id($diz162);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','1914','it','PRENOTA ORA LA TUA OFFERTA PERSONALIZZATA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','1914','en','BOOK YOUR CUSTOM OFFER NOW')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','1914','fr','RÉSERVEZ VOTRE OFFRE SPÉCIALE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','1914','de','BUCHEN SIE IHR ANGEBOT JETZT')");

        $diz163 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','MAPPA')");
        $id_diz163 = $db->insert_id($diz163);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','1914','it','Mappa')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','1914','en','Map')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','1914','fr','Carte')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','1914','de','Karte')");

        $diz164 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','ARRIVO')");
        $id_diz164 = $db->insert_id($diz164);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','1914','it','ARRIVO')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','1914','en','ARRIVAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','1914','fr','ARRIVÉE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','1914','de','ANREISE')");

        $diz165 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PARTENZA')");
        $id_diz165 = $db->insert_id($diz165);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','1914','it','PARTENZA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','1914','en','DEPARTURE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','1914','fr','DEPARTURE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','1914','de','ABFAHRT')");

        $diz166 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PERSONE')");
        $id_diz166 = $db->insert_id($diz166);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','1914','it','PERSONE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','1914','en','PEOPLE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','1914','fr','GENS')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','1914','de','MENSCHEN')");

        $diz167 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CAMERE')");
        $id_diz167 = $db->insert_id($diz167);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','1914','it','CAMERE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','1914','en','ROOMS')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','1914','fr','CHAMBRES')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','1914','de','ZIMMER')");

        $diz168 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','TRATTAMENTO')");
        $id_diz168 = $db->insert_id($diz168);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','1914','it','TRATTAMENTO')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','1914','en','TREATMENT')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','1914','fr','TRAITEMENT')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','1914','de','BEHANDLUNG')");

        $diz169 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PREZZO_TOTALE')");
        $id_diz169 = $db->insert_id($diz169);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','1914','it','PREZZO TOTALE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','1914','en','TOTAL PRICE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','1914','fr','PRIX TOTAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','1914','de','GESAMTPREIS')");

        $diz170 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','QUANTITA')");
        $id_diz170 = $db->insert_id($diz170);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','1914','it','QUANTITA\'')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','1914','en','QUANTITY')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','1914','fr','QUANTITÉ')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','1914','de','MENGE')");

        $diz171 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PREZZO_UNITARIO')");
        $id_diz171 = $db->insert_id($diz171);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','1914','it','PREZZO UNITARIO')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','1914','en','UNIT PRICE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','1914','fr','PRIX UNITAIRE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','1914','de','Einheitspreis')");

        $diz172 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','SUBTOTALE')");
        $id_diz172 = $db->insert_id($diz172);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','1914','it','SUBTOTALE')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','1914','en','SUBTOTAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','1914','fr','SUBTOTAL')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','1914','de','SUBTOTAL')");

        $diz173 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PRENOTA_SUBITO')");
        $id_diz173 = $db->insert_id($diz173);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','1914','it','PRENOTA SUBITO QUESTA OFFERTA')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','1914','en','BOOK THIS OFFER IMMEDIATELY')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','1914','fr','RÉSERVEZ CETTE OFFRE IMMÉDIATEMENT')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','1914','de','BUCHEN SIE DIESES ANGEBOT SOFORT')");

        $diz174 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CAPARRA_RICHIESTA')");
        $id_diz174 = $db->insert_id($diz174);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','1914','it','Caparra richiesta:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','1914','en','Deposit required:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','1914','fr','Dépôt requis:')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','1914','de','Anzahlung erforderlich:')");

        $diz175 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONSENSOMARKETING')");
        $id_diz175 = $db->insert_id($diz175);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','1914','it','Do il consenso per ricevere materiale marketing')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','1914','en','I consent to receive marketing material')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','1914','fr','Je consens à recevoir du matériel de marketing')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','1914','de','Ich bin damit einverstanden, Marketingmaterial zu erhalten')");

        $diz178 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','CONSENSOPROFILAZIONE')");
        $id_diz178 = $db->insert_id($diz178);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','1914','it','Voglio ricevere solo le offerte in linea con le preferenze che ho indicato')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','1914','en','I only want to receive offers in line with the preferences I have indicated')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','1914','fr','Je veux seulement recevoir des offres conformes aux préférences que j\'ai indiquées')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','1914','de','Ich möchte nur Angebote erhalten, die den von mir angegebenen Präferenzen entsprechen')");

        $diz179 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PROPOSTAPAGAMENTOSCELTO')");
        $id_diz179 = $db->insert_id($diz179);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','1914','it','La Proposta è già stata confermata con un altro tipo di pagamento!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','1914','en','The proposal has already been confirmed with another type of payment!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','1914','fr','La proposition a déjà été confirmée avec un autre type de paiement!')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','1914','de','Der Vorschlag wurde bereits mit einer anderen Zahlungsart bestätigt!')");

        $diz180 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('1914','it','PAGAMENTOSCELTO')");
        $id_diz180 = $db->insert_id($diz180);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','1914','it','Proposta confermata tramite pagamento con')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','1914','en','Proposal confirmed by payment with')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','1914','fr','Proposition confirmée par paiement avec')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','1914','de','Vorschlag durch Zahlung bestätigt mit')");

        ### RESPONSEFORM
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_NOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Nome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Name')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Nom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Name')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_COGNOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Cognome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Surname')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Prenom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Nachname')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_EMAIL')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Email')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_TELEFONO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Telefono')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Phone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Telephone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Telefon')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_ARRIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Data Arrivo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Arrival date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ankunft')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_PARTENZA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Data Partenza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Departure date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Abreisedatum')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_ARRIVO_ALTERNATIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Arrivo alternativo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Alternative Arrival')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Alternative Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Alternative Ankunft')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_PARTENZA_ALTERNATIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Partenza alternativa')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Alternative Departure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Alternative Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Alternative Abreisedatum')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_TOTALE_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Totale Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Total Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Total Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Total Erwachsene')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_TOTALE_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Totale Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Total Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Total Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Total Kinder')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Erwachsene')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Kinder')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_BAMBINI_ETA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Età')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Age')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Age')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Jahre')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_SISTEMAZIONE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Tipologia camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Rooms')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Chambre')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Zimmer')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_TRATTAMENTO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Trattamento')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Treatment')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Categorie')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Behandlung')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_TARGET')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Tipologia vacanza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Target vacation')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Vacances ciblées')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Zielurlaub')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_MESSAGGIO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Messaggio')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Nachricht')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_H1')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Richiesta informazioni!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Information request!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Demande d\'information!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Informationen anfordern!')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_OGGETTO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Richiesta Informazioni per il sito: [sito] da parte di: [nome]')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Request Information for the site: [sito] by: [nome]')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Demande d\'informations pour le site: [sito] par [nome]')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Fordern Sie Informationen für die Website an: [sito] Von: [nome]')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','RESPONSE_FORM_SUCCESSO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Richiesta Inviata con Successo!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Successfully Received Inquiry!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Demande reçue avec succès!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Anfrage erfolgreich gesendet!')");


        ### FORM
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TARGET')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Tipologia vacanza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Target vacation')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Vacances ciblées')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Zielurlaub')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_LEGENDA_VACANZA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Scegli il tipo o il motivo della tua vacanza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Choose the type or the reason for your holiday')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Choisissez le type ou la raison de vos vacances')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Wählen Sie die Art oder den Grund für Ihren Urlaub')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_COMUNICAZIONI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Qualcosa da comunicarci')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Something to tell us')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Quelque chose à nous dire')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Etwas zu erzählen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TUO_SOGGIORNO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Dati del soggiorno')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Your stay data')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Vos données de séjour')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ihre Aufenthaltsdaten')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_DATE_SOGGIORNO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Date del soggiorno')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Dates of stay')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Dates de séjour')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Daten des Aufenthalts')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_DATI_PERSONALI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Dati personali')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Personal data')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Données personnelles')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Persönliche Daten')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TEAXT_LOADER')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Qualche istante.... Sta per apparire il MODULO di richiesta informazioni dedicato al <b>CRM QUOTO</b>!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','A few moments .... The information request form dedicated to <b>CRM QUOTO</b> is about to appear!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Quelques instants .... Le formulaire de demande d\'informations dédié à <b>CRM QUOTO</b> est sur le point d\'apparaître!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ein paar Augenblicke ... Das Informationsanforderungsformular für <b>CRM QUOTO</b> ist in Kürze verfügbar!')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_NOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Nome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Name')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Nom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Name')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_COGNOME')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Cognome')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Surname')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Prenom')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Nachname')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_EMAIL')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Email')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Email')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TELEFONO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Telefono')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Phone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Telephone')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Telefon')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_ARRIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Data Arrivo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Arrival date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ankunft')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_PARTENZA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Data Partenza')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Departure date')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Abreisedatum')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_ARRIVO_ALTERNATIVO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Arrivo alternativo')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Alternative Arrival')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Alternative Arrivee')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Alternative Ankunft')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_PARTENZA_ALTERNATIVA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Partenza alternativa')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Alternative Departure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Alternative Départure')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Alternative Abreisedatum')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TOTALE_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Nr.Totale Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Nr.Total Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Nr.Total Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Nr.Total Erwachsene')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TOTALE_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Nr.Totale Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Nr.Total Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Nr.Total Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Nr.Total Kinder')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_SISTEMAZIONE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Tipologia camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Type of room')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Type de chambre')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Zimmertyp')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_CAMERE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Camere')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Rooms')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Chambres')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Zimmer')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_TRATTAMENTO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Trattamento')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Treatment')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Categorie')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Behandlung')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_ADULTI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Adulti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Adults')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Adultes')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Erwachsene')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_BAMBINI')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Bambini')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Children')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Enfants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Kinder')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_BAMBINI_ETA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Età: 1,3 mesi,<1')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Age: 1,3 months,<1')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Age: 1,3 mois,<1')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Alter: 1,3 Monate,<1')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_LEGENDA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Scegli e/o aggiungi il trattamento e distribuisci i partecipanti')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Choose and/or add the treatment and distribute the participants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Choisissez et/ou ajoutez le traitement et répartissez les participants')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Wählen und/oder fügen Sie die Behandlung hinzu und verteilen Sie die Teilnehmer')");
        
        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_ADD_DATE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','aggiungi date alternative')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','add alternative dates')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','ajouter des dates alternatives')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','alternative Termine hinzufügen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_REM_DATE')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','elimina date alternative')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','delete alternative dates')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','supprimer des dates alternatives')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','alternative Termine löschen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_ADD_ROOM')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','aggiungi camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','add room')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','ajouter de la place')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','raum hinzufügen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_REM_ROOM')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','rimuovi camera')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','remove room')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','retirer la pièce')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','zimmer entfernen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_MESSAGGIO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Messaggio')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Message')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Nachricht')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_INVIA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Invia Richiesta')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Send Request')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Envoyer demande')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Anfrage senden')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_CONSENSO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Ho preso visione dell\'informativa privacy - ')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','I have read the privacy policy - ')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','J\'ai lu la politique de confidentialité - ')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ich habe die Datenschutzerklärung gelesen - ')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_LINK_INFORMATIVA')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Visualizza Informativa')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','View Information')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Voir les informations')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Informationen anzeigen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_CONSENSO2')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Do il consenso per ricevere materiale marketing')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','I consent to receive marketing material')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','J\'accepte de recevoir du matériel de marketing')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ich bin damit einverstanden, Marketingmaterial zu erhalten')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_CONSENSO3')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Voglio ricevere le offerte in linea con le preferenze che ho indicato')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','I want to receive offers in line with the preferences I have indicated')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Je veux recevoir des offres conformes aux préférences que j\'ai indiquées')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Ich möchte Angebote erhalten, die den von mir angegebenen Präferenzen entsprechen')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_PRIVACY')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Inserire informativa su SuiteWeb')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Inserire informativa su SuiteWeb')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Inserire informativa su SuiteWeb')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Inserire informativa su SuiteWeb')");

        $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('1914','it','FORM_SUCCESSO')");
        $id_diz =  $db->insert_id($diz);
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','it','Richiesta Inviata con Successo!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','en','Successfully Received Inquiry!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','fr','Demande reçue avec succès!')");
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','1914','de','Anfrage erfolgreich gesendet!')");

        // gestione configuratore
        $descr_select_tipo_camere .= 'Nel box select del campo TIPO CAMERE in CREA NUOVA PROPOSTA'."\r\n";
        $descr_select_tipo_camere .= 'Impostando il valore : '."\r\n";
        $descr_select_tipo_camere .= '0 = default'."\r\n";
        $descr_select_tipo_camere .= '1 = select con ricerca integrata'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','select_tipo_camere','".$descr_select_tipo_camere."','0')");
        #
        $descr_checkemail_verify .= 'Check per avere il controllo email tramite record MX'."\r\n";
        $descr_checkemail_verify .= 'Impostando il valore : '."\r\n";
        $descr_checkemail_verify .= '0 = il controllo non viene fatto'."\r\n";
        $descr_checkemail_verify .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_verify_email','".$descr_checkemail_verify."','1')");

        $descr_pagination .= 'Check per avere il ritorno alla pagina selezionata dopo una modifica'."\r\n";
        $descr_pagination .= 'Impostando il valore : '."\r\n";
        $descr_pagination .= '0 = il controllo non viene fatto'."\r\n";
        $descr_pagination .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_pagination','".$descr_pagination."','1')");

        $descr_paypal .= 'Check per avere la possibilità di pagare tramite PayPal'."\r\n";
        $descr_paypal .= 'Impostando il valore : '."\r\n";
        $descr_paypal .= '0 = il controllo non viene fatto'."\r\n";
        $descr_paypal .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_paypal','".$descr_paypal."','1')");

        $descr_gateway .= 'Check per avere la ppossibilità di pagare tramite Gateway Bancario'."\r\n";
        $descr_gateway .= 'Impostando il valore : '."\r\n";
        $descr_gateway .= '0 = il controllo non viene fatto'."\r\n";
        $descr_gateway .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_gateway_bancario','".$descr_gateway."','0')");

        $descr_virtualpay .= 'Check per avere la possibilità di pagare tramite Virtual Pay'."\r\n";
        $descr_virtualpay .= 'Impostando il valore : '."\r\n";
        $descr_virtualpay .= '0 = il controllo non viene fatto'."\r\n";
        $descr_virtualpay .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_virtualpay','".$descr_virtualpay."','0')");


        $descr_notifiche .= 'Check per abiltare o disabilitare le notifiche in push'."\r\n";
        $descr_notifiche .= 'Impostando il valore : '."\r\n";
        $descr_notifiche .= '0 = notifiche si NON vedono'."\r\n";
        $descr_notifiche .= '1 = notifiche si vedono'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_notifiche_push','".$descr_notifiche."','1')");

        $descr_box .= 'Impostazioni per box servizi aggiuntivi'."\r\n";
        $descr_box .= 'Impostando il valore : '."\r\n";
        $descr_box .= '0 = il box dei servizi aggiuintivi parte da chiuso'."\r\n";
        $descr_box .= '1 = il box dei servizi aggiuintivi parte da aperto'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_open_servizi','".$descr_box."','1')");

        $descr_stripe .= 'Check per avere la possibilità di pagare tramite STRIPE'."\r\n";
        $descr_stripe .= 'Impostando il valore : '."\r\n";
        $descr_stripe .= '0 = il controllo non viene fatto'."\r\n";
        $descr_stripe .= '1 = il controllo è attivo'."\r\n";
        $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('1914','check_stripe','".$descr_stripe."','1')");



        ?>