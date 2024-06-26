<?php
if($_REQUEST['azione']!=''){
       

        $select    = "SELECT * FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

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
      $dbMysqli->query($insert);

      $SoggiornoId = $fun->lastInsertId(IDSITO,'hospitality_tipo_soggiorno','Id');

        $sel = "SELECT * FROM hospitality_tipo_soggiorno_lingua WHERE soggiorni_id = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $rws = $dbMysqli->query($sel);


    if(sizeof($rws) > 0){

        foreach ($rws as $key => $value) {

                 $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id, 
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