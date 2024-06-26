<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];        
            return($newid);
       }         

        $select    = "SELECT * FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

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
      $db->query($insert);

      $CamereId = getlastid('hospitality_tipo_camere');

        $sel = "SELECT * FROM hospitality_camere_testo WHERE camere_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_camere_testo(camere_id, 
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
    $run_query = $db->query($select);
    $array_row = $db->result($run_query);

    if(sizeof($array_row) > 0){

        foreach ($array_row as $key => $value) {

                 $db->query("INSERT INTO hospitality_listino_camere(idsito, 
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