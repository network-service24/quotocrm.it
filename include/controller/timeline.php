<?php
// DATA RICEVUTA DELLA RICHIESTA  + DATA DI INVIO PREVENTIVO
$select = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND TipoRichiesta = 'Preventivo'");
$row    = $select[0];

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
$rec = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND TipoRichiesta = 'Conferma' ORDER BY Id ASC");
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
$select4 = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND TipoRichiesta = 'Conferma' AND Chiuso = 1 ");
$row4    = $select4[0];
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


$sel = $dbMysqli->query("SELECT NumeroPrenotazione FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['azione']." AND idsito= ".IDSITO." AND FontePrenotazione = 'Sito Web'");
$rw  = $sel[0];
if(sizeof($sel)>0){

	$NumPreno = $rw['NumeroPrenotazione'];
	$s        = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND NumeroPrenotazione = ".$NumPreno." ";
	$r        = $dbMysqli->query($s);
	$rws      = $r[0];

	if(sizeof($r)>0){


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
$array_rec = $dbMysqli->query("SELECT * FROM hospitality_traccia_email_upselling WHERE NumPreno = ".$_REQUEST['azione']." AND idsito= ".IDSITO." ORDER BY data_invio ASC");
if(sizeof($array_rec)>0){
	$upselling = '';
	$oggetto   = '';
	$contenuto = '';
	$modl = '';
	foreach ($array_rec as $ky => $val) {
		$Data_invio_tmp_ = explode(" ",$val['data_invio']);
		$Data_invio_tmp  = explode("-",$Data_invio_tmp_[0]);
		$Data_invio      = $Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0];
		$modl            = 'timeline'.$Data_invio_tmp[2].$Data_invio_tmp[1].$Data_invio_tmp[0].str_replace(":","",$Data_invio_tmp_[1]);
		$oggetto         = $val['oggetto'];
		$contenuto       = $val['contenuto'];
		$upselling .='
						<div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline">'.$Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0].'</p>
								<i class="p-l-10 fa-2x fa fa-tag text-primary  update-icon"></i>
							</div>
							<div class="col">
									<h6>Inviata E-Mail di UpSelling</h6>
									'.$oggetto.'
							</div>
						</div>
						<div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline">'.$Data_invio.'</p>
								<i class="p-l-10 fa-2x fa fa-play-circle-o text-primary  update-icon"></i>
							</div>
							<div class="col">
									<h6>Inviata email il</h6>
									<b>Contenuto:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#timeline'.$modl.'"><i class="glyphicon glyphicon-fullscreen"></i></a>
							</div>
						</div>

					<div class="modal fade" id="timeline'.$modl.'"  role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">									
									<h4 class="modal-title" id="myModalLabel">
									'.$oggetto.' 
									</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
								'.$contenuto.'
								</div>
							</div>
						</div>
					</div>
					 <hr>';
	
		
	}

	$contenuto = '';
}

// DATA DI INVIO DI UNA EMAIL PER EMISSIONE BUONO VOUCHER
$array_rec5 = $dbMysqli->query("SELECT * FROM hospitality_traccia_email_buoni_voucher WHERE NumPreno = ".$_REQUEST['azione']." AND idsito= ".IDSITO." ORDER BY data_invio ASC");
if(sizeof($array_rec5)>0){
	$buono_voucher = '';
	$oggetto   = '';
	$contenuto = '';
	$modl = '';
	foreach ($array_rec5 as $ky => $val) {
		$Data_invio_tmp_      = explode(" ",$val['data_invio']);
		$Data_invio_tmp       = explode("-",$Data_invio_tmp_[0]);
		$Data_invio           = $Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0];
		$Idmodl                 = 'timeline'.$Data_invio_tmp[2].$Data_invio_tmp[1].$Data_invio_tmp[0].str_replace(":","",$Data_invio_tmp_[1]);
		$oggetto_mail         = $val['oggetto'];
		$contenuto_mail       = $val['contenuto'];
		$buono_voucher .='
					<div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline">'.$Data_invio_tmp[2].'/'.$Data_invio_tmp[1].'/'.$Data_invio_tmp[0].'</p>
								<i class="p-l-10 fa-2x fa fa-tag text-primary  update-icon"></i>
							</div>
							<div class="col">
									<h6>Inviata E-Mail per emissione Buono Voucher</h6>
									'.$oggetto.'
							</div>
						</div>
					<div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline">'.$Data_invio.'</p>
								<i class="p-l-10 fa-2x fa fa-play-circle-o text-primary  update-icon"></i>
							</div>
							<div class="col">
									<h6>Inviata email il</h6>
									Contenuto:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#timeline'.$Idmodl.'"><i class="glyphicon glyphicon-fullscreen"></i></a>
							</div>
						</div>
					<div class="modal fade" id="timeline'.$Idmodl.'"  role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									
									<h4 class="modal-title" id="myModalLabel">
									'.$oggetto_mail.' 
									</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
								'.$contenuto_mail.'
								</div>
							</div>
						</div>
					</div>
					 <hr>';
	
		
	}

	$contenuto = '';
}

# RIEPILOGO CHAT
$select    = "SELECT hospitality_chat.* FROM hospitality_chat INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_chat.id_guest WHERE hospitality_guest.NumeroPrenotazione = '".$_REQUEST['azione']."' AND hospitality_chat.idsito = '".IDSITO."' ORDER BY hospitality_chat.data DESC";
$rec       = $dbMysqli->query($select);
$tot       = sizeof($rec);
$chat      = '';
$riepilogo = '';  
if($tot > 0){


		foreach($rec as $key => $row){
	
					$data_tmp = explode(" ",$row['data']);
					$data_d   = explode("-",$data_tmp[0]);
					$data     = $data_d[2].'-'.$data_d[1].'-'.$data_d[0].' '.$data_tmp[1];
					
					if($row['operator']==1){
						$q_img = $dbMysqli->query("SELECT img FROM hospitality_operatori WHERE  idsito = ".$row['idsito']." AND NomeOperatore = '".$row['user']."' AND Abilitato = 1");
						$img = $q_img[0];
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
			<div class="row p-b-15">
				<div class="col-auto text-right update-meta">
					<p class="text-muted m-b-0 d-inline p-r-10">Talk Chat</p>
					<i class="p-l-10 fa-2x fa fa-comments text-primary  update-icon"></i>
				</div>
				<div class="col">
						<h6>Avvenuta discussione in Chat</h6>
						Discussione:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#chat'.$_REQUEST['azione'].'"><i class="fa fa-comments-o"></i></a>
				</div>
			</div>
			<div class="modal fade" id="chat'.$_REQUEST['azione'].'"  role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModalLabel">
							Riepilogo Discussione in Chat 
							</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
						<style>
					    .ballon{
					      font-size:14px!important;
					      width:100%;
					      height:auto;
					      border-radius: 10px 10px 10px 10px;
					      -moz-border-radius: 10px 10px 10px 10px;
					      -webkit-border-radius: 10px 10px 10px 10px;
					      border: 1px solid #d5d2d2;
							background: rgba(237,237,237,1);
							background: -moz-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(237,237,237,1)), color-stop(53%, rgba(246,246,246,0.79)), color-stop(100%, rgba(255,255,255,0.6)));
							background: -webkit-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: -o-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: -ms-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: linear-gradient(to bottom, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ededed\', endColorstr=\'#ffffff\', GradientType=0 );
					    }					    
					    .clear{
					    	clear:both;
					    	height:10px;
					    }
					    .messaggi{
					    	list-style-type: none;
					    	padding:0px;
					    }
					    .user2{
							float:right;
							text-align:right;
							padding:20px;
					    }
					    .textchat{
					    	float:left;
					    	text-align:left;
					    	padding:20px;
					    	position:relative;
					    }
					    .operatore{
							float:left;
							text-align:left;
							padding:20px 20px 0px 20px;
					    }
					    .textchatoperatore{
					    	clear:both;
					    	float:left;
					    	text-align:left;
					    	padding:20px;
					    	position:relative;
					    }					    
					  </style>
							<div id="balloon">
								<ul class="messaggi">
									
									'.$riepilogo.'
									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			 <hr>';
				
}
