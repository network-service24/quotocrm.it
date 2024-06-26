<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$js?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
<?=contoallarovescia(4,'preventivi')?> 

    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <? echo $mssg?> 
                <div id="sc"></div>
                  <h2>Preventivi: invio proposte di soggiorno!</h2>
                  <div style="float:right;"><a href="javascript:;" id="attiva_legenda3" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info"></i></a></div>
                  <div class="clearfix"></div>
                  <div  id="legenda3"  style="display:none"> 
                  <div class="row"> 
                    <div class="col-md-6">
                        <?=$data_syncro?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?                   
                            //PORTALI
                            echo ($InfoAlberghiButton!=''?$InfoAlberghiButton.'<br>'.$data_import:'');;
                            echo (($GabicceMareButton!='' && $InfoAlberghiButton!='')?'<br>':'');
                            echo ($GabicceMareButton!=''?$GabicceMareButton.'<br>'.$data_import_gabicce:'');
                            echo (($ItalyFamilyHotelsButton!='' && $InfoAlberghiButton!='' && $GabicceMareButton!='')?'<br>':'');
                            echo ($ItalyFamilyHotelsButton!=''?$ItalyFamilyHotelsButton.'<br>'.$data_import_italyfamilyhotels:'');
                            echo ($RiccioneinHotelButton!=''?$RiccioneinHotelButton.'<br>'.$data_import_riccioneinhotel:'');
                            echo ($CesenaticoBellaVitaButton!=''?$CesenaticoBellaVitaButton.'<br>'.$data_import_cesenaticobellavita:'');
                            echo ($FamilygoButton!=''?$FamilygoButton.'<br>'.$data_import_familygo:'');
                            echo ($ItalyBikeHotelsButton!=''?$ItalyBikeHotelsButton.'<br>'.$data_import_italybikehotels:'');  
                            echo ($BimboInViaggioButton!=''?$BimboInViaggioButton.'<br>'.$data_import_bimboinviaggio:'');                                                    
                        ?>
                    </div>
                  </div>
                  <div class="alert alert-profila  alert-default-profila alert-dismissable text-black">
                        <h5><i class="fa fa-exclamation-triangle text-orange"></i> Se vicino al <b>Cognome</b> appare <i class="fa fa-star text-red"></i> il cliente è già presente in <?=NOME_AMMINISTRAZIONE?>, cioè ha effettuato più di una richiesta di preventivo!</h5>                                             
                        <?=$testo_recall?>
                        <h5>
                            <i class="fa fa-exclamation-triangle text-red"></i> 
                                    Se è attiva la sincronia con il PMS di EricSoft ed avete 2 o più di tipologie di camera uguali <b>NON UTILIZZATE IL CAMPO NR. DI CAMERE inserendone il numero</b>, ma <b>INSERITE PIU' RIGHE!</b>
                        </h5>
                    </div>
                </div>
                    <div style="clear:both;height:5px"></div> 
                        <script>
                           $(document).ready(function(){
                             $("#attiva_legenda3").on("click",function(){
                               $("#legenda3").slideToggle("slow");
                             })
                           })
                         </script>  
                        <div class="btn-group btn-group-100">
                        <? include(INC_PATH_MODULI.'dimension.inc.php'); ?>
                        <div id="view_send_mail_loading"></div> 
                            <button type="button" class="btn bg-maroon">Azioni</button>
                            <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu"> 
                                <li>
                                    <form  method="POST" id="form_search" name="form_search" action="<?=$_SERVER['REQUEST_URI']?>" style="padding: 3px 20px !important;">
                                        <input type="hidden" name="Inviata" value="1">
                                        <?if($_REQUEST['Inviata']==1){?>
                                            <a href="<?=BASE_URL_SITO?>preventivi/"><i class="fa fa-ban green" aria-hidden="true"></i> <span style="margin-left: 10px!important;color:#363636 !important;">Reset filtro non Inviati</span></a>
                                        <?}else{?>
                                            <a href="#" onclick="document.getElementById('form_search').submit();" id="filtro_inviati"><i class="fa fa-filter orange" aria-hidden="true"></i> <span style="padding-left: 10px!important;color:#363636 !important;">Filtra per non Inviati</span></a>
                                        <?}?>
                                    </form>                             
                                </li>
                                <li class="divider"></li>
                                <li><a  data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca avanzata</a></li>
                                <li><a id="archivia_all" href="#"><i class="fa fa-inbox orange" aria-hidden="true"></i> Archivia i selezionati</a></li>
                                <li><a id="delete_all" href="#"><i class="fa fa-remove red" aria-hidden="true"></i> Elimina i selezionati</a></li>
                                <li class="divider"></li>
                                <li><a id="add_all_newsletter" href="#"><img src="<?=BASE_URL_SITO?>img/emessenger.png" class="small_ico_emessenger"> Aggiungi i selezionati ad <?=NOME_CLIENT_EMAIL?></a></li>
                                <li class="divider"></li>
                                <li><a id="assegna_all_op" data-toggle="modal" data-tooltip="tooltip" data-target="#ModaleOperatori" href="#"><i class="fa fa-user info" aria-hidden="true"></i>&nbsp; Assegna operatore ai selezionati</a></li>
                            </ul>
                        </div>
                        <? include(INC_PATH_MODULI.'search.inc.php'); ?>                 
                        <?=$js_script_archivia?> 
                        <?=$js_script_delete?> 
                        <?=$js_script_mailing?>                   
                            <div class="modal fade" id="ModaleOperatori" tabindex="-1" role="dialog" aria-labelledby="ModaleOperatoriLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Seleziona Operatore da associare</h4>
                                        </div>
                                        <div class="modal-body">
                                                <form  method="POST" id="form_ass_op" name="form_ass_op">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="AssOperatore" class="control-label">Operatore</label>
                                                                <select name="AssOperatore" id="AssOperatore" class="form-control" required>
                                                                <option value="">--</option>
                                                                <?=$lista_op?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">                                                                      
                                                    <div class="col-md-12 text-center">
                                                        <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Associa</button> 
                                                        </div>                                    
                                                    </div>
                                                    </div>                                                            
                                                </form>
                                                <?=$js_script_modale_op?> 
                                            <div id="risultato_op"></div>
                                            <div id="risultato_ko_op"></div> 
                                        </div>
                                    </div>
                                </div>           
                            </div>                            
                            <div id="risultato"></div>
                            <div id="risultato_del"></div> 
                            <div id="risultato_newsletter"></div>                 
                            <div style="clearfix"></div>               
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">  
                                    <div  id="checkAll" style="cursor:pointer"><small><i class="fa fa-check-square-o"></i> Seleziona tutti</small></div> 
                                    <div  id="checkAllOp" style="cursor:pointer"><small><i class="fa fa-check-square-o"></i> Seleziona tutti per assegnare operatore</small></div> 
                                </div>
                            </div>                                                                    
                  <?php   echo $xcrud->render(); ?>

                  <?if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div style="float:left;position:absolute;bottom:20px;left:20px"  data-toogle="tooltip" data-html="true" data-placement="right" title="INFO HELP: La memorizzazione del valore di paginazione, se il menù dovesse essere composto da troppi numeri, dopo ogni modifica potrebbe anche non tornare al tab numerico scelto!"><i class="fa fa-life-ring text-light-blue"></i></div>';}?>
                  <?if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div id="legendaPagination"></div>';echo $js_pagination;}?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<div id="modale_upselling"></div> 
<?php 
    if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
        echo notifica_mancata_click(IDSITO,'Preventivo');
        echo $notifiche_js;
    }
?> 

<?php include_module('footer.inc.php'); ?>