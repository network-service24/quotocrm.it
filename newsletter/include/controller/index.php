 <?php
$js_Check_email ='
<script>
/* check sul campo email in tempo reale, se email esiste CNAME */
    $( document ).ready(function() {
        $("#bottone_salva").attr("disabled","true");
        if($(\'#email\').val() != \'\'){
            var EmailCliente = $(\'#email\').val().trim();
            var EmailOperatore = \''.MAIL_CHECK.'\';
            if(EmailCliente.length>=2){
                $.ajax({        
                    type: "POST",         
                    url: "'.BASE_URL_SITO.'ajax/check_valid_email.php",        
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",        
                    success: function(data){
                        var classe = \'\';
                        if(data == \'valid\'){
                            $("#check_email").html(\'<small class="text-green">email valida ed esistente</small>\');
                            $("#bottone_salva").removeAttr("disabled");
                        }else{
                            $("#check_email").html(\'<small class="text-red">email non valida ed inesistente</small>\');
                            $("#bottone_salva").attr("disabled","true");
                        }
                        
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare..."); 
                    }
                });
            }else{
                $("#bottone_salva").removeAttr("disabled");
            }
        }

            $("#email").bind("keyup focusout mouseenter", function () { 
                var EmailCliente = $("#email").val().trim();
                var EmailOperatore = "'.MAIL_CHECK.'";
                if(EmailCliente.length>=2){
                    $.ajax({        
                    type: "POST",         
                    url: "'.BASE_URL_SITO.'ajax/check_valid_email.php",        
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",        
                        success: function(data){
                            var classe = "";
                            if(data == "valid"){
                                $("#check_email").html(\'<small class="text-green">email valida ed esistente</small>\');
                                $("#bottone_salva").removeAttr("disabled");
                            }else{
                                $("#check_email").html(\'<small class="text-red">email non valida ed inesistente</small>\');
                                $("#bottone_salva").attr("disabled","true");
                            }
                            
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare..."); 
                        }
                    });
                }else{
                    $("#bottone_salva").removeAttr("disabled");
                }
            });
    });
</script>'."\r\n";

 	# query  per cancellazione dati  
	if($_REQUEST['action']=='delete'){
		if($_REQUEST['delete']){
			foreach($_REQUEST['delete'] as $key => $value){
			
				$delete = "DELETE FROM mailing_newsletter WHERE id = '".$value."'";
				$dbMysqli->query($delete);
				
			}
		}		
	}

	# query  per inserimento dati  
 	if($_REQUEST['action']=='insertL'){
		$select = "SELECT * FROM mailing_newsletter_nome_liste WHERE idsito = ".IDSITO." AND nome_lista = '".addslashes($_REQUEST['nome_lista'])."' ";
		$arrec = $dbMysqli->query($select);
		if(sizeof($arrec)>0){
			$prt->alertgo('La lista è già presente in questa lista!',BASE_URL_SITO.'newsletter/index/');
		}else{
			$inserimento = "INSERT INTO mailing_newsletter_nome_liste (idsito,nome_lista,visibile) VALUE('".IDSITO."','".addslashes($_REQUEST['nome_lista'])."','1')";
			$dbMysqli->query($inserimento);
			$prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-index/');
		}
			
	}
	# query  per inserimento dati  
	if($_REQUEST['action']=='insert'){
		$select = "SELECT * FROM mailing_newsletter WHERE idsito = ".IDSITO." AND id_lista = ".$_REQUEST['id_lista']." AND nome = '".addslashes($_REQUEST['nome'])."' AND cognome = '".addslashes($_REQUEST['cognome'])."'  ";
		$arrec = $dbMysqli->query($select);
		if(sizeof($arrec)>0){
			$prt->alertgo('Il nominativo è già presente in questa lista!',BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-index/');
		}else{
			$inserim = "INSERT INTO mailing_newsletter (idsito,id_lista,nome,cognome,email,lingua,ip,data,agent,CheckConsensoPrivacy,CheckConsensoMarketing,attivo) VALUE('".IDSITO."','".$_REQUEST['id_lista']."','".addslashes($_REQUEST['nome'])."','".addslashes($_REQUEST['cognome'])."','".$_REQUEST['email']."','".$_REQUEST['lingua']."','".$_REQUEST['ip']."','".$_REQUEST['data']."','".$_REQUEST['agent']."','".$_REQUEST['CheckConsensoPrivacy']."','".$_REQUEST['CheckConsensoMarketing']."','1')";
			$dbMysqli->query($inserim);
			$prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-index/');
		}			
	}

	# query  per lettura dati  
	$query_gen  = "SELECT mailing_newsletter.* ,mailing_newsletter_nome_liste.nome_lista FROM mailing_newsletter INNER JOIN mailing_newsletter_nome_liste ON mailing_newsletter_nome_liste.id = mailing_newsletter.id_lista WHERE mailing_newsletter.idsito = ".IDSITO." ORDER BY mailing_newsletter.id DESC,mailing_newsletter_nome_liste.nome_lista ASC";  
	$arr_r     = $dbMysqli->query($query_gen);
	if(sizeof($arr_r)>0){
		$num   = 1;
		$Data  = '';
		$color = '';
		$iscritti .= '<h2>LISTA UTENTI '.NOME_CLIENT_EMAIL.'</h2>
						
						<form action="'.$_SERVER['REQUEST_URI'].'" method="post" name="form1" id="form1">
						<table id="TabellaLayout" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
						<thead>
							<tr>
								<th>Identificativo</th>
								<th>Lista</th>
								<th>Nome</th>
								<th>Cognome</th>
								<th>Email</th>
								<th>Lingua</th>
								<th>Consensi</th>
								<th class="text-center">Abilita Invio</th>
								<th class="text-center"></th>
							</tr>
						</thead>'."\r\n";
		foreach($arr_r as $key => $val){

			$Data_t            = explode('-',$val['data']);			
			$Data              = $Data_t[2].'-'.$Data_t[1].'-'.$Data_t[0];

			$iscritti .= '<tr id="bg-riga'.$val['id'].'" '.($val['attivo']==0?'style="background-color:#FAE0DA"':'').'>
								<td class="text-center nowrap"><label class="badge bg-green ml-auto pointer">'.$val['id'].'</label></td>					
								<td class="nowrap"><b class="text-success">'.ucfirst($val['nome_lista']).'</b></td>
								<td class="nowrap"><b>'.stripslashes($val['nome']).'</b></td>
								<td class="nowrap"><b>'.stripslashes($val['cognome']).'</b></td>
								<td class="nowrap"><b class="text-info">'.$val['email'].'</b></td>
								<td class="text-center"><img src="'.BASE_URL_SITO.'img/flags/'.$val['lingua'].'.png" class="image_flag"></td>
								<td style="width:20%"><div id="view_consensi_gdpr'.$val['id'].'" class="pointer"><small>Consensi GDPR <i class="fa fa-chevron-down" style="float:right;padding-top:5px"></i></small></div>
								<div id="consensi_gdpr'.$val['id'].'" style="display:none">
								<small>';

					$iscritti .= '<b>Data</b>: '.$Data.'';
					$iscritti .= ($val['ip']!=''?'<br><b>Fonte IP</b>: '.$val['ip']:'');
					$iscritti .= ($val['agent']!=''?'<br><b>Agent</b>: '.$val['agent']:'');

					$iscritti .= '<br><b>Consenso trattamento dati</b>: '.($val['CheckConsensoPrivacy']==1?'<i class="fa fa-check-square-o text-black"></i>':'<i class="fa fa-square-o text-black"></i>');
					$iscritti .= '<br><b>Consenso invio materiale marketing</b>: '.($val['CheckConsensoMarketing']==1?'<i class="fa fa-check-square-o text-black" id="marketing'.$val['id'].'" style="cursor:pointer" data-id="0"></i><span id="new_marketing_green'.$val['id'].'"></span>':'<i class="fa fa-square-o text-black" id="marketing'.$val['id'].'" style="cursor:pointer" data-id="1"></i><span id="new_marketing_red'.$val['id'].'"></span>');    
					$iscritti .= '<br><b>Consenso profilazione</b>: '.($val['CheckConsensoProfilazione']==1?'<i class="fa fa-check-square-o text-black" id="profilazione'.$val['id'].'" style="cursor:pointer" data-id="0"></i><span id="new_profilazione_green'.$val['id'].'"></span>':'<i class="fa fa-square-o text-black" id="profilazione'.$val['id'].'" style="cursor:pointer" data-id="1"></i><span id="new_profilazione_red'.$val['id'].'"></span>');
							
					$iscritti .= '
									<script type="text/javascript">
															$(document).ready(function(){
																	$("#marketing'.$val['id'].'").click(function(){
																	if (window.confirm("ATTENZIONE: Sicuro di modifcare il consenso?")){
																		var valore_marketing = $("#marketing'.$val['id'].'").data("id");
																		$.ajax({
																				url: "'.BASE_URL_SITO.'ajax/consensi/change_consenso_marketing_newsletter.php",
																				type: "POST",
																				data: "id='.$val['id'].'&valore_marketing="+valore_marketing,
																				dataType: "html",
																				success: function(data) { 
																				$("#marketing'.$val['id'].'").remove();
																				$("#log'.$val['id'].'").remove();
																					if(valore_marketing==1){
																						$("#new_marketing_red'.$val['id'].'").html("<i class=\"fa fa-check-square-o text-black\" id=\"marketing'.$val['id'].'\" style=\"cursor:pointer\" data-id=\"0\"></i>");                                                       
																					}else{
																						$("#new_marketing_green'.$val['id'].'").html("<i class=\"fa fa-square-o text-black\" id=\"marketing'.$val['id'].'\" style=\"cursor:pointer\" data-id=\"1\"></i>"); 
																					}
																				}
																			});                                                               
																			return false;
																		}
																	});

																	$("#profilazione'.$val['id'].'").click(function(){
																		if (window.confirm("ATTENZIONE: Sicuro di modifcare il consenso?")){
																			var valore_profilazione = $("#profilazione'.$val['id'].'").data("id");
																			$.ajax({
																				url: "'.BASE_URL_SITO.'ajax/consensi/change_consenso_profilazione_newsletter_gdpr.php",
																				type: "POST",
																				data: "id='.$val['id'].'&valore_profilazione="+valore_profilazione,
																				dataType: "html",
																				success: function(data) { 
																					$("#profilazione'.$val['id'].'").remove();
																					$("#log'.$val['id'].'").remove();
																					if(valore_profilazione==1){
																						$("#new_profilazione_red'.$val['id'].'").html("<i class=\"fa fa-check-square-o text-black\" id=\"profilazione'.$val['id'].'\" style=\"cursor:pointer\" data-id=\"0\"></i>");                                                       
																					}else{
																						$("#new_profilazione_green'.$val['id'].'").html("<i class=\"fa fa-square-o text-black\" id=\"profilazione'.$val['id'].'\" style=\"cursor:pointer\" data-id=\"1\"></i>"); 
																					}
																				}
																			});                                                               
																			return false;
																		}
																		});

																	$("#view_consensi_gdpr'.$val['id'].'").on("click",function(){
																		$("#consensi_gdpr'.$val['id'].'").toggle();
																	});

																});
															</script>';
																				
			$iscritti .= '				</small>
									</div>
								</td>
								<td class="text-center">
									<input type="checkbox" id="attivo'.$val['id'].'" class="js-switch" value="1" '.($val['attivo']==1?'checked="checked"':'').' name="attivo">
									<script>
									$(document).ready(function () {
										$(\'#attivo'.$val['id'].'\').on("change", function(){
											var idsito = '.IDSITO.';
											var id     = '.$val['id'].';
											var attivo = "";
											if($(\'#attivo'.$val['id'].'\').prop("checked")){
												 attivo = 1;
											}else{
												 attivo = 0;
											}
											$.ajax({        
												type: "POST",         
												url: "'.BASE_URL_SITO.'ajax/consensi/save_user_newsletter_preference.php",        
												data: "idsito=" + idsito + "&attivo=" + attivo + "&id=" + id,
												dataType: "html",        
												success: function(data){
													if(attivo == 0){
														$(\'#bg-riga'.$val['id'].'\').attr("style","background-color:#FAE0DA!important");
													}else{
														$(\'#bg-riga'.$val['id'].'\').attr("style","");
													}													
													//console.log(data);
												},
												error: function(){
													alert("Chiamata fallita, si prega di riprovare..."); 
												}
											});
										});
									});
								</script>
								</td>
								<td class="text-center">
									<input name="delete['.$val['id'].']" type="checkbox" value="'.$val['id'].'" class="seleziona" />';
			$iscritti .= '	    </td>
						</tr>';

			$num++;
		}
		$iscritti .='
					<tfoot>
						<tr>
							<td class="text-right" colspan="9">
							<input name="arg" type="hidden" value="liste_newsletter" />
							<input name="action" type="hidden" value="delete" />
							<button type="submit" class="btn  btn-danger">CANCELLA</button>
							</td>                             
						</tr>
					</tfoot>';

		$iscritti .= '</table> 
					</form>
						<script>
							$(document).ready(function () {

							$(\'#TabellaLayout\').DataTable({
									"paging": true,
									"pagingType": "simple_numbers",    
									"language": {
										 "search": "Filtra i risultati:",
										 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
										 "paginate": {
											 "previous": "Precedente",
											 "next":"Successivo",
										 },
										 buttons: {
											pageLength: {
												_: "Mostra %d elementi",
												\'-1\': "Mostra tutto"
											}
										}
									},
									dom: \'Bfrtip\',
									lengthMenu: [
										[ 10, 25, 50, -1 ],
										[ \'10 risultati\', \'25 risultati\', \'50 risultati\', \'Tutti\' ]
									],						
									buttons: [ \'pageLength\',
										{
											text: \'Seleziona tutti\',
											action: function () {
												$(".seleziona").prop("checked", true);
	
											}
										},
										{
											text: \'Togli selezione a tutti\',
											action: function () {
												$(".seleziona").prop("checked", false);
											}
										}
									],
								});
								$(\'#TabellaLayout\').DataTable().order([0,\'desc\']).draw();
								//$(\'.dataTables_length\').addClass(\'bs-select\');

							});
						</script>';

		$iscritti .= '<div class="clearfix p-b-20"></div>
						<div class="alert alert-info text-center text-black">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							I nominativi che vengono inseriti in '.NOME_CLIENT_EMAIL.' dalle varie importazioni dall\'area preventivi e/o prenotazioni chiuse, se non hanno il consenso a ricevere materiale marketing, verranno inseriti disabilitati!<br>
							Il diritto di cancellazione e/o modifica dei consensi secondo la GDPR, viene reso possibile al mittente da un link all\'interno di ogni email inviata da '.NOME_CLIENT_EMAIL.' di QUOTO!                                         
						</div>';
	}else{
		$iscritti = 'Nessun iscritto inserito!';
	}

$js_script ='
		<script>
			$(document).ready(function(){
				$("#open_forminsert").on("click",function(){
					$("#notaint").toggle("fade");
				});
				$("#add_insert").on("click",function(){
					$("#add").toggle("fade");
				});								
			});		
		</script>';


  
?> 