<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];        
            return($newid);
       }         

        $select    = "SELECT * FROM hospitality_tipo_pacchetto WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

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
      $db->query($insert);

      $PacchettoId = getlastid('hospitality_tipo_pacchetto');

        $sel = "SELECT * FROM hospitality_tipo_pacchetto_lingua WHERE pacchetto_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id, 
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