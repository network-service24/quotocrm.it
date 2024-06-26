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


$oggetto_covid19_it = 'Emesso Buono Voucher per [cliente] in riferimento Nr.Prenotazione [numeropreno]';
$oggetto_covid19_en = 'Voucher issued for [cliente] reference No. Reservation [numeropreno]';
$oggetto_covid19_fr = 'Bon émis pour le numéro de référence [cliente] Réservation [numeropreno]';
$oggetto_covid19_de = 'Gutschein ausgestellt für [cliente] Referenznummer Reservierung [numeropreno]';

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

foreach($res as $k => $v){


        $select2 = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'TESTO_VOUCHER_RECUPERO'";
        $sel2 = $db->query($select2);
        $rc = $db->row($sel2);
        if(is_array($rc)) {
                if($rc > count($rc)) // se la pagina richiesta non esiste
                    $tt = count($rc); // restituire la pagina con il numero più alto che esista
            }else{
                $tt = 0;
            }
        if($tt>0){


                $db->query("UPDATE hospitality_dizionario_lingua SET testo = '".addslashes($descr_it)."' WHERE id_dizionario = '".$rc['id']."' AND idsito = '".$v['idsito']."' AND Lingua ='it'");
                $db->query("UPDATE hospitality_dizionario_lingua SET testo = '".addslashes($descr_en)."' WHERE id_dizionario = '".$rc['id']."' AND idsito = '".$v['idsito']."' AND Lingua ='en'");
                $db->query("UPDATE hospitality_dizionario_lingua SET testo = '".addslashes($descr_fr)."' WHERE id_dizionario = '".$rc['id']."' AND idsito = '".$v['idsito']."' AND Lingua ='fr'");
                $db->query("UPDATE hospitality_dizionario_lingua SET testo = '".addslashes($descr_de)."' WHERE id_dizionario = '".$rc['id']."' AND idsito = '".$v['idsito']."' AND Lingua ='de'");
        }
    

}



?>
