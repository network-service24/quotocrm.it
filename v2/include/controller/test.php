<?php
    $prima_data= '2017-01-01';
    $seconda_data = '2017-12-31';
    $_REQUEST['date'] = 1;
        $select = 'SELECT *
                FROM hospitality_guest 
                WHERE 1=1
                AND '.($_REQUEST['date'] == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$prima_data.'" AND hospitality_guest.DataRichiesta <= "'.$seconda_data.'"').'
                AND hospitality_guest.idsito = '.IDSITO.' 
                AND hospitality_guest.Chiuso = 0                                    
                AND hospitality_guest.Disdetta = 0 
                AND hospitality_guest.TipoRichiesta = "Preventivo" ';
    $res = $db->query($select);
    $rec = $db->result($res);

    foreach ($rec as $key => $value) {

   

        $select2 = 'SELECT *
                        FROM hospitality_guest 
                        WHERE 1=1
                        AND '.($_REQUEST['date'] == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$prima_data.'" AND hospitality_guest.DataRichiesta <= "'.$seconda_data.'"').'
                        AND hospitality_guest.idsito = '.IDSITO.' 
                        AND hospitality_guest.NumeroPrenotazione = '.$value['NumeroPrenotazione'].'
                        AND hospitality_guest.Chiuso = 1   
                        AND hospitality_guest.DataChiuso IS NOT NULL                                 
                        AND hospitality_guest.Disdetta = 0 
                        AND hospitality_guest.TipoRichiesta = "Conferma" ';
        $res2 = $db->query($select2);
        $rec2 = $db->result($res2);
        foreach ($rec2 as $ky => $val) {



            //$output[]= $value['NumeroPrenotazione'].'#'.$value['DataRichiesta'].'#'.$val['DataChiuso'];
            $output[] = dateDifference($value['DataRichiesta'],$val['DataChiuso']);
        }

    }
    
?>