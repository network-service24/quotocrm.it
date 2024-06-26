<?php
if($_REQUEST['azione']!=''){

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
		$rws      = $db->row($r);
		if(is_array($rws)) {
			if($rws > count($rws))
					$tot = count($rws);
			}else{
					$tot = 0;
			}

		if($tot>0){


			if ((stristr($rws['Provenienza'],'google')) && (!stristr($rws['Timeline'],'gclid'))){
				$valore_provenienza = 'Organico';
			}elseif((stristr($rws['Provenienza'],SITOWEB)) && (!stristr($rws['Provenienza'],'gclid')) && (!stristr($rws['Provenienza'],'utm_source')) && (!stristr($rws['Provenienza'],'facebook')) && (!stristr($rws['Timeline'],'gclid'))){
				$valore_provenienza = 'Diretto';
			}elseif((stristr($rws['Provenienza'],'facebook')) || (stristr($rws['Timeline'],'facebook'))){
				$valore_provenienza = 'Facebook';
			}elseif((stristr($rws['Provenienza'],'utm_medium')) || (stristr($rws['Timeline'],'utm_medium'))){
				$valore_provenienza = 'Newsletter';
			}elseif((stristr($rws['Provenienza'],'gclid')) || (stristr($rws['Timeline'],'gclid'))){
				$valore_provenienza = 'PPC';
			}elseif($rws['Provenienza']=='' && $rws['Timeline']==''){
				$valore_provenienza = 'Landing Page';
			}elseif(($rws['Provenienza']!='') && ($rws['Timeline']!='') && (!stristr($rws['Provenienza'],SITOWEB)) && (!stristr($rws['Provenienza'],'google')) && (!stristr($rws['Provenienza'],'facebook')) && (!stristr($rws['Timeline'],'gclid')) && (!stristr($rws['Timeline'],'utm_medium=email'))){
				$valore_provenienza = 'Referral/Altro';

			}



		}else{
			$valore_provenienza = 'Nessuno';
		}

	}
}
