<?php
    // Ciclo per il select numerico adulti ericsoft booking
    $eSB = 1;
    for($eSB==1; $eSB<=6; $eSB++){
       $NumeriSB .='<option value="'.$eSB.'">'.$eSB.'</option>';
    }
    // Ciclo per il select numerico adulti ericsoft booking
    $xSB = 1;
    for($xSB==1; $xSB<=6; $xSB++){
       $NumeriBimbiSB .='<option value="'.$xSB.'">'.$xSB.'</option>';
    }
    // eta bimbi bedzzle booking
    $e = 1;
    $etaBimbi1 .='<option value="0">0</option>';
    for($e==1; $e<=12; $e++){
       $etaBimbi1 .='<option value="'.$e.'">'.$e.'</option>';
    }
    $e1 = 1;
    $etaBimbi2 .='<option value="0" '.($EtaBambini1=='0'?'selected="selected"':'').'>0</option>';
    for($e1==1; $e1<=12; $e1++){
       $etaBimbi2 .='<option value="'.$e1.'" '.($EtaBambini1==$e1?'selected="selected"':'').'>'.$e1.'</option>';
    }

    $e3 = 1;
    $etaBimbi3 .='<option value="0" '.($EtaBambini3=='0'?'selected="selected"':'').'>0</option>';
    for($e3==1; $e3<=12; $e3++){
       $etaBimbi3 .='<option value="'.$e3.'" '.($EtaBambini3==$e3?'selected="selected"':'').'>'.$e3.'</option>';
    }
    $e4 = 1;
    $etaBimbi4 .='<option value="0" '.($EtaBambini4=='0'?'selected="selected"':'').'>0</option>';
    for($e4==1; $e4<=12; $e4++){
       $etaBimbi4 .='<option value="'.$e4.'" '.($EtaBambini4==$e4?'selected="selected"':'').'>'.$e4.'</option>';
    }
    $e5 = 1;
    $etaBimbi5 .='<option value="0" '.($EtaBambini5=='0'?'selected="selected"':'').'>0</option>';
    for($e5==1; $e5<=12; $e5++){
       $etaBimbi5 .='<option value="'.$e5.'" '.($EtaBambini5==$e5?'selected="selected"':'').'>'.$e5.'</option>';
    }
    $e6 = 1;
    $etaBimbi6 .='<option value="0" '.($EtaBambini6=='0'?'selected="selected"':'').'>0</option>';
    for($e6==1; $e6<=12; $e6++){
       $etaBimbi6 .='<option value="'.$e6.'" '.($EtaBambini6==$e6?'selected="selected"':'').'>'.$e6.'</option>';
    }
    ###############################################
for ($numB==1; $numB<=5; $numB++){?>
<div class="modal fade" id="input_booking<?=$numB?>"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Inserisci i dati utili per SimpleBooking </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="control-group">
                        <label for="PromotionCode" class="control-label">Codice Promo</label>
                        <div class="controls">
                            <div class="input-group">
                                <input id="PromotionCode<?=$numB?>" name="PromotionCode" type="text" class="form-control" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
             <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataArrivo" class="control-label">Data Arrivo</label>
                            <div class="controls">
                                <div class="input-group">
                                    <input id="DataArrivoB<?=$numB?>" name="DataArrivoB<?=$numB?>" type="date" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataPartenza" class="control-label">Data Partenza</label>
                            <div class="controls">
                                <div class="input-group">
                                    <input id="DataPartenzaB<?=$numB?>" name="DataPartenzaB<?=$numB?>" type="date" class="form-control"  autocomplete="off" />
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">             
                    <div class="form-group">
                            <label for="NumeroAdultiB<?=$numB?>">Numero Adulti</label>
                            <select id="NumeroAdultiB<?=$numB?>" name="NumeroAdultiB<?=$numB?>" class="form-control" required>
                                <option value="" selected="selected">--</option>
                                <?=$NumeriSB?>
                            </select>
                        </div>                                                         
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="NumeroBambiniB<?=$numB?>">Numero Bambini</label>
                                <select name="NumeroBambiniB<?=$numB?>" id="NumeroBambiniB<?=$numB?>" class="form-control" >
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriBimbiSB?>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini1B<?=$numB?>">Età 1°</label>
                            <select id="EtaB1B<?=$numB?>" name="EtaBambini1B<?=$numB?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi1?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini2B<?=$numB?>">Età 2°</label>
                            <select id="EtaB2B<?=$numB?>" name="EtaBambini2B<?=$numB?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi2?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini3B<?=$numB?>">Età 3°</label>
                            <select id="EtaB3B<?=$numB?>" name="EtaBambini3B<?=$numB?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi3?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini4B<?=$numB?>">Età 4°</label>
                            <select id="EtaB4B<?=$numB?>" name="EtaBambini4B<?=$numB?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi4?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini5B<?=$numB?>">Età 5°</label>
                            <select id="EtaB5B<?=$numB?>" name="EtaBambini5B<?=$numB?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi5?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini6B<?=$numB?>">Età 6°</label>
                            <select id="EtaB6B<?=$numB?>" name="EtaBambini6B<?=$numB?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi6?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="n_cm<?=$numB?>"><input type="hidden" id="numero_camere<?=$numB?>" name="numero_camere<?=$numB?>" value="1"/></div>
               
                <div id="add2_room<?=$numB?>" style="cursor:pointer"><i class="fa fa-plus"></i> 2° camera</div>
                <script>
                    $(document).ready(function(){
                        $("#add2_room<?=$numB?>").on("click",function(){
                            $("#seconda<?=$numB?>").slideToggle( "slow", function() {
                                if($("#seconda<?=$numB?>").is(":visible")){
                                    $("#add2_room<?=$numB?>").html("<i class=\"fa fa-minus\"></i> 2° camera");
                                    $("#n_room<?=$numB?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numB?>\" name=\"numero_camere<?=$numB?>\" value=\"2\"/>");
                                    $("#n_cm<?=$numB?>").html(""); 
                                    $("#add3_room<?=$numB?>").show();   
                                }else{
                                    $("#add2_room<?=$numB?>").html("<i class=\"fa fa-plus\"></i> 2° camera");   
                                    $("#n_room<?=$numB?>").html("");     
                                    $("#add3_room<?=$numB?>").hide();  
                                    $("#n_cm<?=$numB?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numB?>\" name=\"numero_camere<?=$numB?>\" value=\"1\"/>");                
                                }
                            });
                        });
                    });
                </script>
                <div id="seconda<?=$numB?>" style="display:none">
                    <div id="n_room<?=$numB?>"></div>
                    <div class="clearfix p-t-5 p-b-5"></div> 
                        <div class="row">
                            <div class="col-md-6">             
                            <div class="form-group">
                                    <label for="NumeroAdultiB<?=$numB?>_2">Numero Adulti</label>
                                    <select id="NumeroAdultiB<?=$numB?>_2" name="NumeroAdultiB<?=$numB?>_2" class="form-control" required>
                                        <option value="" selected="selected">--</option>
                                        <?=$NumeriSB?>
                                    </select>
                                </div>                                                         
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="NumeroBambiniB<?=$numB?>_2">Numero Bambini</label>
                                        <select name="NumeroBambiniB<?=$numB?>_2" id="NumeroBambiniB<?=$numB?>_2" class="form-control" >
                                            <option value="" selected="selected">--</option>
                                            <?=$NumeriBimbiSB?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini1B<?=$numB?>_2">Età 1°</label>
                                    <select id="EtaB1B<?=$numB?>_2" name="EtaBambini1B<?=$numB?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi1?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini2B<?=$numB?>_2">Età 2°</label>
                                    <select id="EtaB2B<?=$numB?>_2" name="EtaBambini2B<?=$numB?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi2?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini3B<?=$numB?>_2">Età 3°</label>
                                    <select id="EtaB3B<?=$numB?>_2" name="EtaBambini3B<?=$numB?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi3?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini4B<?=$numB?>_2">Età 4°</label>
                                    <select id="EtaB4B<?=$numB?>_2" name="EtaBambini4B<?=$numB?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi4?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini5B<?=$numB?>_2">Età 5°</label>
                                    <select id="EtaB5B<?=$numB?>_2" name="EtaBambini5B<?=$numB?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi5?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini6B<?=$numB?>_2">Età 6°</label>
                                    <select id="EtaB6B<?=$numB?>_2" name="EtaBambini6B<?=$numB?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi6?>
                                    </select>
                                </div>
                            </div>
                        </div>                
                    
                </div>
                <div class="clearfix p-t-5 p-b-5"></div> 
                <div id="add3_room<?=$numB?>" style="display:none;cursor:pointer"><i class="fa fa-plus"></i> 3° camera</div>
                <script>
                    $(document).ready(function(){
                        $("#add3_room<?=$numB?>").on("click",function(){
                            $("#terza<?=$numB?>").slideToggle( "slow", function() {
                                if($("#terza<?=$numB?>").is(":visible")){
                                    $("#add3_room<?=$numB?>").html("<i class=\"fa fa-minus\"></i> 3° camera");
                                    $("#n_room<?=$numB?>").html("");
                                    $("#num_room<?=$numB?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numB?>\" name=\"numero_camere<?=$numB?>\" value=\"3\"/>");
                                }else{
                                    $("#add3_room<?=$numB?>").html("<i class=\"fa fa-plus\"></i> 3° camera");   
                                    $("#num_room<?=$numB?>").html("");    
                                    $("#n_room<?=$numB?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numB?>\" name=\"numero_camere<?=$numB?>\" value=\"2\"/>");                  
                                }
                            });
                        });
                    });
                </script>
                <div id="terza<?=$numB?>" style="display:none">
                    <div id="num_room<?=$numB?>"></div>
                    <div class="clearfix p-t-5 p-b-5"></div> 
                        <div class="row">
                            <div class="col-md-6">             
                            <div class="form-group">
                                    <label for="NumeroAdultiB<?=$numB?>_3">Numero Adulti</label>
                                    <select id="NumeroAdultiB<?=$numB?>_3" name="NumeroAdultiB<?=$numB?>_3" class="form-control" required>
                                        <option value="" selected="selected">--</option>
                                        <?=$NumeriSB?>
                                    </select>
                                </div>                                                         
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="NumeroBambiniB<?=$numB?>_3">Numero Bambini</label>
                                        <select name="NumeroBambiniB<?=$numB?>_3" id="NumeroBambiniB<?=$numB?>_3" class="form-control" >
                                            <option value="" selected="selected">--</option>
                                            <?=$NumeriBimbiSB?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini1B<?=$numB?>_3">Età 1°</label>
                                    <select id="EtaB1B<?=$numB?>_3" name="EtaBambini1B<?=$numB?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi1?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini2B<?=$numB?>_3">Età 2°</label>
                                    <select id="EtaB2B<?=$numB?>_3" name="EtaBambini2B<?=$numB?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi2?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini3B<?=$numB?>_3">Età 3°</label>
                                    <select id="EtaB3B<?=$numB?>_3" name="EtaBambini3B<?=$numB?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi3?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini4B<?=$numB?>_3">Età 4°</label>
                                    <select id="EtaB4B<?=$numB?>_3" name="EtaBambini4B<?=$numB?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi4?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini5B<?=$numB?>_3">Età 5°</label>
                                    <select id="EtaB5B<?=$numB?>_3" name="EtaBambini5B<?=$numB?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi5?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini6B<?=$numB?>_3">Età 6°</label>
                                    <select id="EtaB6B<?=$numB?>_3" name="EtaBambini6B<?=$numB?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi6?>
                                    </select>
                                </div>
                            </div>
                        </div>                
                    
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary" id="SB_booking<?=$numB?>B"  data-dismiss="modal" aria-label="Close">Controlla disponibilità </button>
                    </div>
                </div> 
                <script>
                    $(document).ready(function(){
                        $("#DataArrivoB<?=$numB?>").change(function () {
                            var dateAB = new Date($("#DataArrivoB<?=$numB?>")[0].valueAsDate);
                            dateAB.setDate(dateAB.getDate() + 1);
                            $('#DataPartenzaB<?=$numB?>')[0].valueAsDate = dateAB;
                        })
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?}?>