<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	$data      = array();

	# QUERY PER COMPILARE IL DATATABLE
    $select  = "SELECT 
					hospitality_tipo_pagamenti.*	
				FROM 
					hospitality_tipo_pagamenti 
				WHERE 
					hospitality_tipo_pagamenti.idsito = ".$_REQUEST['idsito']."
                ORDER BY
                    hospitality_tipo_pagamenti.Ordine 
                ASC";

	$rec = $dbMysqli->query($select);

	foreach($rec as $key => $row){


                        $modale .= '<div class="modal fade" id="ModaleUpdatePagamenti'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica tipologia di pagamento</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form id="form_up_pagamenti'.$row['Id'].'" name="form_up_pagamenti" method="POST">                                          
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label>Tipo Pagamento</label>
                                                                    </div>
                                                                    <div class="col-md-7 text-left">
                                                                        <b>'.$row['TipoPagamento'].'</b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div id="nexi'.$row['Id'].'">
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Key (API) (ALIAS) NEXI</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="ApiKeyNexi'.$row['Id'].'" name="ApiKeyNexi" value="'.$row['ApiKeyNexi'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Segret Key (CHIAVE MAC)  NEXI</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="SegretKeyNexi'.$row['Id'].'" name="SegretKeyNexi" value="'.$row['SegretKeyNexi'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="stripe'.$row['Id'].'">
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Key (API) per account STRIPE</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="ApiKeyStripe'.$row['Id'].'" name="ApiKeyStripe" value="'.$row['ApiKeyStripe'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="paypal'.$row['Id'].'">                                       
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Email per account PayPal</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="EmailPayPal'.$row['Id'].'" name="EmailPayPal" value="'.$row['EmailPayPal'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="gateway'.$row['Id'].'">
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Indirizzo del form GATEWAY</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="serverURL'.$row['Id'].'" name="serverURL" value="'.$row['serverURL'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>ID Cliente (PAYWAY), ABI (VirtualPay)</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="tid'.$row['Id'].'" name="tid" value="'.$row['tid'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap f-12">
                                                                        <label>API key (PAYWAY), MERCHANT ID (VirtualPay)</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="kSig'.$row['Id'].'" name="kSig" value="'.$row['kSig'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Email Cliente (PAYWAY,VirtualPay)</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                            <input type="text" class="form-control" id="ShopUserRef'.$row['Id'].'" name="ShopUserRef" value="'.$row['ShopUserRef'].'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="carta_credito'.$row['Id'].'">
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Mastercard</label>
                                                                    </div>
                                                                    <div class="col-md-1">                                            	                                                     
                                                                        <input type="checkbox" class="form-control" id="mastercard'.$row['Id'].'" name="mastercard" '.($row['mastercard']==1?'checked="checked"':'').' />
                                                                    </div>
                                                                </div>
                                                            </div>                                    
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Visa</label>
                                                                    </div>
                                                                    <div class="col-md-1">                                            	                                                     
                                                                        <input type="checkbox" class="form-control" id="visa'.$row['Id'].'" name="visa" '.($row['visa']==1?'checked="checked"':'').' />
                                                                    </div>
                                                                </div>
                                                            </div>                                     
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Amex</label>
                                                                    </div>
                                                                    <div class="col-md-1">                                            	                                                     
                                                                        <input type="checkbox" class="form-control" id="amex'.$row['Id'].'" name="amex" '.($row['amex']==1?'checked="checked"':'').' />
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Diners</label>
                                                                    </div>
                                                                    <div class="col-md-1">                                            	                                                     
                                                                        <input type="checkbox" class="form-control" id="diners'.$row['Id'].'" name="diners" '.($row['diners']==1?'checked="checked"':'').' />
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Ordine</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                                            <select class="form-control" id="Ordine'.$row['Id'].'" name="Ordine" style="height:auto!important">
                                                                                <option value="1" '.($row['Ordine']==1?'selected="selected"':'').'>1</option>
                                                                                <option value="2" '.($row['Ordine']==2?'selected="selected"':'').'>2</option>
                                                                                <option value="3" '.($row['Ordine']==3?'selected="selected"':'').'>3</option>
                                                                                <option value="4" '.($row['Ordine']==4?'selected="selected"':'').'>4</option>
                                                                                <option value="5" '.($row['Ordine']==5?'selected="selected"':'').'>5</option>
                                                                                <option value="6" '.($row['Ordine']==6?'selected="selected"':'').'>6</option>
                                                                                <option value="7" '.($row['Ordine']==7?'selected="selected"':'').'>7</option>
                                                                                <option value="8" '.($row['Ordine']==8?'selected="selected"':'').'>8</option>
                                                                                <option value="9" '.($row['Ordine']==9?'selected="selected"':'').'>9</option>
                                                                                <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3 nowrap">
                                                                        <label>Abiliato</label>
                                                                    </div>
                                                                    <div class="col-md-1">                                            	                                                     
                                                                        <input type="checkbox" class="form-control" id="Abilitato'.$row['Id'].'" name="Abilitato" '.($row['Abilitato']==1?'checked="checked" value="1"':'').' />
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center">
                                                                        <input type="hidden" name="Id" id="Id'.$row['Id'].'"  value="'.$row['Id'].'">
                                                                        <input type="hidden" id="idsito'.$row['Id'].'" name="idsito"  value="'.$row['idsito'].'">
                                                                        <input type="hidden" name="action"  value="mod_pagamenti">
                                                                        <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                        <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                    </div>
                                                                </div>
                                                            </div>                                 
                                                        </form>
                                                        <script>
                                                            $(document).ready(function() {

                                                                $("#mastercard'.$row['Id'].'").click(function() {
                                                                    if($("#mastercard'.$row['Id'].'").is(":checked")){
                                                                        $("#mastercard'.$row['Id'].'").attr("value","1");
                                                                    }else{
                                                                        $("#mastercard'.$row['Id'].'").attr("value",false);
                                                                        $("#mastercard'.$row['Id'].'").attr("checked",false);
                                                                    }
                                                                });
                                                                $("#visa'.$row['Id'].'").click(function() {
                                                                    if($("#visa'.$row['Id'].'").is(":checked")){
                                                                        $("#visa'.$row['Id'].'").attr("value","1");
                                                                    }else{
                                                                        $("#visa'.$row['Id'].'").attr("value",false);
                                                                        $("#visa'.$row['Id'].'").attr("checked",false);
                                                                    }
                                                                });
                                                                $("#amex'.$row['Id'].'").click(function() {
                                                                    if($("#amex'.$row['Id'].'").is(":checked")){
                                                                        $("#amex'.$row['Id'].'").attr("value","1");
                                                                    }else{
                                                                        $("#amex'.$row['Id'].'").attr("value",false);
                                                                        $("#amex'.$row['Id'].'").attr("checked",false);
                                                                    }
                                                                });
                                                                $("#diners'.$row['Id'].'").click(function() {
                                                                    if($("#diners'.$row['Id'].'").is(":checked")){
                                                                        $("#diners'.$row['Id'].'").attr("value","1");
                                                                    }else{
                                                                        $("#diners'.$row['Id'].'").attr("value",false);
                                                                        $("#diners'.$row['Id'].'").attr("checked",false);
                                                                    }
                                                                });
                                                                $("#Abilitato'.$row['Id'].'").click(function() {
                                                                    if($("#Abilitato'.$row['Id'].'").is(":checked")){
                                                                        $("#Abilitato'.$row['Id'].'").attr("value","1");
                                                                    }else{
                                                                        $("#Abilitato'.$row['Id'].'").attr("value",false);
                                                                        $("#Abilitato'.$row['Id'].'").attr("checked",false);
                                                                    }
                                                                });

                                                                $("#nexi'.$row['Id'].'").hide();
                                                                $("#stripe'.$row['Id'].'").hide();
                                                                $("#paypal'.$row['Id'].'").hide();
                                                                $("#gateway'.$row['Id'].'").hide();
                                                                $("#carta_credito'.$row['Id'].'").hide();
                                                                $("#content_bb_vp'.$row['Id'].'").hide(); ';

                            if($row['TipoPagamento']=='Nexi'){
                                $modale .='                     $("#nexi'.$row['Id'].'").show();';
                            }
                            if($row['TipoPagamento']=='Stripe'){
                                $modale .='                     $("#stripe'.$row['Id'].'").show();';
                            }
                            if($row['TipoPagamento']=='PayPal'){
                                $modale .='                     $("#paypal'.$row['Id'].'").show();';
                            }
                            if(strstr('Gateway Bancario',$row['TipoPagamento'])){
                                $modale .='                     $("#gateway'.$row['Id'].'").show();';
                            }
                            if($row['TipoPagamento']=='Carta di Credito'){
                                $modale .='                     $("#carta_credito'.$row['Id'].'").show();';
                            }
                            if($row['TipoPagamento']=='Vaglia Postale' || $row['TipoPagamento']=='Vaglia Postale'){
                                $modale .='                     $("#content_bb_vp'.$row['Id'].'").show();';
                            }
                                                                                            

                                    $modale .=' 

                                                                $("#form_up_pagamenti'.$row['Id'].'").submit(function () {   
                                                                    var  dati   = $("#form_up_pagamenti'.$row['Id'].'").serialize(); 
                                                                    $.ajax({
                                                                        url: "'.BASE_URL_SITO.'ajax/impostazioni/modifica_pagamenti.php",
                                                                        type: "POST",
                                                                        data: dati,
                                                                        dataType: "html",
                                                                        success: function(data) {
                                                                            $("#ModaleUpdatePagamenti'.$row['Id'].'").modal("hide");
                                                                            $("#pagamenti").DataTable().ajax.reload();    
                                                                        }
                                                                    });
                                                                    return false; // con false senza refresh della pagina                                       
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>'."\r\n";

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
                                        
                                                '.($row['Abilitato']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="check_abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="check_disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#check_abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/impostazioni/switch_pagamenti.php",
                                                                type: "POST",
                                                                data: "action=switch_pag&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#pagamenti").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#check_disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/impostazioni/switch_pagamenti.php",
                                                                type: "POST",
                                                                data: "action=switch_pag&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#pagamenti").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script>    
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdatePagamenti'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                            
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'impostazioni-configura_contenuti_pagamenti/'.$row['Id'].'/'.urlencode($row['TipoPagamento']).'/"><i class="fa fa-comment-o text-green"></i> Gestione Contenuti </a>  
                                             
                                            </div>
										</div>';                                              
                $selectOrdine = '  <select class="form-control ordina" id="OrdineRow'.$row['Id'].'" name="OrdineRow" style="height:auto;padding:2px!important;width:80%!important">
                                        <option value="1" '.($row['Ordine']==1?'selected="selected"':'').'>1</option>
                                        <option value="2" '.($row['Ordine']==2?'selected="selected"':'').'>2</option>
                                        <option value="3" '.($row['Ordine']==3?'selected="selected"':'').'>3</option>
                                        <option value="4" '.($row['Ordine']==4?'selected="selected"':'').'>4</option>
                                        <option value="5" '.($row['Ordine']==5?'selected="selected"':'').'>5</option>
                                        <option value="6" '.($row['Ordine']==6?'selected="selected"':'').'>6</option>
                                        <option value="7" '.($row['Ordine']==7?'selected="selected"':'').'>7</option>
                                        <option value="8" '.($row['Ordine']==8?'selected="selected"':'').'>8</option>
                                        <option value="9" '.($row['Ordine']==9?'selected="selected"':'').'>9</option>
                                        <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option
                                    </select>
                                    <script>
                                        $(document).ready(function(){ 
                                            $("#OrdineRow'.$row['Id'].'").on("change",function(){
                                                var OrdineRow = $("#OrdineRow'.$row['Id'].' option:selected").val(); 
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/impostazioni/ordine_pagamenti.php",
                                                        type: "POST",
                                                        data: "action=order_pagamenti&idsito='.$row['idsito'].'&Id='.$row['Id'].'&OrdineRow="+OrdineRow+"",
                                                        dataType: "html",
                                                        success: function(data) {
                                                            $("#pagamenti").DataTable().ajax.reload();    
                                                        }
                                                    });
                                                    return false;                                
                                            });
                                        });
                                    </script>';


							$data[] = array(

                                        "tipo"      => (strstr($row['TipoPagamento'],'Carta di Credito')? $row['TipoPagamento'].' a garanzia <span class="p-l-30 "><label class="badge badge-inverse-danger f-10">Il modulo non rispetta le norme (bancarie) vigenti e non vi tutela!<br>Questo metodo di pagamento è altamente sconsigliato dagli Istituti di credito dal Gennaio del 2020</label></span>' : $row['TipoPagamento']),
                                        "testo"     => $fun->ControlloTestiInseritiPagamenti($row['Id'],$row['idsito']),
                                        "ordine"    => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                        "abilitato" => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                        "action"    => $action.$modale
 
							);

	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec) ,
						"recordsFiltered" => sizeof($rec),
						"data" 			  => $data
						); 



if(empty($json_data) || is_null($json_data)){
	$json_data = NULL;
}else{
	$json_data = json_encode($json_data);
}
	  echo $json_data; 

#######################################################################################################################

?>
