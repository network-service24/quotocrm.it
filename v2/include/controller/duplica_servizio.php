<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];        
            return($newid);
       }         

        $select    = "SELECT * FROM hospitality_servizi_camera WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

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
      $db->query($insert);

      $ServizioId = getlastid('hospitality_servizi_camera');

        $sel = "SELECT * FROM hospitality_servizi_camere_lingua WHERE servizi_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id, 
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