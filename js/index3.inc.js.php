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

                        $("#leadtime_pre").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta calcolando il tuo <b>LeadTime</b>, attendere...!');

                        $("#leadtime").load("<?=BASE_URL_SITO?>ajax/generici/load_leadtime2.php?idsito=<?=IDSITO?>&p_data=<?=$prima_data?>&s_data=<?=$seconda_data?>", function() {
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
                $('#demo').val('');
                //$('#demo').val("01/01/<?=date('Y')?>" + ' - ' + "<?=date('d/m/Y')?>");
                //$("#statistiche").submit();
            <?}else{?>
                $('#demo').val("<?=$data_1_tmp?>" + ' - ' + "<?=$data_2_tmp?>");
            <?}?>


            $("#demo").on("change", function(){
                $("#statistiche").submit();
            });
    });
</script>