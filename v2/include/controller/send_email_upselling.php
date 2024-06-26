<?php
if($_REQUEST['action']=='send_email_upselling'){

    $checkbox = explode(',',$_REQUEST['checkbox']);
    $idsito   = $_REQUEST['idsito'];

    if(is_array($checkbox) && !empty($checkbox)){	

    function servizi_aggiuntivi($idsito,$lg,$id_richiesta){
        global $db;
            $select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                        INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                        WHERE hospitality_dizionario_lingua.Lingua = '".$lg."'
                        AND hospitality_dizionario_lingua.idsito = ".$idsito;
            $res = $db->query($select);
            $result = $db->result($res);
            $tot_l = sizeof($result);
            if($tot_l > 0){
                foreach ($result as $key => $value) {
                    if($value['etichetta']=='SERVIZI_AGGIUNTIVI'){
                        $SERVIZI_AGGIUNTIVI = $value['testo'];
                    }
                    if($value['etichetta']=='AL_GIORNO'){
                        $AL_GIORNO = $value['testo'];
                    }
                    if($value['etichetta']=='UNA_TANTUM'){
                        $UNA_TANTUM = $value['testo'];
                    }

                }
            }

            $query  = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi 
                        WHERE hospitality_tipo_servizi.idsito = ".$idsito." 
                        AND hospitality_tipo_servizi.Lingua = 'it' 
                        AND hospitality_tipo_servizi.Abilitato = 1
                        ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
            $risultato_query = $db->query($query);
            $record          = $db->result($risultato_query);
            if(sizeof($record)>0){
                switch($lg){
                    case "it":
                        $stringa_servizi = 'I servizi da te scelti nel preventivo confermato, sono evidenziati dal flag';
                    break;
                    case "en":
                        $stringa_servizi = 'The services you have chosen in the confirmed proposal are highlighted by the flag';
                    break;
                    case "fr":
                        $stringa_servizi = 'Les services que vous avez choisis dans la proposition confirmée sont mis en évidence par le drapeau ';
                    break;
                    case "de":
                        $stringa_servizi = 'Die Dienste, die Sie im bestätigten Angebot ausgewählt haben, werden durch die Markierung hervorgehoben ';
                    break;
                    default:
                        $stringa_servizi = 'The services you have chosen in the confirmed proposal are highlighted by the flag ';
                    break;
                }
            $servizi .='<style>
                                                .iconaDimension {
                                                    width:auto !important;
                                                    height:32px !important;
                                                } 
                                                .content_icona{
                                                    width:auto !important;
                                                    height:32px !important;
                                                    padding:4px!important;
                                                    margin: 4px!important;
                                                    border:1px solid #ccc!important;
                                                    border-radius: 4px 4px 4px 4px!important;
                                                    -moz-border-radius: 4px 4px 4px 4px!important;
                                                    -webkit-border-radius: 4px 4px 4px 4px!important;
                                                    display: inherit !important;
                                                }
                                                .content_icona_empty{
													width:auto !important;
													height:32px !important;
													padding:4px!important;
													margin: 4px!important;
													display: inherit !important;
												 }
                                        </style>
                                        <table cellpadding="10" cellspacing="0" border="0" style="width:60%;">
                                            <tr>
                                                <td colspan="5" style="text-align:left"><span style="font-size:12px">'.$stringa_servizi.'</span> <span style="width:22px;heigh:26px;border:1px solid #CCCCCC;padding:2px"><img src="'.BASE_URL_SITO.'img/icon_email/check.png" style="width:20px;height:auto"></span></td>
                                            </tr>';
            $calcoloprezzo = '';
            $check_s       = '';
            foreach($record as $chiave => $campo){

                $select4 = "SELECT * FROM hospitality_relazione_servizi_proposte WHERE servizio_id = ".$campo['Id']." AND id_richiesta = ".$id_richiesta;
                $ris4    = $db->query($select4); 
                $rws4    = $db->row($ris4); 
                if($rws4>0){             
                    $check_s = 1;
                }else{
                    $check_s = 0;
                }


                $q  = "SELECT hospitality_tipo_servizi_lingua.Servizio FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".$idsito." AND hospitality_tipo_servizi_lingua.lingue = '".$lg."'";
                $r = $db->query($q);
                $rec  = $db->row($r);

                switch($campo['CalcoloPrezzo']){
                    case "Al giorno":
                        $calcoloprezzo = $AL_GIORNO;
                    break;
                    case "Una tantum":
                        $calcoloprezzo = $UNA_TANTUM;
                    break;
                }
                            $servizi .='<tr>
                                                <td style="text-align:center">'.($campo['Icona']!=''?'<div class="content_icona"><img src="'.BASE_URL_SITO.'uploads/'.$idsito.'/'.$campo['Icona'].'" class="iconaDimension"></div>':'<div class="content_icona_empty"></div>').'</td>
                                                <td style="text-align:left"><b>'.$rec['Servizio'].'</b></td>
                                                <td style="text-align:center">'.$calcoloprezzo.'</td>
                                                <td style="text-align:center">'.($campo['PrezzoServizio']!=0?'&euro;&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'Gratis').'</td> 
                                                <td style="text-align:center"><div style="width:22px;heigh:26px;border:1px solid #CCCCCC;padding:2px">'.($check_s==1?'<img src="'.BASE_URL_SITO.'img/icon_email/check.png" style="width:20px;height:auto">':'&nbsp;').'</div></td>                                                                    
                                            </tr>';

            }
            $servizi .='</table>';
            }
            return $servizi;
        }

function riepilogo_proposta($idsito,$id_richiesta,$lg){
    global $db;

    $select = "SELECT hospitality_proposte.Id as IdProposta,
                    hospitality_proposte.PrezzoL,
                    hospitality_proposte.PrezzoP,
                    hospitality_proposte.AccontoPercentuale,
                    hospitality_proposte.AccontoImporto,
                    hospitality_proposte.AccontoTesto,
                    hospitality_proposte.NomeProposta as NomeProposta,
                    hospitality_proposte.TestoProposta as TestoProposta,
                    hospitality_guest.NumeroAdulti,
                    hospitality_guest.NumeroBambini,
                    hospitality_guest.EtaBambini1,
                    hospitality_guest.EtaBambini2,
                    hospitality_guest.EtaBambini3,
                    hospitality_guest.EtaBambini4,
                    hospitality_guest.EtaBambini5,
                    hospitality_guest.EtaBambini6,
                    hospitality_guest.AccontoRichiesta,
                    hospitality_guest.Nome,
                    hospitality_guest.Cognome,
                    hospitality_guest.AccontoLibero,
                    hospitality_guest.Email,
                    hospitality_guest.DataArrivo,
                    hospitality_guest.DataPartenza,
                    hospitality_guest.NumeroPrenotazione,
                    hospitality_guest.DataRichiesta,
                    hospitality_guest.ChiPrenota,
                    hospitality_guest.TipoRichiesta              
                FROM hospitality_proposte 
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_guest.idsito = ".$idsito." AND hospitality_proposte.id_richiesta = ".$id_richiesta." ORDER BY hospitality_proposte.Id ASC";
            $result = $db->query($select);
            $res    = $db->result($result);
            $tot    = sizeof($res);

        if($tot > 0){

            $FCamere         = '';
            $data_alernativa = ''; 
            $DPartenza       = '';
            $DArrivo         = '';
            $DNotti          = '';        

            foreach ($res as $key => $value) {

                $PrezzoL          = number_format($value['PrezzoL'],2,',','.');
                $PrezzoP          = number_format($value['PrezzoP'],2,',','.');
                $IdProposta       = $value['IdProposta'];
                $PrezzoPC         = $value['PrezzoP']; 
                $TipoRichiesta    = $value['TipoRichiesta']; 
                $AccontoRichiesta = $value['AccontoRichiesta']; 
                $AccontoLibero    = $value['AccontoLibero']; 
                $NomeProposta     = $value['NomeProposta'];
                $TestoProposta    = stripslashes($value['TestoProposta']); 
                $Operatore        = stripslashes($value['ChiPrenota']);
                $Nome             = stripslashes($value['Nome']); 
                $Cognome          = stripslashes($value['Cognome']); 
                $Email            = $value['Email'];
                $NumeroAdulti     = $value['NumeroAdulti'];
                $NumeroPrenotazione   = $value['NumeroPrenotazione'];
                $DataRichiesta_tmp    = explode("-",$value['DataRichiesta']);
                $DataRichiesta        = $DataRichiesta_tmp[2].'-'.$DataRichiesta_tmp[1].'-'.$DataRichiesta_tmp[0];
                $NumeroBambini    = $value['NumeroBambini'];
                $EtaBambini1      = $value['EtaBambini1'];
                $EtaBambini2      = $value['EtaBambini2'];
                $EtaBambini3      = $value['EtaBambini3'];
                $EtaBambini4      = $value['EtaBambini4'];
                $EtaBambini5      = $value['EtaBambini5'];
                $EtaBambini6      = $value['EtaBambini6'];            
                $Arrivo_tmp       = explode("-",$value['DataArrivo']);
                $Arrivo           = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
                $Partenza_tmp     = explode("-",$value['DataPartenza']);
                $Partenza         = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];

                $start            = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
                $end              = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
                $Notti            = ceil(abs($end - $start) / 86400);

                // date alternative
                $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
                $re = $db->query($se);
                $rc = $db->row($re);   
                if(is_array($rc)) {
                if($rc > count($rc)) // se la pagina richiesta non esiste
                    $tt = count($rc); // restituire la pagina con il numero più alto che esista
                }else{ 	
                    $tt = 0;
                }
                if($tt>0){
                    $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                    $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                    $DPartenza_tmp  = explode("-",$rc['Partenza']);
                    $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                    $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                    $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                    $DNotti         = ceil(abs($Dend - $Dstart) / 86400);
                }

                $AccontoPercentuale = $value['AccontoPercentuale']; 
                $AccontoImporto     = $value['AccontoImporto'];
                $AccontoTesto       = stripslashes($value['AccontoTesto']);

                $select2 = "SELECT hospitality_richiesta.NumeroCamere,
                                hospitality_richiesta.Prezzo,
                                hospitality_richiesta.NumAdulti,
                                hospitality_richiesta.NumBambini,
                                hospitality_richiesta.EtaB,
                                hospitality_tipo_camere.Id as IdCamera,
                                hospitality_tipo_camere.TipoCamere as TipoCamere,
                                hospitality_tipo_camere.Servizi as Servizi,
                                hospitality_camere_testo.Camera as TitoloCamera,
                                hospitality_camere_testo.Descrizione as TestoCamera,
                                hospitality_tipo_soggiorno.TipoSoggiorno as TipoSoggiorno,
                                hospitality_tipo_soggiorno_lingua.Soggiorno as TitoloSoggiorno,
                                hospitality_tipo_soggiorno_lingua.Descrizione as TestoSoggiorno
                                FROM hospitality_richiesta 
                                INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                INNER JOIN hospitality_camere_testo ON hospitality_camere_testo.camere_id = hospitality_tipo_camere.Id
                                INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                                INNER JOIN hospitality_tipo_soggiorno_lingua ON hospitality_tipo_soggiorno_lingua.soggiorni_id = hospitality_tipo_soggiorno.Id
                                WHERE hospitality_tipo_camere.idsito = ".$idsito." 
                                AND hospitality_camere_testo.idsito = ".$idsito." 
                                AND hospitality_tipo_soggiorno.idsito = ".$idsito." 
                                AND hospitality_tipo_soggiorno_lingua.idsito = ".$idsito." 
                                AND hospitality_richiesta.id_proposta = ".$IdProposta." AND hospitality_camere_testo.lingue = '".$lg."' AND hospitality_tipo_camere.Abilitato = 1
                                AND hospitality_tipo_soggiorno_lingua.lingue = '".$lg."'
                                AND hospitality_tipo_soggiorno.Abilitato = 1 ORDER BY hospitality_richiesta.Id ASC";
                $result2 = $db->query($select2);
                $res2    = $db->result($result2);

                if($rc['Arrivo'] != '' && $rc['Partenza'] != '' && $rc['Arrivo'] != '0000-00-00' && $rc['Partenza'] != '0000-00-00'){

                    if($rc['Arrivo']!= $value['DataArrivo']){
                        $Arrivo   = $DArrivo;
                        $Notti    = $DNotti;
                    }
                    if($rc['Partenza']!= $value['DataPartenza']){
                        $Partenza = $DPartenza;
                        $Notti    = $DNotti;
                    }                                 
                }

                foreach ($res2 as $ky => $val) {

                    $NumeroCamere    = $val['NumeroCamere'];
                    $NumAdulti       = $val['NumAdulti'];
                    $NumBambini      = $val['NumBambini'];
                    $EtaB            = $val['EtaB'];

                    $FCamere .= $val['TitoloSoggiorno'].' - Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].' '.($NumAdulti!=0?'A.'.$NumAdulti:'').' '.($NumBambini!=0?'B.'.$NumBambini:'').' '.($EtaB!=0?''.ETA.' '.$EtaB.'':'').'- €. '.number_format($val['Prezzo'],2,',','.').' <br>';
                }
          

                $proposta .=' <table cellpadding="10" cellspacing="0" border="0" style="width:60%;">
                                <tr>
                                    <td>
                                        '.OFFERTA.' nr. '.$NumeroPrenotazione.' '.DEL.' '.$DataRichiesta.'
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        '.DATA_ARRIVO.' '.$Arrivo.' - '.DATA_PARTENZA.' '.$Partenza.'
                                     </td>
                                </tr>';           
                $proposta .='<tr>
                                    <td>
                                        '.(($NomeProposta!='' || $TestoProposta!='')?''.$NomeProposta.' <br>'.$TestoProposta.'<br><br>':'').'
                                        '.SOGGIORNO_PER_NR_ADULTI.' <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?NR_BAMBINI.' <b>'.$NumeroBambini .'</b> - '.($EtaBambini1!='0' && $EtaBambini1!=''?$EtaBambini1.' '.ANNI.' ':'').($EtaBambini2!='0' && $EtaBambini2!=''?$EtaBambini2.' '.ANNI.' ':'').($EtaBambini3!='0' && $EtaBambini3!=''?$EtaBambini3.' '.ANNI.' ':'').($EtaBambini4!='0' && $EtaBambini4!=''?$EtaBambini4.' '.ANNI.' ':'').($EtaBambini5!='' && $EtaBambini5!='0'?$EtaBambini5.' '.ANNI.' ':'').($EtaBambini6!='' && $EtaBambini6!='0'?$EtaBambini6.' '.ANNI.' ':'').' ':'').NOTTI.' <b>'.$Notti.'</b>                         
                                            <br><br>'.$FCamere .'<br>'.($PrezzoL!='0,00'?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> - ':'').'  Prezzo €.'.$PrezzoP.'<br><br>';
                                                                        
                                                if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                                    $proposta .=' '.ACCONTO.': '.$AccontoRichiesta.' %  - €. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'<br>';                                     
                                                }
                                                if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                                    $proposta .=' '.ACCONTO.': €. '.number_format($AccontoLibero,2,',','.').'<br>';                                     
                                                }  

                                                if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                                    $proposta .=' '.ACCONTO.': '.$AccontoPercentuale.' %  - €. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'<br>';                                     
                                                }

                                                if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                                    if($AccontoImporto >= 1) {
                                                        $proposta .=' '.ACCONTO.':  €. '.number_format($AccontoImporto,2,',','.').'<br>';
                                                    }else{
                                                        $proposta .=' '.CARTACREDITOGARANZIA.'<br>';
                                                    }                                      
                                                } 

                                    

                $proposta .='  
                                    </td>
                                </tr>
                            </table> ';  
        }
    }
    return $proposta;
}

        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
        $ri = $db->query($qr);
        $rx = $db->row($ri);
        if(is_array($rx)) {
            if($rx > count($rx))
                $isSMTP = count($rx); 
        }else{ 	
            $isSMTP = 0;
        }
        $SmtpAuth     = $rx['SMTPAuth'];
        $SmtpHost     = $rx['SMTPHost'];
        $SmtpPort     = $rx['SMTPPort'];
        $SmtpSecure   = $rx['SMTPSecure'];
        $SmtpUsername = $rx['SMTPUsername'];
        $SmtpPassword = $rx['SMTPPassword'];



        $Lingua             = '';
        $servizi            = '';
        $riepilogo_proposta = '';
        $select             = '';
        $ris_query          = '';
        $contenuto          = '';
        $messaggio          = '';
        $oggetto            = '';

        $rec_query          = array();


        require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';

        foreach ($checkbox as $ke => $vl) {

            if($vl!=''){

                $mail = new PHPMailer;

                $select = "SELECT * FROM hospitality_guest WHERE Id = ".$vl." AND idsito = ".$idsito;
                $ris_query = $db->query($select);
                $rec_query = $db->result($ris_query);

                $oggetto   = '';
                $messaggio = '';
                $contenuto = '';

                foreach($rec_query as $ky => $row){

                    $Lingua    = $row['Lingua'];  
                    require_once $_SERVER['DOCUMENT_ROOT'].'/v2/lingue/lang.php';

                    $servizi             = servizi_aggiuntivi($idsito,$Lingua,$vl);
                    $riepilogo_proposta  = riepilogo_proposta($idsito,$vl,$Lingua);
                    $oggetto = str_replace("[cliente]",$row['Nome'].' '.$row['Cognome'], $_REQUEST['oggetto']).' - '.NOMEHOTEL;

                            if($isSMTP > 0){
                                $mail->IsSMTP(); 
                                $mail->SMTPDebug = 0; 
                                $mail->Debugoutput = 'html';
                                $mail->SMTPAuth = $SmtpAuth; 
                                if($SmtpSecure!=''){
                                    $mail->SMTPSecure = $SmtpSecure; 
                                }
                                $mail->SMTPKeepAlive = true; 					
                                $mail->Host = $SmtpHost;
                                $mail->Port = $SmtpPort;
                                $mail->Username = $SmtpUsername;
                                $mail->Password = $SmtpPassword;
                            }       
                  
                            $mail->setFrom(MAIL_SEND, NOMEHOTEL);

                            //$mail->addReplyTo(EMAILHOTEL, NOMEHOTEL);

                            $mail->addAddress($row['Email'], $row['Nome'].' '.$row['Cognome']);

                            $mail->isHTML(true);

                            $mail->Subject = $oggetto;

                            $contenuto = str_replace("[cliente]",$row['Nome'].' '.$row['Cognome'], $_REQUEST['testo_upselling']);

                            $contenuto = str_replace("[proposta]",$riepilogo_proposta, $contenuto);

                            $contenuto = str_replace("[servizi]",$servizi, $contenuto);

                            $contenuto = str_replace("[struttura]",NOMEHOTEL, $contenuto);

                            $messaggio = '<div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00acc1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.EMAILHOTEL.'?subject=Risposta all\'email di UpSelling sulla prenotazione confermata Nr.'.$row['NumeroPrenotazione'].' del '.gira_data($row['DataChiuso']).' intestata a: '.$row['Nome'].' '.$row['Cognome'].'">Clicca qui per rispondere a: '.NOMEHOTEL.'</a></div><div style="clear:both" style="height:10px">&nbsp;</div>'.$contenuto.'<div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00acc1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.EMAILHOTEL.'?subject=Risposta all\'email di UpSelling sulla prenotazione confermata Nr.'.$row['NumeroPrenotazione'].' del '.gira_data($row['DataChiuso']).' intestata a: '.$row['Nome'].' '.$row['Cognome'].'">Clicca qui per rispondere a: '.NOMEHOTEL.'</a></div>';
                            
                            $mail->msgHTML($messaggio, dirname(__FILE__));

                            $mail->AltBody = 'Per visualizzare il messaggio, si prega di utilizzare un visualizzatore e-mail compatibile con HTML!';

                            $mail->send();

                            #inserimento traccia invii
                            $insert = "INSERT INTO hospitality_traccia_email_upselling (idsito,id_richiesta,NumPreno,oggetto,contenuto,data_invio) VALUES('".$idsito."','".$vl."','".$row['NumeroPrenotazione']."','".$oggetto."','".$contenuto."','".date('Y-m-d H:i:s')."')";
                            $db->query($insert);
                }

            }
            
        }
        $prt->_goto(BASE_URL_SITO.'prenotazioni/upselling/ok');
    }
}
?>