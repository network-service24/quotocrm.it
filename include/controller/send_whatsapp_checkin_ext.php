<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {

    function clean($stringa){

        $clean_title = str_replace( "à", "a", $stringa );
        $clean_title = str_replace( "è", "e", $clean_title );
        $clean_title = str_replace( "é", "e", $clean_title );
        $clean_title = str_replace( "ì", "i", $clean_title );
        $clean_title = str_replace( "ò", "o", $clean_title );
        $clean_title = str_replace( "ù", "u", $clean_title );
    
        return($clean_title);
    }
         // query per i dati della richiesta
         $sel  = $dbMysqli->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_GET['param']);
         $dati = $sel[0];        
 
         // assegno alcune variabili
         $IdRichiesta    = $dati['Id'];
         $Nome           = stripslashes($dati['Nome']);
         $Cognome        = stripslashes($dati['Cognome']);  
         $Email          = $dati['Email'];
         $Operatore      = $dati['ChiPrenota'];
         $prefisso       = ($dati['PrefissoInternazionale']==''?'39':$dati['PrefissoInternazionale']);
         $Cellulare      = $dati['Cellulare'];
         if($Operatore == ''){
                 $Operatore = NOMEHOTEL;
         }
         $EmailOperatore = $dati['EmailSegretaria'];
         if($EmailOperatore == ''){
                 $EmailOperatore = EMAILHOTEL;
         }  
         $Lingua = $dati['Lingua']; 
         $idsito = $dati['idsito'];
 
 
         include($_SERVER['DOCUMENT_ROOT'].'/lingue/lang.php');
 
 
         $select = $dbMysqli->query('SELECT siti.*,utenti.logo,
                                     comuni.nome_comune as comune,
                                     province.sigla_provincia as prov
                                     FROM siti 
                                     INNER JOIN utenti ON utenti.idsito = siti.idsito
                                     INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                     INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                     WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"');
         $rows =  $select[0];
         $sito_tmp    = str_replace("http://","",$rows['web']);
         $sito_tmp    = str_replace("www.","",$sito_tmp);
         if($rows['https']==1){
             $http = 'https://';
         }else{
             $http = 'http://';
         }
         $SitoWeb   = $http.'www.'.$sito_tmp;        
         $logo      = $rows['logo'];
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
 
        $link = (URL_LANDING.'checkin/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.IDSITO).'/index/');

            if(strlen($Cellulare)>3 && $Cellulare != ''){

                $update = "UPDATE hospitality_guest SET CheckinInviato = 1 WHERE Id = ".$IdRichiesta;
                $dbMysqli->query($update);
                

                $WhatsApp      = str_replace(" ", "",$Cellulare);
                $WhatsApp      = str_replace(".", "",$WhatsApp);
                $WhatsApp      = str_replace("+", "",$WhatsApp);

                $WhatsApp      = $prefisso.$WhatsApp;
                $testo         = str_replace("[cliente]",(stripslashes($dati['Nome']).' '.stripslashes($dati['Cognome'])),TESTOMAIL_CHECKIN);
                $testo         = str_replace("Livì","Livi'",$testo);
                $testo         = str_replace("&nbsp;"," ", $testo);
                $testo         = str_replace("&#39;","'", $testo);
                $testo         = str_replace("&agrave;","a'", $testo);
                $testo         = str_replace("&eacute;","e'", $testo);
                $testo         = str_replace("&egrave;","e'", $testo);
                $testo         = str_replace("&igrave;","i'", $testo);
                $testo         = str_replace("&ograve;","o'", $testo);
                $testo         = str_replace("&ugrave;","u'", $testo);
                $testo         = str_replace("&rsquo;","'",$testo);
                $testo         = str_replace("&hellip;","...",$testo);
                $testo         = str_replace("...","",$testo);
                $testo         = NOMEHOTEL."\r\n".$testo."\r\n";
                $testo        .= TXTLINK7."\r\n";
                $TestoWhatsApp = urlencode(strip_tags(utf8_encode(clean($testo))).$link);

                  
                $prt->_goto('https://api.whatsapp.com/send?phone='.$WhatsApp.'&text='.$TestoWhatsApp);
           
     

            }

}
