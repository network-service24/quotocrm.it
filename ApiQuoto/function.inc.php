<?php
function mini_clean($stringa){

    $clean_title = str_replace( "*", "", $stringa );
    $clean_title = str_replace( "'", "", $clean_title );
    $clean_title = str_replace( "/", "", $clean_title );
    $clean_title = str_replace( "\"", "", $clean_title );
    $clean_title = trim($clean_title);

    return($clean_title);
}
// funzione per il top email
function top_email($hotel,$base_url){

    $top = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
            <head>
                <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
                <title>".$hotel."</title>
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".$base_url."css/style_email.css\" />
                <style>
                    @charset \"UTF-8\";

                @font-face {
                  font-family: 'Source Sans Pro';
                  font-style: normal;
                  font-weight: 300;
                  src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(".$base_url."css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format('woff');
                }
                @font-face {
                  font-family: 'Source Sans Pro';
                  font-style: normal;
                  font-weight: 400;
                  src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(".$base_url."css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                }
                @font-face {
                  font-family: 'Source Sans Pro';
                  font-style: normal;
                  font-weight: 700;
                  src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(".$base_url."css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                }

                @font-face {
                  font-family: 'Vollkorn';
                  font-style: normal;
                  font-weight: 400;
                  src: local('Vollkorn Regular'), local('Vollkorn-Regular'), url(".$base_url."css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                }
                @font-face {
                  font-family: 'Vollkorn';
                  font-style: normal;
                  font-weight: 700;
                  src: local('Vollkorn Bold'), local('Vollkorn-Bold'), url(".$base_url."css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format('woff');
                }

                body { margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
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
function secondsToTime($inputSeconds) {

$secondsInAMinute = 60;
$secondsInAnHour  = 60 * $secondsInAMinute;
$secondsInADay    = 24 * $secondsInAnHour;

// extract days
$days = floor($inputSeconds / $secondsInADay);

// extract hours
$hourSeconds = $inputSeconds % $secondsInADay;
$hours = floor($hourSeconds / $secondsInAnHour);

// extract minutes
$minuteSeconds = $hourSeconds % $secondsInAnHour;
$minutes = floor($minuteSeconds / $secondsInAMinute);

// extract the remaining seconds
$remainingSeconds = $minuteSeconds % $secondsInAMinute;
$seconds = ceil($remainingSeconds);

// return the final array
$obj = array(
'd' => (int) $days,
'h' => (int) $hours,
'm' => (int) $minutes,
's' => (int) $seconds,
);
return '['.sprintf("%02s", $obj['h']).':'.sprintf("%02s", $obj['m']).':'.sprintf("%02s", $obj['s']).']';
}

function check_double_syncro_form_sito($idsito,$NumeroPrenotazione){
    global $db_quoto;
        $select    = "SELECT COUNT(NumeroPrenotazione) as numero FROM hospitality_guest WHERE idsito = ".$idsito." AND NumeroPrenotazione = ".$NumeroPrenotazione." AND TipoRichiesta = 'Preventivo'";
        $risultato = $db_quoto->query($select);
        $row       = $risultato[0];
        return $row['numero'];
}
function NewNumeroPreno($idsito){
    global $db_quoto;
        $select2             = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".$idsito." ORDER BY NumeroPrenotazione DESC";
        $res2                = $db_quoto->query($select2);
        $rws                 = $res2[0];
        $numero_prenotazione =  (intval($rws['NumeroPrenotazione'])+1);
        return $numero_prenotazione;
}
function get_timeline($percorso,$send_timeline){

if(isset($percorso)){
    // recupero le pagine e l'eventuale referer generato dall'utente
    $info_guest = json_decode($percorso);
}
// recupero le pagine e l'eventuale referer generato dall'utente
if(is_object($info_guest)){
    $testo_info_guest .= '	<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
                                <tr>
                                    <td>';

    // HTTP_USER_AGENT
    if(isset($info_guest->user_data->HTTP_USER_AGENT)){
        $testo_info_guest .= '			<strong>Browser utilizzato</strong>: '.$info_guest->user_data->HTTP_USER_AGENT.'<br />';
    }

    // HTTP_REFERER
    if(isset($info_guest->user_data->HTTP_REFERER)){
        $testo_info_guest .= '			<strong>Provenienza</strong>: '.$info_guest->user_data->HTTP_REFERER.'<br />';
    }

    // REMOTE_ADDR
    if(isset($info_guest->user_data->REMOTE_ADDR)){
        $testo_info_guest .= '			<strong>IP di Provenienza</strong>: '.$info_guest->user_data->REMOTE_ADDR.'<br />';
        $indirizzoIp = $info_guest->user_data->REMOTE_ADDR;
    }

    // TIMELINE
    $testo_info_guest .= '				<br />
                                        <strong>Timeline (sequenza delle pagine visitate):</strong><br />
                                        <ul>';
    $tempo_tot = 0;

    foreach($info_guest->timeline as $k => $v){
        if (strpos($v->url, 'image.php?') == false && $v->time > 0) {
            if(!strstr($v->url,'inc_check_valid_email.php')){
            $testo_info_guest .= '<li>'.$datiSito['web'].$v->url.' ('.secondsToTime($v->time).').</li>';
            $tempo_tot += $v->time;
          }
        }
    }

    // fine TIMELINE + TOTALE TEMPO
    $testo_info_guest .= '				</ul>
                                        <strong>Tempo totale sul sito: '.secondsToTime($tempo_tot).'
                                    </td>
                                </tr>
                            </table>';
}
if($send_timeline == '1'){
    return $testo_info_guest;
}else{
    return '';
}

}

function privacytxt($idsito,$language)
{
global $db_quoto;
$html_txt_trattamento = '';


      $sql_testi = 'SELECT 
                        hospitality_dizionario_lingua.testo 
                    FROM 
                        hospitality_dizionario 
                    INNER JOIN 
                        hospitality_dizionario_lingua 
                    ON 
                     hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE 
                        hospitality_dizionario_lingua.idsito =' . $idsito . ' 
                    AND 
                        hospitality_dizionario.idsito = ' . $idsito . ' 
                    AND 
                        hospitality_dizionario_lingua.Lingua = "' . $language . '" 
                    AND 
                        hospitality_dizionario.etichetta = "INFORMATIVA_PRIVACY" 
                    LIMIT 1';
      $testi_    = $db_quoto->query($sql_testi);
      if ($testi_ && isset($testi_[0])) {
          $testi = $testi_[0];

          $sql_dati = 'SELECT
                            *,
                            siti.nome as nome_sito
                        FROM
                            siti
                            LEFT JOIN utenti on utenti.idsito = siti.idsito
                            LEFT JOIN anagrafica on anagrafica.idanagra = utenti.idanagra
                            LEFT JOIN comuni on comuni.codice_comune = siti.codice_comune
                            LEFT JOIN province on province.codice_provincia = siti.codice_provincia
                        WHERE
                            siti.idsito=' . $idsito . '
                        LIMIT 1';
          $dati_ = $db->query($sql_dati);

          if ($dati_ && isset($dati_[0])) {
              $dati              = $dati_[0];
              $dati['citta']     = $dati['nome_comune'];
              $dati['provincia'] = $dati['sigla_provincia'];
              if ($testi && isset($testi)) {
                  $html_txt_trattamento = '';
                if (isset($testi['testo']) && $testi['testo'] != '') {
                    $txt_trattamento       =  $testi['testo'];
                    $html_txt_trattamento  =  $txt_trattamento . '<p>&nbsp;</p>';
                }

              foreach ($dati as $k => $v) {
                  $html_txt_trattamento = str_replace('{!' . $k . '!}', '<b>' . $v . '</b>', $html_txt_trattamento);
              }

              return '<span>' . $html_txt_trattamento . '</span>';
          }
      }

  }
}
function from_id_to_cod($value)
{

        switch($value) {
                case"1":
                    $cod_lang = 'it';
                break;
                case"2":
                    $cod_lang = 'en';
                break;
                case"3":
                    $cod_lang = 'fr';
                break;
                case"4":
                    $cod_lang = 'de';
                break;
                case"5":
                    $cod_lang = 'es';
                break;
                case"6":
                    $cod_lang = 'ru';
                break;
                case"7":
                    $cod_lang = 'nl';
                break;
                case"8":
                    $cod_lang = 'pl';
                break;
                case"9":
                    $cod_lang = 'hu';
                break;

                case"10":
                    $cod_lang = 'pt';
                break;

                case"11":
                    $cod_lang = 'ae';
                break;

                case"12":
                    $cod_lang = 'cz';
                break;

                case"13":
                    $cod_lang = 'cn';
                break;
                case"14":
                    $cod_lang = 'br';
                break;
                case"15":
                    $cod_lang = 'jp';
                break;

            }


        return $cod_lang;
    }

    function field_clean($stringa){

        $clean_title = str_replace( "!", "", $stringa );
        $clean_title = str_replace( "?", "", $clean_title );
        $clean_title = str_replace( ":", "", $clean_title );
        $clean_title = str_replace( "+", "", $clean_title );
        $clean_title = str_replace( "à", "a", $clean_title );
        $clean_title = str_replace( "è", "e", $clean_title );
        $clean_title = str_replace( "é", "e", $clean_title );
        $clean_title = str_replace( "ì", "i", $clean_title );
        $clean_title = str_replace( "ò", "o", $clean_title );
        $clean_title = str_replace( "ù", "u", $clean_title );
        $clean_title = str_replace( "n.", "", $clean_title );
        $clean_title = str_replace( ".", "", $clean_title );
        $clean_title = str_replace( ",", "", $clean_title );
        $clean_title = str_replace( ";", "", $clean_title );
        $clean_title = str_replace( "'", "", $clean_title );
        $clean_title = str_replace( "*", "", $clean_title );
        $clean_title = str_replace( "/", "", $clean_title );
        $clean_title = str_replace( "\"", "", $clean_title );
        $clean_title = str_replace( " ", "", $clean_title );
        $clean_title = strtolower($clean_title);
        $clean_title = trim($clean_title);
    
        return($clean_title);
    }

    function clean_email($valore){

        $clean_valore = str_replace( "'", "", $valore );
        $clean_valore = str_replace( "?", "", $clean_valore );
        $clean_valore = str_replace( ":", "", $clean_valore );
        $clean_valore = str_replace( "+", "", $clean_valore );
        $clean_valore = str_replace( "à", "a", $clean_valore );
        $clean_valore = str_replace( "è", "e", $clean_valore );
        $clean_valore = str_replace( "é", "e", $clean_valore );
        $clean_valore = str_replace( "ì", "i", $clean_valore );
        $clean_valore = str_replace( "ò", "o", $clean_valore );
        $clean_valore = str_replace( "ù", "u", $clean_valore );
        $clean_valore = str_replace( ",", "", $clean_valore );
        $clean_valore = str_replace( ";", "", $clean_valore );
        $clean_valore = str_replace( "*", "", $clean_valore );
        $clean_valore = str_replace( "/", "", $clean_valore );
        $clean_valore = str_replace( "\"", "", $clean_valore );
        $clean_valore = str_replace( "#", "", $clean_valore );
        $clean_valore = trim($clean_valore);
    
        return($clean_valore);
    }
  ?>