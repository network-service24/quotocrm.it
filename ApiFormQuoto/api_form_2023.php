<?

require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

 if($_REQUEST['action']=='send') {
        require $_SERVER['DOCUMENT_ROOT'].'/ApiQuoto/PHPMailer/PHPMailerAutoload.php';
        $mail       = new PHPMailer;
        $mail_hotel = new PHPMailer;

        $idsito           = $_REQUEST['idsito'];
        $urlback          = $_REQUEST['urlback'];
        $iubendapolicy    = $_REQUEST['iubendapolicy'];
        $language         = $_REQUEST['language'];
        $check_valid      = $_REQUEST['check_valid'];
        $res              = $_REQUEST['res'];


        include_once($_SERVER['DOCUMENT_ROOT'].'/ApiQuoto/function.inc.php');

        require_once $_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php';

        $db_quoto = new MysqliDb(HOST, DB_USER, DB_PASSWORD, DATABASE);

        ## QUERY PER CONFIGURAZIONE SMTP TURBO, SERVIZIO ESTERNO PER INVIO EMAIL ##
        $selSmtp = "SELECT * FROM hospitality_smtp WHERE idsito = ".$idsito." AND Abilitato = 1";  
        $resSmtp = $db_quoto->query($selSmtp);
        if(sizeof($resSmtp)>0){
            $recSmtp = $resSmtp[0];
            $isSMTP = 1; 
        }else{ 	
            $isSMTP = 0;
        }
        $SmtpAuth     = $recSmtp['SMTPAuth'];
        $SmtpHost     = $recSmtp['SMTPHost'];
        $SmtpPort     = $recSmtp['SMTPPort'];
        $SmtpSecure   = $recSmtp['SMTPSecure'];
        $SmtpUsername = $recSmtp['SMTPUsername'];
        $SmtpPassword = $recSmtp['SMTPPassword'];
        $NumberSend   = $recSmtp['NumberSend'];	
        ## FINE SMTP ##

        $sql = "SELECT siti.*,anagrafica.rag_soc
            FROM siti
            INNER JOIN utenti ON utenti.idsito = siti.idsito
            INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra
            WHERE siti.idsito = " . $idsito . "
            AND utenti.blocco_accesso = 0
            AND siti.hospitality = 1
            AND siti.data_start_hospitality <= '" . date('Y-m-d') . "'
            AND siti.data_end_hospitality > '" . date('Y-m-d') . "'";
        $record   = $db_quoto->query($sql);
        $ret      = $record[0];
        $permessi = $db_quoto->count;

    if ($permessi > 0) {

            $idsito   = $ret['idsito'];
            $sito_tmp = str_replace("http://","",$ret['web']);
            if($ret['https']==1){
                $http = 'https://';
            }else{
                $http = 'http://';
            }
            $SitoWeb   = $http.$sito_tmp;
            $SitoHotel = $SitoWeb;
            $chiave_sito_recaptcha    = $ret['chiave_sito_recaptcha_invisible'];
            $chiave_segreta_recaptcha = $ret['chiave_segreta_recaptcha_invisible'];
            $Cliente                  = $ret['rag_soc'];

            switch ($language) {
                case "it":
                    $id_lingua = 1;
                    break;
                case "en":
                    $id_lingua = 2;
                    break;
                case "fr":
                    $id_lingua = 3;
                    break;
                case "de":
                    $id_lingua = 4;
                    break; 
                case "es":
                    $id_lingua = 2;
                    break;
                case "ru":
                    $id_lingua = 2;
                    break;
                case "nl":
                    $id_lingua = 2;
                    break;
                case "pl":
                    $id_lingua = 2;
                    break;
                case "hu":
                    $id_lingua = 2;
                    break;
                case "pt":
                    $id_lingua = 2;
                    break;
                case "ea":
                    $id_lingua = 2;
                    break;
                case "cz":
                    $id_lingua = 2;
                    break;
                case "cn":
                    $id_lingua = 2;
                    break;
                case "br":
                    $id_lingua = 2;
                    break;
                case "jp":
                    $id_lingua = 2;
                    break;                   
                default:
                    $id_lingua = 1;
                    break;
            }



                $idsito           = $_REQUEST['idsito'];
                $urlback          = $_REQUEST['urlback'];
                $iubendapolicy    = $_REQUEST['iubendapolicy'];
                $language         = $_REQUEST['language'];
                $res              = $_REQUEST['res'];

                $Ip               = $_REQUEST['REMOTE_ADDR'];
                $Agent            = $_REQUEST['HTTP_USER_AGENT'];


                $s = "SELECT siti.*,
                            anagrafica.rag_soc,
                            anagrafica.p_iva,
                            utenti.logo,
                            utenti.idutente,
                            comuni.nome_comune,
                            province.nome_provincia,
                            province.sigla_provincia,
                            stati.nome_stato
                FROM siti
                INNER JOIN utenti ON utenti.idsito = siti.idsito
                INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra
                INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                INNER JOIN stati ON stati.id_stato = siti.id_stato
                WHERE siti.idsito = " . $idsito . "
                AND utenti.blocco_accesso = 0
                AND siti.hospitality = 1
                AND siti.data_start_hospitality <= '" . date('Y-m-d') . "'
                AND siti.data_end_hospitality > '" . date('Y-m-d') . "'";
                $rec = $db_quoto->query($s);
                $r   = $rec[0];

                $EmailHotel        = $r['email'];
                $email_alternativa = $r['email_alternativa_form_quoto'];
                $Hotel             = $r['nome'];
                $sito_tmp          = str_replace("http://","",$r['web']);
                $sito_tmp          = str_replace("https://","",$sito_tmp);
                if($r['https']==1){
                    $http = 'https://';
                }else{
                    $http = 'http://';
                }
                $SitoWeb   = $http.$sito_tmp;
                $SitoHotel = $SitoWeb;

                $riferimenti_hotel .= '<strong>'.$Hotel.'</strong><br />';
                $riferimenti_hotel .= $r['indirizzo'].' '.$r['cap'].' '.$r['nome_comune'].' ('.$r['sigla_provincia'].'), '.$r['nome_stato'].' - Tel:+39 '.$r['tel'].''.($r['fax']!=''?' | Fax: +39 '.$r['fax']:'').'<br />';
                $riferimenti_hotel .= 'Web: <a href="'.$SitoHotel.'">'.$r['web'].'</a> | Email: <a href="mailto:'.$EmailHotel.'">'.$EmailHotel.'</a>';

                $idsito                   = $r['idsito'];
                $chiave_sito_recaptcha    = $ret['chiave_sito_recaptcha_invisible'];
                $chiave_segreta_recaptcha = $ret['chiave_segreta_recaptcha_invisible'];
                $idutente                 = $r['idutente'];
                $logo                     = $r['logo'];

                $nome                     = ucfirst($_REQUEST['nome']);
                $cognome                  = ucfirst($_REQUEST['cognome']);
                $email                    = clean_email($_REQUEST['email']);
                $telefono                 = $_REQUEST['telefono'];

                $dataA                    = explode("-",$_REQUEST['data_arrivo']);
                $arrivo                   = $dataA[2].'-'.$dataA[1].'-'.$dataA[0];

                $dataP                    = explode("-",$_REQUEST['data_partenza']);
                $partenza                 = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
                
                if($_REQUEST['DataArrivo']!=''){
                    $dataAa                   = explode("-",$_REQUEST['DataArrivo']);
                    $DataArrivo               = $dataAa[2].'-'.$dataAa[1].'-'.$dataAa[0];
                }

                if($_REQUEST['DataPartenza']!=''){
                    $dataPa                   = explode("-",$_REQUEST['DataPartenza']);
                    $DataPartenza             = $dataPa[2].'-'.$dataPa[1].'-'.$dataPa[0];                
                }

                $TipoCamere               = $_REQUEST['TipoCamere'];


                $adulti                                     = $_REQUEST['adulti'];
                $bambini                                    = $_REQUEST['bambini'];   

                $messaggio                                  = $_REQUEST['messaggio'];
                $hotel                                      = $_REQUEST['hotel'];
                $codice_sconto                              = $_REQUEST['codice_sconto'];
                $animali_ammessi_tmp                        = $_REQUEST['animali_ammessi'];
                if($animali_ammessi_tmp == 1){
                    $animali_ammessi = 'Si'; 
                }elseif($animali_ammessi_tmp == 0){
                    $animali_ammessi = 'No'; 
                }


                /**
                 * !DIZIONARIO FORM
                 */
                switch ($language) {
                    case "it":
                        $language = 'it';
                        $etichettaPulsanteRispondi = 'Clicca qui per rispondere a: ';
                        $etichettaFraseBottom = 'Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!';
                        break;
                    case "en":
                        $language = 'en';
                        $etichettaPulsanteRispondi = 'Click here to answer: ';
                        $etichettaFraseBottom = 'This email was sent automatically, do not reply to this email!';
                        break;
                    case "fr":
                        $language = 'fr';
                        $etichettaPulsanteRispondi = 'Cliquez ici pour répondre : ';
                        $etichettaFraseBottom = 'Cet e-mail a été envoyé automatiquement, ne répondez pas à cet e-mail!';
                        break;
                    case "de":
                        $language = 'de';
                        $etichettaPulsanteRispondi = 'Klicken Sie hier, um zu antworten: ';
                        $etichettaFraseBottom = 'Diese E-Mail wurde automatisch versendet, antworten Sie nicht auf diese E-Mail!';
                        break; 
                    case "es":                       
                    case "ru":
                    case "nl":
                    case "pl":
                    case "hu":
                    case "pt":
                    case "ea":
                    case "cz":
                    case "cn":
                    case "br":
                    case "jp":
                        $language = 'en'; 
                        $etichettaPulsanteRispondi = 'Click here to answer: ';
                        $etichettaFraseBottom = 'This email was sent automatically, do not reply to this email!';  
                        break;           
                    default:
                        $language = 'it';
                        $etichettaPulsanteRispondi = 'Clicca qui per rispondere a: ';
                        $etichettaFraseBottom = 'Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!';
                        break;
                }
                
                 $select = "SELECT dizionario_form_quoto.etichetta,dizionario_form_quoto_lingue.testo FROM dizionario_form_quoto
                 INNER JOIN dizionario_form_quoto_lingue ON dizionario_form_quoto_lingue.id_dizionario = dizionario_form_quoto.id
                 WHERE dizionario_form_quoto_lingue.Lingua = '".$language."'
                 AND dizionario_form_quoto.etichetta LIKE '%RESPONSE_FORM%'
                 AND dizionario_form_quoto_lingue.idsito = ".$idsito;
                $res = $db_quoto->query($select);
                foreach($res as $key => $value){
                    define($value['etichetta'],$value['testo']);

                }
                

                $responseform['nome'][$language]                 = RESPONSE_FORM_NOME;
                $responseform['cognome'][$language]              = RESPONSE_FORM_COGNOME;
                $responseform['email'][$language]                = RESPONSE_FORM_EMAIL;
                $responseform['telefono'][$language]             = RESPONSE_FORM_TELEFONO;
            
                $responseform['arrivo'][$language]               = RESPONSE_FORM_ARRIVO;
                $responseform['partenza'][$language]             = RESPONSE_FORM_PARTENZA;
            
                $responseform['arrivo_alternativo'][$language]   = RESPONSE_FORM_ARRIVO_ALTERNATIVO;
                $responseform['partenza_alternativo'][$language] = RESPONSE_FORM_PARTENZA_ALTERNATIVO;
                $responseform['adulti_totale'][$language]        = RESPONSE_FORM_TOTALE_ADULTI;
                $responseform['bambini_totale'][$language]       = RESPONSE_FORM_TOTALE_BAMBINI;
            
                $responseform['adulti'][$language]               = RESPONSE_FORM_ADULTI;
                $responseform['bambini'][$language]              = RESPONSE_FORM_BAMBINI;
                $responseform['bambini_eta'][$language]          = RESPONSE_FORM_BAMBINI_ETA;
            
                $responseform['sistemazione'][$language]         = RESPONSE_FORM_SISTEMAZIONE;
                $responseform['trattamento'][$language]          = RESPONSE_FORM_TRATTAMENTO;
                $responseform['target'][$language]               = RESPONSE_FORM_TARGET;
            
                $responseform['messaggio'][$language]            = RESPONSE_FORM_MESSAGGIO;
                $responseform['codice_sconto'][$language]        = RESPONSE_FORM_CODICE_SCONTO;
                $responseform['animali'][$language]              = RESPONSE_FORM_ANIMALI_AMMESSI;
                $responseform['h1'][$language]                   = RESPONSE_FORM_H1;
                $responsoform_oggetto                            = str_replace('[sito]',$SitoHotel,RESPONSE_FORM_OGGETTO);
                $responsoform_oggetto                            = str_replace('[nome]',$nome.' '.$cognome,$responsoform_oggetto);
                $responseform_oggetto                            = $responsoform_oggetto;
                $responseform['successo'][$language]             = RESPONSE_FORM_SUCCESSO;

                function verifyCaptcha($response, $remoteip, $chiave_segreta_recaptcha)
                {
        
                    $url = "https://www.google.com/recaptcha/api/siteverify";
                    $url .= "?secret=" . urlencode(stripslashes($chiave_segreta_recaptcha));
                    $url .= "&response=" . urlencode(stripslashes($response));
                    $url .= "&remoteip=" . urlencode(stripslashes($remoteip));
        
                    $response = file_get_contents($url);
                    $response = json_decode($response, true);
        
                    return (object) $response;
                }

                $BaseUrl = BASE_URL_SITO;

                $msg .= top_email($Hotel,$BaseUrl);

                $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                            <tr>
                                <td valign="top">
                                    <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$EmailHotel.'">'.$etichettaPulsanteRispondi.' '.$Hotel.'</a></div>
                                </td>
                            </tr>
                        </table>';

                $msg .= '
                                    <img src="'.$BaseUrl.'uploads/loghi_siti/' . $logo . '" alt="Logo Struttura">
                                    <h1  class="title">' . $responseform['h1'][$language] . '</h1>
                                        <table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['nome'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $nome . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['cognome'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $cognome . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['email'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $email . '</td>
                                        </tr>';

                if ($telefono != '') {
                    $msg .= '      <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['telefono'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $telefono . '</td>
                                        </tr>';
                }
                $msg .= '      <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $arrivo . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $partenza . '</td>
                                        </tr>';
                if ($DataArrivo != '' || $DataPartenza != '') {
                    $msg .= '      <tr>
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo_alternativo'][$language] . '</b></td>
                                        <td align="left" valign="top" style="width:70%">' . $DataArrivo . '</td>
                                        </tr>
                                        <tr>
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza_alternativo'][$language] . '</b></td>
                                        <td align="left" valign="top" style="width:70%">' . $DataPartenza . '</td>
                                        </tr>';
                }
                $msg .= '        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['adulti_totale'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $adulti . '</td>
                                            </tr>';
                if ($bambini != '') {
                    $msg .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['bambini_totale'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $bambini . '</td>
                                            </tr>';
                }
                if(isset($_REQUEST['codice_sconto'])){
                    if ($codice_sconto != '') {
                        $msg .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['codice_sconto'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $codice_sconto . '</td>
                                            </tr>';
                    }
                }
                if ($TipoVacanza != '') {
                    $msg .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $TipoVacanza. '</td>
                                              </tr>';
                }
                if(isset($_REQUEST['animali_ammessi'])){
                    if ($animali_ammessi_tmp != '') {
                        $msg .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['animali'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $animali_ammessi. '</td>
                                                </tr>';
                    }
                }
                if(isset($_REQUEST['TipoCamere'])){
                    if ($TipoCamere != '') {
                        $msg .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $_REQUEST['TipoCamere'] . '</td>
                                                </tr>';
                    }
                }
                $msg .= ' </table>';

                if(isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''){
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_1'] . '</td>
                                    ';
                        }

                        if(isset($_REQUEST['NumAdulti_1'])){
                            if ($_REQUEST['NumAdulti_1']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti_1']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini_1'])){
                            if ($_REQUEST['NumBambini_1']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini_1']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_1'])){
                            if ($_REQUEST['EtaB1_1']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_1'] . ''.(isset($_REQUEST['EtaB2_1']) && $_REQUEST['EtaB2_1'] != ''?', '.$_REQUEST['EtaB2_1']:'').''.(isset($_REQUEST['EtaB3_1']) && $_REQUEST['EtaB3_1'] != ''?', '.$_REQUEST['EtaB3_1']:'').''.(isset($_REQUEST['EtaB4_1']) && $_REQUEST['EtaB4_1'] != ''?', '.$_REQUEST['EtaB4_1']:'').''.(isset($_REQUEST['EtaB5_1']) && $_REQUEST['EtaB5_1'] != ''?', '.$_REQUEST['EtaB5_1']:'').''.(isset($_REQUEST['EtaB6_1']) && $_REQUEST['EtaB6_1'] != ''?', '.$_REQUEST['EtaB6_1']:'').'</td>
                                ';
                            }
                        }
                        $msg .= ' </tr>';
                   
                    $msg .= '   </table>';
                }



                if(isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''){
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_2'] . '</td>
                                    ';
                        }

                        if(isset($_REQUEST['NumAdulti_2'])){
                            if ($_REQUEST['NumAdulti_2']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti_2']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini_2'])){
                            if ($_REQUEST['NumBambini_2']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini_2']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_2'])){
                            if ($_REQUEST['EtaB1_2']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_2'] . ''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != ''?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != ''?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB4_2']) && $_REQUEST['EtaB4_2'] != ''?', '.$_REQUEST['EtaB4_2']:'').''.(isset($_REQUEST['EtaB5_2']) && $_REQUEST['EtaB5_2'] != ''?', '.$_REQUEST['EtaB5_2']:'').''.(isset($_REQUEST['EtaB6_2']) && $_REQUEST['EtaB6_2'] != ''?', '.$_REQUEST['EtaB6_2']:'').'</td>
                                ';
                            }
                        }
                        $msg .= ' </tr>';
                   
                    $msg .= '   </table>';
                }

 

                if(isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''){
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_3'] . '</td>
                                    ';
                        }

                        if(isset($_REQUEST['NumAdulti_3'])){
                            if ($_REQUEST['NumAdulti_3']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti_3']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini_3'])){
                            if ($_REQUEST['NumBambini_3']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini_3']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_3'])){
                            if ($_REQUEST['EtaB1_3']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_3'] . ''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != ''?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != ''?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB4_3']) && $_REQUEST['EtaB4_3'] != ''?', '.$_REQUEST['EtaB4_3']:'').''.(isset($_REQUEST['EtaB5_3']) && $_REQUEST['EtaB5_3'] != ''?', '.$_REQUEST['EtaB5_3']:'').''.(isset($_REQUEST['EtaB6_3']) && $_REQUEST['EtaB6_3'] != ''?', '.$_REQUEST['EtaB6_3']:'').'</td>
                                ';
                            }
                        }
                        $msg .= ' </tr>';
                   
                    $msg .= '   </table>';
                }   

                if ($messaggio != '') {
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['messaggio'][$language] . '</b></td>
                                    <td align="left" valign="top" style="width:70%">' . wordwrap($messaggio, 120, "<br />\n",true) . '</td>
                                </tr>
                            </table>';
                }
                $msg .= '  <table  cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
                                        '.$riferimenti_hotel.'
                                    </td>
                                </tr>
                            </table>';

                $msg .= footer_email();

                $msg .= '<table cellpadding="0" cellspacing="0" width="850px" border="0" align="center">
                                <tr>
                                    <td valign="top">
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>'.$etichettaFraseBottom.'</em></p>
                                    </td>
                                </tr>
                            </table>';

                $msg_hotel .= top_email($Hotel,$BaseUrl);

                $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td valign="top">
                                        <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$email.'">'.$etichettaPulsanteRispondi.' '.$nome.' '.$cognome.'</a></div>
                                    </td>
                                </tr>
                            </table>';

                $msg_hotel .= '
                                    <img src="'.$BaseUrl.'uploads/loghi_siti/' . $logo . '">
                                    <h1  class="title">' . $responseform['h1'][$language] . '</h1>
                                        <table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['nome'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $nome . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['cognome'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $cognome . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['email'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $email . '</td>
                                        </tr>';

                if ($telefono != '') {
                    $msg_hotel .= '      <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['telefono'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $telefono . '</td>
                                        </tr>';
                }
                $msg_hotel .= '      <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $arrivo . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $partenza . '</td>
                                        </tr>';
                if ($DataArrivo != '' || $DataPartenza != '') {
                    $msg_hotel .= '      <tr>
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo_alternativo'][$language] . '</b></td>
                                        <td align="left" valign="top" style="width:70%">' . $DataArrivo . '</td>
                                        </tr>
                                        <tr>
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza_alternativo'][$language] . '</b></td>
                                        <td align="left" valign="top" style="width:70%">' . $DataPartenza . '</td>
                                        </tr>';
                }
                $msg_hotel .= '        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['adulti_totale'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $adulti . '</td>
                                            </tr>';
                if ($bambini != '') {
                    $msg_hotel .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['bambini_totale'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $bambini . '</td>
                                            </tr>';
                }
                if(isset($_REQUEST['codice_sconto'])){
                    if ($codice_sconto != '') {
                        $msg_hotel .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['codice_sconto'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $codice_sconto . '</td>
                                            </tr>';
                    }
                }
                if ($TipoVacanza != '') {
                    $msg_hotel .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $TipoVacanza. '</td>
                                              </tr>';
                }
                if(isset($_REQUEST['animali_ammessi'])){
                    if ($animali_ammessi_tmp != '') {
                        $msg_hotel .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['animali'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $animali_ammessi. '</td>
                                                </tr>';
                    }
                }
                if(isset($_REQUEST['TipoCamere'])){
                    if ($TipoCamere != '') {
                        $msg_hotel .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $_REQUEST['TipoCamere'] . '</td>
                                                </tr>';
                    }
                }
                $msg_hotel .= ' </table>';

                if(isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg_hotel .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''){
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_1'] . '</td>
                                    ';
                        }

                        if(isset($_REQUEST['NumAdulti_1'])){
                            if ($_REQUEST['NumAdulti_1']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti_1']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini_1'])){
                            if ($_REQUEST['NumBambini_1']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini_1']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_1'])){
                            if ($_REQUEST['EtaB1_1']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_1'] . ''.(isset($_REQUEST['EtaB2_1']) && $_REQUEST['EtaB2_1'] != ''?', '.$_REQUEST['EtaB2_1']:'').''.(isset($_REQUEST['EtaB3_1']) && $_REQUEST['EtaB3_1'] != ''?', '.$_REQUEST['EtaB3_1']:'').''.(isset($_REQUEST['EtaB4_1']) && $_REQUEST['EtaB4_1'] != ''?', '.$_REQUEST['EtaB4_1']:'').''.(isset($_REQUEST['EtaB5_1']) && $_REQUEST['EtaB5_1'] != ''?', '.$_REQUEST['EtaB5_1']:'').''.(isset($_REQUEST['EtaB6_1']) && $_REQUEST['EtaB6_1'] != ''?', '.$_REQUEST['EtaB6_1']:'').'</td>
                                        ';
                            }
                        }
                        $msg_hotel .= ' </tr>';
                   
                    $msg_hotel .= '   </table>';
                }



                if(isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg_hotel .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''){
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_2'] . '</td>
                                    ';
                        }

                        if(isset($_REQUEST['NumAdulti_2'])){
                            if ($_REQUEST['NumAdulti_2']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti_2']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini_2'])){
                            if ($_REQUEST['NumBambini_2']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini_2']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_2'])){
                            if ($_REQUEST['EtaB1_2']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_2'] . ''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != ''?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != ''?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB4_2']) && $_REQUEST['EtaB4_2'] != ''?', '.$_REQUEST['EtaB4_2']:'').''.(isset($_REQUEST['EtaB5_2']) && $_REQUEST['EtaB5_2'] != ''?', '.$_REQUEST['EtaB5_2']:'').''.(isset($_REQUEST['EtaB6_2']) && $_REQUEST['EtaB6_2'] != ''?', '.$_REQUEST['EtaB6_2']:'').'</td>
                                ';
                            }
                        }
                        $msg_hotel .= ' </tr>';
                   
                    $msg_hotel .= '   </table>';
                }

 

                if(isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg_hotel .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''){
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_3'] . '</td>
                                    ';
                        }

                        if(isset($_REQUEST['NumAdulti_3'])){
                            if ($_REQUEST['NumAdulti_3']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti_3']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini_3'])){
                            if ($_REQUEST['NumBambini_3']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini_3']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_3'])){
                            if ($_REQUEST['EtaB1_3']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_3'] . ''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != ''?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != ''?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB4_3']) && $_REQUEST['EtaB4_3'] != ''?', '.$_REQUEST['EtaB4_3']:'').''.(isset($_REQUEST['EtaB5_3']) && $_REQUEST['EtaB5_3'] != ''?', '.$_REQUEST['EtaB5_3']:'').''.(isset($_REQUEST['EtaB6_3']) && $_REQUEST['EtaB6_3'] != ''?', '.$_REQUEST['EtaB6_3']:'').'</td>
                                ';
                            }
                        }
                        $msg_hotel .= ' </tr>';
                   
                    $msg_hotel .= '   </table>';
                } 

                if ($messaggio != '') {
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['messaggio'][$language] . '</b></td>
                                    <td align="left" valign="top" style="width:70%">' . wordwrap($messaggio, 120, "<br />\n",true) . '</td>
                                </tr>
                            </table>';
                }

                $msg_hotel .= '  <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
                                        '.$riferimenti_hotel.'
                                    </td>
                                </tr>
                            </table>';

                $msg_hotel .= footer_email();
                $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="850px" border="0" align="center">
                                <tr>
                                    <td valign="top">
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>'.$etichettaFraseBottom.'</em></p>
                                    </td>
                                </tr>
                            </table>';
// SE IL CAPTCHA E' ABILITATO
        if($_REQUEST['captcha'] == 1){
            /** controllo captcha se attivo */

                    if (isset($_POST['g-recaptcha-response'])) {

                        $secret_key = $chiave_segreta_recaptcha;
                        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response'];

                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_HEADER, false);
                        $data = curl_exec($curl);
                        curl_close($curl);

                        $responseCaptchaData = json_decode($data);
            
                        if ($responseCaptchaData->success) {

                                if ($nome != '' && $cognome != '' && $email != '' && $urlback != '' && $language != '' && $adulti != '' && $arrivo != '' && $partenza != '') {

                                if($isSMTP == 1){
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

                                    $mail_hotel->IsSMTP(); 
                                    $mail_hotel->SMTPDebug = 0; 
                                    $mail_hotel->Debugoutput = 'html';
                                    $mail_hotel->SMTPAuth = $SmtpAuth; 
                                    if($SmtpSecure!=''){
                                        $mail_hotel->SMTPSecure = $SmtpSecure; 
                                    }
                                    $mail_hotel->SMTPKeepAlive = true; 					
                                    $mail_hotel->Host = $SmtpHost;
                                    $mail_hotel->Port = $SmtpPort;
                                    $mail_hotel->Username = $SmtpUsername;
                                    $mail_hotel->Password = $SmtpPassword;
                                } 
                                    $mail->setFrom(MAIL_SEND, $Hotel);
                                    $mail->addAddress($email, $nome.' '.$cognome);
                                    $mail->isHTML(true);
                                    $mail->Subject = $responsoform_oggetto;
                                    $mail->msgHTML($msg, dirname(__FILE__));
                                    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                                    $mail->send();

                                    $mail_hotel->setFrom(MAIL_SEND, $nome.' '.$cognome);
                                    $mail_hotel->addAddress($EmailHotel, $nome.' '.$cognome);
                                    if($email_alternativa!=''){
                                        $array_alternativa = array();
                                        $array_alternativa = explode(",",$email_alternativa);
                                        foreach ($array_alternativa as $key => $value) {
                                            $mail_hotel->addAddress($value, $nome.' '.$cognome);
                                        }
                                    }
                                    $mail_hotel->isHTML(true);
                                    $mail_hotel->Subject = $responsoform_oggetto;
                                    $mail_hotel->msgHTML($msg_hotel, dirname(__FILE__));
                                    $mail_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                                    $mail_hotel->send();

                                        $data_richiesta = date('Y-m-d');

                                        $id_lingua      =  $_REQUEST['id_lingua'];
                                        $lingua         =  from_id_to_cod($id_lingua);

                                        $numero_prenotazione = NewNumeroPreno($idsito);
                                        $cellulare           = field_clean($_REQUEST['telefono']);

                                        $data_arrivo         = $_REQUEST['data_arrivo'];

                                        $data_partenza       = $_REQUEST['data_partenza'];
                

                                            if(isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''){
                                                $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_1']:'').'  '.(isset($_REQUEST['TipoCamere']) && $_REQUEST['TipoCamere']!= '' ?'  -   Sistemazione: '.$_REQUEST['TipoCamere']:'').' '.(isset($_REQUEST['NumAdulti_1'])?'  -  Nr.Adulti: '.$_REQUEST['NumAdulti_1']:'').' '.(isset($_REQUEST['NumBambini_1']) && $_REQUEST['NumBambini_1']!= '' ?'  -  Nr.Bambini: '.$_REQUEST['NumBambini_1']:'').'  '.(isset($_REQUEST['EtaB1_1']) && $_REQUEST['EtaB1_1'] != '' ?'  -  Età: '.$_REQUEST['EtaB1_1']:'').''.(isset($_REQUEST['EtaB2_1']) && $_REQUEST['EtaB2_1'] != '' ?', '.$_REQUEST['EtaB2_1']:'').''.(isset($_REQUEST['EtaB3_1']) && $_REQUEST['EtaB3_1'] != '' ?', '.$_REQUEST['EtaB3_1']:'').''.(isset($_REQUEST['EtaB4_1']) && $_REQUEST['EtaB4_1'] != '' ?', '.$_REQUEST['EtaB4_1']:'').''.(isset($_REQUEST['EtaB5_1']) && $_REQUEST['EtaB5_1'] != '' ?', '.$_REQUEST['EtaB5_1']:'').''.(isset($_REQUEST['EtaB6_1']) && $_REQUEST['EtaB6_1'] != '' ?', '.$_REQUEST['EtaB6_1']:'')."\r\n";
                                            }
                                            if(isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''){
                                                $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_2']:'').'  '.(isset($_REQUEST['TipoCamere']) && $_REQUEST['TipoCamere']!= '' ?'  -   Sistemazione: '.$_REQUEST['TipoCamere']:'').' '.(isset($_REQUEST['NumAdulti_2'])?'  -  Nr.Adulti: '.$_REQUEST['NumAdulti_2']:'').' '.(isset($_REQUEST['NumBambini_2']) && $_REQUEST['NumBambini_2']!= '' ?'  -  Nr.Bambini: '.$_REQUEST['NumBambini_2']:'').'  '.(isset($_REQUEST['EtaB1_2']) && $_REQUEST['EtaB1_2'] != '' ?'  -  Età: '.$_REQUEST['EtaB1_2']:'').''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != '' ?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != '' ?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB4_2']) && $_REQUEST['EtaB4_2'] != '' ?', '.$_REQUEST['EtaB4_2']:'').''.(isset($_REQUEST['EtaB5_2']) && $_REQUEST['EtaB5_2'] != '' ?', '.$_REQUEST['EtaB5_2']:'').''.(isset($_REQUEST['EtaB6_2']) && $_REQUEST['EtaB6_2'] != '' ?', '.$_REQUEST['EtaB6_2']:'')."\r\n";
                                            }
                                            if(isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''){
                                                $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_3']:'').'  '.(isset($_REQUEST['TipoCamere']) && $_REQUEST['TipoCamere']!= '' ?'  -   Sistemazione: '.$_REQUEST['TipoCamere']:'').' '.(isset($_REQUEST['NumAdulti_3'])?'  -  Nr.Adulti: '.$_REQUEST['NumAdulti_3']:'').' '.(isset($_REQUEST['NumBambini_3']) && $_REQUEST['NumBambini_3']!= '' ?'  -  Nr.Bambini: '.$_REQUEST['NumBambini_3']:'').' '.(isset($_REQUEST['EtaB1_3']) && $_REQUEST['EtaB1_3'] != '' ?'  -  Età: '.$_REQUEST['EtaB1_3']:'').''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != '' ?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != '' ?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB4_3']) && $_REQUEST['EtaB4_3'] != '' ?', '.$_REQUEST['EtaB4_3']:'').''.(isset($_REQUEST['EtaB5_2']) && $_REQUEST['EtaB5_3'] != '' ?', '.$_REQUEST['EtaB5_3']:'').''.(isset($_REQUEST['EtaB6_3']) && $_REQUEST['EtaB6_3'] != '' ?', '.$_REQUEST['EtaB6_3']:'')."\r\n";
                                            }
                                            $note           =  (($hotel!='' || $hotel!='--')?addslashes($hotel)."\r\n":'');
                                            $note           =  (isset($_REQUEST['animali_ammessi']) && $animali_ammessi_tmp!=''?'Viaggiamo con animali domestici: '.$animali_ammessi."\r\n":'');
                                            $note          .=  (($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$DataArrivo.' Data Partenza Alternativa: '.$DataPartenza."\r\n":'');
                                            $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                                            $note          .=  ($_REQUEST['messaggio']!=''?"\r\n".'Note: '.$_REQUEST['messaggio']:'');
                                            
                                            $ConsensoMarketing    = ($_REQUEST['marketing']!=''?1:0);
                                            $ConsensoProfilazione = ($_REQUEST['profilazione']!=''?1:0);
                                            $ConsensoPrivacy      = ($_REQUEST['consenso']!=''?1:0);


                                        $data      =  array(   'idsito'                     => $idsito,
                                                                'id_politiche'              => 0,
                                                                'MultiStruttura'            => addslashes($hotel),
                                                                'Nome'                      => addslashes($nome),
                                                                'Cognome'                   => addslashes($cognome),
                                                                'EmailSegretaria'           => $email_hotel,
                                                                'Cellulare'                 => $telefono,
                                                                'Email'                     => $email,
                                                                'NumeroPrenotazione'        => $numero_prenotazione,
                                                                'DataArrivo'                => $data_arrivo,
                                                                'DataPartenza'              => $data_partenza,
                                                                'FontePrenotazione'         => "Sito Web",
                                                                'Note'                      => addslashes($note),
                                                                'TipoRichiesta'             => 'Preventivo',
                                                                'TipoVacanza'               => $TipoVacanza,
                                                                'Lingua'                    => $lingua,
                                                                'NumeroAdulti'              => $adulti,
                                                                'NumeroBambini'             => $bambini,
                                                                'DataRichiesta'             => $data_richiesta,
                                                                'CheckConsensoPrivacy'      => $ConsensoPrivacy,
                                                                'CheckConsensoMarketing'    => $ConsensoMarketing,
                                                                'CheckConsensoProfilazione' => $ConsensoProfilazione,
                                                                'Ip'                        => $Ip,
                                                                'Agent'                     => $Agent,
                                                                'CodiceSconto'              => addslashes($codice_sconto));
                                        $db_quoto->insert('hospitality_guest', $data);

                                            // SALVO IL CLIENT ID DI ANALYTICS IN TABELLA RELAZIONALE DI QUOTO
                                            $insertclientId = "INSERT INTO hospitality_client_id(idsito,NumeroPrenotazione,CLIENT_ID) VALUES('".$idsito."','".$numero_prenotazione."','".$_REQUEST['CLIENT_ID']."')";
                                            $db_quoto->query($insertclientId);

                                        $Tracking = urldecode($_REQUEST['tracking']);
                                        if($Tracking){
                                            if((strstr($Tracking,'facebook')) && (strstr($Tracking,'utm_campaign'))){
                                                $array_traccia = explode('utm_campaign=',$Tracking);
                                                $track_tmp     = explode('&fbclid', $array_traccia[1]);
                                                $track         = 'facebook';
                                                $campagna      = $track_tmp[0];
                                                $daDove        = '';    
                                            }elseif((strstr($Tracking,'campagna')) && (strstr($Tracking,'gclid'))){
                                                $array_traccia = explode('campagna=',$Tracking);
                                                $track_tmp     = explode('&gclid', $array_traccia[1]);
                                                $track         = 'google';
                                                $campagna      = $track_tmp[0]; 
                                                $daDove        = ''; 
                                            }elseif((strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign'))){
                                                $track         = 'facebook';
                                                $campagna      = '';  
                                                $daDove        = '';  
                                            }elseif((strstr($Tracking,'gclid')) && (!strstr($Tracking,'facebook')) && (!strstr($Tracking,'campagna'))){
                                                $track         = 'google';
                                                $campagna      = '';
                                                $daDove        = '';     
                                            }elseif((!strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign')) && (!strstr($Tracking,'campagna')) && (!strstr($Tracking,'gclid'))){
                                                $track         = '';
                                                $campagna      = ''; 
                                                $daDove        =  $Tracking;                                    
                                            }

                                            $insert_tracking = "INSERT INTO hospitality_tracking_ads
                                                                            (idsito,
                                                                            NumeroPrenotazione,
                                                                            Url,
                                                                            Tracking,
                                                                            Campagna)
                                                                        VALUES
                                                                            ('".$idsito."',
                                                                            '".$numero_prenotazione."',
                                                                            '".addslashes($daDove)."',
                                                                            '".addslashes($track)."',
                                                                            '".addslashes($campagna)."')";
                                            $db_quoto->query($insert_tracking);
                                        }
                                        /**
                                        *? NUOVO CODICE PER LA TRACCIABILITA'
                                        ** Data 29 Agosto 2023
                                        */
                                        $_REQUEST['utm_campaign'] = str_replace("%20"," ",$_REQUEST['utm_campaign']);
                                        $_REQUEST['utm_campaign'] = str_replace("%7C","|",$_REQUEST['utm_campaign']);
                                        $_REQUEST['utm_campaign'] = str_replace("+"," ",$_REQUEST['utm_campaign']);

                                        $utm_insert = "INSERT INTO hospitality_utm_ads
                                                                ( idsito
                                                                , NumeroPrenotazione
                                                                , referrer
                                                                , utm_source
                                                                , utm_medium
                                                                , utm_campaign
                                                                , data_operazione
                                                                )
                                                            VALUES
                                                                ( '".$idsito."'
                                                                , '".$numero_prenotazione."'
                                                                , '".addslashes($_REQUEST['HTTP_REFERRER'])."'
                                                                , '".addslashes($_REQUEST['utm_source'])."'
                                                                , '".addslashes($_REQUEST['utm_medium'])."'
                                                                , '".addslashes($_REQUEST['utm_campaign'])."'
                                                                , '".date('Y-m-d H:i:s')."'
                                                                )";
                                        $db_quoto->query($utm_insert);                                            

                                        $syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                                        $db_quoto->query($syncro);

                                        // ritorno alla pagina OK
                                        echo'   <form  action="' . $urlback . '?res=sent&'.base64_encode('NumeroPrenotazione').'='.base64_encode($numero_prenotazione).'" name="form_response_q" id="form_response_q"  method="post">
                                                    <input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
                                                    <input type="hidden" name="idsito" value="'.$idsito.'"/>
                                                </form>'."\r\n";

                                        echo'   <script language="JavaScript">
                                                    document.form_response_q.submit();
                                                </script>'."\r\n";
                                        

                                    } else {

                                        $message = 'ERRORE: Potrebbero esserci alcune variabili obbligatorie non compilate!';
                                        echo '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
                                    }


                
                            } else {

                                // ritorno alla pagina KO
                                $message = 'Controllo CAPTCHA negativo!';
                                echo '<script language="javascript">alert("' . $message . '");document.location="' . $urlback . '"</script>';

                            }
                }else{
                // ritorno alla pagina KO
                $message = 'Controllo CAPTCHA mancante, senza il form non viene spedito, contattare amminisratore del sito!';
                echo '<script language="javascript">alert("' . $message . '");document.location="' . $urlback . '"</script>';
            }// if recaptcha

        }else{  // SE IL CAPTCHA E' DISABILITATO

            if ($nome != '' && $cognome != '' && $email != '' && $urlback != '' && $language != '' && $adulti != '' && $arrivo != '' && $partenza != '') {
                
                if($isSMTP == 1){
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

                    $mail_hotel->IsSMTP(); 
                    $mail_hotel->SMTPDebug = 0; 
                    $mail_hotel->Debugoutput = 'html';
                    $mail_hotel->SMTPAuth = $SmtpAuth; 
                    if($SmtpSecure!=''){
                        $mail_hotel->SMTPSecure = $SmtpSecure; 
                    }
                    $mail_hotel->SMTPKeepAlive = true; 					
                    $mail_hotel->Host = $SmtpHost;
                    $mail_hotel->Port = $SmtpPort;
                    $mail_hotel->Username = $SmtpUsername;
                    $mail_hotel->Password = $SmtpPassword;
                } 
                $mail->setFrom(MAIL_SEND, $Hotel);
                $mail->addAddress($email, $nome.' '.$cognome);
                $mail->isHTML(true);
                $mail->Subject = $responsoform_oggetto;
                $mail->msgHTML($msg, dirname(__FILE__));
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->send();

                $mail_hotel->setFrom(MAIL_SEND, $nome.' '.$cognome);
                $mail_hotel->addAddress($EmailHotel, $nome.' '.$cognome);
                if($email_alternativa!=''){
                    $array_alternativa = array();
                    $array_alternativa = explode(",",$email_alternativa);
                    foreach ($array_alternativa as $key => $value) {
                        $mail_hotel->addAddress($value, $nome.' '.$cognome);
                    }
                }
                $mail_hotel->isHTML(true);
                $mail_hotel->Subject = $responsoform_oggetto;
                $mail_hotel->msgHTML($msg_hotel, dirname(__FILE__));
                $mail_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail_hotel->send();

                    $data_richiesta = date('Y-m-d');

                    $id_lingua      =  $_REQUEST['id_lingua'];
                    $lingua         =  from_id_to_cod($id_lingua);

                    $numero_prenotazione = NewNumeroPreno($idsito);
                    $cellulare           = field_clean($_REQUEST['telefono']);

                    $data_arrivo         = $_REQUEST['data_arrivo'];

                    $data_partenza       = $_REQUEST['data_partenza'];


                        if(isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''){
                            $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno_1']) && $_REQUEST['TipoSoggiorno_1'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_1']:'').'  '.(isset($_REQUEST['TipoCamere']) && $_REQUEST['TipoCamere']!= '' ?'  -   Sistemazione: '.$_REQUEST['TipoCamere']:'').' '.(isset($_REQUEST['NumAdulti_1'])?'  -  Nr.Adulti: '.$_REQUEST['NumAdulti_1']:'').' '.(isset($_REQUEST['NumBambini_1']) && $_REQUEST['NumBambini_1']!= '' ?'  -  Nr.Bambini: '.$_REQUEST['NumBambini_1']:'').'  '.(isset($_REQUEST['EtaB1_1']) && $_REQUEST['EtaB1_1'] != '' ?'  -  Età: '.$_REQUEST['EtaB1_1']:'').''.(isset($_REQUEST['EtaB2_1']) && $_REQUEST['EtaB2_1'] != '' ?', '.$_REQUEST['EtaB2_1']:'').''.(isset($_REQUEST['EtaB3_1']) && $_REQUEST['EtaB3_1'] != '' ?', '.$_REQUEST['EtaB3_1']:'').''.(isset($_REQUEST['EtaB4_1']) && $_REQUEST['EtaB4_1'] != '' ?', '.$_REQUEST['EtaB4_1']:'').''.(isset($_REQUEST['EtaB5_1']) && $_REQUEST['EtaB5_1'] != '' ?', '.$_REQUEST['EtaB5_1']:'').''.(isset($_REQUEST['EtaB6_1']) && $_REQUEST['EtaB6_1'] != '' ?', '.$_REQUEST['EtaB6_1']:'')."\r\n";
                        }
                        if(isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''){
                            $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno_2']) && $_REQUEST['TipoSoggiorno_2'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_2']:'').'  '.(isset($_REQUEST['TipoCamere']) && $_REQUEST['TipoCamere']!= '' ?'  -   Sistemazione: '.$_REQUEST['TipoCamere']:'').' '.(isset($_REQUEST['NumAdulti_2'])?'  -  Nr.Adulti: '.$_REQUEST['NumAdulti_2']:'').' '.(isset($_REQUEST['NumBambini_2']) && $_REQUEST['NumBambini_2']!= '' ?'  -  Nr.Bambini: '.$_REQUEST['NumBambini_2']:'').'  '.(isset($_REQUEST['EtaB1_2']) && $_REQUEST['EtaB1_2'] != '' ?'  -  Età: '.$_REQUEST['EtaB1_2']:'').''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != '' ?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != '' ?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB4_2']) && $_REQUEST['EtaB4_2'] != '' ?', '.$_REQUEST['EtaB4_2']:'').''.(isset($_REQUEST['EtaB5_2']) && $_REQUEST['EtaB5_2'] != '' ?', '.$_REQUEST['EtaB5_2']:'').''.(isset($_REQUEST['EtaB6_2']) && $_REQUEST['EtaB6_2'] != '' ?', '.$_REQUEST['EtaB6_2']:'')."\r\n";
                        }
                        if(isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''){
                            $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno_3']) && $_REQUEST['TipoSoggiorno_3'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_3']:'').'  '.(isset($_REQUEST['TipoCamere']) && $_REQUEST['TipoCamere']!= '' ?'  -   Sistemazione: '.$_REQUEST['TipoCamere']:'').' '.(isset($_REQUEST['NumAdulti_3'])?'  -  Nr.Adulti: '.$_REQUEST['NumAdulti_3']:'').' '.(isset($_REQUEST['NumBambini_3']) && $_REQUEST['NumBambini_3']!= '' ?'  -  Nr.Bambini: '.$_REQUEST['NumBambini_3']:'').' '.(isset($_REQUEST['EtaB1_3']) && $_REQUEST['EtaB1_3'] != '' ?'  -  Età: '.$_REQUEST['EtaB1_3']:'').''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != '' ?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != '' ?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB4_3']) && $_REQUEST['EtaB4_3'] != '' ?', '.$_REQUEST['EtaB4_3']:'').''.(isset($_REQUEST['EtaB5_2']) && $_REQUEST['EtaB5_3'] != '' ?', '.$_REQUEST['EtaB5_3']:'').''.(isset($_REQUEST['EtaB6_3']) && $_REQUEST['EtaB6_3'] != '' ?', '.$_REQUEST['EtaB6_3']:'')."\r\n";
                        }
                        $note           =  (($hotel!='' || $hotel!='--')?addslashes($hotel)."\r\n":'');
                        $note           =  (isset($_REQUEST['animali_ammessi']) && $animali_ammessi_tmp!=''?'Viaggiamo con animali domestici: '.$animali_ammessi."\r\n":'');
                        $note          .=  (($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$DataArrivo.' Data Partenza Alternativa: '.$DataPartenza."\r\n":'');
                        $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                        $note          .=  ($_REQUEST['messaggio']!=''?"\r\n".'Note: '.$_REQUEST['messaggio']:'');
                        
                        $ConsensoMarketing    = ($_REQUEST['marketing']!=''?1:0);
                        $ConsensoProfilazione = ($_REQUEST['profilazione']!=''?1:0);
                        $ConsensoPrivacy      = ($_REQUEST['consenso']!=''?1:0);


                    $data      =  array(   'idsito'                     => $idsito,
                                            'id_politiche'              => 0,
                                            'MultiStruttura'            => addslashes($hotel),
                                            'Nome'                      => addslashes($nome),
                                            'Cognome'                   => addslashes($cognome),
                                            'EmailSegretaria'           => $email_hotel,
                                            'Cellulare'                 => $telefono,
                                            'Email'                     => $email,
                                            'NumeroPrenotazione'        => $numero_prenotazione,
                                            'DataArrivo'                => $data_arrivo,
                                            'DataPartenza'              => $data_partenza,
                                            'FontePrenotazione'         => "Sito Web",
                                            'Note'                      => addslashes($note),
                                            'TipoRichiesta'             => 'Preventivo',
                                            'TipoVacanza'               => $TipoVacanza,
                                            'Lingua'                    => $lingua,
                                            'NumeroAdulti'              => $adulti,
                                            'NumeroBambini'             => $bambini,
                                            'DataRichiesta'             => $data_richiesta,
                                            'CheckConsensoPrivacy'      => $ConsensoPrivacy,
                                            'CheckConsensoMarketing'    => $ConsensoMarketing,
                                            'CheckConsensoProfilazione' => $ConsensoProfilazione,
                                            'Ip'                        => $Ip,
                                            'Agent'                     => $Agent,
                                            'CodiceSconto'              => addslashes($codice_sconto));
                    $db_quoto->insert('hospitality_guest', $data);

                        // SALVO IL CLIENT ID DI ANALYTICS IN TABELLA RELAZIONALE DI QUOTO
                        $insertclientId = "INSERT INTO hospitality_client_id(idsito,NumeroPrenotazione,CLIENT_ID) VALUES('".$idsito."','".$numero_prenotazione."','".$_REQUEST['CLIENT_ID']."')";
                        $db_quoto->query($insertclientId);

                    $Tracking = urldecode($_REQUEST['tracking']);
                    if($Tracking){
                        if((strstr($Tracking,'facebook')) && (strstr($Tracking,'utm_campaign'))){
                            $array_traccia = explode('utm_campaign=',$Tracking);
                            $track_tmp     = explode('&fbclid', $array_traccia[1]);
                            $track         = 'facebook';
                            $campagna      = $track_tmp[0];
                            $daDove        = '';    
                        }elseif((strstr($Tracking,'campagna')) && (strstr($Tracking,'gclid'))){
                            $array_traccia = explode('campagna=',$Tracking);
                            $track_tmp     = explode('&gclid', $array_traccia[1]);
                            $track         = 'google';
                            $campagna      = $track_tmp[0]; 
                            $daDove        = ''; 
                        }elseif((strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign'))){
                            $track         = 'facebook';
                            $campagna      = '';  
                            $daDove        = '';  
                        }elseif((strstr($Tracking,'gclid')) && (!strstr($Tracking,'facebook')) && (!strstr($Tracking,'campagna'))){
                            $track         = 'google';
                            $campagna      = '';
                            $daDove        = '';     
                        }elseif((!strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign')) && (!strstr($Tracking,'campagna')) && (!strstr($Tracking,'gclid'))){
                            $track         = '';
                            $campagna      = ''; 
                            $daDove        =  $Tracking;                                    
                        }

                        $insert_tracking = "INSERT INTO hospitality_tracking_ads
                                                        (idsito,
                                                        NumeroPrenotazione,
                                                        Url,
                                                        Tracking,
                                                        Campagna)
                                                    VALUES
                                                        ('".$idsito."',
                                                        '".$numero_prenotazione."',
                                                        '".addslashes($daDove)."',
                                                        '".addslashes($track)."',
                                                        '".addslashes($campagna)."')";
                        $db_quoto->query($insert_tracking);
                    }
                    /**
                    *? NUOVO CODICE PER LA TRACCIABILITA'
                    ** Data 29 Agosto 2023
                    */
                    $_REQUEST['utm_campaign'] = str_replace("%20"," ",$_REQUEST['utm_campaign']);
                    $_REQUEST['utm_campaign'] = str_replace("%7C","|",$_REQUEST['utm_campaign']);
                    $_REQUEST['utm_campaign'] = str_replace("+"," ",$_REQUEST['utm_campaign']);
                    $utm_insert = "INSERT INTO hospitality_utm_ads
                                        ( idsito
                                        , NumeroPrenotazione
                                        , referrer
                                        , utm_source
                                        , utm_medium
                                        , utm_campaign
                                        , data_operazione
                                        )
                                    VALUES
                                        ( '".$idsito."'
                                        , '".$numero_prenotazione."'
                                        , '".addslashes($_REQUEST['HTTP_REFERRER'])."'
                                        , '".addslashes($_REQUEST['utm_source'])."'
                                        , '".addslashes($_REQUEST['utm_medium'])."'
                                        , '".addslashes($_REQUEST['utm_campaign'])."'
                                        , '".date('Y-m-d H:i:s')."'
                                        )";
                    $db_quoto->query($utm_insert);                      

                    $syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                    $db_quoto->query($syncro);

                    // ritorno alla pagina OK
                    echo'   <form  action="' . $urlback . '?res=sent&'.base64_encode('NumeroPrenotazione').'='.base64_encode($numero_prenotazione).'" name="form_response_q" id="form_response_q"  method="post">
                                <input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
                                <input type="hidden" name="idsito" value="'.$idsito.'"/>
                            </form>'."\r\n";

                    echo'   <script language="JavaScript">
                                document.form_response_q.submit();
                            </script>'."\r\n";
                    

                } else {

                    $message = 'ERRORE: Potrebbero esserci alcune variabili obbligatorie non compilate!';
                    echo '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
                }


        }// FINE CONTROLLO CAPTCHA

        }else{

            echo'<div>
                    Il modulo di richiesta by Quoto! CRM non è più attivo!
                    <br>
                    Per mandare il tuo messaggio alla struttura, scrivi direttamente all\'hotel
                    <br>
                    Se sei il proprietario del sito, contatta Network Service
                    <br>
                    <b>Network Service</b><br>
                    Via Valentini A. e L., 11 47922 Rimini (RN), Italia <br>
                    <b>Tel:</b> +39 0541790062 | <b>Fax:</b> +39 0541778656<br>
                    <b>Email:</b> info@network-service.it
                </div>';
        }

        $db_quoto->disconnect();
}else{
    echo'<div>
            <b>ERRORE</b><br><br>
            Variabile <b>action</b> non instanziata!
        </div>';
    }
