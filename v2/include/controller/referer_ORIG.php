<?php
if($_REQUEST['azione']!=''){

	$array_prov         = array();
	$array_time         = array();
	$NumPreno           = '';
	$valore_provenienza = '';
	$provenienza        = '';
	$timeline           = '';

	$sel = $db->query("SELECT NumeroPrenotazione FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND FontePrenotazione = 'Sito Web'");
	$rw  = $db->row($sel);
	if(is_array($rw)) {
		if($rw > count($rw))
				$tt = count($rw);
		}else{
				$tt = 0;
		}
	if($tt>0){

		$NumPreno = $rw['NumeroPrenotazione'];

		$s        = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
		$r        = $db->query($s);
		$rws      = $db->result($r);

 		$valore_provenienza = '';
		$provenienza        = '';
		$timeline           = ''; 

		if(sizeof($rws)>0){


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

			//if(IS_NETWORK_SERVICE_USER==1){
				$select_client_id  = "SELECT * FROM hospitality_client_id WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
				$result_client_id  = $db->query($select_client_id);
				$record            = $db->row($result_client_id);
				if(is_array($record)) {
					if($record > count($record))
							$check = count($record);
					}else{
							$check = 0;
					}
				if($check>0){
					$client_id             =  $record['CLIENT_ID'];
					$DataOperazione        =  $record['DataOperazione'];
					$ID_ACCOUNT_ANALYTICS_ =  explode("-",ID_ACCOUNT_ANALYTICS);
					$ID_ACCOUNT_ANALYTICS  =  $ID_ACCOUNT_ANALYTICS_[0];
					//if(ID_ACCOUNT_ANALYTICS != '' && ID_PROPERTY_ANALYTICS != '' && VIEW_ID_ANALYTICS != ''){
						$valore_provenienza .= (($client_id!='' && $client_id!='.')?' - <a href="https://analytics.google.com/analytics/web/#/report/visitors-user-activity/a'.$ID_ACCOUNT_ANALYTICS.'w'.ID_PROPERTY_ANALYTICS.'p'.VIEW_ID_ANALYTICS.'/_r.userId='.$client_id.'/" target="_blank">Guarda la Timeline su Google Analytics</a>':'');
					//}
				
				}
			//}

		}else{

			$s2        = "SELECT * FROM hospitality_tracking_ads WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
			$r2        = $db->query($s2);
			$rws2      = $db->row($r2);
	
			$DaDove    = $rws2['Url'];
			$Tracking  = $rws2['Tracking'];
			$Campagna  = $rws2['Campagna'];
	
			if(sizeof($rws2)>0){
	
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
	
				//if(IS_NETWORK_SERVICE_USER==1){
					$select_client_id  = "SELECT * FROM hospitality_client_id WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
					$result_client_id  = $db->query($select_client_id);
					$record            = $db->row($result_client_id);
					if(is_array($record)) {
						if($record > count($record))
								$check = count($record);
						}else{
								$check = 0;
						}
					if($check>0){
						$client_id             =  $record['CLIENT_ID'];
						$DataOperazione        =  $record['DataOperazione'];
						$ID_ACCOUNT_ANALYTICS_ =  explode("-",ID_ACCOUNT_ANALYTICS);
						$ID_ACCOUNT_ANALYTICS  =  $ID_ACCOUNT_ANALYTICS_[0];
						//if(ID_ACCOUNT_ANALYTICS != '' && ID_PROPERTY_ANALYTICS != '' && VIEW_ID_ANALYTICS != ''){
							$valore_provenienza .= (($client_id!='' && $client_id!='.')?' - <a href="https://analytics.google.com/analytics/web/#/report/visitors-user-activity/a'.$ID_ACCOUNT_ANALYTICS.'w'.ID_PROPERTY_ANALYTICS.'p'.VIEW_ID_ANALYTICS.'/_r.userId='.$client_id.'/" target="_blank">Guarda la Timeline su Google Analytics</a>':'');
						//}
					}
				//}
	
			}else{
				$valore_provenienza = 'Referral Vuoto';
			}

		}

	}

}
