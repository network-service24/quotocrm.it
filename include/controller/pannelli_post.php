<?
$r = $dbMysqli->query("SELECT * FROM hospitality_pannelli_esterni WHERE idpannello = ".$_REQUEST['azione']." AND idsito = ".IDSITO."");
$row = $r[0];

if($row['target']=='_blank'){

	$location = $row['url'].'?'.$row['campo_1'].'='.$row['valore_1'].'&'.$row['campo_2'].'='.$row['valore_2'].'&'.$row['campo_3'].'='.$row['valore_3'];

	$content = "<script language=\"javascript\">document.location='$location'</script>";
}

$content .='
            <form  action="'.$row['url'].'" method="'.$row['method'].'" name="form_phpmv" id="form_phpmv" target="'.$row['target'].'">
                <input type="hidden" name="'.$row['campo_1'].'" id="'.$row['campo_1'].'"  value="'.$row['valore_1'].'"/>
                <input type="hidden" name="'.$row['campo_2'].'" id="'.$row['campo_2'].'"  value="'.$row['valore_2'].'"/>
                <input type="hidden" name="'.$row['campo_3'].'" id="'.$row['campo_3'].'"  value="'.$row['valore_3'].'"/>
            </form>'."\r\n";


$content .='<iframe name="iframe" id="iframe" width="100%" height="800" scrolling="auto" frameborder="0"></iframe>'."\r\n";


$content .='<script language="JavaScript">
				document.form_phpmv.submit();
			</script>'."\r\n";