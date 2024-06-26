<div class="boxquoto" id="chat">
	<i class="fas fa-caret-up"></i>
	<div class="box6" style="vertical-align: top">		
            <form id="form_chat" name="form_chat" method="post" >  
             <div class="form">                                                              
                <textarea  rows="10"  name="chat" id="chatmsg" placeholder="<?=HOTELCHAT?>" required></textarea>
             </div>
                  <input type="hidden" name="id_guest" value="<?=$IdRichiesta?>">
                  <input type="hidden" name="NumeroPrenotazione" value="<?=$Nprenotazione?>">
                  <input type="hidden" name="user" value="<?=$Cliente?>">
                  <input type="hidden" name="lang" value="<?=$Lingua?>"> 
                  <input type="hidden" name="idsito" value="<?=$IdSito?>"> 
                  <input type="hidden" name="action" value="add_chat">  
                  <input type="button" class="pulsante m-x-tc" id="send_msg" value="<?=INVIA?>" />                                                      

              </form>
	</div>
	
	<?php
	$box='chat'; //ID del box contenitore
	$frase1= $VISUALIZZA.' '.$CONVERSAZIONE;
	$frase2= $NASCONDI.' '.$CONVERSAZIONE;
	$bollino='<i class="fa fa-comments"></i>'; //font awesome di riferimento
	$oc="0";//1 aperto - 2 chiuso
	include(BASE_PATH_SITO . "smart/include/inc_OC.php"); 
	?>

	<div class="box6 t14 content">		
		<!--inizio ciclo conversazione-->
 		<div id="balloon"> FAC SIMILE DEL BOX PER LA DISCUSSIONE CHAT CON IL CLIENTE!</div>
		<!--fine ciclo conversazione-->
		<div class="ca"></div>
	</div>
</div>
<style>
	#chat.scrolled{
		position: fixed;
		top: 55px;
		left: 50%;
		transform: translateX(-93%);
		max-width: 800px;
		width: 100%;
		z-index: 1011;
		box-shadow: 0 0 10px #000;
	}
	#chat.scrolled .bollino{
		display: none;
	}
	#chat .fa-caret-up{
		position: absolute;
		color: #FFF;
		font-size: 30px;
		top: -20px;
		left: 40px;
		display: none;
	}
	#chat.scrolled .fa-caret-up{
		display: block;
	}
	#chat.scrolled textarea{
		font-size: 12px;
	}
	#chat .box6{
		position: relative;
		vertical-align: top;
	}
	#chat .form{
		position: relative;
		width: calc(100% - 160px);
		float: left;
	}
	#chat .form textarea{
		width: 100%;
		margin: 0px;
		height: 60px;

	}
	#chat .pulsante{
		width: 150px;
		float: right;
		height: 60px;
		line-height: 60px;

	}
	#chat .linea{
		border-bottom: 1px dotted <?=$colore2?>;
	}


@media screen and (max-width: 1500px) {
    #chat.scrolled {
        position: relative;
        top: auto;
        left: auto;
        transform: translateX(0);
        max-width: 2000px;
        width: 100%;
        z-index: 1011;
        box-shadow:none;
    }
    #chat.scrolled .bollino {
        display: none;
    }
    #chat .fa-caret-up {
        position: absolute;
        color: #FFF;
        font-size: 30px;
        top: -20px;
        left: 40px;
        display: none;
    }
    #chat.scrolled .fa-caret-up {
        display: block;
    }
    #chat.scrolled textarea {
        font-size: 12px;
    }
}
</style>