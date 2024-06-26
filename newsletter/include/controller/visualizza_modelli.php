
<?php
	if($_REQUEST['azione']=='delete'){
		$serv =  "DELETE FROM mailing_newsletter_template WHERE id = '".$_REQUEST['param']."'";
        $dbMysqli->query($serv);
        $prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-visualizza_modelli/');
	}
	
	$serv = "SELECT * FROM mailing_newsletter_template WHERE idsito = ".IDSITO;
	$record = $dbMysqli->query($serv);
	if(sizeof($record)>0){
		foreach($record as $key => $row){

			$content .= ' <tr>
							<td><b>'.$row['nome_template'].'</b></td>
							<td class="text-center"><img src="'.BASE_URL_SITO.'img/flags/'.$row['lingua'].'.png" class="image_flag"></td>
							<td>
								<div class="text-center"><a  class="text-center" href="javascript:;" data-toggle="modal" data-target="#modale_'.$row['id'].'"><i class="fa fa-windows"></i></a></div>
								<div class="modal fade" id="modale_'.$row['id'].'"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header" style="border-bottom:0px!important">
												<h5>ANTEPRIMA MODELLO '.NOME_CLIENT_EMAIL.'</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="radius6" style="padding:10px">
												'.$row['template'].'
												<p style="padding-top:15px;"><strong><a href="javascript:;" style="color:#212b35;text-decoration:none;">Annulla l\'iscrizione/unsubscribe</a></b></p>
												</div>   
											</div>
										</div>
									</div>
								</div>
							</td>
							<td class="text-center"><a href="'.BASE_URL_SITO.'newsletter/modif_modello/'.$row['id'].'/" data-toogle="tooltip" title="Modifica Modello"><i class="fa fa-edit"></i></td>
							<td class="text-center"><a href="javascript:validator(\''.BASE_URL_SITO.'newsletter/visualizza_modelli/delete/'.$row['id'].'/\');" data-toogle="tooltip" title="Elimina Modello"><i class="fa fa-remove"></i></a></td>
						</tr>';
		}
	}else{
		$content .= ' <tr>
						<td colspan="5">Nessun template inserito!</td>
					</tr>';

	}

?>