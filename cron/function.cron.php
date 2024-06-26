<?php
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

    function check_double_syncro_form_sito($idsito,$NumeroPrenotazione){
        global $dbMysqli;
        $select    = "SELECT COUNT(NumeroPrenotazione) as numero FROM hospitality_guest WHERE idsito = ".$idsito." AND NumeroPrenotazione = ".$NumeroPrenotazione." AND TipoRichiesta = 'Preventivo'";
        $risultato = $dbMysqli->query($select);
        $row       = $risultato[0];
        return $row['numero'];
    }
    
    function syncro_form_sito($idsito,$sitoweb,$data_attivazione){
            global $dbMysqli;
    
            $json_output = array();
    
             # seleziono solo le mail che fanno riferimento al sito e che hanno syncro_hospitality a 0, cioè che non siano mai state importate prima!
            $select = "SELECT id_notifica,json_richiesta,data_invio, oggetto_notifica FROM notifiche WHERE id_sito_riferimento = ".$idsito." AND syncro_hospitality = 0 AND data_invio >= '".$data_attivazione."' ORDER BY id_notifica DESC";
    
            $result = $dbMysqli->query($select);

            $tot    = sizeof($result);

            if($tot > 0){
    
                // azzero le variabile
                $email_hotel                   = '';
                $id_lingua                     = '';
                $lingua                        = '';
                $nome                          = '';
                $cognome                       = '';
                $email_utente                  = '';
                $cellulare                     = '';
                $data_arrivo                   = '';
                $data_partenza                 = '';
                $DataArrivo                    = '';
                $DataPartenza                  = '';
                $numero_adulti                 = '';
                $numero_bambini                = '';
                $trattamento                   = '';
                $sistemazione                  = '';
                $tipo_richiesta                = '';
                $note                          = '';
                $insert                        = '';
                $update                        = '';
                $numero_prenotazione           = '';
                $data_A_tmp                    = '';
                $dataAtmp                      = '';
                $dataAtmp2                     = '';
                $data_P_tmp                    = '';
                $dataPtmp                      = '';
                $dataPtmp2                     = '';
                $bambini_eta                   = '';
                $hotel                         = '';
                $info_percorso                 = '';
                $provenienza                   = '';
                $timeline                      = '';
                $insert_t                      = '';
                $RigheCompilate                = '';
                $n_righe                       = '';
                $ConsensoMarketing             = '';
                $ConsensoProfilazione          = '';
                $ConsensoPrivacy               = '';
                $TipoVacanza                   = '';
    
                foreach ($result as $key => $value) {
                    if(!strstr($value['oggetto_notifica'],'Newsletter')){
                        # assegno array con chive id della richiesta ricevuto dal sito ed i valori in json di tutta la mail
                        $json_output[$value['id_notifica'].'#'.$value['data_invio']] = json_decode($value['json_richiesta'], true);
                    }
                } // chiusura del foreach
    
                    //print_r($json_output); exit;
    
                // azzero le variabile
                $data_arrivo          = '';
                $data_partenza        = '';
                $data_A_tmp           = '';
                $dataAtmp             = '';
                $dataAtmp2            = '';
                $data_P_tmp           = '';
                $dataPtmp             = '';
                $dataPtmp2            = '';
                $DataArrivo           = '';
                $DataPartenza         = '';
                $data_A_tmp_alt       = '';
                $dataAtmpAlternativa  = '';
                $dataAtmp2Alternativa = '';
                $data_P_tmp_alt       = '';
                $dataPtmpAlternativa  = '';
                $dataPtmp2Alternativa = '';
                $RigheCompilate       = '';
                $n_righe              = '';
                $check                = '';
                $numero_prenotazione  = '';
    
    
                foreach ($json_output as $k => $v) {
    
    
                            $select2             = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".$idsito." ORDER BY NumeroPrenotazione DESC";
                            $res2                = $dbMysqli->query($select2);
                            $rws                 = $res2[0];
                            $numero_prenotazione =  (intval($rws['NumeroPrenotazione'])+1);
                    # checkse è già stato inserito
                    $check = check_double_syncro_form_sito($idsito,$numero_prenotazione);
                    if($check==0){
                            $_tmp = explode("#",$k);
                            $id_notifica = $_tmp[0];
                            $data_richiesta = date('Y-m-d',$_tmp[1]);
                            // assegno il valore alle variabili
                            $email_hotel    =  $v['destinatario_email'];
                            $id_lingua      =  $v['id_lingua'];
                            $lingua         =  from_id_to_cod($id_lingua);
                            $nome           =  $v['nome'];
                            $cognome        =  $v['cognome'];
                            $email_utente   =  $v['email'];
                            $cellulare      =  field_clean($v['telefono']);
                            $dataAtmp       =  explode("/",$v['data_arrivo']);
                            $dataAtmp2      =  explode("-",$v['data_arrivo']);
    
                            if($dataAtmp[1]!=''){
                                $data_A_tmp = $dataAtmp;
                            }elseif($dataAtmp2[1]!=''){
                                $data_A_tmp = $dataAtmp2;
                            }
                            $data_arrivo    =  $data_A_tmp[2].'-'.$data_A_tmp[1].'-'.$data_A_tmp[0];
    
                            $dataPtmp       =  explode("/",$v['data_partenza']);
                            $dataPtmp2      =  explode("-",$v['data_partenza']);
                            if($dataPtmp[1]!=''){
                                $data_P_tmp = $dataPtmp;
                            }elseif($dataPtmp2[1]!=''){
                                $data_P_tmp = $dataPtmp2;
                            }
                            $data_partenza  =  $data_P_tmp[2].'-'.$data_P_tmp[1].'-'.$data_P_tmp[0];
    
                            if($v['data_arrivo'] == ''){$data_arrivo=date('Y-m-d');}
                            if($v['data_partenza'] == ''){$data_partenza=date('Y-m-d');}
    
    
                            $dataAtmpAlternativa       =  explode("/",$v['DataArrivo']);
                            $dataAtmp2Alternativa      =  explode("-",$v['DataArrivo']);
    
                            if($dataAtmpAlternativa[1]!=''){
                                $data_A_tmp_alt = $dataAtmpAlternativa;
                            }elseif($dataAtmp2Alternativa[1]!=''){
                                $data_A_tmp_alt = $dataAtmp2Alternativa;
                            }
                            $DataArrivo    =  $data_A_tmp_alt[2].'-'.$data_A_tmp_alt[1].'-'.$data_A_tmp_alt[0];
    
                            $dataPtmpAlternativa       =  explode("/",$v['DataPartenza']);
                            $dataPtmp2Alternativa      =  explode("-",$v['DataPartenza']);
                            if($dataPtmpAlternativa[1]!=''){
                                $data_P_tmp_alt = $dataPtmpAlternativa;
                            }elseif($dataAtmp2Alternativa[1]!=''){
                                $data_P_tmp_alt = $dataPtmpAlternativa;
                            }
                            $DataPartenza  =  $data_P_tmp_alt[2].'-'.$data_P_tmp_alt[1].'-'.$data_P_tmp_alt[0];
    
                            if($v['TipoSoggiorno']){
                                $n_righe = count($v['TipoSoggiorno']);
                                $i=0;
                                $RigheCompilate  = '';
                                for($i==0; $i<=($n_righe-1); $i++){
                                    $RigheCompilate  .= ($v['TipoSoggiorno'][$i]!=''?' - Trattamento: '.$v['TipoSoggiorno'][$i]:'').' '.($v['NumeroCamere'][$i]!=''?' &#10230; Nr.: ' .$v['NumeroCamere'][$i].'  ':'').' '.($v['TipoCamere'][$i]!=''?' &#10230; Sistemazione: '.$v['TipoCamere'][$i]:'').' '.($v['NumAdulti'][$i]!=''?' &#10230; Nr.Adulti: '.$v['NumAdulti'][$i]:'').' '.($v['NumBambini'][$i]!=''?' &#10230; Nr.Bambini: '.$v['NumBambini'][$i]:'').' '.($v['EtaB'][$i]!=''?' &#10230; Età: '.$v['EtaB'][$i]:'')."\r\n";
                                }
                            }
                            $numero_adulti  =  $v['adulti'];
                            $numero_bambini =  $v['bambini'];
                            $trattamento    =  $v['trattamento'];
                            $bambini_eta    =  $v['bambini_eta'];
                            $sistemazione   =  $v['sistemazione'];
                            $TipoVacanza    =  $v['TipoVacanza'];;
                            $hotel          =  $v['hotel'];
                            $tipo_richiesta =  $v['tipo_richiesta'];
                            $note           =  ($bambini_eta !=''?'Età bambini: '.$bambini_eta.'; ':'').' '.($sistemazione !=''?'Sistemazione: '.$sistemazione.'; ':'').' '.($trattamento !=''?' Trattamento: '.$trattamento.'; ':'');
                            $note          .=  (($v['DataArrivo']!='' || $v['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$v['DataArrivo'].' Data Partenza Alternativa: '.$v['DataPartenza']."\r\n":'');
                            $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                            $note          .=  ($v['messaggio']!=''?"\r\n".'Note: '.$v['messaggio']:'');
    
                            $ConsensoMarketing    = ($v['marketing']=='on'?1:0);
                            $ConsensoProfilazione = ($v['profilazione']=='on'?1:0);
                            $ConsensoPrivacy      = ($v['privacy']=='checkbox' || $v['privacy']=='consenso'?1:0);
                            $Ip                   = $v['REMOTE_ADDR'];
                            $Agent                = $v['HTTP_USER_AGENT'];
    
                            if($nome != '' && $cognome != '' && $v['data_arrivo'] != '' && $v['data_partenza'] != ''){
    
    
                                        # inserimento dati form richiesta informazioni del sito
                                        $insert = "INSERT INTO hospitality_guest(idsito,
                                                                                id_politiche,
                                                                                Nome,
                                                                                Cognome,
                                                                                EmailSegretaria,
                                                                                Cellulare,
                                                                                Email,
                                                                                NumeroPrenotazione,
                                                                                DataArrivo,
                                                                                DataPartenza,
                                                                                FontePrenotazione,
                                                                                Note,
                                                                                TipoRichiesta,
                                                                                TipoVacanza,
                                                                                Lingua,
                                                                                NumeroAdulti,
                                                                                NumeroBambini,
                                                                                DataRichiesta,
                                                                                CheckConsensoPrivacy,
                                                                                CheckConsensoMarketing,
                                                                                CheckConsensoProfilazione,
                                                                                Ip,
                                                                                Agent)
                                                                                VALUES('".$idsito."',
                                                                                            '0',
                                                                                            '".addslashes($nome)."',
                                                                                            '".addslashes($cognome)."',
                                                                                            '".$email_hotel."',
                                                                                            '".$cellulare."',
                                                                                            '".$email_utente."',
                                                                                            '".$numero_prenotazione."',
                                                                                            '".$data_arrivo."',
                                                                                            '".$data_partenza."',
                                                                                            '".(($hotel=="" || $hotel=="--")?"Sito Web":addslashes($hotel))."',
                                                                                            '".addslashes($note)."',
                                                                                            'Preventivo',
                                                                                            '".$TipoVacanza."',
                                                                                            '".$lingua."',
                                                                                            '".$numero_adulti."',
                                                                                            '".$numero_bambini."',
                                                                                            '".$data_richiesta."',
                                                                                            '".$ConsensoPrivacy."',
                                                                                            '".$ConsensoMarketing."',
                                                                                            '".$ConsensoProfilazione."',
                                                                                            '".$Ip."',
                                                                                            '".$Agent."')";
                                        $db->query($insert);
    
                                        // CODICE PER IL TRACCIAMENTO DELLA PROVENINEZA DA SITO WEB, SE DA CAMPAGNA FB, PPC, GOOGLE; ECC
                                        $info_percorso = json_decode($v['percorso']);
                                        if(isset($info_percorso)){
                                            // HTTP_REFERER
                                            if(isset($info_percorso->user_data->HTTP_REFERER)){
                                                $provenienza = $info_percorso->user_data->HTTP_REFERER;
                                            }
                                            if(isset($info_percorso->timeline)){
                                                foreach($info_percorso->timeline as $x => $y){
                                                  if (strpos($y->url, 'image.php?') == false && $y->time > 0) {
                                                    if(!strstr($y->url,'inc_check_valid_email.php')){
                                                      $Tline = $sitoweb.$y->url;
                                                      $insert_t = "INSERT INTO hospitality_fonti_provenienza(idsito,
                                                                                                              NumeroPrenotazione,
                                                                                                              Provenienza,
                                                                                                              Timeline)
                                                                                                              VALUES('".$idsito."',
                                                                                                              '".$numero_prenotazione."',
                                                                                                              '".addslashes($provenienza)."',
                                                                                                              '".addslashes($Tline)."')";
                                                      $dbMysqli->query($insert_t);
                                                    }
                                                  }
                                                }
                                            }
    
    
                                        }
    
                                        #azzero vabilibili
                                        $check                = '';
                                        $numero_prenotazione  = '';
                                        #################################################################################################
                                        #
                                        # update campo syncro_hospitality nella tabella notifiche per non importare 2 volte la stessa mail
                                        //$update = "UPDATE notifiche SET syncro_hospitality = 1 WHERE id_notifica = ".$id_notifica;
                                        //$dbMysqli->query($update);
    
                            }// chiusrua se non ci sono compilati i campi:nome cognome data arrivo e partenza
    
                    }//chiusura se il numeroprenotazione è già presente
    
                } // chiusura del foreach
    
                $syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                $dbMysqli->query($syncro);

                $output = 'Sincronia del '.date('d-m-Y H:i:s').' con richieste informazioni per  '.$sitoweb.' avvenuta con successo'."\r\n";  
            }else{
                $output = 'Nessuna sincronizzazione in data '.date('d-m-Y H:i:s').' per '.$sitoweb.''."\r\n"; 
            }

    echo $output;
    
    }
?>