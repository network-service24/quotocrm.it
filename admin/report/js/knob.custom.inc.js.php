<div id="grafico_dinamico_custom"></div>
<script type="text/javascript" id="grafico_dinamico">
            
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
        text: "Index Score Marketing",
        horizontalAlign: "center"
        },
        data: [{
        type: "doughnut",
        startAngle: 60,
        innerRadius:60,
        indexLabelFontSize: 19,
        indexLabel: "{label} #percent%",
        toolTipContent: "<b>{label}:</b> {y} (#percent%)",
        dataPoints: [
            { y: <?=number_format($PercentualeAltreRichiesteMarketingDiretto,2)?>, label: "Altri canali " },
            { y: <?=number_format($PercentualeMarketingDiretto,2)?>, label: "Marketing diretto " }
        ]
        }]
    });
    chart.render();

    }
</script>
<script src="<?=BASE_URL_SITO?>report/js/canvasjs.min.js"></script>
<script>
$(function () {

    $(".knob").knob({

        draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

            var a = this.angle(this.cv)  // Angle
                , sa = this.startAngle          // Previous start angle
                , sat = this.startAngle         // Start angle
                , ea                            // Previous end angle
                , eat = sat + a                 // End angle
                , r = true;

            this.g.lineWidth = this.lineWidth;

            this.o.cursor
            && (sat = eat - 0.3)
            && (eat = eat + 0.3);

            if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
            }

            this.g.beginPath();
            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
            this.g.stroke();

            this.g.lineWidth = 2;
            this.g.beginPath();
            this.g.strokeStyle = this.o.fgColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
            this.g.stroke();

            return false;
        }
        }
    });
    /* END JQUERY KNOB */


    });
</script>
<script src="<?=BASE_URL_SITO?>js/plugins/jqueryKnob/jquery.knob.js"></script>