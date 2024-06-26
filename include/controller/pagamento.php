<?php
	if($_REQUEST['action'] == 'save_pg'){

			if ($_FILES["ricevuta"]["name"]){
					$extension_file = pathinfo($_FILES["ricevuta"]["name"]);
					$type_file = array("pdf","doc","docx","txt","jpg","png");

				if (!in_array(strtolower($extension_file["extension"]), $type_file)) {
					print"<script language=\"javascript\">alert('Formato file non ammesso (".$extension_file['extension'].")');document.location=\"".BASE_URL_SITO."pagamento/&id_richiesta=".$_REQUEST['id_richiesta']."\"</script>";
					exit();
				}
				$_REQUEST['ricevuta'] = "ricevuta_".$_REQUEST['id_richiesta'].".".$extension_file["extension"];
				move_uploaded_file($_FILES["ricevuta"]["tmp_name"], BASE_PATH_SITO.'uploads/'.$_REQUEST['idsito'].'/'.$_REQUEST['ricevuta']);


			}
			if($_REQUEST['copia_ricevuta']){
				$_REQUEST['ricevuta'] = $_REQUEST['copia_ricevuta'];
			}

		$s = "UPDATE hospitality_altri_pagamenti SET CRO = '".$_REQUEST['CRO']."', ricevuta = '".$_REQUEST['ricevuta']."' WHERE Id = ".$_REQUEST['id']." AND id_richiesta = ".$_REQUEST['id_richiesta']." AND idsito = ".$_REQUEST['idsito'];
		$dbMysqli->query($s);


		echo'   <form name="return_back" id="return_back" method="POST" action="'.BASE_URL_SITO.$_REQUEST['provenienza'].'">
					<input type="hidden" name="id_conferma" value="'.$_REQUEST['id_richiesta'].'">
					<input type="hidden" name="id_prenotazione" value="'.$_REQUEST['id_richiesta'].'">
				</form>';
		echo'	<script language="JavaScript">
					document.return_back.submit();
				</script>'."\r\n";

		//header('Location:'.BASE_URL_SITO.$_REQUEST['provenienza']);
	}

	if($_REQUEST['act'] == 'del'){

		$s       = $dbMysqli->query('SELECT ricevuta,id_richiesta FROM hospitality_altri_pagamenti  WHERE Id = '.$_REQUEST['id']);
		$rs      = $s[0];
		$rice    = $rs['ricevuta'];
		$id_rich = $rs['id_richiesta'];
		if (file_exists(BASE_PATH_SITO.'uploads/'.IDSITO.'/'.$rice)) {
			unlink(BASE_PATH_SITO.'uploads/'.IDSITO.'/'.$rice);
			$dbMysqli->query("UPDATE hospitality_altri_pagamenti SET ricevuta = '' WHERE Id = ".$_REQUEST['id']);
		}
		header('Location:'.BASE_URL_SITO.'pagamento/&id_richiesta='.$id_rich);
	}


	$select = 'SELECT hospitality_altri_pagamenti.*,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.NumeroPrenotazione,
				hospitality_guest.Chiuso,hospitality_guest.Archivia,hospitality_guest.AccontoRichiesta,hospitality_guest.AccontoLibero,hospitality_guest.Hidden
				FROM hospitality_altri_pagamenti
				INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_altri_pagamenti.id_richiesta
				WHERE hospitality_altri_pagamenti.id_richiesta = '.$_REQUEST['id_richiesta'].' AND hospitality_altri_pagamenti.idsito = '.IDSITO;
	$record = $dbMysqli->query($select);
	$rows               = $record[0];
	$Nome               = stripslashes($rows['Nome']);
	$Cognome            = stripslashes($rows['Cognome']);
	$NumeroPrenotazione = $rows['NumeroPrenotazione'];
	$AccontoRichiesta   = $rows['AccontoRichiesta'];
	$AccontoLibero      = $rows['AccontoLibero'];
	$IdRichiesta        = $rows['id_richiesta'];
	$Id        			= $rows['Id'];
	$IdSito        		= $rows['idsito'];
	$TipoPagamento      = $rows['TipoPagamento'];
	$cro                = $rows['CRO'];
	$ricevuta           = $rows['ricevuta'];
	$chiuso             = $rows['Chiuso'];
	$archivia           = $rows['Archivia'];
	$Hidden             = $rows['Hidden'];

	$DataIns            = explode("-",$rows['data_inserimento']);
	$DataInserimento    = $DataIns[2].'-'.$DataIns[1].'-'.$DataIns[0];
	switch($TipoPagamento){
		case"Bonifico":
			$icona = '<i class="fa fa-university fa-2x fa-fw text-purple"></i>';
		break;
		case"Vaglia Postale":
			$icona = '<i class="fa fa-euro fa-2x fa-fw text-maroon"></i>';
		break;
		case"PayPal":
			$icona = '<i class="fa fa-paypal fa-2x text-orange"></i>';
		break;
		case"Gateway Bancario":
			$icona = '<img src="'.BASE_URL_SITO.'img/payway_pwsmage.jpg" class="img-responsive" style="width:25%"/> <i class="fa fa-credit-card fa-2x text-orange"></i> ';
		break;
		case"Gateway Bancario Virtual Pay":
			$icona = '<img src="'.BASE_URL_SITO.'img/virtualpay_form.jpg" class="img-responsive" /> <i class="fa fa-credit-card fa-2x text-orange"></i> ';
		break;
		case"Stripe":
			$icona = '<img src="'.BASE_URL_SITO.'img/stripe.png" class="img-responsive"/> <i class="fa fa-credit-card fa-2x text-purple"></i> ';
		break;
		case"Nexi":
			$icona = '<img src="'.BASE_URL_SITO.'img/LogoNexi_XPay.jpg" class="img-responsive" style="width:25%"/> <i class="fa fa-credit-card fa-2x text-info"></i> ';
		break;
	}
	$sel = "SELECT  hospitality_proposte.PrezzoP as PrezzoP,hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto as AccontoImporto
            FROM hospitality_proposte
            WHERE hospitality_proposte.id_richiesta = ".$_REQUEST['id_richiesta']."";
            $rec = $dbMysqli->query($sel);
            $PrezzoPC = '';
            foreach ($rec as $key => $value) {
                $PrezzoPC           = $value['PrezzoP'];
                $AccontoPercentuale = $value['AccontoPercentuale'];
        		$AccontoImporto     = $value['AccontoImporto'];
            }

    if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
        $acconto = '<b>€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b>';
    }
    if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
        $acconto = '<b>€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b>';
    }
    if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
        $acconto = '<b>€. '.number_format($AccontoLibero,2,',','.').'</b>';
    }
    if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
        $acconto = '<b>€. '.number_format($AccontoImporto,2,',','.').'</b>';
	}
	if($Hidden == 0){
		if($archivia == 0){
			if($chiuso == 0){
				$link='conferme/';
			}else{
				$link ='prenotazioni/';
			}
		}else{
			$link='archivio/';
		}
	}else{
		$link='cestino/';
	}
	if($ricevuta != ''){
		$upload = '<a href="'.BASE_URL_SITO.'uploads/'.IDSITO.'/'.$ricevuta.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> Clicca per visualizzare il file</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.BASE_URL_SITO.'pagamento/&id='.$Id.'&act=del" title="Cancella"><i class="fa fa-trash text-red" aria-hidden="true"></i></a> ';
	}else{

		$upload = ' 
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-fw fa-save"></i></span>
						<input type="file" class="form-control"  name="ricevuta" id="ricevuta">
					</div>
				';
		}
?>
