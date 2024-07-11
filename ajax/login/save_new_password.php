<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");


 	if($_POST['check_password']!=''){					
            #inserimento della nuova PASSWORD NELLA TABELLA CRONOLOGIA PASSWORD
            $insert = "INSERT INTO utenti_password(idutente,idsito,password) VALUES('".$_POST['idutente']."','".$_POST['idsito']."','".base64_encode($_POST['check_password'])."')";
            $dbMysqli->query($insert);
            #update password account di suiteweb tabella utenti
            $update = "UPDATE utenti_quoto SET password = '".base64_encode($_POST['check_password'])."', data_account = '".date('Y-m-d')."' WHERE id = '".$_POST['idutente']."' ";
            $dbMysqli->query($update);

            require (INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php');
            $mail 	= new PHPMailer(); 

            $msg 	.= top_email(1);
            $msg .= '<style>
                        .btn-warning {
                                color: #fff;
                                background-color: #f0ad4e;
                                border-color: #eea236;
                            }
                            .btn {
                                display: inline-block;
                                padding: 6px 12px;
                                margin-bottom: 0;
                                font-size: 14px;
                                font-weight: normal;
                                line-height: 1.428571429;
                                text-align: center;
                                white-space: nowrap;
                                vertical-align: middle;
                                cursor: pointer;
                                background-image: none;
                                border: 1px solid transparent;
                                border-radius: 4px;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                -ms-user-select: none;
                                -o-user-select: none;
                                user-select: none;
                            }
                    </style>';
            $msg 	.= '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                    <tr>
                                    <td class="title">
                                        <img src="'.BASE_URL_SITO.'img/logo.png" /><br />
                                        <h2>La tua nuova password di QUOTO!</h2>
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top">									
                                       Per l\'utente <b>'.$_REQUEST['username'].'</b> la nuova PassWord è <b>'.$_REQUEST['check_password'].'</b>
                                    </td>
                                </tr>																	
                                <tr>
                                    <td valign="top">
                                    </td>
                                </tr>							
                            </table>';

            $msg 	.= footer_email(1);
            $msg    .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';
            $body 	= $msg;

            $mail->IsSMTP(); 
            $mail->SMTPDebug = 0; 
            $mail->Debugoutput = 'html';
            $mail->SMTPAuth = SMTPAUTH; 
            $mail->SMTPKeepAlive = true; 					
            $mail->Host = SMTPHOST;
            $mail->Port = SMTPPORT;
            $mail->Username = SMTPUSERNAME;
            $mail->Password = SMTPPASSWORD;

            $mail->SetFrom(MAIL_SEND, NOME_AMMINISTRAZIONE);

            $mail->AddAddress($_POST['email_utente']);
            $mail->AddAddress(MAIL_ADMIN);
                        
            $mail->Subject    = 'La tua nuova password per QUOTO!';
            $mail->MsgHTML($body);
            $mail->Send();
    }

?>