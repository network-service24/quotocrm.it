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

$lista_progetti = $fun->listaProgettiMarketing();

    $select_prog ='  SELECT 
                        pms_progetti.id,
                        pms_progetti.idsito,
                        pms_progetti.totale_progetto,
                        pms_progetti.codice_progetto,
                        pms_progetti.progetto,
                        pms_progetti.data_inizio,
                        pms_progetti.data_fine,
                        pms_progetti.allegato_contratto,
                        siti.web,
                        pms_stati.stato
                    FROM 
                        pms_progetti
                    INNER JOIN 
                        siti
                    ON 
                        siti.idsito = pms_progetti.idsito
                    INNER JOIN 
                        pms_stati 
                    ON
                         pms_stati.id = pms_progetti.id_stato
                    WHERE 
                        pms_progetti.codice_progetto IN ('.$lista_progetti.')
                    AND
                        pms_progetti.id_stato IN (1,3)
                    AND
                        pms_progetti.data_fine >= "'.(date('Y')-1).'-12-31 11:59:59"            
                    ORDER BY
                        pms_progetti.data_fine DESC';

                    $righeP = $dbMysqli->query($select_prog);

                    $output_stato       = '';
                    $data_inizio        = '';
                    $data_fine          = '';
                    $sitoweb            = '';
                    $monte              = '';
                    $tempo              = '';
                    $percentuale        = '';
                    $monte_ore_progetto = '';
                    $totale             = 0;
                    foreach($righeP as $keP => $rows){

                        $select2 = "SELECT SUM(pms_attivita.monte_ore) as tot_monte_ore
                                    FROM pms_attivita
                                    INNER JOIN pms_progetti ON pms_progetti.id = pms_attivita.id_progetto
                                    WHERE pms_progetti.id = ".$rows['id']." AND pms_attivita.parent_id = 0 ";
                        $rec2 = $dbMysqli->query($select2);
                        $row  = $rec2[0];
            
                        $select3 = "SELECT SUM(pms_timer.tempo_impiegato) as tot_timer
                                    FROM pms_attivita
                                    INNER JOIN pms_progetti ON pms_progetti.id = pms_attivita.id_progetto
                                    INNER JOIN pms_timer ON pms_timer.id_attivita = pms_attivita.id
                                    WHERE pms_progetti.id = ".$rows['id']." ";
                        $rec3 = $dbMysqli->query($select3);
                        $rws  = $rec3[0]; 


                        $monte    = $row['tot_monte_ore'];
                        $tempo    = $rws['tot_timer'];
    
                        $residuo  = ($monte - $tempo);


                        switch($rows['stato']){
                            case "Da Fare":
                                $output_stato = '<span class="pcoded-badge badge badge-inverse-default text-black">'.$rows['stato'].'</span>';
                            break;
                            case "Completato":
                                $output_stato = '<span class="pcoded-badge badge badge-success">'.$rows['stato'].'</span>';
                            break;
                            case "Posticipato":
                                $output_stato = '<span class="pcoded-badge badge badge-primary">'.$rows['stato'].'</span>';
                            break;
                            case "Annullato":
                                $output_stato = '<span class="pcoded-badge badge badge-danger">'.$rows['stato'].'</span>';
                            break;
                            case "In Lavorazione":
                                $output_stato = '<span class="pcoded-badge badge badge-warning">'.$rows['stato'].'</span>';
                            break;
                            case "Bloccato":
                                $output_stato = '<span class="pcoded-badge badge badge-inverse-danger">'.$rows['stato'].'</span>';
                            break;
                            case "Sostituito":
                                $output_stato = '<span class="pcoded-badge badge badge-inverse-warning">'.$rows['stato'].'</span>';
                            break;
                        }

                        $totale += $rows['totale_progetto'];

                        $data[] = array(		
                            "id_progetto"   => '<div class="text-center"><a href="'.BASE_URL_SUITEWEB.'progetti/sw/'.$rows['idsito'].'/'.$rows['web'].'/'.$rows['id'].'" target="_blank" title="Vai al Progetto su Suiteweb">[ <i class="fa fa-external-link fa-flip-horizontal"></i> '.$rows['id'].']</a></div>',											
                            "progetto"      => '   <div class="d-inline-block align-middle">
                                                        <h6>'.$rows['web'].'</h6>
                                                        <p>'.$rows['progetto'].' '.($rows['allegato_contratto']!=''?'<a href="'.BASE_URL_SITO.'uploads/allegati/'.$rows['allegato_contratto'].'"  target="_blank" style="position:relative;z-index:999999;" class="m-l-10 text-info" data-html="true" data-toggle="tooltip" title="Contratto allegato: '.$rows['allegato_contratto'].'"><i class="fa fa-save fa-fw"></i></a>':'').'</p>     
                                                    </div>',
                            "data_inizio"   => '<div class="text-center"><span class="ordinamento">'.$rows['data_inizio'].'</span>'.gira_data_no_ore($rows['data_inizio']).'</div>',
                            "data_fine"     => '<div class="text-center"><span class="ordinamento">'.$rows['data_fine'].'</span>'.gira_data_no_ore($rows['data_fine']).'</div>',
                            "residuo"       => '<div class="text-center"><span class="ordinamento">'.$residuo.'</span>'.progettoInHoursMins($residuo,'%02d ore %02d min').'</div>',
                            "stato"         => '<div class="text-center">'.$output_stato.'</div>',
                            "fatturato"     => '<div class="text-right"><i class="fa fa-euro"></i> '.number_format($rows['totale_progetto'],2,",",".").'</div>'

                            );
                    } 

    $json_data = array(
        "draw"            => 1,
        "recordsTotal"    => sizeof($righeP),
        "recordsFiltered" => sizeof($righeP),
        "totalSum"        => number_format($totale,2,",","."),
        "data" 			  => $data
        ); 
    
    
    
    if(empty($json_data) || is_null($json_data)){
        $json_data = NULL;
    }else{
        $json_data = json_encode($json_data);
    } 
    
    echo $json_data; 
?>