<?
require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
 //error_reporting(0);
 if($_REQUEST['action']=='send') {
        require $_SERVER['DOCUMENT_ROOT'].'/ApiQuoto/PHPMailer/PHPMailerAutoload.php';
        $mail       = new PHPMailer;
        $mail_hotel = new PHPMailer;

        $idsito           = $_REQUEST['idsito'];
        $urlback          = $_REQUEST['urlback'];
        $iubendapolicy    = $_REQUEST['iubendapolicy'];
        $language         = $_REQUEST['language'];
        $eqr              = $_REQUEST['eqr'];
        $check_valid      = $_REQUEST['check_valid'];
        $jqueryframe      = $_REQUEST['jqueryframe'];
        $res              = $_REQUEST['res'];

        $send_timeline    = $_REQUEST['send_timeline'];
        $Ip               = $_SERVER['REMOTE_ADDR'];
        $Agent            = $_SERVER['HTTP_USER_AGENT'];
        $percorso         = $_SERVER['HTTP_REFERER'];



        include_once($_SERVER['DOCUMENT_ROOT'].'/ApiQuoto/function.inc.php');

        require_once $_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php';

        $db_quoto = new MysqliDb(HOST, DB_USER, DB_PASSWORD, DATABASE);



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
            $chiave_sito_recaptcha    = $ret['chiave_sito_recaptcha'];
            $chiave_segreta_recaptcha = $ret['chiave_segreta_recaptcha'];
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
                default:
                    $id_lingua = 1;
                    break;
            }



                $idsito           = $_REQUEST['idsito'];
                $urlback          = $_REQUEST['urlback'];
                $iubendapolicy    = $_REQUEST['iubendapolicy'];
                $language         = $_REQUEST['language'];
                $res              = $_REQUEST['res'];

                $sfondo           = ($_REQUEST['sfondo']   == 'transparent' ? 'transparent': '#' . $_REQUEST['sfondo']);
                $pulsante         = ($_REQUEST['pulsante'] == 'transparent' ? 'transparent': '#' . $_REQUEST['pulsante']);
                $testo            = '#' . $_REQUEST['testo'];
                $bordo            = '#' . $_REQUEST['bordo'];
                $radius           = $_REQUEST['radius'];
                $css_input        = $_REQUEST['css_input'];

                $Ip               = $_REQUEST['REMOTE_ADDR'];
                $Agent            = $_REQUEST['HTTP_USER_AGENT'];
                $percorso         = $_REQUEST['percorso'];
                $send_timeline    = $_REQUEST['send_timeline'];

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
                $riferimenti_hotel .= $r['indirizzo'].' '.$r['cap'].' '.$r['nome_comune'].' ('.$r['sigla_provincia'].'), '.$r['nome_stato'].' - Tel:+39 '.$r['tel'].' | Fax: +39 '.$r['fax'].'<br />';
                $riferimenti_hotel .= 'Web: <a href="'.$SitoHotel.'">'.$r['web'].'</a> | Email: <a href="mailto:'.$EmailHotel.'">'.$EmailHotel.'</a>';

                $idsito                                     = $r['idsito'];
                $chiave_sito_recaptcha                      = $ret['chiave_sito_recaptcha'];
                $chiave_segreta_recaptcha                   = $ret['chiave_segreta_recaptcha'];
                $idutente                                   = $r['idutente'];
                $logo                                       = $r['logo'];

                $nome                                       = ucfirst($_REQUEST['nome']);
                $cognome                                    = ucfirst($_REQUEST['cognome']);
                $email                                      = $_REQUEST['email'];
                $telefono                                   = $_REQUEST['telefono'];

                $arrivo                                     = $_REQUEST['data_arrivo'];
                $partenza                                   = $_REQUEST['data_partenza'];

                $DataArrivo                                 = $_REQUEST['DataArrivo'];
                $DataPartenza                               = $_REQUEST['DataPartenza'];
                
                $TipoVacanza                                = $_REQUEST['TipoVacanza'];

                $adulti                                     = $_REQUEST['adulti'];
                $bambini                                    = $_REQUEST['bambini'];
                $bambini_eta                                = $_REQUEST['bambini_eta'].($_REQUEST['EtaB1_1']!='' || $_REQUEST['EtaB1_1']!=0?' '.$_REQUEST['EtaB1_1']:'').($_REQUEST['EtaB2_1']!='' || $_REQUEST['EtaB2_1']!=0?' '.$_REQUEST['EtaB2_1']:'').($_REQUEST['EtaB3_1']!='' || $_REQUEST['EtaB3_1']!=0?' '.$_REQUEST['EtaB3_1']:'');

                $messaggio                                  = $_REQUEST['messaggio'];
                $hotel                                      = $_REQUEST['hotel'];

                //IT
                $responseform['nome']['it']                 = 'Nome';
                $responseform['cognome']['it']              = 'Cognome';
                $responseform['email']['it']                = 'Email';
                $responseform['telefono']['it']             = 'Telefono';

                $responseform['arrivo']['it']               = 'Data Arrivo';
                $responseform['partenza']['it']             = 'Data Partenza';

                $responseform['arrivo_alternativo']['it']   = 'Arrivo alternativo';
                $responseform['partenza_alternativo']['it'] = 'Partenza alternativa';
                $responseform['adulti_totale']['it']        = 'Totale Adulti';
                $responseform['bambini_totale']['it']       = 'Totale Bambini';

                $responseform['adulti']['it']               = 'Adulti';
                $responseform['bambini']['it']              = 'Bambini';
                $responseform['bambini_eta']['it']          = 'Età';

                $responseform['sistemazione']['it']         = 'Sistemazione';
                $responseform['trattamento']['it']          = 'Trattamento';
                $responseform['target']['it']               = 'Target vacanza';

                $responseform['messaggio']['it']            = 'Messaggio';
                $responseform['h1']['it']                   = 'Richiesta informazioni!';
                $responseform['oggetto']['it']              = 'Richiesta Informazioni per il sito: ' . $SitoHotel . ' da parte di: ' . $nome;
                $responseform['successo']['it']             = 'Richiesta Inviata con Successo!';

                //EN
                $responseform['nome']['en']                 = 'Name';
                $responseform['cognome']['en']              = 'Surname';
                $responseform['email']['en']                = 'Email';
                $responseform['telefono']['en']             = 'Phone';

                $responseform['arrivo']['en']               = 'Arrival date';
                $responseform['partenza']['en']             = 'Departure date';

                $responseform['arrivo_alternativo']['en']   = 'Alternative Arrival';
                $responseform['partenza_alternativo']['en'] = 'Alternative Departure';
                $responseform['adulti_totale']['en']        = 'Total Adults';
                $responseform['bambini_totale']['en']       = 'Total Children';

                $responseform['sistemazione']['en']         = 'Rooms';
                $responseform['trattamento']['en']          = 'Treatment';
                $responseform['target']['en']               = 'Target vacation';

                $responseform['adulti']['en']               = 'Adults';
                $responseform['bambini']['en']              = 'Children';
                $responseform['bambini_eta']['en']          = 'Age';

                $responseform['messaggio']['en']            = 'Message';
                $responseform['h1']['en']                   = 'Information request!';
                $responseform['oggetto']['en']              = 'Request Information for the site: ' . $SitoHotel . ' by: ' . $nome;
                $responseform['successo']['en']             = 'Successfully Received Inquiry!';

                //DE
                $responseform['nome']['de']                 = 'Name';
                $responseform['cognome']['de']              = 'Nachname';
                $responseform['email']['de']                = 'Email';
                $responseform['telefono']['de']             = 'Telefon';

                $responseform['arrivo']['de']               = 'Ankunft';
                $responseform['partenza']['de']             = 'Abreisedatum';

                $responseform['arrivo_alternativo']['de']   = 'Alternative Ankunft';
                $responseform['partenza_alternativo']['de'] = 'Alternative Abreisedatum';
                $responseform['adulti_totale']['de']        = 'Total Erwachsene';
                $responseform['bambini_totale']['de']       = 'Total Kinder';

                $responseform['sistemazione']['de']         = 'Zimmer';
                $responseform['trattamento']['de']          = 'Behandlung';
                $responseform['target']['de']               = 'Zielurlaub';

                $responseform['adulti']['de']               = 'Erwachsene';
                $responseform['bambini']['de']              = 'Kinder';
                $responseform['bambini_eta']['de']          = 'Jahre';

                $responseform['messaggio']['de']            = 'Nachricht';
                $responseform['h1']['de']                   = 'Informationen anfordern!';
                $responseform['oggetto']['de']              = 'Fordern Sie Informationen für die Website an: ' . $SitoHotel . ' Von: ' . $nome;
                $responseform['successo']['de']             = 'Anfrage erfolgreich gesendet!';

                //FR
                $responseform['nome']['fr']                 = 'Nom';
                $responseform['cognome']['fr']              = 'Prenom';
                $responseform['email']['fr']                = 'Email';
                $responseform['telefono']['fr']             = 'Telephone';

                $responseform['arrivo']['fr']               = 'Arrivee';
                $responseform['partenza']['fr']             = 'Départure';

                $responseform['arrivo_alternativo']['fr']   = 'Alternative Arrivee';
                $responseform['partenza_alternativo']['fr'] = 'Alternative Départure';
                $responseform['adulti_totale']['fr']        = 'Total Adultes';
                $responseform['bambini_totale']['fr']       = 'Total Enfants';

                $responseform['sistemazione']['fr']         = 'Chambre';
                $responseform['trattamento']['fr']          = 'Categorie';
                $responseform['target']['fr']               = 'Vacances ciblées';

                $responseform['adulti']['fr']               = 'Adultes';
                $responseform['bambini']['fr']              = 'Enfants';
                $responseform['bambini_eta']['fr']          = 'Age';

                $responseform['messaggio']['fr']            = 'Message';
                $responseform['h1']['fr']                   = 'Demande d\'information!';
                $responseform['oggetto']['fr']              = 'Demande d\'informations pour le site: ' . $SitoHotel . ' par ' . $nome;
                $responseform['successo']['fr']             = 'Demande reçue avec succès!';



                $BaseUrl = BASE_URL_SITO;

                $msg .= top_email($Hotel,$BaseUrl);

                $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                            <tr>
                                <td valign="top">
                                    <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$EmailHotel.'">Clicca qui per rispondere a: '.$Hotel.'</a></div>
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
                if ($TipoVacanza != '') {
                    $msg .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $TipoVacanza. '</td>
                                              </tr>';
                }
                $msg .= ' </table>';

                $n_righe = count($_REQUEST['TipoSoggiorno']);
                $i=1;
                if($n_righe>0){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';

                for($i==1; $i<=($n_righe-1); $i++){
                        $msg .= '    <tr>';
                        if ($_REQUEST['TipoSoggiorno'][$i]!= '') {
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno'][$i] . '</td>
                                    ';
                        }
                        if ($_REQUEST['NumeroCamere'][$i]!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>nr.</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumeroCamere'][$i] . '</td>
                                    ';
                        }
                        if ($_REQUEST['TipoCamere'][$i]!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoCamere'][$i] . '</td>
                                    ';
                        }
                        if ($_REQUEST['NumAdulti'][$i] != '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumAdulti'][$i]. '</td>
                                    ';
                        }
                        if ($_REQUEST['NumBambini'][$i]!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini'][$i]. '</td>
                                    ';
                        }
                        if ($_REQUEST['EtaB1_'.$i] != '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_'.$i] . ''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'').'</td>
                                ';
                        }
                        $msg .= ' </tr>';
                    }
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
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
                                    </td>
                                </tr>
                            </table>';

                $msg_hotel .= top_email($Hotel,$BaseUrl);

                $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td valign="top">
                                        <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$email.'">Clicca qui per rispondere a: '.$nome.' '.$cognome.'</a></div>
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
                    $msg .= '      <tr>
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
                if ($TipoVacanza != '') {
                    $msg_hotel .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $TipoVacanza. '</td>
                                              </tr>';
                }
                $msg_hotel .= ' </table>';

                $n_righe = count($_REQUEST['TipoSoggiorno']);
                $i=1;
                if($n_righe>0){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';

                for($i==1; $i<=($n_righe-1); $i++){
                        $msg_hotel .= '    <tr>';
                        if ($_REQUEST['TipoSoggiorno'][$i]!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno'][$i] . '</td>
                                    ';
                        }
                        if ($_REQUEST['NumeroCamere'][$i]!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>nr.</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumeroCamere'][$i] . '</td>
                                    ';
                        }
                        if ($_REQUEST['TipoCamere'][$i]!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoCamere'][$i] . '</td>
                                    ';
                        }
                        if ($_REQUEST['NumAdulti'][$i] != '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumAdulti'][$i]. '</td>
                                    ';
                        }
                        if ($_REQUEST['NumBambini'][$i]!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini'][$i]. '</td>
                                    ';
                        }
                        if ($_REQUEST['EtaB1_'.$i] != '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_'.$i] . ''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'').'</td>
                                ';
                        }
                        
                        $msg_hotel .= ' </tr>';
                    }
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
                $msg_hotel .=  get_timeline($percorso,$send_timeline);
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
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
                                    </td>
                                </tr>
                            </table>';


                    if ($nome != '' && $cognome != '' && $email != '' && $urlback != '' && $language != '' && $adulti != '' && $arrivo != '' && $partenza != '') {


                        $mail->setFrom(MAIL_SEND, $Hotel);
                        $mail->addAddress($email, $nome.' '.$cognome);
                        if($email_alternativa!=''){
                                $array_alternativa = array();
                                $array_alternativa = explode(",",$email_alternativa);
                                foreach ($array_alternativa as $key => $value) {
                                    $mail->addAddress($value, $nome.' '.$cognome);
                                }


                            }
                        $mail->isHTML(true);
                        $mail->Subject = $responseform['oggetto'][$language];
                        $mail->msgHTML($msg, dirname(__FILE__));
                        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                        $mail->send();

                        $mail_hotel->setFrom(MAIL_SEND, $nome.' '.$cognome);
                        $mail_hotel->addAddress($EmailHotel, $nome.' '.$cognome);
                        $mail_hotel->isHTML(true);
                        $mail_hotel->Subject = $responseform['oggetto'][$language];
                        $mail_hotel->msgHTML($msg_hotel, dirname(__FILE__));
                        $mail_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                        $mail_hotel->send();

                               $data_richiesta = date('Y-m-d');

                               $id_lingua      =  $_REQUEST['id_lingua'];
                               $lingua         =  from_id_to_cod($id_lingua);

                               $numero_prenotazione = NewNumeroPreno($idsito);
                               $cellulare           = field_clean($_REQUEST['telefono']);

                               $dataAtmp            = explode("-",$_REQUEST['data_arrivo']);

                               $data_arrivo         = $dataAtmp[2].'-'.$dataAtmp[1].'-'.$dataAtmp[0];
       
                               $dataPtmp            = explode("-",$_REQUEST['data_partenza']);

                               $data_partenza       = $dataPtmp[2].'-'.$dataPtmp[1].'-'.$dataPtmp[0];
       
                               $dataAtmpAlternativa = explode("-",$_REQUEST['DataArrivo']);
       
                               $DataArrivo          = $dataAtmpAlternativa[2].'-'.$dataAtmpAlternativa[1].'-'.$dataAtmpAlternativa[0];
       
                               $dataPtmpAlternativa = explode("-",$_REQUEST['DataPartenza']);

                               $DataPartenza        = $dataPtmpAlternativa[2].'-'.$dataPtmpAlternativa[1].'-'.$dataPtmpAlternativa[0];
       
                               if($_REQUEST['TipoSoggiorno']){
                                   $n_righe = count($_REQUEST['TipoSoggiorno']);
                                   $i=0;
                                   $RigheCompilate  = '';
                                   for($i==0; $i<=($n_righe-1); $i++){
                                       $RigheCompilate  .= ($_REQUEST['TipoSoggiorno'][$i]!=''?' - Trattamento: '.$_REQUEST['TipoSoggiorno'][$i]:'').' '.($_REQUEST['NumeroCamere'][$i]!=''?' &#10230; Nr.: ' .$_REQUEST['NumeroCamere'][$i].'  ':'').' '.($_REQUEST['TipoCamere'][$i]!=''?' &#10230; Sistemazione: '.$_REQUEST['TipoCamere'][$i]:'').' '.($_REQUEST['NumAdulti'][$i]!=''?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti'][$i]:'').' '.($_REQUEST['NumBambini'][$i]!=''?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini'][$i]:'').'  '.($_REQUEST['EtaB1_'.$i] != ''?' &#10230; Età: '.$_REQUEST['EtaB1_'.$i]:'').''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'')."\r\n";
                                   }
                               }
                               $note           =  (($hotel!='' || $hotel!='--')?addslashes($hotel)."\r\n":'');
                               $note          .=  ($bambini_eta !=''?'Età bambini: '.$bambini_eta.'; ':'').' '.($sistemazione !=''?'Sistemazione: '.$sistemazione.'; ':'').' '.($trattamento !=''?' Trattamento: '.$trattamento.'; ':'');
                               $note          .=  (($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$_REQUEST['DataArrivo'].' Data Partenza Alternativa: '.$_REQUEST['DataPartenza']."\r\n":'');
                               $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                               $note          .=  ($_REQUEST['messaggio']!=''?"\r\n".'Note: '.$_REQUEST['messaggio']:'');
                               
                               $ConsensoMarketing    = ($_REQUEST['marketing']!=''?1:0);
                               $ConsensoProfilazione = ($_REQUEST['profilazione']!=''?1:0);
                               $ConsensoPrivacy      = ($_REQUEST['privacy']!=''?1:0);



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
                                                       'Agent'                     => $Agent);
                               $db_quoto->insert('hospitality_guest', $data);

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
                                   
                               // CODICE PER IL TRACCIAMENTO DELLA PROVENINEZA DA SITO WEB, SE DA CAMPAGNA FB, PPC, GOOGLE; ECC
                               $info_percorso = json_decode($percorso);
                               if(isset($info_percorso)){
                                   // HTTP_REFERER
                                   if(isset($info_percorso->user_data->HTTP_REFERER)){
                                       $provenienza = $info_percorso->user_data->HTTP_REFERER;
                                   }
                                   if(isset($info_percorso->timeline)){
                                       foreach($info_percorso->timeline as $x => $y){
                                           if (strpos($y->url, 'image.php?') == false && $y->time > 0) {
                                               if(!strstr($y->url,'inc_check_valid_email.php')){
                                                   $Tline = $SitoWeb.$y->url;
                                                   $insert_t = "INSERT INTO hospitality_fonti_provenienza
                                                                   (idsito,
                                                                   NumeroPrenotazione,
                                                                   Provenienza,
                                                                   Timeline)
                                                               VALUES
                                                                   ('".$idsito."',
                                                                   '".$numero_prenotazione."',
                                                                   '".addslashes($provenienza)."',
                                                                   '".addslashes($Tline)."')";
                                                   $db_quoto->query($insert_t);
                                               }
                                           }
                                       }
                                   }
                               }

                               $syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                               $db_quoto->query($syncro);


                            // ritorno alla pagina OK
                            echo'   <form  action="' . $urlback . '?res=sent" name="form_response_q" id="form_response_q"  method="post">
                                        <input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
                                        <input type="hidden" name="idsito" value="'.$idsito.'"/>
                                    </form>'."\r\n";

                            echo'   <script language="JavaScript">
                                        document.form_response_q.submit();
                                    </script>'."\r\n";
                            

                    } else {

                        $message = 'ERRORE:Potrebbero esserci alcune variabili obbligatorie non compilate!';
                        echo '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
                    }


        }else{

            echo'<div>
                    <b>Permessi negati!</b><br><br>
                    Contattare:<br>
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
