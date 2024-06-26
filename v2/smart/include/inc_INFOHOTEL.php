<?if(($info)>0){?>
<div class="boxquoto" id="infohotel">
	<div class="box6">
		<h3><?=strtoupper($infohotel)?></h3>
	</div>
	<?php
	$box     ='infohotel'; //ID del box contenitore
	$frase1  = $VISUALIZZA.' '. $infohotel;
	$frase2  = $NASCONDI.' '.$infohotel;
	$bollino ='<i class="fa fa-info-circle"></i>'; //font awesome di riferimento
	$oc      ="0";//1 aperto - 0 chiuso
	include(BASE_PATH_SITO . "smart/include/inc_OC.php"); 
	?>
	<div class="box6 t14 content">
		<?=$infohotelTesto?>
		<div class="ca20"></div>
	</div>
</div>
<?}?>