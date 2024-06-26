<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];        
            return($newid);
       }         

        $select    = "SELECT * FROM hospitality_tipo_servizi WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

       $idsito         = $row['idsito'];
       $Lingua         = $row['Lingua'];
       $TipoServizio   = $row['TipoServizio']; 
       $PrezzoServizio = $row['PrezzoServizio']; 
       $CalcoloPrezzo  = $row['CalcoloPrezzo'];    
       $Abilitato      = $row['Abilitato'];
       $Obbligatorio   = $row['Obbligatorio'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_tipo_servizi(
                                                idsito,
                                                Lingua,
                                                TipoServizio,
                                                PrezzoServizio,
                                                CalcoloPrezzo,
                                                Abilitato,
                                                Obbligatorio
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$Lingua."',
                                                'DUPLICATO_".addslashes($TipoServizio)."',
                                                '".$PrezzoServizio."',
                                                '".addslashes($CalcoloPrezzo)."',
                                                '".$Abilitato."',
                                                '".$Obbligatorio."')";
      $db->query($insert);

      $ServizioId = getlastid('hospitality_tipo_servizi');

        $sel = "SELECT * FROM hospitality_tipo_servizi_lingua WHERE servizio_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id, 
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

    header('Location:'.BASE_URL_SITO.'disponibilita-servizi_aggiuntivi/');
} 