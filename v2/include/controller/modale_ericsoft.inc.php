<?php


    // Ciclo per il select numerico adulti ericsoft booking
    $eE = 1;
    for($eE==1; $eE<=6; $eE++){
       $NumeriE .='<option value="'.$eE.'">'.$eE.'</option>';
    }
    // Ciclo per il select numerico adulti ericsoft booking
    $xE = 1;
    for($xE==1; $xE<=6; $xE++){
       $NumeriBimbiE .='<option value="'.$xE.'">'.$xE.'</option>';
    }
    // eta bimbi ericsoft booking
    $sel_person   = "SELECT * FROM hospitality_pms_person WHERE idsito = ".IDSITO." AND TypePms = 'E' AND PersonName NOT LIKE '%Adulti%' ORDER BY Id";
    $res_person   = $db->query($sel_person);
    $array_person = $db->result($res_person);
    foreach($array_person as $chiave => $valore){
        $etaBimbi1E .='<option value="'.$valore['PersonTypeId'].'#'.$valore['PersonName'].'">'.$valore['PersonName'].'</option>';

        $etaBimbi2E .='<option value="'.$valore['PersonTypeId'].'#'.$valore['PersonName'].'">'.$valore['PersonName'].'</option>';

        $etaBimbi3E .='<option value="'.$valore['PersonTypeId'].'#'.$valore['PersonName'].'">'.$valore['PersonName'].'</option>';

        $etaBimbi4E .='<option value="'.$valore['PersonTypeId'].'#'.$valore['PersonName'].'">'.$valore['PersonName'].'</option>';

        $etaBimbi5E .='<option value="'.$valore['PersonTypeId'].'#'.$valore['PersonName'].'">'.$valore['PersonName'].'</option>';

        $etaBimbi6E .='<option value="'.$valore['PersonTypeId'].'#'.$valore['PersonName'].'">'.$valore['PersonName'].'</option>';
    }
    ###############################################
for ($numE==1; $numE<=5; $numE++){?>
<div class="modal fade" id="input_ericsoft_booking<?=$numE?>"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Inserisci i dati utili al controllo del Booking Ericsoft</h4>
          </div>
          <div class="modal-body">
             <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataArrivo" class="control-label">Data Arrivo</label>
                            <div class="controls">
                                <div class="input-group">
                                    <label for="DataArrivoE<?=$numE?>" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                    <input id="DataArrivoE<?=$numE?>" name="DataArrivoE<?=$numE?>" type="text" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataPartenza" class="control-label">Data Partenza</label>
                            <div class="controls">
                                <div class="input-group">
                                    <label for="DataPartenzaE<?=$numE?>" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                    <input id="DataPartenzaE<?=$numE?>" name="DataPartenzaE<?=$numE?>" type="text" class="form-control"  autocomplete="off" />
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">             
                    <div class="form-group">
                            <label for="NumeroAdultiE<?=$numE?>">Numero Adulti</label>
                            <select id="NumeroAdultiE<?=$numE?>" name="NumeroAdultiE<?=$numE?>" class="form-control" required>
                                <option value="" selected="selected">--</option>
                                <?=$NumeriE?>
                            </select>
                        </div>                                                         
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="NumeroBambiniE<?=$numE?>">Numero Bambini</label>
                                <select name="NumeroBambiniE<?=$numE?>" id="NumeroBambiniE<?=$numE?>" class="form-control" >
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriBimbiE?>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini1E<?=$numE?>">Età 1°</label>
                            <select id="EtaB1E<?=$numE?>" name="EtaBambini1E<?=$numE?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi1E?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini2E<?=$numE?>">Età 2°</label>
                            <select id="EtaB2E<?=$numE?>" name="EtaBambini2E<?=$numE?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi2E?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini3E<?=$numE?>">Età 3°</label>
                            <select id="EtaB3E<?=$numE?>" name="EtaBambini3E<?=$numE?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi3E?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini4E<?=$numE?>">Età 4°</label>
                            <select id="EtaB4E<?=$numE?>" name="EtaBambini4E<?=$numE?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi4E?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini5E<?=$numE?>">Età 5°</label>
                            <select id="EtaB5E<?=$numE?>" name="EtaBambini5E<?=$numE?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi5E?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etaBambini6E<?=$numE?>">Età 6°</label>
                            <select id="EtaB6E<?=$numE?>" name="EtaBambini6E<?=$numE?>" class="form-control" >
                                <option value="" selected="selected">--</option>
                                <?=$etaBimbi6E?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="n_cm<?=$numE?>"><input type="hidden" id="numero_camere<?=$numE?>" name="numero_camere<?=$numE?>" value="1"/></div>
               
                <div id="add2_room<?=$numE?>" style="cursor:pointer"><i class="fa fa-plus"></i> 2° camera</div>
                <script>
                    $(document).ready(function(){
                        $("#add2_room<?=$numE?>").on("click",function(){
                            $("#seconda<?=$numE?>").slideToggle( "slow", function() {
                                if($("#seconda<?=$numE?>").is(":visible")){
                                    $("#add2_room<?=$numE?>").html("<i class=\"fa fa-minus\"></i> 2° camera");
                                    $("#n_room<?=$numE?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numE?>\" name=\"numero_camere<?=$numE?>\" value=\"2\"/>");
                                    $("#n_cm<?=$numE?>").html(""); 
                                    $("#add3_room<?=$numE?>").show();   
                                }else{
                                    $("#add2_room<?=$numE?>").html("<i class=\"fa fa-plus\"></i> 2° camera");   
                                    $("#n_room<?=$numE?>").html("");     
                                    $("#add3_room<?=$numE?>").hide();  
                                    $("#n_cm<?=$numE?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numE?>\" name=\"numero_camere<?=$numE?>\" value=\"1\"/>");                
                                }
                            });
                        });
                    });
                </script>
                <div id="seconda<?=$numE?>" style="display:none">
                    <div id="n_room<?=$numE?>"></div>
                    <div class="clearfix p-t-5 p-b-5"></div> 
                        <div class="row">
                            <div class="col-md-6">             
                            <div class="form-group">
                                    <label for="NumeroAdultiE<?=$numE?>_2">Numero Adulti</label>
                                    <select id="NumeroAdultiE<?=$numE?>_2" name="NumeroAdultiE<?=$numE?>_2" class="form-control" required>
                                        <option value="" selected="selected">--</option>
                                        <?=$NumeriE?>
                                    </select>
                                </div>                                                         
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="NumeroBambiniE<?=$numE?>_2">Numero Bambini</label>
                                        <select name="NumeroBambiniE<?=$numE?>_2" id="NumeroBambiniE<?=$numE?>_2" class="form-control" >
                                            <option value="" selected="selected">--</option>
                                            <?=$NumeriBimbiE?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini1E<?=$numE?>_2">Età 1°</label>
                                    <select id="EtaB1E<?=$numE?>_2" name="EtaBambini1E<?=$numE?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi1E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini2E<?=$numE?>_2">Età 2°</label>
                                    <select id="EtaB2E<?=$numE?>_2" name="EtaBambini2E<?=$numE?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi2E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini3E<?=$numE?>_2">Età 3°</label>
                                    <select id="EtaB3E<?=$numE?>_2" name="EtaBambini3E<?=$numE?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi3E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini4E<?=$numE?>_2">Età 4°</label>
                                    <select id="EtaB4E<?=$numE?>_2" name="EtaBambini4E<?=$numE?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi4E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini5E<?=$numE?>_2">Età 5°</label>
                                    <select id="EtaB5E<?=$numE?>_2" name="EtaBambini5E<?=$numE?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi5E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini6E<?=$numE?>_2">Età 6°</label>
                                    <select id="EtaB6E<?=$numE?>_2" name="EtaBambini6E<?=$numE?>_2" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi6E?>
                                    </select>
                                </div>
                            </div>
                        </div>                
                    
                </div>
                <div class="clearfix p-t-5 p-b-5"></div> 
                <div id="add3_room<?=$numE?>" style="display:none;cursor:pointer"><i class="fa fa-plus"></i> 3° camera</div>
                <script>
                    $(document).ready(function(){
                        $("#add3_room<?=$numE?>").on("click",function(){
                            $("#terza<?=$numE?>").slideToggle( "slow", function() {
                                if($("#terza<?=$numE?>").is(":visible")){
                                    $("#add3_room<?=$numE?>").html("<i class=\"fa fa-minus\"></i> 3° camera");
                                    $("#n_room<?=$numE?>").html("");
                                    $("#num_room<?=$numE?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numE?>\" name=\"numero_camere<?=$numE?>\" value=\"3\"/>");
                                }else{
                                    $("#add3_room<?=$numE?>").html("<i class=\"fa fa-plus\"></i> 3° camera");   
                                    $("#num_room<?=$numE?>").html("");    
                                    $("#n_room<?=$numE?>").html("<input type=\"hidden\" id=\"numero_camere<?=$numE?>\" name=\"numero_camere<?=$numE?>\" value=\"2\"/>");                  
                                }
                            });
                        });
                    });
                </script>
                <div id="terza<?=$numE?>" style="display:none">
                    <div id="num_room<?=$numE?>"></div>
                    <div class="clearfix p-t-5 p-b-5"></div> 
                        <div class="row">
                            <div class="col-md-6">             
                            <div class="form-group">
                                    <label for="NumeroAdultiE<?=$numE?>_3">Numero Adulti</label>
                                    <select id="NumeroAdultiE<?=$numE?>_3" name="NumeroAdultiE<?=$numE?>_3" class="form-control" required>
                                        <option value="" selected="selected">--</option>
                                        <?=$NumeriE?>
                                    </select>
                                </div>                                                         
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="NumeroBambiniE<?=$numE?>_3">Numero Bambini</label>
                                        <select name="NumeroBambiniE<?=$numE?>_3" id="NumeroBambiniE<?=$numE?>_3" class="form-control" >
                                            <option value="" selected="selected">--</option>
                                            <?=$NumeriBimbiE?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini1E<?=$numE?>_3">Età 1°</label>
                                    <select id="EtaB1E<?=$numE?>_3" name="EtaBambini1E<?=$numE?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi1E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini2E<?=$numE?>_3">Età 2°</label>
                                    <select id="EtaB2E<?=$numE?>_3" name="EtaBambini2E<?=$numE?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi2E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini3E<?=$numE?>_3">Età 3°</label>
                                    <select id="EtaB3E<?=$numE?>_3" name="EtaBambini3E<?=$numE?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi3E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini4E<?=$numE?>_3">Età 4°</label>
                                    <select id="EtaB4E<?=$numE?>_3" name="EtaBambini4E<?=$numE?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi4E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini5E<?=$numE?>_3">Età 5°</label>
                                    <select id="EtaB5E<?=$numE?>_3" name="EtaBambini5E<?=$numE?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi5E?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="etaBambini6E<?=$numE?>_3">Età 6°</label>
                                    <select id="EtaB6E<?=$numE?>_3" name="EtaBambini6E<?=$numE?>_3" class="form-control" >
                                        <option value="" selected="selected">--</option>
                                        <?=$etaBimbi6E?>
                                    </select>
                                </div>
                            </div>
                        </div>                
                    
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary" id="SB_booking<?=$numE?>E"  data-dismiss="modal" aria-label="Close">Controlla disponibilità <small>con</small> <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"></button>
                    </div>
                </div> 
                <script>
                    $(function() {
                        $( "#DataArrivoE<?=$numE?>" ).datepicker({
                                numberOfMonths: 1,
                                language:'it',
                                showButtonPanel: true,
                                startDate: "today"
                            });
                            $("#DataArrivoE<?=$numE?>").datepicker({dateFormat: "dd/mm/yy"}).change(function () {             
                                var $picker = $("#DataArrivoE<?=$numE?>");
                                var $picker2 = $("#DataPartenzaE<?=$numE?>");
                                var date=new Date($picker.datepicker("getDate"));
                                date.setDate(date.getDate()+1);
                                $picker2.datepicker("setDate", date);           
                            });
                            $( "#DataPartenzaE<?=$numE?>" ).datepicker({
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