<?php
// DATA RICEVUTA DELLA RICHIESTA  + DATA DI INVIO PREVENTIVO
$select = $db->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND TipoRichiesta = 'Preventivo'");
$row    = $db->row($select);

$NumeroPrenotazione = $row['NumeroPrenotazione'];

$Nome               = ucfirst(stripslashes($row['Nome']));

$Cognome            = ucfirst(stripslashes($row['Cognome']));

$DataR_tmp          = explode("-",$row['DataRichiesta']);
$DataRichiesta      = $DataR_tmp[2].'/'.$DataR_tmp[1].'/'.$DataR_tmp[0];


if($row['DataScadenza']){
	$Data_tmp_S = explode("-",$row['DataScadenza']);
	$DataScad   = $Data_tmp_S[2].'/'.$Data_tmp_S[1].'/'.$Data_tmp_S[0];
	}
if($row['DataInvio']){
	$DataI_tmp   = explode("-",$row['DataInvio']);
	$DataInvio   = $DataI_tmp[2].'/'.$DataI_tmp[1].'/'.$DataI_tmp[0];
	$MetodoInvio_p = $row['MetodoInvio'];
}  


// DATA DI INVIO CONFERMA PER PAGAMENTO ACCONTO
// //DATA DI INVIO DELLA PRENOTAZIONE CHIUSA
$select2 = $db->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND TipoRichiesta = 'Conferma' ORDER BY Id ASC");
$rec    = $db->result($select2);
foreach ($rec as $key => $row2) {
	if($row2['DataScadenza']){
		$DataI_tmp_C        = explode("-",$row2['DataScadenza']);
		$DataScadenza         = $DataI_tmp_C[2].'/'.$DataI_tmp_C[1].'/'.$DataI_tmp_C[0];

		$DataI_tmp_CT        = explode("-",$row2['DataInvio']);
		$DataInvioCT         = $DataI_tmp_CT[2].'/'.$DataI_tmp_CT[1].'/'.$DataI_tmp_CT[0];
	}


	if($row2['Chiuso']==1){

			$DataI_tmp_CC        = explode("-",$row2['DataInvio']);
			$DataInvioCC         = $DataI_tmp_CC[2].'/'.$DataI_tmp_CC[1].'/'.$DataI_tmp_CC[0];
		
	}
	$MetodoInvio_c = $row2['MetodoInvio'];
}





//DATA DI INVIO DEL QUESTIONARIO
$select4 = $db->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND TipoRichiesta = 'Conferma' AND Chiuso = 1 ");
$row4    = $db->row($select4);
	if($row4['DataPartenza']!=''){

			if($row4['DataPartenza']>=date('Y-m-d)')){
				$DataCheckOut_val = 1;
			}else{
				$DataCheckOut_val = 0;
			}
			$DataP_tmp          = explode("-",$row4['DataPartenza']);
			$DataCheckOut       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
	}


	if($row4['CS_inviato']==1){
			$DataI_tmp_CQ        = explode("-",$row4['DataInvio']);
			$DataInvioCQ         = ($DataI_tmp_CQ[2]+1).'/'.$DataI_tmp_CQ[1].'/'.$DataI_tmp_CQ[0]; 
	}


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
	if(is_array($rw)) {
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
				}elseif((!stristr($rws['Provenienza'],SITOWEB)) && (!stristr($rws['Provenienza'],'google')) && (!stristr($rws['Provenienza'],'facebook')) && (!stristr($rws['Timeline'],'gclid')) && (!stristr($rws['Timeline'],'utm_medium=email'))){							
					$valore_provenienza = 'Referral/Altro';
				}



	}

}


// DATA DI INVIO DI UNA EMAIL DI UPSELLING
$select4 = $db->query("SELECT * FROM hospitality_traccia_email_upselling WHERE NumPreno = ".$_REQUEST['azione']." AND idsito= ".IDSITO." ORDER BY data_invio ASC");
$array_rec    = $db->result($select4);
if(sizeof($array_rec)>0){
	$upselling = '';
	$oggetto   = '';
	$contenuto = '';
	$modl = '';
	foreach ($array_rec as $ky => $val) {
		$Data_invio_tmp_ = explode(" ",$val['data_invio']);
		$Data_invio_tmp  = explode("-",$Data_invio_tmp_[0]);
		$Data_invio      = $Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0].' '.$Data_invio_tmp_[1];
		$modl            = 'timeline'.$Data_invio_tmp[2].$Data_invio_tmp[1].$Data_invio_tmp[0].str_replace(":","",$Data_invio_tmp_[1]);
		$oggetto         = $val['oggetto'];
		$contenuto       = $val['contenuto'];
		$upselling .='
					<li class="time-label">
						<span class="bg-green">
						'.$Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0].'
						</span>
					</li>
					<li>
						<i class="fa fa-table bg-aqua"></i>
						<div class="timeline-item">
						<h3 class="timeline-header no-border"><b>Inviata E-Mail di UpSelling</b></h3>
							<div class="timeline-body">
								'.$oggetto.'
							</div>
						</div>
					</li>
					<li>
						<i class="fa fa-play bg-red"></i>
						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> Inviata email il: '.$Data_invio.'</span>
							<h3 class="timeline-header"> <b>Contenuto:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#timeline'.$modl.'"><i class="glyphicon glyphicon-fullscreen"></i></a></h3>
						</div>
					</li>
					<div class="modal fade" id="timeline'.$modl.'"  role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">
									'.$oggetto.' 
									</h4>
								</div>
								<div class="modal-body">
								'.$contenuto.'
								</div>
							</div>
						</div>
					</div>';
	
		
	}

	$contenuto = '';
}

// DATA DI INVIO DI UNA EMAIL PER EMISSIONE BUONO VOUCHER
$select5 = $db->query("SELECT * FROM hospitality_traccia_email_buoni_voucher WHERE NumPreno = ".$_REQUEST['azione']." AND idsito= ".IDSITO." ORDER BY data_invio ASC");
$array_rec5    = $db->result($select5);
if(sizeof($array_rec5)>0){
	$buono_voucher = '';
	$oggetto   = '';
	$contenuto = '';
	$modl = '';
	foreach ($array_rec5 as $ky => $val) {
		$Data_invio_tmp_      = explode(" ",$val['data_invio']);
		$Data_invio_tmp       = explode("-",$Data_invio_tmp_[0]);
		$Data_invio           = $Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0].' '.$Data_invio_tmp_[1];
		$Idmodl                 = 'timeline'.$Data_invio_tmp[2].$Data_invio_tmp[1].$Data_invio_tmp[0].str_replace(":","",$Data_invio_tmp_[1]);
		$oggetto_mail         = $val['oggetto'];
		$contenuto_mail       = $val['contenuto'];
		$buono_voucher .='
					<li class="time-label">
						<span class="bg-green">
						'.$Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0].'
						</span>
					</li>
					<li>
						<i class="fa fa-table bg-aqua"></i>
						<div class="timeline-item">
						<h3 class="timeline-header no-border"><b>Inviata E-Mail per emissione Buono Voucher</b></h3>
							<div class="timeline-body">
								'.$oggetto.'
							</div>
						</div>
					</li>
					<li>
						<i class="fa fa-play bg-red"></i>
						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> Inviata email il: '.$Data_invio.'</span>
							<h3 class="timeline-header"> <b>Contenuto:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#timeline'.$Idmodl.'"><i class="glyphicon glyphicon-fullscreen"></i></a></h3>
						</div>
					</li>
					<div class="modal fade" id="timeline'.$Idmodl.'"  role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">
									'.$oggetto_mail.' 
									</h4>
								</div>
								<div class="modal-body">
								'.$contenuto_mail.'
								</div>
							</div>
						</div>
					</div>';
	
		
	}

	$contenuto = '';
}

# RIEPILOGO CHAT
$select    = "SELECT hospitality_chat.* FROM hospitality_chat INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_chat.id_guest WHERE hospitality_guest.NumeroPrenotazione = '".$_REQUEST['azione']."' AND hospitality_chat.idsito = '".IDSITO."' ORDER BY hospitality_chat.data DESC";
$res       = $db->query($select);
$rec       = $db->result($res);
$tot       = sizeof($rec);
$chat      = '';
$riepilogo = '';  
if($tot > 0){


		foreach($rec as $key => $row){
	
					$data_tmp = explode(" ",$row['data']);
					$data_d   = explode("-",$data_tmp[0]);
					$data     = $data_d[2].'-'.$data_d[1].'-'.$data_d[0].' '.$data_tmp[1];
					
					if($row['operator']==1){
						$q_img = $db->query("SELECT img FROM hospitality_operatori WHERE  idsito = ".$row['idsito']." AND NomeOperatore = '".$row['user']."' AND Abilitato = 1");
						$img = $db->row($q_img);
						$ImgOperatore = $img['img'];
	
						if($ImgOperatore == ''){
							$ImgOperatore = BASE_URL_SITO.'img/receptionists.png';
						}else{
							$ImgOperatore = BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$ImgOperatore.'';
						}             
					}
	
			$riepilogo .='  <li>                                      
						<div class="ballon">
							<div '.($row['operator']==0?'class="user2"':'class="operatore"').'>
								<strong>'.$row['user'].'</strong> &nbsp;&nbsp;'.($row['operator']==0?'<img src="'.BASE_URL_SITO.'img/receptionists.png" style="width:32px;height:32px" class="img-circle">':'<img src="'.$ImgOperatore.'" style="width:32px;height:32px" class="img-circle">').' <br>
								<small><small>ha scritto il '.$data.'</small></small>
							</div>
							<div '.($row['operator']==0?'class="textchat"':'class="textchatoperatore"').'>
									'.nl2br($row['chat']).'
							</div>
							<div class="clear"></div>
						</div>                                    			
					</li>
				<br>';
		}


	$chat .='
			<li class="time-label">
				<span class="bg-green">
					<small class="text-white">Talk Chat</small>
				</span>
			</li>
			<li>
				<i class="fa fa-table bg-aqua"></i>
				<div class="timeline-item">
				<h3 class="timeline-header no-border"><b>Avvenuta discussione in Chat</b></h3>
				</div>
			</li>
			<li>
				<i class="fa fa-comment bg-blue"></i>
				<div class="timeline-item">
					<h3 class="timeline-header"> <b>Discussione:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#chat'.$_REQUEST['azione'].'"><i class="fa fa-comments-o"></i></a></h3>
				</div>
			</li>
			<div class="modal fade" id="chat'.$_REQUEST['azione'].'"  role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">
							Riepilogo Discussione in Chat 
							</h4>
						</div>
						<div class="modal-body">
							<ul class="messaggi">
								'.$riepilogo.'
							</ul>
						</div>
					</div>
				</div>
			</div>';
				
}
