<?php
if($_REQUEST['azione']!=''){

	$array_prov         = array();
	$array_time         = array();
	$NumPreno           = '';
	$valore_provenienza = '';
	$provenienza        = '';
	$timeline           = '';

	$sel = $dbMysqli->query("SELECT NumeroPrenotazione FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND FontePrenotazione = 'Sito Web'");
	$rw  = $sel[0];
	if(sizeof($sel)>0){

		$NumPreno = $rw['NumeroPrenotazione'];

		$select_client_id  = "	SELECT 
									hospitality_client_id.*,
									hospitality_custom_dimension_ga4.source,
									hospitality_custom_dimension_ga4.medium,
									hospitality_custom_dimension_ga4.campaign
								FROM 
									hospitality_client_id 
								INNER JOIN hospitality_custom_dimension_ga4 
									ON 
										hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID
									OR
										hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione 										
								WHERE 
									hospitality_client_id.idsito = ".IDSITO." 
								AND 
									hospitality_client_id.NumeroPrenotazione = ".$NumPreno." 
								AND 
									hospitality_custom_dimension_ga4.idsito = ".IDSITO." 
								AND 
									hospitality_custom_dimension_ga4.datesession = DATE(hospitality_client_id.DataOperazione)";
		$result_client_id  = $dbMysqli->query($select_client_id);
		$record            = $result_client_id[0];

		$s        = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." AND Timeline NOT LIKE '%ritarda_client_id.php%'";
		$rws      = $dbMysqli->query($s);

 		$valore_provenienza = '';
		$provenienza        = '';
		$timeline           = ''; 
		$propertyId         = $fun->get_propertyId_analyticsGA4(IDSITO);

		if(sizeof($rws)>0){

			if(sizeof($result_client_id)>0){

				if(strstr($record['source'],'google') && strstr($record['medium'],'organic')){
					$valore_provenienza = 'Organico';
				}elseif(strstr($record['source'],'facebook') && strstr($record['medium'],'social') && $record['campaign']!=''){
					$valore_provenienza = 'Facebook';
				}elseif(strstr($record['source'],'newsletter') && strstr($record['medium'],'email') && $record['campaign']!=''){
					$valore_provenienza = 'Newsletter';
				}elseif(strstr($record['source'],'google') && strstr($record['medium'],'cpc') && $record['campaign']!=''){
					$valore_provenienza = 'PPC';
				}elseif(strstr($record['source'],'bing') && strstr($record['medium'],'organic') && strstr($record['campaign'],'(not set)')){
					$valore_provenienza = 'Bing';
				}elseif(strstr($record['source'],'(direct)') && strstr($record['medium'],'(none)') && strstr($record['campaign'],'(not set)')){
					$valore_provenienza = 'Diretto';				
				}else{
					$valore_provenienza = 'Referral/Altro';
				}

				
				$valore_provenienza .= (($propertyId!='')?' - <a href="https://analytics.google.com/analytics/web/#/p'.$propertyId.'/reports/intelligenthome" target="_blank">Guarda la Timeline su Google Analytics GA4</a>':'');
						
					
				

			}else{
						$valore_provenienza = '';
						$provenienza        = '';
						$timeline           = '';

						foreach ($rws as $key => $value) {
							$array_prov[] = $value['Provenienza'];
							$array_time[] = $value['Timeline'];
						}

						$provenienza = implode(',',$array_prov);
						$timeline    = implode(',',$array_time);

						if((strstr($provenienza,'google')) && ((!strstr($timeline,'gclid')) || $timeline =='')){
							$valore_provenienza = 'Organico';
						}elseif((strstr($provenienza,'facebook')) || (strstr($timeline,'facebook'))){
							$valore_provenienza = 'Facebook';
						}elseif((strstr($provenienza,'utm_source=newsletter')) || (strstr($timeline,'utm_source=newsletter'))){
							$valore_provenienza = 'Newsletter';
						}elseif((strstr($provenienza,'gclid')) || (strstr($timeline,'gclid'))){
							$valore_provenienza = 'PPC';
						}elseif((strstr($provenienza,'landing')) || (strstr($timeline,'landing'))){
							$valore_provenienza = 'Landing Page';
						}elseif((strstr($provenienza,'bing')) && (!strstr($provenienza,'gclid')) && (!strstr($provenienza,'utm_source')) && (!strstr($provenienza,'facebook')) && (!strstr($timeline,'gclid'))){
							$valore_provenienza = 'Bing';
						}elseif(($provenienza!='') && (!strstr($provenienza,'gclid')) && (!strstr($provenienza,'utm_source')) && (!strstr($provenienza,'facebook')) && (!strstr($timeline,'gclid'))){
							$valore_provenienza = 'Diretto';				
						}elseif(($provenienza!='') && ($timeline!='') && (!strstr($provenienza,SITOWEB)) && (!strstr($provenienza,'google')) && (!strstr($provenienza,'facebook')) && (!strstr($timeline,'gclid')) && (!strstr($timeline,'utm_source=newsletter'))){
							$valore_provenienza = 'Referral/Altro';
						}



			}
		}else{

			$select_client_id  = "	SELECT 
										hospitality_client_id.*,
										hospitality_custom_dimension_ga4.source,
										hospitality_custom_dimension_ga4.medium,
										hospitality_custom_dimension_ga4.campaign
									FROM 
										hospitality_client_id 
									INNER JOIN hospitality_custom_dimension_ga4 
										ON 
											hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID
										OR
											hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
									WHERE 
										hospitality_client_id.idsito = ".IDSITO."
									AND 
										hospitality_client_id.NumeroPrenotazione = ".$NumPreno." 
									AND 
										hospitality_custom_dimension_ga4.idsito = ".IDSITO."  
									AND 
										hospitality_custom_dimension_ga4.datesession = DATE(hospitality_client_id.DataOperazione)";
			$result_client_id  = $dbMysqli->query($select_client_id);
			$record            = $result_client_id[0];


				if(sizeof($result_client_id)>0){

					if(strstr($record['source'],'google') && strstr($record['medium'],'organic')){
						$valore_provenienza = 'Organico';
					}elseif(strstr($record['source'],'facebook') && strstr($record['medium'],'social') && $record['campaign']!=''){
						$valore_provenienza = 'Facebook';
					}elseif(strstr($record['source'],'newsletter') && strstr($record['medium'],'email') && $record['campaign']!=''){
						$valore_provenienza = 'Newsletter';
					}elseif(strstr($record['source'],'google') && strstr($record['medium'],'cpc') && $record['campaign']!=''){
						$valore_provenienza = 'PPC';
					}elseif(strstr($record['source'],'bing') && strstr($record['medium'],'organic') && strstr($record['campaign'],'(not set)')){
						$valore_provenienza = 'Bing';
					}elseif(strstr($record['source'],'(direct)') && strstr($record['medium'],'(none)') && strstr($record['campaign'],'(not set)')){
						$valore_provenienza = 'Diretto';				
					}else{
						$valore_provenienza = 'Referral/Altro';
					}
	
	
					$valore_provenienza .= (($propertyId!='')?' - <a href="https://analytics.google.com/analytics/web/#/p'.$propertyId.'/reports/intelligenthome" target="_blank">Guarda la Timeline su Google Analytics GA4</a>':'');
							
						
					
	
				}else{



						$s2        = "SELECT * FROM hospitality_tracking_ads WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
						$r2        = $dbMysqli->query($s2);
						$rws2      = $r2[0];
				
						$DaDove    = $rws2['Url'];
						$Tracking  = $rws2['Tracking'];
						$Campagna  = $rws2['Campagna'];
				
						if(sizeof($r2)>0){
				
							if ($Tracking == 'google' && $Campagna == ''){
								$valore_provenienza = 'Organico';
							}elseif($Tracking == 'google' && $Campagna != ''){
								$valore_provenienza = 'Google Ads';
							}elseif($Tracking == 'facebook' && $Campagna != ''){
								$valore_provenienza = 'Facebook Ads';
							}elseif(($DaDove !='') && ($Tracking == '') && ($Campagna == '')){
								$valore_provenienza = 'Provenienza diretta da: <small>'.$DaDove.'</small>';
							}elseif(($DaDove!='') && (!strstr($Tracking,'google')) && (!strstr($Tracking,'facebook')) && (!strstr($Campagna,'gclid')) && (!strstr($v,'utm_source=newsletter'))){
								$valore_provenienza = 'Referral/Altro';
							}
				
				
						}else{
							$valore_provenienza = 'Referral Vuoto';
						}

				}
		}

	}

}
