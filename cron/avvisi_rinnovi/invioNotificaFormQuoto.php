<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

date_default_timezone_set('Europe/Rome');
setlocale(LC_TIME, 'it_IT.UTF8');

require $_SERVER['DOCUMENT_ROOT'].'/class/PHPMailer/PHPMailerAutoload.php';


    function inviaMail($mail_send,$destinatari,$oggetto, $messaggio){
	  
	  	$mail 	 = new PHPMailer;
        $msg 	.= top_email(1);
        $msg 	.= $messaggio;      
        $msg 	.= footer_email(1);
        $msg  .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';

        $body  = $msg;

        $mail->SetFrom($mail_send);     
        $mail->AddAddress($destinatari);               
        $mail->Subject = $oggetto;
        $mail->MsgHTML($body);
        
        $mail->Send();

    }

    function clean_string($stringa){

        $clean_title = str_replace( "&", "e", $stringa );
        $clean_title = str_replace( "€", "euro", $clean_title );
        $clean_title = str_replace( "%", " ", $clean_title );	
        $clean_title = str_replace( "*", " ", $clean_title );
        $clean_title = trim($clean_title);
    
        return($clean_title);
    }
 

    $giorni10_tmp  = mktime(0, 0, 0, date('m'), (date('d')+10), date('Y'));// +7 giorni da oggi
    $giorni10      = date('Y-m-d',$giorni10_tmp);

    $tipoContratto = '';
    $invio10       = '';
    $array_servizi = '';

    $sel = "SELECT 
                siti.*
            FROM 
                siti 
            WHERE 
                siti.hospitality = 1 
            AND 
                siti.data_end_hospitality > '".date('Y-m-d')."'
            AND 
                siti.no_rinnovo_hospitality = 1
            GROUP BY 
                siti.idsito
            ORDER BY 
                siti.data_start_hospitality 
            DESC";
    $array_id  = $dbMysqli->query($sel);


        foreach ($array_id as $key => $value) {

            $data_tmp     = explode("-",$value['data_end_hospitality']);

            $array_servizi = explode(",",$value['servizi_attivi']);

            if(in_array('Quoto',$array_servizi)){

                $tipoContratto = 'QUOTO! annuale';   
            }

            if(in_array('Quoto TR',$array_servizi)){
                
                $tipoContratto = 'QUOTO! triennale';
            }

    
            if($value['data_end_hospitality'] == $giorni10){

                $messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                    <tr>
                                    <td class="title">
                                        <img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br /><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <p style="font-size:16px">
                                                Il Cliente  <b>'.clean_string($value['nome']).'</b>,
                                                    <br><br>
                                                ha il servizio <b>'.$tipoContratto.' CRM</b> che fra 7 giorni verrà bloccato e gli sarà disattivato l\'account</b>
                                                    <br><br>
                                                E\' necessario <b>sostituire</b> il prima possibile il <b>Widget Form QUOTO</b> dal suo <b>sito web</b> e dalle sue <b>landing page</b>!
                                                    <br><br>
                                                Oppure <b>ricontattare il cliente</b> per un possibile rinnovo!
                                                    <br><br>
                                                Grazie
                                                    <br><br>
                                                Lo Staff direzionale di QUOTO by Network Service
                                        </p>
                                    </td>
                                </tr>                                        
                                <tr>
                                    <td valign="top">
                                    </td>
                                </tr>							
                            </table>';	

                    inviaMail(MAIL_SEND,$MAIL_MARCELLO, 'A BREVE VERRA\' BLOCCATO L\'ACCESSO A QUOTO PER '.clean_string($value['nome']), $messaggio);
                    inviaMail(MAIL_SEND,$MAIL_SERENA, 'A BREVE VERRA\' BLOCCATO L\'ACCESSO A QUOTO PER '.clean_string($value['nome']), $messaggio);
                    inviaMail(MAIL_SEND,$MAIL_VERONICA, 'A BREVE VERRA\' BLOCCATO L\'ACCESSO A QUOTO PER '.clean_string($value['nome']), $messaggio);

                    echo '### ESEGUITO INVIO 10 gg prima ########## MAIL NOTIFICA PER BLOCCAGGIO ACCESSO A QUOTO E PER CAMBIO FORM QUOTO! V3 per '.clean_string($value['nome']).'<br>'."\r\n";
                    $invio10 = true;  
            }else{
                $invio10 = false;
            }

    
        }

    if($invio10==false){
        echo '### NESSUN INVIO ########## MAIL dei 10 gg per cambio form QUOTO! V3'."\r\n";
    }


?>