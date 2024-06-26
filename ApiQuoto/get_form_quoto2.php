<?
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
$view_icon        = $_REQUEST['view_icon'];
$fontawesome      = $_REQUEST['fontawesome'];
$check_target     = $_REQUEST['check_target'];
$ritorno          = $_REQUEST['res'];

$sfondo           = ($_REQUEST['sfondo']   == 'transparent' ? 'transparent': '#' . $_REQUEST['sfondo']);
$pulsante         = ($_REQUEST['pulsante'] == 'transparent' ? 'transparent': '#' . $_REQUEST['pulsante']);
$testo            = '#' . $_REQUEST['testo'];
$bordo            = '#' . $_REQUEST['bordo'];
$radius           = $_REQUEST['radius'];
$css_input        = $_REQUEST['css_input'];

$send_timeline    = $_REQUEST['send_timeline'];
$Ip               = $_SERVER['REMOTE_ADDR'];
$Agent            = $_SERVER['HTTP_USER_AGENT'];
$percorso         = $_SERVER['HTTP_REFERER'];

$sfondo_clean     = str_replace('#', '', $sfondo);
$pulsante_clean   = str_replace('#', '', $pulsante);
$testo_clean      = str_replace('#', '', $testo);
$bordo_clean      = str_replace('#', '', $bordo);

include_once($_SERVER['DOCUMENT_ROOT'].'/ApiQuoto/function.inc.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php';

$db_quoto = new MysqliDb('185.81.4.13', 'quotocrm_quotocrm', 'aya)VfUC9g8S', 'quotocrm_v3_nws');

$db       = new MysqliDb('185.81.4.13', 'quotocrm_quotocrm', 'aya)VfUC9g8S', 'quotocrm_v3_nws');

require_once $_SERVER['DOCUMENT_ROOT'].'/ApiQuoto/google-translate/src/gtranslate.php';

$gt = new gtranslate();
// Query e ciclo per estrapolare i dati di tipologia camere
$rw = "SELECT hospitality_camere_testo.*
        FROM hospitality_camere_testo
        INNER JOIN hospitality_tipo_camere on hospitality_tipo_camere.Id = hospitality_camere_testo.camere_id
        WHERE hospitality_camere_testo.idsito = ".$idsito."
        AND hospitality_camere_testo.lingue = '". $language ."'
        AND hospitality_tipo_camere.Abilitato_form = 1
        ORDER BY hospitality_camere_testo.Camera ASC";
$result = $db_quoto->query($rw);
$tot_camere = sizeof($result);
if($tot_camere>0){
    foreach($result as $key => $val){
        $ListaCamere .='<option value="'.$val['Camera'].'">'.$val['Camera'].'</option>';
    }
}else{
    $ListaCamere .='<option value="Singola">'.$gt->translate('Singola', $language,'it',true).'</option>';
    $ListaCamere .='<option value="Doppia">'.$gt->translate('Doppia', $language,'it',true).'</option>';
    $ListaCamere .='<option value="Matrimoniale">'.$gt->translate('Matrimoniale', $language,'it',true).'</option>';
    $ListaCamere .='<option value="Tripla">'.$gt->translate('Tripla', $language,'it',true).'</option>';
    $ListaCamere .='<option value="Suite">'.$gt->translate('Suite', $language,'it',true).'</option>';
}


// Query e ciclo per estrapolare i dati di tipologia soggiorno
$row = "SELECT hospitality_tipo_soggiorno_lingua.*
        FROM hospitality_tipo_soggiorno_lingua
        INNER JOIN hospitality_tipo_soggiorno on hospitality_tipo_soggiorno.Id = hospitality_tipo_soggiorno_lingua.soggiorni_id
        WHERE hospitality_tipo_soggiorno_lingua.idsito = ".$idsito."
        AND hospitality_tipo_soggiorno_lingua.lingue = '". $language ."'
        AND hospitality_tipo_soggiorno.Abilitato_form = 1
        ORDER BY hospitality_tipo_soggiorno_lingua.Soggiorno ASC";
$record = $db_quoto->query($row);
$tot_soggiorni = sizeof($record);
if($tot_soggiorni>0){
    foreach($record as $chiave => $valore){
        $ListaSoggiorno .='<option value="'.mini_clean($valore['Soggiorno']).'">'.mini_clean($valore['Soggiorno']).'</option>';
    }
}else{

    $ListaSoggiorno .='<option value="All Inclusive">'.$gt->translate('All Inclusive', $language,'it',true).'</option>';
    $ListaSoggiorno .='<option value="Pensione Completa">'.$gt->translate('Pensione Completa', $language,'it',true).'</option>';
    $ListaSoggiorno .='<option value="Mezza Pensione">'.$gt->translate('Mezza Pensione', $language,'it',true).'</option>';
    $ListaSoggiorno .='<option value="Bed & Breakfast">'.$gt->translate('Bed & Breakfast', $language,'it',true).'</option>';
    $ListaSoggiorno .='<option value="Solo Pernotto">'.$gt->translate('Solo Pernotto', $language,'it',true).'</option>';
}

$z = 1;
for($z==1; $z<=10; $z++){
    $NumeriC .='<option value="'.$z.'">'.$z.'</option>';
}
$a = 1;
for($a==1; $a<=20; $a++){
    $NumeriAD .='<option value="'.$a.'">'.$a.'</option>';
}

$x = 1;
for($x==1; $x<=6; $x++){
    $NumeriBimbi .='<option value="'.$x.'">'.$x.'</option>';
}


// Query e ciclo per estrapolare i dati di tipologia camere
$rw = "SELECT hospitality_target.*
        FROM hospitality_target
        WHERE hospitality_target.idsito = ".$idsito."
        AND hospitality_target.Abilitato_form = 1
        AND hospitality_target.Target != ''
        ORDER BY hospitality_target.Target ASC";
$result = $db_quoto->query($rw);
$tot_target = sizeof($result);
if($tot_target>0){
    foreach($result as $key => $val){
        $ListaTarget .='<option value="'.$val['Target'].'">'.$gt->translate($val['Target'], $language,'it',true).'</option>';
    }
}else{
    $ListaTarget .='<option value="">QUOTO v2 non è stato ancora popolato</option>';
}


$sql = "SELECT siti.*,anagrafica.rag_soc
      FROM siti
      INNER JOIN utenti ON utenti.idsito = siti.idsito
      INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra
      WHERE siti.idsito = " . $idsito . "
      AND utenti.blocco_accesso = 0
      AND siti.hospitality = 1
      AND siti.data_start_hospitality <= '" . date('Y-m-d') . "'
      AND siti.data_end_hospitality > '" . date('Y-m-d') . "'";
$record   = $db->query($sql);
$ret      = $record[0];
$permessi = $db->count;
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

      /**
     * !DIZIONARIO FORM
     */
    $select = "SELECT dizionario_form_quoto.etichetta,dizionario_form_quoto_lingue.testo FROM dizionario_form_quoto
                INNER JOIN dizionario_form_quoto_lingue ON dizionario_form_quoto_lingue.id_dizionario = dizionario_form_quoto.id
                WHERE dizionario_form_quoto_lingue.Lingua = '".$language."'
                AND dizionario_form_quoto.etichetta LIKE '%FORM%'
                AND dizionario_form_quoto.etichetta NOT LIKE '%RESPONSE_FORM%'
                AND dizionario_form_quoto_lingue.idsito = ".$idsito ;
    $res = $db_quoto->query($select);
    $tot_l = sizeof($res);
    if($tot_l > 0){
        foreach ($res as $key => $value) {
            define($value['etichetta'],$value['testo']);
        }
    }

    $form['target'][$language]                       = FORM_TARGET;
    $form['legendavacanza'][$language]               = FORM_LEGENDA_VACANZA;
    $form['comunicazioni'][$language]                = FORM_COMUNICAZIONI;
    $form['tuo-soggiorno'][$language]                = FORM_TUO_SOGGIORNO;
    $form['date-soggiorno'][$language]               = FORM_DATE_SOGGIORNO;
    $form['dati-personali'][$language]               = FORM_DATI_PERSONALI;

    $form['text-loader'][$language]                  = FORM_TEAXT_LOADER;
    $form['nome'][$language]                         = FORM_NOME;
    $form['cognome'][$language]                      = FORM_COGNOME;
    $form['email'][$language]                        = FORM_EMAIL;
    $form['telefono'][$language]                     = FORM_TELEFONO;

    $form['arrivo'][$language]                       = FORM_ARRIVO;
    $form['partenza'][$language]                     = FORM_PARTENZA;

    $form['arrivo_alternativo'][$language]           = FORM_ARRIVO_ALTERNATIVO;
    $form['partenza_alternativo'][$language]         = FORM_PARTENZA_ALTERNATIVA;
    $form['adulti_totale'][$language]                = FORM_TOTALE_ADULTI;
    $form['bambini_totale'][$language]               = FORM_TOTALE_BAMBINI;

    $form['sistemazione'][$language]                 = FORM_SISTEMAZIONE;

    $form['camere'][$language]                       = FORM_CAMERE;

    $form['trattamento'][$language]                  = FORM_TRATTAMENTO;

    $form['adulti'][$language]                       = FORM_ADULTI;
    $form['bambini'][$language]                      = FORM_BAMBINI;
    $form['bambini_eta'][$language]                  = FORM_BAMBINI_ETA;

    $form['legenda'][$language]                      = FORM_LEGENDA;
    $form['addDate'][$language]                      = FORM_ADD_DATE;
    $form['remDate'][$language]                      = FORM_REM_DATE;
    $form['addRoom'][$language]                      = FORM_ADD_ROOM;
    $form['remRoom'][$language]                      = FORM_REM_ROOM;

    $form['messaggio'][$language]                    = FORM_MESSAGGIO;

    $form['invia'][$language]                        = FORM_INVIA;

    $form['consenso'][$language]                     = FORM_CONSENSO;
    $form['informativa'][$language]                  = FORM_LINK_INFORMATIVA;
    $form['consenso2'][$language]                    = FORM_CONSENSO2;
    $form['consenso3'][$language]                    = FORM_CONSENSO3;

    $form['privacy'][$language]                      = FORM_PRIVACY;

    $form['successo'][$language]                     = FORM_SUCCESSO;


if ($_REQUEST['action'] == 'send') {


        $idsito           = $_REQUEST['idsito'];
        $language         = $_REQUEST['language'];
        $urlback          = $_REQUEST['urlback'];
        $iubendapolicy    = $_REQUEST['iubendapolicy'];
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
        $rec = $db->query($s);
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

        $ritorno                                    = $_REQUEST['ritorno'];

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
        $bambini_eta                                = $_REQUEST['bambini_eta'];

        $messaggio                                  = $_REQUEST['messaggio'];

        /**
         * !DIZIONARIO FORM
         */
        $select = "SELECT dizionario_form_quoto.etichetta,dizionario_form_quoto_lingue.testo FROM dizionario_form_quoto
                    INNER JOIN dizionario_form_quoto_lingue ON dizionario_form_quoto_lingue.id_dizionario = dizionario_form_quoto.id
                    WHERE dizionario_form_quoto_lingue.Lingua = '".$language."'
                    AND dizionario_form_quoto.etichetta LIKE '%RESPONSE_FORM%'
                    AND dizionario_form_quoto_lingue.idsito = ".$idsito ;
        $res = $db_quoto->query($select);
        $tot_l = sizeof($res);
        if($tot_l > 0){
            foreach ($res as $key => $value) {
                define($value['etichetta'],$value['testo']);

            }
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
        $responseform['h1'][$language]                   = RESPONSE_FORM_H1;
        $responsoform_oggetto                           = str_replace('[sito]',$SitoHotel,RESPONSE_FORM_OGGETTO);
        $responsoform_oggetto                           = str_replace('[nome]',$nome,$responsoform_oggetto);
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

        $BaseUrlSuiteweb = 'https://www.quotocrm.it/';


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
        if ($TipoVacanza != '') {
            $msg .= '      <tr>
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                        <td align="left" valign="top" style="width:70%">' . $gt->translate($TipoVacanza , $language,'it',true). '</td>
                                      </tr>';
        }
        $msg .= ' </table>';

        $n_righe = count($_REQUEST['TipoSoggiorno']);
        $i=0;
        if($n_righe>0){
            $msg .= '<table cellpadding="4" cellspacing="4" width="100%" border="0" align="center">';

        for($i==0; $i<=($n_righe-1); $i++){
                $msg .= '    <tr>';
                if ($_REQUEST['TipoSoggiorno'][$i]!= '') {
                    $msg .= '
                                <td align="left" valign="top"><b>' . $responseform['trattamento'][$language] . '</b></td>
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
                if ($_REQUEST['EtaB'][$i] != '') {
                    $msg .= '
                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                <td align="left" valign="top">' . $_REQUEST['EtaB'][$i] . '</td>
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
        if ($TipoVacanza != '') {
            $msg_hotel .= '      <tr>
                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                        <td align="left" valign="top" style="width:70%">' . $gt->translate($TipoVacanza , $language,'it',true). '</td>
                                      </tr>';
        }
        $msg_hotel .= ' </table>';

        $n_righe = count($_REQUEST['TipoSoggiorno']);
        $i=0;
        if($n_righe>0){
            $msg_hotel .= '<table cellpadding="2" cellspacing="2" width="100%" border="0" align="center">';

        for($i==0; $i<=($n_righe-1); $i++){
                $msg_hotel .= '    <tr>';
                if ($_REQUEST['TipoSoggiorno'][$i]!= '') {
                    $msg_hotel .= '
                                <td align="left" valign="top"><b>' . $responseform['trattamento'][$language] . '</b></td>
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
                if ($_REQUEST['EtaB'][$i] != '') {
                    $msg_hotel .= '
                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                <td align="left" valign="top">' . $_REQUEST['EtaB'][$i] . '</td>
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

            if (isset($_REQUEST["g-recaptcha-response"])) {

                        $remoteip  = $_SERVER["REMOTE_ADDR"];
                        $recaptcha = $_REQUEST["g-recaptcha-response"];

                        $response = verifyCaptcha($recaptcha, $remoteip, $chiave_segreta_recaptcha);

                        if ($response->success) {

                            if ($nome != '' && $cognome != '' && $email != '' && $urlback != '' && $language != '' && $arrivo != '' && $partenza != '') {
                                // Mail it
                               // mail($to, $subject, $msg, $headers);
                               $mail->setFrom('no-reply@suiteweb.it', $Hotel);
                               //$mail->addReplyTo($EmailHotel, $Hotel);
                               $mail->addAddress($email, $nome.' '.$cognome);
                               if($email_alternativa!=''){
                                    $array_alternativa = array();
                                    $array_alternativa = explode(",",$email_alternativa);
                                    foreach ($array_alternativa as $key => $value) {
                                        $mail->addAddress($value, $nome.' '.$cognome);
                                    }


                                }
                               $mail->isHTML(true);
                               $mail->Subject = $responseform_oggetto;
                               $mail->msgHTML($msg, dirname(__FILE__));
                               $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                               $mail->send();

                               $mail_hotel->setFrom('no-reply@suiteweb.it', $Hotel);
                               $mail_hotel->addAddress($EmailHotel, $Hotel);
                               $mail_hotel->isHTML(true);
                               $mail_hotel->Subject = $responseform_oggetto;
                               $mail_hotel->msgHTML($msg_hotel, dirname(__FILE__));
                               $mail_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                               $mail_hotel->send();
    

                                $data_richiesta = date('Y-m-d');

                                $id_lingua      =  $_REQUEST['id_lingua'];
                                $lingua         =  from_id_to_cod($id_lingua);

                                $numero_prenotazione = NewNumeroPreno($idsito);
                                $cellulare           = field_clean($_REQUEST['telefono']);

                                $dataAtmp            = explode("/",$_REQUEST['data_arrivo']);
                                $dataAtmp2           = explode("-",$_REQUEST['data_arrivo']);
        
                                if($dataAtmp[1]!=''){
                                    $data_A_tmp = $dataAtmp;
                                }elseif($dataAtmp2[1]!=''){
                                    $data_A_tmp = $dataAtmp2;
                                }

                                $data_arrivo    =  $data_A_tmp[2].'-'.$data_A_tmp[1].'-'.$data_A_tmp[0];
        
                                $dataPtmp       =  explode("/",$_REQUEST['data_partenza']);
                                $dataPtmp2      =  explode("-",$_REQUEST['data_partenza']);

                                if($dataPtmp[1]!=''){
                                    $data_P_tmp = $dataPtmp;
                                }elseif($dataPtmp2[1]!=''){
                                    $data_P_tmp = $dataPtmp2;
                                }

                                $data_partenza  =  $data_P_tmp[2].'-'.$data_P_tmp[1].'-'.$data_P_tmp[0];
        
                                $dataAtmpAlternativa       =  explode("/",$_REQUEST['DataArrivo']);
                                $dataAtmp2Alternativa      =  explode("-",$_REQUEST['DataArrivo']);
        
                                if($dataAtmpAlternativa[1]!=''){
                                    $data_A_tmp_alt = $dataAtmpAlternativa;
                                }elseif($dataAtmp2Alternativa[1]!=''){
                                    $data_A_tmp_alt = $dataAtmp2Alternativa;
                                }

                                $DataArrivo    =  $data_A_tmp_alt[2].'-'.$data_A_tmp_alt[1].'-'.$data_A_tmp_alt[0];
        
                                $dataPtmpAlternativa       =  explode("/",$_REQUEST['DataPartenza']);
                                $dataPtmp2Alternativa      =  explode("-",$_REQUEST['DataPartenza']);

                                if($dataPtmpAlternativa[1]!=''){
                                    $data_P_tmp_alt = $dataPtmpAlternativa;
                                }elseif($dataAtmp2Alternativa[1]!=''){
                                    $data_P_tmp_alt = $dataPtmpAlternativa;
                                }

                                $DataPartenza  =  $data_P_tmp_alt[2].'-'.$data_P_tmp_alt[1].'-'.$data_P_tmp_alt[0];
        
                                if($_REQUEST['TipoSoggiorno']){
                                    $n_righe = count($_REQUEST['TipoSoggiorno']);
                                    $i=0;
                                    $RigheCompilate  = '';
                                    for($i==0; $i<=($n_righe-1); $i++){
                                        $RigheCompilate  .= ($_REQUEST['TipoSoggiorno'][$i]!=''?' - Trattamento: '.$_REQUEST['TipoSoggiorno'][$i]:'').' '.($_REQUEST['NumeroCamere'][$i]!=''?' &#10230; Nr.: ' .$_REQUEST['NumeroCamere'][$i].'  ':'').' '.($_REQUEST['TipoCamere'][$i]!=''?' &#10230; Sistemazione: '.$_REQUEST['TipoCamere'][$i]:'').' '.($_REQUEST['NumAdulti'][$i]!=''?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti'][$i]:'').' '.($_REQUEST['NumBambini'][$i]!=''?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini'][$i]:'').' '.($_REQUEST['EtaB'][$i]!=''?' &#10230; Età: '.$_REQUEST['EtaB'][$i]:'')."\r\n";
                                    }
                                }
                                $note           =  (($hotel!='' || $hotel!='--')?addslashes($hotel)."\r\n":'');
                                $note          .=  ($bambini_eta !=''?'Età bambini: '.$bambini_eta.'; ':'').' '.($sistemazione !=''?'Sistemazione: '.$sistemazione.'; ':'').' '.($trattamento !=''?' Trattamento: '.$trattamento.'; ':'');
                                $note          .=  (($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$_REQUEST['DataArrivo'].' Data Partenza Alternativa: '.$_REQUEST['DataPartenza']."\r\n":'');
                                $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                                $note          .=  ($_REQUEST['messaggio']!=''?"\r\n".'Note: '.$_REQUEST['messaggio']:'');
                                
                                $ConsensoMarketing    = ($_REQUEST['marketing']=='on'?1:0);
                                $ConsensoProfilazione = ($_REQUEST['profilazione']=='on'?1:0);
                                $ConsensoPrivacy      = ($_REQUEST['privacy']=='checkbox' || $_REQUEST['privacy']=='consenso'?1:0);


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

                                // SALVO LA MAIL ANCHE IN SUTEWEB
                                $jsonRequest = json_encode($_REQUEST);
                                $data        = array('id_utente_destinatario' => $idutente,
                                    'testo_notifica'                              => $msg_hotel,
                                    'id_sito_riferimento'                         => $idsito,
                                    'json_richiesta'                              => $jsonRequest,
                                    'oggetto_notifica'                            => 'Richiesta informazioni per il sito: ' . $SitoWeb . ' da parte di: ' . $nome,
                                    'data_invio'                                  => mktime());
                                $db->insert('notifiche', $data);

                                // ritorno alla pagina OK
                                //echo '<script language="javascript">alert("' . $responseform['successo'][$language] . '");document.location="' . $urlback . '?res=sent"</script>';
                                //echo '<script language="javascript">document.location="' . $urlback . '?res=sent"</script>';
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


}
/*
# integrazione FORM per il software QUOTO
 */



?>
<?php 
/**
 * * messa condizione in base al IDSITO se relilax.it oppure relilax.com
 * * stampa a video il codice di tracciamento
 */
if($idsito=='2265' || $idsito=='2373'){?>
<script async=async src="https://www.googletagmanager.com/gtag/js?id=UA-13158959-3"></script>
<script>window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-13158959-3', {
            'linker': {
                'accept_incoming': true,
                'decorate_forms': true
                , 'domains': ['simplebooking.it', 'suiteweb.it']
            },
            'anonymize_ip': true,
            'transport_type': 'beacon'
        });
</script>
<?}?>
<!-- FINE CODICE DI TRACCIAMNETO PER RELILAX -->
<link type="text/css" href="https://resources.suiteweb.it/v3/jquery_ui/jquery-ui.min.css" rel="Stylesheet" />
<?php if($jqueryframe==0){?>
    <script type="text/javascript" src="https://resources.suiteweb.it/ApiQuoto/js/jquery-3.1.1.min.js"></script>
<?}?>
<?php if($fontawesome){?>
    <script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
<?}?>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js<?=($language=='it'?'':'?hl='.$language)?>" async defer></script>
<script type="text/javascript"  src="https://resources.suiteweb.it/v3/jquery_ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://resources.suiteweb.it/v3/jquery_ui/datapicker-lang/jquery.ui.datepicker-<?=($language == ''?'it':$language)?>.min.js"></script>
<script type="text/javascript" src="https://resources.suiteweb.it/ApiQuoto/js/jquery.validate.min.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/ApiQuoto/js/add_room.inc.js.php');?>

<script>
$(function() {
  $.datepicker.setDefaults({
    showOn: 'both',
    changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy',
    minDate: "+1d",
    numberOfMonths: 1
  });

  var cal_start = "#data_arrivo_quoto";
  var cal_end = "#data_partenza_quoto";
  var dates = $(cal_start + "," + cal_end).datepicker({
    defaultDate: "+7",
    onSelect: function(selectedDate) {
      if (this.id.indexOf('data_arrivo') > -1) {
        var date = $(cal_start).datepicker('getDate', '+1d');
        date.setDate(date.getDate() + 1);
        $(cal_end).datepicker('setDate', date);
        $(cal_end).datepicker("option", "minDate", date);
      }
    }
  });

  var cal_start2 = "#DataArrivo_1_quoto";
  var cal_end2 = "#DataPartenza_1_quoto";
  var dates2 = $(cal_start2 + "," + cal_end2).datepicker({
    defaultDate: "+7",
    onSelect: function(selectedDate) {
      if (this.id.indexOf('DataArrivo') > -1) {
        var date2 = $(cal_start2).datepicker('getDate', '+1d');
        date2.setDate(date2.getDate() + 1);
        $(cal_end2).datepicker('setDate', date2);
        $(cal_end2).datepicker("option", "minDate", date2);
      }
    }
  });

});
$(document).ready(function() {


            /**
            * ! RITARDO APERTURA FORM
            * */
            setTimeout(function(){
                $("#loader-content-quoto").fadeOut(200);
                $("#form-show").fadeIn();
                <?php if($eqr == 1){?>
                    setTimeout(function(){
                        EQR();
                    }, 2000);
                <?}?>
            }, 2000);


        $("#form_richiesta").validate({
            rules: {
                nome: "required",
                cognome: "required",
                email: {
                    required: true,
                    email: true
                },
                privacy: "required",
                data_arrivo: "required",
                data_partenza: "required"
            },
            messages: {
                nome: "",
                cognome: "",
                email: "",
                privacy: "Please accept our policy",
                data_arrivo: "",
                data_partenza: ""
            }
        });

        //modulo loading form crea proposta
        $("#form_richiesta").on("submit",function(){
            if ($(this).valid()){
                $("#view_send_form_loading").html('<div class="clearfix">&nbsp;</div><div class="row"><div class="col-md-12 text-center"><img src="https://resources.suiteweb.it/ApiQuoto/img/Ellipsis-1s-200px.svg" alt="Salvataggio in corso"></div></div><div class="row"><div class="col-md-12 text-center"><small>Salvataggio in corso..., attendere il suo termine!</small></div></div><div class="clearfix"  style="height:10px">&nbsp;</div>');
                $("#pulsante-invio").hide();
            }
        })

        $("#plus_date").on('click',function() {
            var attr = $("#date_alternative").attr('style');
            if(attr == 'display:none'){
                $("#date_alternative").attr('style','display:block');
                $("#plus_date").html('<i class="fa fa-fw  fa-minus"></i> <?=$form['remDate'][$language]?>');
            }
            if(attr == 'display:block'){
                $("#date_alternative").attr('style','display:none');
                $("#plus_date").html('<i class="fa fa-fw  fa-plus"></i> <?=$form['addDate'][$language]?>');
            }
        });

    <?php if($check_valid==1){?>
        $("input[type='email']").bind("keyup focusout", function () {
            var EmailCliente = $("input[type='email']").val();
            var EmailOperatore = "info@suiteweb.it";
            if(EmailCliente.length>=2){
                $.ajax({
                    type: "POST",
                    url: "<?=$SitoWeb?>/src/inc_check_valid_email.php",
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",
                    success: function(data){
                        var classe = "";
                        if(data == "valid"){
                            $("#check_email").html('<small class="ca text-green">email valida ed esistente</small>');
                            $("#pulsante-invio").removeAttr("disabled");
                        }else{
                            $("#check_email").html('<small class="ca text-red">email non valida ed inesistente</small>');
                            $("#pulsante-invio").attr("disabled","true");
                        }

                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            }else{
                $("#pulsante-invio").removeAttr("disabled");
            }
        });
    <?}?>
        $("#link_privacy").on('click',function() {
            $("#box_privacy").toggle();
                <?php if($eqr == 1){?>
                    EQR();
                <?}?>    
        });

        $("#marketing").on('click',function() {
                $("#view_profilazione").toggle();
        });

        if ((window.matchMedia('(max-width: 768px)').matches)) {
            $(".righeSogg").hide();
        }
        console.log($("#form-show").width());
        if ($("#form-show").width()<= 610) {
            $(".righeSogg").hide();
        }

        /** controllo se almeno una riga per proposta è stata compliata */
        /** tipo soggiorno */
        if($("select[name*='TipoSoggiorno[]']").val().length > 0){
            $("select[name*='TipoSoggiorno[]']").attr('required',false);
        }else{
            $("select[name*='TipoSoggiorno[]']").attr('required',true);
            $("select[name*='TipoSoggiorno[]']").attr('title',' ');
        }
        $("select[name*='TipoSoggiorno[]']").on("change", function(){
            if($("select[name*='TipoSoggiorno[]']").val().length > 0){
                $("select[name*='TipoSoggiorno[]']").attr('required',false);
            }else{
                $("select[name*='TipoSoggiorno[]']").attr('required',true);
                $("select[name*='TipoSoggiorno[]']").attr('title',' ');
            }
        })
        /** numero camera */
        if($("select[name*='NumeroCamere[]']").val().length > 0){
            $("select[name*='NumeroCamere[]']").attr('required',false);
        }else{
            $("select[name*='NumeroCamere[]']").attr('required',true);
            $("select[name*='NumeroCamere[]']").attr('title',' ');
        }
        $("select[name*='NumeroCamere[]']").on("change", function(){
            if($("select[name*='NumeroCamere[]']").val().length > 0){
                $("select[name*='NumeroCamere[]']").attr('required',false);
            }else{
                $("select[name*='NumeroCamere[]']").attr('required',true);
                $("select[name*='NumeroCamere[]']").attr('title',' ');
            }
        })
         /**  camera */
        if($("select[name*='TipoCamere[]']").val().length > 0){
            $("select[name*='TipoCamere[]']").attr('required',false);
        }else{
            $("select[name*='TipoCamere[]']").attr('required',true);
            $("select[name*='TipoCamere[]']").attr('title',' ');
        }
        $("select[name*='TipoCamere[]']").on("change", function(){
            if($("select[name*='TipoCamere[]']").val().length > 0){
                $("select[name*='TipoCamere[]']").attr('required',false);
            }else{
                $("select[name*='TipoCamere[]']").attr('required',true);
                $("select[name*='TipoCamere[]']").attr('title',' ');
            }
        })
         /**  camera */
         if($("select[name*='NumAdulti[]']").val().length > 0){
            $("select[name*='NumAdulti[]']").attr('required',false);
        }else{
            $("select[name*='NumAdulti[]']").attr('required',true);
            $("select[name*='NumAdulti[]']").attr('title',' ');
        }
        $("select[name*='NumAdulti[]']").on("change", function(){
            if($("select[name*='NumAdulti[]']").val().length > 0){
                $("select[name*='NumAdulti[]']").attr('required',false);
            }else{
                $("select[name*='NumAdulti[]']").attr('required',true);
                $("select[name*='NumAdulti[]']").attr('title',' ');
            }
        })
         /**  adulti */
         if($("select[name*='NumAdulti[]']").val().length > 0){
            $("select[name*='NumAdulti[]']").attr('required',false);
        }else{
            $("select[name*='NumAdulti[]']").attr('required',true);
            $("select[name*='NumAdulti[]']").attr('title',' ');
        }
        $("select[name*='NumAdulti[]']").on("change", function(){
            if($("select[name*='NumAdulti[]']").val().length > 0){
                $("select[name*='NumAdulti[]']").attr('required',false);
            }else{
                $("select[name*='NumAdulti[]']").attr('required',true);
                $("select[name*='NumAdulti[]']").attr('title',' ');
            }
        })

});

    <?php if($eqr == 1){?>
        function equalizza_change_bambini(){
                EQR();
        }
    <?}?>

    /* calcola_totale_adulti */
    function calcola_totale_adulti() {
        var totale='';
        $("select[name*='NumAdulti[]']").each( function() {
            value = new Number($(this).val());
            totale = new Number(totale + value);
            $('#adulti<?=$idsito?>').val(totale);
        });
    }

    /* calcola_totale_bimbi */
    function calcola_totale_bambini() {
        var totaleb='';
        $("select[name*='NumBambini[]']").each( function() {
            valueb = new Number($(this).val());
            totaleb = new Number(totaleb + valueb);
            $('#bambini<?=$idsito?>').val(totaleb);
        });
    }
    function checkDimension(){
        if ((window.matchMedia('(max-width: 768px)').matches)) {
                $(".righeSogg").hide();
        }
        if ($("#form-show").width()<= 610) {
            $(".righeSogg").hide();
        }
    }
    function eta_bimbi(id){
        /* ON CLICK in base al nunmero dei bambini selezionati si rendono visibili i campi per età */
        $(".NumeroBambini_"+id+"").each(function(){
            if($(".NumeroBambini_"+id+"").val() != ''){
                $(".EtaBambini"+id+"").css("display","block");
            }else{
                $(".EtaBambini"+id+"").css("display","none");
            }
        });
    }
</script>
<link type="text/css" href="https://resources.suiteweb.it/ApiQuoto/css/css-form-quoto.css.php?sfondo=<?=str_replace("#","",$_REQUEST['sfondo'])?>&pulsante=<?=str_replace("#","",$_REQUEST['pulsante'])?>&testo=<?=str_replace("#","",$_REQUEST['testo'])?>&bordo=<?=str_replace("#","",$_REQUEST['bordo'])?>&radius=<?=$radius?>"  rel="stylesheet">
<div id="loader-content-quoto">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <div id="welcome">
                <img src="https://resources.suiteweb.it/ApiQuoto/img/logo_loading.png" class="logo-loader">
                <div class="ca"></div>
                <img src="https://resources.suiteweb.it/ApiQuoto/img/Ellipsis-1s-200px.svg" alt="Modulo dedicato al CRM QUOTO v2">
                <div class="ca"></div>
                <div id="text">
                    <small>
                        <?=$form['text-loader'][$language]?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="form-show" style="display:none">

    <?if($ritorno=='sent'){?>
        <?php
            $content = '  	<script id="pushDataLayerQuoto">
                                window.dataLayer = window.dataLayer || []; 
                                dataLayer.push({\'event\': \'Init\', \'NumeroPrenotazione\': \''.$_REQUEST['NumeroPrenotazione'].'#'.$_REQUEST['idsito'].'\'});
                            </script>
                            <script>
                                $(function() {						
                                    //sposto il dataLayer sotto il metatag title
                                    $("#pushDataLayerQuoto").insertAfter(\'title\');
                                });
                            </script>'."\r\n";
            echo $content;
        ?>
        <div class="row">
            <div id="responseForm" class="col-lg-12  col-md-12  col-sm-12 col-xs-12 responseForm" >
                <?=$form['successo'][$language]?>
            </div>
        </div>

    <?} else {?>


        <form class="form" name="form_richiesta" id="form_richiesta" action="https://resources.suiteweb.it/ApiQuoto/get_form_quoto2.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" name="action" value="send" />
                        <input type="hidden" name="language" value="<?=$language?>" />
                        <input type="hidden" name="sfondo" value="<?=$sfondo_clean?>" />
                        <input type="hidden" name="testo" value="<?=$testo_clean?>" />
                        <input type="hidden" name="pulsante" value="<?=$pulsante_clean?>" />
                        <input type="hidden" name="radius" value="<?=$radius?>" />
                        <input type="hidden" name="bordo" value="<?=$bordo_clean?>" />
                        <input type="hidden" name="id_lingua" value="<?=$id_lingua?>" />
                        <input type="hidden" name="idsito" value="<?=$idsito?>" />
                        <input type="hidden" name="urlback" value="<?=$urlback?>"/>
                        <input type="hidden" name="iubenda" value="<?=$iubendapolicy?>" />
                        <input type="hidden" name="css_input" value="<?=$css_input?>" />
                        <input type="hidden" name="REMOTE_ADDR" value="<?=$Ip?>" />
                        <input type="hidden" name="HTTP_USER_AGENT" value="<?=$Agent?>" />
                        <input type="hidden" name="percorso" value="<?=$percorso?>" />
                        <input type="hidden" name="send_timeline" value="<?=$send_timeline?>" />
                        <input type="hidden" name="eqr" value="<?=$eqr?>" />
                        <input type="hidden" name="check_valid" value="<?=$check_valid?>" />
                        <input type="hidden" name="jqueryframe" value="<?=$jqueryframe?>" />
                        <input type="hidden" name="view_icon" value="<?=$view_icon?>" />
                        <input type="hidden" name="fontawesome" value="<?=$fontawesome?>" />
                        <input type="hidden" name="check_target" value="<?=$check_target?>" />
                        <input type="hidden" name="ritorno" value="<?=$ritorno?>" />
                        <input type="hidden" name="adulti" id="adulti<?=$idsito?>" value="" />
                        <input type="hidden" name="bambini" id="bambini<?=$idsito?>" value="" />
                        <input type="hidden" name="tracking" id="tracking" value="<?=$_REQUEST['tracking']?>"/>
                        <script>
                            $(document).ready(function(){
                                setTimeout(function(){ 
                                        <?php
                                                $CLIENT_ID_ = explode(".",$_REQUEST['_ga']);
                                                $CLIENT_ID = $CLIENT_ID_[2].'.'.$CLIENT_ID_[3];
                                        ?>
                                        $("#load_client_id").html('<input type="hidden" name="CLIENT_ID" value="<?=$CLIENT_ID?>" />');
                                }, 3000);
                            });
                        </script>
                        <div id="load_client_id"></div>
                    </div>
                </div>
                <div class="ca10"></div>
        <div class="card">
        <div class="card-header"><span class="titolo-card"><?=$form['dati-personali'][$language]?></span></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                            <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-user oninput"></i></div><?}?>
                                <input type="text" name="nome" id="nome" placeholder="<?=$form['nome'][$language]?> *" autocomplete="off" class="form-control <?=$css_input?>" />
                            </div>
                            <div class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                            <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-user oninput"></i></div><?}?>
                                <input type="text" name="cognome" id="cognome" placeholder="<?=$form['cognome'][$language]?> *" autocomplete="off" class="form-control <?=$css_input?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                            <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-envelope oninput"></i></div><?}?>
                                <input type="email" name="email" id="email" placeholder="<?=$form['email'][$language]?> *" autocomplete="off" class="form-control <?=$css_input?>" />
                                <?php if($check_valid==1){?><small id="check_email"></small><?}?>
                            </div>
                            <div class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                            <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-phone oninput"></i></div><?}?>
                                <input type="text" name="telefono" id="telefono" placeholder="<?=$form['telefono'][$language]?>" autocomplete="off" class="form-control <?=$css_input?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ca10"></div>
        <div class="card">
        <div class="card-header"><span class="titolo-card"><?=$form['date-soggiorno'][$language]?></span></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                                <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-calendar oninput"></i></div><?}?>
                                <input type="text" readonly="readonly" name="data_arrivo" id="data_arrivo_quoto"  placeholder="<?=$form['arrivo'][$language]?> *" autocomplete="off" class="form-control <?=$css_input?>" />
                            </div>
                            <div class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                                <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-calendar oninput"></i></div><?}?>
                                <input type="text" readonly="readonly" name="data_partenza" id="data_partenza_quoto"  placeholder="<?=$form['partenza'][$language]?> *" autocomplete="off" class="form-control <?=$css_input?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <small><a href="javascript:;" id="plus_date"><i class="fa fa-fw  fa-plus"></i> <?=$form['addDate'][$language]?></a></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div  id="date_alternative" style="display:none">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-calendar oninput"></i></div><?}?>
                                        <input readonly="readonly" id="DataArrivo_1_quoto" name="DataArrivo" type="text" placeholder="<?=$form['arrivo_alternativo'][$language]?> " autocomplete="off" class="form-control <?=$css_input?>" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-calendar oninput"></i></div><?}?>
                                        <input readonly="readonly" id="DataPartenza_1_quoto" name="DataPartenza" type="text" placeholder="<?=$form['partenza_alternativo'][$language]?>" autocomplete="off" class="form-control <?=$css_input?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ca10"></div>
        <div class="card">
        <div class="card-header"><span class="titolo-card"><?=$form['tuo-soggiorno'][$language]?></span></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12 padding-right-22">
                    <?php if(!$check_target){?>
                        <div class="ca10"></div>
                        <small id="legend"><?=$form['legendavacanza'][$language]?></small>
                        <div style="clear:both"></div>
                        <div class="row">
                            <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12">
                                <?php if($view_icon == 1){?><div class="icon-group"><i class="fa fa-fw  fa-globe onselect"></i></div><?}?>
                                <select name="TipoVacanza" id="TipoVacanza" class="form-control padding6-12 <?=$css_input?>">
                                    <option value="" selected="selected"><?=$form['target'][$language]?></option>
                                    <?=$ListaTarget?>
                                </select>
                            </div>
                        </div>
                    <?}?>
                        <div class="ca10"></div>
                        <small id="legend"><?=$form['legenda'][$language]?></small>
                        <div style="clear:both"></div>
                        <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-suitcase onselect"></i></div><?}?>
                                            <select name="TipoSoggiorno[]" id="TipoSoggiorno_1_1" class="form-control padding6-12 <?=$css_input?>">
                                                <option value="" selected="selected"><?=$form['trattamento'][$language]?> *</option>
                                                <?=$ListaSoggiorno?>
                                            </select>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-list onselect"></i></div><?}?>
                                        <select name="NumeroCamere[]" id="NumeroCamere_1_1" class="form-control padding6-12 <?=$css_input?>">
                                            <option value="" selected="selected">Nr.<?=$form['camere'][$language]?> *</option>
                                            <?=$NumeriC?>
                                        </select>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <?php if($view_icon == 1){?>    <div class="icon-group righeSogg"><i class="fa fa-fw  fa-bed onselect"></i></div><?}?>
                                    <select name="TipoCamere[]" id="TipoCamere_1_1" class="form-control padding6-12 <?=$css_input?>">
                                        <option value="" selected="selected"><?=$form['sistemazione'][$language]?> *</option>
                                            <?=$ListaCamere?>
                                    </select>

                                </div>

                        </div>
                        <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-male onselect"></i></div><?}?>
                                        <select name="NumAdulti[]" id="NumeroAdulti_1_1" class="form-control padding6-12 <?=$css_input?>" onchange="calcola_totale_adulti();">
                                            <option value="" selected="selected">Nr.<?=$form['adulti'][$language]?> *</option>
                                            <?=$NumeriAD?>
                                        </select>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-child onselect"></i></div><?}?>
                                        <select name="NumBambini[]" id="NumeroBambini_1_1" class="NumeroBambini_1_1 form-control padding6-12 <?=$css_input?>"  onchange="eta_bimbi('1_1');calcola_totale_bambini();equalizza_change_bambini();">
                                            <option value="" selected="selected">Nr.<?=$form['bambini'][$language]?></option>
                                            <?=$NumeriBimbi?>
                                        </select>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <input type="text"  name="EtaB[]" placeholder="<?=$form['bambini_eta'][$language]?>" class="form-control <?=$css_input?>" />
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                                    <small>
                                        <a href="javascript:;" id="add"  onclick="room_fields(1,'righe_room');checkDimension();">
                                            <i class="fa fa-fw  fa-plus"></i> <?=$form['addRoom'][$language]?>
                                        </a>
                                    </small>
                                </div>
                        </div>
                    <div id="righe_room"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="ca10"></div>
    <div class="card">
    <div class="card-header"><span class="titolo-card"><?=$form['comunicazioni'][$language]?></span></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <textarea name="messaggio" id="messaggio" rows="4" placeholder="<?=$form['messaggio'][$language]?>" class="form-control <?=$css_input?>"></textarea>
                            <div class="ca10"></div>
                            <div class="g-recaptcha" data-sitekey="<?=$chiave_sito_recaptcha?>"></div>
                            <div class="ca10"></div>
                            <input type="checkbox" id="marketing" name="marketing" value="on"><span class="txtprivacy"> <?=$form['consenso2'][$language]?></span><br>
                            <span id="view_profilazione" style="display:none"><input name="profilazione" id="profilazione" type="checkbox"  value="on" /><span class="txtprivacy"> <?=$form['consenso3'][$language]?></span><br></span>
                            <input name="privacy" id="privacy" type="checkbox"  value="checkbox" /><span class="txtprivacy"> <?=$form['consenso'][$language]?></span>
                            <?if ($iubendapolicy != '') {?>
                                <a href="//www.iubenda.com/privacy-policy/<?=$iubendapolicy?>" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy"><?=$form['informativa'][$language]?></a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
                            <?} else {?>
                                <a href="javascript:;" id="link_privacy" class="txtprivacy" title="Privacy Policy"><?=$form['informativa'][$language]?></a>
                            <div style="clear:both"></div>
                            <div  id="box_privacy" style="display:none;overflow-y: auto">
                                    <small>
                                    <?
                                        if (privacytxt($idsito, $language) != '') {
                                            echo privacytxt($idsito, $language);
                                        } else {
                                            echo $form['privacy'][$language];
                                        }
                                    ?>
                                    </small>
                            </div>
                            <?}?>
                            <div class="ca10"></div>
                            <div id="view_send_form_loading"></div>
                            <button class="SW-submit" type="submit" id="pulsante-invio"><?=$form['invia'][$language]?></button>
                            <div class="ca10"></div>
                            <?
                                switch($language){
                                    case"it":
                                        $text_req = 'campo obbligatorio';
                                    break;
                                    case"en":
                                        $text_req = 'required field';
                                    break;
                                    case"fr":
                                        $text_req = 'champ obligatoire';
                                    break;
                                    case"de":
                                        $text_req = 'Pflichtfeld';
                                    break;
                                    default:
                                        $text_req = 'required field';
                                    break;
                                }
                            ?>
                            <span class="txtprivacy">* <?=$text_req?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="ca10"></div>
    </form>
    <?}?>
</div>
<?} else {?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<b>Il Form dedicato a QUOTO non è più ablitato!</b><br>
						Per ripristinare il form classico sul vostro sito<br>
            Contattare:<br>
            <b>Network Service</b><br>
            Via Valentini A. e L., 11 47922 Rimini (RN), Italia <br>
            <b>Tel:</b> +39 0541790062 | <b>Fax:</b> +39 0541778656<br>
            <b>Email:</b> info@network-service.it
      </div>
    </div>
<?}?>
<?$db->disconnect();?>
<?$db_quoto->disconnect();?>
