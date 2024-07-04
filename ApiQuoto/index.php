<?php require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");?>
<?php
	if($_GET['idsito']){
		$ID_SITO = $_GET['idsito'];
	}else{
		$ID_SITO = 'ID_SITO';
	}
	if($_GET['idform']){
		$ID_FORM = $_GET['idform'];
	}else{
		$ID_FORM = 'ID_FORM';
	}

	/**
	 * * variabile per vedere a video la username e password del cUrl API QUOTO
	 */
	if($_GET['dev']==true){
		$user = 'quoto';
		$pass = 'lHxAbMHGU';
		$comm = '';
	}else{
		$user = '........';
		$pass = '........';
		$comm = '## richiedere a Network Service';
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>HELP INTEGRAZIONE FORM PER QUOTO | Network Service</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
		<script src="<?=BASE_URL_SITO?>ApiQuoto/js/clipboard.js"></script>
		<script>
			$(document).ready(function(){
				$('[data-toogle="tooltip"]').tooltip();
			});
    	</script>
</head>
<body>
	<div class="container">
		<p>&nbsp;</p>
		<img src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo.png&w=300&h=0&a=c&q=100" alt="QUOTO" style="vertical-align: bottom;" />  <em><a href="http://www.quoto.travel/" target="_blank">Cos'è QUOTO</a></em>
		<p>&nbsp;</p>
		<b>Help per creare e/o collegare un form, sincronizzando le richieste con QUOTO!</b> <small>(Quoto Engagement & Customer Satisfaction)</small><br>
		###################################################################################################################################################<br>


<h3><b>WIDGET JS FORM QUOTO!</b> <small id="blink">new</small></h3>
<p>
	Il widget qui sotto stampa a video il <b>form dedicato al CRM QUOTO!</b><br>
	Il form è già abilitato alla raccolta dati da e per <b>Analytics GA4</b> inoltre include anche la nuova metodologia Network Service <b>UTM</b> per la <b>tracciabilità della campagne ADS</b><br>
	Inoltre è necessario per il funzionamento del widget l'uso della libreria <b>Jquery.js</b>
</p>
<div style="  border-radius: 5px;border: 1px solid #CCCCCC;padding:10px!important;">
<p><b>SOLO SE...</b></p>
<p>
	il form viene inserito IN UNA SOLA PAGINA del sito (<em>non viene usato un include per inserirlo in tutte le pagine</em>) allora in tutte le pagine <b>è obbligatorio inserire questo script </b>
	<script> var clipboard = new ClipboardJS('#SCQ');</script>	
	<br><div class="text-right"><a href="javascript:;" id="SCQ" data-clipboard-action="copy" data-clipboard-target="#SC" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i> Copia ed incolla</a></div>
	<pre id="SC">&lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/saveUtmFormQuoto.min.js"  async defer&gt;&lt;/script&gt;</pre>
</p>
</div>
<br>
<script> var clipboard = new ClipboardJS('#WDQ');</script>	
<i class="fa fa-code"></i>&nbsp;
<b>
	Codice widget per includere il FORM di QUOTO nel sito e/o in una landing page
</b>&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;
<p>
	Copia ed incolla il codice nella pagina dove vuoi il form&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
	&nbsp;&nbsp;<a href="javascript:;" id="WDQ" data-clipboard-action="copy" data-clipboard-target="#WD" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>
	&nbsp;&nbsp;<a href="javascript:window.open('<?=BASE_URL_SITO?>ApiQuoto/viewWidgetForm.php?idsito=<?=$_GET['idsito']?>');" title="preview" alt="preview"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Visualizza preview form</a>
	&nbsp;&nbsp;<a href="javascript:;" id="view_tips_tricks" data-toggle="tooltip" title="Script per modificare le etichette testuali"><i class="fa fa-expand" aria-hidden="true"></i>&nbsp;&nbsp;Tips & Tricks</a>	
		<script>
			$(document).ready(function(){			
				$("#view_tips_tricks").click(function() {
					$("#tips_tricks").slideToggle("slow");
				});
			})
		</script>
</p>
<pre style="display:none" id="tips_tricks">
&lt;!--
/**
** Se avete necessità di rendere obbligatorio anche il campo telefono!
** Ecco un piccolo script già pronto!
**
** LO SCRIPT VA POSIZIONATO SUBITO SOTTO A: 
** &lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
*/
--&gt;
&lt;script&gt;
jQuery(document).ready(function(){
	jQuery("#telefono").attr("required",true);
	jQuery("#telefono").addClass("CheckChange");
	jQuery("#telefono").attr("placeholder", "Telefono *");
	jQuery("#form_quoto").mousemove(function () {
		if(jQuery("#telefono").val()!=''){
			jQuery("#telefono").removeClass('error');
		}
	})
	jQuery(".submit").on('click', function () {
		if(jQuery("#telefono").val()==''){
			jQuery("#telefono").addClass('error');
			jQuery("#telefono").attr('title','');
		}else{
			jQuery("#telefono").removeClass('error');
		}
	})
})
&lt;/script&gt;
&lt;!--################################################################################################################################################--&gt;
&lt;!--
/**
** Se avete necessità d'inserire un testo descrittivo per agevolare la compilazione del form,  questo script d'esempio fa per voi!
** Il testo apparirà subito sopra la textarea del messaggio
**
** LO SCRIPT VA POSIZIONATO SUBITO SOTTO A: 
** &lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
*/
--&gt;
&lt;div id="legenda" style="font-size:14px;line-height:1.1em;padding-left: 6px;"&gt;
	&lt;strong&gt;Attenzione!&lt;/strong&gt;
	&lt;br&gt;Indicaci più dettagli possibili nel campo del messaggio.&lt;br&gt; Così potremo ospitarti al  meglio!
&lt;/div&gt;
&lt;script&gt;
jQuery(document).ready(function(){
	// CALCOLO DELLA VARIABILE res=sent
	var request_uri_      = window.location.pathname + window.location.search;
	// STAMPA A VIDEO LA LEGENDA SOLO SE NON ESITE LA VARIABILE DI RISPOSTA res=sent
	if (request_uri_.indexOf('?') == -1) {
		jQuery("#legenda").show();
		setTimeout(function(){
			jQuery("#legenda").insertBefore("#messaggio");	
		}, 1000);
	}else{
		jQuery("#legenda").hide();
	}
})
&lt;/script&gt;
&lt;!--################################################################################################################################################--&gt;
&lt;!--
/**
** Se per esempio il widget form di quoto viene installato su un sito di un campeggio (quindi un camping non ha camere), 
** e si desidera sostituire le frasi "+ aggiungi camere" e "- rimuovi camera", (perchè richiesto dal cliente), questo script d'esempio fa per voi!
** Naturalmente le etichette possono essere personalizzate su necessità!
**
** LO SCRIPT VA POSIZIONATO SUBITO SOTTO A: 
** &lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
*/
--&gt;
&lt;script&gt;
	// compilare language con la variabile statica della lingua, con una variabile php oppure con la globale di wordpress
	var language      = 'it'; ## (it | en | fr | de) || &lt;?=$language?&gt; || &lt;?=ICL_LANGUAGE_CODE;?&gt;
	var etichetta_add = '';
	var etichetta_rem = '';
	switch(language){
		case"it":
			etichetta_add = 'aggiungi unità abitativa';
			etichetta_rem = 'rimuovi unità abitativa';
			break;
		case"en":
			etichetta_add = 'add housing unit';
			etichetta_rem = 'remove housing unit';
			break;
		case"fr":
			etichetta_add = 'ajouter un logement';
			etichetta_rem = 'retirer l\'unité d\'habitation';
			break;
		case"de":
			etichetta_add = 'Wohneinheit hinzufügen';
			etichetta_rem = 'Gehäuseeinheit entfernen';
			break;
		case"es":
			etichetta_add = 'añadir unidad de vivienda';
			etichetta_rem = 'quitar unidad de vivienda';
			break;
		case"ru":
			etichetta_add = 'добавить единицу жилья';
			etichetta_rem = 'снять жилой блок';
			break;
		default:
			etichetta_add = 'add housing unit';
			etichetta_rem = 'remove housing unit';
			break;
	}
	jQuery(document).ready(function(){
		setTimeout(function(){
			jQuery("a#add").html("&lt;i class=\"fa fa-plus fa-w-14 fa-fw\"&gt;&lt;/i&gt; " + etichetta_add + "");
			jQuery("a#add").on("click",function(){
				jQuery("a#re").html("&lt;i class=\"fa fa-minus fa-w-14 fa-fw\"&gt;&lt;/i&gt; " + etichetta_rem + "");
			})
		}, 1000);
	})
&lt;/script&gt;
</pre>
<pre id="WD" style="background-color:#F7FBF5!important;">
&lt;!--JQUERY --&gt;
&lt;script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"&gt;&lt;/script&gt;
&lt;!-- QUOTO! form --&gt;
&lt;script type="text/javascript"&gt;
if(typeof window.quoto_form == 'undefined'){
	var quoto_form = jQuery.makeArray({
					'idsito'              : <?=$ID_SITO?>,
					'language'            : 'it',
					'bootstrap'       	  : 1,
					'captcha'         	  : 0,
					'ChiaveSitoReCaptcha' : '',   //v.2 Invisible
					'iubendapolicy'   	  : 0, 
					'iubendacode'         : '',
					'selBambini'   	      : 1,
					'maxEtaBambini'       : '',
					'tipoSoggiorni'       : '',
					'fontawesome'     	  : 1,
					'campoSconto'     	  : 0,
					'selectAnimali'   	  : 0,
					'selectAlloggi'       : 0,
					'tipoAlloggi'         : '',
					'multiStruttura'      : ''
			}); 
}
&lt;/script&gt;
&lt;div id="WidgetformQuoto"&gt;&lt;/div&gt;
&lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
&lt;!-- QUOTO! end form --&gt;</pre>
<p>
	<b>LEGENDA</b>
	<ul>
		<li>lo script necessità della libreria <b>jquery.js</b><br><br></li>
		<li><b>idsito</b>          	= ID_SITO <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> Se il valore non è auto compilato è da richiedere a Network Service</li>
		<li><b>language</b>        	= 'it' <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> (Italiano = it, Inglese = en, Francese = fr, Tedesco = de, Spagnolo = es, Russo = ru) <br><span style="font-size:12px">Queste altre lingue vengono visualizzate a video in inglese (Olandese = nl, Polacco = pl, Ungherese = hu, Portoghese = pt, Arabo = ae, Ceco = cz, Cinese = cn, Brasiliano = br, Giapponese = jp)</span></li>
		<li><b>bootstrap </b>      	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza il framework di Bootstrap, 0 non utilizza il framework</li>
		<li><b>captcha v.2 Invisible</b>         	= 0    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza il controllo captcha, 0 non utilizza il controllo</li>
		<li><b>ChiaveSitoReCaptcha</b> = '' 	<i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> se si utilizza il controllo captcha, compilare la chiave sito, la chiave segreta v.2 Invisible la legge da QUOTO Manager</li>
		<li><b>iubendapolicy</b>   	= 0    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza iubenda, 0 non utilizza iubenda</li>
		<li><b>iubendacode</b>      = ''   <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> se si utilizza iubenda, compilare i vari cookiePolicyId di iubenda 1234#4321#5678#8765#8788#9595 IT#EN#FR#DE#ES#RU</li>
		<li><b>selBambini</b>       = 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza la select Bambini, 0 non visualizza la select</li>
		<li><b>tipoSoggiorni</b>    = ''   <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> <span style="font-size:12px">se si desidera personalizzare le tipologie di soggiorno è necessario compilare tutte e 6 le lingue dividendo le lingue con un cancelletto(#) ed i valori con una virgola(,)</span>
		<li><span style="font-size:12px">ESEMPIO: Solo Pernotto,Mezza Pensione,Pensione Completa#Bed & Breakfast,Half Pensione,Full Pension#Nuitée uniquement,Demi-pension,Pension complète#Nur Übernachtung Halbpension,Vollpension#Sólo pernocta, Media Pensión, Pensión Completa#Только ночь, полупансион, полный пансион</span> </li>
		<li><span style="font-size:12px">valori  in italiano # valori in inglese # valori in francese # valori in tedesco # valori in spagnolo # valori in russo</span></li>
		<li><b>fontawesome</b>     	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza le Font Awesome, 0 non utilizza le Font</li>
		<li><b>campoSconto</b>     	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza il campo codice sconto, 0 non visualizza il campo nel form</li>
		<li><b>selectAnimali</b>   	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza la select animali ammmessi, 0 non visualizza la select</li>
		<li><b>selectAlloggi</b>    = 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza il campo Tipo alloggi(camere), 0 non visualizza il campo nel form</li>
		<li><b>tipoAlloggi</b>      = ''   <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> se si abilita il campo Tipo Alloggi è necessario compilare tutte e 6 le lingue dividendo le lingue con un cancelletto(#) ed i valori con una virgola(,)</li></span>
		<li><span style="font-size:12px">ESEMPIO: Camera Singola,Camere Doppia,Bungalows#Single Room, Double Room, Bungalows#Chambre Simple, Chambre Double, Bungalows#Einzelzimmer, Doppelzimmer, Bungalows#Habitación Individual, Habitación Doble, Bungalows#Одноместный номер, двухместный номер, бунгало </span></li>
		<li><span style="font-size:12px">valori  in italiano # valori in inglese # valori in francese # valori in tedesco # valori in spagnolo # valori in russo	</span></li>
		<li><b>multiStruttura</b>     	= ''    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> campo utile per siglare le richieste con una etichetta di provenienza</li>
		<li><span style="font-size:12px">ESEMPIO: Landing Page Estate 2023, oppure Hotel Demo, oppure dinamicamente in PHP ($_SERVER['REQUEST_URI']), oppure in JavaScript (window.location.pathname).</span></li>
	</ul>
</p>
<p></p>
<h3><b>APPLICATION PROGRAM INTERFACE</b></h3>
<script> var clipboard = new ClipboardJS('#FQ4fa');</script>
<P>Questa metodo necessità la <b>costruzione del FORM da parte del vostro WebMaster</b>, successivamente dovrà inviare il form (anche in ajax va bene, se si preferisce!) ad una pagina che contenga il codice qui compilato, oppure su se stesso!</P><br>
<div style="clear:both;padding:0px 0px 2px 5px!important"></div>
<i class="fa fa-code"></i>&nbsp;<b>CURL PHP PER API IN ASCOLTO</b> &nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
&nbsp;&nbsp;<a href="javascript:;" id="FQ4fa" data-clipboard-action="copy" data-clipboard-target="#FQ4" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a></small>	
<div class="clearfix" style="padding:0px 0px 2px 5px!important"></div>
<pre id="FQ4" style="background-color:#F7FBF5!important;">
&lt;?php
$dati = array(
		"nome"            => '', ## string ## require
		"cognome"         => '', ## string ## require
		"email"           => '', ## string ## require
		"language"        => '', ## string ## require ## (it || en || fr || de)
		"id_lingua"       => '', ## int ## require ## (it = 1 || en = 2 || fr = 3 || de = 4)
		"idsito"          => <?=$ID_SITO?>, ## int ## require 
		"urlback"         => '', ## string ## require ## (url di atterraggio post invio form)
		"action"          => 'send', ## string ## require
		"telefono"        => '', ## string
		"data_arrivo"     => '', ## date ## require ## (yyyy-mm-dd)
		"data_partenza"   => '', ## date ## require ## (yyyy-mm-dd)
		"DataArrivo"      => '', ## date ## (data arrivo aletenativa) ## (yyyy-mm-dd)
		"DataPartenza"    => '', ## date ## (data partenza aletenativa) ## (yyyy-mm-dd)
		"adulti"          => '', ## int ## require ## (totale adulti)
		"bambini"         => '', ## int ## require ## (totale bambini)
		### PRIMA CAMERA ##
		"TipoSoggiorno_1" => '', ## string ## require ## (Solo Pernotto || Mezza Pensione || Pensione Completa || All Inclusive)
		"NumAdulti_1"     => '', ## int ## require ## (1 || 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10)
		"NumBambini_1"    => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6)
		"EtaB1_1"         => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11 || 12 || 13 || 14)
		"EtaB2_1"         => '', ## int
		"EtaB3_1"         => '', ## int
		"EtaB4_1"         => '', ## int
		"EtaB5_1"         => '', ## int
		"EtaB6_1"         => '', ## int
		### SECONDA CAMERA ##
		"TipoSoggiorno_2" => '', ## string ## (Solo Pernotto || Mezza Pensione || Pensione Completa || All Inclusive)
		"NumAdulti_2"     => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10)
		"NumBambini_2"    => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6)
		"EtaB1_2"         => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11 || 12 || 13 || 14)
		"EtaB2_2"         => '', ## int
		"EtaB3_2"         => '', ## int
		"EtaB4_2"         => '', ## int
		"EtaB5_2"         => '', ## int
		"EtaB6_2"         => '', ## int
		### TERZA CAMERA ##
		"TipoSoggiorno_3" => '', ## string ## (Solo Pernotto || Mezza Pensione || Pensione Completa || All Inclusive)
		"NumAdulti_3"     => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10)
		"NumBambini_3"    => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6)
		"EtaB1_3"         => '', ## int ## (1 || 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11 || 12 || 13 || 14)
		"EtaB2_3"         => '', ## int
		"EtaB3_3"         => '', ## int
		"EtaB4_3"         => '', ## int
		"EtaB5_3"         => '', ## int
		"EtaB6_3"         => '', ## int

		"hotel"           => '', ## string ## (campo per la provenienza della richiesta oppure se avete più strutture inserire il nome di un hotel)
		"messaggio"       => '', ## string
		"codice_sconto"   => '', ## string 
		"marketing"       => '', ## int ## (1 || 0)
		"profilazione"    => '', ## int ## (1 || 0)
		"privacy"         => '', ## int ## require ## (1 || 0)
		"REMOTE_ADDR"     => '', ## string  ## (REMOTE_ADDR)
		"HTTP_USER_AGENT" => '', ## string  ## (HTTP_USER_AGENT)
		"tracking"        => '', ## string ## require ## (HTTP_REFERER)
		"utm_source"      => '', ## string ## (compilare il campo recuperando il valore dall'url se presente)
		"utm_medium"      => '', ## string ## (compilare il campo recuperando il valore dall'url se presente)
		"utm_campaign"    => '', ## string ## (compilare il campo recuperando il valore dall'url se presente)
		"_ga"             => '', ## string ## (compilare il campo recuperando il cookie  _ga ANALYTICS se presente)
		"CLIENT_ID"             => '', ## string ## (compilare il campo recuperando ed elaborando il cookie  _ga ANALYTICS se presente)
            );

            $userQ   = '<?=$user?>'; <?=$comm?><?="\r\n"?>
            $passQ   = '<?=$pass?>'; <?=$comm?><?="\r\n"?>
            $urlHost = 'https://www.quotocrm.it/apiForm/';

            $ch = curl_init($urlHost.'send_form.php'); 
            curl_setopt($ch, CURLOPT_USERPWD, $userQ.':'.$passQ);                                                                                                                               
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dati);                                                                                                                                                              
            curl_exec($ch); 

?&gt;
	####################################################################################################################################
	&lt;!--
	/**
	* INSERIRE OBBLIGATORIAMENTE QUESTI INPUT SENZA VALORI NEL FORM dentro il tag &lt;form&gt;&lt;/form&gt;
	* (il valore verrà scritto dal file javascript successivo che va inserito nel tag &lt;head&gt;&lt;/head&gt;)
	* (il mancato inserimento pregiudicherebbe il tracciamento delle campagne ADS)
	* &lt;input type="hidden" name="CLIENT_ID" id="CLIENT_ID"&gt;
	* &lt;input type="hidden" name="utm_source" id="utm_source"&gt;
	* &lt;input type="hidden" name="utm_medium" id="utm_medium"&gt;
	* &lt;input type="hidden" name="utm_campaign" id="utm_campaign"&gt;
	*/
	--&gt;
	####################################################################################################################################
	/**
	* INSERIRE OBBLIGATORIAMENTE LO SCRIPT NELLA PAGINA DEL FORM, SE IL FORM VIENE INCLUSO IN TUTTO IL SITO.
	* SE IL FORM VIENE INSERITO SOLO IN UNA PAGINA DEL SITO, LO SCRIPT VA INSERITO IN OGNI PAGINA
	* (il mancato inserimento pregiudicherebbe il tracciamento delle campagne ADS)
	*/	
	&lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/saveUtmApiQuoto.min.js"  async defer&gt;&lt;/script&gt;

</pre>	
################################################################################################################################################### <br>
<b>ATTENZIONE:</b> <br>
<b>Tutte le altre opzioni</b> (in uso fino al 31-12-2023) per includere nel proprio sito un form di QUOTO, <b>sono OBSOLETE!!</b><br>
Se doveste ancora avere in uso un vecchio sistema di raccolta dati da form, vi consigliamo di <b>sostituirlo con il Widget JS Form QUOTO!</b>
################################################################################################################################################### <br>
		<div style="clear:both;height:10px"></div>
			<div class="row">
				<div class="col-md-8"><img src="<?=BASE_URL_SITO?>img/logo_network_2021.png"></div>
				<div class="col-md-4">
			        <b>Network Service</b><br>
			        Via Valentini A. e L., 11 47922 Rimini (RN), Italia <br>
			        <b>Tel:</b> +39 0541790062 | <b>Fax:</b> +39 0541778656<br>
			        <b>Email:</b> info@network-service.it<br>
			        <b>Email Developer:</b> marcello@network-service.it
		      </div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p>&nbsp;</p>

		      </div>
			</div>
		</div>
</body>
</html>
