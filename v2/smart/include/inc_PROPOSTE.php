<div class="boxquoto" id="proposte">
	<!--FOTO E PRESENTAZIONE-->
	<div class="box6">
		<div class="m m-x-6 m-m-12 m-x-h500 m-img mbr"><img src="<?=$immagine1?>" alt=""></div>
		<div class="m m-x-6 m-x-tl m-m-ha m-m-12 m-eq1">
			<div class="box4">
				<div class="riferimento t12">
					<div class="testo"><strong><?=($TipoRichiesta == 'Preventivo'?IL_SUO.' '.PREVENTIVO: CONFERMA)?>  <?=DA?> <?=$NomeCliente?></strong></div>
					<br>
					<?=OFFERTA?> nr. <?=$NumeroPrenotazione?> <?=DEL?> <?=$DataRichiesta?> <?=($TipoRichiesta == 'Preventivo'?'&nbsp;&nbsp;'.SCADENZA.' '.$DataScadenza.'': '')?>
				</div>
				<div class="ca20"></div>
				<div class="testo"><?=$Testo?></div>
				<div class="ca30"></div>
				<div class="saluti t15">
					<?=CORDIALMENTE?><br>
					<?=$Operatore?>
				</div>
				<div class="ca"></div>
			</div>
		</div>
		<div class="ca"></div>
	</div>
	<!--FASCETTA-->
	<div class="m m-x-12 bcolor twhite t14" id="fascetta">
		<div id="owner">
			<div class="img m-img"><?=$ownerimg?></div>
			<div class="riga1 tcolor t18 w700"><?=CREATA_DA?></div>
			<div class="riga2 twhite t14"><?=($disable==false?$Operatore:'')?></div>

		</div>
		<div class="m m-x-1 m-x-tr t25">
			<div class="box6"><i class="fa fa-clock-o fa-fw"></i></div>
		</div>
		<div class="m m-x-11 m-x-tl">
			<div class="box6">
				<?=($TipoRichiesta == 'Preventivo'?SCADENZA.' '.OFFERTA.' <strong>'.$DataScadenza_estesa.'</strong>':(($AccontoRichiesta != 0 || $AccontoLibero != 0 || $AccontoPercentuale != 0 || $AccontoImporto != 0)?SCADENZA_OFFERTA.'  <strong>'.$DataScadenza_estesa.'</strong>':SCADENZA.' <strong>'.$DataScadenza_estesa.'</strong>'))?>
			</div>
		</div>
	</div>
	<div class="ca20"></div>

	<?php
	$box     ='proposte'; //ID del box contenitore
	$frase1  = $VISUALIZZA.' '.PROPOSTE;
	$frase2  = $NASCONDI.' '.PROPOSTE;
	$bollino ='<i class="fa fa-list-ol"></i>'; //font awesome di riferimento
	$oc      = "1";//1 aperto - 0 chiuso
	include(BASE_PATH_SITO . "smart/include/inc_OC.php"); 
	?>

	<div class="m m-x-12 content">
		<!--TAB PROPOSTE-->
		<div class="m m-x-12 bcolor m-x-h100 tabcontent">
		<!--TAB PROPOSTE-->		
			<?=$proposta_titolo?>
		</div>
		<div class="ca"></div>
		<!--SPECCHIETTO-->
		<div class="m m-x-12 m-img specchietto">
			<img src="<?=$immagine2?>" alt="">
				<?=$proposta_specchietto?>
			<div class="ca"></div>
		</div>
		<div class="ca"></div>
		<!--CAMERE-->
		<div class="m m-x-12 m-img camere">
			<?=$proposta_camera?>

		</div>
		<!--CONTEGGIO-->
		<div class="m m-x-12 m-img conti">
			<!--CONTEGGIO PROPOSTE -->
			<?=$proposta_conteggio?>
		</div>
	</div>
	<div class="ca10"></div>
</div>
<style>
#proposte{
	position: relative;
}
.smart .tab{
	padding: 15px;
	transition: all .6 ease;
	cursor: pointer;
	opacity: 0.6;
	border-top: 10px solid #FFF;
	border-right: 1px solid #FFF;
}
.smart .tab.checked{
	padding: 20px;
	opacity: 1;
	border-top: 0px solid #FFF;
}
.smart .tab:hover{
	background-color: <?=$colore1?>;
	transition: all .2s ease;
	opacity: 1;
}
.smart .tab titolo{
	display: block;
	font-size: 20px;
	font-weight: 700;
	text-transform: uppercase;
}
.smart .tab prezzo{
	display: block;
	font-size: 20px;
	font-weight: 300;
}
.smart .specchietto{
	margin-bottom: 1px;
}
.smart .specchietto .contenitore{
    position:absolute!important;
    top:30px!important;
    left:-600px!important;
	opacity: 0!important;
    transition: all .5s ease!important;
    height:auto!important;
    width:calc(100% - 60px)!important;
    max-width:500px!important;
    transform:scale(1,1)!important;
    z-index:1!important;
}
#preno .fproposta .specchietto {
    height: auto !important;
}
.smart .contenitore.selected{
	opacity: 1!important;
    left:30px!important;
    transform:scale(1,1)!important;
    z-index:2!important;
}
.smart .specchietto .contenitore .pulsante{
	width: 100% !important;
	text-align: center;
	border-radius: 0 !important;
	margin-bottom: 0px;
	padding: 25px 20px !important;
	height: auto !important;
	line-height: 1.1 !important;
}

.smart .specchietto .contenitore linea{
	background-color: rgba(0,0,0,0.8);
	font-size: 13px;
	font-weight: 700;
	position: relative;
	clear: both;
	display: block;
	margin-bottom: 1px;
	padding: 10px 0px 10px 80px;
	width: 100%;
}
.specchietto .contenitore linea svg{
	position: absolute;
	font-size: 28px;
	left: 25px;
	top: 50%;
	transform: translateY(-50%);
}
.smart .specchietto .contenitore totale{
	display: block;
	font-weight: 300;
	font-size: 18px;
	text-decoration: line-through;	
}
.smart .specchietto .contenitore sconto{
	display: block;
	font-weight: 300;
	font-size: 18px;
	
}
.smart .specchietto .contenitore newtotale{
	display: block;
	font-weight: 700;
	font-size: 28px;
	
}
.smart .camera{
	padding: 0;
	overflow: hidden;
	max-height: 0px;
}
.smart .riga:nth-child(even){
	background-color: #ededed;
}
.smart .camera.selected{
	overflow: hidden;
	max-height: 100000px;
}

.smart .conto{
	padding: 0;
	overflow: hidden;
	max-height: 0px;
}
.smart .conto.selected{
	overflow: hidden;
	max-height: 2000px;
}
.smart .tabcontent{
    height:auto !important;
    padding:5px;
}
.smart .tab2019{
    padding:10px 25px;
    margin:1px;
    border-radius:3px;
    background-color:#FFF;
    text-align:center;
    font-weight:700;
    font-size:15px;
    text-transform:uppercase;
    transition:all .3s ease;
    z-index:1;
    cursor:pointer;
}
.smart .tab2019:hover{
    z-index:2;

    transition:none !important;
    box-shadow:0 0 10px #000;
}
.smart .tab2019 titolo{
    font-size:15px;
}
.smart .tab2019 prezzo{
    font-size:20px;
    clear:both;
    display:block;
    font-weight:300;
}
.smart .tab2019.selected{
    padding: 16px 50px;
    margin-top: -5px;
    margin-bottom: -5px;
    border-radius: 0px;
    margin-left: 5px;
    margin-right: 5px;
    background-color:rgba(0,0,0,0.7);
    color:#FFF;
}
.smart .tab2019.selected::after{
    transform: translateX(-50%);
    content: '';
    position: absolute;
    left: 50%;
    /* margin-left: -15px; */
    bottom: -20px;
    width: 0;
    height: 0;
    line-height: 0px;
    border-top: 20px solid rgba(0,0,0,0.7);
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
}
.tab2019.selected:hover{
    z-index:1 !important;
    transform:scale(1,1) !important;
    transition:none !important;
    box-shadow:none !important;
}
@media screen and (max-width: 1500px) {}

@media screen and (max-width: 1200px) {}

@media screen and (max-width: 992px) {}

@media screen and (max-width: 768px) {
	#proposte .smart .specchietto{
		display: none !important;
	}
	.smart .tab titolo{
		font-size: 15px;
		font-weight: 700;
	}
	.smart .tab prezzo{
		font-size: 16px;
		font-weight: 300;
	}
}
@media screen and (max-width: 576px) {
	.smart .pulsante{
        font-size:18px!important;
    }

}
</style>