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
$e1 = 1;
$etaBimbi1 .='<option value="< 1" '.($EtaBambini1=='< 1'?'selected="selected"':'').'>< 1</option>';
for($e1==1; $e1<=18; $e1++){
    $etaBimbi1 .='<option value="'.$e1.'" '.($EtaBambini1==$e1?'selected="selected"':'').'>'.$e1.'</option>';
}
$e2 = 1;
$etaBimbi2 .='<option value="< 1" '.($EtaBambini2=='< 1'?'selected="selected"':'').'>< 1</option>';
for($e2==1; $e2<=18; $e2++){
    $etaBimbi2 .='<option value="'.$e2.'" '.($EtaBambini2==$e2?'selected="selected"':'').'>'.$e2.'</option>';
}
$e3 = 1;
$etaBimbi3 .='<option value="< 1" '.($EtaBambini3=='< 1'?'selected="selected"':'').'>< 1</option>';
for($e3==1; $e3<=18; $e3++){
    $etaBimbi3 .='<option value="'.$e3.'" '.($EtaBambini3==$e3?'selected="selected"':'').'>'.$e3.'</option>';
}
$e4 = 1;
$etaBimbi4 .='<option value="< 1" '.($EtaBambini4=='< 1'?'selected="selected"':'').'>< 1</option>';
for($e4==1; $e4<=18; $e4++){
    $etaBimbi4 .='<option value="'.$e4.'" '.($EtaBambini4==$e4?'selected="selected"':'').'>'.$e4.'</option>';
}
$e5 = 1;
$etaBimbi5 .='<option value="< 1" '.($EtaBambini5=='< 1'?'selected="selected"':'').'>< 1</option>';
for($e5==1; $e5<=18; $e5++){
    $etaBimbi5 .='<option value="'.$e5.'" '.($EtaBambini5==$e5?'selected="selected"':'').'>'.$e5.'</option>';
}
$e6 = 1;
$etaBimbi6 .='<option value="< 1" '.($EtaBambini6=='< 1'?'selected="selected"':'').'>< 1</option>';
for($e6==1; $e6<=18; $e6++){
    $etaBimbi6 .='<option value="'.$e6.'" '.($EtaBambini6==$e6?'selected="selected"':'').'>'.$e6.'</option>';
}
for ($numB==1; $numB<=5; $numB++){?>
<div class="modal fade" id="input_booking<?=$numB?>"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Inserisci i dati utili per SimpleBooking</h5>
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
                                    <input id="DataArrivoB<?=$numB?>" name="DataArrivoB<?=$numB?>" min="<?=$DataDiOggi?>" type="date" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataPartenza" class="control-label">Data Partenza</label>
                            <div class="controls">
                                <div class="input-group">
                                    <input id="DataPartenzaB<?=$numB?>" name="DataPartenzaB<?=$numB?>" min="<?=$DataDiDomani?>" type="date" class="form-control"  autocomplete="off" />
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
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary" id="SB_booking<?=$numB?>B"  data-dismiss="modal" aria-label="Close">Controlla disponibilità</button>
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