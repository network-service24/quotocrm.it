<?php
if($_REQUEST['azione']!=''){


        $select    = "SELECT * FROM hospitality_tipo_servizi WHERE Id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

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
      $dbMysqli->query($insert);

      $ServizioId = $fun->lastInsertId(IDSITO,'hospitality_tipo_servizi','Id');

        $sel = "SELECT * FROM hospitality_tipo_servizi_lingua WHERE servizio_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $rws = $dbMysqli->query($sel);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id, 
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