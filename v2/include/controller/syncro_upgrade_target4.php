<?php

                $query = "SELECT  siti.*
                            FROM siti
                            WHERE siti.hospitality = 1
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'
                            AND siti.id_status <> 5
                            GROUP BY  siti.idsito
                            ORDER BY siti.data_start_hospitality DESC";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $dir_sito = '';
        $dir_tmp  = '';
        $tot      = '';
        $select   = '';

        foreach($res as $k => $v){

               $select = "SELECT * FROM hospitality_target WHERE idsito = ".$v['idsito']." AND (Target = 'Inverno famiglia' OR  Target = 'inverno famiglia')";
               $result = $db->query($select);
               $rec = $db->result($result);

                if(sizeof($rec)==0){
                    $db->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".$v['idsito']."','Inverno famiglia','1','1')");

                }
  
                $select2 = "SELECT * FROM hospitality_target WHERE idsito = ".$v['idsito']." AND (Target = 'Estate famiglia' OR Target = 'estate famiglia') ";
                $result2 = $db->query($select2);
                $rec2 = $db->result($result2);
 
                 if(sizeof($rec2)==0){
                     $db->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".$v['idsito']."','Estate famiglia','1','1')");
 
                 }  
                 
                $select = "SELECT * FROM hospitality_target WHERE idsito = ".$v['idsito']." AND (Target = 'Inverno sport' OR  Target = 'inverno sport')";
                $result = $db->query($select);
                $rec = $db->result($result);

                if(sizeof($rec)==0){
                    $db->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".$v['idsito']."','Inverno sport','1','1')");

                }

                $select2 = "SELECT * FROM hospitality_target WHERE idsito = ".$v['idsito']." AND (Target = 'Estate sport' OR Target = 'estate sport') ";
                $result2 = $db->query($select2);
                $rec2 = $db->result($result2);

                if(sizeof($rec2)==0){
                    $db->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".$v['idsito']."','Estate sport','1','1')");

                }                  

                $select = "SELECT * FROM hospitality_target WHERE idsito = ".$v['idsito']." AND (Target = 'Inverno coppie' OR  Target = 'inverno coppie')";
                $result = $db->query($select);
                $rec = $db->result($result);
 
                 if(sizeof($rec)==0){
                     $db->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".$v['idsito']."','Inverno coppie','1','1')");
 
                 }
   
                 $select2 = "SELECT * FROM hospitality_target WHERE idsito = ".$v['idsito']." AND (Target = 'Estate coppie' OR Target = 'estate coppie') ";
                 $result2 = $db->query($select2);
                 $rec2 = $db->result($result2);
  
                  if(sizeof($rec2)==0){
                      $db->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".$v['idsito']."','Estate coppie','1','1')");
  
                  }  

        }

        $content = 'salvataggio dei target associati al nuovo template effettuato con successo!!';

?>