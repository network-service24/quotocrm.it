/**
 * Restituisce le opzioni di configurazione dei DateRange
 * @returns {{ranges: {"Scorso mese": *[], "Questo anno": *[], Ieri: *[], "Ultimi 30 giorni": (*)[], "Scorso anno": *[], "Ultimi 7 giorni": (*)[], "Questo mese": *[], Oggi: *[]}, opens: string, locale: {fromLabel: string, toLabel: string, cancelLabel: string, firstDay: number, applyLabel: string, format: string, daysOfWeek: string[], separator: string, customRangeLabel: string, weekLabel: string, monthNames: string[]}}}
 */
function getDateRangeOptions() {
    return {
        opens: 'left',
        locale: {
            format: 'DD MMM YYYY',
            separator: ' - ',
            applyLabel: 'Ok',
            cancelLabel: "Annulla",
            fromLabel: 'Dal',
            toLabel: 'Al',
            customRangeLabel: 'Personalizzato',
            weekLabel: 'W',
            daysOfWeek: ['Do', 'Lu', 'Ma', 'Me', 'Gi', 'Ve', 'Sa'],
            monthNames: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
            firstDay: 1
        },
        ranges: {
            'Oggi': [moment(), moment()],
            'Ieri': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimi 7 giorni': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
            'Ultimi 30 giorni': [moment().subtract(30, 'days'), moment().subtract(1, 'days')],
            'Questo mese': [moment().startOf('month'), moment().endOf('month')],
            'Scorso mese': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Questo anno': [moment().startOf('year'), moment().endOf('year')],
            'Scorso anno': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]

        }
    };
}

function getChartData() {
    return {
        labels: [],
        datasets: [{
            xAxisID: 'x',
            label: 'Fatturato',
            backgroundColor: 'rgba(5,141,199,0.1)',
            borderColor: 'rgb(5, 141, 199)',
            fill: true,
            data: [],
        }]
    };
}

function getChartConfig(chartData) {
    return {
        type: 'line',
        locale: 'it',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
                point: {
                    fill: true,
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4,
                    backgroundColor: 'rgb(5, 141, 199)'
                }
            },
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'week',
                        tooltipFormat: 'ddd DD MMM YYYY',
                        displayFormats: {
                            quarter: 'MMM YYYY',
                            day: 'DD/MM/YYYY'
                        },
                        parser: function (data) {
                            //console.log("scales parse data=", data);
                            if (data)
                                return data.indexOf('#') === -1 ? data : data.split("#")[0];

                            return data;
                        }
                    }
                },
            },
            plugins: {
                tooltip: {
                    enabled: true,
                    //mode: 'index', // index = visualizza entrambi i dataset contemporaneamente
                    callbacks: {
                        title: function (tooltipItems, data) {
                            //console.log("tooltipItems=", tooltipItems);
                            if (tooltipItems[0].datasetIndex === 0) {
                                return tooltipItems[0].label.indexOf('#') === -1 ? tooltipItems[0].label : tooltipItems[0].label.split("#")[0];
                            } else {
                                if (chart.data) {
                                    let dateStr = chart.data.labels[tooltipItems[0].dataIndex].split("#")[1];
                                    return moment(dateStr, 'YYYY-MM-DD').format('ddd DD MMM YYYY');
                                }
                            }
                            //return data.datasets[tooltipItems.datasetIndex].label + ': ' + tooltipItems.yLabel + ' €';
                        }
                    }
                },
            }
        }
    };
}

function getDataTableConfig(baseurl) {
    const dateRangeOptions = getDateRangeOptions();

    return {
        processing: true,
        paging: false,
        searching: false,
        pageLength: 10,
        ordering: false,
        aaSorting: [],
        //bSort: false,
        //stateSave: true,
        language: {
            url: baseurl + 'plugin/datatables/Italian.json',
        }
    }
}

function updateCompareDate(startDate, endDate) {
    let dateRangeOptions = getDateRangeOptions();

    let start = (typeof startDate !== 'undefined') ? startDate : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[0], dateRangeOptions.locale.format);
    let end = (typeof endDate !== 'undefined') ? endDate : moment(j('#filter_date_range').val().split(dateRangeOptions.locale.separator)[1], dateRangeOptions.locale.format);

    //periodo precedente
    if (j('#filter_compare_type').children('option:selected').val() === 'period') {
        let daysDiff = end.diff(start, 'days');
        let compareStart = moment(start);
        compareStart = compareStart.subtract(daysDiff, 'days');
        j('#filter_date_range_compare').val(compareStart.format(dateRangeOptions.locale.format) + dateRangeOptions.locale.separator + start.format(dateRangeOptions.locale.format));
    }
    //anno precedente
    else if (j('#filter_compare_type').children('option:selected').val() === 'year') {

        let newStart = moment(start);
        newStart = newStart.subtract(1, 'year');

        let newEnd = moment(end);
        newEnd = newEnd.subtract(1, 'year');

        j('#filter_date_range_compare').val(newStart.format(dateRangeOptions.locale.format) + dateRangeOptions.locale.separator + newEnd.format(dateRangeOptions.locale.format));
    } else {
        //alert("non implementato!");
    }
}

function calculateFooterSum(_this, decimals = 2, noCompare = false, prefix = '') {
    const compare = !!j('#filter_compare').prop("checked");
    if (compare && !noCompare) {
        let sum = _this
            .data()
            .reduce(function (a, b) {
                a = getColumnClearValue(a, false);
                b = getColumnClearValue(b, false);

                //console.log("{BRBDEV}[config-and-utils.js](calculateFooterSum) sum 1 | a=" + a + " | b =" + b);

                a = clearNumber(a);
                b = clearNumber(b);

                //console.log("{BRBDEV}[config-and-utils.js](calculateFooterSum) sum 2 | a=" + a + " | b =" + b);

                let x = parseFloat(a) || 0;
                let y = parseFloat(b) || 0;

                //console.log("{BRBDEV}[config-and-utils.js](calculateFooterSum) sum 3 | x=" + x + " | y =" + y);

                return x + y;
            }, 0);

        let sumCompare = _this
            .data()
            .reduce(function (a, b) {
                a = getColumnClearValue(a, true);
                b = getColumnClearValue(b, true);

                //console.log("{BRBDEV}[config-and-utils.js](calculateFooterSum) compareSum 1 | a=" + a + " | b =" + b);

                a = clearNumber(a);
                b = clearNumber(b);

                let x = parseFloat(a) || 0;
                let y = parseFloat(b) || 0;

                return x + y;
            }, 0);

        const sumPerc = (sum - sumCompare) / sumCompare * 100;
        let sumPercFormatted = number_format(sumPerc, 2, ',', ".");
        if (sumPerc > 0) {
            sumPercFormatted = ' <i class="ion ion-arrow-up-a text-success"></i> +' + sumPercFormatted;
        } else {
            sumPercFormatted = ' <i class="ion ion-arrow-down-a text-danger"></i> ' + sumPercFormatted;
        }

        const footerStrSumFormatted = number_format(sum, decimals, ',', ".");
        const footerStrCompare = ' <span class="compare text-compare" data-toggle="tooltip" title="' + prefix + number_format(sumCompare, decimals, ',', ".") + '">(' + sumPercFormatted + '%)</span>';

        const footerStr = prefix + footerStrSumFormatted + footerStrCompare;
        j(_this.footer()).html(footerStr);
    } else {
        let sum = _this
            .data()
            .reduce(function (a, b) {
                a = clearNumber(a);
                b = clearNumber(b);

                let x = parseFloat(a) || 0;
                let y = parseFloat(b) || 0;

                return x + y;
            }, 0);

        const footerStrFormatted = number_format(sum, decimals, ',', ".");
        j(_this.footer()).html(prefix + ' ' + footerStrFormatted);
    }
}

function calculateFooterConversionPerc(api, colInviatiIndex, colConfermatiIndex, forceNoCompare = false) {
    const compare = !!j('#filter_compare').prop("checked");
    if (compare && !forceNoCompare) {
        // Valori senza compare
        let totInviatiHml = j(api.column(colInviatiIndex).footer()).html();
        let totInviati = getColumnClearValue(totInviatiHml, false);
        totInviati = clearNumber(totInviati);
        if (totInviatiHml && totInviatiHml.length) totInviati = parseFloat(totInviati) || 0;

        let totConfermatiHtml = j(api.column(colConfermatiIndex).footer()).html();
        let totConfermati = getColumnClearValue(totConfermatiHtml, false);
        totConfermati = clearNumber(totConfermati);
        if (totConfermatiHtml && totConfermatiHtml.length) totConfermati = parseFloat(totConfermati) || 0;

        let result = (totConfermati / totInviati) * 100;
        if (isNaN(result)) result = 0;

        // Valori di compare
        let totInviatiCompareHml = j(api.column(colInviatiIndex).footer()).html();
        let totInviatiCompare = getColumnClearValue(totInviatiCompareHml, true);
        totInviatiCompare = clearNumber(totInviatiCompare);
        if (totInviatiCompareHml && totInviatiCompareHml.length) totInviatiCompare = parseFloat(totInviatiCompare) || 0;

        let totConfermatiCompareHtml = j(api.column(colConfermatiIndex).footer()).html();
        let totConfermatiCompare = getColumnClearValue(totConfermatiCompareHtml, true);
        totConfermatiCompare = clearNumber(totConfermatiCompare);
        if (totConfermatiCompareHtml && totConfermatiCompareHtml.length) totConfermatiCompare = parseFloat(totConfermatiCompare) || 0;

        let resultCompare = (totConfermatiCompare / totInviatiCompare) * 100;
        if (isNaN(resultCompare)) resultCompare = 0;

        const resultComparePerc = (result - resultCompare) / resultCompare * 100;
        let resultComparePercFormatted = number_format(resultComparePerc, 2, ',', ".");
        if (resultComparePerc > 0) {
            resultComparePercFormatted = ' <i class="ion ion-arrow-up-a text-success"></i> +' + resultComparePercFormatted;
        } else {
            resultComparePercFormatted = ' <i class="ion ion-arrow-down-a text-danger"></i> ' + resultComparePercFormatted;
        }

        const footerStr = number_format(result, 2, ',', ".") + ' <span class="compare text-compare" data-toggle="tooltip" title="' + number_format(resultCompare, 2, ',', ".") + '">(' + resultComparePercFormatted + '%)</span>'
        j(api.footer()).html(footerStr);
    } else {
        let totInviatiHml = j(api.column(colInviatiIndex).footer()).html();
        let totInviati = 0;
        if (totInviatiHml && totInviatiHml.length) {
            totInviati = parseFloat(clearNumber(totInviatiHml.replace('.', ''))) || 0;
        }

        let totConfermatiHtml = j(api.column(colConfermatiIndex).footer()).html();
        let totConfermati = 0;
        if (totConfermatiHtml && totConfermatiHtml.length) {
            totConfermati = parseFloat(clearNumber(totConfermatiHtml.replace('.', ''))) || 0;
        }

        let result = (totConfermati / totInviati) * 100;
        if (isNaN(result)) result = 0;
        j(api.footer()).html(number_format(result, 2, ',', "."));
    }
}

function clearNumber(numberStr) {
    //if (typeof numberStr == 'string') return numberStr.replaceAll("'", '').replaceAll('.', '').replace(',', '.');
    if (typeof numberStr == 'string') return numberStr.replaceAll("'", '').replace(',', '.').replace(/\.(?=.*\.)/g, '');
    return numberStr;
}

function prefixEuro(data) {
    return '€ ' + data;
}

/**
 * Data una cella della tabella nel formato esempio: 12,37 <span class="..." title="10">(+5%)</span>
 * restituisce il valore princiale senza il tab html se compare = false
 * altrimenti restituisce il valore assoluto (title) del span
 * @param valueString
 * @param compare
 */
function getColumnClearValue(valueString, compare = false) {
    if (compare) {
        let div = document.createElement('div');
        div.innerHTML = valueString;
        let elements = div.getElementsByTagName('span');
        if (elements[0]) {
            return (elements[0]).getAttribute('title').replace(/\s/g, '').replaceAll('€ ', '').replaceAll('€', '');
        } else {
            return valueString.toString().replace(/\s/g, '').replaceAll('€ ', '').replaceAll('€', '');
        }
    } else {
        let div = document.createElement('div');
        div.innerHTML = valueString;
        let elements = div.getElementsByTagName('span');
        while (elements[0]) elements[0].parentNode.removeChild(elements[0]);
        return div.innerHTML.replace(/\s/g, '').replaceAll('€ ', '').replaceAll('€', '');
    }
}

/**
 * Dato un array di parametri resituisce l'url composto dai parametri forniti
 * @param data array parametro=>valore
 * @returns {string} url con parametri. Esempio parametro1=valore&par2=val2
 */
function encodeQueryData(data) {
    const ret = [];
    for (let d in data)
        ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
    return ret.join('&');
}

/**
 * equivalent of PHP number_format
 // eslint-disable-line camelcase
 //  discuss at: https://locutus.io/php/number_format/
 // original by: Jonas Raoni Soares Silva (https://www.jsfromhell.com)
 //
 * @param number
 * @param decimals
 * @param decPoint
 * @param thousandsSep
 * @returns {string}
 */
function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    const n = !isFinite(+number) ? 0 : +number
    const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    const dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    let s = ''
    const toFixedFix = function (n, prec) {
        if (('' + n).indexOf('e') === -1) {
            return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
        } else {
            const arr = ('' + n).split('e')
            let sig = ''
            if (+arr[1] + prec > 0) {
                sig = '+'
            }
            return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
        }
    }
    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}