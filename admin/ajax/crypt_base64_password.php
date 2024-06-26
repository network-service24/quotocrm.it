<?
/**
 * TODO:
 * TABELLE DA AGGIORNARE PROVENIENTI DA SUITEWEB
 * FIXME:
 *
utenti
utenti_quoto
utenti_password
 */
include($_SERVER['DOCUMENT_ROOT'].'/class/MysqliDb.php');

$dbMysqli  = new MysqliDb ('185.81.4.13', 'quotocrm_quotocrm', 'aya)VfUC9g8S', 'quotocrm_v3_nws');

    function encryptIt($q) {
        $Encoded  = base64_encode($q);
        return($Encoded);
    }
    function decryptIt($q) {
        $Decoded  =  base64_decode($q);
        return($Decoded);
    }
$select = "SELECT * FROM utenti_quoto  ORDER BY id DESC";
$array = $dbMysqli->query($select);

$encrypted = '';
$i = 1;
    foreach($array as $key => $val){

        $encrypted = encryptIt($val['password']);
        echo $i.') '.$encrypted .'<br>';

        $update = "UPDATE utenti_quoto SET password = '".$encrypted."' WHERE id = ".$val['id'];
        $dbMysqli->query($update);

        echo $update. '<br />';
        $i++;
    }

?>
