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
$result2 = $db->query($select2);
$array_ = $db->result($result2);

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
    $sel2 = $db->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = " . $NumeroPrenotazione . " AND idsito= " . $idsito . " AND TipoRichiesta = 'Conferma'");
    $res2 = $db->result($result2);
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
    $sel3 = $db->query("SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = " . $NumeroPrenotazione . " AND idsito = " . $idsito . " AND TipoRichiesta = 'Conferma' AND Chiuso = 1 ");
    $row3 = $db->row($sel3);
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

    //if ($FontePrenotazione == 'Sito Web') {

        $s = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = " . $idsito . " AND NumeroPrenotazione = " . $NumeroPrenotazione . "";
        $r = $db->query($s);
        $rws = $db->result($r);

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

    $timeline .=' 
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
        <div class="clearfix"></div>
        <ul class="timeline" id="richieste' . $v['Id'] . '" style="display:none">
        <li class="time-label">
            <span class="bg-red">
                ' . $DataRichiesta . '
            </span>
            </li>
            <li>
            <i class="fa fa-envelope bg-blue"></i>
            <div class="timeline-item">
            <h3 class="timeline-header">
                <div class="row">
                    <div class="col-md-2">        
                        <b>Richiesta di preventivo</b>
                    </div>
                    <div class="col-md-2">
                    ' . ($valore_provenienza != '' ? '&nbsp;&nbsp;&nbsp;<small>Percorso referer : <b>' . $valore_provenienza . '</b></small>' : '') . '
                    </div>';
if ($FontePrenotazione == 'Sito Web') {

    $timeline .= '  <div class="col-md-1">        
                        <a href="javascript:;" data-toggle="modal" data-target="#EmailRichiesta'.$NumeroPrenotazione .'" title="Visualizza Email Originale" class="btn btn-xs btn-success"><i class="fa fa-comment" aria-hidden="true"></i> Apri Richiesta</a>
                    </div>';


                    $sel_arrayemail = "SELECT * FROM notifiche WHERE  id_sito_riferimento = " . $idsito . " AND (data_invio BETWEEN '" . $data_email_suiteweb."' AND '".$data_email_suiteweb_post."')  AND syncro_hospitality = 1";
                    $r_arrayemail   = $db_suiteweb->query($sel_arrayemail);
                    $arrayEmail     = $db_suiteweb->result($r_arrayemail);
                    foreach ($arrayEmail as $key => $value) {

                        $json_output = json_decode($value['json_richiesta'], true);
                        $email_json = $json_output['email'];
                        $richiestaPresente = false;

                        if($Email == $email_json){

                            $richiestaPresente = false;

                            $testoMail   = $value['testo_notifica'];
                            $oggettoMail = $value['oggetto_notifica'];
                                        
                            $timeline .= '<div class="modal large" id="EmailRichiesta'.$NumeroPrenotazione .'" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width:900px!important;">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Richiesta Originale: '.$oggettoMail.'</h4>
                                                </div>
                                                <div class="modal-body">
                                                '.$testoMail .'
                                                </div>
                                            </div>
                                            </div>
                                        </div>  ';      
                        }

                    }
                    if($richiestaPresente == false){
                        $timeline .= '<div class="modal large" id="EmailRichiesta'.$NumeroPrenotazione .'" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width:900px!important;">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Dato mancante!</h4>
                                            </div>
                                            <div class="modal-body">
                                                Email NON presente su SuiteWeb, probabilmente è stata cancellata!
                                                <br><br>OPPURE<br><br>
                                                Questo preventivo è stato duplicato <small>(<em>quando ancora l\'operazione era possibile in QUOTO</em>)</small>!
                                                <br><br>COMUNQUE<br><br>
                                                Se sei certo della sua provenienza <small>(<em>confrontando in dati in altro modo.....</em>)</small>, puoi assegnare alla richiesta una provenienza ed una timeline!
                                            </div>
                                        </div>
                                        </div>
                                    </div>  ';  
                    }

                  
    if(IS_NETWORK_SERVICE_USER == 1){

        $sel_track = "SELECT distinct(hospitality_client_id.NumeroPrenotazione),hospitality_custom_dimension.source,hospitality_custom_dimension.medium,hospitality_custom_dimension.urlpath FROM hospitality_client_id 
                        INNER JOIN hospitality_custom_dimension ON  hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
                        WHERE hospitality_client_id.idsito = " . $idsito . "
                        AND hospitality_custom_dimension.idsito = " . $idsito . "
                        AND hospitality_client_id.NumeroPrenotazione = " . $NumeroPrenotazione . "";
        $r_track   = $db->query($sel_track);
        $rws_track = $db->result($r_track);

        if(sizeof($rws_track)>0){

            $timeline .='    <div class="col-md-7">';
            $timeline .='         <div class="row">
                                    <div class="col-md-4">   
                                        <label>Source</label>
                                    </div>
                                    <div class="col-md-4"> 
                                        <label>Medium</label>
                                    </div>
                                    <div class="col-md-4"> 
                                        <label>Provenienza</label>
                                    </div>
                                </div>';
                foreach($rws_track as $Ky => $val){
                    $timeline .='           <div class="row">
                                                <div class="col-md-4">   
                                                <small>'.$val['source'].'</small>
                                                </div>
                                                <div class="col-md-4">   
                                                <small>'.$val['medium'].'</small>
                                                </div>
                                                <div class="col-md-4"> 
                                                <small> '.$val['urlpath'].'</small>
                                                </div>
                                            </div>
                                            <div class="clear"></div>';
                }
                $timeline .='   </div>';  
        }else{

                $sel_fonte = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = " . $idsito . " AND NumeroPrenotazione = " . $NumeroPrenotazione . "";
                $r_fonte   = $db->query($sel_fonte);
                $rws_fonte = $db->result($r_fonte);

                $timeline .='    <div class="col-md-7">';
                $timeline .='       <div class="text-center"><small>Modulo per modifica referer visibile solo ad Operatore Network</small></div><div class="clear"></div> ';
                $timeline .='         <div class="row">
                                        <div class="col-md-6">   
                                            <label>Provenienza</label>
                                        </div>
                                        <div class="col-md-6"> 
                                            <label>Timeline</label>
                                        </div>
                                    </div>
                                    <form name="formReferer" id="formReferer'.$NumeroPrenotazione .'">';
                                    if(sizeof($rws_fonte)>0){
                                        foreach($rws_fonte as $chiave => $valore){
                    $timeline .='           <div class="row">
                                                <div class="col-md-6">   
                                                    <input type="text" value="'.$valore['Provenienza'].'" name="Provenienza['.$valore['Id'].']" id="Provenienza['.$valore['Id'].']" class="form-control" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <input type="text" value="'.$valore['Timeline'].'" name="Timeline['.$valore['Id'].']" id="Timeline['.$valore['Id'].']" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="clear"></div>';
                                        }
                                    }else{

                    $timeline .='   <div class="row">
                                            <div class="col-md-6">   
                                                <input type="text" name="Provenienza" id="Provenienza" class="form-control" />
                                            </div>
                                            <div class="col-md-6"> 
                                                <input type="text" name="Timeline" id="Timeline" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="clear"></div>';
                                    }
                    $timeline .=' <div class="row">
                                            <div class="col-md-12 text-right"> 
                                                <input type="hidden" name="idsito" value="'.$idsito .'"  />
                                                <input type="hidden" name="NumeroPrenotazione" value="'.$NumeroPrenotazione .'" />
                                                <button type="submit" class="btn btn-success" id="button'.$NumeroPrenotazione.'">Salva</button>
                                            </div>
                                        </div>
                                    </form>';
                    $timeline .='   <script>
                                        $(document).ready(function() {
                                            $("#formReferer'.$NumeroPrenotazione.'").submit(function(){
                                                    var dati = $("#formReferer'.$NumeroPrenotazione.'").serialize();   
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/salva_referer.php",
                                                        type: "POST",
                                                        data: dati,
                                                            success: function(msg) {
                                                                console.log(msg);
                                                                $("#ctrl_referer'.$NumeroPrenotazione.'").html(\'<div class="clear"></div><div class="alert alert-success text-center"><b>Salvataggio effettuato con successo! Attendi il reload della pagina!</b></div>\');
                                                                    setTimeout(function(){
                                                                        $("#ctrl_referer'.$NumeroPrenotazione.'").hide();
                                                                        location.reload();
                                                                    },2000); 
                                                            }
                                                    });
                                                    return false; // con false senza refresh della pagina
                                                });
                                        });
                                        </script>
                                        <div id="ctrl_referer'.$NumeroPrenotazione.'"></div>';
                    $timeline .='   </div>';  
            }
        }    
           
    }
    $timeline .=' 
                </div>
                </h3>
                <div class="timeline-body">
                Arrivo della richiesta <b>N° ' . $NumeroPrenotazione . '</b>  &nbsp; Fonte di provenienza: <b>' . $FontePrenotazione . '</b>
    
                </div>
            </div>
            </li>';

    if ($DataInvio == '') {
        $timeline .='   <li class="time-label">
                <span class="bg-gray">
                    <small class="text-white">Non inviato</small>
                </span>
                </li>
                <li>
                <i class="fa fa-table bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                    <h3 class="timeline-header no-border text-white">Proposta soggiorno</h3>
                </div>
                </li>';

    } else {
        $timeline .='   <li class="time-label">
                <span class="bg-green">
                    ' . $DataInvio . '
                </span>
                </li>
                <li>
                <i class="fa fa-table bg-aqua"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header no-border"><b>Proposta soggiorno</b></h3>
                    <div class="timeline-body">
                    Inviato il preventivo con proposta/e di soggiorno
                    </div>
                </div>
                </li>
                <li>
                <i class="fa fa-pause bg-red"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Scadenza il:
                    ' . $DataScad . '</span>
                    <h3 class="timeline-header"> <b>Stand by:</b> in attesa della conferma della proposta da parte del
                    cliente</h3>

                </div>
                </li>';
    }
    if ($DataScadenza == '' && $DataInvioCC == '') {
        $timeline .='   <li class="time-label">
                <span class="bg-gray">
                    <small class="text-white">Non inviata</small>
                </span>
                </li>
                <li>
                <i class="fa fa-credit-card bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                    <h3 class="timeline-header no-border text-white">Conferma in attesa</h3>
                </div>
                </li>';
    } else {
        $timeline .='   <li class="time-label">
                <span class="bg-light-blue">
                    ' . $DataInvioCT . '
                </span>
                </li>
                <li>
                <i class="fa fa-credit-card bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Scadenza il:
                    ' . $DataScadenza . '</span>
                    <h3 class="timeline-header"><b>Conferma in attesa ...</b></h3>
                    <div class="timeline-body">
                    Inviata conferma in attesa del pagamento acconto per il soggiorno
                    </div>

                </div>
                </li>';
    }

# RIEPILOGO CHAT
    $select = "SELECT hospitality_chat.* FROM hospitality_chat INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_chat.id_guest WHERE hospitality_guest.NumeroPrenotazione = '" . $NumeroPrenotazione . "' AND hospitality_chat.idsito = '" . $idsito . "' ORDER BY hospitality_chat.data DESC";
    $res = $db->query($select);
    $array_row = $db->result($res);

    $chat = '';
    $riepilogo = '';
    if (sizeof($array_row) > 0) {

        foreach ($array_row as $y =>$row ) {

            $data_tmp = explode(" ", $row['data']);
            $data_d = explode("-", $data_tmp[0]);
            $data = $data_d[2] . '-' . $data_d[1] . '-' . $data_d[0] . ' ' . $data_tmp[1];

            if ($row['operator'] == 1) {
                $q_img = $db->query("SELECT img FROM hospitality_operatori WHERE  idsito = " . $row['idsito'] . " AND NomeOperatore = '" . $row['user'] . "' AND Abilitato = 1");
                $img = $db->row($q_img);
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

        $timeline .='
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
<h3 class="timeline-header"> <b>Discussione:</b> clicca sull\'icona per visualizzare il contenuto &nbsp;&nbsp;&nbsp;<a href="#" id="view_chat' . $NumeroPrenotazione . '"><span><i class="fa fa-expand text-green"  aria-hidden="true"></i> <small>espandi</small></span> <span style="display:none"><i class="fa fa-compress text-red" aria-hidden="true"></i> <small>comprimi</small></span></a></h3>
</div>
</li>
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

    }

// DATA DI INVIO DI UNA EMAIL DI UPSELLING
    $select4 = $db->query("SELECT * FROM hospitality_traccia_email_upselling WHERE NumPreno = " . $NumeroPrenotazione . " AND idsito= " . $idsito . " ORDER BY data_invio ASC");
    $array_rec = $db->result($select4);

    if (sizeof($array_rec) > 0) {
        $upselling = '';
        $oggetto = '';
        $contenuto = '';
        $modl = '';
        foreach ($array_rec as $xx => $val) {
            $Data_invio_tmp_ = explode(" ", $val['data_invio']);
            $Data_invio_tmp = explode("-", $Data_invio_tmp_[0]);
            $Data_invio = $Data_invio_tmp[2] . '/' . $Data_invio_tmp[1] . '/' . $Data_invio_tmp[0] . ' ' . $Data_invio_tmp_[1];
            $modl = '_' . $NumeroPrenotazione . '_' . $val['id'] . '_' . $v['Id'];
            $oggetto = $val['oggetto'];
            $contenuto = $val['contenuto'];
            $timeline .='
            <li class="time-label">
                <span class="bg-green">
                ' . $Data_invio_tmp[2] . '/' . $Data_invio_tmp[1] . '/' . $Data_invio_tmp[0] . '
                </span>
            </li>
            <li>
                <i class="fa fa-table bg-aqua"></i>
                <div class="timeline-item">
                <h3 class="timeline-header no-border"><b>Inviata E-Mail di UpSelling</b></h3>
                    <div class="timeline-body">
                        ' . $oggetto . '
                    </div>
                </div>
            </li>
            <li>
                <i class="fa fa-play bg-red"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Inviata email il: ' . $Data_invio . '</span>
                    <h3 class="timeline-header"> <b>Contenuto:</b> clicca sull\'icona per visualizzare il contenuto
                    &nbsp;<a href="#" id="view_upseling' . $modl . '"><span><i class="fa fa-expand text-green"  aria-hidden="true"></i> <small>espandi</small></span> <span style="display:none"><i class="fa fa-compress text-red" aria-hidden="true"></i> <small>comprimi</small></span></a></h3>
                </div>
            </li>
            <div  id="upselling' . $modl . '" style="display:none">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        ' . $contenuto . '
                    </div>
                    <div class="col-md-2"></div>
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

        $contenuto = '';
        $modl = '';
    }

    if ($Chiuso == '') {
        $timeline .='   <li class="time-label">
                <span class="bg-gray">
                    <small class="text-white">Non chiusa</small>
                </span>
                </li>
                <li>
                <i class="fa fa-h-square bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                    <h3 class="timeline-header no-border text-white">Prenotazione chiusa</h3>
                </div>
                </li>';
    } else {
        $timeline .='   <li class="time-label">
                <span class="bg-teal">
                    ' . $DataChiuso . '
                </span>
                </li>
                <li>
                <i class="fa fa-h-square bg-purple"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header no-border"><b>Prenotazione chiusa</b></h3>
                </div>
                </li>';
    }
    if ($DataCheckOut_val == 1 || $DataCheckOut == '') {
        $timeline .='  <li class="time-label">
                <span class="bg-gray">
                    <small class="text-white">No Out</small>
                </span>
                </li>
                <li>
                <i class="fa fa-sign-out bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                    <h3 class="timeline-header no-border text-white">Check Out</h3>
                </div>
                </li>';
    } else {
        $timeline .='   <li class="time-label">
                <span class="bg-maroon">
                    ' . $DataCheckOut . '
                </span>
                </li>
                <li>
                <i class="fa fa-sign-out bg-blue"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><b>Check Out</b></h3>
                    <div class="timeline-body">
                    Il <small>Sig.re/ra</small> <b>
                        ' . $Cognome . ' ' . $Nome . '</b> ha lasciato la nostra struttura
                    </div>
                </div>
                </li>';
    }
    if ($DataInvioCQ == '') {
        $timeline .='   <li>
                <i class="fa fa-question bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                    <h3 class="timeline-header no-border text-white">Questionario</h3>
                </div>
                </li>';
    } else {
        $timeline .='   <li>
                <i class="fa fa-question bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Data di invio:
                    ' . $DataInvioCQ . '</span>
                    <h3 class="timeline-header"><b>Questionario</b></h3>
                    <div class="timeline-body">
                    Invio del questionario per la Customer Satisfaction
                    </div>
                </div>
                </li>
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>';

    }

    $timeline .='
                    </ul>
                    <br>';
    $n++;
    $modl = '';
}


