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
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	$data        = array();

	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
                    hospitality_dizionario.etichetta,
                    hospitality_dizionario.id,
                    hospitality_dizionario.idsito,
                    hospitality_dizionario_lingua.textarea
                FROM 
                    hospitality_dizionario 
                INNER JOIN 
                    hospitality_dizionario_lingua
                ON
                    hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                WHERE 
                    hospitality_dizionario.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_dizionario.Lingua = 'it'
                AND
                    (hospitality_dizionario.etichetta = 'TESTOMAIL_RE_CHAT' 
                OR 
                    hospitality_dizionario.etichetta = 'OGGETTO_RE_CHAT'
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_VAUCHER'
                OR
                    hospitality_dizionario.etichetta = 'OGGETTO_VAUCHER'
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL'
                OR 
                    hospitality_dizionario.etichetta = 'OGGETTO'
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_DISDETTA'
                OR 
                    hospitality_dizionario.etichetta = 'OGGETTO_DISDETTA'
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_CHECKIN'
                OR 
                    hospitality_dizionario.etichetta = 'OGGETTO_CHECKIN'                    
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_DISPONIBILITA'
                OR 
                    hospitality_dizionario.etichetta = 'OGGETTO_DISPONIBILITA'                                      
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_ANNULLA_CONFERMA_NODISPO'
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_ANNULLA_CONFERMA_RINUNCIA'                    
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_ANNULLA_CONFERMA_ALTRO'                    
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_ANNULLA_PREVENTIVO_NODISPO'
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_ANNULLA_PREVENTIVO_STRUTTURA_CHIUSA'                    
                OR 
                    hospitality_dizionario.etichetta = 'TESTOMAIL_ANNULLA_PREVENTIVO_ALTRO')
                AND
                    hospitality_dizionario_lingua.idsito = ".$_REQUEST['idsito']."
                AND
                    hospitality_dizionario_lingua.Lingua = 'it'
                ORDER BY 
                    hospitality_dizionario.id DESC";

	$rec = $dbMysqli->query($select);

    $etichetta = '';
	
	foreach($rec as $key => $row){

        $etichetta = ucwords(strtolower(str_replace("_"," ",$row['etichetta'])));
        $etichetta = str_replace("Vaucher","Voucher",$etichetta);


 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
                                        <a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                             <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'templates-altri_contenuti_email/'.$row['id'].'/'.$row['etichetta'].'/"><i class="fa fa-comment-o text-green"></i> Gestione Contenuti '.($row['textarea']==0?'Oggetto':'E-Mail').' </a>  
                                        </div>
                                    </div>';                                               

							$data[] = array(

                                "id"        => $row['id'],
                                "variabile" => $etichetta,
                                "testi"     => $fun->ControlloTestiInseritiAltroContenutoEmail($row['id'],$row['idsito']),
                                "action"    => $action
 
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
