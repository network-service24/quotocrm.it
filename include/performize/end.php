<?php
$msg = sprintf('%2$s - %1$s - CHECK - session:"%3$s"' . "\n",  date('Y-m-d H:i:s'), $_SERVER['REQUEST_URI'], session_id(), $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']);
if ($_SERVER['REMOTE_ADDR'] == '217.61.62.216')
    file_put_contents(__DIR__ . '/access.log', $msg, FILE_APPEND);
session_register_shutdown();
$closed = session_status() !== PHP_SESSION_ACTIVE;
ob_flush();
flush();
$msg = sprintf('%2$s - %1$s - END PHP - is_session_closed:"%3$s (%6$s)"' . "\n", date('Y-m-d H:i:s'), $_SERVER['REQUEST_URI'], $closed ? 'true' : 'false', $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], session_status());
if ($_SERVER['REMOTE_ADDR'] == '217.61.62.216')
    file_put_contents(__DIR__ . '/access.log', $msg, FILE_APPEND);
if (!$closed) {
    if ($_SERVER['REMOTE_ADDR'] == '217.61.62.216')
        $message = sprintf('%2$s - %1$s - CHIUSURA FORZATA SESSIONE' . "\n", date('Y-m-d H:i:s'), $_SERVER['REQUEST_URI'], $closed ? 'true' : 'false', $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], session_status());
    //   file_put_contents(__DIR__.'/access.log',$msg,FILE_APPEND);
    //close_session();
}
