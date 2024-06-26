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
 

    $giorni40_tmp  = mktime(0, 0, 0, date('m'), (date('d')+40), date('Y'));
    $giorni40      = date('Y-m-d',$giorni40_tmp);

    $tipoContratto = '';
    $data_rinnovo  = '';
    $dataRinnovo   = '';
    $invio40       = '';
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
                siti.id_status <> 5
            AND 
                siti.no_rinnovo_hospitality = 0
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
                $data_rinnovo = mktime(0, 0, 0, date($data_tmp[1]), date($data_tmp[2]), (date($data_tmp[0])+1));
                $dataRinnovo  = date('d-m-Y',$data_rinnovo);
          
            }

            if(in_array('Quoto TR',$array_servizi)){
                
                $tipoContratto = 'QUOTO! triennale';
                $data_rinnovo = mktime(0, 0, 0, date($data_tmp[1]), date($data_tmp[2]), (date($data_tmp[0])+3));
                $dataRinnovo  = date('d-m-Y',$data_rinnovo);
            }

    
            if($value['data_end_hospitality'] == $giorni40){

                $messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                    <tr>
                                    <td class="title">
                                        <img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br /><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <p style="font-size:16px">
                                                Gentile  <b>'.clean_string($value['nome']).'</b>,
                                                    <br><br>
                                                le ricordiamo che il servizio <b>'.$tipoContratto.' CRM</b> si rinnoverà automaticamente tra 40 giorni, in data <b>'.gira_data($value['data_end_hospitality']).'</b>
                                                    <br><br>
                                                Rimaniamo a disposizione per qualsiasi informazione.
                                                    <br><br>
                                                Cordiali saluti
                                                    <br><br>
                                                Lo Staff di Network Service
                                        </p>
                                    </td>
                                </tr>                                        
                                <tr>
                                    <td valign="top">
                                    </td>
                                </tr>							
                            </table>';	

                    inviaMail(MAIL_SEND,$value['email'], clean_string($value['nome']).', Quoto! CRM si rinnoverà il '.gira_data($value['data_end_hospitality']).'', $messaggio);
                    inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA INVIO '.clean_string($value['nome']).', Quoto! CRM si rinnoverà il '.gira_data($value['data_end_hospitality']).'', $messaggio);
                    inviaMail(MAIL_SEND,$MAIL_MARCELLO, 'COPIA INVIO '.clean_string($value['nome']).', Quoto! CRM si rinnoverà il '.gira_data($value['data_end_hospitality']).'', $messaggio);

                    echo '### ESEGUITO INVIO 40 gg prima ########## MAIL RICORDO RINNOVO QUOTO! V3 per '.clean_string($value['nome']).'<br>'."\r\n";
                    $invio40 = true;
            }else{
                    $invio40 = false;
            }

    
    }

    if($invio40==false){
        echo '### NESSUN INVIO ########## MAIL dei 40 gg per ricordo rinnovo contratto QUOTO! V3'."\r\n";
    }

?>