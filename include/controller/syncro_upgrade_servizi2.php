<?php

                $query = "SELECT siti.idsito
                            FROM siti 
                            WHERE siti.hospitality = 1 
                            AND siti.data_end_hospitality > '".date('Y-m-d')."' 
                            ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."                        
                            GROUP BY siti.idsito
                            ORDER BY siti.data_start_hospitality DESC";
        $res = $dbMysqli->query($query);


        $tot      = '';
        $select   = '';

    foreach($res as $k => $v){


        // SERVIZI AGGIUNTIVI
        $seT0 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','assicurazione.png','Assicurazione','','A percentuale','1')");
        $id_seT0 = $dbMysqli->getInsertId($seT0);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/assicurazione.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/assicurazione.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".$v['idsito']."','it','Assicurazione','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".$v['idsito']."','en','Insurance','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".$v['idsito']."','fr','Assurance','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".$v['idsito']."','de','Versicherung','')");

                #
        $seT10 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('".$v['idsito']."','it','tassa_soggiorno.png','Tassa di Soggiorno','','A persona','1')");
        $id_seT10 = $dbMysqli->getInsertId($seT10);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/tassa_soggiorno.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/tassa_soggiorno.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".$v['idsito']."','it','Tassa di Soggiorno','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".$v['idsito']."','en','City tax','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".$v['idsito']."','fr','Taxe de séjour','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".$v['idsito']."','de','Stadtsteuer','')");
    }
       
?>