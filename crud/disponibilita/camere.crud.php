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

	$data           = array();
    $campo          = '';
    $campo2         = '';
    $selectOrdine   = '';
	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
					hospitality_tipo_camere.*	
				FROM 
					hospitality_tipo_camere 
				WHERE 
					hospitality_tipo_camere.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);

    #variabili di controllo dei software di terze parti
    $booking_attivo = $_REQUEST['booking_attivo'];
    $pms_attivo     = $_REQUEST['pms_attivo'];
    $checkAPI       = $fun->checkAPIQuotoHotel($_REQUEST['idsito']);

	foreach($rec as $key => $row){


            if ($fun->check_simplebooking($row['idsito'])==1){
                $campo = $fun->etichetta_booking($row['RoomCode'],'SimpleBooking');
            }
            if ($fun->check_ericsoftbooking($row['idsito'])==1){
                $campo = $fun->etichetta_booking($row['RoomCode'],'EricSoft Booking');
            }
            if ($fun->check_bedzzlebooking($row['idsito'])==1){
                $campo = $fun->etichetta_booking($row['RoomCode'],'Bedzzle Booking');
            }
            if($fun->check_pms_bedzzle($row['idsito'])==1){
                $campo2 = $fun->flag_pms_bedzzle($row['Id'],$row['idsito']);
            }
            if ($fun->check_parity($row['idsito'])==1){
                $campo2 = $fun->flag_camere_parity($row['Id'],$row['idsito']);
            }
            if ($fun->check_pms($row['idsito']) == 1){
                $campo2 = $fun->flag_pms_cinqueStelle($row['Id'],$row['idsito']);
            }

                            $modale .=' <div class="modal fade" id="ModaleUpdateCamere'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Camera</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_camere'.$row['Id'].'" name="form_mod_camere">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 nowrap">
                                                                            <label>Associa Servizi</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                          	                                                     
                                                                            <select name="Servizi" id="Servizi'.$row['Id'].'" class="Servizi_'.$row['Id'].' form-control" multiple="multiple" style="height:auto">';
                                                                            $query = "SELECT * FROM hospitality_servizi_camera WHERE Abilitato = 1 AND idsito = ".$row['idsito']." ORDER BY Servizio ASC";
                                                                            $result = $dbMysqli->query($query);
                                                                            $n_sc = sizeof($result);
                                                                            if($n_sc >0){
                                                                                foreach($result as $chiave => $valore){
                                                                        
                                                                                    $modale  .= '<option value="'.$valore['Servizio'].'" '.(strstr($row['Servizi'],$valore['Servizio'])?'selected="selected"':'').'>'.$valore['Servizio'].'</option>';
                                                                                }
                                                                            }
                                                $modale .='                                                         
                                                                            </select> 
                                
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Tipo Camera</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="TipoCamere'.$row['Id'].'" name="TipoCamere" value="'.$row['TipoCamere'].'" required/>
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
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>  
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Abilitato</label>
                                                                        </div>
                                                                        <div class="col-md-1">                                            	                                                     
                                                                            <input type="checkbox" class="form-control" id="Abilitato'.$row['Id'].'" name="Abilitato" value="'.$row['Abilitato'].'" '.($row['Abilitato']==1?'checked="checked"':'').'/>
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

                                                                    $("#Abilitato'.$row['Id'].'").click(function() {
                                                                        if($("#Abilitato'.$row['Id'].'").is(":checked")){
                                                                            $("#Abilitato'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#Abilitato'.$row['Id'].'").attr("value",false);
                                                                            $("#Abilitato'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });



                                                                    $("#form_mod_camere'.$row['Id'].'").submit(function () {   
                                                                        var  Id           = $("#Id'.$row['Id'].'").val(); 
                                                                        var  TipoCamere   = $("#TipoCamere'.$row['Id'].'").val();
                                                                        var  Servizi      = $("#Servizi'.$row['Id'].'").val();       
                                                                        var  Ordine       = $("#Ordine'.$row['Id'].' option:selected").val(); 
                                                                        var  Abilitato    = $("#Abilitato'.$row['Id'].'").val();  
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/modifica_camera.php",
                                                                            type: "POST",
                                                                            data: "action=mod_camera&Id="+Id+"&idsito='.$row['idsito'].'&TipoCamere="+TipoCamere+"&Abilitato="+Abilitato+"&Ordine="+Ordine+"&Servizi="+Servizi+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateCamere'.$row['Id'].'").modal("hide");
                                                                                $("#camere").DataTable().ajax.reload();    
                                                                            }
                                                                        });
                                                                        
                                                                        return false;
                                                                                                         
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
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-camere_testi/'.$row['Id'].'/'.urlencode($row['TipoCamere']).'/"><i class="fa fa-comment-o text-green"></i> Gestione testi camera </a>                                                                                    
                                            <div class="dropdown-divider"></div>
                                            <a '.($booking_attivo == 1?'class="dropdown-item waves-effect waves-light text-gray" href="javascript:alert(\'Gestione listino QUOTO disabilitata\')"':'class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-camere_listino/'.$row['Id'].'/'.urlencode($row['TipoCamere']).'/"').'><i class="fa fa-euro text-yellow"></i> Gestione listino camera </a>                                         
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-camere_gallery/'.$row['Id'].'/'.urlencode($row['TipoCamere']).'/"><i class="fa fa-photo text-blue"></i> Gestione galleria camera </a>                                         
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-duplica_camera/'.$row['Id'].'/"><i class="fa fa-plus text-black"></i> Duplica </a>                                         
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
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_camera.php",
                                                            type: "POST",
                                                            data: "action=switch_camera&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#camere").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_camera.php",
                                                            type: "POST",
                                                            data: "action=switch_camera&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#camere").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;                                                           
                                                    });
                                                });
                                            </script>                                               
                                            <div class="dropdown-divider"></div>
                                            '.($checkAPI==1?
                                            ($row['Abilitato_form']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="abilitaF'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita voce nel form</a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilitaF'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita voce nel form</a>'
                                            ).'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#abilitaF'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_cameraF.php",
                                                            type: "POST",
                                                            data: "action=switch_cameraF&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato_form=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#camere").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilitaF'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_cameraF.php",
                                                            type: "POST",
                                                            data: "action=switch_cameraF&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato_form=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#camere").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;                                                           
                                                    });
                                                });
                                            </script>                                               
                                            <div class="dropdown-divider"></div>':'').'
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateCamere'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_camera'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_camera'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questa camere e tutto il suo contenuto?\r\nCosì facendo se avete già un\'attivitàdi preventivi e/o prenotazioni in corso, andreste a svuotare le proposte di soggiorno in produzione e le relative statistiche!")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_camera.php",
                                                                    type: "POST",
                                                                    data: "action=del_camera&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#camere").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;
                                                            }
                                                        });
                                                    });
                                                </script>
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
                                    </select>
                                    <script>
                                        $(document).ready(function(){ 
                                            $("#OrdineRow'.$row['Id'].'").on("change",function(){
                                                var OrdineRow = $("#OrdineRow'.$row['Id'].' option:selected").val(); 
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/disponibilita/ordine_camere.php",
                                                        type: "POST",
                                                        data: "action=order_camere&idsito='.$row['idsito'].'&Id='.$row['Id'].'&OrdineRow="+OrdineRow+"",
                                                        dataType: "html",
                                                        success: function(data) {
                                                            $("#camere").DataTable().ajax.reload();    
                                                        }
                                                    });
                                                    return false;                                
                                            });
                                        });
                                    </script>';


                            if ($booking_attivo == 1 && $pms_attivo == 0){     

                                $data[] = array(
                                    "RoomCode"  => $campo,
                                    "camera"    => $row['TipoCamere'],
                                    "servizi"   => ($row['Servizi']!=''?'<span class="pcoded-badge badge badge-inverse-info text-left">'.str_replace(",","<br>",$row['Servizi']).'</span>':''),
                                    "testi"     => $fun->ControlloTestiInseritiCamere($row['Id'],$row['idsito']),
                                    "listino"   => $fun->ControlloListinoInseritoCamere($row['Id'],$row['idsito']),
                                    "gallery"   => $fun->ControlloGalleryInseritoCamere($row['Id'],$row['idsito']),
                                    "ordine"    => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                    "abilitato" => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                    
                                    "action"    => $action.$modale
                                );
                            }elseif($booking_attivo == 0 && $pms_attivo == 1){
                                $data[] = array(
                                    "RoomTypePms" => $campo2,
                                    "camera"      => $row['TipoCamere'],
                                    "servizi"     => ($row['Servizi']!=''?'<span class="pcoded-badge badge badge-inverse-info text-left">'.str_replace(",","<br>",$row['Servizi']).'</span>':''),
                                    "testi"       => $fun->ControlloTestiInseritiCamere($row['Id'],$row['idsito']),
                                    "listino"     => $fun->ControlloListinoInseritoCamere($row['Id'],$row['idsito']),
                                    "gallery"     => $fun->ControlloGalleryInseritoCamere($row['Id'],$row['idsito']),
                                    "ordine"      => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                    "abilitato"   => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                   
                                    "action"      => $action.$modale
                                );                                
                            }elseif($booking_attivo == 1 && $pms_attivo == 1){ 
                                $data[] = array(
                                    "RoomCode"    => $campo,
                                    "RoomTypePms" => $campo2,
                                    "camera"      => $row['TipoCamere'],
                                    "servizi"     => ($row['Servizi']!=''?'<span class="pcoded-badge badge badge-inverse-info text-left">'.str_replace(",","<br>",$row['Servizi']).'</span>':''),
                                    "testi"       => $fun->ControlloTestiInseritiCamere($row['Id'],$row['idsito']),
                                    "listino"     => $fun->ControlloListinoInseritoCamere($row['Id'],$row['idsito']),
                                    "gallery"     => $fun->ControlloGalleryInseritoCamere($row['Id'],$row['idsito']),
                                    "ordine"      => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                    "abilitato"   => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                   
                                    "action"      => $action.$modale
                                );

                            }else{
                                $data[] = array(
                                    "camera"    => $row['TipoCamere'],
                                    "servizi"   => ($row['Servizi']!=''?'<span class="pcoded-badge badge badge-inverse-info text-left">'.str_replace(",","<br>",$row['Servizi']).'</span>':''),
                                    "testi"     => $fun->ControlloTestiInseritiCamere($row['Id'],$row['idsito']),
                                    "listino"   => $fun->ControlloListinoInseritoCamere($row['Id'],$row['idsito']),
                                    "gallery"   => $fun->ControlloGalleryInseritoCamere($row['Id'],$row['idsito']),
                                    "ordine"    => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                    "abilitato" => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                   
                                    "action"    => $action.$modale
                                );
                            }

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
