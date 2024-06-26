<?
  $ChekAPI = $fun->checkAPIQuotoHotel(IDSITO);  

	if($_REQUEST['azione']== 'delete_form'){

		//form_header
		$sql_delete = 'delete from	hospitality_form_testata where idsito = '.IDSITO.' and id = '.$_REQUEST['param'];
		$dbMysqli->query($sql_delete);

		//form_header_lang
		$sql_delete = 'delete from	hospitality_form_testata_lang where id_form = '.$_REQUEST['param'];
		$dbMysqli->query($sql_delete);

		//form_content
		$sql_delete = 'delete from	hospitality_form_contenuti where id_sito = '.IDSITO.' and id_form = '.$_REQUEST['param'];
		$dbMysqli->query($sql_delete);

		//form_content_lang
		$sql_delete = 'delete from	hospitality_form_contenuti_lang where id_sito = '.IDSITO.' and id_form = '.$_REQUEST['param'];
		$dbMysqli->query($sql_delete);

		header('Location:'.BASE_URL_SITO.'setting-form/');
	}

  include(BASE_PATH_SITO.'include/controller/inc/genera_form_quoto.inc.php');

  $id_form = getIdForm(IDSITO);    

	$content_js = '<script type="text/javascript">
					//javascript che gestisce la comparsa/scomparsa del dettaglio nelle singole righe
					function fuser(id) {
						div2mov="#"+id;
						$(div2mov).slideToggle(200);
					}
				</script>
 				<script>
					$(function(){
						$(\'.content_tipo\').each(function(i,el){
							var tipo = $(this).val();
							var raw = $(this).attr(\'id\');
							var id=raw.split("_"); 
							id = id[2];
							switch(tipo){
								case \'2\':
										$("#istr_"+id).html(\'Inserimento opzioni SELECT:<br>[value]=[etichetta] separati da "," in mancanza del parametro [value] verrà associato un valore numerico\');
										$("#param_"+id).show();							
									break;
								case \'4\':
										$("#param_"+id).show();								
									break;								
								case \'9\':
										$("#param_"+id).show();								
									break;								
								default:
										$("#param_"+id).hide();
									break;								
							}
						});
						//$(\'.extraData\').hide();
					});
					function addOpzioni(tipo, id){
						switch(tipo){
							case \'2\':
									$("#istr_"+id).html(\'Inserimento opzioni SELECT:<br>[value]=[etichetta] separati da "," in mancanza del parametro [value] verrà associato un valore numerico\');
									$("#param_"+id).show();								
								break;
							case \'4\':
									$("#param_"+id).show();								
								break;
							case \'9\':
									$("#param_"+id).show();;								
								break;
							default:
									$("#param_"+id).hide();
								break;
						}
					}
					
					function registraDati(form){
						document.form.submit();
						return true;
					}
					
					function insertField(nLingue,idForm,idSito){
                       $.ajax({
                            url: \''.BASE_URL_SITO.'ajax/form/add_campo_new.php\',
                            type: "POST",
                            data: \'idForm=\'+idForm+\'&idSito=\'+idSito+\'&action=insertField\',
                                success: function(data) {                                                                                                          
                                    $("div#add_campo").html(\'<div class="alert alert-success alert-dismissable"><p>Nuovo campo creato con successo! Attendi il reload della pagina o premere F5</p></div>\');        
                                      setTimeout(function(){
                                      	$("#add_campo").fadeOut(300); 
										  window.location.reload();                                                                                        
                                        },3000);
										
                                }                                                          
                          });                                                               
                        return false; // con false senza refresh della pagina
			
					}
					function delField(idCampo,idForm,idSito){
                       $.ajax({
                            url: \''.BASE_URL_SITO.'ajax/form/del_campo_new.php\',
                            type: "POST",
                            data: \'idCampo=\'+idCampo+\'idForm=\'+idForm+\'&idSito=\'+idSito+\'&action=delField\',
                            dataType: "html",
                                success: function(data) {                                                                                                         
                                    $("div#add_campo").html(\'<div class="alert alert-success alert-dismissable"><p>Campo eliminato con successo! Attendi il reload della pagina o premere  F5</p></div>\');        
                                    setTimeout(function(){
                                      	$("#add_campo").fadeOut(300); 
										 window.location.reload();																			                                                   
                                        },3000);
                               }                                                          
                          });                                                               
                        return false; // con false senza refresh della pagina
			
					}					


				</script> '."\r\n";                                    
                              

                    $form = array();
                    $lingue = getLingueSito(IDSITO);
                      foreach($lingue as $k => $v){
						$form[$k] = get_form_new($id_form,IDSITO,$k,'');	

                           	$rnd_id = 'id'.date('Ymdhis').rand(0,999999);          
                                $content.= '<div class="panel box box-success">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$v.'">
                                                      <i class="fa fa-link"></i>&nbsp;&nbsp;<span class="text-black">Impostazioni Form per la lingua <img src="'.BASE_URL_SITO.'img/flags/mini/'.$v.'.png"></span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse'.$v.'" class="p-t-20 panel-collapse collapse">
                                             <div class="box-body">';
                                             
	            $content .='  <script type="text/javascript">                                                                                                   
                                    $(document).ready(function() {
                                        $("#form_'.$rnd_id.'").submit(function(){
                                            
                                            var dati = $("#form_'.$rnd_id.'").serialize();                                                            
                                                $.ajax({
                                                    url: \''.BASE_URL_SITO.'ajax/form/mod_form_nwsl_new.php\',
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(msg) {     
                                                          console.log(msg);                                                                                                     
                                                           $("div#mod_new_'.$v.'").html(\'<div class="alert alert-success alert-dismissable"><p>Impostazioni per la lingua <img src="'.BASE_URL_SITO.'img/flags/mini/'.$v.'.png"> salvate  con successo! Attendi la scomparsa di questo box message!</p></div>\');        
                                                          setTimeout(function(){
                                                            $("#mod_new_'.$v.'").fadeOut(200);                                                       
                                                            },3000);     																
                                                        }                                                          
                                                  });                                                               
                                                return false; // con false senza refresh della pagina
                                            });                                                                                                                                                                                                                                                                    
                                    });
                                   </script>'."\r\n" ;										 
											 
                                    $content .= '
                                            <style>
                                                ul {
                                                  padding:0px;
                                                  margin: 0px;
                                                }
                                                #response {
                                                  /*padding:10px;
                                                  background-color:#9F9;
                                                  border:2px solid #396;
                                                  margin-bottom:20px;*/
                                                }
                                                #list li {
                                                  border-radius: 2px;
                                                  padding: 10px;
                                                  background: #F3F4F5 none repeat scroll 0% 0%;
                                                  margin-bottom: 2px;
                                                  border-left: 1px solid #E6E7E8;
                                                  color: #444;
                                                  list-style: none;
                                                }
                                                .rmvwidth {
                                                   max-width: 3% !important;                                                
												                        }
                                                </style>
                                                <script type="text/javascript">
                                                $(document).ready(function(){   
                                                    function slideout(){
                                                  setTimeout(function(){
                                                  $("#response").slideUp("slow", function () {
                                                      });
                                                    
                                                }, 2000);}
                                                  
                                                  $("#response").hide();
                                                  $(function() {
                                                  $("#list ul").sortable({ opacity: 0.8, cursor: \'move\', update: function() {
                                                      
                                                      var order = $(this).sortable("serialize") + \'&update=update\'; 
                                                      $.post("'.BASE_URL_SITO.'ajax/form/salvaordine_campi.php", order, function(theResponse){
                                                        $("#response").html(theResponse);
                                                        $("#response").slideDown(\'slow\');
                                                        slideout();
                                                      });                                
                                                    }                 
                                                    });
                                                  });

                                                });
                                              
                                                </script>'."\r\n" ;

                                    $content .='<script>

                                                    function ChangeOpzioni'.$k.'(id_tipo_input,id_campo,name,label,obb,idContent){  

                                                          $.ajax({                                                   
                                                            type: "POST",                                                   
                                                            url: "'.BASE_URL_SITO.'ajax/form/change_campo.php",                                                   
                                                            data: "id_tipo_input=" + id_tipo_input +"&id_campo=" + id_campo +"&label=" + label +"&obb=" + obb +"&name=" + name +"&idContent=" + idContent,
                                                            dataType: "html",                                                   
                                                            success: function(data){
                                                              $("#content_'.$k.'_"+id_campo).html(data);
                                                              if(id_tipo_input==18 || id_tipo_input==17){
                                                                $("#content_label_"+id_campo).hide();
                                                                $("#content_name_"+id_campo).hide();
																$("#content_obbligatorio_"+id_campo).hide();
                                                              }else{
                                                                $("#content_label_"+id_campo).show();
                                                                $("#content_name_"+id_campo).show();
                                                                $("#content_obbligatorio_"+id_campo).show();
                                                              }
                                                              
                                                            }
                                                          });
                                                    }  

               
                                                      function Change_label'.$k.'(label,id_campo){ 
                                                            $.ajax({                 
                                                              type: "POST",                
                                                              url: "'.BASE_URL_SITO.'ajax/form/change_label.php",                 
                                                               data: "label=" + label +"&id_campo=" + id_campo,
                                                              dataType: "html",                 
                                                              success: function(data){
                                                                $("#content_'.$k.'_"+id_campo).html(data);
                                                              },
                                                              error: function(){
                                                                alert("Chiamata fallita, si prega di riprovare..."); 
                                                              }
                                                          });
                                                      }    

                                                                      
                                                      function Change_obb'.$k.'(obb,id_campo){ 
                                                           $.ajax({                 
                                                              type: "POST",                
                                                              url: "'.BASE_URL_SITO.'ajax/form/change_obb.php",                 
                                                              data: "obb=" + obb +"&id_campo=" + id_campo,
                                                              dataType: "html",                 
                                                              success: function(data){
                                                                $("#content_'.$k.'_"+id_campo).html(data);
                                                              },
                                                              error: function(){
                                                                alert("Chiamata fallita, si prega di riprovare..."); 
                                                              }
                                                          });
                                                      } 
                                              </script>'."\r\n" ;  											 
											 
              $content .=' <form method="post" id="form_'.$rnd_id.'" name="form_'.$rnd_id.'" >						
                              <input type="hidden" name="idsito" id="idsito" value="'.IDSITO.'">
                              <input type="hidden" name="idform" id="idform" value="'.$id_form.'">
                              <input type="hidden" name="act" id="act" value="upd">
                              <input type="hidden" name="nomeForm" id="nomeForm" value="'.$v.'_'.$form[$k]['header']['nome_form']['form_ref'].'">							
                              <input type="hidden" name="id_lang" id="id_lang" value="'.$k.'">';                                             
                                                	
                                                	
                                
                                if(isset($form[$k]['content'])){

                                                                      
                                     $content.= '<div class="row">
                                                    <div class="col-md-12"><h4>Gestione dei Campi</h4></div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-12">
                                                      <div class="alert alert-profila alert-default-profila alert-dismissable">
                                                        <b>LEGENDA:</b>
                                                          <ul style="list-style-type: none;">
                                                            <li><small>Se modificate la <b>tipologia di un campo</b>, la modifica va ripetuta anche nelle altre lingue, se presenti!</small></li>
                                                            <li><small>Se modificate <b>l\'etichetta</b>, cliccate dentro un\'altro campo per applicare la modifica!</small></li>
                                                            <li><small>Per <b>ordinare</b> i campi usare il Drag and Drop, l\'odinamento viene salvato per tutte le lingue!</small></li>
                                                            <li><small>L\'aggiunta di <b>nuovi campi</b> viene ripetuta per tutte le lingue presenti, ma ricordatevi di personalizzare i campi per ogni lingua!</small></li>
                                                            <li class="text-maroon"><small>Se si aggiunge un <b>nuovo/i campo/i</b> scrivere manualmente il <b>name=""</b> dentro il <b>"Campo"</b> che deve essere uguale al <b>Name</b> dell\'italiano!</small></li>
                                                            <li class="text-red"><small>Se date obbligatorio ad una <b>select</b> per funzionare deve avere il placeholder uguale alla prima etichetta dei parametri, ma senza spazi (cioè una parola unica)!</small></li>
                                                            <li class="text-info"><small>L\'aggiunta di uno o più campi è possibile, ma è neccessario rispettare alcune accortezze; i campi possono avere qualsiasi etichetta e/o placeholder, ma i <b>name=""</b> devono essere sequenziali e cosi chiamati: "nuovo_campo_1, nuovo_campo_2, nuovo_campo_3 , nuovo_campo_ecc"</small></li>
                                                          </ul>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <br>
                                                    <div id="response"></div>                                                
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                              <div class="row">
                                                                <div class="col-md-1 rmvwidth"></div>
                                                                <div class="col-md-2"><b>Tipologia</b></div>
                                                                <div class="col-md-1"><b>Etichetta</b></div>
                                                                <div class="col-md-1"><b>Name</b></div>
                                                                <div class="col-md-4"><b>Campo</b></div>
                                                                <div class="col-md-1 text-center "><b>Visibile</b></div>
                                                                <div class="col-md-1 text-center "><b>Obb.</b></div>
                                                                <div class="col-md-1 text-center "></div>
                                                              </div>
                                                              <br>
                                                      <div id="list">
                                                      <ul>';
                                    $input = '';
                                    foreach($form[$k]['content'] as $kx =>$vx){

                                        $input = str_replace('[name]',$vx['name'],$vx['campo']);
                                        $input = str_replace('[id]',$vx['idContent'] ,$input);
                                        $input = str_replace('[placeholder]',urldecode($vx['label']),$input);
                                        $input = str_replace('[obbligatorio]',($vx['obbligatorio']==0?'':'required'),$input);

                                        $content .= '<script>
                                                      $(document).ready(function(){ 
                                                        if($("#content_tipo_'.$vx['id'].'").val()==17 || $("#content_tipo_'.$vx['id'].'").val()==18){
                                                           $("#content_obbligatorio_'.$vx['id'].'").hide();
                                                           $("#content_label_'.$vx['id'].'").hide();
														                                $("#content_name_'.$vx['id'].'").hide();		
                                                        }else{
                                                          $("#content_obbligatorio_'.$vx['id'].'").show();
                                                          $("#content_label_'.$vx['id'].'").show();
                                                          $("#content_name_'.$vx['id'].'").show();
                                                        }
                                                      });
                                                    </script>';

                                         $content.= '<li id="item_'.$vx['idContent'].'">
                                                            <div class="row">
                                                            <div class="col-md-1 rmvwidth">
                                                                <span class="handle" style="cursor:pointer">
                                                                  <i class="fa fa-ellipsis-v"></i>
                                                                  <i class="fa fa-ellipsis-v"></i>
                                                                </span> 
                                                            </div>
                                                              <div class="col-md-2" style="padding-left:2px!important;padding-right:2px!important">
                                                                <input type="hidden" name="content['.$k.']['.$vx['id'].'][id_campo]" value="'.$vx['idContent'].'"  />
                                                                <select name="content['.$k.']['.$vx['id'].'][tipo]"  class="form-control content_tipo" id="content_tipo_'.$vx['id'].'" onchange="addOpzioni($(this).val(),\''.$vx['id'].'\');ChangeOpzioni'.$k.'($(this).val(),\''.$vx['id'].'\',\''.$vx['name'].'\',\''.$vx['label'].'\',\''.$vx['obbligatorio'].'\',\''.$vx['idContent'].'\');">'.array_tipologia_new($vx['id_tipo_input']).'</select>
                                                              </div>
                                                              <div class="col-md-1" style="padding-left:2px!important;padding-right:2px!important">
                                                                <input type="text" class="form-control"  name="content['.$k.']['.$vx['id'].'][label]" id="content_label_'.$vx['id'].'" onblur="Change_label'.$k.'($(this).val(),\''.$vx['id'].'\');Change_name'.$k.'($(this).val(),\''.$vx['idContent'].'\',\''.$vx['id'].'\');" value="'.urldecode($vx['label']).'" />
                                                              </div>
                                                              <div class="col-md-1" style="padding-left:2px!important;padding-right:2px!important">
                                                                <input type="text" class="form-control"  name="content['.$k.']['.$vx['id'].'][name]" id="content_name_'.$vx['id'].'" value="'.$vx['name'].'" />
                                                              </div>                                                                                                                                                                                     
                                                              <div class="col-md-4">
                                                                <textarea name="content['.$k.']['.$vx['id'].'][campo]" id="content_'.$k.'_'.$vx['id'].'" class="form-control" />'.urldecode($input).'</textarea>
                                                              </div>
                                                              <div class="col-md-1 text-center">
                                                                <select name="content['.$k.']['.$vx['id'].'][attivo]" id="content_attivo_'.$vx['id'].'" class="form-control" ><option value="1">Si</option><option value="0" '.($vx['attivo'] == '0'?'selected="selected"':'' ).'>No</option></select>
                                                              </div>
                                                              <div class="col-md-1 text-center">                                  
                                                                <select name="content['.$k.']['.$vx['id'].'][obbligatorio]" id="content_obbligatorio_'.$vx['id'].'" class="form-control" onchange="Change_obb'.$k.'($(this).val(),\''.$vx['id'].'\');" ><option value="1">Si</option><option value="0" '.($vx['obbligatorio'] == '0'?'selected="selected"':'' ).'>No</option></select>
                                                              </div>
                                                              <div class="col-md-1 text-right">
                                                                <a href="javascript:;" class="btn btn-danger" title="Elimina" onclick="if(confirm(\'Confermi la rimozione del campo?\')) { delField(\''.$vx['id_campo'].'\',\''.$id_form.'\',\''.IDSITO.'\');}else{ return false; }" ><i class="fa fa-remove"></i></a>  
                                                              </div>
                                                            </div>                                                            
                                                             <div class="row" id="param_'.$vx['id'].'" class="extraData">
                                                              <div class="col-md-12">
                                                                <div id="istr_'.$vx['id'].'"></div>
                                                                <textarea name="content['.$k.']['.$vx['id'].'][parametri]" id="content['.$k.']['.$vx['id'].'][parametri]" class="form-control" />'.urldecode($vx['parametri_campo']).'</textarea>
                                                              </div>
                                                    </li>';
                                    }
                                     $content.= '</ul>
                                                </div>
                                              </div><!-- col--> 
                                            </div> <!-- row-->
                                     <div id="add_campo"></div>';
                                } 
                                     $content.= '<br>
                                                <div style="float:right;margin-right:28px">
                                                	<a class="btn btn-info" href="javascript:;" onclick="insertField(\''.count($lingue).'\',\''.$id_form.'\',\''.IDSITO.'\')" title="aggiungi campo" /><i class="fa fa-plus"></i></a>
                                                </div>                         
                                                        
                                          ';                                               	                                     	
                                                	
                                    $content.= '            	
                                                	<h4>Impostazioni form</h4>
                                                  <div class="row">
	                                                		<div class="col-md-6">
			                                                	<div class="form-group">
																	                        <label>Nome Form</label>                                              
		                                                			<input class="form-control" type="text" id="header_nome_form" name="header['.$k.'][nome_form]" value="'.$form[$k]['header']['nome_form']['descrizione'].'"  tabindex="1" >		                                              			
		                                                		</div>	                                                			
	                                                		</div>
	                                                		<div class="col-md-6">
			                                                	<div class="form-group">
		                                                   			<label>Email destinazione</label>                                                   
		                                                			<input class="form-control" type="text" id="header_destinatario_email" name="header['.$k.'][destinatario_email]" value="'.$form[$k]['header']['destinatario_email']['descrizione'].'"  tabindex="2" >		                                              			
		                                                		</div>	                                                			
	                                                		</div>
	                                                	</div>
	                                                  <div class="row">
	                                                		<div class="col-md-6">
			                                                	<div class="form-group">
		                                                   			<label>Oggetto email</label>                                                   
		                                                			<input class="form-control" type="text" id="oggetto_email" name="header['.$k.'][oggetto_email]" value="'.$form[$k]['header']['oggetto_email']['descrizione'].'" tabindex="5" >		                                              			
		                                                		</div>	                                                			
	                                                		</div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Testo (script) Consenso</label>                                                   
                                                          <textarea  id="text_consenso" name="header['.$k.'][text_consenso]" class="form-control" style="height:100px!important" tabindex="6" >'.$form[$k]['header']['text_consenso']['descrizione'].'</textarea>		  
                                                          <label>ID Iubenda</label>   <small>(se compilato con ID iubenda, automaticamente sostituisce lo script del consenso privacy)</small>
                                                          <input class="form-control" type="text" id="id_iubenda" name="header['.$k.'][id_iubenda]" value="'.$form[$k]['header']['id_iubenda']['descrizione'].'" tabindex="5" >                                            			
                                                        </div>	                                                			
                                                    </div>
	                                                	</div>
	                                                  <div class="row">
	                                                  	      <div class="col-md-6">
			                                                	<div class="form-group">
		                                                   			<label>Testo invio email</label>                                                   
		                                                			<textarea  id="header_testo_form" name="header['.$k.'][testo_form]" class="form-control" style="height:100px!important" tabindex="6" >'.$form[$k]['header']['testo_form']['descrizione'].'</textarea>		                                              			
		                                                		</div>	                                                			
	                                                		</div>
	                                                		<div class="col-md-6">
			                                                	<div class="form-group">
		                                                   			<label>Personalizza Testo submit</label> 
		                                                   			<input class="form-control" type="text" id="testo_submit_'.$v.'" name="header['.$k.'][testo_submit]" value="'.$form[$k]['header']['testo_submit']['descrizione'].'" tabindex="7" >		                                        		                                                					                                              			
		                                                		</div>	                                                			
	                                                		</div>
	                                                	</div>';
                			
	                                  
	                                  
	                                          $content.= '	                                                	
	                                                		<div class="">
	                                                		<div id="mod_new_'.$v.'"></div>
                                                		<button type="submit" class="btn btn-success">Salva</button>
                                                	</div>
                                                	</form>                                                  	
                                                </div>
                                            </div>
                                        </div>
                                        <hr>';
						}
						
	$record = get_content_testata_form($id_form,IDSITO);

 	$content_setting .='
						<div class="panel box box-success">
							<div class="box-header">
								<h4 class="box-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseReCaptcha">
									  <i class="fa fa-link"></i>&nbsp;&nbsp;<span class="text-black">Gestione Google ReCaptcha</span>
									</a>
								</h4>
							</div>
							<div style="height: 0px;" id="collapseReCaptcha" class="p-t-20 panel-collapse collapse">
								<div class="box-body">
									<div id="res_setting"></div>
									<form method="post" id="form_setting_form" name="form_setting_form">
										<input type="hidden" name="idsito" id="idsito" value="'.IDSITO.'">
										<input type="hidden" name="idform" id="idform" value="'.$id_form.'">
										<input type="hidden" name="action" id="action" value="ins_setting">

										<h4>Inserire i valori per il google recaptcha</h4>										
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Chiave Sito ReCaptcha</label>
														<input type="text" name="chiave_sito_recaptcha" id="chiave_sito_recaptcha" value="'.$record['chiave_sito_recaptcha'].'" class="form-control" required/>
													</div>                                                			

												</div>
												<div class="col-md-6">
													<label>Chiave Segreta ReCaptcha</label>
													<input type="text" name="chiave_segreta_recaptcha" id="chiave_segreta_recaptcha" value="'.$record['chiave_segreta_recaptcha'].'" class="form-control" required />
												</div>	                                                		
											</div>
											<div class="">
												<button type="submit" class="btn btn-success">Salva</button>
											</div>
									</form>
								</div>
							</div>
						</div>
            <hr>'."\r\n";	 	
		$content_setting .='
							<script type="text/javascript">                                                                                                   
                                    $(document).ready(function() {
                                        $("#form_setting_form").submit(function(){
                                            
                                            var dati = $("#form_setting_form").serialize();                                                            
                                                $.ajax({
                                                    url: \''.BASE_URL_SITO.'ajax/form/ins_setting_form_new.php\',
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(data) {                                                                                                          
                                                            $("div#res_setting").html(\'<div class="alert alert-success alert-dismissable"><p>Impostazioni dati per il google recaptcha salvate con successo! Attendi la scomparsa di questo box message!</p></div>\');        
                                                              setTimeout(function(){
                                                              	$("#res_setting").fadeOut(200);                                                       
                                                                },3000);
																
                                                        }                                                          
                                                  });                                                               
                                                return false; // con false senza refresh della pagina
                                            });                                                                                                                                                                                                                                                                    
                                    });
                                   </script>'."\r\n" ; 
								   

?>