<!-- Moment js  -->
<script type="text/javascript" src="<?=BASE_URL_SITO?>plugin/moment-2.29.1/moment-with-locales.js"></script>	
<!-- Date-range picker css  -->
<link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css">       
<!-- Date-range picker js -->
<script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
<script>
    $(document).ready(function(){

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
                $('#confronto').val("01/01/<?=(date('Y')-1)?>" + ' - ' + "<?=date('d/m').'/'.(date('Y')-1)?>");
            <?}else{?>
                $('#demo').val("<?=$data_1_tmp?>" + ' - ' + "<?=$data_2_tmp?>");
                $('#confronto').val("<?=$prima_data_it?>" + ' - ' + "<?=$seconda_data_it?>");
            <?}?>


            $("#demo").on("change", function(){
                $("#loading").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/loader.gif"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del caricamento dati!</small></div>');
                $('#confronto').val('');
                $("#statistiche").submit();
            });
    });
</script>