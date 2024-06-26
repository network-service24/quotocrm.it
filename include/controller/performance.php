<?php
$jsScript = '   
<script>
    /**
     * LOAD DIV PERFORMANCE
     */
    function print_performance(){
        $("#preno_camera_pre").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta calcolando le <b>performance per camera</b>, attendere...!\');

        $("#prenotazioni_camera").load("'.BASE_URL_SITO.'ajax/statistiche/performance_camere.php?idsito='.IDSITO.'&anno='.$_REQUEST['anno'].'", function() {
            $("#preno_camera_pre").hide();
        });
    }
    $(document).ready(function(){
        var highestBox = 400;
        var heigthRow = $("#PerformanceCamere").height();
        var heigthRowBlock = $("#LavoroOperatori").height();
        var new_height = (highestBox - 50);
        if(highestBox > heigthRow){
			$("#proposte_block").attr("style", "height:"+new_height+"px;overflow-y:auto;overflow-x:auto;");
			$("#proposte_block").addClass("scroll");	
		}else{
			$("#proposte_block").attr("style", "height:"+heigthRow+"px;overflow-y:auto;overflow-x:auto;");
			$("#proposte_block").addClass("scroll");
		}
        $(".row-eq-height").each(function() {
            var heights = $(this).find(".col-eq-height").map(function() {
            return $(this).outerHeight();
                }).get(), maxHeight = Math.max.apply(null, heights);
                $(this).find(".col-eq-height").outerHeight(maxHeight);
        });

        print_performance();
    });
</script>'."\r\n";

$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['anno']==''?date('Y'):$_REQUEST['anno'])==$i?'selected="selected"':'').'>'.$i.'</option>';
    }
?>