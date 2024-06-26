<?php
$idsito = $_REQUEST['idsito'];
$id_richiesta = $_REQUEST['id_richiesta'];
$Nome = $_REQUEST['nome'];
$Cognome = $_REQUEST['cognome'];
$Email = $_REQUEST['email'];
$Lingua = $_REQUEST['lingua'];

$h2 ='<h2> Operazioni compiute per: <span class="text-blue">' . ucfirst(stripslashes($Nome)) . ' ' . ucfirst(stripslashes($Cognome)) . '</span> <img src="' . BASE_URL_SITO . 'img/flags/mini/' . $Lingua . '.png" class="flag_ico"></h2>';
$timeline .= '<div style="clear:both;height:40px"></div>';
$select2 = 'SELECT *
                        FROM hospitality_guest
                        WHERE idsito      = ' . $idsito . '
                        AND Nome          = "' . $Nome . '"
                        AND Cognome       = "' . $Cognome . '"
                        AND Email         = "' . $Email . '"
                        GROUP BY NumeroPrenotazione
                        ORDER BY DataRichiesta DESC,NumeroPrenotazione DESC';
$array_ = $dbMysqli->query($select2);

$DataRichiesta           = '';
$DataScad                = '';
$DataScadenza            = '';
$DataInvio               = '';
$DataInvioCC             = '';
$TipoRichiesta           = '';
$TipoVacanza             = '';
$Chiuso                  = '';
$DataChiuso              = '';
$DataArrivo              = '';
$DataCheckOut            = '';
$Nome                    = '';
$Cognome                 = '';
$Adulti                  = '';
$Bambini                 = '';
$FontePrenotazione       = '';
$n                       = 0;
$ArrayNumeroPrenotazione = array();
$upselling               = '';
$oggetto                 = '';
$contenuto               = '';
$modl                    = '';
$valore_provenienza      = '';
$provenienza             = '';
$timeline                = '';
$data_email_suiteweb     = '';

foreach ($array_ as $k =>$v) {

    $ArrayNumeroPrenotazione[] = $v['NumeroPrenotazione'];
    $NumeroPrenotazione        = $v['NumeroPrenotazione'];
    $FontePrenotazione         = $v['FontePrenotazione'];
    $Nome                      = ucfirst(stripslashes($v['Nome']));
    $Cognome                   = ucfirst(stripslashes($v['Cognome']));
    $Adulti                    = $v['NumeroAdulti'];
    $Bambini                   = $v['NumeroBambini'];
    $TipoRichiesta             = $v['TipoRichiesta'];
    $TipoVacanza               = $v['TipoVacanza'];


    $DataR_tmp                = explode("-", $v['DataRichiesta']);
    $DataRichiesta            = $DataR_tmp[2] . '/' . $DataR_tmp[1] . '/' . $DataR_tmp[0];
    $data_email_suiteweb      = mktime(0,0,0,$DataR_tmp[1],$DataR_tmp[2],$DataR_tmp[0]);
    $data_email_suiteweb_post = mktime('23','59','59',$DataR_tmp[1],$DataR_tmp[2],$DataR_tmp[0]);

    if ($v['DataScadenza']) {
        $Data_tmp_S = explode("-", $v['DataScadenza']);
        $DataScad = $Data_tmp_S[2] . '/' . $Data_tmp_S[1] . '/' . $Data_tmp_S[0];
    }
    if ($v['DataInvio']) {
        $DataI_tmp = explode("-", $v['DataInvio']);
        $DataInvio = $DataI_tmp[2] . '/' . $DataI_tmp[1] . '/' . $DataI_tmp[0];
    }

// DATA DI INVIO CONFERMA PER PAGAMENTO ACCONTO
    $res2 = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = " . $NumeroPrenotazione . " AND idsito= " . $idsito . " AND TipoRichiesta = 'Conferma'");

    foreach ($res2 as $r =>$row2) {
        if ($row2['DataScadenza']) {
            $DataI_tmp_C = explode("-", $row2['DataScadenza']);
            $DataScadenza = $DataI_tmp_C[2] . '/' . $DataI_tmp_C[1] . '/' . $DataI_tmp_C[0];

            $DataI_tmp_CT = explode("-", $row2['DataInvio']);
            $DataInvioCT = $DataI_tmp_CT[2] . '/' . $DataI_tmp_CT[1] . '/' . $DataI_tmp_CT[0];
        }

        if ($row2['Chiuso'] == 1) {

            $DataI_tmp_CC = explode("-", $row2['DataInvio']);
            $DataInvioCC = $DataI_tmp_CC[2] . '/' . $DataI_tmp_CC[1] . '/' . $DataI_tmp_CC[0];

        }
    }

//DATA DI INVIO DEL QUESTIONARIO
    $sel3 = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = " . $NumeroPrenotazione . " AND idsito = " . $idsito . " AND TipoRichiesta = 'Conferma' AND Chiuso = 1 ");
    $row3 = $sel3[0];
    $Chiuso = $row3['Chiuso'];

    if ($row3['DataPartenza'] != '') {

        if ($row3['DataPartenza'] >= date('Y-m-d)')) {
            $DataCheckOut_val = 1;
        } else {
            $DataCheckOut_val = 0;
        }
        $DataP_tmp = explode("-", $row3['DataPartenza']);
        $DataCheckOut = $DataP_tmp[2] . '/' . $DataP_tmp[1] . '/' . $DataP_tmp[0];
    }

    if ($row3['DataChiuso']) {
        $DataC_tmp_h = explode(" ", $row3['DataChiuso']);
        $DataC_tmp = explode("-", $DataC_tmp_h[0]);
        $DataChiuso = $DataC_tmp[2] . '/' . $DataC_tmp[1] . '/' . $DataC_tmp[0];
    }

    if ($row3['CS_inviato'] == 1) {
        $DataI_tmp_CQ = explode("-", $row3['DataInvio']);
        $DataInvioCQ = $DataI_tmp_CQ[2] . '/' . $DataI_tmp_CQ[1] . '/' . $DataI_tmp_CQ[0];
    }

   
        $s = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = " . $idsito . " AND NumeroPrenotazione = " . $NumeroPrenotazione . "";
        $rws = $dbMysqli->query($s);
		if(sizeof($rws)>0){

            $valore_provenienza  = '';
            
			foreach ($rws as $key => $value) {
				$array_prov[] = $value['Provenienza'];
				$array_time[] = $value['Timeline'];
			}

			$provenienza       = implode(',',$array_prov);
		 	$timeline_fonte    = implode(',',$array_time);

			if ((strstr($provenienza,'google')) && (!strstr($timeline_fonte,'gclid'))){
				$valore_provenienza = 'Organico';
			}elseif((strstr($provenienza,SITOWEB)) && (!strstr($provenienza,'gclid')) && (!strstr($provenienza,'utm_source')) && (!strstr($provenienza,'facebook')) && (!strstr($timeline_fonte,'gclid'))){
				$valore_provenienza = 'Diretto';
			}elseif((strstr($provenienza,'facebook')) || (strstr($timeline_fonte,'facebook'))){
				$valore_provenienza = 'Facebook';
			}elseif((strstr($provenienza,'utm_source=newsletter')) || (strstr($timeline_fonte,'utm_source=newsletter'))){
				$valore_provenienza = 'Newsletter';
			}elseif((strstr($provenienza,'gclid')) || (strstr($timeline_fonte,'gclid'))){
				$valore_provenienza = 'PPC';
			}elseif((strstr($provenienza,'landing')) || (strstr($timeline_fonte,'landing'))){
				$valore_provenienza = 'Landing Page';
			}elseif(($provenienza!='') && ($timeline_fonte!='') && (!strstr($provenienza,SITOWEB)) && (!strstr($provenienza,'google')) && (!strstr($provenienza,'facebook')) && (!strstr($timeline_fonte,'gclid')) && (!strstr($timeline_fonte,'utm_source=newsletter'))){
				$valore_provenienza = 'Referral/Altro';
			}
        }

    //}

    $timeline .='   <div class="latest-update-box">
      <div class="row">
            <div class="col-md-12 text-blue">
                <a href="javascript:;" id="expande_richieste' . $v['Id'] . '">Operazioni compiute realtive alla Nr. richiesta <b>' . $NumeroPrenotazione . '</b> del <b>' . $DataRichiesta . '</b> per Adulti: <b>' . $Adulti . '</b> ' . ($Bambini > 0 ? 'Bambini: <b>' . $Bambini . '</b>' : '') . '<span class="pull-right" id="expand' . $v['Id'] . '"><i class="fa fa-expand text-green"  aria-hidden="true"></i> <small>espandi</small></span> <span class="pull-right" style="display:none" id="compress' . $v['Id'] . '"><i class="fa fa-compress text-red" aria-hidden="true"></i> <small>comprimi</small></span></a>
            <script>
                $(document).ready(function () {
                    ' . (count($ArrayNumeroPrenotazione) != 1 ? '' : '
                        $("#richieste' . $v['Id'] . '").show();
                        $("#compress' . $v['Id'] . '").show();
                        $("#expand' . $v['Id'] . '").hide();'
                ) . '
                    $("#expande_richieste' . $v['Id'] . '").on("click",function(){
                        $("#richieste' . $v['Id'] . '").toggle("slow");
                        $(this).find(\'span\').toggle();
                    });
                });
            </script>
            </div>
        </div>
        <div class="clearfix p-b-30"></div>
    <div class="latest-update-box">
        <div  id="richieste' . $v['Id'] . '" style="display:none">
        <div class="row p-b-15">
            <div class="col-auto text-right update-meta">
                <p class="text-muted m-b-0 d-inline"> ' . $DataRichiesta . '</p>
                <i class="p-l-10 fa-2x fa fa-envelope text-primary  update-icon"></i>
            </div>
            <div class="col">
                <h6>' . ($valore_provenienza != '' ? '&nbsp;&nbsp;&nbsp;<small>Percorso referer : <b>' . $valore_provenienza . '</b></small>' : '') . '</h6>
                    Arrivo della richiesta <b>N° ' . $NumeroPrenotazione . '</b>  &nbsp; Fonte di provenienza: <b>' . $FontePrenotazione . '</b>
                </div>
            </div>';
    $timeline .='<hr>';
    if ($DataInvio == '') {
        $timeline .=' 
                    <div class="row p-b-15">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline p-r-10">Non inviato</p>
                            <i class="p-l-10 fa-2x fa fa-envelope-o text-gray  update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Proposta soggiorno</h6>
                        </div>
                    </div>';

    } else {
        $timeline .='   
                    <div class="row p-b-15">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">' . $DataInvio . '</p>
                            <i class="p-l-10 fa-2x fa fa-envelope text-primary  update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Proposta soggiorno</h6>
                            Inviato il preventivo con proposta/e di soggiorno
                        </div>
                    </div>
                    <div class="row p-b-15">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">' . $DataScad . '</p>
                            <i class="p-l-10 fa-2x fa fa-clock-o text-primary  update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Scade: <b>Stand by</b> in attesa della conferma della proposta da parte del
                    cliente</h6>
                        </div>
                    </div>';
    }
    $timeline .='<hr>';
    if ($DataScadenza == '' && $DataInvioCC == '') {
        $timeline .='  
                    <div class="row p-b-15">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline p-r-10">Non inviata</p>
                            <i class="p-l-10 fa-2x fa fa-envelope-o text-gray  update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Conferma in attesa</h6>
                        </div>
                    </div>';
    } else {
        $timeline .=' 
                    <div class="row p-b-15">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">' . $DataInvioCT . '</p>
                            <i class="p-l-10 fa-2x fa fa-clock-o text-primary  update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Scadenza il:
                                ' . $DataScadenza . '<b>Conferma in attesa ...</b></h6>
                                 Inviata conferma in attesa del pagamento acconto per il soggiorno
                        </div>
                    </div>';
    }
    $timeline .='<hr>';
# RIEPILOGO CHAT
    $select = "SELECT hospitality_chat.* FROM hospitality_chat INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_chat.id_guest WHERE hospitality_guest.NumeroPrenotazione = '" . $NumeroPrenotazione . "' AND hospitality_chat.idsito = '" . $idsito . "' ORDER BY hospitality_chat.data DESC";
    $array_row = $dbMysqli->query($select);

    $chat = '';
    $riepilogo = '	<style>
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
                    <div id="balloon">';
    if (sizeof($array_row) > 0) {

        foreach ($array_row as $y =>$row ) {

            $data_tmp = explode(" ", $row['data']);
            $data_d = explode("-", $data_tmp[0]);
            $data = $data_d[2] . '-' . $data_d[1] . '-' . $data_d[0] . ' ' . $data_tmp[1];

            if ($row['operator'] == 1) {
                $q_img = $dbMysqli->query("SELECT img FROM hospitality_operatori WHERE  idsito = " . $row['idsito'] . " AND NomeOperatore = '" . $row['user'] . "' AND Abilitato = 1");
                $img = $q_img[0];
                $ImgOperatore = $img['img'];

                if ($ImgOperatore == '') {
                    $ImgOperatore = BASE_URL_SITO . 'img/receptionists.png';
                } else {
                    $ImgOperatore = BASE_URL_SITO . 'uploads/' . $row['idsito'] . '/' . $ImgOperatore . '';
                }
            }

            $riepilogo .= '  <li>
                                <div class="ballon">
                                <div ' . ($row['operator'] == 0 ? 'class="user2"' : 'class="operatore"') . '>
                                    <strong>' . $row['user'] . '</strong> &nbsp;&nbsp;' . ($row['operator'] == 0 ? '<img src="' . BASE_URL_SITO . 'img/receptionists.png" style="width:32px;height:32px" class="img-circle">' : '<img src="' . $ImgOperatore . '" style="width:32px;height:32px" class="img-circle">') . ' <br>
                                    <small><small>ha scritto il ' . $data . '</small></small>
                                </div>
                                <div ' . ($row['operator'] == 0 ? 'class="textchat"' : 'class="textchatoperatore"') . '>
                                        ' . nl2br($row['chat']) . '
                                </div>
                                <div class="clear"></div>
                                </div>
                            </li>
                            <br>';
    }
    $riepilogo .= '</div>';

        $timeline .='<div class="row p-b-15">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline p-r-10">Talk Chat</p>
                            <i class="p-l-10 fa-2x fa fa-comments text-primary  update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Avvenuta discussione in Chat></h6>
                            <b>Discussione:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" id="view_chat' . $NumeroPrenotazione . '"><span><i class="fa fa-expand text-green"  aria-hidden="true"></i> <small>espandi</small></span> <span style="display:none"><i class="fa fa-compress text-red" aria-hidden="true"></i> <small>comprimi</small></span></a>
                        </div>
                    </div>

                <div id="chat' . $NumeroPrenotazione . '" style="display:none">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <ul class="messaggi">
                            ' . $riepilogo . '
                            </ul>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <script>
                    $("#view_chat' . $NumeroPrenotazione . '").on("click",function(e){
                        $("#chat' . $NumeroPrenotazione . '").toggle("slow");
                        $(this).find(\'span\').toggle();
                        scroll_to(\'view_chat' . $NumeroPrenotazione . '\', 70, 1000);
                        e.stopPropagation();
                    });
                </script>';
        $timeline .='<hr>';
    }

// DATA DI INVIO DI UNA EMAIL DI UPSELLING
    $array_rec = $dbMysqli->query("SELECT * FROM hospitality_traccia_email_upselling WHERE NumPreno = " . $NumeroPrenotazione . " AND idsito= " . $idsito . " ORDER BY data_invio ASC");

    if (sizeof($array_rec) > 0) {
        $upselling = '';
        $oggetto = '';
        $contenuto = '';
        $modl = '';
        foreach ($array_rec as $xx => $val) {
            $Data_invio_tmp_ = explode(" ", $val['data_invio']);
            $Data_invio_tmp = explode("-", $Data_invio_tmp_[0]);
            $Data_invio = $Data_invio_tmp[2] . '/' . $Data_invio_tmp[1] . '/' . $Data_invio_tmp[0];
            $modl = '_' . $NumeroPrenotazione . '_' . $val['id'] . '_' . $v['Id'];
            $oggetto = $val['oggetto'];
            $contenuto = $val['contenuto'];
            $timeline .='<div class="row p-b-15">
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
									<a href="#" id="view_upseling' . $modl . '"><span><i class="fa fa-expand text-green"  aria-hidden="true"></i> <small>espandi</small></span> <span style="display:none"><i class="fa fa-compress text-red" aria-hidden="true"></i> <small>comprimi</small></span></a>
							</div>
						</div>
                        <script>
                            $("#view_upseling' . $modl . '").on("click",function(e){
                                $("#upselling' . $modl . '").toggle("slow");
                                $(this).find(\'span\').toggle();
                                scroll_to(\'view_upseling' . $modl . '\', 70, 1000);
                                e.stopPropagation();
                            });
                        </script>';

        }
        $timeline .='<hr>';
        $contenuto = '';
        $modl = '';
    }

    if ($Chiuso == '') {
        $timeline .=' 
        				<div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline p-r-10">Non chiusa</p>
								<i class="p-l-10 fa-2x fa fa-key text-gray  update-icon"></i>
							</div>
							<div class="col">
									<h6>Prenotazione non confermata</h6>
							</div>
						</div> ';
    } else {
        $timeline .='   
                        <div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline"> ' . $DataChiuso . '</p>
								<i class="p-l-10 fa-2x fa fa-key text-primary  update-icon"></i>
							</div>
							<div class="col">
									<h6>Prenotazione confermata</h6>
							</div>
						</div>';
    }
    $timeline .='<hr>';
    if ($DataCheckOut_val == 1 || $DataCheckOut == '') {
        $timeline .=' 
                        <div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline p-r-10">No Out</p>
								<i class="p-l-10 fa-2x fa fa-clock-o text-gray  update-icon"></i>
							</div>
							<div class="col">
									<h6>Check Out</h6>
							</div>
						</div>';
    } else {
        $timeline .=' 
                        <div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline">' . $DataCheckOut . '</p>
								<i class="p-l-10 fa-2x fa clock-o text-primary  update-icon"></i>
							</div>
							<div class="col">
                                <h6>Check Out</h6>
                                Il <small>Sig.re/ra</small> <b>
                                ' . $Cognome . ' ' . $Nome . '</b> ha lasciato la nostra struttura
							</div>
						</div>';
    }
    $timeline .='<hr>';
    if ($DataInvioCQ == '') {
        $timeline .='  
                        <div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline"></p>
								<i class="p-l-10 fa-2x fa fa-star text-gray  update-icon"></i>
							</div>
							<div class="col">
									<h6>Questionario</h6>
							</div>
						</div>';
    } else {
        $timeline .='   
                        <div class="row p-b-15">
							<div class="col-auto text-right update-meta">
								<p class="text-muted m-b-0 d-inline">' . $DataInvioCQ . '</p>
								<i class="p-l-10 fa-2x fa clock-o text-primary  update-icon"></i>
							</div>
							<div class="col">
                                <h6>Questionario</h6>
                                Invio del questionario per la Customer Satisfaction
							</div>
						</div>';

    }

    $timeline .='</div>
                </div>
            </div>';
    $n++;
    $modl = '';
}
?>