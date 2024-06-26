<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

<style>
.content{
    overflow: inherit!important;
}
</style>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>Gestione Filtri Avanzati Profila ed Esporta <?=NOME_AMMINISTRAZIONE?></h5> 
                                                <?=$provenienza?>                                                
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-maximize full-card"></i></li>
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                        <li><i class="feather icon-trash-2 close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                                <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-6"> 
                                                            <h3>Filtri avanzati per Profila ed Esporta clienti di QUOTO</h3>
                                                            </div>
                                                            <div class="col-md-6"> 
                                                            <? if($_REQUEST['action']=='search'){
                                                                echo' <h5>Filtri della query!</h5>
                                                                <div style="clear:both; margin-left:20px"></div>';
                                                                        echo   ($_REQUEST['Lingua']!=''?'<p class="badge bg-gray text-black">'.$_REQUEST['Lingua'].'</p>':'').' 
                                                                                '.($_REQUEST['TipoRichiesta']!=''?'<p class="badge bg-gray text-black">'.$_REQUEST['TipoRichiesta'] .'</p>':'').' 
                                                                                '.($_REQUEST['FontePrenotazione']!=''?'<p class="badge bg-gray text-black">'.$_REQUEST['FontePrenotazione'].'</p>':'').'
                                                                                '.($_REQUEST['TipoVacanza']!=''?'<p class="badge bg-gray text-black">'.$_REQUEST['TipoVacanza'].'</p>':'').'
                                                                                '.($_REQUEST['DataArrivo']!=''?'<p class="badge bg-gray text-black">'.gira_data($_REQUEST['DataArrivo']).'</p>':'').'
                                                                                '.($_REQUEST['DataPartenza']!=''?'<p class="badge bg-gray text-black">'.gira_data($_REQUEST['DataPartenza']).'</p>':'');                                   
                                                                }

                                                            ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                        <form  method="POST" id="form_search" name="form_search" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="idsito" class="control-label">Sito <small>(I clienti di colore rosso sono scaduti!)</small></label>
                                                                                    <select name="idsito" id="idsito" class="chosen-select form-control">
                                                                                        <option value="">--</option>
                                                                                        <?=$lista_siti?>
                                                                                    </select>
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                <script>
                                                                $(document).ready(function() {
                                                                    if($('#idsito').val() != ''){
                                                                    $('#view').css('display','block'); 
                                                                    }
                                                                    $('#idsito').change(function(){
                                                                        $('#view').css('display','block');
                                                                    });
                                                                });
                                                                </script>
                                                                <div id="view" style="display:none">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                            <div class="form-group">

                                                                                    <label for="Lingua" class="control-label">Lingua</label>
                                                                                    <select name="Lingua" id="Lingua" class="form-control">
                                                                                    <option value="">--</option>
                                                                                        <?=$Lingua?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="TipoRichiesta" class="control-label">Tipo Richiesta</label>
                                                                                <select name="TipoRichiesta" id="TipoRichiesta" class="form-control">
                                                                                <option value="">--</option>
                                                                                    <?=$TipoRichiesta?>
                                                                                </select>
                                                                            </div>
                                                                            </div>                                    
                                                                        </div>                                
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                <label for="FontePrenotazione" class="control-label">Fonte</label>
                                                                                <select name="FontePrenotazione" id="FontePrenotazione" class="form-control">
                                                                                    <option value="">...</option>
                                                                                </select>
                                                                            <script type="text/javascript">
                                                                                    $(document).ready(function() {   
                                                                                        if($('#idsito').val() != ''){
                                                                                            var idsito = $("#idsito").val();
                                                                                            $.ajax({        
                                                                                                type: "POST",         
                                                                                                url: "<?=BASE_URL_ADMIN?>ajax/filtri/fonti_quoto.php",        
                                                                                                data: "idsito=" + idsito,
                                                                                                dataType: "html",        
                                                                                                success: function(msg){
                                                                                                    $("#FontePrenotazione").html(msg);
                                                                                                },
                                                                                                error: function(){
                                                                                                    alert("Chiamata fallita, si prega di riprovare..."); 
                                                                                                }
                                                                                            });
                                                                                        } 
                                                                                        $('#idsito').change(function() {
                                                                                            var idsito = $("#idsito").val();
                                                                                            $.ajax({        
                                                                                                type: "POST",         
                                                                                                url: "<?=BASE_URL_ADMIN?>ajax/filtri/fonti_quoto.php",        
                                                                                                data: "idsito=" + idsito,
                                                                                                dataType: "html",        
                                                                                                success: function(msg){
                                                                                                    $("#FontePrenotazione").html(msg);
                                                                                                },
                                                                                                error: function(){
                                                                                                    alert("Chiamata fallita, si prega di riprovare..."); 
                                                                                                }
                                                                                            });
                                                                                        });        
                                                                                    });
                                                                                </script>                                        
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group">

                                                                                <label for="TipoVacanza" class="control-label">Tipo (target cliente)</label>
                                                                                <select name="TipoVacanza" id="TipoVacanza" class="form-control">
                                                                                <option value="">...</option>                                            
                                                                                </select>
                                                                            <script type="text/javascript">
                                                                                    $(document).ready(function() {  
                                                                                        if($('#idsito').val() != ''){
                                                                                            var idsito = $("#idsito").val();
                                                                                            $.ajax({        
                                                                                                type: "POST",         
                                                                                                url: "<?=BASE_URL_ADMIN?>ajax/filtri/target_quoto.php",        
                                                                                                data: "idsito=" + idsito,
                                                                                                dataType: "html",        
                                                                                                success: function(msg){
                                                                                                    $("#TipoVacanza").html(msg);
                                                                                                },
                                                                                                error: function(){
                                                                                                    alert("Chiamata fallita, si prega di riprovare..."); 
                                                                                                }
                                                                                            });
                                                                                        } 

                                                                                        $('#idsito').change(function() {
                                                                                            var idsito = $("#idsito").val();
                                                                                            $.ajax({        
                                                                                                type: "POST",         
                                                                                                url: "<?=BASE_URL_ADMIN?>ajax/filtri/target_quoto.php",        
                                                                                                data: "idsito=" + idsito,
                                                                                                dataType: "html",        
                                                                                                success: function(msg){
                                                                                                    $("#TipoVacanza").html(msg);
                                                                                                },
                                                                                                error: function(){
                                                                                                    alert("Chiamata fallita, si prega di riprovare..."); 
                                                                                                }
                                                                                            });
                                                                                        });        
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            </div>                                    
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                            <div class="form-group">

                                                                                    <label for="Chiuso" class="control-label">Prenotazione Chiusa</label>
                                                                                    <select name="Chiuso" id="Chiuso" class="form-control">
                                                                                    
                                                                                    <option value="1" <?=($_REQUEST['Chiuso']==1?'selected="selected"':'')?>>Si</option>
                                                                                    <option value="0" <?=($_REQUEST['Chiuso']==0?'selected="selected"':'')?>>No</option>
                                                                                    <option value="" <?=($_REQUEST['Chiuso']==''?'selected="selected"':'')?>>--</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="Disdetta" class="control-label">Prenotazione Disdetta</label>
                                                                                <select name="Disdetta" id="Disdetta" class="form-control">
                                                                                
                                                                                    <option value="1" <?=($_REQUEST['Disdetta']==1?'selected="selected"':'')?>>Si</option>
                                                                                    <option value="0" <?=($_REQUEST['Disdetta']==0?'selected="selected"':'')?>>No</option>
                                                                                    <option value="" <?=($_REQUEST['Disdetta']==''?'selected="selected"':'')?>>--</option>
                                                                                </select>
                                                                            </div>
                                                                            </div>                                    
                                                                        </div>
                                                                        <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                    <label for="CheckConsensoPrivacy" class="control-label">Consenso trattamento dati</label>
                                                                                    <select name="CheckConsensoPrivacy" id="CheckConsensoPrivacy" class="form-control">
                                                                                    <option value="">--</option>
                                                                                    <option value="1" <?=($_REQUEST['CheckConsensoPrivacy']=='1'?'selected':'')?>'>SI</option>
                                                                                    <option value="0" <?=($_REQUEST['CheckConsensoPrivacy']=='0'?'selected':'')?>'>NO</option>
                                                                                    </select>
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                    <label for="CheckConsensoMarketing" class="control-label">Consenso invio materialeMarketing</label>
                                                                                    <select name="CheckConsensoMarketing" id="CheckConsensoMarketing" class="form-control">
                                                                                    <option value="">--</option>
                                                                                    <option value="1" <?=($_REQUEST['CheckConsensoMarketing']=='1'?'selected':'')?>'>SI</option>
                                                                                    <option value="0" <?=($_REQUEST['CheckConsensoMarketing']=='0'?'selected':'')?>'>NO</option>
                                                                                    </select>
                                                                                </div>
                                                                                </div>
                                                                        </div>                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                            <div class="col-md-6">
                                                                                        <div class="control-group">
                                                                                            <label for="DataArrivo" class="control-label">Data Arrivo</label>
                                                                                            <div class="controls">
                          
                                                                                                    <input id="DataArrivo" name="DataArrivo" type="date" class="form-control" value="<?=$_REQUEST['DataArrivo']?>" autocomplete="off" />
                                                                                               
                                                                                            </div>
                                                                                        </div>                          
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                        <div class="control-group">
                                                                                            <label for="DataPartenza" class="control-label">Data Partenza</label>
                                                                                            <div class="controls">

                                                                                                    <input id="DataPartenza" name="DataPartenza" type="date" class="form-control" value="<?=$_REQUEST['DataPartenza']?>" autocomplete="off" />
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                    </div>                                                                                                                                    
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="action" value="search">
                                                                            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                                                                            <input type="hidden" name="order" value="<?=$_REQUEST['order']?>">
                                                                            <input type="hidden" name="tipo" value="<?=$_REQUEST['tipo']?>">
                                                                            <a href="<?=BASE_URL_SITO?>filtro_quoto/" class="btn btn-sm btn-success" >Refresh</a>  
                                                                            <button type="submit" class="btn btn-sm btn-primary" id="bottone">Filtra</button> 
                                                                        </div>                                
                                                                        </form> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <? if($_REQUEST['idsito'] != ''){?>
                                                            <div class="row">
                                                                <div class="col-md-6"></div>
                                                                <div class="col-md-6 text-right" >
                                                                    <form style="display: inline-block!important;padding-bottom:5px!important;padding-right:5px!important" method="POST" id="form_export" name="form_export" action="<?=BASE_URL_ADMIN?>src/controller/export_clienti_quoto.php">
                                                                        <input type="hidden" name="action" value="export">
                                                                        <input type="hidden" name="idsito" value="<?=$_REQUEST['idsito']?>">
                                                                        <input type="hidden" name="Lingua" value="<?=$_REQUEST['Lingua']?>">
                                                                        <input type="hidden" name="TipoRichiesta" value="<?=$_REQUEST['TipoRichiesta']?>">
                                                                        <input type="hidden" name="FontePrenotazione" value="<?=$_REQUEST['FontePrenotazione']?>">
                                                                        <input type="hidden" name="TipoVacanza" value="<?=$_REQUEST['TipoVacanza']?>">
                                                                        <input type="hidden" name="DataArrivo" value="<?=$_REQUEST['DataArrivo']?>">
                                                                        <input type="hidden" name="DataPartenza" value="<?=$_REQUEST['DataPartenza']?>">
                                                                        <input type="hidden" name="CheckConsensoPrivacy" value="<?=$_REQUEST['CheckConsensoPrivacy']?>">
                                                                        <input type="hidden" name="CheckConsensoMarketing" value="<?=$_REQUEST['CheckConsensoMarketing']?>">                                    
                                                                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                                                                        <input type="hidden" name="order" value="<?=$_REQUEST['order']?>">
                                                                        <input type="hidden" name="tipo" value="<?=$_REQUEST['tipo']?>">
                                                                        <button type="submit" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Esporta</button>                               
                                                                    </form>
                                                                </div>
                                                            </div>   
                                                            <?php echo $lista;?>                     
                                                        <?}?>
                                                    <? include_once(INC_PATH_MODULI_ADMIN.'backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_once(INC_PATH_MODULI_ADMIN.'footer.inc.php'); ?>