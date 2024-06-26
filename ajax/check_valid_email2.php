<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/class/class.verifyEmail.php';

$EmailCliente   = $_REQUEST['EmailCliente'];
$EmailOperatore = $_REQUEST['EmailOperatore'];

$vmail = new verifyEmail();
$vmail->setStreamTimeoutWait(20);
$vmail->Debug= TRUE;
$vmail->Debugoutput= 'html';

$vmail->setEmailFrom($EmailOperatore);

if ($vmail->check($EmailCliente)) {
    echo 'exist';
} elseif ($vmail->validate($EmailCliente)) {
    echo 'valid but not exist';
} else {
    echo 'not valid and not exist';
}

?>