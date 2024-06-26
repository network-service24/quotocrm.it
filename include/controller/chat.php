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
    
    $css_pulsante = 'btn btn-primary';

    if($row['DataScadenza']< date("Y-m-d")){
        $text         = '<div class="alert alert-info text-black text-center"><span class="f-12">La <b>Data  di Scadenza</b> della proposta è passata oppure non impostata, per <b>rispondere alla chat</b> è necessario <b>modificarla</b>!</span></div>';
        $title        = 'Data  di  Scadenza passata, modificarla!';
        $command      = 'disabled="disabled"';
        $css_pulsante = 'btn btn-disabled';
   
        $dataS__ = explode("-",$row['DataScadenza']);
        $dataSC = $dataS__[2].'-'.$dataS__[1].'-'.$dataS__[0];
        $form_data_scadenza .= '<small>
                                <div id="ResultDataScadenza"></div>
                                <form  method="POST" id="form_change" name="form_change">
                                    <div class="row">
                                        <div class="col-md-3" text-center">
                                            <label  class="control-label">Data Scadenza</label>
                                            <input type="date" id="DataScadenza" autocomplete="off"  class=" form-control" name="DataScadenza" value="'.$row['DataScadenza'].'">
                                        </div>
                                        <div class="col-md-1 text-left">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            <input type="hidden" name="action" value="change">
                                            <input type="hidden" name="id_richiesta" value="'.$row['Id'].'">
                                            <input type="hidden" name="idsito" value="'.IDSITO.'">
                                            <button type="submit" class="btn btn-primary btn-sm" id="bottone">Modifica</button>
                                        </div>
                                        <div class="col-md-8 text-right">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            '.$text.'
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix" style="height:40px!important"></div>
                                </small>'."\r\n";
        $form_data_scadenza .=' <script>
                                    $(document).ready(function() {
                                        $("#form_change").submit(function(){
                                            
                                            var dati = $("#form_change").serialize();                                                            
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/chat/modifica_data_scadenza.php",
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
                                    url: "'.BASE_URL_SITO.'ajax/chat/aggiungi_chat.php",
                                    type: "POST",
                                    data: dati,
                                        success: function(data) {                                                                                                          
                                            $("#chat").val(""); 
                                            $("#balloon").load("'.BASE_URL_SITO.'ajax/chat/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                                                            
                                        }                                                                    
                                    });                                                               
                                return false; // con false senza refresh della pagina
                        });                                                                                                                                                                                                                                                                    

                        $("#balloon").load("'.BASE_URL_SITO.'ajax/chat/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                    });
                </script>'."\r\n";
    $js_chat_load ='<script>
                        $(document).ready(function() {
                            $("#balloon").load("'.BASE_URL_SITO.'ajax/chat/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                        });
                    </script>'."\r\n";

    $riferimenti = 'Nr.Rich: <b class="text-info">'.$row['Id'].'</b> 
                    Nr.Rif: <b class="text-info">'.$row['NumeroPrenotazione'].'</b> 
                    Nome: <b>'.stripslashes($row['Nome']).'</b> 
                    Cognome: <b>'.stripslashes($row['Cognome']).'</b>';

    $dettaglioProposta = $fun->dettaglio_richiesta($row['NumeroPrenotazione'],$row['idsito']);
?>