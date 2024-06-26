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


    $select = "SELECT * FROM dizionario_form_quoto WHERE idsito = ".$v['idsito']." AND etichetta = 'RESPONSE_FORM_CODICE_SCONTO'";
    $sel = $db->query($select);
    $tot = sizeof($db->result($sel));
    if($tot==0){ 
            $diz1 = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','RESPONSE_FORM_CODICE_SCONTO')");
            $id_diz1 = $db->insert_id($diz1);
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','it','Codice Sconto')");
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','en','Discount code')");
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','fr','Code de réduction')");
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".$v['idsito']."','de','Rabattcode')");
   }

}



?>
