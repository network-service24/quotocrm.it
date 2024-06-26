<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 

$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

$delete = "DELETE FROM hospitality_chat_notify WHERE id = ".$_REQUEST['id'];
mysqli_query($conn,$delete);

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

mysqli_query($conn,$insert);

mysqli_close($conn);
?>