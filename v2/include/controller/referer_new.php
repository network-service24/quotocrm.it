<?php
if($_REQUEST['azione']!=''){

	$NumPreno = '';
    $DaDove   = '';
    $Tracking = '';
    $Campagna = '';

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

		$s        = "SELECT * FROM hospitality_tracking_ads WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
		$r        = $db->query($s);
		$rws      = $db->row($r);

		$DaDove    = $rws['Url'];
		$Tracking  = $rws['Tracking'];
		$Campagna  = $rws['Campagna'];

		if(sizeof($rws)>0){

			if ($Tracking == 'google' && $Campagna == ''){
				$valore_provenienza = 'Organico';
			}elseif($Tracking == 'google' && $Campagna != ''){
				$valore_provenienza = 'Landing Page da Google Ads';
			}elseif($Tracking == 'facebook' && $Campagna == 'diretto'){
				$valore_provenienza = 'Facebook';
			}elseif($Tracking == 'facebook' && ($Campagna != 'diretto' || $Campagna != '')){
				$valore_provenienza = 'Landing page da FB Ads';
			}elseif((strstr($provenienza,'landing')) || (strstr($timeline,'landing'))){
				$valore_provenienza = 'Landing Page';
			}elseif(($provenienza!='') && ($timeline!='') && (!strstr($provenienza,SITOWEB)) && (!strstr($provenienza,'google')) && (!strstr($provenienza,'facebook')) && (!strstr($timeline,'gclid')) && (!strstr($timeline,'utm_source=newsletter'))){
				$valore_provenienza = 'Referral/Altro';
			}



		}else{
			$valore_provenienza = 'Referral Vuoto';
		}

	}

}
