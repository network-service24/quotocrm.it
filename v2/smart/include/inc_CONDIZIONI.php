<div class="boxquoto" id="condizioni">
    <div class="box6">
        <h3><?=strtoUpper(CONDIZIONI_GENERALI)?></h3>
    </div>
    <?php
        $box     ='condizioni'; //ID del box contenitore
        $frase1  = $VISUALIZZA.' '.$CONDIZIONI;
        $frase2  = $NASCONDI.' '.$CONDIZIONI;
        $bollino ='<i class="fa fa-question-circle"></i>'; //font awesome di riferimento
        $oc      ="0";//1 aperto - 0 chiuso
        include(BASE_PATH_SITO. "smart/include/inc_OC.php"); 
	?>
        <div class="box6 t14 content">
            <?=$condizioni_generali?>
        </div>
</div>