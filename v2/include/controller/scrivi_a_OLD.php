<?php
        //#### QUERY PER ESTRAPOLARE I DATI DI OGNI PREVENTIVO
        $select = $db->query("SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['azione']);
        $row = $db->row($select);
        $Ospite= stripslashes($row['Nome']).' '.stripslashes($row['Cognome']);
        $Operatore = $row['ChiPrenota'];
        $Email_Ospite = $row['Email'];


        $sel = $db->query("SELECT Tripadvisor FROM hospitality_social WHERE idsito = ".IDSITO);
        $row2 = $db->row($sel);
        if($row2['Tripadvisor']!=''){
             $tripadvisor = $row2['Tripadvisor'];
        }else{
            $tripadvisor = 'https://www.tripadvisor.it/';
        }

        
           

        switch($row['Lingua']){
            case "it":
               ## MODIFICA VOLUTA DAL HOTEL CROZZON IN DATA 18/08/2020 (assolutamente non condivisa da Marcello)
                if(IDSITO == 660){
                    $oggetto = 'Per condividere la vostra esperienza con tutto il resto del mondo! '.NOMEHOTEL;
                    $testo_email ='Gentile <b>'.$Ospite.'</b>,
                                    <br>
                                    con molto piacere, abbiamo notato dalla compilazione del questionario per la <b>Soddisfazione del Cliente</b>, che si è trovato molto bene da noi all\'Hotel Crozzon!
                                    <br>
                                    Le saremmo immensamenti grati se volesse scrivere una breve recensione sul portale <b>TripAdvisor</b>
                                    <br><br>
                                    Ringraziandola ancora di aver soggiornato nella nostra struttura e fiduciosi di poterla riavere come nostro Ospite, le inviamo il link per la recensione: <b>Tripadvisor</b> – <a href="'.$tripadvisor.'">clicca qui</a>
                                    <br><br>
                                    Cordiali saluti.
                                    <br>
                                    <b>Famiglia Masè e tutto lo staff dell\'Hotel Crozzon</b><br>
                                    <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</em></p>';
                }else{
                    $oggetto = 'Gentile ospite saremmo lieti se volesse lasciare una recensione in merito al suo soggiorno presso la nostra struttura: '.NOMEHOTEL;
                    $testo_email ='Gentile <b>'.$Ospite.'</b>,<br>
                                                abbiamo notato dalla compilazione del questionario per la <b>Soddisfazione del Cliente</b> in Hotel, che si è trovato bene presso la nostra struttura ricettiva!
                                                <br>
                                                Le saremmo immensamenti grati se volesse scrivere una breve recensione sul portale <b>TripAdvisor</b>
                                                <br><br>
                                                Ringraziandola ancora di aver soggiornato nella nostra struttura e fiduciosi di poterla riavere come nostro Ospite, le inviamo il link per la recensione:
                                                <br>
                                                <a href="'.$tripadvisor.'">'.$tripadvisor.'</a>
                                                <br><br>
                                                Cordiali saluti.
                                                <br>
                                                <b>'.$Operatore.' - '.NOMEHOTEL.'</b><br>
                                                <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</em></p>';
                }
            break;
            case "en":
                $oggetto = 'Dear guest, we would be pleased if you would like to leave a review about your stay at our facility: '.NOMEHOTEL;
                $testo_email ='Dear <b>'.$Ospite.'</b>, <br>
                                                we noticed from the completion of the <b> Customer Satisfaction </b> questionnaire in the Hotel, which found itself well at our accommodation!
                                                <br>
                                                We would be grateful if you would like to write a short review on the <b> TripAdvisor </b> portal
                                                <br>
                                                Thanking you again for having stayed in our structure and trusting to be able to have it back as our Guest, we send you the link for the review:
                                                <br>
                                                <a href="'.$tripadvisor.'">'.$tripadvisor.'</a>
                                                <br>
                                                Best regards.
                                            <br>
                                            <b>'.$Operatore.' - '.NOMEHOTEL.'</b><br>
                                            <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>This e-mail was sent automatically by the software, do not reply to this e-mail!</em></p>';
            break;
            case "fr":
                $oggetto = 'Cher client, nous serions heureux si vous souhaitez laisser un commentaire sur votre séjour dans notre établissement: '.NOMEHOTEL;
                $testo_email ='Cher <b>'.$Ospite.'</b>, <br>
                                                nous avons remarqué à la fin du questionnaire <b> satisfaction de la clientèle </b> dans l\'hôtel, qui s\'est bien trouvé dans notre logement!
                                                <br>
                                                Nous vous serions reconnaissants de bien vouloir rédiger une brève critique sur le portail <b> TripAdvisor </b>
                                                <br>
                                                En vous remerciant encore d\'être resté dans notre structure et en ayant confiance pour pouvoir le récupérer en tant qu\'invité, nous vous envoyons le lien pour la revue:
                                            <br>
                                            <a href="'.$tripadvisor.'">'.$tripadvisor.'</a>
                                            <br><br>
                                            Cordialement.
                                            <br>
                                            <b>'.$Operatore.' - '.NOMEHOTEL.'</b><br>
                                            <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Cet e-mail a été envoyé automatiquement par le logiciel, ne répondez pas à cet e-mail!</em></p>';
            break;
            case "de":
                $oggetto = 'Sehr geehrter Gast, wir würden uns freuen, wenn Sie eine Bewertung über Ihren Aufenthalt in unserer Einrichtung hinterlassen möchten: '.NOMEHOTEL;
                $testo_email ='Lieber <b>'.$Ospite.'</b>, <br>
                                            Wir haben von der Fertigstellung des Fragebogens <b> Kundenzufriedenheit </b> im Hotel erfahren, der sich in unserer Unterkunft wiederfand!
                                            <br>
                                            Wir wären Ihnen dankbar, wenn Sie eine kurze Kritik auf dem <b> TripAdvisor </b> -Portal schreiben möchten
                                            <br>
                                            Wir danken Ihnen nochmals, dass Sie in unserer Struktur geblieben sind und darauf vertrauen, dass wir sie als Gast wieder haben können. Wir senden Ihnen den Link für die Bewertung:
                                            <br>
                                            <a href="'.$tripadvisor.'">'.$tripadvisor.'</a>
                                            <br><br>
                                            Mit freundlichen Grüßen.
                                            <br>
                                            <b>'.$Operatore.' - '.NOMEHOTEL.'</b><br>
                                            <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Diese E-Mail wurde von der Software automatisch verschickt, antworten Sie nicht auf diese E-Mail!</em></p>';
            break;            
        }
        
        


        $script_header .= '<style>
                                .no_border_top_dx{
                                    border-top:0px!important;
                                   /* border-bottom:0px!important;*/
                                    border-right:0px!important;
                                }
                                .no_border_input{
                                    border-top:0px!important;
                                    border-bottom:0px!important;
                                    border-right:0px!important;
                                    border-left:0px!important;
                                }
                                .bold{
                                    font-weight:bold!important;
                                }
                                .center_small{
                                    text-align:center!important;
                                    font-size:90%!important;
                                }
                                .center{
                                    text-align:center!important;                                
                                }
                                .clear{
                                    clear:both!important;
                                    height:5px!important;
                                }
                                .small{
                                    font-size:90%!important;
                                }
                                .input_white{
                                    background-color:#FFFFFF!important;
                                }
    
                            </style>'."\r\n";



$msg = '';

if($_REQUEST['action']=='send_mail'){

        $select = $db->query("SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['azione']);
        $row = $db->row($select);
        $Ospite = stripslashes($row['Nome']).' '.stripslashes($row['Cognome']);
        $Email_Ospite = $row['Email'];
        
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
        $ri = $db->query($qr);
        $rx = $db->row($ri);
        if(is_array($rx)) {
            if($rx > count($rx))
                $isSMTP = count($rx); 
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

        $mail->setFrom(MAIL_SEND, NOMEHOTEL);

       // $mail->addReplyTo(EMAILHOTEL, NOMEHOTEL);

        // EMAIL INDIRIZZATA AL CLIENTE
        $mail->addAddress($_REQUEST['email_singola'], $Ospite);
        
        if($_REQUEST['email_copia']!=''){
            // COPIA CC
            $mail->addAddress($_REQUEST['email_copia'],$Ospite);
        }

        $mail->Subject = $_REQUEST['oggetto'];

        $mail->msgHTML($_REQUEST['testo_email'], dirname(__FILE__));

        $mail->AltBody = 'This is a plain-text message body';


        // 
        //send the message, check for errors
        if (!$mail->send()) {

            $msg = '<div id="res_back" class="alert alert-danger">
                        <i class="fa fa-check"></i> Mailer Error: '. $mail->ErrorInfo.'
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>';

        } else {
            /** INSERIMENTO DI UNA RIGA CON  DATA PER OGNO INVIO EFFETTUATO */
            $db->query("INSERT INTO hospitality_recensioni_send (idsito,id_richiesta,data_invio) VALUES('" . IDSITO . "','" . $_REQUEST['azione'] . "','" . date('Y-m-d') . "')");

            $msg = '<div id="res_back" class="alert alert-info">
                        <i class="fa fa-check"></i> E-mail inviata con successo!
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>'; 
                    


        }
        
}   

$script_msg ='<script>                                                                                                   
                    $(document).ready(function() {                                                                                  
                            setTimeout(function(){
                                $(\'#res_back\').hide();
                                window.location.replace(\''.BASE_URL_SITO.'giudizio_finale/\');
                            },3000);
                    });
                </script>'."\r\n";  

                $script_footer .='  <script type="text/javascript">
                        $(function() {
                            CKEDITOR.replace(\'testo_email\');
                            $(".textarea").wysihtml5();                                                   
                        });
                    </script>'."\r\n";  
                    
$script_footer .='<script type="text/javascript" src="'.BASE_URL_SITO.'xcrud/editors/ckeditor/ckeditor.js"></script>'."\r\n";  
$script_footer .='<script type="text/javascript">
                        CKEDITOR.config.toolbar = [
                                        [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'Font\',\'FontSize\'],
                                        [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],
                                        [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],
                                        [\'Image\',\'Table\',\'Link\',\'TextColor\',\'BGColor\']
                                    ] ;
                        CKEDITOR.config.autoGrow_onStartup = true;
                        CKEDITOR.config.extraPlugins = \'autogrow\';
                        CKEDITOR.config.autoGrow_minHeight = 400;
                        CKEDITOR.config.autoGrow_maxHeight = 600;
                        CKEDITOR.config.autoGrow_bottomSpace = 50;           
                </script>'."\r\n";

$pulsante_indietro ='<a class="btn btn-warning " href="'.BASE_URL_SITO.'giudizio_finale/"><i class="fa fa-arrow-left"></i> torna indietro</a>';


?>