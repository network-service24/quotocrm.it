<?php

	$serv = "SELECT  mailing_newsletter_spedite.*,
									mailing_newsletter_nome_liste.nome_lista,
									mailing_newsletter_template.nome_template
						FROM  mailing_newsletter_spedite
						LEFT JOIN mailing_newsletter_nome_liste ON mailing_newsletter_nome_liste.id = mailing_newsletter_spedite.id_lista
						LEFT JOIN mailing_newsletter_template ON mailing_newsletter_template.id = mailing_newsletter_spedite.id_template
						WHERE 1 = 1
						AND mailing_newsletter_spedite.idsito = ".IDSITO."
						ORDER BY mailing_newsletter_spedite.data_invio DESC"; 
	
	
	$rec =$dbMysqli->query($serv);
	
	if(sizeof($rec)>0){

		$stat .= '<table id="TabellaLayout" class="table table-striped table-hover table-bordered table-sm">
								<thead>
									<tr>
										<th class="nowrap">Inviate</th>
										<th>Lista</th>
										<th>Modello</th>
										<th text-center">Data Invio</th>
										<th>Destinatario</th>
										<th>Oggetto</th>
										<th>Contenuto</th>
									</tr>
								</thead>'."\r\n";
	$Data  = '';

	foreach($rec as $key => $val){
		$Data_tmp = explode(' ',$val['data_invio']);
		$orario   = $Data_tmp[1];
		$Data_t   = explode('-',$Data_tmp[0]);			
		$Data     = $Data_t[2].'-'.$Data_t[1].'-'.$Data_t[0].' '.$orario ;

		$stat .= '<tr>
									<td class="nowrap text-center"><label class="badge bg-green ml-auto pointer">'. $val['invii'].'</label></td>					
									<td class="nowrap">'.($val['nome_lista']!=''?'<span class="text-info">'.ucfirst($val['nome_lista']).'</span>':($val['destinatario']!=''?'<small class="text-orange">Invio con unico destinatario</small>':'<small class="text-maroon">La lista utilizzata per l\'invio è stata eliminata!</small>')).'</td>					
									<td class="nowrap">'.ucfirst($val['nome_template']).'</td>
									<td class="text-center nowrap"><b>'.$Data.'</b></td>
									<td class="nowrap">'.($val['destinatario']!=''?'<span class="text-info">'.$val['destinatario'].'</span>':'<small class="text-green">Invio tramite lista</small>').'</td>
									<td class="nowrap"><b>'.stripslashes($val['oggetto']).'</b></td>
									<td>
									<div class="text-center"><a  class="text-center" href="javascript:;" data-toggle="modal" data-target="#modale_'.$val['id'].'"><i class="fa fa-comment"></i></a></div>
											<div class="modal fade" id="modale_'.$val['id'].'"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header" style="border-bottom:0px!important">
															<h4>ANTEPRIMA CONTENUTO '.NOME_CLIENT_EMAIL.'</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>															
														</div>
														<div class="modal-body">
														<div class="radius6" style="padding:10px">'.stripslashes($val['testo']).'</div>
														</div>
													</div>
												</div>
											</div>									
								</td>
								</tr>';

	}

	$stat .='
							<tfoot>
								<tr>
									<td class="text-right" colspan="7">
									</td>                             
								</tr>
							</tfoot>';

	$stat .= '</table> 
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
											buttons: [ \'pageLength\', ],
										});
										$(\'#TabellaLayout\').DataTable().order([0,\'desc\']).draw();
										$(\'.dataTables_length\').addClass(\'bs-select\');

									});
								</script>';
}else{
		$stat = 'Nessun statistica rilevata';
}

?>