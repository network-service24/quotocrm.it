<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$action                  = $_REQUEST['action'];
	$tabella                 = $_REQUEST['tabella'];
	$param                   = $_REQUEST['param'];
	$id                      = $_REQUEST['id'];
    $order                   = $_REQUEST['order'];
	$typeorder               = $_REQUEST['typeorder'];
	$idVisibile              = $_REQUEST['idVisibile'];
	$provenienza             = $_REQUEST['provenienza'];
	$where                   = urldecode($_REQUEST['where']);
	$join                    = urldecode($_REQUEST['join']);
	$campiQuery              = urldecode($_REQUEST['campiQuery']);
	$groupBy                 = urldecode($_REQUEST['groupBy']);
	$record                  = '';
	$data                    = array();

	#######################################################################################################################


    switch($action){

        case "insert":
            $dbMysqli->insert($tabella,$campi_tabella);
        break;

        case "update":
            $dbMysqli->where($param,$id);
            $dbMysqli->update($tabella,$campi_tabella);
        break;

        case "delete":
            $dbMysqli->where($param,$id);
            $dbMysqli->delete($tabella);
        break;

    }
	

	#######################################################################################################################

	# QUERY PER COMPILARE IL DATATABLE
	$s  = " SELECT 
		    siti.*,utenti.username,utenti.password,utenti.is_admin 
			FROM siti 
            LEFT JOIN utenti ON siti.idsito = utenti.idsito ";
    if($_REQUEST['azione']=='ricerca' && $_REQUEST['idsito']!=''){
        $s          .= 'WHERE siti.idsito = '.$_REQUEST['idsito'];
    }
    if($_REQUEST['azione']=='ut' && $_REQUEST['param']!=''){
        $s          .= 'WHERE siti.idsito = '.$_REQUEST['param'];
    }
    if($_REQUEST['azione']=='cl' && $_REQUEST['param']!=''){
        $s          .= 'WHERE utenti.idanagra = '.$_REQUEST['param'];
    }
    if($_REQUEST['azione']=='ricerca' && $_REQUEST['sito']!=''){
        $s          .= 'WHERE siti.web LIKE "%'.$_REQUEST['sito'].'%"';
    }
	 $s          .= "GROUP BY siti.idsito
		             ORDER BY siti.idsito DESC ";

	$rec = $dbMysqli->query($s);

	$array_moduli = array();
	
	foreach($rec as $key => $row){


						$record = implode('|',$row);

						$loginQuoto         = ($row['hospitality']==1?"<a target='_blank' href='".BASE_URL_SITO."jump_quoto/".$row['username']."/".$row['password']."' data-toogle='tooltip' title='Login a Quoto' class='btn btn-sm btn-info btn-outline-primary btn-custom'><img src='".BASE_URL_SITO."images/ico_quoto.png' style='width:16px;height:16px;'></a>":"");
						// clienti
						$clientiButton      = "<a href='".BASE_URL_SITO."jump_clienti/sw/".$row['idsito']."' class='btn btn-sm btn-danger btn-outline-danger btn-custom' title='Cliente'><i class='fa fa-user fa-fw'></i></a>";							
						// utenti
						$utentiButton       = "<a href='".BASE_URL_SITO."utenti/sw/".$row['idsito']."' class='btn btn-sm btn-warning btn-outline-warning btn-custom' title='Utente o Utenti'><i class='fa fa-users fa-fw'></i></a>";							
						// Update Button
						$updateButton       = "<button class='btn btn-sm btn-warning update btn-custom' data-id='".$row['idsito']."' onclick='get_content_update(".$row['idsito'].")' title='Modifica'><i class='fa fa-edit fa-fw'></i></button>";
				
						$modalbutton        = "<div class='text-center'><a href='javascript:;'  onclick='get_content_dettaglio(".$row['idsito'].")' title='Dettagli completo'><i class='fa fa-arrows-alt'></i></a></div>";
						// Delete Button
						$deleteButton       = "<button class='btn btn-sm btn-danger btn-custom' data-id='".$row['idsito']."' onclick='if(confirm(\"Sei sicuro di eliminare il record?\") == true){ get_delete(".$row['idsito'].")}' title='Elimina'><i class='fa fa-remove fa-fw'></i></button>";
											

						
						$action2 = $clientiButton." ".$utentiButton." ".$updateButton." ".$deleteButton;


							$data[] = array(
								"idsito"          => '<span class="coded-badge badge badge-info">'.$row['idsito'].'</span>',
								"servizi_attivi"  => (($row['servizi_attivi']!='' && $row['servizi_attivi']!='null')?'<span class="pcoded-badge badge badge-inverse-info text-left">'.str_replace(",","<br>",$row['servizi_attivi']).'</span>':''),
								"web"             => '<a href="'.($row['https']==1?'https://':'http://').$row['web'].'" target="_blank" title="Vai al sito del cliente">'.$row['web'].'</a>',
								"email"           => '<div class="text-center"><a href="mailto:'.$row['email'].'" title="'.$row['email'].'" class="text-center"><i class="fa fa-envelope" style="color:#1CC9A7"></i></a></div>',
								"id_status"       => $fun->getNomeStatus($row['id_status']),
								"login"           => $loginQuoto,
								"action"          => '<div class="nowrap">'.$action.'</div>'
							);

	
	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec) ,
						"recordsFiltered" => sizeof($rec),
						"data" 			  => $data
						); 



if(empty($json_data) || is_null($json_data)){
	$json_data = NULL;
}else{
	$json_data = json_encode($json_data);
}
	  echo $json_data; 

#######################################################################################################################

?>
