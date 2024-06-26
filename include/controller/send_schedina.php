<?php
        //#### QUERY 
        $select = "SELECT DataArrivo, DataPartenza,NumeroPrenotazione FROM  hospitality_guest  
                    WHERE hospitality_guest.idsito = ".$_REQUEST['azione']." 
                    AND hospitality_guest.NumeroPrenotazione = ".$_REQUEST['valore']." 
                    AND hospitality_guest.TipoRichiesta = 'Conferma' 
                    AND hospitality_guest.Chiuso = 1";
        $result = $dbMysqli->query($select);
        $row    = $result[0];
        $NumeroPrenotazione = $row['NumeroPrenotazione'];
        $DataArrivo         = $fun->gira_data($row['DataArrivo']);
        $DataPartenza       = $fun->gira_data($row['DataPartenza']);



        // query per alcuni dati inerenti al cliente: nome, Email, SitoWeb
        $query = 'SELECT siti.*,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                    WHERE siti.idsito = "'.IDSITO.'"';
        $res  =  $dbMysqli->query($query);
        $rows =  $res[0];
        $sito_tmp  = str_replace("http://","",$rows['web']);
        $sito_tmp  = str_replace("www.","",$sito_tmp);
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
        $hotel     = $rows['nome'];




        $oggetto = 'Spett.le Questura, dati per schedina alloggiati della prenotazione nr.'.$_REQUEST['valore'];



        $testo_email .='<b>'.$hotel.'</b>,<br>         
                                 '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                                  Tel. '.$tel.' '.($fax!=''?' Fax. '.$fax:'').' E-mail: '.$rows['email'].'<br>
                                  SitoWeb: '.$SitoWeb.'<br><br>
                                  In base alla nostra prenotazione Nr.<b>'.$NumeroPrenotazione.'</b> avremo come ospiti Nr.<b>'.$_REQUEST['param'].'</b> persone, presso la nostra stuttura ricettiva dal <b>'.$DataArrivo.'</b> al <b>'.$DataPartenza.'</b>
                                    <br>';

                                    $select = "SELECT * FROM hospitality_checkin WHERE idsito = ".IDSITO." AND Prenotazione = ".$NumeroPrenotazione." ORDER BY Id ASC";
                                    $record = $dbMysqli->query($select);  
                                    $i = 1;  
                                    foreach ($record as $key => $value) {
                                       $testo_email .= $i.'°
                                                        <table cellpadding="3" cellspacing="3" align="left" width="80%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                            <tr>
                                                                <td style="width:20%"><b>Tipo Componente</b></td>
                                                                <td style="width:30%">'.$value['TipoComponente'].'</td>
                                                                <td style="width:20%"></td>
                                                                <td style="width:30%"></td>

                                                            </tr>
                                                            <tr>
                                                               <td style="width:20%"><b>Tipo Documento</b></td>
                                                                <td style="width:30%">'.$value['TipoDocumento'].'</td>
                                                                <td style="width:20%"><b>Numero Documento</b></td>
                                                                <td style="width:30%">'.$value['NumeroDocumento'].'</td>

                                                            </tr>
                                                            <tr>
                                                               <td style="width:20%"><b>Comune di Emissione</b></td>
                                                                <td style="width:30%">'.$value['ComuneEmissione'].'</td>
                                                                <td style="width:20%"><b>Stato di Emissione</b></td>
                                                                <td style="width:30%">'.$value['StatoEmissione'].'</td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width:20%"><b>Data Rilascio</b></td>
                                                                <td style="width:30%">'.gira_data($value['DataRilascio']).'</td>
                                                                <td style="width:20%"><b>Data Scadenza</b></td>
                                                                <td style="width:30%">'.gira_data($value['DataScadenza']).'</td>
                                                            </tr>                                                            
                                                        </table>
                                                        <div style="clear:both;height:20px"></div>'; 
                                        $testo_email .='
                                                        <table cellpadding="3" cellspacing="3" align="left" width="80%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                            <tr>
                                                                <td style="width:20%"><b>Nome</b></td>
                                                                <td style="width:30%">'.stripslashes($value['Nome']).'</td>
                                                                <td style="width:20%"><b>Cognome</b></td>
                                                                <td style="width:30%">'.stripslashes($value['Cognome']).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:20%"><b>Sesso</b></td>
                                                                <td style="width:30%">'.$value['Sesso'].'</td>
                                                                <td style="width:20%"><b>Cittadinanza</b></td>
                                                                <td style="width:30%">'.$value['Cittadinanza'].'</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:20%"><b>Nome</b></td>
                                                                <td style="width:30%">'.$value['Nome'].'</td>
                                                                <td style="width:20%"><b>Cognome</b></td>
                                                                <td style="width:30%">'.$value['Cognome'].'</td>
                                                            </tr>';
                                        if($value['lang']=='it'){                   
                                            $testo_email .= '<tr>
                                                                    <td style="width:20%"><b>Indirizzo</b></td>
                                                                    <td style="width:30%">'.$value['Indirizzo'].'</td>
                                                                    <td style="width:20%"><b>Città</b></td>
                                                                    <td style="width:30%">'.$value['Citta'].'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:20%"><b>Provincia</b></td>
                                                                    <td style="width:30%">'.$value['Provincia'].'</td>
                                                                    <td style="width:20%"><b>Cap</b></td>
                                                                    <td style="width:30%">'.$value['Cap'].'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:20%"><b>Data di Nascita</b></td>
                                                                    <td style="width:30%">'.gira_data($value['DataNascita']).'</td>
                                                                    <td style="width:20%"><b>Stato di Nascita</b></td>
                                                                    <td style="width:30%">'.$value['StatoNascita'].'</td>
                                                                </tr> 
                                                                <tr>
                                                                    <td style="width:20%"><b>Luogo di Nascita</b></td>
                                                                    <td style="width:30%">'.$value['LuogoNascita'].'</td>
                                                                    <td style="width:20%"><b>Provincia di Nascita</b></td>
                                                                    <td style="width:30%">'.$value['ProvinciaNascita'].'</td>
                                                                </tr> ';
                                        }else{
                                            $testo_email .= '<tr>
                                                                        <td style="width:20%"><b>Indirizzo</b></td>
                                                                        <td style="width:30%">'.$value['Indirizzo'].'</td>
                                                                        <td style="width:20%"><b>Città</b></td>
                                                                        <td style="width:30%">'.$value['CittaBis'].'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:20%"><b>Provincia</b></td>
                                                                        <td style="width:30%">'.$value['ProvinciaBis'].'</td>
                                                                        <td style="width:20%"><b>Cap</b></td>
                                                                        <td style="width:30%">'.$value['Cap'].'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:20%"><b>Data di Nascita</b></td>
                                                                        <td style="width:30%">'.gira_data($value['DataNascita']).'</td>
                                                                        <td style="width:20%"><b>Stato di Nascita</b></td>
                                                                        <td style="width:30%">'.$value['StatoNascita'].'</td>
                                                                    </tr> 
                                                                    <tr>
                                                                        <td style="width:20%"><b>Luogo di Nascita</b></td>
                                                                        <td style="width:30%">'.$value['LuogoNascitaBis'].'</td>
                                                                        <td style="width:20%"><b>Provincia di Nascita</b></td>
                                                                        <td style="width:30%">'.$value['ProvinciaNascitaBis'].'</td>
                                                                    </tr> ';
                                        }
                                        $testo_email .=     '<tr>
                                                                <td style="width:20%"><b>Note</b></td>
                                                                <td colspan="3" style="width:80%">'.$value['Note'].'</td>
                                                            </tr> 
                                                        </table>
                                                        <div style="clear:both;height:30px"></div>'; 
                                    $i++;                                                      
                                    }


        $testo_email .='            <div style="clear:both;height:50px"></div>
                                    Cordiali saluti.
                                    <br>
                                    <b>'.NOMEHOTEL.'</b><br>
                                    <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</em></p>';


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

if($_REQUEST['action']=='send_email'){

        $select = "SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['azione'];
        $risultato = $dbMysqli->query($select);
        $row = $risultato[0];
        $Ospite = stripslashes($row['Nome']).' '.stripslashes($row['Cognome']);

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

        //$mail->addReplyTo(EMAILHOTEL, NOMEHOTEL);

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
         
            $msg .= '<div id="res_back" class="alert alert-info">
                        <i class="fa fa-check"></i> E-mail inviata con successo!
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>'; 
        


        }
        
}   
$script_js ='<script>                                                                                                   
                        $(document).ready(function() {                                                                                  
                                setTimeout(function(){
                                    $(\'#res_back\').hide();
                                    window.location.replace(\''.BASE_URL_SITO.'checkinonline-schedine_alloggiati/\');
                                },3000);
                        });
                    </script>'."\r\n";
$script_footer .='<script type="text/javascript">
                    $(function() {
                        CKEDITOR.replace(\'testo_email\');
                        $(".textarea").wysihtml5();                                                   
                    });
                </script>'."\r\n";  
$script_footer .='<script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>'."\r\n";  
$script_footer .='<script type="text/javascript">
                                CKEDITOR.config.toolbar = [
                                               [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'Font\',\'FontSize\'],
                                               [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],
                                               [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],
                                               [\'Image\',\'Table\',\'Link\',\'TextColor\',\'BGColor\']
                                            ] ;
                                CKEDITOR.config.autoGrow_onStartup = true;
                                CKEDITOR.config.extraPlugins = \'autogrow\';
                                CKEDITOR.config.autoGrow_minHeight = 600;
                                CKEDITOR.config.autoGrow_maxHeight = 1000;
                                CKEDITOR.config.autoGrow_bottomSpace = 50;           
                        </script>'."\r\n";

$pulsante_indietro ='<a class="btn btn-warning " href="'.BASE_URL_SITO.'checkinonline-schedine_alloggiati/"><i class="fa fa-arrow-left"></i> torna indietro</a>';
?>