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
            $Cliente   = $ret['rag_soc'];

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

                $Ip               = $_REQUEST['Ip'];
                $Agent            = $_REQUEST['Agent'];


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

                $idutente                                   = $r['idutente'];
                $logo                                       = $r['logo'];

                $nome                                       = ucfirst($_REQUEST['nome']);
                $cognome                                    = ucfirst($_REQUEST['cognome']);
                $email                                      = $_REQUEST['email'];
                $telefono                                   = $_REQUEST['telefono'];

                //$arrivo                                     = $_REQUEST['data_arrivo'];
                /**
                 * * Ogni tanto da elementor la data formattata in italiano, non la prende
                 * * e la passa in formato YYYY-mm-dd
                 * * tramte questa espressione regolare se il bug dovresse capitare , la giro!!
                 */
                if(eregi("(0?[1-9]|[12][0-9]|3[01])/(0?[1-9]|1[012])/((19[0][1-9]|19[1-9][0-9])|(20[012][0-9]|20[3][0-7]))", $_REQUEST['data_arrivo'], $regs)){

                    $arrivo     = $_REQUEST['data_arrivo'];
                }else{

                    $dataA      = explode("-",$_REQUEST['data_arrivo']);

                    $arrivo     = $dataA[2].'/'.$dataA[1].'/'.$dataA[0];
                    
                }  
                   
                $partenza                                   = $_REQUEST['data_partenza'];
                
                $DataArrivo                                 = $_REQUEST['DataArrivo'];
                $DataPartenza                               = $_REQUEST['DataPartenza'];
                
                $TipoVacanza                                = $_REQUEST['TipoVacanza'];

                $adulti                                     = $_REQUEST['adulti'];
                $bambini                                    = $_REQUEST['bambini'];
                $bambini_eta                                = $_REQUEST['bambini_eta'];

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



                $BaseUrlSuiteweb = 'https://www.suiteweb.it/';

                $msg .= top_email($Hotel,$BaseUrlSuiteweb);

                $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                            <tr>
                                <td valign="top">
                                    <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$EmailHotel.'">Clicca qui per rispondere a: '.$Hotel.'</a></div>
                                </td>
                            </tr>
                        </table>';

                $msg .= '
                                    <img src="'.$BaseUrlSuiteweb.'v2/uploads/loghi_siti/' . $logo . '" alt="Logo Struttura">
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
                $msg .= ' </table>';


                if(isset($_REQUEST['TipoSoggiorno1']) && $_REQUEST['TipoSoggiorno1'] != ''){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno1']) && $_REQUEST['TipoSoggiorno1'] != ''){
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno1'] . '</td>
                                    ';
                        }
                        if (isset($_REQUEST['NumeroCamere1'])) {
                            if ($_REQUEST['NumeroCamere1']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>nr.</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumeroCamere1'] . '</td>
                                        ';
                            }
                        }
                        if (isset($_REQUEST['TipoCamere1'])) {
                            if ($_REQUEST['TipoCamere1']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['TipoCamere1'] . '</td>
                                        ';
                            }
                        }
                        if(isset($_REQUEST['NumAdulti1'])){
                            if ($_REQUEST['NumAdulti1']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti1']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini1'])){
                            if ($_REQUEST['NumBambini1']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini1']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_1'])){
                            if ($_REQUEST['EtaB1_1']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_1'] . ''.(isset($_REQUEST['EtaB1_2']) && $_REQUEST['EtaB1_2'] != ''?', '.$_REQUEST['EtaB1_2']:'').''.(isset($_REQUEST['EtaB1_3']) && $_REQUEST['EtaB1_3'] != ''?', '.$_REQUEST['EtaB1_3']:'').''.(isset($_REQUEST['EtaB1_4']) && $_REQUEST['EtaB1_4'] != ''?', '.$_REQUEST['EtaB1_4']:'').''.(isset($_REQUEST['EtaB1_5']) && $_REQUEST['EtaB1_5'] != ''?', '.$_REQUEST['EtaB1_5']:'').'</td>
                                ';
                            }
                        }
                        $msg .= ' </tr>';
                   
                    $msg .= '   </table>';
                }



                if(isset($_REQUEST['TipoSoggiorno2']) && $_REQUEST['TipoSoggiorno2'] != ''){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno2']) && $_REQUEST['TipoSoggiorno2'] != ''){
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno2'] . '</td>
                                    ';
                        }
                        if (isset($_REQUEST['NumeroCamere2'])) {
                            if ($_REQUEST['NumeroCamere2']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>nr.</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumeroCamere2'] . '</td>
                                        ';
                            }
                        }
                        if (isset($_REQUEST['TipoCamere2'])) {
                            if ($_REQUEST['TipoCamere2']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['TipoCamere2'] . '</td>
                                        ';
                            }
                        }
                        if(isset($_REQUEST['NumAdulti2'])){
                            if ($_REQUEST['NumAdulti2']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti2']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini2'])){
                            if ($_REQUEST['NumBambini2']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini2']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB2_1'])){
                            if ($_REQUEST['EtaB2_1']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB2_1'] . ''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != ''?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != ''?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB2_4']) && $_REQUEST['EtaB2_4'] != ''?', '.$_REQUEST['EtaB2_4']:'').''.(isset($_REQUEST['EtaB2_5']) && $_REQUEST['EtaB2_5'] != ''?', '.$_REQUEST['EtaB2_5']:'').'</td>
                                ';
                            }
                        }
                        $msg .= ' </tr>';
                   
                    $msg .= '   </table>';
                }

 

                if(isset($_REQUEST['TipoSoggiorno3']) && $_REQUEST['TipoSoggiorno3'] != ''){
                    $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno3']) && $_REQUEST['TipoSoggiorno3'] != ''){
                            $msg .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno3'] . '</td>
                                    ';
                        }
                        if (isset($_REQUEST['NumeroCamere3'])) {
                            if ($_REQUEST['NumeroCamere3']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>nr.</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumeroCamere3'] . '</td>
                                        ';
                            }
                        }
                        if (isset($_REQUEST['TipoCamere3'])) {
                            if ($_REQUEST['TipoCamere3']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['TipoCamere3'] . '</td>
                                        ';
                            }
                        }
                        if(isset($_REQUEST['NumAdulti3'])){
                            if ($_REQUEST['NumAdulti3']!= '') {
                                $msg .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti3']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini3'])){
                            if ($_REQUEST['NumBambini3']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini3']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB3_1'])){
                            if ($_REQUEST['EtaB3_1']!= '') {
                            $msg .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB3_1'] . ''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != ''?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != ''?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB3_4']) && $_REQUEST['EtaB3_4'] != ''?', '.$_REQUEST['EtaB3_4']:'').''.(isset($_REQUEST['EtaB3_5']) && $_REQUEST['EtaB3_5'] != ''?', '.$_REQUEST['EtaB3_5']:'').'</td>
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
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
                                    </td>
                                </tr>
                            </table>';

                $msg_hotel .= top_email($Hotel,$BaseUrlSuiteweb);

                $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                <tr>
                                    <td valign="top">
                                        <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$email.'">Clicca qui per rispondere a: '.$nome.' '.$cognome.'</a></div>
                                    </td>
                                </tr>
                            </table>';

                $msg_hotel .= '
                                    <img src="'.$BaseUrlSuiteweb.'v2/uploads/loghi_siti/' . $logo . '">
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
                $msg_hotel .= ' </table>';

 

                if(isset($_REQUEST['TipoSoggiorno1']) && $_REQUEST['TipoSoggiorno1'] != ''){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg_hotel .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno1']) && $_REQUEST['TipoSoggiorno1'] != ''){
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno1'] . '</td>
                                    ';
                        }
                        if (isset($_REQUEST['NumeroCamere1'])) {
                            if ($_REQUEST['NumeroCamere1']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>nr.</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumeroCamere1'] . '</td>
                                        ';
                            }
                        }
                        if (isset($_REQUEST['TipoCamere1'])) {
                            if ($_REQUEST['TipoCamere1']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['TipoCamere1'] . '</td>
                                        ';
                            }
                        }
                        if(isset($_REQUEST['NumAdulti1'])){
                            if ($_REQUEST['NumAdulti1']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti1']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini1'])){
                            if ($_REQUEST['NumBambini1']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini1']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB1_1'])){
                            if ($_REQUEST['EtaB1_1']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB1_1'] . ''.(isset($_REQUEST['EtaB1_2']) && $_REQUEST['EtaB1_2'] != ''?', '.$_REQUEST['EtaB1_2']:'').''.(isset($_REQUEST['EtaB1_3']) && $_REQUEST['EtaB1_3'] != ''?', '.$_REQUEST['EtaB1_3']:'').''.(isset($_REQUEST['EtaB1_4']) && $_REQUEST['EtaB1_4'] != ''?', '.$_REQUEST['EtaB1_4']:'').''.(isset($_REQUEST['EtaB1_5']) && $_REQUEST['EtaB1_5'] != ''?', '.$_REQUEST['EtaB1_5']:'').'</td>
                                ';
                            }
                        }
                        $msg_hotel .= ' </tr>';
                   
                    $msg_hotel .= '   </table>';
                }



                if(isset($_REQUEST['TipoSoggiorno2']) && $_REQUEST['TipoSoggiorno2'] != ''){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg_hotel .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno2']) && $_REQUEST['TipoSoggiorno2'] != ''){
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno2'] . '</td>
                                    ';
                        }
                        if (isset($_REQUEST['NumeroCamere2'])) {
                            if ($_REQUEST['NumeroCamere2']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>nr.</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumeroCamere2'] . '</td>
                                        ';
                            }
                        }
                        if (isset($_REQUEST['TipoCamere2'])) {
                            if ($_REQUEST['TipoCamere2']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['TipoCamere2'] . '</td>
                                        ';
                            }
                        }
                        if(isset($_REQUEST['NumAdulti2'])){
                            if ($_REQUEST['NumAdulti2']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti2']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini2'])){
                            if ($_REQUEST['NumBambini2']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini2']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB2_1'])){
                            if ($_REQUEST['EtaB2_1']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB2_1'] . ''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != ''?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != ''?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB2_4']) && $_REQUEST['EtaB2_4'] != ''?', '.$_REQUEST['EtaB2_4']:'').''.(isset($_REQUEST['EtaB2_5']) && $_REQUEST['EtaB2_5'] != ''?', '.$_REQUEST['EtaB2_5']:'').'</td>
                                ';
                            }
                        }
                        $msg_hotel .= ' </tr>';
                   
                    $msg_hotel .= '   </table>';
                }

 

                if(isset($_REQUEST['TipoSoggiorno3']) && $_REQUEST['TipoSoggiorno3'] != ''){
                    $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';


                        $msg_hotel .= '    <tr>';
                        if(isset($_REQUEST['TipoSoggiorno3']) && $_REQUEST['TipoSoggiorno3'] != ''){
                            $msg_hotel .= '
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['TipoSoggiorno3'] . '</td>
                                    ';
                        }
                        if (isset($_REQUEST['NumeroCamere3'])) {
                            if ($_REQUEST['NumeroCamere3']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>nr.</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumeroCamere3'] . '</td>
                                        ';
                            }
                        }
                        if (isset($_REQUEST['TipoCamere3'])) {
                            if ($_REQUEST['TipoCamere3']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['TipoCamere3'] . '</td>
                                        ';
                            }
                        }
                        if(isset($_REQUEST['NumAdulti3'])){
                            if ($_REQUEST['NumAdulti3']!= '') {
                                $msg_hotel .= '
                                            <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                            <td align="left" valign="top">' . $_REQUEST['NumAdulti3']. '</td>
                                        ';
                                }
                        }
                        if(isset($_REQUEST['NumBambini3'])){
                            if ($_REQUEST['NumBambini3']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['NumBambini3']. '</td>
                                    ';
                            }
                        }
                        if(isset($_REQUEST['EtaB3_1'])){
                            if ($_REQUEST['EtaB3_1']!= '') {
                            $msg_hotel .= '
                                        <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                        <td align="left" valign="top">' . $_REQUEST['EtaB3_1'] . ''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != ''?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != ''?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB3_4']) && $_REQUEST['EtaB3_4'] != ''?', '.$_REQUEST['EtaB3_4']:'').''.(isset($_REQUEST['EtaB3_5']) && $_REQUEST['EtaB3_5'] != ''?', '.$_REQUEST['EtaB3_5']:'').'</td>
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
                                        <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
                                    </td>
                                </tr>
                            </table>';


                    if ($nome != '' && $cognome != '' && $email != '' && $urlback != '' && $language != '' && $adulti != '' && $arrivo != '' && $partenza != '') {

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

                            /**
                             * * Ogni tanto da elementor la data formattata in italiano, non la prende
                             * * e la passa in formato YYYY-mm-dd
                             * * tramte questa espressione regolare se il bug dovresse capitare, 
                             * * la tengo cosi com'è perchè nel DB va inserita in formato date()!!
                             */
                            if(eregi("(0?[1-9]|[12][0-9]|3[01])/(0?[1-9]|1[012])/((19[0][1-9]|19[1-9][0-9])|(20[012][0-9]|20[3][0-7]))", $_REQUEST['data_arrivo'], $regs)){

                                $dataAtmp            = explode("/",$_REQUEST['data_arrivo']);
 
                                $data_arrivo         = $dataAtmp[2].'-'.$dataAtmp[1].'-'.$dataAtmp[0];
                             }else{
 
                                 $data_arrivo        = $_REQUEST['data_arrivo'];
                             } 
       
                               $dataPtmp            = explode("/",$_REQUEST['data_partenza']);

                               $data_partenza       = $dataPtmp[2].'-'.$dataPtmp[1].'-'.$dataPtmp[0];
       
                               $dataAtmpAlternativa = explode("/",$_REQUEST['DataArrivo']);
       
                               $DataArrivo          = $dataAtmpAlternativa[2].'-'.$dataAtmpAlternativa[1].'-'.$dataAtmpAlternativa[0];
       
                               $dataPtmpAlternativa = explode("/",$_REQUEST['DataPartenza']);

                               $DataPartenza        = $dataPtmpAlternativa[2].'-'.$dataPtmpAlternativa[1].'-'.$dataPtmpAlternativa[0];
       
                               if(isset($_REQUEST['TipoSoggiorno1']) && $_REQUEST['TipoSoggiorno1'] != ''){
                                    $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno1']) && $_REQUEST['TipoSoggiorno1'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno1']:'').' '.(isset($_REQUEST['NumeroCamere1']) && $_REQUEST['NumeroCamere1']!= '' ?' &#10230; Nr.: '.$_REQUEST['NumeroCamere1']:'').' '.(isset($_REQUEST['TipoCamere1']) && $_REQUEST['TipoCamere1']!= '' ?' &#10230;  Sistemazione: '.$_REQUEST['TipoCamere1']:'').' '.(isset($_REQUEST['NumAdulti1'])?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti1']:'').' '.(isset($_REQUEST['NumBambini1']) && $_REQUEST['NumBambini1']!= '' ?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini1']:'').'  '.(isset($_REQUEST['EtaB1_1']) && $_REQUEST['EtaB1_1'] != '' ?' &#10230; Età: '.$_REQUEST['EtaB1_1']:'').''.(isset($_REQUEST['EtaB1_2']) && $_REQUEST['EtaB1_2'] != '' ?', '.$_REQUEST['EtaB1_2']:'').''.(isset($_REQUEST['EtaB1_3']) && $_REQUEST['EtaB1_3'] != '' ?', '.$_REQUEST['EtaB1_3']:'').''.(isset($_REQUEST['EtaB1_4']) && $_REQUEST['EtaB1_4'] != '' ?', '.$_REQUEST['EtaB1_4']:'').''.(isset($_REQUEST['EtaB1_5']) && $_REQUEST['EtaB1_5'] != '' ?', '.$_REQUEST['EtaB1_5']:'')."\r\n";
                               }
                               if(isset($_REQUEST['TipoSoggiorno2']) && $_REQUEST['TipoSoggiorno2'] != ''){
                                    $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno2']) && $_REQUEST['TipoSoggiorno2'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno2']:'').' '.(isset($_REQUEST['NumeroCamere2']) && $_REQUEST['NumeroCamere2']!= '' ?' &#10230; Nr.: '.$_REQUEST['NumeroCamere2']:'').' '.(isset($_REQUEST['TipoCamere2']) && $_REQUEST['TipoCamere2']!= '' ?' &#10230;  Sistemazione: '.$_REQUEST['TipoCamere2']:'').' '.(isset($_REQUEST['NumAdulti2'])?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti2']:'').' '.(isset($_REQUEST['NumBambini2']) && $_REQUEST['NumBambini2']!= '' ?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini2']:'').'  '.(isset($_REQUEST['EtaB2_1']) && $_REQUEST['EtaB2_1'] != '' ?' &#10230; Età: '.$_REQUEST['EtaB2_1']:'').''.(isset($_REQUEST['EtaB2_2']) && $_REQUEST['EtaB2_2'] != '' ?', '.$_REQUEST['EtaB2_2']:'').''.(isset($_REQUEST['EtaB2_3']) && $_REQUEST['EtaB2_3'] != '' ?', '.$_REQUEST['EtaB2_3']:'').''.(isset($_REQUEST['EtaB2_4']) && $_REQUEST['EtaB2_4'] != '' ?', '.$_REQUEST['EtaB2_4']:'').''.(isset($_REQUEST['EtaB2_5']) && $_REQUEST['EtaB2_5'] != '' ?', '.$_REQUEST['EtaB2_5']:'')."\r\n";
                                }
                                if(isset($_REQUEST['TipoSoggiorno3']) && $_REQUEST['TipoSoggiorno3'] != ''){
                                    $RigheCompilate  .= (isset($_REQUEST['TipoSoggiorno3']) && $_REQUEST['TipoSoggiorno3'] != ''?' - Trattamento: '.$_REQUEST['TipoSoggiorno3']:'').' '.(isset($_REQUEST['NumeroCamere3']) && $_REQUEST['NumeroCamere3']!= '' ?' &#10230; Nr.: '.$_REQUEST['NumeroCamere3']:'').' '.(isset($_REQUEST['TipoCamere3']) && $_REQUEST['TipoCamere3']!= '' ?' &#10230;  Sistemazione: '.$_REQUEST['TipoCamere3']:'').' '.(isset($_REQUEST['NumAdulti3'])?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti3']:'').' '.(isset($_REQUEST['NumBambini3']) && $_REQUEST['NumBambini3']!= '' ?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini3']:'').'  '.(isset($_REQUEST['EtaB3_1']) && $_REQUEST['EtaB3_1'] != '' ?' &#10230; Età: '.$_REQUEST['EtaB3_1']:'').''.(isset($_REQUEST['EtaB3_2']) && $_REQUEST['EtaB3_2'] != '' ?', '.$_REQUEST['EtaB3_2']:'').''.(isset($_REQUEST['EtaB3_3']) && $_REQUEST['EtaB3_3'] != '' ?', '.$_REQUEST['EtaB3_3']:'').''.(isset($_REQUEST['EtaB3_4']) && $_REQUEST['EtaB3_4'] != '' ?', '.$_REQUEST['EtaB3_4']:'').''.(isset($_REQUEST['EtaB3_5']) && $_REQUEST['EtaB3_5'] != '' ?', '.$_REQUEST['EtaB3_5']:'')."\r\n";
                                }
                               $note           =  (($hotel!='' || $hotel!='--')?addslashes($hotel)."\r\n":'');
                               $note           =  (isset($_REQUEST['animali_ammessi']) && $animali_ammessi_tmp!=''?'Viaggiamo con animali domestici: '.$animali_ammessi."\r\n":'');
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


                               $syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                               $db_quoto->query($syncro);

                            // ritorno alla pagina OK
                              echo'   <form  action="' . $urlback . '?res=sent" name="form_response_q" id="form_response_q"  method="POST">
                                        <input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
                                        <input type="hidden" name="idsito" value="'.$idsito.'"/>
                                    </form>'."\r\n";

                            echo'   <script language="JavaScript">
                                        document.form_response_q.submit();
                                    </script>'."\r\n"; 
                            

                    } else {

                        $arrayCampiVuoti = array((isset($nome)    && $nome     == ''?'Nome, ':'').
                                                (isset($cognome)  && $cognome  == ''?'Cognome, ':'').
                                                (isset($email)    && $email    == ''?'Email, ':'').
                                                (isset($urlback)  && $urlback  == ''?'UrlBack, ':'').
                                                (isset($language) && $language == ''?'Language, ':'').
                                                (isset($adulti)   && $adulti   == ''?'Adulti, ':'').
                                                (isset($arrivo)   && $arrivo   == ''?'Data Arrivo, ':'').
                                                (isset($partenza) && $partenza == ''?'Data Partenza, ':''));
                        $campiVuoti      = implode(",",$arrayCampiVuoti);
                        $campiVuoti      = substr($campiVuoti,0,-2);

                        $message         = 'ATTENZIONE:\n i campi   ['.$campiVuoti.']\n sono obbligatori, devono essere compilati!';

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
}
