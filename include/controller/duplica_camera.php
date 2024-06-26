<?php
if($_REQUEST['azione']!=''){

        $select    = "SELECT * FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

       // dati camera
       $idsito     = $row['idsito'];
       $Lingua     = $row['Lingua'];
       $Servizi    = $row['Servizi'];
       $TipoCamere = $row['TipoCamere'];    
       $Abilitato  = $row['Abilitato'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_tipo_camere(
                                                idsito,
                                                Lingua,
                                                Servizi,
                                                TipoCamere,
                                                Abilitato
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$Lingua."',
                                                '".addslashes($Servizi)."',
                                                'DUPLICATO_".addslashes($TipoCamere)."',
                                                '".$Abilitato."')";
      $dbMysqli->query($insert);

      $CamereId = $fun->lastInsertId(IDSITO,'hospitality_tipo_camere','Id');

        $sel = "SELECT * FROM hospitality_camere_testo WHERE camere_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $rws = $dbMysqli->query($sel);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id, 
                                                      idsito,
                                                      lingue,                                              
                                                      Camera,
                                                      Descrizione
                                                      ) VALUES (
                                                      '".$CamereId."',
                                                      '".$value['idsito']."', 
                                                      '".$value['lingue']."',
                                                      '".addslashes($value['Camera'])."', 
                                                      '".addslashes($value['Descrizione'])."')"); 

        }
    }

    $select    = "SELECT * FROM hospitality_listino_camere WHERE IdCamera = ".$_REQUEST['azione'];
    $array_row = $dbMysqli->query($select);

    if(sizeof($array_row) > 0){

        foreach ($array_row as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_listino_camere(idsito, 
                                                      IdSoggiorno,
                                                      IdCamera,                                              
                                                      PeriodoDal,
                                                      PeriodoAl,
                                                      PrezzoCamera,
                                                      Abilitato
                                                      ) VALUES (
                                                      '".$value['idsito']."',
                                                      '".$value['IdSoggiorno']."', 
                                                      '".$CamereId."',
                                                      '".$value['PeriodoDal']."', 
                                                      '".$value['PeriodoAl']."',
                                                      '".$value['PrezzoCamera']."',
                                                      '".$value['Abilitato']."')"); 

        }
    }

    header('Location:'.BASE_URL_SITO.'disponibilita-camere/');
} 