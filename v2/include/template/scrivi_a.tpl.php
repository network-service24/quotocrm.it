<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2>
                    <div class="row">
                        <div class="col-md-10">
                            Scrivi al tuo ospite per richiedere una recensione
                        </div>
                        <div class="col-md-2 text-right">
                            <?=$pulsante_indietro?>
                        </div>
                    </div>
                </h2>
            <? if($msg ==''){?>
                <form id="form_mail" name="form_mail" role="form" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw">A:</i></span>
                                <input type="email" id="email_singola" name="email_singola" placeholder="Inserimento indirizzo e-mail"
                                    class="form-control no_border_top_dx bold" value="<?=$Email_Ospite?>" required>
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
                    <div class="clear"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea id="testo_email" name="testo_email" class="xcrud-input xcrud-texteditor form-control editor-loaded">
                                <?=$testo_email?>
                            </textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="box-footer">
                        <input type="hidden" name="azione" value="<?=$_REQUEST['azione']?>">
                        <input type="hidden" name="action" value="send_mail">
                        <button type="submit" class="btn btn-primary">Invia E-Mail</button>
                    </div>
                </form>
            <?}else{
                echo $msg;
                echo $script_msg;                
            }?>
            <div class="clearfix"></div>
            <?=$script_footer?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>