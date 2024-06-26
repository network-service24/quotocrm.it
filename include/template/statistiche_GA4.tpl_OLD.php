<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<?php include(BASE_PATH_SITO.'js/statistiche_GA4.inc.js.php');?>  

<style>
.table td, .table th {
    padding: 10px !important;
    vertical-align: top !important;
    border: 0px 0px 0px 0px !important;
}
</style>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                        <? include_module('breadcrumb.inc.php'); ?>
                                                <div class="page-body">
                                                                <div class="alert alert-default text-center text-black">
                                                                    <ul>
                                                                        <li><b>LEGENDA:</b> le prenotazioni e/o ..in trattativa se <b>cestinate</b> oppure <b>disdette, annullate</b>, vengono <b>escluse</b> da qualsiasi modulo statistico!</li>
                                                                        <li>Per <b>non escludere</b> le prenotazioni e/o le conferme in trattativa dai moduli statistici è altamente consigliato <b>archiviarle</b>!</li>
                                                                        <li>La <b>sincronizzazione</b> dei dati con <b>Analytics GA4</b> ha <b>48 ore di scarto</b>, per esempio: se un preventivo e/o una prenotazione proveniente da "Sito Web -> campagna marketing" entrata il 01-00-0000 sarà visibile nel modulo statistico di GA4 il 03-00-0000</li>  
                                                                    </ul>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-block">
                                                                        <div class="row">
                                                                            <div class="col-md-3"></div>
                                                                            <div class="col-md-2 text-right"> <label> Periodo</label> <i class="fa fa-question-circle" data-toggle="tooltip" Title="Se a causa di una mole di dati piuttosto consistente, il filtro non riuscisse ad elaborare la query, abbassare il range temporale"></i></div>
                                                                            <div class="col-md-2">                                                           
                                                                                <form id="statistiche" name="statistiche" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                                    <div class="form-group">
                                                                                            <input placeholder="Imposta una query di ricerca" class="form-control periodo" id="demo" name="date" type="text" autocomplete="off">
                                                                                    </div>
                                                                                    <input type="hidden" name="action" value="request_date">
                                                                                </form>                                                                    
                                                                            </div>
                                                                            <div class="col-md-5 text-right"></div>
                                                                        </div>
                                                                        <div class="clearfix p-b-20"></div>
                                                                            <?=$output?>
                                                                    </div>
                                                                </div>                                                             
                                                                <?php if (array_values($array_fatturatoD) > 0) {?>
                                                                    <div class="card">
                                                                        <div class="card-block"> 
                                                                            <div class="row">
                                                                                <div class="col-md-8"> Conferme Annullate dall'operatore</div>
                                                                                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_annullate" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
                                                                            </div>
                                                                            <div class="clearfix p-b-10"></div>
                                                                                <div id="annullate" style="display:none">
                                                                                    <?=$outputA?>
                                                                                </div> 
                                                                                <script>
                                                                                    $(document).ready(function(){
                                                                                        $("#attiva_annullate").on("click",function(){
                                                                                        $("#annullate").slideToggle("slow");
                                                                                        })
                                                                                    })
                                                                                </script>
                                                                        </div>
                                                                    </div>
                                                                <?}?>
                                                                <?php if (isset($array_fatturatoTARGET)) {?>
                                                                    <div class="card">
                                                                        <div class="card-block"> 
                                                                            <div class="row">
                                                                                <div class="col-md-8"> Fatturato per Target Cliente</div>
                                                                                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_target" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
                                                                            </div>
                                                                            <div class="clearfix p-b-10"></div>
                                                                                <div id="target" style="display:none">
                                                                                    <?=$outputTA?>
                                                                                </div> 
                                                                                <script>
                                                                                    $(document).ready(function(){
                                                                                        $("#attiva_target").on("click",function(){
                                                                                        $("#target").slideToggle("slow");
                                                                                        })
                                                                                    })
                                                                                </script>
                                                                        </div>
                                                                    </div>                                                                     
                                                                <?}?>
                                                                <?php if (array_values($array_fatturatoOperatore) > 0){?>
                                                                    <div class="card">
                                                                        <div class="card-block"> 
                                                                            <div class="row">
                                                                                <div class="col-md-8"> Fatturato per Operatore</div>
                                                                                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_operatori" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
                                                                            </div>
                                                                            <div class="clearfix p-b-10"></div>
                                                                                <div id="operatori" style="display:none">
                                                                                    <?=$outputOP?>
                                                                                </div> 
                                                                                    <script>
                                                                                        $(document).ready(function(){
                                                                                            $("#attiva_operatori").on("click",function(){
                                                                                            $("#operatori").slideToggle("slow");
                                                                                                if($("#operatori").prop('display','none')){
                                                                                                    $("#minus_operatori").hide();
                                                                                                    $("#plus_operatori").show();
                                                                                                }else{
                                                                                                    $("#plus_operatori").hide();
                                                                                                    $("#minus_operatori").show();
                                                                                                }
                                                                                            })
                                                                                        })
                                                                                    </script>
                                                                        </div>
                                                                    </div> 
                                                                <?}?>
                                                                <?php if(array_values($array_fatturatoTemplate) > 0){?>
                                                                    <div class="card">
                                                                        <div class="card-block"> 
                                                                            <div class="row">
                                                                                <div class="col-md-8"> Fatturato per Template Landing Page</div>
                                                                                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_template" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
                                                                            </div>
                                                                            <div class="clearfix p-b-10"></div>
                                                                            <div id="template" style="display:none">
                                                                                <?=$outputTP?>
                                                                            </div> 
                                                                            <script>
                                                                                $(document).ready(function(){
                                                                                    $("#attiva_template").on("click",function(){
                                                                                    $("#template").slideToggle("slow");
                                                                                    })
                                                                                })
                                                                            </script>
                                                                        </div>
                                                                    </div>  
                                                                <?}?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>