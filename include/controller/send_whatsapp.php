<?php
if($_REQUEST['azione'] == 'send' && $_REQUEST['param'] != '') {
    
         // query per i dati della richiesta
        $sel  = "SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['param'];
        $result = $dbMysqli->query($sel);
        $dati  = $result[0];           
       // giro le date in formato IT
        $DataA_tmp        = explode("-",$dati['DataArrivo']);
        $DataArrivo       = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
        $DataP_tmp        = explode("-",$dati['DataPartenza']);
        $DataPartenza     = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
        // assegno alcune variabili
        $IdRichiesta      = $dati['Id'];
        $idsito           = $dati['idsito'];
        $AccontoRichiesta = $dati['AccontoRichiesta'];
        $AccontoLibero    = $dati['AccontoLibero'];
        $TemplateEmail    = $dati['TemplateEmail'];
        $AbilitaInvio     = $dati['AbilitaInvio'];
        $TipoRichiesta    = $dati['TipoRichiesta'];
        $Nome             = stripslashes($dati['Nome']);
        $Cognome          = stripslashes($dati['Cognome']);
        $NumeroAdulti     = $dati['NumeroAdulti'];
        $NumeroBambini    = $dati['NumeroBambini'];  
        $EtaBambini1      = $dati['EtaBambini1']; 
        $EtaBambini2      = $dati['EtaBambini2']; 
        $EtaBambini3      = $dati['EtaBambini3']; 
        $EtaBambini4      = $dati['EtaBambini4'];       
        $Email            = $dati['Email'];
        $Operatore        = $dati['ChiPrenota'];
        $prefisso         = ($dati['PrefissoInternazionale']==''?'39':$dati['PrefissoInternazionale']);
        $Cellulare        = $dati['Cellulare'];
        if($Operatore == ''){
                $Operatore = NOMEHOTEL;
        }
        $EmailOperatore = $dati['EmailSegretaria'];
        if($EmailOperatore == ''){
                $EmailOperatore = EMAILHOTEL;
        }  
        $Note           = $dati['Note'];
        $Lingua         = $dati['Lingua'];  


        include($_SERVER['DOCUMENT_ROOT'].'/lingue/lang.php');

     

                $_soluzioneconf     =     SOLUZIONECONFERMATA;         
                $_datisoggiorno     =     DATISOGGIORNO;
                $_tiposoggiorno     =     TIPOSOGGIORNO;
                $_dataarrivo        =     DATAARRIVO;
                $_datapartenza      =     DATAPARTENZA;
                $_sistemazione      =     SISTEMAZIONE;
                $_note              =     NOTE;                              
                $_txtlink1          =     TXTLINK1;
                $_txtlink2          =     TXTLINK2;
                $_txtlink3          =     TXTLINK3;
                $_paginariservata   =     PAGINARISERVATA;
                $_saluti            =     SALUTI_H;
                $_offerta_dettaglio =     OFFERTA_DETTAGLIO;
                $_pagamento         =     PAGAMENTO;
                $_acconto           =     ACCONTO;
                $_tiporichiesta     =     ($dati['TipoRichiesta']=='Preventivo'?PREVENTIVO:CONFERMA);                              

        $ss = "SELECT 
                hospitality_proposte.Id as IdProposta,
                hospitality_proposte.CheckProposta as CheckProposta,
                hospitality_proposte.PrezzoL as PrezzoL,
                hospitality_proposte.PrezzoP as PrezzoP,
                hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
                hospitality_proposte.AccontoImporto as AccontoImporto
                FROM hospitality_proposte
                WHERE hospitality_proposte.id_richiesta = ".$_REQUEST['param']."
                GROUP BY hospitality_proposte.Id";
            $rec = $dbMysqli->query($sel);
            $PrezzoPC           = '';
            $AccontoPercentuale = '';
            $AccontoImporto     = '';
            foreach ($rec as $key => $value) {
                $PrezzoPC           = $value['PrezzoP']; 
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto     = $value['AccontoImporto'];
            }
    

                // query per i contenuti testuali ed oggetto della email  in base alla lingua ed al tipo di richiesta    
                $quy  = "SELECT * FROM hospitality_contenuti_email WHERE TipoRichiesta = '".$TipoRichiesta."' AND Lingua = '".$Lingua ."' AND idsito = ".IDSITO;
                $resT = $dbMysqli->query($quy);
                $rw   = $resT[0];         
                
                // query per alcuni dati inerenti al cliente: nome, Email, SitoWeb
                $selS = 'SELECT siti.*,
                                            comuni.nome_comune as comune,
                                            province.sigla_provincia as prov
                                            FROM siti 
                                            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                            WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"';
                $rws  =  $dbMysqli->query($selS);
                $rows = $rws[0];
                $sito_tmp    = str_replace("http://","",$rows['web']);
                $sito_tmp    = str_replace("www.","",$sito_tmp);
                if($rows['https']==1){
                    $http = 'https://';
                }else{
                    $http = 'http://';
                }
                $SitoWeb   = $http.'www.'.$sito_tmp;            
                $tel       = $rows['tel'];
                $fax       = $rows['fax'];
                $cap       = $rows['cap'];
                $indirizzo = $rows['indirizzo'];
                $comune    = $rows['comune'];
                $prov      = $rows['prov'];

                $directory_sito = str_replace(".it","",$sito_tmp);
                $directory_sito = str_replace(".com","",$directory_sito);
                $directory_sito = str_replace(".net","",$directory_sito);
                $directory_sito = str_replace(".biz","",$directory_sito);
                $directory_sito = str_replace(".eu","",$directory_sito);
                $directory_sito = str_replace(".de","",$directory_sito);
                $directory_sito = str_replace(".es","",$directory_sito);
                $directory_sito = str_replace(".fr","",$directory_sito);

                #tipo di template usato
                $grafica = $fun->check_template($rows['idsito']);
                $chek_l_t = $fun->check_landing_template($rows['idsito'],$IdRichiesta);
                if($chek_l_t != 'smart'){
                    $chek_l_t = $fun->check_landing_type_template($rows['idsito'],$IdRichiesta);
                }

                if($grafica != 'default'){
                    $grafica = $fun->check_landing_type_template($rows['idsito'],$IdRichiesta);
                }
                if($chek_l_t!=''){
                    
                    switch($dati['TipoRichiesta']) {
                        case "Preventivo":
                           if($chek_l_t=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');                        
                           }else{
                               $link = (BASE_URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');
                           }                
                        break;
                        case "Conferma":
                           if($chek_l_t=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');           
                            }else{
                                $link = (BASE_URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');
                            }
                        break;   
                    }

                }else{

                    switch($dati['TipoRichiesta']) {
                        case "Preventivo":
                           if($grafica=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');                 
                           }else{
                                $link = (BASE_URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');
                           }                
                        break;
                        case "Conferma":
                           if($grafica=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');               
                            }else{
                                $link = (BASE_URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');
                            }
                        break;   
                    }

                }


                // update della tabella hospitality_guest dove si segna l'invio e la data dell'invio stesso
                $dbMysqli->query("UPDATE hospitality_guest SET Inviata = 1, DataInvio = '".date('Y-m-d')."' , Metodoinvio = 'Whatsapp' WHERE Id = ".$IdRichiesta);

                $WhatsApp      = str_replace(" ", "",$Cellulare);
                $WhatsApp      = str_replace(".", "",$WhatsApp);
                $WhatsApp      = str_replace("+", "",$WhatsApp);

                $WhatsApp      = $prefisso.$WhatsApp;
                $testo         = str_replace("[cliente]",(stripslashes($dati['Nome']).' '.stripslashes($dati['Cognome'])),$rw['Messaggio']);
                $testo         = str_replace("Livì","Livi'",$testo);
                $testo         = str_replace("&nbsp;"," ", $testo);
                $testo         = str_replace("&#39;","'", $testo);
                $testo         = str_replace("&agrave;","a'", $testo);
                $testo         = str_replace("&eacute;","e'", $testo);
                $testo         = str_replace("&egrave;","e'", $testo);
                $testo         = str_replace("&igrave;","i'", $testo);
                $testo         = str_replace("&ograve;","o'", $testo);
                $testo         = str_replace("&ugrave;","u'", $testo);
                $testo         = str_replace("&uuml;","ü", $testo);
                $testo         = str_replace("&ouml;","ö", $testo);
                $testo         = str_replace("&szlig;","ß", $testo);
                $testo         = str_replace("&rsquo;","'",$testo);
                $testo         = str_replace("&hellip;","...",$testo);
                $testo         = str_replace("...","",$testo);


                $testo         = $testo."\r\n";
                if($TipoRichiesta == 'Preventivo') { 
                    $testo        .= TXTLINK1."\r\n";
                }
                if($TipoRichiesta == 'Conferma') { 
                    $testo        .= TXTLINK3."\r\n";
                }

                switch ($Lingua) {
                    case 'it':
                        $TWApp = 'Se non si riesce a visualizzare l\'offerta, copiare ed incollare il link nel browser'."\r\n"."\r\n";
                        break;
                    case 'en':
                        $TWApp = 'If the link is not active, copy and paste the link into your browser'."\r\n"."\r\n";
                    break;
                    case 'fr':
                        $TWApp = 'Si le lien n\'est pas actif, copiez et collez le lien dans votre navigateur'."\r\n"."\r\n";
                        break;
                    case 'de':
                        $TWApp = 'Wenn der Link nicht aktiv ist, kopieren Sie den Link und fügen Sie ihn in Ihren Browser ein'."\r\n"."\r\n";
                        break;                    
                }

                if($Lingua == 'de'){
                    $TestoWhatsApp = (urlencode(strip_tags(($testo)).$TWApp.$link));
                }else{
                    $TestoWhatsApp = urlencode(strip_tags(utf8_encode($testo)).$TWApp.$link);
                }

                ##LOG##
                if($TipoRichiesta=='Conferma'){
                    $_REQUEST['spedito'] = 'Conferma';
                }
                if($TipoRichiesta=='Preventivo'){
                    $_REQUEST['spedito'] = 'Preventivo';
                }
                $_REQUEST['id_richiesta'] = $_REQUEST['param'];
                $_REQUEST['action']       = 'send_whatsapp';
                include($_SERVER['DOCUMENT_ROOT'].'/include/template/moduli/logs.inc.php');
                ##LOG##


                if($TipoRichiesta == 'Preventivo') { 
                   
                   $prt->_goto('https://api.whatsapp.com/send?phone='.$WhatsApp.'&text='.$TestoWhatsApp);
                }
                
                if($TipoRichiesta == 'Conferma') {                    
                    $prt->_goto('https://api.whatsapp.com/send?phone='.$WhatsApp.'&text='.$TestoWhatsApp);
                }
  
}
