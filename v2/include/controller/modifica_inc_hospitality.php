<?php if($TipoRichiesta == 'Preventivo'){?>
        <!-- se le proposta è 1 -->
        <?php if($numero_proposte == 1){?>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <span class="text-black">2° PROPOSTA</span>
                          </a>
                        </h4>
                      </div>
                      <div aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
                        <?php if(check_simplebooking(IDSITO)==1){?>
                                <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 text-center">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking2">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                            <div id="wait2"></div>                                        
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    <?}?>                        
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">                                                        
                               <table class="table table-responsive">
                                    <tr>
                                        <td colspan="4">
                                        <input type="hidden" name="id_proposta_2" value="2">
                                            <div class="Check2bis"><label for="CheckProposta"> 2° Proposta</label></div>
                                                <div class="Check2" style="display:none">
                                                    <label for="CheckProposta"> Seleziona Proposta</label>                                                               
                                                <div class="form-group">
                                                    <input type="checkbox" value="1" name="CheckProposta2" id="CheckProposta_2">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                         <td colspan="4">
                                                <div class="form-group">
                                                    <label for="NomeProposta">Nome Proposta o del Pacchetto <small style="font-weight: normal!important">(non obbligatorio)</small></label>
                                                    <select name="NomeProposta2" id="NomeProposta_2" class="form-control" tabindex="26">
                                                        <?php echo $ListaPacchetti ?>
                                                    </select>
                                                </div>  
                                         </td>
                                    </tr>
                                    <tr>                                           
                                         <td colspan="4">
                                                <div class="form-group">
                                                    <label for="TestoProposta">Descrizione Proposta o del Pacchetto</label>
                                                    <textarea rows="3" name="TestoProposta2" id="TestoProposta_2" class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta" tabindex="27"></textarea>
                                                </div>  
                                         </td>                                           
                                    </tr>
                                    <?if(check_simplebooking(IDSITO)==1){?> 
                                       <tr>
                                            <td colspan="4" style="border:0px!important">                                                           
                                                <div id="simple2"></div>
                                            </td>
                                        </tr>
                                    <?}?>                                      
                                    <tr id="nc2">

                                     <td style="width:25%">
                                             <div class="form-group">
                                            <label for="TipoSoggiorno">Tipo Soggiorno</label>
                                                <select name="TipoSoggiorno2[]" id="TipoSoggiorno_2" class="form-control" tabindex="28">
                                                    <option value="" selected="selected">--</option>
                                                        <?=$ListaSoggiorno?>
                                                </select>
                                            </div>
                                     </td>
                                        <td style="width:25%">
                                            <div class="form-group">
                                                <label for="NumeroCamere">Nr Camere</label>
                                                <select name="NumeroCamere2[]" id="NumeroCamere_2" class="form-control" tabindex="29">
                                                    <option value="" selected="selected">--</option>
                                                  <?=$Numeri?>
                                                </select>
                                            </div>   
                                        </td>
                                        <td style="width:25%">
                                            <div class="form-group">
                                                <label for="TipoCamere">Tipo Camere</label>
                                                <select name="TipoCamere2[]" id="TipoCamere_2" class="<?=$stile_chosen?>form-control" tabindex="30">
                                                    <option value="" selected="selected">--</option>
                                                        <?=$ListaCamere?>
                                                </select>
                                            </div> 
                                        </td>  
                                        <td style="width:25%">
                                            <label for="Prezzo">Prezzo</label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" name="Prezzo2[]" id="Prezzo_2"  class="prezzo2 form-control" placeholder="0000.00" tabindex="31">
                                            </div> 
                                        </td>                                            
                                    </tr>
                                    <tr>
                                      <td colspan="4">
                                          <table id="add_c2" class="table" ></table>
                                      </td>  
                                    </tr> 
                                    <tr>
                                        <td colspan="4" style="text-align:right">
                                            <a href="javascript:;" onclick="scroll_to('nc2', 50, 1000)" id="add_cam2" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a> 
                                            <a href="javascript:;" onclick="scroll_to('nc2', 50, 1000)" id="rem_cam2" class="btn btn-warning btn-xs"><i class="fa fa-minus"></i></a>          
                                        </td>
                                    </tr>
                                    </table>
                                    <table class="table table-responsive">
                                    <tr>
                                        <td class="col-md-2 text-right">
                                        <small style="font-weight:normal!important"><small>Se il prezzo di listino è uguale al prezzo del soggiorno, non sarà visibile sulla proposta!</small></small>
                                        </td>
                                        <td class="col-md-3">
                                            <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" onclick="calcola_totale2();" name="PrezzoL2" id="PrezzoL_2"  class="form-control" placeholder="0000.00" tabindex="32">
                                            </div>
                                            <span id="sconto_P2"></span> 
                                        </td>
                                        <td class="col-md-3">
                                            <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale2();" name="PrezzoP2" id="PrezzoP_2"  class="form-control" placeholder="0000.00" tabindex="33">
                                            </div> 
                                        </td>
                                        <td class="col-md-2">
                                               <div style="clear:both;padding-top:25px;">
                                                    <select name="SC2[]" id="SC_2" class="form-control">
                                                        <option value="0" selected="selected">Sconto</option>
                                                        <option value="5">5%</option>
                                                        <option value="10">10%</option>
                                                        <option value="15">15%</option>
                                                        <option value="20">20%</option>
                                                        <option value="25">25%</option>
                                                        <option value="30">30%</option>
                                                        <option value="35">35%</option>
                                                        <option value="40">40%</option>
                                                        <option value="45">45%</option>
                                                        <option value="50">50%</option>
                                                    </select>
                                                </div>
                                        </td>
                                    <?if($DataRichiesta >= DATA_UPGRADE_CAPARRE){?>
                                        <td class="col-md-2">
                                            <div class="form-group">          
                                                <label for="acconto_richiesta">Caparra <i class="fa fa-question-circle text-info" data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i> <i class="fa fa-exclamation-triangle text-orange" data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                   <select  name="AccontoPercentuale2" id="AccontoPercentuale_2" class="form-control">
                                                        <?=$AccontoRichiesta?>
                                                    </select>
                                                    <div id="acconto_l2"></div>
                                            </div> 
                                        </td>
                                    <?}?> 
                                    </tr>
                                    <?if($DataRichiesta >= DATA_UPGRADE_CAPARRE){?>
                                        <tr>
                                             <td class="col-md-4" colspan="2">
                                                    <div class="form-group">
                                                        <label for="NomeProposta">Tipologia Tariffa</label>
                                                            <select id="EtichettaTariffa_2" name="EtichettaTariffa2" class="form-control">
                                                                <?php echo $ListaTariffe ?>
                                                            </select>
                                                    </div>  
                                             </td>                                         
                                             <td colspan="3" class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="TestoProposta">Condizioni Tariffa</label>
                                                            <textarea rows="3" name="AccontoTesto2" id="AccontoTesto_2" class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                    </div>  
                                             </td>                                           
                                        </tr>
                                    <?}?>                                                                                                                                 
                                </table>  
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#calculator2" title="Calcolatrice">
                                        <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                    </button>                                                                  
                                    <div class="modal fade modale_drag draggable" id="calculator2">
                                      <div class="modal-dialog">
                                        <div class="modal-content" style="height:360px!important;width:250px!important">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Calcolatrice &nbsp;&nbsp;<small><small>Drag & Drop <i class="fa fa-arrows" aria-hidden="true"></i></small></small></h4>
                                          </div>
                                            <div class="modal-body">
                                                <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>                       
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <span class="text-black">3° PROPOSTA</span>
                          </a>
                        </h4>
                      </div>
                      <div aria-expanded="false" id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                        <div class="row">
                        <?if(check_simplebooking(IDSITO)==1){?>
                            <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 text-center">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking3">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                        <div id="wait3"></div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                        <?}?>                         
                            <div class="col-md-2"></div>
                            <div class="col-md-8">                                                        
                                <table class="table table-responsive">
                                    <tr>
                                        <td colspan="4">
                                        <input type="hidden" name="id_proposta_3" value="3">
                                            <div class="Check3bis"><label for="CheckProposta"> 3° Proposta</label></div>
                                                <div class="Check3" style="display:none">
                                                    <label for="CheckProposta"> Seleziona Proposta</label>                                                               
                                                <div class="form-group">
                                                    <input type="checkbox"  value="1" name="CheckProposta3" id="CheckProposta_3">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                         <td colspan="4">
                                                <div class="form-group">
                                                    <label for="NomeProposta">Nome Proposta o del Pacchetto <small style="font-weight: normal!important">(non obbligatorio)</small></label>
                                                    <select  name="NomeProposta3" id="NomeProposta_3" class="form-control" tabindex="34">
                                                        <?php echo $ListaPacchetti ?>
                                                    </select>
                                                </div>  
                                         </td>
                                    </tr>
                                    <tr>                                           
                                         <td colspan="4">
                                                <div class="form-group">
                                                    <label for="TestoProposta">Descrizione Proposta o del Pacchetto</label>
                                                    <textarea rows="3" name="TestoProposta3" id="TestoProposta_3" class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta" tabindex="35"></textarea>
                                                </div>  
                                         </td>                                            
                                    </tr>
                                    <?if(check_simplebooking(IDSITO)==1){?> 
                                       <tr>
                                            <td colspan="4" style="border:0px!important">                                                           
                                                <div id="simple3"></div>
                                            </td>
                                        </tr>
                                    <?}?>                                      
                                    <tr id="nc3">
                                     <td style="width:25%">
                                             <div class="form-group">
                                            <label for="TipoSoggiorno">Tipo Soggiorno</label>
                                                <select name="TipoSoggiorno3[]" id="TipoSoggiorno_3" class="form-control" tabindex="36">
                                                    <option value="" selected="selected">--</option>
                                                        <?=$ListaSoggiorno?>
                                                </select>
                                            </div>
                                     </td>
                                        <td style="width:25%">
                                            <div class="form-group">
                                                <label for="NumeroCamere">Nr Camere</label>
                                                <select name="NumeroCamere3[]" id="NumeroCamere_3" class="form-control" tabindex="37">
                                                    <option value="" selected="selected">--</option>
                                                  <?=$Numeri?>
                                                </select>
                                            </div>   
                                        </td>
                                        <td style="width:25%">
                                            <div class="form-group">
                                                <label for="TipoCamere">Tipo Camere</label>
                                                <select name="TipoCamere3[]" id="TipoCamere_3" class="<?=$stile_chosen?>form-control" tabindex="38">
                                                    <option value="" selected="selected">--</option>
                                                        <?=$ListaCamere?>
                                                </select>
                                            </div> 
                                        </td> 
                                         <td style="width:25%">
                                            <label for="Prezzo">Prezzo</label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" name="Prezzo3[]" id="Prezzo_3"  class="prezzo3 form-control" placeholder="0000.00" tabindex="39">
                                            </div> 
                                        </td>                                                                                                             
                                    </tr>
                                    <tr>
                                      <td colspan="4">
                                          <table id="add_c3" class="table" ></table>
                                      </td>  
                                    </tr> 
                                    <tr>
                                        <td colspan="4" style="text-align:right">
                                            <a href="javascript:;" onclick="scroll_to('nc3', 50, 1000)" id="add_cam3" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a> 
                                            <a href="javascript:;" onclick="scroll_to('nc3', 50, 1000)" id="rem_cam3" class="btn btn-warning btn-xs"><i class="fa fa-minus"></i></a>          
                                        </td>
                                    </tr>
                                    </table>
                                    <table class="table table-responsive">
                                    <tr>
                                        <td class="col-md-2 text-right">
                                        <small style="font-weight:normal!important"><small>Se il prezzo di listino è uguale al prezzo del soggiorno, non sarà visibile sulla proposta!</small></small>
                                        </td>
                                        <td class="col-md-3">
                                            <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" onclick="calcola_totale3();" name="PrezzoL3" id="PrezzoL_3"  class="form-control" placeholder="0000.00" tabindex="40">
                                            </div>
                                            <span id="sconto_P3"></span> 
                                        </td>
                                        <td class="col-md-3">
                                            <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale3();" name="PrezzoP3" id="PrezzoP_3"  class="form-control" placeholder="0000.00" tabindex="41">
                                            </div> 
                                        </td>
                                        <td class="col-md-2">
                                                <div style="clear:both;padding-top:25px;">
                                                    <select name="SC3[]" id="SC_3" class="form-control">
                                                        <option value="0" selected="selected">Sconto</option>
                                                        <option value="5">5%</option>
                                                        <option value="10">10%</option>
                                                        <option value="15">15%</option>
                                                        <option value="20">20%</option>
                                                        <option value="25">25%</option>
                                                        <option value="30">30%</option>
                                                        <option value="35">35%</option>
                                                        <option value="40">40%</option>
                                                        <option value="45">45%</option>
                                                        <option value="50">50%</option>
                                                    </select>
                                                </div>
                                        </td>
                                    <?if($DataRichiesta >= DATA_UPGRADE_CAPARRE){?>
                                        <td class="col-md-2">
                                            <div class="form-group">          
                                                <label for="acconto_richiesta">Caparra <i class="fa fa-question-circle text-info" data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i> <i class="fa fa-exclamation-triangle text-orange" data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                   <select  name="AccontoPercentuale3" id="AccontoPercentuale_3" class="form-control">
                                                        <?=$AccontoRichiesta?>
                                                    </select>
                                                    <div id="acconto_l3"></div>
                                            </div> 
                                        </td>
                                    <?}?> 
                                    </tr>
                                    <?if($DataRichiesta >= DATA_UPGRADE_CAPARRE){?>
                                        <tr>
                                             <td class="col-md-4" colspan="2">
                                                    <div class="form-group">
                                                        <label for="NomeProposta">Tipologia Tariffa</label>
                                                            <select id="EtichettaTariffa_3" name="EtichettaTariffa3" class="form-control">
                                                                <?php echo $ListaTariffe ?>
                                                            </select>
                                                    </div>  
                                             </td>                                         
                                             <td colspan="3" class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="TestoProposta">Condizioni Tariffa</label>
                                                            <textarea rows="3" name="AccontoTesto3" id="AccontoTesto_3" class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                    </div>  
                                             </td>                                           
                                        </tr>
                                    <?}?>                                                                                                                                 
                                </table>
                            </div>
                            <div class="col-md-2">
                                    <button type="button" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#calculator3" title="Calcolatrice">
                                        <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                    </button>                                                                  
                                    <div class="modal fade modale_drag draggable" id="calculator3">
                                      <div class="modal-dialog">
                                        <div class="modal-content" style="height:360px!important;width:250px!important">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Calcolatrice &nbsp;&nbsp;<small><small>Drag & Drop <i class="fa fa-arrows" aria-hidden="true"></i></small></small></h4>
                                          </div>
                                            <div class="modal-body">
                                                <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                        </div>                        
                        </div>
                      </div>
                    </div>
                    <!-- se le proposte sono  2 -->
                <?}elseif($numero_proposte == 2){?>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <span class="text-black">3° PROPOSTA</span>
                          </a>
                        </h4>
                      </div>
                      <div aria-expanded="false" id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                        <div class="row">
                        <?if(check_simplebooking(IDSITO)==1){?>
                            <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 text-center">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking3">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                         <div id="wait3"></div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                        <?}?>                         
                            <div class="col-md-2"></div>
                            <div class="col-md-8">                                                        
                                <table class="table table-responsive">
                                    <tr>
                                        <td colspan="4">
                                        <input type="hidden" name="id_proposta_3" value="3">
                                            <div class="Check3bis"><label for="CheckProposta"> 3° Proposta</label></div>
                                                <div class="Check3" style="display:none">
                                                    <label for="CheckProposta"> Seleziona Proposta</label>                                                               
                                                <div class="form-group">
                                                    <input type="checkbox"  value="1" name="CheckProposta3" id="CheckProposta_3">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                         <td colspan="4">
                                                <div class="form-group">
                                                    <label for="NomeProposta">Nome Proposta o del Pacchetto <small style="font-weight: normal!important">(non obbligatorio)</small></label>
                                                    <select  name="NomeProposta3" id="NomeProposta_3" class="form-control" tabindex="34">
                                                        <?php echo $ListaPacchetti ?>
                                                    </select>
                                                </div>  
                                         </td>
                                    </tr>
                                    <tr>                                           
                                         <td colspan="4">
                                                <div class="form-group">
                                                    <label for="TestoProposta">Descrizione Proposta o del Pacchetto</label>
                                                    <textarea rows="3" name="TestoProposta3" id="TestoProposta_3" class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta" tabindex="35"></textarea>
                                                </div>  
                                         </td>                                            
                                    </tr>
                                    <?if(check_simplebooking(IDSITO)==1){?> 
                                       <tr>
                                            <td colspan="4" style="border:0px!important">                                                           
                                                <div id="simple3"></div>
                                            </td>
                                        </tr>
                                    <?}?>                                         
                                    <tr id="nc3">
                                     <td style="width:25%">
                                             <div class="form-group">
                                            <label for="TipoSoggiorno">Tipo Soggiorno</label>
                                                <select name="TipoSoggiorno3[]" id="TipoSoggiorno_3" class="form-control" tabindex="36">
                                                    <option value="" selected="selected">--</option>
                                                        <?=$ListaSoggiorno?>
                                                </select>
                                            </div>
                                     </td>
                                        <td style="width:25%">
                                            <div class="form-group">
                                                <label for="NumeroCamere">Nr Camere</label>
                                                <select name="NumeroCamere3[]" id="NumeroCamere_3" class="form-control" tabindex="37">
                                                    <option value="" selected="selected">--</option>
                                                  <?=$Numeri?>
                                                </select>
                                            </div>   
                                        </td>
                                        <td style="width:25%">
                                            <div class="form-group">
                                                <label for="TipoCamere">Tipo Camere</label>
                                                <select name="TipoCamere3[]" id="TipoCamere_3" class="<?=$stile_chosen?>form-control" tabindex="38">
                                                    <option value="" selected="selected">--</option>
                                                        <?=$ListaCamere?>
                                                </select>
                                            </div> 
                                        </td> 
                                         <td style="width:25%">
                                            <label for="Prezzo">Prezzo</label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" name="Prezzo3[]" id="Prezzo_3"  class="prezzo3 form-control" placeholder="0000.00" tabindex="39">
                                            </div> 
                                        </td>                                                                                                             
                                    </tr>
                                    <tr>
                                      <td colspan="4">
                                          <table id="add_c3" class="table" ></table>
                                      </td>  
                                    </tr> 
                                    <tr>
                                        <td colspan="4" style="text-align:right">
                                            <a href="javascript:;" onclick="scroll_to('nc3', 50, 1000)" id="add_cam3" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a> 
                                            <a href="javascript:;" onclick="scroll_to('nc3', 50, 1000)" id="rem_cam3" class="btn btn-warning btn-xs"><i class="fa fa-minus"></i></a>          
                                        </td>
                                    </tr>
                                    </table>
                                    <table class="table table-responsive">
                                    <tr>
                                        <td class="col-md-2 text-right">
                                        <small style="font-weight:normal!important"><small>Se il prezzo di listino è uguale al prezzo del soggiorno, non sarà visibile sulla proposta!</small></small>
                                        </td>
                                        <td class="col-md-3">
                                            <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" onclick="calcola_totale3();" name="PrezzoL3" id="PrezzoL_3"  class="form-control" placeholder="0000.00" tabindex="40">
                                            </div>
                                            <span id="sconto_P3"></span> 
                                        </td>
                                        <td class="col-md-3">
                                            <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                            <div class="input-group">                                                    
                                                <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
                                                <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale3();" name="PrezzoP3" id="PrezzoP_3"  class="form-control" placeholder="0000.00" tabindex="41">
                                            </div> 
                                        </td>
                                        <td class="col-md-2">
                                                <div style="clear:both;padding-top:25px;">
                                                    <select name="SC3[]" id="SC_3" class="form-control">
                                                        <option value="0" selected="selected">Sconto</option>
                                                        <option value="5">5%</option>
                                                        <option value="10">10%</option>
                                                        <option value="15">15%</option>
                                                        <option value="20">20%</option>
                                                        <option value="25">25%</option>
                                                        <option value="30">30%</option>
                                                        <option value="35">35%</option>
                                                        <option value="40">40%</option>
                                                        <option value="45">45%</option>
                                                        <option value="50">50%</option>
                                                    </select>
                                                </div>
                                        </td>
                                    <?if($DataRichiesta >= DATA_UPGRADE_CAPARRE){?>
                                        <td class="col-md-2">
                                            <div class="form-group">          
                                                <label for="acconto_richiesta">Caparra <i class="fa fa-question-circle text-info" data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i> <i class="fa fa-exclamation-triangle text-orange" data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                   <select  name="AccontoPercentuale3" id="AccontoPercentuale_3" class="form-control">
                                                        <?=$AccontoRichiesta?>
                                                    </select>
                                                    <div id="acconto_l3"></div>
                                            </div> 
                                        </td>
                                    <?}?> 
                                    </tr>
                                    <?if($DataRichiesta >= DATA_UPGRADE_CAPARRE){?>
                                        <tr>
                                             <td class="col-md-4" colspan="2">
                                                    <div class="form-group">
                                                        <label for="NomeProposta">Tipologia Tariffa</label>
                                                            <select id="EtichettaTariffa_3" name="EtichettaTariffa3" class="form-control">
                                                                <?php echo $ListaTariffe ?>
                                                            </select>
                                                    </div>  
                                             </td>                                         
                                             <td colspan="3" class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="TestoProposta">Condizioni Tariffa</label>
                                                            <textarea rows="3" name="AccontoTesto3" id="AccontoTesto_3" class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                    </div>  
                                             </td>                                           
                                        </tr>
                                    <?}?>                                                                                                                                 
                                </table>
                            </div>
                            <div class="col-md-2">
                                    <button type="button" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#calculator3" title="Calcolatrice">
                                        <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                    </button>                                                                  
                                    <div class="modal fade modale_drag draggable" id="calculator3">
                                      <div class="modal-dialog">
                                        <div class="modal-content" style="height:360px!important;width:250px!important">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Calcolatrice &nbsp;&nbsp;<small><small>Drag & Drop <i class="fa fa-arrows" aria-hidden="true"></i></small></small></h4>
                                          </div>
                                            <div class="modal-body">
                                                <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                        </div>                        
                        </div>
                      </div>
                    </div>
        <?}?>
<!-- se la richiesta è un preventivo si vede la modifica altrimenti no -->
<?}?>