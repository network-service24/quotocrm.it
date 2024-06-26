<div class="boxquoto" id="dovesiamo">
	<div class="box6">
		<h3><?=strtoUpper(DOVE_SIAMO)?></h3>
	</div>
	<?php
	$box     ='dovesiamo'; //ID del box contenitore
	$frase1  = $VISUALIZZA.' '.$MAPPA;
	$frase2  = $NASCONDI.' '.$MAPPA;
	$bollino ='<i class="fa fa-location-arrow"></i>'; //font awesome di riferimento
	$oc      ="0";//1 aperto - 0 chiuso
	include(BASE_PATH_SITO . "smart/include/inc_OC.php"); 
	?>
	<div class="box6 t14 content">
		<?=$Mappa?>
	</div>
</div>