<?
    # filtro di partenza del mese in corso - 1
    $mesi = mktime(date('H'),date('i'),date('s'),(date('m')-1),date('d'),date('Y'));
    # query  per lettura dati  
	$query_gen  = "SELECT * FROM hospitality_log_accessi WHERE data_ora >= '".$mesi."' ORDER BY data_ora DESC";  
	$arr_r     = $dbMysqli->query($query_gen);

	if(sizeof($arr_r)>0){

		$log = '<h2>LISTA ACCESSI a QUOTO</h2>						
						<table id="TabellaLayout" class="xcrud-list table table-striped table-hover table-bordered table-sm">
						<thead>
                            <tr class="xcrud-th">
                                <th class="th-sm" style="white-space:nowrap">Id</th>
                                <th class="th-sm" style="white-space:nowrap">IdSito</th>
								<th class="th-sm" style="white-space:nowrap">Cliente</th>
								<th class="th-sm" style="white-space:nowrap">Nome Utente</th>
								<th class="th-sm" style="white-space:nowrap">Host</th>
								<th class="th-sm" style="white-space:nowrap">Ip Remote</th>
								<th class="th-sm" style="white-space:nowrap">User Agent</th>
								<th class="th-sm" style="white-space:nowrap">Data e Ora</th>
							</tr>
						</thead>'."\r\n";
		foreach($arr_r as $key => $val){


            $log .= '<tr>
                        <td style="white-space:nowrap"><small>'.$val['id'].'</small></td>
                        <td style="white-space:nowrap"><small>'.$val['idsito'].'</small></td>
                        <td style="white-space:nowrap"><small>'.$val['utente'].'</small></td>					
                        <td style="white-space:nowrap"><small>'.$val['nome_utente'].'</small></td>
                        <td style="white-space:nowrap"><small>'.$val['host'].'</small></td>
                        <td style="white-space:nowrap">'.($val['remote']=='5.89.51.153'?'<small class="text-red" data-toggle="tooltip" title="IP Network Service">'.$val['remote'].'</small>':'<small>'.$val['remote'].'</small>').'</td>
                        <td><small>'.$val['user_agent'].'</small></td>
                        <td style="white-space:nowrap"><small>'.date('d-m-Y H:i:s',$val['data_ora']).'</small></td>';																				
			$log .= '</tr>';


		}

		$log .= '</table> 
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
                                    [ 10, 25, 50,100,200, -1 ],
                                    [ \'10 risultati\', \'25 risultati\', \'50 risultati\',\'100 risultati\',\'200 risultati\', \'Tutti\' ]
                                ],	
                                buttons: [ \'pageLength\',
                                {
                                    extend: \'collection\',
                                    className: \'buttonExport\',
                                    text: \'Esporta\',
                                    buttons: [  
                                        { extend: \'copy\', text: \'Copia\' }, 
                                        { extend: \'excel\', text: \'Excel\' },  
                                        { extend: \'csv\', text: \'CSV\' },  
                                        { extend: \'pdf\', text: \'PDF\' },  
                                        { extend: \'print\', text: \'Stampa\' }
                                    ]
                                }
                            ],			
                        });
                        $(\'#TabellaLayout\').DataTable().order([0,\'desc\']).draw();
                        $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                        $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
                    });
                </script>';
        }else{
            $log = 'Nessun log inserito!';
        }
