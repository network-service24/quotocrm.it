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
    <?php include(BASE_PATH_SITO . 'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">

                <div class="alert alert-profila  alert-default-profila alert-dismissable text-center text-black">
                <p><b>LEGENDA:</b> i preventivi,  le prenotazioni e/o ..in trattativa se <b>cestinate</b> vengono escluse da qualsiasi calcolo statistico!</p>
                    <p>Per <b>non escludere</b> i preventivi, le prenotazioni e/o le conferme in trattativa dai moduli statistici è altamente consigliato <b>archiviarle</b>!</p> 
                </div>

            <div class="box radius6">
                <div class="box-body">
                <div class="row">
                    <div class="col-md-3"><a href="<?=BASE_URL_SITO?>grafici-statistiche_utm/" class="btn btn-default">&lt;&lt; Vai alla statistiche</a></div>
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
                <div id="view_loading_statistiche"></div>
                <?= $js_load ?>
                <h4 class="text-center"><i class="fa fa-facebook-square fa-2x" style="color:#3B5897"></i>  Fonte di prenotazione <b>Facebook Ads</b>: per campagne social. <small>(tracciabilità ottenuta da UTM QUOTO)</small></h4>                           
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $legendaSn_BOX ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
</section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
