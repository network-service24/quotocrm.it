<?php


    $select = $db->query("SELECT hospitality_guest.* 
                          FROM hospitality_guest 
                          WHERE hospitality_guest.idsito = ".IDSITO."  
                          AND hospitality_guest.Id = '".$_REQUEST['id_guest']."'");
    $row = $db->row($select);

    $query      = $db->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." AND NomeOperatore != '".$row['ChiPrenota']."' ORDER BY Id ASC");
    $array_op   = $db->result();
    $Operatori .='<option value="">scegli</option>';
    foreach($array_op  as $chiave => $valore){
        $Operatori .='<option value="'.$valore['NomeOperatore'].'" >'.$valore['NomeOperatore'].'</option>';
    }

    if($row['DataScadenza']< date("Y-m-d")){
        $text = '<small class="text-primary">La <b>Data di Scadenza</b> della proposta è passata oppure non impostata, per <b>rispondere alla chat</b> è necessario <b>modificarla</b>!</small><br> <small style="color:#999!important">Perchè al cliente arriva email di avviso che lo rimanda alla landing page per la lettura della chat, che quindi non può essere scaduta!</small>';
        $title = 'Data di Scadenza passata, modificarla!';
       // $command = 'disabled="disabled"';
   
        $dataS__ = explode("-",$row['DataScadenza']);
        $dataSC = $dataS__[2].'-'.$dataS__[1].'-'.$dataS__[0];
        $form_data_scadenza .= '<small>
                                <div id="ResultDataScadenza"></div>
                                <form  method="POST" id="form_change" name="form_change">
                                    <div class="row">
                                        <div class="col-md-3" text-center">
                                            <label  class="control-label">Data Scadenza</label>
                                            <input type="text" id="DataScadenza" autocomplete="off"  class="date-picker form-control" name="DataScadenza" value="'.$dataSC.'">
                                        </div>
                                        <div class="col-md-1 text-left">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            <input type="hidden" name="action" value="change">
                                            <input type="hidden" name="id_richiesta" value="'.$row['Id'].'">
                                            <input type="hidden" name="idsito" value="'.IDSITO.'">
                                            <button type="submit" class="btn btn-primary" id="bottone">Modifica</button>
                                        </div>
                                        <div class="col-md-8 text-right">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            '.$text.'
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix" style="height:40px!important"></div>
                                </small>'."\r\n";
        $form_data_scadenza .= '  <link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
        $form_data_scadenza .= '  <script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
        $form_data_scadenza .= '  <script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
        $form_data_scadenza .=' <script>
                                    $(document).ready(function() {

                                        $( "#DataScadenza" ).datepicker({
                                            numberOfMonths: 1,
                                            language:\'it\',
                                            showButtonPanel: true
                                        });
                                        
                                        $("#form_change").submit(function(){
                                            
                                            var dati = $("#form_change").serialize();                                                            
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/modifica_data_scadenza.php",
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(data) {                                                                                                          
                                                            $("#ResultDataScadenza").html(\'<div class="alert alert-success">Data salvata con successo! Attendi il reload della pagina!</div>\'); 
                                                            setTimeout(function(){ 
                                                                location.reload();  
                                                            }, 500);
                                                                                                            
                                                        }                                                                    
                                                    });                                                               
                                                return false; // con false senza refresh della pagina
                                        });                                                                                                                                                                                                                                                                                                  
                                    });
                                </script>'."\r\n";
    }  
    $js_chat ='<script>
                    $(document).ready(function() {
                        $("#form_chat").submit(function(){
                            
                            var dati = $("#form_chat").serialize();                                                            
                                $.ajax({
                                    url: "'.BASE_URL_SITO.'ajax/aggiungi_chat.php",
                                    type: "POST",
                                    data: dati,
                                        success: function(data) {                                                                                                          
                                            $("#chat").val(""); 
                                            $("#balloon").load("'.BASE_URL_SITO.'ajax/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                                                            
                                        }                                                                    
                                    });                                                               
                                return false; // con false senza refresh della pagina
                        });                                                                                                                                                                                                                                                                    

                        $("#balloon").load("'.BASE_URL_SITO.'ajax/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                    });
                </script>'."\r\n";
    $js_chat_load ='<script>
                        $(document).ready(function() {
                            $("#balloon").load("'.BASE_URL_SITO.'ajax/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                        });
                    </script>'."\r\n";
?>