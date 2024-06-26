<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<?=$js_script?>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                                <div class="card-block">

        <div class="row">
        <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
            <div class="col-md-10">
            <?=$msg?>
            <h2>INVIA <?=NOME_CLIENT_EMAIL?> </h2>
            <p>Per questa settimana hai a tua disposizione ancora <label class="badge bg-orange ml-auto pointer" data-toogle="tooltip" title="" data-original-title="Numeri di invii disponibili"><?=$NumSend?></label> invii, oggi sei al <?=$GiornoSettimana?>° giorno della settimana. Gli invii settimanali non sono cumulabili!</p>                                             
                <div class="row">
                    <div class="col-md-12">
                        <form name="sel_modello" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" data-toogle="tooltip" title="Scegliere un modello di template"><i class="fa fa-fw fa-windows"></i></span>
                                
                                        <select name="id_template" id="id_template" class="form-control" onChange="window.document.sel_modello.submit();">
                                                <option value="">Scegli un modello</option>
                                                <?php echo $template ?>
                                        </select>     
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <form id="form_mail" name="form_mail" role="form" method="post" action="<?=$_SERVER['REQUEST_URI']?>">  
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group" id="list_group">
                                <span class="input-group-addon"  data-toogle="tooltip" title="Scegliere una lista alla quale inviare una newsletter!"><i class="fa fa-fw fa-list"></i></span>
                                <select name="id_lista" id="id_lista" class="form-control">
                                        <option value="">Scegli una lista</option>
                                        <?php echo $liste ?>
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-6" id="dest_group">
                        <div class="form-group">       
                            <div class="input-group">
                                    <span class="input-group-addon" data-toogle="tooltip" title="Inserire un unico destinatario, se si desidera inviare una sola e-mail!"><i class="fa fa-fw fa-user"></i></span>
                                    <input type="text" id="destinatario" name="destinatario" placeholder="Destinatario singolo" class="form-control no_border_top_dx bold">   
                            </div>
                            <span id="check_email"></span>
                            <?
                                if(check_configurazioni(IDSITO,'check_verify_email')== 1){
                                    echo $js_Check_email;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?=$js_script_select?>
                <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"  data-toogle="tooltip" title="Inserire un oggetto"><i class="fa fa-fw fa-pencil"></i></span>
                            <input type="text" id="oggetto" name="oggetto" placeholder="Oggetto:[cliente]" class="form-control no_border_top_dx bold" value="<?=$oggetto?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Contenuto E-mail</label>
                        <div class="alert alert-profila alert-default-profila alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p> E' possibile personalizzare il testo del messaggio inserendo la variabile <b>[cliente]</b> e la variabile <b>[struttura]</b>, le variabili funzionano solo se si usa una lista di nominativi e non un destinatario singolo!</p>                                             
                            <p>Al momento dell'invio dell'email <?=NOME_CLIENT_EMAIL?>, il sistema sostituirà [cliente] con il nome ed il cognome del contatto e [struttura] con l'intestazione della vostra attività.</p>
                            <p>In <?=NOME_CLIENT_EMAIL?> <b class="text-red">NON è possibile</b> usare gli short tag [proposta] e/o [servizi], perchè gli iscritti sono nominativi anagrafici e non richieste di preventivo!</p>
                            <p>Questa sezione di <?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> è un vero e proprio modulo da utilizzare per operazioni di mail marketing!</p>
                        </div> 
                </div>
                <div id="view_mail_loading"></div>
                    <div id="content_mail">
                        <div class="form-group">
                                <div class="clearfix"></div>
                                <textarea name="testo" class="form-control"  id="testo"><?=$testo?></textarea> 
                                <?=$js_script_editor?>    
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="action" value="send_mail">
                            <input type="hidden" name="data_invio" value="<?=date('Y-m-d H:i:s')?>">
                            <input type="hidden" name="id_template" value="<?=$_REQUEST['id_template']?>">
                            <input type="hidden" name="lingua" value="<?=$lingua?>">
                            <button type="submit" class="btn btn-primary" id="bottone_salva">Invia email di <?=NOME_CLIENT_EMAIL?></button>
                        </div>
                    </div>
                <div class="alert alert-profila alert-default-profila alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>Una volta cliccato il pulsante di "Invia email di <?=NOME_CLIENT_EMAIL?>", attendere il termine dell'operazione prima di uscire da questa schermata!</p>
                </div>      
            </div>
        </div>
        </form>  
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