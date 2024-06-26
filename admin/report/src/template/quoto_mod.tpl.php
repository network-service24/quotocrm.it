<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

<?php echo $script_legenda ?>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Modifica Report QUOTO</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="<?=BASE_URL_ADMIN?>report/dashboard_report/"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="<?=$_SERVER['REQUEST_URI']?>">Modifica report quoto</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>MODIFICA REPORT <?=($_REQUEST['azione']!=''?': '.$_REQUEST['azione']:'')?></h5>                                                                                      
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                        <li><i class="feather icon-trash-2 close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                                <div class="card-block">
                                                    <!-- libririe utili -->
                                                    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_ADMIN?>report/css/custom.report.css">
                                                    <script type="text/javascript" src="<?=BASE_URL_ADMIN?>report/html2canvas/js/html2canvas.js"></script>
                                                    <script type="text/javascript" src="<?=BASE_URL_ADMIN?>report/html2canvas/js/jquery.plugin.html2canvas.js"></script>
                                                    <script type="text/javascript" src="<?=BASE_URL_SITO?>js/ckeditor/ckeditor.js"></script>
                                                    <script>    
                                                      CKEDITOR.config.toolbar = [
                                                                      ['Source','-','Maximize'],['Format','FontSize'],
                                                                      ['Bold','Italic','Underline','StrikeThrough','-','Cut','Copy','Paste','PasteText','-','Outdent','Indent'],
                                                                      ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                                      ['Table','Link','TextColor','BGColor']
                                                                  ] ;
                                                      CKEDITOR.config.autoGrow_onStartup = true;
                                                      CKEDITOR.config.extraPlugins = 'autogrow';
                                                      CKEDITOR.config.autoGrow_minHeight = 200;
                                                      CKEDITOR.config.autoGrow_maxHeight = 600;
                                                      CKEDITOR.config.autoGrow_bottomSpace = 50;
                                                    </script>
                                             <form enctype="multipart/form-data" name="form_report" id="form_report" method="post" action="<?=BASE_URL_ADMIN.'report/quoto_mod/'.$_REQUEST['azione'].'/'.$_REQUEST['param'].'/'.$_REQUEST['valore'].'/'?>">
                                                    <table class="table table-sm"  style="width:100%">       
                                                        <tr>
                                                                <td class="no_border_input">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                        <img src="<?=BASE_URL_ADMIN?>report/images/quoto.jpg">
                                                                        </div>
                                                                        <div class="col-md-6 text-right">
                                                                            <img src="<?=BASE_URL_ADMIN?>report/images/logo_network_service.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>                               
                                                        <tr>
                                                        <td class="no_border_input">
                                                        
                                                            <table class="table  table-sm"  style="width:100%">                             
                                                                <tr class="blu">
                                                                <th class="text-center"><input type="text" name="titolo_quoto" class="form-control no_border_input text-center font20Bold blu" value="<?=$titolo_quoto?>" placeholder="QUOTO"></th>
                                                                </tr>                                      
                                                            </table>
                                                            <div style="clear:both;height:20px"></div>
                                                            <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="input-group">                                                    
                                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></span>  
                                                                        <input type="text" name="periodo_riferimento" class="form-control no_border_top_dx" value="<?=$periodo_riferimento?>" placeholder="Periodo di riferimento">
                                                                </div>                                        
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-6 text-right">
                                                                <img src="<?=BASE_URL_ADMIN?>report/images/quoto.jpg">
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i></span>
                                                                        <input type="date" name="dal" id="dal" class="form-control no_border_top_dx font20Bold" value="<?=$Dal?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i></span>
                                                                        <input type="date" name="al" id="al" class="form-control no_border_top_dx font20Bold" value="<?=$Al?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div style="clear:both;height:20px"></div>
                                                        <?if(!is_null($preventivi_inviati) && !empty($preventivi_inviati) && $preventivi_inviati != ''){?> 
                                                            <table class="table table-bordered">                                     
                                                                <tr class="blu">
                                                                <th class="text-center font20Bold"><b>Preventivi Inviati</b></th>
                                                                <th class="text-center font20Bold"><b>Prenotazioni Chiuse</b></th>
                                                                <th class="text-center font20Bold"><b>Tasso di Conversione</b></th>
                                                                <th class="text-center font20Bold"><b>Fatturato su Prenotazioni Chiuse</b></th>
                                                                <th></th>
                                                                </tr>
                                                                <tr id="riga_conversioni">
                                                                <td><input type="text" name="preventivi_inviati" id="preventivi_inviati" class=" form-control no_border_input font20Bold text-center" value="<?=$preventivi_inviati?>" /></td>
                                                                <td><input type="text" name="prenotazioni_chiuse" id="prenotazioni_chiuse" class=" form-control no_border_input font20Bold text-center" value="<?=$prenotazioni_chiuse?>" /></td>
                                                                <td><input type="text" name="tasso_conversione" id="tasso_conversione" class=" form-control no_border_input font20Bold text-center" value="<?=$tasso_conversione?>" /></td>
                                                                <td><input type="text" name="fatturato" id="fatturato" class=" form-control no_border_input font20Bold text-center" value="<?=$fatturato?>" /></td>
                                                                <td class="text-right"><a href="javascript:;" id="del_conversioni" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a></td> 
                                                                </tr>
                                                            <script>
                                                                $(document).ready(function() {  
                                                                    $("#del_conversioni").click(function(){
                                                                        $("#riga_conversioni").remove();                                       
                                                                    });
                                                                });                   
                                                            </script>                                         
                                                            </table> 
                                                            <?}?>
                                                            <?if(!is_null($etichetta_fatturato_fonti) && !empty($etichetta_fatturato_fonti) && $etichetta_fatturato_fonti[0] != ''){?>
                                                                <div style="clear:both;height:20px"></div> 
                                                                <table class="table table-bordered">                                     
                                                                    <tr class="blu">
                                                                        <th class="text-center font20Bold" colspan="3"><b>Fatturato per Fonti di Prenotazione</b></th>
                                                                    </tr>
                                                                    <?=$td_fonti?>                                        
                                                                </table>
                                                            <?}?>
                                                            <?if(!is_null($etichetta_fatturato_sito) && !empty($etichetta_fatturato_sito) && $etichetta_fatturato_sito[0] != ''){?>                   
                                                                <div style="clear:both;height:20px"></div> 
                                                                <table class="table table-bordered">                                     
                                                                    <tr class="blu">
                                                                    <th class="text-center font20Bold" colspan="3"><b>Dettaglio del Fatturato per Fonte di Prenotazione Sito Web</b></th>
                                                                    </tr>
                                                                    <?=$td_provenienza?>                                        
                                                                </table>
                                                            <?}?> 
                                                            <?if(!is_null($etichetta_fatturato_target) && !empty($etichetta_fatturato_target) && $etichetta_fatturato_target[0] != ''){?>
                                                                <div style="clear:both;height:20px"></div> 
                                                                <table class="table table-bordered">                                     
                                                                    <tr class="blu">
                                                                    <th class="text-center font20Bold" colspan="3"><b>Fatturato per Target Clienti</b></th>
                                                                    </tr>
                                                                    <?=$td_target?>                                        
                                                                </table> 
                                                        <?}?>
                                                            <?if(!is_null($etichetta_fatturato_operatori) && !empty($etichetta_fatturato_operatori) && $etichetta_fatturato_operatori[0] != ''){?>
                                                                <div style="clear:both;height:20px"></div> 
                                                                <table class="table table-bordered">                                     
                                                                    <tr class="blu">
                                                                    <th class="text-center font20Bold" colspan="3"><b>Fatturato per Operatori</b></th>
                                                                    </tr>
                                                                    <?=$td_operatori?>                                        
                                                                </table> 
                                                            <?}?>
                                                            <div style="clear:both;height:20px"></div>                                  
                                                            <div class="row">
                                                            <div class="col-md-12">
                                                                <textarea name="testo_report_quoto" id="testo_report_quoto" class="form-control"><?=$testo_report_quoto?></textarea>
                                                                <script type="text/javascript">
                                                                    $(function() {
                                                                        CKEDITOR.replace('testo_report_quoto');
                                                                        $(".textarea").wysihtml5();                                                   
                                                                    });
                                                                </script>
                                                            </div>
                                                            </div>                                  
                                                            <div style="clear:both;height:20px"></div>
                                                                                                                                                                                      
                                                            <div class="row">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-8 text-center">
                                                                <input type="hidden" name="action" value="modif">
                                                                <input type="hidden" name="Id" value="<?=$Id?>">

                                                                <input type="hidden" name="idsito" value="<?=$_REQUEST['param']?>">
                                                                <input type="hidden" name="data_report" value="<?=$_REQUEST['data_report']?>">
                                                                <button type="submit" class="btn btn-success" id="posizione"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Salva le modifiche</button>
  
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                            </div>
                                                        
                                                        </td>
                                                    </tr>
                                                    </table>
                                                </form>
                                                <? include_once(INC_PATH_MODULI_ADMIN.'backtop.inc.php'); ?>                                         
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <? include(BASE_PATH_ADMIN.'report/js/knob.custom.inc.js.php');?>
    <!-- /.content -->
    <? include_once(INC_PATH_MODULI_ADMIN.'footer.inc.php'); ?>