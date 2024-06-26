<?php
if($_REQUEST['azione']!=''){


        $select    = "SELECT * FROM hospitality_condizioni_tariffe WHERE id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

        $idsito    = $row['idsito'];
        $Lingua    = $row['Lingua'];
        $etichetta = $row['etichetta'];    



        // query di inserimento
        $insert = "INSERT INTO hospitality_condizioni_tariffe(
                                                idsito,
                                                Lingua,
                                                etichetta
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$Lingua."',
                                                'DUPLICATO_".addslashes($etichetta)."')";
      $dbMysqli->query($insert);

      $PacchettoId = $fun->lastInsertId(IDSITO,'hospitality_condizioni_tariffe','Id');

        $sel = "SELECT * FROM hospitality_condizioni_tariffe_lingua WHERE id_tariffe = ".$_REQUEST['azione']." ORDER BY id ASC";
        $rws = $dbMysqli->query($sel);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe, 
                                                      idsito,
                                                      Lingua,                                              
                                                      tariffa,
                                                      testo
                                                      ) VALUES (
                                                      '".$PacchettoId."',
                                                      '".$value['idsito']."', 
                                                      '".$value['Lingua']."',
                                                      '".addslashes($value['tariffa'])."', 
                                                      '".addslashes($value['testo'])."')"); 

        }
    }

    header('Location:'.BASE_URL_SITO.'disponibilita-tariffe/');
} 