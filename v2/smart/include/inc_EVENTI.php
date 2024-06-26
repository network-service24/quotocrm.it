<?if((sizeof($DatiEventi)!=0) && ($ModuliEventi == true)){?>
<div class="boxquoto" id="eventi">
	<div class="box6">
		<h3><?=strtoUpper(EVENTI)?></h3>
	</div>
	<?php
	$box     ='eventi'; //ID del box contenitore
	$frase1  = $VISUALIZZA.' '.EVENTI;
	$frase2  = $NASCONDI.' '.EVENTI;
	$bollino ='<i class="fa fa-star"></i>'; //font awesome di riferimento
	$oc      ="0";//1 aperto - 0 chiuso
	include(BASE_PATH_SITO . "smart/include/inc_OC.php"); 
	?>
	<div class="box6 t14 content">
		<?=$Eventi?>
		<div class="ca10"></div>
	
	    <div  id="b_map" style="display:none" >       
		      <div class="m m-x-12">
		          <a name="start_map"></a>      
		          <a href="javascript:;" id="close"><i  class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="float:right"></i></a>                    
		          <iframe id="frame_lp"  src="<?=BASE_URL_SITO?>include/controller/gmap.php" frameborder="0" width="100%" height="334px" class="mbr"></iframe>                                                           
		      </div>                                                  
	   	</div>

		 <script>
		 	$(document).ready(function() {
			  	$("#close").click(function(){
			        $("#b_map").css("display","none");
			     });
		  	});
		  </script>
  		<div class="ca10"></div>
  </div>	
</div>
<?}?>