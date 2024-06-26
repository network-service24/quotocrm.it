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

	$data                = array();
    $PrezzoServizio      = '';
    $PercentualeServizio = '';
    $selectOrdine        = '';

	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
					hospitality_tipo_servizi.*	
				FROM 
					hospitality_tipo_servizi 
				WHERE 
					hospitality_tipo_servizi.idsito = ".$_REQUEST['idsito']." 
                ORDER BY
                    hospitality_tipo_servizi.TipoServizio ASC";

	$rec = $dbMysqli->query($select);


	foreach($rec as $key => $row){

                            $modale =' <div class="modal fade" id="ModaleUpdateServiziAggiuntivi'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Servizio Aggiuntivo</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" id="form_mod_servizi_aggiuntivi'.$row['Id'].'" name="form_mod_servizi_aggiuntivi">
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-3 text-center">
                                                                                <label>Icona</label>
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <span class="text-black f-12 text-center">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</span>
                                                                                <div class="input-group">
                                                                                <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                                                <input type="file" class="form-control"  name="file_icona" id="file_icona'.$row['Id'].'">
                                                                                <button type="button" class="btn btn-mini" id="btn_upload'.$row['Id'].'">Upload</button>
                                                                                </div>
                                                                                <div id="result_file'.$row['Id'].'"></div>
                                                                                <input type="hidden"  id="Icona'.$row['Id'].'" name="Icona" />
                                                                            </div>
                                                                        </div>                            
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3 nowrap text-center">
                                                                                <label>Servizio</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-coffee fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="TipoServizio'.$row['Id'].'" value="'.$row['TipoServizio'].'" name="TipoServizio" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3 nowrap text-center">
                                                                                <label>Calcolo del Prezzo</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-calculator fa-fw"></i></span>
                                                                                    <select name="CalcoloPrezzo" id="CalcoloPrezzo'.$row['Id'].'" class="form-control" required style="height:auto" >
                                                                                        <option value="Una tantum" '.($row['CalcoloPrezzo']=='Una tantum'?'selected="selected"':'').'>Una tantum</option>
                                                                                        <option value="Al giorno" '.($row['CalcoloPrezzo']=='Al giorno'?'selected="selected"':'').'>Al giorno</option>
                                                                                        <option value="A persona" '.($row['CalcoloPrezzo']=='A persona'?'selected="selected"':'').'>A persona</option>
                                                                                        <option value="A percentuale" '.($row['CalcoloPrezzo']=='A percentuale'?'selected="selected"':'').'>A percentuale</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                <div id="tipoPrezzo'.$row['Id'].'">
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3 nowrap text-center">
                                                                                <label>Prezzo Servizio <i class="fa fa-info-circle text-black cursore" title="Per impostare un servizio Gratuito, inserire 0 (zero) come Prezzo Servizio"></i></label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="PrezzoServizio'.$row['Id'].'" value="'.$row['PrezzoServizio'].'" name="PrezzoServizio" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tipoPercentuale'.$row['Id'].'"> 
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3 nowrap text-center">
                                                                                <label>Percentuale Servizio</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="PercentualeServizio'.$row['Id'].'" value="'.$row['PercentualeServizio'].'" name="PercentualeServizio" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Ordine</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                                                <select class="form-control" id="Ordine'.$row['Id'].'" name="Ordine" style="height:auto">
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
                                                                                    <option value="11" '.($row['Ordine']==11?'selected="selected"':'').'>11</option>
                                                                                    <option value="12" '.($row['Ordine']==12?'selected="selected"':'').'>12</option>
                                                                                    <option value="13" '.($row['Ordine']==13?'selected="selected"':'').'>13</option>
                                                                                    <option value="14" '.($row['Ordine']==14?'selected="selected"':'').'>14</option>
                                                                                    <option value="15" '.($row['Ordine']==15?'selected="selected"':'').'>15</option>
                                                                                    <option value="16" '.($row['Ordine']==16?'selected="selected"':'').'>16</option>
                                                                                    <option value="17" '.($row['Ordine']==17?'selected="selected"':'').'>17</option>
                                                                                    <option value="18" '.($row['Ordine']==18?'selected="selected"':'').'>18</option>
                                                                                    <option value="19" '.($row['Ordine']==19?'selected="selected"':'').'>19</option>
                                                                                    <option value="20" '.($row['Ordine']==20?'selected="selected"':'').'>20</option>
                                                                                    <option value="21" '.($row['Ordine']==21?'selected="selected"':'').'>21</option>
                                                                                    <option value="22" '.($row['Ordine']==22?'selected="selected"':'').'>22</option>
                                                                                    <option value="23" '.($row['Ordine']==23?'selected="selected"':'').'>23</option>
                                                                                    <option value="24" '.($row['Ordine']==24?'selected="selected"':'').'>24</option>
                                                                                    <option value="25" '.($row['Ordine']==25?'selected="selected"':'').'>25</option>
                                                                                    <option value="26" '.($row['Ordine']==26?'selected="selected"':'').'>26</option>
                                                                                    <option value="27" '.($row['Ordine']==27?'selected="selected"':'').'>27</option>
                                                                                    <option value="28" '.($row['Ordine']==28?'selected="selected"':'').'>28</option>
                                                                                    <option value="29" '.($row['Ordine']==29?'selected="selected"':'').'>29</option>
                                                                                    <option value="30" '.($row['Ordine']==30?'selected="selected"':'').'>30</option>
                                                                                    <option value="31" '.($row['Ordine']==31?'selected="selected"':'').'>31</option>
                                                                                    <option value="32" '.($row['Ordine']==32?'selected="selected"':'').'>32</option>
                                                                                    <option value="33" '.($row['Ordine']==33?'selected="selected"':'').'>33</option>
                                                                                    <option value="34" '.($row['Ordine']==34?'selected="selected"':'').'>34</option>
                                                                                    <option value="35" '.($row['Ordine']==35?'selected="selected"':'').'>35</option>
                                                                                    <option value="36" '.($row['Ordine']==36?'selected="selected"':'').'>36</option>
                                                                                    <option value="37" '.($row['Ordine']==37?'selected="selected"':'').'>37</option>
                                                                                    <option value="38" '.($row['Ordine']==38?'selected="selected"':'').'>38</option>
                                                                                    <option value="39" '.($row['Ordine']==39?'selected="selected"':'').'>39</option>
                                                                                    <option value="40" '.($row['Ordine']==40?'selected="selected"':'').'>40</option>
                                                                                    <option value="41" '.($row['Ordine']==41?'selected="selected"':'').'>41</option>
                                                                                    <option value="42" '.($row['Ordine']==42?'selected="selected"':'').'>42</option>
                                                                                    <option value="43" '.($row['Ordine']==43?'selected="selected"':'').'>43</option>
                                                                                    <option value="44" '.($row['Ordine']==44?'selected="selected"':'').'>44</option>
                                                                                    <option value="45" '.($row['Ordine']==45?'selected="selected"':'').'>45</option>
                                                                                    <option value="46" '.($row['Ordine']==46?'selected="selected"':'').'>46</option>
                                                                                    <option value="47" '.($row['Ordine']==47?'selected="selected"':'').'>47</option>
                                                                                    <option value="48" '.($row['Ordine']==48?'selected="selected"':'').'>48</option>
                                                                                    <option value="49" '.($row['Ordine']==49?'selected="selected"':'').'>49</option>
                                                                                    <option value="50" '.($row['Ordine']==50?'selected="selected"':'').'>50</option>
                                                                                    <option value="51" '.($row['Ordine']==51?'selected="selected"':'').'>51</option>
                                                                                    <option value="52" '.($row['Ordine']==52?'selected="selected"':'').'>52</option>
                                                                                    <option value="53" '.($row['Ordine']==53?'selected="selected"':'').'>53</option>
                                                                                    <option value="55" '.($row['Ordine']==55?'selected="selected"':'').'>55</option>
                                                                                    <option value="55" '.($row['Ordine']==55?'selected="selected"':'').'>55</option>
                                                                                    <option value="56" '.($row['Ordine']==56?'selected="selected"':'').'>56</option>
                                                                                    <option value="57" '.($row['Ordine']==57?'selected="selected"':'').'>57</option>
                                                                                    <option value="58" '.($row['Ordine']==58?'selected="selected"':'').'>58</option>
                                                                                    <option value="59" '.($row['Ordine']==59?'selected="selected"':'').'>59</option>
                                                                                    <option value="60" '.($row['Ordine']==60?'selected="selected"':'').'>60</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 

                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-12 text-center">
                                                                                <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                 
                                                                </form>                      
                                                            <script>
                                                                $(document).ready(function() {

                                                                    //CARICO ICONA										
                                                                    $("#btn_upload'.$row['Id'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#file_icona'.$row['Id'].'").prop(\'files\').length > 0)
                                                                        {
                                                                            file =$("#file_icona'.$row['Id'].'").prop(\'files\')[0];
                                                                            formdata.append("file_icona", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/disponibilita/upload_icona_servizio_aggiuntivo.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result) {
                                                                                console.log(result);
                                                                                if(result != ""){
                                                                                    $("#Icona'.$row['Id'].'").val(result);
                                                                                    $("#result_file'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    $("#tipoPrezzo'.$row['Id'].'").hide();
                                                                    $("#tipoPercentuale'.$row['Id'].'").hide(); ';
    
                                if($row['CalcoloPrezzo']!='A percentuale'){
                                    $modale .='                     $("#tipoPrezzo'.$row['Id'].'").show();';
                                }else{
                                    $modale .='                     $("#tipoPercentuale'.$row['Id'].'").show();';
                                }
                                    $modale .='                     $("#form_mod_servizi_aggiuntivi'.$row['Id'].'").submit(function () {   
                                                                        var  Id                  = $("#Id'.$row['Id'].'").val(); 
                                                                        var  Icona               = $("#Icona'.$row['Id'].'").val(); 
                                                                        var  TipoServizio        = $("#TipoServizio'.$row['Id'].'").val();
                                                                        var  PrezzoServizio      = $("#PrezzoServizio'.$row['Id'].'").val(); 
                                                                        var  PercentualeServizio = $("#PercentualeServizio'.$row['Id'].'").val(); 
                                                                        var  CalcoloPrezzo       = $("#CalcoloPrezzo'.$row['Id'].'").val(); 
                                                                        var  Ordine              = $("#Ordine'.$row['Id'].' option:selected").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/modifica_servizi_aggiuntivi.php",
                                                                            type: "POST",
                                                                            data: "action=mod_servizi_aggiuntivi&Id="+Id+"&Ordine="+Ordine+"&idsito='.$row['idsito'].'&TipoServizio="+TipoServizio+"&PrezzoServizio="+PrezzoServizio+"&PercentualeServizio="+PercentualeServizio+"&CalcoloPrezzo="+CalcoloPrezzo+"&Icona="+Icona+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateServiziAggiuntivi'.$row['Id'].'").modal("hide");
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

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-add_servizi_aggiuntivi/'.$row['Id'].'/"><i class="fa fa-comment-o text-green"></i> Gestione testi dei servizi aggiuntivi </a>                                         
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-duplica_servizio_aggiuntivo/'.$row['Id'].'/"><i class="fa fa-plus tetx-black"></i> Duplica  </a>                                      
                                            <div class="dropdown-divider"></div>
                                            '.($row['Abilitato']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                            ).'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#abilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_servizi_aggiuntivi.php",
                                                            type: "POST",
                                                            data: "action=switch_servizi_aggiuntivi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#servizi_aggiuntivi").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_servizi_aggiuntivi.php",
                                                            type: "POST",
                                                            data: "action=switch_servizi_aggiuntivi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#servizi_aggiuntivi").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;                                                           
                                                    });
                                                });
                                            </script>                                               
                                            <div class="dropdown-divider"></div>
                                            '.($row['CalcoloPrezzo']!='A persona'?($row['Obbligatorio']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="incluso'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Includi</a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="nonincluso'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Escludi</a>'
                                            ):'').'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#incluso'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_includi_servizi_aggiuntivi.php",
                                                            type: "POST",
                                                            data: "action=switch_inc_servizi_aggiuntivi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Obbligatorio=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#servizi_aggiuntivi").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#nonincluso'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_includi_servizi_aggiuntivi.php",
                                                            type: "POST",
                                                            data: "action=switch_inc_servizi_aggiuntivi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Obbligatorio=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#servizi_aggiuntivi").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateServiziAggiuntivi'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_servizi_aggiuntivi'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_servizi_aggiuntivi'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Servizio?\r\nCosì facendo se avete già un\'attività di preventivi e/o prenotazioni in corso, andreste a svuotare le proposte di soggiorno in produzione e le relative statistiche!")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_servizi_aggiuntivi.php",
                                                                    type: "POST",
                                                                    data: "action=del_servizi_aggiuntivi&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#servizi_aggiuntivi").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
										</div>';                                              

                                        if($row['PrezzoServizio']==0){
                                            if($row['PercentualeServizio']==''){
                                                $PrezzoServizio = 'Gratuito';
                                            }else{
                                                $PrezzoServizio = '';
                                            }
                                        }else{
                                            $PrezzoServizio = '<i class="fa fa-euro p-r-5"></i> '.number_format($row['PrezzoServizio'],2,",",".");
                                        }
                                        if($row['PercentualeServizio']!=''){
                                            $PercentualeServizio = '<i class="fa fa-percent p-r-5"></i> '.number_format($row['PercentualeServizio'],0,",",".");
                                        }else{
                                            $PercentualeServizio = '';
                                        }

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
                                                    <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option>
                                                    <option value="11" '.($row['Ordine']==11?'selected="selected"':'').'>11</option>
                                                    <option value="12" '.($row['Ordine']==12?'selected="selected"':'').'>12</option>
                                                    <option value="13" '.($row['Ordine']==13?'selected="selected"':'').'>13</option>
                                                    <option value="14" '.($row['Ordine']==14?'selected="selected"':'').'>14</option>
                                                    <option value="15" '.($row['Ordine']==15?'selected="selected"':'').'>15</option>
                                                    <option value="16" '.($row['Ordine']==16?'selected="selected"':'').'>16</option>
                                                    <option value="17" '.($row['Ordine']==17?'selected="selected"':'').'>17</option>
                                                    <option value="18" '.($row['Ordine']==18?'selected="selected"':'').'>18</option>
                                                    <option value="19" '.($row['Ordine']==19?'selected="selected"':'').'>19</option>
                                                    <option value="20" '.($row['Ordine']==20?'selected="selected"':'').'>20</option>
                                                    <option value="21" '.($row['Ordine']==21?'selected="selected"':'').'>21</option>
                                                    <option value="22" '.($row['Ordine']==22?'selected="selected"':'').'>22</option>
                                                    <option value="23" '.($row['Ordine']==23?'selected="selected"':'').'>23</option>
                                                    <option value="24" '.($row['Ordine']==24?'selected="selected"':'').'>24</option>
                                                    <option value="25" '.($row['Ordine']==25?'selected="selected"':'').'>25</option>
                                                    <option value="26" '.($row['Ordine']==26?'selected="selected"':'').'>26</option>
                                                    <option value="27" '.($row['Ordine']==27?'selected="selected"':'').'>27</option>
                                                    <option value="28" '.($row['Ordine']==28?'selected="selected"':'').'>28</option>
                                                    <option value="29" '.($row['Ordine']==29?'selected="selected"':'').'>29</option>
                                                    <option value="30" '.($row['Ordine']==30?'selected="selected"':'').'>30</option>
                                                    <option value="31" '.($row['Ordine']==31?'selected="selected"':'').'>31</option>
                                                    <option value="32" '.($row['Ordine']==32?'selected="selected"':'').'>32</option>
                                                    <option value="33" '.($row['Ordine']==33?'selected="selected"':'').'>33</option>
                                                    <option value="34" '.($row['Ordine']==34?'selected="selected"':'').'>34</option>
                                                    <option value="35" '.($row['Ordine']==35?'selected="selected"':'').'>35</option>
                                                    <option value="36" '.($row['Ordine']==36?'selected="selected"':'').'>36</option>
                                                    <option value="37" '.($row['Ordine']==37?'selected="selected"':'').'>37</option>
                                                    <option value="38" '.($row['Ordine']==38?'selected="selected"':'').'>38</option>
                                                    <option value="39" '.($row['Ordine']==39?'selected="selected"':'').'>39</option>
                                                    <option value="40" '.($row['Ordine']==40?'selected="selected"':'').'>40</option>
                                                    <option value="41" '.($row['Ordine']==41?'selected="selected"':'').'>41</option>
                                                    <option value="42" '.($row['Ordine']==42?'selected="selected"':'').'>42</option>
                                                    <option value="43" '.($row['Ordine']==43?'selected="selected"':'').'>43</option>
                                                    <option value="44" '.($row['Ordine']==44?'selected="selected"':'').'>44</option>
                                                    <option value="45" '.($row['Ordine']==45?'selected="selected"':'').'>45</option>
                                                    <option value="46" '.($row['Ordine']==46?'selected="selected"':'').'>46</option>
                                                    <option value="47" '.($row['Ordine']==47?'selected="selected"':'').'>47</option>
                                                    <option value="48" '.($row['Ordine']==48?'selected="selected"':'').'>48</option>
                                                    <option value="49" '.($row['Ordine']==49?'selected="selected"':'').'>49</option>
                                                    <option value="50" '.($row['Ordine']==50?'selected="selected"':'').'>50</option>
                                                    <option value="51" '.($row['Ordine']==51?'selected="selected"':'').'>51</option>
                                                    <option value="52" '.($row['Ordine']==52?'selected="selected"':'').'>52</option>
                                                    <option value="53" '.($row['Ordine']==53?'selected="selected"':'').'>53</option>
                                                    <option value="55" '.($row['Ordine']==55?'selected="selected"':'').'>55</option>
                                                    <option value="55" '.($row['Ordine']==55?'selected="selected"':'').'>55</option>
                                                    <option value="56" '.($row['Ordine']==56?'selected="selected"':'').'>56</option>
                                                    <option value="57" '.($row['Ordine']==57?'selected="selected"':'').'>57</option>
                                                    <option value="58" '.($row['Ordine']==58?'selected="selected"':'').'>58</option>
                                                    <option value="59" '.($row['Ordine']==59?'selected="selected"':'').'>59</option>
                                                    <option value="60" '.($row['Ordine']==60?'selected="selected"':'').'>60</option>
                                                </select>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#OrdineRow'.$row['Id'].'").on("change",function(){
                                                            var OrdineRow = $("#OrdineRow'.$row['Id'].' option:selected").val(); 
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/ordine_servizi_aggiuntivi.php",
                                                                    type: "POST",
                                                                    data: "action=order_servizi_aggiuntivi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&OrdineRow="+OrdineRow+"",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#servizi_aggiuntivi").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;                                
                                                        });
                                                    });
                                                </script>';


							$data[] = array(
                                        "icona"       => ($row['Icona']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Icona'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Icona'].'&w=140&a=c&q=100" class="img-60"></a>':''),
                                        "servizio"    => $row['TipoServizio'],
                                        "testi"       => $fun->ControlloTestiInseritiServiziAggiuntivi($row['Id'],$row['idsito']),
                                        "prezzo"      => $PrezzoServizio,
                                        "percentuale" => $PercentualeServizio,
                                        "calcolo"     => $row['CalcoloPrezzo'],
                                        "abilitato"   => ($row['Abilitato'] == 0?'<i class="fa fa-times text-danger"></i>': '<i class="fa fa-check text-success"></i>'),
                                        "incluso"     => ($row['CalcoloPrezzo']!='A persona'?($row['Obbligatorio'] == 0?'<i class="fa fa-times text-danger"></i>': '<i class="fa fa-check text-success"></i>'):'<small>Non è possibile includere</small>'),
                                        "ordine"      => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                        "action"      => $action.$modale
 
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
