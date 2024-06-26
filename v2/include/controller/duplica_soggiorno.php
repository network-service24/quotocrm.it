<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];        
            return($newid);
       }         

        $select    = "SELECT * FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

       $idsito        = $row['idsito'];
       $Lingua        = $row['Lingua'];
       $TipoSoggiorno = $row['TipoSoggiorno'];    
       $Abilitato     = $row['Abilitato'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_tipo_soggiorno(
                                                idsito,
                                                Lingua,
                                                TipoSoggiorno,
                                                Abilitato
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$Lingua."',
                                                'DUPLICATO_".addslashes($TipoSoggiorno)."',
                                                '".$Abilitato."')";
      $db->query($insert);

      $SoggiornoId = getlastid('hospitality_tipo_soggiorno');

        $sel = "SELECT * FROM hospitality_tipo_soggiorno_lingua WHERE soggiorni_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id, 
                                                      idsito,
                                                      lingue,                                              
                                                      Soggiorno,
                                                      Descrizione
                                                      ) VALUES (
                                                      '".$SoggiornoId."',
                                                      '".$value['idsito']."', 
                                                      '".$value['lingue']."',
                                                      '".addslashes($value['Soggiorno'])."', 
                                                      '".addslashes($value['Descrizione'])."')"); 

        }
    }

    header('Location:'.BASE_URL_SITO.'disponibilita-soggiorni/');
} 