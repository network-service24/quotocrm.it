<?php

            $select = "SELECT idsito,NumeroPrenotazione,DataArrivo,DataPartenza,Lingua FROM hospitality_guest  WHERE Id = ".$_REQUEST['azione'];
            $dati_ = $dbMysqli->query($select);
            $dati =  $dati_[0];       
            //                  assegno alcune variabili
            $idsito             =       $dati['idsito'];
            $NumeroPrenotazione =       $dati['NumeroPrenotazione'];
            $Lingua             =       $dati['Lingua'];
            $Arrivo             =       $fun->gira_data($dati['DataArrivo']);
            $Partenza           =       $fun->gira_data($dati['DataPartenza']);

            include($_SERVER['DOCUMENT_ROOT'].'/lingue/lang.php');

            $testo = str_replace("[Arrivo]",$Arrivo,TESTOMAIL_RITORNO_DISPONIBILITA);
            $testo = str_replace("[Partenza]",$Partenza ,$testo);
            $testo = str_replace("[sitoweb]",HTTPHEADER.SITOWEB,$testo);


            $content = '<!--  custom.functions .js -->
                        <link rel="stylesheet" type="text/css" href="'.BASE_URL_SITO.'css/custom.css">
                        <div id="result_disp'.$_REQUEST['azione'].'" class="alert alert-success text-center" style="display:none">
                            <h2>Invio email al cliente avvenuto con successo!</h2>
                            <br><br>
                            <h2>Attendi il reload della pagina!</h2>
                        </div>
                        <form id="invio_email_dispo'.$_REQUEST['azione'].'" method="POST">

                                <div class="form-group">
                                    <label>Contenuto E-mail per il cliente</label>											
                                    <textarea id="testo_email_dispo'.$_REQUEST['azione'].'" name="testo_email_dispo" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="height:300px">'.$testo.'</textarea>
                                          <input type="hidden" name="idsito" value="'.IDSITO.'">
                                        <input type="hidden" name="id_richiesta" value="'.$_REQUEST['azione'].'">
                                        <input type="hidden" name="action" value="send_email_dispo">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-center"></div>
                                        <div class="col-md-4 text-center">
                                            <button type="submit" class="btn btn-primary">Invia email</button>
                                            
                                            <script>
                                                $(document).ready(function() {

                                                    $("#testo_email_dispo'.$_REQUEST['azione'].'").wysihtml5();

                                          
                                                    
                                                    $("#invio_email_dispo'.$_REQUEST['azione'].'").on("submit",function(){
                                                
                                                        var dati = $("#invio_email_dispo'.$_REQUEST['azione'].'").serialize();
                                                      
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "'.BASE_URL_SITO.'ajax/sendmail/send_nuova_disponibilita.php",
                                                            data: dati,
                                                            success: function(msg)
                                                            {
                                                                $("#invio_email_dispo'.$_REQUEST['azione'].'").hide();
                                                                $("#result_disp'.$_REQUEST['azione'].'").show();
                                                                setTimeout(function(){ 
                                                                    parent.location.reload();
                                                                }, 1000);


                                                            }
                                                        });
                                                        return false;                                                   
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-4 text-center"></div>
                                    </div>
                                </div>
                        </form>'."\r\n";


?>