<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

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
                                                    <h4>Tabella relazionale QUOTO</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                            <a href="<?=BASE_URL_ADMIN?>report/dashboard_report/"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="<?=$_SERVER['REQUEST_URI']?>">Tabella relazionale QUOTO</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>
                                                        Relazione tra tutte le richieste QUOTO e tabella analytics <small>&#10230;Telefono per campagna</small>!
                                                </h5> 
                                                <br><br>                                             
                                                <p class="f-12 text-center">
                                                    La lista è composta dalle prenotazioni e le conferme presenti in QUOTO che hanno la relazione con il numero di telefono dalla tabella&#10230;telefono per campagna, al loro interno!
                                                </p>  
                                                <div class="alert alert-warning text-black f-12">
                                                    <ul class="f-12 text-center">
                                                        <li>FORMATO DEL FILE CSV DA RISPETTARE</li>
                                                        <li>COLONNE: <b>Ora di inizio, Codice Paese chiamante, Numero di telefono del chiamante, Campagna, Gruppo di annunci</b></li>
                                                        <li><i class="fa fa-exclamation-triangle text-red"></i> ATTENZIONE: </li>
                                                        <li>Se non dovessero esserci corrispondenze <b  class="text-red">il loading gira all'infinito</b> senza restituire risultati (ossia se la query che relaziona la tabella delle prenotazione e la tabella dei numeri di telefono, non da esito positivo!) </li>
                                                        <li>Se inserite un formato errato in CSV lo script salta totalmente, danneggiando anche il tempo di caricamento per gli altri clienti</li>
                                                    </ul>
                                                </div>                                                                                      
                                            </div>
                                                <div class="card-block">     
                                                    <?php 
                                                        if($_POST['save_ok'] == 1){ 
                                                            echo'   <div class="row">                                                    
                                                                        <div class="col-md-5">
                                                                            <div class="alert alert-info" id="result_save_file">File salvato con successo!</div>
                                                                        </div>
                                                                    </div>'."\r\n";
                                                            echo'   <script>
                                                                        $(document).ready(function(){
                                                                            setTimeout (function () {
                                                                                $("#result_save_file").hide("slow");
                                                                              }, 2000);
                                                                        });
                                                                    </script>'."\r\n";
                                                        }  
                                                    ?>                                         
                                                            <form name="sync_csv" id="sync_csv" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">        
                                                                <div class="row">  
                                                                <div class="col-md-1"></div>                                                  
                                                                    <div class="col-md-3">
                                                                        <style>

                                                                            .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                                                background-color: #FFFFFF!important;
                                                                            }
                                                                        </style> 
                                                                        <select name="idsito" id="idsito" class="form-control js-example-data-array"></select>
                                                                    </div>
                                                                    <div class="col-md-4 text-right">
                                                                    
                                                                            <div class="row">                                                            
                                                                                <div class="col-md-1 text-right">&nbsp;</div>
                                                                                <div class="col-md-8 text-right">  
                                                                                <div class="input-group">
                                                                                        <label class="input-group-btn">
                                                                                            <span class="btn btn-primary">
                                                                                                Browse&hellip; <input type="file" name="csv" style="display: none;">
                                                                                            </span>
                                                                                        </label>
                                                                                        <input type="text" name="filecsv" class="form-control" style="height:41px!important" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <input type="hidden" name="action" value="save_csv">
                                                                                    <button type="submit" class="btn btn-primary">Salva</button>
                                                                                </div>
                                                                                <div class="col-md-1">&nbsp;</div>
                                                                            </div>
                                                            </form>
                                                                <script>
                                                                    $(function() {
                                                                        var data = [{ id: 0, text: 'Seleziona Sito da sssociare al CSV da caricare!'},<?=$list?>];
                                                                                $(".js-example-data-array").select2({
                                                                                    data: data
                                                                                });
                                                                                $(".js-example-data-array2").select2();
                                                                        // Possiamo allegare l'evento `fileselect` a tutti gli input di file nella pagina
                                                                        $(document).on('change', ':file', function() {
                                                                            var input = $(this),
                                                                                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                                                                                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                                                                            input.trigger('fileselect', [numFiles, label]);
                                                                            });

                                                                            // Possiamo guardare il nostro evento personalizzato `fileselect` come questo 
                                                                            $(document).ready( function() {
                                                                                $(':file').on('fileselect', function(event, numFiles, label) {

                                                                                    var input = $(this).parents('.input-group').find(':text'),
                                                                                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                                                                                    if( input.length ) {
                                                                                        input.val(log);
                                                                                    } else {
                                                                                        if( log ) alert(log);
                                                                                    }

                                                                                });
                                                                            });

                                                                        });
                                                                </script>
                                                            </div>
                                                         
                                                            <div class="col-md-4 text-right">
                                                                <form name="filtro" id="filtro" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                    <div class="row">                                                            
                                                                        <div class="col-md-7 text-right">                                                               
                                                                            <select name="cl" id="cl" class="form-control js-example-data-array2" style="text-align:left!important">
                                                                                <option value="">Filtra per cliente i risultati</option>
                                                                                <?=$siti ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5 text-left">
                                                                            <button type="submit" class="btn btn-primary">Filtra</button>
                                                                        </div>
                                                                        <style>
                                                                            .select2-selection--single{
                                                                                text-align:left;
                                                                            }
                                                                        </style>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <div class="clearfix"></div>
                                                    <?=$output?>   
                                                    <? include_module('backtop.inc.php'); ?>                                      
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