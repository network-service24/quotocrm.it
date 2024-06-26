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
                                                <p class="f-w-600">Gestione Gallerie Immagini</p>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                        </button> 
                                                    </div>
                                                    <div class="clearfix p-b-10"></div>
                                                    <div class="alert alert-default text-black" id="legenda"  style="display:none">
                                                    <b class="f-12">LEGENDA:</b> 
                                                        <p class="f-12"> Dimensione max accettata: 2.048 KByte (2MB) e 32 DPI di risoluzione (Formato Web)!!</p>
                                                        <p class="f-12"> Perchè la gallery possa avere un aspetto uniforme, vi consigliamo di salvare tutte le immagini della stessa dimensione.</p>
                                                        <p class="f-12"> La photogallery, nella landing page apparirà in ordine Random, ossia ad ogni apertura della pagina l'ordinamento delle immagini cambierà in maniera casuale!</p>
                                                    </div>
                                                    <script>
                                                            $(document).ready(function(){
                                                                $("#closeButtonBoxInfo").hide();
                                                                $("#closeButtonBoxInfo").on("click",function(){
                                                                        $("#closeButtonBoxInfo").hide();
                                                                        $("#openButtonBoxInfo").show();
                                                                        $("#legenda").hide(300);                           
                                                                });
                                                                $("#openButtonBoxInfo").on("click",function(){
                                                                        $("#openButtonBoxInfo").hide();
                                                                        $("#closeButtonBoxInfo").show();
                                                                        $("#legenda").show(300);                           
                                                                });
                                                            })
                                                        </script>
                                                    <div class="clearfix p-b-10"></div>
                                                    <div class="row"><div class="col-md-12 text-center">Galleria dedicata al template <b>"Default"</b>, Il limite massimo di Immagini è <label class="badge badge-danger f-18" id="count_infobox">12</label> </div></div>
                                                    <div class="clearfix p-b-10"></div>
                                                    <?php   echo $content; ?>
                                                    <div class="clearfix p-b-30"></div>
                                                    <p class="p-b-10 f-w-600"> Gestione gallerie immagini per target (<em>personalizzabili</em>), associate ai template con la stessa denominazione!</p>
                                                    <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo2">
                                                            Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo2">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                        </button> 
                                                    </div>
                                                    <div class="clearfix p-b-10"></div>
                                                    <div class="alert alert-default text-black" id="legenda2"  style="display:none"> 
                                                    <b class="f-12">LEGENDA:</b>   
                                                        <p class="f-12"> Le photogallery per Target, saranno associate automaticamente ai template landing page relativi! Per inserire le immagini in ogni Target Gallery, entra in "Gestione galleria"!</p>
                                                        <p class="f-12"> <b>ATTENZIONE:</b> modificando il <b>Target Gallery</b>, contemporaneamente andrete a rinominare anche il nome del <b>"Nome Template"</b> ed il nome dei <b>"Contenuti Landing page per target"</b>, associati al target stesso!</p>
                                                        <p class="f-12"> <b>ATTENZIONE:</b> inserire il nome della gallery <b>senza</b>, trattini ,underscore, spazi o caratteri particolari!</p>
                                                        <p class="f-12"> <b>ATTENZIONE:</b> ricorda che le gallery associate ai <b>nuovi template</b> devono contenere un <b>minimo di <span class="f-14">9</span> immagini</b>, diversamente la foto gallery nel nuovo template <b class="f-14">non appare</b>!!</p>
                                                    </div>
                                                    <script>
                                                            $(document).ready(function(){
                                                                $("#closeButtonBoxInfo2").hide();
                                                                $("#closeButtonBoxInfo2").on("click",function(){
                                                                        $("#closeButtonBoxInfo2").hide();
                                                                        $("#openButtonBoxInfo2").show();
                                                                        $("#legenda2").hide(300);                           
                                                                });
                                                                $("#openButtonBoxInfo2").on("click",function(){
                                                                        $("#openButtonBoxInfo2").hide();
                                                                        $("#closeButtonBoxInfo2").show();
                                                                        $("#legenda2").show(300);                           
                                                                });
                                                            })
                                                        </script>
                                                    <?php   echo $content2; ?>  
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