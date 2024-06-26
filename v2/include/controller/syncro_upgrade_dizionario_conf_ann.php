<?php

 $testo_it = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per la vostra conferma <b>Nr. [NumeroPrenotazione]</b> con proposta soggiorno dal <b>[Arrivo]</b> al <b>[Partenza]</b>, purtroppo non abbiamo disponibilità presso la nostra struttura ricettiva. 
                <br><br>                                      
                Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta! 
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';

$testo2_it = 'Gentile <b>[cliente]</b>,  
                <br><br>
                ci spiace appurare la vostra rinuncia sulla conferma <b>Nr. [NumeroPrenotazione]</b> per la proposta soggiorno dal <b>[Arrivo]</b> al <b>[Partenza]</b>. 
                <br><br>                                      
                Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], saremmo lieti di offrirle la nostra miglior proposta! 
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';

$testo3_it = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per la vostra conferma <b>Nr. [NumeroPrenotazione]</b> con proposta soggiorno dal <b>[Arrivo]</b> al <b>[Partenza]</b>, ......... 
                <br><br>                                      
                Cordiali saluti		
                <br><br>
                [struttura]';

$testo_en = 'Dear <b>[cliente]</b>,
                <br><br>
                for your confirmation <b> Nr. [NumeroPrenotazione] </b> with proposed stay from <b> [Arrivo] </b> to <b> [Partenza] </b>, unfortunately we do not have availability at our facility receptive.
                <br><br>
                If you would like to reformulate a request for a quote from our website: [sitoweb], diversifying the dates of your stay, we would be happy to offer you our best proposal!
                <br><br>
                Sincerely
                <br><br>
                [struttura]';

$testo2_en = 'Dear <b>[cliente]</b>,
                <br><br>
                we are sorry to ascertain your waiver on the confirmation <b> Nr. [NumeroPrenotazione] </b> for the proposed stay from <b> [Arrivo] </b> to <b> [Partenza] </b>.
                <br><br>
                If you would like to reformulate a request for a quote from our website: [sitoweb], we would be happy to offer you our best proposal!
                <br><br>
                Sincerely
                <br><br>
                [struttura]';

$testo3_en = 'Dear <b>[cliente]</b>,
                <br><br>
                for your confirmation <b> Nr. [NumeroPrenotazione] </b> with proposed stay from <b> [Arrivo] </b> to <b> [Partenza] </b>, ........
                <br><br>
                Sincerely
                <br><br>
                [struttura]';

$testo_fr = 'Cher <b>[cliente]</b>,
                <br><br>
                pour votre confirmation <b> Nr. [NumeroPrenotazione] </b> avec séjour proposé de <b> [Arrivo] </b> à <b> [Partenza] </b>, malheureusement nous n\'avons pas de disponibilité à notre établissement réceptif. 
                <br><br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], en diversifiant les dates de votre séjour, nous serions heureux de vous proposer notre meilleure proposition!
                <br><br>
                Cordialement
                <br><br>
                [struttura]';

$testo2_fr = 'Cher <b>[cliente]</b>,
                <br><br>
                nous sommes désolés de vérifier votre renonciation sur la confirmation <b> Nr. [NumeroPrenotazione] </b> pour le séjour proposé de <b> [Arrivo] </b> à <b> [Partenza] </b>.
                <br><br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], nous serions heureux de vous proposer notre meilleure proposition!
                <br><br>
                Cordialement
                <br><br>
                [struttura]';

$testo3_fr = 'Cher <b>[cliente]</b>,
                <br><br>
                pour votre confirmation <b> Nr. [NumeroPrenotazione] </b> avec séjour proposé de <b> [Arrivo] </b> à <b> [Partenza] </b>, ......
                <br><br>
                Cordialement
                <br><br>
                [struttura]';

$testo_de = 'Sehr geehrter <b>[cliente]</b>,
                <br><br>
                für Ihre Bestätigung <b> Nr. [NumeroPrenotazione] </b> mit vorgeschlagenem Aufenthalt von <b> [Arrivo] </b> bis <b> [Partenza] </b>, leider haben wir keine Verfügbarkeit bei uns Einrichtung empfänglich. 
                <br><br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], um die Daten Ihres Aufenthalts zu diversifizieren, bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br><br>
                Mit freundlichen Grüßen
                <br><br>
                [struttura]';

$testo2_de = 'Sehr geehrter <b>[cliente]</b>,
                <br><br>
                Es tut uns leid, dass Sie Ihren Verzicht auf der Bestätigung <b> Nr. [NumeroPrenotazione] </b> für den vorgeschlagenen Aufenthalt von <b> [Arrivo] </b> bis <b> [Partenza] </b>.
                <br><br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br><br>
                Mit freundlichen Grüßen
                <br><br>
                [struttura]';

$testo3_de = 'Sehr geehrter <b>[cliente]</b>,
                <br><br>
                für Ihre Bestätigung <b> Nr. [NumeroPrenotazione] </b> mit vorgeschlagenem Aufenthalt von <b> [Arrivo] </b> bis <b> [Partenza] </b>, ..........
                <br><br>
                Mit freundlichen Grüßen
                <br><br>
                [struttura]';

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

##PRIMO TESTO
        $select = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'TESTOMAIL_ANNULLA_CONFERMA_NODISPO'";
        $sel = $db->query($select);
        $tot = sizeof($db->result($sel));
        if($tot==0){
                $diz1 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','TESTOMAIL_ANNULLA_CONFERMA_NODISPO')");
                $id_diz1 = $db->insert_id($diz1);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','it','".addslashes($testo_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','en','".addslashes($testo_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','fr','".addslashes($testo_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','de','".addslashes($testo_de)."','1')");
        }
 ##SECONDO TESTO
        $select2 = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'TESTOMAIL_ANNULLA_CONFERMA_RINUNCIA'";
        $sel2 = $db->query($select2);
        $tot2 = sizeof($db->result($sel2));
        if($tot2==0){
                $diz2 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','TESTOMAIL_ANNULLA_CONFERMA_RINUNCIA')");
                $id_diz2 = $db->insert_id($diz2);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2."','".$v['idsito']."','it','".addslashes($testo2_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2."','".$v['idsito']."','en','".addslashes($testo2_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2."','".$v['idsito']."','fr','".addslashes($testo2_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2."','".$v['idsito']."','de','".addslashes($testo2_de)."','1')");
        }
 ##TERZO TESTO
        $select3 = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'TESTOMAIL_ANNULLA_CONFERMA_ALTRO'";
        $sel3 = $db->query($select3);
        $tot3 = sizeof($db->result($sel3));
        if($tot3==0){
                $di3 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','TESTOMAIL_ANNULLA_CONFERMA_ALTRO')");
                $id_diz3 = $db->insert_id($diz3);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3."','".$v['idsito']."','it','".addslashes($testo3_it)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3."','".$v['idsito']."','en','".addslashes($testo3_en)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3."','".$v['idsito']."','fr','".addslashes($testo3_fr)."','1')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3."','".$v['idsito']."','de','".addslashes($testo3_de)."','1')");
        }

}



?>
