<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];        
            return($newid);
       }         

        $select    = "SELECT * FROM hospitality_condizioni_tariffe WHERE id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

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
      $db->query($insert);

      $PacchettoId = getlastid('hospitality_condizioni_tariffe');

        $sel = "SELECT * FROM hospitality_condizioni_tariffe_lingua WHERE id_tariffe = ".$_REQUEST['azione']." ORDER BY id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe, 
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