<?php

                $query = "SELECT utenti.idsito, siti.web 
                            FROM utenti 
                            INNER JOIN siti ON siti.idsito = utenti.idsito 
                            WHERE 1=1
                            AND utenti.blocco_accesso = 0 
                            AND siti.hospitality = 1
                            ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                            AND siti.data_start_hospitality <= '".date('Y-m-d')."' 
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        foreach($res as $k => $v){

         #NEW
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#789D2B','#85255D')");
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#8A1702','#CA9822')");
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#248230','#A8342E')");
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#FFBF00','#663300')");
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#FF4000','#003366')");
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#CF6F55','#643D43')"); 
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#A8672E','#1D6066')");  
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#DC3B60','#105583')"); 
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#A6875D','#000000')"); 
         $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#FFA317','#000001')"); 

           
        }



?>