<?php
 # INTERFACCIA
$num = $fun->get_pag(IDSITO);


$content ='    <div class="row">
                    <div class="col-md-3">
                        <label>Numero di record per la paginazione dei preventivi</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select class="form-control" id="valore_breadcrumb" name="valore_breadcrumb">
                                <option value="" '.($num==''?'selected="selected"':'').'>--</option>
                                <option value="40" '.($num==40?'selected="selected"':'').'>40</option>
                                <option value="50" '.($num==50?'selected="selected"':'').'>50</option>
                                <option value="60" '.($num==60?'selected="selected"':'').'>60</option>
                            </select>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#valore_breadcrumb").on("change",function () {   
                            var  valore_breadcrumb  = $("#valore_breadcrumb").val();    
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/generici/modifica_breadcrumb.php",
                                type: "POST",
                                data: "action=breadcrumb&idsito='.IDSITO.'&valore_breadcrumb="+valore_breadcrumb+"",
                                dataType: "html",
                                success: function(data) {
                                    open_notifica("<div class=\"text-center\">Record modificato</div>","<div class=\"text-center\">Record modificato con successo!</div>","plain","top-center","warning",3000,"#000000");   
                                }
                            });
                            return false; // con false senza refresh della pagina                                       
                        });
                    });
                </script>';
?>      