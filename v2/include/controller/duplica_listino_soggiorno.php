<?php
if($_REQUEST['azione']!=''){

        $select    = "SELECT * FROM hospitality_listino_soggiorni WHERE Id = ".$_REQUEST['azione']." AND idsito = ".IDSITO;
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

        $idsito          = $row['idsito'];
        $IdSoggiorno     = $row['IdSoggiorno'];
        $PeriodoDal      = $row['PeriodoDal'];
        $PeriodoAl       = $row['PeriodoAl'];
        $Prezzo    = $row['Prezzo'];
        $Abilitato       = $row['Abilitato'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_listino_soggiorni(
                                                idsito,
                                                IdSoggiorno,
                                                PeriodoDal,
                                                PeriodoAl,
                                                Prezzo,
                                                Abilitato
                                                ) VALUES (
                                                '".$idsito."',
                                                '".$IdSoggiorno."',
                                                '".$PeriodoDal."',
                                                '".$PeriodoAl."',
                                                '".$Prezzo."',
                                                '".$Abilitato."')";
      $db->query($insert);

      header('Location:'.BASE_URL_SITO.'disponibilita-soggiorni/'.$_REQUEST['param']);


}
