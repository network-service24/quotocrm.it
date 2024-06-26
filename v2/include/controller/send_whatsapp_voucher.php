<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {

         // query per i dati della richiesta
        $db->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_GET['param']);
        $dati = $db->row();        

        // assegno alcune variabili
        $IdRichiesta    = $dati['Id'];
        $Nome           = stripslashes($dati['Nome']);
        $Cognome        = stripslashes($dati['Cognome']);
        $prefisso       = ($dati['PrefissoInternazionale']==''?'39':$dati['PrefissoInternazionale']);
        $Cellulare      = $dati['Cellulare'];


    if(strlen($Cellulare)<3 || $Cellulare == ''){
        $prt->alertgo('Il numero di Cellulare non è presente, modificare la conferma e compilare il campo!',BASE_URL_SITO.'conferme/');
        exit;
    }else{

        $Operatore      = $dati['ChiPrenota'];
        if($Operatore == ''){
                $Operatore = NOMEHOTEL;
        }
        $EmailOperatore = $dati['EmailSegretaria'];
        if($EmailOperatore == ''){
                $EmailOperatore = EMAILHOTEL;
        }  
        $Lingua         = $dati['Lingua']; 

        include($_SERVER['DOCUMENT_ROOT'].'/v2/lingue/lang.php');

        $db_suiteweb->query('SELECT siti.*,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                    WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"');
        $rows =  $db_suiteweb->row();
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

       $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.IDSITO.'_c').'/voucher/');

        // update della tabella hospitality_guest dove si segna l'invio e la data dell'invio stesso
        $db->query("UPDATE hospitality_guest SET Inviata = 1, DataInvio = '".date('Y-m-d')."' , Metodoinvio = 'Whatsapp' WHERE Id = ".$IdRichiesta);

        $WhatsApp      = str_replace(" ", "",$Cellulare);
        $WhatsApp      = str_replace(".", "",$WhatsApp);
        $WhatsApp      = str_replace("+", "",$WhatsApp);

        $WhatsApp      = $prefisso.$WhatsApp;
        $testo         = str_replace("[cliente]",(stripslashes($dati['Nome']).' '.stripslashes($dati['Cognome'])),TESTOMAIL_VAUCHER);
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

        $testo         = $testo."\r\n";

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
        $_REQUEST['spedito'] = 'Voucher';
        $_REQUEST['id_richiesta'] = $_GET['param'];
        $_REQUEST['action']       = 'send_whatsapp';
        include($_SERVER['DOCUMENT_ROOT'].'/v2/include/template/moduli/logs.inc.php');
        ##LOG##
                 
        $prt->_goto('https://api.whatsapp.com/send?phone='.$WhatsApp.'&text='.$TestoWhatsApp);

        $update = "UPDATE hospitality_guest SET Voucher_send = 1, Chiuso = 1, Visibile = 1, DataChiuso = '".date('Y-m-d H:i:s')."' WHERE Id = ".$IdRichiesta;
        $db->query($update);

    }

 
}