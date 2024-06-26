<?php

require $_SERVER['DOCUMENT_ROOT'] . "/include/settings.inc.php";


$perc_marketing  = $_REQUEST['perc_marketing'];
$perc_altro      = $_REQUEST['perc_altro'];

echo '<script type="text/javascript">
                                
                    
    
                    var chart_custom = new CanvasJS.Chart("chartContainer_custom", {
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
                          { y: '.$perc_altro.', label: "Altri canali " },
                          { y: '.$perc_marketing.', label: "Marketing diretto " }
                        ]
                      }]
                    });
                    chart_custom.render();
    
                    
              </script> ';	
