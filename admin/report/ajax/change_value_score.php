<?php

require $_SERVER['DOCUMENT_ROOT'] . "/include/settings.inc.php";
error_reporting(0);


$percentuale_score  = $_REQUEST['score'];

echo '<script type="text/javascript">
                $(document).ready(function() {
                    $("#percentuale_score_js").html(\'<b class="font24Bold">'.$percentuale_score.'%</b>\');
                    $("#recalc_percentuale_score_marketing").html(\'<input type="hidden" name="recalc_percentuale_score_marketing" id="perc_marketing" value="'.$percentuale_score.'"/>\');
                });
                </script>';	
