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


               /*  $oggetto = 'Per condividere la vostra esperienza con tutto il resto del mondo! Hotel Crozzon';
                $testo_email ='Gentile <b>'.$Ospite.'</b>,
                                <br>
                                con molto piacere, abbiamo notato dalla compilazione del questionario per la <b>Soddisfazione del Cliente</b>, che si è trovato molto bene da noi all\'Hotel Crozzon!
                                <br>
                                Le saremmo immensamenti grati se volesse scrivere una breve recensione sul portale <b>TripAdvisor</b>
                                <br><br>
                                Ringraziandola ancora di aver soggiornato nella nostra struttura e fiduciosi di poterla riavere come nostro Ospite, le inviamo il link per la recensione: <b>Tripadvisor</b> – <a href="'.$tripadvisor.'">clicca qui</a>
                                <br><br>
                                Cordiali saluti.
                                <br>
                                <b>Famiglia Masè e tutto lo staff dell\'Hotel Crozzon</b><br>
                                <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</em></p>'; */
           
                $oggetto_it = 'Gentile ospite saremmo lieti se volesse lasciare una recensione in merito al suo soggiorno presso la nostra struttura: [struttura]';
                $testo_email_it ='Gentile <b>[cliente]</b>,<br>
                                            abbiamo notato dalla compilazione del questionario per la <b>Soddisfazione del Cliente</b> in Hotel, che si è trovato bene presso la nostra struttura ricettiva!
                                            <br>
                                            Le saremmo immensamenti grati se volesse scrivere una breve recensione sul portale <b>TripAdvisor</b>
                                            <br><br>
                                            Ringraziandola ancora di aver soggiornato nella nostra struttura e fiduciosi di poterla riavere come nostro Ospite, le inviamo il link per la recensione:
                                            <br>
                                            <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                            <br><br>
                                            Cordiali saluti.
                                            <br>
                                            <b>[operatore] - [struttura]</b><br>
                                            <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</em></p>';
      
            $oggetto_en = 'Dear guest, we would be pleased if you would like to leave a review about your stay at our facility: [struttura]';
            $testo_email_en ='Dear <b>[cliente]</b>, <br>
                                            we noticed from the completion of the <b> Customer Satisfaction </b> questionnaire in the Hotel, which found itself well at our accommodation!
                                            <br>
                                            We would be grateful if you would like to write a short review on the <b> TripAdvisor </b> portal
                                            <br>
                                            Thanking you again for having stayed in our structure and trusting to be able to have it back as our Guest, we send you the link for the review:
                                            <br>
                                            <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                            <br>
                                            Best regards.
                                        <br>
                                        <b>[operatore] - [struttura]</b><br>
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>This e-mail was sent automatically by the software, do not reply to this e-mail!</em></p>';
       
            $oggetto_fr = 'Cher client, nous serions heureux si vous souhaitez laisser un commentaire sur votre séjour dans notre établissement: [struttura]';
            $testo_email_fr ='Cher <b>[cliente]</b>, <br>
                                            nous avons remarqué à la fin du questionnaire <b> satisfaction de la clientèle </b> dans l\'hôtel, qui s\'est bien trouvé dans notre logement!
                                            <br>
                                            Nous vous serions reconnaissants de bien vouloir rédiger une brève critique sur le portail <b> TripAdvisor </b>
                                            <br>
                                            En vous remerciant encore d\'être resté dans notre structure et en ayant confiance pour pouvoir le récupérer en tant qu\'invité, nous vous envoyons le lien pour la revue:
                                        <br>
                                        <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                        <br><br>
                                        Cordialement.
                                        <br>
                                        <b>[operatore] - [struttura]</b><br>
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Cet e-mail a été envoyé automatiquement par le logiciel, ne répondez pas à cet e-mail!</em></p>';
      
            $oggetto_de = 'Sehr geehrter Gast, wir würden uns freuen, wenn Sie eine Bewertung über Ihren Aufenthalt in unserer Einrichtung hinterlassen möchten: [struttura]';
            $testo_email_de ='Lieber <b>[cliente]</b>, <br>
                                        Wir haben von der Fertigstellung des Fragebogens <b> Kundenzufriedenheit </b> im Hotel erfahren, der sich in unserer Unterkunft wiederfand!
                                        <br>
                                        Wir wären Ihnen dankbar, wenn Sie eine kurze Kritik auf dem <b> TripAdvisor </b> -Portal schreiben möchten
                                        <br>
                                        Wir danken Ihnen nochmals, dass Sie in unserer Struktur geblieben sind und darauf vertrauen, dass wir sie als Gast wieder haben können. Wir senden Ihnen den Link für die Bewertung:
                                        <br>
                                        <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                        <br><br>
                                        Mit freundlichen Grüßen.
                                        <br>
                                        <b>[operatore] - [struttura]</b><br>
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Diese E-Mail wurde von der Software automatisch verschickt, antworten Sie nicht auf diese E-Mail!</em></p>';

foreach($res as $k => $v){

        $diz5 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','OGGETTO_TRIPADVISOR')");
        $id_diz5 = $db->insert_id($diz5);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".$v['idsito']."','it','".addslashes($oggetto_it)."')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".$v['idsito']."','en','".addslashes($oggetto_en)."')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".$v['idsito']."','fr','".addslashes($oggetto_fr)."')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".$v['idsito']."','de','".addslashes($oggetto_de)."')");

        $diz1 = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','TESTO_EMAIL_TRIPADVISOR')");
        $id_diz1 = $db->insert_id($diz1);
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','it','".addslashes($testo_email_it)."')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','en','".addslashes($testo_email_en)."')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','fr','".addslashes($testo_email_fr)."')");
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','de','".addslashes($testo_email_de)."')");

        

}



?>
