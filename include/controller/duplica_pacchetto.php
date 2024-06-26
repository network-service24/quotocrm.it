<?php
if($_REQUEST['azione']!=''){


        $select    = "SELECT * FROM hospitality_tipo_pacchetto WHERE Id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

        $idsito        = $row['idsito'];
        $Lingua        = $row['Lingua'];
        $TipoPacchetto = $row['TipoPacchetto'];    
        $Abilitato     = $row['Abilitato'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_tipo_pacchetto(
                                                idsito,
                                                Lingua,
                                                TipoPacchetto,
                                                Abilitato
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$Lingua."',
                                                'DUPLICATO_".addslashes($TipoPacchetto)."',
                                                '".$Abilitato."')";
      $dbMysqli->query($insert);

      $PacchettoId = $fun->lastInsertId(IDSITO,'hospitality_tipo_pacchetto','Id');

        $sel = "SELECT * FROM hospitality_tipo_pacchetto_lingua WHERE pacchetto_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $rws = $dbMysqli->query($sel);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id, 
                                                      idsito,
                                                      lingue,                                              
                                                      Pacchetto,
                                                      Descrizione
                                                      ) VALUES (
                                                      '".$PacchettoId."',
                                                      '".$value['idsito']."', 
                                                      '".$value['lingue']."',
                                                      '".addslashes($value['Pacchetto'])."', 
                                                      '".addslashes($value['Descrizione'])."')"); 

        }
    }

    header('Location:'.BASE_URL_SITO.'disponibilita-pacchetti/');
} 