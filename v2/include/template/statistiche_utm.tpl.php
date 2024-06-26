<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<!-- Moment js  -->
<script type="text/javascript" src="<?=BASE_URL_SITO?>plugins/moment-2.29.1/moment-with-locales.js"></script>	
<!-- Date-range picker css  -->
<link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>plugins/daterangepicker/daterangepicker-bs3.css">       
<!-- Date-range picker js -->
<script type="text/javascript" src="<?=BASE_URL_SITO?>plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $(document).ready(function(){


                var highestBox = 400;
                var heigthRow = $("#rigaFatt").height();
                var heigthRowBlock = $("#rigaArrivi").height();
                var new_height = (highestBox - 50);
                    if(highestBox < heigthRowBlock){
                        $("#proposte_block").attr("style", "height:"+new_height+"px;overflow-y:auto;overflow-x:auto;");
                        $("#proposte_block").addClass("scroll");
                        $("#arrivi_block").attr("style", "height:"+new_height+"px;overflow-x:auto;");
                        $("#arrivi_block").addClass("scroll");			
                    }else{
                        $("#proposte_block").attr("style", "height:"+heigthRowBlock+"px;overflow-y:auto;overflow-x:auto;");
                        $("#proposte_block").addClass("scroll");
                        $("#arrivi_block").attr("style", "height:"+heigthRowBlock+"px;overflow-x:auto;");
                        $("#arrivi_block").addClass("scroll");							
                    }
                $(".row-eq-height").each(function() {
                    var heights = $(this).find(".col-eq-height").map(function() {
                    return $(this).outerHeight();
                        }).get(), maxHeight = Math.max.apply(null, heights);
                        $(this).find(".col-eq-height").outerHeight(maxHeight);
                });


                    moment.locale('it');
                    $('#demo').daterangepicker({
                        format: 'DD/MM/YYYY',
                        locale: { 
                            cancelLabel: 'Cancella',
                            applyLabel: 'Applica',
                            fromLabel: 'Da',
                            toLabel: 'A',
                            customRangeLabel: 'Imposta date',
                            daysOfWeek: [
                                                    'Do',
                                                    'Lu',
                                                    'Ma',
                                                    'Me',
                                                    'Gi',
                                                    'Ve',
                                                    'Sa'
                                            ],
                            monthNames: [
                                                    'Gennaio',
                                                    'Febbraio',
                                                    'Marzo',
                                                    'Aprile',
                                                    'Maggio',
                                                    'Giugno',
                                                    'Luglio',
                                                    'Agosto',
                                                    'Settembre',
                                                    'Ottobre',
                                                    'Novembre',
                                                    'Dicembre'
                                            ]
                    } ,
                    ranges: {
                                'Oggi': [moment(), moment()],
                                'Ieri': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Ultimi 7 Giorni': [moment().subtract(6, 'days'), moment()],
                                'Ultimi 30 Giorni': [moment().subtract(29, 'days'), moment()],
                                'Questo Mese': [moment().startOf('month'), moment().endOf('month')],
                                'Mese Precedente': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                                'Questo Anno': [moment().startOf('year'), moment().endOf('year')],
                                'Anno Precedente': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                            },
                    startDate: moment().startOf('year'),
                    endDate: moment()
                } ); 

            <?php if($_REQUEST['date']==''){?>
                $('#demo').val("01/01/<?=date('Y')?>" + ' - ' + "<?=date('d/m/Y')?>");
            <?}else{?>
                $('#demo').val("<?=$data_1_tmp?>" + ' - ' + "<?=$data_2_tmp?>");
            <?}?>


            $("#demo").on("change", function(){
                $("#statistiche").submit();
            });
    });
</script>
<style>
    .th {
        background-color: #00acc1 !important;
        border-right: 1px solid #ffffff;
        color: #fff !important;
    }
    .linea_border{
        border-top: 1px solid #000!important;
    }
</style>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
        <section class="content">  
            <div class="alert alert-profila  alert-default-profila alert-dismissable text-center text-black">    
            <p><b>LEGENDA:</b> i preventivi,  le prenotazioni e/o ..in trattativa se <b>cestinate</b> vengono escluse da qualsiasi calcolo statistico!</p>
                    <p>Per <b>non escludere</b> i preventivi, le prenotazioni e/o le conferme in trattativa dai moduli statistici è altamente consigliato <b>archiviarle</b>!</p>                                                                     
            </div> 
            <div class="box no-radius">
                <div class="box-body"> 
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
                       <!--  <div id="view_loading_statistiche"></div> -->
                        <div class="clearfix"></div>
        <h4 class="text-center"></h4>
            <div class="row">

                <div class="col-md-12">               
                    <div id="loadingQ"></div>
                    <div id="statisticheQ"></div>
                    <script>
                        $(document).ready(function() {
                            $("#loadingQ").html('<div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.svg"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del caricamento dati!</small></div>');
                            $.ajax({								 
                                type: "POST",								 
                                url: "<?=BASE_URL_SITO?>ajax/statistiche/statistiche_utm.php",								 
                                data: "idsito=<?=IDSITO?>&filter_query=<?=$filter_query?>&action=<?=$_REQUEST['action']?>&DataRichiesta_dal=<?=$DataRichiesta_dal?>&DataRichiesta_al=<?=$DataRichiesta_al?>",
                                dataType: "html",
                                    success: function(msg){
                                        $("#statisticheQ").html(msg);
                                        $("#loadingQ").hide();
                                    },
                                    error: function(){
                                        alert("Risultato non raggiunto, si prega di riprovare abbassando il range temporale!"); 
                                    }
                            });                        
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>  
    <script>
        $(document).ready(function() {
            $("#request_date").on("submit",function(){
                $("#view_loading_statistiche").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.svg"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>');
            });
        });
    </script>

  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
