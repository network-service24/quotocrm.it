<?php
if($_REQUEST['azione']!=''){

        $select    = "SELECT * FROM hospitality_listino_camere WHERE Id = ".$_REQUEST['azione'];
        $run_query = $dbMysqli->query($select);
        $row       = $run_query[0];

        $idsito          = $row['idsito'];
        $IdNumeroListino = $row['IdNumeroListino'];
        $IdCamera        = $row['IdCamera'];
        $IdSoggiorno     = $row['IdSoggiorno'];
        $PeriodoDal      = $row['PeriodoDal'];
        $PeriodoAl       = $row['PeriodoAl'];
        $PrezzoCamera    = $row['PrezzoCamera'];
        $Abilitato       = $row['Abilitato'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_listino_camere(
                                                idsito,
                                                IdNumeroListino,
                                                IdSoggiorno,
                                                IdCamera,
                                                PeriodoDal,
                                                PeriodoAl,
                                                PrezzoCamera,
                                                Abilitato
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$IdNumeroListino."',
                                                '".$IdSoggiorno."',
                                                '".$IdCamera."',
                                                '".$PeriodoDal."',
                                                '".$PeriodoAl."',
                                                '".$PrezzoCamera."',
                                                '".$Abilitato."')";
      $dbMysqli->query($insert);
      
    if($_REQUEST['valore']=='sum'){
      header('Location:'.BASE_URL_SITO.'disponibilita-listino_tabella/'.$IdNumeroListino.'/');
    }else{
      header('Location:'.BASE_URL_SITO.'disponibilita-camere_listino/'.$IdCamera .'/');
    }

}
