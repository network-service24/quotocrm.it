<?php


    // Ciclo per il select numerico adulti bedzzle booking
    $eBedzzle = 1;
    for($eBedzzle==1; $eBedzzle<=6; $eBedzzle++){
       $NumeriBedzzle .='<option value="'.$eBedzzle.'">'.$eBedzzle.'</option>';
    }
    // Ciclo per il select numerico adulti bedzzle booking
    $xBedzzle = 1;
    $NumeriBimbiBedzzle .='<option value="0">0</option>';
    for($xBedzzle==1; $xBedzzle<=6; $xBedzzle++){
       $NumeriBimbiBedzzle .='<option value="'.$xBedzzle.'">'.$xBedzzle.'</option>';
    }
    // eta bimbi bedzzle booking
    $e = 1;
    $etaBimbi1Bedzzle .='<option value="0">0</option>';
    for($e==1; $e<=12; $e++){
       $etaBimbi1Bedzzle .='<option value="'.$e.'">'.$e.'</option>';
    }
    $e1 = 1;
    $etaBimbi2Bedzzle .='<option value="0" '.($EtaBambini1=='0'?'selected="selected"':'').'>0</option>';
    for($e1==1; $e1<=12; $e1++){
       $etaBimbi2Bedzzle .='<option value="'.$e1.'" '.($EtaBambini1==$e1?'selected="selected"':'').'>'.$e1.'</option>';
    }

    $e3 = 1;
    $etaBimbi3Bedzzle .='<option value="0" '.($EtaBambini3=='0'?'selected="selected"':'').'>0</option>';
    for($e3==1; $e3<=12; $e3++){
       $etaBimbi3Bedzzle .='<option value="'.$e3.'" '.($EtaBambini3==$e3?'selected="selected"':'').'>'.$e3.'</option>';
    }
    $e4 = 1;
    $etaBimbi4Bedzzle .='<option value="0" '.($EtaBambini4=='0'?'selected="selected"':'').'>0</option>';
    for($e4==1; $e4<=12; $e4++){
       $etaBimbi4Bedzzle .='<option value="'.$e4.'" '.($EtaBambini4==$e4?'selected="selected"':'').'>'.$e4.'</option>';
    }
    $e5 = 1;
    $etaBimbi5Bedzzle .='<option value="0" '.($EtaBambini5=='0'?'selected="selected"':'').'>0</option>';
    for($e5==1; $e5<=12; $e5++){
       $etaBimbi5Bedzzle .='<option value="'.$e5.'" '.($EtaBambini5==$e5?'selected="selected"':'').'>'.$e5.'</option>';
    }
    $e6 = 1;
    $etaBimbi6Bedzzle .='<option value="0" '.($EtaBambini6=='0'?'selected="selected"':'').'>0</option>';
    for($e6==1; $e6<=12; $e6++){
       $etaBimbi6Bedzzle .='<option value="'.$e6.'" '.($EtaBambini6==$e6?'selected="selected"':'').'>'.$e6.'</option>';
    }
    ###############################################
for ($numBedzzle==1; $numBedzzle<=5; $numBedzzle++){?>
<div class="modal fade" id="input_bedzzle_booking<?=$numBedzzle?>"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Inserisci i dati utili al controllo del Booking Bedzzle</h4>
          </div>
          <div class="modal-body">
             <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataArrivo" class="control-label">Data Arrivo</label>
                            <div class="controls">
                                <div class="input-group">
                                    <label for="DataArrivoE<?=$numBedzzle?>" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                    <input id="DataArrivoBedzzle<?=$numBedzzle?>" name="DataArrivoBedzzle<?=$numBedzzle?>" type="text" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataPartenza" class="control-label">Data Partenza</label>
                            <div class="controls">
                                <div class="input-group">
                                    <label for="DataPartenzaBedzzle<?=$numBedzzle?>" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                    <input id="DataPartenzaBedzzle<?=$numBedzzle?>" name="DataPartenzaBedzzle<?=$numBedzzle?>" type="text" class="form-control"  autocomplete="off" />
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">             
                    <div class="form-group">
                            <label for="NumeroAdultiBedzzle<?=$numBedzzle?>">Numero Adulti</label>
                            <select id="NumeroAdultiBedzzle<?=$numBedzzle?>" name="NumeroAdultiBedzzle<?=$numBedzzle?>" class="form-control" required>
                                <option value="" selected="selected">--</option>
                                <?=$NumeriBedzzle?>
                            </select>
                        </div>                                                         
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="NumeroBambiniBedzzle<?=$numBedzzle?>">Numero Bambini</label>
                                <select name="NumeroBambiniBedzzle<?=$numBedzzle?>" id="NumeroBambiniBedzzle<?=$numBedzzle?>" class="form-control" >
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriBimbiBedzzle?>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini1Bedzzle<?=$numBedzzle?>">Età 1°</label>
                            <select id="EtaB1Bedzzle<?=$numBedzzle?>" name="EtaBambini1Bedzzle<?=$numBedzzle?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi1Bedzzle?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini2Bedzzle<?=$numBedzzle?>">Età 2°</label>
                            <select id="EtaB2Bedzzle<?=$numBedzzle?>" name="EtaBambini2Bedzzle<?=$numBedzzle?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi2Bedzzle?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini3Bedzzle<?=$numBedzzle?>">Età 3°</label>
                            <select id="EtaB3Bedzzle<?=$numBedzzle?>" name="EtaBambini3Bedzzle<?=$numBedzzle?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi3Bedzzle?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini4Bedzzle<?=$numBedzzle?>">Età 4°</label>
                            <select id="EtaB4Bedzzle<?=$numBedzzle?>" name="EtaBambini4Bedzzle<?=$numBedzzle?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi4Bedzzle?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini5Bedzzle<?=$numBedzzle?>">Età 5°</label>
                            <select id="EtaB5Bedzzle<?=$numBedzzle?>" name="EtaBambini5Bedzzle<?=$numBedzzle?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi5Bedzzle?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini6Bedzzle<?=$numBedzzle?>">Età 6°</label>
                            <select id="EtaB6Bedzzle<?=$numBedzzle?>" name="EtaBambini6Bedzzle<?=$numBedzzle?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi6Bedzzle?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="n_cm<?=$numBedzzle?>"><input type="hidden" id="numero_camere<?=$numBedzzle?>" name="numero_camere<?=$numBedzzle?>" value="1"/></div>
               
                <div id="add2_room<?=$numBedzzle?>" style="cursor:pointer"><i class="fa fa-plus"></i> 2° camera</div>
                <script>
                    $(document).ready(function(){
                        $("#add2_room<?=$numBedzzle?>").on("click",function(){
                            $("#seconda<?=$numBedzzle?>").slideToggle( "slow", function() {
                                if($("#seconda<?=$numBedzzle?>").is(":visible")){
                                    $("#add2_room<?=$numBedzzle?>").html("<i class=\"fa fa-minus\"></i> 2° camera");
                                    $("#n_room<?=$numBedzzle?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numBedzzle?>\" name=\"numero_camere<?=$numBedzzle?>\" value=\"2\"/>");
                                    $("#n_cm<?=$numBedzzle?>").html(""); 
                                    $("#add3_room<?=$numBedzzle?>").show();   
                                }else{
                                    $("#add2_room<?=$numBedzzle?>").html("<i class=\"fa fa-plus\"></i> 2° camera");   
                                    $("#n_room<?=$numBedzzle?>").html("");     
                                    $("#add3_room<?=$numBedzzle?>").hide();  
                                    $("#n_cm<?=$numBedzzle?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numBedzzle?>\" name=\"numero_camere<?=$numBedzzle?>\" value=\"1\"/>");                
                                }
                            });
                        });
                    });
                </script>
                <div id="seconda<?=$numBedzzle?>" style="display:none">
                    <div id="n_room<?=$numBedzzle?>"></div>
                    <div class="clearfix p-t-5 p-b-5"></div> 
                        <div class="row">
                            <div class="col-md-6">             
                            <div class="form-group">
                                    <label for="NumeroAdultiBedzzle<?=$numBedzzle?>_2">Numero Adulti</label>
                                    <select id="NumeroAdultiBedzzle<?=$numBedzzle?>_2" name="NumeroAdultiBedzzle<?=$numBedzzle?>_2" class="form-control" required>
                                        <option value="" selected="selected">--</option>
                                        <?=$NumeriBedzzle?>
                                    </select>
                                </div>                                                         
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="NumeroBambiniBedzzle<?=$numBedzzle?>_2">Numero Bambini</label>
                                        <select name="NumeroBambiniBedzzle<?=$numBedzzle?>_2" id="NumeroBambiniBedzzle<?=$numBedzzle?>_2" class="form-control" >
                                            <option value="" selected="selected">--</option>
                                            <?=$NumeriBimbiBedzzle?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini1Bedzzle<?=$numBedzzle?>_2">Età 1°</label>
                                    <select id="EtaB1Bedzzle<?=$numBedzzle?>_2" name="EtaBambini1Bedzzle<?=$numBedzzle?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi1Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini2Bedzzle<?=$numBedzzle?>_2">Età 2°</label>
                                    <select id="EtaB2Bedzzle<?=$numBedzzle?>_2" name="EtaBambini2Bedzzle<?=$numBedzzle?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi2Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini3Bedzzle<?=$numBedzzle?>_2">Età 3°</label>
                                    <select id="EtaB3Bedzzle<?=$numBedzzle?>_2" name="EtaBambini3Bedzzle<?=$numBedzzle?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi3Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini4Bedzzle<?=$numBedzzle?>_2">Età 4°</label>
                                    <select id="EtaB4Bedzzle<?=$numBedzzle?>_2" name="EtaBambini4Bedzzle<?=$numBedzzle?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi4Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini5Bedzzle<?=$numBedzzle?>_2">Età 5°</label>
                                    <select id="EtaB5Bedzzle<?=$numBedzzle?>_2" name="EtaBambini5Bedzzle<?=$numBedzzle?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi5Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini6Bedzzle<?=$numBedzzle?>_2">Età 6°</label>
                                    <select id="EtaB6Bedzzle<?=$numBedzzle?>_2" name="EtaBambini6Bedzzle<?=$numBedzzle?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi6Bedzzle?>
                                    </select>
                                </div>
                            </div>
                        </div>                
                    
                </div>
                <div class="clearfix p-t-5 p-b-5"></div> 
                <div id="add3_room<?=$numBedzzle?>" style="display:none;cursor:pointer"><i class="fa fa-plus"></i> 3° camera</div>
                <script>
                    $(document).ready(function(){
                        $("#add3_room<?=$numBedzzle?>").on("click",function(){
                            $("#terza<?=$numBedzzle?>").slideToggle( "slow", function() {
                                if($("#terza<?=$numBedzzle?>").is(":visible")){
                                    $("#add3_room<?=$numBedzzle?>").html("<i class=\"fa fa-minus\"></i> 3° camera");
                                    $("#n_room<?=$numBedzzle?>").html("");
                                    $("#num_room<?=$numBedzzle?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numBedzzle?>\" name=\"numero_camere<?=$numBedzzle?>\" value=\"3\"/>");
                                }else{
                                    $("#add3_room<?=$numBedzzle?>").html("<i class=\"fa fa-plus\"></i> 3° camera");   
                                    $("#num_room<?=$numBedzzle?>").html("");    
                                    $("#n_room<?=$numBedzzle?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numBedzzle?>\" name=\"numero_camere<?=$numBedzzle?>\" value=\"2\"/>");                  
                                }
                            });
                        });
                    });
                </script>
                <div id="terza<?=$numBedzzle?>" style="display:none">
                    <div id="num_room<?=$numBedzzle?>"></div>
                    <div class="clearfix p-t-5 p-b-5"></div> 
                        <div class="row">
                            <div class="col-md-6">             
                            <div class="form-group">
                                    <label for="NumeroAdultiBedzzle<?=$numBedzzle?>_3">Numero Adulti</label>
                                    <select id="NumeroAdultiBedzzle<?=$numBedzzle?>_3" name="NumeroAdultiBedzzle<?=$numBedzzle?>_3" class="form-control" required>
                                        <option value="" selected="selected">--</option>
                                        <?=$NumeriBedzzle?>
                                    </select>
                                </div>                                                         
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="NumeroBambiniBedzzle<?=$numBedzzle?>_3">Numero Bambini</label>
                                        <select name="NumeroBambiniBedzzle<?=$numBedzzle?>_3" id="NumeroBambiniBedzzle<?=$numBedzzle?>_3" class="form-control" >
                                            <option value="" selected="selected">--</option>
                                            <?=$NumeriBimbiBedzzle?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini1Bedzzle<?=$numBedzzle?>_3">Età 1°</label>
                                    <select id="EtaB1Bedzzle<?=$numBedzzle?>_3" name="EtaBambini1Bedzzle<?=$numBedzzle?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi1Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini2Bedzzle<?=$numBedzzle?>_3">Età 2°</label>
                                    <select id="EtaB2Bedzzle<?=$numBedzzle?>_3" name="EtaBambini2Bedzzle<?=$numBedzzle?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi2Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini3Bedzzle<?=$numBedzzle?>_3">Età 3°</label>
                                    <select id="EtaB3Bedzzle<?=$numBedzzle?>_3" name="EtaBambini3Bedzzle<?=$numBedzzle?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi3Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini4Bedzzle<?=$numBedzzle?>_3">Età 4°</label>
                                    <select id="EtaB4Bedzzle<?=$numBedzzle?>_3" name="EtaBambini4Bedzzle<?=$numBedzzle?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi4Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini5Bedzzle<?=$numBedzzle?>_3">Età 5°</label>
                                    <select id="EtaB5Bedzzle<?=$numBedzzle?>_3" name="EtaBambini5Bedzzle<?=$numBedzzle?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi5Bedzzle?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini6Bedzzle<?=$numBedzzle?>_3">Età 6°</label>
                                    <select id="EtaB6Bedzzle<?=$numBedzzle?>_3" name="EtaBambini6Bedzzle<?=$numBedzzle?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi6Bedzzle?>
                                    </select>
                                </div>
                            </div>
                        </div>                
                    
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-danger" id="SB_booking<?=$numBedzzle?>Bedzzle"  data-dismiss="modal" aria-label="Close">Controlla disponibilità <small>con</small> <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png" style="text-align:absmiddle;width:auto;height:25px"></button>
                    </div>
                </div> 
                <script>
                    $(function() {
                        $( "#DataArrivoBedzzle<?=$numBedzzle?>" ).datepicker({
                                numberOfMonths: 1,
                                language:'it',
                                showButtonPanel: true,
                                startDate: "today"
                            });
                            $("#DataArrivoBedzzle<?=$numBedzzle?>").datepicker({dateFormat: "dd/mm/yy"}).change(function () {             
                                var $picker = $("#DataArrivoBedzzle<?=$numBedzzle?>");
                                var $picker2 = $("#DataPartenzaBedzzle<?=$numBedzzle?>");
                                var date=new Date($picker.datepicker("getDate"));
                                date.setDate(date.getDate()+1);
                                $picker2.datepicker("setDate", date);           
                            });
                            $( "#DataPartenzaBedzzle<?=$numBedzzle?>" ).datepicker({
                                numberOfMonths: 1,
                                language:'it',
                                showButtonPanel: true,
                                startDate: "today"
                            });
                        });
                </script>        
            </div>
        </div>
    </div>
</div>
<?}?>