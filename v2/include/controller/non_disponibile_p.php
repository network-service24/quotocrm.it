<?php

            $select = "SELECT NumeroPrenotazione,DataArrivo,DataPartenza,Lingua FROM hospitality_guest  WHERE Id = ".$_REQUEST['azione'];
            $dati_ = $db->query($select);
            $dati =  $db->row($dati_);       
            //                  assegno alcune variabili
            $NumeroPrenotazione =       $dati['NumeroPrenotazione'];
            $Lingua             =       $dati['Lingua'];
            $Arrivo             =       gira_data($dati['DataArrivo']);
            $Partenza           =       gira_data($dati['DataPartenza']);

            include($_SERVER['DOCUMENT_ROOT'].'/v2/lingue/lang.php');

            $testo_p = str_replace("[Arrivo]",$Arrivo,TESTOMAIL_ANNULLA_PREVENTIVO_NODISPO);
            $testo_p = str_replace("[Partenza]",$Partenza ,$testo_p);
            $testo_p = str_replace("[sitoweb]",HTTPHEADER.SITOWEB,$testo_p);

            $testo2_p = str_replace("[Arrivo]",$Arrivo,TESTOMAIL_ANNULLA_PREVENTIVO_STRUTTURA_CHIUSA);
            $testo2_p = str_replace("[Partenza]",$Partenza,$testo2_p);
            $testo2_p = str_replace("[sitoweb]",HTTPHEADER.SITOWEB,$testo2_p);

            $testo3_p = str_replace("[Arrivo]",$Arrivo,TESTOMAIL_ANNULLA_PREVENTIVO_ALTRO);
            $testo3_p = str_replace("[Partenza]",$Partenza,$testo3_p);
            $testo3_p = str_replace("[sitoweb]",HTTPHEADER.SITOWEB,$testo3_p);


            $content = '<div id="result_no_disp'.$_REQUEST['azione'].'" class="alert alert-success text-center" style="display:none">
                            <h2>Invio email al cliente e  salvataggio dati statistici avvenuto con successo!</h2>
                            <br><br>
                            <h2>Attendi il reload della pagina!</h2>
                        </div>
                        <form id="invio_email_no_dispo'.$_REQUEST['azione'].'" method="POST">
                                <div class="form-group">
                                    <label>Motivazione</label><br>     
                                    <input type="radio" class="scelta_m" name="motivo" value="Assenza Disponibilità" checked="checked" required> Assenza Disponibilità<br>
                                    <input type="radio" class="scelta_m" name="motivo" value="Struttura Ricettiva Chiusa" required> Struttura Ricettiva Chiusa<br>
                                    <input type="radio" class="scelta_m" name="motivo" id="altro'.$_REQUEST['azione'].'" value="Altro" required> Altro<br>
                                    <input type="text" id="motivo_custom'.$_REQUEST['azione'].'" name="motivo_custom" placeholder="inserire la vostra motivazione" class="form-control" style="display:none">
                                </div>
                                <div class="form-group">
                                    <label>Contenuto E-mail per il cliente</label>											
                                    <textarea id="testo_email_no_dispo'.$_REQUEST['azione'].'" name="testo_email_no_dispo" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="height:300px">'.$testo_p.'</textarea>
                                    <textarea id="2testo_email_no_dispo'.$_REQUEST['azione'].'" name="2testo_email_no_dispo" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="height:300px;display:none">'.$testo2_p.'</textarea>
                                    <textarea id="3testo_email_no_dispo'.$_REQUEST['azione'].'" name="3testo_email_no_dispo" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="height:300px;display:none">'.$testo3_p.'</textarea>  
                                        <input type="hidden" name="idsito" value="'.IDSITO.'">
                                        <input type="hidden" name="id_richiesta" value="'.$_REQUEST['azione'].'">
                                        <input type="hidden" name="action" value="send_email_no_dispo">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-center"></div>
                                        <div class="col-md-4 text-center">
                                            <button type="submit" class="btn btn-primary">Invia email</button>
                                            
                                            <script>
                                                $(document).ready(function() {

                                                    $("#testo_email_no_dispo'.$_REQUEST['azione'].'").wysihtml5();

                                                    $(".scelta_m").on("change",function(){
                                                        var m = $("input[name=motivo]:checked", "#invio_email_no_dispo'.$_REQUEST['azione'].'").val();

                                                        if(m == "Assenza Disponibilità"){

                                                            $("#motivo_custom'.$_REQUEST['azione'].'").hide("slow");

                                                            $("#2testo_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                            var contentPar = $("#2testo_email_no_dispo'.$_REQUEST['azione'].'").parent();
                                                            contentPar.find(\'.wysihtml5-toolbar\').remove();
                                                            contentPar.find(\'iframe\').remove();
                                                            contentPar.find(\'input[name*="wysihtml5"]\').remove();

                                                            $("#3testo_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                            var contentPar3 = $("#3testo_email_no_dispo'.$_REQUEST['azione'].'").parent();
                                                            contentPar3.find(\'.wysihtml5-toolbar\').remove();
                                                            contentPar3.find(\'iframe\').remove();
                                                            contentPar3.find(\'input[name*="wysihtml5"]\').remove();

                                                            $("#testo_email_no_dispo'.$_REQUEST['azione'].'").wysihtml5();
                                                            $("#testo_email_no_dispo'.$_REQUEST['azione'].'").show();
                                                        }
                                                        if(m == "Struttura Ricettiva Chiusa"){

                                                            $("#motivo_custom'.$_REQUEST['azione'].'").hide("slow");

                                                            $("#testo_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                            $("#3testo_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                            var contentPar = $("#testo_email_no_dispo'.$_REQUEST['azione'].'").parent();
                                                            contentPar.find(\'.wysihtml5-toolbar\').remove();
                                                            contentPar.find(\'iframe\').remove();
                                                            contentPar.find(\'input[name*="wysihtml5"]\').remove();

                                                            $("#2testo_email_no_dispo'.$_REQUEST['azione'].'").wysihtml5();
                                                            $("#2testo_email_no_dispo'.$_REQUEST['azione'].'").show();
                                                        }
                                                        if(m == "Altro"){

                                                            $("#motivo_custom'.$_REQUEST['azione'].'").show("slow");

                                                            $("#testo_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                            $("#2testo_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                            var contentPar = $("#2testo_email_no_dispo'.$_REQUEST['azione'].'").parent();
                                                            contentPar.find(\'.wysihtml5-toolbar\').remove();
                                                            contentPar.find(\'iframe\').remove();
                                                            contentPar.find(\'input[name*="wysihtml5"]\').remove();

                                                            $("#3testo_email_no_dispo'.$_REQUEST['azione'].'").wysihtml5();
                                                            $("#3testo_email_no_dispo'.$_REQUEST['azione'].'").show();
                                                        }
                                                    });
                                                    
                                                    $("#invio_email_no_dispo'.$_REQUEST['azione'].'").on("submit",function(){
                                                
                                                        var dati = $("#invio_email_no_dispo'.$_REQUEST['azione'].'").serialize();
                                                      
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "'.BASE_URL_SITO.'ajax/send_no_dispo_preventivi.php",
                                                            data: dati,
                                                            success: function(msg)
                                                            {
                                                                $("#invio_email_no_dispo'.$_REQUEST['azione'].'").hide();
                                                                $("#result_no_disp'.$_REQUEST['azione'].'").show();
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