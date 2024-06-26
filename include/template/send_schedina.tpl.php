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
                                                <div class="card-block">
                                                        <h2>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    Invia Schedina allogiati alla Questura: <span>&#10230;</span> <small>invia email P.S.</small>
                                                                </div>
                                                                <div class="col-md-2 text-right">
                                                                    <?=$pulsante_indietro?>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                        <? if($msg !=''){?>
                                                        <?=$msg?>
                                                        <?=$script_js?>
                                                        <? }else{ ?>
                                                                <form id="form_mail" name="form_mail" role="form" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon"><i class="fa fa-fw">A:</i></span>
                                                                                <input type="email" id="email_singola" name="email_singola" placeholder="Inserimento indirizzo e-mail della questura"
                                                                                    class="form-control no_border_top_dx bold" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon"><i class="fa fa-fw">Cc:</i></span>
                                                                                <input type="email" id="email_copia" name="email_copia" placeholder="Metti in copia"
                                                                                    class="form-control no_border_top_dx bold">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                                                <input type="text" id="oggetto" name="oggetto" placeholder="Oggetto" class="form-control no_border_top_dx bold"
                                                                                    value="<?=$oggetto?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <textarea id="testo_email" name="testo_email" class="xcrud-input xcrud-texteditor form-control editor-loaded">
                                                                                <?=$testo_email?>
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix p-b-20"></div>
                                                                    <div class="box-footer">
                                                                        <input type="hidden" name="azione" value="<?=$_REQUEST['azione']?>">
                                                                        <input type="hidden" name="action" value="send_email">
                                                                        <button type="submit" class="btn btn-primary">Invia E-Mail</button>
                                                                    </div>
                                                                </form>
                                                        <?}?>
                                                        <?=$script_footer?>
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