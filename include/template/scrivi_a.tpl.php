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
                                                        <h5>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    Scrivi al tuo ospite per richiedere una recensione
                                                                </div>
                                                                <div class="col-md-2 text-right">
                                                                    <?=$pulsante_indietro?>
                                                                </div>
                                                            </div>
                                                        </h5>
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
                                                            <div class="clearfix p-b-10"></div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-fw">Cc:</i></span>
                                                                        <input type="email" id="email_copia" name="email_copia" placeholder="Metti in copia"
                                                                            class="form-control no_border_top_dx bold">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix p-b-10"></div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                                        <input type="text" id="oggetto" name="oggetto" placeholder="Oggetto" class="form-control no_border_top_dx bold"
                                                                            value="<?=$oggetto?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           <div class="clearfix p-b-10"></div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea class="form-control Width100" id="testo_email"  name="testo_email" style="width:100%"><?=$testo_email?></textarea>
                                                                        <!-- Custom js -->
                                                                        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/ckeditor/ckeditor.js"></script>
                                                                        <script>    
                                                                                $(function() {
                                                                                        CKEDITOR.replace('testo_email'');
                                                                                        $(".textarea").wysihtml5();                                 
                                                                                });                                                                           
                                                                                CKEDITOR.config.toolbar = [
                                                                                            ['Source','-','Maximize'],
                                                                                            ['Bold','Italic','Underline','StrikeThrough','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Outdent','Indent','NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Table','Link','TextColor','BGColor'],
                                                                                        ] ; 
                                                                                CKEDITOR.config.autoGrow_onStartup = true;
                                                                                CKEDITOR.config.extraPlugins = 'autogrow';
                                                                                CKEDITOR.config.autoGrow_minHeight = 250;
                                                                                CKEDITOR.config.autoGrow_maxHeight = 500;
                                                                                CKEDITOR.config.width = 570;
                                                                                CKEDITOR.config.autoGrow_bottomSpace = 50;           
                                                                        </script>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix p-b-20"></div>
                                                            <div class="box-footer">
                                                                <input type="hidden" name="azione" value="<?=$_REQUEST['azione']?>">
                                                                <input type="hidden" name="action" value="send_mail">
                                                                <button type="submit" class="btn btn-primary btn-sm">Invia E-Mail</button>
                                                            </div>
                                                        </form>
                                                    <?}else{
                                                        echo $msg;
                                                        echo $script_msg;                
                                                    }?>
                                                    <div class="clearfix"></div>
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
