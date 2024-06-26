<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO . 'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-details">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Dettagli</h4>
                    </div>
                    <div class="modal-body">
                        <table id="modal-details-table" class="datatable table table-striped table-bordered"></table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="box radius6">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 form-inline">
                        <div class="pull-right">
                            <div class="form-group mr-5">
                                <label for="filter_date_range">Periodo</label>
                                <input type="text" id="filter_date_range" name="filter_date_range" autocomplete="off" class="daterange form-control"
                                       value="<?php echo $startDate . ' - ' . $endDate ?>"/>
                            </div>
                            <label class="checkbox-inline mr-3">
                                <input type="checkbox" id="filter_compare" value="true" <?php if ($compare != 'false') echo 'checked="checked"' ?>> Confronta con
                            </label>
                            <select class="form-control mr-3" id="filter_compare_type">
                                <option value="period">Periodo precedente</option>
                                <option value="year">Anno precedente</option>
                                <option value="custom" selected="selected">Personalizzato</option>
                            </select>
                            <div class="form-group">
                                <label for="filter_date_range_compare"></label>
                                <input type="text" id="filter_date_range_compare" name="filter_date_range_compare" autocomplete="off" class="daterange form-control"
                                       value="<?php echo $compareStartDate . ' - ' . $compareEndDate ?>" <?php echo ($compare == 'true') ? '' : 'disabled="disabled"' ?> />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div style="height: 400px; position: relative">
                            <canvas id="chart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box radius6">
            <div class="box-body">
                <div id="tab-loading" class="loading"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <table id="table_stats" class="datatable table table-striped table-bordered" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Metodo di Contatto</th>
                                <th class="text-center">Richieste ricevute</th>
                                <th class="text-center">Preventivi inviati</th>
                                <th class="text-center">Prenotazioni confermate</th>
                                <th class="text-center">Conversione %</th>
                                <th class="text-center">Fatturato</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td>TOTALE</td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center"><small><i class="fa fa-exclamation-circle text-info"></i> <b>Potrebbero</b> esserci delle leggere discrepanze tra il <b>totale fatturato</b> degli InfoBox nella Dashboard e l'attuale schermata, perchè questi dati tengono conto dell'interazione con Google Analytics, mentre il Fatturato totale della Dashboard è la risultate di tutte le prenotazioni di QUOTO!</small></div>
        <div class="box radius6 mt-5">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border pointer-hover" data-toggle="collapse" data-target="#wrap_table_stats_other">
                                <h3 class="box-title">Annullate dall'operatore</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#wrap_table_stats_other"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body collapse" id="wrap_table_stats_other">
                                <table id="table_stats_annulled" class="datatable table table-striped table-bordered" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Metodo di Contatto</th>
                                        <th class="text-right">Prenotazioni Annullate</th>
                                        <th class="text-right">Importo</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td>TOTALE</td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_URL_SITO ?>plugins/daterangepicker-3.1.0/daterangepicker.css"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_URL_SITO ?>plugins/datatables/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_URL_SITO ?>plugins/datatables/dataTables.bootstrap.css"/>

<script>
    // Mi salvo il jQuery originale per cambiarlo e poi riprenderlo
    var jQueryOriginal = jQuery || $ || window.jQuery;
</script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/jquery-3.3.1/jquery.js"></script>
<script type="text/javascript">
    // sostituisco jQuery con una versione aggiornata
    var j = jQuery.noConflict();
</script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/moment-2.29.1/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/daterangepicker-3.1.0/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/chartjs-3.4.1/chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/chartjs-adapter-moment-1.0.0/chartjs-adapter-moment-1.0.0.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_SITO ?>js/config-and-utils.js"></script>

<script>
    j(function () {
        //region Configurazioni, Eventi, utils
        moment.locale('it');
        let dateRangeOptions = getDateRangeOptions();

        // checkbox "Confronta" abilita\disabilita datepicker e setta il periodo precedente
        j("#filter_compare").click(function (el) {
            let isDisabled = (!this.checked) || ((this.checked) && (j('#filter_compare_type').children('option:selected').val() !== 'custom'));
            j('#filter_date_range_compare').prop("disabled", isDisabled);
            updateCompareDate();
            updateChart();
            updateTable();
            updateTableAnnulled();
        });

        // Select del tipo di confronto
        j("#filter_compare_type").change(function () {
            let isDisabled = (!j("#filter_compare").is(':checked')) || ((j("#filter_compare").is(':checked')) && (j(this).val() !== 'custom'));

            j('#filter_date_range_compare').prop("disabled", isDisabled);
            updateCompareDate();
            updateChart();
            updateTable();
            updateTableAnnulled();
        });

        let filter_date_range = j('#filter_date_range').daterangepicker(dateRangeOptions, function (start, end, label) {
            //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            updateCompareDate(start, end);

            // Chiamata per aggiornare i dati del grafico
            updateChart(false, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));

            // Chiamata per aggiornare i dati della tabella principale
            updateTable(false, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));

            // Chiamata per aggiornare i dati della tabella annullate
            updateTableAnnulled(false, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));

        });
        let filter_date_range_compare = j('#filter_date_range_compare').daterangepicker(dateRangeOptions, function (start, end, label) {
            // Chiamata per aggiornare i dati del grafico
            updateChart(true, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            updateTable(true, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            updateTableAnnulled(true, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });
        //endregion Configurazioni ed Eventi

        //region GRAFICO
        let chartData = getChartData();
        const chartConfig = getChartConfig(chartData);

        const chart = new Chart(
            document.getElementById('chart'),
            chartConfig
        );

        function updateChart(isCompare, start, end) {
            const startDate = ((!isCompare) && (typeof start !== 'undefined')) ? start : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const endDate = ((!isCompare) && (typeof end !== 'undefined')) ? end : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const compare = !!j('#filter_compare').prop("checked");
            const compareStartDate = ((isCompare) && (typeof start !== 'undefined')) ? start : moment(j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const compareEndDate = ((isCompare) && (typeof end !== 'undefined')) ? end : moment(j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');

            j.post({
                url: '<?php echo BASE_URL_SITO ?>ajax/statistiche_new_graph.php',
                data: {
                    'id_sito': <?php echo IDSITO ?>,
                    'start': startDate,
                    'end': endDate,
                    'compare': compare,
                    'compare_start': compareStartDate,
                    'compare_end': compareEndDate,
                },
                dataType: 'json',
                success: function (result) {
                    //console.log("updateChart ajax result:", result);
                    if (result && result[0].length) {
                        // calcolo delle etichette combinate
                        let labels = result[0].map(x => x.data);
                        if (compare) {
                            let labelsCompare = result[1].map(x => x.data);
                            for (let i = 0; i < labelsCompare.length; i++) {
                                if (i < labels.length) {
                                    labels[i] = labels[i] + "#" + labelsCompare[i];
                                } else {
                                    labels.push(labelsCompare[i]); // se il periodo di confronto è più lungo aggiungo in coda le date (sballa il grafico)
                                }
                            }
                        }
                        //console.log("labels=", labels);

                        chart.data.labels = labels;

                        if (result[0].length > 0)
                            chart.data.datasets[0].data = result[0].map(x => x.fatturato);

                        if (compare && result[1].length > 0) {
                            if (chart.data.datasets.length === 1) {
                                const newDataset = {
                                    label: 'Confronto',
                                    backgroundColor: 'rgb(255,99,99)',
                                    borderColor: 'rgb(237,126,23)',
                                    data: []
                                }
                                chart.data.datasets.push(newDataset);
                            }
                            chart.data.datasets[1].data = result[1].map(x => x.fatturato);
                        } else {
                            if (chart.data.datasets.length > 1) {
                                chart.data.datasets.pop();
                            }
                        }
                    } else {
                        chart.data.datasets[0].data = [];
                    }
                    chart.update();
                }
            });
        }

        //endregion GRAFICO

        //region TABELLA PRINCIPALE
        j("#tab-loading").fadeIn();
        let dataTableConfig = getDataTableConfig('<?php echo BASE_URL_SITO ?>');
        dataTableConfig.columnDefs = [
            {targets: [1, 2, 3, 4, 5], className: 'dt-body-right'},
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        if (data.toLowerCase().indexOf('sito web') !== -1) {
                            const startDate = j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[0];
                            const endDate = j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[1]
                            const compare = !!j('#filter_compare').prop("checked");
                            const compareStartDate = j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[0];
                            const compareEndDate = j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[1];

                            const params = {
                                'method': encodeURIComponent(data),
                                'startDate': encodeURIComponent(startDate),
                                'endDate': encodeURIComponent(endDate),
                                'compare': encodeURIComponent(compare),
                                'compareStartDate': encodeURIComponent(compareStartDate),
                                'compareEndDate': encodeURIComponent(compareEndDate),
                            }
                            data = '<a href="<?php echo BASE_URL_SITO ?>grafici-statistiche_new_detail/&' + encodeQueryData(params) + '">' + data + '</a>';
                        }
                    }

                    return data;
                }
            }, {
                targets: [5],
                render: function (data, type, row, meta) {
                    return prefixEuro(data);
                }
            }, {
                targets: [1, 2, 3],
                render: function (data, type, row, meta) {
                    return '<a class="show-detail" href="#" data-col="' + meta.col + '" data-row="' + meta.row + '">' + data + '</a>';
                }
            }
        ];
        dataTableConfig.footerCallback = function (row, data, start, end, display) {
            let api = this.api();
            api.columns([1, 2, 3], {page: 'current'}).every(function () {
                calculateFooterSum(this, 0);
            });
            api.columns([4], {page: 'current'}).every(function () {
                calculateFooterConversionPerc(this, 2, 3);
            });
            api.columns([5], {page: 'current'}).every(function () {
                calculateFooterSum(this, 2, false, '€ ');
            });
        };
        let tableStats = j('#table_stats').DataTable(dataTableConfig);

        function updateTable(isCompare, start, end) {
            const startDate = ((!isCompare) && (typeof start !== 'undefined')) ? start : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const endDate = ((!isCompare) && (typeof end !== 'undefined')) ? end : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const compare = !!j('#filter_compare').prop("checked");
            const compareStartDate = ((isCompare) && (typeof start !== 'undefined')) ? start : moment(j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const compareEndDate = ((isCompare) && (typeof end !== 'undefined')) ? end : moment(j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');

            j("#tab-loading").fadeIn();
            j.post({
                url: '<?php echo BASE_URL_SITO ?>ajax/statistiche_new_table.php',
                data: {
                    'id_sito': <?php echo IDSITO ?>,
                    'start': startDate,
                    'end': endDate,
                    'compare': compare,
                    'compare_start': compareStartDate,
                    'compare_end': compareEndDate,
                },
                dataType: 'json',
                success: function (result) {
                    //console.log("updateTable ajax result:", result);

                    tableStats.clear();
                    if (result && result.data && result.data.length > 0) {
                        tableStats.rows.add(result.data);
                    }
                    tableStats.draw();
                    j('#tab-loading').fadeOut();
                }
            })
                .fail(function (err) {
                    j('#tab-loading').fadeOut();
                });
        }

        //endregion TABELLA PRINCIPALE

        //region TABELLA ANNULLATE
        let annulledTableConfig = getDataTableConfig('<?php echo BASE_URL_SITO ?>');
        annulledTableConfig.columnDefs = [
            {className: 'dt-body-right', targets: [1, 2]},
            {
                targets: [2],
                render: function (data, type, row, meta) {
                    return prefixEuro(data);
                }
            }
        ];
        annulledTableConfig.footerCallback = function (row, data, start, end, display) {
            let api = this.api();

            api.columns([1], {page: 'current'}).every(function () {
                calculateFooterSum(this, 0);
            });
            api.columns([2], {page: 'current'}).every(function () {
                calculateFooterSum(this, 2, false, '€ ');
            });
        };
        let tableAnnulled = j('#table_stats_annulled').DataTable(annulledTableConfig);

        function updateTableAnnulled(isCompare, start, end) {
            const startDate = ((!isCompare) && (typeof start !== 'undefined')) ? start : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const endDate = ((!isCompare) && (typeof end !== 'undefined')) ? end : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const compare = !!j('#filter_compare').prop("checked");
            const compareStartDate = ((isCompare) && (typeof start !== 'undefined')) ? start : moment(j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const compareEndDate = ((isCompare) && (typeof end !== 'undefined')) ? end : moment(j('#filter_date_range_compare').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');

            j.post({
                url: '<?php echo BASE_URL_SITO ?>ajax/statistiche_new_table.php',
                data: {
                    'id_sito': <?php echo IDSITO ?>,
                    'start': startDate,
                    'filter': 'annulled',
                    'end': endDate,
                    'compare': compare,
                    'compare_start': compareStartDate,
                    'compare_end': compareEndDate,
                },
                dataType: 'json',
                success: function (result) {
                    //console.log("updateTableAnnulled ajax result:", result);

                    tableAnnulled.clear();
                    if (result && result.data && result.data.length) {
                        tableAnnulled.rows.add(result.data);
                    }
                    tableAnnulled.draw();
                }
            });
        }

        //endregion TABELLA ANNULLATE

        // MODAL DETTAGLI
        j('body').on('click', '.show-detail', function () {
            const colIndex = j(this).data('col');
            const rowIndex = j(this).data('row');
            const row = j(this).closest('tr');

            const startDate = moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const endDate = moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format).format('YYYY-MM-DD');
            const method = row.find('td:eq(0)').text();
            const type = colIndex == 1 ? 'richieste' : colIndex == 2 ? 'inviati' : colIndex == 3 ? 'confermati' : '';
            const idSito = <?php echo $_SESSION['IDSITO'] ?>;
            const idUtente = <?php echo $_SESSION['utente']['idutente'] ?>;

            const params = {
                'idSito': encodeURIComponent(idSito),
                'idUtente': encodeURIComponent(idUtente),
                'method': encodeURIComponent(method),
                'type': encodeURIComponent(type),
                'startDate': encodeURIComponent(startDate),
                'endDate': encodeURIComponent(endDate),
            }

            j('#modal-details-table').DataTable({
                ajax: '<?php echo BASE_URL_SITO ?>ajax/statistiche_new_details.php/?' + encodeQueryData(params),
                destroy: true,
                columns: [
                    {title: "Id"},
                    {title: "Num. Prenotazione"},
                    {title: "Data"},
                    {title: "Prezzo"},
                    {title: "Canale"},
                    {title: "Campagna"},
                    {title: "Analytics", class: "text-center"}
                ]
            });

            $('#modal-details').modal('show');
            return false;
        });

        /* INIZIALIZZAZIONE */
        updateChart();
        updateTable();
        updateTableAnnulled();
    });
</script>

<style>
    span.compare {
        display: inline-block;
        width: 50%;
    }

    .text-compare {
        color: rgb(237, 126, 23) !important;
    }

    .pointer-hover:hover {
        cursor: pointer !important;
    }

    .datatable tfoot td {
        font-weight: bold;
        padding: 8px 10px !important;
    }
</style>

<script>
    // ripristino il jQuery originale
    jQuery = window.jQuery = $ = jQueryOriginal;
</script>
<?php include_module('footer.inc.php'); ?>
