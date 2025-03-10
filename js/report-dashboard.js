"use strict";
$(document).ready(function() {
    function e(e, t, a) {
        return null == a && (a = "rgba(0,0,0,0)"), {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"],
            datasets: [{
                label: "",
                borderColor: e,
                borderWidth: 2,
                hitRadius: 30,
                pointRadius: 3,
                pointHoverRadius: 4,
                pointBorderWidth: 5,
                pointHoverBorderWidth: 12,
                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                pointBorderColor: e,
                pointHoverBackgroundColor: e,
                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                fill: !0,
                lineTension: 0,
                backgroundColor: a,
                data: t
            }]
        }
    }

    function t() {
        return {
            title: {
                display: !1
            },
            tooltips: {
                position: "nearest",
                mode: "index",
                intersect: !1,
                yPadding: 10,
                xPadding: 10
            },
            legend: {
                display: !1,
                labels: {
                    usePointStyle: !1
                }
            },
            responsive: !0,
            maintainAspectRatio: !0,
            hover: {
                mode: "index"
            },
            scales: {
                xAxes: [{
                    display: !1,
                    gridLines: !1,
                    scaleLabel: {
                        display: !0,
                        labelString: "Month"
                    }
                }],
                yAxes: [{
                    display: !1,
                    gridLines: !1,
                    scaleLabel: {
                        display: !0,
                        labelString: "Value"
                    },
                    ticks: {
                        beginAtZero: !0
                    }
                }]
            },
            elements: {
                point: {
                    radius: 4,
                    borderWidth: 12
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 25,
                    bottom: 25
                }
            }
        }
    }
    var a = (AmCharts.makeChart("visitor", {
        type: "serial",
        hideCredits: !0,
        theme: "light",
        dataDateFormat: "YYYY-MM-DD",
        precision: 2,
        valueAxes: [{
            id: "v1",
            title: "Visitors",
            position: "left",
            autoGridCount: !1,
            labelFunction: function(e) {
                return "$" + Math.round(e) + "M"
            }
        }, {
            id: "v2",
            title: "New Visitors",
            gridAlpha: 0,
            position: "right",
            autoGridCount: !1
        }],
        graphs: [{
            id: "g3",
            valueAxis: "v1",
            lineColor: "#feb798",
            fillColors: "#feb798",
            fillAlphas: 1,
            type: "column",
            title: "old Visitor",
            valueField: "sales2",
            clustered: !1,
            columnWidth: .5,
            legendValueText: "$[[value]]M",
            balloonText: "[[title]]<br /><b style='font-size: 130%'>$[[value]]M</b>"
        }, {
            id: "g4",
            valueAxis: "v1",
            lineColor: "#fe9365",
            fillColors: "#fe9365",
            fillAlphas: 1,
            type: "column",
            title: "New visitor",
            valueField: "sales1",
            clustered: !1,
            columnWidth: .3,
            legendValueText: "$[[value]]M",
            balloonText: "[[title]]<br /><b style='font-size: 130%'>$[[value]]M</b>"
        }, {
            id: "g1",
            valueAxis: "v2",
            bullet: "round",
            bulletBorderAlpha: 1,
            bulletColor: "#FFFFFF",
            bulletSize: 5,
            hideBulletsCount: 50,
            lineThickness: 2,
            lineColor: "#0df3a3",
            type: "smoothedLine",
            title: "Last Month Visitor",
            useLineColorForBulletBorder: !0,
            valueField: "market1",
            balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }, {
            id: "g2",
            valueAxis: "v2",
            bullet: "round",
            bulletBorderAlpha: 1,
            bulletColor: "#FFFFFF",
            bulletSize: 5,
            hideBulletsCount: 50,
            lineThickness: 2,
            lineColor: "#fe5d70",
            dashLength: 5,
            title: "Average Visitor",
            useLineColorForBulletBorder: !0,
            valueField: "market2",
            balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }],
        chartCursor: {
            pan: !0,
            valueLineEnabled: !0,
            valueLineBalloonEnabled: !0,
            cursorAlpha: 0,
            valueLineAlpha: .2
        },
        categoryField: "date",
        categoryAxis: {
            parseDates: !0,
            dashLength: 1,
            minorGridEnabled: !0
        },
        legend: {
            useGraphSettings: !0,
            position: "top"
        },
        balloon: {
            borderThickness: 1,
            cornerRadius: 5,
            shadowAlpha: 0
        },
        dataProvider: [{
            date: "2013-01-16",
            market1: 71,
            market2: 75,
            sales1: 5,
            sales2: 8
        }, {
            date: "2013-01-17",
            market1: 74,
            market2: 78,
            sales1: 4,
            sales2: 6
        }, {
            date: "2013-01-18",
            market1: 78,
            market2: 88,
            sales1: 5,
            sales2: 2
        }, {
            date: "2013-01-19",
            market1: 85,
            market2: 89,
            sales1: 8,
            sales2: 9
        }, {
            date: "2013-01-20",
            market1: 82,
            market2: 89,
            sales1: 9,
            sales2: 6
        }, {
            date: "2013-01-21",
            market1: 83,
            market2: 85,
            sales1: 3,
            sales2: 5
        }, {
            date: "2013-01-22",
            market1: 88,
            market2: 92,
            sales1: 5,
            sales2: 7
        }, {
            date: "2013-01-23",
            market1: 85,
            market2: 90,
            sales1: 7,
            sales2: 6
        }, {
            date: "2013-01-24",
            market1: 85,
            market2: 91,
            sales1: 9,
            sales2: 5
        }, {
            date: "2013-01-25",
            market1: 80,
            market2: 84,
            sales1: 5,
            sales2: 8
        }, {
            date: "2013-01-26",
            market1: 87,
            market2: 92,
            sales1: 4,
            sales2: 8
        }, {
            date: "2013-01-27",
            market1: 84,
            market2: 87,
            sales1: 3,
            sales2: 4
        }, {
            date: "2013-01-28",
            market1: 83,
            market2: 88,
            sales1: 5,
            sales2: 7
        }, {
            date: "2013-01-29",
            market1: 84,
            market2: 87,
            sales1: 5,
            sales2: 8
        }, {
            date: "2013-01-30",
            market1: 81,
            market2: 85,
            sales1: 4,
            sales2: 7
        }]
    }), AmCharts.makeChart("proj-earning", {
        type: "serial",
        hideCredits: !0,
        theme: "light",
        dataProvider: [{
            type: "UI",
            visits: 10
        }, {
            type: "UX",
            visits: 15
        }, {
            type: "Web",
            visits: 12
        }, {
            type: "App",
            visits: 16
        }, {
            type: "SEO",
            visits: 8
        }],
        valueAxes: [{
            gridAlpha: .3,
            gridColor: "#fff",
            axisColor: "transparent",
            color: "#fff",
            dashLength: 0
        }],
        gridAboveGraphs: !0,
        startDuration: 1,
        graphs: [{
            balloonText: "Active User: <b>[[value]]</b>",
            fillAlphas: 1,
            lineAlpha: 1,
            lineColor: "#fff",
            type: "column",
            valueField: "visits",
            columnWidth: .5
        }],
        chartCursor: {
            categoryBalloonEnabled: !1,
            cursorAlpha: 0,
            zoomable: !1
        },
        categoryField: "type",
        categoryAxis: {
            gridPosition: "start",
            gridAlpha: 0,
            axesAlpha: 0,
            lineAlpha: 0,
            fontSize: 12,
            color: "#fff",
            tickLength: 0
        },
        export: {
            enabled: !1
        }
    }), document.getElementById("newuserchart").getContext("2d"));
    window.myDoughnut = new Chart(a, {
        type: "doughnut",
        data: {
            datasets: [{
                data: [10, 34, 5],
                backgroundColor: ["#fe9365", "#01a9ac", "#fe5d70"],
                label: "Dataset 1"
            }],
            labels: ["Satisfied", "Unsatisfied", "NA"]
        },
        options: {
            maintainAspectRatio: !1,
            responsive: !0,
            legend: {
                position: "bottom"
            },
            title: {
                display: !0,
                text: ""
            },
            animation: {
                animateScale: !0,
                animateRotate: !0
            }
        }
    });
    var a = document.getElementById("sale-chart1").getContext("2d"),
        a = (new Chart(a, {
            type: "line",
            data: e("#b71c1c", [25, 30, 15, 20, 25, 30, 15, 25, 35, 30, 20, 10, 12, 1], "transparent"),
            options: t()
        }), document.getElementById("sale-chart2").getContext("2d")),
        a = (new Chart(a, {
            type: "line",
            data: e("#00692c", [30, 15, 25, 35, 30, 20, 25, 30, 15, 20, 25, 10, 12, 1], "transparent"),
            options: t()
        }), document.getElementById("sale-chart3").getContext("2d"));
    new Chart(a, {
        type: "line",
        data: e("#096567", [15, 20, 25, 10, 30, 15, 25, 35, 30, 20, 25, 30, 12, 1], "transparent"),
        options: t()
    })
});