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


foreach($res as $k => $v){

        $select2 = "SELECT * FROM dizionario_form_quoto WHERE idsito = ".$v['idsito']." AND etichetta = 'RESPONSE_FORM_ANIMALI_AMMESSI'";
        $sel2 = $db->query($select2);
        $tot2 = sizeof($db->result($sel2));
        if($tot2==0){

            $diz = $db->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','RESPONSE_FORM_ANIMALI_AMMESSI')");
            $id_diz =  $db->insert_id($diz);
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".$v['idsito']."','it','Viaggiamo con animali domestici')");
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".$v['idsito']."','en','We travel with pets')");
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".$v['idsito']."','fr','Nous voyagons avec des animaux domestiques')");
            $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".$v['idsito']."','de','Wir reisen mit Haustieren')");

         }


}



?>
