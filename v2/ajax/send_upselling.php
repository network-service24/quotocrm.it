<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 //error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');


		$lista_servizi_aggiuntivi = '';
		// Query per servizi aggiuntivi
		$query  = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi 
						WHERE hospitality_tipo_servizi.idsito = ".$_REQUEST['idsito']." 
						AND hospitality_tipo_servizi.Lingua = 'it' 
						AND hospitality_tipo_servizi.Abilitato = 1
						ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
		$risultato_query = mysqli_query($conn,$query);
		$tot_record      = mysqli_num_rows($risultato_query);

		if($tot_record > 0){
			$lista_servizi_aggiuntivi .='<style>
												.iconaDimension {
													width:auto !important;
													height:32px !important;
												} 
												.content_icona{
													width:auto !important;
													height:32px !important;
													padding:4px!important;
													margin: 4px!important;
													border:1px solid #ccc!important;
													border-radius: 4px 4px 4px 4px!important;
													-moz-border-radius: 4px 4px 4px 4px!important;
													-webkit-border-radius: 4px 4px 4px 4px!important;
													display: inherit !important;
												}
												.content_icona_empty{
													width:auto !important;
													height:32px !important;
													padding:4px!important;
													margin: 4px!important;
													display: inherit !important;
												 }
												tr{
													height:48px !important;
												}
										</style>
										<table cellpadding="10" cellspacing="0" border="0" style="width:60%;">
											<tr>
												<td colspan="4" style="text-align:center"><b>Servizi Aggiuntivi</b></td>
											</tr>';
			while($campo = mysqli_fetch_assoc($risultato_query)){				
								$lista_servizi_aggiuntivi .='<tr>
																<td style="text-align:center">'.($campo['Icona']!=''?'<div class="content_icona"><img src="'.BASE_URL_SITO.'uploads/'.$_REQUEST['idsito'].'/'.$campo['Icona'].'" class="iconaDimension"></div>':'<div class="content_icona_empty"></div>').'</td>
																<td style="text-align:left"><b>'.$campo['TipoServizio'].'</b></td>																
																<td style="text-align:center">'.$campo['CalcoloPrezzo'].'</td>
																<td style="text-align:center">'.($campo['PrezzoServizio']!=0?'&euro;&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-info">Gratis</small>').'</td>                                                                   
															</tr>';

			}
			$lista_servizi_aggiuntivi .='</table>';
		}

		$id_rich = substr($_REQUEST['checkbox'],0,-1);
		$qry  = "SELECT hospitality_guest.Email,hospitality_guest.NumeroPrenotazione FROM hospitality_guest 
						WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']." 
						AND hospitality_guest.Id IN (".$id_rich.")";
		$ris_qry = mysqli_query($conn,$qry);
		$destinatari = array();
		$i = 1;
		while($valore = mysqli_fetch_assoc($ris_qry)){	
			$destinatari[] = ' [Nr.'.$valore['NumeroPrenotazione'].'] '.$valore['Email'];
			$i++;
		}

			echo'<script type="text/javascript">
					$(function() {
						$("#email_upselling").modal("show");    
						$("#view_servizi").on("click",function(){
							   $("#elenco_servizi").toggle();   
							}); 
						$("#preview").on("click",function(){
							$("#screenshot").toggle();   
						});  
						$("#form_upselling").on("submit",function(){
							$("#view_loading").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/logo_loading_mail.png" alt="QUOTO v2" style="max-width:50%;"><div class="clearfix">&nbsp;</div><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.gif" alt="Invio Email di Upselling CRM QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Invio in corso..., attendere il suo termine, prima di cambiare schermata!</small></div></div>\');
							$("#content_upselling").hide();
						})                                           
					});
				</script> 
				<!-- modale per invio email di upselling -->
				<div class="modal fade" id="email_upselling"  role="dialog" aria-labelledby="myemail_upselling">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myemail_upselling">Invia email di UpSelling <small>(one-shot deal/una occasione unica)</small></h4>
						</div>
							<div class="modal-body">
							<div id="risultato_send_upselling"></div>							
								<div class="alert alert-profila alert-default-profila alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<p>Utilizzare questo modulo per inviare una proposta di UPSELLING sulle prenotazioni già confermate!</p>
									<p>E\' possibile personalizzare il testo del messaggio inserendo la variabile <b>[cliente]</b>, la variabile <b>[struttura]</b>, la variabile <b>[proposta]</b> e la variabile <b>[servizi]</b></p>                                             
									<p>Al momento dell\'invio il sistema sostituirà <b>[cliente]</b> con il <b>Nome</b> ed il <b>Cognome</b> del contatto, sostituirà <b>[struttura]</b> con l\'intestazione della <b>vostra attività</b>, sostituirà <b>[proposta]</b> con il riepilogo della <b>Prenotazione Confermata</b> e sostituirà <b>[servizi]</b> con l\'elenco dei <b>servizi aggiunti</b>, naturalmente nella lingua impostata nella prenotazione.</p>
									<p>Per visualizzare un promemoria dei <b>[servizi]</b>, <span id="view_servizi" style="cursor:pointer;color:#3c8dbc">CLICCA QUI!!</span>.</p>
									<div id="elenco_servizi" style="display:none!important"><br>'.$lista_servizi_aggiuntivi.'</div>
								</div>
								<form id="form_upselling" name="invio_upselling" method="post" action="'.BASE_URL_SITO.'send_email_upselling/">
									<div class="form-group">
										<label data-toogle="tooltip" title="Destinatari/o"><i class="fa fa-fw fa-users"></i> Destinatari/o E-mail</label>
										<textarea id="xx" name="xx" rows="'.(count($destinatari)>5?'4':'1').'" cols="50" class="form-control no_border_top_dx bold" readonly="readonly">'.implode(',',$destinatari).'</textarea>
									</div>
									<div class="form-group">
										<label>Oggetto E-mail</label>
											<div class="input-group">
													<span class="input-group-addon"  data-toogle="tooltip" title="Inserire un oggetto"><i class="fa fa-fw fa-pencil"></i></span>
													<input type="text" id="oggetto" name="oggetto" placeholder="Oggetto:[cliente], approfitta di un occasione imperdibile!" class="form-control no_border_top_dx bold" value="[cliente], approfitta di un occasione imperdibile!" required>
											</div>
									</div>
									<div id="view_loading"></div>
										<div id="content_upselling">
												<div class="form-group">
													<label>Contenuto E-mail</label>											
													<textarea id="send_email_upselling" name="testo_upselling" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >
														<img src = "'.BASE_URL_SUITEWEB.'v2/uploads/loghi_siti/'.$_REQUEST['avatar'].'" />
													<br><br>
														Gentile <b>[cliente]</b>,
													<br><br>
														a breve sarai ospite della nostra struttura, prima del tuo arrivo vorremmo proporti una occasione imperdibile!
													<br><br>
														Ti proponiamo di cambiare la tua scelta con........... a soli €.............
													<br><br>
														<b>Rispondi a questa email per dare il tuo assenso a questa occasione imperdibile!</b> 
													<br><br><br>
														<b>La tua Prenotazione Confermata:</b>
													<br><br>
														[proposta]
													<br><br>
														<b>Scegli uno dei servizi:</b>
													<br><br>
														[servizi]
													<br><br>	
														<span style="font-size:12px">(<em>esprimi liberamente le tue richieste e se desideri aggiungere uno o più servizi, menzionali nell\'email di risposta!</em>)</span>
													<br><br>
														Il nostro staff modificherà il tuo soggiorno adeguatamente, aggiornando la prenotazione confermata prima del tuo arrivo!		
													<br><br>
														<b>[struttura]</b>
													</textarea>
													<script type="text/javascript">
													$(function() {
														CKEDITOR.replace(\'send_email_upselling\');
														$(".textarea").wysihtml5();                                                   
													});
												</script>  
												<script type="text/javascript" src="'.BASE_URL_SITO.'xcrud/editors/ckeditor/ckeditor.js"></script>
												<script type="text/javascript">
															CKEDITOR.config.toolbar = [
																			[\'Source\',\'-\',\'Maximize\'],[\'Format\',\'Font\',\'FontSize\'],
																			[\'Bold\',\'Italic\',\'Underline\'],
																			[\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],
																			[\'Image\',\'Table\',\'Link\',\'TextColor\',\'BGColor\']
																		] ;
															CKEDITOR.config.autoGrow_onStartup = true;
															CKEDITOR.config.extraPlugins = \'autogrow\';
															CKEDITOR.config.autoGrow_minHeight = 400;
															CKEDITOR.config.autoGrow_maxHeight = 600;
															CKEDITOR.config.autoGrow_bottomSpace = 50;           
													</script>
														<input type="hidden" name="checkbox" value="'.$_REQUEST['checkbox'].'">
														<input type="hidden" name="idsito" value="'.$_REQUEST['idsito'].'">
														<input type="hidden" name="action" value="send_email_upselling">
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-4 text-center"></div>
														<div class="col-md-4 text-center"><button type="submit" id="button_send" class="btn btn-primary">Invia email</button></div>
														<div class="col-md-4 text-right"><div class="clearfix"></div><button type="button" class="btn btn-xs bg-black" data-dismiss="modal">Chiudi</button></div>
													</div>
												</div>
										</div>
									</form>                                                                                                           
								</div>
							</div>
						</div>
					</div>
				</div>';


?>