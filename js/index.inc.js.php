<!-- Moment js  -->
<script type="text/javascript" src="<?=BASE_URL_SITO?>plugin/moment-2.29.1/moment-with-locales.js"></script>	
<!-- Date-range picker css  -->
<link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css">       
<!-- Date-range picker js -->
<script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
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

                function print_leadtime(){

                        $("#leadtime_pre").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:180px;height:auto" />');

                        $("#leadtime").load("<?=BASE_URL_SITO?>ajax/generici/load_leadtime.php?idsito=<?=IDSITO?>&p_data=<?=$prima_data?>&s_data=<?=$seconda_data?>", function() {
                            $("#leadtime_pre").hide();
                        });
                }

                print_leadtime();

                function booking_window(){

                    $("#bookingwindow_pre").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:180px;height:auto" />');

                    $("#bookingwindow").load("<?=BASE_URL_SITO?>ajax/generici/load_booking_window.php?idsito=<?=IDSITO?>&p_data=<?=$prima_data?>&s_data=<?=$seconda_data?>", function() {
                        $("#bookingwindow_pre").hide();
                    });
                }
                
                booking_window();



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

    /**
    ** Alert Info Notification
    ** Segnala la possibilità di archiare tutti gli anni
    ** un singolo evento!!
    */
    <?php   if(ANNO_ATTIVAZIONE != date('Y')){ ?>
        'use strict';
            $(window).on('load',function(){
                //Welcome Message (not for login page)
                function notify(message, type){
                    $.growl({
                        message: message
                    },{
                        type: type,
                        allow_dismiss: false,
                        label: '',
                        className: '',
                        placement: {
                            from: 'top',
                            align: 'center'
                        },
                        delay: 10000,
                        animate: {
                                enter: 'animated fadeInRight',
                                exit: 'animated fadeInRight'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        }
                    });
                };
            if(leggiCookie('alert_archivia_anno')) {
                return false;
            }else{
                setTimeout(function(){ 
                    notify(                    
                        '<div data-growl="container" class="alert alert-inverse m-b-0 m-t-0 m-l-0 m-r-0 p-b-0 p-t-0 p-l-0 p-r-0" role="alert"  style="margin-bottom:-5px!important;">' +
                        '<button type="button" class="close p-r-0" data-growl="dismiss">' +
                        '<i class="fa fa-times text-white p-l-20"></i>' +
                        '</button>' +
                        '<span data-growl="message" class="p-r-20 p-b-0 m-b-0 m-t-0 m-l-0 m-r-0">Entrando nella voce di menu "Archiviate per anno", potete archiviare tutte le proposte degli anni scorsi.<br> Così facendo l\'uso di QUOTO (Preventivi, ...in trattativa,Prenotazioni) sarà molto più snello e veloce!</span>' +
                        '</div>',
                    'inverse');
                }, 1500);
                scriviCookie('alert_archivia_anno','archivio','60');
            }
            });
    <?}?>
</script>