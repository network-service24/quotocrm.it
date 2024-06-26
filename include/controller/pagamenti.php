<?php
 # INTERFACCIA PER AGGIORNARE LA PERCENTUALE DI CAPARRA
$select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = ".IDSITO;
$res    = $dbMysqli->query($select);
$rw     = $res[0];
$tot    = sizeof($res);
if($tot == 0){
    $insert = "INSERT INTO hospitality_acconto_pagamenti(idsito) VALUES('".IDSITO."')";
    $result = $dbMysqli->query($insert);
    $id     = $dbMysqli->getInsertId($result);
}else{
    $id = $rw['Id'];
}

$content .= '<div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="res"></div>
                    <div class="row m-t-10">
                        <div class="col-md-4 nowrap text-right">
                            <label class="f-w-600">Percentuale Caparra di default %</label>
                        </div>
                        <div class="col-md-4 text-center">
                            <select class="form-control" id="Acconto" name="Acconto" style="height:auto">
                                <option value=""   '.($rw['Acconto']=='' || $rw['Acconto']==0?'selected="selected"':'').'>--</option>
                                <option value="10" '.($rw['Acconto']=='10'?'selected="selected"':'').'>10</option>
                                <option value="15" '.($rw['Acconto']=='15'?'selected="selected"':'').'>15</option>
                                <option value="20" '.($rw['Acconto']=='20'?'selected="selected"':'').'>20</option>
                                <option value="25" '.($rw['Acconto']=='25'?'selected="selected"':'').'>25</option>
                                <option value="30" '.($rw['Acconto']=='30'?'selected="selected"':'').'>30</option>
                                <option value="40" '.($rw['Acconto']=='40'?'selected="selected"':'').'>40</option>
                                <option value="50" '.($rw['Acconto']=='50'?'selected="selected"':'').'>50</option>
                                <option value="60" '.($rw['Acconto']=='60'?'selected="selected"':'').'>60</option>
                                <option value="70" '.($rw['Acconto']=='70'?'selected="selected"':'').'>70</option>
                                <option value="80" '.($rw['Acconto']=='80'?'selected="selected"':'').'>80</option>
                                <option value="90" '.($rw['Acconto']=='90'?'selected="selected"':'').'>90</option>
                                <option value="100" '.($rw['Acconto']=='100'?'selected="selected"':'').'>100</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-left">
                        <input type="hidden" name="Id"  id="Id" value="'.$id.'">
                            <button type="button" class="btn btn-primary btn-sm" id="salva">Salva</button>
                        </div>
                        <div class="col-md-9"></div>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>      
        <script>
                $(document).ready(function(){

                    // UPDATE 
                    $("#salva").on("click",function(){
                        var Acconto = $(\'#Acconto option:selected\').val(); 
                        var Id      = $(\'#Id\').val(); 
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/pagamenti/aggiorna_percentuale_acconto.php",
                                type: "POST",
                                data: "action=mod_acconto&idsito='.IDSITO.'&Id="+Id+"&Acconto="+Acconto+"",
                                success: function(msg){  
                                    $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info text-center"><p>Percentuale salvata con successo!</p></div>\');
                                    setTimeout(function(){ 
                                        $("#res").hide(); 
                                    }, 2000);
                                },
                                error: function(){
                                    alert("Chiamata fallita, si prega di riprovare...");
                                }
                            });
                            return false; // con false senza refresh della pagina
                    });
                });
            </script> 
            <div class="clearfix p-b-30"></div>'."\r\n";
# ARRAY DELLE TIPOLOGIA DI PAGAMENTO
$array_pag = $fun->arrayPagamenti(IDSITO);
# INSERT TESTI
$content .= '<div class="modal fade" id="ModalePagamenti" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi tipologia di pagamento</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_pagamenti" name="form_pagamenti" method="POST">                                          
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Tipo Pagamento</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group input-group-primary">
                                                <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>'."\r\n";
        $content .= '                            <select name="TipoPagamento"  id="TipoPagamento" class="form-control">'."\r\n";
                                    foreach($array_pag as $key => $value){
                                        $content .= '<option value="'.$value.'">'.$value.'</option>';
                                    }
        $content .= '                            </select>
                                                </div>
                                                <div id="content_bb_vp" class="f-12 text-center">                                       	                                                     
                                                    Una volta salvata la tipologia di pagamento gestire i contenuti di testo relativi!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div id="nexi">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Key (API) (ALIAS) NEXI</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="ApiKeyNexi" name="ApiKeyNexi" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Segret Key (CHIAVE MAC)  NEXI</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="SegretKeyNexi" name="SegretKeyNexi" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="stripe">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Key (API) per account STRIPE</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="ApiKeyStripe" name="ApiKeyStripe" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="paypal">                                       
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Email per account PayPal</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="EmailPayPal" name="EmailPayPal" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="gateway">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Indirizzo del form GATEWAY</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="serverURL" name="serverURL" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>ID Cliente (PAYWAY), ABI (VirtualPay)</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="tid" name="tid" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap f-12">
                                                <label>API key (PAYWAY), MERCHANT ID (VirtualPay)</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="kSig" name="kSig" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Email Cliente (PAYWAY,VirtualPay)</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="ShopUserRef" name="ShopUserRef" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="carta_credito">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Mastercard</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="mastercard" name="mastercard"  />
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Visa</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="visa" name="visa"  />
                                            </div>
                                        </div>
                                    </div>                                     
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Amex</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="amex" name="amex"  />
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Diners</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="diners" name="diners"  />
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Ordine</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                    <select class="form-control" id="Ordine" name="Ordine">
                                                        <option value="">--</option>';
                    for($n==1; $n<=10; $n++){
                        $content .='           <option value="'.$n.'">'.$n.'</option>';
                    }
$content .='                                        </select>
                                        </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 nowrap">
                                                <label>Abiliato</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="Abilitato" name="Abilitato" value="1" checked="checked" />
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                <input type="hidden" name="action"  value="add_pagamenti">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form>
                                <script>
                                    $(document).ready(function() {

                                        $("#mastercard").click(function() {
                                            if($("#mastercard").is(":checked")){
                                                $("#mastercard").attr("value","1");
                                            }else{
                                                $("#mastercard").attr("value",false);
                                                $("#mastercard").attr("checked",false);
                                            }
                                        });
                                        $("#visa").click(function() {
                                            if($("#visa").is(":checked")){
                                                $("#visa").attr("value","1");
                                            }else{
                                                $("#visa").attr("value",false);
                                                $("#visa").attr("checked",false);
                                            }
                                        });
                                        $("#amex").click(function() {
                                            if($("#amex").is(":checked")){
                                                $("#amex").attr("value","1");
                                            }else{
                                                $("#amex").attr("value",false);
                                                $("#amex").attr("checked",false);
                                            }
                                        });
                                        $("#diners").click(function() {
                                            if($("#diners").is(":checked")){
                                                $("#diners").attr("value","1");
                                            }else{
                                                $("#diners").attr("value",false);
                                                $("#diners").attr("checked",false);
                                            }
                                        });
                                        $("#Abilitato").click(function() {
                                            if($("#Abilitato").is(":checked")){
                                                $("#Abilitato").attr("value","1");
                                            }else{
                                                $("#Abilitato").attr("value",false);
                                                $("#Abilitato").attr("checked",false);
                                            }
                                        });

                                        $("#nexi").hide();
                                        $("#stripe").hide();
                                        $("#paypal").hide();
                                        $("#gateway").hide();
                                        $("#carta_credito").hide();
                                        $("#content_bb_vp").hide();

                                        $("#TipoPagamento").on("change",function(){
                                            var TipoPagamento = $("#TipoPagamento option:selected").val();
                                            if(TipoPagamento == "Nexi"){
                                                $("#nexi").show();
                                                $("#stripe").hide();
                                                $("#paypal").hide();
                                                $("#gateway").hide();
                                                $("#carta_credito").hide();
                                                $("#content_bb_vp").hide();
                                            }
                                            if(TipoPagamento == "Stripe"){
                                                $("#stripe").show();                                                
                                                $("#nexi").hide();
                                                $("#paypal").hide();
                                                $("#gateway").hide();
                                                $("#carta_credito").hide();
                                                $("#content_bb_vp").hide();
                                            }
                                            if(TipoPagamento == "PayPal"){
                                                $("#paypal").show();
                                                $("#nexi").hide();
                                                $("#stripe").hide();
                                                $("#gateway").hide();
                                                $("#carta_credito").hide();
                                                $("#content_bb_vp").hide();
                                            }
                                            if(TipoPagamento == "Carta di Credito"){
                                                $("#nexi").hide();
                                                $("#stripe").hide();
                                                $("#paypal").hide();
                                                $("#gateway").hide();
                                                $("#carta_credito").show();
                                                $("#content_bb_vp").hide();
                                            } 
                                            if(TipoPagamento == "Gateway Bancario" || TipoPagamento == "Gateway Bancario Virtual Pay" || TipoPagamento == "Gateway Bancario Banca Sella"){
                                                $("#nexi").hide();
                                                $("#stripe").hide();
                                                $("#paypal").hide();
                                                $("#gateway").show();
                                                $("#carta_credito").hide();
                                                $("#content_bb_vp").hide();
                                            } 
                                            if(TipoPagamento == "Bonifico Bancario"){
                                                $("#nexi").hide();
                                                $("#stripe").hide();
                                                $("#paypal").hide();
                                                $("#gateway").hide();
                                                $("#carta_credito").hide();
                                                $("#content_bb_vp").show();
                                            }  
                                            if(TipoPagamento == "Vaglia Postale"){
                                                $("#nexi").hide();
                                                $("#stripe").hide();
                                                $("#paypal").hide();
                                                $("#gateway").hide();
                                                $("#carta_credito").hide();
                                                $("#content_bb_vp").show();
                                            }                                            
                                        });

                                        $("#form_pagamenti").submit(function () {   
                                            var  dati   = $("#form_pagamenti").serialize(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/impostazioni/aggiungi_pagamenti.php",
                                                type: "POST",
                                                data: dati,
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModalePagamenti").modal("hide");
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

 # INTERFACCIA CRUD DATATABLE
 $content .='   <!-- Table datatable-->
 <table id="pagamenti" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
      <thead>
          <tr>';

$content .='          
              <th>Tipo Pagamento</th>
              <th>Testi presenti</th>
              <th style="width:5%">Ordinamento</th>
              <th>Abilitato</th>
              <th style="width:4%"></th>
          </tr>
      </thead>

  </table> '."\r\n";
$content .='<style>
    #azioniPrev .dropdown-toggle::after {
        display: none !important;
    }
    #pagamenti_filter{
        display: none !important;
    }
    .buttons-collection{
        display: none !important;
    }
    #pagamenti_info{
        display: none !important;
    }
</style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {'."\r\n";


$content .=' 
  //INIZIALIZZO I TOOLTIP
  $(\'[data-tooltip="tooltip"]\').tooltip();

  // CONFIG DATATABLE
  var table = $("#pagamenti").DataTable( {
      order: [[2, \'asc\']],           
      responsive: true,
      processing:true,
      oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
      "paging": true,
          "pagingType": "simple_numbers",    
          "language": {
               "search": "Filtro rapido:",
               "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
               "emptyTable": " ",
               "paginate": {
                   "previous": "Precedente",
                   "next":"Successivo",
               },
               buttons: {
                  pageLength: {                                
                      _: "Mostra %d record",
                      \'-1\': "Mostra tutto"
                  }
              }
          },
          dom: \'Bfrtip\',
          lengthMenu: [
              [ 10, 20, -1 ],
              [  \'10 record\', \'20 record\', \'Tutti\' ]
          ],	
          buttons: [';

          
$content .='{
                text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                className: \'buttonSelezioni\',
                attr: {id: \'aggiungi\'},
                action: function () {
                    $("#ModalePagamenti").modal("show");
                }
            },';

$content .='\'pageLength\',                    


      ],			
      "ajax": "'.BASE_URL_SITO.'crud/impostazioni/pagamenti.crud.php?idsito='.IDSITO.'",
      "deferRender": true,
      "columns": ['."\r\n";

$content .='    { "data": "tipo"},  
                { "data": "testo","class":"text-center"},        
                { "data": "ordine","type": "formatted-num","class":"text-center"},
                { "data": "abilitato","class":"text-center"},
                { "data": "action","class":"text-center"}
      ],';
$content .='    "columnDefs": [
                    {"targets": [0,1,3,4], "orderable": false} 
                ]
            })
            
            $("#pagamenti_processing").removeClass("card"); '."\r\n";


$content .='})
</script>';
?>