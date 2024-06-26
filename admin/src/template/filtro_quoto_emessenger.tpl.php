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
                                                <h5>Gestione Filtri E-MESSENGER di <?=NOME_AMMINISTRAZIONE?></h5> 
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
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6"></div>
                                                                <div class="col-md-6 text-right">
                                                                    <? if($_REQUEST['idsito'] != ''){?>
                                                                            <form style="display: inline-block!important;padding-bottom:5px!important;padding-right:5px!important" method="POST" id="form_export" name="form_export" action="<?=BASE_URL_ADMIN?>src/controller/export_emessenger_quoto.php">
                                                                                <input type="hidden" name="action" value="export">
                                                                                <input type="hidden" name="idsito" value="<?=$_REQUEST['idsito']?>">
                                                                                <input type="hidden" name="Lingua" value="<?=$_REQUEST['Lingua']?>">
                                                                                <input type="hidden" name="CheckConsensoPrivacy" value="<?=$_REQUEST['CheckConsensoPrivacy']?>">
                                                                                <input type="hidden" name="CheckConsensoMarketing" value="<?=$_REQUEST['CheckConsensoMarketing']?>">
                                                                                <button type="submit" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Esporta</button>                               
                                                                            </form>                 
                                                                    <?}?>
                                                                </div>
                                                            </div>
                                                            <form  method="POST" id="form_search" name="form_search" action="<?=$_SERVER['REQUEST_URI']?>">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="idsito" class="control-label">Sito <small>(I clienti di colore rosso sono scaduti!)</small></label>
                                                                    <select name="idsito" id="idsito" class="chosen-select form-control">
                                                                        <option value="">--</option>
                                                                        <?=$lista_siti?>
                                                                    </select>
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
                                                        <br>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                        <label for="Lingua" class="control-label">Lingua</label>
                                                                        <select name="Lingua" id="Lingua" class="form-control">
                                                                        <option value="">--</option>
                                                                            <?=$Lingua?>
                                                                        </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                            
                                                                        <label for="CheckConsensoPrivacy" class="control-label">Consenso trattamento dati</label>
                                                                        <select name="CheckConsensoPrivacy" id="CheckConsensoPrivacy" class="form-control">
                                                                        <option value="">--</option>
                                                                        <option value="1" <?=($_REQUEST['CheckConsensoPrivacy']=='1'?'selected':'')?>>SI</option>
                                                                        <option value="0" <?=($_REQUEST['CheckConsensoPrivacy']=='0'?'selected':'')?>>NO</option>
                                                                        </select>
                                                            
                                                                </div>
                                                                <div class="col-md-4">
                                                                    
                                                                        <label for="CheckConsensoMarketing" class="control-label">Consenso invio materialeMarketing</label>
                                                                        <select name="CheckConsensoMarketing" id="CheckConsensoMarketing" class="form-control">
                                                                        <option value="">--</option>
                                                                        <option value="1" <?=($_REQUEST['CheckConsensoMarketing']=='1'?'selected':'')?>>SI</option>
                                                                        <option value="0" <?=($_REQUEST['CheckConsensoMarketing']=='0'?'selected':'')?>>NO</option>
                                                                        </select>
                                                                    
                                                                </div>
                                                            </div>                                                                    
                                                        </div>  
                                                        <br>                                                                                                                                  
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                        <input type="hidden" name="action" value="search">
                                                                        <a href="<?=BASE_URL_SITO?>prg-filtro_quoto_emessenger/" class="btn btn-sm btn-success" >Refresh</a>  
                                                                        <button type="submit" class="btn btn-sm btn-primary" id="bottone">Filtra</button> 
                                                            </div>
                                                        </div>                                
                                                    </form> 
                                                    <div class="clearfix p-b-30"></div>                          
                                                </div>
                                                <div class="clearfix p-b-30"></div>
                                                    <? if($_REQUEST['idsito'] != ''){?>
                                                        <?=$output;?>                       
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