<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$delete = "DELETE FROM hospitality_chat_notify WHERE id = ".$_REQUEST['id'];
$dbMysqli->query($delete);

$insert ="INSERT INTO hospitality_chat(idsito,
                                        NumeroPrenotazione,
                                        id_guest,
                                        lang,
                                        user,
                                        chat,
                                        data,
                                        operator) 
                                        VALUES ('".$_REQUEST['idsito']."',
                                        '".$_REQUEST['NumeroPrenotazione']."',
                                        '".$_REQUEST['id_guest']."',
                                        '".$_REQUEST['lang']."',
                                        '".($_REQUEST['user']==''?'Operatore':addslashes($_REQUEST['user']))."',														
                                        'La conversazione è stata chiusa dall\'operatore',
                                        '".date('Y-m-d H:i:s')."',
                                        '1')";

$dbMysqli->query($insert);

?>