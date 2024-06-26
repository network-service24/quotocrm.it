<?php
function getExecutionTime($reset = false){
    static $start_microtime = null;
    if($reset){
        $start_microtime = null;
    }
    if(is_null($start_microtime)){
        $start_microtime = microtime(true);
        return 0.0;
    }
    return microtime(true) - $start_microtime;
}

function include_module($module_filename) {
	$controller_filename = str_replace('inc.php','php',$module_filename);
	if(file_exists(INC_PATH_CONTROLLER.$controller_filename)) {

		include(INC_PATH_CONTROLLER.$controller_filename);

	}
	if(file_exists(INC_PATH_MODULI.$module_filename)) {

		include(INC_PATH_MODULI.$module_filename);

	}
	else {
		echo 'impossibile caricare il modulo '.INC_PATH_MODULI.$module_filename;
		exit;
	}
}
function tot_clienti($idstatus){
	global $dbMysqli;
		// calcolo clienti attivi
	$rw = $dbMysqli->query('SELECT COUNT(anagrafica.idanagra) as tot_clienti FROM anagrafica  WHERE anagrafica.id_status = '.$idstatus);
	$rw = $rw[0];
	return $rw['tot_clienti'];
}
function tot_siti($idstatus){
	global $dbMysqli;
	// calcolo siti attivi
	$rws = $dbMysqli->query('SELECT COUNT(siti.idsito) as tot_siti FROM siti  WHERE siti.id_status = '.$idstatus);
	$rws = $rws[0];
	return $rws['tot_siti'];
}
function tot_utenti($status){
	global $dbMysqli;
	// calcolo utenti attivi
	$rwr = $dbMysqli->query('SELECT COUNT(utenti.idutente) as tot_utenti FROM utenti INNER JOIN siti ON siti.idsito = utenti.idsito WHERE siti.data_start_hospitality != "" AND utenti.status = '.$status);
	$rwr = $rwr[0];
	return $rwr['tot_utenti'];
}
function block_utenti($status){
	global $dbMysqli;
	// calcolo utenti attivi
	$rwr = $dbMysqli->query('SELECT COUNT(utenti.idutente) as tot_utenti FROM utenti  WHERE utenti.blocco_accesso = '.$status);
	$rwr = $rwr[0];
	return $rwr['tot_utenti'];
}
/**
 * funzione per pannelli esterni nel menu laterale
 * @param  [type] $idsito [description]
 * @return [type]         [description]
 */
function menu_pannelli($idsito){
	global $dbMysqli;

		$pannelli = '';
        $ico      = '';
        $r = $dbMysqli->query("SELECT * FROM hospitality_pannelli_esterni WHERE idsito = ".$idsito);
		$tot = sizeof($r);
		if($tot>0){
        $pannelli .='<ul class="pcoded-item pcoded-left-item p-t-10">';
			foreach($r as $key => $row){


                    $pannelli .='<li>
			                        <a href="'.BASE_URL_SITO.'pannelli_post/'.$row['idpannello'].'" >';
                                        if($row['ico_image']!=''){
                                            $ico ='<img src="'.BASE_URL_SITO.'uploads/'.$idsito.'/'.$row['ico_image'].'" style="width:20px;height:20px">';
                                        }elseif($row['font_awesome']!=''){
                                            $ico ='<i class="'.$row['font_awesome'].'"></i>';
                                        }
                                        if($row['ico_image']=='' && $row['font_awesome']==''){
                                            $ico ='<i class="fa fa-table"></i>';

                                        }
			        		$pannelli .='<span class="pcoded-micon">'.$ico.'</span> <span class="pcoded-mtext">'.$row['nome_pannello'].'</span>
			                        </a>
								</li>';


			}
            $pannelli .='</ul>';

		}
        return $pannelli;
}
function check_contenuti(){
	global $dbMysqli;
	// check lingue impostate
	$sel = "SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_lingue = sizeof($res);
	// check fonti prenotazione
	$sel = "SELECT * FROM hospitality_fonti_prenotazione WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_fonti = sizeof($res);
	// check soggiorni
	$sel = "SELECT * FROM hospitality_tipo_soggiorno WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_sogg = sizeof($res);
	// check servizi in camera
	$sel = "SELECT * FROM hospitality_servizi_camera WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_servizi = sizeof($res);
	// check  camere
	$sel = "SELECT * FROM hospitality_tipo_camere WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_camere = sizeof($res);
	// check contenuti email
	$sel = "SELECT * FROM hospitality_contenuti_email WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_cont_email = sizeof($res);
	// check contenuti landing page
	$sel = "SELECT * FROM hospitality_contenuti_web WHERE idsito = ".IDSITO;
	$res = $dbMysqli->query($sel);
	$n_cont_web = sizeof($res);

	$check = ($n_lingue+$n_fonti+$n_sogg+$n_servizi+$n_camere+$n_cont_email+$n_cont_web);

	return $check;
}
function check_setup()
{
    global $dbMysqli;
    // check tabella setup
    $sel = "SELECT * FROM hospitality_setup WHERE idsito = ".IDSITO." AND setup = 1";
    $res = $dbMysqli->query($sel);
    $chk = sizeof($res);

    return $chk;
}
function n_conferme_send($output=null){

    /** @var PerformizeFunctions $fun */
    global $fun;

    return $fun->n_conferme_send($output);
//	global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q  = $dbMysqli->query('SELECT COUNT(Id) as n_conferme FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Archivia = 0 AND Chiuso = 0 AND DataInvio is Null AND Hidden = 0 AND NoDisponibilita = 0');
//	$rw = $q[0];
//	if($rw['n_conferme'] > 0){
//        if(!$output){
//            return '<label class="badge badge-success pull-right" id="notify_conferme" data-toggle="tooltip" title="Conferme da inviare">'.$rw['n_conferme'].'</label>';
//        }else{
//            return $rw['n_conferme'];
//        }
//	}

}
function n_preventivi_send($output=null){

    /** @var PerformizeFunctions $fun */
    global $fun;

    return $fun->n_preventivi_send($output);
//    global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q = $dbMysqli->query('SELECT COUNT(Id) as n_preventivi FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Archivia = 0 AND DataInvio is Null AND Hidden = 0 AND NoDisponibilita = 0');
//	$rw = $q[0];
//	if($rw['n_preventivi'] > 0){
//        if(!$output){
//            return '<label class="badge badge-info pull-right" id="notify_preventivi" data-toggle="tooltip" title="Preventivi da inviare">'.$rw['n_preventivi'].'</label>';
//        }else{
//            return $rw['n_preventivi'];
//        }
//	}

}
function n_cestino($output=null){

    /** @var PerformizeFunctions $fun */
    global $fun;

    return $fun->n_cestino($output);

//    global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q = $dbMysqli->query('SELECT COUNT(Id) as n_richieste FROM hospitality_guest  WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Hidden = 1');
//	$rw = $q[0];
//	if($rw['n_richieste'] > 0){
//        if(!$output){
//            return '<label class="badge badge-danger pull-right" id="notify_cestino">'.$rw['n_richieste'].'</label>';
//        }else{
//            return $rw['n_preventivi'];
//        }
//	}

}
function n_annullate($output=null){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->n_annullate($output);
//    global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q = $dbMysqli->query('SELECT COUNT(Id) as n_richieste FROM hospitality_guest  WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').'  AND NoDisponibilita = 1 AND Hidden = 0 AND Disdetta = 0 AND Archivia = 0');
//	$rw = $q[0];
//	if($rw['n_richieste'] > 0){
//        return '<label class="badge badge-warning pull-right">'.$rw['n_richieste'].'</label>';
//	}
}
function n_archivio($output=null,$anno=null){
    /** @var PerformizeFunctions $fun */
global $fun;
    return $fun->n_archivio($output, $anno);
//    global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q = '  SELECT
//                COUNT(Id) as n_archiviate
//            FROM
//                hospitality_guest
//            WHERE
//                idsito = '.IDSITO.'
//                '.($permessi_user['UNIQUE']==1?'  AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').'
//                AND Archivia = 1 ';
//    if($anno != ''){
//     $q .=' AND
//				( YEAR ( hospitality_guest.DataRichiesta ) = "'.$anno.'" OR YEAR ( hospitality_guest.DataChiuso ) = "'.$anno.'" )';
//    }
//	$res = $dbMysqli->query($q);
//    $rw = $res[0];
//	if($rw['n_archiviate'] > 0){
//        if(!$output){
//            return '<label class="badge badge-primary text-black pull-right">'.$rw['n_archiviate'].'</label>';
//        }else{
//            return $rw['n_archiviate'];
//        }
//	}

}
function n_disdette($output=null){

    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->n_disdette($output);
//
//    global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q = $dbMysqli->query('SELECT COUNT(Id) as n_disdette FROM hospitality_guest  WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Disdetta = 1 AND Hidden = 0 AND Archivia = 0 AND NoDisponibilita = 0 AND Chiuso = 1');
//	$rw = $q[0];
//	if($rw['n_disdette'] > 0){
//        if(!$output){
//            return '<label class="badge bg-white text-black pull-right">'.$rw['n_disdette'].'</label>';
//        }else{
//            return $rw['n_disdette'];
//        }
//	}

}
function n_buoni_voucher($output=null){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->n_buoni_voucher($output);
//    global $dbMysqli;
//    $permessi_user = check_permessi();
//	$q = $dbMysqli->query('SELECT COUNT(Id) as n_buoniVoucher
//                            FROM hospitality_guest
//                            WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').'
//                            AND
//					            hospitality_guest.TipoRichiesta = "Conferma"
//                            AND
//                                hospitality_guest.Hidden = 0
//                            AND
//                                hospitality_guest.Archivia = 0
//                            AND
//                                hospitality_guest.Disdetta = 0
//                            AND
//                                hospitality_guest.Chiuso = 1
//                            AND
//                                hospitality_guest.DataValiditaVoucher IS NOT NULL
//                            AND
//                                hospitality_guest.IdMotivazione IS NOT NULL
//                            AND
//                                hospitality_guest.DataRiconferma IS NULL
//                            AND
//                                hospitality_guest.NoDisponibilita = 0');
//	$rw = $q[0];
//	if($rw['n_buoniVoucher'] > 0){
//        return '<label class="badge bg-blue pull-right">'.$rw['n_buoniVoucher'].'</label>';
//	}
}
function tot_preventivi(){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_preventivi();
//	global $dbMysqli,$prima_data,$seconda_data;
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_preventivi FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo"  AND Hidden = 0 AND idsito = '.IDSITO.' AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//	$rw  = $res[0];
//	return $rw['tot_preventivi'];
}
function tot_invii(){

    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_invii();

//	global $dbMysqli,$prima_data,$seconda_data;
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.IDSITO.' AND Chiuso = 0   AND Hidden = 0 AND DataInvio IS NOT NULL AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//	$rws = $res[0];
//	return $rws['tot_invii'];
}
function tot_conferme(){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_conferme();
//
//	global $dbMysqli,$prima_data,$seconda_data;
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' AND Disdetta = 0  AND Archivia = 0 AND Hidden = 0 AND Chiuso = 0 AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//	$rwr = $res[0];
//	return $rwr['tot_conferme'];
}
function tot_prenotazioni(){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_prenotazioni();

//	global $dbMysqli,$prima_data,$seconda_data;
//    $prima_data   = $prima_data;
//    $seconda_data = $seconda_data;
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' AND Disdetta = 0   AND Hidden = 0  AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//	$rwc = $res[0];
//	return $rwc['tot_prenotazioni'];
}
function tot_preno_archiviate(){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_preno_archiviate();
//
//    global $dbMysqli,$prima_data,$seconda_data;
//    $prima_data   = $prima_data.' 00:00:00';
//    $seconda_data = $seconda_data.' 23:59:59';
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1 AND '.($_REQUEST['date']==''?' (DataChiuso >= "'.date('Y').'-01-01 00:00:00" AND DataChiuso <= "'.date('Y').'-12-31 23:59:59")':' (DataChiuso >= "'.$prima_data.'" AND DataChiuso <= "'.$seconda_data.'")').'');
//	$rwc = $res[0];
//	return $rwc['tot_prenotazioni'];
}
function tot_annullate(){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_annullate();

//	global $dbMysqli,$prima_data,$seconda_data;
//    $prima_data   = $prima_data;
//    $seconda_data = $seconda_data;
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_annullate FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' AND Archivia = 0 AND Hidden = 0 AND NoDisponibilita = 1  AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//	$rwc = $res[0];
//	return $rwc['tot_annullate'];
}
function tot_disdetta(){

    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_disdetta();

//	global $dbMysqli,$prima_data,$seconda_data;
//    $prima_data   = $prima_data.' 00:00:00';
//    $seconda_data = $seconda_data.' 23:59:59';
//	$res = $dbMysqli->query('SELECT COUNT(Id) as tot_disdette FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' AND Archivia = 0 AND Hidden = 0 AND Disdetta = 1 AND Chiuso = 1 AND '.($_REQUEST['date']==''?' (DataChiuso >= "'.date('Y').'-01-01 00:00:00" AND DataChiuso <= "'.date('Y').'-12-31 23:59:59")':' (DataChiuso >= "'.$prima_data.'" AND DataChiuso <= "'.$seconda_data.'")').'');
//	$rwc = $res[0];
//	return $rwc['tot_disdette'];
}
function tot_fatturato($n_format=null){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_fatturato($n_format);
//
//	global $dbMysqli,$prima_data,$seconda_data;
//    $prima_data   = $prima_data;
//    $seconda_data = $seconda_data;
//
//	$res = $dbMysqli->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                FROM hospitality_guest
//                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                WHERE 1=1
//                AND hospitality_guest.idsito = '.IDSITO.'
//                AND hospitality_guest.NoDisponibilita = 0
//                AND hospitality_guest.Hidden = 0
//                AND hospitality_guest.Disdetta = 0
//                AND hospitality_guest.TipoRichiesta = "Conferma"
//                AND '.($_REQUEST['date']==''?' (DataRichiesta>= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//    $rwc = $res[0];
//
//    if($n_format){
//        return $rwc['fatturato'];
//    }else{
//        return number_format($rwc['fatturato'],2,',','.');
//    }

}
function tot_fatturato_prev($n_format=null){

    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_fatturato_prev($n_format);
//
//
//	global $dbMysqli,$prima_data,$seconda_data;
//            $prima_data   = $prima_data;
//            $seconda_data = $seconda_data;
//
//            $numeroPreventivi = '';
//            $fatturato_medio  = '';
//            $media            = '';
//
//    $select = 'SELECT COUNT(hospitality_guest.Id) as numeroPreventivi
//                FROM hospitality_guest
//                WHERE 1=1
//                AND hospitality_guest.idsito = '.IDSITO.'
//                AND hospitality_guest.Chiuso = 0
//                AND hospitality_guest.Hidden = 0
//                AND hospitality_guest.Disdetta = 0
//                AND hospitality_guest.TipoRichiesta = "Preventivo"
//                AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'';
//    $result = $dbMysqli->query($select);
//    $rws = $result[0];
//
//    $numeroPreventivi = $rws['numeroPreventivi'];
//
//    $select2 ='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato,
//                        COUNT(hospitality_proposte.Id) as numeroProposte
//                FROM hospitality_guest
//                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                WHERE 1=1
//                AND hospitality_guest.idsito = '.IDSITO.'
//                AND hospitality_guest.Chiuso = 0
//                AND hospitality_guest.Hidden = 0
//                AND hospitality_guest.Disdetta = 0
//                AND hospitality_guest.TipoRichiesta = "Preventivo"
//                AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'';
//
//    $result2 = $dbMysqli->query($select2);
//    $rwc = $result2[0];
//
//    if($rwc['numeroProposte'] > 0){
//
//        if($numeroPreventivi >= $rwc['numeroProposte']){
//            $media = ($numeroPreventivi/$rwc['numeroProposte']);
//        }else{
//            $media = ($rwc['numeroProposte']/$numeroPreventivi);
//        }
//        $fatturato_medio = ($rwc['fatturato']/$media);
//
//            if($n_format){
//                return $fatturato_medio;
//            }else{
//                return number_format($fatturato_medio,2,',','.');
//            }
//    }
}
function tot_fatturato_conf($n_format=null){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_fatturato_conf($n_format);
//
//	global $dbMysqli,$prima_data,$seconda_data;
//
//    $prima_data   = $prima_data;
//    $seconda_data = $seconda_data;
//
//	$res = $dbMysqli->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                FROM hospitality_guest
//                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                WHERE 1=1
//                AND hospitality_guest.idsito = '.IDSITO.'
//                AND hospitality_guest.Chiuso = 0
//                AND hospitality_guest.Hidden = 0
//                AND hospitality_guest.Disdetta = 0
//                AND hospitality_guest.NoDisponibilita = 0
//                AND hospitality_guest.TipoRichiesta = "Conferma"
//                AND '.($_REQUEST['date']==''?' (DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//    $rwc = $res[0];
//
//    if($n_format){
//        return $rwc['fatturato'];
//    }else{
//        return number_format($rwc['fatturato'],2,',','.');
//    }

  }
  function tot_fatturato_annullate($n_format=null){
      /** @var PerformizeFunctions $fun */
      global $fun;
      return $fun->tot_fatturato_annullate($n_format);
//
//    global $dbMysqli,$prima_data,$seconda_data;
//            $prima_data   = $prima_data;
//            $seconda_data = $seconda_data;
//    $res = $dbMysqli->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                FROM hospitality_guest
//                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                WHERE 1=1
//                AND hospitality_guest.idsito = '.IDSITO.'
//                AND hospitality_guest.NoDisponibilita = 1
//                AND hospitality_guest.Hidden = 0
//                AND hospitality_guest.Disdetta = 0
//                AND hospitality_guest.TipoRichiesta = "Conferma"
//                AND '.($_REQUEST['date']==''?' (DataRichiesta>= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//    $rwc = $res[0];
//
//            if($n_format){
//                return $rwc['fatturato'];
//            }else{
//                return number_format($rwc['fatturato'],2,',','.');
//            }
  }
  function tot_fatturato_disdette($n_format=null){
      /** @var PerformizeFunctions $fun */
      global $fun;
      return $fun->tot_fatturato_disdette($n_format);

//    global $dbMysqli,$prima_data,$seconda_data;
//            $prima_data   = $prima_data;
//            $seconda_data = $seconda_data;
//            $res = $dbMysqli->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                FROM hospitality_guest
//                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                WHERE 1=1
//                AND hospitality_guest.idsito = '.IDSITO.'
//                AND hospitality_guest.NoDisponibilita = 0
//                AND hospitality_guest.Hidden = 0
//                AND hospitality_guest.Disdetta = 1
//                AND hospitality_guest.Chiuso = 1
//                AND hospitality_guest.TipoRichiesta = "Conferma"
//                AND '.($_REQUEST['date']==''?' (DataRichiesta>= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31")':' (DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'")').'');
//            $rwc = $res[0];
//
//            if($n_format){
//                return $rwc['fatturato'];
//            }else{
//                return number_format($rwc['fatturato'],2,',','.');
//            }
  }
function tot_conversioni($tot_invii,$tot_prenotazioni){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->tot_conversioni($tot_invii,$tot_prenotazioni);
//
//	$conversioni = @((100*$tot_prenotazioni)/$tot_invii);
//	if(is_int($conversioni)){
//		$conversioni = $conversioni;
//	}else{
//		$conversioni =	number_format($conversioni,2,',','.');
//	}
//  if($conversioni == ''){
//    $conversioni = 0;
//  }
//	return str_replace(",00", "",$conversioni).' %';
}
function prenotazioni_device(){
    global $dbMysqli,$prima_data,$seconda_data;

    $select = 'SELECT * FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.IDSITO.' AND Disdetta = 0 AND Archivia = 0 AND Chiuso = 1 AND '.($_REQUEST['date'] == ''?' DataRichiesta >= "'.date('Y').'-01-01" AND DataRichiesta <= "'.date('Y').'-12-31"': ' DataRichiesta >= "'.$prima_data.'" AND DataRichiesta <= "'.$seconda_data.'"').'';
    $rwc = $dbMysqli->query($select);

    if(sizeof($rwc)>0){

        $id_preventivi_mobile  = array();
        $id_preventivi_desktop = array();
        $n_mobile              = 0;
        $n_desktop             = 0;
        $value['Agent']        = '';

        foreach ($rwc as $key => $value) {

            if(strstr($value['Agent'],'Mobile')){

                $id_preventivi_mobile[] = $value['Id'];

                $select_m ='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE 1=1
                                AND hospitality_guest.Id IN ('.implode(",",$id_preventivi_mobile).')
                                AND hospitality_guest.idsito = '.IDSITO.'
                                AND hospitality_guest.Chiuso = 1
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.TipoRichiesta = "Conferma" ';
                $res_m = $dbMysqli->query($select_m);
                $mobile= $res_m[0];

                $n_mobile++;


            }
            if(!strstr($value['Agent'],'Mobile')){

                $id_preventivi_desktop[] = $value['Id'];

                $select_d ='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE 1=1
                                AND hospitality_guest.Id IN ('.implode(",",$id_preventivi_desktop).')
                                AND hospitality_guest.idsito = '.IDSITO.'
                                AND hospitality_guest.Chiuso = 1
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.TipoRichiesta = "Conferma"';
                $res_d = $dbMysqli->query($select_d);
                $desktop = $res_d[0];

                $n_desktop++;

            }

        }

        $totale_prenotazioni = ($n_desktop+$n_mobile);

        if($n_desktop>0){
            $percentuale_desktop = ((100*$n_desktop)/$totale_prenotazioni);
            $percentuale_desktop =  number_format($percentuale_desktop,2,',','.');
            $percentuale_desktop = str_replace(",00", "",$percentuale_desktop).' %';
        }
        if($n_mobile>0){
            $percentuale_mobile = ((100*$n_mobile)/$totale_prenotazioni);
            $percentuale_mobile =  number_format($percentuale_mobile,2,',','.');
            $percentuale_mobile = str_replace(",00", "",$percentuale_mobile).' %';
        }
        $device ='<div class="row pd20-noTop">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                            <b class="text-teal">Desktop</b>
                            <div class="clearfix"></div>
                                n° '.$n_desktop.'
                            <div class="clearfix"></div>
                            <i class="fa fa-desktop fontsize80 " id="desktop"></i>
                            <div class="clearfix"></div>
                                '.number_format($desktop['fatturato'],2,',','.').' <i class="fa fa-euro"></i>
                                <br>
                                <b class="text-teal">'.$percentuale_desktop .'</b>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                        <b class="text-maroon">Mobile</b>
                        <div class="clearfix"></div>
                            n° '.$n_mobile.'
                        <div class="clearfix"></div>
                        <i class="fa fa-mobile fontsize80 " id="mobile"></i>
                        <div class="clearfix"></div>
                            '.number_format($mobile['fatturato'],2,',','.').' <i class="fa fa-euro"></i>
                            <br>
                            <b class="text-maroon">'.$percentuale_mobile .'</b>
                    </div>
                </div>';

        return $device;
    }else{
        return 'Nessun risultato!';
    }

}

function fatturato_template(){
    global $dbMysqli,$prima_data,$seconda_data;

    $select = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO."";
    $rws = $dbMysqli->query($select);
    $totTemplate = sizeof($rws);

    if($totTemplate>0){

        $idtemplate        = '';
        $NomeTemplate      = '';
        $Thumb             = '';
        $fatturatoTemplate = '';
        $TotPreno          = '';
        $fatturato         = '';
        $ico               = '';

        foreach ($rws as $key => $value) {


            $idtemplate     = $value['Id'];
            $NomeTemplate = $value['TemplateName'];
            $Thumb        = $value['Thumb'];

                    $sel  = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                            FROM hospitality_guest
                                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                            WHERE 1=1
                                            AND hospitality_guest.id_template = '.$idtemplate.'
                                            AND '.($_REQUEST['date'] == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$prima_data.'" AND hospitality_guest.DataRichiesta <= "'.$seconda_data.'"').'
                                            AND hospitality_guest.idsito = '.IDSITO.'
                                            AND hospitality_guest.Chiuso = 1
                                            AND hospitality_guest.DataChiuso IS NOT NULL
                                            AND hospitality_guest.Disdetta = 0
                                            AND hospitality_guest.TipoRichiesta = "Conferma"';
                    $re = $dbMysqli->query($sel);
                    $rs = $re[0];

                    $fatturatoTemplate    =  $rs['fatturato'];
                    if($fatturatoTemplate == '')$fatturatoTemplate = 0;

                    $array_fatturatoTemplate[$NomeTemplate.'#'.$Thumb]  = $fatturatoTemplate;
        }

        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as Totale
                        FROM hospitality_guest
                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        WHERE 1 = 1
                        AND '.($_REQUEST['date'] == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$prima_data.'" AND hospitality_guest.DataRichiesta <= "'.$seconda_data.'"').'
                        AND hospitality_guest.idsito = '.IDSITO.'
                        AND hospitality_guest.Chiuso = 1
                        AND hospitality_guest.DataChiuso IS NOT NULL
                        AND hospitality_guest.Disdetta = 0
                        AND hospitality_guest.TipoRichiesta = "Conferma" ';
        $r = $dbMysqli->query($sel);
        $rw = $r[0];
        $totale = $rw['Totale'];
        if($totale == '')$totale = 0;

        $fatturato = '';
        $ico       = '';
        $risultati = '';

        foreach ($array_fatturatoTemplate as $ky => $val) {
            $ky_tmp              = explode("#",$ky);
            $ky                  = $ky_tmp[0];
            $thumb_              = $ky_tmp[1];
            switch(($ky)){
                case 'default':
                    $fatturato   = $val;
                    $ico = 'fa fa-image text-orange';
                    $identificativo = 'id="default"';
                break;
                case 'smart':
                    $fatturato   = $val;
                    $ico = 'fa fa-image text-maroon';
                    $identificativo = 'id="smart"';
                break;
                case 'family':
                    $fatturato   = $val;
                    $ico = 'fa fa-image text-green';
                    $identificativo = 'id="family"';
                break;
                case 'bike':
                    $fatturato   = $val;
                    $ico = 'fa fa-image text-info';
                    $identificativo = 'id="bike"';
                break;
                case 'romantico':
                    $fatturato   = $val;
                    $ico = 'fa fa-image text-red';
                    $identificativo = 'id="romantico"';
                break;
                default:
                    $fatturato   = $val;
                    $stylecolor = colorGen();
                    $ico = 'fa fa-image';
                    $identificativo = 'id="'.get_name_template(IDSITO,'').'"';

                break;

            }

            if(!empty($fatturato) &&  !is_null($fatturato) && $fatturato > 0){
                $percent = ($fatturato*100/$totale);
                $percent = number_format($percent,2,',','.');
                $percent = str_replace(",00", "",$percent).' %';
            }else{
                $v       = 0;
                $percent = '0 %';
            }

            $label = (strlen($ky)<=6?$ky:substr($ky,0,6).'..');


            $risultati .= '<div class="row">
                                <div class="col-md-3 text-left"><i class="'.$ico.' fa-3x fa-fw" '.$identificativo.'  style="color:'.$stylecolor.'"></i></div>
                                <div class="col-md-3 text-center"><div class="clearfix"></div><b>'.ucfirst($label).'</b></div>
                                <div class="col-md-3 text-left nowrap" style="padding-left: 5px !important;"><div class="clearfix"></div><i class="fa fa-euro"></i> '.number_format($fatturato,0,',','.').'</div>
                                <div class="col-md-3 text-right nowrap" style="padding-left: 0px !important;"><div class="clearfix"></div><small>('.$percent.')</small></div>
                            </div>
                            <div class="clearfix"></div>';


        }
        $valore .= '<div class="row">';
        $valore .= '<div class="col-md-12"><b class="text-blue">Template Landing Page</b></div>';
        $valore .= '</div>';
        $valore .= '<div class="clearfix"></div>';
        $valore .= $risultati;
        $legenda .= '<div class="clearfix"></div>';
        $valore .= '<div class="row">';
        $valore .= '<div class="col-md-12 text-info">
                        <small><a href="javascript:;" id="attiva_legenda_info_template" data-toogle="tooltip" data-html="true" title="<div class=\'text-left\'>Se il layout template della landing page, non viene scelto al momento della creazione della proposta, i calcoli sopra citati, non ne tengono in considerazione!<br> I valori in € sono espressi senza decimali ,00</div>">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></small>
                    </div>';
        $valore .= '</div>';

    }
        return $valore;


}
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

}


function fatturato_post_upselling(){
    global $dbMysqli,$filter_query,$filter_query_p;
            $selectUP = "SELECT hospitality_traccia_email_upselling.id_richiesta,hospitality_traccia_email_upselling.NumPreno, hospitality_traccia_email_upselling.data_invio ,hospitality_guest.DataModificaPrenotazione
                                    FROM hospitality_traccia_email_upselling
                                    INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_traccia_email_upselling.id_richiesta
                                    WHERE hospitality_traccia_email_upselling.idsito = ".IDSITO."
                                    AND hospitality_guest.DataModificaPrenotazione IS NOT NULL
                                    AND hospitality_guest.DataModificaPrenotazione != '0000-00-00'
                                    GROUP BY hospitality_traccia_email_upselling.id_richiesta ORDER BY hospitality_traccia_email_upselling.id_richiesta DESC,hospitality_traccia_email_upselling.data_invio DESC,hospitality_guest.DataModificaPrenotazione DESC";
            $reUP  = $dbMysqli->query($selectUP);

            if(sizeof($reUP) > 0){
                $output .=' <table class="xcrud-list table table-striped table-hover table-bordered">
                                    <tr>
                                            <th class="text-center  nowrap"><small>Data Invio E-Mail UpSelling</th>
                                            <th class="text-left nowrap"><small>Nr.Prenotazione</small></th>
                                            <th class="text-center  nowrap"><small>Data Modifica Prenotazione</th>
                                            <th class="text-right nowrap"><small>Fatturato</th>
                                            <th class="text-center nowrap"><small>% sul fatt totale</small></th>
                                </tr>';

                    foreach ($reUP as $key => $value) {

                        $select5 = "SELECT  SUM(hospitality_proposte.PrezzoP) as fatturato_upselling
                                                FROM hospitality_guest
                                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                                WHERE hospitality_guest.Id = ".$value['id_richiesta']."
                                                ".($_REQUEST['action']=='request_date'?$filter_query:$filter_query_p)."
                                                AND hospitality_guest.idsito = ".IDSITO."
                                                AND hospitality_guest.Chiuso = 1
                                                AND hospitality_guest.Chiuso IS NOT NULL
                                                AND hospitality_guest.DataModificaPrenotazione IS NOT NULL
                                                AND hospitality_guest.DataModificaPrenotazione != '0000-00-00'
                                                AND hospitality_guest.Disdetta = 0
                                                AND hospitality_guest.TipoRichiesta = 'Conferma'
                                                ";
                                            $res5 = $reUP->query($select5);
                                            $rws5 = $res5[0];

                                            $fatturato_upselling = $rws5['fatturato_upselling'];
                                            $numero_preno_upselling = $rws5['numero_preno_upselling'];
                                            if($fatturato_upselling == '')$fatturato_upselling = 0;

                                            if(tot_fatturato(1)>0){
                                                $percent = ((100*$fatturato_upselling)/tot_fatturato(1));
                                            }else{
                                                $percent = '0';
                                            }

                                            $totalepercent += $percent;
                                            $totalepercent=  number_format($totalepercent,2,',','.');
                                            $totalepercent = str_replace(",00", "",$totalepercent).' %';

                                            $percent=  number_format($percent,2,',','.');
                                            $percent = str_replace(",00", "",$percent).' %';
                                            $totale += $fatturato_upselling;

                                            $output .='<tr>
                                                                            <td class="text-center nowrap">'.gira_data($value['data_invio']).'</td>
                                                                            <td class="text-center nowrap">'.$value['NumPreno'].'</td>
                                                                            <td class="text-center nowrap">'.gira_data($value['DataModificaPrenotazione']).'</td>
                                                                            <td class="text-right nowrap">'.($fatturato_upselling >0?number_format($fatturato_upselling ,2,',','.'):'0,00').' <i class="fa fa-euro"></i></td>
                                                                            <td class="text-center nowrap">'.$percent.'</td>
                                                                    </tr>';
                    }
                    $output .=' <tr>
                                    <td class="text-center nowrap"></td>
                                    <td class="text-center nowrap"></td>
                                    <td class="text-right nowrap"><b>Totale</b></td>
                                    <td class="text-right nowrap">'.number_format($totale ,2,',','.').' <i class="fa fa-euro"></i></td>
                                    <td class="text-center nowrap">'.$totalepercent.'</td>
                                </tr>';

                    $output .= '</table>';
            }else{
                $output = 'no dati!';
            }
    return $output;
}


function prenotazioni_fonte(){

    global $dbMysqli,$prima_data,$seconda_data;

    $percent     = '';
    $stringa     = '';
    $legenda     = '';
    $totale      = '';
    $fatturato   = '';

    $select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = ".IDSITO."";
    $rws = $dbMysqli->query($select);
    $tot = sizeof($rws);
    if($tot>0){

        foreach ($rws as $key => $value) {

            $select2 = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                    FROM hospitality_guest
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                    WHERE hospitality_guest.FontePrenotazione = "'.$value['FontePrenotazione'].'"
                                    AND '.($_REQUEST['date'] == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$prima_data.'" AND hospitality_guest.DataRichiesta <= "'.$seconda_data.'"').'
                                    AND hospitality_guest.idsito = '.IDSITO.'
                                    AND hospitality_guest.Chiuso = 1
                                    AND hospitality_guest.Disdetta = 0
                                    AND hospitality_guest.TipoRichiesta = "Conferma" ';
            $res2 = $dbMysqli->query($select2);
            $rws2 = $res2[0];
            $fatturato = $rws2['fatturato'];
            if($fatturato == '')$fatturato = 0;
            $array_fatturato[$value['FontePrenotazione'].'_'.$value['Abilitato']]  = $fatturato;

        }

        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as Totale
                        FROM hospitality_guest
                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        WHERE 1 = 1
                        AND '.($_REQUEST['date'] == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$prima_data.'" AND hospitality_guest.DataRichiesta <= "'.$seconda_data.'"').'
                        AND hospitality_guest.idsito = '.IDSITO.'
                        AND hospitality_guest.Chiuso = 1
                        AND hospitality_guest.Disdetta = 0
                        AND hospitality_guest.TipoRichiesta = "Conferma" ';
        $r = $dbMysqli->query($sel);
        $rw = $r[0];
        $totale = $rw['Totale'];
        if($totale == '')$totale = 0;


        $k           = '';
        $percent     = '';
        $stringa     = '';
        $legenda     = '';
        $v           = '';
        foreach ($array_fatturato as $k => $v) {


            $k_tmp     =explode("_",$k);
            $k         = $k_tmp[0];
            $abilitato = $k_tmp[1];

            switch(strtolower($k)){
                case 'sito web':
                    $color = '#f39c12';
                    $label = 'Sito Web / Landing';
                break;
                case 'posta elettronica':
                    $color = '#f56954';
                    $label = 'Posta Elettronica';
                break;
                case 'info alberghi':
                    $color = '#605ca8';
                    $label = 'Info Alberghi';
                break;
                case 'gabiccemare.com':
                    $color = '#dd4b39';
                    $label = 'gabiccemare.com';
                break;
                case 'reception':
                    $color = '#39cccc';
                    $label = 'Reception';
                break;
                case 'telefono':
                    $color = '#f012be';
                    $label = 'Telefono';
                break;
                case 'telefonata':
                    $color = '#f012be';
                    $label = 'Telefonata';
                break;
                case 'whatsapp':
                    $color = '#00a65a';
                    $label = 'Whatsapp';
                break;
                case 'facebook':
                    $color = '#3c8dbc';
                    $label = 'Facebook';
                break;
                default:
                    $color = colorGen();
                    $label = $k;
                break;

            }



            if(!empty($v) &&  !is_null($v) && $v > 0){
                $percent = ($v*100/$totale);
                $percent = number_format($percent,2,',','.');
                $percent = str_replace(",00", "",$percent).' %';
            }else{
                $v       = 0;
                $percent = '0 %';
            }
            $label = (strlen($label)<=17?$label:substr($label,0,17).'...');
            $stringa .= '<div class="row">';
            $stringa .= '<div class="col-md-6 nowrap '.($abilitato==0?'text-gray':'').'"><small><i class="fa fa-newspaper-o ico_list" style="color:'.$color.'"></i> '.$label.' '.($abilitato==0?' <small>(non attivo)</small>':'').'</small></div>';
            $stringa .= '<div class="col-md-3 nowrap"><small><i class="fa fa-euro"></i> '.number_format($v,0,',','.').'</small></div>';
            $stringa .= '<div class="col-md-3 nowrap text-left" style="padding-left: 5px !important;"><small>('.$percent.')</small></div>';
            $stringa .= '</div>';



        }


            $legenda .= '<div class="row">';
            $legenda .= '<div class="col-md-12"><b class="text-blue">Fonte di provenienza</b></div>';
            $legenda .= '</div>';
            $legenda .= '<div class="clearfix"></div>';
            $legenda .= $stringa;
            $legenda .= '<div class="clearfix"></div>';
            $legenda .= '<div class="row">';
            $legenda .= '<div class="col-md-12 text-info"><small><a href="javascript:;" id="attiva_legenda_info_fonti" data-toogle="tooltip" data-html="true" title="<div class=\'text-left\'>I valori in € sono espressi senza decimali ,00</div>">Help  <i class="fa fa-life-ring text-info"></i></a></small></div>';
            $legenda .= '</div>';


    }
    return $legenda;
}
function printR($array) {
	echo '<pre>';
		print_r($array);
	echo '</pre>';
}
// funzione per il top email
function top_email($template){
	// 1 = recupero password
	// 2 =
	switch($template){
		case 1:
			$top = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
					<head>
						<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
						<title>".NOME_AMMINISTRAZIONE."</title>
						<link rel=\"stylesheet\" type=\"text/css\" href=\"".BASE_URL_SITO."css/style_email.css\" />
						<style>
							@charset \"UTF-8\";

						@font-face {
						  font-family: 'Source Sans Pro';
						  font-style: normal;
						  font-weight: 300;
						  src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(".BASE_URL_SITO."css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format('woff');
						}
						@font-face {
						  font-family: 'Source Sans Pro';
						  font-style: normal;
						  font-weight: 400;
						  src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(".BASE_URL_SITO."css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
						}
						@font-face {
						  font-family: 'Source Sans Pro';
						  font-style: normal;
						  font-weight: 700;
						  src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(".BASE_URL_SITO."css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
						}

						@font-face {
						  font-family: 'Vollkorn';
						  font-style: normal;
						  font-weight: 400;
						  src: local('Vollkorn Regular'), local('Vollkorn-Regular'), url(".BASE_URL_SITO."css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
						}
						@font-face {
						  font-family: 'Vollkorn';
						  font-style: normal;
						  font-weight: 700;
						  src: local('Vollkorn Bold'), local('Vollkorn-Bold'), url(".BASE_URL_SITO."css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format('woff');
						}

						body { margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
						a{ text-decoration:none; color:#333333; }
						h2{ font-size:12pt; }
						.tbl_body { width:700px; font-size:10pt; background-color:#FFFFFF; border-collapse:collapse; }
						.tbl_body td { padding:5px; }
						.tbl_body .spacer_td { border-top:solid 1px #999999; background-color:#EEEEEE; height:30px; }
						.tbl_body .spacer_btm_td { border-bottom:solid 1px #999999; height:15px; }
						.title{ background-color:#FFFFFF; color:#666666; font-size:14pt; }
						.footer{ background-color:#BBBBBB; color:#666666; font-size:8pt; }
						.footer a{ color:#EEEEEE; }
						.tit_residuo{ display: inline-block; font-size: 10pt; margin: 0 0 0 40px; padding: 3px 0 0; /* text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
						.alert_tit_residuo{ color:#990000; }
						.tit_residuo .lbl_tit_residuo { display:inline-block; width:450px; }
						.tit_residuo .lbl_val_residuo { display:inline-block; width:100px; vertical-align: top;}
						.tit_ass_ore_residuo{   display: inline-block; font-size: 10pt; margin: 0 5px; padding: 3px 0 0; text-align: left; /*text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
						.tit_ass_ore_consumato{ display: inline-block; font-size: 10pt; margin: 0 5px; padding: 3px 0 0; text-align: center; width: 40%; /* text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
						.tbl_pack {display:table;}
						.tbl_pack_row {display:table-row;}
						.tbl_pack_row:nth-child(1) {border-top: 1px solid #DDDDDD;}
						.tbl_pack_row:nth-child(2) {background-color:#dfedfe;}
						.tbl_pack_td {border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; display: table-cell; margin: 0 5px 5px 0; padding: 5px; font-size: 9pt; vertical-align:top;}
						.tbl_pack_td:nth-child(1) {border-left: 1px solid #DDDDDD;}
						.tbl_pack_td_tit { font-weight:bold; background-color:#f7fedf; font-size: 10pt;}
						.tbl_pack_td small{font-size:8pt;}
						.tbl_pack_td b{font-size: 9pt;}
						.box_note_commerciali_det_storico{background-color: #FFFFFF; border: 1px solid #999999; display: inline-block; min-height: 350px; overflow: auto; padding: 0 5px; width: 465px; vertical-align: top;}
						.info_note_commerciali_top{font-size:9pt; border-bottom:solid 1px #999999; padding:5px 0; display:block; height: auto; position:relative;}
						.info_note_commerciali_bottom{font-size:9pt; border-top:solid 1px #999999; padding:5px 0; display:block; height: auto; position:relative;}
						.info_note_commerciali_top p, .info_note_commerciali_bottom p{margin:0;}
						.info_note_commerciali_top h3, .info_note_commerciali_bottom h3{margin:0;}
						.txt_nota_commerciale{font-size:10pt; padding:5px 15px;}
						.txt_nota_tecnica{display:block; margin:0px 0px 10px 0px; padding:10px; background-color:#F5F5F5;}
						.row_nota_commerciale{display:block; margin:0px 0px 10px 0px; padding:10px;}
						.row_list_note{display:block; padding: 10px 5px; border: 1px solid #666666; margin:0px 0px 5px;}
						</style>
					</head>
					<body>";
			break;
	}
	return($top);
}
// funzione per il footer email
function footer_email($template){
	// 1 = recupero password
	// 2 =
	switch($template){
		case 1:
			$footer = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
								<tr>
									<td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
											<img height="27" src="'.BASE_URL_SITO.'img/logo_network_2021.png" align="left" style="margin-right:5px;"> Network Service srl - Via Valentini A. e L., 11 47922 Rimini (RN) | P.I. 02675250407<br />
											tel. 0541.790062 | fax 0541.778656 | <a href="mailto:info@network-service.it">info@network-service.it</a>
									</td>
								</tr>
							</table>
						</body>
					</html>';
			break;
	}
	return($footer);
}

function calcola_distanza($latitude1, $longitude1, $latitude2, $longitude2) {
  $theta = $longitude1 - $longitude2;
  $miles = (sin(@deg2rad($latitude1)) * sin(@deg2rad($latitude2))) + (cos(@deg2rad($latitude1)) * cos(@deg2rad($latitude2)) * cos(@deg2rad($theta)));
  $miles = acos($miles);
  $miles = rad2deg($miles);
  $miles = $miles * 60 * 1.1515;
  $feet = $miles * 5280;
  $yards = $feet / 3;
  $km = $miles * 1.609344;
  $meters = $kilometers * 1000;
  return compact('km');
}

function from_id_to_cod($value)
{

        switch($value) {
                case"1":
                    $cod_lang = 'it';
                break;
                case"2":
                    $cod_lang = 'en';
                break;
                case"3":
                    $cod_lang = 'fr';
                break;
                case"4":
                    $cod_lang = 'de';
                break;
                case"5":
                    $cod_lang = 'es';
                break;
                case"6":
                    $cod_lang = 'ru';
                break;
                case"7":
                    $cod_lang = 'nl';
                break;
                case"8":
                    $cod_lang = 'pl';
                break;
                case"9":
                    $cod_lang = 'hu';
                break;

                case"10":
                    $cod_lang = 'pt';
                break;

                case"11":
                    $cod_lang = 'ae';
                break;

                case"12":
                    $cod_lang = 'cz';
                break;

                case"13":
                    $cod_lang = 'cn';
                break;
                case"14":
                    $cod_lang = 'br';
                break;
                case"15":
                    $cod_lang = 'jp';
                break;

            }


        return $cod_lang;
    }
function from_id_to_lg($value)
{

        switch($value) {
                case"1":
                    $lang = 'Italiano';
                break;
                case"2":
                    $lang = 'Inglese';
                break;
                case"3":
                    $lang = 'Francese';
                break;
                case"4":
                    $lang = 'Tedesco';
                break;
                case"5":
                    $lang = 'Spagnolo';
                break;
                case"6":
                    $lang = 'Russo';
                break;
                case"7":
                    $lang = 'Olandese';
                break;
                case"8":
                    $lang = 'Polacco';
                break;
                case"9":
                    $lang = 'Ungherese';
                break;

                case"10":
                    $lang = 'Portoghese';
                break;

                case"11":
                    $lang = 'Arabo';
                break;

                case"12":
                    $lang = 'Checo';
                break;

                case"13":
                    $lang = 'Cinese';
                break;
                case"14":
                    $lang = 'Brasiliano';
                break;
                case"15":
                    $lang = 'Giapponese';
                break;

            }


        return $lang;
    }
function getLingueSito($idSito){
	global $dbMysqli;
		$lingue = array();
		$q = "  SELECT 
                    hospitality_lingue_form.codlingua, 
                    hospitality_lista_lingue.id_lang 
                FROM 
                    hospitality_lista_lingue, hospitality_lingue_form 
                WHERE 
                    hospitality_lingue_form.idsito = '".$idSito."' 
                AND 
                    hospitality_lingue_form.codlingua = hospitality_lista_lingue.codice 
                ORDER BY
                    hospitality_lista_lingue.id_lang asc";
		$result  = $dbMysqli->query($q);
		foreach($result as $key => $row){
			$lingue[$row['id_lang']] = $row['codlingua'];
		}
	return $lingue;
}
function getLingue($idSito){
	global $dbMysqli;
		$lingue = array();
		$q = "SELECT * FROM hospitality_lingue WHERE idsito = '".$idSito."' order by id_lingua asc";
		$result = $dbMysqli->query($q);
		foreach($result as $key => $row){
			$lingue[$row['id_lingua']] = $row['Sigla'];
		}
	return $lingue;
}
function field_clean($stringa){

	$clean_title = str_replace( "!", "", $stringa );
	$clean_title = str_replace( "?", "", $clean_title );
	$clean_title = str_replace( ":", "", $clean_title );
	$clean_title = str_replace( "+", "", $clean_title );
	$clean_title = str_replace( "à", "a", $clean_title );
	$clean_title = str_replace( "è", "e", $clean_title );
	$clean_title = str_replace( "é", "e", $clean_title );
	$clean_title = str_replace( "ì", "i", $clean_title );
	$clean_title = str_replace( "ò", "o", $clean_title );
	$clean_title = str_replace( "ù", "u", $clean_title );
	$clean_title = str_replace( "n.", "", $clean_title );
	$clean_title = str_replace( ".", "", $clean_title );
	$clean_title = str_replace( ",", "", $clean_title );
	$clean_title = str_replace( ";", "", $clean_title );
	$clean_title = str_replace( "'", "", $clean_title );
	$clean_title = str_replace( "*", "", $clean_title );
	$clean_title = str_replace( "/", "", $clean_title );
	$clean_title = str_replace( "\"", "", $clean_title );
	$clean_title = str_replace( " ", "", $clean_title );
	$clean_title = strtolower($clean_title);
	$clean_title = trim($clean_title);

	return($clean_title);
}
function mini_clean($stringa){

	$clean_title = str_replace( "*", "", $stringa );
	$clean_title = str_replace( "'", "", $clean_title );
	$clean_title = str_replace( "/", "", $clean_title );
	$clean_title = str_replace( "\"", "", $clean_title );
	$clean_title = trim($clean_title);

	return($clean_title);
}

function check_double_syncro_form_sito($idsito,$NumeroPrenotazione){
    global $dbMysqli;
    $select    = "SELECT COUNT(NumeroPrenotazione) as numero FROM hospitality_guest WHERE idsito = ".$idsito." AND NumeroPrenotazione = ".$NumeroPrenotazione." AND TipoRichiesta = 'Preventivo'";
    $risultato = $dbMysqli->query($select);
    $row       = $risultato[0];
    return $row['numero'];
}

function syncro_form_sito(){
        global $dbMysqli;

        $json_output = array();

		 # seleziono solo le mail che fanno riferimento al sito e che hanno syncro_hospitality a 0, cioè che non siano mai state importate prima!
		$select = "SELECT id_notifica,json_richiesta,data_invio, oggetto_notifica FROM notifiche WHERE id_sito_riferimento = ".IDSITO." AND syncro_hospitality = 0 AND data_invio >= '".DATA_ATTIVAZIONE."' ORDER BY id_notifica DESC";

		$result = $dbMysqli->query($select);

		$tot    = sizeof($result);
		if($tot > 0){

			// azzero le variabile
			$email_hotel                   = '';
			$id_lingua                     = '';
			$lingua                        = '';
			$nome                          = '';
			$cognome                       = '';
			$email_utente                  = '';
			$cellulare                     = '';
			$data_arrivo                   = '';
            $data_partenza                 = '';
            $DataArrivo                    = '';
			$DataPartenza                  = '';
			$numero_adulti                 = '';
			$numero_bambini                = '';
			$trattamento                   = '';
			$sistemazione                  = '';
			$tipo_richiesta                = '';
			$note                          = '';
			$insert                        = '';
			$update                        = '';
			$numero_prenotazione           = '';
			$data_A_tmp                    = '';
			$dataAtmp                      = '';
			$dataAtmp2                     = '';
			$data_P_tmp                    = '';
			$dataPtmp                      = '';
			$dataPtmp2                     = '';
			$bambini_eta                   = '';
			$hotel                         = '';
			$info_percorso                 = '';
			$provenienza                   = '';
			$timeline                      = '';
            $insert_t                      = '';
            $RigheCompilate                = '';
            $n_righe                       = '';
            $ConsensoMarketing             = '';
            $ConsensoProfilazione          = '';
            $ConsensoPrivacy               = '';
            $TipoVacanza                   = '';

			foreach ($result as $key => $value) {
                if(!strstr($value['oggetto_notifica'],'Newsletter')){
				    # assegno array con chive id della richiesta ricevuto dal sito ed i valori in json di tutta la mail
			        $json_output[$value['id_notifica'].'#'.$value['data_invio']] = json_decode($value['json_richiesta'], true);
                }
			} // chiusura del foreach

				//print_r($json_output); exit;

			// azzero le variabile
			$data_arrivo          = '';
			$data_partenza        = '';
			$data_A_tmp           = '';
			$dataAtmp             = '';
			$dataAtmp2            = '';
			$data_P_tmp           = '';
			$dataPtmp             = '';
            $dataPtmp2            = '';
            $DataArrivo           = '';
			$DataPartenza         = '';
			$data_A_tmp_alt       = '';
			$dataAtmpAlternativa  = '';
			$dataAtmp2Alternativa = '';
			$data_P_tmp_alt       = '';
			$dataPtmpAlternativa  = '';
            $dataPtmp2Alternativa = '';
            $RigheCompilate       = '';
            $n_righe              = '';
            $check                = '';
            $numero_prenotazione  = '';


			foreach ($json_output as $k => $v) {


						$select2             = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".IDSITO." ORDER BY NumeroPrenotazione DESC";
						$res2                = $dbMysqli->query($select2);
						$rws                 = $res[0];
						$numero_prenotazione =  (intval($rws['NumeroPrenotazione'])+1);
                # checkse è già stato inserito
                $check = check_double_syncro_form_sito(IDSITO,$numero_prenotazione);
                if($check==0){
						$_tmp = explode("#",$k);
						$id_notifica = $_tmp[0];
						$data_richiesta = date('Y-m-d',$_tmp[1]);
		                // assegno il valore alle variabili
						$email_hotel    =  $v['destinatario_email'];
						$id_lingua      =  $v['id_lingua'];
						$lingua         =  from_id_to_cod($id_lingua);
						$nome           =  $v['nome'];
						$cognome        =  $v['cognome'];
						$email_utente   =  $v['email'];
                        $cellulare      =  field_clean($v['telefono']);
						$dataAtmp       =  explode("/",$v['data_arrivo']);
						$dataAtmp2      =  explode("-",$v['data_arrivo']);

						if($dataAtmp[1]!=''){
							$data_A_tmp = $dataAtmp;
						}elseif($dataAtmp2[1]!=''){
							$data_A_tmp = $dataAtmp2;
						}
						$data_arrivo    =  $data_A_tmp[2].'-'.$data_A_tmp[1].'-'.$data_A_tmp[0];

						$dataPtmp       =  explode("/",$v['data_partenza']);
						$dataPtmp2      =  explode("-",$v['data_partenza']);
						if($dataPtmp[1]!=''){
							$data_P_tmp = $dataPtmp;
						}elseif($dataPtmp2[1]!=''){
							$data_P_tmp = $dataPtmp2;
						}
						$data_partenza  =  $data_P_tmp[2].'-'.$data_P_tmp[1].'-'.$data_P_tmp[0];

						if($v['data_arrivo'] == ''){$data_arrivo=date('Y-m-d');}
                        if($v['data_partenza'] == ''){$data_partenza=date('Y-m-d');}


                        $dataAtmpAlternativa       =  explode("/",$v['DataArrivo']);
						$dataAtmp2Alternativa      =  explode("-",$v['DataArrivo']);

						if($dataAtmpAlternativa[1]!=''){
							$data_A_tmp_alt = $dataAtmpAlternativa;
						}elseif($dataAtmp2Alternativa[1]!=''){
							$data_A_tmp_alt = $dataAtmp2Alternativa;
						}
						$DataArrivo    =  $data_A_tmp_alt[2].'-'.$data_A_tmp_alt[1].'-'.$data_A_tmp_alt[0];

						$dataPtmpAlternativa       =  explode("/",$v['DataPartenza']);
						$dataPtmp2Alternativa      =  explode("-",$v['DataPartenza']);
						if($dataPtmpAlternativa[1]!=''){
							$data_P_tmp_alt = $dataPtmpAlternativa;
						}elseif($dataAtmp2Alternativa[1]!=''){
							$data_P_tmp_alt = $dataPtmpAlternativa;
						}
                        $DataPartenza  =  $data_P_tmp_alt[2].'-'.$data_P_tmp_alt[1].'-'.$data_P_tmp_alt[0];

                        if($v['TipoSoggiorno']){
                            $n_righe = count($v['TipoSoggiorno']);
                            $i=0;
                            $RigheCompilate  = '';
                            for($i==0; $i<=($n_righe-1); $i++){
                                $RigheCompilate  .= ($v['TipoSoggiorno'][$i]!=''?' - Trattamento: '.$v['TipoSoggiorno'][$i]:'').' '.($v['NumeroCamere'][$i]!=''?' &#10230; Nr.: ' .$v['NumeroCamere'][$i].'  ':'').' '.($v['TipoCamere'][$i]!=''?' &#10230; Sistemazione: '.$v['TipoCamere'][$i]:'').' '.($v['NumAdulti'][$i]!=''?' &#10230; Nr.Adulti: '.$v['NumAdulti'][$i]:'').' '.($v['NumBambini'][$i]!=''?' &#10230; Nr.Bambini: '.$v['NumBambini'][$i]:'').' '.($v['EtaB'][$i]!=''?' &#10230; Età: '.$v['EtaB'][$i]:'')."\r\n";
                            }
                        }
						$numero_adulti  =  $v['adulti'];
						$numero_bambini =  $v['bambini'];
						$trattamento    =  $v['trattamento'];
						$bambini_eta    =  $v['bambini_eta'];
                        $sistemazione   =  $v['sistemazione'];
                        $TipoVacanza    =  $v['TipoVacanza'];;
						$hotel          =  $v['hotel'];
						$tipo_richiesta =  $v['tipo_richiesta'];
						$note           =  ($bambini_eta !=''?'Età bambini: '.$bambini_eta.'; ':'').' '.($sistemazione !=''?'Sistemazione: '.$sistemazione.'; ':'').' '.($trattamento !=''?' Trattamento: '.$trattamento.'; ':'');
                        $note          .=  (($v['DataArrivo']!='' || $v['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$v['DataArrivo'].' Data Partenza Alternativa: '.$v['DataPartenza']."\r\n":'');
                        $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                        $note          .=  ($v['messaggio']!=''?"\r\n".'Note: '.$v['messaggio']:'');

                        $ConsensoMarketing    = ($v['marketing']=='on'?1:0);
                        $ConsensoProfilazione = ($v['profilazione']=='on'?1:0);
                        $ConsensoPrivacy      = ($v['privacy']=='checkbox' || $v['privacy']=='consenso'?1:0);
                        $Ip                   = $v['REMOTE_ADDR'];
                        $Agent                = $v['HTTP_USER_AGENT'];

						if($nome != '' && $cognome != '' && $numero_adulti != '' && $v['data_arrivo'] != '' && $v['data_partenza'] != ''){


                                    # inserimento dati form richiesta informazioni del sito
                                    $insert = "INSERT INTO hospitality_guest(idsito,
                                                                            id_politiche,
                                                                            Nome,
                                                                            Cognome,
                                                                            EmailSegretaria,
                                                                            Cellulare,
                                                                            Email,
                                                                            NumeroPrenotazione,
                                                                            DataArrivo,
                                                                            DataPartenza,
                                                                            FontePrenotazione,
                                                                            Note,
                                                                            TipoRichiesta,
                                                                            TipoVacanza,
                                                                            Lingua,
                                                                            NumeroAdulti,
                                                                            NumeroBambini,
                                                                            DataRichiesta,
                                                                            CheckConsensoPrivacy,
                                                                            CheckConsensoMarketing,
                                                                            CheckConsensoProfilazione,
                                                                            Ip,
                                                                            Agent)
                                                                            VALUES('".IDSITO."',
                                                                                        '0',
                                                                                        '".addslashes($nome)."',
                                                                                        '".addslashes($cognome)."',
                                                                                        '".$email_hotel."',
                                                                                        '".$cellulare."',
                                                                                        '".$email_utente."',
                                                                                        '".$numero_prenotazione."',
                                                                                        '".$data_arrivo."',
                                                                                        '".$data_partenza."',
                                                                                        '".(($hotel=="" || $hotel=="--")?"Sito Web":addslashes($hotel))."',
                                                                                        '".addslashes($note)."',
                                                                                        'Preventivo',
                                                                                        '".$TipoVacanza."',
                                                                                        '".$lingua."',
                                                                                        '".$numero_adulti."',
                                                                                        '".$numero_bambini."',
                                                                                        '".$data_richiesta."',
                                                                                        '".$ConsensoPrivacy."',
                                                                                        '".$ConsensoMarketing."',
                                                                                        '".$ConsensoProfilazione."',
                                                                                        '".$Ip."',
                                                                                        '".$Agent."')";
                                    $dbMysqli->query($insert);

                                    // CODICE PER IL TRACCIAMENTO DELLA PROVENINEZA DA SITO WEB, SE DA CAMPAGNA FB, PPC, GOOGLE; ECC
                                    $info_percorso = json_decode($v['percorso']);
                                    if(isset($info_percorso)){
                                        // HTTP_REFERER
                                        if(isset($info_percorso->user_data->HTTP_REFERER)){
                                            $provenienza = $info_percorso->user_data->HTTP_REFERER;
                                        }
                                        if(isset($info_percorso->timeline)){
                                            foreach($info_percorso->timeline as $x => $y){
                                              if (strpos($y->url, 'image.php?') == false && $y->time > 0) {
                                                if(!strstr($y->url,'inc_check_valid_email.php')){
                                                  $Tline = SITOWEB.$y->url;
                                                  $insert_t = "INSERT INTO hospitality_fonti_provenienza(idsito,
                                                                                                          NumeroPrenotazione,
                                                                                                          Provenienza,
                                                                                                          Timeline)
                                                                                                          VALUES('".IDSITO."',
                                                                                                          '".$numero_prenotazione."',
                                                                                                          '".addslashes($provenienza)."',
                                                                                                          '".addslashes($Tline)."')";
                                                  $dbMysqli->query($insert_t);
                                                }
                                              }
                                            }
                                        }


                                    }

                                    #azzero vabilibili
                                    $check                = '';
                                    $numero_prenotazione  = '';
                                    #################################################################################################
                                    #
                                    # update campo syncro_hospitality nella tabella notifiche per non importare 2 volte la stessa mail
                                    $update = "UPDATE notifiche SET syncro_hospitality = 1 WHERE id_notifica = ".$id_notifica;
                                    $dbMysqli->query($update);

                        } //chiusura se il campo nome, cognome, adulti sono compilati

                }//chiusura se il numeroprenotazione è già presente

            } // chiusura del foreach

			$syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".IDSITO."','".date('Y-m-d H:i:s')."')";
			$dbMysqli->query($syncro);
		}// chiusura del primo if sul totale dei record nella prima query

}

function check_comunicazioni(){
	global $dbMysqli;
	    $s = 'SELECT * FROM comunicazioni WHERE DataInizio <= "'.date('Y-m-d').'" AND DataFine > "'.date('Y-m-d').'" AND Abilitato = 1 ORDER BY Id DESC LIMIT 1';
	    $r = $dbMysqli->query($s);
        $rSW = $r[0];
	      if(sizeof($r)>0){
	        $button ='<li class="dropdown tasks-menu">
	        				<a href="#" data-toggle="modal" data-target="#comunicazioni" title="Ri-Apri la modale delle Comunicazioni">
	        					<span class="text-white f-11 f-w-100 border-nav">Comunicazioni da Network Service</span>
	        				</a>
	        			</li>';
	      }
	     return $button;
}

	function data_scadenza_software(){
		global $dbMysqli;

		$select     = "SELECT DATEDIFF(data_end_hospitality,'".date('Y-m-d')."') AS DiffDate, data_end_hospitality   FROM siti WHERE idsito = ".IDSITO." AND hospitality = 1";
		$res        = $dbMysqli->query($select);
		$row        = $res[0];

		$differenza = ($row['DiffDate']);

		$diff_data  = (100-$differenza);

		$d_e_tmp    = explode("-",$row['data_end_hospitality']);

		$data_end   = $d_e_tmp[2].'-'.$d_e_tmp[1].'-'.$d_e_tmp[0];

		if($differenza <= 31){

			$box ='<li class="dropdown tasks-menu">
	                 	<span class="badge badge-warning text-white f-11 f-w-100 border-nav">Prossima scadenza di Quoto!: '.$data_end .'</span>
	             </li>';
		}


	    return $box;
	}

	function scadenza_software(){
		global $dbMysqli;

		$select     = "SELECT DATEDIFF(data_end_hospitality,'".date('Y-m-d')."') AS DiffDate, data_start_hospitality,data_end_hospitality,servizi_attivi,no_rinnovo_hospitality  FROM siti WHERE idsito = ".IDSITO." AND hospitality = 1";
		$res        = $dbMysqli->query($select);
		$row        = $res[0];

		$differenza = $row['DiffDate'];

		$diff_data  = (100-ceil(($differenza*100)/365));

		$d_a_tmp    = explode("-",$row['data_start_hospitality']);

		$data_start = $d_a_tmp[2].'-'.$d_a_tmp[1].'-'.$d_a_tmp[0];

		$d_e_tmp    = explode("-",$row['data_end_hospitality']);

		$data_end   = $d_e_tmp[2].'-'.$d_e_tmp[1].'-'.$d_e_tmp[0];

        $array_servizi = explode(",",$row['servizi_attivi']);

        if(in_array('Quoto',$array_servizi)){

            $giorni = mktime (0,0,0,$d_e_tmp[1],$d_e_tmp[2],($d_e_tmp[0]-1));
            $data = date('Y-m-d',$giorni);
            $dateCalcolo = 'dal <b>'.gira_data($data).'</b> al <b>'.$data_end.'</b>';
            $etichettaTipoQuoto = '<b>'.NOME_AMMINISTRAZIONE.'</b> v.'.VERSIONE;

        }elseif(in_array('Quoto TR',$array_servizi)){

            $giorni = mktime (0,0,0,$d_e_tmp[1],$d_e_tmp[2],($d_e_tmp[0]-3));
            $data = date('Y-m-d',$giorni);
            $dateCalcolo = 'dal <b>'.gira_data($data).'</b> al <b>'.$data_end.'</b>';
            $etichettaTipoQuoto = '<b>'.NOME_AMMINISTRAZIONE.' TR</b> v.'.VERSIONE;

        }

			$box ='<li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <div class="label-icon"> 
                                        <span class="f-11 border-nav">
                                            Scadenza CRM
                                            <i class="fa fa-hourglass-end"></i>
                                            <label class="badge badge-danger">'.$differenza.'</label> 
                                        </span>
                                    </div>
                                   
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li class="text-center">
                                        <h6>Date dalla  prima attivazione CRM alla scadenza</h6>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-6 f-10 text-left">Prima attivazione</div>
                                            <div class="col-md-6 f-10 text-right">Scadenza</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6"> <small class="pull-left"><b>'.$data_start.'</b></small></div>
                                            <div class="col-md-6"><small class="pull-right"><b>'.$data_end.'</b></small>   </div>
                                        </div>                                                                                                                   
                                    </li>
                                    <li>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" style="width: '.$diff_data.'%;" aria-valuenow="'.$diff_data.'" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="text-center f-11">alla prossima scadenza sono rimasti <span class="text-danger f-14">'.$differenza.' gg</span><br><span class="f-11">('.$dateCalcolo.')</span></div>
                                    </li>
                                    <li class="text-center">
                                        <span class="f-12">'.$etichettaTipoQuoto.' '.($row['no_rinnovo_hospitality']==0?'verrà rinnovato automaticamente!':'non verrà più rinnovato alla scadenza!').'</span>
                                    </li>
                                </ul>
                            </div>
                        </li>';

	    return $box;
	}
	function syncro_oggetto_preventivo($value)
	{
        switch($value) {
                case"it":
                    $oggetto = 'Proposta di Preventivo';
                break;
                case"en":
                    $oggetto = 'Proposal for Quotation';
                break;
                case"fr":
                    $oggetto = 'Proposition de devis';
                break;
                case"de":
                    $oggetto = 'Vorschlag für Quotation';
                break;
                default:
                    $oggetto = 'Proposal for Quotation';
                break;

            }
        return $oggetto;
    }
	function syncro_messaggio_preventivo($value)
	{
        switch($value) {
                case"it":
                    $messaggio = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato';
                break;
                case"en":
                    $messaggio = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period';
                break;
                case"fr":
                    $messaggio = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée';
                break;
                case"de":
                    $messaggio = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten';
                break;
                default:
                    $messaggio = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period';
                break;

            }
        return $messaggio;
    }
	function syncro_oggetto_conferma($value)
	{
        switch($value) {
                case"it":
                    $oggetto = 'Conferma prenotazione';
                break;
                case"en":
                    $oggetto = 'Confirmation of reservation';
                break;
                case"fr":
                    $oggetto = 'Confirmation de réservation';
                break;
                case"de":
                    $oggetto = 'Buchungsbestätigung';
                break;
                default:
                    $oggetto = 'Confirmation of reservation';
                break;

            }
        return $oggetto;
    }
	function syncro_messaggio_conferma($value)
	{
        switch($value) {
               case"it":
                    $messaggio = "Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia";
                break;
                case"en":
                    $messaggio = "Dear [cliente], in response to your kind reply of acceptance, we give you confirmation of your stay you indicated, but not yet accepted as a definite reservation on hold because of the advance payment or credit card number to guarantee";
                break;
                case"fr":
                    $messaggio = "Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie";
                break;
                case"de":
                    $messaggio = "Sehr geehrter [cliente],  als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie";
                break;
                default:
                    $messaggio = "Dear [cliente], in response to your kind reply of acceptance, we give you confirmation of your stay you indicated, but not yet accepted as a definite reservation on hold because of the advance payment or credit card number to guarantee";
                break;


            }
        return $messaggio;
    }

    function syncro_web_preventivo($value)
	{
        switch($value) {
                case"it":
                    $testo = "Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato.
								Per vedere l\'offerta basta un semplice click sul link sottostante.";
                break;
                case"en":
                    $testo = "Dear [cliente],  in response to your kind request, we proceeded to elaborate our holiday offer for the requested period.
							To see the offer, a simple click on the link below.";
                break;
                case"fr":
                    $testo = "Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée.
							Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.";
                break;
                case"de":
                    $testo = "Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten.
							Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben.";
                break;
                default:
                    $testo = "Dear [cliente],  in response to your kind request, we proceeded to elaborate our holiday offer for the requested period.
							We hope that our tax proposals are happy with your choice, thank you staying at your disposal.";
                break;

            }
        return $testo;
    }
    function syncro_web_conferma($value)
	{
        switch($value) {
                case"it":
                    $testo = "Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia";
                break;
                case"en":
                    $testo = "Dear [cliente], in response to your kind reply of acceptance, we give you confirmation of your stay you indicated, but not yet accepted as a definite reservation on hold because of the advance payment or credit card number to guarantee";
                break;
                case"fr":
                    $testo = "Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie";
                break;
                case"de":
                    $testo = "Sehr geehrter [cliente],  als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie";
                break;
                default:
                    $testo = "Dear [cliente], in response to your kind reply of acceptance, we give you confirmation of your stay you indicated, but not yet accepted as a definite reservation on hold because of the advance payment or credit card number to guarantee";
                break;

            }
        return $testo;
    }

        function syncro_pernotto($value)
	{
        switch($value) {
                case"it":
                    $soggiorno = 'Solo Pernottamento';
                break;
                case"en":
                    $soggiorno = 'Room only';
                break;
                case"fr":
                    $soggiorno = 'Seulement Bed';
                break;
                case"de":
                    $soggiorno = 'Nur Bett';
                break;
                default:
                    $soggiorno = 'Room only';
                break;

            }
        return $soggiorno;
    }
    function guida(){
			$guida ='<li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <span class="border-nav f-11">
                                        Istruzioni d\'uso 
                                        <i class="fa fa-question-circle fa-lg"></i>
                                    </span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li class="text-center">
                                        <h6>Tutorial tipo: <b>Frequently Asked Questions</b></h6>
                                    </li>
                                        <li>
                                            <a href="'.BASE_URL_SITO.'tutorial/faq_quoto.pdf" class="link_istruzioni"  target="_blank">
                                                <i class="fa fa-file-pdf-o text-red"></i> Visualizza, scarica o stampa le istruzioni
                                            </a>
                                        </li>
                                        <li>
                                            <a href="'.BASE_URL_SITO.'ApiQuoto/index.php?idsito='.IDSITO.'" target="_blank" class="link_istruzioni" title="Includi il form QUOTO nel tuo sito!">
                                                <i class="fa fa-code text-green"></i> Includi il form QUOTO nel tuo sito!
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://quoto.online/tutorial/Buoni-Voucher-Quoto-2.pdf" class="link_istruzioni"  target="_blank" title="Istruzioni d\'uso Buono Voucher">
                                                <i class="fa fa-file-pdf-o text-red"></i> Tutorial Buono Voucher
                                            </a>
                                        </li>
                                       
                                        <li>
                                            <a href="mailto:'.MAIL_ASSISTENZA.'?subject='.NOMEHOTEL.': chiedo assistenza sul software QUOTO!" title="Invia una e-mail a Network Service!" class="link_istruzioni" >
                                                <i class="fa fa-question-circle text-info"></i> Chiedi assistenza a: '.MAIL_ASSISTENZA.'
                                            </a>
                                        </li>
                                </ul>
                            </div>
                        </li>';


	return $guida;
	}
    function video_guida(){

	          $guida .='<li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <span class="border-nav f-11">
                                        Video tutorial 
                                        <i class="fa fa-youtube fa-lg"></i>
                                    </span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Novità ultime release di QUOTO v.2.3.1 Beta" data-idvideo="SDNuXhp9XW4">
                                                <i class="fa fa-youtube-play info text-red"></i> Novità ultime release di QUOTO v.2.3.1 Beta
                                            </a>
                                        </li>
                                 <!--      <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Come creare un preventivo" data-idvideo="vy6nhrzuwE4">
                                                <i class="fa fa-youtube-play info text-red"></i> Come creare un preventivo
                                            </a>
                                        </li>
                                       <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Conferma in trattativa ed invio voucher" data-idvideo="ty9dEiOdk2g">
                                                <i class="fa fa-youtube-play info text-red"></i> Conferma in trattativa ed invio voucher
                                            </a>
                                        </li>
                                       <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Modulo Check-in Online" data-idvideo="h2DlmWi6gi4">
                                                <i class="fa fa-youtube-play info text-red"></i> Modulo di Check-In Online
                                            </a>
                                        </li>

                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Scelta dei servizi aggiuntivi da parte del cliente " data-idvideo="QMX2XPjEpEY">
                                                <i class="fa fa-youtube-play info text-red"></i> Scelta dei servizi aggiuntivi da parte del cliente 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Template e testi per target cliente " data-idvideo="SeEJRnvoVQo">
                                                <i class="fa fa-youtube-play info text-red"></i> Template e testi per target cliente 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Novità d\'autunno 2021 di Quoto!" data-idvideo="WPem5MxjW1c">
                                                <i class="fa fa-youtube-play info text-red"></i> Novità d\'autunno 2021 di Quoto! 
                                            </a>
                                        </li>-->
                                <!--         <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Configurazione 3" data-idvideo="UmXO22FoPFc">
                                                <i class="fa fa-youtube-play info text-red"></i> Configurazione &nbsp;<small class="label bg-green">3°</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Configurazione 4" data-idvideo="dsgSPEgLTQQ">
                                                <i class="fa fa-youtube-play info text-red"></i> Configurazione &nbsp;<small class="label bg-teal">4°</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Configurazione 5" data-idvideo="p7x-wu79WgQ">
                                                <i class="fa fa-youtube-play info text-red"></i> Configurazione &nbsp;<small class="label bg-fuchsia">5°</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Contenuti & Template" data-idvideo="ASDxfYFjetM">
                                                <i class="fa fa-youtube-play info text-red"></i> Contenuti & Template &nbsp;<small class="label bg-blue">6°</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Uso di QUOTO Giornaliero 1" data-idvideo="gZKgEUAOsO4">
                                                <i class="fa fa-youtube-play info text-red"></i> Uso di QUOTO Giornaliero <b>1°</b> video
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Uso di QUOTO Giornaliero 2" data-idvideo="B9nTIBaNyFk">
                                                <i class="fa fa-youtube-play info text-red"></i> Uso di QUOTO Giornaliero <b>2°</b> video
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Uso di QUOTO Giornaliero 3" data-idvideo="9xkiHfyrzQI">
                                                <i class="fa fa-youtube-play info text-red"></i> Uso di QUOTO Giornaliero <b>3°</b> video
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Integrazione di SimpleBooking in QUOTO!" data-idvideo="qvwsKWTU6fo">
                                                <i class="fa fa-youtube-play info text-red"></i> Integrazione con SimpleBooking
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="btn_mod link_istruzioni" data-toggle="modal" data-target="#video" data-titolo="Procedura per il Checkin Online" data-idvideo="ZZF2nJEY1Sg">
                                                <i class="fa fa-youtube-play info text-red"></i> Procedura per il Checkin Online
                                            </a>
                                        </li>  -->
                                        ';
                        $guida .='  </ul>
                        			</div>
                                </li>';

	return $guida;
	}
	
function check_conferma($primary_key){
    global $dbMysqli;

    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.idsito,
   						hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
    					hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.TipoRichiesta
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key;
    $res = $dbMysqli->query($select);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere  = '';
        $saldo           = '';
        $etichetta_saldo = '';
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        foreach ($res as $key => $value) {

			$PrezzoL            = number_format($value['PrezzoL'],2,',','.');
			$PrezzoP            = number_format($value['PrezzoP'],2,',','.');
			$IdProposta         = $value['IdProposta'];
			$PrezzoPC           = $value['PrezzoP'];
			$idsito             = $value['idsito'];
			$AccontoRichiesta   = $value['AccontoRichiesta'];
			$AccontoLibero      = $value['AccontoLibero'];
			$NomeProposta       = $value['NomeProposta'];
			$Nome               = stripslashes($value['Nome']);
			$Cognome            = stripslashes($value['Cognome']);
			$Email              = $value['Email'];
			$Arrivo_tmp         = explode("-",$value['DataArrivo']);
			$Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
			$Partenza_tmp       = explode("-",$value['DataPartenza']);
			$Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
			$AccontoPercentuale = $value['AccontoPercentuale'];
			$AccontoImporto     = $value['AccontoImporto'];
			$AccontoTesto       = stripslashes($value['AccontoTesto']);

            $start            = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end              = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
            $formato="%a";
            $Notti = dateDiff($value['DataArrivo'],$value['DataPartenza'],$formato);



            // date alternative
            $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
            $re = $dbMysqli->query($se);
            $rc = $re[0];
            if(is_array($rc)) {
                if($rc > count($rc)) 
                    $tt = count($rc); 
            }else{
                $tt = 0;
            }
            if($tt>0){
                $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                $DPartenza_tmp  = explode("-",$rc['Partenza']);
                $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                $formato="%a";
                $DNotti = dateDiff($rc['Arrivo'],$rc['Partenza'],$formato);
            }
            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $saldo   = ($PrezzoPC-$AccontoLibero);
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                if($AccontoImporto >= 1) {
                    $etichetta_caparra  = '';
                }else{
                    $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                }
                $saldo   = ($PrezzoPC-$AccontoImporto);
                $acconto = number_format($AccontoImporto,2,',','.');
            }
            if($PrezzoPC==$saldo){
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
            }else{
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
            }


            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
            $res2 = $dbMysqli->query($select2);
            $Camere = '';
            if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
                if($value['TipoRichiesta']=='Preventivo'){
                    if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                        $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$DArrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$DPartenza.' - per notti: '.$DNotti.'<br>';
                    }
                }elseif($value['TipoRichiesta']=='Conferma'){
                    if($rc['Arrivo']!= $value['DataArrivo']){
                        $Arrivo   = $DArrivo;
                    }
                    if($rc['Partenza']!= $value['DataPartenza']){
                        $Partenza   = $DPartenza;
                    }
                }
            }
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }

             $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.'<br> '.$data_alernativa.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.''.$etichetta_caparra:'').'<br>'.$etichetta_saldo.'<br>';

             $data_alernativa = '';
             $DPartenza       = '';
             $DArrivo         = '';
             $DNotti          = '';
            }
          return $sistemazione;

    }else{
        return '';
    }
}
function n_notifiche_cs($output=null){
	global $dbMysqli;

	$q = $dbMysqli->query('SELECT * FROM hospitality_customer_satisfaction  WHERE  idsito = '.IDSITO.' AND data_compilazione ="'.date('Y-m-d').'" GROUP BY id_richiesta');
	$rw = sizeof($q);
	if($rw > 0){
        if(!$output){
            return '<span class="badge badge-info pull-right" id="notify_cs">'.$rw.'</span>';
        }else{
            return $rw;
        }

	}

}

function conferma_in_arrivo($primary_key){
    global $dbMysqli;

    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.idsito,
    					hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
    					hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
                        hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
    					hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key;
    $res = $dbMysqli->query($select);

    $tot    = sizeof($res);
    if($tot > 0){
        $Camere  = '';
        foreach ($res as $key => $value) {

			$PrezzoL            = number_format($value['PrezzoL'],2,',','.');
			$PrezzoP            = number_format($value['PrezzoP'],2,',','.');
			$IdProposta         = $value['IdProposta'];
			$PrezzoPC           = $value['PrezzoP'];
			$idsito             = $value['idsito'];
			$AccontoRichiesta   = $value['AccontoRichiesta'];
			$AccontoLibero      = $value['AccontoLibero'];
			$NomeProposta       = $value['NomeProposta'];
			$Nome               = stripslashes($value['Nome']);
			$Cognome            = stripslashes($value['Cognome']);
			$Email              = $value['Email'];
			$NumeroAdulti       = $value['NumeroAdulti'];
			$NumeroBambini      = $value['NumeroBambini'];
			$EtaBambini1        = $value['EtaBambini1'];
			$EtaBambini2        = $value['EtaBambini2'];
			$EtaBambini3        = $value['EtaBambini3'];
			$EtaBambini4        = $value['EtaBambini4'];
			$EtaBambini5        = $value['EtaBambini5'];
			$EtaBambini6        = $value['EtaBambini6'];
			$Arrivo_tmp         = explode("-",$value['DataArrivo']);
			$Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
			$Partenza_tmp       = explode("-",$value['DataPartenza']);
			$Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
			$AccontoPercentuale = $value['AccontoPercentuale'];
			$AccontoImporto     = $value['AccontoImporto'];
			$AccontoTesto       = stripslashes($value['AccontoTesto']);
			$start              = strtotime($value['DataArrivo']);
			$end                = strtotime($value['DataPartenza']);
			$Notti              = ceil(abs($end - $start) / 86400);
            // date alternative
            $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
            $re = $dbMysqli->query($se);
            $rc = $re[0];
            if(is_array($rc)) {
                if($rc > count($rc)) 
                    $tt = count($rc); 
            }else{
                $tt = 0;
            }
            if($tt>0){
                $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                $DPartenza_tmp  = explode("-",$rc['Partenza']);
                $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                $DNotti         = ceil(abs($Dend - $Dstart) / 86400);
            }
            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                if($AccontoImporto >= 1) {
                    $etichetta_caparra  = '';
                }else{
                    $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                }
                $acconto = number_format($AccontoImporto,2,',','.');
            }

            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
            $res2 = $dbMysqli->query($select2);

            $Camere = '';
            if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
                if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                    $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$DArrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$DPartenza.' - per notti: '.$DNotti.'<br>';
                }
            }
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }

             $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> - '.($EtaBambini1!='' && $EtaBambini1!='0'?$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br> '.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.''.$etichetta_caparra:'').'<br>';
        }

            $sistemazione = str_replace('"',' ',$sistemazione);
            $sistemazione .= '<div style=\'float:right\'><a href=\'https://'.$_SERVER['HTTP_HOST'].'/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Print PDF</a></div><br>';

          return $sistemazione;

    }else{
        return '';
    }
}
function check_simplebooking($idsito){
	 global $dbMysqli;
	    $Qcheck = "SELECT * FROM hospitality_simplebooking WHERE idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);
        if(sizeof($Tcheck)>0){
        	$check = 1;
        }else{
        	$check = 0;
        }
    return $check;
}
function check_ericsoftbooking($idsito){
    global $dbMysqli;
       $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".$idsito."  AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
       $Tcheck = $dbMysqli->query($Qcheck);
       if(sizeof($Tcheck)>0){
           $check = 1;
       }else{
           $check = 0;
       }
   return $check;
}
function check_ericsoftpms($idsito){
    global $dbMysqli;
       $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".$idsito."  AND PMS = 1 ORDER BY Id DESC LIMIT 1";
       $Tcheck = $dbMysqli->query($Qcheck);
       if(sizeof($Tcheck)>0){
           $check = 1;
       }else{
           $check = 0;
       }
   return $check;
}
function paginazioneX($idsito){
	global $dbMysqli;
		$select = "SELECT * FROM hospitality_breadcrumb WHERE idsito = ".$idsito;
		$res    = $dbMysqli->query($select);
		$rw     = $res[0];
		$numero = $rw['numero'];
    	return $numero;
}
function gira_data($data){
	$data = explode(" ",$data);
	$data_tmp = explode("-",$data[0]);
	$new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data[1];
	return $new_data;
}
function n_checkin($output=null){
    /** @var PerformizeFunctions $fun */
    global $fun;
    return $fun->n_checkin($output);
//
//	global $dbMysqli;
//
//	$q = $dbMysqli->query('SELECT * FROM hospitality_checkin  WHERE  idsito = '.IDSITO.' AND data_compilazione >= "'.date('Y-m-d  00:00:00').'" AND data_compilazione < "'.date('Y-m-d  23:59:59').'" GROUP BY Prenotazione');
//	$rw = sizeof($q);
//	if($rw > 0){
//        if(!$output){
//            return '<label class="badge bg-orange pull-righ m-l-5" id="notify_schedine">'.$rw.'</label>';
//        }else{
//            return $rw;
//        }
//	}

}
function check_template($idsito)
{
    global $dbMysqli;

    $sel      = "SELECT * FROM hospitality_template_landing WHERE idsito = " . $idsito . "";
    $res      = $dbMysqli->query($sel);
    $record   = $res[0];
    $template = $record['Template'];

    return $template;
}
function check_landing_template($idsito, $idrichiesta = null)
{
    global $dbMysqli;

    $sel = "SELECT hospitality_template_background.TemplateName FROM hospitality_guest
				INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
				WHERE hospitality_guest.idsito = " . $idsito . " ";
    if ($idrichiesta != '') {
        $sel .= " AND hospitality_guest.Id = " . $idrichiesta;
    }else{
        $sel .= " AND hospitality_guest.TipoRichiesta = 'Preventivo' AND hospitality_guest.Accettato = 0";
    }
    $sel .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.NumeroPrenotazione DESC";

    $res          = $dbMysqli->query($sel);
    $record       = $res[0];
    $TemplateName = $record['TemplateName'];

    return $TemplateName;
}
function check_permessi()
{
    global $dbMysqli;

    $select = "SELECT * FROM utenti WHERE username = '" . $_SESSION['user_accesso'] . "' AND password = '" . ($_SESSION['pass_accesso']) . "'";
    $esec   = $dbMysqli->query($select);
    $record = sizeof($esec);

    $select2 = "SELECT * FROM utenti_quoto WHERE idsito = ".IDSITO." AND username = '" . $_SESSION['user_accesso'] . "' AND password = '" . ($_SESSION['pass_accesso']) . "'";
    $esec2   = $dbMysqli->query($select2);
    $record2 = sizeof($esec2);

    if ($record2 > 0 && $record == 0) {
        $config1           = $_SESSION['utente']['config1'];
        $config2           = $_SESSION['utente']['config2'];
        $config3           = $_SESSION['utente']['config3'];
        $config4           = $_SESSION['utente']['config4'];
        $config5           = $_SESSION['utente']['config5'];
        $config6           = $_SESSION['utente']['config6'];
        $dashborad_box     = $_SESSION['utente']['dashboard_box'];
        $statistiche       = $_SESSION['utente']['statistiche'];
        $crea_proposta     = $_SESSION['utente']['crea_proposta'];
        $preventivi        = $_SESSION['utente']['preventivi'];
        $conferme          = $_SESSION['utente']['conferme'];
        $prenotazioni      = $_SESSION['utente']['prenotazioni'];
        $profila           = $_SESSION['utente']['profila'];
        $giudizi           = $_SESSION['utente']['giudizi'];
        $archivio          = $_SESSION['utente']['archivio'];
        $schedine          = $_SESSION['utente']['schedine'];
        $content_email     = $_SESSION['utente']['content_email'];
        $content_landing   = $_SESSION['utente']['content_landing'];
        $anteprima_email   = $_SESSION['utente']['anteprima_email'];
        $anteprima_landing = $_SESSION['utente']['anteprima_landing'];
        $screenshots       = $_SESSION['utente']['screenshots'];
        $comunicazioni     = $_SESSION['utente']['comunicazioni'];
        $utenti            = $_SESSION['utente']['utenti'];
        $unique_display    = $_SESSION['utente']['unique_display'];
    }
    if ($record > 0 && $record2 == 0) {
        $config1           = 1;
        $config2           = 1;
        $config3           = 1;
        $config4           = 1;
        $config5           = 1;
        $config6           = 1;
        $dashborad_box     = 1;
        $statistiche       = 1;
        $crea_proposta     = 1;
        $preventivi        = 1;
        $conferme          = 1;
        $prenotazioni      = 1;
        $profila           = 1;
        $giudizi           = 1;
        $archivio          = 1;
        $schedine          = 1;
        $content_email     = 1;
        $content_landing   = 1;
        $anteprima_email   = 1;
        $anteprima_landing = 1;
        $screenshots       = 1;
        $comunicazioni     = 1;
        $utenti            = 1;
        $unique_display    = 0;
    }
    $array_permessi = array('CONFIG1' => $config1,
        'CONFIG2'                         => $config2,
        'CONFIG3'                         => $config3,
        'CONFIG4'                         => $config4,
        'CONFIG5'                         => $config5,
        'CONFIG6'                         => $config6,
        'DASH'                            => $dashborad_box,
        'STAT'                            => $statistiche,
        'PROP'                            => $crea_proposta,
        'PREV'                            => $preventivi,
        'CONF'                            => $conferme,
        'PRENO'                           => $prenotazioni,
        'PROF'                            => $profila,
        'GIUD'                            => $giudizi,
        'ARCH'                            => $archivio,
        'SCHED'                           => $schedine,
        'CONT_MAIL'                       => $content_email,
        'CONT_LAND'                       => $content_landing,
        'ANT_MAIL'                        => $anteprima_email,
        'ANT_LAND'                        => $anteprima_landing,
        'SCREEN'                          => $screenshots,
        'COMUNIC'                         => $comunicazioni,
        'UTENTI'                          => $utenti,
        'UNIQUE'                          => $unique_display,
    );
    return $array_permessi;
}
function PasswordCasuale($lunghezza = 8)
{
    $caratteri_disponibili = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password              = "";
    for ($i = 0; $i < $lunghezza; $i++) {
        $password = $password . substr($caratteri_disponibili, rand(0, strlen($caratteri_disponibili) - 1), 1);
    }
    return $password;
}
function verifyEmail($email){

    if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)){

        $domain = explode("@", $email); 

        if (checkdnsrr($domain[1], "MX")){

            $result = 'valid';

        }else{

            $result   = "invalid";
        }

    }else{

        $result   = "invalid";
    }

    return $result;
}

function check_consenso_gdpr($idutente,$idsito){
     global $dbMysqli;
        $s   = 'SELECT * FROM consensi_gdpr_utenti WHERE idutente = '.$idutente.' AND idsito = '.$idsito.' AND software = "Quoto"';
        $r   = $dbMysqli->query($s);
        $rSW = $r[0];
        if(is_array($rSW)) {
            if($rSW > count($rSW))
             $check = $rSW;
        }else{
            $check = 0;
        }
          if($check==0){

                $se = 'SELECT testo_consenso_gdpr_quoto FROM consenso_gdpr WHERE 1 = 1 LIMIT 1';
                $re = $dbMysqli->query($se);
                $rs = $re[0];


                    $ModaleConsenso .= '<script type="text/javascript">
                                        $(document).ready(function(){
                                            $(\'#consenso_gdpr\').modal(\'show\');
                                        });
                                    </script>'."\r\n";
                    $ModaleConsenso .='<div class="modal fade" id="consenso_gdpr"  aria-labelledby="consenso_gdpr">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <a class="close" data-dismiss="modal">×</a>
                                                    <h4 class="modal-title"><b>Consenso GDPR</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    '.$rs['testo_consenso_gdpr_quoto'].'<br>
                                                    <div class="text-center">
                                                    <style>.btn-check { color: #444;border-color: transparent;background-color:transparent;</style>
                                                        <button type="button" id="gdpr" class="btn-check"><i class="fa fa-check-circle-o fa-2x fa-fw" id="flag_gdpr"></i> Ho Capito ed Accetto!</button>';
                                    $ModaleConsenso .= '<script type="text/javascript">
                                                            $(document).ready(function(){
                                                                $(\'#gdpr\').click(function(){
                                                                    $.ajax({
                                                                          url: "/ajax/consenso_gdpr.php",
                                                                          type: "POST",
                                                                          data: "idutente='.$idutente.'&idsito='.$idsito.'&checkbox_value=1&ip='.base64_encode($_SERVER['REMOTE_ADDR']).'&agent='.base64_encode($_SERVER['HTTP_USER_AGENT']).'",
                                                                          dataType: "html",
                                                                          success: function(data) {
                                                                             $(\'#consenso_gdpr\').modal(\'hide\');
                                                                          }
                                                                      });
                                                                      return false; // con false senza refresh della pagina
                                                                });
                                                            });
                                                        </script>'."\r\n";
                    $ModaleConsenso .= '            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>'."\r\n";
          }
         return $ModaleConsenso;
}
function differenza_date ($data_iniziale,$data_finale,$unita) {

 $data1 = strtotime($data_iniziale);
 $data2 = strtotime($data_finale);

    switch($unita) {
        case "i": $unita = 1/60; break;     //MINUTI
        case "h": $unita = 1; break;        //ORE
        case "g": $unita = 24; break;       //GIORNI
        case "a": $unita = 8760; break;         //ANNI
    }

 $differenza = (($data2-$data1)/3600)/$unita;
 return $differenza;
}
/**
 * [array_remove_item description]
 * @param  [type] $arr  [description]
 * @param  [type] $item [description]
 * @return [type]       [description]
 */
function array_remove_item($arr,$item)
{
  // verifico che il valore sia compreso nell'array
  if(in_array($item,$arr))
  {
    // rimuovo il valore passando ad unset la chiave dell'item
    // recuperata usando array_search
    unset($arr[array_search($item,$arr)]);
    // restituisco l'array dopo averla re-indicizzata
    return array_values($arr);
  }else{
    // se non trovo corrispondenze restituisco l'array così com'è
   return $arr;
  }
}

function InformativaPrivacy()
{
    global $dbMysqli;
    $sql_dati = 'SELECT
                        *,
                        siti.nome as nome_sito
                    FROM
                        siti
                        LEFT JOIN utenti on utenti.idsito = siti.idsito
                        LEFT JOIN anagrafica on anagrafica.idanagra = utenti.idanagra
                        LEFT JOIN comuni on comuni.codice_comune = siti.codice_comune
                        LEFT JOIN province on province.codice_provincia = siti.codice_provincia
                    WHERE
                        siti.idsito = ' . $_SESSION['IDSITO'] . '
                    LIMIT 1';

    $dati_ = $dbMysqli->query($sql_dati);
    $dati  = $dati_[0];

    $dati['citta']     = $dati['nome_comune'];
    $dati['provincia'] = $dati['sigla_provincia'];
    $informativa       = INFORMATIVA_PRIVACY;
    foreach ($dati as $k => $v) {
        $informativa = str_replace('{!' . $k . '!}', '<b>' . $v . '</b>', $informativa);
    }
    $informativa = str_replace("[struttura]",$dati['nome_sito'], $informativa);
    return $informativa;
}

function tot_ticket_risposta($idsito,$output=null){
	global $dbMysqli;
	// calcolo ticket attivi
	$res = $dbMysqli->query("SELECT COUNT(id) as tot_ticket FROM ticket  WHERE idsito = ".$idsito." AND stato = 'Chiuso' AND letto = 0 AND idcat = ".CATEGORIA_TICKET_QUOTO);
	$rwr = $res[0];
	if($rwr['tot_ticket']>0){
        if(!$output){
            return '<label class="badge bg-red pull-right" id="notify_ticket">'.$rwr['tot_ticket'].'</label>';
        }else{
            return $rwr['tot_ticket'];
        }
	}

}

function check_pms($idsito)
{
    global $dbMysqli;
    $Tcheck = array();
    $Qcheck = "SELECT * FROM hospitality_pms WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
    $Qquery = $dbMysqli->query($Qcheck);
    $Tcheck = $Qquery[0];
    if(is_array($Tcheck)) {
        if($Tcheck > count($Tcheck)) 
         $check = $Tcheck['Pms']; 
    }else{
        $check = 0;
    }

    return $check;
}
function check_pms_bedzzle($idsito)
{
    global $dbMysqli;
    $Tcheck = array();
    $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = " . $idsito . " AND PMS = 1 ORDER BY Id DESC LIMIT 1";
    $Qquery = $dbMysqli->query($Qcheck);
    $Tcheck = $Qquery[0];
    if(is_array($Tcheck)) {
        if($Tcheck > count($Tcheck)) 
         $check = $Tcheck['PMS']; 
    }else{
        $check = 0;
    }

    return $check;
}
function check_bedzzlePMS($idsito){
    global $db;
       $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".$idsito."  AND PMS = 1 ORDER BY Id DESC LIMIT 1";
       $Qquery = $dbMysqli->query($Qcheck);
       if(sizeof($Qquery)>0){
           $check = 1;
       }else{
           $check = 0;
       }
   return $check;
}
function check_camere_pms($idsito){
    global $dbMysqli;
    $select = "SELECT * FROM hospitality_pms_camere WHERE idsito = " . $idsito;
    $res = $dbMysqli->query($select);
    $check_type = sizeof($res);
    if ($check_type > 0) {
        $check = 1;
    } else {
        $check = 0;
    }
    return $check;
}
function check_soggiorni_pms($idsito){
    global $dbMysqli;
    $select = "SELECT * FROM hospitality_pms_trattamenti WHERE idsito = " . $idsito;
    $res = $dbMysqli->query($select);
    $check_type = sizeof($res);
    if ($check_type > 0) {
        $check = 1;
    } else {
        $check = 0;
    }
    return $check;
}
function check_person_pms($idsito){
    global $dbMysqli;
    $select = "SELECT * FROM hospitality_pms_person WHERE idsito = " . $idsito;
    $res = $dbMysqli->query($select);
    $check_type = sizeof($res);
    if ($check_type > 0) {
        $check = 1;
    } else {
        $check = 0;
    }
    return $check;
}
function ico_operatore($idsito,$username){
    global $dbMysqli;
    $nome = '';

    $res = $dbMysqli->query("SELECT Sesso,nome FROM utenti_quoto WHERE idsito = ".$idsito." AND username = '".addslashes($username)."' AND abilitato = 1");
    if(sizeof($res)>0){

        $r  = $res[0];

        if($r['Sesso']=='Male'){

            $ICOUSER = 'avatar5.png';

        }elseif($r['Sesso']=='Female'){

            $ICOUSER = 'avatar3.png';
        }
        if($r['Sesso']==''){

            $ICOUSER = 'avatar5.png';
        }
        $nome = $r['nome'];
    }else{
        $ICOUSER = 'avatar5.png';
        $nome = '';
    }
    return $ICOUSER.'#'.$nome ;
}
function colorGen() {

    $caratteri_disponibili ="abcdef1234567890";
    $colore = "";
    for($i = 0; $i<6; $i++){
        $colore .= substr($caratteri_disponibili,rand(0,strlen($caratteri_disponibili)-1),1);
    }
    return '#'.$colore;
}
function notifica_mancata_click($idsito,$TipoRichiesta)
{
    global $dbMysqli;

        $query       = "SELECT
                            Id,
                            DataRichiesta,
                            DataInvio,
                            DataScadenza,
                            NumeroPrenotazione,
                            Nome,
                            Cognome
                        FROM
                            hospitality_guest
                        WHERE
                            TipoRichiesta = '".$TipoRichiesta."'
                        AND
                            idsito = ".$idsito."
                        AND
                            DataInvio IS NOT NULL
                        AND
                            DataInvio < '".date('Y-m-d')."'
                        AND
                            DataScadenza > '".date('Y-m-d')."'";

        $array_fetch = $dbMysqli->query($query);

        if(sizeof($array_fetch)>0){

            $loadercolor     = '';
            $aperture        = '';
            $testo           = '';
            $aperture_exists = array();

            if($TipoRichiesta=='Preventivo'){
                (sizeof($array_fetch)==1?$tipo = 'per il preventivo':$tipo = 'per i preventivi');
                $loadercolor     = "#000000";
            }else{
                (sizeof($array_fetch)==1?$tipo = 'per la conferma':$tipo = 'per le conferme');
                $loadercolor     = "#000000";
            }
            foreach($array_fetch as $key => $row){

                $qry = "SELECT COUNT(Id) as Click FROM hospitality_traccia_email WHERE IdRichiesta = ".$row['Id']." AND Idsito = ".$idsito;
                $ris   = $dbMysqli->query($qry);
                $rw    = $ris[0];
                if($row['DataRichiesta']>=$_SESSION['DATA_DOWGRADE_SHORTURL']){
                    $aperture = $rw['Click'];
                }else{
                    $aperture = ($rw['Click']>0?$rw['Click']-1:$rw['Click']);
                }

                $aperture_exists[] = $aperture;

                if($aperture == 0 && $row['DataInvio'] != '' && $row['DataInvio'] < date('Y-m-d') && $row['DataScadenza'] > date('Y-m-d')){
                    $testo .= 'N. <b>'.$row['NumeroPrenotazione'].'</b> per <em>'.$row['Nome'].' '.$row['Cognome'].'</em><br>';
                }
            }
             if(in_array(0,$aperture_exists)){
                $script = ' <script>
                                $( document ).ready(function() {
                                    setTimeout(function(){
                                        open_notifica("Sono passate più di <b>24 ore</b><br>dall\'invio dell\'email<br>'.$tipo.':","'.$testo.'","plain","bottom-right","error",10000,"'.$loadercolor.'");
                                    }, 4950);
                                });
                            </script>'."\r\n";
            }
        }else{
            $script = '';
        }

    return $script;
}
function check_configurazioni($idsito,$parametro){
    global $dbMysqli;
    $config = "SELECT valore FROM hospitality_configurazioni WHERE idsito = ".$idsito." AND parametro = '".$parametro."'";
    $res_config = $dbMysqli->query($config);
    $rec_config = $res_config[0];

    if($parametro =='select_tipo_camere'){

        if($rec_config['valore'] == '1'){
            $check = 'chosen-select ';
          }else{
            $check = '';
          }

    }else{

        if($rec_config['valore'] == '1'){
            $check = 1;
        }else{
            $check = 0;
        }

    }

    return $check;
}
function count_iscritti($idsito,$id_lista=null){
    global $dbMysqli;
    $query_gen       = "SELECT COUNT(id) as totale FROM mailing_newsletter WHERE idsito = ".$idsito." ".($id_lista!=''?' AND id_lista = '.$id_lista:'')." AND attivo = 1";
    $risult          = $dbMysqli->query($query_gen);
    $record          = $risult[0];
    $numero_iscritti = $record['totale'];

    return $numero_iscritti;

}
function count_iscritti_marketing($idsito,$id_lista=null){
    global $dbMysqli;
    $query_gen       = "SELECT COUNT(id) as totale FROM mailing_newsletter WHERE idsito = ".$idsito." ".($id_lista!=''?' AND id_lista = '.$id_lista:'')." AND attivo = 1 AND CheckConsensoMarketing = 1";
    $risult          = $dbMysqli->query($query_gen);
    $record          = $risult[0];
    $numero          = intval($record['totale']);

    return $numero;

}
function count_template($idsito){
    global $dbMysqli;
    $query_gen       = "SELECT COUNT(id) as totale FROM mailing_newsletter_template WHERE idsito = ".$idsito."";
    $risult          = $dbMysqli->query($query_gen);
    $record          = $risult[0];
    $numero_template = $record['totale'];

    return $numero_template;

}


function count_richieste($nome,$cognome,$email,$tipo,$chiuso=null){
    global $dbMysqli;

    $sel = 'SELECT COUNT(Id) as numero FROM hospitality_guest WHERE idsito = '.IDSITO.' AND Nome = "'.$nome.'" AND Cognome = "'.$cognome.'" AND Email = "'.$email.'" AND TipoRichiesta = "'.$tipo.'" '.($chiuso!=''?'AND Chiuso = '.$chiuso:'');
    $res = $dbMysqli->query($sel);
    $rec = $res[0];

    return $rec['numero'];
}

function fatturato($nome,$cognome,$email,$numerico=null){
    global $dbMysqli;

    $fatturato = '';

    $s = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
            FROM hospitality_guest
            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
            WHERE 1=1
            AND hospitality_guest.Nome = '".addslashes($nome)."'
            AND Cognome = '".addslashes($cognome)."'
            AND Email = '".$email."'
            AND hospitality_guest.idsito = ".IDSITO."
            AND hospitality_guest.NoDisponibilita = 0
            AND hospitality_guest.Hidden = 0
            AND hospitality_guest.Disdetta = 0
            AND hospitality_guest.TipoRichiesta = 'Conferma' ";
    $r = $dbMysqli->query($s);
    $rw = $r[0];

    $fatturato = number_format($rw['fatturato'],2,',','.');
    $fatturato_no_format = $rw['fatturato'];

    if($numerico){
        $fatt = $fatturato_no_format;
    }else{
        if($fatturato != '0,00' &&  $fatturato != ''){
            $fatt = '<label class="badge bg-green"><i class="fa fa-euro"></i> '.$fatturato .'</label>';

        }else{
            $fatt = '<label class="badge"><i class="fa fa-euro"></i> '.$fatturato .'</label>';
        }
    }
    return $fatt;
}
function func_stars($value){

    switch($value){
        case 1:
            $ico = '<div align="center"><img src="'.BASE_URL_SITO.'img/emoji/bad.jpg" data-toogle="tooltip" title="Bad [valore = 1]"></div>';
        break;
        case 2:
            $ico = '<div align="center"><img src="'.BASE_URL_SITO.'img/emoji/semi_bad.jpg" data-toogle="tooltip" title="Semi Bad [valore = 2]"></div>';
        break;
        case 3:
            $ico = '<div align="center"><img src="'.BASE_URL_SITO.'img/emoji/medium.jpg" data-toogle="tooltip" title="Medium [valore = 3]"></div>';
        break;
        case 4:
            $ico = '<div align="center"><img src="'.BASE_URL_SITO.'img/emoji/semi_good.jpg" data-toogle="tooltip" title="Semi Good [valore = 4]"></div>';
        break;
        case 5:
            $ico = '<div align="center"><img src="'.BASE_URL_SITO.'img/emoji/good.jpg" data-toogle="tooltip" title="Good [valore = 5]"></div>';
        break;
    }

    return $ico;


}
function func_menu_facebook($idsito){
  global $dbMysqli;
  $sql = "SELECT NumeroPrenotazione
                      FROM hospitality_fonti_provenienza
                      WHERE 1 = 1
                      AND (hospitality_fonti_provenienza.Provenienza LIKE '%facebook%'  OR hospitality_fonti_provenienza.Timeline LIKE '%facebook%')
                      AND (hospitality_fonti_provenienza.Provenienza LIKE '%utm_campaign%' OR hospitality_fonti_provenienza.Timeline LIKE '%utm_campaign%')
                      AND hospitality_fonti_provenienza.idsito = ".$idsito;
  $variable = $dbMysqli->query($sql);

  if(sizeof($variable)>0){
    $array_NumPreno = array();
    foreach ($variable as $key => $value) {
      $array_NumPreno[] = $value['NumeroPrenotazione'];
    }
    $NumeroPreno = implode(',',$array_NumPreno);
    $select = "SELECT COUNT(hospitality_guest.Id) as num_camp_f
                        FROM hospitality_guest
                        WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeroPreno.")
                        AND hospitality_guest.FontePrenotazione = 'Sito Web'
                        AND hospitality_guest.Chiuso = 1
                        AND (hospitality_guest.DataChiuso != '' OR hospitality_guest.DataChiuso IS NOT NULL)
                        AND hospitality_guest.Disdetta = 0
                        AND hospitality_guest.Hidden = 0
                        AND hospitality_guest.TipoRichiesta = 'Conferma'";
    $res = $dbMysqli->query($select);
    $rws = $res[0];
    if(is_array($rws)) {
        if($rws > count($rws)) 
            $tot = count($rws); 
    }else{
        $tot = 0;
    }
    if($tot>0){
      $check_social = $rws['num_camp_f'];
      if($check_social > 0){

            $menu .=  '<li class="'.$GLOBALS['ActiveMenu']['grafici'].'">
                            <a href="'.BASE_URL_SITO.'grafici-facebook/">
                                <i class="fa fa-facebook"></i> <span>Campagne FaceBook Ads</span>
                            </a>
                        </li>';
      }else{
         $menu = '';
      }
    }
  }
  return $menu;
}
function func_menu_ppc($idsito){
  global $dbMysqli;
  $sql = "SELECT NumeroPrenotazione
                      FROM hospitality_fonti_provenienza
                      WHERE 1 = 1
                      AND (hospitality_fonti_provenienza.Provenienza LIKE '%gclid%'  OR hospitality_fonti_provenienza.Timeline LIKE '%gclid%')
                      AND hospitality_fonti_provenienza.idsito = ".$idsito;
  $variable = $dbMysqli->query($sql);

  if(sizeof($variable)>0){
    $array_NumPreno = array();
    foreach ($variable as $key => $value) {
      $array_NumPreno[] = $value['NumeroPrenotazione'];
    }
    $NumeroPreno = implode(',',$array_NumPreno);
    $select = "SELECT COUNT(hospitality_guest.Id) as num_camp_p
                        FROM hospitality_guest
                        WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeroPreno.")
                        AND hospitality_guest.FontePrenotazione = 'Sito Web'
                        AND hospitality_guest.Chiuso = 1
                        AND (hospitality_guest.DataChiuso != '' OR hospitality_guest.DataChiuso IS NOT NULL)
                        AND hospitality_guest.Disdetta = 0
                        AND hospitality_guest.Hidden = 0
                        AND hospitality_guest.TipoRichiesta = 'Conferma'";
    $res = $dbMysqli->query($select);
    $rws = $res[0];
    if(is_array($rws)) {
        if($rws > count($rws)) 
            $tot = count($rws); 
    }else{
        $tot = 0;
    }
    if($tot>0){
      $check_ppc = $rws['num_camp_p'];
      if($check_ppc > 0){

            $menu .=  '<li class="'.$GLOBALS['ActiveMenu']['grafici'].'">
                             <a href="'.BASE_URL_SITO.'grafici-ppc/">
                                <i class="fa fa-google"></i> <span>Campagne Google Ads</span>
                            </a>
                        </li>';
      }else{
         $menu = '';
      }
    }
  }
  return $menu;
}
function func_check_accessi($idsito){
  global $dbMysqli;

  $select = "SELECT * FROM utenti_quoto WHERE utenti_quoto.idsito = ".$idsito." AND utenti_quoto.utenti = 0 AND utenti_quoto.abilitato = 1";
  $record = $dbMysqli->query($select);
  $check_user = sizeof($record);
  if($check_user > 0){
    $check = 1;
  }else{
    $check = 0;
  }

 return $check;

}
function check_parity($idsito)
{
    global $dbMysqli;
    $Tcheck = array();
    $check  = '';
    $Qcheck = "SELECT * FROM hospitality_parityrate WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
    $Qquery = $dbMysqli->query($Qcheck);
    $Tcheck = sizeof($Qquery);
    if ($Tcheck > 0) {
        $check = 1;
    } else {
        $check = 0;
    }

    return $check;
}
function check_camere_parity($idsito){
    global $dbMysqli;
    $select = "SELECT * FROM hospitality_parity_camere WHERE idsito = " . $idsito;
    $res = $dbMysqli->query($select);
    $check_type = sizeof($res);
    if ($check_type > 0) {
        $check = 1;
    } else {
        $check = 0;
    }
    return $check;
}
function check_soggiorni_parity($idsito){
    global $dbMysqli;
    $select = "SELECT * FROM hospitality_parity_trattamenti WHERE idsito = " . $idsito;
    $res = $dbMysqli->query($select);
    $check_type = sizeof($res);
    if ($check_type > 0) {
        $check = 1;
    } else {
        $check = 0;
    }
    return $check;
}
function check_listino_parity($idsito){
    global $dbMysqli;
    $select = "SELECT * FROM hospitality_numero_listini WHERE idsito = " . $idsito." AND Listino LIKE '%ParityRate%' AND Parity = 1 AND Abilitato = 1";
    $res = $dbMysqli->query($select);
    $check_type = sizeof($res);
    if ($check_type > 0) {
        $check = 1;
    } else {
        $check = 0;
    }
    return $check;
}
function check_data_syncro_listino_parity($idsito){
    global $dbMysqli;
    $s = "SELECT data FROM hospitality_data_syncro_listino_parity WHERE idsito = ".$idsito."  ORDER BY id DESC";
    $r = $dbMysqli->query($s);
    $tot = sizeof($r);

    if($tot >0){

        $w = $r[0];

        $parity = check_parity($idsito);
        if($parity == 1){
        $output = '<div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <div class="alert alert-info">
                            <i class="fa fa-exclamation-circle text-white fa-2x fa-fw" aria-hidden="true"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <b>SINCRO PARITY RATE:</b>
                            <ul>
                                <li>Ultima Data sincronizzazione listino: <b>'.gira_data($w['data']).'</b></li>
                                <li>LEGENDA CRON DI SINCRONIZZAZIONE:
                                    <ul>
                                        <li>Il controllo per la sincronizzazione <b>passa ogni ORA di tutti i giorni al 15esimo minuto</b>!</li>
                                        <li>La richiesta di sincronizzazione prezzi ha le date impostate che vanno dalla <b>data odierna</b> (oggi) alla <b>data di scadenza</b> del vostro contratto QUOTO!</li>
                                        <li>Se la scansione nota che non ci sono righe presenti nel listino compie una operazione di <b>inserimento</b>, altrimenti se sono presenti ne compie la <b>modifica</b>!</li>
                                    </ul>
                            </li>
                            </ul>
                        </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>';
            }else{
                $output = '';
            }
    }else{
      $output = '';
    }
    return $output;
  }

function syncro_preno_parity($idsito){
    global $dbMysqli;
    
    $qry  = "SELECT * FROM hospitality_parityrate  WHERE idsito = ".$idsito." AND Abilitato = 1 LIMIT 1";
    $sq   = $dbMysqli->query($qry);
    $tot = sizeof($sq);

      if($tot>0){

        $imap = $sq[0];

            $ParityButton .= '
                                <div id="parity"><div  class="text-right"><a href="#" class="btn bg-info btn-xs" id="CheckBtnParity"><img src="https://'.$_SERVER["HTTP_HOST"].'/img/logoRC.png" style="width:20px;height:9px"/> Syncro con ParityRate</a></div>
                                    <div id="pul_parity_hide"></div>
                                    <script>
                                    $(document).ready(function() {
                                        if(leggiCookie(\'syncro_parity'.$idsito.'\')) {
                                            $("#CheckBtnParity").css(\'display\',\'none\');
                                            $("#pul_parity_hide").html(\'<div class="row"><div class="col-md-2"></div><div class="col-md-8"><div class="alert alert-info"><div class="text-center"><small class="text-left"> <b>Una volta cliccato su "<img src="https://'.$_SERVER["HTTP_HOST"].'/img/logoRC.png" style="width:20px;height:9px"/> Syncro con ParityRate",  il pulsante  scompare! Ogni 15 min  il Channel Manager sincronizzerà le prenotazioni.<br> Una volta sincronizzate dopo qualche minuto il pulsante tornerà visibile, se non dovesse accadere automaticamente potete usufruire della funzione manualmente cliccando qui sotto!</b></small></div></div><div class="col-md-2"></div></div>\');
                                            $("#check_pul").html(\'<div class="text-center text-info"><span style="cursor:pointer">CLICCA QUI <i class="fa fa-refresh"></i> per controllare se puoi ri-sincronizzare</span></div><br><br>\');
                                        }else{
                                            $("#pul_parity_hide").hide();
                                            $("#check_pul").hide();
                                        }
                                        $(\'#CheckBtnParity\').click(function(){
                                                scriviCookie(\'syncro_parity'.$idsito.'\',\'parityrate\',\'3\');
                                                $("#CheckBtnParity").css(\'display\',\'none\');
                                                $("#ctrl_parity").html(\'<div class="text-right"><img src="'.BASE_URL_SITO.'img/loader.gif" style="max-width:100%;"/></div>\');
                                                var idsito   = '.$idsito.';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "'.BASE_URL_SITO.'soap/syncro_preno_parity.php",
                                                    data: "idsito=" + idsito,
                                                    dataType: "html",
                                                    success: function(data){
                                                        $("#ctrl_parity").html(\'<div class="text-right"><small class="text-info"><b>Sincronizzazione effettuata!!</b></small></div>\');
                                                            setTimeout(function(){
                                                                    location.reload();
                                                            },2000);
                                                    },
                                                     error: function(){
                                                         alert("Chiamata fallita, si prega di riprovare...");
                                                    }
                                                });
                                        });
                                    });
                                    </script>
                                    <div id="ctrl_parity"></div>
                                    </div>
                                    <div id="check_pul"></div>';
               
                $ParityButton .= '  <script>
                                        $(document).ready(function() {
                                            
                                            $("#check_pul").on("click",function(){

                                                var minute_now = new Date().getMinutes(); 
                                                console.log(minute_now);

                                                if(minute_now >= "0" && minute_now < "1"){
                                                    var check_controll_click = false;
                                                }else if(minute_now >= "15" && minute_now < "16"){
                                                    var check_controll_click = false;
                                                }else if(minute_now >= "30" && minute_now < "31"){
                                                    var check_controll_click = false;
                                                }else if(minute_now >= "45" && minute_now < "46"){
                                                    var check_controll_click = false;
                                                }else{
                                                    var check_controll_click = true;
                                                }

                                                if(check_controll_click == true){
                                                    if(leggiCookie(\'syncro_parity'.$idsito.'\')) {
                                                        console.log("il cookie esiste ancora!");
                                                        alert("Tempo ancora utile a ParityRate per la sincronizzazione!");
                                                    }else{
                                                        location.reload();
                                                    }
                                                }else{
                                                    console.log("Orario utile a RoomCloud per la chiamata, riprovare tra qualche istante!");
                                                    alert("Orario ancora utile a ParityRate per la sincronizzazione delle prenotazione, riprovare tra qualche istante!");
                                                }
                                            });
                                        });
                                    </script>';
           
        }
        return $ParityButton;
}
function popola_status_parity($idsito,$NumeroPrenotazione,$status){
    global $dbMysqli;

    $qry  = "SELECT * FROM hospitality_parityrate  WHERE idsito = ".$idsito." AND Abilitato = 1 LIMIT 1";
    $sq   = $dbMysqli->query($qry);
    $tot  = sizeof($sq);

    if($tot>0){
            $update = "UPDATE hospitality_guest SET AzioneParity = '".$status."' WHERE NumeroPrenotazione = ".$NumeroPrenotazione." AND idsito = ".$idsito; 
            $dbMysqli->query($update);    
    }

}
function syncro_button_form_sito(){

    $ButtonSincroSito = '<a href="#" class="btn btn-success btn-xs" id="CheckBtnSito">Syncro Form Richieste</a>
                            <div id="pul_hide_sito"></div>
                            <script>
                            $(document).ready(function() {
                                
                                var check_controll_click = true;

                                if(leggiCookie(\'syncro_form'.IDSITO.'\')) {
                                $("#CheckBtnSito").css(\'display\',\'none\');
                                $("#pul_hide_sito").html(\'<span class="text-info"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un 5 minuti!</b></span>\');
                                }else{
                                    $("#pul_hide_sito").hide();
                                }
                                $(\'#CheckBtnSito\').click(function(){

                                        /**
                                         CONTROLLO SUL DECIMO E DODICESIMO MINUTO UTILE AL CRON PER ESECUZIONE, 
                                        QUINDI NON LACIA IL PULSANTE MANUALE PER NON SOVRAPPORSI
                                        */
                                        var minute_now = new Date().getMinutes(); 
                                        console.log(minute_now);

                                        if(minute_now >= "10" && minute_now < "12"){
                                            var check_controll_click = false;
                                        }else{
                                            var check_controll_click = true;
                                        }

                                        if(check_controll_click == true){
                                            if(leggiCookie(\'syncro_form'.IDSITO.'\')) {
                                                console.log("il cookie esiste ancora!");
                                                alert("Tempo ancora utile alla sincronizzazione automatica delle email, riprova tra qualche istante per non sovrapporre le procedure!");
                                                return false;
                                            }else{
                                                location.reload();
                                            }
                                        }else{
                                            console.log("Tempo ancora utile alla sincronizzazione automatica delle email, riprova tra qualche istante per non sovrapporre le procedure!");
                                            alert("Tempo ancora utile alla sincronizzazione automatica delle email, riprova tra qualche istante per non sovrapporre le procedure!");
                                            return false;
                                        }
                                        /** FINE CONTROLLO */

                                        scriviCookie(\'syncro_form'.IDSITO.'\',\'Suiteweb\',\'5\');
                                        $("#CheckBtnSito").css(\'display\',\'none\');
                                        $("#ctrlSito").html(\'<img src="'.BASE_URL_SITO.'img/loader.gif" style="max-width:100%;"/>\');
                                        var idsito             = '.IDSITO.';
                                        var data_attivazione   = '.DATA_ATTIVAZIONE.';
                                        $.ajax({
                                            type: "POST",
                                            url: "'.BASE_URL_SITO.'ajax/sincro_richieste.php",
                                            data: "idsito=" + idsito + "&data_attivazione=" + data_attivazione,
                                            dataType: "html",
                                            success: function(data){
                                                console.log(data);
                                                $("#ctrlSito").html(\'<span class="text-info"><b>Sincronizzazione email effettuata!!</b></span>\');
                                                    setTimeout(function(){
                                                            location.reload();
                                                    },2000);
                                            },
                                            // error: function(){
                                            //     alert("Chiamata fallita, si prega di riprovare...");
                                            // }
                                        });
                                });
                            });
                            </script>
                            <div id="ctrlSito"></div>';

return $ButtonSincroSito;
}
function dateDiff($data1,$data2,$formato) {
    $datetime1 = new DateTime($data1);
    $datetime2 = new DateTime($data2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format($formato);
}
function n_campagne_arrivate($idsito,$tracking,$campagna){
    global $dbMysqli;

    $clean_campagna = '';

	$q = $dbMysqli->query("SELECT COUNT(Id) as n_preventivi FROM hospitality_tracking_ads  WHERE  hospitality_tracking_ads.idsito = ".$idsito." AND hospitality_tracking_ads.Tracking = '".$tracking."' AND hospitality_tracking_ads.Campagna = '".$campagna."'");
	$rw = $q[0];

    $clean_campagna = str_replace('_',' ',$campagna);
    $clean_campagna = str_replace('-',' ',$campagna);

    return $rw['n_preventivi'];
   

}
function n_campagne_chiuse($idsito,$tracking,$campagna){
    global $dbMysqli,$filter_query;

    $clean_campagna = '';

	$q = "SELECT COUNT(hospitality_guest.Id) as n_preventivi 
            FROM hospitality_tracking_ads 
            RIGHT JOIN hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_tracking_ads.NumeroPrenotazione
            WHERE  hospitality_tracking_ads.idsito = ".$idsito." 
            AND hospitality_tracking_ads.Tracking = '".$tracking."' 
            AND hospitality_tracking_ads.Campagna = '".$campagna."'
            AND hospitality_guest.idsito = ".$idsito." 
            ".$filter_query." 
            AND hospitality_guest.FontePrenotazione = 'Sito Web'

            AND hospitality_guest.Disdetta = 0
            AND hospitality_guest.Hidden = 0
            AND hospitality_guest.TipoRichiesta = 'Conferma'";
    $r  = $dbMysqli->query($q);
	$rw = $r[0];

    $clean_campagna = str_replace('_',' ',$campagna);
    $clean_campagna = str_replace('-',' ',$campagna);



    return $rw['n_preventivi'];;
    
    
}
function numero_campagne_da_($idsito,$tracking,$campagna,$DaDove){
    global $dbMysqli,$filter_query_r;

    $dove      = '';
    $clean_campagna = '';

    $q = "SELECT COUNT(hospitality_tracking_ads.Id) as n_preventivi FROM hospitality_tracking_ads
            INNER JOIN hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_tracking_ads.NumeroPrenotazione
            WHERE  hospitality_tracking_ads.idsito = ".$idsito." 
            ".$filter_query_r."
            AND hospitality_tracking_ads.Tracking = '".$tracking."' 
            AND hospitality_tracking_ads.Campagna = '".$campagna."' ";
            if($DaDove=='landing'){
                $dove = 'Landing';
                $q .= " AND (hospitality_tracking_ads.Url NOT LIKE '%.php%' 
                            OR hospitality_tracking_ads.Url = '')";
            }else{
                $dove = 'Sito Web';
                $q .= " AND (hospitality_tracking_ads.Url  LIKE '%.php%' 
                             OR hospitality_tracking_ads.Url = '')";
            } 

    $r  = $dbMysqli->query($q);
    $rw = $r[0];


    return $rw['n_preventivi'];
    
    
  
}
function numero_campagne_da_landing_old($idsito,$tracking,$campagna,$DaDove){
    global $dbMysqli,$filter_query_r;

    $dove      = '';
    $clean_campagna = '';

    $q = "SELECT COUNT(hospitality_tracking_ads.Id) as n_preventivi FROM hospitality_tracking_ads
            INNER JOIN hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_tracking_ads.NumeroPrenotazione
            WHERE  hospitality_tracking_ads.idsito = ".$idsito." 
            AND hospitality_guest.idsito = ".$idsito." 
            ".$filter_query_r."
            AND hospitality_tracking_ads.Tracking = '".$tracking."' 
            AND hospitality_tracking_ads.Campagna = '".$campagna."' 
            AND hospitality_tracking_ads.Url NOT LIKE '%.php%' 
            AND hospitality_tracking_ads.Url != '/'";


    $r  = $dbMysqli->query($q);
    $rw = $r[0];


    return $rw['n_preventivi'];
    
    
  
}
function numero_campagne_da_sito_old($idsito,$tracking,$campagna,$DaDove){
    global $dbMysqli,$filter_query_r;

    $dove      = '';
    $clean_campagna = '';

    $q = "SELECT COUNT(hospitality_tracking_ads.Id) as n_preventivi FROM hospitality_tracking_ads
            INNER JOIN hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_tracking_ads.NumeroPrenotazione
            WHERE  hospitality_tracking_ads.idsito = ".$idsito." 
            AND hospitality_guest.idsito = ".$idsito." 
            ".$filter_query_r."
            AND hospitality_tracking_ads.Tracking = '".$tracking."' 
            AND hospitality_tracking_ads.Campagna = '".$campagna."'
            AND (hospitality_tracking_ads.Url  LIKE '%.php%' 
            OR hospitality_tracking_ads.Url = '/')";
     

    $r  = $dbMysqli->query($q);
    $rw = $r[0];


    return $rw['n_preventivi'];
    
    
  
}
function n_campagne_chiuse_new($idsito,$tracking,$campagna){
    global $dbMysqli,$filter_query;

	$q = "  SELECT
                     DISTINCT(hospitality_client_id.NumeroPrenotazione)
                FROM 
                    hospitality_client_id 
                INNER JOIN 
                    hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
                WHERE  
                    hospitality_client_id.idsito = ".$idsito." 
                AND
                    hospitality_custom_dimension.idsito = ".$idsito." 
                AND
                    hospitality_custom_dimension.campaign = '".$campagna."'
                AND 
                    hospitality_custom_dimension.urlpath LIKE '%res=sent%'
                GROUP BY 
                    hospitality_custom_dimension.clientid";
            
    $rw  = $dbMysqli->query($q);

    foreach($rw as $key => $value){
        $array_chiuse[] = $value['NumeroPrenotazione'];
    }
    if(sizeof($rw) > 0){
        $num_chiuse = implode(',',$array_chiuse);

        $q = "  SELECT
                    COUNT(hospitality_guest.id) as n_chiuse
                FROM 
                    hospitality_guest 
                WHERE 
                    hospitality_guest.idsito = ".$idsito." 

                    ".$filter_query."
                AND
                    hospitality_guest.NumeroPrenotazione IN (".$num_chiuse.")
                AND
                    hospitality_guest.FontePrenotazione = 'Sito Web'
                AND                     
                    hospitality_guest.NoDisponibilita = 0
                AND 
                    hospitality_guest.Disdetta = 0
                AND 
                    hospitality_guest.Hidden = 0
                AND 
                    hospitality_guest.TipoRichiesta = 'Conferma'";
            $r  = $dbMysqli->query($q);
            $rw = $r[0];
            

            $chiuse = $rw['n_chiuse'];
    }else{
        $chiuse = 0;
    }

    return $chiuse;
    
    
}

function numero_campagne_da_landing($idsito,$tracking,$campagna,$clientid){
    global $dbMysqli,$filter_query_custom_client_id;

    if($tracking == 'google'){                    
        $AND_CPC = " AND 
                        hospitality_custom_dimension.source = 'google' 
                     AND 
                        hospitality_custom_dimension.medium = 'cpc' ";
    }
    if($tracking == 'facebook'){                    
        $AND_CPC = " AND 
                        hospitality_custom_dimension.source = 'facebook' 
                     AND 
                        hospitality_custom_dimension.medium = 'social' ";
    }
    if($tracking == 'newsletter'){                    
        $AND_CPC = " AND 
                        (hospitality_custom_dimension.source = 'newsletter' OR hospitality_custom_dimension.source = 'sendinblue')
                     AND 
                        hospitality_custom_dimension.medium = 'email' ";
    }
    $q = "  SELECT 
                COUNT(hospitality_custom_dimension.id) as n_preventivi  
            FROM 
                hospitality_custom_dimension

            WHERE 
                hospitality_custom_dimension.idsito = ".$idsito." 

            ".$filter_query_custom_client_id."

            ".$AND_CPC."

            AND 
                hospitality_custom_dimension.campaign = '".$campagna."'
            AND 
                hospitality_custom_dimension.urlpath LIKE '%res=sent'
            AND 
                (hospitality_custom_dimension.urlpath !='/?res=sent' AND hospitality_custom_dimension.urlpath != '/' AND hospitality_custom_dimension.urlpath  != '/index.php' AND hospitality_custom_dimension.urlpath  NOT LIKE  '%.php?res=sent%' AND hospitality_custom_dimension.urlpath NOT LIKE '%.php%') 
";

    $r  = $dbMysqli->query($q);
    $tot = sizeof($r);

    if($tot>0){ 

        $rw = $r[0];

        $n_preventivi = $rw['n_preventivi'];
    }else{
        $n_preventivi = 0;
    } 



    return $n_preventivi;
    
    
  
}
function numero_campagne_da_sito($idsito,$tracking,$campagna,$clientid){
    global $dbMysqli,$filter_query_custom_client_id;

    if($tracking == 'google'){                    
        $AND_CPC = " AND 
                        hospitality_custom_dimension.source = 'google' 
                     AND 
                        hospitality_custom_dimension.medium = 'cpc' ";
    }
    if($tracking == 'facebook'){                    
        $AND_CPC = " AND 
                        hospitality_custom_dimension.source = 'facebook' 
                     AND 
                        hospitality_custom_dimension.medium = 'social' ";
    }
    if($tracking == 'newsletter'){                    
        $AND_CPC = " AND 
                        (hospitality_custom_dimension.source = 'newsletter' OR hospitality_custom_dimension.source = 'sendinblue')
                     AND 
                        hospitality_custom_dimension.medium = 'email' ";
    }
    $q = "  SELECT 
                COUNT(hospitality_custom_dimension.id) as n_preventivi
            FROM 
                hospitality_custom_dimension
            WHERE 
                hospitality_custom_dimension.idsito = ".$idsito." 

            ".$filter_query_custom_client_id."

            ".$AND_CPC."

            AND 
                hospitality_custom_dimension.campaign = '".$campagna."'
            AND 
                hospitality_custom_dimension.urlpath LIKE '%res=sent%'
            AND 
                (hospitality_custom_dimension.urlpath  = '/?res=sent' OR hospitality_custom_dimension.urlpath  = '/' OR hospitality_custom_dimension.urlpath  = '/index.php' OR hospitality_custom_dimension.urlpath LIKE '%.php%')";

    $r  = $dbMysqli->query($q);
    $tot = sizeof($r);

    if($tot>0){ 
            $rw = $r[0];
            $n_preventivi = $rw['n_preventivi'];
    }else{
        $n_preventivi = 0;
    }



    return $n_preventivi;
    
    
  
}

function numero_preventivi_inviati_per_campagna($idsito,$tracking,$campagna,$clientid){
    global $dbMysqli,$filter_query_custom_client_id;

    if($tracking == 'google'){                    
        $AND_CPC = " AND 
                        hospitality_custom_dimension.source = 'google' 
                     AND 
                        hospitality_custom_dimension.medium = 'cpc' ";
    }
    if($tracking == 'facebook'){                    
        $AND_CPC = " AND 
                        hospitality_custom_dimension.source = 'facebook' 
                     AND 
                        hospitality_custom_dimension.medium = 'social' ";
    }
    if($tracking == 'newsletter'){                    
        $AND_CPC = " AND 
                        (hospitality_custom_dimension.source = 'newsletter' OR hospitality_custom_dimension.source = 'sendinblue')
                     AND 
                        hospitality_custom_dimension.medium = 'email' ";
    }
    $q = "  SELECT 
                (hospitality_custom_dimension.id) as n_preventivi_inviati
            FROM 
                hospitality_custom_dimension
            INNER JOIN
                hospitality_client_id ON hospitality_client_id.CLIENT_ID = hospitality_custom_dimension.clientid
            INNER JOIN
                hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
            WHERE 
                hospitality_custom_dimension.idsito = ".$idsito." 

            ".$filter_query_custom_client_id."

            ".$AND_CPC."
            AND 
                hospitality_guest.idsito = ".$idsito." 
            AND 
                hospitality_client_id.idsito = ".$idsito." 
            AND 
                hospitality_guest.Inviata = 1 
            AND 
                hospitality_guest.FontePrenotazione = 'Sito Web'
            AND 
                hospitality_guest.TipoRichiesta ='Preventivo'
            AND 
                hospitality_custom_dimension.campaign = '".$campagna."'
            AND 
                hospitality_custom_dimension.urlpath LIKE '%res=sent%'
            GROUP BY
                hospitality_guest.Id ";

    $r  = $dbMysqli->query($q);
    $rw = sizeof($r);


    if($rw>0){ 
            $n_preventivi_inviati = $rw;
    }else{
        $n_preventivi_inviati = 0;
    }



    return $n_preventivi_inviati;
    
    
  
}
function fatturato_per_campagna($idsito,$campagna){
    global $dbMysqli,$filter_query;

        $sl = "SELECT 

                    hospitality_proposte.PrezzoP as fatturato
                FROM 
                    hospitality_guest
                INNER JOIN 
                    hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                INNER JOIN 
                    hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                INNER JOIN 
                    hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
                WHERE 
                    1=1
                    ".$filter_query ."
                AND 
                    hospitality_guest.idsito = ".$idsito."

                AND 
                    hospitality_guest.FontePrenotazione = 'Sito Web'
                AND 
                    hospitality_guest.Disdetta = 0
                AND 
                    hospitality_guest.NoDisponibilita = 0
                AND 
                    hospitality_guest.Hidden = 0
                AND 
                    hospitality_guest.TipoRichiesta = 'Conferma' 
                AND 
                    hospitality_client_id.idsito = ".$idsito."
                AND 
                    hospitality_custom_dimension.idsito = ".$idsito."
                AND 
                    hospitality_custom_dimension.campaign = '".$campagna."' 
                AND 
                    hospitality_custom_dimension.urlpath LIKE '%res=sent%'
                GROUP BY 
                    hospitality_guest.NumeroPrenotazione";

        $rec  = $dbMysqli->query($sl);

        if(sizeof($rec)>0){
            foreach($rec as $key => $value){
                $arraytotalePerCampagna[] = $value['fatturato'];
            }
            $output = array_sum($arraytotalePerCampagna);
        }else{
            $output = 0;
        }

    return $output;

}

function output_acconto($id){
    global $dbMysqli;

    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.idsito,
   						hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
    					hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.TipoRichiesta
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$id;
    $res = $dbMysqli->query($select);

    $tot    = sizeof($res);
    if($tot > 0){
        $Camere  = '';
        $saldo           = '';
        $etichetta_saldo = '';
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        foreach ($res as $key => $value) {

			$PrezzoL            = number_format($value['PrezzoL'],2,',','.');
			$PrezzoP            = number_format($value['PrezzoP'],2,',','.');
			$IdProposta         = $value['IdProposta'];
			$PrezzoPC           = $value['PrezzoP'];
			$idsito             = $value['idsito'];
			$AccontoRichiesta   = $value['AccontoRichiesta'];
			$AccontoLibero      = $value['AccontoLibero'];
			$AccontoPercentuale = $value['AccontoPercentuale'];
			$AccontoImporto     = $value['AccontoImporto'];
			$AccontoTesto       = stripslashes($value['AccontoTesto']);


            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $saldo   = ($PrezzoPC-$AccontoLibero);
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                $saldo   = ($PrezzoPC-$AccontoImporto);
                $acconto = number_format($AccontoImporto,2,',','.');
            }
        }
          return $acconto;

    }else{
        return '';
    }
}

function tot_fatturato_buoni_voucher(){
    global $dbMysqli,$prima_data,$seconda_data;
    
    $prima_data   = $prima_data;
    $seconda_data = $seconda_data;

	$select ='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato_buoni
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1=1
                AND hospitality_guest.idsito = '.IDSITO.'
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND hospitality_guest.DataValiditaVoucher IS NOT NULL
                AND '.($_REQUEST['date']==''?' (hospitality_guest.DataVoucherRecSend >= "'.date('Y').'-01-01" AND hospitality_guest.DataVoucherRecSend <= "'.date('Y').'-12-31")':' (hospitality_guest.DataVoucherRecSend >= "'.$prima_data.'" AND hospitality_guest.DataVoucherRecSend <= "'.$seconda_data.'")');
    $result = $dbMysqli->query($select);
    $rwc    = $result[0];
    if($rwc['fatturato_buoni']!=''){
        return  number_format($rwc['fatturato_buoni'],2,',','.');
    }else{
        return false;
    }

}
function numero_buoni_voucher(){
    global $dbMysqli,$prima_data,$seconda_data;
    
    $prima_data   = $prima_data;
    $seconda_data = $seconda_data;

	$select ='  SELECT 
                    COUNT(hospitality_guest.Id) as NumeroDisdette
                FROM 
                    hospitality_guest 
                WHERE 1=1
                AND hospitality_guest.idsito = '.IDSITO.'
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND hospitality_guest.DataValiditaVoucher IS NOT NULL
                AND '.($_REQUEST['date']==''?' (hospitality_guest.DataVoucherRecSend >= "'.date('Y').'-01-01" AND hospitality_guest.DataVoucherRecSend <= "'.date('Y').'-12-31")':' (hospitality_guest.DataVoucherRecSend >= "'.$prima_data.'" AND hospitality_guest.DataVoucherRecSend <= "'.$seconda_data.'")');
    $result = $dbMysqli->query($select);
    $rwc    = $result[0];
    if($rwc['NumeroDisdette']!=''){
        return  '<small style="cursor:pointer;z-index:99;position:absolute;top:20;left:95%;width:100%">(N° '.$rwc['NumeroDisdette'].')</small>';
    }else{
        return false;
    }

}
function check_vista(){
    global $dbMysqli;
    $select  = "SELECT ViewIdAnalytics FROM siti WHERE idsito = ".IDSITO."";
    $record_ = $dbMysqli->query($select);
    $record  = $record_[0];
    $viewId  = $record['ViewIdAnalytics'];
    if($viewId == ''){
        $output = false;
    }else{
        $output = true;
    }
    return $output;
}
function check_propertyId(){
    global $dbMysqli;
    $select  = "SELECT PropertyIdAnalyticsGA4 FROM siti WHERE idsito = ".IDSITO."";
    $record_ = $dbMysqli->query($select);
    $record  = $record_[0];
    $propId  = $record['PropertyIdAnalyticsGA4'];
    if($propId == ''){
        $output = false;
    }else{
        $output = true;
    }
    return $output;
}
function get_account_analytics($idsito){
    global $dbMysqli;
  
    $sql = "SELECT IdAccountAnalytics FROM siti WHERE idsito = ".$idsito;
    $rs = $dbMysqli->query($sql);
    $rc = $rs[0];
  
    $IdAccountAnalytics = $rc['IdAccountAnalytics'];
  
    return $IdAccountAnalytics;
  }

  function get_name_template($idsito,$type){
    global $dbMysqli;
  
    $sql = "SELECT TemplateName FROM hospitality_template_background WHERE idsito = ".$idsito." AND TemplateType = '".$type."'";
    $rs = $dbMysqli->query($sql);
    $rc = $rs[0];
    $NomeTemplate = $rc['TemplateName'];

    return $NomeTemplate;
  }

    function check_view_template($idsito, $type)
    {
        global $dbMysqli;
        $check = '';

        $sql = "SELECT TemplateName FROM hospitality_template_background WHERE idsito = " . $idsito . " AND TemplateType = '" . $type . "' AND Visibile = 1";
        $rs = $dbMysqli->query($sql);
        if(sizeof($rs) > 0){
            $check = true;
        }else{
            $check = false;
        }

        return $check;
    }

    function check_view_by_name_template($idsito, $name)
    {
        global $dbMysqli;
        $check = '';

        $sql = "SELECT TemplateName FROM hospitality_template_background WHERE idsito = " . $idsito . " AND TemplateName = '" . $name . "' AND Visibile = 1";
        $rs = $dbMysqli->query($sql);
        if(sizeof($rs) > 0){
            $check = true;
        }else{
            $check = false;
        }

        return $check;
    }

  function check_landing_type_template($idsito, $idrichiesta = null)
{
    global $dbMysqli;

    $sel = "SELECT hospitality_template_background.TemplateType FROM hospitality_guest
				INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
				WHERE hospitality_guest.idsito = " . $idsito . " ";
    if ($idrichiesta != '') {
        $sel .= " AND hospitality_guest.Id = " . $idrichiesta;
    }else{
        $sel .= " AND hospitality_guest.TipoRichiesta = 'Preventivo' AND hospitality_guest.Accettato = 0";
    }
    $sel .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.NumeroPrenotazione DESC";

    $res          = $dbMysqli->query($sel);
    $record       = $res[0];
    $TemplateType = $record['TemplateType'];

    return $TemplateType;
}
function check_template_custom($idsito)
{
    global $dbMysqli;

    $sel      = "   SELECT hospitality_template_background.TemplateType FROM hospitality_template_landing 
                    INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
                    WHERE hospitality_template_landing.idsito = " . $idsito . "";
    $res      = $dbMysqli->query($sel);
    $record   = $res[0];
    $template = $record['TemplateType'];

    return $template;
}
function check_nome_template_by_id($id_template,$idsito)
{
    global $dbMysqli;

        $sel      = "SELECT TemplateName,TemplateType FROM hospitality_template_background  WHERE Id = ".$id_template." AND idsito = " . $idsito . " ";
        $res      = $dbMysqli->query($sel);
        $tot      = sizeof($res);

        if($tot>0){
            $record = $res[0];
            $output = $record;
        }else{
            $output = '';
        }


    return $output;
}
function check_nome_template_default($idsito)
{
    global $dbMysqli;
        $sel      = "   SELECT Template FROM hospitality_template_landing  WHERE idsito = " . $idsito . " ";
        $res      = $dbMysqli->query($sel);
        $tot      = sizeof($res);

        if($tot>0){
            $record   = $res[0];
            $output = $record;
        }
    

    return $output;
}
function lista_nomi_template($idsito){
    global $dbMysqli;
  
    $sql = "SELECT TemplateName FROM hospitality_template_background WHERE idsito = ".$idsito."";
    $rc = $dbMysqli->query($sql);
    foreach ($rc as $key => $value) {
        $output_[] = "'".$value['TemplateName']."'";
    }
    $output = implode(",",$output_);
    return $output;
}
function check_controllo_servizi($idsito){
    global $dbMysqli;
        $sel      = "SELECT * FROM hospitality_tipo_servizi_config  WHERE idsito = " . $idsito . " AND AbilitatoLatoLandingPage = 1";
        $res      = $dbMysqli->query($sel);
        $tot      = sizeof($res);
  
        if($tot>0){
          $output = 1;
        }else{
          $output = 0;
        }
  
    return $output;
  }
  function check_numero_servizi($idsito){
    global $dbMysqli;

        $num_servizi = "SELECT COUNT(id) as num_serv FROM hospitality_tipo_servizi WHERE idsito = ".IDSITO." AND Abilitato = 1" ;
        $result_num = $dbMysqli->query($num_servizi);
        $r = $result_num[0];
        $numero =  $r['num_serv'];

        return $numero;
  }
  function contoallarovescia($min,$page){


    $contatore = '  <script src="'.BASE_URL_SITO.'js/countdown-0.9.5.js"></script>'."\r\n";
    $contatore .= '  <script>
    // Impostiamo timer per ...   
                        $(document).ready(function() { 
                            $("#countdown").countDown({ 
                                targetOffset: { 
                                    \'day\':    0, 
                                    \'month\':  0, 
                                    \'year\':   0, 
                                    \'hour\':   0, 
                                    \'min\':    '.$min.', 
                                    \'sec\':    0 
                                },
                                onComplete: function() { document.location="'.BASE_URL_SITO.''.$page.'/";}
                            }); 
                        });          
                    </script>'."\r\n";
    $contatore .= ' <style>
                        .contoallerovescia{
                            position:absolute;
                            right:20px;
                            font-size:12px;
                            float:right;
                        }
                        .testo_contatore{
                            float:left;
                            margin-right:10px;
                        }
                        .minuti{
                            float:left;
                            margin-right:10px;
                        }
                        .mg_l{
                            margin-left:2px;
                        }
                        .secondi{
                            float:left;
                        }
                        .fl_l{
                            float:left;
                        }
                    </style>'."\r\n";
    $contatore .= '  <!-- inizio pannello contatore  -->
                        <div id="countdown" class="contoallerovescia"> 
                        <div class="testo_contatore"> Prossimo refresh della pagina tra: </div>     
                        <div class="dash minutes_dash minuti"> 
                            <span class="dash_title mg_l">min</span> 
                            <div class="digit fl_l"><div class="top" style="display: none;">0</div><div class="bottom" style="display: block;">0</div></div> 
                            <div class="digit fl_l"><div class="top" style="display: none;">0</div><div class="bottom" style="display: block;">0</div></div> 
                        </div>     
                        <div class="dash seconds_dash secondi"> 
                            <span class="dash_title mg_l">sec</span> 
                            <div class="digit fl_l"><div class="top" style="display: none;">0</div><div class="bottom" style="display: block;">0</div></div> 
                            <div class="digit fl_l"><div class="top" style="display: none;">0</div><div class="bottom" style="display: block;">0</div></div> 
                        </div> 
                    </div>
                    <!-- Fine contatore -->
                    <div class="clearfix"></div>'."\r\n";

    return $contatore;
  }
  function get_form_new($id_form, $id_sito, $id_lingua, $hput = null){
	global $dbMysqli;
	$form = array();
	$q = "	SELECT
				fh.*,
				fh.id AS idForm,
				fhl.*
			FROM
                hospitality_form_testata AS fh,
                hospitality_form_testata_lang AS fhl
			WHERE
				fh.idsito = '".$id_sito."'
				AND fh.id = '".$id_form."'
				AND fh.id = fhl.id_form
				AND fhl.id_lang = '".$id_lingua."'";

	$record = $dbMysqli->query($q);

    foreach($record as $key => $row){
		$form['header'][$row['tipo_label']] = $row;
	}

	$q1 = "	SELECT
				fcl.parametri as parametri_campo,
				fc.id AS idContent,
				fc.*,
				fcl.*,
				fi.params as params,
				fi.component_name AS tipo,
				fi.type AS sottotipo
			FROM
				hospitality_form_contenuti AS fc,
				hospitality_form_contenuti_lang AS fcl,
				hospitality_form_campi AS fi
			WHERE
				fc.id = fcl.id_campo
				AND fc.id_sito = '".$id_sito."'
				".($hput?' AND fc.attivo = \'1\'':'')."
				AND fc.id_form = '".$id_form."'
				AND fcl.id_lang = '".$id_lingua."'
				AND fi.id = fc.id_tipo_input
			order by
				fc.ordinamento asc";
	$record1 = $dbMysqli->query($q1);

	foreach($record1 as $key1 => $row1){
		$form['content'][$row1['id']] = $row1;
	}

	return $form;
}
function array_tipologia_new($itemSet){
	global $dbMysqli;
		$output  = '';
		$q       = "SELECT * FROM hospitality_form_campi";
		$record  = $dbMysqli->query($q);

        foreach($record as $key => $row){
			$output .= '<option value="'.$row['id'].'" '.($row['id']==$itemSet?'selected="selected"':'').'>'.$row['component_name'].' - ('.$row['type'].')</option>';
		}
	return $output;
}
function check_form_exists($idsito){
    global $dbMysqli;

    $sel = "SELECT
                hospitality_form_testata.id
            FROM
                hospitality_form_testata
            WHERE
                hospitality_form_testata.idsito = ".$idsito;
                
    $res = $dbMysqli->query($sel);
    $tot = sizeof($res);
    if($tot>0){
        $check = 1;
      }else{
        $check = 0;
      }
    return $check;
}
function getIdForm($idsito){

    global $dbMysqli;

    $sel = "SELECT
                hospitality_form_testata.id
            FROM
                hospitality_form_testata
            WHERE
                hospitality_form_testata.idsito = ".$idsito;
                
    $res    = $dbMysqli->query($sel);
    $record = $res[0];
    $idform = $record['id'];
    if(is_array($record)) {
        if($record > count($record))
        return $idform;
    }else{
        return '';
    }
   
}
function check_lang_form_exists($idSito){
	global $dbMysqli;
		$lingue = array();
		$q = "  SELECT 
                    hospitality_lingue_form.id
                FROM 
                    hospitality_lingue_form 
                WHERE 
                    hospitality_lingue_form.idsito = '".$idSito."' ";
		$result = $dbMysqli->query($q);

        $tot = sizeof($result);
        if($tot>0){
            $check = 1;
          }else{
            $check = 0;
          }
        return $check;
}
function get_content_testata_form($id_form, $id_sito){
	global $dbMysqli;

	$q = "	SELECT
				*
			FROM
                hospitality_form_testata
			WHERE
                hospitality_form_testata.idsito = '".$id_sito."'
            AND 
                hospitality_form_testata.id = '".$id_form."'";

	$res    = $dbMysqli->query($q);
	$record = $res[0];
    return $record;
}
function ckeck_notify_chat($idsito){
    global $dbMysqli;

    $body      = '';
    $etichetta = '';

    $select = " SELECT
                    hospitality_chat_notify.*
                FROM
                    hospitality_chat_notify 
                WHERE
                    hospitality_chat_notify.idsito = ".$idsito." 
                GROUP BY 
                    hospitality_chat_notify.NumeroPrenotazione
                ORDER BY
                    hospitality_chat_notify.NumeroPrenotazione DESC";

    $record  = $dbMysqli->query($select);

    if(sizeof($record)>0){

        foreach ($record as $key => $value) {

                $sel = " SELECT
                                hospitality_guest.Id as id_richiesta,
                                hospitality_guest.TipoRichiesta,
                                hospitality_guest.Chiuso
                            FROM
                                hospitality_guest 
                            WHERE
                                hospitality_guest.idsito = ".$idsito." 
                            AND
                                hospitality_guest.NumeroPrenotazione = ".$value['NumeroPrenotazione']."
                            ORDER BY
                                hospitality_guest.NumeroPrenotazione DESC
                            LIMIT 1";

                $rus = $dbMysqli->query($sel);
                $rec = $rus[0];

                if($rec['TipoRichiesta'] == 'Preventivo'){
                    $etichetta = 'Prev.';
                    $proposizione = 'del';
                    $long_etichetta = 'Preventivo';
                }elseif($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 0){
                    $etichetta = 'Conf.';
                    $proposizione = 'della';
                    $long_etichetta = 'Conferma';
                }elseif($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 1){
                    $etichetta = 'Preno.';
                    $proposizione = 'della';
                    $long_etichetta = 'Prenotazione';
                }

            $body .='   <div id="riga'.$value['id'].'" class="media">
                            <a class="media-left" href="#!"  title="Apri la Chat '.$proposizione.' '.$long_etichetta.'" id="OpenDashChat'.$value['id'].'">
                                <i class="fa fa-comments-o fa-2x fa-fw"></i>
                                <!-- <div class="live-status bg-success"></div> -->
                            </a>
                            <div class="media-body">
                                <div class="f-11 chat-header nowrap">
                                    <div class="row">
                                        <div class="col-md-2 f-11">'.$etichetta.'</div>
                                        <div class="col-md-3 text-center">N° <a href="'.BASE_URL_SITO.'modifica_proposta/edit/'.$rec['id_richiesta'].'" class="text-info f-11" data-toggle="tooltip" title="vai al '.$long_etichetta.'">'.$value['NumeroPrenotazione'].'</a></div>
                                        <div class="col-md-5 f-11">'.(strlen($value['user'])>=12?substr($value['user'],0,12).'...':$value['user']).'</div>
                                        <div class="col-md-2 text-right"><a href="javascript:;" title="Chiudi la Chat '.$proposizione.' '.$long_etichetta.'" id="CloseChat'.$value['id'].'"><i class="fa fa-chain-broken"></i></a></div>
                                    </div>             
                                </div>
                            </div>
                        </div>'."\r\n";
            $body .= '  <script>
                            $(document).ready(function(){
                                $("#OpenDashChat'.$value['id'].'").on("click",function(){							
                                    $("#srcAttr'.$value['id'].'").attr("src","'.BASE_URL_SITO.'ajax/chat/dashboard_chat.php?NumeroPrenotazione='.$value['NumeroPrenotazione'].'&idsito='.IDSITO.'&id_notify='.$value['id'].'");
                                    $("#idChat'.$value['id'].'").modal("show");
                                });
                                $("#CloseChat'.$value['id'].'").on("click",function(){
                                    if (window.confirm("ATTENZIONE: Sicuro di voler chiudere la chat N° '.$value['NumeroPrenotazione'].'?")){
                                        $.ajax({
                                            url: "'.BASE_URL_SITO.'ajax/chat/close_chat.php",
                                            type: "POST",
                                            data: "id='.$value['id'].'&idsito='.$value['idsito'].'&NumeroPrenotazione='.$value['NumeroPrenotazione'].'&id_guest='.$rec['id_richiesta'].'&user='.$_SESSION['user_accesso'].'",
                                            dataType: "html",
                                            success: function(data) {
                                            $(\'#riga'.$value['id'].'\').remove();
                                            }
                                        });
                                        return false;
                                    }
                                });
                            });
                        </script>';

        }

        return $body;
    }else{
        return '<p class="text-center">Nessuna Chat in attesa di risposta!</p>';
    }
 
} 

function ckeck_notify_chat_modal($idsito){
    global $dbMysqli;
    $select = " SELECT
                    hospitality_chat_notify.*
                FROM
                    hospitality_chat_notify 
                WHERE
                    hospitality_chat_notify.idsito = ".$idsito." 
                GROUP BY
                    hospitality_chat_notify.NumeroPrenotazione
                ORDER BY
                    hospitality_chat_notify.id DESC";

    $record = $dbMysqli->query($select);

    if(sizeof($record)>0){

        foreach ($record as $key => $value) {

            $modali .= '<div class="modal fade" id="idChat'.$value['id'].'"  role="dialog" aria-labelledby="idChat'.$value['id'].'">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title nowrap" id="myModalLabel">Chat in attesa di risposta!<div class="clearfix f-11">Chiudi la finestra e ricarica la chat cliccando sulla <b>X</b> oppure clicca con il mouse fuori dalla modale!</div></h5>                                    
                                    <i class="fa fa-times fa-2x" id="pul_close'.$value['id'].'" class="btn btn-out-dotted btn-inverse btn-square btn-sm"  data-dismiss="modal" aria-label="Close" style="float:right;cursor:pointer;"></i>                               
                                </div>
                                    <div class="modal-body">
                                         <iframe id="srcAttr'.$value['id'].'" src="" frameborder="no" scrolling="yes" onload="resizeIframe(this)" style="min-height:800px;width:100%"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#pul_close'.$value['id'].'").on("click",function () {
                                    location.reload();  
                                }); 
                            });
                        </script>';
        }


        return $modali;
    }
 
} 

function check_control_modify($idsito,$id_richiesta,$operatore){
    global $dbMysqli;

    $selectCheck = "SELECT * FROM hospitality_check_modifica WHERE idsito = ".$idsito." AND id_richiesta = ".$id_richiesta."  ORDER BY data_ora DESC";
    $resultCheck = $dbMysqli->query($selectCheck);
    $check       = sizeof($resultCheck);
    $recordCheck = $resultCheck[0];
    if($check == 0){
        $insertCheckOp = "INSERT INTO hospitality_check_modifica(idsito,id_richiesta,operatore,data_ora) VALUES('".$idsito."','".$id_richiesta."','".addslashes($operatore)."','".date('Y-m-d H:s:i')."')";
        $dbMysqli->query($insertCheckOp);
    }else{
        $selectCheckOp = "SELECT * FROM hospitality_check_modifica WHERE idsito = ".$idsito." AND id_richiesta = ".$id_richiesta." AND operatore = '".addslashes($operatore)."' ORDER BY data_ora DESC";
        $resultCheckOp = $dbMysqli->query($selectCheckOp);
        $checkOp       = sizeof($resultCheckOp);
        $recordCheckOp = $resultCheckOp[0];

        if($checkOp == 0){

        
                return'  <script>
                            $(function() {
                                $.notify({ 
                                    title:    \'La proposta è in fase di modifica!\', 
                                    body:     \'<b class="text-danger">ATTENZIONE:</b><br> impossibile modificare, in quanto è già in uso da operatore <b>'.$recordCheck['operatore'].'</b>!\', 
                                    icon:     \'fa fa-exclamation\', 
                                    position: \'top-center\', 
                                    timeout: 10000,
                                    showTime: 100,
                                    forever: true
                                }); 
                            });
                        </script>'."\r\n";
        
        }
    }

}

function check_recensioni_punteggio($idsito){
    global $dbMysqli;

    $select = "SELECT * FROM hospitality_recensioni_range WHERE idsito = ".$idsito." AND abilita = 1";
    $result = $dbMysqli->query($select);
    $check = sizeof($result);

    return $check;
}

function check_recensioni_data($idsito){
    global $dbMysqli;

    $select = "SELECT * FROM hospitality_giorni_recensioni WHERE idsito = ".$idsito." AND abilita = 1";
    $result = $dbMysqli->query($select);
    $check = sizeof($result);

    return $check;
}

function count_notify_chat($idsito){
    global $dbMysqli;

    $body      = '';
    $etichetta = '';

    $select = " SELECT
                    hospitality_chat_notify.id
                FROM
                    hospitality_chat_notify 
                WHERE
                    hospitality_chat_notify.idsito = ".$idsito." 
                GROUP BY 
                    hospitality_chat_notify.NumeroPrenotazione
                ORDER BY
                    hospitality_chat_notify.NumeroPrenotazione DESC";

    $record = $dbMysqli->query($select);
    $numero_chat = sizeof($record);
    if($numero_chat > 0){
        return '<label class="badge bg-green" data-toogle="tooltip" title="Chat in attesa di risposta!" style="margin-left:10px">'.$numero_chat.'</label>';
    }

}
/*function ckeck_modifica($idsito){
    global $dbMysqli;

    $body      = '';
    $etichetta = '';

    $select = " SELECT
                    hospitality_check_modifica.*
                FROM
                    hospitality_check_modifica 
                WHERE
                    hospitality_check_modifica.idsito = ".$idsito." 
                ORDER BY
                    hospitality_check_modifica.id DESC";

    $record  = $dbMysqli->query($select);

    if(sizeof($record)>0){

        $body .= '<table class="xcrud-list table table-striped table-hover table-bordered f-12" id="tabellaChat">
                    <tr>
                        <th class="text-left  nowrap">Tipo</th>
                        <th class="text-center nowrap">Numero</th>
                        <th class="text-left  nowrap">Operatore</th>
                        <th class="text-left  nowrap">Sblocca</th>
                    </tr>';
        foreach ($record as $key => $value) {

                $sel = " SELECT
                                hospitality_guest.TipoRichiesta,
                                hospitality_guest.NumeroPrenotazione,
                                hospitality_guest.Chiuso
                            FROM
                                hospitality_guest 
                            WHERE
                                hospitality_guest.idsito = ".$idsito." 
                            AND
                                hospitality_guest.id = ".$value['id_richiesta']."
                            ORDER BY
                                hospitality_guest.Id DESC
                            LIMIT 1";

                $rus  = $dbMysqli->query($sel);
                $rec  = $rus[0];

                if($rec['TipoRichiesta'] == 'Preventivo'){
                    $etichetta = 'Preventivo';
                    $prepos = 'al';
                }elseif($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 0){
                    $etichetta = 'Conferma';
                    $prepos = 'alla';
                }elseif($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 1){
                    $etichetta = 'Prenotazione';
                    $prepos = 'alla';
                }

            $body .= '<tr id="SbloccaRiga'.$value['id'].'">
                        <td class="text-left nowrap">'.$etichetta.'</td>
                        <td class="text-center nowrap"><a href="'.BASE_URL_SITO.'modifica_proposta/edit/'.$value['id_richiesta'].'" class="text-info" data-toggle="tooltip" title="Vai '.$prepos.' '.$etichetta.'">N° '.$rec['NumeroPrenotazione'].'</a></td>
                        <td class="text-left nowrap">'.$value['operatore'].'</td>
                        <td class="text-center nowrap">
                            <a href="javascript:;" id="SbloccaP'.$value['id'].'"><i class="fa fa-chain-broken"></i></a>
                            <script>
                                $(document).ready(function(){
                                    $("#SbloccaP'.$value['id'].'").on("click",function(){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler sbloccare N° '.$rec['NumeroPrenotazione'].'?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/sblocca_p.php",
                                                type: "POST",
                                                data: "id='.$value['id'].'&idsito='.$value['idsito'].'&NumeroPrenotazione='.$rec['NumeroPrenotazione'].'",
                                                dataType: "html",
                                                success: function(data) {
                                                $(\'#SbloccaRiga'.$value['id'].'\').remove();
                                                }
                                            });
                                            return false;
                                        }
                                    });
                                });
                            </script>
                        </td>
                    </tr>';

        }
        $body .= '</table>';

        return $body;
    }else{
        return 'Nessuna Proposta bloccata!';
    }
 
} */
function check_data_password_overfade(){
    global $dbMysqli;
    /** 
     * * SONO ESCLUSI DAL CAMBIO PASSWORD GLI UTENTI CHE HANNO IL PMS DI ERICSOFT 
     * * ALTRIMENIT OGNI VOLTA ANDREBBE COMUNICATA LA NUOVA PWS ANCHE A LORO 
     * */
    $sel = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".IDSITO."  AND PMS = 1";
    $res = $dbMysqli->query($sel);
    if(sizeof($res)==0){

        $select = "SELECT * FROM utenti_quoto WHERE idsito = ".IDSITO." AND username ='".$_SESSION['user_accesso']."' AND abilitato = 1";
        $result = $dbMysqli->query($select);
        $record = $result[0];
        if(is_array($record)) {
            if($record > count($record))
                $check = count($record);
        }else{
            $check = 0;
        }
        if($check>0){
            $dataAcc = $record['data_account'];
            $data_ = explode("-",$dataAcc);
            $d = $data_[2];
            $m = $data_[1];
            $y = $data_[0];
        
            $check_date = mktime(0,0,0,($m+3),$d,$y);
            $data_account = date('Y-m-d',$check_date);   
        
                $op_username =  $record['username'];
                $op_passowrd =  $record['password'];
                $op_id       =  $record['id'];
        
        
            if(date('Y-m-d')>=$data_account){
                    $output ='  <!-- validate password css -->
                                <link rel="stylesheet" href="'.BASE_URL_SITO.'validate-password/css/jquery.passwordRequirements.css" />
                                <style>#pr-box{z-index:2147483647!important;}</style>
                                <!-- validate password js -->
                                <script src="'.BASE_URL_SITO.'validate-password/js/jquery.passwordRequirements.min.js"></script>
                                <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">                                           
                                            <h5 class="modal-title text-center">Sono passati 3 mesi, è obbligatorio modificare <br>la tua password di accesso a QUOTO!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <div id="result_check"></div>
                                                        <div id="result_save"></div>
                                                        <form name="update_pass" id="update_pass" method="post">
                                                            <div class="form-group">
                                                                <input type="text" name="username" value="'.$op_username.'" class="form-control" placeholder="Nome Utente" readonly />
                                                            </div>
                                                            <div class="clearfix p-b-5"></div>
                                                            <div class="form-group">
                                                                <input type="text" name="check_password" id="check_password" value="'.base64_decode($op_passowrd).'" class="pr-password form-control" placeholder="Crea la tua nuova Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La password deve contenere un numero e una lettera maiuscola e minuscola e almeno 8 caratteri e non più di 18"  minlength="8" maxlength="18" required />
                                                            </div> 
                                                            <div class="clearfix p-b-5"></div>
                                                            <div class="form-group text-center">  
                                                                <input type="hidden" name="idutente" id="idutente" value="'.$op_id.'"> 
                                                                <input type="hidden" name="idsito"  id="idsito" value="'.IDSITO.'">  
                                                                <input type="hidden" name="email_utente"  id="email_utente" value="'.EMAILHOTEL.'">                                                          
                                                                <button type="submit" class="btn btn-info" id="pul_change_pass">Salva nuova password</button>  
                                                            </div>
                                                        </form>
                                                        <script>
                                                            $(document).ready(function(){                                                                                                                            
                                                        
                                                                $(".pr-password").passwordRequirements({
                                                                        numCharacters: 8,
                                                                        useLowercase:true,
                                                                        useUppercase:true,
                                                                        useNumbers:true,
                                                                        useSpecial:false
                                                                });

                                                                $("#pul_change_pass").attr("disabled","disabled");

                                                                $("#check_password").on("keyup", function () {
                                                                    var pass = $("#check_password").val();
                                                                    $.ajax({
                                                                        url: "'.BASE_URL_SITO.'ajax/login/check_password.php",
                                                                        type: "POST",
                                                                        data: "idutente='.$op_id.'&password="+pass,
                                                                        dataType: "html",
                                                                        success: function(msg) {
                                                                            if(msg!=""){
                                                                                $("#result_check").html(msg);
                                                                                $("#pul_change_pass").attr("disabled","disabled");
                                                                            }else{
                                                                                $("#result_check").html("");
                                                                                $("#pul_change_pass").attr("disabled",false);
                                                                            }
                                                                        }
                                                                    });            
                                                                });

                                                                $("#update_pass").on("submit", function () {
                                                                    var dati = $("#update_pass").serialize();                                                    
                                                                    $.ajax({
                                                                        url: "'.BASE_URL_SITO.'ajax/login/save_new_password.php",
                                                                        type: "POST",
                                                                        data: dati,
                                                                        dataType: "html",
                                                                        success: function(data) {
                                                                                $("#result_save").html("<div class=\"alert alert-success text-center\">La nuova password è stata salvata con successo!<br> A breve verrai diretto al Log out del software!</div>");
                                                                                setTimeout(function(){
                                                                                    $("#result_save").fadeOut(200);
                                                                                    $("#change_password").modal("hide"); 
                                                                                    window.location.href = "'.BASE_URL_SITO.'logout.php";
                                                                                }, 3000);
                                                                            }
                                                                    });
                                                                    return false;
                                                                });

                                                            });
                                                        </script>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>'."\r\n";

                $output .=  '   <script>
                                    $(document).ready(function(){
                                        $("#change_password").modal("show");  
                                    });
                                </script>'."\r\n";
                    $output .=  '<style>        
                                    div.fadeMe {
                                    opacity:    0.5; 
                                    background: #000; 
                                    width:      100%;
                                    height:     100%; 
                                    z-index:    10;
                                    top:        0; 
                                    left:       0; 
                                    position:   fixed; 
                                    }
                                </style>
                                <div class="fadeMe"></div>';
            }
        }
    }
      return $output;
}
function check_bedzzlebooking($idsito){
    global $dbMysqli;
       $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".$idsito."  AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
       $Tcheck = $dbMysqli->query($Qcheck);

       if(sizeof($Tcheck)>0){
           $check = 1;
       }else{
           $check = 0;
       }
   return $check;
}
function check_fatturato_telefono($idsito){
    global $dbMysqli;
       $Qcheck = "SELECT * FROM hospitality_guest_track_phone WHERE idsito = ".$idsito."";
       $Qquery = $dbMysqli->query($Qcheck);
 
       if(sizeof($Tcheck)>0){
           $check = 1;
       }else{
           $check = 0;
       }
   return $check;
}
function syncro_bimboinviaggio($idsito){
    global $dbMysqli;
    // inclusione per import email di bimboinviaggio
    $qry2  = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'bimboinviaggio.com' AND idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC";
    $sq2   = $dbMysqli->query($qry2);
    $imap2 = $sq2[0];
        if($imap2['ServerEmail'] !='' && $imap2['UserEmail'] !='' && $imap2['PasswordEmail'] !=''){
            $Button = '<a href="#" class="btn bg-teal btn-xs" id="CheckBtn8">Syncro bimboinviaggio.com</a>
                                            <div id="pul_hide8"></div>
                                            <script>
                                            $(document).ready(function() {
                                                if(leggiCookie(\'syncro_imap_bimboinviaggio\')) {
                                                $("#CheckBtn8").css(\'display\',\'none\');
                                                $("#pul_hide8").html(\'<small class="text-info"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></small>\');
                                                }else{
                                                    $("#pul_hide8").hide();
                                                }
                                                $(\'#CheckBtn8\').click(function(){
                                                        scriviCookie(\'syncro_imap_bimboinviaggio\',\'bimboinviaggio\',\'60\');
                                                        $("#CheckBtn8").css(\'display\',\'none\');
                                                        $("#ctrl8").html(\'<img src="'.BASE_URL_SITO.'img/loader.gif" style="max-width:100%;"/>\');
                                                        var idsito   = '.IDSITO.';
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "'.BASE_URL_SITO.'ajax/import_imap_bimboinviaggio.php",
                                                            data: "idsito=" + idsito,
                                                            dataType: "html",
                                                            success: function(data){
                                                                $("#ctrl8").html(\'<small class="text-info"><b>Sincronizzazione effettuata!!</b></small>\');
                                                                    setTimeout(function(){
                                                                            location.reload();
                                                                    },2000);
                                                            },
                                                            // error: function(){
                                                            //     alert("Chiamata fallita, si prega di riprovare...");
                                                            // }
                                                        });
                                                });
                                            });
                                            </script>
                                            <div id="ctrl8"></div>';
        }
        return $Button;
}

function check_syncro_bimboinviaggio($idsito){
    global $dbMysqli;
    $se2 = "SELECT data FROM hospitality_data_import_ottavo_portale WHERE idsito = ".$idsito." ORDER BY id DESC";
    $ri2 = $dbMysqli->query($se2);
    $tt = sizeof($ri2);

    if($tt > 0){
    
        $rr2 = $ri2[0];

        $datS    =  explode(" ",$rr2['data']);
        $dataS   =  explode("-",$datS[0]);
        $dataH   =  explode(":",$datS[1]);
        $data_import_    =  '<small><i class="fa fa-refresh" aria-hidden="true"></i> Ultima sincronizzazione con nuove richieste da <b>bimboinviaggio.com</b>: '.$dataS[2].'-'.$dataS[1].'-'.$dataS[0].' alle '.$dataH[0].':'.$dataH[1].':'.$dataH[2].'<br>Clicca sul pulsante per sincronizzare le email di bimboinviaggio.com!</small>';
    }
    return $data_import_;
}
function DiffNotti($data1,$data2,$formato) {
    $datetime1 = new DateTime($data1);
    $datetime2 = new DateTime($data2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format($formato);
}
function getLastPreventivo($idsito){
		global $dbMysqli;
			$sel     = "SELECT 
                            Id 
                        FROM 
                            hospitality_guest 
                        WHERE 
                            idsito = ".$idsito." 
                        AND 
                            TipoRichiesta = 'Preventivo' 
                        AND 
                            DataScadenza >= '".date('Y-m-d')."' 
                        AND 
                            Archivia = 0 
                        AND 
                            Hidden = 0
                        AND 
                            NoDisponibilita = 0 
                        AND 
                            Disdetta = 0 
                        AND 
                            Accettato = 0 
                        ORDER BY 
                            Id DESC 
                        LIMIT 1";
			$res     = $dbMysqli->query($sel);
			$rec     = $res[0];
	
			return $rec['Id'];
}
function getDirectorySito($idsito){
    global $dbMysqli;

        $select = 'SELECT web FROM siti WHERE idsito = "'.$idsito.'"';
        $result = $dbMysqli->query($select);
        $rows   =  $result[0];
        $sito_tmp    = str_replace("http://","",$rows['web']);
        $sito_tmp    = str_replace("https://","",$sito_tmp);
        $sito_tmp    = str_replace("www.","",$sito_tmp);
        $directory_sito = str_replace(".it","",$sito_tmp);
        $directory_sito = str_replace(".com","",$directory_sito);
        $directory_sito = str_replace(".net","",$directory_sito);
        $directory_sito = str_replace(".biz","",$directory_sito);
        $directory_sito = str_replace(".eu","",$directory_sito);
        $directory_sito = str_replace(".de","",$directory_sito);
        $directory_sito = str_replace(".es","",$directory_sito);
        $directory_sito = str_replace(".fr","",$directory_sito);

    return $directory_sito;
}

function num_profila_anno($anno){
    global $fun;
    return $fun->num_profila_anno($anno);
//
//	global $dbMysqli;
//	$res = $dbMysqli->query("SELECT COUNT(Id) as num FROM hospitality_guest  WHERE idsito = ".IDSITO." AND ( YEAR ( hospitality_guest.DataRichiesta ) = '".$anno."' OR YEAR ( hospitality_guest.DataChiuso ) = '".$anno."')");
//	$rwc = $res[0];
//    if($rwc['num'] > 0){
//	    return '<label class="badge badge-primary text-black pull-right">'.$rwc['num'].'</label>';
//    }else{
//        return '';
//    }
}

function flip_data($data){
	$data_tmp = explode("-",$data);
	$new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];
	return $new_data;
}

