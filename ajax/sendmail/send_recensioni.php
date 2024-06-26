<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['azione'] == 'send') {
    
         // query per i dati della richiesta
        $sel  = $dbMysqli->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['id']);
        $dati = $sel[0];        

        // assegno alcune variabili
        $IdRichiesta    = $dati['Id'];
        $idsito         = $dati['idsito'];
        $Nome           = stripslashes($dati['Nome']);
        $Cognome        = stripslashes($dati['Cognome']);   
        $Email          = $dati['Email'];
        $Operatore      = $dati['ChiPrenota'];
        $EmailOperatore = $dati['EmailSegretaria']; 
        $Lingua         = $dati['Lingua']; 


        $select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE hospitality_dizionario.idsito = ".$idsito."
                    AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'
                    AND hospitality_dizionario_lingua.idsito = ".$idsito;
        $rec = $dbMysqli->query($select);
        foreach($rec as $key => $value) {
            $etichetta[$value['etichetta']]=$value['testo'];
        }

        $_oggetto           =     $etichetta['OGGETTO_RECENSIONE'];
        $_testo             =     $etichetta['TESTOMAIL_RECENSIONE']; 
        $_datarichiesta     =     $etichetta['DATA_RICHIESTA'];
        $_txtlink4          =     $etichetta['TXTLINK4'];
        $_paginariservata   =     $etichetta['PAGINARISERVATA'];
        $_saluti            =     $etichetta['SALUTI_H'];
        $_noreplay          =     $etichetta['NO_REPLAY_EMAIL'];


        $quy = $dbMysqli->query('SELECT siti.*,utenti.logo,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN utenti ON utenti.idsito = siti.idsito
                                    INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                    WHERE siti.idsito = "'.$idsito.'"');
        $rows =  $quy[0];
        $sito_tmp    = str_replace("http://","",$rows['web']);
        $sito_tmp    = str_replace("www.","",$sito_tmp);
        if($rows['https']==1){
            $http = 'https://';
        }else{
            $http = 'http://';
        }
        $SitoWeb   = $http.'www.'.$sito_tmp;             
        $logo      = $rows['logo'];
        $NomeHotel = $rows['nome']; 
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

        $sel    = "SELECT 
                        Tripadvisor 
                    FROM 
                        hospitality_social 
                    WHERE 
                        hospitality_social.idsito = ".$idsito."" ;

                $res    = $dbMysqli->query($sel);
                $record = $res[0];

                $link = $record['Tripadvisor'];

   
        
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$idsito." AND Abilitato = 1";  
        $ri = $dbMysqli->query($qr);
        $rx = $ri[0];
        if(sizeof($ri)>0) {
            $isSMTP = count($ri); 
        }else{ 	
            $isSMTP = 0;
        }
        $SmtpAuth     = $rx['SMTPAuth'];
        $SmtpHost     = $rx['SMTPHost'];
        $SmtpPort     = $rx['SMTPPort'];
        $SmtpSecure   = $rx['SMTPSecure'];
        $SmtpUsername = $rx['SMTPUsername'];
        $SmtpPassword = $rx['SMTPPassword'];
        $NumberSend   = $rx['NumberSend'];      

        require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        if($isSMTP > 0){
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
        } 
        $mail->setFrom(MAIL_SEND, $Operatore);
  
        $mail->addAddress($Email, $Nome.' '.$Cognome);
        $mail->isHTML(true);
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,$_oggetto).' | '.ucfirst($rows['nome']);
   
        $IdSito = $idsito;
        include BASE_PATH_SITO.'email_template/manual_recensioni_send.php';        

        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

                ##LOG##
                $_REQUEST['spedito'] = 'RecensioniManuali';
                $_REQUEST['id_richiesta'] = $_REQUEST['id'];
                $_REQUEST['action']       = 'send_recensioni';
                include($_SERVER['DOCUMENT_ROOT'].'/include/template/moduli/logs.inc.php');
                ##LOG##

                $update = "UPDATE hospitality_guest SET recensione_inviata = 1 WHERE Id = ".$IdRichiesta;
                $dbMysqli->query($update);
                $update2 = "INSERT  INTO hospitality_traccia_email_cron (IdRichiesta,Idsito,DataAzione,TipoReInvio) VALUES ('".$IdRichiesta."','".$idsito."','".date('Y-m-d H:i:s')."','RecensioniSend')";
                $dbMysqli->query($update2);


        }                 
             
     
 
}