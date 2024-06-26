<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>
                                                  <?=$riferimenti?>
                                                </h5>                                              

                                            </div>
                                                <div class="card-block">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                        <div class="col-md-10">
                                                            <?=$dettaglioProposta;?> <br>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="text-right">
                                                            <h3>
                                                                <form action="<?=BASE_URL_SITO.$_REQUEST['provenienza'].'/';?>" method="POST" name="redirect">
                                                                    <input type="hidden" name="idrichiesta" value="<?=$_REQUEST['id_guest']?>">
                                                                    <button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-arrow-left"></i>Torna indietro </button>
                                                                </form>

                                                            </h3>
                                                            </div>
                                                        </div><!-- /.col -->
                                                        </div>
                                                        <?=$form_data_scadenza?>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                            <form id="form_chat" name="form_chat" method="post">
                                                                <div class="form-group">
                                                                <label for="op">Cambia operatore <a href="javascript:;" id="attiva_legenda_info_fonti" data-toogle="tooltip" data-html="true" title="<div class=\'text-left\'>Se sei un operatore diverso da chi ha creato il preventivo e/o la conferma,puoi cambiare!</div>"><i class="fa fa-life-ring text-info"></i></a></label>
                                                                    <select class="form-control"name="operatore" id="operatore" >
                                                                    <?=$Operatori?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Messaggio">Hotel Chat</label>
                                                                    <textarea class="form-control" rows="10" name="chat" id="chat" required></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_guest" value="<?=$row['Id']?>">
                                                                <input type="hidden" name="NumeroPrenotazione" value="<?=$row['NumeroPrenotazione']?>">
                                                                <input type="hidden" name="user" value="<?=$row['ChiPrenota']?>">
                                                                <input type="hidden" name="lang" value="<?=$row['Lingua']?>">
                                                                <input type="hidden" name="idsito" value="<?=$row['idsito']?>">
                                                                <input type="hidden" name="action" value="add_chat">
                                                                <button id="bottone_invio_chat" type="submit" class="btn <?=$css_pulsante?> btn-sm" style="float:right!important;" title="<?=$title?>" <?=$command?> >Invia</button>
                                                            </form>
                                                            <?=$js_chat?>
                                                            <?=$js_chat_load?>
                                                            <br><br><br>
                                                            <div id="balloon"></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                    </div>  
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>