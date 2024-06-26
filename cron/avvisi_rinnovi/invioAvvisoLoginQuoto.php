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


    $giorni15_tmp = mktime(0, 0, 0, date('m'), (date('d')-15), date('Y'));
    $giorni15 = date('Y-m-d',$giorni15_tmp);


    $giorni30_tmp = mktime(0, 0, 0, date('m'), (date('d')-30), date('Y'));
    $giorni30 = date('Y-m-d',$giorni30_tmp);

  
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
            GROUP BY 
                siti.idsito
            ORDER BY 
                siti.data_start_hospitality 
            DESC";
    $array_id  = $dbMysqli->query($sel);

    foreach ($array_id as $key => $value) {

        $select = "SELECT * FROM hospitality_log_accessi WHERE remote != '5.89.51.153' AND idsito =  ".$value['idsito']." ORDER BY id DESC";
        $record = $dbMysqli->query($select);
        $v      = $record[0];

        if(sizeof($record) > 0){
    

            $sel = "SELECT  * FROM siti WHERE siti.idsito = ".$v['idsito'];
            $rec = $dbMysqli->query($sel);
            $rws = $rec[0];


                if(date('Y-m-d', $v['data_ora']) == $giorni15){


                    $messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                        <tr>
                                        <td class="title">
                                            <img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
                                            <h2>'.clean_string($rws['nome']).' sono 15 o più giorni che non effettua il login in QUOTO!</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <h2>Sito: '.$rws['web'].' </h2>
                                            <h2>Telefono: '.$rws['tel'].' </h2>
                                            <h2>Email: '.$rws['email'].' </h2>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                        </td>
                                    </tr>							
                                </table>';				

                        inviaMail(MAIL_SEND,$MAIL_SERENA_QT, clean_string($rws['nome']).' 15 giorni che non effettua il login in QUOTO V3', $messaggio);
                        inviaMail(MAIL_SEND,$MAIL_MARCELLO,clean_string($rws['nome']).' 15 giorni che non effettua il login in QUOTO V3', $messaggio);
                    
                        echo '### ESEGUITO INVIO ########## MAIL dei 15 gg per '.clean_string($rws['nome'])."\r\n";
                        $invio15 = true;
                }else{
                        $invio15 = false;
                }



                if(date('Y-m-d', $v['data_ora']) == $giorni30){


                    $messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                        <tr>
                                        <td class="title">
                                            <img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
                                            <h2>'.clean_string($rws['nome']).' sono 30 giorni che non effettua il login in QUOTO!</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <h2>Sito: '.$rws['web'].' </h2>
                                            <h2>Telefono: '.$rws['tel'].' </h2>
                                            <h2>Email: '.$rws['email'].' </h2>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                        </td>
                                    </tr>							
                                </table>';				

                        inviaMail(MAIL_SEND,$MAIL_SERENA_QT, clean_string($rws['nome']).' 30 giorni che non effettua il login in QUOTO V3', $messaggio);
                        inviaMail(MAIL_SEND,$MAIL_MARCELLO, clean_string($rws['nome']).' 30 giorni che non effettua il login in QUOTO V3', $messaggio);

                        echo '### ESEGUITO INVIO ########## MAIL dei 30 gg per '.clean_string($rws['nome'])."\r\n";
                        $invio30 = true;
                }else{
                        $invio30 = false;                
                }
            

        
        }


        if($invio15==false){
            echo '### NESSUN INVIO ########## MAIL dei 15 gg per mancato login a QUOTO v3'."\r\n";
        }
        if($invio30==false){
            echo '### NESSUN INVIO ########## MAIL dei 30 gg per mancato login a QUOTO v3'."\r\n";
        }
    }

?>