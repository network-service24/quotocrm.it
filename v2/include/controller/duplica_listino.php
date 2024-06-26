<?php
if($_REQUEST['azione']!=''){

        $select    = "SELECT * FROM hospitality_listino_camere WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

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
      $db->query($insert);
    if($_REQUEST['valore']=='sum'){
      header('Location:'.BASE_URL_SITO.'disponibilita-tipo_listino/');
    }else{
      header('Location:'.BASE_URL_SITO.'disponibilita-camere/'.$_REQUEST['param']);
    }

}
