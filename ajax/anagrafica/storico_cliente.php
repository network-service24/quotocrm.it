<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

        $idsito     = $_REQUEST['idsito'];
        $nome       = $_REQUEST['nome'];
        $cognome    = $_REQUEST['cognome'];
        $email      = $_REQUEST['email'];

		$select = "	SELECT 
						hospitality_proposte.Id as IdProposta,
						hospitality_proposte.NomeProposta,
						hospitality_proposte.PrezzoL,
						hospitality_proposte.PrezzoP,
						hospitality_guest.TipoRichiesta,
						hospitality_guest.idsito,
						hospitality_guest.AccontoRichiesta,
						hospitality_guest.Nome,
						hospitality_guest.Cognome,
						hospitality_guest.AccontoLibero,
						hospitality_proposte.AccontoPercentuale,
						hospitality_proposte.AccontoImporto,
						hospitality_proposte.AccontoTesto,
						hospitality_guest.Email,
						hospitality_guest.DataArrivo,
						hospitality_guest.DataPartenza,
						hospitality_guest.Chiuso,
                        hospitality_guest.NumeroPrenotazione,
                        hospitality_guest.Id,
                        hospitality_guest.DataRichiesta,
                        hospitality_guest.DataChiuso
					FROM 
						hospitality_proposte
					INNER JOIN 
						hospitality_guest 
					ON 
						hospitality_guest.Id = hospitality_proposte.id_richiesta
					WHERE 
						hospitality_guest.Nome = '".$dbMysqli->escape($nome)."' 
					AND
						hospitality_guest.Cognome = '".$dbMysqli->escape($cognome)."' 
					AND
						hospitality_guest.Email = '".$dbMysqli->escape($email)."' 
					AND 
						hospitality_guest.idsito = ".$idsito." 
					ORDER BY 
                        hospitality_guest.DataRichiesta DESC,
                        hospitality_guest.DataChiuso DESC,
                        hospitality_guest.TipoRichiesta DESC,
                        hospitality_guest.Id DESC";
		$res = $dbMysqli->query($select);
		$tot = sizeof($res);

        $output = '';

		if($tot > 0){

            foreach ($res as $k => $v) {
                $array_p[$v['IdProposta']] = $v;
            }
          

			$Camere          = '';
			$sistemazioneP   = '';
			$sistemazioneC   = '';
			$n               = 1;
			$data_alernativa = '';
			$saldo           = '';
			$etichetta_saldo = '';
			$DPartenza       = '';
			$DArrivo         = '';
			$DNotti          = '';
			
			foreach ($array_p as $key => $value) {

				$PrezzoL            = number_format($value['PrezzoL'],2,',','.');
				$PrezzoP            = number_format($value['PrezzoP'],2,',','.');
				$Id                 = $value['Id'];
                $IdProposta         = $value['IdProposta'];
                $NumeroPrenotazione = $value['NumeroPrenotazione'];
                $DataRichiesta      = $fun->gira_data($value['DataRichiesta']);
                $DataChiuso         = $fun->gira_data_noHour($value['DataChiuso']);
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
				$start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
				$end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
				$formato            = "%a";
				$Notti              = dateDiff($value['DataArrivo'],$value['DataPartenza'],$formato);
				$AccontoPercentuale = $value['AccontoPercentuale'];
				$AccontoImporto     = $value['AccontoImporto'];
				$AccontoTesto       = stripslashes($value['AccontoTesto']);
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
					$formato        = "%a";
					$DNotti         = $fun->dateDiff($rc['Arrivo'],$rc['Partenza'],$formato);
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
						$etichetta_caparra  = 'Carta di Credito a garanzia';
					}
					$saldo   = ($PrezzoPC-$AccontoImporto);
					$acconto = number_format($AccontoImporto,2,',','.');
				}
				if($PrezzoPC==$saldo){
					$etichetta_saldo = 'Cifra a <b>saldo</b> €.0,00';
				}else{
					$etichetta_saldo = 'Cifra a <b>saldo</b> €.'.number_format(floatval($saldo),2,',','.');
				}


				$select2 = "SELECT 
								hospitality_richiesta.*,
								hospitality_tipo_camere.TipoCamere,
								hospitality_tipo_soggiorno.TipoSoggiorno
							FROM 
								hospitality_richiesta
							INNER JOIN 
								hospitality_tipo_camere 
							ON 
								hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
							INNER JOIN 
								hospitality_tipo_soggiorno 
							ON 
								hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
							WHERE 
								hospitality_richiesta.id_proposta = ".$IdProposta."
							AND 
								hospitality_richiesta.id_richiesta = ".$Id  ;
				$res2 = $dbMysqli->query($select2);
				
				$Camere = '';

				if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
					if($value['TipoRichiesta']=='Preventivo'){
						if($Arrivo != $DArrivo || $Partenza != $DPartenza){
							$data_alernativa = '<b>Date alternative</b><br><b>Arrivo</b>  '.$DArrivo.' - <b>Partenza</b>  '.$DPartenza.'<br>';
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
					$Camere .= '<span class="nowrap">
                                    <b>'.$val['TipoSoggiorno'].'</b><br> 
                                    <span class="m-l-10"><i class="fa fa-caret-right"></i> '.$val['TipoCamere'].($val['NumAdulti']!=0?'  A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'</span>
                                </span>
                                <br>';
				}

                $numero_proposte = $tot;

				if($value['TipoRichiesta'] == 'Preventivo'){

 					$output .= '<div class="card">
                                    <div class="card-block text-left">
                                        <div id="view'.$IdProposta.'" class="cursore f-14 prev"><i class="fa fa-angle-double-right m-r-10"></i>Preventivo Nr. '.$NumeroPrenotazione.' del '.$DataRichiesta.'</div>
                                        <div id="hid'.$IdProposta.'" class="m-t-10 m-l-20" style="display:none">
                                            '.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'
                                                <b>'.$Nome.' '.$Cognome.'</b> - '.$Email.'<br>
                                                <b>Arrivo</b>  '.$Arrivo.' - <b>Partenza</b>  '.$Partenza.'<br>
                                            '.$data_alernativa.'
                                            '.$Camere.'    
                                               <b>Prezzo Proposto</b> €.'.$PrezzoP.'
                                        </div>
                                    </div>
                                </div>'; 

				}else{

					$output .= '<div class="card">
                                    <div class="card-block text-left">
                                        <div id="view'.$IdProposta.'" class="cursore f-14"><i class="fa fa-angle-double-right m-r-10"></i>'.($value['Chiuso']==1?'Prenotazione':'Conferma').' Nr. '.$NumeroPrenotazione.' del '.($value['Chiuso']==1?$DataChiuso:$DataRichiesta).'</div>
                                        <div id="hid'.$IdProposta.'" class="m-t-10  m-l-20" style="display:none">
                                            '.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'
                                                <b>'.$Nome.' '.$Cognome.'</b> - '.$Email.'<br>
                                                <b>Arrivo</b>  '.$Arrivo.' - <b>Partenza</b>  '.$Partenza.'<br> 
                                            '.$data_alernativa.'
                                            '.$Camere.' 
                                                <b>Prezzo Proposto</b> €.'.$PrezzoP.'<br />
                                            '.($acconto!=''?'<b>Caparra</b> versata o da prelevare €.'.$acconto.'':'').'<br>
                                            '.$etichetta_saldo.'
                                        </div>
                                    </div>
                                </div>';

				}
                    $JSoutput .=' 
                                        $("#view'.$IdProposta.'").on("click",function(){
                                            $("#hid'.$IdProposta.'").slideToggle();
                                        });
                                ';
                $n++;
                $data_alernativa = '';
                $DPartenza       = '';
                $DArrivo         = '';
                $DNotti          = '';
			}

			echo '<div>
                    <div>
                        <div class="f-13 scroll p-r-10" style="'.($n>=7?'height:700px;':'').'overflow-y:auto;overflow-x:auto;">
                            '.$output.'
                            <script>
                                $(document).ready(function(){
                                    '.$JSoutput.'
                                })
                            </script>
                        </div>
                    </div>
                </div>';

		}else{
			echo '';
		} 
	


?>