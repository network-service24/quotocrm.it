<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="invoice radius6">
        <div class="row">
            <div class="box-body">
                <h2> Dati della scelta di Pagamento del cliente
                    <span>&#10230;</span> <small>Utente</small></h2>
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="page-header">
                            <div class="inline"><?=$icona?> &nbsp; <?=$Nome.' '.$Cognome?></div>
                        </h2>
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <div class="text-right">
                            <a class="btn btn-warning" href="<?=BASE_URL_SITO.$link?>"><i class="fa fa-arrow-left"></i>
                                Torna indietro </a>
                        </div>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <? echo check_conferma($_REQUEST['id_richiesta'])?>
                    </div><!-- /.col -->
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6 table-responsive">
                        <form id="f" name="f" role="form" method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">N. Rif. Conferma soggiorno</th>
                                    <td>
                                        <?=$IdRichiesta?>/
                                        <?=$NumeroPrenotazione?>
                                    </td>
                                </tr>
                                <? if($acconto!=''){?>
                                <tr>
                                    <th style="width:50%">Caparra da prelevare</th>
                                    <td>
                                        <?=$acconto?>
                                    </td>
                                </tr>
                                <?}?>
                                <tr>
                                    <th style="width:50%">Nome e Cognome dell'intestatario del Soggiorno</th>
                                    <td>
                                        <?=$Nome.' '.$Cognome?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Data della scelta di pagamento:</th>
                                    <td>
                                        <?=$DataInserimento?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Tipo di Pagamento scelto:</th>
                                    <td>
                                        <?=$TipoPagamento?>
                                        <? 
                                            if($TipoPagamento=='Stripe'){
                                                echo '  <small><em>[link]</em> :'.$cro.'</small>';
                                            }

                                            if($TipoPagamento=='Nexi'){
                                                echo '  <small> <em>[Id transazione]</em> :'.$cro.'</small>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <? if($TipoPagamento=='Bonifico'){?>
                                <tr>
                                    <td colspan="2">
                                        <b>Se avete
                                            <?=($TipoPagamento=='Bonifico'?'il CRO oppure':'')?> copia di avvenuto pagamento,
                                            <?=($TipoPagamento=='Bonifico'?'inserire uno o l\'altro dato, oppure entrambi':'inserire la ricevuta')?>!</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">CRO:</th>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-bars"></i></span>
                                            <input type="text" name="CRO" class="form-control" value="<?=$cro?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Upload Ricevuta:<br><small class="text-gray">(pdf, doc, docx,
                                            txt, jpg, png)</small></th>
                                    <td>
                                        <?=$upload?>
                                    </td>
                                </tr>
                                <?}?>
                                <? if($TipoPagamento=='PayPal'){?>
                                    <tr>
                                        <th style="width:50%">ID Transazione PayPal:</th>
                                        <td>
                                            <?=$cro?>
                                        </td>
                                    </tr>
                                <?}?>
                                <? if($TipoPagamento=='Gateway Bancario' || $TipoPagamento=='Gateway Bancario Virtual Pay'){?>
                                    <tr>
                                        <th style="width:50%">ID Transazione <?=$TipoPagamento?>:</th>
                                        <td>
                                            <?=$cro?>
                                        </td>
                                    </tr>
                                <?}?>
                                <? if($TipoPagamento=='Bonifico'){?>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="hidden" name="id_richiesta" value="<?=$IdRichiesta?>">
                                        <input type="hidden" name="id" value="<?=$Id?>">
                                        <input type="hidden" name="provenienza" value="<?=$link?>">
                                        <input type="hidden" name="idsito" value="<?=$IdSito?>">
                                        <input type="hidden" name="copia_ricevuta" value="<?=$ricevuta?>">
                                        <input type="hidden" name="action" value="save_pg">
                                        <button type="submit" class="btn btn-primary">Salva</button>
                                    </td>
                                </tr>
                                <?}?>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
    <div class="clearfix"></div>
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
