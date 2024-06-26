<?php
        //#### QUERY PER ESTRAPOLARE I DATI DI OGNI PREVENTIVO
        $select = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['azione']);
        $row    = $select[0];
        $Ospite       =   stripslashes(ucfirst($row['Nome'])).' '.stripslashes(ucfirst($row['Cognome']));
        $Operatore    =   $row['ChiPrenota'];
        $Email_Ospite =   $row['Email'];
        $Lingua       =   $row['Lingua'];


        $sel = $dbMysqli->query("SELECT Tripadvisor FROM hospitality_social WHERE idsito = ".IDSITO);
        $row2 = $sel[0];
        if($row2['Tripadvisor']!=''){
             $tripadvisor = $row2['Tripadvisor'];
        }else{
            $tripadvisor = 'https://www.tripadvisor.it/';
        }
        $select = "SELECT 
                        hospitality_dizionario.etichetta,
                        hospitality_dizionario_lingua.testo 
                    FROM 
                        hospitality_dizionario
                    INNER JOIN 
                        hospitality_dizionario_lingua 
                    ON 
                        hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE 
                        hospitality_dizionario.idsito = ".IDSITO."
                    AND 
                        hospitality_dizionario_lingua.Lingua = '".$Lingua."'
                    AND 
                        (hospitality_dizionario.etichetta = 'TESTO_EMAIL_TRIPADVISOR' 
                    OR 
                        hospitality_dizionario.etichetta = 'OGGETTO_TRIPADVISOR')";
$array = $dbMysqli->query($select);

foreach($array as $key => $value){
    $etichetta[$value['etichetta']]=$value['testo'];
}

$oggetto      =     str_replace("[struttura]",NOMEHOTEL,$etichetta['OGGETTO_TRIPADVISOR']);
$testo_email  =     str_replace("[cliente]",$Ospite,$etichetta['TESTO_EMAIL_TRIPADVISOR']);
$testo_email  =     str_replace("[struttura]",NOMEHOTEL,$testo_email); 
$testo_email  =     str_replace("[link_tripadvisor]",$tripadvisor,$testo_email);        
$testo_email  =     str_replace("[operatore]",$Operatore,$testo_email);       



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

        $select = $dbMysqli->query("SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['azione']);
        $row = $select[0];
        $Ospite = stripslashes($row['Nome']).' '.stripslashes($row['Cognome']);
        $Email_Ospite = $row['Email'];
        
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
        $ri = $dbMysqli->query($qr);
        $rx = $ri[0];
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
            $dbMysqli->query("INSERT INTO hospitality_recensioni_send (idsito,id_richiesta,data_invio) VALUES('" . IDSITO . "','" . $_REQUEST['azione'] . "','" . date('Y-m-d') . "')");

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

$pulsante_indietro ='<a class="btn btn-warning btn-sm" href="'.BASE_URL_SITO.'giudizio_finale/"><i class="fa fa-arrow-left"></i> torna indietro</a><div class="clearfix p-b-10"></div>';


?>