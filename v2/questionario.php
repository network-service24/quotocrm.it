<?
    $qry = "SELECT * FROM hospitality_invio_questionario WHERE idsito = ".IDSITO;
    $rec = $db->query($qry);
    $rws = $db->row($rec);
    $invio_automatico = $rws['invio_automatico'];
    if($invio_automatico == 1){
      
       // query per i dati della richiesta
        $s = $db->query("SELECT * FROM hospitality_guest  WHERE idsito = ".IDSITO." AND TipoRichiesta = 'Conferma' AND Chiuso = 1 AND DataPartenza < '".date('Y-m-d')."'  AND CS_inviato = 0");
        $recdati = $db->result($s);  
        $tt_dati = sizeof($recdati);
        
        $IdRichiesta    = '';
        $Nome           = '';
        $Cognome        = '';   
        $Email          = '';
        $Operatore      = '';
        $EmailOperatore = '';
        $link           = '';

        foreach ($recdati as $key => $dati) {

                // assegno alcune variabili
                $IdRichiesta    = $dati['Id'];
                $Nome           = $dati['Nome'];
                $Cognome        = $dati['Cognome'];   
                $Email          = $dati['Email'];
                $Operatore      = $dati['ChiPrenota'];
                if($Operatore == ''){
                        $Operatore = NOMEHOTEL;
                }
                $EmailOperatore = $dati['EmailSegretaria'];
                if($EmailOperatore == ''){
                        $EmailOperatore = EMAILHOTEL;
                }  
                $Lingua         = $dati['Lingua']; 

                include($_SERVER['DOCUMENT_ROOT'].'/lingue/lang.php');

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
                $SitoWeb     = 'http://www.'.$sito_tmp;
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

               $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.IDSITO.'_c').'/questionario/');



                require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';
                //include INC_PATH_CLASS.'PHPMailer/class.smtp.php';
                $mail = new PHPMailer;
                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                //$mail->SMTPDebug = 0;
                //$mail->Debugoutput = 'html';
                //$mail->Host = 'smtp.gmail.com';
                //$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead            
                //$mail->Port = 587;
                //$mail->SMTPSecure = 'tls';
                //$mail->SMTPAuth = true;
                //$mail->Username = "network.service.rimini@gmail.com";
                //$mail->Password = "1106Rimini74";

                $mail->setFrom($EmailOperatore, $Operatore);
                $mail->addReplyTo($EmailOperatore, $Operatore);
                $mail->addAddress($Email, $Nome.' '.$Cognome);
                $mail->isHTML(true);
                $mail->Subject = OGGETTO.' | '.NOMEHOTEL;
                $messaggio = '<!DOCTYPE html>
                                <html lang="it">
                                  <head>
                                    <meta charset="utf-8">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                        <title>'.NOMEHOTEL.'</title>                               
                                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
                                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                                    <style>
                                            @charset "UTF-8";
                                            body{
                                              margin-top:10px;
                                              background-color: #EBEBEB;
                                              font-family: Arial;
                                              font-style:italic;
                                              font-weight: bold;
                                              font-size: 20px;
                                            }
                                            .testo{
                                                font-family:Georgia, serif;
                                                font-size: 18px;
                                                color: #5E5E5E;
                                            }
                                            .testo_big{
                                                font-family:Georgia, serif;
                                                font-size: 24px;
                                                color: #5E5E5E;
                                                font-style: italic!important;
                                            }                                    
                                            .testo_footer{
                                                font-family: Arial;
                                                font-style:italic;
                                                font-size: 11px;
                                                color: #5E5E5E;
                                            }                                    
                                            .bgcolor-white{
                                                background-color: #FFFFFF;
                                                border:1px solid #D0D0D0;
                                            }  
                                            .bgcolor-b{
                                                background-color:#DBD7D8;
                                                color:#5E5E5E;
                                                font-family:Georgia, serif;
                                                font-size: 18px;
                                            }  
                                            .bgcolor_beige{
                                                 background-color: #EBEBEB;
                                            }                                                      
                                            .paddingXX{
                                                padding: 40px;
                                            } 
                                            .paddingYY{
                                                padding: 20px;
                                            } 
                                            .paddingXY{
                                                padding-left: 40px;
                                                padding-right: 40px;
                                                padding-top: 20px;
                                                padding-bottom: 20px;
                                            } 
                                            .cell-data{
                                                width:100%!important;
                                                min-height:120px!important;
                                                height:auto!important;
                                                background-color:#DBD7D8!important;
                                                color:#706E6F!important;
                                                font-size: 24px!important;
                                                font-style: italic!important;
                                                
                                            }  
                                             .cell-link{
                                                padding: 20px;
                                                width:50%;
                                                background-color:#EF4047;
                                                color:#FFFFFF;
                                                font-family:Georgia, serif;
                                                font-size: 20px;
                                            } 
                                            .big_white{
                                                color:#FFFFFF;
                                                font-family:Georgia, serif;
                                                font-size: 28px;
                                                font-weight:bold;
                                            } 
                                            .small_white{
                                                color:#FFFFFF;
                                                font-family:Georgia, serif;
                                                font-size: 18px;
                                                font-weight:normal;
                                            }                                     
                                            .red{
                                                color:#EF4047;
                                            }
                                            hr{
                                                border-top:1px solid #FFFFFF;
                                                background-color:#FFFFFF;
                                            }
                                            .paddingTOP{
                                                padding: 10px;
                                            } 
                                            a:link { color: #FFFFFF; text-decoration:none}
                                            a:visited { color: #FFFFFF; text-decoration:none}
                                            a:hover {  color: #D0D0D0; text-decoration:none}

                                            .misura_tabella{
                                                 width:50%!important;
                                            }

                                            @media (max-width: 768px) { 
                                                .testo{
                                                    font-family:Georgia, serif;
                                                    font-size: 14px;
                                                    color: #5E5E5E;
                                                }
                                                .testo_big{
                                                    font-family:Georgia, serif;
                                                    font-size: 18px;
                                                    color: #5E5E5E;
                                                    font-style: italic!important;
                                                }
                                                .big_white{
                                                    color:#FFFFFF;
                                                    font-family:Georgia, serif;
                                                    font-size: 20px;
                                                    font-weight:bold;
                                                }  

                                                 .small_white{
                                                    color:#FFFFFF;
                                                    font-family:Georgia, serif;
                                                    font-size: 14px;
                                                    font-weight:normal;
                                                }  

                                                .paddingXX{
                                                    padding: 20px;
                                                } 
                                                .paddingYY{
                                                    padding: 10px;
                                                } 
                                                .paddingXY{
                                                    padding-left: 20px;
                                                    padding-right: 20px;
                                                    padding-top: 10px;
                                                    padding-bottom: 10px;
                                                } 
                                                .cell-data{
                                                    width:100%!important;
                                                    height:auto!important;
                                                    background-color:#DBD7D8!important;
                                                    color:#706E6F!important;
                                                    font-size: 14px!important;
                                                    font-style: italic!important;
                                                    text-align:center!important;
                                                    
                                                } 
                                                .text-right{
                                                    text-align:center!important;
                                                } 
                                                 .cell-link{
                                                    padding: 10px;
                                                    width:50%;
                                                    background-color:#EF4047;
                                                    color:#FFFFFF;
                                                    font-family:Georgia, serif;
                                                    font-size: 16px;
                                                } 

                                                .fa-2x {
                                                    font-size: 1em!important;
                                                }

                                                #data-richiesta{
                                                    display:none!important;
                                                }
                                                .alert {
                                                    padding:5px 5px 0px 5px!important;
                                                }
                                                .img-responsive {
                                                    max-width: 60%!important;
                                                    height: auto!important;
                                                    margin-bottom:10px!important;
                                                }
                                                .mini{
                                                    width:100%!important;

                                                }
                                                .misura_tabella{
                                                    width:100%!important;
                                                }

                                            }                                     

                                            @media (max-width: 992px) {

                                                .testo{
                                                    font-family:Georgia, serif;
                                                    font-size: 16px;
                                                    color: #5E5E5E;
                                                }
                                                .testo_big{
                                                    font-family:Georgia, serif;
                                                    font-size: 20px;
                                                    color: #5E5E5E;
                                                    font-style: italic!important;
                                                }
                                                .big_white{
                                                    color:#FFFFFF;
                                                    font-family:Georgia, serif;
                                                    font-size: 22px;
                                                    font-weight:bold;
                                                }  

                                                 .small_white{
                                                    color:#FFFFFF;
                                                    font-family:Georgia, serif;
                                                    font-size: 16px;
                                                    font-weight:normal;
                                                }  

                                                .paddingXX{
                                                    padding: 30px;
                                                } 
                                                .paddingYY{
                                                    padding: 15px;
                                                } 
                                                .paddingXY{
                                                    padding-left: 30px;
                                                    padding-right: 30px;
                                                    padding-top: 15px;
                                                    padding-bottom: 15px;
                                                } 
                                                .cell-data{
                                                    width:100%!important;
                                                    height:auto!important;
                                                    background-color:#DBD7D8!important;
                                                    color:#706E6F!important;
                                                    font-size: 16px!important;
                                                    font-style: italic!important;
                                                    text-align:center!important;
                                                    
                                                } 
                                                .text-right{
                                                    text-align:center!important;
                                                } 
                                                 .cell-link{
                                                    padding: 15px;
                                                    width:50%;
                                                    background-color:#EF4047;
                                                    color:#FFFFFF;
                                                    font-family:Georgia, serif;
                                                    font-size: 18px;
                                                } 

                                                .fa-2x {
                                                    font-size: 1em!important;
                                                }

                                                #data-richiesta{
                                                    display:none!important;
                                                }
                                                .alert {
                                                    padding:10px 10px 0px 10px!important;
                                                }
                                                .img-responsive {
                                                    max-width: 100%!important;
                                                    margin-bottom:10px!important;
                                                }
                                                .right-float{
                                                    position:relative!important;
                                                    max-width:90%!important;
                                                    margin: 0 auto;

                                                }
                                                .misura_tabella{
                                                    width:90%!important;
                                                }

                                             }
                                          
                                        </style>                                             
                                    </head>
                                <body>';
       $messaggio .= '<table class="testo" border="0" width="100%">
                        <tr>
                        <td colspan="2">
                        <table class="testo misura_tabella" border="0"  align="center">
                            <tr>
                             <td align="left" style="padding-bottom:5px!important"><b>'.(AVATAR!=''?'<img src="'.BASE_URL_SUITEWEB.'v2/uploads/loghi_siti/'.AVATAR.'">':ucfirst($rows['nome'])).'</b></td>
                             <td id="data-richiesta" align="right"><b>'.DATA_RICHIESTA.'</b><br>'.date('d-m-Y').'</td>
                            </tr>
                        </table>
                                               
                        <table class="testo bgcolor-white misura_tabella" border="0"  align="center">
                           <tr>
                            <td class="paddingXX">';
          $messaggio .= str_replace("[cliente]",('<b>'.$Nome.' '.$Cognome.'</b>'),TESTOMAIL);

          $messaggio .= '</td>
                        </tr>
                        </table>';

     
        $messaggio .= ' <br><br><a href="'.$link.'">                          
                        <table class="testo cell-link misura_tabella" border="0" align="center">
                           <tr>
                                <td class="paddingXY"><b class="big_white">'.PAGINARISERVATA.'</b><br><b class="small_white">'.TXTLINK4.'</b></td>
                                <td class="paddingXY" align="right"> 
                                    <i class="fa fa-star fa-2x"></i>
                                    <i class="fa fa-star fa-2x"></i>
                                    <i class="fa fa-star fa-2x"></i>
                                    <i class="fa fa-star-half-o fa-2x"></i>
                                </td>
                            </tr>                          
                        </table>
                        </a>                         
                        <br><br>
                        <table class="testo bgcolor-white misura_tabella" border="0" align="center">
                           <tr>
                                <td class="paddingXX"><span class="testo_big">'.SALUTI_H.'</span><br><br>'.$Operatore.' - <b class="red">'.ucfirst($rows['nome']).'</b><br>
                                '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                                 Tel. '.$tel.' '.($fax!=''?'Fax. '.$fax:'').' E-mail: '.$rows['email'].'</td>
                            </tr>                          
                        </table>
                        <br><br>
                        <table class="testo_footer misura_tabella" border="0"  align="center">
                           <tr>
                                <td align="right">'.NO_REPLAY_EMAIL.'</td>
                            </tr>                          
                        </table> 
                        <br><br><br>
                        <table class="testo_footer misura_tabella" border="0" align="center">
                           <tr>
                                <td align="right">By Network Service s.r.l.</td>
                            </tr>                          
                        </table>';   
        $messaggio .=  '</td>
                      </tr>                  
                      </table>
                      </body>
                      </html>';               


                
                    $mail->msgHTML($messaggio, dirname(__FILE__));
                    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                    $mail->send();


                    $update = "UPDATE hospitality_guest SET CS_inviato = 1 WHERE Id = ".$IdRichiesta;
                    $db->query($update);

          }//fine ciclo


    }// fine if
?>