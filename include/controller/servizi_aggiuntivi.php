<?php
    $sel = "SELECT * FROM hospitality_tipo_servizi WHERE idsito = ".IDSITO." AND CalcoloPrezzo = 'A Percentuale' AND Abilitato = 1";
    $res = $dbMysqli->query($sel);
    $check_calc = $res;
    if(sizeof($check_calc) >= 1){
        $valore_tipo_config = 0;
        $etichetta_explane_percentuale = '  
                                                <i class="fa fa-exclamation-circle text-red"></i> <b>Importante!</b><br/>
                                                Se avete inserito nella lista uno o più servizi aggiuntivi  
                                                <b>"A Percentuale"</b>  è sconsigliato abilitare la gestione lato client (landing page)!
                                                <br/> 
                                                In alternativa se volete abilitare la gestione lato client, ricordatevi di non selezionare il servizio <b>"A percentuale"</b> durante la creazione della proposta di soggiorno!
                                                <br/> 
                                                Questo perchè se il servizio è pre-selezionato da voi, il calcolo della percentuale avverrà sempre e solo sull\'importo del soggiorno 
                                                da voi proposto e non sul totale modificato dal cliente finale che può aggiungere o meno nuovi servizi!
                                            ';
    }else{
        $valore_tipo_config = 1;
    }

    $select = "SELECT * FROM hospitality_tipo_servizi_config WHERE idsito = ".IDSITO;
    $result = $dbMysqli->query($select);
    $rec    = $result[0];
    if(sizeof($result) == 0){
        $insert= "INSERT INTO hospitality_tipo_servizi_config (idsito,AbilitatoLatoLandingPage) VALUES ('".IDSITO."','".$valore_tipo_config."')";
        $dbMysqli->query($insert);
    } 
    $AbilitatoLatoLandingPage = $rec['AbilitatoLatoLandingPage'];

    $content .= '<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div id="res"></div>
                        <div class="row m-t-10">
                            <div class="col-md-7 nowrap text-left">
                                <label class="f-w-600">Abilita oppure disabilita la gestione dei SERVIZI AGGIUNTIVI lato landing page (cliente) <i class="fa fa-exclamation-circle text-black" data-toggle="tooltip" title="Abilita oppure disabilita la gestione dei SERVIZI AGGIUNTIVI lato landing page (cliente)"></i></label>
                            </div>
                            <div class="col-md-1 text-left">
                                <input type="checkbox"  name="AbilitatoLatoLandingPage_" id="AbilitatoLatoLandingPage_" '.($AbilitatoLatoLandingPage==1?'checked="checked"':'').' value="'.$AbilitatoLatoLandingPage.'"/>
                                <input type="hidden"   id="AbilitatoLatoLandingPage"  name="AbilitatoLatoLandingPage" value="'.$AbilitatoLatoLandingPage.'"/> 
                            </div>
                            <div class="col-md-1 text-left">
                                <button type="button" class="btn btn-primary btn-sm" id="salva">Salva</button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                <div class="col-md-2"></div>
                </div>      
                <script>
                    $(document).ready(function(){

                        $("#AbilitatoLatoLandingPage_").click(function() {
                            if($("#AbilitatoLatoLandingPage_").is(":checked")){
                                $("#AbilitatoLatoLandingPage_").attr("value","1");
                                $("#AbilitatoLatoLandingPage").attr("value","1");
                            }else{
                                $("#AbilitatoLatoLandingPage_").attr("value",0);
                                $("#AbilitatoLatoLandingPage_").attr("checked",0);
                                $("#AbilitatoLatoLandingPage").attr("value",0);
                            }
                        });
                        // UPDATE
                        $("#salva").on("click",function(){
                            var AbilitatoLatoLandingPage = $(\'#AbilitatoLatoLandingPage\').val(); 
                                $.ajax({
                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/abilita_servizi_aggiuntivi_client.php",
                                    type: "POST",
                                    data: "idsito='.IDSITO.'&AbilitatoLatoLandingPage="+AbilitatoLatoLandingPage+"",
                                    success: function(msg){  
                                        $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info"><p>Dati salvati con successo!</p></div>\');
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

# AGGIUNGI
$content .=' <div class="modal fade" id="ModaleServiziAggiuntivi" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Servizio</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_servizi_aggiuntivi" name="form_add_servizi_aggiuntivi">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Icona</label>
                                            </div>
                                            <div class="col-md-9">
                                                <span class="text-back f-12 text-center">Una volta scelto il file, cliccare sul pulsante "Upload"</span>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                <input type="file" class="form-control"  name="file" id="file">
                                                <button type="button" class="btn btn-mini" id="btn_add">Upload</button>
                                                </div>
                                                <div id="result_file"></div>
                                                <input type="hidden"  id="Icona" name="Icona" />
                                            </div>
                                        </div>                            
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Servizio</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-coffee fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="TipoServizio" name="TipoServizio" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Calcolo del Prezzo</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-calculator fa-fw"></i></span>
                                                    <select name="CalcoloPrezzo" id="CalcoloPrezzo" class="form-control" required >
                                                        <option value="">--</option>
                                                        <option value="Una tantum">Una tantum</option>
                                                        <option value="Al giorno">Al giorno</option>
                                                        <option value="A persona">A persona</option>
                                                        <option value="A percentuale">A percentuale</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <div id="tipoPrezzo">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Prezzo Servizio <i class="fa fa-info-circle text-black cursore" title="Per impostare un servizio Gratuito, inserire 0 (zero) come Prezzo Servizio"></i></label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="PrezzoServizio" name="PrezzoServizio" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tipoPercentuale"> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Percentuale Servizio</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="PercentualeServizio" name="PercentualeServizio" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>   
                                <div class="form-group">  
                                    <div class="row">
                                        <div class="col-md-3 nowrap">
                                            <label>Ordine</label>
                                        </div>
                                        <div class="col-md-9">                                            	                                                     
                                            <div class="input-group input-group-primary">
                                                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                <select class="form-control" id="Ordine" name="Ordine">
                                                    <option value="">--</option>';
                        for($n==1; $n<=60; $n++){
                            $content .='           <option value="'.$n.'">'.$n.'</option>';
                        }
    $content .='                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form> 
                                </div> 
                                <div class="col-md-2"></div>
                                </div>                      
                                <script>
                                    $(document).ready(function() {

                                        $("#tipoPrezzo").hide();
                                        $("#tipoPercentuale").hide();

                                        $("#CalcoloPrezzo").on("change",function(){
                                            var CalcoloPrezzo = $("#CalcoloPrezzo option:selected").val();
                                            if(CalcoloPrezzo != "A percentuale"){
                                                $("#tipoPrezzo").show();
                                                $("#tipoPercentuale").hide();
                                            }else{
                                                $("#tipoPrezzo").hide();
                                                $("#tipoPercentuale").show();
                                            }
                                        });

                                        //CARICO ICONA										
                                        $("#btn_add").on("click",function(){
                                            formdata = new FormData();
                                            if($("#file").prop(\'files\').length > 0)
                                            {
                                                file =$("#file").prop(\'files\')[0];
                                                formdata.append("file", file);
                                            }
                                            $.ajax({
                                                url: "' . BASE_URL_SITO . 'ajax/disponibilita/add_icona_servizio_aggiuntivo.php?idsito='.IDSITO.'",
                                                type: "POST",
                                                data: formdata,
                                                processData: false,
                                                contentType: false,
                                                success: function (risultato) {
                                                    console.log(risultato);
                                                    if(risultato != ""){
                                                        $("#Icona").val(risultato);
                                                        $("#result_file").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                    }else{
                                                        $("#result_file").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                    }
                                                }
                                            });
                                            return false;
                                        });                                        

                                        $("#form_add_servizi_aggiuntivi").submit(function () {  
                                            var  Icona               = $("#Icona").val(); 
                                            var  TipoServizio        = $("#TipoServizio").val();
                                            var  PrezzoServizio      = $("#PrezzoServizio").val(); 
                                            var  PercentualeServizio = $("#PercentualeServizio").val(); 
                                            var  CalcoloPrezzo       = $("#CalcoloPrezzo").val(); 
                                            var  Ordine              = $("#Ordine option:selected").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_servizio_aggiuntivo.php",
                                                type: "POST",
                                                data: "action=add_servizio_aggiuntivo&idsito='.IDSITO.'&Ordine="+Ordine+"&TipoServizio="+TipoServizio+"&PrezzoServizio="+PrezzoServizio+"&PercentualeServizio="+PercentualeServizio+"&CalcoloPrezzo="+CalcoloPrezzo+"&Icona="+Icona+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleServiziAggiuntivi").modal("hide");
                                                    $("#servizi_aggiuntivi").DataTable().ajax.reload();    
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
               <table id="servizi_aggiuntivi" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Icona</th>
                            <th>Servizio</th>
                            <th>Testi presenti</th>
                            <th>Prezzo Servizio</th>
                            <th>Percentuale Servizio</th>
                            <th>Calcolo del Prezzo</th>
                            <th>Abilitato</th>
                            <th>Incluso</th>
                            <th>Ordine</th>
                            <th style="width:5%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #servizi_aggiuntivi_filter{
                    display: none !important;
                }
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {'."\r\n";


$content .=' 


                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#servizi_aggiuntivi").DataTable( {
                    order: [[8, \'asc\']],                                        
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
							[ 15, 30, 60, -1 ],
							[  \'15 record\', \'30 record\', \'60 risultati\',\'Tutti\' ]
                        ],	
                        buttons: [
                            {
                                text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi Servizio\',
                                className: \'buttonSelezioni\',
                                attr: {id: \'aggiungi\'},
                                action: function () {
                                    $("#ModaleServiziAggiuntivi").modal("show");
                                }
                            },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/disponibilita/servizi_aggiuntivi.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "icona","class":"text-center"},
                        { "data": "servizio"},
                        { "data": "testi","class":"text-center"},
                        { "data": "prezzo"},
                        { "data": "percentuale"},                                                
                        { "data": "calcolo"},  
                        { "data": "abilitato","class":"text-center"},        
                        { "data": "incluso","class":"text-center"},
                        { "data": "ordine","type": "formatted-num","class":"text-center"},
                        { "data": "action","class":"text-center"},
                    ],';
        $content .='    "columnDefs": [
                               {"targets": [0,2,3,4,5,6,7,9], "orderable": false} 

                        ]
                    })

                    $("#servizi_aggiuntivi_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>