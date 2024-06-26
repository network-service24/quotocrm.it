<?php
if($_REQUEST['azione']!=''){


        $select    = "SELECT * FROM hospitality_servizi_camera WHERE Id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

       $idsito        = $row['idsito'];
       $Lingua        = $row['Lingua'];
       $Servizio      = $row['Servizio'];    
       $Abilitato     = $row['Abilitato'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_servizi_camera(
                                                idsito,
                                                Lingua,
                                                Servizio,
                                                Abilitato
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$Lingua."',
                                                'DUPLICATO_".addslashes($Servizio)."',
                                                '".$Abilitato."')";
      $dbMysqli->query($insert);

      $ServizioId = $fun->lastInsertId(IDSITO,'hospitality_servizi_camera','Id');

        $sel = "SELECT * FROM hospitality_servizi_camere_lingua WHERE servizi_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $rws = $dbMysqli->query($sel);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id, 
                                                      idsito,
                                                      lingue,                                              
                                                      Servizio,
                                                      Descrizione
                                                      ) VALUES (
                                                      '".$ServizioId."',
                                                      '".$value['idsito']."', 
                                                      '".$value['lingue']."',
                                                      '".addslashes($value['Servizio'])."', 
                                                      '".addslashes($value['Descrizione'])."')"); 

        }
    }

    header('Location:'.BASE_URL_SITO.'disponibilita-servizi_camera/');
} 