<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$testo_it_dispo = 'Gentile <b>[cliente]</b>,  
            <br><br>
            per le date che aveva scelto <b>[Arrivo]</b> al <b>[Partenza]</b>, è tornata la disponibilità presso la nostra struttura ricettiva.
            <br><br>  
            Se fosse ancora interressato al preventivo che le avevamo mandato, saremmo lieti di re-inviarle la nostra miglior proposta!                                    
            <br><br>
            Cordiali saluti		
            <br><br>
            [struttura]';                          

$testo_en_dispo = 'Dear <b> [cliente] </b>,
            <br> <br>
            for the dates that he had chosen <b> [Arrivo] </b> to <b> [Partenza] </b>, the availability at our accommodation is back.
            <br> <br>
            If you are still interested in the quote we sent you, we would be happy to re-send you our best proposal!
            <br> <br>
            Sincerely
            <br> <br>
            [struttura] ';  

$testo_fr_dispo = 'Cher <b> [cliente] </b>,
            <br> <br>
            pour les dates qu\'il avait choisies <b> [Arrivo] </b> à <b> [Partenza] </b>, la disponibilité de notre hébergement est de retour.
            <br> <br>
            Si vous êtes toujours intéressé par le devis que nous vous avons envoyé, nous nous ferons un plaisir de vous renvoyer notre meilleure proposition!
            Cordialement
            <br> <br>
            [struttura] ';  


$testo_de_dispo = 'Sehr geehrter <b> [cliente] </b>,
            <br> <br>
            für die von ihm gewählten Daten <b> [Arrivo] </b> bis <b> [Partenza] </b> ist die Verfügbarkeit in unserer Unterkunft wieder da.
            <br> <br>
            Wenn Sie immer noch an dem Angebot interessiert sind, das wir Ihnen gesendet haben, senden wir Ihnen gerne unser bestes Angebot erneut zu!
            <br> <br>
            Mit freundlichen Grüßen
            <br> <br>
            [struttura] ';
 

 $query = "SELECT distinct(siti.idsito)
                FROM siti
                WHERE siti.hospitality = 1
                AND siti.data_end_hospitality > '".date('Y-m-d')."'
                GROUP BY siti.idsito
                ORDER BY siti.idsito DESC";
$res = $dbMysqli->query($query);


foreach($res as $k => $v){

##PRIMO TESTO
        $select = "SELECT * FROM hospitality_dizionario WHERE idsito = ".$v['idsito']." AND etichetta = 'TESTOMAIL_RITORNO_DISPONIBILITA'";
        $sel = $dbMysqli->query($select);
        $tot = sizeof($sel);
        if($tot==0){
                $diz1 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','TESTOMAIL_RITORNO_DISPONIBILITA')");
                $id_diz1 = $dbMysqli->getInsertId($diz1);
                $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','it','".addslashes($testo_it_dispo)."','1')");
                $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','en','".addslashes($testo_en_dispo)."','1')");
                $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','fr','".addslashes($testo_fr_dispo)."','1')");
                $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1."','".$v['idsito']."','de','".addslashes($testo_de_dispo)."','1')");
                
                echo 'inserite voci '.$tot.' per il sito '.$v['idsito'];
        }


}



?>
