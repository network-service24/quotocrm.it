<?php
            header("Expires: on, 01 Jan 1970 00:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");

            require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

            require_once BASE_PATH_SITO. 'class/MysqliDb.php';
            $db  = new MysqliDb(DB_SUITEWEB_HOST, DB_SUITEWEB_USER, DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME);


            function getNewIdAnagra()
            {
                global $db;

                    $sql = 'SELECT idanagra FROM anagrafica ORDER BY idanagra DESC LIMIT 1';
                    $ret = $db->query($sql);
                    $rw  = $ret[0];

                    $NewId = ($rw['idanagra']+1);

                    return $NewId;

            }
            function getNewIdSito()
            {
                global $db;

                    $sql = 'SELECT idsito FROM siti ORDER BY idsito DESC LIMIT 1';
                    $ret = $db->query($sql);
                    $rw  = $ret[0];

                    $NewId = ($rw['idsito']+1);

                    return $NewId;

            }
            function getNewIdUtente()
            {
                global $db;

                    $sql = 'SELECT idutente FROM utenti ORDER BY idutente DESC LIMIT 1';
                    $ret = $db->query($sql);
                    $rw  = $ret[0];

                    $NewId = ($rw['idutente']+1);

                    return $NewId;

            }

            function getComune($codice_comune = null)
            {
                global $db;
                if($codice_comune != null)
                {
                    $sql = 'SELECT * FROM comuni where codice_comune = "'.$codice_comune.'"';
                    $ret = $db->query($sql);
                    $rw  = $ret[0];
                    if(isset($rw))
                        return($rw['nome_comune']);
                    else
                        return false;
                }

            }
            function getRegione($codice_regione = null)
            {
                global $db;
                if($codice_regione != null)
                {
                    $sql = 'SELECT * FROM regioni where codice_regione = "'.$codice_regione.'"';
                    $ret = $db->query($sql);
                    $rw  = $ret[0];
                    if(isset($rw))
                        return($rw['nome_regione']);
                    else
                        return false;
                }
            }
            function getProvincia($codice_provincia = null)
            {
                global $db;
                if($codice_provincia != null)
                {
                    $sql = 'SELECT * FROM province where codice_provincia = "'.$codice_provincia.'"';
                    $ret = $db->query($sql);
                    $rw  = $ret[0];
                    if(isset($rw))
                        return($rw['sigla_provincia']);
                    else
                        return false;
                }

            }
            function gira_data($data){
                $data = explode(" ",$data);
                $data_tmp = explode("-",$data[0]);
                $new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data[1];
                return $new_data;
            }

            function bannercookies(){
                $txt_overlay_cookie = '<p>La informiamo che, per migliorare la Sua esperienza di navigazione su questo sito web, il titolare del trattamento dati, utilizza diversi tipi di cookie, tra cui: 1) Cookies tecnici o analitici prima parte; 2) Cookies analitici di terze parti anonime; 3) Cookies analitici di terze parti non anonime. Nella pagina dell&rsquo;Informativa estesa &ldquo;Cookie policy&rdquo; che trova qui sono presenti le istruzioni per negare il consenso all&#39;installazione di qualunque tipologia di cookie.<br />
                Cliccando su &quot;OK&quot; o continuando la navigazione, dichiara di avere compreso le modalit&agrave; nell&#39; Informativa Estesa ai sensi dell&#39;Art 13 del Reg. (UE) 2016/679.</p>';
                $txt_overlay_cookie = str_replace("\n",'',str_replace("\r",'',str_replace('"','\"',nl2br($txt_overlay_cookie))));
                if($txt_overlay_cookie != ''){

                                $l10n['OK'] = 'OK';
                                $l10n['Più Informazioni'] = 'Più Informazioni';

                  
                }
            
            echo '<div id="bnrcks"><div class="cntcks">'.$txt_overlay_cookie.' <button class="npcks">'.$l10n['Più Informazioni'].'</button></div><div class="btncks"><button class="okcks">'.$l10n['OK'].'</button></div></div>';
        }

if($_REQUEST['action']=='registra'){

        // funzione per il top email
        function top_email($hotel,$base_url_suiteweb){

            $top = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
                    <head>
                        <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
                        <title>".$hotel."</title>
                        <link rel=\"stylesheet\" type=\"text/css\" href=\"".$base_url_suiteweb."css/style_email.css\" />
                        <style>
                            @charset \"UTF-8\";

                        @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 300;
                        src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(".$base_url_suiteweb."css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format('woff');
                        }
                        @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(".$base_url_suiteweb."css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                        }
                        @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(".$base_url_suiteweb."css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                        }

                        @font-face {
                        font-family: 'Vollkorn';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Vollkorn Regular'), local('Vollkorn-Regular'), url(".$base_url_suiteweb."css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                        }
                        @font-face {
                        font-family: 'Vollkorn';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Vollkorn Bold'), local('Vollkorn-Bold'), url(".$base_url_suiteweb."css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format('woff');
                        }

                        body { background-image:url(".$base_url_suiteweb."img/bg-mail.jpg); background-position:top left; background-repeat:no-repeat; background-color:#FFFFFF; margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
                        a{ text-decoration:none; color:#333333; }
                        h2{ font-size:12pt; }
                        .tbl_body { width:850px; font-size:9pt; background-color:#FFFFFF; border-collapse:collapse; }
                        .tbl_body td { padding:5px; }
                        td{white-space: nowrap;}
                        .tbl_body .spacer_td { border-top:solid 1px #999999; background-color:#EEEEEE; height:30px; }
                        .tbl_body .spacer_btm_td { border-bottom:solid 1px #999999; height:15px; }
                        .title{ background-color:#FFFFFF; color:#666666; font-size:14pt; }
                        .footer{ background-color:#BBBBBB; color:#666666; font-size:8pt; }
                        .footer a{ color:#EEEEEE; }
                        </style>
                    </head>
                    <body>
                    <table class=\"tbl_body\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">
                        <tr>
                            <td align=\"left\" valign=\"top\">";

        return($top);
        }
        // funzione per il footer email
        function footer_email(){

            $footer = '   </td>
                        </tr>
                    </table>
                </body>
            </html>';

        return($footer);
        }

    $idanagra                     = $_REQUEST['idanagra'];
    $idsito                       = $_REQUEST['idsito'];
    $idutente                     = $_REQUEST['idutente'];
    $nome                         = $db->escape($_REQUEST['nome']);
    $cognome                      = $db->escape($_REQUEST['cognome']);
    $cellulare_referente          = $_REQUEST['cellulare_referente'];
    $email_referente              = $_REQUEST['email_referente'];
    $struttura                    = $db->escape($_REQUEST['struttura']);
    $rag_soc                      = $db->escape($_REQUEST['rag_soc']);
    $partita_iva                  = $_REQUEST['partita_iva'];
    $codice_fiscale               = $_REQUEST['codice_fiscale'];
    $regione                      = getRegione($_REQUEST['id_regione']);
    $provincia                    = getProvincia($_REQUEST['id_provincia']);
    $comune                       = getComune($_REQUEST['citta']);
    $codice_regione               = $_REQUEST['id_regione'];
    $codice_provincia             = $_REQUEST['id_provincia'];
    $codice_comune                = $_REQUEST['citta'];
    $indirizzo                    = $db->escape($_REQUEST['indirizzo']);
    $sitoweb                      = $_REQUEST['sitoweb'];
    $cellulare                    = $_REQUEST['cellulare'];
    $fax                          = $_REQUEST['fax'];
    $email                        = $_REQUEST['email'];
    $username                     = $_REQUEST['username'];
    $password                     = $_REQUEST['password'];
    $checkin_online_hospitality   = 1;
    $hospitality                  = 1;
    $data_start_hospitality       = $_REQUEST['data_start_hospitality'];
    $data_end_hospitality         = $_REQUEST['data_end_hospitality'];
    $Ip                           = $_REQUEST['Ip'];
    $data_creazione_anagrafica    = date('Y-m-d H:i:s');
    $data_modifica_anagrafica     = date('Y-m-d H:i:s');
    $id_stato                     = 112;
    $id_status                    = 1;
    $abilita_mappa                = 1;
    $blocco_accesso               = 0;
    $is_admin                     = 0;
    $status                       = 1;
    $no_rinnovo_hospitality       = 1;
    $servizi_attivi               = 'Promo Check-in Online Omaggio';
            function verifyCaptcha($response,$remoteip){


                $url  = "https://www.google.com/recaptcha/api/siteverify";
                $url .= "?secret="  .urlencode(stripslashes('6Lf4WPQUAAAAALWdUSPnZvVwGKrwcJHxfkaOHrt_'));
                $url .= "&response=".urlencode(stripslashes($response));
                $url .= "&remoteip=".urlencode(stripslashes($remoteip));


                $response = file_get_contents($url);
                $response = json_decode($response,true);

                return (object) $response;
            }

            $BaseUrlSuiteweb = 'https://www.suiteweb.it/';


            $msg_op .= top_email($Hotel,$BaseUrlSuiteweb);

            $msg_op .= '
                                <img src="'.BASE_URL_SITO.'img/logo.png" alt="QUOTO!" />
                                <h1  class="title">Riepilogo dati inseriti per Check-in Online QUOTO!</h1>
                                    <table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">
                                        <tr>
                                            <td align="left" valign="top" style="width:100%" colspan="2"><b>DATI ANAGRAFICI</b></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Nome</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $nome . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Cognome</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $cognome . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Il tuo Cellulare</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $cellulare_referente . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>La tua E-Mail</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $email_referente . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:100%" colspan="2"><b>DATI STRUTTURA</b></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Nome Struttura</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $struttura . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Ragione Sociale </b></td>
                                            <td align="left" valign="top" style="width:70%">' . $rag_soc . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Partita IVA</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $partita_iva . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Codice Fiscale</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $codice_fiscale . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Regione</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $regione . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Provincia</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $provincia . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Comune</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $comune . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Indirizzo</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $indirizzo . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Sito Web</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $sitoweb . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Telefono</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $cellulare . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Fax</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $fax . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>E-Mail</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $email . '</td>
                                        </tr>';
                    $msg_op .= '        <tr>
                                            <td align="left" valign="top" style="width:100%" colspan="2"><b>DATI PER ACCESSO LOGIN</b></td>
                                        </tr>
                                        <!--<tr>
                                            <td align="left" valign="top" style="width:30%"><b>ACCESSO AL SOFTWARE</b> (<span style="color:#FF0000">IN ATTESA DI ABILITAZIONE</span>)</td>
                                            <td align="left" valign="top" style="width:70%">A breve riceverete una email di conferma per accedere liberamente al Check-in Online di QUOTO! I dati di accesso sono riportati di seguito!</td>
                                        </tr>-->
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Attivo</b></td>
                                            <td align="left" valign="top" style="width:70%">Dal '.gira_data($data_start_hospitality).' al '.gira_data($data_end_hospitality).'</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Url</b></td>
                                            <td align="left" valign="top" style="width:70%">https://www.quoto.online/login.php</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>UserName</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $username . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>PassWord</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $password . '</td>
                                        </tr>
                                    </table>';

                    $msg_op .= '<br><table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                    <tr>
                                        <td valign="top">
                                            <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: center"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
                                        </td>
                                    </tr>
                                </table>';
                    $msg_op .= footer_email();
                    $msg .= top_email($Hotel,$BaseUrlSuiteweb);
                    $msg .= '
                                        <img src="'.BASE_URL_SITO.'img/logo.png" alt="QUOTO!" />
                                        <h1  class="title">Grazie per esserti registrato per l\'uso del modulo di Check-in Online QUOTO!</h1>
                                        <table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">
                                        <tr>
                                            <td align="left" valign="top" style="width:100%" colspan="2">
                                                Gentile <b>' . $nome . '</b>,
                                                <br><br>
                                                hai attivato l\'account di Quoto!
                                                <br><br>
                                                Complimenti!
                                                <br><br>
                                                Da adesso potrai utilizzare il modulo <b>Check-In Online</b> gratuitamente fino al <b>'.gira_data($data_end_hospitality).'</b>.
                                                <br><br>
                                                Accedi subito ed inizia ad utilizzare le funzionalità del <b>Check-In Online di Quoto!</b>
                                                <br><br>
                                                <b>Assistenza</b> --> <a href="mailto:support@quoto.travel">support@quoto.travel</a>
                                                <br><br>
                                                A presto
                                                <br><br>
                                                Il team di Quoto! Crm per Hotel
                                            </td>
                                        </tr>';
                    $msg .= '           <tr>
                                            <td align="left" valign="top" style="width:100%" colspan="2"><b>DATI PER ACCESSO LOGIN</b></td>
                                        </tr>
                                        <!--<tr>
                                            <td align="left" valign="top" style="width:30%"><b>ACCESSO AL SOFTWARE</b> (<span style="color:#FF0000">IN ATTESA DI ABILITAZIONE</span>)</td>
                                            <td align="left" valign="top" style="width:70%">A breve riceverete una email di conferma per accedere liberamente al Check-in Online di QUOTO! I dati di accesso sono riportati di seguito!</td>
                                        </tr>-->
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Attivo</b></td>
                                            <td align="left" valign="top" style="width:70%">Dal '.gira_data($data_start_hospitality).' al '.gira_data($data_end_hospitality).'</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>Url</b></td>
                                            <td align="left" valign="top" style="width:70%">https://www.quoto.online/login.php</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>UserName</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $username . '</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>PassWord</b></td>
                                            <td align="left" valign="top" style="width:70%">' . $password . '</td>
                                        </tr>
                                    </table>';

                    $msg .= '<br><table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                    <tr>
                                        <td valign="top">
                                            <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: center"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
                                        </td>
                                    </tr>
                                </table>';

            $msg .= footer_email();




            if (isset($_REQUEST["g-recaptcha-response"])) {

                        $remoteip  = $_SERVER["REMOTE_ADDR"];
                        $recaptcha = $_REQUEST["g-recaptcha-response"];

                        $response = verifyCaptcha($recaptcha, $remoteip);

                        if ($response->success) {

                            if ($struttura != '' && $rag_soc != '' && $email != '') {

                            require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';
                            $mail     = new PHPMailer;
                            $mail_NWS = new PHPMailer;

                            $mail->setFrom(MAIL_SEND, 'QUOTO!');
                            $mail->addAddress($email, $struttura);
                            if($email_referente != $email){
                                $mail->addAddress($email_referente, $struttura);
                            }
                            $mail->isHTML(true);
                            $mail->Subject = 'Conferma registrazione modulo di Check-in Online di QUOTO!';
                            $mail->msgHTML($msg, dirname(__FILE__));
                            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                            $mail->send();

                            $mail_NWS->setFrom(MAIL_SEND, $struttura);
                            $mail_NWS->addAddress(MAIL_ASSISTENZA, $struttura .' per QUOTO! Check-in Online');
                            $mail_NWS->addAddress('antonio@network-service.it', $struttura .' per QUOTO! Check-in Online');
                            $mail_NWS->addAddress('marcello@network-service.it', $struttura .' per QUOTO! Check-in Online');
                            $mail_NWS->isHTML(true);
                            $mail_NWS->Subject = 'Utente '.$struttura.' che si è registrato per usare il Checkin Online di QUOTO!';
                            $mail_NWS->msgHTML($msg_op, dirname(__FILE__));
                            $mail_NWS->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                            $mail_NWS->send();

                                $data = array(
                                                'idanagra'                           => $idanagra,
                                                'nome'                               => $nome,
                                                'cognome'                            => $cognome,
                                                'rag_soc'                            => $rag_soc,
                                                'p_iva'                              => $partita_iva,
                                                'codice_fiscale'                     => $codice_fiscale,
                                                'codice_regione'                     => $codice_regione,
                                                'codice_provincia'                   => $codice_provincia,
                                                'codice_comune'                      => $codice_comune,
                                                'id_stato'                           => $id_stato,
                                                'indirizzo'                          => $indirizzo,
                                                'cell'                               => $cellulare_referente,
                                                'fax'                                => $fax,
                                                'email'                              => $email_referente,
                                                'data_creazione_anagra'              => $data_creazione_anagrafica,
                                                'data_modifica_anagra'               => $data_modifica_anagrafica,
                                                'id_status'                          => $id_status
                                            );
                                $db->insert('anagrafica', $data);

                                $data2 = array(
                                                    'idsito'                      => $idsito,
                                                    'nome'                        => $struttura,
                                                    'web'                         => $sitoweb,
                                                    'codice_regione'              => $codice_regione,
                                                    'codice_provincia'            => $codice_provincia,
                                                    'codice_comune'               => $codice_comune,
                                                    'id_stato'                    => $id_stato,
                                                    'indirizzo'                   => $indirizzo,
                                                    'cell'                        => $cellulare,
                                                    'fax'                         => $fax,
                                                    'email'                       => $email,
                                                    'data_creazione'              => $data_creazione_anagrafica,
                                                    'data_modifica'               => $data_modifica_anagrafica,
                                                    'abilita_mappa'               => $abilita_mappa,
                                                    'servizi_attivi'              => $servizi_attivi,
                                                    'checkin_online_hospitality'  => $checkin_online_hospitality,
                                                    'no_rinnovo_hospitality'      => $no_rinnovo_hospitality,
                                                    'hospitality'                 => $hospitality,
                                                    'data_start_hospitality'      => $data_start_hospitality,
                                                    'data_end_hospitality'        => $data_end_hospitality

                                                );
                                    $db->insert('siti', $data2);

                                    $data3 = array(
                                                'idutente'                              => $idutente,
                                                'idanagra'                              => $idanagra,
                                                'idsito'                                => $idsito,
                                                'username'                              => $username,
                                                'password'                              => $password,
                                                'blocco_accesso'                        => $blocco_accesso,
                                                'is_admin'                              => $is_admin,
                                                'data_creazione'                        => $data_creazione_anagrafica,
                                                'data_modifica'                         => $data_modifica_anagrafica,
                                                'ut_nome'                               => $nome,
                                                'ut_cognome'                            => $cognome,
                                                'ut_email'                              => $email,
                                                'status'                                => $status
                                            );
                                $db->insert('utenti', $data3);

                                // entra in quoto!
                                echo'<form  action="'.BASE_URL_SITO.'login.php" method="post" name="form_phpmv" id="form_phpmv">
                                        <input type="hidden" name="username" id="username"  value="'.$username.'"/>
                                        <input type="hidden" name="password" id="password"  value="'.$password.'"/>
                                    </form>'."\r\n";

                                    echo'<script language="JavaScript">
                                            document.form_phpmv.submit();
                                        </script>'."\r\n";
                            } else {

                                $message = 'ERRORE:Potrebbero esserci alcune variabili obbligatorie non compilate!';
                                echo '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
                            }

                        } else {

                            // ritorno alla pagina KO
                            $message = 'Controllo CAPTCHA negativo!';
                            echo '<script language="javascript">alert("' . $message . '");document.location="'.BASE_URL_SITO.'registrazione/index.php"</script>';

                        }
                }

    }
$oggi        = date('Y-m-d');
//$UnAnnoDopo_ = mktime(0,0,0,date('m'),date('d'),(date('Y')+1));
//$UnAnnoDopo  = date('Y-m-d',$UnAnnoDopo_);
$UnAnnoDopo  = '2020-10-31';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NBJDMF');</script>
<!-- End Google Tag Manager -->
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In omaggio fino al 31/10/2020">
    <meta property="og:title" content="Registrati ed utilizza subito il check in online">
	<meta property="og:site_name" content="Registrati ed utilizza subito il check in online">
	<meta property="og:description" content="In omaggio fino al 31/10/2020">
	<meta property="og:image" content="<?=$url_web?>/registrazione/og.jpg" />
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?=$url_web?>">
    <meta name="author" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon"  href="<?=BASE_URL_SITO?>img/favicon.ico">
    <title>Registrati ed utilizza subito il check in online</title>
    <!-- Bootstrap Core CSS -->
<!-- <link href="<?=BASE_URL_SITO?>material/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Custom CSS -->
    <link href="<?=BASE_URL_SITO?>registrazione/style.css" rel="stylesheet">
    <link href="<?=BASE_URL_SITO?>registrazione/bannercks.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <script src="https://resources.suiteweb.it/font-awesome/js/all.min.js"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,400i,500,600,700,800,900|Roboto:100,300,400,400i,500,700,900&display=swap" rel="stylesheet">
    <!--  Jquery -->
     <script src="<?=BASE_URL_SITO?>material/assets/plugins/jquery/jquery.min.js"></script>

     <script src="<?=BASE_URL_SITO?>registrazione/main.js"></script>

     <script src="<?=BASE_URL_SITO?>registrazione/bannercks.js"></script>

    <script type="text/javascript" src="<?=BASE_URL_SITO?>js/jquery.validate.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    // Equalize //
    function EQ(id) {
        wWindow = $(window).width();
        HEQ = 0;
        $('.' + id).css({
            'height': 'auto'
        });
        $('.' + id).each(function() {
            HID = $(this).outerHeight();
            if (HID > HEQ) {
                HEQ = HID;
            }
        });
        $('.' + id).css({
            'height': HEQ
        });
    }
    //
    function EQR() {
        EQ('m-eq');
        EQ('m-eq1');
        EQ('m-eq2');
        EQ('m-eq3');
        EQ('m-eq4');
        EQ('m-eq5');
        EQ('m-eq6');
        EQ('m-eq7');
        EQ('olm-eq');
        EQ('footer-eq2');
        EQ('footer-eq');
        EQ('bnf-eq');
        EQ('bnfb-eq');
        EQ('bnfb-eq2');
        EQ('video-eq');
    }
    EQR();
    $(window).on('load', function() {
        EQR();
    });
    $(window).on('resize', function() {
        EQR();
    });
    function genera_password(limit) {

        limit = limit || 8;

        var password = '';

        var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        var list = chars.split('');
        var len = list.length,
            i = 0;

            do {

                i++;

                var index = Math.floor(Math.random() * len);

                password += list[index];

            } while (i < limit);

        return password;

    }

    $( document ).ready(function() {

        $('#password').click(function() {
            $('#password').val(genera_password(8));
        })

        $("#passo_zero").show();
        $("#passo_uno").hide();
        $("#passo_due").hide();
        $("#passo_tre").hide();
        $("#passo_quattro").hide();

        $("#PassoZero").on("click",function(){
            var nome                = $("#nome").val();
            var cognome             = $("#cognome").val();
            var cellulare_referente = $("#cellulare_referente").val();
            var email_referente     = $("#email_referente").val();
            if(nome == ''){
                alert('Inserire il tuo nome!');
            }
            else if(cognome == ''){
                alert('Inserire il tuo cognome!');
            }
            else if(cellulare_referente == ''){
                alert('Inserire il tuo numero di cellulare!');
            }
            else if(email_referente == ''){
                alert('Inserire la tua E-Mail');
            }
            else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email_referente)){
                alert('Il formato della email non è corretto');
            }
            else if(nome != '' && cognome != '' && cellulare_referente != '' && email_referente != ''){
                $("#passo_zero").hide();
                $("#passo_uno").show();
            }

        })

        $("#PassoUno").on("click",function(){
            var struttura       = $("#struttura").val();
            var rag_soc         = $("#rag_soc").val();
            var partita_iva     = $("#partita_iva").val();
            var codice_fiscale  = $("#codice_fiscale").val();
            if(struttura == ''){
                alert('Inserire il nome della tua Struttura');
            }
            else if(rag_soc == ''){
                alert('Inserire il nome della Ragione Sociale');
            }
            else if(partita_iva == '' && codice_fiscale == ''){
                alert('Inserire il nome la Partita IVA oppure il Codice Fiscale');
            }
            else if(struttura != '' && rag_soc != '' && (partita_iva != '' || codice_fiscale != '')){
                $("#passo_uno").hide();
                $("#passo_due").show();
            }

        })
        $("#PassoDue").on("click",function(){
            var id_regione      = $("#id_regione").val();
            var id_provincia    = $("#id_provincia").val();
            var citta           = $("#citta").val();
            var indirizzo       = $("#indirizzo").val();
            if(id_regione == ''){
                alert('Scegliere la Regione');
            }
            else if(id_provincia == ''){
                alert('Scegliere la Provincia');
            }
            else if(citta == ''){
                alert('Scegliere il Comune');
            }
            else if(indirizzo == ''){
                alert('Inserire il vostro indirizzo');
            }
            else if(id_regione != '' && id_provincia != '' && citta != '' && indirizzo != ''){
                $("#passo_due").hide();
                $("#passo_tre").show();
            }
        })
        $("#PassoTre").on("click",function(){
            var sitoweb      = $("#sitoweb").val();
            var cellulare    = $("#cellulare").val();
            var email        = $("#email").val();
            if(sitoweb == ''){
                alert('Inserire il vostro Sito Web');
            }
            else if(cellulare == ''){
                alert('Inserire il Numero di Telefono / Cellulare');
            }
            else if(email == ''){
                alert('Inserire la vostra E-Mail');
            }
            else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)){
                alert('Il formato della email non è corretto');
            }
            else if(sitoweb != '' && cellulare != '' && email != ''){
                $("#passo_tre").hide();
                $("#passo_quattro").show();
            }
        })

        $(".back0").on("click",function(){
            $("#passo_zero").show();
            $("#passo_uno").hide();
            $("#passo_due").hide();
            $("#passo_tre").hide();
            $("#passo_quattro").hide();

        })
        $(".back1").on("click",function(){
            $("#passo_uno").show();
            $("#passo_zero").hide();
            $("#passo_due").hide();
            $("#passo_tre").hide();
            $("#passo_quattro").hide();
        })
        $(".back2").on("click",function(){
            $("#passo_due").show();
            $("#passo_zero").hide();
            $("#passo_uno").hide();
            $("#passo_tre").hide();
            $("#passo_quattro").hide();

        })
        $(".back3").on("click",function(){
            $("#passo_tre").show();
            $("#passo_zero").hide();
            $("#passo_uno").hide();
            $("#passo_due").hide();
            $("#passo_quattro").hide();

        })

        $("#registra").validate({
            rules: {
                nome: "required",
                cognome: "required",
                cellulare_referente: "required",
                email_referente: {
                    required: true,
                    email: true
                },
                struttura: "required",
                rag_soc: "required",
                email: {
                    required: true,
                    email: true
                },
                privacy: "required",
                id_regione: "required",
                id_provincia: "required",
                citta: "required",
                indirizzo: "required",
                sitoweb: "required",
                cellulare:"required",
                username: {
                    required : true,
                    minlength: 8
                },
                password: {
                    required : true,
                    minlength: 8
                }
            },
            messages: {
                privacy: "Acconsenti al trattamento",
            }
        });

    });
</script>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBJDMF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="m m-x-12">
        <div class="m m-x-3 m-xl-2 m-l-1 m-m-0 m-x-h100"></div>
        <div class="m m-x-3 m-xl-4 m-x-tl m-l-5 m-m-6 m-s-12">
            <div class="box3">
                <div class="t30 w700 m-x-tc">
                    <img src="<?=BASE_URL_SITO?>registrazione/img/logo.jpg" alt="">
                    <div class="ca20"></div>
                    Usa il Modulo di <br>Check-in Online di QUOTO<br>per il tuo hotel
                </div>
                <div class="t25 w700 m-x-tc riquadretto">In omaggio fino al 31/10/2020</div>
                <div class="ca50"></div>
                <strong>Aiuta il tuo ospite a smaltire le procedure di Check-in in Hotel!</strong>
                <div class="ca"></div>
                    Inserisci  l'anagrafica del tuo cliente in pochi passi.
                <div class="ca20"></div>
                <strong>Segna il canale di provenienza della tua prenotazione.</strong>
                <div class="ca"></div>
                    Inserisci i riferimenti della prenotazione.
                <div class="ca20"></div>
                <strong>Pronto all'invio!</strong>
                <div class="ca"></div>
                    Invia tramite Whatsapp o E-mail il link alla landing page dedicata al modulo di Check-in Online
                <div class="ca50"></div>
                <div class="m m-x-12 m-x-tc">
                    <div class="t16 w700 riquadretto2"> Richiedi il Modulo di Check-in Online qui <i class="fas fa-arrow-right"></i><div class="down"><i class="fas fa-arrow-down"></i> <i class="fas fa-arrow-down"></i> <i class="fas fa-arrow-down"></i></div></div>
                </div>
            </div>
        </div>

        <div class="m m-x-3 m-xl-4 m-l-5 m-m-6 m-s-12">
            <div class="box3">
                <div class="t30 m-x-tc">

                    Sei pronto ad utilizzare subito Il Modulo di Check-in Online di Quoto! ?
                </div>
                <div class="ca50"></div>
                <div class="boxform twhite m-x-tc">
                    <div class="t30 roboto">Registrati ed usa subito il Check-in Online!</div>
                    <div class="ca20"></div>
                    <div class="t18">Compila i campi, seguendo gli step!</div>
                    <div class="ca20"></div>
                    <form class="m-x-tl" name="registra" id="registra" method="post" action="<?=$_SERVER['REQUEST_URI']?>">

                        <div id="passo_zero">


                                <div class="t18 text-center">Come ti chiami?</div>

                                    <div class="ContentPul">
                                                <button type="button" class="equal">1</button>
                                                <button type="button" class="equal" style="opacity:0.5">2</button>
                                                <button type="button" class="equal" style="opacity:0.5">3</button>
                                                <button type="button" class="equal" style="opacity:0.5">4</button>
                                                <button type="button" class="equal" style="opacity:0.5">5</button>
                                        </div>

                                <div class="ca"></div>


                                            <label>* Nome </label>
                                            <input type="text" name="nome" id="nome" autocomplete="off" />
                                <div class="ca"></div>

                                            <label>* Cognome </label>
                                            <input type="text" name="cognome" id="cognome" autocomplete="off"  />
                                <div class="ca"></div>

                                            <label>* Cellulare referente </label>
                                            <input name="cellulare_referente" type="text"  id="cellulare_referente"  />
                                <div class="ca"></div>

                                            <label>* E-Mail referente </label>
                                            <input name="email_referente" type="text"  id="email_referente" autocomplete="off" />
                                <div class="ca"></div>

                                            <button type="button"id="PassoZero" onclick="scroll_to('registra',150, 500)">Step 1/5</button>

                                </div>

                            <div id="passo_uno">


                                <div class="t18 text-center">Inserisci i dati della tua Struttura ricettiva!</div>

                                    <div class="ContentPul">
                                                <button type="button" class="back0 equal" style="opacity:0.5">1</button>
                                                <button type="button" class="equal">2</button>
                                                <button type="button" class="equal" style="opacity:0.5">3</button>
                                                <button type="button" class="equal" style="opacity:0.5">4</button>
                                                <button type="button" class="equal" style="opacity:0.5">5</button>
                                        </div>
                                <div class="ca"></div>


                                            <label>* Nome Struttura </label>
                                            <input type="text" name="struttura" id="struttura"  placeholder="Hotel..... 3 stelle" />
                                <div class="ca"></div>

                                            <label>* Ragione Sociale </label>
                                            <input type="text" name="rag_soc" id="rag_soc"   />
                            <div class="ca"></div>

                                            <label>* Partita IVA <div class="text-gray padL20">( * oppure il campo codice fiscale)</div></label>
                                            <input name="partita_iva" type="text"  id="partita_iva" maxlength="12" />
                            <div class="ca"></div>

                                          <label> Codice Fiscale </label>
                                            <input name="codice_fiscale" type="text"  id="codice_fiscale" maxlength="16" pattern=".{16,}" />
                            <div class="ca"></div>


                                            <button type="button" id="PassoUno" onclick="scroll_to('registra',150, 500)">Step 2/5</button>

                            </div>

                            <div id="passo_due">



                                <div class="t18 text-center">L'indirizzo della tua struttura ricettiva!</div>

                                    <div class="ContentPul">
                                                <button type="button" class="back0 equal" style="opacity:0.5">1</button>
                                                <button type="button" class="back1 equal" style="opacity:0.5">2</button>
                                                <button type="button" class="equal">3</button>
                                                <button type="button" class="equal" style="opacity:0.5">4</button>
                                                <button type="button" class="equal" style="opacity:0.5">5</button>
                                            </div>
                                    <div class="ca"></div>
                                            <label>* Regione</label>
                                            <select id="id_regione" name="id_regione"  >
                                                <option value="" ></option>
                                                <?
                                                $query = "SELECT * FROM regioni  WHERE codice_regione IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) ORDER BY nome_regione ASC";
                                                $res = $db->query($query);
                                                    foreach($res as $key => $row){
                                                    echo '<option value="'.$row['id_regione'].'">'.$row['nome_regione'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <script>
                                            $(document).ready(function() {
                                                $('#id_regione').change(function() {
                                                    var id_regione = $("#id_regione").val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?=BASE_URL_SITO?>ajax/id_provincia.php",
                                                        data: "id_regione=" + id_regione,
                                                        dataType: "html",
                                                        success: function(msg) {
                                                            $("#id_provincia").html(msg);
                                                        },
                                                        error: function() {
                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                        }
                                                    });
                                                });
                                            });
                                            </script>
                                        <div class="ca"></div>
                                            <label>* Provincia</label>
                                            <select id="id_provincia" name="id_provincia"  ></select>
                                            <script>
                                            $(document).ready(function() {
                                                $('#id_provincia').change(function() {
                                                    var id_provincia = $("#id_provincia").val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?=BASE_URL_SITO?>ajax/id_citta.php",
                                                        data: "id_provincia=" + id_provincia,
                                                        dataType: "html",
                                                        success: function(msg) {
                                                            $("#citta").html(msg);
                                                        },
                                                        error: function() {
                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                        }
                                                    });
                                                });
                                            });
                                            </script>
                                    <div class="ca"></div>
                                            <label>* Comune</label>
                                            <select name="citta"  id="citta" ></select>
                                    <div class="ca"></div>
                                            <label>* Indirizzo civico struttura</label>
                                            <input name="indirizzo" type="text"  id="indirizzo" />
                                    <div class="ca"></div>

                                            <button type="button" id="PassoDue" onclick="scroll_to('registra',150, 500)">Step 3/5</button>



                            </div>

                            <div id="passo_tre">


                                <div class="t18 text-center">  Hai quasi terminato, inserisci alcune informazioni utili...</div>

                                <div class="ContentPul">
                                                <button type="button" class="back0 equal" style="opacity:0.5">1</button>
                                                <button type="button" class="back1 equal" style="opacity:0.5">2</button>
                                                <button type="button" class="back2 equal" style="opacity:0.5">3</button>
                                                <button type="button" class="equal">4</button>
                                                <button type="button" class="equal" style="opacity:0.5">5</button>
                                      </div>
                            <div class="ca"></div>

                                            <label>* Sito Web struttura</label>
                                            <input type="text" name="sitoweb" id="sitoweb"  placeholder="www.sitoweb.it"  autocomplete="off" />
                                <div class="ca"></div>
                                            <label>* Telefono struttura </label>
                                            <input type="numeric" name="cellulare" id="cellulare"   placeholder="Numero telefonico senza nessun altro carattere" />
                                <div class="ca"></div>
                                            <label> Fax struttura</label>
                                            <input type="text" name="fax" id="fax"  />
                                    <div class="ca"></div>
                                            <label>* E-Mail struttura</label>
                                            <input type="text" name="email" id="email"  autocomplete="off" />

                                        <script>
                                            $(document).ready(function() {
                                                $('#email').on("mouseout change",function() {
                                                    var email = $("#email").val();

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?=BASE_URL_SITO?>ajax/check_email_login.php",
                                                        data: "email=" + email,
                                                        dataType: "html",
                                                        success: function(msg) {
                                                            if(msg > 0){
                                                                $("#check_email").html('<div class="text-red text-center">L\'email è già abbinata ad un account in uso!</div>');
                                                                $('#PassoTre').attr("disabled", "disabled").button('refresh');
                                                            }else{
                                                                $("#check_email").html('');
                                                                $('#PassoTre').removeAttr("disabled").button('refresh');
                                                            }

                                                        },
                                                        error: function() {
                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                        }
                                                    });
                                                });
                                            });
                                            </script>
                                            <div id="check_email"></div>
                                    <div class="ca"></div>

                                            <button type="button" id="PassoTre" onclick="scroll_to('registra',150, 500)">Step 4/5</button>


                            </div>

                            <div id="passo_quattro">


                                <div class="t18 text-center">Ultimo Step,<br> Crea il tuo account ed entra in QUOTO!</div>

                                <div class="ContentPul">
                                                <button type="button" class="equal back0" style="opacity:0.5">1</button>
                                                <button type="button" class="equal back1" style="opacity:0.5">2</button>
                                                <button type="button" class="equal back2" style="opacity:0.5">3</button>
                                                <button type="button" class="equal back3" style="opacity:0.5">4</button>
                                                <button type="button" class="equal">5</button>
                                            </div>
                                <div class="ca"></div>
                                                <label>* UserName </label>
                                                <input type="text" name="username" id="username"  title="Campo obbligatorio (Min 8 caratteri)" pattern="[A-Za-z]{8}" autocomplete="off" />

                                            <script>
                                            $(document).ready(function() {
                                                $('#username').on("mouseout change",function() {
                                                    var username = $("#username").val();

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?=BASE_URL_SITO?>ajax/check_user_login.php",
                                                        data: "username=" + username,
                                                        dataType: "html",
                                                        success: function(msg) {
                                                            if(msg > 0){
                                                                $("#check_user").html('<div class="text-red text-center">La username è già in uso!</div>');
                                                                $('#pulsante-invio').attr("disabled", "disabled").button('refresh');
                                                            }else{
                                                                $("#check_user").html('');
                                                                $('#pulsante-invio').removeAttr("disabled").button('refresh');
                                                            }

                                                        },
                                                        error: function() {
                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                        }
                                                    });
                                                });
                                            });
                                            </script>
                                            <div id="check_user"></div>
                                    <div class="ca"></div>
                                                <label>* PassWord </label>
                                                <input type="text" name="password" id="password"  title="Campo obbligatorio (Min 8 caratteri)"  pattern="[A-Za-z]{8}" autocomplete="off" />

                                            <script>
                                            $(document).ready(function() {
                                                $('#password').on("mouseout change click",function() {
                                                    var password = $("#password").val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?=BASE_URL_SITO?>ajax/check_pass_login.php",
                                                        data: "password=" + password,
                                                        dataType: "html",
                                                        success: function(msg) {
                                                            if(msg > 0){
                                                                $("#check_pass").html('<div class="text-red text-center">La password è già in uso!</div>');
                                                                $('#pulsante-invio').attr("disabled", "disabled").button('refresh');
                                                            }else{
                                                                $("#check_pass").html('');
                                                                $('#pulsante-invio').removeAttr("disabled").button('refresh');
                                                            }

                                                        },
                                                        error: function() {
                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                        }
                                                    });
                                                });
                                            });
                                            </script>
                                            <div id="check_pass"></div>
                                            <div class="ca"></div>
                                            <label> &nbsp; </label>
                                                <div class="g-recaptcha" data-sitekey="6Lf4WPQUAAAAAMkEu-YZZqebuJwkLa6lEAhkR0kv"></div>
                                                <div class="ca"></div>

                                                <span class="txtprivacy">
                                                    <input name="privacy" id="privacy" type="checkbox"  value="checkbox"> Ho preso visione dell'informativa per il trattamento dei miei dati: <a href="#INFORMATIVA" rel="modal:open"><b>Visualizza</b></a>
                                                <div id="INFORMATIVA" class="modal">
                                                <b>INFORMATIVA EX ART. 13 UE N. 679/2016 - MODULO CHECK-IN ONLINE QUOTO</b><br><br>

<b>NETWORK SERVICE S.R.L.</b>, avente sede legale in Via Antonio e Leonida Valentini, n. 11, 47922, Rimini (RN), P. IVA 04297510408, in persona del legale rappresentate pro tempore, in qualità di TITOLARE DEL TRATTAMENTO, La informa ai sensi dell’art. 13 del Regolamento UE n. 2016/679 (in seguito “GDPR”) che i dati da Lei forniti saranno trattati con le modalità e per le finalità seguenti:
    <br>
    1. <b>Quali dati trattiamo se utilizzerai Quoto?</b>
    <br>
Per poter utilizzare Quoto per gestire i check-in online, dobbiamo trattare i tuoi dati personali identificativi (ragione sociale, P. Iva, nome dell’amministratore della società, indirizzo, dati relativi alle modalità di pagamento, ecc.). 
<br>
Se invece ti limiterai a navigare sul nostro sito
<br>
    2. <b>Perché dobbiamo trattare i tuoi dati personali e come lo facciamo?</b>
    <br>
a. I tuoi dati personali sono trattati nel rispetto della normativa europea che li tutela (Reg. UE 2016/679, o anche detto GDPR). Il Regolamento ci permette di trattare i tuoi dati senza richiederti il consenso e questo perché ci occorrono per le finalità di seguito indicate:
<br>      
    ◦ Concludere il contratto per l’utilizzo di Quoto;
    <br>
    ◦ Adempiere gli obblighi precontrattuali, contrattuali e fiscali derivanti da rapporti con te in essere;
    <br>
    ◦ Esercitare i nostri diritti (ad esempio: gestione tesoreria, diritto di difesa in giudizio, ecc.).
    <br>
b. Inoltre, tratteremo il tuo indirizzo email e la ragione sociale per inviarti inviarti via e-mail, contatti telefonici, newsletter e materiale informativo sulle funzionalità di Quoto e sulle offerte a te dedicate per il suo acquisto. Il GDPR ci permette di inviarti queste comunicazioni sulla base del legittimo interesse (art. 6, lett. f), quindi non dovrai darci il tuo consenso; ricorda sempre, però, che potrai chiedere di essere rimosso dalla mailing list in ogni momento (diritto di opt-out). 
<br>    
3. <b>Cosa succede se non ci fornisci i tuoi dati personali per le finalità dette sopra?</b>
<br>
I dati che ci rilasci e indicati al precedente punto 2 sono trattati senza il tuo consenso per le ragioni su indicate: il rifiuto alla concessione dei dati per il punto 2.a non ci permette di lasciarti utilizzare Quoto, il rifiuto al rilascio dei dati di cui al punto 2.b non pregiudica l’utilizzo di Quoto ma senza i tuoi dati non potremo inviarti comunicazioni commerciali riguardanti le offerte a te riservate per l’acquisto del nostro software. 
<br> 
4. <b>Cosa facciamo con i tuoi dati e chi li tratta?</b>
<br>
I tuoi dati vengono raccolti, registrati, organizzati, strutturati, conservati, adattati o modificati, estratti, consultati, utilizzati comunicati con diverse modalità, limitati, cancellati, distrutti. Per fare queste operazioni ci avvaliamo di nostri collaboratori autorizzati a farlo e istruiti sul fatto che i tuoi dati devono essere utilizzati solo per le finalità che ti abbiamo descritto al punto 2 e rispettando scrupolosamente i principi di riservatezza e di sicurezza richiesti dalle norme applicabili.
<br>  
5. <b>Chi accede ai dati?</b>
<br>
I tuoi dati possono essere accessibili ai nostri collaboratori e dipendenti e/o a società terze o altri soggetti esterni a Network Service Srl (ad esempio: studi professionali, consulenti, software house che forniscono i gestionali, ecc.) che svolgono attività in outsourcing per nostro conto, nella loro qualità di responsabili esterni del trattamento. L’elenco aggiornato delle persone che vedono i tuoi dati è disponibile presso la nostra sede.
<br>
6. <b>A chi comunichiamo i tuoi dati?</b>
<br>
Qualora fosse richiesto possiamo comunicare i tuoi dati a Pubblica Amministrazione, Organismi di Vigilanza e/o Autorità Giudiziarie nonché a tutti gli altri soggetti ai quali la comunicazione sia obbligatoria o necessaria per legge. I tuoi dati non saranno diffusi.
<br>
7. <b>Trasferimento di dati</b>
<br>
I tuoi dati personali sono archiviati in data base localizzati in Italia e a San Marino. La Repubblica di San Marino ha una propria legge sulla protezione dei dati personali (L. 171/2018) che è ritenuta garanzia idonea per tutelare i tuoi dati, anche se fuori dall’Unione europea.
<br>
8. <b>Quanto tempo conserviamo i tuoi dati?</b>
<br>
I tuoi dati personali che ci occorrono le gli adempimenti contabili sono conservati per 10 anni dal momento dell’ultima registrazione (art. 2220 cc). Il tu indirizzo email verrà conservato per 36 mesi dalla data dell’ultima interazione con le nostre newsletter e/o i servizi che ti offriamo. Ti evidenziamo che i sistemi informativi impiegati per la gestione delle informazioni raccolte sono configurati, sin dall’origine, in modo da minimizzare l’utilizzo dei dati personali. 
<br> 
9. <b>Diritti dell’interessato</b>
<br>
Ai sensi degli articoli da 15 a 22 del Reg. UE n. 679/2016, puoi: a) ottenere la conferma dell'esistenza di trattamenti di dati personali che ti riguardano e, in tal caso, l’acceso a tali dati; b) ottenere la rettifica dei dati personali inesatti e l’integrazione dei dati personali incompleti; c) ottenere la cancellazione dei dati personali che ti riguardano, nei casi in cui ciò sia consentito dal Regolamento; d) la limitazione del trattamento, nelle ipotesi previste dal Regolamento; e) ottenere la comunicazione, ai destinatari cui siano stati trasmessi i dati personali, delle richieste di rettifica/cancellazione dei dati personali e di limitazione del trattamento che ci farai pervenire, salvo che ciò si riveli impossibile o implichi per noi uno sforzo sproporzionato; f) ricevere, in un formato strutturato, di uso comune e leggibile da dispositivo automatico, dei dati personali fornitici, nonché la trasmissione degli stessi a un altro titolare del trattamento, e ciò in qualsiasi momento; g) opporsi in qualsiasi momento, per motivi connessi alla tua situazione particolare, al trattamento dei dati personali che ti riguardano ai sensi dell’articolo 6, paragrafo 1, lettere e) o f), compresa la profilazione sulla base di tali disposizioni. Con riferimento alle finalità di cui al punto 2.b hai il diritto di opporti in qualsiasi momento al trattamento dei dati personali che ti riguardano; h) non essere sottoposto a una decisione basata unicamente sul trattamento automatizzato, compresa la profilazione, che produca effetti giuridici che ti riguardano o che incida in modo analogo significativamente sulla tua persona; i) proporre reclamo a un’autorità di controllo ai sensi dell’art. 77.
<br> 
10. <b>Modalità di esercizio dei diritti</b>
<br>
Potrà in qualsiasi momento esercitare i diritti contattando il Titolare al seguente indirizzo e-mail: info@network-service.it
<br>
La presente informativa è aggiornata alla data del 18/06/2020
<br><br>
<b>INFORMATIVA PRIVACY AI SENSI DEGLI ARTT. 13 E 14 DEL REGOLAMENTO UE 2016/679 (GDPR)</b>
<br><br>
<b>PRIVACY POLICY</b>
<br><br>
1. <b>Titolare del trattamento</b>
<br>
Il Titolare del trattamento dei dati raccolti tramite questo sito è NETWORK SERVICE S.R.L., avente sede legale in Via Antonio e Leonida Valentini, n. 11, 47922, Rimini (RN), P. IVA 04297510408  (nel proseguo anche il “Titolare”). La lista aggiornata degli autorizzati al trattamento e dei responsabili esterni è disponibile presso la sede del Titolare.
<br>
2. <b>Finalità e base giuridica del trattamento</b>
<br><br>
<b>SITO WEB</b>
<table style="width:100%">
    <tr>
        <td style="width:70%"><b>FINALITÀ</b></td>
        <td style="width:30%"><b>BASE GIURIDICA</b></td>
    </tr>
    <tr>
        <td>Raccolta di dati e informazioni in forma esclusivamente aggregata e anonima al fine di verificare il corretto funzionamento del sito. Nessuna di queste informazioni è correlata alla persona fisica-utente del sito, e non ne consentono in alcun modo l'identificazione. </td>
        <td>Legittimo interesse del Titolare (statistica e funzionamento del sito), non occorre consenso.</td>
    </tr>
    <tr>
        <td>Eventuale raccolta di dati e informazioni al fine di tutelare la sicurezza del sito (filtri antispam, firewall, rilevazione virus) e degli Utenti e per prevenire o smascherare frodi o abusi a danno del sito web. I dati sono registrati automaticamente e possono eventualmente comprendere anche dati personali (indirizzo IP) che potrebbero essere utilizzati, conformemente alle leggi vigenti in materia, al fine di bloccare tentativi di danneggiamento al sito medesimo o di recare danno ad altri utenti, o comunque attività dannose o costituenti reato. Tali dati non sono mai utilizzati per l'identificazione o la profilazione dell'Utente e vengono cancellati periodicamente.</td>
        <td>Legittimo interesse del Titolare (sicurezza del sito), non occorre consenso.</td>
    </tr>
    <tr>
        <td>Raccolta di dati ai fini di analisi ed elaborazione di informazioni relative all'utente, alle sue preferenze, abitudini, scelte di consumo e/o esperienze di navigazione. Tale attività viene effettuata anche mediante l’utilizzo di tecnologie quali i cookie (propri o di terze parti). La raccolta dei dati mediante utilizzo dei cookie avviene dietro consenso espresso tramite apposito banner, oppure mediante l’uso o la consultazione del sito, quale comportamento concludente. </td>
        <td>Consenso dell’interessato</td>
    </tr>
</table>
<br>
<b>EROGAZIONE DEL SERVIZIO</b>
<table style="width:100%">
    <tr>
        <td style="width:70%"><b>FINALITÀ</b></td>
        <td style="width:30%"><b>BASE GIURIDICA</b></td>
    </tr>
    <tr>
        <td>Raccolta di dati (es. nome, cognome, e-mail, ecc.) per erogazione del servizio </td>
        <td>Attuazione misure contrattuali e precontrattuali per finalità connesse alla richiesta dell’utente [VEDI INFORMATIVA PER I CLIENTI DI QUOTO]</td>
    </tr>
</table>
<br>
<b>COMUNICAZIONI E NEWSLETTER</b>
<table style="width:100%">
    <tr>
        <td style="width:70%"><b>FINALITÀ</b></td>
        <td style="width:30%"><b>BASE GIURIDICA</b></td>
    </tr>
    <tr>
        <td>Invio di newsletter e materiale commerciale/informativo ai nostri clienti</td>
        <td>Legittimo interesse del titolare, non occorre consenso (direct marketing)</td>
    </tr>
</table>
<br>
3. <b>Consenso e conseguenze del rifiuto</b>
<br>
Per i dati raccolti dal sito web: con l'uso o la consultazione del sito i visitatori e gli utenti approvano la presente informativa privacy e acconsentono al trattamento dei loro dati personali in relazione alle modalità e alle finalità di seguito descritte, compresa l'eventuale comunicazione a terzi se necessaria per l'erogazione di un servizio. Il conferimento dei dati e quindi il consenso alla raccolta e al trattamento dei dati è facoltativo, l'Utente può negare il consenso e può revocare in qualsiasi momento un consenso già fornito (tramite le impostazioni del browser per i cookie). Tuttavia negare il consenso può comportare l'impossibilità di erogare alcuni servizi e l'esperienza di navigazione nel sito sarebbe compromessa.  
<br>
Erogazione del servizio: la raccolta dati per l’erogazione dei servizi richiesti con la compilazione degli appositi moduli ha come base giuridica l’esecuzione di un rapporto precontrattuale e/o contrattuale con il Titolare, per finalità connesse alla richiesta dell’interessato. Pertanto non necessita di consenso. In assenza di tali dati non sarà possibile erogare il servizio richiesto.
<br>
Comunicazioni e newsletter: la ricezione di comunicazioni e newsletter a soggetti già clienti del Titolare ha come base giuridica il legittimo interesse (direct marketing o soft spam) con diritto di opt-out per l’interessato. Ricordiamo che il consenso è sempre revocabile e, per l’esercizio di detto diritto, l’interessato potrà inviare una e-mail a info@network-service.it comunicando di non voler più ricevere le comunicazioni in oggetto. 
<br>
4. <b>Modalità di trattamento dei dati personali</b>
<br>
Il trattamento dei tuoi dati avviene mediante l’utilizzo di strumenti e procedure idonee a garantirne la sicurezza e la riservatezza, e può essere effettuato sia tramite il nostro sito web che attraverso altri strumenti elettronici, e talvolta anche con l'ausilio di supporti cartacei. Oltre al Titolare, in alcuni casi, potrebbero avere accesso ai Dati altri soggetti coinvolti nell’organizzazione di questo Sito Web (personale amministrativo, commerciale, amministratori di sistema, ecc.) ovvero soggetti esterni (come fornitori di servizi tecnici terzi, hosting provider, società informatiche, agenzie di comunicazione) nominati, nelle ipotesi previste dalla normativa, Responsabili del Trattamento da parte del Titolare. L’elenco aggiornato dei Responsabili potrà sempre essere richiesto al Titolare del Trattamento.
<br>
5. <b>Periodo di conservazione dei dati</b>
<br>
Dati raccolti dal  sito: i dati raccolti dal sito durante il suo funzionamento sono conservati per il tempo strettamente necessario a svolgere le attività precisate. Alla scadenza i dati saranno cancellati o anonimizzati, a meno che non sussistano ulteriori finalità per la conservazione degli stessi. Il Titolare non ha alcun controllo sui cookie interamente gestiti dalle terze parti e non ha accesso alle informazioni raccolte tramite detti cookie. Per maggiori dettagli sulla conservazione dei dati raccolti mediante cookie  si rimanda alla cookie policy.
<br>
Dati inseriti nei moduli di contatto e/o richiesta di servizi: 10 anni dalla iscrizione a Quoto.
<br>
6. <b>Trasferimento di dati verso Paesi/organizzazioni extra UE</b>
<br>
La informiamo che i tuoi dati personali sono trasferiti a San Marino (RSM) e negli Stati Uniti (Google). Entrambi i Paesi prestano garanzie idonee alla tutela del dato (rispettivamente L. 171/2018 e Privacy Shield). 
<br>
7. <b>Accesso e comunicazione dei dati</b>
<br>
I Suoi dati potranno essere resi accessibili ai dipendenti e collaboratori del Titolare nella loro qualità di incaricati del trattamento e/o amministratori di sistema; a società terze o altri soggetti (a titolo indicativo: studi professionali, consulenti, software house che forniscono i gestionali, istituti di credito, assicurazioni, ecc.) che svolgono attività in outsourcing per conto del Titolare, nella loro qualità di responsabili esterni del trattamento.
<br>
Il Titolare potrà comunicare i Suoi dati a Pubblica Amministrazione, Organismi di Vigilanza e/o Autorità Giudiziarie nonché a tutti gli altri soggetti ai quali la comunicazione sia obbligatoria o necessaria per legge. I Suoi dati non saranno diffusi.
<br>
8. <b>Modalità di trattamento</b>
<br>
Il trattamento dei Suoi dati personali è realizzato per mezzo delle operazioni indicate all’art. 4 n. 2) GDPR, e precisamente: raccolta, registrazione, organizzazione, strutturazione, conservazione, adattamento o modifica, estrazione, consultazione, uso, comunicazione mediante trasmissione, raffronto o interconnessione, limitazione, cancellazione e distruzione dei dati. I suoi dati personali sono sottoposti a trattamento sia cartaceo che elettronico. Il trattamento è svolto da incaricati e collaboratori nell’ambito delle rispettive funzioni ed in conformità alle istruzioni ricevute, sempre e soltanto per il conseguimento delle specifiche finalità rispettando scrupolosamente i principi di riservatezza e di sicurezza richiesti dalle norme applicabili.
<br>
9. <b>Diritti dell’interessato</b>
<br>
Ai sensi degli articoli da 15 a 22 del Reg. UE n. 679/2016, all’Interessato è conferita la possibilità di esercitare specifici diritti. In particolare, l'Interessato ha diritto a: a) ottenere la conferma dell'esistenza di trattamenti di dati personali che lo riguardano e, in tal caso, l’acceso a tali dati; b) ottenere la rettifica dei dati personali inesatti e l’integrazione dei dati personali incompleti; c) ottenere la cancellazione dei dati personali che lo riguardano, nei casi in cui ciò sia consentito dal Regolamento; d) la limitazione del trattamento, nelle ipotesi previste dal Regolamento; e) ottenere la comunicazione, ai destinatari cui siano stati trasmessi i dati personali, delle richieste di rettifica/cancellazione dei dati personali e di limitazione del trattamento pervenute dall’Interessato, salvo che ciò si riveli impossibile o implichi uno sforzo sproporzionato; f) ricevere, in un formato strutturato, di uso comune e leggibile da dispositivo automatico, dei dati personali forniti al Titolare, nonché la trasmissione degli stessi a un altro titolare del trattamento, e ciò in qualsiasi momento, anche alla cessazione dei rapporti eventualmente intrattenuti col Titolare; g) opporsi in qualsiasi momento, per motivi connessi alla sua situazione particolare, al trattamento dei dati personali che lo riguardano ai sensi dell’articolo 6, paragrafo 1, lettere e) o f), compresa la profilazione sulla base di tali disposizioni. Qualora i dati personali siano trattati per finalità di marketing diretto, l’interessato ha il diritto di opporsi in qualsiasi momento al trattamento dei dati personali che lo riguardano effettuato per tali finalità, compresa la profilazione nella misura in cui sia connessa a tale marketing diretto; h) non essere sottoposto a una decisione basata unicamente sul trattamento automatizzato, compresa la profilazione, che produca effetti giuridici che lo riguardano o che incida in modo analogo significativamente sulla sua persona; i) proporre reclamo a un’autorità di controllo ai sensi dell’art. 77. Le richieste di cui ai punti precedenti dovranno essere inviate via e-mail all’indirizzo del titolare del trattamento: info@network-service.it
<br>
10. <b>Tutela della privacy dei minori</b>
<br>
Il presente Sito Web si rivolge a un pubblico generico, tuttavia i suoi servizi sono destinati a persone di età pari o superiore a 18 anni. La Società non richiede, raccoglie, utilizza e divulga deliberatamente dati personali forniti da persone di età inferiore a 18 anni online. Qualora la Società venga a sapere di aver raccolto personalmente dati di un minore, li cancellerà.
<br>
11. <b>Aggiornamenti</b>
<br>
La presente privacy policy è aggiornata alla data del 22/06/2020
<br><br>
<b>COOKIE POLICY</b>
<br><br>
1. <b>Cosa sono i cookie?</b>
<br>
Come chiarito dal Garante Privacy nelle FAQ del dicembre 2012, i cookie sono “piccoli file di testo” – formati da lettere e numeri - “che i siti visitati dall'utente inviano al suo terminale (solitamente al browser), dove vengono memorizzati per essere poi ritrasmessi agli stessi siti alla successiva visita del medesimo utente”. I cookie hanno la funzione di snellire l'analisi del traffico sul web o di segnalare quando un sito specifico o una parte di esso vengono visitati, di distinguere tra loro i visitatori per poter fornire contenuti personalizzati, ed aiutano gli amministratori a migliorare il sito e l’esperienza di navigazione degli utenti stessi. Attraverso i cookie non possiamo accedere ad altre informazioni memorizzate sul vostro dispositivo, anche se è qui che i cookie vengono scaricati. I cookie non possono caricare codici di alcun tipo, veicolare virus o malware e non sono dannosi per il terminale dell’utente.
<br>
Di seguito è possibile trovare tutte le informazioni sui cookie installati attraverso questo sito, e le indicazioni necessarie su come gestire le proprie preferenze a riguardo.
<br>
2. <b>Consenso dell’utente all’uso dei cookie</b>
<br>
Collegandosi per la prima volta ad una qualunque pagina del Sito l’utente vedrà apparire un banner informativo sull’utilizzo dei cookie. Chiudendo tale informativa tramite l’apposito tasto o cliccando al di fuori del banner che la contiene e proseguendo nella navigazione, l’utente acconsente al nostro utilizzo dei cookie, secondo le modalità descritte nella presente Cookie Policy.
<br>
Il sito ricorda la scelta effettuata dall’utente, pertanto l’informativa breve non verrà riproposta nei collegamenti successivi dallo stesso dispositivo. Tuttavia, l’utente ha sempre la possibilità di revocare in tutto o in parte il consenso già espresso.
<br>
Questo sito installa solamente cookie tecnici, ovvero cookie utili per la sicurezza dell’utente e del titolare del sito web stesso. Per l’installazione di questi cookie non è necessario il consenso dell’utente, pertanto non appariranno banner in calce al sito che avvisano dell’esistenza dei cookie. In questa policy puoi vedere quali cookie tecnici sono stati installati, la loro funzionalità e la relativa durata. Puoi sempre impedire l’installazione di questi cookie ma in tal caso le funzionalità del sito verranno compromesse rendendo molto difficile la navigazione. Qualora si riscontrassero problemi di natura tecnica legati alla prestazione del consenso, vi preghiamo di contattarci tramite gli appositi canali previsti da questo sito per consentici di prestarvi assistenza.
<br>
3. <b>Durata dei cookie</b>
<br>
I cookie possono essere:
<br>
    di sessione, cookie che vengono memorizzati in modo persistente sul computer dell’utente e si cancellano con la chiusura del browser, sono strettamente limitati alla trasmissione di identificativi di sessione necessari per consentire l’esplorazione sicura ed efficiente del sito evitando il ricorso ad altre tecniche informatiche potenzialmente pregiudizievoli per la riservatezza della navigazione degli utenti;
    <br>
    persistenti, cookie che rimangono memorizzati sul disco rigido del computer fino alla loro scadenza o cancellazione da parte degli utenti/visitatori. Tramite i cookie persistenti i visitatori che accedono al sito (o eventuali altri utenti che impiegano il medesimo computer) vengono automaticamente riconosciuti ad ogni visita. I visitatori possono impostare il browser del computer in modo tale che accetti/rifiuti tutti i cookie o visualizzi un avviso ogni qual volta viene proposto un cookie, per poter valutare se accettarlo o meno. L’utente può, comunque, modificare la configurazione predefinita e disabilitare i cookie (cioè bloccarli in via definitiva), impostando il livello di protezione più elevato.
    <br>

4. <b>Tipologia dei cookie</b>
<br>
I cookie possono essere:
<br>
    di prima parte, ovvero cookie che riportano come dominio il presente sito web;
    <br>
    di terza parte, ovvero cookie che sono relativi a domini esterni.
    <br>
I cookie di terza parte sono necessariamente installati da un soggetto esterno, sempre definito come "terza parte", non gestito dal sito.
<br>
4. <b>Natura dei cookie</b>
<br>
Relativamente alla natura dei cookie, ne esistono di diversi tipi:
<br>
- Cookie tecnici: sono quelli utilizzati al solo fine di "effettuare la trasmissione di una comunicazione su una rete di comunicazione elettronica, o nella misura strettamente necessaria al fornitore di un servizio della società dell'informazione esplicitamente richiesto dall'abbonato o dall'utente a erogare tale servizio" (cfr. art. 122, comma 1, del Codice).
<br>
Essi non vengono utilizzati per scopi ulteriori e sono normalmente installati direttamente dal titolare o gestore del sito web. Possono essere suddivisi in:
<br>
    cookie di navigazione o di sessione, che garantiscono la normale navigazione e fruizione del sito web (permettendo, ad esempio, di realizzare un acquisto o autenticarsi per accedere ad aree riservate); essi sono di fatto necessari per il corretto funzionamento del sito;
    <br>
    cookie analytics, assimilati ai cookie tecnici laddove utilizzati direttamente dal gestore del sito per raccogliere informazioni, in forma aggregata, sul numero degli utenti e su come questi visitano il sito stesso, al fine di migliorare le performance del sito;
    <br>
    cookie di funzionalità, che permettono all'utente la navigazione in funzione di una serie di criteri selezionati (ad esempio, la lingua, i prodotti selezionati per l'acquisto) al fine di migliorare il servizio reso allo stesso. Per l'installazione di tali cookie non è richiesto il preventivo consenso degli utenti (più informazioni nel paragrafo Gestione dei cookie in basso).
    <br>

- Cookie di profilazione: sono volti a creare profili relativi all'utente e vengono utilizzati al fine di inviare messaggi pubblicitari in linea con le preferenze manifestate dallo stesso nell'ambito della navigazione in rete. Per l'utilizzo dei cookie di profilazione è richiesto il consenso dell'interessato. In caso di cookie di terze parti, il sito non ha un controllo diretto dei singoli cookie e non può controllarli (non può né installarli direttamente né cancellarli). Puoi comunque gestire questi cookie attraverso le impostazioni del browser (segui le istruzioni riportate più avanti), o i siti indicati nella sezione "Gestione dei cookie".
<br>

5. <b>Cookie presenti su questo sito</b>
<br>
Utilizziamo i cookie per personalizzare contenuti ed annunci, per fornire funzionalità dei social media e per analizzare il nostro traffico. Condividiamo inoltre informazioni sul modo in cui utilizza il nostro sito con i nostri partner che si occupano di analisi dei dati web, pubblicità e social media, i quali potrebbero combinarle con altre informazioni che ha fornito loro o che hanno raccolto dal suo utilizzo dei loro servizi.
<br>
Alcuni cookie sono collocati da servizi di terzi che compaiono sulle nostre pagine. Questo sito non ha alcun controllo sui cookie interamente gestiti dalle terze parti e non ha accesso alle informazioni raccolte tramite detti cookie. Le informazioni sull'uso dei cookie di terze parti e sulle finalità degli stessi, nonché sulle modalità per l'eventuale disabilitazione, sono fornite direttamente dalle terze parti sui siti delle terze parti stesse.
<br>
Si rammenta che generalmente il tracciamento degli utenti non comporta identificazione dello stesso, a meno che l'Utente non sia già iscritto al servizio e non sia anche già loggato, nel qual caso si intende che l'Utente ha già espresso il suo consenso direttamente alla terza parte al momento dell'iscrizione al relativo servizio (es. Facebook).
<br><br>
Di seguito l’elenco dei cookie presenti sul sito:
<br>
<table style="width:100%">
    <tr>
        <td><b>NOME COOKIE</b></td>
        <td><b>TIPOLOGIA COOKIE (DI SESSIONE, PROFILAZIONE, ANALYTICS)</b></td>
        <td><b>FUNZIONALITÀ</b></td>
        <td><b>TEMPO DI DURATA</b></td>
    </tr>
    <tr>
        <td>primo ingresso</td>
        <td>sessione</td>
        <td>modal</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td>PHPSESSID</td>
        <td>sessione</td>
        <td>tecnico</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td>supp.visit</td>
        <td>terze parti</td>
        <td>chat esterna</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td>ssup.vid</td>
        <td>terze parti</td>
        <td>chat esterna</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td colspan="4">LANDING offerta.quoto.online</td>
    </tr>
    <tr>
        <td>_ga</td>
        <td>analytics</td>
        <td>tracciamento</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td>_gclau</td>
        <td>analytics</td>
        <td>tracciamento</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td>_gat_UA-xxxxxxxx</td>
        <td>analytics</td>
        <td>tracciamento</td>
        <td>alla fine della sessione</td>
    </tr>
    <tr>
        <td>_gid</td>
        <td>analytics</td>
        <td>tracciamento</td>
        <td>alla fine della sessione</td>
    </tr>
</table>
<br>
6. <b>Disabilitazione cookie</b>
<br>
L'utente può rifiutare l'utilizzo dei cookie e in qualsiasi momento può revocare un consenso già fornito. Poiché i cookie sono collegati al browser utilizzato, possono essere disabilitati direttamente dal browser, così rifiutando/revocando il consenso all'uso dei cookie.
                                                </div>
                                                <style>                                                  
                                                  .modal { 
                                                            max-width:980px !important;
                                                            font-size:14px !important;
                                                    } 
                                                    .modal b{
                                                            font-weight:600;
                                                    }
                                                    .modal th, td {
                                                        padding: 5px;
                                                        border:1px solid;
                                                    }
                                                </style>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> 
                                                </span>
                                                <div class="ca"></div>


                                                <input name="data_start_hospitality" type="hidden" id="data_start_hospitality" value="<?=$oggi?>" />
                                                <input name="data_end_hospitality" type="hidden" id="data_end_hospitality" value="<?=$UnAnnoDopo?>" />
                                                <input name="action" type="hidden" id="action" value="registra" />
                                                <input name="servizi_attivi" type="hidden" id="servizi_attivi" value="Promo Check-in Online Omaggio" />
                                                <input name="idanagra" type="hidden" id="idanagra" value="<?=getNewIdAnagra()?>" />
                                                <input name="idsito" type="hidden" id="idsito" value="<?=getNewIdSito()?>" />
                                                <input name="idutente" type="hidden" id="idutente" value="<?=getNewIdUtente()?>" />
                                                <button type="submit" id="pulsante-invio">Entra in QUOTO!</button>

                            </div>

                            <div class="ca20"></div>
                            <div class="text-right"><a href="<?=BASE_URL_SITO?>login.php">&larr; Torna al login!</a></div>



                    </form>
                </div>
                <div class="ca"></div>
            </div>
        </div>
        <div class="ca50 m-m-0"></div>
        <div class="ca50 m-m-0"></div>
    </div>

    <div class="m m-x-12 bcolor2">
        <div class="box3 m-x-tc t30">
            <img src="<?=BASE_URL_SITO?>registrazione/img/logo.jpg" alt="">
            <div class="ca20"></div>
            A cosa serve Quoto! ? La risposta nel video.
        </div>
        <div class="m m-x-3 m-x-h100 m-xl-2 m-l-1 m-m-0"></div>
        <div class="m m-x-3 m-x-tc m-xl-4 m-l-5 m-m-6 m-s-12 m-s-tc video-eq">
            <div class="boxstep CONTvideo"><iframe width="100%" height="100%"
                    src="https://www.youtube.com/embed/sH-dI5BkljY?rel=0&showinfo=0" frameborder="0"
                    allow="accelerometer;  encrypted-media; gyroscope;" allowfullscreen></iframe></div>
        </div>
        <div class="m m-x-3 m-x-tl m-xl-4 m-l-5 m-m-6 m-s-12 m-s-tc video-eq">
            <div class="boxstep">
                <div class="t20 roboto">Capitalizza al massimo le tue richieste in un soggiorno venduto! </div>
                <div class="ca20"></div>
                Piu' richieste converti e meno spendi in ADS, è un gioco di numeri.
            </div>
        </div>
        <div class="ca50"></div>
    </div>

    <div class="m m-x-12">
        <div class="ca50"></div>
        <div class="m m-x-12">
            <div class="boxstep t40 tcolor roboto m-x-tc">
                <div class="t12 tcolor">STEPS</div>
                <div class="ca10"></div>
                Ecco le principali caratteristiche del CRM Quoto!:
            </div>
        </div>

        <div class="m m-x-6 m-eq1 dx m-s-0"></div>
        <div class="m m-x-3 m-eq1 m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc">
            <div class="boxstep">
                <div class="bollinosx">1</div>
                <div class="roboto">Step 1 - Preventivi Effetto "woow"</div>
                <div class="ca20"></div>
                <div class="t15">La prima impressione non si scorda mai, per questo inviare un preventivo funzionale ed
                    emozionale in
                    pochissimi secondi è un primo passo per la conversione delle richieste soggiorno.</div>
            </div>
        </div>
        <div class="ca"></div>

        <div class="m m-x-3 m-xl-2 m-l-1 m-m-0 m-eq2"></div>
        <div class="m m-x-3 m-x-tr m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc m-eq2 dx">
            <div class="boxstep">
                <div class="bollinodx">2</div>
                <div class="roboto">Step 2 - Comunicazione in Chat </div>
                <div class="ca20"></div>
                <div class="t15">Non solo prima, ma anche dopo aver
                    inviato il preventivo è fondamentale comunicare con il cliente per soddisfare tutte le sue esigenze,
                    con
                    la Chat di Quoto! è semplicissimo!</div>
            </div>
        </div>
        <div class="ca"></div>

        <div class="m m-x-6 m-s-0 m-eq3 dx"></div>
        <div class="m m-x-3 m-eq3 m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc">
            <div class="boxstep">
                <div class="bollinosx">3</div>
                <div class="roboto">Step 3 - Automatizza le cominicazioni</div>
                <div class="ca20"></div>
                <div class="t15">Ci sono attività ripetitive e vanno automatizzate come i recall via mail sulle scadenze
                    dei preventivi o
                    sull'invio degli acconti, ci sono mail di pre stay piuttosto che l'invio di un questionario, ci
                    pensa
                    Quoto!</div>
            </div>
        </div>
        <div class="ca"></div>

        <div class="m m-x-3 m-xl-2 m-l-1 m-m-0 m-eq4"></div>
        <div class="m m-x-3 m-x-tr m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc m-eq4 dx">
            <div class="boxstep">
                <div class="bollinodx">4</div>
                <div class="roboto">Step 4 - Ricevi pagamenti in ambiente sicuro</div>
                <div class="ca20"></div>
                <div class="t15">Per gli acconti del soggiorno, nessun problema, il cliente oltre al bonifico potrà
                    inviare al tuo Hotel
                    un pagamento attraverso i piu' diffusi sistemi di pagamento sicuro come Paypal, oppure attraverso il
                    tuo
                    gateway bancario</div>
            </div>
        </div>
        <div class="ca"></div>

        <div class="m m-x-6 m-eq5 dx m-s-0"></div>
        <div class="m m-x-3 m-eq5 m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc">
            <div class="boxstep">
                <div class="bollinosx">5</div>
                <div class="roboto">Step 5 - Migiora il servizio del tuo Hotel</div>
                <div class="ca20"></div>
                <div class="t15">Quanto è bello migliorare il servizio e prevenire una recensione negativa? Bhè
                    con il sistema di "customer satisfaction" tutto questo è possibile.</div>
            </div>
        </div>
        <div class="ca"></div>

        <div class="m m-x-3 m-xl-2 m-l-1 m-m-0 m-eq6"></div>
        <div class="m m-x-3 m-x-tr m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc m-eq6 dx">
            <div class="boxstep">
                <div class="bollinodx">6</div>
                <div class="roboto">Step 6 - Migliora il servizio e la reputazione</div>
                <div class="ca20"></div>
                <div class="t15">Quanto è bello migliorare il servizio e prevenire una recensione negativa? Bhè con il
                    sistema di
                    "customer satisfaction" tutto questo è possibile.</div>
            </div>
        </div>
        <div class="ca"></div>

        <div class="m m-x-6 m-s-0 m-eq7 dx"></div>
        <div class="m m-x-3 m-eq7 m-xl-4 m-l-5 m-m-6 m-s-12 m-s-ha m-s-tc">
            <div class="boxstep">
                <div class="bollinosx">7</div>
                <div class="roboto">Step 7 - Statistiche vendite / Campagne ADS</div>
                <div class="ca20"></div>
                <div class="t15">Se i numeri indicano la strada, nella sezione statistiche troverai molte
                    informazioni dettagliate sulle vendite, riuscirai anche a capire il ritorno degli investimenti sulle
                    singole campagne Facebook Ads e Google Ads.</div>
            </div>
        </div>
        <div class="ca"></div>

    </div>
    <div class="ca50"></div>
    <div class="m m-x-12 bcolor2">
        <div class="ca50 m-m-0"></div>
        <div class="m m-x-12 m-x-tc t40">
            <div class="box3">I nostri Albergatori che convertono, dicono di Quoto!</div>
        </div>
        <div class="m m-x-3 m-x-h100 m-xl-2 m-l-1 m-m-0"></div>
        <div class="m m-x-3 m-x-tr m-xl-4 m-l-5 m-m-6 m-s-12 m-s-tc">
            <div class="box3"><em class="t16">"Mi sono subito innamorata di Quoto e nonostante non sia interfacciabile
                    con il mio
                    channel manager l’ho voluto comprare … perché inviare un preventivo con Quoto è cool!<br>
                    Quoto non piace solo a noi. Piace anche ai nostri ospiti che hanno pure recensito su Tripadvisor il
                    nostro nuovo sistema d’invio dell’offerta."</em>
                <div class="ca50"></div>
                <div class="w700 tcolor2 roboto">Federica Dei Cas - Sales Manager<br>

                    Hotel Baita dei Pini - Bormio</div>
            </div>
        </div>
        <div class="m m-x-3 m-xl-4 m-l-5 m-m-6 m-s-12 m-s-tc">
            <div class="box3">
                <em class="t16">"Usiamo Quoto! da due anni, il problema principale che ci ha risolto è aumentare il
                    nostro tempo a
                    disposizione, è veramente molto veloce una volta configurato e presa manualità con lo strumento.
                    Inoltre elimina tutti gli errori di battitura e sviste varie, venendo da preventivi via Email a
                    "modelli".
                    <div class="ca5"></div>
                    Dal secondo anno poi puoi vedere un raffronto con l'anno precedente, per target, fonte di
                    prenotazione e fatturato. Molto utile!
                    <div class="ca5"></div>

                    Consiglio il sistema Quoto! con convinzione a chi, come me, si lamentava (ora non più!) del troppo
                    tempo dedicato ad inviare preventivi."</em>
                <div class="ca50"></div>
                <div class="w700 tcolor2 roboto">Gianluca Ricci - Sales Manager<br>

                    Hotel Raffaello</div>
            </div>
        </div>
    </div>

    <div class="m m-x-12">
        <div class="ca50"></div>
        <div class="m m-x-12 m-x-tc t30 w700">
            <div class="box3">Alcuni dei partner connessi:</div>
            <div class="ca10"></div>
            <img src="<?=BASE_URL_SITO?>registrazione/img/logo-5-stelle.jpg" alt="">
            <img src="<?=BASE_URL_SITO?>registrazione/img/logo-simple-booking.jpg" alt="">
            <img src="<?=BASE_URL_SITO?>registrazione/img/logo-parity-rate.jpg" alt="">
            <img src="<?=BASE_URL_SITO?>registrazione/img/logo-stripe.png" alt="">
            <div class="ca50"></div>
            <a href="#INFORMATIVA" rel="modal:open" class="privacybtn" title="Informativa, Privacy Policy e Cookie Policy">Informativa, Privacy Policy e Cookie Policy</a>
        <div class="ca50"></div>
    </div>
    <script>
        $(document).ready(function () {
            $("#licenza").click(function () {
                window.open('<?=BASE_URL_SITO?>licenza.html', 'licenza', 'toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=120');
            });
        });
    </script>
    
    <?php bannercookies();?>
        <div class="cookies">
            <b>COOKIE POLICY</b>
            <br><br>
            1. <b>Cosa sono i cookie?</b>
            <br>
            Come chiarito dal Garante Privacy nelle FAQ del dicembre 2012, i cookie sono “piccoli file di testo” – formati da lettere e numeri - “che i siti visitati dall'utente inviano al suo terminale (solitamente al browser), dove vengono memorizzati per essere poi ritrasmessi agli stessi siti alla successiva visita del medesimo utente”. I cookie hanno la funzione di snellire l'analisi del traffico sul web o di segnalare quando un sito specifico o una parte di esso vengono visitati, di distinguere tra loro i visitatori per poter fornire contenuti personalizzati, ed aiutano gli amministratori a migliorare il sito e l’esperienza di navigazione degli utenti stessi. Attraverso i cookie non possiamo accedere ad altre informazioni memorizzate sul vostro dispositivo, anche se è qui che i cookie vengono scaricati. I cookie non possono caricare codici di alcun tipo, veicolare virus o malware e non sono dannosi per il terminale dell’utente.
            <br>
            Di seguito è possibile trovare tutte le informazioni sui cookie installati attraverso questo sito, e le indicazioni necessarie su come gestire le proprie preferenze a riguardo.
            <br>
            2. <b>Consenso dell’utente all’uso dei cookie</b>
            <br>
            Collegandosi per la prima volta ad una qualunque pagina del Sito l’utente vedrà apparire un banner informativo sull’utilizzo dei cookie. Chiudendo tale informativa tramite l’apposito tasto o cliccando al di fuori del banner che la contiene e proseguendo nella navigazione, l’utente acconsente al nostro utilizzo dei cookie, secondo le modalità descritte nella presente Cookie Policy.
            <br>
            Il sito ricorda la scelta effettuata dall’utente, pertanto l’informativa breve non verrà riproposta nei collegamenti successivi dallo stesso dispositivo. Tuttavia, l’utente ha sempre la possibilità di revocare in tutto o in parte il consenso già espresso.
            <br>
            Questo sito installa solamente cookie tecnici, ovvero cookie utili per la sicurezza dell’utente e del titolare del sito web stesso. Per l’installazione di questi cookie non è necessario il consenso dell’utente, pertanto non appariranno banner in calce al sito che avvisano dell’esistenza dei cookie. In questa policy puoi vedere quali cookie tecnici sono stati installati, la loro funzionalità e la relativa durata. Puoi sempre impedire l’installazione di questi cookie ma in tal caso le funzionalità del sito verranno compromesse rendendo molto difficile la navigazione. Qualora si riscontrassero problemi di natura tecnica legati alla prestazione del consenso, vi preghiamo di contattarci tramite gli appositi canali previsti da questo sito per consentici di prestarvi assistenza.
            <br>
            3. <b>Durata dei cookie</b>
            <br>
            I cookie possono essere:
            <br>
                di sessione, cookie che vengono memorizzati in modo persistente sul computer dell’utente e si cancellano con la chiusura del browser, sono strettamente limitati alla trasmissione di identificativi di sessione necessari per consentire l’esplorazione sicura ed efficiente del sito evitando il ricorso ad altre tecniche informatiche potenzialmente pregiudizievoli per la riservatezza della navigazione degli utenti;
                <br>
                persistenti, cookie che rimangono memorizzati sul disco rigido del computer fino alla loro scadenza o cancellazione da parte degli utenti/visitatori. Tramite i cookie persistenti i visitatori che accedono al sito (o eventuali altri utenti che impiegano il medesimo computer) vengono automaticamente riconosciuti ad ogni visita. I visitatori possono impostare il browser del computer in modo tale che accetti/rifiuti tutti i cookie o visualizzi un avviso ogni qual volta viene proposto un cookie, per poter valutare se accettarlo o meno. L’utente può, comunque, modificare la configurazione predefinita e disabilitare i cookie (cioè bloccarli in via definitiva), impostando il livello di protezione più elevato.
                <br>

            4. <b>Tipologia dei cookie</b>
            <br>
            I cookie possono essere:
            <br>
                di prima parte, ovvero cookie che riportano come dominio il presente sito web;
                <br>
                di terza parte, ovvero cookie che sono relativi a domini esterni.
                <br>
            I cookie di terza parte sono necessariamente installati da un soggetto esterno, sempre definito come "terza parte", non gestito dal sito.
            <br>
            4. <b>Natura dei cookie</b>
            <br>
            Relativamente alla natura dei cookie, ne esistono di diversi tipi:
            <br>
            - Cookie tecnici: sono quelli utilizzati al solo fine di "effettuare la trasmissione di una comunicazione su una rete di comunicazione elettronica, o nella misura strettamente necessaria al fornitore di un servizio della società dell'informazione esplicitamente richiesto dall'abbonato o dall'utente a erogare tale servizio" (cfr. art. 122, comma 1, del Codice).
            <br>
            Essi non vengono utilizzati per scopi ulteriori e sono normalmente installati direttamente dal titolare o gestore del sito web. Possono essere suddivisi in:
            <br>
                cookie di navigazione o di sessione, che garantiscono la normale navigazione e fruizione del sito web (permettendo, ad esempio, di realizzare un acquisto o autenticarsi per accedere ad aree riservate); essi sono di fatto necessari per il corretto funzionamento del sito;
                <br>
                cookie analytics, assimilati ai cookie tecnici laddove utilizzati direttamente dal gestore del sito per raccogliere informazioni, in forma aggregata, sul numero degli utenti e su come questi visitano il sito stesso, al fine di migliorare le performance del sito;
                <br>
                cookie di funzionalità, che permettono all'utente la navigazione in funzione di una serie di criteri selezionati (ad esempio, la lingua, i prodotti selezionati per l'acquisto) al fine di migliorare il servizio reso allo stesso. Per l'installazione di tali cookie non è richiesto il preventivo consenso degli utenti (più informazioni nel paragrafo Gestione dei cookie in basso).
                <br>

            - Cookie di profilazione: sono volti a creare profili relativi all'utente e vengono utilizzati al fine di inviare messaggi pubblicitari in linea con le preferenze manifestate dallo stesso nell'ambito della navigazione in rete. Per l'utilizzo dei cookie di profilazione è richiesto il consenso dell'interessato. In caso di cookie di terze parti, il sito non ha un controllo diretto dei singoli cookie e non può controllarli (non può né installarli direttamente né cancellarli). Puoi comunque gestire questi cookie attraverso le impostazioni del browser (segui le istruzioni riportate più avanti), o i siti indicati nella sezione "Gestione dei cookie".
            <br>

            5. <b>Cookie presenti su questo sito</b>
            <br>
            Utilizziamo i cookie per personalizzare contenuti ed annunci, per fornire funzionalità dei social media e per analizzare il nostro traffico. Condividiamo inoltre informazioni sul modo in cui utilizza il nostro sito con i nostri partner che si occupano di analisi dei dati web, pubblicità e social media, i quali potrebbero combinarle con altre informazioni che ha fornito loro o che hanno raccolto dal suo utilizzo dei loro servizi.
            <br>
            Alcuni cookie sono collocati da servizi di terzi che compaiono sulle nostre pagine. Questo sito non ha alcun controllo sui cookie interamente gestiti dalle terze parti e non ha accesso alle informazioni raccolte tramite detti cookie. Le informazioni sull'uso dei cookie di terze parti e sulle finalità degli stessi, nonché sulle modalità per l'eventuale disabilitazione, sono fornite direttamente dalle terze parti sui siti delle terze parti stesse.
            <br>
            Si rammenta che generalmente il tracciamento degli utenti non comporta identificazione dello stesso, a meno che l'Utente non sia già iscritto al servizio e non sia anche già loggato, nel qual caso si intende che l'Utente ha già espresso il suo consenso direttamente alla terza parte al momento dell'iscrizione al relativo servizio (es. Facebook).
            <br><br>
            Di seguito l’elenco dei cookie presenti sul sito:
            <br>
            <table style="width:100%">
                <tr>
                    <td><b>NOME COOKIE</b></td>
                    <td><b>TIPOLOGIA COOKIE (DI SESSIONE, PROFILAZIONE, ANALYTICS)</b></td>
                    <td><b>FUNZIONALITÀ</b></td>
                    <td><b>TEMPO DI DURATA</b></td>
                </tr>
                <tr>
                    <td>primo ingresso</td>
                    <td>sessione</td>
                    <td>modal</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td>PHPSESSID</td>
                    <td>sessione</td>
                    <td>tecnico</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td>supp.visit</td>
                    <td>terze parti</td>
                    <td>chat esterna</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td>ssup.vid</td>
                    <td>terze parti</td>
                    <td>chat esterna</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td colspan="4">LANDING offerta.quoto.online</td>
                </tr>
                <tr>
                    <td>_ga</td>
                    <td>analytics</td>
                    <td>tracciamento</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td>_gclau</td>
                    <td>analytics</td>
                    <td>tracciamento</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td>_gat_UA-xxxxxxxx</td>
                    <td>analytics</td>
                    <td>tracciamento</td>
                    <td>alla fine della sessione</td>
                </tr>
                <tr>
                    <td>_gid</td>
                    <td>analytics</td>
                    <td>tracciamento</td>
                    <td>alla fine della sessione</td>
                </tr>
            </table>
            <br>
            6. <b>Disabilitazione cookie</b>
            <br>
            L'utente può rifiutare l'utilizzo dei cookie e in qualsiasi momento può revocare un consenso già fornito. Poiché i cookie sono collegati al browser utilizzato, possono essere disabilitati direttamente dal browser, così rifiutando/revocando il consenso all'uso dei cookie.
            <div id="close"><i class="fa fa-times-circle fa-3x"></i></div>
        </div>
    </body>
</html>
<?$db->disconnect();?>
