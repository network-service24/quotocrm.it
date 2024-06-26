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
                    (hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM1' 
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM1'
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM2'
                OR
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM2'
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM3'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM3'
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM4'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM4'   
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM5'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM5'  
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM6'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM6'  
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM7'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM7'  
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM8'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM8'  
                OR 
                    hospitality_dizionario.etichetta = 'PREVENTIVO_CUSTOM9'
                OR 
                    hospitality_dizionario.etichetta = 'CONFERMA_CUSTOM9'                      
                OR 
                    hospitality_dizionario.etichetta = 'QUESTIONARIO'
                OR 
                    hospitality_dizionario.etichetta = 'TESTO_QUESTIONARIO'
                OR 
                    hospitality_dizionario.etichetta = 'TESTO_VOUCHER'
                OR 
                    hospitality_dizionario.etichetta = 'TESTO_VOUCHER_RECUPERO')
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

        
        if(strstr($etichetta,'Custom9')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom9");
            $etichetta = str_replace("Custom9",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom8')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom8");
            $etichetta = str_replace("Custom8",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom7')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom7");
            $etichetta = str_replace("Custom7",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom6')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom6");
            $etichetta = str_replace("Custom6",$new_et,$etichetta);
        }        
        if(strstr($etichetta,'Custom5')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom5");
            $etichetta = str_replace("Custom5",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom4')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom4");
            $etichetta = str_replace("Custom4",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom3')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom3");
            $etichetta = str_replace("Custom3",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom2')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom2");
            $etichetta = str_replace("Custom2",$new_et,$etichetta);
        }
        if(strstr($etichetta,'Custom1')){
            $new_et    = $fun->get_name_template($row['idsito'],"custom1");
            $etichetta = str_replace("Custom1",$new_et,$etichetta);
        }

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
                                        <a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                             <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'templates-altri_contenuti_template/'.$row['id'].'/'.$row['etichetta'].'/"><i class="fa fa-comment-o text-green"></i> Gestione Contenuti '.($row['textarea']==0?'Titolo':'Testo').' </a>  
                                        </div>
                                    </div>';                                               

							$data[] = array(

                                "id"        => '<div class="ordinamento">'.$row['id'].'</div><span class="f-10">'.$row['etichetta'].'</span>',
                                "variabile" => '<b>'.$etichetta.'</b>',
                                "testi"     => $fun->ControlloTestiInseritiAltroContenutoTemplate($row['id'],$row['idsito']),
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
