<?php for ($numB==1; $numB<=5; $numB++){?>
<div class="modal fade" id="input_booking<?=$numB?>"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Inserisci i dati utili al controllo SimpleBooking</h4>
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
                                    <label for="DataArrivoB<?=$numB?>" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                    <input id="DataArrivoB<?=$numB?>" name="DataArrivoB<?=$numB?>" type="text" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            <label for="DataPartenza" class="control-label">Data Partenza</label>
                            <div class="controls">
                                <div class="input-group">
                                    <label for="DataPartenzaB<?=$numB?>" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                    <input id="DataPartenzaB<?=$numB?>" name="DataPartenzaB<?=$numB?>" type="text" class="form-control"  autocomplete="off" />
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
                                <?=$Numeri?>
                            </select>
                        </div>                                                         
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="NumeroBambiniB<?=$numB?>">Numero Bambini</label>
                                <select name="NumeroBambiniB<?=$numB?>" id="NumeroBambiniB<?=$numB?>" class="form-control" >
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriBimbi?>
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
                        <button type="button" class="btn btn-success" id="SB_booking<?=$numB?>B"  data-dismiss="modal" aria-label="Close">Controlla disponibilità <small>con</small> <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                    </div>
                </div> 
                <script>
                    $(function() {
                        $( "#DataArrivoB<?=$numB?>" ).datepicker({
                                numberOfMonths: 1,
                                language:'it',
                                showButtonPanel: true,
                                startDate: "today"
                            });
                            $("#DataArrivoB<?=$numB?>").datepicker({dateFormat: "dd/mm/yy"}).change(function () {             
                                var $picker = $("#DataArrivoB<?=$numB?>");
                                var $picker2 = $("#DataPartenzaB<?=$numB?>");
                                var date=new Date($picker.datepicker("getDate"));
                                date.setDate(date.getDate()+1);
                                $picker2.datepicker("setDate", date);           
                            });
                            $( "#DataPartenzaB<?=$numB?>" ).datepicker({
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