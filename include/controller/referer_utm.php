<?php
if($_REQUEST['azione']!=''){

		$NumPreno = $_REQUEST['azione'];

		$select  = "	SELECT 
									hospitality_utm_ads.*
								FROM 
									hospitality_guest
								INNER JOIN 
                                    hospitality_utm_ads
                                ON 
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 										
								WHERE 
									hospitality_guest.idsito = ".IDSITO."
                                AND 
                                    FontePrenotazione = 'Sito Web' 
								AND 
                                    hospitality_utm_ads.NumeroPrenotazione = ".$NumPreno." 
								AND 
									hospitality_utm_ads.idsito = ".IDSITO." ";
		$result  = $dbMysqli->query($select);
		$record  = $result[0];



		if(sizeof($result)>0){


                if($record['utm_source'] != '' && $record['utm_medium'] != '' && $record['utm_campaign'] != ''){
                    $valore_provenienza = $record['utm_source'].'-'.$record['utm_medium'];
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && $record['referrer'] == '/'){
					$valore_provenienza = 'Diretto';
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && strstr($record['referrer'],SITOWEB,true)){
                    $valore_provenienza = 'Referral';
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && strstr($record['referrer'],SITOWEB,false)){
                    $valore_provenienza = 'Organico';				
				}else{
					$valore_provenienza = 'Referral/Altro';
				}

        }else{
            $valore_provenienza = 'Referral/Altro';
        }

}else{
	$valore_provenienza = 'Referral/Altro';
}
