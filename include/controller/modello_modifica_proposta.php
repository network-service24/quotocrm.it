<?php if($TipoRichiesta == 'Preventivo'){?>
        <!-- se le proposta è 1 -->
        <?php 
               $nr_part = ($numero_proposte+1);
                for($nr=$nr_part; $nr<=5; $nr++){
            ?>
                <div class="accordion-panel card card-block  m-t-30">                                                                                                                                                
                    <a class="f-16 f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$nr?>" aria-expanded="true" aria-controls="collapseOne">
                        <?=$nr?>° PROPOSTA
                        <i class="fa fa-caret-up fa-2x fa-fw f-right"></i>
                    </a>   
                    <!-- ° PROPOSTA -->
                    <div id="collapse<?=$nr?>" class="panel-collapse collapse in" role="tabpanel">                           
                                <input type="hidden" name="id_proposta_<?=$nr?>" value="<?=$nr?>">
                                <div class="Check<?=$nr?>" style="display:none">
                                    <label for="CheckProposta"> Seleziona Proposta</label>
                                    <div class="form-group">
                                        <input type="checkbox" value="1" name="CheckProposta<?=$nr?>" onclick="check(this);" class="controllo" id="CheckProposta_<?=$nr?>">
                                    </div>
                                </div>
                                <?if($fun->check_simplebooking(IDSITO)==1){?>
                                    <div class="row m-t-10">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking<?=$nr?>">Apri SimpleBooking</button>  
                                        </div>
                                    </div>
                                    <div id="wait<?=$nr?>"></div>
                                <?}?>
                                <?if($fun->check_ericsoftbooking(IDSITO)==1){?>
                                    <div class="row m-t-10">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">                               
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking<?=$nr?>">Apri EricSoftBooking</button>                                                         
                                        </div>
                                    </div>
                                    <div id="wait<?=$nr?>E"></div>
                                <?}?> 
                                <?if($fun->check_bedzzlebooking(IDSITO)==1){?>
                                    <div class="row m-t-10">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">                               
                                            <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking<?=$nr?>">Apri BedzzleBooking</button>                                                         
                                        </div>
                                    </div>
                                    <div id="wait<?=$nr?>Bedzzle"></div>
                                <?}?>                                                                         
                                <div class="row m-t-10">
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                            <input type="date" name="DataArrivo<?=$nr?>" id="DataArrivo_<?=$nr?>" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                            <input type="date" name="DataPartenza<?=$nr?>" id="DataPartenza_<?=$nr?>" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                        </div>                                                        
                                    </div>
                                </div>                                                                               
                                <div class="row m-t-10">
                                    <div class="col-md-8"> 
                                        <div class="form-group">
                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                <select name="NomeProposta<?=$nr?>" id="NomeProposta_<?=$nr?>" class="form-control">
                                                    <?=$lista_pacchetti?>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-8"> 
                                        <div class="form-group">
                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                <textarea class="form-control" name="TestoProposta<?=$nr?>" id="TestoProposta_<?=$nr?>" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?if($fun->check_simplebooking(IDSITO)==1){?>
                                    <div id="simple<?=$nr?>"></div>
                                <?}?>
                                <?if($fun->check_ericsoftbooking(IDSITO)==1){?>
                                    <div id="simple<?=$nr?>E"></div>
                                <?}?>
                                <?if($fun->check_bedzzlebooking(IDSITO)==1){?>
                                    <div id="wait<?=$nr?>Bedzzle"></div>
                                <?}?>
                                <!-- righe_camere_proposta_NR -->
                            <div class="table-responsive">
                                <table class="table  no-border-top no-border-bottom">
                                    <tr>
                                        <td class="td25 no-border-top">
                                        <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_<?=$nr?>_1"></div>
                                                <div class="form-group">
                                                    <label class="control-label"><b>Tipo Soggiorno</b></label>
                                                    <select name="TipoSoggiorno<?=$nr?>[]" id="TipoSoggiorno_<?=$nr?>_1" class="form-control" >
                                                        <?=$fun->lista_soggiorni(IDSITO)?>
                                                    </select>
                                                </div>
                                        </td>
                                        <td class="td25 no-border-top">
                                            <div class="form-group">
                                                <label class="control-label"><b>Tipo Camera</b></label>
                                                <input type="hidden" name="NumeroCamere<?=$nr?>[]" id="NumeroCamere_<?=$nr?>_1" value="1">
                                                <select name="TipoCamere<?=$nr?>[]" id="TipoCamere_<?=$nr?>_1" class="<?=$stile_chosen?> form-control" <?=(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(<?=$nr?>,1);"':''):'')?>>
                                                        <?=$fun->lista_camere(IDSITO)?>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="td10 no-border-top">
                                            <div class="form-group">
                                                <label class="control-label"><b>Adulti</b></label>
                                                <select required name="NumAdulti<?=$nr?>[]" id="NumeroAdulti_<?=$nr?>_1" class="form-control" <?=(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(<?=$nr?>,1);"':''):'')?>>
                                                    <?=$NumeroAdulti?>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="td10 no-border-top">
                                            <div class="form-group">
                                                <label class="control-label"><b>Bambini</b></label>
                                                <select name="NumBambini<?=$nr?>[]" id="NumeroBambini_<?=$nr?>_1" class="NumeroBambini_<?=$nr?>_1 form-control" onchange="eta_bimbi('<?=$nr?>_1');">
                                                    <?=$NumeroBambini?>
                                                </select>
                                                <div class="EtaBambini<?=$nr?>_1" style="display:none">
                                                    <input type="text"  name="EtaB<?=$nr?>[]" placeholder="1,3,8" class="form-control" data-toggle="tooltip" title="Se non avate una sincronizzazione attiva con un PMS potete anche inserire una parte di testo per esempio: 10 anni, 8 mesi">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="td30 no-border-top">
                                        <div class="td30 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_<?=$nr?>_1"></div>
                                            <div class="form-group">
                                                <label class="control-label"><b>Prezzo</b></label>
                                                <div class="input-group">
                                                    <input type="text" name="Prezzo<?=$nr?>[]" id="Prezzo_<?=$nr?>_1" class="prezzo<?=$nr?> form-control" placeholder="Prezzo 0000.00"  <?=(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(<?=$nr?>,1);"':''):'')?> onkeyup="calcola_totale<?=$nr?>();">
                                                    <span class="input-group-addon" onclick="room_fields(<?=$nr?>,'righe_room<?=$nr?>');">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="nopadding no-border-top no-border-bottom">
                                            <table id="righe_room<?=$nr?>"  class="nopadding no-border-top no-border-bottom" style="width:100%"></table>
                                        </td>
                                    </tr>
                                    <?=$fun->get_servizi_aggiuntivi($nr);?>
                                </table>
                            </div>
                                <div class="row m-t-10">
                                    <div class="col-md-3">
                                    <!-- 
                                        <div class="form-group">
                                            <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                            <input type="text" onclick="calcola_totale<?=$nr?>();" name="PrezzoL<?=$nr?>" id="PrezzoL_<?=$nr?>" class="form-control" placeholder="0000.00">
                                        </div>
                                    -->
                                    <input type="hidden" onclick="calcola_totale<?=$nr?>();" name="PrezzoL<?=$nr?>" id="PrezzoL_<?=$nr?>" class="form-control" placeholder="0000.00">
                                    <span id="sconto_P<?=$nr?>"></span> 
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label class="control-label"><b>Prezzo soggiorno proposto</b> <?php echo ($check_pms5==1?'<i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se il totale soggiorno dopo l\'applicazione dello sconto contiene dei decimali, non modificate manualmente il valore arrotondandolo, perchè al momento della sincronia con 5 Stelle verrebbe rispristinato automaticamente sul PMS!"></i>':'')?></label>
                                            <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale<?=$nr?>();" name="PrezzoP<?=$nr?>" id="PrezzoP_<?=$nr?>" class="form-control" placeholder="0000.00">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">   
                                            <label class="control-label"><b>Sconto</b></label>
                                            <select name="SC<?=$nr?>" id="SC_<?=$nr?>" class="form-control">
                                                <option value="0" selected="selected">--</option>
                                                <?=$percentuali_sconto?>
                                            </select>
                                            <input type="hidden" name="sconto_camere<?=$nr?>" id="sconto_camere_<?=$nr?>">
                                            <div id="Imponibile_<?=$nr?>"></div>
                                        </div> 
                                        <?=$boxCodiceSconto?>                                                       
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="acconto_richiesta">
                                                <b>Caparra</b> 
                                            </label>
                                            <select name="AccontoPercentuale<?=$nr?>" id="AccontoPercentuale_<?=$nr?>" class="form-control">
                                                <?=$AccontoRichiesta?>
                                            </select>
                                            <div id="acconto_l<?=$nr?>"></div>
                                        </div>                                                        
                                    </div>
                                </div>                  
                                <div class="row m-t-10">
                                    <div class="col-md-8"> 
                                        <div class="form-group">
                                            <label class="control-label"><b>Tipologia tariffa</b></label>
                                                <select name="EtichettaTariffa<?=$nr?>" id="EtichettaTariffa_<?=$nr?>" class="form-control">
                                                    <option value="">scegli</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-8"> 
                                        <div class="form-group">
                                            <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                <textarea class="form-control" name="AccontoTesto<?=$nr?>" id="AccontoTesto_<?=$nr?>" rows="3" placeholder="Il campo si auto-compila scegliendo la tipologia di tariffa"></textarea>
                                        </div>
                                    </div>
                                </div> 

                        </div>
                    </div>

        <?}?>
<!-- se la richiesta è un preventivo si vede la modifica altrimenti no -->
    <!-- id utile alla compilazione automatica dei prezzi camere in ajax -->
    <div id="valori"></div>
    <div id="valori_serv"></div>
<?}?>
