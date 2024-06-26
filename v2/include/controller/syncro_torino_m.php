<?php
// MOTIVAZIONI VOSUCHER CANCELLAZIONE

        $sync =$db->query("INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,DataValidita,Motivazione,Abilitato) VALUES('1914','it','".(date('Y')+1)."-".date('m-d')."','COVID19','1')");
        $id_sync = $db->insert_id($sync);
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','1914','it','COVID19','".addslashes($oggetto_covid19_it)."','".addslashes($descr_covid19_it)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','1914','en','COVID19','".addslashes($oggetto_covid19_en)."','".addslashes($descr_covid19_en)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','1914','fr','COVID19','".addslashes($oggetto_covid19_fr)."','".addslashes($descr_covid19_fr)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','1914','de','COVID19','".addslashes($oggetto_covid19_de)."','".addslashes($descr_covid19_de)."')");
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

        $sync2 =$db->query("INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,DataValidita,Motivazione,Abilitato) VALUES('1914','it','".date('Y')."-".(date('m')+6)."-".date('d')."','Malattia','1')");
        $id_sync2 = $db->insert_id($sync);
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','1914','it','Malattia','".addslashes($oggetto_malattia_it)."','".addslashes($descr_malattia_it)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','1914','en','Disease','".addslashes($oggetto_malattia_en)."','".addslashes($descr_malattia_en)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','1914','fr','Maladie','".addslashes($oggetto_malattia_fr)."','".addslashes($descr_malattia_fr)."')");
        $db->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','1914','de','Krankheit','".addslashes($oggetto_malattia_de)."','".addslashes($descr_malattia_de)."')");                       
        // FINE
?>