<?php

require $_SERVER['DOCUMENT_ROOT'] . "/include/settings.inc.php";
error_reporting(0);


$recalc_percentuale_score_altro  = $_REQUEST['scoreN'];

echo '<script type="text/javascript">
                $(document).ready(function() {
                    $("#recalc_percentuale_score_altro").html(\'<input type="hidden" name="recalc_percentuale_score_altro" id="perc_altro" value="'.$recalc_percentuale_score_altro.'" />\');
                });
                </script>';	
